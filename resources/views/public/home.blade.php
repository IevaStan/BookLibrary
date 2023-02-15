@extends('components.min_layout')

@section('content')

<div class="container text-center">
    <div class="row">
        @foreach($books as $book)
        <div class="col-3 mb-3">
            <div class="card " style="width: 18rem;">
                <img src="{{ asset($book->image) }}" class="img-fluid card-img-top">
                
                <div class="card-header ">
                    <h5 class="card-title text-primary pt-2">
                        {{ $book->name }}
                    </h5>
                </div>

                <div class="card-body">
                    <h6 class="card-title mb-2 text- text-muted ">by Knygos autorius</h6>
                    @if($book->category)
                    <h6 class="card-subtitle mb-2 fw-light text-uppercase">{{ $book->category->name }}</h6>
                    @endif
                    <p class="card-text">{{ $book->page_count }} pages, {{ $book->description }} </p>
                    <a href="{{ url('book/show', ['id' => $book->id]) }}" class="btn btn-primary">About book</a>
                </div>

            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection