@extends('template')

@section('title', $title)

@section('content')
<div class="container">
    <h3>Form Peminjaman Buku</h3>
    <form action="/admin/borrowings/store" method="POST">
        @csrf
        <div>
            <label for="namalengkap" >Nama Lengkap</label><br>
            <select id="namalengkap" name="user_id">
                @foreach($userslist as $u)
                <option value="{{ $u->id }}"> {{ $u->name }} </option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="judul" >Judul Buku</label><br>
            <select id="judul" name="book_id">
                @foreach($bookslist as $b)
                <option value="{{ $b->id }}"> {{ $b->title }} </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="selesia-button">Selesai</button>
    </form>
</div>
@endsection