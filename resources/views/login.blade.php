<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="css/Style.css">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> -->
</head>
<body style="width: 95%;">
    <div class="register-container">
    <h2>Hello! Welcome back.</h2>
    <p>Login with the data you entered during Registration.</p>
        <form action="/auth" method="POST">
            @csrf
            <div>
                <label for="email" >Email Address</label><br>
                <input type="email" id="email" name="email"  style="margin-bottom: 20px;" required><br>
            </div>
            <div>
                <label for="password">Password</label><br>
                <input type="password" id="password" name="password" required><br>
            </div>
            <button type="submit" class="signup-button">Login</button>
        </form>
    </div>
</body>
</html>