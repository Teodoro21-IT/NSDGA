@php
    $activeClasses = 'bg-white/20 text-white font-semibold rounded-xl';
    $inactiveClasses = 'text-white/70 hover:bg-white/10 hover:text-white rounded-xl';

    $requiredActionsCount = $requiredActionsCount ?? null;

    if ($requiredActionsCount === null) {
        $studentAccountId = session('student_account_id');

        $requiredActionsCount = $studentAccountId
            ? \Illuminate\Support\Facades\DB::table('announcements')
                ->join(
                    'announcement_student_accounts',
                    'announcements.id',
                    '=',
                    'announcement_student_accounts.announcement_id'
                )
                ->where('announcement_student_accounts.student_account_id', $studentAccountId)
                ->whereDate('announcements.created_at', now()->toDateString())
                ->count()
            : 0;
    }
@endphp

<aside class="w-64 bg-[#800000] text-white hidden md:flex flex-col sticky top-0 h-screen shadow-2xl font-sans">
    
    <div class="p-5 border-b border-white/10 flex items-center space-x-3">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-11 h-11 rounded-full bg-white p-0.5">
        <div class="flex flex-col">
            <h1 class="text-[10px] font-bold leading-tight tracking-wide text-white uppercase">
                Nuestra Señora De Guia<br>Academy of Marikina
            </h1>
            <p class="text-[8px] font-bold text-white/70 uppercase tracking-widest mt-1">Student Portal</p>
        </div>
    </div>
    
    <nav class="flex-1 px-4 py-6 space-y-2">
        <a href="{{ route('application') }}" class="flex items-center space-x-3 p-3 transition {{ request()->routeIs('application') ? $activeClasses : $inactiveClasses }}">
            <span class="text-sm">Application Status</span>
        </a>

        <a href="{{ route('enrollment') }}" class="flex items-center space-x-3 p-3 transition {{ request()->routeIs('enrollment') ? $activeClasses : $inactiveClasses }}">
            <span class="text-sm">Enrollment Form</span>
        </a>

        <a href="{{ route('documents') }}" class="flex items-center space-x-3 p-3 transition {{ request()->routeIs('documentation') ? $activeClasses : $inactiveClasses }}">
            <span class="text-sm">My Documents</span>
        </a>

        <a href="{{ route('notification') }}" class="flex items-center justify-between p-3 transition {{ request()->routeIs('notification') ? $activeClasses : $inactiveClasses }}">
            <div class="flex items-center space-x-3">
                <span class="text-sm">Notifications</span>
            </div>
            @if ($requiredActionsCount > 0)
                <span class="bg-[#EF4444] text-white text-[10px] font-bold px-2 py-0.5 rounded-full shadow-md">{{ $requiredActionsCount }}</span>
            @endif
        </a>

        <a href="{{ route('profile') }}" class="flex items-center space-x-3 p-3 transition {{ request()->routeIs('profile') ? $activeClasses : $inactiveClasses }}">
            <span class="text-sm">My Profile</span>
        </a>
    </nav>

    <div class="p-6">
        <hr class="border-white/10 mb-6"> 
        <form action="{{ route('student.logout') }}" method="POST">
            @csrf
            <button type="submit" class="w-full flex items-center justify-center space-x-2 p-3 bg-black/20 hover:bg-[#EF4444] border border-white/5 text-white rounded-xl transition-all font-semibold text-sm">
                <span>Logout</span>
            </button>
        </form>
    </div>
</aside>