<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];
    public function categories(){
        return $this->hasMany(CategoryTread::class);
    }
    public function treads()
    {
        return $this->belongsToMany(Treads::class);
    }

}
