@extends('components.layout')

@section('title', 'Authors')

@section('content')

<h1>Authors</h1>

<!-- @if($message = Session::get('success'))
<div>
    {{ $message }}
</div>
@endif -->

@include('components.alert.success_message')

<div class="row">
    <div class="col">
        <a href="{{ url('authors/create') }}" class="btn btn-primary">Create</a>
    </div>
</div>

<table class="table">
    <tr>
        <th scope="col" width="100">ID</th>
        <th scope="col">Name</th>
        <th scope="col">Surname</th>
        <th scope="col" width="100">Birthday</th>
        <th scope="col" width="100">Country</th>
        <th scope="col" width="100">Edit</th>
        <th scope="col" width="100">Delete</th>
    </tr>
    @foreach($authors as $author)
    <tr>
        <th scope="row">{{ $author->id }}</th>
        <td class="list-group-flush">
            <a href="{{ url('authors', ['id' => $author->id]) }}" class="list-group-item list-group-item-action">{{ $author->name }}</a>
        </td>
        <td>{{ $author->surname }}</td>
        <td>{{ $author->birthdate->format('Y-m-d')}}</td>
        <td>{{ $author->country }}</td>
        <td>
            <a href="{{ route('author.edit', ['id' => $author->id]) }}" class="btn btn-primary">Edit</a>
        </td>
        <td>
            <form action="{{ route('author.delete', ['id' => $author->id]) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection