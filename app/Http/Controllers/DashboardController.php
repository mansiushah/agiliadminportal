<?php

namespace App\Http\Controllers;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\Controller;
use App\Models\{User,Organisation,Category,Offers,Admin};
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;


class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $user = auth()->guard('admin')->user();

            if ($user) { // ✅ Only assign if logged in
                $this->userId      = $user->id;
                $this->role_id     = $user->role_id;
                $this->environment = $user->environment;
            }

            return $next($request);
        });
    }
    public function index()
    {
        $userCount = User::where('environment',$this->environment)->count();
        $categoryCount = Category::count();
        $organisationCount = Organisation::where('environment',$this->environment)->count();
        $offersCount = Offers::where('environment',$this->environment)->count();
        return view('dashboard',compact('userCount','organisationCount','categoryCount','offersCount'));
    }
    public function changePassword()
    {
        return view('auth.changepassword');
    }
    public function UpdatechangePassword(Request $request)
    {
        $admin = auth()->guard('admin')->user();
         // Validate input
        $request->validate([
            'old_password'      => 'required',
            'new_password'      => 'required|min:6',
            'confirm_password'  => 'required|same:new_password',
        ]);
       // Check if old password is correct
        if (!Hash::check($request->old_password, $admin->password)) {
            return back()->with(['error' => 'The current password is incorrect.']);
        }
        // Update the password
        $admin->password = Hash::make($request->new_password);
        $admin->save();

        return back()->with('success', 'Password updated successfully.');
    }
    public function updateEnvironment(Request $request)
    {
        $request->validate([
            'environment' => 'required|in:0,1',
        ]);

        $Admin = Admin::where('id',$this->userId)->first();
        $Admin->environment = $request->environment;
        $Admin->save();

        return response()->json([
            'status' => 'success',
            'mode' => $Admin->environment == 1 ? 'Live' : 'Test'
        ]);
    }
}
