@extends('components.layout')

@section('title', 'Create category')

@section('content')

<h1>Create new category</h1>

<form action="{{ url('categories/create') }}" method="post" class="row g-3">

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
        <label class="form-label">Category name:</label>
        <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" placeholder="Category name">
        @error('name')
        <div class="invalid-feedback">{{ $message }}</div><br>
        @enderror
    </div>
    

    <div class="form-group">
        <label class="form-label">Parent category:</label>
        <select name="category_id" class="form-control">
            <option value="">--</option>
            @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>


    <div class="form-group">
        <input type="checkbox" name="enabled" class="form-check-input" value="1" @if (old('enabled')) checked @endif>
        <label class="form-check-label">Enabled?</label>
    </div>
    <div class="col-12">
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
</form>

@endsection