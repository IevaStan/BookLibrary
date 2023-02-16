@extends('components.layout')

@section('title', 'Books')

@section('content')

<h1>Add a new book</h1>

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ url('books/store') }}" method="post" class="row g-3" enctype="multipart/form-data">
    



    @csrf
    <div class="form-group">
        <label class="form-label">Title:</label>
        <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" placeholder="Book title">
        @error('name')
        <div class="invalid-feedback">{{ $message }}</div><br>
        @enderror
    </div>


    <div class="form-group">
        <label class="form-label">Author:</label>
        <select name="author_id[]" class="form-control @error('author_id') is-invalid @enderror" multiple>
            @foreach($authors as $author)
            <option value="{{ $author->id }}">{{ $author->full_name }}</option>
            @endforeach
        </select>
        @error('author_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="form-group">
        <label class="form-label">Category:</label>
        <select name="category_id" class="form-control">
            @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option> 
                @foreach($category->childrenCategories as $childrenCategory)
                <option value="{{ $childrenCategory->id }}">---{{ $childrenCategory->name }}</option> 
                @endforeach
            @endforeach
        </select>
    </div>


    <div class="form-group">
        <label class="form-label">Pages:</label>
        <input type="number" name="page_count" value="{{ old('page_count') }}" min="20" class="form-control @error('page_count') is-invalid @enderror">
        @error('page_count')
        <div class="invalid-feedback">{{ $message }}</div><br>
        @enderror
    </div>



    <div class="form-group">
        <label class="form-label">Description:</label>
        <input type="text" name="description" value="{{ old('description') }}" class="form-control @error('description') is-invalid @enderror" placeholder="Book type: Paperback, Hardcover, E-book">
        @error('description')
        <div class="invalid-feedback">{{ $message }}</div><br>
        @enderror
    </div>


    <div class="form-group">
        <label class="form-label">Add picture:</label>
        <input type="file" name="image" class="form-control 
        {{--@error('image') is-invalid @enderror--}}
        ">
        @error('image')
        <div class="invalid-feedback">{{ $message }}</div><br>
        @enderror
    </div>


    <div class="col-12">
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
</form>

@endsection