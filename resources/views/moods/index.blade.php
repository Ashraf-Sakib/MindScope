<x-app-layout>
    <section class="max-w-4xl mx-auto px-6 pt-16 pb-12 text-center">
        <div class="mb-8">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">
                Welcome to <span class="text-lavender-600">MindScope</span>
            </h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Track your mood, check in daily, and see your progress over time. Your mental wellness journey starts here.
            </p>
        </div>
    </section>

    <!-- Project Introduction -->
    <section class="max-w-4xl mx-auto px-6 mb-12">
        <div class="bg-gradient-to-br from-pastel-purple to-pastel-blue rounded-3xl p-8 shadow-xl border-2 border-lavender-200">
            <h2 class="text-2xl font-semibold text-gray-800 mb-3">About MindScope</h2>
            <p class="text-gray-700 leading-relaxed">
                MindScope is your personal mood tracking companion. Take a moment each day to reflect on how you're feeling, 
                write about your experiences, and watch patterns emerge over time. Understanding your emotions is the first 
                step toward better mental wellness.
            </p>
        </div>
    </section>

    <!-- Mood Selection Section -->
    <section class="max-w-4xl mx-auto px-6 mb-12">
        <div class="bg-white rounded-3xl p-8 shadow-xl border-2 border-gray-200">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6 text-center">How are you feeling today?</h2>
            
            <!-- Mood Dropdown -->
            <div class="mb-8">
                <label for="mood-select" class="block text-base font-semibold text-gray-800 mb-3">Select your mood</label>
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
                <p class="text-base font-semibold text-gray-800 mb-5 text-center">Or tap a quick mood</p>
                <div class="flex flex-wrap justify-center gap-4">
                    <button type="button" onclick="selectQuickMood('happy')" class="w-24 h-24 rounded-2xl bg-gradient-to-br from-pastel-green to-mint-200 hover:from-mint-200 hover:to-mint-300 flex flex-col items-center justify-center text-4xl transition-all transform hover:scale-110 shadow-lg hover:shadow-xl border-2 border-mint-500 active:scale-95">
                        <span>😊</span>
                        <span class="text-sm mt-1 text-gray-800 font-bold">Happy</span>
                    </button>
                    <button type="button" onclick="selectQuickMood('sad')" class="w-24 h-24 rounded-2xl bg-gradient-to-br from-pastel-blue to-blue-200 hover:from-blue-200 hover:to-blue-300 flex flex-col items-center justify-center text-4xl transition-all transform hover:scale-110 shadow-lg hover:shadow-xl border-2 border-blue-400 active:scale-95">
                        <span>😢</span>
                        <span class="text-sm mt-1 text-gray-800 font-bold">Sad</span>
                    </button>
                    <button type="button" onclick="selectQuickMood('tired')" class="w-24 h-24 rounded-2xl bg-gradient-to-br from-pastel-purple to-lavender-200 hover:from-lavender-200 hover:to-lavender-300 flex flex-col items-center justify-center text-4xl transition-all transform hover:scale-110 shadow-lg hover:shadow-xl border-2 border-lavender-400 active:scale-95">
                        <span>😴</span>
                        <span class="text-sm mt-1 text-gray-800 font-bold">Tired</span>
                    </button>
                    <button type="button" onclick="selectQuickMood('stressed')" class="w-24 h-24 rounded-2xl bg-gradient-to-br from-pastel-red to-red-200 hover:from-red-200 hover:to-red-300 flex flex-col items-center justify-center text-4xl transition-all transform hover:scale-110 shadow-lg hover:shadow-xl border-2 border-red-400 active:scale-95">
                        <span>😰</span>
                        <span class="text-sm mt-1 text-gray-800 font-bold">Stressed</span>
                    </button>
                </div>
            </div>
            <div class="bg-gradient-to-br from-mint-100 to-pastel-green rounded-2xl p-6 border-2 border-mint-300 shadow-md">
                <label for="mood-details" class="block text-lg font-semibold text-gray-800 mb-3">
                    Tell us more about how you're feeling
                </label>
                <textarea placeholder="What's on your mind? Share your thoughts, experiences, or anything you'd like to remember about today..." class="textarea textarea-info w-full h-32 resize-none" id="mood-details" name="mood_details"
                ></textarea>
                <p class="text-sm text-gray-700 font-medium mt-2">This is your safe space. Write as much or as little as you'd like.</p>
            </div>
            <div class="mt-8 text-center">
                <button type="submit" class="btn btn-dash btn-secondary">
                    💾 Save Mood Entry
                </button>
            </div>
        </div>
    </section>

    <!-- Dashboard Link -->
    <section class="max-w-4xl mx-auto px-6 pb-16 text-center">
        <div class="bg-gradient-to-r from-pastel-orange to-pastel-yellow rounded-2xl p-8 border-2 border-orange-300 shadow-lg">
            <h3 class="text-xl font-semibold text-gray-800 mb-3">View Your Progress</h3>
            <p class="text-gray-700 font-medium mb-6">Check your mood history and see patterns emerge over time</p>
            <a href="{{ route('dashboard') }}" class="inline-block bg-mint-600 hover:bg-mint-700 text-white text-lg py-4 px-10 rounded-xl font-bold shadow-lg hover:shadow-xl transition-all transform hover:scale-105 active:scale-95 border-2 border-mint-700">
                📊 Go to Dashboard →
            </a>
        </div>
    </section>
    <script>
        function selectQuickMood(mood) {
            const select = document.getElementById('mood-select');
            select.value = mood;
            
            // Visual feedback
            const event = new Event('change', { bubbles: true });
            select.dispatchEvent(event);
            
            // Scroll to textarea
            document.getElementById('mood-details').scrollIntoView({ 
                behavior: 'smooth', 
                block: 'center' 
            });
            document.getElementById('mood-details').focus();
        }
    </script>
</x-app-layout>