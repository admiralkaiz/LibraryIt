@extends('template')

@section('title', 'LibraryIt | Posts')

@section('content')
<div class="row p-0 container-fluid justify-content-center">

<!-- Form for write post -->
<div class="row g-0 p-5 gy-2 justify-content-center" style="width: max-content;">
    <h4 class="text-center">
        Write something meaningful...
    </h4>
    <form class="border" style="padding: 20px" method="POST" action="/{{ $role }}/posts/add">
        @csrf 
        <input type="hidden" name="_method" value="POST" />
        <div class="form-group p-2">
            <label>Title</label>
            <input type="text" name="title" class="form-control " value="" />
        </div>
        <div class="form-group p-2">
            <label>Description</label>
            <input type="text" name="description" class="form-control" value="" />
        </div>
        <div style="text-align:center">
            <button class="btn btn-success">Post</button>
        </div>
    </form>
</div>

<!-- Show all reviews... -->
<div class="row g-0 p-5 justify-content-center">
    <h4 class="text-center">
        All Posts
    </h4>
    <div class="justify-content-center text-center" style="width: max-content;">
    @foreach($list as $p)
    <div class="card mb-3" style="width: 512px;">
        <div class="row g-0">
            <div class="col-md-4">
                @if (isset($p->image))
                <img src="/reviews/{{$p->image}}" class="img-fluid rounded-start">
                @endif
            </div>
        </div>
        <div class="row g-0">
            <div class="col-md-8">
                <div class="card-body">
                    <h3 class="card-title">{{ $p->title }}</h5>
                    <br>
                    <p class="card-text">By: {{ $p->user->name }}</p>
                    <br>
                    <p class="card-text">{{ $p->description }}</p>
                    <br>
                    <br>
                    @if(Auth::user()->id == $p->user->id)
                    <form method="POST" action="/{{ $role }}/posts/{{ $p->id }}/delete" style="display:inline" onsubmit="return confirm('Yakin hapus?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger"> Hapus </button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endforeach
    </div>
</div>

</div>
@endsection