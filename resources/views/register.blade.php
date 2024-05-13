<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Form</title>
    <link rel="stylesheet" href="StyleUser.css">
</head>
<style>
    body {
    margin: 0;
    padding: 0;
    background-color: #7E90F3; 
    font-family: 'Poppins', Arial, sans-serif;
    overflow: hidden;
}

.container {
    width: 50%; /* Lebar kontainer setengah dari lebar halaman */
    margin: 50px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    float: right;
    margin-right: 30px;
    height: auto;
    margin-top: 25px; /* Mengubah tinggi kontainer menjadi otomatis */
}

h2 {
    display: flex;
    justify-content: center;
    align-items: center;
    color: #333;
    text-align: center;
}

p {
    display: flex;
    color: #666;
    justify-content: center; /* Mengatur posisi vertikal ke tengah */
    align-items: center;
}
form {
    padding: 20px;
}

label {
    color: #5352ED;
    font-weight: bold;
    margin-bottom: 10px;
}

input[type="text"],
input[type="email"],
input[type="password"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 15px;
    box-sizing: border-box;
    border-color: #5352ED;
    background-color: #F4F6FD;
    height: 50px;
}

.privacy-terms {
    display: flex;
    justify-content: center; /* Mengatur posisi vertikal ke tengah */
    align-items: center; /* Mengatur posisi horizontal ke tengah */
    color: #666;
    margin-top: 10px;
    font-weight: bold;
    font-size: 15px;
    font-family: 'Poppins', Arial, sans-serif;
}
.signup-button {
    background-color: #6D67E4;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    display: block;
    margin: auto;
    margin-top: 20px; 
    width: 500px;
    font-weight: bold;
    height: 40px;
    font-size: 20px;
}

.social-icons {
    display: flex;
    justify-content: center;
    margin-top: 20px; /* Memberikan jarak antara tombol sign up dan ikon sosial */
}

.social-icons img {
    margin: 0 10px;
    width: 50px;
    height: auto; /* Memberikan jarak horizontal antara ikon sosial */
}
.left-img{
    width: 600px;
    margin-top: 80px;
    margin-left: 20px;
}
</style>
<body>
    <img src="Assets/gbr.png" alt="" class="left-img">
    <div class="container">
        <h2>Please Fill this form to create an Account</h2>
        <form action="/registerUser" method="POST">
            @csrf
            <div>
                <label for="name" >Full Name</label><br>
                <input type="text" id="name" name="name"  style="margin-bottom: 20px; margin-top: 5px;" required><br>
            </div>
            <div>
                <label for="email" >Email Address</label><br>
                <input type="email" id="email" name="email"  style="margin-bottom: 20px; margin-top: 5px;" required><br>
            </div>
            <div>
                <label for="password">Password</label><br>
                <input type="password" id="password" name="password" style="margin-top: 5px;" required><br>
                <span class="privacy-terms">By signing up,I've read and agree to our <a href="#" style="text-decoration: none; margin-left: 5px; margin-right: 5px;"> Privacy Policy </a> and <a href="#" style="text-decoration: none; margin-left: 5px; margin-right: 5px;"> Terms of use</a></span>
            </div>
            <button type="submit" class="signup-button">Sign Up</button>
            <div class="social-icons">
                <a href=""><img src="../Asset/Google.jpg" alt=""></a>
                <p style="font-weight: bold;">OR</p>
                <a href=""><img src="../Asset/Facebook.jpg" alt=""></a>
            </div>
            <p class="already-have">Already have an Account? <a href="/login" style="text-decoration: none;">LOGIN</a></p>
        </form>
    </div>
</body>
</html>
