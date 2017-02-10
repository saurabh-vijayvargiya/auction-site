@extends('layouts.app')

@section('content')


<div class="panel-body">
    <!-- Display Validation Errors -->
    
    <!-- New Auction Form -->
    <form action="{{ url('auction') }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
        {{ csrf_field() }}

        <!-- Auction Title -->
        <div class="form-group">
            <label for="auction-title" class="col-sm-3 control-label">Title</label>

            <div class="col-sm-6">
                <input type="text" name="title" id="auction-title" class="form-control">
            </div>
        </div>

        <!-- Auction Description -->
        <div class="form-group">
            <label for="auction-description" class="col-sm-3 control-label">Description</label>

            <div class="col-sm-6">
                <textarea name="description" rows="5" id="auction-description" class="form-control"></textarea>
            </div>
        </div>

        <!-- Auction Image -->
        <div class="form-group">
            <label for="auction-image" class="col-sm-3 control-label">Image</label>

            <div class="col-sm-6">
                <input type="file" name="image" id="auction-image" class="form-control">
            </div>
        </div>

        <!-- Auction Category -->
        <div class="form-group">
            <label for="auction-category" class="col-sm-3 control-label">Category</label>

            <div class="col-sm-6">
                <select name="category"  class="form-control">
                	<option disabled>Category</option>
                	@foreach ($categories as $category)
                		<option value="{{ $category->category }}">{{ $category->category }}</option>
                	@endforeach
                </select>
            </div>
        </div>

        <!-- Auction Reserve price -->
        <div class="form-group">
            <label for="auction-reserve-price" class="col-sm-3 control-label">Reserve Price</label>

            <div class="col-sm-6">
                <input type="number" name="reserve_price" id="auction-reserve-price" class="form-control">
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