<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Settings & Security | Dashboard</title>
    @vite(['resources/css/app.css'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style> 
        body { font-family: 'Inter', sans-serif; } 
        .strength-dot { transition: all 0.4s ease; }
    </style>
</head>
<body class="bg-[#F8F9FA] min-h-screen flex text-slate-800">

    @include('components.registrar.registrar-sidebar')
    
    <main class="flex-1 flex flex-col min-h-screen ml-[260px]">
        @include('components.registrar.registrar-navbar')

        <div class="p-10 pt-24 w-full">
            <div class="relative z-10 mb-10">
                <h1 class="text-[32px] font-extrabold text-slate-800 tracking-tight">Account Settings & Security</h1>
            </div>

            <div class="flex flex-col lg:flex-row gap-8 items-start">
                <div class="w-full lg:w-[700px] bg-white rounded-2xl p-10 shadow-sm border border-slate-100">
                    <h2 class="text-2xl font-bold text-[#7f0000] mb-10">Change Password</h2>

                    <form method="POST" action="{{ route('registrar.password.update') }}" class="space-y-8">
                        @csrf
                        
                        {{-- Current Password --}}
                        <div>
                            <label class="block text-[11px] font-extrabold text-slate-500 uppercase tracking-wider mb-2">Current Password</label>
                            <div class="relative">
                                <input type="password" name="current_password" 
                                    class="w-full bg-[#fcfcfc] px-4 py-4 rounded-lg border @error('current_password') border-red-300 @else border-slate-200 @enderror outline-none transition-all focus:border-slate-400">
                            </div>
                            @error('current_password')
                                <p class="text-red-500 text-[12px] mt-2 font-medium italic">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- New Password --}}
                        <div>
                            <label class="block text-[11px] font-extrabold text-slate-500 uppercase tracking-wider mb-2">New Password</label>
                            <div class="relative mb-3">
                                <input type="password" name="password" id="password-input" placeholder="••••••••••••"
                                    class="w-full bg-[#fcfcfc] px-4 py-4 rounded-lg border-2 border-slate-200 outline-none transition-all focus:border-slate-400">
                            </div>

                            {{-- Segmented Strength Meter (Clean & Subtle) --}}
                            <div class="flex items-center gap-4 bg-slate-50 p-4 rounded-xl border border-slate-100">
                                <div class="flex gap-1.5">
                                    <div id="dot-1" class="strength-dot h-1.5 w-8 rounded-full bg-slate-200"></div>
                                    <div id="dot-2" class="strength-dot h-1.5 w-8 rounded-full bg-slate-200"></div>
                                    <div id="dot-3" class="strength-dot h-1.5 w-8 rounded-full bg-slate-200"></div>
                                    <div id="dot-4" class="strength-dot h-1.5 w-8 rounded-full bg-slate-200"></div>
                                </div>
                                <span id="strength-label" class="text-[11px] font-bold uppercase tracking-widest text-slate-400">Security: Not Set</span>
                            </div>

                            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-3">
                                <div data-req="length" class="flex items-center gap-2 text-slate-400 transition-all">
                                    <div class="check-circle w-4 h-4 border-2 border-slate-200 rounded-full flex items-center justify-center text-[10px]">✓</div>
                                    <span class="text-[12px] font-medium">12+ Characters</span>
                                </div>
                                <div data-req="case" class="flex items-center gap-2 text-slate-400 transition-all">
                                    <div class="check-circle w-4 h-4 border-2 border-slate-200 rounded-full flex items-center justify-center text-[10px]">✓</div>
                                    <span class="text-[12px] font-medium">Uppercase & Lowercase</span>
                                </div>
                                <div data-req="number" class="flex items-center gap-2 text-slate-400 transition-all">
                                    <div class="check-circle w-4 h-4 border-2 border-slate-200 rounded-full flex items-center justify-center text-[10px]">✓</div>
                                    <span class="text-[12px] font-medium">At least one number</span>
                                </div>
                                <div data-req="special" class="flex items-center gap-2 text-slate-400 transition-all">
                                    <div class="check-circle w-4 h-4 border-2 border-slate-200 rounded-full flex items-center justify-center text-[10px]">✓</div>
                                    <span class="text-[12px] font-medium">Special Character</span>
                                </div>
                            </div>
                        </div>

                        {{-- Confirm Password --}}
                        <div>
                            <label class="block text-[11px] font-extrabold text-slate-500 uppercase tracking-wider mb-2">Confirm New Password</label>
                            <input type="password" name="password_confirmation" 
                                class="w-full bg-[#fcfcfc] px-4 py-4 rounded-lg border border-slate-200 outline-none h-[58px] focus:border-slate-400 transition-all">
                        </div>

                        <div class="flex justify-end pt-4">
                            <button type="submit" class="bg-slate-900 hover:bg-black text-white px-10 py-4 rounded-xl font-bold transition shadow-lg active:scale-95 text-sm uppercase tracking-widest">
                                Update Password
                            </button>
                        </div>
                    </form>
                </div>

                {{-- Activity Card --}}
                <div class="w-full lg:w-[320px]">
                    <div class="bg-white rounded-2xl p-7 shadow-sm border border-slate-100">
                        <h3 class="text-[11px] uppercase tracking-widest font-extrabold text-slate-400 mb-6">Security context</h3>
                        <div class="space-y-4">
                            <div class="p-3 bg-blue-50/50 rounded-lg border border-blue-100/50">
                                <p class="text-[11px] text-blue-600 font-bold mb-1 italic">Current Device</p>
                                <p class="text-xs text-slate-600 font-semibold">Windows 11 • Chrome 122</p>
                            </div>
                            <div class="p-3 bg-slate-50 rounded-lg border border-slate-100">
                                <p class="text-[11px] text-slate-500 font-bold mb-1 italic">Reminder  </p>
                                <p class="text-xs text-slate-600 font-semibold">Change Password Every 3 Months</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        document.getElementById('password-input').addEventListener('input', function(e) {
            const val = e.target.value;
            const label = document.getElementById('strength-label');
            
            const checks = {
                length: val.length >= 12,
                case: /[a-z]/.test(val) && /[A-Z]/.test(val),
                number: /[0-9]/.test(val),
                special: /[!@#$%^&*(),.?":{}|<>]/.test(val)
            };

            let score = 0;
            Object.keys(checks).forEach(key => {
                const row = document.querySelector(`[data-req="${key}"]`);
                const circle = row.querySelector('.check-circle');
                if (checks[key]) {
                    score++;
                    row.classList.replace('text-slate-400', 'text-slate-900');
                    circle.classList.replace('border-slate-200', 'border-slate-900');
                    circle.classList.add('bg-slate-900', 'text-white');
                } else {
                    row.classList.replace('text-slate-900', 'text-slate-400');
                    circle.classList.replace('border-slate-900', 'border-slate-200');
                    circle.classList.remove('bg-slate-900', 'text-white');
                }
            });

            // Segmented Bar Logic
            const dots = [document.getElementById('dot-1'), document.getElementById('dot-2'), document.getElementById('dot-3'), document.getElementById('dot-4')];
            const colors = ['#E11D48', '#F59E0B', '#2563EB', '#059669'];
            const labels = ['Weak', 'Fair', 'Good', 'Strong'];

            dots.forEach((dot, index) => {
                if (index < score) {
                    dot.style.backgroundColor = colors[score - 1];
                    dot.style.width = '32px';
                } else {
                    dot.style.backgroundColor = '#E2E8F0';
                }
            });

            if (val.length > 0) {
                label.innerText = `Security: ${labels[score - 1]}`;
                label.style.color = colors[score - 1];
            } else {
                label.innerText = "Security: Not Set";
                label.style.color = '#94A3B8';
            }
        });
    </script>
</body>
</html>