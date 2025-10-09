<section class="space-y-6">
  <header class="text-center">
    <h2 class="text-2xl font-semibold text-primary">
      Update Password
    </h2>
    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400 max-w-2xl mx-auto">
      Ensure your account is protected by using a strong and unique password.
    </p>
  </header>

  <form method="post" action="{{ route('password.update') }}" class="mt-6 max-w-xl mx-auto space-y-5">
    @csrf
    @method('put')

    <!-- Current Password -->
    <div class="form-control">
      <label for="current_password" class="label">
        <span class="label-text font-medium">Current Password</span>
      </label>
      <div class="relative">
        <input 
          id="current_password" 
          name="current_password" 
          type="password"
          placeholder="Enter your current password" 
          class="input input-bordered w-full pr-10"
          autocomplete="current-password"
        />
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute right-3 top-3 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 .6-.4 1-1 1s-1-.4-1-1 .4-1 1-1 1 .4 1 1zm-1 4h.01M12 3a9 9 0 11-9 9 9 9 0 019-9z"/>
        </svg>
      </div>
      <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2 text-error" />
    </div>

    <!-- New Password -->
    <div class="form-control">
      <label for="password" class="label">
        <span class="label-text font-medium">New Password</span>
      </label>
      <div class="relative">
        <input 
          id="password" 
          name="password" 
          type="password"
          placeholder="Enter your new password" 
          class="input input-bordered w-full pr-10"
          autocomplete="new-password"
        />
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute right-3 top-3 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 .6-.4 1-1 1s-1-.4-1-1 .4-1 1-1 1 .4 1 1zm-1 4h.01M12 3a9 9 0 11-9 9 9 9 0 019-9z"/>
        </svg>
      </div>
      <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 text-error" />
    </div>

    <!-- Confirm Password -->
    <div class="form-control">
      <label for="password_confirmation" class="label">
        <span class="label-text font-medium">Confirm Password</span>
      </label>
      <div class="relative">
        <input 
          id="password_confirmation" 
          name="password_confirmation" 
          type="password"
          placeholder="Re-enter your new password"
          class="input input-bordered w-full pr-10"
          autocomplete="new-password"
        />
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute right-3 top-3 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 .6-.4 1-1 1s-1-.4-1-1 .4-1 1-1 1 .4 1 1zm-1 4h.01M12 3a9 9 0 11-9 9 9 9 0 019-9z"/>
        </svg>
      </div>
      <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2 text-error" />
    </div>

    <!-- Save Button -->
    <div class="flex items-center justify-end gap-3 pt-4">
      <button type="submit" class="btn btn-primary">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        </svg>
        Save Changes
      </button>

      @if (session('status') === 'password-updated')
        <p
          x-data="{ show: true }"
          x-show="show"
          x-transition
          x-init="setTimeout(() => show = false, 2000)"
          class="text-sm text-success font-medium"
        >
          ✓ Password Updated
        </p>
      @endif
    </div>
  </form>
</section>
