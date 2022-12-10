@extends('layouts.mainlayout')
@section('title', 'Book')
@section('content')


<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <div class="col-12 col-md-8 offset-md-2 col-lg-6 offset-md-3 mb-5">
        <h1 class="mb-1">Book Return</h1>

        <div class="mt-4">
            @if (session('status'))
                <div class="alert {{ session('alert-class')}}">
                    {{ session('status') }}
                </div>
            @endif
        </div>

        <form action="/book-return" method="post" class="mb-5">
            @csrf
            <div class="mb-3">
                <label for="user" class="form-label">User</label>
                <select name="user_id" class="form-control inputbox" name="user" id="user">
                    <option value="">Select User</option>
                    @foreach ($users as $item)
                    <option value="{{ $item->id }}">{{ $item->username }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="book" class="form-label">Book</label>
                <select name="book_id" class="form-control inputbox" name="book" id="book">
                    <option value="">Select Book</option>
                    @foreach ($books as $item)
                    <option value="{{ $item->id }}">{{ $item->book_code }}  {{ $item->title }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <button type="submit" class="btn btn-primary w-100">submit</button>
            </div>
        </form>
    </div>

    <div class="mt-5">
        <h1  class="mt-6">Rent Logs</h1>
        <div class="mt-3">
            <x-rent-log-table :rentlog="$rent_logs"/>
        </div>
    </div>
    

<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function(){
         $('.inputbox').select2();
    });
</script>
    
@endsection