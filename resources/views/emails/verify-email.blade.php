<!DOCTYPE html>
<html>

<head>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="text/html; charset=UTF-8" http-equiv="Content-Type">
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            background-color: #030303;
            margin: 0;
            padding: 0;
            -webkit-text-size-adjust: none;
            text-size-adjust: none;
        }

        .wrapper {
            background-color: #030303;
            width: 100%;
            padding: 40px 0;
        }

        .container {
            max-width: 500px;
            margin: 0 auto;
            background-color: #0A0A0A;
            border: 1px solid #1f2937;
            border-radius: 16px;
            overflow: hidden;
        }

        .header {
            padding: 30px 40px;
            text-align: center;
            border-bottom: 1px solid #1f2937;
        }

        .content {
            padding: 40px;
            color: #d1d5db;
            line-height: 1.6;
            font-size: 15px;
        }

        h1 {
            color: #ffffff;
            font-size: 20px;
            font-weight: 600;
            margin-top: 0;
            margin-bottom: 20px;
        }

        .button-container {
            text-align: center;
            margin: 35px 0;
        }

        .button {
            background-color: #0d9488;
            color: #ffffff;
            text-decoration: none;
            padding: 14px 28px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 15px;
            display: inline-block;
        }

        .footer {
            padding: 20px 40px 30px;
            text-align: center;
            color: #6b7280;
            font-size: 12px;
        }

        .warning-box {
            background-color: #111111;
            border-left: 3px solid #0d9488;
            padding: 15px;
            margin-top: 30px;
            border-radius: 0 8px 8px 0;
            font-size: 13px;
            color: #9ca3af;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <table cellpadding="0" cellspacing="0" class="container" width="100%">
            <tr>
                <td class="header">
                    <h2 style="color: #2dd4bf; margin: 0; letter-spacing: 1px;">SIGNET</h2>
                </td>
            </tr>
            <tr>
                <td class="content">
                    <h1>Verify Your Email Address</h1>
                    <p>Welcome to Signet, <strong>{{ $user->name ?? "Developer" }}</strong>!</p>
                    <p>Your workspace has been provisioned. To ensure the security of your account and activate your Cloud KMS, please verify your email address by clicking the button below.</p>

                    <div class="button-container">
                        <a class="button" href="{{ $url }}">Initialize Console</a>
                    </div>

                    <div class="warning-box">
                        <strong>Security Notice:</strong> If you did not create an account, no further action is required.
                    </div>
                </td>
            </tr>
            <tr>
                <td class="footer">
                    &copy; {{ date("Y") }} Signet. All rights reserved.<br>
                    Signet: Zero-Trust License & Key Management Platform engineered by <a href="https://trezanix.com" target="_blank">Trezanix</a>.<br>

                </td>
            </tr>
        </table>
    </div>
</body>

</html>
