<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EarningHistory extends Model
{
    //
    protected $table = "earning_history";
    
    protected $fillable = ['user_id'];
    
}
