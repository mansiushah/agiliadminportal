@extends('layouts.auth')
@section('title', 'Verification Method')
@section('content')
<div class="login_box">
    <div class="login_top text-center mb-3">
        <h2>Admin Portal</h2>
        <P>Select Verification Method</P>
    </div>
    <div class="login_info">
        <form method="POST" action="{{ route('send-email-or-sms') }}">
            @csrf
            <div class="verification-radio">
                <div class="radio">
                    <input id="radio-1" name="type" type="radio" value="email" checked>
                    <label for="radio-1" class="radio-label">Email verification code</label>
                </div>
                <div class="radio">
                    <input id="radio-2" name="type" type="radio" value="phone" >
                    <label for="radio-2" class="radio-label">SMS verification code</label>
                </div>
            </div>
            <div class="mt-4">
                <button class="btn btn-primary w-100 login_btn">Send OTP</button>
            </div>
        </form>
    </div>
</div>
@endsection
