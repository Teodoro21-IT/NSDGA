<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NSDGA | Create Event</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 min-h-screen flex text-slate-900 font-inter">

      <x-admin.sidebar />
    
        <main class="flex-1 flex flex-col min-h-screen ml-[260px]">
       @include('components.admin.admin_navbar')
       
        <div class="p-10 pt-24 w-full">
            {{-- Header Section --}}
            <div class="mb-8">
                <h1 class="text-[32px] font-extrabold text-[#7f0000] tracking-tight">Create New Event</h1>
                <p class="text-slate-500 font-medium">Manage and review incoming events for Academic Year 2026-2027.</p>
            </div>

        

        <div class="p-8 max-w-4xl">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="bg-slate-900 p-6">
                    <h3 class="text-white font-bold text-lg">Create New School Event</h3>
                    <p class="text-slate-400 text-xs uppercase tracking-widest font-semibold mt-1">Fill in the details to notify students</p>
                </div>

                <form action="{{ route('admin.events.store') }}" method="POST" class="p-8 space-y-6">
                    @csrf
                    
                    @if(session('success'))
                        <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-600 rounded-xl text-sm font-bold">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Event Title</label>
                            <input type="text" name="event_title" placeholder="e.g. Foundation Day" 
                                   class="w-full mt-2 p-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all">
                        </div>

                        <div>
                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Category</label>
                            <select name="event_type" class="w-full mt-2 p-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all">
                                <option value="academic">Academic</option>
                                <option value="holiday">Holiday</option>
                                <option value="exam">Examination</option>
                                <option value="sports">Sports & Culture</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Event Date</label>
                            <input type="date" name="event_date" 
                                   class="w-full mt-2 p-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all">
                        </div>
                    </div>

                    <div>
                        <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Description / Details</label>
                        <textarea name="event_description" rows="4" placeholder="Write the event details here..." 
                                  class="w-full mt-2 p-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all"></textarea>
                    </div>

                    <div class="pt-4 flex justify-end gap-3">
                        <button type="button" class="px-6 py-3 rounded-xl text-sm font-bold text-slate-500 hover:bg-slate-100 transition-all">Discard</button>
                        <button type="submit" class="px-8 py-3 bg-blue-600 text-white rounded-xl text-sm font-bold shadow-lg shadow-blue-200 hover:bg-blue-700 active:scale-95 transition-all">
                            Publish Event
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

</body>
</html>