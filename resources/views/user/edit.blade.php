@extends('layouts.base')
@section('content')
    <x-header main="Pengurusan Pengguna" sub="Petugas" sub2="Daftar Petugas" />

    <div class="container">
        <form action="{{ route('pp.update', $user->id) }}" method="post">
            @method('put')
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
                                    <input type="text" name="nama" class="form-control border-main"
                                        value="{{ $user->nama }}">
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
                                    <input type="text" name="no_kakitangan" class="form-control border-main"
                                        value="{{ $user->no_kakitangan }}">
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="row align-items-center">
                                <div class="col-xl-3">
                                    <label class="col-form-label text-main">No. Kad Pengenalan</label>
                                </div>
                                <div class="col-xl-8">
                                    <input type="number" name="no_kad_pengenalan" class="form-control border-main"
                                        value="{{ $user->no_kad_pengenalan }}">
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
                                    <input type="number" name="no_telefon" class="form-control border-main"
                                        value="{{ $user->no_telefon }}">
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 my-2">
                            <div class="row align-items-center">
                                <div class="col-xl-3">
                                    <label class="col-form-label text-main">E-mel</label>
                                </div>
                                <div class="col-xl-8">
                                    <input type="text" name="email" class="form-control border-main"
                                        value="{{ $user->email }}">
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
                                    <select name="stesen" class="form-select border-main">
                                        <option {{ $user->stesen == 'Pahang' ? 'selected' : '' }} value="Pahang">Pahang
                                        </option>
                                        <option {{ $user->stesen == 'Sabah' ? 'selected' : '' }} value="Sabah">Sabah
                                        </option>
                                        <option {{ $user->stesen == 'Johor' ? 'selected' : '' }} value="Johor">Johor
                                        </option>
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
                                    <select name="kategori_petugas" class="form-select border-main">
                                        <option {{ $user->kategori_petugas == 'Petugas Am' ? 'selected' : '' }}
                                            value="Petugas Am">Petugas Am
                                        </option>
                                        <option {{ $user->kategori_petugas == 'Pekerja Operasi Ladang' ? 'selected' : '' }}
                                            value="Pekerja Operasi Ladang">Pekerja Operasi Ladang</option>
                                        <option {{ $user->kategori_petugas == 'Tenaga Kerja Luar' ? 'selected' : '' }}
                                            value="Tenaga Kerja Luar">Tenaga Kerja Luar</option>
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
                                    <select name="tugasan" class="form-select border-main">
                                        <option {{ $user->kategori_petugas == 'Petugas Am' ? 'selected' : '' }}
                                            value="Petugas Am">Petugas Am
                                        </option>
                                        <option {{ $user->kategori_petugas == 'Pekerja Operasi Ladang' ? 'selected' : '' }}
                                            value="Pekerja Operasi Ladang">Pekerja Operasi Ladang</option>
                                        <option {{ $user->kategori_petugas == 'Tenaga Kerja Luar' ? 'selected' : '' }}
                                            value="Tenaga Kerja Luar">Tenaga Kerja Luar</option>
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
                                    <input type="text" name="blok" class="form-control border-main"
                                        value="{{ $user->blok }}">
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
                                    <select name="luput_pwd" class="form-select border-main" id="email">
                                        <option {{ $user->luput_pwd == '90' ? 'selected' : '' }} value="90">90 Hari
                                        </option>
                                        <option {{ $user->luput_pwd == '180' ? 'selected' : '' }} value="180">180 Hari
                                        </option>
                                        <option {{ $user->luput_pwd == '270' ? 'selected' : '' }} value="270">270 Hari
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row mt-5">
                <div class="text-center">
                    <button class="btn btn-danger" type="submit">Kemaskini
                        <span data-feather="check-circle"></span>
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
    </script>
@endsection
