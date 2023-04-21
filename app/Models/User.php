<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements  MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'influencer'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function isInfluencer()
    {
        return $this->influencer;
    }
    public function isVendor()
    {
        return $this->is_vendor;
    }

    public function isAdmin()
    {
        return $this->is_admin;
    }

    public function is_verified()
    {
        return $this->is_verified;
    }

    public function earning_history()
    {
        return $this->hasMany(EarningHistory::class)->orderBy('id', 'desc');
    }
    public function loans()
    {
        return $this->hasMany(Loans::class);
    }
    public function readingHistories()
    {
        return $this->hasMany(ReadingHistory::class);
    }

}
