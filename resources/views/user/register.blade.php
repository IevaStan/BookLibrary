@extends('components.layout')

@section('title', 'Signup')

@section('content')

<h1>Signup</h1>
<br>
<br>

<form action="{{ route('create.user') }}" method="post">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @csrf
    <div class="form-group">
        <label class="form-label">Name</label>
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Your name" value="{{ old('name') }}">
        @error('name')
        <div class="invalid-feedback">{{ $message }}</div><br>
        @enderror
    </div>

    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email address</label>
        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ old('email') }}">
        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        @error('email')
        <div class="invalid-feedback">{{ $message }}</div><br>
        @enderror
    </div>

    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="exampleInputPassword1">
        @error('password')
        <div class="invalid-feedback">{{ $message }}</div><br>
        @enderror
    </div>

    <div class="form-group">
        <label class="form-label">Role</label>
        <select name="role" class="form-control @error('role') is-invalid @enderror">
            <option></option>
            <option value="Admin">Admin</option>
            <option value="Customer">Customer</option>
        </select>
        @error('role')
        <div class="invalid-feedback">{{ $message }}</div><br>
        @enderror
    </div>
    <br>
    <button type="submit" class="btn btn-primary">Submit</button>
    
</form>
<br>
<br>
@endsection