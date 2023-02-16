@extends('components.layout')

@section('title', 'Books')

@section('content')

<h1>Books</h1>

@include('components.alert.success_message')

<div class="row">
    <div class="col">
        <form action="{{ url('books') }}" method="get">
            <div class="form-group">

                <div class="form-group">
                    <label class="form-label">Title:</label>
                    <input type="text" name="name" value="{{ $name }}" class="form-control" placeholder="Book title">
                </div>

                <label class="form-label">Select the category:</label>
                <select name="category_id" class="form-control">
                    <option></option>
                    @foreach($categories as $category)
                    <option @if($category->id == $category_id) selected @endif
                        value="{{ $category->id }}">{{ $category->name }}
                    </option>
                    @foreach($category->childrenCategories as $childrenCategory)
                    <option @if($childrenCategory->id == $category_id) selected @endif
                        value="{{ $childrenCategory->id }}">---{{ $childrenCategory->name }}
                    </option>
                    @endforeach
                    @endforeach
                </select>
                <br>
            </div>

            <div class="btn-group" role="group">
                <div>
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
                <div>
                    <a href=" {{ url('books') }}" class="btn btn-secondary">Clear filter</a>
                </div>
            </div>
            <br>
            <br>

        </form>
    </div>
</div>

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
            <div class="col-md-4 px-0">
                @if($book->image)
                <img src="{{ asset($book->image) }}" class="img-fluid ">
                @else
                no image
                @endif
            </div>
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