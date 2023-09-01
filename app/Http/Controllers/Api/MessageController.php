<?php

namespace App\Http\Controllers\Api;

use App\Models\Message;
use App\Mail\NewMessage;
use App\Models\Apartment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    private $validations = [
        'name'             => 'required|string|min:5|max:50',
        'last_name'        => 'required|string|max:50',
        'email'            => 'required|email|max:250',
        'message'          => 'required|string',
        'apartment_id'     => 'required|integer|exists:apartments,id',
    ];
    
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, $this->validations);

        if($validator->fails()) {
            return response()->json([
                'success'  => false,
                'errors'   => $validator->errors(),
            ]);
        }

        // salvare i dati del message nel DB

        $newMessage = new Message();
        $newMessage->name           = $data['name'];
        $newMessage->last_name      = $data['last_name'];
        $newMessage->email          = $data['email'];
        $newMessage->message        = $data['message'];
        $newMessage->apartment_id   = $data['apartment_id'];
        $newMessage->save();

        // Ottieni la lista degli appartamenti
        $apartments = Apartment::all();

        // inviare il nuovo messaggio

        Mail::to($newMessage->email)->send(new NewMessage($newMessage));

        // ritornare un valore di successo al frontend

        return response()->json([
            'success' => true,
            'apartments' => $apartments,
        ]);

    }

}
