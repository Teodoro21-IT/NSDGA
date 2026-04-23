<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NSDGA | Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #f8fafc; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
    </style>
</head>
<body class="bg-[#f8fafc] antialiased"> 

    <x-admin.sidebar />
    
        <main class="flex-1 flex flex-col min-h-screen ml-[260px]">
       @include('components.admin.admin_navbar')
       
        <div class="p-10 pt-24 w-full">
            {{-- Header Section --}}
            

                <div class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-4">
                    <div>
                        <h1 class="text-[32px] font-extrabold text-[#7f0000] tracking-tight">Enrollment Command Center</h1>
                        <p class="text-slate-500 font-medium">Academic Year 2025-2026 Analytics</p>
                    </div>
                    <div class="flex gap-3">
                        <span class="bg-white px-4 py-2 rounded-xl border border-slate-200 text-xs font-bold text-slate-600 shadow-sm">
                            Last Updated: Just Now
                        </span>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
                    <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm hover:shadow-md transition-all group">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Total Applied (2026)</p>
                                <h3 class="text-3xl font-black text-slate-800 mt-2">1,452</h3>
                            </div>
                            <div class="p-3 bg-blue-50 text-blue-600 rounded-2xl">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                            </div>
                        </div>
                        <div class="mt-4 flex items-center gap-2 text-xs font-bold text-green-500">
                            <span class="bg-green-100 px-2 py-0.5 rounded-lg">+14.2%</span>
                            <span class="text-slate-400 font-medium italic">vs 1,248 (2025)</span>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm hover:shadow-md transition-all group border-l-4 border-l-amber-400">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-[10px] font-bold text-amber-500 uppercase tracking-widest">Pending Forms</p>
                                <h3 class="text-3xl font-black text-slate-800 mt-2">28</h3>
                            </div>
                            <div class="p-3 bg-amber-50 text-amber-600 rounded-2xl">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><path d="M8 13h8"/><path d="M8 17h8"/><path d="M10 9H8"/></svg>
                            </div>
                        </div>
                        <div class="mt-4 text-[10px] font-bold text-slate-400">Forms awaiting initial review</div>
                    </div>

                    <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm hover:shadow-md transition-all group border-l-4 border-l-rose-400">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-[10px] font-bold text-rose-500 uppercase tracking-widest">Incomplete Docs</p>
                                <h3 class="text-3xl font-black text-slate-800 mt-2">64</h3>
                            </div>
                            <div class="p-3 bg-rose-50 text-rose-600 rounded-2xl">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/><path d="M12 11v6"/><path d="M9 14h6"/></svg>
                            </div>
                        </div>
                        <div class="mt-4 text-[10px] font-bold text-slate-400">Missing PSA / Form 137</div>
                    </div>

                    <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Enrollment Yield</p>
                                <h3 class="text-3xl font-black text-[#7f0000] mt-2">88%</h3>
                            </div>
                            <div class="p-3 bg-red-50 text-[#7f0000] rounded-2xl">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21.21 15.89A10 10 0 1 1 8 2.83"/><path d="M22 12A10 10 0 0 0 12 2v10z"/></svg>
                            </div>
                        </div>
                        <div class="mt-4 text-[10px] font-bold text-slate-400 uppercase tracking-tight">Converted from Inquiry</div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <div class="lg:col-span-2 bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
                        <div class="p-8 border-b border-slate-50 flex justify-between items-center bg-white sticky top-0">
                            <h3 class="text-xs font-black text-slate-800 uppercase tracking-widest">Active Enrollment Tracking</h3>
                            <div class="flex gap-2">
                                <select class="text-[10px] font-bold border-none bg-slate-50 rounded-lg px-2 py-1 outline-none">
                                    <option>All Status</option>
                                    <option>Pending Docs</option>
                                    <option>Pending Form</option>
                                </select>
                            </div>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left">
                                <thead class="bg-slate-50/50">
                                    <tr>
                                        <th class="px-8 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Applicant</th>
                                        <th class="px-8 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Application Status</th>
                                        <th class="px-8 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest text-right">Document Status</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-50">
                                    <tr class="hover:bg-slate-50/80 transition-colors cursor-pointer group">
                                        <td class="px-8 py-5">
                                            <div class="flex items-center gap-3">
                                                <div class="w-10 h-10 bg-slate-800 rounded-xl flex items-center justify-center text-white font-black text-xs">AM</div>
                                                <div>
                                                    <span class="text-sm font-bold text-slate-700 uppercase block">Alice Mercado</span>
                                                    <span class="text-[10px] text-slate-400">Grade 11 - HUMSS</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-8 py-5">
                                            <span class="px-3 py-1 text-[10px] font-black uppercase rounded-full bg-green-100 text-green-700 border border-green-200">Approved</span>
                                        </td>
                                        <td class="px-8 py-5 text-right">
                                            <span class="px-3 py-1 text-[10px] font-black uppercase rounded-full bg-rose-100 text-rose-700 border border-rose-200">Missing PSA</span>
                                        </td>
                                    </tr>
                                    <tr class="hover:bg-slate-50/80 transition-colors cursor-pointer group">
                                        <td class="px-8 py-5">
                                            <div class="flex items-center gap-3">
                                                <div class="w-10 h-10 bg-[#7f0000] rounded-xl flex items-center justify-center text-white font-black text-xs">JR</div>
                                                <div>
                                                    <span class="text-sm font-bold text-slate-700 uppercase block">Jun Reyes</span>
                                                    <span class="text-[10px] text-slate-400">Grade 7</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-8 py-5">
                                            <span class="px-3 py-1 text-[10px] font-black uppercase rounded-full bg-amber-100 text-amber-700 border border-amber-200">Pending Review</span>
                                        </td>
                                        <td class="px-8 py-5 text-right">
                                            <span class="px-3 py-1 text-[10px] font-black uppercase rounded-full bg-slate-100 text-slate-500 border border-slate-200">In Review</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="bg-slate-900 p-8 rounded-[2.5rem] text-white shadow-2xl relative overflow-hidden">
                            <h4 class="text-xs font-black mb-6 uppercase tracking-widest text-blue-400">Yearly Comparison</h4>
                            <div class="space-y-4">
                                <div>
                                    <div class="flex justify-between text-[10px] font-bold mb-2 uppercase">
                                        <span>2025 Total</span>
                                        <span>1,248</span>
                                    </div>
                                    <div class="w-full bg-slate-800 h-2 rounded-full overflow-hidden">
                                        <div class="bg-slate-500 h-full w-[70%]"></div>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex justify-between text-[10px] font-bold mb-2 uppercase">
                                        <span>2026 Current</span>
                                        <span class="text-blue-400">1,452</span>
                                    </div>
                                    <div class="w-full bg-slate-800 h-2 rounded-full overflow-hidden">
                                        <div class="bg-blue-500 h-full w-[85%]"></div>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-6 text-[10px] text-slate-400 leading-relaxed italic">
                                * Enrollment has increased by 16% compared to the same period last year.
                            </p>
                        </div>

                        <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm">
                            <h4 class="text-xs font-black mb-4 uppercase tracking-widest text-slate-800">Quick Actions</h4>
                            <div class="grid grid-cols-1 gap-2">
                                <button class="w-full py-3 bg-[#7f0000] text-white text-[10px] font-black uppercase rounded-xl hover:opacity-90 transition-all">Send Reminders to Incomplete</button>
                                <button class="w-full py-3 bg-slate-100 text-slate-600 text-[10px] font-black uppercase rounded-xl hover:bg-slate-200 transition-all">Generate Masterlist</button>
                            </div>
                        </div>
                    </div>
                </div>
            </main> 
        </div>
    </div>
</body>
</html>