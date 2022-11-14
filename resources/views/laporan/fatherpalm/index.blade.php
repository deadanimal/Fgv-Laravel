@extends('layouts.base')
@section('content')
    <x-header main="Laporan" sub="Fatherpalm" sub2="" />
    <div class="row justify-content-center mt-5">
        <div class="col-xl-8">
            <div class="row">
                <div class="col-xl-6 mb-3">
                    <label class="col-form-label text-main">Kategori Laporan</label>
                    <select name="kategori" class="form-select border-danger">
                        <option selected disabled hidden> SILA PILIH </option>
                        <option value="Balut">Balut</option>
                        <option value="Pendebungaan Terkawal">Pendebungaan Terkawal</option>
                        <option value="Kawalan Kualiti">Kawalan Kualiti</option>
                        <option value="Penuaian">Penuaian</option>
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

                {{-- <div class="text-end mt-5">
                    <button type="submit" class="btn btn-danger">Jana Documen
                        <span data-feather="file-plus"></span>
                    </button>
                </div> --}}
            </div>

        </div>

    </div>
@endsection
