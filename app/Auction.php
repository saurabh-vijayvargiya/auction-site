<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
    protected $fillable = ['user_id', 'title', 'description', 'image', 'category', 'reserve_price'];

    /**
     * Get the user that owns the auction.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the bids for the auction.
     */
    public function bids()
    {
        return $this->hasMany(Bid::class);
    }

    /**
     * Get the categories list for the auction.
     */
    public function categories()
    {
        return $this->hasMany(Category::class);
    }
}