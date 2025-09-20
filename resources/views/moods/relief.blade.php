<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Instant Relief') }}
        </h2>
    </x-slot>

    <div class="max-w-3xl mx-auto mt-10 text-center px-4">
        <!-- Page Title -->
        <h1 class="text-3xl font-bold mb-6 text-indigo-600">Instant Relief 🌿</h1>

        <!-- Breathing Exercise -->
        <div id="breathing" class="mb-10 flex flex-col items-center">
            <p id="breath-text" class="text-xl mb-4 text-gray-700">Inhale...</p>
            <div id="circle" class="w-24 h-24 bg-indigo-400 rounded-full transition-transform duration-2000 ease-in-out shadow-lg"></div>
        </div>

        <!-- Motivational Quotes -->
        <p id="quote-text" class="text-lg italic text-gray-700">Take a deep breath...</p>

        <!-- Back to Dashboard -->
        <div class="mt-10">
            <a href="{{ route('dashboard') }}" class="text-indigo-600 hover:underline">
                ← Back to Dashboard
            </a>
        </div>
    </div>

    <!-- JS for breathing animation and quotes -->
    <script>
        const circle = document.getElementById('circle');
        const breathText = document.getElementById('breath-text');
        const quoteText = document.getElementById('quote-text');

        const quotes = [
            "You are stronger than you think.",
            "One step at a time.",
            "Breathe. Relax. Reset.",
            "Your mind deserves a break.",
            "Calmness is a superpower."
        ];

        function breathe() {
            // Inhale
            breathText.textContent = 'Inhale...';
            circle.style.transform = 'scale(1.5)';

            setTimeout(() => {
                // Hold
                breathText.textContent = 'Hold...';

                setTimeout(() => {
                    // Exhale
                    breathText.textContent = 'Exhale...';
                    circle.style.transform = 'scale(1)';

                    // Show a random quote at exhale
                    const random = quotes[Math.floor(Math.random() * quotes.length)];
                    quoteText.textContent = random;

                    setTimeout(breathe, 4000); // Repeat the cycle
                }, 4000);
            }, 4000);
        }

        breathe();
    </script>
</x-app-layout>
