<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class userPredictions extends Model
{
    //
    protected $table = "user_predictions";
    protected $fillable = [
        'title', 
        'content', 
        'status', 
        'user_id'
    ];
    
}
