<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfluencerSalary extends Model
{
    const APPROVED = 1;
    const REJECTED = 2;
    const PENDING = 0;

    use HasFactory;
    protected $table = "influencersalary";
    public $timestamps = false;
    protected $guarded = [];
}
