@extends('newtemplate')

@section('title', 'LibraryIt | Posts')

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
    align-items: center;
    padding: 20px;
    background-color: #ffffff;
    width: 1000px;
    margin-bottom: 20px;
    margin-top: 50px;
    margin-left: 230px; /* Mengizinkan wrap jika konten melebihi lebar container */
    flex-direction: column; /* Menjadikan konten tersusun secara vertikal */
}

.profile-section {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-bottom: 20px;
    margin-left: 50px; /* Jarak antara setiap pasangan gambar dan informasi */
}

.profile-picture img{
    width: 300px;
    height: 200px;
    border-radius: 5px;
    margin-right: 20px;
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
.news{
  border-radius: 5px;
  border: none;
  background-color: #6D67E4;
  height: 40px;
  color: #ffffff;
  width: 170px;
}
.news:hover {
    background-color: #ED5353;
}
.addnewpost-container {
    width: 400px;
    text-align: center;
    padding: 20px;
    background-color: #ffffff;
}
.addnewpost-container h3 {
    margin-bottom: 20px;
    background-color: #000000;
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
}
.addnewpost-container label {
    float: left;
    text-align: left;
    width: 100%;
    margin-bottom: 7px;
    color: #6D67E4;
    font-family: 'Poppins', sans-serif;
    font-weight: 600;
}
.addnewpost-container button {
    width: 75%;
    height: 35px;
    padding: 10px;
    margin-top: 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}
.addnewpost-container button.posting-button {
    background-color: #6D67E4;
    color: white;
    font-size: 17px;
    top: 50%;
    margin-top: 30px;
}
.addnewpost-container button:hover {
    opacity: 0.8;
}
.addnewpost-container button.posting-button:hover {
    background-color: #FF7F56;
}
.addnewpost-container input[type="file"],
.addnewpost-container input[type="text"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #6D67E4;
    border-radius: 10px;
    box-sizing: border-box;
    padding-left: 20px;
}
</style>

<div class="addnewpost-container" style="margin-left: auto; margin-right:auto">
    <h3>Add New Post</h3>
    <form class="border" style="padding: 20px" method="POST" action="/{{ $role }}/posts/add">
    @csrf
        <div>
            <label for="judul" >Judul</label><br>
            <input type="text" name="title" style="margin-bottom: 20px;"><br>
        </div>
        <div>
            <label for="deskripsi" >Deskripsi</label><br>
            <textarea type="text" name="description" style="margin-bottom: 20px;"></textarea>
        </div>
        <div>
            <label for="gambar" >Gambar</label><br>
            <input type="file" id="image" name="image" style="margin-bottom: 20px;"><br>
        </div>
        <button type="submit" class="posting-button">Posting</button>
    </form>
</div>

<div class="container">
  <h2>Postingan Terkini</h2>
  @foreach ($list as $p)
  <div class="profile-section">
      @if (isset($p->image))
      <div class="profile-picture">
          <img src="/reviews/{{$p->image}}" alt="Profile Picture" style="margin-bottom: 20px;">
      </div>
      @endif
      <div class="info">
          <p style="margin-bottom: 20px; text-align: center;">{{$p->title}}</p>
      </div>
      <form action="/{{$role}}/posts/{{$p->id}}">
        <button class="news" type="submit">Lihat Berita</button>
      </form>
  </div>
  @endforeach
</div>

<div class="container">
  {{$list->links()}}
</div>

@endsection