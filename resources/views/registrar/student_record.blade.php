<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Records | Dashboard</title>
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

    {{-- Main Content Wrapper --}}
    <main class="main-content min-h-screen transition-all duration-300">
        <div class="p-8">
            {{-- Page Header --}}
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Student Records</h1>
                    <p class="text-sm text-gray-500">Manage and view all enrolled students in the system</p>
                </div>
                <button class="bg-indigo-600 text-white px-5 py-2.5 rounded-xl text-sm font-semibold hover:bg-indigo-700 transition shadow-lg shadow-indigo-100 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Add New Record
                </button>
            </div>

            {{-- Filter Bar --}}
            <div class="bg-white p-4 rounded-t-2xl border border-gray-100 flex flex-col md:flex-row gap-4 items-center justify-between">
                <div class="relative w-full md:w-96">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </span>
                    <input type="text" placeholder="Search by name, ID, or course..." class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border-none rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 transition-all outline-none">
                </div>
                
                <div class="flex gap-3 w-full md:w-auto">
                    <select class="bg-gray-50 border-none rounded-xl text-sm px-4 py-2.5 focus:ring-2 focus:ring-indigo-500 outline-none cursor-pointer">
                        <option>All Year Levels</option>
                        <option>Grade 11</option>
                        <option>Grade 12</option>
                        <option>1st Year College</option>
                    </select>
                </div>
            </div>

            {{-- Table Container --}}
            <div class="bg-white border border-gray-100 rounded-b-2xl overflow-hidden shadow-sm">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50/50 border-b border-gray-100">
                                <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Student ID</th>
                                <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Full Name</th>
                                <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Course / Strand</th>
                                <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            {{-- Row Example --}}
                            <tr class="hover:bg-indigo-50/30 transition-colors group">
                                <td class="px-6 py-4">
                                    <span class="text-sm font-bold text-indigo-600 tracking-tight">2024-0012</span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-indigo-100 flex items-center justify-center text-[10px] font-bold text-indigo-700">TR</div>
                                        <span class="text-sm font-semibold text-gray-700">Teodoro Repizo</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500 font-medium">BS Information Technology</td>
                                <td class="px-6 py-4">
                                    <span class="px-2.5 py-1 bg-green-50 text-green-600 text-[10px] font-bold rounded-full border border-green-100 uppercase tracking-wider">Enrolled</span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <button onclick="viewStudentRecord('Teodoro Repizo', '2024-0012', 'BSIT', 'Enrolled')" class="p-2 text-gray-400 hover:text-indigo-600 hover:bg-white rounded-lg transition shadow-none hover:shadow-sm">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                {{-- Pagination Footer --}}
                <div class="px-6 py-4 border-t border-gray-50 flex justify-between items-center bg-gray-50/30">
                    <span class="text-xs text-gray-500 font-medium">Showing 1 entries</span>
                    <div class="flex gap-2">
                        <button class="px-4 py-2 text-xs font-bold text-gray-400 bg-white border border-gray-200 rounded-xl cursor-not-allowed">Prev</button>
                        <button class="px-4 py-2 text-xs font-bold text-indigo-600 bg-white border border-indigo-100 rounded-xl hover:bg-indigo-50 transition">Next</button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    {{-- Record Detail Modal --}}
    <div id="recordModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-slate-900/40 backdrop-blur-sm transition-opacity">
        <div class="bg-white w-full max-w-md rounded-2xl shadow-2xl transform transition-all scale-95 opacity-0 duration-300" id="modalContainer">
            <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                <h2 class="text-lg font-bold text-gray-800">Student Profile</h2>
                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600 text-2xl">&times;</button>
            </div>
            <div class="p-8 text-center">
                <div class="w-20 h-20 bg-indigo-100 rounded-full flex items-center justify-center mx-auto mb-4 text-xl font-bold text-indigo-600" id="profileInitial"></div>
                <h3 class="text-xl font-bold text-gray-900" id="modalName"></h3>
                <p class="text-sm text-gray-500 mb-6" id="modalID"></p>
                
                <div class="grid grid-cols-2 gap-4 text-left border-t border-gray-50 pt-6">
                    <div>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Course</p>
                        <p id="modalCourse" class="text-sm font-semibold text-gray-700"></p>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Status</p>
                        <p id="modalStatus" class="text-sm font-semibold text-green-600"></p>
                    </div>
                </div>
            </div>
            <div class="p-6 bg-gray-50 rounded-b-2xl flex flex-col gap-2">
                <button class="w-full py-2.5 bg-indigo-600 text-white text-sm font-bold rounded-xl hover:bg-indigo-700 transition">View Full Academic Records</button>
                <button onclick="closeModal()" class="w-full py-2.5 text-sm font-bold text-gray-500 hover:bg-gray-200 rounded-xl transition">Close</button>
            </div>
        </div>
    </div>

    <script>
        function viewStudentRecord(name, id, course, status) {
            const modal = document.getElementById('recordModal');
            const container = document.getElementById('modalContainer');

            document.getElementById('modalName').innerText = name;
            document.getElementById('modalID').innerText = "ID: " + id;
            document.getElementById('modalCourse').innerText = course;
            document.getElementById('modalStatus').innerText = status;
            document.getElementById('profileInitial').innerText = name.split(' ').map(n => n[0]).join('');

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