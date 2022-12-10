<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Buku | @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>

<style>
    .main {
        height: 100vh;
    }

    .sidebar {
        background: rgb(94, 94, 94);
        color: #fff;
    }

    .sidebar a {
        color: #fff;
        text-decoration: none;
        display: block;
        padding: 20px 10px;
    }

    .sidebar a:hover {
        background: #000;
    }
</style>

<body>
    
    <div class="main d-flex flex-column justify-content-between">
        
        <nav class="navbar navbar-dark navbar-expand-lg bg-primary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Rental Buku</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </nav>

        <div class="body-content h-100">
            <div class="row g-0 h-100">
                <div class="sidebar col-lg-2 collapse d-lg-block" id="navbarTogglerDemo03">
                    @if(Auth::user())
                        @if (Auth::user()->role_id == 1)
                            <a href="/dashboard">Dashboard</a>
                            <a href="/">Book List</a>
                            <a href="/books">Books</a>
                            <a href="/categories">Categories</a>
                            <a href="/users">Users</a>
                            <a href="/rent-logs">Rent Log</a>
                            <a href="/book-rent">Book Rent</a>
                            <a href="/book-return">Book Return</a>
                            <a href="/logout">Logout</a>
                        @else
                            <a href="/profile">My Rent Logs</a>
                            <a href="/">Book List</a>
                            <a href="/logout">Logout</a>
                        @endif

                    @else
                        <a href="/login">Login</a>
                        <a href="/register">Register</a>
                    @endif
                    
                </div>
                <div class="content p-5 col-lg-10">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    

    <div>
        
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

</body>
</html>