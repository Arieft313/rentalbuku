@extends('layouts.mainlayout')

@section('title', 'User Detail')

@section('content')
    <h1>Detail User</h1>

    <div class='mt-5 '>
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status')}}
            </div>
        @endif
    </div>

    @if ($user->status == 'inactive')
        <div class="mt-3 mr-2 ">
            <a href="/user-approve/{{ $user->slug }}" class="btn btn-info">Approve User</a>
        </div>
    
    @elseif($user->status == 'active')
        <div class="mt-3 mr-2 ">
            <a href="/user-ban/{{ $user->slug }}" class="btn btn-danger">Ban User</a>
        </div>

    @elseif($user->status == 'banned')
        <div class="mt-3 mr-2 ">
            <a href="/user-unban/{{ $user->slug }}" class="btn btn-warning">Unbanned User</a>
        </div>
    @endif

    <div  class="mt-3 mb-5" style="width: 47%; float:left">
        <div class="mb-2">
            <label for="" class="form-label"> Username</label>
            <input type="text" class="form-control" readonly value="{{$user->username}}">
        </div>
        
        <div class="mb-2">
            <label for="" class="form-label"> Phone</label>
            <input type="text" class="form-control" readonly value="{{$user->phone}}">
        </div>
        <div class="mb-2">
            <label for="" class="form-label"> Status</label>
            <input type="text" class="form-control" readonly value="{{$user->status}}">
        </div>
    </div>

    <div class="mt-3" style="width: 48%; float:right">
        <div class="mb-2">
            <label for="" class="form-label"> Address</label>
            <textarea name="" id="" cols="48" rows="3" class="form-control" style="resize:none" readonly>{{$user->address}}</textarea>
        </div>
    </div>

    <div class="mt-2">
        <x-rent-log-table :rentlog="$rent_logs"/>
    </div>

@endsection