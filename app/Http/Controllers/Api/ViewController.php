<?php

namespace App\Http\Controllers\Api;

use App\Models\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewController extends Controller
{
    public function index()
    {

        $views = View::all();

        return response()->json([
            'success' => true,
            'results'    => $views,
        ]);
    }
}
