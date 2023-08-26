<?php

namespace App\Models;

use App\Models\User;
use App\Models\View;
use App\Models\Image;
use App\Models\Address;
use App\Models\Message;
use App\Models\Sponsor;
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function views()
    {
        return $this->hasMany(View::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function image()
    {
        return $this->hasMany(Image::class);  
    }
   
    public function utilities() {
        return $this->belongsToMany(Utility::class);
    }

    public function sponsors()
    {
        return $this->belongsToMany(Sponsor::class);
    }
}
