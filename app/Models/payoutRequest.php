<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class payoutRequest extends Model
{
    //
    protected $guarded  = [];
    const APPROVED = 1;
    const REJECTED = 2;
    const PENDING = 0;

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
