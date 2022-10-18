<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>FGV | FELDA GLOBAL VENTURES</title>
    <!-- ===============================================-->
    <!--    Favicons-->
    <!-- ===============================================-->
    <link rel="apple-touch-icon" sizes="180x180" href="/main-image/Logo.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/main-image/Logo.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/main-image/Logo.png">
    <link rel="shortcut icon" type="image/x-icon" href="/main-image/Logo.png">
    <link rel="manifest" href="/main-image/Logo.png">
    <meta name="msapplication-TileImage" content="/main-image/Logo.png">

    <meta name="theme-color" content="#ffffff">


    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>

    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
        }

        body,
        html {
            height: 100%;
        }

        .bg {
            /* The image used */
            background-image: url("/main-image/bg-main-1.png");

            /* Full height */
            height: 100%;

            /* Center and scale the image nicely */
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        .nav-link {
            color: #40131c;
        }

        .nav-link>.active {
            color: #40131c;
            opacity: 100%;
        }

        button {
            opacity: 50%;
        }

        .selected {
            opacity: 100% !important;
        }

        .text-main {
            color: #40131c;
        }
    </style>
</head>

<body class="bg" id="thebody">
    <div class="container overflow-hidden">

        <div class="row justify-content-center" style="margin-top: 150px;">
            <div class="col-xl-4">
                <img src="/main-image/logo fgv.png">
            </div>
            <div class="col-xl-5 text-center">
                <ul class="nav nav-tabs justify-content-center">
                    <li class="nav-item">
                        <button id="btn1" class="nav-link active selected fw-bold"> Seed
                            Garden</button>
                    </li>
                    <li class="nav-item">
                        <button id="btn2" class="nav-link active fw-bold">Laboratory</button>
                    </li>
                </ul>

                <h2 class="text-white mt-4 fw-bolder mb-0">FGV Agri Services Sdn Bhd</h2>
                <h4 class="text-white fw-bold" style="letter-spacing: 1px;"> Planting Material Production System (PMPS)
                </h4>

                <div class="row justify-content-center">
                    <div class="col-xl-8 mt-4">
                        <form action="{{ route('login') }}" method="post">
                            @csrf

                            <label class="text-white fw-bolder">No. Kakitangan</label>
                            <input id="no_kakitangan" type="no_kakitangan"
                                class="form-control mb-3 @error('no_kakitangan') is-invalid @enderror"
                                name="no_kakitangan" value="{{ old('no_kakitangan') }}" required
                                autocomplete="no_kakitangan" autofocus>

                            @error('no_kakitangan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <label class="text-white fw-bolder">Kata Laluan</label>
                            <input id="password" type="password"
                                class="form-control mb-5 @error('password') is-invalid @enderror" name="password"
                                required autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <button class="btn btn-danger fw-bold w-100" style="opacity:100%" type="submit">
                                Log Masuk
                            </button>

                            <button id="refresh-form" type="button"
                                class="btn btn-sm btn-danger position-absolute ms-2"
                                style="opacity:100%;margin-top:3px;">
                                <span class="text-white" data-feather="refresh-ccw"
                                    style="height: 20px; width: 20px;"></span>
                            </button>


                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script>
        feather.replace()
    </script>

    {{-- <script src="/vendors/fontawesome/all.min.js"></script> --}}

    <script>
        $("#btn1").click(function() {
            $("#btn2").removeClass('selected');
            $(this).addClass('selected');
            $("#thebody").css('background-image', "url('/main-image/bg-main-1.png')");
        });
        $("#btn2").click(function() {
            $("#btn1").removeClass('selected');
            $(this).addClass('selected');
            $("#thebody").css('background-image', "url('/main-image/bg-main-2.png')");

        });
        $("#refresh-form").click(function() {
            $("#email").val('');
            $("#password").val('');


        });
    </script>
</body>

</html>
