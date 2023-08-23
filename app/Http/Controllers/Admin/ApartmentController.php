<?php

namespace App\Http\Controllers\Admin;

use App\Models\Utility;
use App\Models\Apartment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ApartmentController extends Controller
{
    
    public function index()
    {
        $apartments = Apartment::paginate(3);
        return view('admin.apartments.index', compact('apartments'));
    }

    
    public function create()
    {
        $utilities = Utility::all();
        return view('Admin.apartments.create', compact('utilities'));
    }

    
    public function store(Request $request)
    {
        // $request->validate($this->validations, $this->validations_messages);
        $data = $request->all();
        
        // Salvare i dati nel database
        $newApartment = new apartment();
        $newApartment->title         = $data['title'];
        $newApartment->slug          = apartment::slugger($data['title']);
        $newApartment->rooms     = $data['rooms'];
        // if ($request->has('img')) {
        //     $imagePath = Storage::put('uploads', $data['img']);
        //     $newApartment->img          = $imagePath;
        // }
        $newApartment->beds    = $data['beds'];
        $newApartment->bathrooms   = $data['bathrooms'];
        $newApartment->square_meters   = $data['square_meters'];
        $newApartment->address        = $data['address'];
        $newApartment->visible      = $data['visible'];
        $newApartment->save();

        $newApartment->utilities()->sync($data['utilities'] ?? []);

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
        return view('admin.apartments.edit', compact('apartment', 'utilities'));
    }

    
    public function update(Request $request, $slug)
    {
        $apartment = Apartment::where('slug', $slug)->firstOrFail();
        // $request->validate($this->validations, $this->validations_messages);
        $data = $request->all();

        // if ($request->has('img')) {
        //     $imagePath = Storage::disk('public')->put('uploads', $data['img']);
        //     if ($apartment->img) {
        //         Storage::delete($apartment->img);
        //     }
        //     $apartment->img = $imagePath;
        // }

        $apartment->title          = $data['title'];
        $apartment->rooms     = $data['rooms'];
        $apartment->beds    = $data['beds'];
        $apartment->bathrooms   = $data['bathrooms'];
        $apartment->square_meters   = $data['square_meters'];
        $apartment->address        = $data['address'];
        $apartment->visible      = $data['visible'];
        $apartment->update();

        $apartment->utilities()->sync($data['utilities'] ?? []);

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
        $trashedApartment = Apartment::onlyTrashed()->paginate(3);

        return view('admin.apartment.trashed', compact('trashedApartment'));
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
