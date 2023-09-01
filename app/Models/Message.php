<?php

namespace App\Models;

use App\Models\Apartment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Message extends Model
{
    use HasFactory;

    protected $table = 'messages';

    protected $fillable = ['name', 'last_name', 'email', 'message', 'apartment_id'];


    public function apartment()
    {
        return $this->belongsTo(Apartment::class, 'apartment_id');
    }
}
