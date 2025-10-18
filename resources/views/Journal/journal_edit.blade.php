<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-base-content leading-tight">
            ✏️ Edit Journal Entry
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="card bg-base-100 shadow-xl">
                <div class="card-body">
                    <h3 class="card-title text-xl mb-4">Edit Your Journal Entry</h3>

                    <form method="POST" action="{{ route('journal.update', $journal->id) }}" class="space-y-4">
                        @csrf
                        @method('PATCH') {{-- Important for update --}}

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
                                value="{{ old('title', $journal->title) }}"
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
                            >{{ old('content', $journal->content) }}</textarea>
                            @error('content')
                                <label class="label">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </label>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="card-actions justify-end pt-4">
                            <button type="submit" class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Update Entry
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const textarea = document.getElementById('content');
        const charCount = document.getElementById('char-count');
        
        if (textarea && charCount) {
            const updateCount = () => {
                const count = textarea.value.length;
                charCount.textContent = `${count} / 5000`;
                if (count > 4500) charCount.classList.add('text-warning');
                else charCount.classList.remove('text-warning');
            };
            textarea.addEventListener('input', updateCount);
            updateCount(); // initialize count
        }
    </script>
</x-app-layout>
