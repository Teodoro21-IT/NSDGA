<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>my_profile | Dashboard</title>
    @vite(['resources/css/app.css'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style> 
        body { font-family: 'Inter', sans-serif; } 
        
        .main-content { margin-left: 260px; } 
    </style>
</head>
<body class="bg-[#F3F4F6] min-h-screen text-slate-800">

    {{-- The Fixed Sidebar --}}
    @include('components.registrar.registrar-sidebar')

  <main class="main-content min-h-screen pb-12">
    {{-- Header --}}
    <div class="bg-white border-b border-gray-200 px-8 py-12 mb-8">
        <div class="max-w-5xl mx-auto flex flex-col md:flex-row items-center gap-8">
            {{-- Profile Picture / Avatar --}}
            <div class="relative group">
                <div class="w-32 h-32 rounded-2xl bg-indigo-600 flex items-center justify-center text-white text-4xl font-bold shadow-xl shadow-indigo-100 ring-4 ring-white">
                    AD
                </div>
                <button class="absolute -bottom-2 -right-2 p-2 bg-white rounded-xl shadow-lg border border-gray-100 text-gray-500 hover:text-indigo-600 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                </button>
            </div>

            <div class="text-center md:text-left space-y-2">
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Registar Dashboard</h1>
                <p class="text-indigo-600 font-medium bg-indigo-50 px-3 py-1 rounded-full inline-block text-sm uppercase tracking-wider">Registrar Office</p>
                <div class="flex items-center justify-center md:justify-start gap-4 text-gray-400 text-sm">
                    <span class="flex items-center gap-1"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg> registrar@nsdga.edu.ph</span>
                    <span class="flex items-center gap-1"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg> Marikina City</span>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-5xl mx-auto px-8 grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        {{-- Left Column: Account Details --}}
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                    <h2 class="font-bold text-gray-800">Personal Information</h2>
                    <button class="text-sm font-bold text-indigo-600 hover:text-indigo-700">Edit Details</button>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">First Name</label>
                        <p class="text-sm font-semibold text-gray-700">Teodoro</p>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Last Name</label>
                        <p class="text-sm font-semibold text-gray-700">Repizo</p>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Official Employee ID</label>
                        <p class="text-sm font-semibold text-gray-700">NSDGA-2026-REG-01</p>
                    </div>
                </div>
            </div>

            {{-- Security Section --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100">
                    <h2 class="font-bold text-gray-800">Security & Password</h2>
                </div>
                <div class="p-6 space-y-4">
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-indigo-100 text-indigo-600 rounded-lg">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-gray-700">Password</p>
                                <p class="text-xs text-gray-500">Last changed 3 months ago</p>
                            </div>
                        </div>
                        <button class="px-4 py-2 bg-white border border-gray-200 rounded-lg text-xs font-bold text-gray-600 hover:bg-gray-50 transition">Update</button>
                    </div>
                    
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-green-100 text-green-600 rounded-lg">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-gray-700">Two-Factor Authentication</p>
                                <p class="text-xs text-green-600 font-medium">Currently Enabled</p>
                            </div>
                        </div>
                        <button class="px-4 py-2 bg-white border border-gray-200 rounded-lg text-xs font-bold text-red-500 hover:bg-red-50 transition">Disable</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Right Column: Activity / Logs --}}
        <div class="space-y-6">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h3 class="font-bold text-gray-800 mb-4">Account Stats</h3>
                <div class="space-y-4">
                    <div class="flex justify-between items-center border-b border-gray-50 pb-2">
                        <span class="text-xs text-gray-500">Member Since</span>
                        <span class="text-xs font-bold text-gray-700">Aug 2024</span>
                    </div>
                    <div class="flex justify-between items-center border-b border-gray-50 pb-2">
                        <span class="text-xs text-gray-500">Records Verified</span>
                        <span class="text-xs font-bold text-gray-700">842</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-xs text-gray-500">Status</span>
                        <span class="text-xs font-bold text-green-600">Active Account</span>
                    </div>
                </div>
            </div>
            
            <button class="w-full py-3 bg-red-50 text-red-600 rounded-2xl text-sm font-bold hover:bg-red-100 transition flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                Logout from System
            </button>
        </div>
    </div>
</main>

</body>
</html>