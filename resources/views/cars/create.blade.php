<x-layout>
    <h1 class="text-3xl font-bold mb-6">➕ Add a New Car</h1>

    {{-- Show validation errors --}}
    @if ($errors->any())
        <div class="bg-red-100 text-red-800 px-4 py-2 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form 
        action="{{ route('cars.store') }}" 
        method="POST" 
        enctype="multipart/form-data" 
        class="space-y-4 max-w-lg"
    >
        @csrf

        {{-- Title --}}
        <div>
            <label class="block font-semibold mb-1">Car Title</label>
            <input 
                type="text" 
                name="title" 
                value="{{ old('title') }}" 
                class="border rounded px-3 py-2 w-full"
                required
            >
        </div>

        {{-- Description --}}
        <div>
            <label class="block font-semibold mb-1">Description</label>
            <textarea 
                name="description" 
                rows="4" 
                class="border rounded px-3 py-2 w-full"
                required
            >{{ old('description') }}</textarea>
        </div>

        {{-- Facebook Link --}}
        <div>
            <label class="block font-semibold mb-1">Facebook Marketplace Link</label>
            <input 
                type="url" 
                name="fb_link" 
                value="{{ old('fb_link') }}" 
                class="border rounded px-3 py-2 w-full"
                required
            >
        </div>

        {{-- Image Upload --}}
        <div>
            <label class="block font-semibold mb-1">Car Image</label>
            <input 
                type="file" 
                name="image" 
                class="border rounded px-3 py-2 w-full"
                accept="image/*"
                required
            >
        </div>

        {{-- Submit --}}
        <div class="flex gap-4">
            <button 
                type="submit" 
                class="bg-green-600 text-white px-4 py-2 rounded shadow hover:bg-green-700"
            >
                Save Car
            </button>

            <a 
                href="{{ route('cars.index') }}" 
                class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400"
            >
                Cancel
            </a>
        </div>
    </form>
</x-layout>
