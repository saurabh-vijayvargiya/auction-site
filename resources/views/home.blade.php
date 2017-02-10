@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Currect Auctions</div>
                <div class="panel-body">
                    @foreach($auctions as $auction)
                        <a href="{{url('auction/'.$auction->id)}}">{{$auction->title}}</a><br>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
