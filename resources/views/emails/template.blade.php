<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $subject }}</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f3f4f6;
            margin: 0;
            padding: 0;
            color: #334155;
            line-height: 1.6;
        }
        .email-container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        .header {
            background: linear-gradient(135deg, #8b5cf6, #6d28d9);
            padding: 30px 20px;
            text-align: center;
        }
        .header h1 {
            color: #ffffff;
            margin: 0;
            font-size: 28px;
            font-weight: 700;
            letter-spacing: 1px;
        }
        .header p {
            color: #ddd6fe;
            margin: 5px 0 0 0;
            font-size: 15px;
        }
        .body-content {
            padding: 30px 40px;
        }
        .body-content h2 {
            color: #1e293b;
            font-size: 20px;
            margin-top: 0;
        }
        .body-content p {
            margin-bottom: 15px;
        }
        .body-content blockquote {
            background-color: #f8fafc;
            border-left: 4px solid #8b5cf6;
            margin: 20px 0;
            padding: 15px 20px;
            border-radius: 0 8px 8px 0;
            color: #475569;
            font-style: italic;
        }
        .footer {
            background-color: #f8fafc;
            padding: 20px;
            text-align: center;
            border-top: 1px solid #e2e8f0;
            color: #64748b;
            font-size: 13px;
        }
        .footer a {
            color: #8b5cf6;
            text-decoration: none;
        }
        .btn {
            display: inline-block;
            background-color: #8b5cf6;
            color: #ffffff;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            margin-top: 15px;
        }
        @media only screen and (max-width: 600px) {
            .email-container {
                margin: 0;
                border-radius: 0;
            }
            .body-content {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="header">
            <h1>🐾 PetJam</h1>
            <p>Kết nối yêu thương - Lan tỏa hạnh phúc</p>
        </div>

        <!-- Body -->
        <div class="body-content">
            {!! $content !!}
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>Email này được gửi tự động từ hệ thống PetJam. Vui lòng không trả lời trực tiếp email này.</p>
            <p>&copy; {{ date('Y') }} PetJam. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
