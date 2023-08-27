<x-app-layout>
    <div class="p-4">
        <form action="{{ route('admin.apartments.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            

            <div class="mb-4">
                <label for="title" class="block mb-1 font-semibold text-white">Title</label>
                <input type="text" id="title" name="title" class="w-full px-4 py-2 border rounded @error('title') border-red-500 @enderror" value="{{ old('title') }}" placeholder="Enter title">
                @error('title')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-3">
                <label for="address" class="block text-sm font-medium text-white">Address</label>
                <input type="text" class="form-input mt-1 block w-full py-2 px-3 border bg-white rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm @error('address_id') border-red-500 @enderror" id="address" name="address" value="{{ old('address') }}" placeholder="Enter address">
                @error('address')
                <div class="text-red-500 text-xs mt-1">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="latitude" class="block text-sm font-medium text-white">Latitude</label>
                <input type="text" class="form-input mt-1 block w-full py-2 px-3 border bg-white rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm @error('latitude_id') border-red-500 @enderror" id="latitude" name="latitude" value="{{ old('latitude') }}" placeholder="Enter latitude">
                @error('latitude')
                <div class="text-red-500 text-xs mt-1">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="longitude" class="block text-sm font-medium text-white">Longitude</label>
                <input type="text" class="form-input mt-1 block w-full py-2 px-3 border bg-white rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm @error('longitude_id') border-red-500 @enderror" id="longitude" name="longitude" value="{{ old('longitude') }}" placeholder="Enter longitude">
                @error('longitude')
                <div class="text-red-500 text-xs mt-1">
                    {{ $message }}
                </div>
                @enderror
            </div>
            
            <input type="file" name="images[]" multiple>
            <div class="mb-3">
                <label class="block font-semibold text-white">Cover Image</label>
                <div class="space-y-2">
                    <label class="flex items-center">
                        <input type="radio" name="cover_image_index" value="-1" class="text-blue-600 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" checked>
                        <span class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">No cover image</span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="cover_image_index" value="0" class="text-blue-600 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                        <span class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Set as cover image</span>
                    </label>
                </div>
                @error('cover_image_index')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="flex space-x-4 justify-center">
                <div class="mb-4">
                    <label for="rooms" class="block mb-1 font-semibold text-white">Rooms</label>
                    <select name="rooms" id="rooms" class="w-full px-4 py-2 border rounded @error('rooms') border-red-500 @enderror">
                      @for ($i = 1; $i <= 20; $i++)
                        <option value="{{ $i }}" {{ old('rooms') == $i ? 'selected' : '' }}>{{ $i }}</option>
                      @endfor
                    </select>
                    @error('rooms')
                      <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
    
                <div class="mb-4">
                    <label for="beds" class="block mb-1 font-semibold text-white">Beds</label>
                    <select name="beds" id="beds" class="w-full px-4 py-2 border rounded @error('beds') border-red-500 @enderror">
                      @for ($i = 1; $i <= 20; $i++)
                        <option value="{{ $i }}" {{ old('beds') == $i ? 'selected' : '' }}>{{ $i }}</option>
                      @endfor
                    </select>
                    @error('beds')
                      <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
    
                <div class="mb-4">
                    <label for="bathrooms" class="block mb-1 font-semibold text-white">Bathrooms</label>
                    <select name="bathrooms" id="bathrooms" class="w-full px-4 py-2 border rounded @error('bathrooms') border-red-500 @enderror">
                      @for ($i = 1; $i <= 10; $i++)
                        <option value="{{ $i }}" {{ old('bathrooms') == $i ? 'selected' : '' }}>{{ $i }}</option>
                      @endfor
                    </select>
                    @error('bathrooms')
                      <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            
            <div class="flex space-x-4 justify-around">

                <div class="mb-4">
                    <label class="block font-semibold text-white">Square Meters</label>
                    <div class="space-y-2">
                        @for ($i = 20; $i <= 180; $i += 10)
                        <label class="flex items-center">
                            <input type="radio" name="square_meters" value="{{ $i }}" class="text-blue-600 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            <span class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $i }}mq</span>
                        </label>
                        @endfor
                    </div>
                    @error('square_meters')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                
                
    
                <div class="mb-4">
                    <label class="block font-semibold text-white">Is Available?</label>
                    <div class="space-y-2">
                      <label class="flex items-center">
                        <input type="radio" name="available" value="1" class="text-blue-600 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                        <span class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Yes</span>
                      </label>
                      <label class="flex items-center">
                        <input type="radio" name="available" value="0" class="text-blue-600 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                        <span class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">No</span>
                      </label>
                    </div>
                    @error('available')
                      <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                  
                  
                  
    
                
                
    
                <div class="mb-4">
                    <h6 class="text-lg font-medium text-white">Sponsors</h6>
                    @foreach ($sponsors as $sponsor)
                        <div class="flex items-center mb-2">
                            <input 
                                class="form-radio h-5 w-5 text-blue-600" 
                                type="radio" 
                                id="sponsor{{ $sponsor->id }}" 
                                value="{{ $sponsor->id }}"
                                name="sponsors"
                                @if (old('sponsors') == $sponsor->id) checked @endif 
                            >
                            <label class="ml-2 text-white" for="sponsor{{ $sponsor->id }}">
                                {{ $sponsor->type }}
                            </label>
                        </div>
                    @endforeach
                    @error('sponsors')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                
                
    
                <div class="mb-4">
                    <h6 class="text-lg font-medium text-white">Utilities</h6>
                    @foreach ($utilities as $utility)
                        <div class="flex items-center mb-2">
                            <input 
                                class="form-checkbox h-5 w-5 text-blue-600" 
                                type="checkbox" 
                                id="utility{{ $utility->id }}" 
                                value="{{ $utility->id }}"
                                name="utilities[]"
                                @if (in_array($utility->id, old('utilities') ?: [])) checked @endif 
                            >
                            <label class="ml-2 text-white" for="utility{{ $utility->id }}">
                                {{ $utility->name }}
                            </label>
                        </div>
                    @endforeach
                    @error('utilities')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

            </div>
            

            <div class="mb-4">
                <button type="submit" class="px-4 py-2 text-white bg-green-700 rounded">Invia</button>
            </div>
        </form>
    </div>
</x-app-layout>