@extends('newtemplate')

@section('title', $title)

@section('content')
<div class="row p-5 container-fluid justify-content-center">
    <h1 align="center">
        Borrowing List
    </h1>
</div>
@if($admin_mode)
<div class="pagination-container" style="margin-top: 1px">
    <p align="center">
    <form action="/admin/borrowings/create">
        <input type="submit" value="Add Borrowing" />
    </form>
    </p>
</div>
@endif
<div class="table-container" style="margin-top: 1px; margin-bottom: 100px;">
@if($admin_mode)
    <div class="row container-fluid justify-content-right text-end" style="width: 90%;">
        <div class="float-right">
            <a href="/admin/borrowings/create" class="btn btn-primary">Add Borrowing</a>
        </div>
    </div>
    
    <div class="p-2"></div>
    <table class="table table-bordered table-striped">
        <tr>
            <th> Nama Peminjam </th>
            <th> Judul Buku </th>
            <th> Tanggal Peminjaman </th>
            <th> Tanggal Pengembalian </th>
            <th> Status Pengembalian </th>
            <th> Status Keterlambatan </th>
            <th> Aksi </th>
        </tr>
        @foreach($borrowings as $b)
        <tr>
            <td> {{ $b->user->name }} </td>
            <td> {{ $b->book->title }} </td>
            <td> {{ $b->borrow_date }} </td>
            <td> {{ $b->return_date }} </td>
            <td> {{ ($b->is_returned)?'SUDAH':'BELUM' }} </td>
            <td> {{ ($b->is_late)?'TELAT':'-' }} </td>
            <td>
                <form method="POST" action="/admin/borrowings/{{ $b->id }}/setReturned" style="display:inline" onsubmit="return confirm('Sudah mengembalikan?')">
                    @csrf
                    @method('PUT')
                    <button class="btn btn-success"> Set as Returned </button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    @endif

    @if(!$admin_mode)
    <table class="table table-bordered table-striped">
        <tr>
            <th> Judul Buku </th>
            <th> Tanggal Peminjaman </th>
            <th> Tanggal Pengembalian </th>
            <th> Status Pengembalian </th>
            <th> Status Keterlambatan </th>
        </tr>
        @foreach($borrowings as $b)
        @if ($b->user->id == Auth::user()->id && $b->is_returned != 1)
            <td> {{ $b->book->title }} </td>
            <td> {{ $b->borrow_date }} </td>
            <td> {{ $b->return_date }} </td>
            <td> {{ ($b->is_late)?'TELAT':'-' }} </td>
        @endif
        @endforeach
    </table>
    @endif
    </div>
@endsection