<x-guest-layout>
    <div class="w-full max-w-6xl bg-base-100 shadow-2xl rounded-3xl overflow-hidden grid grid-cols-1 md:grid-cols-2">
        <div class="hidden md:block">
            <img 
                src="{{ asset('images/reset_pass.png') }}" 
                alt="MindScope Password Reset"
                class="w-full h-full object-cover"
            >
        </div>
        <div class="flex flex-col justify-center items-center p-10 bg-base-200">
            <h2 class="text-3xl font-bold mb-6 text-primary">Reset Password</h2>

            <form method="POST" action="{{ route('password.store') }}" class="w-full max-w-sm space-y-4">
                @csrf
               <input type="hidden" name="token" value="{{ request()->token ?? $request->route('token') }}">

                <div>
                    <label class="label font-medium">Email</label>
                    <input type="email" 
                        name="email" 
                        placeholder="Enter your email" 
                        value="{{ old('email', $request->email) }}" 
                        class="input input-bordered w-full" 
                        required autofocus>
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-error" />
                </div>
                <div>
                    <label class="label font-medium">New Password</label>
                    <input type="password" 
                        name="password" 
                        placeholder="Enter new password" 
                        class="input input-bordered w-full" 
                        required autocomplete="new-password">
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-error" />
                </div>
                <div>
                    <label class="label font-medium">Confirm Password</label>
                    <input type="password" 
                        name="password_confirmation" 
                        placeholder="Confirm new password" 
                        class="input input-bordered w-full" 
                        required autocomplete="new-password">
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-sm text-error" />
                </div>
                <div class="flex justify-end mt-6">
                    <button type="submit" class="btn btn-primary btn-wide">
                        Reset Password
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
