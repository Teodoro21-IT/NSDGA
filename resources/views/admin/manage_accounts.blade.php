<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NSDGA | Admin Dashboard</title>
    @vite(['resources/css/app.css'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="bg-slate-50 min-h-screen flex text-slate-900">

  
        <x-admin.sidebar />
    
        <main class="flex-1 flex flex-col min-h-screen ml-[260px]">
       @include('components.admin.admin_navbar')

       
        <div class="p-10 pt-24 w-full">
            {{-- Header Section --}}
            <div class="mb-8">
                <h1 class="text-[32px] font-extrabold text-[#7f0000] tracking-tight">Manage Accounts</h1>
                <p class="text-slate-500 font-medium">Manage and review Registrar accounts </p>
            </div>
        
        <div class="p-8">
            <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
                
                <div class="xl:col-span-1 bg-white rounded-2xl shadow-sm border border-slate-200 h-fit">
                    <div class="bg-slate-900 p-5 rounded-t-2xl">
                        <h3 class="font-bold text-white flex items-center">
                            <span class="mr-2">➕</span> Add New User
                        </h3>
                    </div>
                    
                    <form action="{{ route('admin.store') }}" method="POST" class="p-6 space-y-4">
                        @csrf
                        @if(session('success'))
                            <div class="p-3 bg-emerald-50 text-emerald-700 text-xs font-bold rounded-lg border border-emerald-200">
                                ✅ {{ session('success') }}
                            </div>
                        @endif

                        <div>
                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Username/Work_ID</label>
                            <input type="text" name="user" required class="w-full mt-1 p-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500/20 outline-none transition">
                            @error('user') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Full Name</label>
                            <input type="text" name="full_name" required placeholder="Juan Dela Cruz" class="w-full mt-1 p-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500/20 outline-none transition">
                        </div>

                        <div class="grid grid-cols-1 gap-4">
                            <div>
                                <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Gmail / Email</label>
                                <input type="email" name="email" required class="w-full mt-1 p-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500/20 outline-none transition" placeholder="example@gmail.com">
                            </div>
                            <div>
                                <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Contact Number</label>
                                <input type="text" name="phone_number" required class="w-full mt-1 p-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500/20 outline-none transition" placeholder="09xxxxxxxxx">
                                @error('phone_number') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div>
                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Password</label>
                            <input type="password" name="pass" required class="w-full mt-1 p-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500/20 outline-none transition">
                            @error('pass') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">User Role</label>
                            <select name="role" class="w-full mt-1 p-3 bg-slate-50 border border-slate-200 rounded-xl outline-none cursor-pointer">
                                <option value="registrar">Registrar</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>

                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 rounded-xl shadow-lg transition-all active:scale-95">
                            Register Account
                        </button>
                    </form>
                </div>

                <div class="xl:col-span-2 bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                    <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                        <div>
                            <h3 class="text-lg font-bold text-slate-800">Account Directory</h3>
                            <p class="text-xs text-slate-500">Manage school personnel access</p>
                        </div>
                        <span class="text-xs font-bold text-blue-600 bg-white border border-blue-100 px-3 py-1.5 rounded-lg">
                            Total: {{ count($accounts) }}
                        </span>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="text-slate-400 text-[10px] font-bold uppercase tracking-widest border-b border-slate-100">
                                    <th class="p-5">Employee_ID</th>
                                    <th class="p-5">Full Name</th>
                                    <th class="p-5">Contact Info</th>                                   
                                    <th class="p-5">Role</th>
                                    <th class="p-5">Status</th> 
                                    <th class="p-5 text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 text-sm">
                                @foreach($accounts as $acc)
                                <tr class="hover:bg-blue-50/30 transition duration-150">
                                    <td class="p-5">
                                        <div class="font-bold text-slate-700">{{ $acc->user }}</div>
                                        <div class="text-[10px] text-slate-400">{{ $acc->email }}</div>
                                    </td>
                                    <td class="p-5 font-bold text-slate-700 capitalize">{{ $acc->full_name ?? 'No Name' }}</td>
                                    <td class="p-5 text-slate-600 font-medium">{{ $acc->phone_number }}</td>
                                    <td class="p-5">
                                        <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase border
                                            {{ $acc->role == 'admin' ? 'bg-purple-50 text-purple-700 border-purple-100' : 'bg-cyan-50 text-cyan-700 border-cyan-100' }}">
                                            {{ $acc->role }}
                                        </span>
                                    </td>
                                    <td class="p-5">
                                        @if($acc->is_locked)
                                            <span class="px-2 py-1 text-[10px] font-bold text-red-600 bg-red-50 border border-red-100 rounded-full">LOCKED</span>
                                        @else
                                            <span class="px-2 py-1 text-[10px] font-bold text-emerald-600 bg-emerald-50 border border-emerald-100 rounded-full">ACTIVE</span>
                                        @endif
                                    </td>
                                    <td class="p-5 text-center flex justify-center space-x-1">
                                        <form action="{{ route('accounts.toggleLock', $acc->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="p-2 rounded-lg hover:bg-slate-100 transition" title="Toggle Lock">
                                                {{ $acc->is_locked ? '🔓' : '🔒' }}
                                            </button>
                                        </form>

                                        <button type="button" onclick="openEditModal({{ $acc }})" class="p-2 rounded-lg text-blue-500 hover:bg-blue-50" title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                            </svg>
                                        </button>

                                        <form action="{{ route('admin.delete', $acc->id) }}" method="POST" onsubmit="return confirm('Delete this account?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="p-2 text-red-400 hover:bg-red-50 rounded-lg transition">🗑️</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="mt-10 bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-slate-50/30">
                    <div class="flex items-center space-x-3">
                        <div class="p-2 bg-slate-900 rounded-xl"><span class="text-blue-400">🕒</span></div>
                        <h3 class="text-lg font-bold text-slate-800">Recent System Activity</h3>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="text-slate-400 text-[10px] font-bold uppercase tracking-widest bg-slate-50/30 border-b border-slate-100">
                                <th class="px-8 py-4">Administrator</th>
                                <th class="px-6 py-4">Action</th>
                                <th class="px-6 py-4">Target Person</th>
                                <th class="px-6 py-4">Network ID</th>
                                <th class="px-8 py-4 text-right">Time</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-sm">
                            @forelse($logs as $log)
                            <tr class="hover:bg-slate-50/80 transition-all">
                                <td class="px-8 py-5 font-semibold text-slate-700">{{ $log->user->full_name ?? 'System' }}</td>
                                <td class="px-6 py-5">
                                    <span class="px-3 py-1 rounded-lg text-[10px] font-bold uppercase border bg-emerald-50 text-emerald-600 border-emerald-100">
                                        {{ $log->action }}
                                    </span>
                                </td>
                                <td class="px-6 py-5 text-slate-600">{{ $log->target }}</td>
                                <td class="px-6 py-5 font-mono text-[10px] text-slate-400">{{ $log->ip_address }}</td>
                                <td class="px-8 py-5 text-right">
                                    <div class="text-slate-700 font-bold text-xs uppercase">{{ \Carbon\Carbon::parse($log->created_at)->diffForHumans() }}</div>
                                    <div class="text-[10px] text-slate-400">{{ \Carbon\Carbon::parse($log->created_at)->format('h:i A') }}</div>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="5" class="py-20 text-center text-slate-400">No activity logs found</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <div id="editModal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" onclick="closeEditModal()"></div>
        <div class="relative bg-white w-full max-w-md rounded-3xl shadow-2xl overflow-hidden transform transition-all duration-300 scale-95 opacity-0" id="modalContainer">
            
            <div class="bg-gradient-to-r from-slate-800 to-slate-900 p-6 text-white flex justify-between items-center">
                <div>
                    <h3 class="text-xl font-bold">Edit Account</h3>
                    <p class="text-slate-400 text-xs mt-1">Update personnel access info</p>
                </div>
                <button onclick="closeEditModal()" class="text-slate-400 hover:text-white">✕</button>
            </div>

            <form id="editForm" method="POST" class="p-8 space-y-4">
                @csrf @method('PUT')
                
                <div>
                    <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Full Name</label>
                    <input type="text" name="full_name" id="edit_full_name" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500/20 outline-none">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Employee ID</label>
                        <input type="text" name="user" id="edit_user" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500/20 outline-none">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Role</label>
                        <select name="role" id="edit_role" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none">
                            <option value="admin">Admin</option>
                            <option value="registrar">Registrar</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Gmail / Email</label>
                    <input type="email" name="email" id="edit_email" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500/20 outline-none">
                </div>

                <div>
                    <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Contact Number</label>
                    <input type="text" name="phone_number" id="edit_phone" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500/20 outline-none">
                </div>

                <div class="pt-2 border-t border-slate-100">
                    <label class="block text-[10px] font-bold text-blue-500 uppercase tracking-widest mb-1">Security Reset</label>
                    <div class="relative">
                        <input type="password" name="pass" id="edit_password" placeholder="New password (leave blank to keep)" 
                            class="w-full px-4 py-3 bg-blue-50/30 border border-blue-100 rounded-xl focus:ring-2 focus:ring-blue-500/20 outline-none text-sm">
                        <button type="button" onclick="togglePass()" class="absolute right-3 top-3 text-blue-300 hover:text-blue-600">👁️</button>
                    </div>
                </div>

                <div class="flex items-center space-x-3 pt-4">
                    <button type="button" onclick="closeEditModal()" class="flex-1 px-6 py-3 border border-slate-200 text-slate-500 font-bold rounded-2xl hover:bg-slate-50 transition-all">Cancel</button>
                    <button type="submit" class="flex-1 px-6 py-3 bg-blue-600 text-white font-bold rounded-2xl shadow-lg hover:bg-blue-700 transition-all">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openEditModal(account) {   
            const modal = document.getElementById('editModal');
            const container = document.getElementById('modalContainer');
            
            document.getElementById('editForm').action = '/admin/update/' + account.id;
            document.getElementById('edit_full_name').value = account.full_name;
            document.getElementById('edit_user').value = account.user;
            document.getElementById('edit_email').value = account.email;
            document.getElementById('edit_phone').value = account.phone_number;
            document.getElementById('edit_role').value = account.role;
            document.getElementById('edit_password').value = '';

            modal.classList.remove('hidden');
            setTimeout(() => {
                container.classList.remove('scale-95', 'opacity-0');
                container.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        function closeEditModal() {
            const modal = document.getElementById('editModal');
            const container = document.getElementById('modalContainer');
            container.classList.add('scale-95', 'opacity-0');
            setTimeout(() => { modal.classList.add('hidden'); }, 300);
        }

        function togglePass() {
            const p = document.getElementById('edit_password');
            p.type = p.type === 'password' ? 'text' : 'password';
        }
    </script>
</body>
</html>