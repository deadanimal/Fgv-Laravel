@extends('layouts.base')
@section('content')
    <div class="row mx-2">
        <div class="col-xl-12 text-center">
            <h4 class="mt-5">Ladang Benih Pusat Pertanian Perkhidmatan Tun Razak</h4>
            <h6 class="mt-2">Rumusan Pencapaian Penuaian Harian Tandan Ladang Benih</h6>
        </div>
        <div class="col-9"></div>
        <div class="col-3 text-end">
            <select id="download" class="form-select bg-danger text-white">
                <option selected disabled hidden>Muat Turun Dokumen</option>
                <option value="1">PDF (.pdf)</option>
                <option value="2">Excel (.xlxs)</option>
                <option value="3">CSV (.csv)</option>
            </select>
        </div>
        <form style="display: none" action="/laporan3" method="post">
            @csrf
            <input type="hidden" name="pdf" value="1">
            <button type="submit" id="downloadpdf" style="display: none">Download</button>
        </form>
        <a id="downloadexcel" style="display: none" href="excel-kehadiran-peserta" download="kehadiran-peserta">Download</a>



        <div class="col-12 mt-4">
            @include('laporan.motherpalm.table.table3')
        </div>
    </div>


    <script>
        $('#download').change(function(e) {
            let val = $(this).val();
            switch (val) {
                case '1':
                    document.getElementById('downloadpdf').click();
                    break;
                case '2':

                    break;
                case '3':

                    break;

                default:
                    break;
            }
        });
    </script>
@endsection
