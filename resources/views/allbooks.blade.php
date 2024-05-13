@extends('newtemplate')

@section('title', 'LibraryIt | Books')

@section('content')
@if($admin_mode)
<div class="search-container" style="margin-top: 1px">
    <p align="center">
    <form action="/admin/books/create">
        <input type="submit" value="Add Book" />
    </form>
    </p>
</div>
@endif
<div class="table-container">
<table>
    <thead>
    <tr>
        <th>Judul</th>
        <th>Tahun</th>
        <th>Kepengarangan</th>
        <th>Penerbit</th>
        <th>ISBN</th>
        @if($admin_mode)
        <th>Aksi</th>
        @endif
    </tr>
    </thead>
    <tbody>
        @foreach($list as $b)
        <tr>
            <td><a href="/{{ $role }}/books/{{ $b->id }}">{{$b->title}}</a></td>
            <td>{{$b->year}}</td>
            <td>{{$b->author}}</td>
            <td>{{$b->publisher}}</td>
            <td>{{$b->isbn}}</td>
            @if($admin_mode)
            <td>
            <a href="/admin/books/{{ $b->id }}/edit">Edit</a>
            <form method="POST" action="/admin/books/{{ $b->id }}/delete" style="display:inline" onsubmit="return confirm('Yakin hapus?')">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger"> Delete </button>
            </form>
            </td>
            @endif
        </tr>
        @endforeach
    </tbody>
</table>
</div>
{{ $list->links() }}
</div>

@endsection