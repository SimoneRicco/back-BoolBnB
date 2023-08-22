<?php

namespace App\Models;

use App\Models\Apartment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Utility extends Model
{
    use HasFactory;
    protected $table = 'utilities';
    public $timestamps = false;

    public function apartments() {
        return $this->belongsToMany(Apartment::class);
    }
}
