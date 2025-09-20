<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>

    <!-- Mood Form -->
    <form method="POST" action="{{ route('moods.store') }}">
        @csrf
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <label for="mood" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    How are you feeling today?
                </label>
                <select id="mood" name="mood" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                    <option value="happy">Happy</option>
                    <option value="sad">Sad</option>
                    <option value="anxious">Anxious</option>
                    <option value="excited">Excited</option>
                    <option value="angry">Angry</option>
                </select>

                <label for="note" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mt-4">
                    Additional Notes (optional)
                </label>
                <textarea id="note" name="note" rows="3" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>

                <button type="submit" class="mt-4 inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Submit
                </button>
            </div>
        </div>
    </form>
    <a href="{{ route('weekly.report') }}" class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-6 inline-block text-indigo-600 hover:underline">
        View Weekly Mood Report
    </a>
    <a href="{{ route('relief') }}" 
   class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-6 inline-block text-indigo-600 hover:underline">
    Need Instant Relief?
</a>



    <!-- Mood History -->
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-6">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
            <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Your Mood History</h2>
            <ul class="list-disc pl-5 space-y-1 text-gray-700 dark:text-gray-300">
                @foreach(auth()->user()->moods as $mood)
                    <li>
                        {{ $mood->created_at->format('M d, Y') }} — {{ $mood->mood }} 
                        @if($mood->note) ({{ $mood->note }}) @endif
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</x-app-layout>
