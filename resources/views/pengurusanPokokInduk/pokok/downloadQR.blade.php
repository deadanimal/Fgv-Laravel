<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>QRCODE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <style>
        div.page_break+div.page_break {
            page-break-before: always;
        }
    </style>
</head>

<body>
    @if ($type == 1)
        <div class="text-center mt-5">
            <img src="{{ url('qrcode_pokok.svg') }}" alt="">
            <h5 class="mt-3">No Pokok : {{ $pokok->no_pokok }}</h5>
        </div>
    @endif

    @if ($type == 2)
        @foreach ($pokoks as $p)
            <div class="text-center mt-5">
                <img src="{{ url($no_pokoks['name'][$p]) }}" alt="">
                <h5 class="mt-3">No Pokok : {{ $no_pokoks['no_pokok'][$p] }}</h5>
            </div>
            <div class="page_break"></div>
        @endforeach
    @endif
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
</body>

</html>
