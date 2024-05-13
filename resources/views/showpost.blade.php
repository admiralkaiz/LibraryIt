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
    position: relative; /* Jarak antara setiap pasangan gambar dan informasi */
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
.info img{
    width: 200px;
    height: 200px;
    align-items: center;
    display: block;
    margin: 0 auto;
}
.container-box {
    display: flex; /* Mengaktifkan flexbox */
}

.code-box {
    background-color: #5352ED; /* Warna biru */
    padding: 5px; /* Padding untuk memberikan ruang di sekitar teks */
    border-radius: 5px; /* Membuat sudut kotak menjadi melengkung */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Efek bayangan untuk menampilkan kotak */
    margin-bottom: 20px;
    width: 100px;
    height: 20px;
    text-align: center;
    color: #ffffff; /* Memberikan ruang di bawah kotak */
}

.code-box2 {
    background-color: #5352ED;
    padding: 5px;
    border-radius: 5px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
    width: 150px;
    height: 20px;
    text-align: center;
    color: #ffffff;
    margin-left: 10px; /* Memberikan jarak antara .code-box dan .code-box2 */
}
</style>

<div class="container">
        <div class="profile-section">
            <div class="info" style="margin-left: 120px;">
                <h2>{{$data->title}}</h2>
                <div class="container-box">
                <div class="code-box2"><p style="margin-bottom: 20px;">Oleh {{$data->user->name}}</p></div>
                @if ($data->user->id==Auth::user()->id)
                <br />
                <br />
                <form method="POST" action="/{{ $role }}/posts/{{ $data->id }}/delete" style="display:inline" onsubmit="return confirm('Yakin hapus?')">
                    @csrf
                    @method('DELETE')
                    <button class=""> Hapus </button>
                </form>
                <br />
                <br />
                <br />
                @endif
                </div>
                @if (isset($data->image))
                <img src="/posts/{{$data->image}}" alt="" style="margin-bottom: 20px;">
                @endif
                <p>{{$data->description}}</p>
            </div>
        </div>

@endsection