<x-guest-layout>
    
    <div class="w-full max-w-6xl bg-base-100 shadow-2xl rounded-3xl overflow-hidden grid grid-cols-1 md:grid-cols-2">
    <div class="hidden md:block">
        <img 
            src="{{ asset('images/Login.png') }}" 
            alt="MindScope Illustration"
            class="w-full h-full object-cover"
        >
    </div>
     <div class="flex flex-col justify-center items-center p-10 bg-base-200">
            
            <h2 class="text-2xl font-Montserrat font-semibold mb-6">Login</h2>

            <form method="POST" action="{{ route('login') }}" class="w-full max-w-sm space-y-4">
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
                <div>
                    <label class="label font-medium">Password</label>
                    <input type="password" 
                        name="password" 
                        placeholder="Enter your password" 
                        class="input input-bordered w-full" 
                        required autocomplete="current-password">
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-error" />
                </div>
                <label class="label cursor-pointer flex items-center gap-2">
                    <input type="checkbox" name="remember" class="checkbox checkbox-primary" />
                    <span class="label-text">Remember me</span>
                </label>
                <div class="flex justify-between items-center">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="link link-hover text-sm text-primary">
                            Forgot password?
                        </a>
                    @endif
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
            </form>
        </div>
</div>

</x-guest-layout>