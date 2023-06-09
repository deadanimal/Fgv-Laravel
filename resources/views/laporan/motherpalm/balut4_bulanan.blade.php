@extends('layouts.base')
@section('content')
    <div class="row mx-2">

        <div class="col-9 mt-5"></div>
        <div class="col-3 text-end mt-5">
            <select id="download" class="form-select bg-danger text-white">
                <option selected disabled hidden>Muat Turun Dokumen</option>
                <option value="1">PDF (.pdf)</option>
                <option value="2">Excel (.xlxs)</option>
                <option value="3">CSV (.csv)</option>
            </select>
        </div>

        <a href="#" id="downloadpdf" style="display: none"></a>

        <a href="#" id="downloadexcel" style="display: none"></a>

        <a href="#" id="downloadcsv" style="display: none"></a>



        <div class="col-12 mt-4">
            @include('laporan.motherpalm.table.balut4_bulanan')
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
                    document.getElementById('downloadexcel').click();
                    break;
                case '3':
                    document.getElementById('downloadcsv').click();
                    break;

                default:
                    break;
            }
        });
    </script>
@endsection
