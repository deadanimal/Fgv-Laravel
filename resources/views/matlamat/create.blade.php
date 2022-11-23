@extends('layouts.base')
@section('content')
    <style>
        .ui-datepicker-calendar {
            display: none;
        }
    </style>
    <x-header main="Konfigurasi Data Rujukan" sub="Matlamat Bulanan / Tahunan" sub2="Daftar Matlamat" />

    <div class="container">
        <form action="{{ route('matlamat.store') }}" method="post">
            @csrf
            <div class="row justify-content-center mt-3">
                <div class="col-10 px-0">
                    <h4 class="text-main">DAFTAR TAHUN</h4>

                    <input type="hidden" name="jenis" value="tahun">
                    <div class="row align-items-center">

                        <div class="col-xl-6">
                            <div class="row align-items-center">
                                <div class="col-xl-3">
                                    <label class="col-form-label text-main">Proses</label>
                                </div>
                                <div class="col-xl-8">
                                    <select name="proses" class="form-select border-danger" required>
                                        <option selected disabled hidden>PILIH PROSES</option>
                                        <option value="Balut">Balut</option>
                                        <option value="Pendebungaan Terkawal">Pendebungaan Terkawal</option>
                                        <option value="Kawalan Kualiti">Kawalan Kualiti</option>
                                        <option value="Penuaian">Penuaian</option>
                                    </select>
                                </div>

                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="row align-items-center">
                                <div class="col-1"></div>
                                <div class="col-xl-3">
                                    <label class="col-form-label text-main">Tahun</label>
                                </div>
                                <div class="col-xl-8">
                                    <select name="tahun" class="form-select border-danger" required>
                                        <option selected disabled hidden>PILIH TAHUN</option>
                                        @foreach ($tahuns as $tahun)
                                            <option value="{{ $tahun }}">{{ $tahun }}</option>
                                        @endforeach

                                    </select>

                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="row align-items-center">
                                <div class="col-xl-3">
                                    <label class="col-form-label text-main">Matlamat Tahunan</label>
                                </div>
                                <div class="col-xl-8">
                                    <input type="text" name="matlamat" class="form-control border-danger "
                                        placeholder="MASUKKAN MATLAMAT">
                                </div>
                            </div>

                        </div>

                        <div class="col-xl-6">
                            <div class="row align-items-center">
                                <div class="col-xl-1"></div>
                                <div class="col-xl-11 text-end">
                                    <button class="btn btn-danger btn-sm" type="submit">Simpan <span
                                            class="fas fa-bookmark"></span></button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </form>

        <form class="mt-4" action="{{ route('matlamat.store') }}" method="post">
            @csrf
            <div class="row justify-content-center mt-5">

                <div class="col-10 px-0">
                    <h4 class="text-main">DAFTAR BULAN</h4>

                    <input type="hidden" name="jenis" value="bulan">
                    <div class="row align-items-center">

                        <div class="col-xl-6">
                            <div class="row align-items-center">
                                <div class="col-xl-3">
                                    <label class="col-form-label text-main">Proses</label>
                                </div>
                                <div class="col-xl-8">
                                    <select name="proses" class="form-select border-danger" required>
                                        <option selected disabled hidden>PILIH PROSES</option>
                                        <option value="Balut">Balut</option>
                                        <option value="Pendebungaan Terkawal">Pendebungaan Terkawal</option>
                                        <option value="Kawalan Kualiti">Kawalan Kualiti</option>
                                        <option value="Penuaian">Penuaian</option>
                                    </select>
                                </div>

                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="row align-items-center">
                                <div class="col-1"></div>
                                <div class="col-xl-3">
                                    <label class="col-form-label text-main">Untuk Tahun</label>
                                </div>
                                <div class="col-xl-8">
                                    <select name="matlamat_tahunan_id" class="form-select border-danger" required>
                                        <option selected disabled hidden>PILIH TAHUN</option>
                                        @foreach ($tahuns as $tahun)
                                            <option value="{{ $tahun }}">{{ $tahun }}</option>
                                        @endforeach

                                    </select>

                                </div>
                            </div>
                        </div>


                        <div class="col-xl-6">
                            <div class="row align-items-center">
                                <div class="col-xl-3">
                                    <label class="col-form-label text-main">Matlamat Bulanan</label>
                                </div>
                                <div class="col-xl-8">
                                    <input type="text" name="matlamat" class="form-control border-danger "
                                        placeholder="MASUKKAN MATLAMAT">
                                </div>
                            </div>

                        </div>

                        <div class="col-xl-6">
                            <div class="row align-items-center">
                                <div class="col-1"></div>
                                <div class="col-xl-3">
                                    <label class="col-form-label text-main">Bulan</label>
                                </div>
                                <div class="col-xl-8">
                                    <select name="bulan" class="form-select border-danger" required>
                                        <option selected disabled hidden>PILIH BULAN</option>
                                        @for ($i = 1; $i < 13; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>

                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 text-end">
                            <button class="btn btn-danger btn-sm">Simpan <span class="fas fa-bookmark"></span></button>

                        </div>




                    </div>
                </div>
            </div>

        </form>

    </div>
@endsection
