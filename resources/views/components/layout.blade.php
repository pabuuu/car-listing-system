<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME')}}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- AlpineJS -->
    <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body class="bg-gray-50 text-slate-900">
    <header class="bg-slate-800 shadow-lg">
        <nav class="flex items-center justify-between px-6 py-4">
            <!-- Left side -->
            <div class="flex items-center gap-6">
                <a href="{{ route('home') }}" class="nav-link text-xl font-bold text-white">
                    SpeedyDrive Finder
                </a>
                <a href="{{ route('home') }}" class="nav-link text-white">Home</a>
            </div>

            <!-- Right side -->
            <div class="flex items-center gap-4">
                <!-- Magnifying button wrapper -->
                <div class="relative" x-data="{ openSearch: false }">
                    <button @click="openSearch = !openSearch" class="text-white px-2 py-1 hover:bg-slate-700 rounded">
                        <!-- SVG icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M21 21l-4.35-4.35M9 17a8 8 0 100-16 8 8 0 000 16z"/>
                        </svg>
                    </button>

                    <!-- Search form -->
                    <div 
                        x-show="openSearch" 
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 transform -translate-y-2"
                        x-transition:enter-end="opacity-100 transform translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 transform translate-y-0"
                        x-transition:leave-end="opacity-0 transform -translate-y-2"
                        class="absolute right-0 mt-2 w-64 z-50"
                    >
                        <form 
                            action="{{ route('cars.index') }}" 
                            method="GET" 
                            class="flex items-center gap-2 bg-white p-2 rounded shadow-lg"
                        >
                            <input 
                                type="text" 
                                name="search" 
                                placeholder="Search cars..." 
                                value="{{ request('search') }}"
                                class="px-3 py-2 rounded w-full placeholder-gray-400 focus:outline-none"
                                autofocus
                            >
                            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                                Search
                            </button>
                        </form>
                    </div>
                </div>

                @guest
                    <a href="{{ route('login') }}" class="nav-link text-white">Login</a>
                    <a href="{{ route('register') }}" class="nav-link text-white">Register</a>
                @endguest

                @auth
                    <a href="{{ route('account') }}" class="nav-link text-white">Account</a>
                    <a href="{{ route('cars.myListings') }}" class="nav-link text-white">Listings</a>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="nav-link text-white">Logout</button>
                    </form>
                @endauth
            </div>
        </nav>
    </header>

    <main class="py-8 px-4 mx-auto max-w-screen-lg">
        {{ $slot }}
    </main>
</body>
</html>
