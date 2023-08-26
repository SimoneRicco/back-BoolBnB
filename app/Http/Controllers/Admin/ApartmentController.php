<?php

namespace App\Http\Controllers\Admin;

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
        'title'              => 'required|string|max:50',
        'address_id'         => 'integer|exists:address,id',
        'user_id'            => 'required|integer|exists:users,id',
        'rooms'              => 'required|integer',
        'beds'               => 'required|integer',
        'bathrooms'          => 'required|integer',
        'square_meters'      => 'required|string|in:20,30,40,50,60,70,80,90,100,110,120,130,140,150,160,170,180',
        'available'          => 'required|boolean',
        'utilities'          => 'nullable|array',
        'utilities. *'       => 'integer|exists:utilities,id',
        'sponsors'           => 'nullable',
        'sponsors. *'        => 'integer|exists:sponsors,id',

    ];

    private $validations_messages = [
        'required'      => 'il campo :attribute è obbligatorio',
        'max'           => 'il campo :attribute deve avere almeno :max caratteri',
        'exists'        => 'Valore non valido',
    ];

    public function index()
    {
        $apartments = Apartment::paginate(5);
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

        // Salvare i dati nel database
        $newApartment = new apartment();
        $newApartment->title            = $data['title'];
        $newApartment->slug             = apartment::slugger($data['title']);
        // if ($request->has('image_id')) {
        //     $imagePath = Storage::put('uploads', $data['image_id']);
        //     $newApartment->image_id          = $imagePath;
        // }
        $newApartment->address_id       = $data['address_id'];
        $newApartment->user_id          = $data['user_id'];
        $newApartment->rooms            = $data['rooms'];
        $newApartment->beds             = $data['beds'];
        $newApartment->bathrooms        = $data['bathrooms'];
        $newApartment->square_meters    = $data['square_meters'];
        $newApartment->available        = $data['available'];
        $newApartment->save();

        $newApartment->utilities()->sync($data['utilities'] ?? []);
        $newApartment->sponsors()->sync($data['sponsors'] ?? []);

        return redirect()->route('admin.apartments.show', ['apartment' => $newApartment]);
    }


    public function show($slug)
    {
        $apartment = Apartment::where('slug', $slug)->firstOrFail();
        return view('admin.apartments.show', compact('apartment'));
    }


    public function edit($slug)
    {
        $apartment = Apartment::where('slug', $slug)->firstOrFail();
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

        // if ($request->has('image_id')) {
        //     $imagePath = Storage::disk('public')->put('uploads', $data['image_id']);
        //     if ($apartment->image_id) {
        //         Storage::delete($apartment->image_id);
        //     }
        //     $apartment->image_id = $imagePath;
        // }
        
        $apartment->title            = $data['title'];
        $apartment->address_id       = $data['address_id'];
        $apartment->user_id          = $data['user_id'];
        $apartment->rooms            = $data['rooms'];
        $apartment->beds             = $data['beds'];
        $apartment->bathrooms        = $data['bathrooms'];
        $apartment->square_meters    = $data['square_meters'];
        $apartment->available        = $data['available'];
        $apartment->update();

        $apartment->utilities()->sync($data['utilities'] ?? []);
        $apartment->sponsors()->sync($data['sponsors'] ?? []);

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
        $apartment->sponsors()->detach();
        $apartment->forceDelete();
        return to_route('admin.apartments.trashed')->with('delete_success', $apartment);
    }
}
