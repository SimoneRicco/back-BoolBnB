<x-app-layout>
    <div class="col-span-1 my-20 mx-auto bg-white" style="width: 500px">
        <h1 class="py-6 border-b-2 text-xl text-gray-600 px-8">Order Checkout</h1>
        <ul class="py-6 border-b space-y-6 px-8">
            <li class="grid grid-cols-6 gap-2 border-b-1">
                {{-- <div class="col-span-1 self-center">
                    <img src="https://bit.ly/3oW8yej" alt="Product" class="rounded w-full">
                </div> --}}
                <div class="flex flex-col col-span-3 pt-2">
                    <span class="text-md font-bold" id="sponsor-type">
                        {{$sponsor->type}}
                    </span>
                </div>
            </li>
        </ul>
        <div class="px-8 border-b">
            <div class="flex justify-between py-4 text-gray-600">
                <span>Order id</span>
                <span class="font-semibold text-pink-500">{{$result->transaction->id}}</span>
            </div>
        </div>
        <div class="font-semibold text-xl px-8 flex justify-between py-8 text-gray-600">
            <span>Total</span>
            <span>{{$result->transaction->amount}}</span>
        </div>
    </div>
    <script>
        // Nel tuo controller o helper
function getColor(id) {
    let myId = parseInt(id);
    console.log(myId);
        switch (myId) {
            case 1:
                console.log(id);
                return 'text-yellow-300';
                break;
            case 2:
                console.log(id);
                return 'text-gray-400';
                break;
            case 3:
                console.log(id);
                return 'text-orange-900';
                break;
            default:
            console.log(id);
                return 'black';
                break;
        }
    }   
        const type = document.getElementById('sponsor-type');
        
        // Ottieni l'ID del sponsor da qualche parte (assicurati di averlo)
        const sponsorId = "{{ $sponsor->id }}";
        
        // Assegna il colore in base all'ID del sponsor
        const sponsorColor = getColor(sponsorId);
        
        // Applica il colore al testo
        type.classList.add(sponsorColor);
    </script>
</x-app-layout>
