@extends('template')

@section('title', $title)

@section('content')
    @if (isset($err_msg))
    <h1 class="p-5 text-center">{{ $err_msg }}</h1>
    @else
    <h1 class="p-5 text-center">{{ $data->title }}</h1>
    <div class="row p-0 container-fluid justify-content-center">

        <!-- This is for book anatomy -->
        <div class="row g-0" style="width: max-content;">
            <div class="col-md-4">
                <img src="/books/{{$data->image}}" class="img-fluid" width="400px">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <p class="card-text">
                        <table class="table table-bordered">
                            <tr>
                                <th>
                                    ISBN
                                </th>
                                <td>
                                    {{ $data->isbn }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Author
                                </th>
                                <td>
                                    {{ $data->author }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Publisher
                                </th>
                                <td>
                                    {{ $data->publisher }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Publish Year
                                </th>
                                <td>
                                    {{ $data->year }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Synopsis
                                </th>
                                <td>
                                    {{ $data->synopsis }}
                                </td>
                            </tr>
                        </table>
                    </p>
                    @if($admin_mode)
                    <a href="/admin/books/{{ $data->id }}/edit" class="btn btn-secondary">Edit</a>
                    <a href="/admin/books/{{ $data->id }}/delete " class="btn btn-danger">Delete</a>
                    @endif
                </div>
            </div>
        </div>

        <!-- Form for write review -->
        <div class="row g-0 p-5 gy-2 justify-content-center" style="width: max-content;">
            <h4 class="text-center">
                Write your review...
            </h4>
            <form class="border" style="padding: 20px" method="POST" action="/{{ $role }}/reviews/add">
                @csrf 
                <input type="hidden" name="_method" value="POST" />
                <input type="hidden" name="book_id" value="{{ $data->id }}">
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
                Reviews
            </h4>
            <div class="justify-content-center text-center" style="width: max-content;">
            @foreach($reviews as $r)
            <div class="card mb-3" style="width: 120%;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="/reviews/{{$r->image}}" class="img-fluid rounded-start">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h3 class="card-title">{{ $r->title }}</h5>
                            <br>
                            <p class="card-text">By: {{ $r->user->name }}</p>
                            <br>
                            <p class="card-text">{{ $r->description }}</p>
                            <br>
                            <br>
                            @if(Auth::user()->id == $r->user->id)
                            <form method="POST" action="/{{ $role }}/reviews/{{ $r->id }}/delete" style="display:inline" onsubmit="return confirm('Yakin hapus?')">
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
    @endif
@endsection