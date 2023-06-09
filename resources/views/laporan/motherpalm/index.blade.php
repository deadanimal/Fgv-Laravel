@extends('layouts.base')
@section('content')
    <x-header main="Laporan" sub="Motherpalm" sub2="" />
    <form class="row justify-content-center mt-5" action="{{ route('laporan.motherpalmStore') }}" method="POST">
        @csrf
        <div class="col-xl-9">


            <div class="row mt-4">
                <div class="col-xl-6">
                    <div class="form-group row align-items-center">
                        <label class="col-form-label text-main col-sm-4 text-end" for="select-kategori">Kategori Laporan</label>
                        <div class="col-sm-8">
                            <select name="kategori" class="form-select border-danger" id="select-kategori">
                                <option selected disabled hidden> SILA PILIH </option>
                                <option value="master">Master Record</option>
                                <option value="balut">Balut (Bagging)</option>
                                <option value="debung">Pendebungaan Terkawal (Control Pollination)</option>
                                <option value="kawal">Kawalan Kualiti (Quality Control)</option>
                                <option value="tuai">Penuaian (Harvesting)</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="form-group row align-items-center">
                        <label class="col-form-label text-main col-sm-4 text-end" for="select-laporan">Laporan</label>
                        <div class="col-sm-8">
                            <select name="laporan" class="form-select border-danger" id="select-laporan">
                                <option selected disabled hidden> SILA PILIH KATEGORI</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-xl-6 d-none" id="divharian-bulan">
                    <div class="form-group row align-items-center">
                        <label class="col-form-label text-main col-sm-4 text-end" for="harian-bulan">Filter 1</label>
                        <div class="col-sm-8">
                            <select class="form-select border-danger" name="hb" id="harian-bulan">
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-xl-6 d-none divBulanTahun">
                    <div class="form-group row align-items-center">
                        <label class="col-form-label text-main col-sm-4 text-end">Bulan</label>
                        <div class="col-sm-8">
                            <select name="bulan" class="form-select" id="bulanInput">
                                <option value="all">All</option>
                                @for ($i = 1; $i < 13; $i++)
                                    <option value="{{ sprintf('%02d', $i) }}">
                                        {{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 d-none divBulanTahun">
                    <div class="form-group row align-items-center">
                        <label class="col-form-label text-main col-sm-4 text-end">Tahun</label>
                        <div class="col-sm-8">
                            <select name="tahun" class="form-select">
                                @foreach ($years as $year)
                                    <option value="{{ $year }}" {{ $year == date('Y') ? 'selected' : '' }}>
                                        {{ $year }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>


                <div class="col-xl-6 d-none divHari">
                    <div class="form-group row align-items-center">
                        <label class="col-form-label text-main col-sm-4 text-end">Tarikh Mula</label>
                        <div class="col-sm-8">
                            <x-custom-date-input name="tarikh_mula" />
                        </div>
                    </div>
                </div>

                <div class="col-xl-6 d-none divHari">
                    <div class="form-group row align-items-center">
                        <label class="col-form-label text-main col-sm-4 text-end">Tarikh Akhir</label>
                        <div class="col-sm-8">
                            <x-custom-date-input name="tarikh_akhir" />
                        </div>
                    </div>
                </div>


                <div class="text-end mt-5 d-none" id="divjanaDoc">
                    <button type="submit" class="btn btn-danger me-3">Jana Dokumen
                        <span data-feather="file-plus"></span>
                    </button>
                </div>

            </div>
        </div>
    </form>


    <script>
        $('#select-kategori').change(function(e) {
            let val = $(this).val();
            $('#select-laporan').html("");
            $('.hide_tarikh').hide();
            switch (val) {
                case 'master':
                    $('#select-laporan').append(`
                        <option selected disabled hidden> SILA PILIH </option>
                        <option value="1">Master Record</option>
                    `);
                    break;
                case 'balut':
                    $('#select-laporan').append(`
                        <option selected disabled hidden> SILA PILIH </option>
                        <option value="1">Laporan 1P1F</option>
                        <option value="2">Laporan Balut (Bagging)</option>
                        <option value="3">Rumusan Maklumat (Batch)</option>
                        <option value="4">Laporan Kerosakan Sebelum CP</option>
                    `);
                    break;
                case 'debung':
                    $('#select-laporan').append(`
                        <option selected disabled hidden> SILA PILIH </option>
                        <option value="1">Laporan Control Pollination (CP)</option>
                    `);
                    break;
                case 'kawal':
                    $('#select-laporan').append(`
                        <option selected disabled hidden> SILA PILIH </option>
                        <option value="4">Rumusan Kerosakan Keseluruhan</option>
                        <option value="1">Rumusan Kerosakan Baka</option>
                        <option value="2">Rumusan Kerosakan Blok</option>
                        <option value="3">Rumusan Kerosakan Petugas Balut dan CP</option>
                        <option value="10">Laporan Harian Pemeriksaan Petugas QC</option>
                        <option value="11">Laporan Harian Kerosakan Petugas QC</option>
                    `);
                    break;
                case 'tuai':
                    $('#select-laporan').append(`
                        <option selected disabled hidden> SILA PILIH </option>
                        <option value="2">Laporan Penuaian Mengikut Umur Tandan</option>
                        <option value="8">Rumusan Bulanan Jenis Kerosakan (Blok dan Baka)</option>
                        <option value="9">Laporan Penuaian (Harvesting)</option>
                    `);
                    break;

                default:
                    break;
            }
            $(".divBulanTahun").addClass("d-none");
            $(".divHari").addClass("d-none");
        });


        $('#select-laporan').change(function(e) {
            let k = $('#select-kategori').val();
            let l = $(this).val();

            $("#divharian-bulan").removeClass("d-none");

            if (k == "balut")
            {
                switch (l)
                {
                    case '4':
                        $("#bulanInput").html(``);
                        $("#bulanInput").append(`
                            @for ($i = 1; $i < 13; $i++)
                                        <option value="{{ sprintf('%02d', $i) }}">
                                            {{ $i }}</option>
                            @endfor
                        `);
                        break;

                    default:
                        $("#bulanInput").html(``);
                        $("#bulanInput").append(`
                            <option value="all">All</option>
                            @for ($i = 1; $i < 13; $i++)
                                        <option value="{{ sprintf('%02d', $i) }}">
                                            {{ $i }}</option>
                            @endfor
                        `);
                        break;
                }
            }

            if (k == "master")
            {
                switch (l)
                {
                    case '1':
                        $('#harian-bulan').empty();
                        $('#harian-bulan').append(`
                        <option selected disabled hidden> SILA PILIH </option>
                        <option value="h">Harian</option>
                    `);
                    break;

                    default:
                        $('#harian-bulan').append(`
                        <option selected disabled hidden> SILA PILIH </option>
                        <option value="h">Harian</option>
                        <option value="b">Bulan</option>
                        `);
                        break;
                }
            }
            else
            if (k == "balut")
            {
                switch (l)
                {
                    case '1':
                    case '2':
                    case '4':
                        $('#harian-bulan').empty();
                        $('#harian-bulan').append(`
                        <option selected disabled hidden> SILA PILIH </option>
                        <option value="h">Harian</option>
                        <option value="b">Bulan</option>
                    `);
                    break;

                    case '3':
                        $('#harian-bulan').empty();
                        $('#harian-bulan').append(`
                        <option selected disabled hidden> SILA PILIH </option>
                        <option value="b">Bulan</option>
                    `);
                    break;

                    default:
                        $('#harian-bulan').append(`
                        <option selected disabled hidden> SILA PILIH </option>
                        <option value="h">Harian</option>
                        <option value="b">Bulan</option>
                        `);
                        break;
                }
            }
            else
            if (k == "debung")
            {
                switch (l)
                {
                    case '1':
                        $('#harian-bulan').empty();
                        $('#harian-bulan').append(`
                        <option selected disabled hidden> SILA PILIH </option>
                        <option value="h">Harian</option>
                        <option value="b">Bulan</option>
                    `);
                    break;

                    default:
                        $('#harian-bulan').append(`
                        <option selected disabled hidden> SILA PILIH </option>
                        <option value="h">Harian</option>
                        <option value="b">Bulan</option>
                        `);
                        break;
                }
            }
            else
            if (k == "kawal")
            {
                switch (l)
                {
                    case '1':
                    case '2':
                    case '3':
                    case '4':
                        $('#harian-bulan').empty();
                        $('#harian-bulan').append(`
                        <option selected disabled hidden> SILA PILIH </option>
                        <option value="b">Bulan</option>
                    `);
                    break;

                    case '10':
                    case '11':
                        $('#harian-bulan').empty();
                        $('#harian-bulan').append(`
                        <option selected disabled hidden> SILA PILIH </option>
                        <option value="h">Harian</option>
                    `);
                    break;

                    default:
                        $('#harian-bulan').append(`
                        <option selected disabled hidden> SILA PILIH </option>
                        <option value="h">Harian</option>
                        <option value="b">Bulan</option>
                        `);
                        break;
                }
            }
            else
            if (k == "tuai")
            {
                switch (l)
                {
                    case '2':
                    case '9':
                        $('#harian-bulan').empty();
                        $('#harian-bulan').append(`
                        <option selected disabled hidden> SILA PILIH </option>
                        <option value="h">Harian</option>
                        <option value="b">Bulan</option>
                    `);
                    break;

                    case '8':
                    case '11':
                        $('#harian-bulan').empty();
                        $('#harian-bulan').append(`
                        <option selected disabled hidden> SILA PILIH </option>
                        <option value="b">Bulan</option>
                    `);
                    break;

                    default:
                        $('#harian-bulan').append(`
                        <option selected disabled hidden> SILA PILIH </option>
                        <option value="h">Harian</option>
                        <option value="b">Bulan</option>
                        `);
                        break;
                }
            }
            
            $(".divBulanTahun").addClass("d-none");
            $(".divHari").addClass("d-none");
        });

        $("#harian-bulan").change(function(e) {
            let f1 = $(this).val();
            $("#divjanaDoc").removeClass("d-none");
            if (f1 == "b")
            {
                $(".divBulanTahun").removeClass("d-none");
                $(".divHari").addClass("d-none");
            }
            else
            {
                $(".divBulanTahun").addClass("d-none");
                $(".divHari").removeClass("d-none");
            }
        });
    </script>
@endsection
