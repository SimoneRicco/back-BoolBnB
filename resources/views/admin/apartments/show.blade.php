<x-app-layout>


    <h1 class=" text-5xl text-center py-2"> {{ $apartment->title }}</h1>
    <p class="text-center py-2"> Dettagli: </p>
    <img src="{{ asset('storage/uploads/' . $apartment->image->url) }}" alt="{{ $apartment->title }}">
    
    {{-- <div class="flex justify-center flex-wrap">
        <img src="{{ asset('storage/uploads' . $project->image1) }}" alt="{{ $project->title }}">
        <div class="flex flex-col mb-5">
            <h1 class="text-white text-center py-2">Video: {{ $project->title }}</h1>
            <video autoplay loop muted class="video h-[40rem]">
                <source 
                    src="{{ asset('storage/uploads' . $project->video) }}"
                    type="video/webm"
                />
            </video>
        </div>
       
    </div> --}}
                       
    
                        
    </x-app-layout>