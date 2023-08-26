{{-- <x-app-layout>
    <div class="p-4">
        <form action="{{ route('admin.projects.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="title" class="block mb-1 font-semibold text-white">Title</label>
                <input type="text" id="title" name="title" class="w-full px-4 py-2 border rounded @error('title') border-red-500 @enderror" value="{{ old('title') }}">
                @error('title')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="author" class="block mb-1 font-semibold text-white">Author</label>
                <input type="text" id="author" name="user_id" class="w-full px-4 py-2 border rounded @error('user_id') border-red-500 @enderror" value="{{ old('user_id') }}">
                @error('user_id')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex px-2">

                <div class="flex items-center mb-3 px-1">
                    <label for="image1" class="px-4 py-2 bg-gray-200 rounded-l">Upload Image 1</label>
                    <input type="file" class="hidden @error('image1') is-invalid @enderror" id="image1" name="image1">
                    <label for="image1" class="px-4 py-2 text-white bg-blue-500 rounded-r cursor-pointer hover:bg-blue-600">
                        Select File
                    </label>
                </div>
                <div class="invalid-feedback">
                    @error('image1') {{ $message }} @enderror
                </div>

                <div class="flex items-center mb-3 px-1">
                    <label for="image2" class="px-4 py-2 bg-gray-200 rounded-l">Upload Image 2</label>
                    <input type="file" class="hidden @error('image2') is-invalid @enderror" id="image2" name="image2">
                    <label for="image2" class="px-4 py-2 text-white bg-blue-500 rounded-r cursor-pointer hover:bg-blue-600">
                        Select File
                    </label>
                </div>
                <div class="invalid-feedback">
                    @error('image2') {{ $message }} @enderror
                </div>

                <div class="flex items-center mb-3 px-1">
                    <label for="image3" class="px-4 py-2 bg-gray-200 rounded-l">Upload Image 3</label>
                    <input type="file" class="hidden @error('image3') is-invalid @enderror" id="image3" name="image3">
                    <label for="image3" class="px-4 py-2 text-white bg-blue-500 rounded-r cursor-pointer hover:bg-blue-600">
                        Select File
                    </label>
                </div>
                <div class="invalid-feedback">
                    @error('image3') {{ $message }} @enderror
                </div>

                <div class="flex items-center mb-3 px-1">
                    <label for="image4" class="px-4 py-2 bg-gray-200 rounded-l">Upload Image 4</label>
                    <input type="file" class="hidden @error('image4') is-invalid @enderror" id="image4" name="image4">
                    <label for="image4" class="px-4 py-2 text-white bg-blue-500 rounded-r cursor-pointer hover:bg-blue-600">
                        Select File
                    </label>
                </div>
                <div class="invalid-feedback">
                    @error('image4') {{ $message }} @enderror
                </div>

                <div class="flex items-center mb-3 px-1">
                    <label for="image5" class="px-4 py-2 bg-gray-200 rounded-l">Upload Image 5</label>
                    <input type="file" class="hidden @error('image5') is-invalid @enderror" id="image5" name="image5">
                    <label for="image5" class="px-4 py-2 text-white bg-blue-500 rounded-r cursor-pointer hover:bg-blue-600">
                        Select File
                    </label>
                </div>
                <div class="invalid-feedback">
                    @error('image5') {{ $message }} @enderror
                </div>

            </div>

            <div class="px-3">
                <div class="flex items-center mb-3">
                    <label for="video" class="px-4 py-2 bg-gray-200 rounded-l">Upload Video</label>
                    <input type="file" class="hidden @error('video') is-invalid @enderror" id="video" name="video">
                    <label for="video" class="px-4 py-2 text-white bg-blue-500 rounded-r cursor-pointer hover:bg-blue-600">
                        Select File
                    </label>
                </div>
                <div class="invalid-feedback">
                    @error('video') {{ $message }} @enderror
                </div>
            </div>

            <div class="mb-4">
                <label for="creation_date" class="block mb-1 font-semibold text-white">Creation Date</label>
                <input type="date" id="creation_date" name="creation_date" class="w-full px-4 py-2 border rounded @error('creation_date') border-red-500 @enderror" value="{{ old('creation_date') }}">
                @error('creation_date')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="last_update" class="block mb-1 font-semibold text-white">Last Update</label>
                <input type="date" id="last_update" name="last_update" class="w-full px-4 py-2 border rounded @error('last_update') border-red-500 @enderror" value="{{ old('last_update') }}">
                @error('last_update')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="collaborators" class="block mb-1 font-semibold text-white">Collaborators</label>
                <input type="text" id="collaborators" name="collaborators" class="w-full px-4 py-2 border rounded @error('collaborators') border-red-500 @enderror" value="{{ old('collaborators') }}">
                @error('collaborators')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-3">
                <label for="type" class="block text-sm font-medium text-white">Type</label>
                <select class="form-select mt-1 block w-full py-2 px-3 border  bg-white rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm @error('type_id') border-red-500 @enderror" id="type" name="type_id">
                    <option selected>Change type</option>
                    
                    @foreach ($types as $type)
                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </select>
                @error('type_id')
                <div class="text-red-500 text-xs mt-1">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-4">
                <h6 class="text-lg font-medium text-white">technologies</h6>
                @foreach ($technologies as $technology)
                    <div class="flex items-center mb-2">
                        <input 
                            class="form-checkbox h-5 w-5 text-blue-600" 
                            type="checkbox" 
                            id="technology{{ $technology->id }}" 
                            value="{{ $technology->id }}"
                            name="technologies[]"
                            @if (in_array($technology->id, old('technologies') ?: [])) checked @endif 
                        >
                        <label class="ml-2 text-white" for="technology{{ $technology->id }}">
                            {{ $technology->name }}
                        </label>
                    </div>
                @endforeach
            </div>
            
            <div class="mb-4">
                <label for="link_github" class="block mb-1 font-semibold text-white">Link github</label>
                <input type="text" id="link_github" name="link_github" class="w-full px-4 py-2 border rounded @error('link_github') border-red-500 @enderror" value="{{ old('link_github') }}">
                @error('link_github')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>
    
            <div class="mb-4">
                <label for="description" class="block mb-1 font-semibold text-white">Description</label>
                <textarea id="description" name="description" class="w-full px-4 py-2 border rounded @error('description') border-red-500 @enderror" rows="4" required>{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <button type="submit" class="px-4 py-2 text-white bg-green-700 rounded">Invia</button>
            </div>
        </form>
    </div>
</x-app-layout> --}}