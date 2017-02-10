<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'funds'
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
     * Get the auction of the user.
     */
    public function auctions()
    {
        return $this->hasMany(Auction::class);
    }

    /**
     * Get the bid of the user.
     */
    public function bids()
    {
        return $this->hasMany(Bid::class);
    }
}
