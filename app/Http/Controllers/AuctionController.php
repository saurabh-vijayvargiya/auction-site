<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Category;
use App\Auction;
use App\Bid;
use DB;
use Auth;

class AuctionController extends Controller
{
    
    protected $categories;
    
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
     * Get all the categories from database
     * @return void
     */
    public function getCategories()
    {
        $this->categories = count($this->categories) > 0 ? $this->categories : Category::all();
    }

    /**
     * Show view to create auction
     * @return view
     */
    public function index()
    {
        self::getCategories();
        return view('auction.create')->with('categories', $this->categories);
    }

    /**
     * Save auction data to database
     * @param  Request
     * @return redirect
     */
    public function create(Request $request)
    {
        $auction = new Auction;

        $file = $request->file('image');
        $destination_path = '../storage/app/public/uploads/';
        $filename = str_random(6).'_'.$file->getClientOriginalName();
        $file->move($destination_path, $filename);

        $auction->title = $request->input('title');
        $auction->description = $request->input('description');
        $auction->image = $destination_path.$filename;
        $auction->category = $request->input('category');
        $auction->reserve_price = $request->input('reserve_price');
        $auction->user_id = Auth::user()->id;

        $auction->save();
        $id = $auction->id;

        return redirect('/auction/'.$id);
    }

    /**
     * View specific auction using auction id
     * @param  int auction id
     * @return view
     */
    public function view($id)
    {
        $auction = Auction::where('id', '=', $id)->get();
        $owner = $auction[0]->user_id === Auth::user()->id ? true : false;
        $bids = DB::table('bids')
            ->join('users', 'users.id', '=', 'bids.user_id')
            ->select('bids.bid_amount', 'users.name')
            ->where('bids.auction_id', '=', $id)
            ->get();
        

        if(count($bids)) {    
            $topBid = Auction::find($id)->bids()->orderBy('bid_amount', 'desc')->limit(1)->get()[0];
            $topBidder = Bid::find($topBid->id)->user->name;
            $currentUserBid = Bid::where([['user_id', '=', Auth::user()->id], ['auction_id', '=', $id]])->get()[0];
            $amount = $topBid->bid_amount;
        } else {
            $topBid = null;
            $topBidder = null;
            $currentUserBid = null;
            $amount = null;
        }

        self::getCategories();
        
        return view('auction.view', ['auction' => $auction, 'owner' => $owner, 'categories' => $this->categories, 'bids' => $bids, 'currentUserBid' => $currentUserBid, 'topBid' => ['bidder' => $topBidder, 'amount' => $amount]]);
    }

    /**
     * To show current user's auctions
     * @return view
     */
    public function self()
    {
        $userId = Auth::user()->id;
        $auctions = Auction::where('user_id', '=', $userId)->get();
        
        return view('auction.self')->with('auctions', $auctions);
    }

    /**
     * Edit an auction
     * @param  int auction id
     * @return view
     */
    public function edit($id)
    {
        $auction = Auction::find($id);
        self::getCategories();
        
        return view('auction.edit', ['auction' => $auction, 'categories' => $this->categories]);
    }

    /**
     * Update an auction
     * @param  Request
     * @param  int auction id
     * @return view
     */
    public function update(Request $request, $id)
    {
        $auction = Auction::find($id);

        $file = $request->file('image');
        if(isset($file)){
            $destination_path = '../storage/app/public/uploads/';
            $filename = str_random(6).'_'.$file->getClientOriginalName();
            $file->move($destination_path, $filename);
            $auction->image = $destination_path.$filename;
        }

        $auction->title = $request->input('title');
        $auction->description = $request->input('description');
        $auction->category = $request->input('category');
        $auction->reserve_price = $request->input('reserve_price');

        $auction->save();

        return redirect('/auction/'.$id);
    }
}
