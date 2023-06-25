@extends('layouts.base')
@section('content')
    <x-header main="Laporan" sub="Fatherpalm" sub2="" />
    <div class="row justify-content-center mt-5">
        <div class="col-xl-8">
            <form class="row" action="{{ route('laporan.fatherpalmStore') }}" method="POST">
                @csrf
            <div class="row mt-4">
                <div class="col-xl-6 mb-3">
                    <label class="col-form-label text-main">Laporan</label>
                    <select name="laporan" class="form-select border-danger" id="select-laporan">
                        <option selected disabled hidden> SILA PILIH </option>
                        <option value="1">Master Record</option>
                        <option value="2">Rumusan 1P1F</option>
                        <option value="3">Rekod Progress Membalut sub QC dan Tuai bagi Bunga Pisifera Ladang Benih</option>
                        <option value="4">Laporan Kerosakan Membalut Bunga Pisifera dan Kerosakan Sebelum dan Selepas Bunga di Tuai</option>
                        <option value="5">Data Penggunaan Pollen Mengikut Blok</option>
                        <option value="6">Rekod Penggunaan Harian Pollen ke Ladang Benih</option>
                    </select>
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
                <div class="col-xl-4 d-none divBulanTahun">
                    <div class="form-group row align-items-center">
                        <label class="col-form-label text-main col-sm-4 text-end">Bulan Mula</label>
                        <div class="col-sm-8">
                            <select name="bulan" class="form-select" id="bulanInput">
                                <!--option value="all">All</option-->
                                @for ($i = 1; $i < 13; $i++)
                                    <option value="{{ sprintf('%02d', $i) }}">
                                        {{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 d-none divBulanTahun">
                    <div class="form-group row align-items-center">
                        <label class="col-form-label text-main col-sm-4 text-end">Bulan Akhir</label>
                        <div class="col-sm-8">
                            <select name="bulan_akhir" class="form-select" id="bulanInput">
                                <!--option value="all">All</option-->
                                @for ($i = 1; $i < 13; $i++)
                                    <option value="{{ sprintf('%02d', $i) }}">
                                        {{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 d-none divBulanTahun" style="padding-top:10px;">
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
            </form>

        </div>

    </div>

    <script>
    $('#select-laporan').change(function(e) {
            let l = $(this).val();

            $("#divharian-bulan").removeClass("d-none");

            switch (l)
            {
                case '2':
                    $('#harian-bulan').empty();
                    $('#harian-bulan').append(`
                    <option selected disabled hidden> SILA PILIH </option>
                    <option value="h">Harian</option>
                    <option value="b">Bulan</option>
                `);
                break;

                case '3':
                case '6':
                case '7':
                    $('#harian-bulan').empty();
                    $('#harian-bulan').append(`
                    <option selected disabled hidden> SILA PILIH </option>
                    <option value="h">Harian</option>
                `);
                break;

                case '1':
                case '4':
                case '5':
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
