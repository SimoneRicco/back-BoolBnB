<x-app-layout>

    @if (session('delete_success'))
    @php $apartment = session('delete_success') @endphp
        <div class="bg-red-500 text-white p-4">
            The apartment "{{ $apartment->title }}" has been Deleted
        </div>
    @endif

    @if (session('restore_success'))
    @php $apartment = session('restore_success') @endphp
        <div class="bg-green-500 text-white p-4">
            The apartment "{{ $apartment->title }}" has been Restored
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
                        <th class="p-3 hidden md:table-cell text-blue-600/100">Sponsors</th>
                        <th class="p-3 text-center text-blue-600/100">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($trashedApartments as $apartment)
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
                        <td class="p-3 hidden md:table-cell">
                            {{ implode(', ', $apartment->utilities->pluck('name')->all()) }}
                        </td>
                        <td class="p-3 hidden md:table-cell">
                            <p>{{ implode(', ', $apartment->sponsors->pluck('type')->all()) }}</p>
                        </td>
                        <td class="p-3">
                            <div style="display: flex; gap: 10px;">
                                <form class="d-inline-block" method="POST" action="{{ route('admin.apartments.restore', ['apartment' => $apartment]) }}">
                                    @csrf
                                    <button class="px-7 py-1 font-semibold border rounded dark:border-gray-100 dark:text-gray-100">Restore</button>
                                </form>
                                <button type="button" class="btn btn-danger js-delete" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{ $apartment->slug }}">
                                    
                                </button>
                                <form action="{{ route('admin.apartments.harddelete', ['apartment' => $apartment]) }}" method="POST" class="d-inline-block">
                                    @csrf
                                    @method('delete')
                                    <button class="px-7 py-1 font-semibold border rounded dark:border-gray-100 dark:text-gray-100">Delete</button>
                                </form>
                                
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    
                    
                </tbody>
            </table>
        </div>
    </div>
    <div class="container mx-auto mt-4">
        {{-- {{ $projects->links('vendor.pagination.tailwind') }} --}}
        {!! $trashedApartments->appends(Request::except('page'))->render() !!}
    </div>
</x-app-layout>