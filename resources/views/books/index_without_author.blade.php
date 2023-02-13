@extends('components.layout')

@section('title', 'Books')

@section('content')

@foreach($books as $book)
<div>
    {{ $book->name }} - @if($book->category){{ $book->category->name }}@endif
</div>
@endforeach
<br>
<br>

@endsection

