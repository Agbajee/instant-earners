<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Market extends Model
{
    //
    protected $table = "market";
    public $timestamps = false;

    protected $casts = [
        'contact' => 'array'
    ];

    protected $guarded = [];
    
}
