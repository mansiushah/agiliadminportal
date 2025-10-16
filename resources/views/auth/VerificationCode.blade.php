@extends('layouts.auth')
@section('title', 'Verification Code')
@section('content')
<div class="login_box">
    <div class="login_top text-center mb-3">
                  {{-- Show OTP Mismatch Error --}}
    @if(session('error'))
        <div class="alert alert-danger text-center">
            {{ session('error') }}
        </div>
    @endif
        <h2>Admin Portal</h2>
        <P>Enter Verification Code</P>
        @if($type == 'email' || session('type') == 'email')
        <p>We have sent the verification code to your <br> email <span class="span_clr"> {{ $admin->email }} </span> <br> If  you haven’t received this in your Inbox, we advise checking your Junk/Spam folder too.</p>
        @elseif($type == 'phone' || session('type') == 'phone')
        <p>We have sent the verification code to your phone number: <span class="span_clr">{{ $admin->phone_number }}</span></p>
    @endif
    </div>
    <div class="login_info">
        <form action="{{ route('validate-otp') }}" method="POST" id="otpForm">
            @csrf
            <input type="hidden" name="type" value="{{ old('type', $type ?? session('type')) }}">
            <input type="hidden" name="otp" id="otp"> <!-- final OTP value -->
            <div class="form-group varification_bx d-flex " id="varification_bx">
                <input type="text" class="form-control otp-input" maxlength="1" name="digit1">
                <input type="text" class="form-control otp-input" maxlength="1" name="digit2">
                <input type="text" class="form-control otp-input" maxlength="1" name="digit3">
                <input type="text" class="form-control otp-input" maxlength="1" name="digit4">
            </div>
            <div class="verification_bx_time text-center pb-3">
                <!-- <span>02:39</span>-->
            </div>
            <button type="submit" class="btn btn-primary w-100 login_btn">Verify</button>
            <div class="form-check mt-3 text-center signup_div">
                <span>Didn’t receive the code?
                    <a href="{{ route('resend-otp', ['type' => $type ?? session('type')]) }}">Resend</a>
                </span>
            </div>
        </form>
    </div>
</div>
@endsection
<script>
document.addEventListener('DOMContentLoaded', function () {
    const inputs = document.querySelectorAll('.otp-input');
    const hiddenOtp = document.getElementById('otp');

    // Auto move to next input
    inputs.forEach((input, index) => {
        input.addEventListener('input', (e) => {
            const value = e.target.value.replace(/[^0-9]/g, ''); // allow only digits
            e.target.value = value;
            if (value && index < inputs.length - 1) {
                inputs[index + 1].focus();
            }
            updateHiddenOtp();
        });

        // Handle backspace → move to previous input
        input.addEventListener('keydown', (e) => {
            if (e.key === 'Backspace' && !e.target.value && index > 0) {
                inputs[index - 1].focus();
            }
        });

        // Handle paste (this fixes your issue)
        input.addEventListener('paste', (e) => {
            e.preventDefault();
            const pasteData = (e.clipboardData || window.clipboardData).getData('text').trim();
            if (!/^\d+$/.test(pasteData)) return; // only digits

            // Split pasted text into boxes
            pasteData.split('').forEach((char, i) => {
                if (inputs[i]) inputs[i].value = char;
            });

            updateHiddenOtp();
            inputs[Math.min(pasteData.length - 1, inputs.length - 1)].focus();
        });
    });

    function updateHiddenOtp() {
        const otpValue = Array.from(inputs).map(i => i.value).join('');
        hiddenOtp.value = otpValue;
    }

    // Optional: prevent form submit if OTP incomplete
    document.getElementById('otpForm').addEventListener('submit', function (e) {
        updateHiddenOtp();
        if (hiddenOtp.value.length < inputs.length) {
            e.preventDefault();
            alert('Please enter complete OTP');
        }
    });
});
</script>
