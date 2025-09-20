<template>
  <div class="min-h-screen flex flex-col bg-gray-50 dark:bg-gray-900">
    <header class="bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 text-white shadow-md p-6 flex justify-between items-center">
      <h1 class="text-2xl font-bold">Mindscope</h1>
      <nav>
        <a href="/dashboard" class="mr-4 hover:underline">Dashboard</a>
        <a href="/relief" class="hover:underline">Instant Relief</a>
      </nav>
    </header>

    <!-- Main content -->
    <main class="flex-1 p-6">
      <slot />
    </main>

    <!-- Footer -->
    <footer class="bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-400 text-center py-4">
      &copy; {{ new Date().getFullYear() }} Mindscope
    </footer>
  </div>
</template>

<script>
export default {
  name: "Layout",
};
</script>
