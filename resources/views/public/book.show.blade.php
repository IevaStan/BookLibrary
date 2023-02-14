






@extends('components.min_layout')

@section('content')

<h1>About the book</h1>
<div class="card">
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

@endsection



