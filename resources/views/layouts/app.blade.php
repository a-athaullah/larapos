<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <title>{{ $storeName }}</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <script src="{{asset('js/lara.js')}}" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Anton&display=swap');

        html,
        body {
            font-family: 'Montserrat', sans-serif;
        }

        .navbar,
        .title {
            font-family: 'Anton', sans-serif;
            font-size: 1.25rem;
        }
    </style>
</head>

<body class="bg-light">
    <div class="wrapper">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark text-white"> 
            <a class="navbar-brand" href="/" style="margin-left:1em;">{{ $storeName }}</a> 
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto p-1">
                    <li class="nav-item active"> 
                        <a href="{{route('categories.index')}}" class="nav-link" x-text="ct">Categories</a> 
                    </li>
                    <li class="nav-item active"> 
                        <a href="{{route('products.index')}}" class="nav-link" x-text="pd">Products</a> 
                    </li>
                    <li class="nav-item active"> 
                        <a href="{{route('sales.index')}}" class="nav-link" x-text="nav4">Transactions</a> 
                    </li>
                    <li class="nav-item active">
                        <form action="{{route('logout')}}" method="POST">
                            @csrf 
                            <button onclick="return confirm('Yakin akan log out ?')" type="submit" class="btn btn-outline-danger"> 
                                <svg class="bi bi-exclamation-circle-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                                </svg> Logout 
                            </button>
                        </form>
                    </li>
            </div>
        </nav>
        <div class="content-wrapper">@include('auth.pos')@yield('content')</div>
    </div>
    <script src="{{asset('js/bos.js')}}"></script>
    <script src="{{asset('js/app.js')}}"></script><script src='https://cdn.jsdelivr.net/npm/vue/dist/vue.js'></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
</body>

</html>