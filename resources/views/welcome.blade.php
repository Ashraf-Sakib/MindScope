<x-app-layout>
   
    <section class="text-center mt-20">
        <h1 class="text-3xl font-bold text-gray-700">Welcome to MindScope </h1>
        <p class="text-gray-500 mt-2">Track your mood, check in daily, and see your progress over time.</p>
    </section>

   
    <section class="flex justify-center gap-4 mt-10">
        <button class="w-16 h-16 rounded-full bg-mint-100 hover:bg-mint-200 flex items-center justify-center text-2xl">Happy</button>
        <button class="w-16 h-16 rounded-full bg-blue-100 hover:bg-blue-200 flex items-center justify-center text-2xl">Sad</button>
        <button class="w-16 h-16 rounded-full bg-purple-100 hover:bg-purple-200 flex items-center justify-center text-2xl">Excited</button>
        <button class="w-16 h-16 rounded-full bg-lavender-100 hover:bg-lavender-200 flex items-center justify-center text-2xl">Stressed</button>
    </section>
    <div class="mt-10 text-center">
        <a href="/dashboard" class="bg-mint-200 hover:bg-mint-300 text-gray-700 py-2 px-6 rounded-xl font-medium">
            Go to Dashboard
        </a>
    </div>
</x-app-layout>
