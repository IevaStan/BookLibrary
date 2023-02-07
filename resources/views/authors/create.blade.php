@extends('components.layout')

@section('title', 'Authors')

@section('content')
<h1>Add a new author</h1>

<form action="{{ url('authors/create') }}" method="post" class="row g-3">

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
    <div class="form-group">
        <label class="form-label">Name:</label>
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="First name">
        @error('name')
        <div class="invalid-feedback">{{ $message }}</div><br>
        @enderror
    </div>
    <div class="form-group">
        <label class="form-label">Surname:</label>
        <input type="text" name="surname" class="form-control @error('surname') is-invalid @enderror" placeholder="Second name">
        @error('surname')
        <div class="invalid-feedback">{{ $message }}</div><br>
        @enderror
    </div>
    <div class="form-group">
        <label class="form-label">Date of birth</label>
        <input type="date" name="birthdate" class="form-control @error('birthdate') is-invalid @enderror">
        {{--pas Mindaugą type="text" placeholder="Birthday" --}}
        @error('birthdate')
        <div class="invalid-feedback">{{ $message }}</div><br>
        @enderror
    </div>
    <div class="form-group">
        <label class="form-label">Country of origin</label>
        <input type="text" name="country" class="form-control @error('country') is-invalid @enderror" placeholder="Country">
        @error('country')
        <div class="invalid-feedback">{{ $message }}</div><br>
        @enderror
    </div>
    <div class="col-12">
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
</form>
@endsection