<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Form Pengembalian</title>
<link rel="stylesheet" type="text/css" href="{{ asset('/css/StyleLandingPage.css') }}">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
  .card-container-kiri {
    background-color: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin-top: 60px;
    width: 40%;
    height: 200px;
    float: left;
    position: relative;
    z-index: 1;
  }
  .card-container-kiri h2{
    text-align: left;
    margin-left: 270px;
    margin-top: 20px;
  }
  .card-container-kiri p {
    text-align: left;
    margin-left: 270px;
  }
  .card-container-kanan {
    background-color: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin-top: 60px;
    width: 40%;
    height: 200px;
    float: right;
    position: relative;
    z-index: 1; 
  }
  .card-container-kanan h2{
    text-align: right;
    margin-top: 20px;
    margin-right: 20px;
  }
  .card-container-kanan p {
    text-align: right;
    margin-right: 20px;
  }
  .custom-button {
    background-color: #ED5353;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    margin-top: 10px;
    float: left;
    margin-left: 270px;
    width: 200px;
  }
  .custom-button:hover {
    background-color: #C94545;
  }
  .background-in-card {
    background-color: #f7f7f7a0;
    width: 100%;
    height: 360px;
    clear: both;
    margin-top: 60px;
    position: relative;
    z-index: 2;
  }
  .background-book-card {
    background-color: #E3FFF6;
    width: 100%;
    height: 515px;
    clear: both;
    position: relative;
    z-index: 2;
    padding: 20px;
    box-sizing: border-box;
    overflow-x: auto;
    overflow-y: hidden;
    white-space: nowrap;
    display: flex;
}
  .card-book {
    background-color: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    width: 14%;
    margin: 10px;
    float: left;
    text-align: center;
    flex: 0 0 auto;
    position: relative;
    height: 300px;
    margin-top: 80px;
  }
  .card-book img {
    width: 150px;
    border-radius: 5px;
  }
  .card-book p.title {
    position: absolute;
    bottom: 40px;
    width: 100%;
    margin: 0;
    padding: 0;
    left: 0;
    right: 0;
  }
  .card-book p.author {
    position: absolute;
    bottom: 20px;
    width: 100%;
    margin: 0;
    padding: 0;
    left: 0;
    right: 0;
  }
  .background-book-card h3,
  .background-news-card h3 {
    position: absolute;
    top: 20px;
    left: 50%;
    transform: translateX(-50%);
    z-index: 2;
    text-align: center;
    width: 100%;
}
  .background-news-card {
    background-color: #f7f7f7a0;
    width: 100%;
    height: 450px;
    clear: both;
    position: relative;
    z-index: 2;
    padding: 20px;
    box-sizing: border-box;
    overflow-x: auto;
    overflow-y: hidden;
    white-space: nowrap;
    display: flex;
}
.card-news {
    background-color: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    width: 18%;
    margin: 10px;
    float: left;
    text-align: center;
    flex: 0 0 auto;
    position: relative;
    height: 200px;
    margin-top: 80px;
  }
  .card-news img {
    width: 150px;
    border-radius: 5px;
  }
  .card-news p.title {
    position: absolute;
    bottom: 60px;
    width: 100%;
    margin: 0;
    padding: 0;
    left: 0;
    right: 0;
    text-align: left;
    margin-left: 10px;
  }
  .card-news p.author {
    position: absolute;
    bottom: 20px;
    width: 100%;
    margin: 0;
    padding: 0;
    left: 0;
    right: 0;
    text-align: left;
    margin-left: 10px;
  }
  .card-news p.date {
    position: absolute;
    bottom: 40px;
    width: 100%;
    margin: 0;
    padding: 0;
    left: 0;
    right: 0;
    text-align: left;
    margin-left: 10px;
}
.footer {
  position: relative;
  bottom: 0;
  width: 100%;
}

.footer-lapisan-bawah {
  background-color: #f7f7f7a0;
  padding: 20px 0;
  height: 50px;
  display: flex; 
  justify-content: space-between;
  align-items: flex-end;
}
.footer-lapisan-bawah p {
  margin: 0;
}

.footer-lapisan-atas{
  background-color: #8197C7;
  padding: 10px 0;
  text-align: center;
  color: black;
  height: 320px;
  display: flex;
  justify-content: space-between;
}
</style>
</head>
<body>
<div class="nav-container">
    <nav class="navbar">
        <div class="navbar-right">
          <a href="#" class="navbar-link">Beranda</a>
          <a href="#" class="navbar-link">Kategori</a>
          <form action="#" class="search-form">
            <input type="text" placeholder="Cari..." class="search-input">
            <button type="submit" class="search-button"><i class="fa fa-search"></i></button>
          </form>
          <a href="/login"class="navbar-masuk">Masuk</a>
          <button class="navbar-button"><a href="/register">Daftar</a></button>
        </div>
      </nav>      
</div>
<div class="add-teks">
    <span>Jelajahi Dunia Pengetahuan bersama</span> LibraryIt!
</div>
<div class="gambar-container">
  <img src="Assets/library.png" alt="LibraryIt Logo" class="gambar-landing">
</div>
<div class="container-kotak1">
  <div class="bulat"></div>
  <div class="kotak">
    <p>Terpercaya oleh lebih dari <span>500 ribu</span> pembaca</p>
  </div>
</div>
<div class="container-kotak2">
  <div class="bulat"></div>
  <div class="kotak">
    <p>Akses lebih dari <span>30 juta</span> publikasi penelitian</p>
  </div>
</div>
<div class="container-kotak3">
  <div class="bulat"></div>
  <div class="kotak">
    <p>Unduh lebih dari <span>400 ribu</span> e-book </p>
  </div>
</div>
<div class="container-kotak4">
  <div class="bulat-kiri4"></div>
  <div class="kotak-kiri4">
    <p>E - Book</p>
  </div>
</div>
<div class="container-kotak5">
  <div class="bulat-kiri5"></div>
  <div class="kotak-kiri5">
    <p>Jurnal</p>
  </div>
</div>
<div class="container-kotak6">
  <div class="bulat-kiri6"></div>
  <div class="kotak-kiri6">
    <p>Artikel</p>
  </div>
</div> 

<!-- <div class="background-in-card">
  <div class="card-container-kiri">
    <h2>ISBN</h2>
    <p>International Standard Book Number</p>
    <button class="custom-button">Cari Buku</button>
  </div>
  <div class="card-container-kanan">
    <h2>Ask A Librarian!</h2>
    <p>Feel free to contact us</p>
  </div>
</div>
<div class="background-book-card">
  <h3>Temukan Sinopsis Yang Menarik</h3>
  <div class="card-book">
    <img src="Assets/12.png" alt="Cover Buku 1">
    <p class="title" style="color: #5352ED;">Judul Buku 5</p>
    <p class="author">Penulis 1</p>
  </div>
  <div class="card-book">
    <img src="Assets/16.jpg" alt="Cover Buku 2">
    <p class="title" style="color: #5352ED;">Judul Buku 5</p>
    <p class="author">Penulis 2</p>
  </div>
  <div class="card-book">
    <img src="Assets/25.jpeg" alt="Cover Buku 3">
    <p class="title" style="color: #5352ED;">Judul Buku 5</p>
    <p class="author">Penulis 3</p>
  </div>
  <div class="card-book">
    <img src="Assets/25.jpeg" alt="Cover Buku 4">
    <p class="title" style="color: #5352ED;">Judul Buku 5</p>
    <p class="author">Penulis 4</p>
  </div>
  <div class="card-book">
    <img src="Assets/25.jpeg" alt="Cover Buku 5">
    <p class="title" style="color: #5352ED;">Judul Buku 5</p>
    <p class="author">Penulis 5</p>
  </div>
  <div class="card-book">
    <img src="Assets/25.jpeg" alt="Cover Buku 5">
    <p class="title" style="color: #5352ED;">Judul Buku 5</p>
    <p class="author">Penulis 5</p>
  </div>
</div>
<div class="background-news-card">
  <h3>Berita Terbaru</h3>
  <div class="card-news">
    <img src="Assets/19.png" alt="Cover Buku 1">
    <p class="title" style="color: #5352ED;">Judul Buku 5</p>
    <p class="date">05/05/2024</p>
    <p class="author">Penulis 1</p>
  </div>
  <div class="card-news">
    <img src="Assets/19.png" alt="Cover Buku 2">
    <p class="title" style="color: #5352ED;">Judul Buku 5</p>
    <p class="date">05/05/2024</p>
    <p class="author">Penulis 2</p>
  </div>
  <div class="card-news">
    <img src="Assets/19.png" alt="Cover Buku 3">
    <p class="title" style="color: #5352ED;">Judul Buku 5</p>
    <p class="date">05/05/2024</p>
    <p class="author">Penulis 3</p>
  </div>
  <div class="card-news">
    <img src="Assets/19.png" alt="Cover Buku 4">
    <p class="title" style="color: #5352ED;">Judul Buku 5</p>
    <p class="date">05/05/2024</p>
    <p class="author">Penulis 4</p>
  </div>
  <div class="card-news">
    <img src="Assets/19.png" alt="Cover Buku 5">
    <p class="title" style="color: #5352ED;">Judul Buku 5</p>
    <p class="date">05/05/2024</p>
    <p class="author">Penulis 5</p>
  </div>
  <div class="card-news">
    <img src="Assets/19.png" alt="Cover Buku 5">
    <p class="title" style="color: #5352ED;">Judul Buku 5</p>
    <p class="date">05/05/2024</p>
    <p class="author">Penulis 5</p>
  </div>
</div>
<footer class="footer">
  <div class="footer-lapisan-bawah"></div>
  <div class="footer-lapisan-atas">
    <div class="footer-kiri">
      <img src="Assets/Facebook.jpg" alt="" style="width: 130px; display: block; margin-left: 40px; margin-top: 20px;">
      <h2 style="text-align: left; margin-left: 40px;">Jam Operasional Layanan</h2>
      <p style="text-align: left; margin-left: 40px; font-weight: bold;">Senin-Jumat 08.00 - 16.00 WIB</p>
      <p style="text-align: left; margin-left: 40px; font-weight: bold;">Sabtu-Minggu 09.00 - 15.30 WIB</p>
      <p style="text-align: left; margin-left: 40px; font-weight: bold;">Cuti Bersama dan Libur Nasional : Tutup</p>
    </div>
    <div class="footer-kanan">
      <h2 style="text-align: left; margin-right: 40px;">Kontak Kami</h2>
      <p style="text-align: left; margin-right: 40px; font-weight: bold;">Telepon</p>
      <p style="text-align: left; margin-right: 40px;">081280000110</p>
      <p style="text-align: left; margin-right: 40px; font-weight: bold; margin-top: 40px;">Email</p>
      <p style="text-align: left; margin-right: 40px;">libraryit[at]go.id</p>
      <p style="text-align: left; margin-right: 40px; font-weight: bold; margin-top: 40px;">Alamat</p>
      <p style="text-align: left; margin-right: 40px;">Jl. Perintis Kemerdakaan No. 11 Jakarta, Indonesia</p>
    </div>
  </div>
  <div class="footer-lapisan-bawah">
    <p class="hak-cipta" style="margin-left: 40px; font-weight: bold;">Hak Cipta 2023 © LibraryIt!</p>
    <p class="jml-pengunjung" style="text-align: right; margin-right: 40px; font-weight: bold;">Jumlah Pengunjung :  4807970</p>
  </div> -->
</footer>
</body>
</html>
