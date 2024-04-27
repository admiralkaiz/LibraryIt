<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="/css/Style.css">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> -->
</head>
<body style="width: 95%;">
    <div class="register-container">
    <h3>Please Fill this form to create an Account</h3>
    <form action="/registerUser" method="POST">
        @csrf
        <div>
            <label for="name" >Name</label><br>
            <input type="text" id="name" name="name"  style="margin-bottom: 20px;" required><br>
        </div>
        <div>
            <label for="email" >Email Address</label><br>
            <input type="email" id="email" name="email"  style="margin-bottom: 20px;" required><br>
        </div>
        <div>
            <label for="password">Password</label><br>
            <input type="password" id="password" name="password" required><br>
        </div>
        <button type="submit" class="signup-button">Sign Up</button>
    </form>
    <p class="already-have">Already have an Account? <a href="/login" style="text-decoration: none;">LOGIN</a></p>
    </div>
</body>
</html>