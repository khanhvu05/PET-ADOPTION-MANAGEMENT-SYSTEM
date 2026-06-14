<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="color-scheme" content="light">
    <meta name="supported-color-schemes" content="light">
    <title>{{ $subject ?? 'Thông báo từ PetJam' }}</title>
    <style>
        /* Base typography & reset */
        :root {
            color-scheme: light;
            supported-color-schemes: light;
        }
        body {
            font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f7fb !important;
            margin: 0;
            padding: 0;
            color: #334155 !important;
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
        }
        
        .wrapper {
            width: 100%;
            background-color: #f4f7fb;
            padding: 40px 0;
        }

        .email-container {
            max-width: 500px;
            margin: 0 auto;
            background-color: #ffffff !important;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.01);
            position: relative;
        }

        /* Header */
        .header {
            padding: 30px 30px 10px 30px;
            text-align: left;
            display: flex;
            align-items: center;
        }
        .header-logo {
            display: inline-block;
            vertical-align: middle;
            color: #ea580c; /* Orange 600 */
            font-size: 24px;
            text-decoration: none;
            font-weight: 900;
            letter-spacing: -0.5px;
        }
        .header-subtitle {
            display: block;
            font-size: 8px;
            text-transform: uppercase;
            color: #64748b;
            letter-spacing: 1px;
            font-weight: 700;
            margin-top: 2px;
        }
        .header-paw {
            font-size: 28px;
            margin-right: 8px;
            vertical-align: middle;
        }

        /* Content Area */
        .body-content {
            padding: 20px 30px 40px 30px;
        }
        
        .body-content h1, .body-content h2, .body-content h3 {
            color: #0f172a !important;
            margin-top: 0;
        }

        /* Footer */
        .footer-wrapper {
            background-color: #e0f2fe; /* Light blue */
            position: relative;
            padding: 30px 30px 40px 30px;
            text-align: center;
            border-top: 1px dashed #bae6fd;
        }
        
        .cloud-svg {
            position: absolute;
            top: -25px;
            left: 0;
            width: 100%;
            height: auto;
            z-index: 1;
        }

        .footer-content {
            position: relative;
            z-index: 2;
        }

        .footer-dogs {
            font-size: 32px;
            margin-bottom: 10px;
        }

        .thank-you-badge {
            display: inline-block;
            background: rgba(255, 255, 255, 0.8);
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            color: #0369a1; /* Sky 700 */
            margin-bottom: 15px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.02);
        }

        .footer-text {
            color: #475569;
            font-size: 11px;
            font-weight: 500;
            margin: 0;
        }
        
        .footer-social {
            margin-top: 15px;
            font-size: 16px;
            color: #64748b;
        }
        .footer-social span { margin: 0 5px; }

        .system-note {
            text-align: center;
            font-size: 11px;
            color: #94a3b8;
            margin-top: 20px;
        }

        /* Components */
        .pet-card {
            display: flex;
            align-items: center;
            background-color: #ffffff !important;
            border: 1px solid #f1f5f9;
            border-radius: 16px;
            padding: 15px;
            margin-bottom: 25px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }
        .pet-card-large {
            display: block;
            background-color: #ffffff !important;
            border: 1px solid #f1f5f9;
            border-radius: 16px;
            overflow: hidden;
            margin-bottom: 25px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }
        .pet-avatar {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 15px;
            border: 2px solid #f8fafc;
        }
        .pet-photo {
            width: 100%;
            height: 220px;
            object-fit: cover;
            display: block;
        }
        .pet-info h3 { margin: 0 0 5px 0; color: #0f172a; font-size: 18px; }
        .pet-info p { margin: 0; color: #64748b; font-size: 13px; }

        .info-list { margin-bottom: 25px; }
        .info-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 12px;
            font-size: 14px;
        }
        .info-icon { margin-right: 10px; font-size: 16px; color: #94a3b8; width: 20px; text-align: center; }
        .info-text strong { color: #334155; display: block; margin-bottom: 2px; }
        .info-text { color: #64748b; }

        .alert-box {
            background-color: #fffbeb;
            border: 1px solid #fde68a;
            border-radius: 12px;
            padding: 15px;
            margin-bottom: 25px;
            font-size: 13px;
            color: #b45309;
            display: flex;
            align-items: flex-start;
        }
        .alert-box.danger {
            background-color: #fef2f2;
            border-color: #fecaca;
            color: #b91c1c;
        }
        .alert-box.success {
            background-color: #f0fdf4;
            border-color: #bbf7d0;
            color: #15803d;
        }
        .alert-icon { font-size: 18px; margin-right: 10px; }

        .btn {
            display: block;
            text-align: center;
            padding: 14px 20px;
            border-radius: 12px;
            font-weight: 700;
            text-decoration: none;
            font-size: 15px;
            margin-bottom: 15px;
            transition: all 0.2s;
        }
        .btn-primary {
            background-color: #ea580c; /* Orange 600 */
            color: #ffffff !important;
            box-shadow: 0 4px 6px -1px rgba(234, 88, 12, 0.2);
        }
        .btn-outline {
            background-color: #ffffff;
            color: #475569 !important;
            border: 1px solid #cbd5e1;
        }

        .contact-info {
            border-top: 1px solid #f1f5f9;
            padding-top: 20px;
            margin-top: 30px;
            font-size: 12px;
            color: #64748b;
        }
        .contact-row { display: flex; align-items: center; margin-bottom: 8px; }
        .contact-row span { margin-right: 8px; }

        /* Typography Utilities */
        .text-center { text-align: center; }
        .text-left { text-align: left; }
        .font-bold { font-weight: 700; }
        .text-orange { color: #ea580c; }
        .text-slate { color: #475569; }
        .title-icon { font-size: 28px; margin-bottom: 10px; display: block; text-align: center; }
        .main-title { font-size: 24px; text-align: center; color: #0f172a; margin-bottom: 30px; line-height: 1.3; }
        
        /* Mobile */
        @media only screen and (max-width: 500px) {
            .wrapper { padding: 10px; }
            .email-container { border-radius: 12px; }
            .header { padding: 20px 20px 10px 20px; }
            .body-content { padding: 15px 20px 30px 20px; }
            .footer-wrapper { padding: 20px 20px 30px 20px; }
        }
    </style>
</head>
<body>
    <div class="wrapper" style="background-color: #f4f7fb;">
        <div class="email-container" style="background-color: #ffffff;">
            
            <!-- Header -->
            <div class="header">
                <div>
                    <a href="#" class="header-logo">
                        <span class="header-paw">🐾</span>PETJAM
                        <span class="header-subtitle">Animal Adoption & Rescue</span>
                    </a>
                </div>
                <div style="margin-left: auto; color: #cbd5e1; font-size: 24px;">🐾</div>
            </div>

            <!-- Body -->
            <div class="body-content" style="background-color: #ffffff;">
                @if(isset($content))
                    {!! $content !!}
                @else
                    @yield('content')
                @endif
            </div>

            <!-- Footer with Clouds & Dogs -->
            <div class="footer-wrapper">
                <!-- SVG Clouds divider -->
                <svg class="cloud-svg" viewBox="0 0 500 50" preserveAspectRatio="none">
                    <path d="M0,50 L0,25 C15,25 25,10 40,10 C55,10 65,25 80,25 C95,25 105,5 120,5 C135,5 145,25 160,25 C175,25 185,15 200,15 C215,15 225,25 240,25 C255,25 265,10 280,10 C295,10 305,25 320,25 C335,25 345,5 360,5 C375,5 385,25 400,25 C415,25 425,15 440,15 C455,15 465,25 480,25 C495,25 500,20 500,20 L500,50 Z" fill="#e0f2fe"></path>
                </svg>
                
                <div class="footer-content">
                    <div class="footer-dogs">
                        🐕 🐈
                    </div>
                    <div class="thank-you-badge">
                        Cảm ơn bạn đã đồng hành cùng PETJAM!
                    </div>
                    <p class="footer-text">
                        Trân trọng,<br>
                        <strong>Đội ngũ PETJAM</strong>
                    </p>
                    <div class="footer-social">
                        <span>📘</span>
                        <span>📸</span>
                        <span>🌐</span>
                    </div>
                </div>
            </div>
        </div>
        
        <p class="system-note">
            * Đây là email tự động từ hệ thống PETJAM, vui lòng không trả lời email này.
        </p>
    </div>
</body>
</html>
