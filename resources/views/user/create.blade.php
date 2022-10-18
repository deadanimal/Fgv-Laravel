@extends('layouts.base')
@section('content')
    <x-header main="Pengurusan Pengguna" sub="Petugas" sub2="Daftar Petugas" />

    <div class="container">
        <form action="{{ route('pp.store') }}" method="post">
            @csrf
            <div class="row justify-content-center mt-4">
                <div class="col-10 px-0">
                    <h3 class="fw-bold text-uppercase text-main">Maklumat Pekerja</h3>
                    <h5 class="text-main">Sila isikan maklumat pekerja berikut dengan betul.</h5>

                    <div class="row align-items-center mt-5">

                        <div class="col-xl-6">
                            <div class="row align-items-center">
                                <div class="col-xl-3">
                                    <label class="col-form-label text-main">Nama</label>
                                </div>
                                <div class="col-xl-8">
                                    <input type="text" name="nama"
                                        class="form-control border-main  @error('nama') is-invalid @enderror"
                                        placeholder="SILA TAIP DISINI">
                                </div>

                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="row align-items-center">
                                <div class="col-1"></div>
                                <div class="col-xl-3">
                                    <label class="col-form-label text-main">No. Kakitangan</label>
                                </div>
                                <div class="col-xl-8">
                                    <input type="number" name="no_kakitangan"
                                        class="form-control border-main  @error('no_kakitangan') is-invalid @enderror"
                                        placeholder="SILA TAIP DISINI">
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="row align-items-center">
                                <div class="col-xl-3">
                                    <label class="col-form-label text-main">No. Kad Pengenalan</label>
                                </div>
                                <div class="col-xl-8">
                                    <input type="number" name="no_kad_pengenalan"
                                        class="form-control border-main  @error('no_kad_pengenalan') is-invalid @enderror"
                                        placeholder="SILA TAIP DISINI">
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="row align-items-center">
                                <div class="col-1"></div>
                                <div class="col-xl-3">
                                    <label class="col-form-label text-main">No. Telefon</label>
                                </div>
                                <div class="col-xl-8">
                                    <input type="number" name="no_telefon"
                                        class="form-control border-main @error('no_telefon') is-invalid @enderror"
                                        placeholder="SILA TAIP DISINI">
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 my-2">
                            <div class="row align-items-center">
                                <div class="col-xl-3">
                                    <label class="col-form-label text-main">E-mel</label>
                                </div>
                                <div class="col-xl-8">
                                    <input type="text" name="email"
                                        class="form-control border-main  @error('email') is-invalid @enderror"
                                        placeholder="SILA TAIP DISINI">
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 my-2">
                            <div class="row align-items-center">
                                <div class="col-1"></div>
                                <div class="col-xl-3">
                                    <label class="col-form-label text-main">Stesen</label>
                                </div>
                                <div class="col-xl-8">
                                    <select name="stesen"
                                        class="form-select border-main  @error('stesen') is-invalid @enderror"
                                        id="email">
                                        <option selected disabled hidden> SILA PILIH </option>
                                        <option value="Pahang">Pahang</option>
                                        <option value="Sabah">Sabah</option>
                                        <option value="Johor">Johor</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="row align-items-center">
                                <div class="col-xl-3">
                                    <label class="col-form-label text-main">Kategori Petugas</label>
                                </div>
                                <div class="col-xl-8">
                                    <select name="kategori_petugas"
                                        class="form-select border-main @error('kategori_petugas') is-invalid @enderror"
                                        id="email">
                                        <option selected disabled hidden> SILA PILIH </option>
                                        <option value="Petugas Am">Petugas Am</option>
                                        <option value="Pekerja Operasi Ladang">Pekerja Operasi Ladang</option>
                                        <option value="Tenaga Kerja Luar">Tenaga Kerja Luar</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="row align-items-center">
                                <div class="col-1"></div>
                                <div class="col-xl-3">
                                    <label class="col-form-label text-main">Tugasan</label>
                                </div>
                                <div class="col-xl-8">
                                    <select name="tugasan"
                                        class="form-select border-main  @error('tugasan') is-invalid @enderror"
                                        id="email">
                                        <option selected disabled hidden> SILA PILIH </option>
                                        <option value="Petugas Am">Petugas Am</option>
                                        <option value="Pekerja Operasi Ladang">Pekerja Operasi Ladang</option>
                                        <option value="Tenaga Kerja Luar">Tenaga Kerja Luar</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 my-2">
                            <div class="row align-items-center">
                                <div class="col-xl-3">
                                    <label class="col-form-label text-main">Blok</label>
                                </div>
                                <div class="col-xl-8">
                                    <input type="text" name="blok"
                                        class="form-control border-main  @error('blok') is-invalid @enderror"
                                        placeholder="SILA TAIP DISINI">
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="row align-items-center">
                                <div class="col-1"></div>
                                <div class="col-xl-3">
                                    <label class="col-form-label text-main">Jangka Hayat Laluan</label>
                                </div>
                                <div class="col-xl-8">
                                    <select name="luput_pwd"
                                        class="form-select border-main  @error('luput_pwd') is-invalid @enderror"
                                        id="email">
                                        <option selected disabled hidden> SILA PILIH </option>
                                        <option value="90">90 Hari</option>
                                        <option value="180">180 Hari</option>
                                        <option value="270">270 Hari</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="peranan" value="Pengguna">

                    </div>
                </div>
            </div>

            <div class="row mt-5">
                <div class="text-center">
                    <button id="custom-btn-white" type="button" class="btn btn-white me-3 border-danger text-danger">
                        Set Semula
                        <span data-feather="refresh-ccw" style="width: 15px;"></span>
                    </button>
                    <button type="submit" class="btn btn-danger">Daftar
                        <span data-feather="plus-circle"></span>
                    </button>
                </div>
            </div>

        </form>

    </div>

    <script>
        $("#custom-btn-white").mouseenter(function() {
            $(this).removeClass('btn-white');
            $(this).removeClass('text-danger');
            $(this).addClass('btn-danger');
            $(this).addClass('text-white');

        });
        $("#custom-btn-white").mouseleave(function() {
            $(this).addClass('btn-white');
            $(this).addClass('text-danger');
            $(this).removeClass('btn-danger');
            $(this).removeClass('text-white');
        });

        $('#custom-btn-white').click(function() {
            location.reload();
        });
    </script>
@endsection
