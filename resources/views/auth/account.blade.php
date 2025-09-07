<x-layout>
    <h1 class="text-xl mb-4">My Account</h1>

    @if(session('success'))
        <p class="text-green-500 mb-4">{{ session('success') }}</p>
    @endif

    <form action="{{ route('account.update') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label for="username">Username</label>
            <input type="text" name="username" value="{{ old('username', $user->username) }}"
                   class="border p-2 w-full @error('username') border-red-500 @enderror">
            @error('username')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password">New Password (leave blank to keep current)</label>
            <input type="password" name="password"
                   class="border p-2 w-full @error('password') border-red-500 @enderror">
            @error('password')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password_confirmation">Confirm New Password</label>
            <input type="password" name="password_confirmation" class="border p-2 w-full">
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2">Update</button>
    </form>
</x-layout>
