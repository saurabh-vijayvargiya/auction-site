@extends('layouts.app')

@section('content')


<div class="panel-body">
    <!-- Display Validation Errors -->
    
    <!-- New Auction Form -->
    <form action="{{ url('auction/'.$auction->id.'/edit') }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
        {{ csrf_field() }}

        <!-- Auction Title -->
        <div class="form-group">
            <label for="auction-title" class="col-sm-3 control-label">Title</label>

            <div class="col-sm-6">
                <input type="text" name="title" id="auction-title" class="form-control" value="{{$auction->title}}">
            </div>
        </div>

        <!-- Auction Description -->
        <div class="form-group">
            <label for="auction-description" class="col-sm-3 control-label">Description</label>

            <div class="col-sm-6">
                <textarea name="description" rows="5" id="auction-description" class="form-control">{{$auction->description}}</textarea>
            </div>
        </div>

        <!-- Auction Image -->
        <div class="form-group">
            <label for="auction-image" class="col-sm-3 control-label">Image</label>

            <div class="col-sm-6">
                <input type="file" name="image" id="auction-image" class="form-control">
                <img src="{{asset($auction->image)}}" width="200px" />
            </div>
        </div>

        <!-- Auction Category -->
        <div class="form-group">
            <label for="auction-category" class="col-sm-3 control-label">Category</label>

            <div class="col-sm-6">
                <select name="category"  class="form-control">
                	<option disabled>Category</option>
                	@foreach ($categories as $category)
                        @if($category == $auction->category)
                		    <option value="{{ $category->category }}" selected="selected">{{ $category->category }}</option>
                        @else
                            <option value="{{ $category->category }}">{{ $category->category }}</option>
                        @endif
                	@endforeach
                </select>
            </div>
        </div>

        <!-- Auction Reserve price -->
        <div class="form-group">
            <label for="auction-reserve-price" class="col-sm-3 control-label">Reserve Price</label>

            <div class="col-sm-6">
                <input type="number" name="reserve_price" id="auction-reserve-price" class="form-control" value="{{$auction->reserve_price}}">
            </div>
        </div>

        <!-- Add Auction Button -->
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <button type="submit" class="btn btn-default">
                    <i class="fa fa-plus"></i> Submit
                </button>
            </div>
        </div>
    </form>
</div>


@endsection