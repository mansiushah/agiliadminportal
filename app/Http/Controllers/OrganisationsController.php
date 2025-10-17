<?php
namespace App\Http\Controllers;
use Validator;
use Session;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\{User,Category,UsaStates,Countries,Currencies,Organisation,Offers,Role,OrganisationTaxRegistrations,Payments,WalletHistory,OfferAnalytics,OfferImages,OfferIntrests,Invoices,Audit,ApiKey,ApiKeyUsage,TimeZoneName};
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Stripe\Stripe;
use Stripe\Customer;
use App\Traits\ApiResponser;
class OrganisationsController extends Controller
{
    use ApiResponser;
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
        $data = Organisation::with('organisationtaxregistrationsm')->where('environment',$this->environment)->withCount('userCount')->orderBy('id','desc')->get();
        return view('organisation.index', compact('data'));
    }
    public function create()
    {
        $category = Category::get();
        $usastates = UsaStates::get();
        $countries = Countries::get();
        $currencies = Currencies::orderBy('currency', 'asc')->get();
        //$currencies = [];
        return view('organisation.create',compact('category','usastates','countries','currencies'));
    }
     public function getCurrencies($country_code)
    {
        $currencies = Currencies::where('country_code', $country_code)
            ->orderBy('currency', 'asc')
            ->get();

        return response()->json($currencies);
    }
    public function store(Request $request)
    {
        $request->validate([
            'company_name'     => 'required|string|max:255',
            'trading_name'  => 'required',
            'company_email'  => 'required|email|unique:organisations',
            'company_number'  => 'required',
            'country_id'       => 'required',
           // 'usa_state_id'     => 'required',
            'currency_id'      => 'required',
            'category_id'      => 'required|array|min:1',
            'category_id.*'    => 'exists:categories,id',
            'offer_quota' => 'required|in:1,0',
            'max_number_of_offer' => [
                'nullable',
                'required_if:offer_quota,1',
                'integer',
                'min:1',
                'max:9999',
            ],
              // 🔹 Custom address validation rule
            'company_address_google_placeid' => 'required|string',
        ], [
            // 🔹 Custom error message
            'company_address_google_placeid.required' => 'The company address field is mandatory.',
        ]);
        $organisation = new Organisation();
        $organisation->environment = $this->environment;
        $organisation->company_name = $request->company_name;
        $organisation->trading_name = $request->trading_name;
        $organisation->company_number = $request->company_number;
        $organisation->company_address_line1 = $request->company_address_line1;
        $organisation->company_address_line2 = $request->company_address_line2;
        $organisation->company_address_city = $request->company_address_city;
        $organisation->company_address_state = $request->company_address_state;
        $organisation->company_address_postal_code = $request->company_address_postal_code;
        $organisation->company_address_country = $request->company_address_country;
        $organisation->company_address_google_placeid = $request->company_address_google_placeid;
        $organisation->company_email = $request->company_email;
        $organisation->country_id = $request->country_id;
        $organisation->usa_state_id = $request->usa_state_id;
        $organisation->currency_id = $request->currency_id;
        $organisation->category_id = json_encode(array_map('intval', $request->category_id));
        $organisation->offer_quota_set = $request->offer_quota;
        $organisation->offer_quota = $request->max_number_of_offer;
        $organisation->save();
        if($organisation)
        {
            Stripe::setApiKey(config('services.stripe.secret'));
            // Create the customer on Stripe
            $customer = Customer::create([
                'name' => $request->company_name,
                'email' => $request->company_email,
                'address' => [
                    'line1' => $request->company_address_line1,
                    'city' => $request->company_address_city,
                    'state' => $request->company_address_state,
                    'postal_code' => $request->company_address_postal_code,
                    'country' => $request->company_address_country,
                ],
                'metadata' => [
                    'company_type' => 'advertiser',
                    'business_name' => $request->company_name
                ],
            ]);
            $customerId = $customer->id;
            $organisationnew = Organisation::where('id',$organisation->id)->first();
            $organisationnew->stripe_test_customer_id = $customerId;
            $organisationnew->save();
            $taxNumbers = $request->tax_registration_number ?? [];
            $taxTypes   = $request->stripe_tax_type ?? [];
          	foreach ($taxNumbers as $index => $number) {
            if (empty($number)) {
                continue; // skip empty tax numbers
            }
            // Create tax ID in Stripe
            $stripeTaxId = Customer::createTaxId(
                $customerId,
                [
                    'type'  => $taxTypes[$index] ?? 'eu_vat',
                    'value' => strtoupper(trim($number)),
                ]
            );
            // Dynamically assign correct column based on environment
            $data = [
                'organisation_id'         => $organisation->id,
                'tax_registration_number' => $number,
                'stripe_tax_type'         => $taxTypes[$index] ?? null,
            ];
            if ($this->environment === '1') {
                $data['stripe_tax_id'] = $stripeTaxId->id;
            } else {
                $data['stripe_test_tax_id'] = $stripeTaxId->id;
            }
            OrganisationTaxRegistrations::create($data);
        }
        }
         return redirect()->route('organisations')->with('success', __('messages.org_add'));
    }
    public function edit($id)
    {
        $category = Category::get();
        $usastates = UsaStates::get();
        $countries = Countries::get();
        $currencies = Currencies::get();
        $data = Organisation::with(['organisationtaxregistrationsm','currencyName'])->findOrFail($id);
        $data->category_id = is_array($data->category_id) ? $data->category_id : json_decode($data->category_id, true);
       //echo "<pre>"; print_r($data);die;
        return view('organisation.edit', compact('data','category','usastates','countries','currencies'));
    }
    public function update(Request $request)
    {
            $request->validate([
            'company_name'     => 'required|string|max:255',
            'country_id'       => 'required',
           // 'usa_state_id'     => 'required',
            'currency_id'      => 'required',
            'category_id'      => 'required|array|min:1',
            'category_id.*'    => 'exists:categories,id',
            'offer_quota' => 'required|in:1,0',
            'max_number_of_offer' => [
                'nullable',
                'required_if:offer_quota,1',
                'integer',
                'min:1',
                'max:9999',
            ],
        ]);
        $organisation = Organisation::with('organisationtaxregistrationsm')->where('id',$request->id)->first();
        $organisation->company_name = $request->company_name;
        $organisation->trading_name = $request->trading_name;
        $organisation->company_number = $request->company_number;
        //$organisation->company_address = $request->company_address;
        $organisation->company_email = $request->company_email;
        $organisation->country_id = $request->country_id;
        $organisation->usa_state_id = $request->usa_state_id;
        $organisation->currency_id = $request->currency_id;
        $organisation->category_id = json_encode(array_map('intval', $request->category_id));
        $organisation->offer_quota_set = $request->offer_quota;
        $organisation->offer_quota = $request->max_number_of_offer;
        $organisation->save();
        if($organisation)
        {
            $organisationnew = Organisation::where('id',$organisation->id)->first();
            $organisationnew->stripe_test_customer_id = $organisation->stripe_test_customer_id;
            $organisationnew->save();
            $taxNumbers = $request->tax_registration_number ?? [];
            $taxTypes   = $request->stripe_tax_type ?? [];
            // Check if country changed
            $oldCountryId = $organisation->getOriginal('country_id');
            $newCountryId = $organisation->country_id;
            if ($oldCountryId != $newCountryId) {
                // Country changed → delete all old tax records
                OrganisationTaxRegistrations::where('organisation_id', $organisation->id)->delete();
            }
             foreach ($taxNumbers as $index => $number) {
                $number = strtoupper(trim($number));
                if (!empty($number)) {
                    Stripe::setApiKey(config('services.stripe.secret'));
                    $customerId = $organisation->stripe_customer_id ?? $organisation->stripe_test_customer_id;
                    $taxType    = $taxTypes[$index] ?? 'eu_vat';
                    // ✅ 1. Get existing tax IDs from Stripe
                    $existingTaxIds = \Stripe\Customer::allTaxIds($customerId, ['limit' => 100]);
                    $alreadyExists = false;
                    foreach ($existingTaxIds->data as $existingTax) {
                        if (
                            strtoupper($existingTax->value) === $number &&
                            $existingTax->type === $taxType
                        ) {
                            $alreadyExists = $existingTax->id;
                            break;
                        }
                    }
                    if ($alreadyExists) {
                        // ✅ Already exists → just update DB mapping
                        $column = env('STRIPE_MODE') === 'live' ? 'stripe_tax_id' : 'stripe_test_tax_id';
                        OrganisationTaxRegistrations::updateOrCreate(
                            [
                                'organisation_id' => $organisation->id,
                                'stripe_tax_type' => $taxType
                            ],
                            [
                                'tax_registration_number' => $number,
                                $column                   => $alreadyExists,
                            ]
                        );
                    } else {
                        // ✅ Create new tax ID in Stripe
                        $stripeTaxId = \Stripe\Customer::createTaxId(
                            $customerId,
                            [
                                'type'  => $taxType,
                                'value' => $number,
                            ]
                        );
                        $column = env('STRIPE_MODE') === 'live' ? 'stripe_tax_id' : 'stripe_test_tax_id';
                        OrganisationTaxRegistrations::updateOrCreate(
                            [
                                'organisation_id' => $organisation->id,
                                'stripe_tax_type' => $taxType
                            ],
                            [
                                'tax_registration_number' => $number,
                                $column                   => $stripeTaxId->id,
                            ]
                        );
                    }
                }
            }
        }
        return redirect()->route('organisations')->with('success', __('messages.org_update'));
    }
    public function destroy($id)
    {
        $organisation = Organisation::findOrFail($id);
        // Get all users under this organisation
        $userIds = $organisation->users->pluck('id');
        // Delete child records linked to these users
        Offers::whereIn('user_id', $userIds)->delete();
        //File::whereIn('user_id', $userIds)->delete();
        // Repeat for other child tables
        // Delete the users themselves
        User::whereIn('id', $userIds)->delete();
        // Finally delete the organisation
        $organisation->delete();
        return redirect()->route('organisations')->with('success', 'Organisation and all related data deleted.');
    }
    public function view($id, Request $request)
    {
        $role = Role::get();
        $Organisationdata = Organisation::where('id', $id)->first();
        if ($request->ajax()) {
            $status = $request->status;
            $role_id = $request->role_id;
            $draw = $request->get('draw');
            $start = $request->get("start", 0);
            $length = $request->get("length", 10);
            $query = User::with('role')->where('environment',$this->environment)->where('organisation_id', $id);
            // ✅ Apply Role Filter
            if (!empty($role_id)) {
                $query->where('role_id', $role_id);
            }
            // ✅ Apply Status Filter
            if (!empty($status)) {
                $query->where('enabled', $status == "enabled" ? 1 : 0);
            }
            $totalRecords = $query->count();
            // ✅ Apply pagination
            $filteredData = $query->orderBy('id', 'desc')
                                ->skip($start)
                                ->take($length)
                                ->get();
            $data = $filteredData->map(function ($row, $index) use ($start) {
                return [
                    'name'    => $row->full_name,
                    'email'   => $row->email,
                    'phone_number' => $row->phone_number,
                    'role'    => $row->role_name_by_id,
                    'offer_quota'    => '-',
                    'wallet_value'    => '$'.$row->wallet_value,
                    'status'  => $row->enabled == 1
                                    ? '<span class="user_enabled_btn">Enabled</span>'
                                    : '<span class="user_disabled_btn">Disabled</span>',
                    'action'  => '
                        <div class="d-flex">
                            <a href="'.route('organisations.user.edit', $row->id).'" class="table_pencil_btn mr-2">
                                <i class="fa fa-pencil-square-o"></i>
                            </a>
                            <a href="#" class="table_eye_btn mr-2 openResetModal" data-bs-toggle="modal" data-id="'.$row->id.'" data-bs-target="#EditOrganaizationModal">
                                <i class="fa fa-lock"></i>
                            </a>
                            <a href="#" class="table_delete_btn" data-bs-toggle="modal" data-bs-target="#DeleteOrganaizationModal2" data-id="'.$row->id.'">
                                <i class="fa fa-trash"></i>
                            </a>
                        </div>
                    ',
                ];
            });
            return response()->json([
                "draw" => intval($draw),
                "recordsTotal" => $totalRecords,
                "recordsFiltered" => $totalRecords,
                "data" => $data,
            ]);
        }
        return view('organisation.view', compact('Organisationdata', 'role'));
    }
    /*public function view($id)
    {
        $role = Role::get();
        $Organisationdata = Organisation::where('id',$id)->first();
        $data = User::with('role')->where('organisation_id',$id)->get();
        return view('organisation.view', compact('Organisationdata','data','role'));
    }*/
    public function createUser($id,Request $request)
    {
        $Organisationdata = Organisation::where('id',$id)->first();
      	$timezone = TimeZoneName::get();
        return view('organisation.userAdd', compact('Organisationdata','timezone'));
    }
    public function StoreUser(Request $request)
    {
       $request->validate([
            'phone_number' => ['required', 'string', 'max:50', 'regex:/^\+?[0-9\s\-]{7,20}$/'],
            'full_name'    => ['required', 'string', 'max:255'],
            'email'        => ['required', 'string', 'email', 'max:500', 'unique:users,email'],
            'role_id' =>  ['required'],
         	'time_zone_name' => ['required']
        ]);
        $token = uniqid(base64_encode(Str::random(10)));
        $urlSafe = $this->makeUrlSafe($token);
        $user = new User();
        $user->environment = $this->environment;
        $user->role_id = $request->role_id;
        $user->organisation_id = $request->organisation_id;
        $user->full_name = $request->full_name;
        $user->phone_number = $request->phone_number;
        $user->time_zone_name = $request->time_zone_name;
        $user->user_offer_quota = $request->user_offer_quota;
        $user->email = $request->email;
        $user->custom_token = $urlSafe;
        $user->password = ''; // no password yet
        $user->first_logon = true;
        $user->save();
        $userID = 1;
        $encryptedId = $urlSafe;
        $link = config('services.ad_portal_url').'/first-login/' . $encryptedId;
        $name = $request->full_name;
        Mail::to($user->email)->send(new \App\Mail\FirstLoginMail($user->name, $link));
        //return view('emails.sentnewpassword', compact('name', 'link'));die;
        //return back()->with('success', 'User created and email sent.');
        return redirect()->route('organisations.view',$request->organisation_id)->with('success', __('messages.org_user_add'));
    }
    public function editUser($id)
    {
        $data = User::findOrFail($id);
        $timezone = TimeZoneName::get();
        return view('organisation.userEdit', compact('data','timezone'));
    }
    public function updateUser(Request $request)
    {
        $user = User::whereId($request->id)->first();
        // print_r($request->id);die;
        $user->role_id = $request->role_id;
        $user->full_name = $request->full_name;
        $user->phone_number = $request->phone_number;
        $user->enabled  = $request->enabled;
        $user->email = $request->email;
      	$user->time_zone_name = $request->time_zone_name;
        $user->save();
        return redirect()->route('organisations.view',$user->organisation_id)->with('success', __('messages.org_user_updated'));
    }
    public function DisableAllUser($id)
    {
        User::where('organisation_id', $id)->update(['enabled' => 0]);
        return redirect()->route('organisations.view',$id)->with('success',  __('messages.disable_all_user'));
    }
    public function destroyUser($id)
    {
        $users = User::findOrFail($id);
        $OffersId = $users->offers ? $users->offers->pluck('id')->toArray() : [];
        Payments::where('user_id', $id)->delete();
        WalletHistory::where('user_id',$id)->delete();
        //OfferAnalytics::whereIn('offer_id',$OffersId)->delete();
        //OfferImages::whereIn('offer_id', $OffersId)->get()->each->delete();
        //OfferIntrests::whereIn('offer_id',$OffersId)->delete();
        //Invoices::whereIn('offer_id',$OffersId)->delete();
        Audit::where('user_id', $id)->delete();
        ApiKey::where('user_id',$id)->delete();
       // ApiKeyUsage::whereIn('offer_id',$OffersId)->delete();
        //Offers::whereIn('user_id', $id)->delete();
        // Finally delete the organisation
        $users->delete();
        return redirect()->route('organisations.view',$id)->with('success',  __('messages.disable_all_user'));
    }
    public function resetUserPassword($id)
    {
        $token = uniqid(base64_encode(Str::random(10)));
        $urlSafe = $this->makeUrlSafe($token);
        $user = User::where('id',$id)->first();
        $user->password = ''; // no password yet
        $user->first_logon = true;
        $user->custom_token = $urlSafe;
        $user->save();
        $encryptedId = $urlSafe;
        $link = config('services.ad_portal_url').'/first-login/' . $encryptedId;
        $name = $user->full_name;
        Mail::to($user->email)->send(new \App\Mail\FirstLoginMail($name,$link));
        return redirect()->route('organisations.view',$user->organisation_id)->with('success',  __('messages.user_password_reset'));
    }
    public function getTaxRegistrations($country_code)
    {
        $taxRegs = \App\Models\TaxRegistration::where('country_code', $country_code)->get();
        return response()->json($taxRegs);
    }
    public function orgRequest(Request $request)
    {
        return view('organisation.orgrequest');
    }
}
