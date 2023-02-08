@extends('components.layout')

@section('title', 'User profile')

@section('content')

<h1>User profile</h1>
<div class="card">
    <div class="card-header">
        {{ $user->name }} profile
    </div>
    <div class="card-body">
        <p class="card-text">Name: {{ $user->name }}</p>
        <p class="card-text">Email: {{ $user->email }}</p>
        <p class="card-text">Joined on: {{ $user->email_verified_at->format('Y-m-d') }}</p>
    </div>
</div>
<br>
<br>
@endsection