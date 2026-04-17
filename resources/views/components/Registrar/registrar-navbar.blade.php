<nav class="bg-white border-b border-gray-100 fixed top-0 right-0 z-40 flex items-center justify-between px-8 py-3" 
     style="left: 260px; width: calc(100% - 260px); height: 70px;">
    
    <div class="flex items-center gap-5">
        <div class="h-8 border-l border-gray-200"></div>

        <div class="text-right min-w-max pr-4">
            <p class="font-bold text-slate-800 text-sm tracking-tight leading-none mb-1">
                {{-- Use full_name here --}}
                {{ Auth::user()->full_name }}
            </p>
            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest leading-none">
                REGISTRAR
            </p>
        </div>
    </div>
</nav>