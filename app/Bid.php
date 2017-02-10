<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    protected $fillable = ['auction_id', 'user_id', 'bid_amount'];

    /**
     * Get the user that owns the bid.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the auction that contains the bid.
     */
    public function auction()
    {
        return $this->belongsTo(Auction::class);
    }

    public function getTimeagoAttribute()
    {
        $date = CarbonCarbon::createFromTimeStamp(strtotime($this->created_at))->diffForHumans();
        return $date;
    }

    public function storeBidForAuction($auctionID, $amount)
    {
        $auction = Auction::find($auctionID);

        $this->auction_id = $auctionID;
        $this->user_id = Auth::user()->id;
        $this->bid_amount = $bid_amount;
        $auction->bids()->save($this);
    }
}
