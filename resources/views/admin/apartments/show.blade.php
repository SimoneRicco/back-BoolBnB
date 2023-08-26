<x-app-layout>


    <h1 class=" text-5xl text-center py-2"> {{ $apartment->title }}</h1>
    <p class="text-center py-2"> Dettagli: </p>
    
    @foreach ($apartment->image as $image)
        <img src="{{ asset('storage/uploads/' . $image->url) }}" alt="{{ $apartment->title }}">
    @endforeach

    
    
</x-app-layout>