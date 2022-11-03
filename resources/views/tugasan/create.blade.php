@extends('layouts.base')
@section('content')
    <x-header main="Pengurusan Pengguna" sub="Laporan Petugas" sub2="Tambah Tugasan" />

    <div class="container">
        <form action="{{ route('tugasan.store') }}" method="post">
            @csrf
            <div class="row justify-content-center mt-4">
                <div class="col-10 px-0">
                    <h3 class="fw-bold text-uppercase text-main">Tambah Tugasan</h3>
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
                        <div class="col-xl-6 mb-4">
                            <div class="row align-items-center">
                                <div class="col-xl-3">
                                    <label class="col-form-label text-main">Tandan</label>
                                </div>
                                <div class="col-xl-8">
                                    <select name="tandan_id"
                                        class="form-select border-main @error('tandan') is-invalid @enderror">
                                        <option selected disabled hidden> SILA PILIH </option>
                                        @foreach ($tandans as $tandan)
                                            <option value="{{ $tandan->id }}">{{ $tandan->no_daftar }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                        </div>

                        <div class="col-xl-6 mb-4">
                            <div class="row align-items-center">
                                <div class="col-1"></div>
                                <div class="col-xl-2">
                                    <label class="col-form-label text-main">Jenis</label>
                                </div>
                                <div class="col-xl-9">
                                    <select name="jenis"
                                        class="form-select border-main @error('jenis') is-invalid @enderror">
                                        <option selected disabled hidden> SILA PILIH </option>
                                        <option value="balut">Balut</option>
                                        <option value="debung">Debung</option>
                                        <option value="kawal">Kawal</option>
                                        <option value="tuai">Tuai</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 mb-4">
                            <div class="row align-items-center">
                                <div class="col-xl-3">
                                    <label class="col-form-label text-main">Catatan</label>
                                </div>
                                <div class="col-xl-8">
                                    <input type="text" name="catatan"
                                        class="form-control border-main  @error('catatan') is-invalid @enderror"
                                        placeholder="SILA TAIP DISINI">
                                </div>

                            </div>
                        </div>

                        <div class="col-xl-6 mb-4">
                            <div class="row align-items-center">
                                <div class="col-xl-1"></div>
                                <div class="col-xl-2">
                                    <label class="col-form-label text-main">Tarikh</label>
                                </div>
                                <div class="col-xl-9">
                                    <div class="input-group">
                                        <input class="form-control datetimepicker border-main border-right-0" type="text"
                                            placeholder="SILA PILIH" data-options='{"disableMobile":true}'
                                            aria-describedby="date" name="tarikh" />

                                        <button type="button" class="btn border-main border-left-0 customdate"><span
                                                class="far fa-calendar-alt text-main"></button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 mb-4 ">
                            <div class="row align-items-center">
                                <div class="col-xl-3">
                                    <label class="col-form-label text-main">Petugas</label>
                                </div>
                                <div class="col-xl-8">
                                    <select name="petugas_id" data-options='{"removeItemButton":true,"placeholder":true}'
                                        class="form-select border-main @error('petugas_id') is-invalid @enderror  js-choice"
                                        size="1">
                                        <option value=""> SILA PILIH </option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->nama }}</option>
                                        @endforeach
                                    </select>


                                </div>
                            </div>
                        </div>



                        <input type="hidden" name="status" value="dicipta">

                    </div>
                </div>

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

        $(".customdate").click(function() {
            $(this).siblings("input").trigger("click");
        });
    </script>
@endsection
