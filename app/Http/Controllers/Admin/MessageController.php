<?php

namespace App\Http\Controllers\Admin;

use App\Models\Message;
use App\Models\Apartment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MessageController extends Controller
{
    
    public function index()
    {
        $messages = Message::all();

        return view('admin.apartments.dashboard', compact('messages'));
    }

    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        //
    }

    
    public function show(Message $message)
    {
        //
    }

    
    public function edit(Message $message)
    {
        //
    }

    
    public function update(Request $request, Message $message)
    {
        //
    }

    
    public function destroy(Message $message)
    {
        //
    }
}
