<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NSDGA | Verification</title>
    @vite(['resources/css/app.css'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .glass { background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-900 via-slate-800 to-blue-900 min-h-screen flex items-center justify-center p-6">
    <div class="glass rounded-3xl shadow-2xl p-8 w-full max-w-[400px]">
        <h2 class="text-2xl font-bold mb-2 text-slate-800">Security Verification</h2>
        <p class="text-slate-500 text-sm mb-6">Enter the 6-digit code sent to your phone.</p>

        @if(session('student_otp_account_id'))
            <div class="mb-6 rounded-lg border border-yellow-200 bg-yellow-50 px-4 py-4 text-sm text-yellow-700">
                It looks like you are in the student login flow. Please use the student OTP page instead.
                <a href="{{ route('student.otp.view') }}" class="font-semibold text-blue-600 hover:text-blue-800">Go to student OTP verification</a>
            </div>
        @endif

        <form action="{{ route('otp.verify') }}" method="POST" class="space-y-6">
            @csrf
            @if($errors->any())
                <div class="p-3 bg-red-50 border-l-4 border-red-500 text-red-700 text-xs font-medium rounded">
                    {{ $errors->first() }}
                </div>
            @endif

            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">OTP Code</label>
                <input type="text" name="otp" maxlength="6" required class="w-full p-4 bg-slate-100 border border-transparent rounded-xl focus:bg-white focus:border-blue-500 outline-none text-center text-2xl tracking-widest font-bold" placeholder="000000">
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white p-4 rounded-xl font-bold hover:bg-blue-700 shadow-lg transition-all active:scale-[0.98]">
                Verify & Login
            </button>
        </form>

        <div class="mt-6 text-center border-t border-slate-100 pt-4">
            <form action="{{ route('otp.resend') }}" method="POST">
                @csrf
                <p class="text-xs text-slate-500 mb-2 font-medium">Didn't receive the code?</p>
                <button type="submit" class="text-blue-600 hover:text-blue-700 font-bold text-sm transition-all active:scale-95">
                    📩 Resend New Code
                </button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
