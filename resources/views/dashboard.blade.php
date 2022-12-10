@extends('layouts.mainlayout')

@section('title', 'Dashboard')

@section('content')
<h1>WELCOME, {{Auth::user()->username}}</h1>
    <div class="row mt-3 mb-3">
        <div class="col-lg-4">
            <div class="card-data book">
                <div class="row">
                    <div class="col-6"><i class="bi bi-journals"></i></div>
                    <div class="col-6 d-flex  flex-column justify-content-center align-items-end">
                        <div class="card-desc">Books</div>
                        <div class="card-count">{{$book_count}}</div>
                    </div>
                </div>
            </div>
         </div>
         <div class="col-lg-4">
            <div class="card-data category">
                <div class="row">
                    <div class="col-6"><i class="bi bi-list-stars"></i></i></div>
                    <div class="col-6 d-flex  flex-column justify-content-center align-items-end">
                        <div class="card-desc">Category</div>
                        <div class="card-count">{{$category}}</div>
                    </div>
                </div>
            </div>
         </div>
         <div class="col-lg-4">
            <div class="card-data users">
                <div class="row">
                    <div class="col-6"><i class="bi bi-person-lines-fill"></i></div>
                    <div class="col-6 d-flex  flex-column justify-content-center align-items-end">
                        <div class="card-desc">users</div>
                        <div class="card-count">{{$user_count}}</div>
                    </div>
                </div>
            </div>
         </div>
    </div>


    <div class="mt-5">
        <h2>Rent Logs</h2>
        <div class="mt-3">
            <x-rent-log-table :rentlog="$rent_logs"/>
    </div>
@endsection