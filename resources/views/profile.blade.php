@extends('layouts.mainlayout')

@section('title', 'My Rent Log')

@section('content')

<h1>My Rent Logs</h1>

<div class="mt-5">
    <x-rent-log-table :rentlog="$rent_logs"/>
</div>
    
@endsection