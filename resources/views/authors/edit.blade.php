@extends('components.layout')

@section('title', 'edit author '. $author->name.' '.$author->surname)

@section('content')

<h1>Edit author's "{{ $author->name }} {{ $author->surname }}" data</h1>

<form action="{{ route('author.edit', ['id' => $author->id]) }}" method="post" class="row g-3">

    <!-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif -->

    @csrf
    <div class="col-md-6">
        <label class="form-label">Name:</label>
        <input type="text" name="name" value="{{ old('name', $author->name) }}" class="form-control @error('name') is-invalid @enderror" placeholder="Author's name">
        @error('name')
        <div class="invalid-feedback">{{ $message }}</div><br>
        @enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Surname:</label>
        <input type="text" name="surname" value="{{ old('surname', $author->surname) }}" class="form-control @error('surname') is-invalid @enderror" placeholder="Author's surname">
        @error('surname')
        <div class="invalid-feedback">{{ $message }}</div><br>
        @enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Country Of Origin:</label>
        <input type="text" name="country" value="{{ old('country', $author->country) }}" class="form-control @error('country') is-invalid @enderror" placeholder="Author's birthplace">
        @error('country')
        <div class="invalid-feedback">{{ $message }}</div><br>
        @enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Birthdate:</label>
        <input type="date" name="birthdate" value="{{ old('birthdate', $author->birthdate->format('Y-m-d')) }}" class="form-control @error('birthdate') is-invalid @enderror" placeholder="Author's date of birth">
        @error('birthdate')
        <div class="invalid-feedback">{{ $message }}</div><br>
        @enderror
    </div>
    <div class="col-12">
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
</form>

@endsection