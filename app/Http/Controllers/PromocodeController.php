<?php
namespace App\Http\Controllers;
use Validator;
use Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\{Promocode,Organisation,TimeZoneName};
use Carbon\Carbon;
class PromocodeController extends Controller
{
     public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->userId = auth()->guard('admin')->id();
            $this->environment = auth()->guard('admin')->user()->environment;
            return $next($request);
        });
    }
   public function index()
   {
    $data = Promocode::with('organisation')->where('environment',$this->environment)->orderBy('id','desc')->get();
    foreach ($data as $category) {
        $category->organisation_count = Organisation::whereJsonContains('category_id', $category->id)->count();
    }
    return view('promocode.index', compact('data'));
    }
    public function create()
    {
        $organisation = Organisation::get();
        $timezone = TimeZoneName::get();
        return view('promocode.create',compact('organisation','timezone'));
    }
    public function store(Request $request)
    {
        $request->validate([
                    'promo_code' => [
                        'required',
                        'string',
                        'max:50',
                        'regex:/^[A-Z0-9]+$/i', // only A–Z and 0–9
                    ],
                    'percentage' => [
                        'required',
                        'numeric',
                        'min:1',   // at least 1%
                        'max:100', // max 100%
                    ],
                ]);
        $expiryDate = $request->end_date; // e.g. "09/26/2025"
        $expiryTime = $request->end_time; // e.g. "03:14 PM"
        $timeZone   = $request->time_zone_name;   // e.g. "Africa/Abidjan"
        // Combine date & time
        $dateTimeString = $expiryDate . ' ' . $expiryTime; // "09/26/2025 03:14 PM"
        // Parse with timezone
        $dateTime = Carbon::createFromFormat('Y-m-d H:i', $dateTimeString, $timeZone);
        // Convert to UTC
        $utcDateTime = $dateTime->setTimezone('UTC');
        $form_data = array(
                'promo_code'       =>   $request->promo_code,
                'environment'      =>   $this->environment,
                'percentage_discount'       =>   $request->percentage,
                'organisation_id'  =>   $request->organisation_id,
                'expired_at'       =>   $utcDateTime,
                'time_zone_name'   =>   $timeZone,
            );
        Promocode::create($form_data);
        return redirect()->route('promocode')->with('success', 'Data Added successfully.');
    }
    public function destroy($id)
    {
         Promocode::findOrFail($id)->delete();
         return redirect()->route('promocode')->with('success', 'Data is successfully deleted');
    }
}
