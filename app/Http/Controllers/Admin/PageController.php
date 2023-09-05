<?php

namespace App\Http\Controllers\Admin;

use App\Models\Message;
use App\Models\Apartment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function dashboard()
    {
        // Recupera l'utente loggato
        $user = Auth::user();

        // Recupera tutti gli appartamenti collegati all'utente
        $apartments = $user->apartments;

        // Recupera tutti i messaggi associati agli appartamenti dell'utente
        $messages = Message::whereIn('apartment_id', $apartments->pluck('id'))->get();

        return view('admin..apartments.dashboard', compact('apartments', 'messages'));
    }
}