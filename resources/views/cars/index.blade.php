<x-layout>
    {{-- Page Title --}}
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold">Used Cars for Sale in the Philippines</h1>
    </div>

    {{-- Flash success message --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- Show cars --}}
    @if($cars->count())
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

                    <a 
                        href="{{ $car->fb_link }}" 
                        target="_blank" 
                        class="text-blue-600 underline hover:text-blue-800"
                    >
                        View on FB Marketplace
                    </a>

                    <p class="text-sm text-gray-500 mt-2">
                        Added by: {{ $car->user->username ?? 'Guest' }}
                    </p>
                </div>
            @endforeach
        </div>
    @else
        <p>No cars found.</p>
    @endif

</x-layout>
