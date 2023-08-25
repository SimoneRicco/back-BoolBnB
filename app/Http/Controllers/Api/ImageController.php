<?php

namespace App\Http\Controllers\Api;

use App\Models\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ImageController extends Controller
{
    public function index() {
        $images = Image::all();

        return response()->json([
            'success' => true,
            'results' => $images,
        ]);
    }
}
