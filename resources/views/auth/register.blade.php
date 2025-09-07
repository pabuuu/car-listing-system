
<x-layout>
    <h1 class="title">Register a new account</h1>

    <div class="mx-auto max-w-screen-sm card">

        <form action="{{route('register')}}" method="post">
            @csrf

            {{-- Username --}}
            <div class="mb-8">
                <label for="username">Username</label>
                <input 
                    type="text" 
                    name="username" 
                    value="{{ old('username') }}"
                    class="input @error('username') input-error @enderror"
                >
                @error('username')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Email --}}
            <div class="mb-8">
                <label for="email">Email</label>
                <input 
                    type="text" 
                    name="email" 
                    value="{{ old('email') }}"
                    class="input @error('email') input-error @enderror"
                >
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password --}}
            <div class="mb-8">
                <label for="password">Password</label>
                <input 
                    type="password" 
                    name="password" 
                    class="input @error('password') input-error @enderror"
                >
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Confirm Password --}}
            <div class="mb-8">
                <label for="password_confirmation">Confirm password</label>
                <input 
                    type="password" 
                    name="password_confirmation" 
                    class="input @error('password_confirmation') input-error @enderror"
                >
                @error('password_confirmation')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Submit Button --}}
            <button class="btn">Register</button>
        </form>

        

    </div>
</x-layout>
