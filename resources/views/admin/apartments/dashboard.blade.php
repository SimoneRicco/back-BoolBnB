<x-app-layout>
    <x-slot name="header">
        
        <!-- Mostra il messaggio di accesso -->
        <div class="p-6 text-gray-900 dark:text-gray-100 flex">
            <h1 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            BoolMail
            </h1>
            <div class="mx-4 border-r border-gray-400"></div>
            <h3>
                Inbox
            </h3>
        </div>
    </x-slot>

    <div class="p-6 mx-16 flex">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Messaggi Ricevuti</h2>
    </div>

    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @foreach ($messages->sortByDesc('created_at') as $message)
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg m-2">
                <div class="p-6 text-gray-900 dark:text-gray-100">
    
                    <!-- Aggiungi il codice per visualizzare i messaggi qui -->
                    <div class="messages">
                        <div class="card mb-4">
                            <div class="card-body">
                                <h5 class="card-title">Nuovo messaggio di posta da: {{ $message->email }}</h5>
                                <h6 class="card-subtitle mb-2 text-muted">Intestato a: {{ $message->name }} {{ $message->last_name }}</h6>
                                <p class="card-text">In merito a: {{ $message->apartment->title }}</p>
                                <p class="card-text">Messaggio: {{ $message->message }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

            <!-- Aggiungi il paginator di Tailwind CSS -->
            <div class="mt-4">
                {{ $messages->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
