<!DOCTYPE html>
<html>
<head>
    <style>
        /* Reset some default styles */
        body, p {
            margin: 0;
            padding: 0;
        }
        /* Styles for the email content */
        .email-container {
            max-width: 500px;
            margin: 0 auto;
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            padding: 20px;
        }
        .email-content {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }
        .reset-text {
            color: #333;
            font-size: 14px;
            line-height: 1.5;
            margin-bottom: 20px;
        }
        .button-container {
            text-align: center;
            margin-top: 30px;
        }
        .reset-button {
            display: inline-block;
            background-color: #1e88e5;
            color: #fff!important;
            padding: 12px 24px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            letter-spacing: 0.5px;
            transition: background-color 0.3s ease;
        }
        .reset-button:hover {
            background-color: #1565c0;
            color: #fff!important;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-content">
            <p class="reset-text">Hello {{$emailData['name']}},</p>
            <p class="reset-text">We received a request to reset your password. Click the button below to reset it:</p>
            <div class="button-container">
                <a class="reset-button" href="{{route('resetPassword',[encrypt($emailData['id'])])}}">Reset Password</a>
            </div><br>
            <p class="reset-text">If you didn't request a password reset, please ignore this email.</p>
            <p>Best regards,</p>
            <p>{{ucwords($userProfile['panel_name']) ?? 'Admin Panel'}} Team</p>
        </div>
    </div>
</body>
</html>
