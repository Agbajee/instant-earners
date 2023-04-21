<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryTread extends Model
{
    public function cat(){
        return $this->belongsTo(Category::class, 'cat_id', 'id');
    }
    public function tread(){
        return $this->belongsTo(Treads::class, 'tread_id', 'id');
    }

}
