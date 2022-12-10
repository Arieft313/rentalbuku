@extends('layouts.mainlayout')
@section('title', 'Book')
@section('content')

<h1 class="mb-3">Book List</h1>

<div class='mt-5'>
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status')}}
            </div>
        @endif
</div>

<div class="mt-5">
        <a href="book-add" class="btn btn-primary">Add Data</a>
        <a href="book-deleted" class="btn btn-secondary me-3">View Deleted Data</a>
</div>

<div class="my-5">
    <table class="table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Code</th>
                <th>Title</th>
                <th>Category</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($books as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->book_code}} </td>
                <td>{{ $item->title}} </td>
                <td>
                    @foreach ($item->categories as $category)
                        {{$category->name}}, 
                    @endforeach 
                </td>
                <td>{{ $item->status}} </td>
                <td>
                <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="book-delete/{{ $item->slug}}" method="POST">
                    @method('DELETE')
                    @csrf
                    <a href="book-edit/{{ $item->slug }}" class="btn btn-sm btn-primary">EDIT</a>
                    <button type="submit" class="btn btn-sm btn-danger">DELETE</button>
                </form>
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>
    
@endsection