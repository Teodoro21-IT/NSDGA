<aside class="w-64 bg-slate-900 min-h-screen flex flex-col border-r border-slate-800">
    <div class="p-6">
        <h1 class="text-2xl font-black text-white tracking-tighter">NSDGA</h1>
        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-[0.2em]">School Management System</p>
    </div>

    <nav class="flex-1 px-4 space-y-2 mt-4">
        <a href="{{ route('admin.dashboard') }}" 
           class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white shadow-lg shadow-blue-900/20' : 'text-slate-400 hover:bg-slate-800' }}">
            <span class="text-sm font-bold">Manage Accounts</span>
        </a>

        <a href="{{ route('admin.students') }}" 
           class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.students') ? 'bg-blue-600 text-white shadow-lg shadow-blue-900/20' : 'text-slate-400 hover:bg-slate-800' }}">
            <span class="text-sm font-bold">Student Records</span>
        </a>

        <a href="{{ route('admin.events.create') }}" 
           class="flex items-center px-4 py-3 rounded-xl transition-all {{ request()->routeIs('admin.events.create') ? 'bg-blue-600 text-white shadow-lg' : 'text-slate-400 hover:bg-slate-800' }}">
            <span class="text-sm font-bold">Create Event</span>
        </a>
     
        <a href="{{ route('password.show') }}" 
           class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 group {{ request()->routeIs('password.show') ? 'bg-blue-600 text-white shadow-lg shadow-blue-900/20' : 'text-slate-400 hover:bg-slate-800' }}">
            <span class="text-sm font-bold">System Settings</span>
        </a>

    </nav>

    <div class="p-4 border-t border-slate-800">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center px-4 py-3 text-red-400 font-bold text-sm hover:bg-red-500/10 rounded-xl transition-all">
                Logout Account
            </button>
        </form>
    </div>
</aside>