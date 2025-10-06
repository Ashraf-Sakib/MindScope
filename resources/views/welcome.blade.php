<x-app-layout>
    <section class="min-h-screen flex flex-col items-center justify-center bg-base-200 text-base-content px-6 text-center">
       <div class="max-w-2xl space-y-6">
            <h1 class="text-5xl font-extrabold text-primary">
                🌿 Welcome to <span class="text-accent">MindScope</span>
            </h1>
            <p class="text-lg text-base-content/70 leading-relaxed">
                A peaceful space to reflect on your emotions, track your moods, 
                and find balance in your mental well-being 💫
            </p>
            <div class="mt-8 flex justify-center">
                <img 
                    src="{{ asset('images/Pagol.png') }}" 
                    alt="MindScope illustration"
                    class="max-w-xs md:max-w-md rounded-2xl "
                />
            </div>
            <p class="italic text-base-content/60 text-lg mt-8">
                “Your emotions are messages — not instructions. Listen, understand, and grow.” 🌙
            </p>
            <div class="flex justify-center gap-4 mt-10">
                @auth
                    <a href="{{ route('dashboard') }}" class="btn btn-primary btn-wide">
                        Go to Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary btn-wide">
                        Get Started
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-outline btn-accent btn-wide">
                        Join Now
                    </a>
                @endauth
            </div>
        </div>
    </section>
</x-app-layout>
