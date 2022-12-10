@extends('layouts.mainlayout')

@section('title','Dashboard')
@section('page-name','dashboard')
@section('content')

<!-- Pencarian -->
<form action="" method="get">
<div class="row">
    <div class="col-12 col-sm-6">
        <select name="category" id="category" class="form-control></select>
        <option value="">Select Category</option>
        @foreach ($categories as $item)
            <option value="{{ $item->id }}">{{ $item->name }}</option> 
        @endforeach
    </div>
    <div class="col-12 col-sm-6">
        <div class="input-group">
            <input type="text" name="title" class="form-control" placeholder="Search book's title">
            <button class="btn btn-primary" type="submit">Search</button>
        </div>
    </div>
</div>
</form>
<!-- End Pencarian -->
<div class="my-5">
    <div class="row">
        @foreach ($books as $item)
            <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
                <div class="card">
                    <img src="{{ asset('images/not found.jpg')}}" class="card-img-top" alt="">
                    <h5 class="card-title">{{$item->title}}</h5>
                    <p>{{$item->book_code}}</p>
                    <a href=""></a>
                </div>
            </div>
        @endforeach
        
    </div>
</div>