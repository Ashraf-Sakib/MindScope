<x-app-layout>
  <x-slot name="header">
    <div class="flex justify-between items-center">
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
        🧠 MindScope Dashboard
      </h2>
      <div class="flex items-center space-x-4">
        <span class="text-gray-600 dark:text-gray-300">{{ Auth::user()->name }}</span>
        <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800">logout</a>
        <a href="{{ route('profile.edit') }}" class="text-blue-600 hover:text-blue-800">Edit Profile</a>
      </div>
    </div>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
          <h3 class="text-lg font-medium mb-2">Welcome section</h3>
          <p class="text-gray-600 dark:text-gray-400">
            Welcome back, {{ Auth::user()->name }}! ✨<br>
            Track your mood, reflect on your week, and chat with Wizard Cat for motivation 🐱🪄
          </p>
        </div>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <a href="{{ route('moods.index') }}" class="block">
          <div class="bg-red-100 border-2 border-red-300 rounded-2xl p-8 text-center hover:shadow-lg transition-shadow">
            <div class="text-4xl mb-4">😊</div>
            <h3 class="text-lg font-semibold text-red-700">mood entry</h3>
            <p class="text-sm text-red-600 mt-2">Log your feelings and add notes</p>
          </div>
        </a>
        <a href="{{ route('relief') }}" class="block">
          <div class="bg-yellow-100 border-2 border-yellow-300 rounded-2xl p-8 text-center hover:shadow-lg transition-shadow">
            <div class="text-4xl mb-4">🌿</div>
            <h3 class="text-lg font-semibold text-yellow-700">instant relief</h3>
            <p class="text-sm text-yellow-600 mt-2">Try breathing exercises or meditation</p>
          </div>
        </a>

        <a href="{{ route('weekly.report') }}" class="block">
          <div class="bg-blue-100 border-2 border-blue-300 rounded-2xl p-8 text-center hover:shadow-lg transition-shadow">
            <div class="text-4xl mb-4">📊</div>
            <h3 class="text-lg font-semibold text-blue-700">weekly report</h3>
            <p class="text-sm text-blue-600 mt-2">See how your week has been</p>
          </div>
        </a>

      </div>
      <div class="bg-green-100 border-2 border-green-300 rounded-2xl p-8">
        <div class="flex items-center mb-6">
          <span class="text-2xl mr-3">📝</span>
          <h3 class="text-xl font-semibold text-green-700">recent mood entries</h3>
        </div>
        
        @if($recentMoods->isEmpty())
          <div class="text-center py-8">
            <p class="text-green-600 text-lg">No moods logged yet. Start tracking today! 🌟</p>
          </div>
        @else
          <div class="overflow-x-auto">
            <table class="w-full table-auto">
              <thead>
                <tr class="text-left border-b-2 border-green-200">
                  <th class="pb-3 text-green-700 font-semibold">Date</th>
                  <th class="pb-3 text-green-700 font-semibold">Mood</th>
                  <th class="pb-3 text-green-700 font-semibold">Note</th>
                </tr>
              </thead>
              <tbody>
                @foreach($recentMoods as $mood)
                  <tr class="border-b border-green-100">
                    <td class="py-3 text-green-700">{{ $mood->created_at->format('M d, Y') }}</td>
                    <td class="py-3">
                      <span class="inline-block px-3 py-1 rounded-full text-sm font-medium text-white
                        @if($mood->mood === 'happy') bg-green-500
                        @elseif($mood->mood === 'sad') bg-blue-500
                        @elseif($mood->mood === 'anxious') bg-yellow-500
                        @elseif($mood->mood === 'angry') bg-red-500
                        @else bg-gray-500 @endif">
                        {{ ucfirst($mood->mood) }}
                      </span>
                    </td>
                    <td class="py-3 text-green-700">{{ Str::limit($mood->note, 50) }}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        @endif
      </div>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-red-100 border-2 border-red-300 rounded-2xl p-8">
          <div class="text-center">
            <div class="text-4xl mb-4">📝</div>
            <h3 class="text-lg font-semibold text-red-700 mb-2">taking note</h3>
            <p class="text-sm text-red-600 mb-4">Quick notes and thoughts</p>
            <button class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition-colors">
              Add Note
            </button>
          </div>
        </div>
        <div class="bg-purple-100 border-2 border-purple-300 rounded-full p-8">
          <div class="text-center">
            <div class="text-5xl mb-4">🐱</div>
            <h3 class="text-lg font-semibold text-purple-700 mb-2">wizard cat</h3>
            <h4 class="text-md font-medium text-purple-600 mb-4">floating chatbot</h4>
            <p class="text-sm text-purple-600 mb-4">Get motivational advice and support</p>
            <button class="bg-purple-500 text-white px-4 py-2 rounded-lg hover:bg-purple-600 transition-colors">
              Chat Now
            </button>
          </div>
        </div>

      </div>

    </div>
  </div>
</x-app-layout>