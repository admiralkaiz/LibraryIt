@extends('newtemplate')

@section('title', $title)

@section('content')

<style>
body {
  font-family: 'Poppins', sans-serif;
  background-color: #D9D9D9;
  color: #333;
}
.navbar {
  display: flex;
  justify-content: flex-end;
  align-items: center;
  padding: 15px 30px;
  background-color: #D9D9D9;
  color: rgb(255, 255, 255);
}

.navbar-right {
  display: flex;
  align-items: center;
}

.navbar-link {
  margin-left: 20px;
  color: rgb(0, 0, 0);
  text-decoration: none;
  font-weight: bold;
}

.navbar-link:hover {
  color: #5352ED;
}

.search-form-nav {
  position: relative;
  margin-left: 20px;
  
}

.search-input-nav {
  padding: 5px 10px;
  border: 2px solid #000000;
  border-radius: 5px;
  background-color: #D9D9D9;
}

.search-button-nav {
  position: absolute;
  top: 50%;
  right: 5px;
  transform: translateY(-50%);
  background-color: transparent;
  border: none;
  color: #000000;
  cursor: pointer;
}

.navbar-masuk {
  margin-left: 20px;
  color: #000000;
  text-decoration: none;
}
.navbar-masuk:hover {
    color: #ED5353;
}
.navbar-button {
  margin-left: 20px;
  padding: 7px 15px;
  border: none;
  border-radius: 5px;
  background-color: #5352ED;
  color: white;
  cursor: pointer;
  border-bottom: none;
}

.navbar-button a {
    font-family: 'Poppins', sans-serif;
    color: white;
    text-decoration: none;
    font-weight: bold;
}

.navbar-button:hover {
    background-color: #ED5353;
}
.footer {
  position: relative;
  bottom: 0;
  width: 100%;
}

.footer-lapisan-atas{
  background-color: #7E90F3;
  padding: 10px 0;
  text-align: center;
  color: black;
  height: 320px;
  display: flex;
  justify-content: space-between;
}

.nav-container {
  position: relative;
}

.navbar img {
  position: absolute;
  top: 10px;
  left: 20px;
  width: 80px;
  height: auto;
}
.container {
    display: flex;
    align-items: left;
    padding: 20px;
    background-color: #ffffff;
    width: 1000px;
    margin-bottom: 20px;
    margin-top: 50px;
    margin-left: 230px;
    flex-wrap: wrap; /* Mengizinkan wrap jika konten melebihi lebar container */
    flex-direction: column; /* Menjadikan konten tersusun secara vertikal */
}

.profile-section {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
    margin-left: 50px;
    position: relative; /* Jarak antara setiap pasangan gambar dan informasi */
}

.profile-picture img{
    width: 100px;
    height: 120px;
    border-radius: 5px;
    margin-right: 20px;
    position: absolute; /* Menjadikan posisi absolut agar tetap di atas */
    top: 0;
}

.info {
    flex: 1; /* Memperluas agar mengisi sisa ruang */
}

.info h2 {
    margin-top: 0;
    margin-bottom: 5px; /* Menambahkan jarak antara judul dan nama */
}

.info p {
    margin: 0; /* Menghapus margin bawaan */
    margin-bottom: 5px; /* Menambahkan jarak antara nama dan elemen berikutnya */
}
.button-container {
    text-align: center; /* Membuat tombol berada di tengah secara horizontal */
    margin-top: 20px; /* Atur margin atas sesuai kebutuhan */
    margin-bottom: 20px; /* Atur margin bawah sesuai kebutuhan */
}

.mulai-menulis-button {
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    background-color: #6D67E4;
    color: white;
    cursor: pointer;
}

.mulai-menulis-button:hover {
    background-color: #ED5353;
}
.info table {
    margin-bottom: 20px;
    border-collapse: collapse;
    width: 100%;
}

.info table td {
    padding: 8px;
    border: 1px solid #dddddd;
    text-align: left;
}

.info table tr:nth-child(even) {
    background-color: #f2f2f2;
}
.komentar-container {
    margin-top: 20px;
}
.komentar-input {
    width: 300px;
    height: 100px;
    padding: 10px;
    border-radius: 5px;
    border: 1px solid #ccc;
    resize: vertical; /* Biarkan textarea dapat diubah ukurannya secara vertikal */
    margin-bottom: 10px;
}

.komentar-button {
    padding: 8px 16px;
    border: none;
    border-radius: 5px;
    background-color: #6D67E4;
    color: white;
    cursor: pointer;
}

.komentar-button:hover {
    background-color: #ED5353;
}
</style>

<div class="container">
<div class="profile-section">
    <div class="profile-picture">
        <img src="/books/{{$data->image}}" alt="Profile Picture">
    </div>
    <div class="info" style="margin-left: 120px;">
        <h2>Judul Buku</h2>
        <h3 style="margin-bottom: 5px;">Sinopsis</h3>
        <p style="margin-bottom: 20px;">{{$data->synopsis}}</p>
        <h3 style="margin-bottom: 5px;">Informasi Detail</h3>
        <p><b>Kepengarangan:</b> {{$data->author}}</p>
        <p><b>Penerbit:</b>  {{$data->publisher}}</p>
        <p><b>ISBN/ISSN:</b> {{$data->isbn}}</p>
        <div>
        @if($admin_mode)
            <a href="/admin/books/{{ $data->id }}/edit">Edit</a>
            <form method="POST" action="/admin/books/{{ $data->id }}/delete" style="display:inline" onsubmit="return confirm('Yakin hapus?')">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger"> Delete </button>
            </form>
        @endif
        </div>
        <div class="komentar-container">
            <h3 style="margin-bottom: 5px;">Tambahkan Review Anda:</h3>
            <!-- <textarea class="komentar-input" placeholder="Tambahkan komentar Anda di sini..."></textarea> -->
            <form class="border" style="padding: 20px" method="POST" action="/{{ $role }}/reviews/add">
                @csrf 
                <input type="hidden" name="_method" value="POST" />
                <input type="hidden" name="book_id" value="{{ $data->id }}">
                <div class="form-group p-2">
                    <label></label>
                    <textarea type="text" name="description" class="komentar-input" placeholder="Tambahkan komentar Anda di sini..."></textarea>
                </div>
                <div style="text-align:center">
                    <button class="komentar-button">Kirim</button>
                </div>
            </form>
            <div>
                <h3>Ulasan Buku</h3>
            @foreach($reviews as $r)
            <p><b>{{$r->user->name}}</b></p>
            <p>{{$r->description}}
            @if(Auth::user()->id == $r->user->id)
            <form method="POST" action="/{{ $role }}/reviews/{{ $r->id }}/delete" style="display:inline" onsubmit="return confirm('Yakin hapus?')">
                @csrf
                @method('DELETE')
                <button class=""> Hapus </button>
            </form>
            @endif    
            <br /><br /></p>
            @endforeach
            </div>
        </div> 
    </div>
</div>
</div>
@endsection