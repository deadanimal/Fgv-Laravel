@extends('layouts.base')
@section('content')
    <x-header main="Laporan" sub="Motherpalm" sub2="" />


    <div class="container">
        <form action="#" method="post">
            @csrf
            <div class="row justify-content-center mt-4">
                <div class="col-10 px-0">

                    <div class="row align-items-center">

                        <div class="col-xl-6 mb-3">
                            <div class="row align-items-center">
                                <div class="col-xl-3">
                                    <label class="col-form-label text-main">Kategori Laporan</label>
                                </div>
                                <div class="col-xl-8">
                                    <select name="kategori" class="form-select border-main ">
                                        <option selected disabled hidden> SILA PILIH </option>
                                        <option value="Balut">Balut</option>
                                        <option value="Pendebungaan Terkawal">Pendebungaan Terkawal</option>
                                        <option value="Kawalan Kualiti">Kawalan Kualiti</option>
                                        <option value="Penuaian">Penuaian</option>
                                    </select>
                                </div>

                            </div>
                        </div>

                        <div class="col-xl-6 mb-3">
                            <div class="row align-items-center">
                                <div class="col-1"></div>
                                <div class="col-xl-2">
                                </div>
                                <div class="col-xl-9">
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 mb-3">
                            <div class="row align-items-center">
                                <div class="col-xl-3">
                                    <label class="col-form-label text-main">Tarikh Mula</label>
                                </div>
                                <div class="col-xl-8">
                                    <x-custom-date-input name="tarikh_mula" />
                                </div>

                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="row align-items-center">
                                <div class="col-xl-1"></div>
                                <div class="col-xl-2">
                                    <label class="col-form-label text-main">Tarikh Akhir</label>
                                </div>
                                <div class="col-xl-9">
                                    <div class="input-group">
                                        <x-custom-date-input name="tarikh_akhir" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- <div class="text-end mt-5">
                            <button type="submit" class="btn btn-danger">Jana Documen
                                <span data-feather="file-plus"></span>
                            </button>
                        </div> --}}

                    </div>
                </div>


            </div>

        </form>

    </div>
@endsection
