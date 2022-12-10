@extends('layouts.mainlayout')

@section('title', 'Registered User')

@section('content')
    <h1>User List</h1>
    <div class='mt-5'>
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status')}}
            </div>
        @endif
    </div>

    <div class="mt-5 mr-2 ">
        <a href="/users" class="btn btn-primary">Approved User</a>
        <!-- <a href="banned-user" class="btn btn-danger">View Banned User</a> -->
    </div>
    
    <div class="my-5">
        <table class="table w-75">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Username</th>
                    <th>Phone</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bannedUsers as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->username }}</td>
                    <td>@if ($item->phone)
                            {{ $item->phone }}
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        <a href="/user-detail/{{ $item->slug }}" class="btn btn-sm btn-primary">DETAIL</a>
                    </td>

                    <!-- <td>
                        <a href="category-edit/{{ $item->slug }}">EDIT</a>
                        <a href="category-delete/{{ $item->slug }}">DELETE</a>
                    </td> -->
                @endforeach
                </tr>
            </tbody>
        </table>
    </div>

@endsection