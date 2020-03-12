<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Aplikasi Inventaris untuk Project PAS">
    <meta name="author" content="Ephraim Jehudah Pelealu">
    <title>SPP - @yield('page-title')</title>
    <!-- Favicon -->
    <link href="/assets/img/brand/favicon.png" rel="icon" type="image/png">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <!-- Icons -->
    <link href="/assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
    <link href="/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <!-- Argon CSS -->
    <link type="text/css" href="/assets/css/argon.css?v=1.0.0" rel="stylesheet">
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="/assets/js/bootstrap.min.js"></script>
</head>

<body>
<!-- Sidenav -->
<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand pt-0" href="">
            <img src="/assets/img/brand/blue.png"  style="width:150px; height:150px;"alt="...">
        </a>
        <!-- User -->
        <ul class="nav align-items-center d-md-none">

            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="mb-0 text-sm  font-weight-bold btn btn-light" style="color: #111111;">@if(Auth::guard('siswa')->check()){{Auth::user()->nama}}@else{{Auth::user()->nama_petugas}}@endif</span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">Welcome!</h6>
                    </div>
                    <div class="dropdown-divider"></div>
                    <a href="/prosesLogout" class="dropdown-item">
                        <i class="ni ni-user-run"></i>
                        <span>Logout</span>
                    </a>
                </div>
            </li>
        </ul>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="">
                            <img src="/assets/img/brand/blue.png" style="width: 158px;height: 52px;" alt="">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Form -->

            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/">
                        <i class="ni ni-tv-2 text-primary"></i> Home
                    </a>
                </li>
            </ul>
            @if(Auth::guard('admin')->check())
                <hr class="my-3">
                <h6 class="navbar-heading text-muted">Data Petugas</h6>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/menu/petugasList">
                            <i class="ni ni-badge text-blue"></i> Daftar Petugas
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/menu/formAddPetugas">
                            <i class="ni ni-app text-blue"></i> Tambah Petugas
                        </a>
                    </li>
                </ul>
                <hr class="my-3">
                <h6 class="navbar-heading text-muted">Data Siswa</h6>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/menu/siswaList">
                            <i class="ni ni-badge text-blue"></i> Daftar Siswa
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/menu/formAddSiswa">
                            <i class="ni ni-app text-blue"></i> Tambah Siswa
                        </a>
                    </li>
                </ul>
                <hr class="my-3">
                <h6 class="navbar-heading text-muted">Data Kelas</h6>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/menu/kelasList">
                            <i class="ni ni-badge text-blue"></i> Daftar Kelas
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/menu/formAddKelas">
                            <i class="ni ni-app text-blue"></i> Tambah Kelas
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/menu/kenaikanKelas">
                            <i class="ni ni-app text-blue"></i> Kenaikan Kelas
                        </a>
                    </li>
                </ul>
            @endif
            @if(Auth::guard('petugas')->check() || Auth::guard('admin')->check()  || Auth::guard('siswa')->check())
                <hr class="my-3">
                <h6 class="navbar-heading text-muted">Transaksi</h6>
                <ul class="navbar-nav">
                    @if(Auth::guard('petugas')->check() || Auth::guard('admin')->check())
                        <li class="nav-item">
                            <a class="nav-link" href="/menu/transaksi">
                                <i class="ni ni-badge text-blue"></i>Pembayaran SPP
                            </a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" href="/menu/addUserForm">
                            <i class="ni ni-app text-blue"></i> History Pembayaran
                        </a>
                    </li>
                </ul>
            @endif
            @if(Auth::guard('admin')->check())
                <hr class="my-3">
                <h6 class="navbar-heading text-muted">Data Laporan</h6>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/menu/userList">
                            <i class="ni ni-badge text-blue"></i> Generate Laporan
                        </a>
                    </li>
                </ul>
            @endif
        </div>
    </div>

</nav>
<!-- Main content -->
<div class="main-content">
    <!-- Top navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
        <div class="container-fluid">
            <!-- Brand -->
            <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="/">@yield('title')</a>
            <!-- User -->
            <ul class="navbar-nav align-items-center d-none d-md-flex">
                <li class="nav-item dropdown">
                    <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="media align-items-center">
                            <div class="media-body ml-2 d-none d-lg-block">
                                <span class="mb-0 text-sm  font-weight-bold btn btn-light" style="color: #111111;">@if(Auth::guard('siswa')->check()){{Auth::user()->nama}}@else{{Auth::user()->nama_petugas}}@endif</span>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                        <div class=" dropdown-header noti-title">
                            <h6 class="text-overflow m-0">Welcome!</h6>
                        </div>
                        <div class="dropdown-divider"></div>
                        <a href="/prosesLogout" class="dropdown-item">
                            <i class="ni ni-user-run"></i>
                            <span>Logout</span>
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <!-- Header -->
    @yield('header-content')
    <!-- Page content -->
    <div class="container-fluid mt--7">
        @yield('body-content')
        <!-- Footer -->
        <footer class="footer">
            <div class="row align-items-center justify-content-xl-between">
                <div class="col-xl-6">
                    <div class="copyright text-center text-xl-left text-muted">
                        &copy; 2020 <a href="#" class="font-weight-bold ml-1">Ephraim Jehudah P.</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>
<!-- Argon Scripts -->

<!-- Core -->
<script src="/sweet_alert/sweetalert.min.js"></script>

@include('sweet::alert')
<script src="/assets/vendor/jquery/dist/jquery.min.js"></script>
@yield('script-js')
<script src="/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<!-- Optional JS -->
<script src="/assets/vendor/chart.js/dist/Chart.min.js"></script>
<script src="/assets/vendor/chart.js/dist/Chart.extension.js"></script>
<!-- Argon JS -->
<script src="/assets/js/argon.js?v=1.0.0"></script>

</body>

</html>
