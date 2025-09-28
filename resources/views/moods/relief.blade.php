<x-app-layout>
    <x-slot name="title">Instant Relief</x-slot>
    
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Instant Relief') }}
                </h2>
                <p class="text-gray-600 dark:text-gray-400 text-sm mt-1">
                    Take a moment to breathe and find your calm.
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Breathing Exercise -->
            <div class="bg-white dark:bg-gray-800 shadow-2xl rounded-3xl p-8 text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Breathing Exercise 🌿</h1>
                <p class="text-gray-600 dark:text-gray-400 mb-8">Follow the rhythm to calm your mind and body</p>

                <div class="mb-8 flex flex-col items-center">
                    <p id="breath-text" class="text-2xl font-semibold text-indigo-600 dark:text-indigo-400 mb-6">Inhale...</p>
                    <div id="circle" class="w-32 h-32 bg-gradient-to-r from-indigo-400 to-purple-500 rounded-full transition-all duration-4000 ease-in-out shadow-2xl"></div>
                </div>

                <div class="bg-gray-50 dark:bg-gray-700 rounded-2xl p-6">
                    <p id="quote-text" class="text-lg italic text-gray-700 dark:text-gray-300">Take a deep breath...</p>
                </div>
            </div>

            <!-- Quick Tips -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-gradient-to-br from-green-500 to-emerald-600 text-white rounded-2xl p-6">
                    <h3 class="font-semibold text-lg mb-2">🌱 Grounding Technique</h3>
                    <p class="text-green-100 text-sm">Name 5 things you can see, 4 you can touch, 3 you can hear, 2 you can smell, 1 you can taste.</p>
                </div>
                
                <div class="bg-gradient-to-br from-blue-500 to-cyan-600 text-white rounded-2xl p-6">
                    <h3 class="font-semibold text-lg mb-2">💭 Positive Affirmation</h3>
                    <p class="text-blue-100 text-sm">"This moment is temporary. I have the strength to get through it."</p>
                </div>
            </div>

            <!-- Back Button -->
            <div class="text-center mt-8">
                <a href="{{ route('dashboard') }}" 
                   class="inline-flex items-center px-6 py-3 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-xl hover:bg-gray-200 dark:hover:bg-gray-600 transition duration-150 font-medium">
                    ← Back to Dashboard
                </a>
            </div>
        </div>
    </div>

    <!-- Breathing Exercise Script -->
    <script>
        const circle = document.getElementById('circle');
        const breathText = document.getElementById('breath-text');
        const quoteText = document.getElementById('quote-text');

        const quotes = [
            "You are stronger than you think.",
            "One step at a time.",
            "Breathe. Relax. Reset.",
            "Your mind deserves a break.",
            "Calmness is a superpower.",
            "This too shall pass.",
            "You've survived 100% of your bad days.",
            "Progress, not perfection.",
            "Be gentle with yourself.",
            "You are doing better than you think."
        ];

        function breathe() {
            // Inhale (4 seconds)
            breathText.textContent = 'Inhale...';
            breathText.className = 'text-2xl font-semibold text-green-600 dark:text-green-400 mb-6';
            circle.style.transform = 'scale(1.5)';
            circle.style.background = 'linear-gradient(to right, #10b981, #34d399)';

            setTimeout(() => {
                // Hold (4 seconds)
                breathText.textContent = 'Hold...';
                breathText.className = 'text-2xl font-semibold text-blue-600 dark:text-blue-400 mb-6';

                setTimeout(() => {
                    // Exhale (4 seconds)
                    breathText.textContent = 'Exhale...';
                    breathText.className = 'text-2xl font-semibold text-purple-600 dark:text-purple-400 mb-6';
                    circle.style.transform = 'scale(1)';
                    circle.style.background = 'linear-gradient(to right, #8b5cf6, #a78bfa)';

                    // Show random quote
                    const randomQuote = quotes[Math.floor(Math.random() * quotes.length)];
                    quoteText.textContent = `"${randomQuote}"`;

                    setTimeout(breathe, 4000); // Repeat
                }, 4000);
            }, 4000);
        }

        // Start the breathing exercise
        breathe();
    </script>

    <style>
        #circle {
            transition: all 4s cubic-bezier(0.4, 0, 0.2, 1);
        }
    </style>
</x-app-layout>