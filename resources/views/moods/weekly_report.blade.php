<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-primary">
                    {{ __('MindMirror') }}
                </h2>
                <p class="text-sm opacity-70">
                    Your weekly mood report trends from 
                    <span class="font-medium">{{ now()->subWeek()->format('M j') }}</span> 
                    to 
                    <span class="font-medium">{{ now()->format('M j, Y') }}</span>
                </p>
            </div>
            <a href="{{ route('dashboard') }}" 
               class="btn btn-outline btn-sm rounded-xl">
                ← Back to MindInsight
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            @if($weeklyMoods->isEmpty())
                <div class="card bg-base-200 shadow-xl text-center py-16">
                    <div class="text-7xl mb-6 animate-bounce">📊</div>
                    <h3 class="text-2xl font-semibold mb-3">No Data Yet</h3>
                    <p class="opacity-70 mb-6">You haven’t logged any moods in the past 7 days.</p>
                    <a href="{{ route('moods.index') }}" class="btn btn-primary btn-wide text-white">
                        📝 Log Your First Mood
                    </a>
                </div>
            @else
                <!-- 🌟 Stats Summary -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                    
                    <div class="card bg-base-200 shadow-md">
                        <div class="card-body flex flex-row items-center justify-between">
                            <div>
                                <p class="text-sm opacity-70">Total Entries</p>
                                <p class="text-3xl font-bold">{{ $weeklyMoods->count() }}</p>
                            </div>
                            <div class="text-4xl">📈</div>
                        </div>
                    </div>

                    <div class="card bg-base-200 shadow-md">
                        <div class="card-body flex flex-row items-center justify-between">
                            <div>
                                <p class="text-sm opacity-70">Most Common Mood</p>
                                <p class="text-3xl font-bold capitalize">
                                    {{ $mostCommonMood ?? 'N/A' }}
                                </p>
                            </div>
                            <div class="text-4xl">
                                @if(isset($mostCommonMood))
                                    @switch($mostCommonMood)
                                        @case('happy') 😊 @break
                                        @case('excited') 🤩 @break
                                        @case('calm') 😌 @break
                                        @case('anxious') 😰 @break
                                        @case('sad') 😢 @break
                                        @case('tired') 😴 @break
                                        @case('stressed') 😰 @break
                                        @case('angry') 😠 @break
                                        @default 😊
                                    @endswitch
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="card bg-base-200 shadow-md">
                        <div class="card-body flex flex-row items-center justify-between">
                            <div>
                                <p class="text-sm opacity-70">Consistency</p>
                                <p class="text-3xl font-bold">{{ $consistencyRate ?? 0 }}%</p>
                            </div>
                            <div class="text-4xl">🔥</div>
                        </div>
                    </div>
                </div>

                <!-- 🪄 Mood Entries -->
                <div class="card bg-base-200 shadow-xl">
                    <div class="card-body">
                        <h3 class="card-title text-lg font-semibold mb-4">Your Mood Entries</h3>
                        <div class="divide-y divide-base-300">
                            @foreach($weeklyMoods as $mood)
                                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between py-4">
                                    <div class="flex items-start space-x-4">
                                        <div class="text-4xl">
                                            @switch($mood->mood)
                                                @case('happy') 😊 @break
                                                @case('excited') 🤩 @break
                                                @case('calm') 😌 @break
                                                @case('anxious') 😰 @break
                                                @case('sad') 😢 @break
                                                @case('tired') 😴 @break
                                                @case('stressed') 😰 @break
                                                @case('angry') 😠 @break
                                                @default 😊
                                            @endswitch
                                        </div>
                                        <div>
                                            <p class="font-semibold capitalize">
                                                {{ $mood->mood }}
                                            </p>
                                            <p class="text-sm opacity-70">
                                                {{ $mood->created_at->format('l, F j, Y • g:i A') }}
                                            </p>
                                            @if($mood->note)
                                                <p class="mt-1 italic text-sm opacity-80">
                                                    “{{ $mood->note }}”
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="mt-2 sm:mt-0 text-xs opacity-70">
                                        {{ $mood->created_at->diffForHumans() }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
