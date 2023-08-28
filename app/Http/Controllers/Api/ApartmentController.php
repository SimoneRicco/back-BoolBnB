<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    public function index()
    {
        $apartments = Apartment::paginate(5);
        return response()->json($apartments);
    }

    public function show($slug)
    {
        $apartment = Apartment::with('image', 'address', 'sponsor', 'utilities')->where('slug', $slug)->firstOrFail();
        return response()->json([
            'results'   => $apartment,
        ]);
    }
}
