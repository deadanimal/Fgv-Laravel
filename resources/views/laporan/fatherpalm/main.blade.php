@extends('layouts.base')
@section('content')
    <x-header main="Laporan" sub="Fatherpalm" sub2="" />
    <div class="row justify-content-center mt-5">
        <div class="col-xl-8">
            <form class="row" action="{{ route('laporan.fatherpalmStore') }}" method="POST">
                @csrf
                <div class="col-xl-6 mb-3">
                    <label class="col-form-label text-main">Laporan</label>
                    <select name="laporan" class="form-select border-danger" id="laporan">
                        <option selected disabled hidden> SILA PILIH </option>
                        @foreach ($laporan as $index => $l)
                            <option value={{ $index }}>{{ $l }}</option>
                        @endforeach
                    </select>
                </div>
                {{-- <div class="col-xl-6"></div> --}}
                {{-- <div class="col-xl-6">
                    <label class="col-form-label text-main">Tarikh Mula</label>
                    <x-custom-date-input name="tarikh_mula" />
                </div>

                <div class="col-xl-6">
                    <label class="col-form-label text-main">Tarikh Akhir</label>
                    <x-custom-date-input name="tarikh_akhir" />
                </div>

                <div class="text-end mt-5">
                    <button type="submit" class="btn btn-danger">Jana Dokumen
                        <span data-feather="file-plus"></span>
                    </button>
                </div> --}}

                {{-- 1 --}}
                <div class="col-xl-6 mb-3" id="1">
                    <label class="col-form-label text-main">Bulan Tahun</label>
                    <x-custom-month-year-input name="bulan_tahun" />
                </div>

                {{-- 2 --}}
                <div class="col-xl-6 mb-3" id="2">
                    <label class="col-form-label text-main">Harian/Bulanan</label>
                    <select name="hb" class="form-select border-danger" id="hb">
                        <option selected disabled hidden> SILA PILIH </option>
                        <option value="harian">Harian</option>
                        <option value="bulanan">Bulanan</option>
                    </select>
                </div>
                <div class="row m-0 p-0" id="harian">
                    <div class="col-xl-6 mb-3"></div>
                    <div class="col-xl-6 mb-3">
                        <label class="col-form-label text-main">Bulan Tahun</label>
                        <x-custom-month-year-input name="bulan_tahun" />
                    </div>
                </div>
                <div class="row m-0 p-0" id="bulanan">
                    <div class="col-xl-6 mb-3"></div>
                    <div class="col-xl-6 mb-3" >
                        <label class="col-form-label text-main">Tahun</label>
                        <x-custom-year-input name="tahun" />
                    </div>
                </div>
                

                {{-- 3 --}}
                <div id="3" class="col-xl-6 mb-3">
                    <div class="">
                        <label class="col-form-label text-main">Tarikh Mula</label>
                        <x-custom-date-input name="mula" />
                    </div>
                    <div class=" mb-3"></div>
                    <div class="">
                        <label class="col-form-label text-main">Tarikh Akhir</label>
                        <x-custom-date-input name="mula" />
                    </div>
                </div>


            </form>

        </div>

    </div>
    <script>
        $(document).ready(function() {
            $('#1').hide();
            $('#2').hide();
            $('#3').hide();
            $('#harian').hide();
            $('#bulanan').hide();
        });

        $('#laporan').change(function() {
            var id = $(this).val();
            if (id == 1) {
                $('#1').show();
                $('#2').hide();
                $('#3').hide();
                $('#harian').hide();
                $('#bulanan').hide();
            } else if (id == 2) {
                $('#1').hide();
                $('#2').show();
                $('#3').hide();
                $('#harian').hide();
                $('#bulanan').hide();
            } else {
                $('#1').hide();
                $('#2').hide();
                $('#3').show();
                $('#harian').hide();
                $('#bulanan').hide();
            }
        });

        $('#hb').change(function() {
            var choice_hb = $(this).val();
            if (choice_hb == 'harian') {
                $('#harian').show();
                $('#bulanan').hide();
            } else {
                $('#harian').hide();
                $('#bulanan').show();
            }
        })
    </script>
@endsection


{{-- stash --}}
{{-- @extends('layouts.base')
@section('content')
    <x-header main="Laporan" sub="Fatherpalm" sub2="" />
    <div class="row justify-content-center mt-5">
        <div class="col-xl-8">
            <form class="row" action="{{ route('laporan.fatherpalmStore') }}" method="POST">
                @csrf
                <div class="col-xl-6 mb-3">
                    <label class="col-form-label text-main">Laporan</label>
                    <select name="laporan" class="form-select border-danger" id="laporan">
                        <option selected disabled hidden> SILA PILIH </option>
                        @foreach ($laporan as $index => $l)
                            <option value={{ $index }}>{{ $l }}</option>
                        @endforeach
                    </select>
                </div>

                <div id="choice" class="col-xl-6 mb-3">

                </div>
            </form>

        </div>

    </div>
    <script>

        $('#laporan').change(function() {
            var id = $(this).val();
            // $('#'+id).removeClass('hide');
            if (id == 1) {
                $('#choice').html('');
                $('#choice').append(`<div id="1">
                    <label class="col-form-label text-main">Bulan Tahun</label>
                    <x-custom-month-year-input name="bulan_tahun" />
                </div>`);
            } else if (id == 2) {
                $('#choice').html('');
                $('#choice').append(`<div id="2">
                    <label class="col-form-label text-main">Harian/Bulanan</label>
                    <select name="pilihan_hb" class="form-select border-danger" id="pilihan_hb">
                        <option selected disabled hidden> SILA PILIH </option>
                        <option value="harian">Harian</option>
                        <option value="bulanan">Bulanan</option>
                    </select>
                </div>
                <div></div>
                <div id="choice_hb"></div>
                
                `);

                $('#pilihan_hb').change(function() {
                    var type = $(this).val();
                    if (type = "harian") {
                        $('#choice_hb').html('');
                        $('#choice_hb').append(`<div id="harian">
                            <label class="col-form-label text-main">Bulan Tahun</label>
                            <x-custom-month-year-input name="bulan_tahun" />
                        </div>`);
                    } else {
                        $('#choice_hb').html('');
                        $('#choice_hb').append(`<div id="bulanan">
                            <label class="col-form-label text-main">Tahun</label>
                            <x-custom-year-input name="tahun" />
                        </div>`);
                    }
                })
            } else {
                $('#choice').html('');
                $('#choice').append(`<div>
                        <label class="col-form-label text-main">Tarikh Mula</label>
                        <x-custom-calendar-input name="mula" />
                    </div>
                    <div></div>
                    <div>
                        <label class="col-form-label text-main">Tarikh Akhir</label>
                        <x-custom-calendar-input name="mula" />
                    </div>`);
            }
        });
    </script>
@endsection --}}
