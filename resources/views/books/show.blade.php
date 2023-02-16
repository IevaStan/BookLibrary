@extends('components.layout')

@section('title', 'Book')

@section('content')

<h1>About the book</h1>

<div class="card" style="width: 18rem;">
    @if($book->image)
    <img src="{{ asset($book->image) }}" class="card-img-top" alt="book picture">
    @else
    no image
    @endif
    <div class="card-body">
        <h5 class="card-title">{{ $book->name }}</h5>
        <p class="card-text"></p>
    </div>
    <ul class="list-group list-group-flush">
        <li class="list-group-item">ID: {{ $book->id }}</li>
        <li class="list-group-item">Pages: {{ $book->page_count }}.</li>
        <li class="list-group-item">Description: {{ $book->description }}.</li>
    </ul>
    <div class="card-body">
        <div class="btn-group" role="group">
            <div><a href="{{ route('book.edit', ['id' => $book->id]) }}" class="btn btn-primary">Edit</a></div>
            <form action="{{ route('book.delete', ['id' => $book->id]) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
    </div>
</div>
<br>
<br>

{{--<div class="card">
    <div class="card-header">
        {{ $book->name }}
</div>
<div class="card-body">
    <p class="card-text">ID: {{ $book->id }}.</p>
    <p class="card-text">Pages: {{ $book->page_count }}.</p>
    <p class="card-text">Description: {{ $book->description }}.</p>
</div>
</div>
<br>
<br>



<div class="btn-group" role="group">
    <div><a href="{{ route('book.edit', ['id' => $book->id]) }}" class="btn btn-primary">Edit</a></div>
    <form action="{{ route('book.delete', ['id' => $book->id]) }}" method="post">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
</div>
<br>
<br>--}}

@endsection