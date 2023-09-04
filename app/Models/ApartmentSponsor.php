<?php

namespace App\Models;

use App\Models\Sponsor;
use App\Models\Apartment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ApartmentSponsor extends Model
{
    use HasFactory;

    public $timestamps = false;

    // public $fillable = ['duration', 'apartment_id', 'sponsor_id'];


    public function apartment()
    {
        return $this->belongsTo(Apartment::class);
    }

    public function sponsor()
    {
        return $this->belongsTo(Sponsor::class);
    }
}
