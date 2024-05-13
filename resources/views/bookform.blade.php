@extends('newtemplate')

@section('title', $title)

@section('content')
<style>
    .addbuku-container {
    width: 400px;
    text-align: center;
    padding: 20px;
    background-color: #ffffff;
}
.addbuku-container h3 {
    margin-bottom: 20px;
    background-color: #000000;
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
}
.addbuku-container label {
    float: left;
    text-align: left;
    width: 100%;
    margin-bottom: 7px;
    color: #6D67E4;
    font-family: 'Poppins', sans-serif;
    font-weight: 600;
}
.addbuku-container button {
    width: 75%;
    height: 35px;
    padding: 10px;
    margin-top: 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}
.addbuku-container button .tambah-button {
    background-color: #FF7F56;
    color: white;
    font-size: 17px;
    top: 50%;
    margin-top: 30px;
}
.addbuku-container button:hover {
    opacity: 0.8;
}
.addbuku-container button .tambah-button:hover {
    background-color: #6D67E4;
}
.addbuku-container input[type="file"],
.addbuku-container input[type="text"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #6D67E4;
    border-radius: 10px;
    box-sizing: border-box;
    padding-left: 20px;
}
</style>
<div class="addbuku-container" style="width: 50%; margin-left:auto; margin-right:auto">
            <h3>Tambah Buku</h3>
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
                    <button type="submit" class="tambah-button" style="background-color: #FF7F56; color: #ffffff;">
                        Save
                    </button>
                </div>
            </form>
        </div>
@endsection