<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application | Dashboard</title>
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
    <main class="main-content min-h-screen transition-all duration-300">
        
        {{-- Header --}}
        <header class="bg-white border-b border-gray-200 sticky top-0 z-10 px-8 py-4 flex justify-between items-center">
            <h1 class="text-xl font-bold tracking-tight text-gray-900">Dashboard Overview</h1>
            <div class="flex items-center gap-4">
                <span class="text-sm font-medium text-gray-500">{{ now()->format('F j, Y') }}</span>
                <div class="h-8 w-8 rounded-full bg-indigo-600 flex items-center justify-center text-white font-bold text-xs">AD</div>
            </div>
        </header>

        <div class="p-8">
            {{-- Stats Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <p class="text-sm font-medium text-gray-500 uppercase">Total Students</p>
                    <p class="text-2xl font-bold mt-1">1,284</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <p class="text-sm font-medium text-gray-500 uppercase">Pending Requests</p>
                    <p class="text-2xl font-bold mt-1 text-orange-600">24</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <p class="text-sm font-medium text-gray-500 uppercase">Approved Records</p>
                    <p class="text-2xl font-bold mt-1 text-green-600">956</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <p class="text-sm font-medium text-gray-500 uppercase">New Enrollees</p>
                    <p class="text-2xl font-bold mt-1 text-indigo-600">12</p>
                </div>
            </div>

            {{-- Recent Registrations Section --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                    <h2 class="font-semibold text-gray-700">Recent Registrations</h2>
                    <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
                        + Add New Student
                    </button>
                </div>

                <div class="p-6">
                    <h3 class="font-bold text-gray-700 flex items-center gap-2 mb-4">
                        <span class="w-2 h-2 bg-orange-500 rounded-full animate-pulse"></span>
                        Pending Review
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <div onclick="openModal('Juan Dela Cruz', 'juan.dc@email.com', 'BS Information Technology', '2026-0042')" 
                             class="bg-white p-4 rounded-xl border border-gray-100 hover:border-indigo-500 hover:shadow-md transition cursor-pointer group">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h4 class="font-semibold text-gray-900 group-hover:text-indigo-600 transition">Juan Dela Cruz</h4>
                                    <p class="text-xs text-gray-500">BS Information Technology</p>
                                </div>
                                <span class="text-xs font-bold text-indigo-600 bg-indigo-50 px-2 py-1 rounded">View Details</span>
                            </div>
                        </div>

                        <div onclick="openModal('Maria Santos', 'maria.s@email.com', 'BS Computer Science', '2026-0043')" 
                             class="bg-white p-4 rounded-xl border border-gray-100 hover:border-indigo-500 hover:shadow-md transition cursor-pointer group">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h4 class="font-semibold text-gray-900 group-hover:text-indigo-600 transition">Maria Santos</h4>
                                    <p class="text-xs text-gray-500">BS Computer Science</p>
                                </div>
                                <span class="text-xs font-bold text-indigo-600 bg-indigo-50 px-2 py-1 rounded">View Details</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    {{-- Student Detail Modal --}}
    <div id="reviewModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black/50 backdrop-blur-sm transition-opacity">
        <div class="bg-white w-full max-w-lg rounded-2xl shadow-2xl transform transition-all scale-95 opacity-0 duration-300" id="modalContainer">
            <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                <h2 class="text-xl font-bold text-gray-800">Student Application</h2>
                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600 text-2xl">&times;</button>
            </div>
            
            <div class="p-8 space-y-6">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase">Student Name</p>
                        <p id="modalName" class="text-sm font-medium text-gray-900"></p>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase">Student ID</p>
                        <p id="modalID" class="text-sm font-medium text-gray-900"></p>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase">Email Address</p>
                        <p id="modalEmail" class="text-sm font-medium text-gray-900"></p>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase">Course</p>
                        <p id="modalCourse" class="text-sm font-medium text-gray-900"></p>
                    </div>
                </div>
            </div>

            <div class="p-6 bg-gray-50 rounded-b-2xl flex justify-end gap-3">
                <button onclick="closeModal()" class="px-5 py-2 text-sm font-medium text-gray-600 hover:bg-gray-200 rounded-lg transition">Close</button>
                <button class="px-5 py-2 text-sm font-medium text-white bg-red-500 hover:bg-red-600 rounded-lg transition">Reject</button>
                <button class="px-5 py-2 text-sm font-medium text-white bg-green-600 hover:bg-green-700 rounded-lg shadow-lg shadow-green-100 transition">Approve Enrollment</button>
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