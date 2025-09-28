<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Weekly Mood Report') }}
                </h2>
                <p class="text-gray-600 dark:text-gray-400 text-sm mt-1">
                    Your mood trends from {{ now()->subWeek()->format('M j') }} to {{ now()->format('M j, Y') }}
                </p>
            </div>
            <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition duration-150">
                ← Back to Dashboard
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($weeklyMoods->isEmpty())
                <div class="text-center py-12">
                    <div class="text-6xl mb-4">📊</div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">No Data Yet</h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-6">You haven't logged any moods in the past 7 days.</p>
                    <a href="{{ route('moods.index') }}" class="inline-flex items-center px-6 py-3 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 transition duration-150">
                        📝 Log Your First Mood
                    </a>
                </div>
            @else
                <!-- Stats Summary -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-lg">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Entries</p>
                                <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $weeklyMoods->count() }}</p>
                            </div>
                            <div class="text-2xl">📈</div>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-lg">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Most Common Mood</p>
                                <p class="text-2xl font-bold text-gray-900 dark:text-white capitalize">
                                    {{ $mostCommonMood ?? 'N/A' }}
                                </p>
                            </div>
                            <div class="text-2xl">
                                @if(isset($mostCommonMood))
                                    @switch($mostCommonMood)
                                        @case('happy') 😊 @break
                                        @case('excited') 🤩 @break
                                        @case('calm') 😌 @break
                                        @case('anxious') 😰 @break
                                        @case('sad') 😢 @break
                                        @default 😊
                                    @endswitch
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-lg">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Consistency</p>
                                <p class="text-2xl font-bold text-gray-900 dark:text-white">
                                    {{ $consistencyRate ?? 0 }}%
                                </p>
                            </div>
                            <div class="text-2xl">🔥</div>
                        </div>
                    </div>
                </div>

                <!-- Mood Entries -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-lg">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-6">Your Mood Entries</h3>
                    
                    <div class="space-y-4">
                        @foreach($weeklyMoods as $mood)
                            <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-700 rounded-xl">
                                <div class="flex items-center space-x-4">
                                    <div class="text-3xl">
                                        @switch($mood->mood)
                                            @case('happy') 😊 @break
                                            @case('excited') 🤩 @break
                                            @case('calm') 😌 @break
                                            @case('anxious') 😰 @break
                                            @case('sad') 😢 @break
                                            @default 😊
                                        @endswitch
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-900 dark:text-white capitalize">
                                            {{ $mood->mood }}
                                        </p>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">
                                            {{ $mood->created_at->format('l, F j, Y • g:i A') }}
                                        </p>
                                        @if($mood->note)
                                            <p class="text-gray-600 dark:text-gray-300 mt-1 text-sm">
                                                "{{ $mood->note }}"
                                            </p>
                                        @endif
                                    </div>
                                </div>
                                <span class="text-xs text-gray-500 dark:text-gray-400">
                                    {{ $mood->created_at->diffForHumans() }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>