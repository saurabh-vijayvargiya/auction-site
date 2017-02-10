<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Bid;
use Auth;
use DB;

class BidController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show current user's bids
     * @return view
     */
    public function self()
    {
    	$userId = Auth::user()->id;
        $bids = DB::table('bids')
            ->join('auctions', 'auctions.id', '=', 'bids.auction_id')
            ->select('bids.bid_amount', 'auctions.title', 'bids.auction_id')
            ->where('bids.user_id', '=', $userId)
            ->get();
        
        return view('bid')->with('bids', $bids);
    }

    /**
     * Submit bid for the auction
     * @param  Request
     * @param  int auction id
     * @return view
     */
    public function create(Request $request, $id)
    {
    	$bid = new Bid;

        $bid->auction_id = $id;
        $bid->user_id = Auth::user()->id;
        $bid->bid_amount = $request->input('bid_amount');

        $bid->save();

        $user = Auth::user();
        $user->funds = $user->funds - $request->input('bid_amount');
        $user->save();
        
        return redirect('/auction/'.$id);
    }

    /**
     * Update bid for the auction
     * @param  Request
     * @param  int auction id
     * @return view
     */
    public function update(Request $request, $id)
    {
        $bid = Bid::find($request->bidId);
        
        $bid->auction_id = $id;
        $bid->user_id = Auth::user()->id;
        $bid->bid_amount = $request->input('bid_amount');
        
        $bid->save();

        $user = Auth::user();
        $user->funds = $user->funds - $request->input('bid_amount');
        $user->save();
        
        return redirect('/auction/'.$id);
    }
}
