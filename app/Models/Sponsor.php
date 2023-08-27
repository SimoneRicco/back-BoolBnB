<?php

namespace App\Models;

use App\Models\Apartment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sponsor extends Model
{
    use HasFactory;
    protected $table = 'sponsors';

    public function apartments() {
        return $this->hasMany(Apartment::class);
    }
}
