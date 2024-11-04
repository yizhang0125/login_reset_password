<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset Request</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .header {
            padding: 20px;
            background-color: #333;
            color: #ffffff;
            text-align: center;
        }
        .header h1 {
            font-size: 28px; /* Increased font size for visibility */
            margin: 0;
        }
        .content {
            padding: 30px;
            text-align: center;
        }
        .content h2 {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
        }
        .content p {
            font-size: 16px;
            color: #555;
            line-height: 1.6;
            margin-bottom: 20px;
        }
        .button-container {
            margin-top: 20px;
        }
        a.button {
            padding: 12px 30px;
            background-color: #555;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }
        a.button:hover {
            background-color: #333;
        }
        .footer {
            padding: 20px;
            background-color: #333;
            color: #ddd;
            text-align: center;
            font-size: 13px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h1>Password Reset</h1> <!-- Increased font size for visibility -->
    </div>
    <div class="content">
        <h2>{{ $details['message'] }}</h2>
        <p>Please click the button below to reset your password. If you did not request this, you can safely ignore this email.</p>
        <div class="button-container">
            <a href="{{ $details['link'] }}" class="button">Reset Password</a>
        </div>
    </div>
    <div class="footer">
        &copy; 2023 Your Company. All rights reserved.
    </div>
</div>

</body>
</html>
