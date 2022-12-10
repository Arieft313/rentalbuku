@extends('layouts.mainlayout')

@section('title','Dashboard')
@section('page-name','dashboard')
@section('content')

<h1>Book List</h1>
<form action="" method="get">
    <div class="row">
        <!-- <div class="col-12 col-sm-6">
            <select name="category" id="category" class="form-control">
                <option value="">Select Category</option>
                @foreach ($categories as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option> 
                @endforeach
            </select>
        </div> -->
        <div class="col-12 col-sm-6 mt-2 mb-2">
            <div class="input-group">
                <input type="text" name="title" class="form-control" placeholder="Search book's title">
                <button class="btn btn-primary" type="submit">Search</button>
            </div>
        </div>
    </div>
</form>

<div class="my-3">
    <div class="row">
        @foreach ($books as $item)
            <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
                <div class="card h-100">
                    <div class="card-body">
                        <img src="{{ $item->cover != null ? asset('storage/cover/'.$item->cover) : asset('images/not found.jpg')}}"  class="card-img-top mb-2" draggable="false">
                        <h6 style="font-size: 9px;  text-align: center;">{{$item->book_code}}</h6>
                        <h5 style="font-size: 18px; text-align: center;" class="card-title">{{$item->title}}</h5>
                        <p style="font-size: 12px;  text-align: center;"> 
                        @foreach ($item->categories as $category) 
                        {{$category->name}},  
                        @endforeach 
                        </p> 
                        <p style="font-size: 10px;" class="card-text text-end fw-bold {{ $item->status == 'in stock' ? 'text-success'  : 'text-danger'}}">
                            {{ $item->status}}
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>


@endsection