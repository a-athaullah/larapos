<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <title>Mayess Kitchen</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <script src="{{asset('js/lara.js')}}" defer></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
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
            font-size: 30px;
        }
    </style>
</head>

<body class="bg-light" x-data='{ssc: "Larablog", ct: "Categories", ssc2: "Lavablog", pd: "Products", ssc3: "Lablog Sqlite", lp: "Laravel POS", ssc4: "Larapos Simple", hc: "www.hockeycomputindo.com", ssc5: "Laravel POS", hcs: "https://www.hockeycomputindo.com", ssc6: "Laravel Angular", ffos: "Free open source code point of sale app present by", ads: "Add User", ssc6u: "https://www.hockeycomputindo.com/2021/01/cara-integrasi-laravel-angular-learn.html", acs: "Add Customer", lcsps: "List our source code laravel project", dbps: "Databased Products", ssc4u: "https://www.hockeycomputindo.com/2020/07/free-point-of-sale-laravel-pos-source.html", acg: "Add Categories", ssc3u: "https://www.hockeycomputindo.com/2021/12/laravel-website-cms-source-code-full.html", cnpdt: " Create New Product", ssc5u: "https://www.hockeycomputindo.com/2020/09/aplikasi-toko-gratis-download.html", apd: "Add Products", soc: "Source Code Gallery →", resto: "https://www.hockeycomputindo.com/p/resto.html", shp : "Retail Shop App", shop: "https://www.hockeycomputindo.com/p/toko.html", ssc2u: "https://www.hockeycomputindo.com/2021/02/new-laravel-blog-cms-free-download.html", title: "Mayess", rst: "Restaurant App", and: "Android Dev", opo: "Our Product", ssc1u: "https://www.hockeycomputindo.com/2020/09/larablog-laravel-cms-blog-with-seo.html", kasir: "POS Hardware", andro: "https://android.axcora.com", nav1: "Home", kasirs: "https://www.hockeycomputindo.com/p/daftar-mesin-kasir-terbaru.html", sslugu1: "https://www.hockeycomputindo.com/p/lavaapp-aplikasi-toko-grosir-dan-eceran.html", sslug1: "Lavapos", oss: "Our Services", socs: "https://www.hockeycomputindo.com/2010/12/blog-post.html", sslugu2: "https://www.hockeycomputindo.com/p/resto-cafe-website-modern-aplikasi.html", wbd: "Website Dev", sslug2: "Dexopos Resto", wbde: "https://website.axcora.com", sslugu3: "https://www.hockeycomputindo.com/p/website-keren-aplikasi-toko-android.html", lpor: "Laravel Pro", sslug3: "Dexopos Shop", sslugu4: "https://www.hockeycomputindo.com/p/new-restaurant-point-of-sale-pos-apps.html", sslug4: "Mr.Resto Pos", cc: "Create Categories", nav2: "Doc", ddps: "Download all source code project", cn: "Categorie Name", nav3: "Data", cnct: "Create New Categories", sv: "Save Data", ctndb: "Categories databased", nav4: "POS", ncsa: "New Customer", inc: "Income", nav5: "Report", pro: "PRO", rpt: "Report", rptdm: "Report details menu", nav6: "WebApp", xpr: "Export Report", pap: "Premium App", db: "Database", papa: "https://lava.axcora.my.id/", dbs: "Register Database in here", pfc: "Profit Income", us: "User", gpr: "Group Report", pdpr: "Product Report", cs: "Customer", nus: "Create new user", usdb: "User Databased Management", usb: "User Report", cdmb: "Customer Databased Management", csr: "Customer Report", wba: "https://www.hockeycomputindo.com/p/webapp.html",}'>
    <div class="wrapper">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark text-white"> 
            <a class="navbar-brand" href="/" x-text='title'></a> 
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-columns-gap" viewBox="0 0 16 16">
                    <path d="M6 1v3H1V1h5zM1 0a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1H1zm14 12v3h-5v-3h5zm-5-1a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1h-5zM6 8v7H1V8h5zM1 7a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V8a1 1 0 0 0-1-1H1zm14-6v7h-5V1h5zm-5-1a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1h-5z" />
                </svg> </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto p-1">
                    <li class="nav-item active"> 
                        <a href="{{route('data')}}" class="nav-link" x-text="nav3"> 
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-folder2-open" viewBox="0 0 16 16">
                                <path d="M1 3.5A1.5 1.5 0 0 1 2.5 2h2.764c.958 0 1.76.56 2.311 1.184C7.985 3.648 8.48 4 9 4h4.5A1.5 1.5 0 0 1 15 5.5v.64c.57.265.94.876.856 1.546l-.64 5.124A2.5 2.5 0 0 1 12.733 15H3.266a2.5 2.5 0 0 1-2.481-2.19l-.64-5.124A1.5 1.5 0 0 1 1 6.14V3.5zM2 6h12v-.5a.5.5 0 0 0-.5-.5H9c-.964 0-1.71-.629-2.174-1.154C6.374 3.334 5.82 3 5.264 3H2.5a.5.5 0 0 0-.5.5V6zm-.367 1a.5.5 0 0 0-.496.562l.64 5.124A1.5 1.5 0 0 0 3.266 14h9.468a1.5 1.5 0 0 0 1.489-1.314l.64-5.124A.5.5 0 0 0 14.367 7H1.633z" />
                            </svg> 
                        </a> 
                    </li>
                    <li class="nav-item active"> 
                        <a href="{{route('sales.create')}}" class="nav-link" x-text="nav4"> 
                            <svg class="bi bi-cart3" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm7 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                            </svg> Point of sale 
                        </a> 
                    </li>
                    <li class="nav-item active">
                        <form action="{{route('logout')}}" method="POST">@csrf <button onclick="return confirm('Yakin akan log out ?')" type="submit" class="btn btn-outline-danger"> <svg class="bi bi-exclamation-circle-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                                </svg> Logout </button> </form>
                    </li>
            </div>
        </nav>
        <div class="content-wrapper">@include('auth.pos')@yield('content')@include('auth.passwords.admin')</div>
    </div>
    <script src="{{asset('js/bos.js')}}"></script>
    <script src="{{asset('js/app.js')}}"></script>. <?php print "<div id='app'>{{message}}</div>"; ?> <script src='https://cdn.jsdelivr.net/npm/vue/dist/vue.js'></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>

</html>