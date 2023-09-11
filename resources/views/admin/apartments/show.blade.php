<x-app-layout>

    <h1 class="dark:text-white text-5xl text-center py-2"> {{ $apartment->title }}</h1>
    {{-- <p class="text-center py-2"> {{ $apartment->description }} </p> --}}
    <div class="container mx-auto">
        <div class="bg-red-100 border-l-4 border-red-500 p-4 my-4">
            <p class="text-red-700 text-2xl font-semibold">
                "{{ $apartment->description }}"
            </p>
            <p class="text-gray-600 mt-2">
                - {{ $apartment->user->name }}
            </p>
        </div>
    </div>
    <div class="container mx-auto">
        <ul class="list-disc list-inside">
            <li class="text-lg text-blue-600">Stanze: {{ $apartment->rooms }}</li>
            <li class="text-lg text-blue-600">Letti: {{ $apartment->beds }}</li>
            <li class="text-lg text-blue-600">Bagni: {{ $apartment->bathrooms }}</li>
            <li class="text-lg text-blue-600">Metri quadrati: {{ $apartment->square_meters }}</li>
        </ul>
    </div>
    <p class="dark:text-white text-center text-2xl">Immagini</p>
   <div class="grid grid-cols-2 gap-4">
    @foreach ($apartment->image as $image)
        <div class="bg-gray-100 p-4">
            <img src="{{ asset('storage/uploads/' . $image->url) }}" alt="{{ $apartment->title }}" class="max-w-full h-auto">
        </div>
    @endforeach
</div>

    
</x-app-layout>