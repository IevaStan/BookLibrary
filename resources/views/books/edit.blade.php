@extends('components.layout')

@section('title', 'edit book '. $book->name)

@section('content')

<h1>Edit book "{{ $book->name }}"</h1>

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('book.edit', ['id' => $book->id]) }}" method="post" class="row g-3">


    @csrf
    <div class="form-group">
        <label class="form-label">Title:</label>
        <input type="text" name="name" value="{{ old('name', $book->name) }}" class="form-control @error('name') is-invalid @enderror" placeholder="Book title">
        @error('name')
        <div class="invalid-feedback">{{ $message }}</div><br>
        @enderror
    </div>


    <div class="form-group">
        <label class="form-label">Author:</label>
        <select name="author_id[]" class="form-control @error('author_id') is-invalid @enderror" multiple>
            @foreach($authors as $author)
            <option value="{{ $author->id }}" @if($book->authors->contains($author->id))selected @endif >{{ $author->full_name }}</option>
            @endforeach
        </select>
    </div>


    <div class="form-group">
        <label class="form-label">Category:</label>
        <select name="category_id" class="form-control">
            @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>


    <div class="form-group">
        <label class="form-label">Pages:</label>
        <input type="number" name="page_count" value="{{ old('page_count', $book->page_count) }}" min="20" class="form-control @error('page_count') is-invalid @enderror">
        @error('page_count')
        <div class="invalid-feedback">{{ $message }}</div><br>
        @enderror
    </div>


    <div class="form-group">
        <label class="form-label">Description:</label>
        <input type="text" name="description" value="{{ old('description', $book->description) }}" class="form-control @error('description') is-invalid @enderror" placeholder="Book type: Paperback, Hardcover, E-book">
        @error('description')
        <div class="invalid-feedback">{{ $message }}</div><br>
        @enderror
    </div>


    <div class="col-12">
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
</form>














@endsection