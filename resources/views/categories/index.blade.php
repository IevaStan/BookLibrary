@extends('components.layout')

@section('title', 'Categories')

@section('content')

<h1>Categories</h1>

@include('components.alert.success_message')

<div class="row">
    <div class="col"> <a href="{{ url('categories/create') }}" class="btn btn-primary">Create</a> </div>
</div>

<table class="table">
    <tr>
        <th scope="col" width="100">Title</th>
        <th scope="col">Name</th>
        <th scope="col">Enabled</th>
        <th scope="col" width="100">Edit</th>
        <th scope="col" width="100">Delete</th>
    </tr>
    @foreach($categories as $category)
    <tr>
        <th scope="row">{{ $category->id }}</th>
        <td class="list-group-flush" >
            <a href="{{ url('categories', ['id' => $category->id]) }}" class="list-group-item list-group-item-action">{{ $category->name }}</a>
        </td>
        <td>{{ $category->enabled }}</td>
        <td>
            <a href="{{ route('category.edit', ['id' => $category->id]) }}" class="btn btn-primary">Edit</a>
        </td>
        <td>
            <form action="{{ route('category.delete', ['id' => $category->id]) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection