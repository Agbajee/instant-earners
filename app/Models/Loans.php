<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loans extends Model
{
    const STATUS_APPROVED = 1;
    const STATUS_PENDING = 2;
    const STATUS_REJECTED = 3;

    protected $table = "loans";

    public $timestamps = false;

    protected $guarded = [];
    protected $casts = [
        'user_info' => 'array',
        // 'due_when' => 'datetime'
    ];
}
