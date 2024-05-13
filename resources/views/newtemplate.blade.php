<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title> @yield('title') </title>
<link rel="stylesheet" href="StyleLandingPage.css">
<link rel="stylesheet" href="Style.css">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
.search-container {
  padding: 10px;
  width: 1100px; /* Atur lebar kotak */
  height: auto;
  margin-bottom: 60px;
  background-color: #ffffff;
  margin-left: 170px;
  margin-top: 100px;
  /* Atur ketinggian kotak sesuai kontennya */
}

.search-bar {
  display: flex;
  align-items: center;
  margin-bottom: 10px;
}

.search-bar input[type="text"] {
  flex: 1; /* Biarkan input search bar memperluas sebanyak mungkin */
  padding: 5px;
  border: none;
}

.search-button {
  padding: 5px 10px;
  background-color: #6D67E4;
  color: white;
  border: none;
  margin-right: 200px;
  display: flex;
  top: 209px;
  height: 98px;
  width: 50px;
}
.search-button i{
    margin: auto;
}

.separator {
  margin: 10px 0;
}

.filter-container {
  margin-bottom: 10px;
  display: flex;
  align-items: center;
  font-size: 12px;
}

.filter-container input[type="checkbox"] {
  margin-right: 5px;
  /* Membuat checkbox bundar */
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
  width: 15px;
  height: 15px;
  background-color: #D9D9D9;
  border-radius: 50%;
  outline: none;
  cursor: pointer;
}

.filter-container input[type="checkbox"]:checked {
  background-color: #8088D3;
}
.search-contact-button {
  width: 100%;
  padding: 10px;
  background-color: #007bff;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}
.table-container {
  margin-top: 20px;
  width: 1200px;
  margin-left: 135px;
  margin-bottom: 20px;
}

table {
  width: 100%;
  border-collapse: collapse;
}

th, td {
  padding: 10px;
  background-color: #ffffff;
  border: 1px solid #ccc;
}
th {
  background-color: #869BC7;
  font-weight: bold;
  text-align: center;
}

.pagination-container {
  display: inline-block;
  list-style: none;
  padding: 0;
  background-color: #ffffff; /* Memberikan latar belakang putih */
  padding: 1px 5px; /* Penyesuaian padding */ /* Penyesuaian border-radius */
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  margin-bottom: 200px;
  text-align: right;
  clear: both;  
  margin-left: 135px;
  width: 1190px;
}

.pagination {
  display: inline-block;
  list-style: none;
  padding: 0;
}

.pagination li {
  display: inline;
}

.pagination li a {
  padding: 5px 10px;
  margin-right: 5px;
  text-decoration: none;
  color: #333;
}

.pagination li a:hover {
  background-color: #f2f2f2;
}

</style>
</head>
<body>
<div class="nav-container">
    <nav class="navbar">
        <div class="navbar-right">
          <a href="/{{ (Auth::user()->is_admin==1)?'admin':'user' }}/books" class="navbar-link">Buku</a>
          <a href="/{{ (Auth::user()->is_admin==1)?'admin':'user' }}/posts" class="navbar-link">Postingan</a>
          @if(Auth::user()->is_admin==1)
          <a href="/{{ (Auth::user()->is_admin==1)?'admin':'user' }}/borrowings" class="navbar-link">Daftar Peminjaman</a>
          @elseif(Auth::user()->is_admin!=1)
          <a href="/{{ (Auth::user()->is_admin==1)?'admin':'user' }}/borrowings" class="navbar-link">Informasi Peminjaman</a>
          @endif
          <a class="navbar-masuk"><i class="fa fa-person"></i>{{Auth::user()->name}}</a>
          <button class="navbar-button"><a href="/logout">Keluar</a></button>
        </div>
    </nav>
    @yield('content')
</div>
<footer class="footer">
  <div class="footer-lapisan-bawah"></div>
  <div class="footer-lapisan-atas">
    <div class="footer-kiri" style="color: #ffffff;">
      <img src="Assets/gbr.png" alt="" style="width: 130px; display: block; margin-left: 40px; margin-top: 20px;">
      <h2 style="text-align: left; margin-left: 40px;">Jam Operasional Layanan</h2>
      <p style="text-align: left; margin-left: 40px; font-weight: bold;">Senin-Jumat 08.00 - 16.00 WIB</p>
      <p style="text-align: left; margin-left: 40px; font-weight: bold;">Sabtu-Minggu 09.00 - 15.30 WIB</p>
      <p style="text-align: left; margin-left: 40px; font-weight: bold;">Cuti Bersama dan Libur Nasional : Tutup</p>
    </div>
    <div class="footer-kanan" style="color: #ffffff;">
      <h2 style="text-align: left; margin-right: 40px;">Kontak Kami</h2>
      <p style="text-align: left; margin-right: 40px; font-weight: bold;">Telepon</p>
      <p style="text-align: left; margin-right: 40px;">081280000110</p>
      <p style="text-align: left; margin-right: 40px; font-weight: bold; margin-top: 40px;">Email</p>
      <p style="text-align: left; margin-right: 40px;">libraryit[at]go.id</p>
      <p style="text-align: left; margin-right: 40px; font-weight: bold; margin-top: 40px;">Alamat</p>
      <p style="text-align: left; margin-right: 40px;">Jl. Perintis Kemerdakaan No. 11 Jakarta, Indonesia</p>
    </div>
  </div>
</footer>
</body>
</html>
