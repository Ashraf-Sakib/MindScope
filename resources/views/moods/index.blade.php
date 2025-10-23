<x-app-layout>
    <section class="max-w-4xl mx-auto px-6 pt-16 pb-12 text-center">
        <div class="mb-8">
            <h1 class="text-4xl md:text-5xl font-bold text-base-content mb-4">
                Welcome to <span class="text-primary">MindPulse</span>
            </h1>
            <p class="text-lg text-base-content/70 max-w-2xl mx-auto">
                Track your mood, check in daily, and see your progress over time. Your mental wellness journey starts here.
            </p>
        </div>
    </section>
    <section class="max-w-4xl mx-auto px-6 mb-12">
        <div class="bg-base-100 text-base-content rounded-3xl p-8 shadow-xl border-2 border-primary">
            <h2 class="text-2xl font-semibold text-base-content mb-3">About MindPulse</h2>
            <p class="text-base-content/70 leading-relaxed">
                <i><b>MindPulse</b> is your personal mood tracking companion. Take a moment each day to reflect on how you're feeling, 
                write about your experiences, and watch patterns emerge over time. Understanding your emotions is the first 
                step toward better mental wellness.</i>
            </p>
        </div>
    </section>
    <section class="max-w-4xl mx-auto px-6 mb-12">
        <form action="{{ route('moods.store') }}" method="POST" class="bg-base-100 rounded-3xl p-8 shadow-xl border-2 border-base-200">
            @csrf
            <h2 class="text-2xl font-semibold text-base-content mb-6 text-center">How are you feeling today?</h2>

            <!-- Mood Dropdown -->
            <div class="mb-8">
                <label for="mood-select" class="block text-base font-semibold text-base-content mb-3">Select your mood</label>
                <select id="mood-select" class="select select-accent" name="mood" required>
                    <option  selected disabled>Choose a mood...</option>
                    <option value="happy">😊 Happy</option>
                    <option value="sad">😢 Sad</option>
                    <option value="tired">😴 Tired</option>
                    <option value="stressed">😰 Stressed</option>
                    <option value="excited">🎉 Excited</option>
                    <option value="anxious">😟 Anxious</option>
                    <option value="calm">😌 Calm</option>
                    <option value="angry">😠 Angry</option>
                </select>
            </div>
            <div class="mb-8">
                <p class="text-base font-semibold text-base-content mb-5 text-center">Or tap a quick mood</p>
                <div class="flex flex-wrap justify-center gap-4">
                    <button type="button" onclick="selectQuickMood('happy')" class="w-24 h-24 rounded-2xl bg-success/20 hover:bg-success/40 flex flex-col items-center justify-center text-4xl transition-all transform hover:scale-110 shadow-lg hover:shadow-xl border-2 border-success active:scale-95">
                        <span>😊</span>
                        <span class="text-sm mt-1 text-base-content font-bold">Happy</span>
                    </button>
                    <button type="button" onclick="selectQuickMood('sad')" class="w-24 h-24 rounded-2xl bg-info/20 hover:bg-info/40 flex flex-col items-center justify-center text-4xl transition-all transform hover:scale-110 shadow-lg hover:shadow-xl border-2 border-info active:scale-95">
                        <span>😢</span>
                        <span class="text-sm mt-1 text-base-content font-bold">Sad</span>
                    </button>
                    <button type="button" onclick="selectQuickMood('tired')" class="w-24 h-24 rounded-2xl bg-primary/20 hover:bg-primary/40 flex flex-col items-center justify-center text-4xl transition-all transform hover:scale-110 shadow-lg hover:shadow-xl border-2 border-primary active:scale-95">
                        <span>😴</span>
                        <span class="text-sm mt-1 text-base-content font-bold">Tired</span>
                    </button>
                    <button type="button" onclick="selectQuickMood('stressed')" class="w-24 h-24 rounded-2xl bg-error/20 hover:bg-error/40 flex flex-col items-center justify-center text-4xl transition-all transform hover:scale-110 shadow-lg hover:shadow-xl border-2 border-error active:scale-95">
                        <span>😰</span>
                        <span class="text-sm mt-1 text-base-content font-bold">Stressed</span>
                    </button>
                </div>
            </div>
            <div class="bg-base-200 rounded-2xl p-6 border-2 border-base-300 shadow-md">
                <label for="mood-details" class="block text-lg font-semibold text-base-content mb-3">
                    Tell us more about how you're feeling
                </label>
                <textarea placeholder="What's on your mind? Share your thoughts, experiences, or anything you'd like to remember about today..." class="textarea textarea-info w-full h-32 resize-none" id="mood-details" name="note"
                ></textarea>
                <p class="text-sm text-base-content font-medium mt-2">This is your safe space. Write as much or as little as you'd like.</p>
            </div>
            <div class="mt-8 text-center">
                <button type="submit" class="btn btn-outline btn-wide rounded-xl mt-4">
                     Save Mood Entry
                </button>
            </div>
        </form>
    </section>

    <!-- Dashboard Link -->
    <section class="max-w-4xl mx-auto px-6 pb-16 text-center">
        <div class="bg-base-100 rounded-2xl p-8 border-2 border-warning shadow-lg">
            <h3 class="text-xl font-semibold text-base-content mb-3">View Your Progress</h3>
            <p class="text-base-content font-medium mb-6">Check your mood history and see patterns emerge over time</p>
            <div class="text-center">
                <a href="{{ route('dashboard') }}" 
                   class="btn btn-outline btn-wide rounded-xl mt-4">
                    ← Back to MindInsight
                </a>
            </div>
        </div>
    </section>
</x-app-layout>