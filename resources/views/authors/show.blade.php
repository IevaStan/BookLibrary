@extends('components.layout')

@section('title', $author->name.' '.$author->surname)

@section('content')

<h1>About the author</h1>
<div class="card">
    <div class="card-header">
        {{ $author->name }} {{ $author->surname }}
    </div>
    <div class="card-body">
        <p class="card-text">ID: {{ $author->id }}.</p>
        <p class="card-text">Birthday: {{ $author->birthdate }}.</p>
        <p class="card-text">Country Of Origin: {{ $author->country }}.</p>
    </div>
</div>
<br>
<br>


<h5>{{ $author->name }} {{ $author->surname }}'s books:</h5>
@foreach($author->books as $book)
<div class="card">
    <div class="card-header">
        Original title: {{ $book->name }}
    </div>
    <div class="card-body">
        <p class="card-text">{{ $book->page_count }} pages,</p>
        <p class="card-text">{{ $book->description }}.</p>
    </div>
</div>
<br>
@endforeach
<br>
<br>

<div class="btn-group" role="group">
    <div><a href="{{ route('author.edit', ['id' => $author->id]) }}" class="btn btn-primary">Edit</a></div>
    <form action="{{ route('author.delete', ['id' => $author->id]) }}" method="post">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
</div>
<br>
<br>



@endsection