@extends('components.layout')

@section('title', 'Books')

@section('content')

<h1>Books</h1>

@include('components.alert.success_message')

<div class="row">
    <div class="col"> <a href="{{ url('books/create') }}" class="btn btn-primary">Create</a> </div>
</div>

<table class="table">
    <tr>
        <th scope="col" width="100">ID</th>
        <th scope="col">Title</th>
        <th scope="col">Image</th>
        <th scope="col">Author(s)</th>
        <th scope="col">Category</th>
        <th scope="col">Pages</th>
        <th scope="col">Description</th>
        <th scope="col" width="100">Edit</th>
        <th scope="col" width="100">Delete</th>
    </tr>
    @foreach($books as $book)
    <tr>
        <th scope="row">{{ $book->id }}</th>
        <td class="list-group-flush">
            <a href="{{ url('books', ['id' => $book->id]) }}" class="list-group-item list-group-item-action">{{ $book->name }}</a>
        </td>
        <td>
            
        <img src="{{ asset($book->image) }}" class="img-fluid">
            
        </td>
        <td>
            @if($book->authors)

            @foreach($book->authors as $author)
            {{ $author->full_name }} <br>
            @endforeach

            @endif
        </td>
        <td>
            @if($book->category)
            {{ $book->category->name }}
            @endif
        </td>
        <td>{{ $book->page_count }}</td>
        <td>{{ $book->description }}</td>
        <td>
            <a href="{{ route('book.edit', ['id' => $book->id]) }}" class="btn btn-primary">Edit</a>
        </td>
        <td>
            <form action="{{ route('book.delete', ['id' => $book->id]) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
<div class="row">
    <div class="col">
        {{ $books->links()}}
    </div>
</div>

@endsection