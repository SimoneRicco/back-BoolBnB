<?php

namespace App\Http\Controllers\Api;

use App\Models\Utility;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UtilityController extends Controller
{
    public function index() {
        $utilities = Utility::all();

        return response()->json([
            'success' => true,
            'results' => $utilities,
        ]);
    }
}
