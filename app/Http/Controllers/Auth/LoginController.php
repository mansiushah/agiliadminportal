<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Traits\ApiResponser;
use App\Models\Admin;
use App\Services\TwilioService;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
class LoginController extends Controller
{
    use ApiResponser;
    protected $twilio;
    public function __construct(TwilioService $twilio)
    {
        $this->twilio = $twilio;
    }
    public function showLoginForm()
    {
        return view('auth.login');
    }
    public function login(Request $request)
    {
         $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
       if (auth()->guard('admin')->attempt(['email' => $request->input('email'), 'password' => $request->input('password')]))
        {
            $user = auth()->guard('admin')->user();
            return redirect()->route('select-otp-option');
        }
        else
        {
            return back()->with('error','Your Username and Password are wrong.');
        }
    }
    public function selectOtpOption()
    {
        return view('auth.selectOtpOption');
    }
    public function SendEmailOrSms(Request $request)
    {
        $previousUrl = url()->previous();
        // If the previous URL is exactly send-email-or-sms, skip OTP update
        if (strpos($previousUrl, 'send-email-or-sms') === false) {
            $user = auth()->guard('admin')->user();
            $otp = rand(1000, 9999);
            $user->otp = $otp;
            $user->otp_verify = 0;
            $user->otp_expires_at = Carbon::now()->addMinutes(10); // 🔹 expires in 10 mins
            $user->save();
            $verification = $request->type;
            $email = $user->email;
            $mobile = $user->phone_number;
            if ($verification === 'phone') {
                $message = "Please verify your account using the following passcode: {$otp}";
                $this->twilio->sendSms($mobile, $message);
            }
            if ($verification === 'email') {
               Mail::to($user->email)->send(new \App\Mail\Verification('Admin',$otp));
            }
        }
        return view('auth.VerificationCode', [
            'admin' => auth()->guard('admin')->user(),
            'type' => $request->type
        ]);
    }
    public function ResendOTP(Request $request,$type)
    {
        $admin = auth()->guard('admin')->user();
        $verification = $type;
        $otp = rand(1000, 9999);
        $admin->otp = $otp;
        $admin->otp_verify = 0;
        $admin->otp_expires_at = Carbon::now()->addMinutes(10); // 🔹 expires in 10 mins
        $admin->save();
        $email = $admin->email;
        $mobile = $admin->phone_number;
        if ($verification === 'phone') {
            $message = "Please verify your account using the following passcode: {$otp}";
            $this->twilio->sendSms($mobile, $message);
        }
        if ($verification === 'email') {
           Mail::to($email)->send(new \App\Mail\ResetUserPassword('Admin',$otp));
        }
        $request->session()->flash('error', __('messages.code_reset'));
        $request->session()->flash('class', 'red');
         return view('auth.VerificationCode',[
                    'admin' => auth()->guard('admin')->user(),
                    'type'=> $verification]);
    }
    public function validateOTP(Request $request)
    {
        $otp = implode('', [
            $request->digit1, $request->digit2,
            $request->digit3, $request->digit4
        ]);
        $type = $request->type;
        $admin = auth()->guard('admin')->user();
        //print_r($admin);die;
        if($type == 'email')
        {
            $admin = Admin::where('email',$admin->email)->first();
        }
        else
        {
            $admin = Admin::where('phone_number',$admin->phone_number)->first();
        }
        // 🔹 Step 1: Check if OTP exists and not expired
        if (!$admin->otp || !$admin->otp_expires_at) {
            $request->session()->flash('error', 'No OTP found. Please request a new one.');
            $request->session()->flash('class', 'red');
            return back()->with(['admin' => $admin, 'type' => $type]);
        }

        // 🔹 Step 2: Check if expired (after 10 mins)
        if (Carbon::now()->greaterThan(Carbon::parse($admin->otp_expires_at))) {
            $request->session()->flash('error', 'Your OTP has expired. Please request a new one.');
            $request->session()->flash('class', 'red');
            return back()->with(['admin' => $admin, 'type' => $type]);
        }
        if ($admin && $admin->otp == $otp)
        {
            $admin->otp_verify = 1;
            $admin->environment = 1;
            $admin->save();
            return redirect()->route('dashboard');
        }
        else
        {
            $request->session()->flash('error', __('messages.otp_missmatch'));
            $request->session()->flash('class', 'red');
            return back()->with(['admin' => $admin,'type'=> $type]);
        }
    }
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('login');
    }
}
