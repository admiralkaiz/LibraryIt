@extends('template')

@section('title', $title)

@section('content')
    <div class="row p-5 container-fluid justify-content-center">
        <h1 class="text-center">
            Book Collection List
        </h1>
    </div>

    @if($admin_mode)
    <div class="row container-fluid justify-content-right text-end" style="width: 90%;">
        <div class="float-right">
            <a href="/admin/books/create" class="btn btn-primary">Add new book...</a>
        </div>
    </div>
    @endif


    <div class="row p-5 container-fluid justify-content-center">
        @foreach($list as $b)
        <div class="card mb-3" style="width: max-content;">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="/books/{{$b->image}}" class="img-fluid rounded-start">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h3 class="card-title">{{ $b->title }}</h5>
                        <p class="card-text">Author: {{ $b->author }}</p>
                        <p class="card-text">Publisher: {{ $b->publisher }}</p>
                        <p class="card-text">Publish year: {{ $b->year }}</p>
                        <a href="/{{ $role }}/books/{{ $b->id }}" class="btn btn-primary">Check Info</a>
                        @if($admin_mode)
                        <a href="/admin/books/{{ $b->id }}/edit" class="btn btn-secondary">Edit</a>
                        <form method="POST" action="/admin/books/{{ $b->id }}/delete" style="display:inline" onsubmit="return confirm('Yakin hapus?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger"> Delete </button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection
