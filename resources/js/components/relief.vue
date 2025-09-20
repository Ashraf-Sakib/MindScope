<template>
  <Layout>
    <div class="max-w-4xl mx-auto text-center space-y-12">
      <h1 class="text-4xl font-bold text-indigo-600">Instant Relief 🌿</h1>

      <!-- Breathing Exercise -->
      <div class="bg-white dark:bg-gray-800 shadow-2xl rounded-2xl p-8 flex flex-col items-center space-y-6">
        <p class="text-xl text-gray-700 dark:text-gray-200 font-semibold">{{ breathText }}</p>
        <div
          :style="{ transform: `scale(${scale})` }"
          class="w-32 h-32 bg-gradient-to-r from-indigo-400 via-purple-400 to-pink-400 rounded-full transition-transform duration-1000"
        ></div>
      </div>

      <!-- Motivational Quotes -->
      <div class="bg-white dark:bg-gray-800 shadow-2xl rounded-2xl p-8">
        <p
          key="quote"
          class="text-lg italic text-gray-700 dark:text-gray-200 transition-opacity duration-1000"
        >
          {{ currentQuote }}
        </p>
      </div>

      <!-- Back Button -->
      <div>
        <a href="/dashboard" class="inline-block mt-6 px-6 py-3 bg-indigo-600 text-white font-semibold rounded-xl shadow-lg hover:bg-indigo-700 transition-all duration-300">
          ← Back to Dashboard
        </a>
      </div>

    </div>
  </Layout>
</template>

<script>
import Layout from './layouts.vue';

export default {
  components: { Layout },
  data() {
    return {
      scale: 1,
      breathText: 'Inhale...',
      quotes: [
        "You are stronger than you think.",
        "One step at a time.",
        "Breathe. Relax. Reset.",
        "Your mind deserves a break.",
        "Calmness is a superpower."
      ],
      currentQuote: "Take a deep breath...",
    };
  },
  mounted() {
    this.startBreathing();
    setInterval(this.changeQuote, 5000);
  },
  methods: {
    startBreathing() {
      const cycle = () => {
        this.breathText = 'Inhale...';
        this.scale = 1.5;
        setTimeout(() => {
          this.breathText = 'Hold...';
          setTimeout(() => {
            this.breathText = 'Exhale...';
            this.scale = 1;
            setTimeout(cycle, 4000);
          }, 4000);
        }, 4000);
      };
      cycle();
    },
    changeQuote() {
      this.currentQuote = this.quotes[Math.floor(Math.random() * this.quotes.length)];
    }
  }
};
</script>
