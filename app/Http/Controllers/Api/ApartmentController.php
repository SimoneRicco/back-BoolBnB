<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

class ApartmentController extends Controller
{
    public function index(Request $request)
    {
        $user_id = $request->query('user_id');
        $address_id = $request->query('address_id');
        $rooms = $request->query('rooms');
        $beds = $request->query('beds');
        $searchStr = $request->query('q');
        $query = Apartment::with('address', 'user');
        

        if($user_id) {
            $query = $query->where('user_id', $user_id);
        }

        if ($address_id) {
            $query = $query->where('address_id', $address_id);
        }

        if ($searchStr) {
            $query = $query->whereHas('address', function ($query) use ($searchStr) {
                $query->where('address', 'LIKE', "%{$searchStr}%");
            })->orWhereHas('user', function ($query) use ($searchStr) {
                $query->where('lastname', 'LIKE', "%{$searchStr}%");
            });
        }

        if($rooms){
            $query = $query->where('rooms', '>=', $rooms);
        }

        if($beds){
            $query = $query->where('beds', '>=', $beds);
        }

        $apartment = $query->paginate(8);

        return response()->json([
            'success' => true,
            'results'    => $apartment,
        ]);
    }

    public function show($slug)
    {
        $apartment = Apartment::with('image', 'address', 'sponsor', 'utilities', 'views')->where('slug', $slug)->firstOrFail();
        return response()->json([
            'results'   => $apartment,
        ]);
    }
}
