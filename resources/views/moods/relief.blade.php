<x-app-layout>
    <x-slot name="title">MindEase</x-slot>
    
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-primary">MindEase</h2>
                <p class="text-sm opacity-70">Take a moment to breathe and find your calm with <b>MindEase</i></b>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
            <div class="card bg-base-100 shadow-lg rounded-3xl p-8 text-center relative overflow-hidden">
                <h1 class="text-3xl font-bold mb-2">Box Breathing 🫁</h1>
                <p class="text-sm opacity-70 mb-6">Follow the animation below to balance your breath and ease your mind.</p>
                <div class="flex flex-col items-center mb-8">
                    <img id="lungs" src="{{ asset('images/Lungs.png') }}" alt="Lungs" class="w-40 h-40" />
                    <p id="breath-text" class="text-2xl font-semibold text-primary mt-6">Inhale...</p>
                </div>
                <div class="bg-base-100 rounded-2xl p-6 border border-base-300">
                    <p id="quote-text" class="text-lg italic opacity-80">Take a deep breath...</p>
                </div>
            </div>
            <div class="card bg-base-100 shadow-lg rounded-3xl p-8">
                <h2 class="text-2xl font-bold mb-3 text-success">🌱 Grounding Technique</h2>
                <p class="opacity-70 mb-4">Reconnect with the present moment by focusing on your senses.</p>

                <div class="space-y-4">
                    <div class="alert alert-success"><span class="font-semibold">5 things you can see</span></div>
                    <div class="alert alert-success"><span class="font-semibold">4 things you can touch</span></div>
                    <div class="alert alert-success"><span class="font-semibold">3 things you can hear</span></div>
                    <div class="alert alert-success"><span class="font-semibold">2 things you can smell</span></div>
                    <div class="alert alert-success"><span class="font-semibold">1 thing you can taste</span></div>
                </div>
            </div>

            <!-- Back Button -->
            <div class="text-center">
                <a href="{{ route('dashboard') }}" 
                   class="btn btn-outline btn-wide rounded-xl mt-4">
                    ← Back to MindInsight
                </a>
            </div>
        </div>
    </div>

    <!-- Breathing Script -->
    <script>
        const lungs = document.getElementById('lungs');
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

        function randomQuote() {
            quoteText.textContent = `"${quotes[Math.floor(Math.random() * quotes.length)]}"`;
        }

        function boxBreathing() {
            let cycle = 0;

            function step() {
                if (cycle % 4 === 0) {
                    breathText.textContent = "Inhale (4s)...";
                    lungs.style.transform = "scale(1.2)";
                } else if (cycle % 4 === 1) {
                    breathText.textContent = "Hold (4s)...";
                } else if (cycle % 4 === 2) {
                    breathText.textContent = "Exhale (4s)...";
                    lungs.style.transform = "scale(1)";
                } else {
                    breathText.textContent = "Hold (4s)...";
                    randomQuote();
                }
                cycle++;
            }

            step();
            setInterval(step, 4000);
        }

        boxBreathing();
    </script>

    <style>
        #lungs {
            transition: transform 4s ease-in-out;
            transform-origin: center;
        }
    </style>
</x-app-layout>
