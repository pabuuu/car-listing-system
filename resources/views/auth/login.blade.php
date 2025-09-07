<x-layout>
    <h1 class="title mb-6">Login</h1>

    <form action="{{ route('login') }}" method="POST" class="max-w-md mx-auto">
        @csrf

        {{-- Email --}}
        <div class="mb-6">
            <label for="email">Email</label>
            <input 
                type="text" 
                name="email" 
                value="{{ old('email') }}"
                class="input @error('email') border-red-500 ring-red-500 @enderror"
            >
            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Password --}}
        <div class="mb-6">
            <label for="password">Password</label>
            <input 
                type="password" 
                name="password" 
                class="input @error('password') border-red-500 ring-red-500 @enderror"
            >
            @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Remember Me --}}
        <div class="mb-6 flex items-center">
            <input type="checkbox" name="remember" id="remember" class="mr-2">
            <label for="remember">Remember me</label>
        </div>

        {{-- Submit --}}
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Login
        </button>
    </form>
</x-layout>
