<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use App\Models\View;
use App\Models\Image;
use App\Models\Address;
use App\Models\Sponsor;
use App\Models\Utility;
use App\Models\Apartment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ApartmentController extends Controller
{
    private $validations = [
        'title'             => 'required|string|max:50',
        'address'           => 'required|string',
        'latitude'          => 'required|numeric',
        'longitude'         => 'required|numeric',
        'images.*'          => 'required|image|mimes:jpeg,png,jpg,gif|max:10240',
        'cover_image_index' => 'required|integer',
        'rooms'             => 'required|integer',
        'beds'              => 'required|integer',
        'bathrooms'         => 'required|integer',
        'square_meters'     => 'required|in:20,30,40,50,60,70,80,90,100,110,120,130,140,150,160,170,180',
        'available'         => 'required|boolean',
        'sponsor_id'        => 'required|integer|exists:sponsors,id',
        'utilities'         => 'nullable|array',
        'utilities.*'       => 'integer|exists:utilities,id',
    ];

    private $validations_messages = [
        'required'                      => 'Il campo :attribute è obbligatorio.',
        'max'                           => 'Il campo :attribute deve avere al massimo :max caratteri.',
        'exists'                        => 'Valore non valido.',
    ];

    public function index()
{
    $apartments = Apartment::where('user_id', auth()->id())
        ->orderByDesc('created_at')
        ->paginate(5);

    return view('admin.apartments.index', compact('apartments'));
}


    public function create()
    {
        $utilities = Utility::all();
        $images = Image::all();
        $addresses = Address::all();
        $views = View::all();
        $sponsors = Sponsor::all();
        return view('Admin.apartments.create', compact('utilities', 'images', 'addresses', 'views', 'sponsors'));
    }


    public function store(Request $request)
    {
        $request->validate($this->validations, $this->validations_messages);
        $data = $request->all();
        $coverImageIndex = $request->input('cover_image_index', -1);

        // Salvare i dati nel database per gli apartment
        $newApartment = new apartment();
        $newApartment->title            = $data['title'];
        $newApartment->user_id          = auth()->user()->id;
        $newApartment->sponsor_id       = $data['sponsor_id'];
        $newApartment->slug             = apartment::slugger($data['title']);
        $newApartment->rooms            = $data['rooms'];
        $newApartment->beds             = $data['beds'];
        $newApartment->bathrooms        = $data['bathrooms'];
        $newApartment->square_meters    = $data['square_meters'];
        $newApartment->available        = $data['available'];
        $newApartment->save();

        $newApartment->utilities()->sync($data['utilities'] ?? []);

        // istanza per gli address

        $address = new Address();
        $address->address            = $data['address'];
        $address->latitude           = $data['latitude'];
        $address->longitude          = $data['longitude'];

        $address->apartment()->associate($newApartment);
        $address->save();

        // istanza per le image

        foreach ($request->file('images') as $index => $imageFile) {
            $newImage = new Image();
            $newImage->name = $imageFile->getClientOriginalName();

            // Imposta il valore di 'cover_image' in base all'indice selezionato
            $newImage->cover_image = $index === (int)$coverImageIndex;

            // Esegui la logica per salvare l'immagine e associarla all'appartamento
            $newImage->apartment()->associate($newApartment);

            // Salva fisicamente l'immagine nel percorso desiderato
            $imagePath = $newImage->id . '_' . $imageFile->getClientOriginalName();
            $imageFile->storeAs('uploads', $imagePath); // Rimuovi 'uploads/' dal percorso

            // Assegna l'URL dell'immagine (senza il percorso completo)
            $newImage->url = $imagePath;

            $newImage->save();

            // Se questa immagine è selezionata come immagine di copertina, aggiorna tutte le altre immagini
            if ($newImage->cover_image) {
                Image::where('apartment_id', $newApartment->id)
                    ->where('id', '!=', $newImage->id)
                    ->update(['cover_image' => false]);
            }
        }



        return redirect()->route('admin.apartments.show', ['apartment' => $newApartment]);
    }


    public function show($slug)
    {
        $apartment = Apartment::where('slug', $slug)->firstOrFail();
        return view('admin.apartments.show', compact('apartment'));
    }


    public function edit($slug)
    {
        $apartment = Apartment::where('slug', $slug)
        ->where('user_id', auth()->id()) // Aggiungi questa condizione
        ->first();

        if (!$apartment) {
            abort(403, 'Unauthorized'); // L'utente non ha il permesso di modificare questo appartamento
        }
        
        $utilities = Utility::all();
        $images = Image::all();
        $addresses = Address::all();
        $views = View::all();
        $sponsors = Sponsor::all();
        return view('admin.apartments.edit', compact('apartment', 'utilities', 'images', 'addresses', 'views', 'sponsors'));
    }


    public function update(Request $request, $slug)
    {
        $apartment = Apartment::where('slug', $slug)->firstOrFail();
        $request->validate($this->validations, $this->validations_messages);
        $data = $request->all();
        $coverImageIndex = $request->input('cover_image_index', -1);

        $apartment->title            = $data['title'];
        $apartment->user_id          = auth()->user()->id;
        $apartment->sponsor_id       = $data['sponsor_id'];
        $apartment->rooms            = $data['rooms'];
        $apartment->beds             = $data['beds'];
        $apartment->bathrooms        = $data['bathrooms'];
        $apartment->square_meters    = $data['square_meters'];
        $apartment->available        = $data['available'];
        $apartment->update();

        $apartment->utilities()->sync($data['utilities'] ?? []);

        $newAddress = new Address();
        $newAddress->address            = $data['address'];
        $newAddress->latitude           = $data['latitude'];
        $newAddress->longitude          = $data['longitude'];

        $newAddress->apartment()->associate($apartment);
        $newAddress->save();

        foreach ($request->file('images') as $index => $imageFile) {
            $newImage = new Image();
            $newImage->name = $imageFile->getClientOriginalName();
        
            // Imposta il valore di 'cover_image' in base all'indice selezionato
            $newImage->cover_image = $index === (int)$coverImageIndex;
        
            // Esegui la logica per salvare l'immagine e associarla all'appartamento
            $newImage->apartment()->associate($apartment); // Utilizza $apartment invece di $newApartment
        
            // Salva fisicamente l'immagine nel percorso desiderato
            $imagePath = $newImage->id . '_' . $imageFile->getClientOriginalName();
            $imageFile->storeAs('uploads', $imagePath); // Rimuovi 'uploads/' dal percorso
        
            // Assegna l'URL dell'immagine (senza il percorso completo)
            $newImage->url = $imagePath;
        
            $newImage->save();
        
            // Se questa immagine è selezionata come immagine di copertina, aggiorna tutte le altre immagini
            if ($newImage->cover_image) {
                Image::where('apartment_id', $apartment->id) // Utilizza $apartment->id invece di $newApartment->id
                    ->where('id', '!=', $newImage->id)
                    ->update(['cover_image' => false]);
            }
        }

        return redirect()->route('admin.apartments.show', ['apartment' => $apartment]);
    }


    public function destroy($slug)
    {
        $apartment = Apartment::where('slug', $slug)->firstOrFail();

        $apartment->delete();

        return to_route('admin.apartments.index')->with('delete_success', $apartment);
    }

    public function restore($slug)
    {
        $apartment = Apartment::find($slug);
        Apartment::withTrashed()->where('slug', $slug)->restore();
        $apartment = Apartment::where('slug', $slug)->firstOrFail();



        return to_route('admin.apartments.trashed')->with('restore_success', $apartment);
    }

    public function cancel($slug)
    {
        $apartment = Apartment::find($slug);
        Apartment::withTrashed()->where('slug', $slug)->restore();
        $apartment = Apartment::where('slug', $slug)->firstOrFail();



        return to_route('admin.apartments.index')->with('cancel_success', $apartment);
    }

    public function trashed()
    {
        $trashedApartments = Apartment::onlyTrashed()->paginate(5);

        return view('admin.apartments.trashed', compact('trashedApartments'));
    }

    public function harddelete($slug)
    {
        $apartment = Apartment::withTrashed()->where('slug', $slug)->first();

        if ($apartment->file) {
            Storage::delete($apartment->file);
        }
        // se ho il trashed lo inserisco nel harddelete

        $apartment->utilities()->detach();
        $apartment->forceDelete();
        return to_route('admin.apartments.trashed')->with('delete_success', $apartment);
    }
}
