<?php

namespace App\Http\Controllers\Admin;

use Braintree\Gateway;
use App\Models\Sponsor;
use App\Models\Apartment;
use Illuminate\Http\Request;
use Psy\Readline\Hoa\Console;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class BraintreeController extends Controller
{
    public function token(Request $request)
    {
        $apartment = Apartment::where('slug', $request->all())->firstOrFail();
        $sponsors = Sponsor::all();
        // dd($apartment);

        $gateway = new Gateway([
            'environment' => env('BRAINTREE_ENVIRONMENT'),
            'merchantId' => env("BRAINTREE_MERCHANT_ID"),
            'publicKey' => env("BRAINTREE_PUBLIC_KEY"),
            'privateKey' => env("BRAINTREE_PRIVATE_KEY")
        ]);
        $clientToken = $gateway->clientToken()->generate();
        return view('admin.apartments.payment', compact('apartment', 'sponsors'), ['token' => $clientToken]);
    }

    public function pay(Request $request)
    {
        $gateway = new Gateway([
            'environment' => env('BRAINTREE_ENVIRONMENT'),
            'merchantId' => env("BRAINTREE_MERCHANT_ID"),
            'publicKey' => env("BRAINTREE_PUBLIC_KEY"),
            'privateKey' => env("BRAINTREE_PRIVATE_KEY")
        ]);
        // dd($data);
        $nonceFromTheClient  = $request['payment_method_nonce'];
        $sponsor = Sponsor::find($request['sponsor-plan']);
        $apartment = Apartment::where('slug', $request['apartment'])->firstOrFail();

        $result = $gateway->transaction()->sale([
            'amount' => $sponsor->price,
            // 'amount' => 2500,
            'paymentMethodNonce' => $nonceFromTheClient,
            // 'deviceData' => $deviceDataFromTheClient,
            'options' => [
                'submitForSettlement' => True
            ]
        ]);
        // dd($result);
        if ($result->success) {
            if ($apartment->sponsors()->where('valid', true)->count() > 0) {

                $apartment->sponsors()->where('valid', true)->update([
                    'expire_date' => DB::raw('DATE_ADD(expire_date, INTERVAL ' . $sponsor->duration . ' DAY)'),
                ]);
            } else { //se non esise una sponsorizzazione attiva
                $apartment->sponsors()->attach($sponsor->id, [
                    'subscription_date' => now(), // Imposta la data corrente
                    'expire_date' => (now()->addDays($sponsor->duration)),
                ]);
            }
            return to_route('admin.apartments.payment')->with('transition_success', $result);
        } else {
            return redirect()->route('admin.apartments.payment')->with('transition_error', $result->message);
        }
    }
}
