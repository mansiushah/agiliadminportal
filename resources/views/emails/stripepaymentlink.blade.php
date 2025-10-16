<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Stripe Payment link</title>
    <style>
        .social-icons {
            justify-content: center;
            align-items: center;
            padding: 0px;
        }
        .social-icons a {
            margin: 15px 5px;
            width: 36px;
        }
    </style>
</head>
<body style="font-family: Inter, sans-serif; margin: 0; padding: 0;">
    <div style="max-width: 600px; margin: 0 auto; padding: 0; border: 1px solid #ddd; border-radius: 5px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); overflow: hidden;">
        <div style="background-color: #180054; padding: 40px; text-align: center;">
            <img src="{{ url('public/assets/emailtemplateimg/Logo.png') }}" alt="Agilis Logo" style="max-width: 100%;">
        </div>
        <div style="padding: 20px;">
            <h2 style="color: #333;font-size: 24px;font-weight: 600;">Hi mansi,</h2>
            <p style="color: #555;font-size: 14px;font-weight: bold;">Thank you for creating your offer: Summer Yoga Offer:</p>
            <p style="color: #555;font-size: 14px;font-weight: ">To activate your offer, please complete the payment using the link below:</p>
            <button>Complete Your Payment</button>
            <p style="color: #555;font-size: 14px;font-weight: ">This secure payment link will take you directly to Stripe’s checkout screen.</p>
            <p style="color: #555;font-size: 14px;font-weight: ">Once your payment is successful, you will be redirected to a confirmation page.</p>
            <p style="color: #555;font-size: 14px;">If you didn’t create this offer, please ignore this email.</p>
            <br/>
            <p style="color: #555;font-size: 14px;">Best regards,</p>
            <p style="color: #555;font-size: 14px;font-weight: bold;color:#180054;">Agilis team</p>
        </div>
        <div style="padding: 0; text-align: center; background-color: #f8f8f8; margin: 20px;">
        <table width="100%"
               style="background-image: url('{{ asset('public/assets/emailtemplateimg/background.jpg') }}');
                      background-repeat: no-repeat;
                      background-size: 100% 100%;">
                <tr>
                    <td style="height: 166px; padding: 0px;">
                        <div style="width: 40%; float:left;text-align: left;padding: 20px 0 0 20px;">
                        <p style="font-family: Inter, sans-serif; font-size: 16px; font-weight: 700; text-align: left; padding: 0 0 10px 0;">Available on:</p>
                        <a href="https://www.apple.com/app-store/" target="_blank">
                            <img src="{{ url('public\assets\emailtemplateimg\appstore.png') }}" alt="App Store" style="margin: 0;">
                        </a>
                        <a href="https://play.google.com/store" target="_blank">
                        <img src="{{ url('public\assets\emailtemplateimg\playstore.png') }}" alt="Google Play" style="margin: 10px 0 0 0;">
                        </a>
                        </div>
                        <div style="float:right;text-align: right; margin: 30px 20px 0;padding: 0;line-height: 0;">
                            <img src="{{ url('public\assets\emailtemplateimg\device.png') }}" alt="Device" style="margin: 0;">
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <div class="social-icons" style="text-align: center;">
            <a href="https://www.facebook.com/" target="_blank"><img src="{{ url('public\assets\emailtemplateimg\fb.png') }}" style="width: 36px;"></a>
            <a href="https://in.linkedin.com/" target="_blank"><img src="{{ url('public\assets\emailtemplateimg\linkedin.png') }}" style="width: 36px;"></a>
            <a href="https://www.instagram.com/" target="_blank"><img src="{{ url('public\assets\emailtemplateimg\Insta.png') }}" style="width: 36px;"></a>
            <a href="https://www.twitter.com/" target="_blank"><img src="{{ url('public\assets\emailtemplateimg\Twitter.png') }}" style="width: 36px;"></a>
            <a href="https://www.tiktok.com/" target="_blank"><img src="{{ url('public\assets\emailtemplateimg\Tiktok.png')}}" style="width: 36px;"></a>
        </div>
        <div style="padding: 10px;">
            <p style="color: #aaa; font-size: 12px; text-align: center; padding-top: 0; margin-top: 0;">© 2025 Agilis Dating Ltd. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
