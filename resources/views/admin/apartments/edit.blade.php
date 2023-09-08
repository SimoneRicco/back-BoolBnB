<x-app-layout>
    <div class="p-4">
        <form method="post" action="{{ route('admin.apartments.update', ['apartment' => $apartment]) }}" enctype="multipart/form-data">
            @csrf
            @method('put')

            <div class="mb-4">
                <label for="title" class="block mb-1 font-semibold dark:text-white">Title</label>
                <input type="text" id="title" name="title" class="w-full px-4 py-2 border rounded @error('title') border-red-500 @enderror" value="{{ old('title', $apartment->title) }}">
                @error('title')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>
            
            <div id="mySearchBox">
                <h1 class="dark:text-white">Address</h1>
            </div>
            <div class="mb-3">
                {{-- <label for="address" class="block text-sm font-medium text-white">Address</label> --}}
                <input type="hidden" class="form-input mt-1 block w-full py-2 px-3 border bg-white rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm @error('address_id') border-red-500 @enderror" id="address" name="address" value="{{ old('address', $apartment->address->address) }}" placeholder="Enter address">
                @error('address')
                <div class="text-red-500 text-xs mt-1">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-3">
                {{-- <label for="latitude" class="block text-sm font-medium text-white">Latitude</label> --}}
                <input type="hidden" class="form-input mt-1 block w-full py-2 px-3 border bg-white rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm @error('latitude_id') border-red-500 @enderror" id="latitude" name="latitude" value="{{ old('latitude', $apartment->address->latitude) }}" placeholder="Enter latitude">
                @error('latitude')
                <div class="text-red-500 text-xs mt-1">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-3">
                {{-- <label for="longitude" class="block text-sm font-medium text-white">Longitude</label> --}}
                <input type="hidden" class="form-input mt-1 block w-full py-2 px-3 border bg-white rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm @error('longitude_id') border-red-500 @enderror" id="longitude" name="longitude" value="{{ old('longitude', $apartment->address->longitude) }}" placeholder="Enter longitude">
                @error('longitude')
                <div class="text-red-500 text-xs mt-1">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div style="display: flex; align-items: center;">
                <input type="file" name="images[]" id="imageInput" multiple class="dark:text-white">
                <button id="clearImages" type="button" style="background-color: white; border: none;">Clear All</button>
            </div>
        
            <div id="imagePreviews" class="mt-3 space-y-3 flex"></div>
        
            <div class="mb-3">
                <label for="existing_images" class="form-label dark:text-white">Existing Images</label>
                <button id="clearImages" type="button" style="background-color: white; border: none;">Clear All</button>
                <div style="display: flex; flex-wrap: wrap;" id="existingImagePreviews">
                    @foreach($images as $image)
                        @if($image->apartment_id == $apartment->id)
                            <div class="col-md-3">
                                <img src="{{ asset('storage/uploads/' . $image->url) }}" alt="{{ $apartment->title }}" class="max-w-xs max-h-32 border border-gray-300 rounded">
                                <div>
                                    <input type="radio" name="cover_image_index" value="{{ $image->id }}" {{ $image->cover_image ? 'checked' : '' }}>
                                    <label for="cover_image_{{ $image->id }}">Set as Cover Image</label>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                
            </div>
            
            <script>
                const imageInput = document.getElementById('imageInput');
                const imagePreviews = document.getElementById('imagePreviews');
            
                imageInput.addEventListener('change', handleImageUpload);
            
                function handleImageUpload(event) {
                    imagePreviews.innerHTML = '';
            
                    const files = event.target.files;
                    for (let i = 0; i < files.length; i++) {
                        const imgPreview = document.createElement('div');
                        imgPreview.classList.add('flex', 'items-center', 'space-x-2', 'relative');
            
                        const imgElement = document.createElement('img');
                        imgElement.src = URL.createObjectURL(files[i]);
                        imgElement.classList.add('max-w-xs', 'max-h-32', 'border', 'border-gray-300', 'rounded');
            
                        const radioInput = document.createElement('input');
                        radioInput.type = 'radio';
                        radioInput.name = 'cover_image_index';
                        radioInput.value = i;
                        radioInput.classList.add('text-blue-600', 'border-gray-300', 'rounded', 'focus:ring-blue-500', 'dark:focus:ring-blue-600', 'dark:ring-offset-gray-700', 'dark:focus:ring-offset-gray-700', 'focus:ring-2', 'dark:bg-gray-600', 'dark:border-gray-500');
            
                        imgPreview.appendChild(imgElement);
                        imgPreview.appendChild(radioInput);
            
                        imagePreviews.appendChild(imgPreview);
                    }
                }
            
                document.getElementById('clearImages').addEventListener('click', resetImageInput);
            
                function resetImageInput() {
                    imageInput.value = null;
                    imagePreviews.innerHTML = '';
                    const radioInputs = document.querySelectorAll('input[name="cover_image_index"]');
                    radioInputs.forEach(input => input.checked = false);
                }
            </script>
            
            

            <div class="flex space-x-4 justify-center">
                <div class="mb-4">
                    <label for="rooms" class="block mb-1 font-semibold dark:text-white">Rooms</label>
                    <select name="rooms" id="rooms" class="w-full px-4 py-2 border rounded @error('rooms') border-red-500 @enderror">
                      @for ($i = 1; $i <= 20; $i++)
                        <option value="{{ $i }}" {{ old('rooms', $apartment->rooms) == $i ? 'selected' : '' }}>{{ $i }}</option>
                      @endfor
                    </select>
                    @error('rooms')
                      <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
    
                <div class="mb-4">
                    <label for="beds" class="block mb-1 font-semibold dark:text-white">Beds</label>
                    <select name="beds" id="beds" class="w-full px-4 py-2 border rounded @error('beds') border-red-500 @enderror">
                      @for ($i = 1; $i <= 20; $i++)
                        <option value="{{ $i }}" {{ old('beds', $apartment->beds) == $i ? 'selected' : '' }}>{{ $i }}</option>
                      @endfor
                    </select>
                    @error('beds')
                      <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
    
                <div class="mb-4">
                    <label for="bathrooms" class="block mb-1 font-semibold dark:text-white">Bathrooms</label>
                    <select name="bathrooms" id="bathrooms" class="w-full px-4 py-2 border rounded @error('bathrooms') border-red-500 @enderror">
                      @for ($i = 1; $i <= 10; $i++)
                        <option value="{{ $i }}" {{ old('bathrooms', $apartment->bathrooms) == $i ? 'selected' : '' }}>{{ $i }}</option>
                      @endfor
                    </select>
                    @error('bathrooms')
                      <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="square_meters" class="block font-semibold dark:text-white">Square Meters</label>
                    <input type="number" name="square_meters" id="square_meters" min="20" max="180" step="10" value="{{ old('square_meters', $apartment->square_meters) }}" class="dark:text-white border-gray-300 rounded-md focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                    @error('square_meters')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block font-semibold dark:text-white">Is Available?</label>
                    <div class="space-y-2">
                        <label class="flex items-center">
                            <input type="radio" name="available" value="1" class="text-blue-600 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" {{ old('available', $apartment->available) == 1 ? 'checked' : '' }}>
                            <span class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Yes</span>
                        </label>
                        <label class="flex items-center">
                            <input type="radio" name="available" value="0" class="text-blue-600 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" {{ old('available', $apartment->available) == 0 ? 'checked' : '' }}>
                            <span class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">No</span>
                        </label>
                    </div>
                    @error('available')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mb-4">
                <h6 class="text-lg font-medium dark:text-white">Utilities</h6>
                <div class=" flex flex-wrap justify-center">
                    @foreach ($utilities as $utility)
                        <div class="flex items-center mb-2">
                            <label class="mr-2 ml-4 dark:text-white" for="utility{{ $utility->id }}">
                                {{ $utility->name }}
                            </label>
                            <input 
                                class="form-checkbox h-5 w-5 text-blue-600" 
                                type="checkbox" 
                                id="utility{{ $utility->id }}" 
                                value="{{ $utility->id }}"
                                name="utilities[]"
                                @if (in_array($utility->id, old('utilities', $apartment->utilities->pluck('id')->all()))) checked @endif 
                            >
                        </div>
                    @endforeach
                    @error('utilities')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>
                
            <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descrizione</label>
            <textarea id="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your description here..." name="description">{{ old('description', $apartment->description) }}</textarea>

<<<<<<< HEAD
            <div class="my-4">
                <button type="submit" class="px-4 py-2 text-white bg-green-700 rounded">Invia</button>
=======

            <div class="mb-4">
                <button type="submit" class="px-4 py-2 text-white bg-green-700 rounded" onclick="disableSubmitButton()">Invia</button>
<<<<<<< HEAD
=======
>>>>>>> origin/fixImagesEdit
>>>>>>> b33d66c51db02dfe78e1e44e3a65ee6a99b62aa0
            </div>
            <script>
                let isSubmitting = false; // Variabile di stato per il controllo dell'invio

                document.querySelector('form').addEventListener('submit', function (e) {
                if (isSubmitting) {
                    e.preventDefault(); // Impedisce l'invio duplicato del modulo
                    return;
                }

                // Imposta lo stato di invio su true per disabilitare il pulsante
                isSubmitting = true;

                // Disabilita il pulsante di invio
                document.getElementById('create-new-apartment').disabled = true;
            });
            // Dopo aver gestito la richiesta di invio del modulo
            // Riabilita il pulsante di invio e reimposta lo stato di invio
            document.getElementById('create-new-apartment').disabled = false;
            isSubmitting = false;

            </script>
            <script>
                var options = {
                    searchOptions: {
                        key: "ndHFeyzbDlb3RqfpAT5GGO7XqIcEf1DC",
                        language: "it-IT",
                        limit: 5,
                    },
                    autocompleteOptions: {
                        key: "ndHFeyzbDlb3RqfpAT5GGO7XqIcEf1DC",
                        language: "it-IT",
                    },
                    labels: {
                        noResultsMessage: 'Nessun risultato trovato.'
                    },
                };
                var ttSearchBox = new tt.plugins.SearchBox(tt.services, options);
                var searchBoxHTML = ttSearchBox.getSearchBoxHTML();
                document.querySelector("#mySearchBox").append(searchBoxHTML);

                const inputBox = searchBoxHTML.firstChild.children[2];
                inputBox.setAttribute('class', "form-input mt-1 block w-full py-2 px-3 border bg-white rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm");
                inputBox.setAttribute('id', "apartment-address");

                // Aggiungi un gestore di eventi per gestire la selezione dell'indirizzo
                ttSearchBox.on('tomtom.searchbox.resultselected', function(event) {
                    const selectedAddress = event.data.result.address.freeformAddress;
                    document.querySelector("#apartment-address").value = selectedAddress;
                    // Assegna automaticamente il valore all'input dell'indirizzo
                    document.querySelector("#address").value = selectedAddress;
                    
                    // Chiamata all'API per ottenere latitudine e longitudine
                    apiCall(selectedAddress);
                });
            </script>
            <script>
                async function apiCall(addr) {
                    try {
                        const response = await fetch(`https://api.tomtom.com/search/2/search/${addr}.json?key=ndHFeyzbDlb3RqfpAT5GGO7XqIcEf1DC`);
                        const data = await response.json();
            
                        if (data.results.length === 0) {
                            alert('Indirizzo non valido');
                        } else {
                            const { lat, lon } = data.results[0].position;
                            document.querySelector("#latitude").value = lat;
                            document.querySelector("#longitude").value = lon;
                        }
                    } catch (error) {
                        console.error("Errore durante la chiamata API:", error);
                    }
                }
            
                const inputAddress = document.querySelector("#apartment-address");
                inputAddress.addEventListener('change', async () => {
                    const address = inputAddress.value;
                    if (address) {
                        await apiCall(address);
                    }
                });
            </script>
        </form>
    </div>
</x-app-layout>