<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * Get the category that owns the auction.
     */
    public function auction()
    {
        return $this->hasMany(Auction::class);
    }
}
