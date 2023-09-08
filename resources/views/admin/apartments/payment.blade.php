<x-app-layout>

    @if (session('transition_error'))
    @php
        $transition = session('transition_error')
    @endphp
    <div class="bg-red-500 text-white p-4">
        Your transition failed!!! ({{$transition}})
   </div>   
    @endif


    <p class="dark:text-white">Card number to use: 4111111111111111</p>
    <p>{{ $apartment->id }}</p>
    <form action="{{ route('admin.apartments.checkout', ['apartment' => $apartment]) }}" method="post" id="braintree-form">
        @csrf
        @method("POST")
        {{-- @dd($token) --}}
        
        {{-- <p>{{ $apartment->sponsors }}</p> --}}
        @foreach ($sponsors as $item)
            @if ($loop->first)
                <div class="flex items-center mb-4">
                    <input id="default-radio-{{$item->id}}" type="radio" value="{{$item->id}}" name="sponsor-plan" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" checked> 
                    <label for="default-radio-{{$item->id}}" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{$item->type}} ({{$item->price}}$)</label>
                </div>
            @else
                <div class="flex items-center mb-4">
                    <input id="default-radio-{{$item->id}}" type="radio" value="{{$item->id}}" name="sponsor-plan" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" > 
                    <label for="default-radio-{{$item->id}}" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{$item->type}} ({{$item->price}}$)</label>
                </div>
            @endif
        @endforeach
        <div id="dropin-container"></div>
        <input type="button" id="submit-button" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded" value="Buy">
        <input type="hidden" id="payload-nonce" name="payment_method_nonce">
    </form>
    <script>
    // var dropin = require('braintree-web-drop-in');
    const button = document.querySelector('#submit-button');
    const input = document.querySelector('#payload-nonce'); 
    const form = document.querySelector('#braintree-form'); 

    const auth_token = "{{ $token }}";

    braintree.dropin.create({
        authorization: auth_token,
        container: '#dropin-container'
    }, function (createErr, instance) {
      button.addEventListener('click', function () {
        // console.log('qui')
        instance.requestPaymentMethod(function (requestPaymentMethodErr, payload) {
            // Submit payload.nonce to your server
            //console.log(payload.nonce)
            input.value = payload.nonce;
            form.submit();
        });
      });
    });
  </script>
</x-app-layout>
