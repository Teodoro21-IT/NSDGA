<!DOCTYPE html>
<html>
<head>
    <style>
        .container {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            max-width: 500px;
            margin: 20px auto;
            padding: 30px;
            background-color: #1e293b; /* Modern Dark Slate */
            border-radius: 15px;
            text-align: center;
            color: #ffffff;
        }
        .otp-code {
            font-size: 40px;
            font-weight: bold;
            letter-spacing: 10px;
            color: #3b82f6; /* Professional Blue */
            margin: 20px 0;
            padding: 10px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 8px;
        }
        .footer {
            font-size: 12px;
            color: #94a3b8;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Security Verification</h2>
        <p>Hello! Use the code below to log in to the <strong>NSDGA System</strong>.</p>
        <div class="otp-code">{{ $otp }}</div>
        <p>This code is valid for 10 minutes.</p>
        <div class="footer">
            © 2026 Nuestra Señora de Guia Academy. All rights reserved.
        </div>
    </div>
</body>
</html>