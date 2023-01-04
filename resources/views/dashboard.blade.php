@extends('layouts.base')

@section('content')
    {{-- <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Launch static
        backdrop modal</button> --}}
    @if (auth()->user()->first_login)
        <div class="modal fade" id="setNewPassword" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1"
            aria-labelledby="setNewPasswordLabel" aria-hidden="true">
            <div class="modal-dialog modal-md mt-6" role="document">
                <div class="modal-content border-0">
                    <div class="position-absolute top-0 end-0 mt-3 me-3 z-index-1">
                        <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base"
                            data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-0">
                        <div class="bg-light rounded-top-lg py-3 ps-4 pe-6">
                            <h4 class="mb-1" id="setNewPasswordLabel">Sila Kemaskini Kata Laluan Anda</h4>
                        </div>
                        <div class="p-4">
                            <form class="row" action="{{ route('pp.newPwd', auth()->id()) }}" method="POST">
                                @csrf
                                <div class="col-lg-12">
                                    <label class="mb-3 fw-bold" for="">Kata Laluan Baru</label>
                                    <input type="password" id="pwd1" name="password1" class="form-control mb-3">
                                    <input type="password" id="pwd2" name="password2" class="form-control mb-3">

                                    <label class="text-danger" id="takSepadan">*Kata Laluan Tidak Sepadan</label>
                                    <div class="text-end">
                                        <button class="btn btn-sm btn btn-success" type="submit"
                                            id="btnTukarPwd">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <div class="row mt-5">
                    <div class="col-6 text-center" style="border-right-style: solid;border-right-color:#40131c; ">
                        <h4 id="motherpalm" class="fw-bold" style="cursor: pointer;">MOTHERPALM </h4>
                    </div>

                    <div class="col-6 text-center">
                        <h4 id="fatherpalm" style="cursor: pointer;" class="fw-bold opacity-50">FATHERPALM</h4>
                    </div>
                </div>

            </div>

            <div class="col-md-8 mt-5" id="divmotherpalm">
                <div class="row align-items-center">
                    <div class="col-md-6 mb-3">
                        <div class="card">
                            <img class="card-img" src="/main-image/card-bg.png">
                            <div class="card-img-overlay text-white text-center">
                                <h4 class="text-white">BALUT</h4>

                                <div class="d-flex align-items-center mt-3">
                                    <div class="col-6">
                                        <span class="text-white h4 fw-bolder">{{ $motherpalm['balut']['hariini'] }}</span>
                                        <br>
                                        <span class="text-white h7">HARI INI</span>
                                    </div>
                                    <div class="d-flex" style="height: 4rem;">
                                        <div class="vr" style="width: 3px;color:red; opacity:inherit;"></div>
                                    </div>

                                    <div class="col-6">
                                        <span
                                            class="text-white h4 fw-bolder">{{ $motherpalm['balut']['hinggakini'] }}</span>
                                        <br>
                                        <span class="text-white h7">HINGGA KINI</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="card">
                            <img class="card-img" src="/main-image/card-bg.png">
                            <div class="card-img-overlay text-white text-center">
                                <h5 class="text-white">PENDEBUNGAAN TERKAWAL</h5>

                                <div class="d-flex align-items-center mt-3">
                                    <div class="col-6">
                                        <span class="text-white h4 fw-bolder">{{ $motherpalm['debung']['hariini'] }}</span>
                                        <br>
                                        <span class="text-white h7">HARI INI</span>
                                    </div>
                                    <div class="d-flex" style="height: 4rem;">
                                        <div class="vr" style="width: 3px;color:red; opacity:inherit;"></div>
                                    </div>

                                    <div class="col-6">
                                        <span
                                            class="text-white h4 fw-bolder">{{ $motherpalm['debung']['hinggakini'] }}</span>
                                        <br>
                                        <span class="text-white h7">HINGGA KINI</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="card">
                            <img class="card-img" src="/main-image/card-bg.png">
                            <div class="card-img-overlay text-white text-center">
                                <h4 class="text-white">KAWALAN KUALITI</h4>

                                <div class="d-flex align-items-center mt-3">
                                    <div class="col-6">
                                        <span class="text-white h4 fw-bolder">{{ $motherpalm['kawal']['hariini'] }}</span>
                                        <br>
                                        <span class="text-white h7">HARI INI</span>
                                    </div>
                                    <div id="linemerah" class="d-flex" style="height: 4rem;">
                                        <div class="vr" style="width: 3px;color:red; opacity:inherit;"></div>
                                    </div>

                                    <div class="col-6">
                                        <span
                                            class="text-white h4 fw-bolder">{{ $motherpalm['kawal']['hinggakini'] }}</span>
                                        <br>
                                        <span class="text-white h7">HINGGA KINI</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="card">
                            <img class="card-img" src="/main-image/card-bg.png">
                            <div class="card-img-overlay text-white text-center">
                                <h4 class="text-white">PENUAIAN</h4>

                                <div class="d-flex align-items-center mt-3">
                                    <div class="col-6">
                                        <span class="text-white h4 fw-bolder">{{ $motherpalm['tuai']['hariini'] }}</span>
                                        <br>
                                        <span class="text-white h7">HARI INI</span>
                                    </div>
                                    <div class="d-flex" style="height: 4rem;">
                                        <div class="vr" style="width: 3px;color:red; opacity:inherit;"></div>
                                    </div>

                                    <div class="col-6">
                                        <span
                                            class="text-white h4 fw-bolder">{{ $motherpalm['tuai']['hinggakini'] }}</span>
                                        <br>
                                        <span class="text-white h7">HINGGA KINI</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8" style="margin-top: 10%;" id="divfatherpalm">
                <div class="row align-items-center">

                    <div class="col-md-6 mb-3">
                        <div class="card">
                            <img class="card-img" src="/main-image/card-bg.png">
                            <div class="card-img-overlay text-white text-center">
                                <h4 class="text-white">BALUT</h4>

                                <div class="d-flex align-items-center mt-3">
                                    <div class="col-6">
                                        <span class="text-white h4 fw-bolder">{{ $fatherpalm['balut']['hariini'] }}</span>
                                        <br>
                                        <span class="text-white h7">HARI INI</span>
                                    </div>
                                    <div class="d-flex" style="height: 4rem;">
                                        <div class="vr" style="width: 3px;color:red; opacity:inherit;"></div>
                                    </div>

                                    <div class="col-6">
                                        <span
                                            class="text-white h4 fw-bolder">{{ $fatherpalm['balut']['hinggakini'] }}</span>
                                        <br>
                                        <span class="text-white h7">HINGGA KINI</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="card">
                            <img class="card-img" src="/main-image/card-bg.png">
                            <div class="card-img-overlay text-white text-center">
                                <h4 class="text-white">PENUAIAN</h4>

                                <div class="d-flex align-items-center mt-3">
                                    <div class="col-6">
                                        <span class="text-white h4 fw-bolder">{{ $fatherpalm['tuai']['hariini'] }}</span>
                                        <br>
                                        <span class="text-white h7">HARI INI</span>
                                    </div>
                                    <div class="d-flex" style="height: 4rem;">
                                        <div class="vr" style="width: 3px;color:red; opacity:inherit;"></div>
                                    </div>

                                    <div class="col-6">
                                        <span
                                            class="text-white h4 fw-bolder">{{ $fatherpalm['tuai']['hinggakini'] }}</span>
                                        <br>
                                        <span class="text-white h7">HINGGA KINI</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $("#divmotherpalm").show();
            $("#divfatherpalm").hide();
            $("#takSepadan").hide();

            $("#setNewPassword").modal('show');


        });

        $("#fatherpalm").click(function() {
            $(this).removeClass('opacity-50');
            $("#motherpalm").addClass('opacity-50');
            $("#divmotherpalm").hide();
            $("#divfatherpalm").show();
        });
        $("#motherpalm").click(function() {
            $(this).removeClass('opacity-50');
            $("#fatherpalm").addClass('opacity-50');
            $("#divmotherpalm").show();
            $("#divfatherpalm").hide();
        });

        $('#btnTukarPwd').click(function(e) {
            e.preventDefault();

            if ($('#pwd1').val() == $('#pwd2').val()) {
                $("#takSepadan").hide();
                $(this).closest('form').submit();
            } else {
                $("#takSepadan").show();
            }

        });
    </script>
@endsection
