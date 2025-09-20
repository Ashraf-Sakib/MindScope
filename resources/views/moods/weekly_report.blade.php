<x-app-layout>
    <div class="max-w-4xl mx-auto mt-8">
        <h2 class="text-2xl font-bold mb-6 text-center">Your Weekly Mood Report</h2>

        @if($WeeklyMoods->isEmpty())
            <p class="text-gray-600 text-center">No moods logged in the last 7 days.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach($WeeklyMoods as $mood)
                    <div class="bg-white p-4 rounded-xl shadow-md border">
                        <h3 class="text-lg font-semibold">
                            {{ ucfirst($mood->mood) }}
                        </h3>
                        <p class="text-gray-700">{{ $mood->note ?? 'No description provided' }}</p>
                        <p class="text-sm text-gray-500 mt-2">
                            {{ $mood->created_at->format('l, M d, Y') }}
                        </p>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="text-center mt-6">
            <a href="{{ route('dashboard') }}" 
               class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">
               Back to Dashboard
            </a>
        </div>
    </div>
</x-app-layout>
    