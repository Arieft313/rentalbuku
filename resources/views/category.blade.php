@extends('layouts.mainlayout')

@section('title', 'Category')

@section('content')
    <h1>Category List</h1>
    <div class='mt-5'>
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status')}}
            </div>
        @endif
    </div>

    <div class="mt-5  ">
        <a href="category-add" class="btn btn-primary">Add Data</a>
        <a href="category-deleted" class="btn btn-secondary me-3">View Deleted Data</a>
    </div>
    
    <div class="my-5">
        <table class="table w-75">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->name }}</td>
                    <td>
                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="category-delete/{{ $item->slug}}" method="POST">
                            @method('DELETE')
                            @csrf
                            <a href="category-edit/{{ $item->slug }}" class="btn btn-sm btn-primary">EDIT</a>
                            <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                        </form>
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