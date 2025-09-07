<x-layout>
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold">My Listings</h1>

        <!-- Add Car Button -->
        <a href="{{ route('cars.create') }}" 
           class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
            Add Car
        </a>
    </div>

    @if($cars->isEmpty())
        <p>You don’t have any listings yet.</p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($cars as $car)
                <div class="bg-white shadow-lg rounded-lg p-4 flex flex-col items-center text-center
                            transform transition duration-300 hover:-translate-y-2 hover:shadow-2xl">
                    
                    {{-- Image first --}}
                    @if($car->image_path)
                        <img src="{{ asset('storage/' . $car->image_path) }}" 
                             alt="{{ $car->title }}" 
                             class="mb-4 rounded-lg w-full max-h-48 object-contain">
                    @endif

                    <h2 class="font-bold text-xl mb-2">{{ $car->title }}</h2>

                    <p class="mb-2">{{ Str::limit($car->description, 100) }}</p>

                    <a href="{{ $car->fb_link }}" target="_blank" 
                       class="text-blue-600 underline hover:text-blue-800 mb-2">
                        View on Facebook
                    </a>

                    <p class="text-sm text-gray-500 mb-4">
                        Added by: {{ $car->user->username ?? 'Guest' }}
                    </p>

                    <div class="flex gap-2">
                        <a href="{{ route('cars.edit', $car) }}" 
                           class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition">
                            Edit
                        </a>
                        <form action="{{ route('cars.destroy', $car) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 transition">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</x-layout>
