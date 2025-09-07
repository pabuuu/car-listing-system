<x-layout>
    <div class="max-w-xl mx-auto bg-white shadow-lg rounded-lg p-6">
        <h1 class="text-2xl font-bold mb-6 text-center">Edit Car Listing</h1>

        {{-- Flash success message --}}
        @if(session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('cars.update', $car) }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-4">
            @csrf
            @method('PUT')

            {{-- Title --}}
            <div>
                <label for="title" class="block font-semibold mb-1">Title</label>
                <input type="text" name="title" id="title" value="{{ old('title', $car->title) }}"
                       class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:ring-blue-400">
                @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Description --}}
            <div>
                <label for="description" class="block font-semibold mb-1">Description</label>
                <textarea name="description" id="description" rows="4"
                          class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:ring-blue-400">{{ old('description', $car->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- FB Link --}}
            <div>
                <label for="fb_link" class="block font-semibold mb-1">Facebook Marketplace Link</label>
                <input type="url" name="fb_link" id="fb_link" value="{{ old('fb_link', $car->fb_link) }}"
                       class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:ring-blue-400">
                @error('fb_link')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Current Image --}}
            @if($car->image_path)
                <div class="flex flex-col items-center">
                    <p class="mb-2 font-semibold">Current Image</p>
                    <img src="{{ asset('storage/' . $car->image_path) }}" alt="{{ $car->title }}" class="mb-2 w-full max-h-48 object-contain rounded">
                </div>
            @endif

            {{-- Image Upload --}}
            <div>
                <label for="image" class="block font-semibold mb-1">Replace Image (optional)</label>
                <input type="file" name="image" id="image" class="w-full">
                @error('image')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Submit --}}
            <div class="flex justify-between mt-4">
                <a href="{{ route('cars.myListings') }}" class="px-4 py-2 bg-gray-400 text-white rounded hover:bg-gray-500 transition">
                    Cancel
                </a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                    Update Car
                </button>
            </div>
        </form>
    </div>
</x-layout>
