<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
</head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">LibraryIt</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                @auth 
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                     <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/{{ (Auth::user()->is_admin==1)?'admin':'user' }}/books">Books</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/{{ (Auth::user()->is_admin==1)?'admin':'user' }}/posts">Posts</a>
                    </li>
                    @if(Auth::user()->is_admin==1)
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/{{ (Auth::user()->is_admin==1)?'admin':'user' }}/borrowings">Borrowing List</a>
                    </li>
                    @elseif (Auth::user()->is_admin!=1)
                    <li>
                        <a class="nav-link active" aria-current="page" href="/{{ (Auth::user()->is_admin==1)?'admin':'user' }}/borrowings">Borrowing Information</a>
                    </li>
                    @endif
                </ul>
                <ul class="navbar-nav navbar-right mb-2 mb-lg-0">
                    <li>
                    {{ Auth::user()->name }}
                    </li>
                    <li>
                    <a href="/logout" class="btn btn-warning">Logout</a>
                    </li>
                </ul>
                @endauth
            </div>
        </div>
    </nav>
    <div class="container justify-content-center" style="width: 90%;">
    @yield('content')
    </div>
</body>
</html>
