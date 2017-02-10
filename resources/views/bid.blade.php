@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">My Bids</div>
                <div class="panel-body">
                    @foreach($bids as $bid)
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <a href="{{url('auction/'.$bid->auction_id)}}">{{$bid->title}}</a>
                                <span class="pull-right">${{$bid->bid_amount}}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
