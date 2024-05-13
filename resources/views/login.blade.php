<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Background Warna</title>
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
    width: 50%;
    margin: 50px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    float: right;
    margin-right: 30px;
    height: auto;
    margin-top: 25px;
}

h2 {
    display: flex;
    justify-content: center;
    align-items: center;
    color: #333;
    text-align: center;
    font-weight: bold;
    margin-top: 40px;
}

p {
    display: flex;
    color: #666;
    justify-content: center;
    align-items: center;
    margin-top: 50px;
    margin-bottom: 40px;
}
form {
    padding: 20px;
}

label {
    color: #5352ED;
    font-weight: bold;
    margin-bottom: 10px;
}

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

.login-button, .google-button {
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
    position: relative; 
    margin-top: 50px;
}

.google-button {
    background-color: #fff;
    color: #5352ED;
    border: 2px solid #5352ED;
    position: relative;
    margin-top: 30px;
}

.google-button span {
    display: flex;
    align-items: center;
    margin-left: 100px;
}

.google-button img {
    width: 20px;
    height: auto;
    margin-right: 10px;
}

.forgot-password {
    display: flex;
    justify-content: flex-end; /* Memindahkan teks ke kanan */
}

/* Hover effect for Forgot Password */
.forgot-password a:hover {
    color: #FF7F56; /* Change text color on hover */
}

/* Hover effect for Login Now button */
.login-button:hover {
    background-color: #FF7F56; /* Change background color on hover */
}

/* Hover effect for Continue With Google button */
.google-button:hover {
    border-color: #FF7F56; /* Change background color on hover */
    color: #FF7F56; /* Change text color on hover */
}

.dont-have {
    display: flex;
    justify-content: center;
    align-items: center;
    color: #000000; /* Warna tulisan */
    margin-top: 20px; /* Jarak antara paragraf dan tombol */
}

.dont-have a {
    margin-left: 5px;
    color: #6D67E4; /* Jarak antara tulisan "Register" dan tanda tanya */
}

.social-icons {
    display: flex;
    justify-content: center;
    margin-top: 20px;
}

img {
    margin: 0 10px;
    width: 20px;
    height: auto;
}

.left-img {
    width: 600px;
    margin-top: 80px;
    margin-left: 20px;
}
</style>
<body>
    <img src="Assets/gbr.png" alt="" class="left-img">
    <div class="container">
        <h2>Hello! Welcome back.</h2>
        <p>Login with the data you entered during Registration.</p>
        <form action="/auth" method="POST">
            @csrf
            <div>
                <label for="email" >Email Address</label><br>
                <input type="email" id="email" name="email"  style="margin-bottom: 30px; margin-top: 5px;" required><br>
            </div>
            <div>
                <label for="password">Password</label><br>
                <input type="password" id="password" name="password" style="margin-top: 5px;" required><br>
                <span class="forgot-password"><a href="#" style="text-decoration: none;">Forgot Password ?</a></span>            
            </div>
            <button type="submit" class="login-button">Login Now</button>
            <!-- <button type="submit" class="google-button"> <span><img src="../Asset/Google.jpg" alt="">Continue With Google</span></button> -->
            <p class="dont-have">Don't have an Account? <a href="/register" style="text-decoration: none;">Register</a></p>
        </form>
    </div>
</body>
</html>
