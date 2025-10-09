<section class="space-y-6">
  <header class="text-center">
    <h2 class="text-2xl font-semibold text-primary">
      Profile Information
    </h2>
    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400 max-w-2xl mx-auto">
      Update your account’s profile details and email address.
    </p>
  </header>
  <form id="send-verification" method="post" action="{{ route('verification.send') }}">
    @csrf
  </form>
  <form method="post" action="{{ route('profile-info-update') }}" class="mt-6 max-w-xl mx-auto space-y-5">
    @csrf
    @method('patch')

    <!-- Name -->
    <div class="form-control">
      <label for="name" class="label">
        <span class="label-text font-medium">Name</span>
      </label>
      <div class="relative">
        <input
          id="name"
          name="name"
          type="text"
          class="input input-bordered w-full pr-10"
          value="{{ old('name', auth()->user()->name) }}"
          required
          autocomplete="name"
          placeholder="Enter your full name"
        />
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute right-3 top-3 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A4 4 0 018 16h8a4 4 0 012.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
        </svg>
      </div>
      <x-input-error class="mt-2 text-error" :messages="$errors->get('name')" />
    </div>
    <div class="form-control">
      <label for="email" class="label">
        <span class="label-text font-medium">Email</span>
      </label>
      <div class="relative">
        <input
          id="email"
          name="email"
          type="email"
          class="input input-bordered w-full pr-10"
          value="{{ old('email', auth()->user()->email) }}"
          required
          autocomplete="username"
          placeholder="Enter your email address"
        />
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute right-3 top-3 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12H8m8 0H8m0 0v6m8-6V6m0 0H8" />
        </svg>
      </div>
      <x-input-error class="mt-2 text-error" :messages="$errors->get('email')" />
      @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! auth()->user()->hasVerifiedEmail())
        <div class="mt-3 bg-base-200 p-3 rounded-lg">
          <p class="text-sm text-gray-700 dark:text-gray-200">
            Your email address is <span class="font-semibold text-error">unverified</span>.
            <button
              form="send-verification"
              class="ml-1 text-sm text-primary hover:underline focus:outline-none"
            >
              Click here to resend verification email.
            </button>
          </p>

          @if (session('status') === 'verification-link-sent')
            <p class="mt-2 text-success text-sm font-medium">
              A new verification link has been sent to your email.
            </p>
          @endif
        </div>
      @endif
    </div>
    <div class="flex items-center justify-end gap-3 pt-4">
      <button type="submit" class="btn btn-primary">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        </svg>
        Save Changes
      </button>

      @if (session('status') === 'profile-updated')
        <p
          x-data="{ show: true }"
          x-show="show"
          x-transition
          x-init="setTimeout(() => show = false, 2000)"
          class="text-sm text-success font-medium"
        >
          ✓ Profile Updated
        </p>
      @endif
    </div>
  </form>
</section>
