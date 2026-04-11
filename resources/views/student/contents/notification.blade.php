@extends('student.layouts.app')

@section('content')
@php
    $todayAnnouncements = $todayAnnouncements ?? collect();
    $yesterdayAnnouncements = $yesterdayAnnouncements ?? collect();
    $requiredActionsCount = $todayAnnouncements->count(); // Assuming today's are the actions
@endphp

<div class="min-h-screen bg-gray-50 pb-10">
    

    <div class="max-w-5xl mx-auto mt-8 px-4">
        <div class="flex justify-between items-end mb-6">
            <div>
                <h2 class="text-3xl font-semibold text-gray-900">Inbox</h2>
                <p class="text-gray-500 mt-1">You have <span class="font-medium">{{ $requiredActionsCount }}</span> new actions required</p>
            </div>
            <button class="text-red-700 font-semibold hover:underline">Mark all as read</button>
        </div>

        <div class="mb-10">
            <h3 class="text-sm font-bold text-gray-400 uppercase tracking-widest mb-4">Today</h3>
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                @forelse ($todayAnnouncements as $announcement)
                    <div class="group flex items-start p-6 border-b border-gray-50 last:border-0 hover:bg-blue-50/30 transition-colors relative">
                        <div class="flex-shrink-0 w-10 h-10 bg-gray-50 rounded-full border border-gray-200 flex items-center justify-center text-gray-400 mr-4">
                            @if(str_contains(strtolower($announcement->title), 'action'))
                                <span class="font-serif text-lg font-bold">!</span>
                            @else
                                <span class="font-serif text-lg font-bold italic">i</span>
                            @endif
                        </div>
                        
                        <div class="flex-1 pr-10">
                            <div class="flex justify-between items-start">
                                <h4 class="text-base font-bold text-gray-800">{{ $announcement->title }}</h4>
                                <span class="text-xs text-gray-400">
                                    {{ \Illuminate\Support\Carbon::parse($announcement->created_at)->diffForHumans() }}
                                </span>
                            </div>
                            <p class="text-sm text-gray-600 mt-1 leading-relaxed">
                                {{ $announcement->announcement_text }}
                            </p>
                        </div>

                        <div class="absolute right-6 top-1/2 -translate-y-1/2">
                            <div class="w-2.5 h-2.5 bg-blue-500 rounded-full"></div>
                        </div>
                    </div>
                @empty
                    <div class="p-8 text-center text-gray-400 italic">No announcements today.</div>
                @endforelse
            </div>
        </div>

        <div class="mb-10">
            <h3 class="text-sm font-bold text-gray-400 uppercase tracking-widest mb-4">Yesterday</h3>
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 min-h-[150px] flex items-center justify-center">
                @forelse ($yesterdayAnnouncements as $announcement)
                    <div class="w-full group flex items-start p-6 border-b border-gray-50 last:border-0">
                         <h4 class="font-bold">{{ $announcement->title }}</h4>
                    </div>
                @empty
                    <p class="text-gray-300">No recent history</p>
                @endforelse
            </div>
        </div>

    </div>
</div>
@endsection