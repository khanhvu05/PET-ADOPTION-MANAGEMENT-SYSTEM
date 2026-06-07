<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống đang bảo trì</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased min-h-screen flex items-center justify-center p-6">
    <div class="max-w-xl w-full text-center">
        <!-- Maintenance Icon -->
        <div class="mb-8 flex justify-center">
            <div class="relative w-32 h-32 flex items-center justify-center bg-teal-100 rounded-full">
                <svg class="w-16 h-16 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                <div class="absolute -bottom-2 -right-2 w-12 h-12 bg-white rounded-full flex items-center justify-center shadow-sm">
                    <svg class="w-6 h-6 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                </div>
            </div>
        </div>

        <h1 class="text-3xl font-extrabold text-slate-900 mb-4 tracking-tight">Hệ Thống Đang Bảo Trì</h1>
        <p class="text-lg text-slate-600 mb-8 leading-relaxed max-w-lg mx-auto">
            Chúng tôi đang tiến hành nâng cấp và bảo trì hệ thống để mang lại trải nghiệm tốt hơn. 
            Vui lòng quay lại sau ít phút nữa! Xin lỗi vì sự bất tiện này.
        </p>

        <div class="inline-flex gap-4">
            <a href="{{ url('/') }}" class="px-6 py-3 rounded-xl bg-slate-900 text-white font-semibold shadow hover:bg-slate-800 transition-colors">
                Thử tải lại trang
            </a>
            <a href="mailto:{{ \App\Models\Setting::where('key', 'site_email')->value('value') ?? 'contact@petadoption.com' }}" class="px-6 py-3 rounded-xl bg-white text-slate-700 font-semibold border border-slate-200 shadow-sm hover:bg-slate-50 transition-colors">
                Liên hệ hỗ trợ
            </a>
        </div>
        
        <div class="mt-12 text-sm text-slate-500">
            &copy; {{ date('Y') }} {{ \App\Models\Setting::where('key', 'site_name')->value('value') ?? 'PetAdoption' }}. All rights reserved.
        </div>
    </div>
</body>
</html>
