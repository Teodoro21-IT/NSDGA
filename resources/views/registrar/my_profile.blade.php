<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile | NSDGA</title>
    @vite(['resources/css/app.css'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-[#F3F4F6] min-h-screen text-slate-800 flex overflow-x-hidden">

    {{-- Fixed Sidebar  --}}
    @include('components.registrar.registrar-sidebar')

  
    <div class="flex-1 flex flex-col min-w-0 ml-[260px]">
        
        {{-- Fixed Navbar --}}
        @include('components.registrar.registrar-navbar')

        <main class="min-h-screen pt-24 pb-12 px-8">
            <div class="max-w-6xl mx-auto">
                
                {{-- Profile Header Card --}}
                <div class="bg-white rounded-2xl shadow-sm p-8 mb-8 flex flex-col md:flex-row items-center gap-8 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-maroon-50 rounded-full -mr-16 -mt-16 opacity-50"></div>
                    
                    <div class="relative flex-shrink-0">
                        <img src="{{ asset('images/nailong.png') }}" alt="Avatar" 
                             class="h-32 w-32 rounded-2xl object-cover shadow-lg border-4 border-white ring-1 ring-gray-100">
                    </div>
                    
                    <div class="text-center md:text-left min-w-0 flex-1">
                        {{-- 'truncate' prevents the encrypted string from breaking the layout --}}
                        <h1 class="text-4xl font-black text-slate-800 tracking-tight mb-1 truncate">
                            {{ Auth::user()->full_name }}
                        </h1>
                        <div class="flex flex-wrap items-center justify-center md:justify-start gap-3 text-gray-500">
                            <span class="flex items-center gap-1.5 font-bold text-maroon-800 uppercase text-xs tracking-widest">
                                <i class="fas fa-briefcase"></i> Registrar
                            </span>
                            <span class="text-gray-300">|</span>
                            <span class="text-sm font-medium tracking-tight uppercase">
                                EMPLOYEE ID NO. {{ Auth::user()->user }}            
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Information Grid --}}
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                    {{-- Personal Information --}}
                    <div class="bg-white rounded-2xl border border-gray-100 p-8 shadow-sm">
                        <div class="flex items-center gap-3 mb-8 pb-3 border-b border-dashed border-gray-100">
                            <div class="p-2 bg-maroon-50 text-maroon-800 rounded-lg">
                                <i class="fas fa-user text-sm"></i>
                            </div>
                            <h2 class="font-bold uppercase text-xs tracking-[0.2em] text-slate-600">Personal Information</h2>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-y-8">
                            <div class="min-w-0">
                                <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1.5">Full Name</label>
                                <p class="text-sm font-bold text-slate-800 truncate">{{ Auth::user()->full_name }}</p>
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1.5">Gender</label>
                                <p class="text-sm font-bold text-slate-800">Male add database</p>
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1.5">Birthdate</label>
                                <p class="text-sm font-bold text-slate-800">April 16, 2004 add database</p>
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1.5">Nationality</label>
                                <p class="text-sm font-bold text-slate-800">Filipino add database</p>
                            </div>
                        </div>
                    </div>

                    {{-- Professional Details --}}
                    <div class="bg-white rounded-2xl border border-gray-100 p-8 shadow-sm">
                        <div class="flex items-center gap-3 mb-8 pb-3 border-b border-dashed border-gray-100">
                            <div class="p-2 bg-maroon-50 text-maroon-800 rounded-lg">
                                <i class="fas fa-id-card text-sm"></i>
                            </div>
                            <h2 class="font-bold uppercase text-xs tracking-[0.2em] text-slate-600">Professional Details</h2>
                        </div>
                        
                        <div class="space-y-8">
                            <div>
                                <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1.5">Department</label>
                                <p class="text-sm font-bold text-slate-800 uppercase tracking-tight">Office of the Registrar</p>
                            </div>
                            <div class="grid grid-cols-2">
                                <div>
                                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1.5">Date Hired</label>
                                    <p class="text-sm font-bold text-slate-800">Add Database</p>
                                </div>
                                <div>
                                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1.5">Employment Status</label>
                                    <div class="flex items-center gap-2 mt-1">
                                        <span class="h-2 w-2 rounded-full bg-blue-600"></span>
                                        <p class="text-sm font-bold text-slate-800">Add database</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Contact Information --}}
                <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-50">
                    <div class="flex items-center justify-between mb-10">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-maroon-50 text-maroon-800 rounded-lg">
                                <i class="fas fa-envelope-open-text text-sm"></i>
                            </div>
                            <h2 class="font-bold uppercase text-xs tracking-[0.2em] text-slate-600">Contact Information</h2>
                        </div>
                        <button class="bg-[#800000] hover:bg-[#600000] text-white px-10 py-2.5 rounded-xl text-xs font-black tracking-widest transition shadow-lg shadow-maroon-100">
                            SAVE CHANGES
                        </button>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Email Address</label>
                            <input type="email" value="{{ Auth::user()->email }}" 
                                   class="w-full bg-gray-50 border-none rounded-xl p-4 text-sm font-bold text-slate-700 truncate" readonly>
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Phone Number</label>
                            <input type="text" value="{{ Auth::user()->phone_number }}" 
                                   class="w-full bg-gray-50 border-none rounded-xl p-4 text-sm font-bold text-slate-700 truncate" readonly>
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Home Address</label>
                            <input type="text" value="Mag add ako ng home address dito sa database" 
                                   class="w-full bg-gray-50 border-none rounded-xl p-4 text-sm font-bold text-slate-700" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>