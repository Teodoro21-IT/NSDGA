<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application | Dashboard</title>
    @vite(['resources/css/app.css'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style> 
        body { font-family: 'Inter', sans-serif; } 
        /* Ensure main content accounts for the fixed sidebar width */
        .main-content { margin-left: 260px; }
    </style>
</head>

<body class="bg-[#F8F9FA] min-h-screen text-slate-800">

    {{-- The Fixed Sidebar --}}
    @include('components.registrar.registrar-sidebar')

    {{-- Main Content Area --}}
    <main class="main-content min-h-screen flex flex-col transition-all duration-300">
        
        {{-- Fixed Navbar included inside the main content to align with margin --}}
        @include('components.registrar.registrar-navbar')

        {{-- Page Content Container - pt-24 ensures it sits below the fixed navbar --}}
        <div class="p-10 pt-24 space-y-8">
            
            {{-- Header --}}
            <div>
                <h1 class="text-[32px] font-extrabold text-slate-800 tracking-tight">Recent Registrations</h1>
                <p class="text-slate-500 font-medium mt-1">Manage and review student enrollment applications.</p>
            </div>

            {{-- Stats Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 transition-all hover:shadow-md">
                    <p class="text-[11px] font-extrabold text-slate-400 uppercase tracking-widest">Total Students</p>
                    <p class="text-3xl font-black mt-2 text-slate-900">1,284</p>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 transition-all hover:shadow-md">
                    <p class="text-[11px] font-extrabold text-slate-400 uppercase tracking-widest">Pending Requests</p>
                    <p class="text-3xl font-black mt-2 text-orange-600">24</p>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 transition-all hover:shadow-md">
                    <p class="text-[11px] font-extrabold text-slate-400 uppercase tracking-widest">Approved Records</p>
                    <p class="text-3xl font-black mt-2 text-green-600">956</p>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 transition-all hover:shadow-md">
                    <p class="text-[11px] font-extrabold text-slate-400 uppercase tracking-widest">New Enrollees</p>
                    <p class="text-3xl font-black mt-2 text-[#4f46e5]">12</p>
                </div>
            </div>

            {{-- Applications Section --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                <div class="px-8 py-6 border-b border-slate-50 flex justify-between items-center bg-[#fcfcfc]">
                    <h2 class="font-bold text-slate-700">Application Queue</h2>
                    <button class="bg-[#4f46e5] hover:bg-[#4338ca] text-white px-6 py-2.5 rounded-xl text-sm font-bold transition shadow-lg shadow-indigo-100 active:scale-95">
                        + Add New Student
                    </button>
                </div>

                <div class="p-8">
                    <h3 class="font-black text-[11px] uppercase tracking-[0.2em] text-slate-400 flex items-center gap-2 mb-6">
                        <span class="w-2 h-2 bg-orange-500 rounded-full animate-pulse"></span>
                        Pending Review
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        {{-- Card 1 --}}
                        <div onclick="openModal('Juan Dela Cruz', 'juan.dc@email.com', 'BS Information Technology', '2026-0042')" 
                             class="bg-white p-6 rounded-2xl border border-slate-100 hover:border-indigo-300 hover:shadow-xl transition-all cursor-pointer group relative overflow-hidden">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h4 class="font-bold text-slate-900 text-lg group-hover:text-indigo-600 transition">Juan Dela Cruz</h4>
                                    <p class="text-sm text-slate-500 font-medium mt-1">BS Information Technology</p>
                                </div>
                                <span class="text-[10px] font-black text-indigo-600 bg-indigo-50 px-3 py-1.5 rounded-lg uppercase tracking-wider group-hover:bg-indigo-600 group-hover:text-white transition-colors">Review</span>
                            </div>
                        </div>

                        {{-- Card 2 --}}
                        <div onclick="openModal('Maria Santos', 'maria.s@email.com', 'BS Computer Science', '2026-0043')" 
                             class="bg-white p-6 rounded-2xl border border-slate-100 hover:border-indigo-300 hover:shadow-xl transition-all cursor-pointer group relative overflow-hidden">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h4 class="font-bold text-slate-900 text-lg group-hover:text-indigo-600 transition">Maria Santos</h4>
                                    <p class="text-sm text-slate-500 font-medium mt-1">BS Computer Science</p>
                                </div>
                                <span class="text-[10px] font-black text-indigo-600 bg-indigo-50 px-3 py-1.5 rounded-lg uppercase tracking-wider group-hover:bg-indigo-600 group-hover:text-white transition-colors">Review</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    {{-- Student Detail Modal --}}
    <div id="reviewModal" class="fixed inset-0 z-[100] hidden flex items-center justify-center bg-slate-900/40 backdrop-blur-sm transition-opacity duration-300">
        <div class="bg-white w-full max-w-lg rounded-[2rem] shadow-2xl transform transition-all scale-95 opacity-0 duration-300 overflow-hidden" id="modalContainer">
            <div class="p-8 border-b border-slate-50 flex justify-between items-center">
                <h2 class="text-2xl font-black text-slate-800 tracking-tight">Application Details</h2>
                <button onclick="closeModal()" class="text-slate-400 hover:text-slate-600 text-3xl leading-none transition">&times;</button>
            </div>
            
            <div class="p-10 space-y-8">
                <div class="grid grid-cols-2 gap-8">
                    <div>
                        <p class="text-[11px] font-black text-slate-400 uppercase tracking-[0.15em]">Student Name</p>
                        <p id="modalName" class="text-base font-bold text-slate-900 mt-1"></p>
                    </div>
                    <div>
                        <p class="text-[11px] font-black text-slate-400 uppercase tracking-[0.15em]">Student ID</p>
                        <p id="modalID" class="text-base font-bold text-slate-900 mt-1"></p>
                    </div>
                    <div class="col-span-2">
                        <p class="text-[11px] font-black text-slate-400 uppercase tracking-[0.15em]">Email Address</p>
                        <p id="modalEmail" class="text-base font-bold text-slate-900 mt-1"></p>
                    </div>
                    <div class="col-span-2">
                        <p class="text-[11px] font-black text-slate-400 uppercase tracking-[0.15em]">Course Program</p>
                        <p id="modalCourse" class="text-base font-bold text-slate-900 mt-1"></p>
                    </div>
                </div>
            </div>

            <div class="p-8 bg-slate-50 flex flex-col sm:flex-row justify-end gap-3 border-t border-slate-100">
                <button onclick="closeModal()" class="px-6 py-3 text-sm font-bold text-slate-500 hover:text-slate-700 transition order-2 sm:order-1">Close</button>
                <button class="px-6 py-3 text-sm font-bold text-white bg-slate-400 hover:bg-red-500 rounded-xl transition order-3 sm:order-2">Reject</button>
                <button class="px-8 py-3 text-sm font-black text-white bg-[#7f0000] hover:bg-[#600000] rounded-xl shadow-lg shadow-[#7f0000]/20 transition order-1 sm:order-3 active:scale-95">Approve Enrollment</button>
            </div>
        </div>
    </div>

    <script>
        function openModal(name, email, course, id) {
            const modal = document.getElementById('reviewModal');
            const container = document.getElementById('modalContainer');

            document.getElementById('modalName').innerText = name;
            document.getElementById('modalEmail').innerText = email;
            document.getElementById('modalCourse').innerText = course;
            document.getElementById('modalID').innerText = id;

            modal.classList.remove('hidden');
            setTimeout(() => {
                container.classList.remove('scale-95', 'opacity-0');
                container.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        function closeModal() {
            const modal = document.getElementById('reviewModal');
            const container = document.getElementById('modalContainer');

            container.classList.remove('scale-100', 'opacity-100');
            container.classList.add('scale-95', 'opacity-0');
            
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }

        window.onclick = function(event) {
            const modal = document.getElementById('reviewModal');
            if (event.target == modal) closeModal();
        }
    </script>
</body>
</html>