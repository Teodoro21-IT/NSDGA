<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NSDGA | Dashboard</title>
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

    {{-- Main Content Area --}}
    <main class="main-content flex flex-col min-h-screen">
        
        {{-- Fixed Header --}}
        <header class="bg-white/80 backdrop-blur-md border-b border-slate-200 sticky top-0 z-50 p-4 px-8 flex justify-between items-center">
            <div>
                <h2 class="text-sm font-medium text-slate-500">Welcome back,</h2>
                <p class="text-lg font-bold text-slate-900">Registrar Administrator</p>
            </div>
            <div class="flex items-center space-x-4">
                <button class="p-2 text-slate-400 hover:text-indigo-600 transition">
                    <span class="text-xl">🔔</span>
                </button>
                <div class="h-10 w-10 rounded-full bg-gradient-to-tr from-indigo-500 to-purple-500 border-2 border-white shadow-sm"></div>
            </div>
        </header>

        {{-- Dashboard Content --}}
        <div class="p-8 space-y-8">
            
            {{-- Stats Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100 hover:shadow-md transition">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-indigo-50 text-indigo-600 rounded-2xl text-xl">👨‍🎓</div>
                        <span class="text-xs font-bold text-green-500 bg-green-50 px-2 py-1 rounded-lg">+12%</span>
                    </div>
                    <h3 class="text-slate-500 text-sm font-medium">Total Students</h3>
                    <p class="text-2xl font-black text-slate-900">1,284</p>
                </div>

                <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100 hover:shadow-md transition">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-emerald-50 text-emerald-600 rounded-2xl text-xl">📄</div>
                        <span class="text-xs font-bold text-slate-400 bg-slate-50 px-2 py-1 rounded-lg">Steady</span>
                    </div>
                    <h3 class="text-slate-500 text-sm font-medium">Pending Requests</h3>
                    <p class="text-2xl font-black text-slate-900">42</p>
                </div>

                <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100 hover:shadow-md transition">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-amber-50 text-amber-600 rounded-2xl text-xl">📅</div>
                        <span class="text-xs font-bold text-amber-500 bg-amber-50 px-2 py-1 rounded-lg">Today</span>
                    </div>
                    <h3 class="text-slate-500 text-sm font-medium">Scheduled Appointments</h3>
                    <p class="text-2xl font-black text-slate-900">08</p>
                </div>
            </div>

            {{-- Bottom Section --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                {{-- Table --}}
                <div class="lg:col-span-2 bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
                    <div class="p-6 border-b border-slate-50 flex justify-between items-center">
                        <h3 class="font-bold text-slate-800">Recent Enrollment Applications</h3>
                        <button class="text-indigo-600 text-sm font-semibold hover:underline">View All</button>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="bg-slate-50/50 text-slate-400 text-[11px] uppercase tracking-widest">
                                <tr>
                                    <th class="px-6 py-4">Student Name</th>
                                    <th class="px-6 py-4">Program</th>
                                    <th class="px-6 py-4">Status</th>
                                    <th class="px-6 py-4 text-right">Date</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50 text-sm">
                                <tr class="hover:bg-slate-50/50 transition">
                                    <td class="px-6 py-4 font-medium text-slate-700">Julianne Moore</td>
                                    <td class="px-6 py-4 text-slate-500">BS Computer Science</td>
                                    <td class="px-6 py-4"><span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-bold">Pending</span></td>
                                    <td class="px-6 py-4 text-right text-slate-400 text-xs">Apr 12, 2026</td>
                                </tr>
                                <tr class="hover:bg-slate-50/50 transition">
                                    <td class="px-6 py-4 font-medium text-slate-700">Marcus Wright</td>
                                    <td class="px-6 py-4 text-slate-500">AB Communication</td>
                                    <td class="px-6 py-4"><span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-bold">Approved</span></td>
                                    <td class="px-6 py-4 text-right text-slate-400 text-xs">Apr 11, 2026</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Sidebar Actions --}}
                <div class="space-y-6">
                    <div class="bg-indigo-900 rounded-3xl p-6 text-white shadow-xl shadow-indigo-200 relative overflow-hidden">
                        <div class="relative z-10">
                            <h3 class="font-bold text-lg mb-2">System Update</h3>
                            <p class="text-indigo-200 text-xs leading-relaxed mb-4">The student portal will undergo maintenance tonight at 12:00 PM.</p>
                            <button class="bg-white text-indigo-900 px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-wider">Dismiss</button>
                        </div>
                        <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-indigo-500/20 rounded-full"></div>
                    </div>

                    <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100">
                        <h3 class="font-bold text-slate-800 mb-4">Quick Actions</h3>
                        <div class="grid grid-cols-2 gap-3">
                            <button class="flex flex-col items-center justify-center p-4 bg-slate-50 rounded-2xl hover:bg-indigo-50 hover:text-indigo-600 transition group">
                                <span class="text-xl mb-1">➕</span>
                                <span class="text-[10px] font-bold uppercase tracking-tight text-slate-500 group-hover:text-indigo-600">Add Student</span>
                            </button>
                            <button class="flex flex-col items-center justify-center p-4 bg-slate-50 rounded-2xl hover:bg-indigo-50 hover:text-indigo-600 transition group">
                                <span class="text-xl mb-1">🖨️</span>
                                <span class="text-[10px] font-bold uppercase tracking-tight text-slate-500 group-hover:text-indigo-600">Reports</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

</body>
</html>