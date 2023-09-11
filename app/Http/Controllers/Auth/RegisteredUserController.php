<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255',],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'birth_date' => ['nullable', 'date'],
            'image'    => ['nullable', 'image', 'max:10240'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $imagePath = null; // Inizializza la variabile per il percorso dell'immagine

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName(); // Ottieni il nome originale del file
            $imagePath = $image->storeAs('uploads', $imageName, 'public'); // Salva il file con il nome originale
        }

        $user = User::create([
            'name' => $request->name,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'birth_date' => $request->birth_date,
            'image' => $imageName, // Salva solo il nome dell'immagine nel database
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
