<x-app-layout>

    @if (session('delete_success'))
    @php
        $apartment = session('delete_success')
    @endphp
    <div class="bg-red-500 text-white p-4">
        "{{ $apartment->title }}" has been moved to the trash!!
        <form action="{{ route('admin.apartments.cancel', ['apartment' => $apartment]) }}" method="post">
            @csrf
            <button class="bg-yellow-500 text-white px-4 py-2 rounded">Cancel</button>
        </form>
    </div>
    @endif

    <div class="container p-2 mx-auto sm:p-4 dark:text-gray-100">
        <h2 class="mb-4 text-2xl font-semibold leadi">Appartamenti</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full text-xs">
                <colgroup>
                    <col>
                    <col class="hidden md:table-cell">
                    <col class="hidden md:table-cell">
                    <col class="hidden md:table-cell">
                    <col class="hidden md:table-cell">
                    <col class="w-24">
                </colgroup>
                <thead class="dark:bg-gray-700">
                    <tr class="text-left">
                        <th class="p-3 text-blue-600/100">Titolo</th>
                        <th class="p-3 hidden md:table-cell text-blue-600/100">Camere</th>
                        <th class="p-3 hidden md:table-cell text-blue-600/100">Letti</th>
                        <th class="p-3 hidden md:table-cell text-blue-600/100">Bagni</th>
                        <th class="p-3 hidden md:table-cell text-blue-600/100">Metri quadrati</th>
                        <th class="p-3 hidden md:table-cell text-blue-600/100">Indirizzo</th>
                        <th class="p-3 hidden md:table-cell text-blue-600/100">Utilities</th>   
                        <th class="p-3 text-center text-blue-600/100">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($apartments->sortByDesc('created_at') as $apartment)
                      @if ($apartment->user_id === auth()->id())
                        <tr class="border-b border-opacity-20 dark:border-gray-700 dark:bg-gray-900">
                        <td class="p-3">
                            <p>{{ $apartment->title }}</p>
                        </td>
                        <td class="p-3 hidden md:table-cell">
                            <p>{{ $apartment->rooms }}</p>
                        </td>
                        <td class="p-3 hidden md:table-cell">
                            <p>{{ $apartment->beds }}</p>
                        </td>
                        <td class="p-3 hidden md:table-cell">
                            <p>{{ $apartment->bathrooms }}</p>
                        </td>
                        <td class="p-3 hidden md:table-cell">
                            <p>{{ $apartment->square_meters }}</p>
                        </td>
                        
                        <td class="p-3 hidden md:table-cell">
                            <p>{{ $apartment->address->address }}</p>
                        </td>

                        {{-- <td class="p-3 hidden md:table-cell">
                            {{ implode(', ', $apartment->utilities->pluck('name')->all()) }}
                        </td> --}}

                        <td class="p-3 hidden md:table-cell">
                            <ul class="divide-y list-none">
                                @foreach ($apartment->utilities as $utility)
                                    <li>{{ $utility->name }}</li>
                                @endforeach
                            </ul>
                        </td>
                        
                        {{-- <td class="p-3">
                            {{ implode(', ', $apartment->sponsors->pluck('type')->all()) }}
                        </td> --}}
                        <td class="p-3">
                            <div class="flex flex-col space-y-2 sm:flex-row sm:justify-center sm:space-x-4 sm:space-y-0">
                                <button class="px-7 py-1 font-semibold border rounded dark:border-gray-100 dark:text-gray-100" onclick="window.location='{{ route('admin.apartments.payment', ['apartment' => $apartment]) }}'">Sponsorize</button>
                                <button class="px-7 py-1 font-semibold border rounded dark:border-gray-100 dark:text-gray-100" onclick="window.location='{{ route('admin.apartments.show', ['apartment' => $apartment]) }}'">Info</button>
                                <button class="px-7 py-1 font-semibold border rounded dark:border-gray-100 dark:text-gray-100" onclick="window.location='{{ route('admin.apartments.edit', ['apartment' => $apartment]) }}'">Edit</button>
                                <form class="d-inline-block" method="POST" action="{{ route('admin.apartments.destroy', ['apartment' => $apartment]) }}">
                                    @csrf
                                    @method('delete')
                                    <button class="px-7 py-1 font-semibold border rounded dark:border-gray-100 dark:text-gray-100" onclick="window.location='{{ route('admin.apartments.destroy', ['apartment' => $apartment]) }}'">Delete</button>
                                </form>
                            </div>
                        </td>
                        
                    </tr>
                    @endif
                    @endforeach
                    
                    
                </tbody>
            </table>
        </div>
    </div>
    <div class="container mx-auto mt-4">
        {{-- {{ $projects->links('vendor.pagination.tailwind') }} --}}
        {!! $apartments->appends(Request::except('page'))->render() !!}
    </div>
</x-app-layout>