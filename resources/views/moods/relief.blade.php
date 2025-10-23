<x-app-layout>
    <section class="max-w-4xl mx-auto px-6 pt-16 pb-12 text-center">
        <div class="mb-8">
            <h1 class="text-4xl md:text-5xl font-bold text-base-content mb-4">
                Welcome to <span class="text-primary">MindEase</span>
            </h1>
            <p class="text-lg text-base-content/70 max-w-2xl mx-auto">
               <b>MindEase</b> is your pocket-sized calm zone — a space within MindScope designed to help you slow down, breathe, and reset. 🌙
            </p>
        </div>
    </section>
    <section class="max-w-4xl mx-auto px-6 mb-12">
        <div class="bg-base-100 text-base-content rounded-3xl p-8 shadow-xl border-2 border-primary">
            <h2 class="text-2xl font-semibold text-base-content mb-3">About MindEase</h2>
            <p class="text-base-content/70 leading-relaxed">
               <i>In a world that’s always rushing, MindEase gives you the tools to pause.
With guided box breathing exercises, grounding techniques, and mindfulness sessions, it helps you manage anxiety, stay present, and find mental balance in moments of stress.</i>
            </p>
        </div>
    </section>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
            
            <div class="card bg-base-100 text-base-content border-2 border-primary shadow-xl">
                <div class="card-body p-0 grid grid-cols-1 md:grid-cols-2">
                    <div class="flex flex-col items-center justify-center p-8 bg-gradient-to-br from-primary/10 to-secondary/10">
                        <img id="lungs" src="{{ asset('images/Lungs.png') }}" alt="Lungs" class="w-64 h-64 object-contain" />
                        <p id="breath-text" class="text-3xl font-bold text-primary mt-6">Inhale</p>
                        <p id="countdown" class="text-6xl font-bold text-primary mt-4">4</p>
                    </div>
            
                    <div class="flex flex-col justify-center p-8 space-y-6">
                        <div>
                            <h1 class="text-3xl font-bold mb-2 text-success">Box Breathing 🫁</h1>
                            <p class="text-sm opacity-70">Follow the animation to balance your breath and ease your mind.</p>
                        </div>
                        
                        <div class="bg-base-200 rounded-2xl p-6 border border-base-300">
                            <p id="quote-text" class="text-lg italic opacity-80">"Take a deep breath..."</p>
                        </div>
                        
                        <div class="space-y-2">
                            <p class="font-semibold">How it works:</p>
                            <ul class="text-sm opacity-70 space-y-1 list-disc list-inside">
                                <li>Inhale for 5 seconds</li>
                                <li>Hold for 5 seconds</li>
                                <li>Exhale for 5 seconds</li>
                                <li>Hold for 5 seconds</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card bg-base-100 text-base-content border-2 border-success shadow-xl">
                <div class="card-body p-0 grid grid-cols-1 md:grid-cols-2">
                    <div class="flex items-center justify-center  bg-base-100">
                        <img src="{{ asset('images/ground.png') }}" alt="Grounding" class="w-full h-full object-contain rounded-xl"/>
                    </div>
                    <div class="flex flex-col justify-center p-8 space-y-4">
                        <div>
                            <h2 class="text-2xl font-bold mb-2 text-success">Grounding Technique</h2>
                            <p class="opacity-70">Reconnect with the present moment by focusing on your senses.</p>
                        </div>

                        <div class="space-y-3">
                            <div class="alert alert-success">
                                <span class="font-semibold">5 things you can see</span>
                            </div>
                            <div class="alert alert-success">
                                <span class="font-semibold">4 things you can touch</span>
                            </div>
                            <div class="alert alert-success">
                                <span class="font-semibold">3 things you can hear</span>
                            </div>
                            <div class="alert alert-success">
                                <span class="font-semibold">2 things you can smell</span>
                            </div>
                            <div class="alert alert-success">
                                <span class="font-semibold">1 thing you can taste</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          <div class="card bg-base-100 text-base-content border-2 border-info shadow-xl">
                <div class="card-body p-0 grid grid-cols-1 md:grid-cols-2">
                    <div class="flex items-center justify-center bg-base-100 ">
                        <img src="{{ asset('images/mindful.png') }}" alt="Meditation" class="w-full h-full object-cover md:object-contain rounded-l-xl"/>
                    </div>
                
                    <div class="flex flex-col justify-center p-8 space-y-6">
                        <div>
                            <h2 class="text-2xl font-bold mb-2 text-success">Daily Mindfulness</h2>
                            <p class="opacity-70">Watch these videos for your daily mindfulness</p>
                        </div>
                        
                        <div class="carousel w-full rounded-xl bg-base-200 overflow-hidden">
                            <div id="video1" class="carousel-item relative w-full">
                                <div class="w-full aspect-video">
                                    <iframe 
                                        src="https://www.youtube.com/embed/ZToicYcHIOU" 
                                        title="Mindfulness Meditation"
                                        frameborder="0" 
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                                        allowfullscreen
                                        loading="lazy"
                                        class="w-full h-full">
                                    </iframe>
                                </div>
                                <div class="absolute flex justify-between transform -translate-y-1/2 left-4 right-4 top-1/2">
                                    <a href="#video5" class="btn btn-circle btn-sm btn-primary">❮</a>
                                    <a href="#video2" class="btn btn-circle btn-sm btn-primary">❯</a>
                                </div>
                            </div>
                            <div id="video2" class="carousel-item relative w-full">
                                <div class="w-full aspect-video">
                                    <iframe 
                                        src="https://www.youtube.com/embed/7-jJqXU25wo" 
                                        title="5-Minute Breathing Meditation"
                                        frameborder="0" 
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                                        allowfullscreen
                                        loading="lazy"
                                        class="w-full h-full">
                                    </iframe>
                                </div>
                                <div class="absolute flex justify-between transform -translate-y-1/2 left-4 right-4 top-1/2">
                                    <a href="#video1" class="btn btn-circle btn-sm btn-primary">❮</a>
                                    <a href="#video3" class="btn btn-circle btn-sm btn-primary">❯</a>
                                </div>
                            </div>
                            <div id="video3" class="carousel-item relative w-full">
                                <div class="w-full aspect-video">
                                    <iframe 
                                        src="https://www.youtube.com/embed/uumInvT4t9Y" 
                                        title="Guided Relaxation"
                                        frameborder="0" 
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                                        allowfullscreen
                                        loading="lazy"
                                        class="w-full h-full">
                                    </iframe>
                                </div>
                                <div class="absolute flex justify-between transform -translate-y-1/2 left-4 right-4 top-1/2">
                                    <a href="#video2" class="btn btn-circle btn-sm btn-primary">❮</a>
                                    <a href="#video4" class="btn btn-circle btn-sm btn-primary">❯</a>
                                </div>
                            </div>
                            <div id="video4" class="carousel-item relative w-full">
                                <div class="w-full aspect-video">
                                    <iframe 
                                        src="https://www.youtube.com/embed/pAEioF7FaWY" 
                                        title="Sleep Meditation"
                                        frameborder="0" 
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                                        allowfullscreen
                                        loading="lazy"
                                        class="w-full h-full">
                                    </iframe>
                                </div>
                                <div class="absolute flex justify-between transform -translate-y-1/2 left-4 right-4 top-1/2">
                                    <a href="#video3" class="btn btn-circle btn-sm btn-primary">❮</a>
                                    <a href="#video5" class="btn btn-circle btn-sm btn-primary">❯</a>
                                </div>
                            </div>
                            <div id="video5" class="carousel-item relative w-full">
                                <div class="w-full aspect-video">
                                    <iframe 
                                        src="https://www.youtube.com/embed/sG7DBA-mgFY" 
                                        title="Meditation Music"
                                        frameborder="0" 
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                                        allowfullscreen
                                        loading="lazy"
                                        class="w-full h-full">
                                    </iframe>
                                </div>
                                <div class="absolute flex justify-between transform -translate-y-1/2 left-4 right-4 top-1/2">
                                    <a href="#video4" class="btn btn-circle btn-sm btn-primary">❮</a>
                                    <a href="#video1" class="btn btn-circle btn-sm btn-primary">❯</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <a href="{{ route('dashboard') }}" 
                   class="btn btn-outline btn-wide rounded-xl mt-4">
                    ← Back to MindInsight
                </a>
            </div>
        </div>
    </div>
<script>
    const lungs = document.getElementById('lungs');
    const breathText = document.getElementById('breath-text');
    const countdown = document.getElementById('countdown');
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
        "You are doing better than you think.",
        "Hard times create strong people.",
        "Keep moving forward, no matter how slow.",
        "Courage creates change.",
        "Be brave enough to begin."
    ];

    function randomQuote() {
        const randomIndex = Math.floor(Math.random() * quotes.length);
        quoteText.textContent = `"${quotes[randomIndex]}"`;
    }

    randomQuote();

    function boxBreathing() {
        let cycle = 0;
        let count = 5;  
        
        function updateCountdown() {
            countdown.textContent = count;
            count--;
            
            if (count < 1) {
                count = 5;  
                cycle++;
                updatePhase();
            }
        }
        
        function updatePhase() {
            if (cycle % 4 === 0) {
                breathText.textContent = "Inhale";
                breathText.className = "text-3xl font-bold text-info mt-6";
                lungs.style.transform = "scale(1.3)";
                randomQuote(); 
            } else if (cycle % 4 === 1) {
                breathText.textContent = "Hold";
                breathText.className = "text-3xl font-bold text-warning mt-6";
                randomQuote();
            } else if (cycle % 4 === 2) {
                breathText.textContent = "Exhale";
                breathText.className = "text-3xl font-bold text-success mt-6";
                lungs.style.transform = "scale(1)";
                randomQuote();
            } else {
                breathText.textContent = "Hold";
                breathText.className = "text-3xl font-bold text-warning mt-6";
                randomQuote();
            }
        }

        updatePhase();
        setInterval(updateCountdown, 1000);
    }

    boxBreathing();
</script>

    <style>
        #lungs {
            transition: transform 5s ease-in-out;
            transform-origin: center;
        }
        
        #countdown {
            font-variant-numeric: tabular-nums;
        }
    </style>
</x-app-layout>