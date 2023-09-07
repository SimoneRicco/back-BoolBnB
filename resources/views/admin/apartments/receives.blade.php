<x-app-layout>

    {{-- @if (session('delete_success'))
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
    @endif --}}

    <div class="container p-2 mx-auto sm:p-4 dark:text-gray-100">
        <h2 class="mb-4 text-2xl font-semibold leadi">Ricevute</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full text-xs">
                <colgroup>
                    <col>
                    <col>
                    <col>
                    <col>
                    <col class="w-24">
                </colgroup>
                <thead class="dark:bg-gray-700">
                    <tr class="text-left">
                        <th class="p-3 text-blue-600/100">Titolo</th>
                        <th class="p-3 text-blue-600/100">Sponsors</th>
                        <th class="p-3 text-blue-600/100">Data di sottoscrizione</th>
                        <th class="p-3 text-blue-600/100">Data di scadenza</th>
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
                        <td class="p-3">
                            <p>{{ implode(', ', $apartment->sponsors->pluck('type')->all()) }}</p>
                        </td>
                        <td class="p-3">
                            <p>{{ implode(', ', $apartment->sponsors()->pluck('subscription_date')->all()) }}</p>
                        </td>
                        <td class="p-3">
                            <p>{{ implode(', ', $apartment->sponsors()->pluck('expire_date')->all()) }}</p>
                        </td>
                        <td class="p-3">
                            <div class="flex justify-center gap-4">
                                <button class="px-7 py-1 font-semibold border rounded dark:border-gray-100 dark:text-gray-100" onclick="window.location='{{ route('admin.apartments.receive', ['apartment' => $apartment]) }}'">Show</button>
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
