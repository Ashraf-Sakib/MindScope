<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-base-content leading-tight">
            📔 Personal Journal
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Card -->
            <div class="card bg-gradient-to-r from-primary to-secondary text-primary-content shadow-xl mb-6">
                <div class="card-body">
                    <h2 class="card-title text-2xl">Welcome to Your Journal, {{ Auth::user()->name }}!</h2>
                    <p class="opacity-90">Capture your thoughts, reflect on your day, and track your personal growth journey.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Journal Entry Form -->
                <div class="lg:col-span-2">
                    <div class="card bg-base-100 shadow-xl">
                        <div class="card-body">
                            <h3 class="card-title text-xl mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                                New Journal Entry
                            </h3>

                            <form method="POST" action="{{ route('journal.store') }}" class="space-y-4">
                                @csrf

                                <!-- Title -->
                                <div class="form-control">
                                    <label for="title" class="label">
                                        <span class="label-text font-medium">Entry Title</span>
                                        <span class="label-text-alt text-xs opacity-60">Optional</span>
                                    </label>
                                    <input 
                                        type="text" 
                                        id="title"
                                        name="title"
                                        placeholder="Give your entry a title..." 
                                        class="input input-bordered w-full"
                                        value="{{ old('title') }}"
                                    />
                                    @error('title')
                                        <label class="label">
                                            <span class="label-text-alt text-error">{{ $message }}</span>
                                        </label>
                                    @enderror
                                </div>

                                <!-- Content -->
                                <div class="form-control">
                                    <label for="content" class="label">
                                        <span class="label-text font-medium">What's on your mind?</span>
                                        <span class="label-text-alt text-xs opacity-60" id="char-count">0 / 5000</span>
                                    </label>
                                    <textarea 
                                        id="content"
                                        name="content"
                                        class="textarea textarea-bordered h-48 w-full" 
                                        placeholder="Write your thoughts, feelings, experiences, or reflections here..."
                                        maxlength="5000"
                                        required
                                    >{{ old('content') }}</textarea>
                                    @error('content')
                                        <label class="label">
                                            <span class="label-text-alt text-error">{{ $message }}</span>
                                        </label>
                                    @enderror
                                </div>

                                <!-- Tags -->
                                <div class="form-control">
                                    <label for="tags" class="label">
                                        <span class="label-text font-medium">Tags</span>
                                        <span class="label-text-alt text-xs opacity-60">Separate with commas</span>
                                    </label>
                                    <input 
                                        type="text" 
                                        id="tags"
                                        name="tags"
                                        placeholder="e.g., gratitude, goals, reflection" 
                                        class="input input-bordered w-full"
                                        value="{{ old('tags') }}"
                                    />
                                </div>

                                <!-- Mood Selection -->
                                <div class="form-control">
                                    <label class="label">
                                        <span class="label-text font-medium">How are you feeling?</span>
                                    </label>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach(['😊 Happy', '😔 Sad', '😰 Anxious', '😌 Calm', '😤 Frustrated', '🥰 Grateful', '😴 Tired', '🔥 Energetic'] as $mood)
                                            <label class="cursor-pointer">
                                                <input type="radio" name="mood" value="{{ $mood }}" class="radio radio-sm radio-primary hidden peer" />
                                                <span class="btn btn-sm btn-outline peer-checked:btn-primary">{{ $mood }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Privacy Toggle -->
                                <div class="form-control">
                                    <label class="label cursor-pointer justify-start gap-3">
                                        <input type="checkbox" name="is_private" class="toggle toggle-primary" checked />
                                        <span class="label-text">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                            </svg>
                                            Keep this entry private
                                        </span>
                                    </label>
                                </div>

                                <!-- Submit Button -->
                                <div class="card-actions justify-end pt-4">
                                    <button type="submit" class="btn btn-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Save Entry
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Journal Stats -->
                    <div class="card bg-base-100 shadow-xl">
                        <div class="card-body">
                            <h3 class="card-title text-lg">Your Journal Stats</h3>
                            <div class="stats stats-vertical shadow">
                                <div class="stat">
                                    <div class="stat-figure text-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                        </svg>
                                    </div>
                                    <div class="stat-title">Total Entries</div>
                                    <div class="stat-value text-primary">{{ $totalEntries ?? 0 }}</div>
                                </div>
                                
                                <div class="stat">
                                    <div class="stat-figure text-secondary">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                        </svg>
                                    </div>
                                    <div class="stat-title">Current Streak</div>
                                    <div class="stat-value text-secondary">{{ $streak ?? 0 }}</div>
                                    <div class="stat-desc">days in a row</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Writing Prompts -->
                    <div class="card bg-base-100 shadow-xl">
                        <div class="card-body">
                            <h3 class="card-title text-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                                </svg>
                                Writing Prompts
                            </h3>
                            <ul class="space-y-2 text-sm">
                                <li class="flex items-start gap-2">
                                    <span class="text-primary">•</span>
                                    <span>What made you smile today?</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="text-primary">•</span>
                                    <span>What challenge did you overcome?</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="text-primary">•</span>
                                    <span>What are you grateful for right now?</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="text-primary">•</span>
                                    <span>What did you learn about yourself?</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="text-primary">•</span>
                                    <span>What are you looking forward to?</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Quick Tips -->
                    <div class="alert alert-info">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-current shrink-0 w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div>
                            <h4 class="font-bold">Journaling Tip</h4>
                            <p class="text-xs">Write freely without judging yourself. Your journal is a safe space for honest self-expression.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Entries -->
            <div class="mt-8">
                <div class="card bg-base-100 shadow-xl">
                    <div class="card-body">
                        <h3 class="card-title text-xl mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Recent Entries
                        </h3>

                        @forelse($entries ?? [] as $entry)
                            <div class="card bg-base-200 shadow mb-4">
                                <div class="card-body">
                                    <div class="flex justify-between items-start">
                                        <div class="flex-1">
                                            @if($entry->title)
                                                <h4 class="font-semibold text-lg">{{ $entry->title }}</h4>
                                            @endif
                                            <p class="text-sm opacity-60 mb-2">
                                                {{ $entry->created_at->format('F j, Y • g:i A') }}
                                                @if($entry->mood)
                                                    <span class="ml-2">{{ $entry->mood }}</span>
                                                @endif
                                            </p>
                                            <p class="line-clamp-3">{{ Str::limit($entry->content, 200) }}</p>
                                            @if($entry->tags)
                                                <div class="flex flex-wrap gap-2 mt-2">
                                                    @foreach(explode(',', $entry->tags) as $tag)
                                                        <span class="badge badge-sm badge-outline">{{ trim($tag) }}</span>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                        <div class="dropdown dropdown-end">
                                            <label tabindex="0" class="btn btn-ghost btn-sm btn-circle">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                                </svg>
                                            </label>
                                            <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
                                                <li><a href="{{ route('journal.show', $entry->id) }}">View Full Entry</a></li>
                                                <li><a href="{{ route('journal.edit', $entry->id) }}">Edit</a></li>
                                                <li>
                                                    <form method="POST" action="{{ route('journal.destroy', $entry->id) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-error" onclick="return confirm('Are you sure you want to delete this entry?')">Delete</button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-12">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto opacity-30 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                                <p class="text-lg opacity-60">No journal entries yet.</p>
                                <p class="text-sm opacity-40 mt-2">Start writing your first entry above!</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Character counter
        const textarea = document.getElementById('content');
        const charCount = document.getElementById('char-count');
        
        if (textarea && charCount) {
            textarea.addEventListener('input', function() {
                const count = this.value.length;
                charCount.textContent = `${count} / 5000`;
                
                if (count > 4500) {
                    charCount.classList.add('text-warning');
                } else {
                    charCount.classList.remove('text-warning');
                }
            });
        }
    </script>
</x-app-layout>