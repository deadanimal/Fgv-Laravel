@extends('layouts.base')
@section('content')
    <x-header main="Laporan" sub="Fatherpalm" sub2="" />
    <div class="row justify-content-center mt-5">
        <div class="col-xl-8">
            <form class="row" action="{{ route('laporan.fatherpalmStore') }}" method="POST">
                @csrf
                <div class="col-xl-6 mb-3">
                    <label class="col-form-label text-main">Laporan</label>
                    <select name="laporan" class="form-select border-danger">
                        <option selected disabled hidden> SILA PILIH </option>
                        <option value="1">Membalut vs Tuai Bunga Pasifera (Bulanan )</option>
                        <option value="2">Tuai Bunga Pisifera vs Berat Pollen (Bulanan)</option>
                        <option value="3">Penggunaan Pollen Bulanan</option>
                    </select>
                </div>
                <div class="col-xl-6"></div>
                <div class="col-xl-6">
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
                </div>
            </form>

        </div>

    </div>
@endsection
