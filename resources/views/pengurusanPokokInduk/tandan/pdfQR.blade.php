<style>
    .page-break {
        page-break-after: always;
    }

    img {
        margin: 20px;
    }
</style>

@for ($i = 0; $i < $bilqr; $i++)
    <img src="data:image/png;base64, {!! base64_encode(
        QrCode::format('png')->size(300)->generate(URL::to('/pengurusan-pokok-induk/pokok/edit/' . $pokoks[$i]['id'])),
    ) !!} ">
    {{-- <div class="page-break"></div> --}}
@endfor
