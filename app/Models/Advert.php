<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Advert extends Model
{

    protected $guarded = [];
    protected $table = "advert";

    public $timestamps = false;

    public function user(){
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
