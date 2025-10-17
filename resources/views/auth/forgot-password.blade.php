<x-guest-layout>
    <div class="w-full max-w-6xl bg-base-100 shadow-2xl rounded-3xl overflow-hidden grid grid-cols-1 md:grid-cols-2">
        <div class="hidden md:block">
            <img 
                src="{{ asset('images/forgot-pass.jpg') }}" 
                alt="MindScope Forgot Password"
                class="w-full h-full object-cover"
            >
        </div>
        <div class="flex flex-col justify-center items-center p-10 bg-base-200">
            <h2 class="text-3xl font-bold mb-4 text-primary">Forgot Password?</h2>
            <p class="mb-6 text-sm text-center text-base-content/70">
                No problem. Just enter your email and we'll send you a reset link.
            </p>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}" class="w-full max-w-sm space-y-4">
                @csrf

                <div>
                    <label class="label font-medium">Email</label>
                    <input type="email" 
                        name="email" 
                        placeholder="Enter your email" 
                        value="{{ old('email') }}" 
                        class="input input-bordered w-full" 
                        required autofocus>
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-error" />
                </div>

                <div class="flex justify-end mt-6">
                    <button type="submit" class="btn btn-primary btn-wide">
                        Email Password Reset Link
                    </button>
                </div>

                <div class="text-center mt-4">
                    <a href="{{ route('login') }}" class="text-sm text-primary hover:underline">
                        Back to Login
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>