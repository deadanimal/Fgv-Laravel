<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>QRCODE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

</head>

<body style="margin-top: 10%;">
    @switch($type)
        @case(1)
            <div class="text-center mt-5">
                <img src="{{ url('qr/qrcode_pokok.svg') }}" style="width: 7cm; height:7cm;" alt="">
                <h5 class="mt-3"><?php $temp = $pokok->progeny . $pokok->no_pokok; ?> {{ str_replace(' ', '', $temp) }}</h5>
            </div>
        @break

        @case(2)
            @foreach ($pokoks as $p)
                <div style="width: 7cm;" class="d-inline-flex" style="margin-left: 9%">
                    <img src="data:image/png;base64, {!! $no_pokoks['qr'][$p->id] !!}">
                    <h5 class="mt-2 mb-4 text-center"> {{ $no_pokoks['no_pokok'][$p->id] }}</h5>
                </div>
                {{-- <div style="width: 7cm;" class="d-inline-flex ms-5">
                    <img src="{{ url($no_pokoks['name'][$p->id]) }}" style="width: 7cm; height:7cm;" alt="">
                    <h5 class="mt-2 mb-4 text-center"> {{ $no_pokoks['no_pokok'][$p->id] }}</h5>
                </div> --}}
            @endforeach
        @break

        @case(3)
            <div class="text-center mt-5">
                <img src="{{ url('qr/qrcode_tandan.svg') }}" style="width: 3cm; height:3cm;" alt="">
                <h5 class="mt-3">No Daftar : {{ $tandan->no_daftar }}</h5>
            </div>
        @break

        @case(4)
            @foreach ($tandans as $t)
                <div style="width: 3cm;" class="d-inline-flex ms-5">
                    <img src="{{ url($no_tandans['name'][$t->id]) }}" style="width: 3cm; height:3cm;" alt="">
                    <h5 class="mt-2 mb-4 text-center"> {{ $no_tandans['no_tandan'][$t->id] }}</h5>
                </div>
            @endforeach
        @break

        @default
    @endswitch

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
</body>

</html>
