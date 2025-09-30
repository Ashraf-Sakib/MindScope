<div class="navbar bg-base-100 shadow-lg">
    <!-- Mobile Hamburger (Left Side on Mobile) -->
    <div class="navbar-start">
        <!-- Mobile Dropdown -->
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

    <!-- Desktop Navigation Links (Center) -->
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
        <div class="dropdown dropdown-end">
            <div tabindex="0" role="button" class="btn btn-ghost btn-circle">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />
                </svg>
            </div>
            <div tabindex="0" class="dropdown-content z-[1] card card-compact w-64 p-4 shadow bg-base-100 rounded-box mt-3">
                <div class="card-body">
                    <h3 class="font-bold text-lg">Choose Theme</h3>
                    <div class="form-control">
                        <select id="theme-selector" class="select select-bordered w-full">
                            <option value="light">☀️ Light</option>
                            <option value="dark">🌙 Dark</option>
                            <option value="valentine">💖 Valentine</option>
                            <option value="cupcake">🧁 Cupcake</option>
                            <option value="bumblebee">🐝 Bumblebee</option>
                            <option value="emerald">✨ Emerald</option>
                            <option value="corporate">🏢 Corporate</option>
                            <option value="synthwave">🌆 Synthwave</option>
                            <option value="retro">👾 Retro</option>
                            <option value="cyberpunk">🤖 Cyberpunk</option>
                            <option value="halloween">🎃 Halloween</option>
                            <option value="garden">🌻 Garden</option>
                            <option value="forest">🌲 Forest</option>
                            <option value="aqua">💧 Aqua</option>
                            <option value="lofi">🎵 Lofi</option>
                            <option value="pastel">🎨 Pastel</option>
                            <option value="fantasy">🧚 Fantasy</option>
                            <option value="wireframe">📐 Wireframe</option>
                            <option value="black">⚫ Black</option>
                            <option value="luxury">💎 Luxury</option>
                            <option value="dracula">🧛 Dracula</option>
                            <option value="cmyk">🖨️ CMYK</option>
                            <option value="autumn">🍂 Autumn</option>
                            <option value="business">💼 Business</option>
                            <option value="acid">🧪 Acid</option>
                            <option value="lemonade">🍋 Lemonade</option>
                            <option value="night">🌃 Night</option>
                            <option value="coffee">☕ Coffee</option>
                            <option value="winter">❄️ Winter</option>
                            <option value="dim">🔅 Dim</option>
                            <option value="nord">🗻 Nord</option>
                            <option value="sunset">🌅 Sunset</option>
                        </select>
                    </div>
                    <p class="text-xs opacity-70 mt-2">Theme will be saved automatically</p>
                </div>
            </div>
        </div>
        <div class="dropdown dropdown-end">
            <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar placeholder">
                <div class="bg-primary text-primary-content rounded-full w-10">
                    <span class="text-xl">{{ substr(Auth::user()->name ?? 'G', 0, 1) }}</span>
                </div>
            </div>
            <ul tabindex="0" class="mt-3 z-[1] p-2 shadow menu menu-sm dropdown-content bg-base-100 rounded-box w-52">
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const themeSelector = document.getElementById('theme-selector');
        const savedTheme = localStorage.getItem('theme') || 'light';
        document.documentElement.setAttribute('data-theme', savedTheme);
        themeSelector.value = savedTheme;
        themeSelector.addEventListener('change', function() {
            const selectedTheme = this.value;
            document.documentElement.setAttribute('data-theme', selectedTheme);
            localStorage.setItem('theme', selectedTheme);
        });
    });
</script>