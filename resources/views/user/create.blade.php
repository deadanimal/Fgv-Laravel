@extends('layouts.base')
@section('content')
    <style>
        .choices {
            margin-bottom: 0%;
        }
    </style>
    <x-header main="Pengurusan Pengguna" sub="Petugas" sub2="Daftar Petugas" />

    <div class="container">
        <form action="{{ route('pp.store') }}" method="post">
            @csrf
            <div class="row justify-content-center mt-4">
                <div class="col-10 px-0">
                    <h3 class="fw-bold text-uppercase text-main">Maklumat Pekerja</h3>
                    <h5 class="text-main">Sila isikan maklumat pekerja berikut dengan betul.</h5>

                    <div class="row align-items-center mt-5">
                        <div class="col-12">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                        <div class="col-xl-6">
                            <div class="row align-items-center">
                                <div class="col-xl-3">
                                    <label class="col-form-label text-main">Nama</label>
                                </div>
                                <div class="col-xl-8">
                                    <input style="text-transform: uppercase" type="text" name="nama"
                                        class="form-control border-main  @error('nama') is-invalid @enderror"
                                        placeholder="SILA TAIP DI SINI" value="{{ old('nama') }}">
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
                                    <input type="text" name="no_kakitangan" id="inputNoKakitangan"
                                        class="form-control border-main  @error('no_kakitangan') is-invalid @enderror"
                                        placeholder="SILA TAIP DI SINI" value="{{ old('no_kakitangan') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="row align-items-center">
                                <div class="col-xl-3">
                                    <label class="col-form-label text-main">No. Kad Pengenalan</label>
                                </div>
                                <div class="col-xl-8">
                                    <input type="text" name="no_kad_pengenalan"
                                        class="form-control border-main  @error('no_kad_pengenalan') is-invalid @enderror"
                                        placeholder="000000000000" value="{{ old('no_kad_pengenalan') }}">
                                </div>
                            </div>

                        </div>

                        <div class="col-xl-6">
                            <div class="row align-items-center">
                                <div class="col-xl-1"></div>
                                <div class="col-xl-3">
                                    <label class="col-form-label text-main">No. Telefon</label>
                                </div>
                                <div class="col-xl-8">
                                    <input type="text" name="no_telefon"
                                        class="form-control border-main @error('no_telefon') is-invalid @enderror"
                                        placeholder="0171231233" value="{{ old('no_telefon') }}">
                                </div>
                            </div>
                        </div>



                        <div class="col-xl-6">
                            <div class="row align-items-center">
                                <div class="col-xl-3">
                                    <label class="col-form-label text-main">E-mel</label>
                                </div>
                                <div class="col-xl-8">
                                    <input type="text" name="email"
                                        class="form-control border-main  @error('email') is-invalid @enderror"
                                        placeholder="a@b.com" value="{{ old('email') }}">
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
                                        class="form-select border-main  @error('stesen') is-invalid @enderror">
                                        <option selected disabled hidden> SILA PILIH </option>
                                        @foreach ($stesens as $stesen)
                                            <option {{ old('stesen') == $stesen->name ? 'selected' : '' }}
                                                value="{{ $stesen->name }}">{{ $stesen->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 my-2">
                            <div class="row align-items-center">
                                <div class="col-xl-3">
                                    <label class="col-form-label text-main">Kategori Petugas</label>
                                </div>
                                <div class="col-xl-8">
                                    <select name="kategori_petugas"
                                        class="form-select border-main @error('kategori_petugas') is-invalid @enderror">
                                        <option selected disabled hidden> SILA PILIH </option>
                                        @foreach ($kategoris as $kp)
                                            <option {{ old('kategori_petugas') == $kp->name ? 'selected' : '' }}
                                                value="{{ $kp->name }}">{{ $kp->name }}</option>
                                        @endforeach
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
                                    <select name="peranan"
                                        class="form-select border-main  @error('peranan') is-invalid @enderror">
                                        <option selected disabled hidden> SILA PILIH </option>
                                        @foreach ($roles as $role)
                                            <option {{ old('peranan') == $role->name ? 'selected' : '' }}
                                                value="{{ $role->name }}">{{ $role->display_name }}</option>
                                        @endforeach
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
                                    <select class="form-select js-choice" id="organizerMultiple" multiple="multiple"
                                        size="1" name="blok[]"
                                        data-options='{"removeItemButton":true,"placeholder":true}'>
                                        <option value="">Sila Pilih...</option>
                                        @foreach ($bloks as $blok)
                                            <option value="{{ $blok->nama }}">{{ $blok->nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('blok')
                                        <p class="text-sm text-danger">*SILA PILIH BLOK*</p>
                                    @enderror

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
                                        class="form-select border-main  @error('luput_pwd') is-invalid @enderror">
                                        <option selected disabled hidden> SILA PILIH </option>
                                        <option @selected(old('luput_pwd') == 90) value="90">90 Hari</option>
                                        <option @selected(old('luput_pwd') == 180) value="180">180 Hari</option>
                                        <option @selected(old('luput_pwd') == 270) value="270">270 Hari</option>
                                    </select>
                                </div>
                            </div>
                        </div>
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

        $("#inputNoKakitangan").keyup(function(e) {
            var val = $(this).val();
            var trim = $.trim(val);

            $(this).val(trim);


        });
    </script>
@endsection
