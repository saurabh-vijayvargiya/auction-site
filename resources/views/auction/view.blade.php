@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                @foreach($auction as $data)
                <div class="panel-heading text-capitalize"><h2>{{$data->title}}</h2></div>
                <div class="panel-body">
                    <div class="thumbnail">
                        <img src="{{asset($data->image)}}" width="400px" class="pull-left" />
                        <div class="caption">
                            <p class="text-capitalize">Description : {{$data->description}}</p>
                            <p class="text-capitalize">Category : {{$data->category}}</p>
                            <p>Reserve Price : ${{$data->reserve_price}}</p>
                            @if($owner)
                            <p>
                                <div class="row text-center" style="padding-left:1em;">
                                    <a href="{{ url('/auction/'.$data->id.'/edit') }}" class="btn btn-warning pull-left">Edit</a>
                                    <span class="pull-left">&nbsp;</span>
                                </div>
                            </p>
                            @else
                            <p>
                                <div class="row text-center" style="padding-left:1em;">
                                    @if(count($currentUserBid))
                                        <button type="button" class="btn btn-warning pull-left" data-toggle="modal" data-target="#bidModal">Update Bid</button>
                                    @else
                                        <button type="button" class="btn btn-warning pull-left" data-toggle="modal" data-target="#bidModal">Bid Now</button>
                                    @endif
                                </div>
                            </p>
                            @endif

                            @if(count($bids) > 0)
                                <p>
                                    <div class="row text-center" style="padding-left:1em;">
                                        <label for="top-bid" class="btn btn-warning">Top Bid</label>
                                        <span>{{$topBid['bidder']}}, Bid: ${{$topBid['amount']}}</span>
                                        <span class="pull-left">&nbsp;</span>
                                    </div>
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="panel panel-default">
                        @if(count($bids) > 0)
                            <div class="panel-heading"><h2>Bids</h2></div>
                            <div class="panel-body">
                                @foreach($bids as $bid)
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <span class="pull-left">{{$bid->name}}</span>
                                            <span class="pull-right">${{$bid->bid_amount}}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="panel-body">No bid has been made yet. </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <div class="modal fade" id="bidModal" tabindex="-1" role="dialog" aria-labelledby="bidModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="bidModalLabel">New Bid</h4>
                </div>
                <div class="modal-body">
                    @if(count($bids))
                        <form  action="{{ url('bid/'.$data->id.'/update') }}" method="POST" class="form-horizontal">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="bid-amount">Bid Amount:</label>
                                <input type="text" class="form-control" value="{{$currentUserBid->bid_amount}}" name="bid_amount" placeholder="Bid Amount">
                                <input type="hidden" name="bidId" value="{{$currentUserBid->id}}">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Update Bid</button>
                            </div>
                        </form>
                    @else
                        <form  action="{{ url('bid/'.$data->id) }}" method="POST" class="form-horizontal">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="bid-amount">Bid Amount:</label>
                                <input type="text" class="form-control" name="bid_amount" placeholder="Bid Amount">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Submit Bid</button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection