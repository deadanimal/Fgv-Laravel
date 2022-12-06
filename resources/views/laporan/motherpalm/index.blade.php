@extends('layouts.base')
@section('content')
    <x-header main="Laporan" sub="Motherpalm" sub2="" />
    <form class="row justify-content-center mt-5" action="{{ route('laporan.motherpalmStore') }}" method="POST">
        @csrf
        <div class="col-xl-8">
            <div class="row">
                <div class="col-xl-6 mb-3">
                    <div class="form-group row align-items-center">
                        <label class="col-form-label text-main col-sm-3">Kategori Laporan</label>
                        <div class="col-sm-8">
                            <select name="kategori" class="form-select border-danger" id="select-kategori">
                                <option selected disabled hidden> SILA PILIH </option>
                                <option value="balut">Balut (Bagging)</option>
                                <option value="debung">Pendebungaan Terkawal (Control Pollination)</option>
                                <option value="tuai">Tuai (Harvesting)</option>
                                <option value="kawal">Kawalan Kualiti (Quality Control)</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-xl-1"></div>
                <div class="col-xl-5 hide_tarikh">
                    <div class="form-group row align-items-center">
                        <label class="col-sm-3 col-form-label text-main">Tarikh Mula</label>
                        <div class="col-sm-8">
                            <x-custom-date-input name="tarikh_mula" />
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="form-group row align-items-center">
                        <label class="col-form-label text-main col-sm-3">Laporan</label>
                        <div class="col-sm-8">
                            <select name="laporan" class="form-select border-danger" id="select-laporan">
                                <option selected disabled hidden> SILA PILIH KATEGORI</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-xl-1"></div>
                <div class="col-xl-5 hide_tarikh">
                    <div class="form-group row align-items-center">
                        <label class="col-sm-3 col-form-label text-main">Tarikh Akhir</label>
                        <div class="col-sm-8">
                            <x-custom-date-input name="tarikh_akhir" />
                        </div>
                    </div>
                </div>

                <div class="text-end mt-5">
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
            switch (val) {
                case 'kawal':
                    $('#select-laporan').append(`
                        <option value="1">Rumusan Kerosakan Baka</option>
                        <option value="2">Rumusan Kerosakan Blok</option>
                        <option value="3">Rumusan Kerosakan Petugas</option>
                        <option value="4">Rumusan Kerosakan Keseluruhan</option>
                        <option value="5">Senarai Belum QC</option>
                        <option value="6">Rosak Selepas QC</option>
                        <option value="7">Target vs Pencapaian Bulanan</option>
                        <option value="8">Rumusan</option>
                        <option value="9">Maklumat Mengikut Bulan Bagging</option>
                    `);
                    break;
                case 'balut':
                    $('#select-laporan').append(`
                        <option selected disabled hidden> SILA PILIH </option>
                        <option value="1">Laporan Harian Balut</option>
                        <option value="2">Rumusan Mingguan Balut (Baka)</option>
                        <option value="3">Laporan 1P1F</option>
                        <option value="4">Target vs Pencapaian Bulanan</option>
                        <option value="5">Rumusan</option>
                        <option value="6">Maklumat Mengikut Bulan Bagging</option>
                    `);
                    break;
                case 'debung':
                    $('#select-laporan').append(`
                        <option selected disabled hidden> SILA PILIH </option>
                        <option value="1">Laporan Harian Pendebungaan Terkawal</option>
                        <option value="2">Rumusan Mingguan CP (Baka)</option>
                        <option value="3">Senarai Belum CP</option>
                        <option value="4">Rosak Sebelum CP</option>
                        <option value="5">Target vs Pencapaian Bulanan</option>
                        <option value="6">Rumusan</option>
                        <option value="7">Maklumat Mengikut Bulan Bagging</option>
                    `);
                    break;
                case 'tuai':
                    $('#select-laporan').append(`
                        <option selected disabled hidden> SILA PILIH </option>
                        <option value="1">Laporan Harian Penuaian</option>
                        <option value="2">Laporan Penuaian Mengikut Umur Tandan</option>
                        <option value="3">Rumusan Mingguan Tuai (Baka)</option>
                        <option value="4">Senarai Belum Tuai</option>
                        <option value="5">Target vs Pencapaian Bulanan</option>
                        <option value="6">Rumusan</option>
                        <option value="7">Maklumat Mengikut Bulan Bagging</option>
                    `);
                    break;

                default:
                    break;
            }
        });


        $('#select-laporan').change(function(e) {
            let k = $('#select-kategori').val();
            let l = $(this).val();
            if (k == "balut" && l == 3) {
                $('.hide_tarikh').addClass('d-none');
            } else {
                $('.hide_tarikh').removeClass('d-none');
            }
        });
    </script>
@endsection
