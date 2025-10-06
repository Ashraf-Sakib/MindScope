<div class="navbar bg-base-100 shadow-lg">
    <div class="navbar-start">
        <div class="dropdown">
            <div tabindex="0" role="button" class="btn btn-ghost lg:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" />
                </svg>
            </div>
            <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
                <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li><a href="#">Home</a></li>
                <li><a href="{{ route('profile.edit') }}">Profile</a></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
        
        <!-- Logo -->
        <a href="{{ route('dashboard') }}" class="btn btn-ghost text-xl">
            <span class="font-bold">MindScope</span>
        </a>
    </div>
    <div class="navbar-center hidden lg:flex">
        <ul class="menu menu-horizontal px-1">
            <li>
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    Dashboard
                </a>
            </li>
            <li>
                <a href="#" class="{{ request()->routeIs('index') ? 'active' : '' }}">
                    Home
                </a>
            </li>
        </ul>
    </div>
    <div class="navbar-end gap-2">
        <div class="flex items-center">
            <label for="theme-selector" class="sr-only">Choose Theme</label>
            <select id="theme-selector" class="select select-bordered select-sm w-32">
                <!-- Options will be populated by JavaScript -->
                <option value="light">Light</option>
                <option value="dark">Dark</option>
            </select>
        </div>
        <div class="dropdown dropdown-end">
            <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar placeholder">
                <div class="bg-base-100 text-base-content rounded-full w-10">
                    <span class="text-xl">{{ substr(Auth::user()->name ?? 'G', 0, 1) }}</span>
                </div>
            </div>
            <ul tabindex="0" class="mt-3 z-[1] p-2 shadow menu menu-sm dropdown-content bg-base-100 text-base-content rounded-box w-52">
                <li class="menu-title">
                    <span class="text-base">{{ Auth::user()->name ?? 'Guest' }}</span>
                    <span class="text-xs opacity-60">{{ Auth::user()->email ?? 'Not logged in' }}</span>
                </li>
                <li><a href="{{ route('profile.edit') }}">Profile Settings</a></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>