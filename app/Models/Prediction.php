<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prediction extends Model
{
    //
    protected $table = "prediction";
    protected $fillable = ['title', 'content', 'image'];
    
}
