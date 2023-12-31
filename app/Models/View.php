<?php

namespace App\Models;

use App\Models\Apartment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class View extends Model
{
    use HasFactory;

    protected $table = 'views';

    public function apartment()
    {
        return $this->belongsTo(Apartment::class);
    }
}
