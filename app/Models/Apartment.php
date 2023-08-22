<?php

namespace App\Models;

use App\Models\Utility;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Apartment extends Model
{
    use HasFactory;
    protected $table = 'apartments';
    public $timestamps = false;
   
    public function utilities() {
        return $this->belongsToMany(Utility::class);
    }
}
