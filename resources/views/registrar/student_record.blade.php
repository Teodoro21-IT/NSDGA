<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Records | Dashboard</title>
    @vite(['resources/css/app.css'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style> 
        body { font-family: 'Inter', sans-serif; } 
        /* Sync content margin with your sidebar width */
        .main-content { margin-left: 260px; } 
    </style>
</head>
<body class="bg-[#F8F9FA] min-h-screen text-slate-800">

    {{-- The Fixed Sidebar --}}
    @include('components.registrar.registrar-sidebar')

    {{-- Main Content Wrapper --}}
    <main class="main-content min-h-screen transition-all duration-300">

        {{-- Fixed Navbar included inside main content --}}
        @include('components.registrar.registrar-navbar')
        
        {{-- Added padding-top (pt-24) to ensure content starts below fixed navbar --}}
        <div class="p-10 pt-24 space-y-8">
            
            {{-- Page Header --}}
            <div class="flex justify-between items-end">
                <div>
                    <h1 class="text-[32px] font-extrabold text-slate-900 tracking-tight">Student Records</h1>
                    <p class="text-slate-500 font-medium mt-1">Manage and view all enrolled students in the system</p>
                </div>
                <button class="bg-[#4f46e5] text-white px-6 py-3 rounded-xl text-sm font-bold hover:bg-[#4338ca] transition shadow-lg shadow-indigo-100 flex items-center gap-2 active:scale-95">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                    Add New Record
                </button>
            </div>

            {{-- Table & Filter Container --}}
            <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
                
                {{-- Filter Bar --}}
                <div class="p-6 border-b border-slate-50 flex flex-col md:flex-row gap-4 items-center justify-between bg-[#fcfcfc]">
                    <div class="relative w-full md:w-96">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </span>
                        <input type="text" placeholder="Search by name, ID, or course..." class="w-full pl-12 pr-4 py-3 bg-white border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 transition-all outline-none">
                    </div>
                    
                    <div class="flex gap-3 w-full md:w-auto">
                        <select class="bg-white border border-slate-200 rounded-xl text-sm px-6 py-3 focus:ring-2 focus:ring-indigo-500 outline-none cursor-pointer font-semibold text-slate-600">
                            <option>All Year Levels</option>
                            <option>Grade 11</option>
                            <option>Grade 12</option>
                            <option>1st Year College</option>
                        </select>
                    </div>
                </div>

                {{-- Table Body --}}
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-white">
                                <th class="px-8 py-5 text-[11px] font-black text-slate-400 uppercase tracking-[0.15em]">Student ID</th>
                                <th class="px-8 py-5 text-[11px] font-black text-slate-400 uppercase tracking-[0.15em]">Full Name</th>
                                <th class="px-8 py-5 text-[11px] font-black text-slate-400 uppercase tracking-[0.15em]">Course / Strand</th>
                                <th class="px-8 py-5 text-[11px] font-black text-slate-400 uppercase tracking-[0.15em]">Status</th>
                                <th class="px-8 py-5 text-[11px] font-black text-slate-400 uppercase tracking-[0.15em] text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            <tr class="hover:bg-slate-50/80 transition-colors group">
                                <td class="px-8 py-6">
                                    <span class="text-sm font-bold text-indigo-600 tracking-tight">2024-0012</span>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 rounded-full bg-indigo-50 flex items-center justify-center text-xs font-black text-indigo-600 border border-indigo-100">TR</div>
                                        <span class="text-sm font-bold text-slate-700">Teodoro Repizo</span>
                                    </div>
                                </td>
                                <td class="px-8 py-6 text-sm text-slate-500 font-semibold">BS Information Technology</td>
                                <td class="px-8 py-6">
                                    <span class="px-4 py-1.5 bg-green-50 text-green-600 text-[10px] font-black rounded-lg border border-green-100 uppercase tracking-widest">Enrolled</span>
                                </td>
                                <td class="px-8 py-6 text-right">
                                    <button onclick="viewStudentRecord('Teodoro Repizo', '2024-0012', 'BS Information Technology', 'Enrolled')" class="p-2.5 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-xl transition-all">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                {{-- Pagination Footer --}}
                <div class="px-8 py-6 border-t border-slate-50 flex justify-between items-center bg-[#fcfcfc]">
                    <span class="text-xs text-slate-400 font-bold uppercase tracking-wider">Showing 1 entries</span>
                    <div class="flex gap-2">
                        <button class="px-5 py-2 text-[11px] font-black uppercase text-slate-300 bg-white border border-slate-100 rounded-xl cursor-not-allowed">Prev</button>
                        <button class="px-5 py-2 text-[11px] font-black uppercase text-indigo-600 bg-white border border-indigo-100 rounded-xl hover:bg-indigo-50 transition active:scale-95">Next</button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    {{-- Record Detail Modal --}}
    <div id="recordModal" class="fixed inset-0 z-[100] hidden flex items-center justify-center bg-slate-900/40 backdrop-blur-sm transition-opacity duration-300">
        <div class="bg-white w-full max-w-md rounded-[2.5rem] shadow-2xl transform transition-all scale-95 opacity-0 duration-300 overflow-hidden" id="modalContainer">
            <div class="p-8 border-b border-slate-50 flex justify-between items-center">
                <h2 class="text-2xl font-black text-slate-800 tracking-tight">Student Profile</h2>
                <button onclick="closeModal()" class="text-slate-300 hover:text-slate-500 text-3xl leading-none">&times;</button>
            </div>
            
            <div class="p-10 text-center">
                <div class="w-24 h-24 bg-indigo-50 rounded-3xl flex items-center justify-center mx-auto mb-6 text-2xl font-black text-indigo-600 border border-indigo-100" id="profileInitial"></div>
                <h3 class="text-2xl font-black text-slate-900 tracking-tight" id="modalName"></h3>
                <p class="text-sm font-bold text-indigo-600 mt-1" id="modalID"></p>
                
                <div class="grid grid-cols-2 gap-6 text-left border-t border-slate-50 mt-8 pt-8">
                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Course Program</p>
                        <p id="modalCourse" class="text-sm font-bold text-slate-700 mt-1"></p>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Status</p>
                        <p id="modalStatus" class="text-sm font-black text-green-600 mt-1 uppercase tracking-wider"></p>
                    </div>
                </div>
            </div>

            <div class="p-8 bg-slate-50 flex flex-col gap-3">
                <button class="w-full py-4 bg-[#7f0000] text-white text-xs font-black uppercase tracking-widest rounded-2xl hover:bg-[#600000] transition shadow-lg shadow-maroon-100 active:scale-95">View Full Academic Records</button>
                <button onclick="closeModal()" class="w-full py-4 text-xs font-black uppercase tracking-widest text-slate-400 hover:text-slate-600 transition">Close Preview</button>
            </div>
        </div>
    </div>

    <script>
        function viewStudentRecord(name, id, course, status) {
            const modal = document.getElementById('recordModal');
            const container = document.getElementById('modalContainer');

            document.getElementById('modalName').innerText = name;
            document.getElementById('modalID').innerText = "STUDENT ID: " + id;
            document.getElementById('modalCourse').innerText = course;
            document.getElementById('modalStatus').innerText = status;
            
            // Handle multiple names for initials
            const initials = name.split(' ').map(n => n[0]).join('').toUpperCase();
            document.getElementById('profileInitial').innerText = initials;

            modal.classList.remove('hidden');
            setTimeout(() => {
                container.classList.remove('scale-95', 'opacity-0');
                container.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        function closeModal() {
            const modal = document.getElementById('recordModal');
            const container = document.getElementById('modalContainer');
            container.classList.remove('scale-100', 'opacity-100');
            container.classList.add('scale-95', 'opacity-0');
            setTimeout(() => { modal.classList.add('hidden'); }, 300);
        }

        window.onclick = function(event) {
            if (event.target == document.getElementById('recordModal')) closeModal();
        }
    </script>
</body>
</html>