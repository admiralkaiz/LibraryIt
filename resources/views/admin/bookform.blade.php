@extends('template')

@section('title', $title)

@section('content')
<div class="col-3">
            <p>
                <a href="/admin/books">
                    Back
                </a>
            </p>
            <h4>
                {{ $title }}
            </h4>
            <form class="border" style="padding:20px" method="POST" action="{{ $action }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" value="{{ $method }}" />
                <div class="form-group">
                    <label>
                        ISBN code
                    </label>
                    <input type="text" name="isbn" class="form-control @error('isbn') is-invalid @enderror" value="{{ isset($data)?$data->isbn:old('isbn') }}">
                    @error('isbn')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>
                        Title
                    </label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ isset($data)?$data->title:old('title') }}">
                    @error('title')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>
                        Author
                    </label>
                    <input type="text" name="author" class="form-control @error('author') is-invalid @enderror" value="{{ isset($data)?$data->author:old('author') }}">
                    @error('author')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>
                        Publisher
                    </label>
                    <input type="text" name="publisher" class="form-control @error('publisher') is-invalid @enderror" value="{{ isset($data)?$data->publisher:old('publisher') }}">
                    @error('publisher')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>
                        Year
                    </label>
                    <input type="number" name="year" class="form-control @error('year') is-invalid @enderror" value="{{ isset($data)?$data->year:old('year') }}">
                    @error('year')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>
                        Synopsis
                    </label>
                    <input type="text" name="synopsis" class="form-control @error('synopsis') is-invalid @enderror" value="{{ isset($data)?$data->synopsis:old('synopsis') }}">
                    @error('synopsis')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>
                        Cover Image
                    </label>
                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" value="{{ isset($data)?$data->image:old('image') }}">
                    @error('image')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div style="text-align:center">
                    <button class="btn btn-success">
                        Save
                    </button>
                </div>
            </form>
        </div>
@endsection