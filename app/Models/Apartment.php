<?php

namespace App\Models;

use App\Models\Utility;
use App\Traits\Slugger;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Apartment extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Slugger;
    protected $table = 'apartments';
    public $timestamps = false;

    public function getRouteKey()
    {
        return $this->slug;
    }
   
    public function utilities() {
        return $this->belongsToMany(Utility::class);
    }
}
