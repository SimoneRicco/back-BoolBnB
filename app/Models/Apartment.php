<?php

namespace App\Models;

use Carbon\Carbon;
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
    protected $fillable = ['title'];

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

    public function message()
    {
        return $this->hasMany(Message::class);
    }

    public function address()
    {
        return $this->hasOne(Address::class);
    }

    public function image()
    {
        return $this->hasMany(Image::class);
    }

    public function utilities()
    {
        return $this->belongsToMany(Utility::class);
    }

    public function sponsors()
    {
        return $this->belongsToMany(Sponsor::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($apartment) {
            if (!$apartment->user_id) {
                $apartment->user_id = auth()->user()->id;
            }
        });
    }
    // public function isSponsored()
    // {
    //     $subscriptionEndDate = Carbon::parse($this->pivot->subscription_date)->addDays($this->pivot->duration);

    //     return $subscriptionEndDate > now();

    //     // return $this->sponsors()
    //     //     ->where('subscription_date', '>', now()) //falso
    //     //     ->exists();
    // }
}
