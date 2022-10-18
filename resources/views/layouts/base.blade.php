<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>FGV | FELDA GLOBAL VENTURES</title>


    <!-- ===============================================-->
    <!--    Favicons-->
    <!-- ===============================================-->
    <link rel="apple-touch-icon" sizes="180x180" href="/main-image/Logo.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/main-image/Logo.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/main-image/Logo.png">
    <link rel="shortcut icon" type="image/x-icon" href="/main-image/Logo.png">


    <meta name="theme-color" content="#ffffff">
    <script src="/assets/js/config.js"></script>
    <script src="/vendors/overlayscrollbars/OverlayScrollbars.min.js"></script>


    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

    <link href="/vendors/prism/prism-okaidia.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700%7cPoppins:300,400,500,600,700,800,900&amp;display=swap"
        rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="/vendors/overlayscrollbars/OverlayScrollbars.min.css" rel="stylesheet">
    <link href="/assets/css/theme.min.css" rel="stylesheet" id="style-default">
    <link href="/vendors/flatpickr/flatpickr.min.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


    <style>
        body {
            font-family: 'Poppins', sans-serif
        }

        .navbar-vertical {
            position: absolute;
        }

        .bg-main {
            background-color: #ECECEC;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            color: #40131c;
        }

        .text-main {
            color: #40131c;
        }

        .border-main {
            border-color: #40131c;
        }


        .refreshbtn:hover {
            stroke: #f89521;
        }

        tbody>tr:hover {
            background-color: rgb(249, 225, 198);
        }

        .dipilih>button {
            color: #f89521 !important;
        }

        .nav-link {
            border-radius: 10px;
        }

        .nav-link.active,
        .nav-item.active,
        .nav-link:hover {
            margin-left: 10px;
            background-color: #fff;
            border-radius: 10px;
        }
    </style>


</head>


<body style="width: 100%;overflow-x:hidden">

    <main class="main" id="top">
        <div class="col-12">
            <img src="/main-image/Header.png" width="100%">
        </div>

        <div class="container-fluid px-0 bg-main" data-layout="container" style="">

            <nav class="navbar navbar-light navbar-vertical navbar-expand-xl mx-auto">
                <div class="d-flex align-items-center mb-1">
                    <div class="toggle-icon-wrapper ps-3">
                        <button id="burger" class="btn navbar-toggler-humburger-icon navbar-vertical-toggle"
                            data-bs-toggle="tooltip" data-bs-placement="left" title="Toggle Navigation"><span
                                class="navbar-toggle-icon"><span class="toggle-line"></span></span></button>
                    </div>
                </div>

                <div class="collapse navbar-collapse" id="navbarVerticalCollapse">
                    <div class="navbar-vertical-content scrollbar bg-main">

                        <div class="d-flex mb-3 ms-1 align-items-center flex-row" id="profileRow">
                            <img id="profilePicSidebar" src="/main-image/profile photos.png" class="rounded"
                                height="20%;">
                            <div class="ms-1 ">
                                <p class="text-main mb-0">
                                    <span class="fw-bold">NAMA :</span> Namamama
                                </p>
                                <p class="text-main">
                                    <span class="fw-bold">NO. Kakitangan:</span> 00110-090X-11XFGV
                                </p>
                            </div>
                        </div>

                        <ul class="navbar-nav flex-column mb-3" id="navbarVerticalNav">


                            <li class="nav-item">
                                <a class="nav-link p-3 my-1 {{ Request::is('dashboard', '/') ? 'active' : '' }}"
                                    href="/dashboard" role="button">
                                    <div class="d-flex align-items-center">
                                        <span class="nav-link-icon">
                                            <img src="/icons/laman-utama.ico" width="100%">
                                        </span>
                                        <span class="nav-link-text ps-3 text-main">Laman Utama</span>
                                    </div>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link p-3 my-1 dropdown-indicator" href="#pengurusan-pengguna"
                                    role="button" data-bs-toggle="collapse"
                                    aria-expanded="{{ Request::is('pengurusan_pengguna/*') ? 'true' : 'false' }}"
                                    aria-controls="pengurusan-pengguna">
                                    <div class="d-flex align-items-center">
                                        <span class="nav-link-icon">
                                            <img src="/icons/pengurusan-pengguna.ico" width="100%">
                                        </span>
                                        <span class="nav-link-text ps-3 text-main">Pengurusan Pengguna</span>
                                    </div>
                                </a>
                                <ul class="nav collapse {{ Request::is('pengurusan_pengguna/*') ? 'show' : 'false' }} ps-4"
                                    id="pengurusan-pengguna">
                                    <li
                                        class="nav-item 
                                        {{ Request::is('pengurusan_pengguna/index', 'pengurusan_pengguna/daftar', 'pengurusan_pengguna/edit') ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ route('pp.index') }}">
                                            <div class="d-flex align-items-center">
                                                <span class="nav-link-icon">
                                                    <span class="fas fa-folder-open text-main"></span>
                                                </span>
                                                <span class="nav-link-text text-main ps-1">Petugas</span>
                                            </div>
                                        </a>
                                    </li>
                                    <li
                                        class="nav-item {{ Request::is('pengurusan_pengguna/laporan', 'pengurusan_pengguna/maklumat') ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ route('pp.laporan') }}">
                                            <div class="d-flex align-items-center">
                                                <span class="nav-link-icon">
                                                    <span class="fas fa-folder-open text-main"></span>
                                                </span>
                                                <span class="nav-link-text text-main ps-1">Laporan Petugas</span>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link p-3 my-1 dropdown-indicator " href="#pokok-induk" role="button"
                                    data-bs-toggle="collapse" aria-expanded="false" aria-controls="pokok-induk">
                                    <div class="d-flex align-items-center">
                                        <span class="nav-link-icon">
                                            <img src="/icons/palm.ico" width="100%">
                                        </span>
                                        <span class="nav-link-text ps-3 text-main">Pengurusan Pokok Induk</span>
                                    </div>
                                </a>
                                <ul class="nav collapse {{ Request::is('pengurusan-pokok-induk/*') ? 'show' : 'false' }} ps-4"
                                    id="pokok-induk">
                                    <li
                                        class="nav-item 
                                            {{ Request::is('pengurusan-pokok-induk/pokok/*') ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ route('pi.p.index') }}">
                                            <div class="d-flex align-items-center">
                                                <span class="nav-link-icon">
                                                    <span class="fas fa-folder-open text-main"></span>
                                                </span>
                                                <span class="nav-link-text text-main ps-1">Pokok</span>
                                            </div>
                                        </a>
                                    </li>
                                    <li
                                        class="nav-item {{ Request::is('pengurusan-pokok-induk/tandan/*') ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ route('pi.t.index') }}">
                                            <div class="d-flex align-items-center">
                                                <span class="nav-link-icon">
                                                    <span class="fas fa-folder-open text-main"></span>
                                                </span>
                                                <span class="nav-link-text text-main ps-1">Tandan</span>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link p-3 my-1 dropdown-indicator" href="#laporan" role="button"
                                    data-bs-toggle="collapse" aria-expanded="false" aria-controls="laporan">
                                    <div class="d-flex align-items-center">
                                        <span class="nav-link-icon">
                                            <img src="/icons/laporan.ico" width="100%">
                                        </span>
                                        <span class="nav-link-text ps-3 text-main">Laporan</span>
                                    </div>
                                </a>
                                <ul class="nav collapse false" id="laporan">
                                    <li class="nav-item">
                                        <a class="nav-link" href="">
                                            <div class="d-flex align-items-center">
                                                <span class="nav-link-icon">
                                                    <span class="fas fa-folder-open text-main"></span>
                                                </span>
                                                <span class="nav-link-text ps-1">Pokok</span>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="">
                                            <div class="d-flex align-items-center">
                                                <span class="nav-link-icon">
                                                    <span class="fas fa-folder-open text-main"></span>
                                                </span>
                                                <span class="nav-link-text ps-1">Tandan</span>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('audit') ? 'active' : '' }} p-3 my-1 "
                                    href="{{ route('audit') }}" role="button">
                                    <div class="d-flex align-items-center">
                                        <span class="nav-link-icon">
                                            <img src="/icons/audit.ico" width="130%">
                                        </span>
                                        <span class="nav-link-text ps-3 text-main">Jejak Audit</span>
                                    </div>
                                </a>

                            </li>

                            <li class="nav-item">
                                <a class="nav-link p-3 my-1 dropdown-indicator " href="#konfigurasi-sistem"
                                    role="button" data-bs-toggle="collapse" aria-expanded="false"
                                    aria-controls="konfigurasi-sistem">
                                    <div class="d-flex align-items-center">
                                        <span class="nav-link-icon">
                                            <img src="/icons/setting.ico" width="100%">

                                        </span>
                                        <span class="nav-link-text ps-3 text-main">Konfigurasi Sistem</span>
                                    </div>
                                </a>
                                <ul class="nav collapse false" id="konfigurasi-sistem">
                                    <li class="nav-item">
                                        <a class="nav-link" href="">
                                            <div class="d-flex align-items-center">
                                                <span class="nav-link-icon">
                                                    <span class="fas fa-folder-open text-main"></span>
                                                </span>
                                                <span class="nav-link-text ps-1">Pokok</span>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="">
                                            <div class="d-flex align-items-center">
                                                <span class="nav-link-icon">
                                                    <span class="fas fa-folder-open text-main"></span>
                                                </span>
                                                <span class="nav-link-text ps-1">Tandan</span>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <div class="mt-5 d-flex flex-row-reverse">
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                    <span class="fas fa-sign-out-alt text-main fs-3"></span></a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    class="d-none">
                                    @csrf
                                </form>
                            </div>

                        </ul>

                    </div>
                </div>
            </nav>

            <div class="content bg-white">
                <button id="burger2" class="d-none btn navbar-toggler-humburger-icon navbar-toggler me-1 me-sm-3"
                    type="button" data-bs-toggle="collapse" data-bs-target="#navbarVerticalCollapse"
                    aria-controls="navbarVerticalCollapse" aria-expanded="false" aria-label="Toggle Navigation"><span
                        class="navbar-toggle-icon"><span class="toggle-line"></span></span>
                </button>
                @include('sweetalert::alert')

                @yield('content')

                <div class="row mt-8">
                    <div class="col-12 mt-5">
                        <footer class="mb-2">
                            <hr class="text-main mb-2" style="height: 3px;">
                            <div class="text-main fw-bold text-center">
                                FGV Agri Services Sdn Bhd (FGVAS) © 2022 | Planting Material Production System
                                (PMPS)
                            </div>
                        </footer>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->


    <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->
    <script src="/vendors/popper/popper.min.js"></script>
    <script src="/vendors/bootstrap/bootstrap.min.js"></script>
    <script src="/vendors/anchorjs/anchor.min.js"></script>
    <script src="/vendors/is/is.min.js"></script>
    <script src="/vendors/prism/prism.js"></script>
    <script src="/vendors/fontawesome/all.min.js"></script>
    <script src="/vendors/lodash/lodash.min.js"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
    <script src="/vendors/list.js/list.min.js"></script>
    <script src="/assets/js/theme.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script src="/assets/js/flatpickr.js"></script>
    <script>
        $("#burger").click(function() {
            var navbar = $("#navbarVerticalCollapse").width();
            if (navbar == 304) {
                $("#profilePicSidebar").css('width', '42px');
                $(".active").css('margin-left', '0');
            }
            if (navbar == 64) {
                $("#profilePicSidebar").css('width', '87px');
                $(".active").css('margin-left', '10px');

            }
        });

        $(document).ready(function() {
            var navbar = $("#navbarVerticalCollapse").width();
            if (navbar == 64) {
                $("#profilePicSidebar").css('width', '42px');
            }
            if (navbar == 304) {
                $("#profilePicSidebar").css('width', '87px');
            }

            if ($(window).width() < 1200) {
                $("#burger2").removeClass('d-none');
                $("#profileRow").css('margin-top', '20px');
                $(".navbar").css('margin-top', '-30px');
            }


            $("td").addClass('align-middle');
            feather.replace();

        });

        $(window).resize(function() {
            if ($(this).width() < 1200) {
                $("#burger2").removeClass('d-none');
                $("#profileRow").css('margin-top', '20px');
                $(".navbar").css('margin-top', '-30px');
            }

            if ($(this).width() >= 1200) {
                $("#burger2").addClass('d-none');
                $("#profileRow").css('margin-top', '0');
                $(".navbar").css('margin-top', '0');
            }
        });
    </script>
    @yield('scripts')


</body>

</html>
