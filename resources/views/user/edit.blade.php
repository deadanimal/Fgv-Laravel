@extends('layouts.base')
@section('content')
    <x-header main="Pengurusan Pengguna" sub="Petugas" sub2="Daftar Petugas" />

    <div class="container">
        <form action="{{ route('pp.update', $user->id) }}" method="post">
            @method('put')
            @csrf
            <div class="row justify-content-center mt-5">
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
                                    <input type="text" name="nama"
                                        class="form-control border-main  @error('nama') is-invalid @enderror"
                                        placeholder="SILA TAIP DI SINI" value="{{ $user->nama }}">
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
                                    <input type="text" name="no_kakitangan"
                                        class="form-control border-main  @error('no_kakitangan') is-invalid @enderror"
                                        placeholder="SILA TAIP DI SINI" value="{{ $user->no_kakitangan }}">
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
                                        placeholder="000000000000" value="{{ $user->no_kad_pengenalan }}">
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
                                        placeholder="0171231233" value="{{ $user->no_telefon }}">
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
                                        placeholder="a@b.com" value="{{ $user->email }}">
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
                                        @foreach ($stesens as $stesen)
                                            <option @selected($user->stesen == $stesen->name) value="{{ $stesen->name }}">
                                                {{ $stesen->name }}</option>
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
                                        @foreach ($kategoris as $kp)
                                            <option @selected($user->kategori_petugas == $kp->name) value="{{ $kp->name }}">
                                                {{ $kp->name }}</option>
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
                                        @foreach ($roles as $role)
                                            <option @selected($user->peranan == $role->display_name) value="{{ $role->name }}">
                                                {{ $role->display_name }}</option>
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
                                    <input type="text" name="blok"
                                        class="form-control border-main  @error('blok') is-invalid @enderror"
                                        placeholder="SILA TAIP DI SINI" value="{{ $user->blok }}">
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
                                        <option @selected($user->luput_pwd == 90) value="90">90 Hari</option>
                                        <option @selected($user->luput_pwd == 180) value="180">180 Hari</option>
                                        <option @selected($user->luput_pwd == 270) value="270">270 Hari</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                <div class="text-center">
                    <button class="btn btn-danger" type="button" data-bs-toggle="modal"
                        data-bs-target="#update_password"> Password
                        <span data-feather="settings"></span>
                    </button>
                    {{-- <button class="btn btn-danger" type="button"> Set Semula Password
                        <span data-feather="settings"></span>
                    </button> --}}
                    <button class="btn btn-danger" type="submit">Kemaskini
                        <span data-feather="check-circle"></span>
                    </button>
                </div>
            </div>

        </form>
    </div>
    <div class="modal fade" id="update_password" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px">
            <div class="modal-content position-relative">
                <div class="position-absolute top-0 end-0 mt-2 me-2 z-index-1">
                    <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base"
                        data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('pp.updatePwd', $user->id) }}" method="post" id="formpwd">
                    @csrf
                    <div class="modal-body p-0">
                        <div class="rounded-top-lg py-3 ps-4 pe-6 bg-light">
                            <h4 class="mb-1" id="modalExampleDemoLabel">Kemaskini Password </h4>
                        </div>
                        <div class="p-4 pb-0">
                            {{-- <div class="mb-3">
                                    <label class="col-form-label" for="p1">New Password:</label>
                                    <input class="form-control" id="p1" type="text" />
                                </div>
                                <div class="mb-3">
                                    <label class="col-form-label" for="p2">New Password Confirmation:</label>
                                    <input class="form-control" name="password" id="p2" type="text" />
                                </div>
                                <div>
                                    <p id="err-msg-pwd" class="text-danger hide">Password dimasukkan tidak sama</p>
                                </div> --}}
                            <div class="text-center mb-4">
                                <button class="btn btn-danger" id="btnsubmitpwd" type="submit">Set Semula </button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Tutup</button>
                        {{-- <button class="btn btn-primary" id="btnsubmitpwd" type="submit">Simpan </button> --}}
                    </div>
                </form>


            </div>
        </div>
    </div>


    <script>
        // $('#err-msg-pwd').hide();

        // $('#btnsubmitpwd').click(function(e) {
        //     e.preventDefault();
        //     if ($('#p1').val() != $('#p2').val()) {
        //         $('#err-msg-pwd').show();
        //     } else {
        //         $('#err-msg-pwd').hide();
        //         $('#formpwd').submit();
        //     }
        // });

        $("#btnsubmitpwd").click(function(e) {
            e.preventDefault();
            let form = $(this).parent('form');

            Swal.fire({
                title: 'Perhatian!',
                text: 'Adakah anda pasti?',
                icon: 'warning',
                showCancelButton: true,
                cancelButtonText: 'Kembali',
                confirmButtonText: 'Pasti',
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#formpwd').submit();
                }
            });
        });

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
