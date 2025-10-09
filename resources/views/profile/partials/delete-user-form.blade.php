<section class="space-y-6">
  <header class="text-center">
    <h2 class="text-2xl font-semibold text-error">
      Delete Account
    </h2>
    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400 max-w-2xl mx-auto">
      Once your account is deleted, all your data and resources will be permanently removed. 
      Please make sure to download any data you want to keep before continuing.
    </p>
  </header>

  <!-- Delete Button -->
  <div class="text-center">
    <button 
      class="btn btn-error btn-wide mt-4"
      x-data
      x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
        viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M6 18L18 6M6 6l12 12" />
      </svg>
      Delete Account
    </button>
  </div>

  <!-- Modal -->
  <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
    <form method="post" action="#" class="p-6 space-y-5">
      @csrf
      @method('delete')

      <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-error" fill="none"
          viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M13 16h-1v-4h-1m1-4h.01M12 20h.01M9 20h6a2 2 0 002-2V6a2 2 0 00-2-2H9a2 2 0 00-2 2v12a2 2 0 002 2z" />
        </svg>
        Confirm Account Deletion
      </h3>

      <p class="text-sm text-gray-600 dark:text-gray-400">
        This action <span class="font-semibold text-error">cannot be undone</span>. 
        Please enter your password to confirm.
      </p>

      <div class="form-control">
        <label for="password" class="label">
          <span class="label-text">Password</span>
        </label>
        <input
          id="password"
          name="password"
          type="password"
          placeholder="Enter your password"
          class="input input-bordered w-full"
        />
        <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2 text-error" />
      </div>

      <div class="flex justify-end gap-3 mt-6">
        <button 
          type="button" 
          class="btn btn-outline"
          x-on:click="$dispatch('close')">
          Cancel
        </button>

        <button type="submit" class="btn btn-error">
          Delete Account
        </button>
      </div>
    </form>
  </x-modal>
</section>
