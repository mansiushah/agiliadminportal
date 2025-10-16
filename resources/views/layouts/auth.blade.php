<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
    <link rel="shortcut icon" href="{{ url('public/assets/img/favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ url('public/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ url('public/assets/css/responsive.css') }}">

    <body class="login_body">
        <div class="login_top_bx position-relative">
            <div class="pb-2">
                <img src="{{ url('public/assets/img/Logo.png') }}" alt="logo" class="img-fluid">
            </div>
        </div>
        <div class="login_wrapper position-relative">
            @yield('content')
        </div>

    </body>
<script src="{{ url('public/assets/js/jquery.js') }}"></script>
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css'>
<script src='https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js'></script>
<script src="{{ url('public/assets/js/custom.js') }}"></script>
<script>
    const inputs = document.querySelectorAll(".otp-input");
    const otpHidden = document.getElementById("otp");
    const otpForm = document.getElementById("otpForm");

    inputs.forEach((input, index) => {
        // auto move to next
        input.addEventListener("input", (e) => {
            if (e.target.value.length === 1 && index < inputs.length - 1) {
                inputs[index + 1].focus();
            }
        });

        // backspace to previous
        input.addEventListener("keydown", (e) => {
            if (e.key === "Backspace" && !input.value && index > 0) {
                inputs[index - 1].focus();
            }
        });
    });

    // before submit, combine into hidden field
    otpForm.addEventListener("submit", () => {
        let otpValue = "";
        inputs.forEach(input => otpValue += input.value);
        otpHidden.value = otpValue;
    });
</script>
</html>
