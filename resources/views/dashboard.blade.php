@extends('layouts.base')

@section('content')
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

                                <div class="d-flex align-items-center mt-2">
                                    <div class="col-6">
                                        <span class="text-white h3 fw-bolder">{{ $motherpalm['balut']['hariini'] }}</span>
                                        <br>
                                        <span class="text-white h7">HARI INI</span>
                                    </div>
                                    <div class="d-flex" style="height: 5rem;">
                                        <div class="vr" style="width: 3px;color:red; opacity:inherit;"></div>
                                    </div>

                                    <div class="col-6">
                                        <span
                                            class="text-white h3 fw-bolder">{{ $motherpalm['balut']['hinggakini'] }}</span>
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
                                <h3 class="text-white">PENDEBUNGAAN TERKAWAL</h3>

                                <div class="d-flex align-items-center mt-2">
                                    <div class="col-6">
                                        <span class="text-white h3 fw-bolder">{{ $motherpalm['debung']['hariini'] }}</span>
                                        <br>
                                        <span class="text-white h7">HARI INI</span>
                                    </div>
                                    <div class="d-flex" style="height: 5rem;">
                                        <div class="vr" style="width: 3px;color:red; opacity:inherit;"></div>
                                    </div>

                                    <div class="col-6">
                                        <span
                                            class="text-white h3 fw-bolder">{{ $motherpalm['debung']['hinggakini'] }}</span>
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
                                <h3 class="text-white">KAWALAN KUALITI</h3>

                                <div class="d-flex align-items-center mt-2">
                                    <div class="col-6">
                                        <span class="text-white h3 fw-bolder">{{ $motherpalm['kawal']['hariini'] }}</span>
                                        <br>
                                        <span class="text-white h7">HARI INI</span>
                                    </div>
                                    <div id="linemerah" class="d-flex" style="height: 5rem;">
                                        <div class="vr" style="width: 3px;color:red; opacity:inherit;"></div>
                                    </div>

                                    <div class="col-6">
                                        <span
                                            class="text-white h3 fw-bolder">{{ $motherpalm['kawal']['hinggakini'] }}</span>
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
                                <h3 class="text-white">PENUAIAN</h3>

                                <div class="d-flex align-items-center mt-2">
                                    <div class="col-6">
                                        <span class="text-white h3 fw-bolder">{{ $motherpalm['tuai']['hariini'] }}</span>
                                        <br>
                                        <span class="text-white h7">HARI INI</span>
                                    </div>
                                    <div class="d-flex" style="height: 5rem;">
                                        <div class="vr" style="width: 3px;color:red; opacity:inherit;"></div>
                                    </div>

                                    <div class="col-6">
                                        <span class="text-white h3 fw-bolder">{{ $motherpalm['tuai']['hinggakini'] }}</span>
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
                                <h3 class="text-white">BALUT</h3>

                                <div class="d-flex align-items-center mt-2">
                                    <div class="col-6">
                                        <span class="text-white h3 fw-bolder">{{ $fatherpalm['balut']['hariini'] }}</span>
                                        <br>
                                        <span class="text-white h7">HARI INI</span>
                                    </div>
                                    <div class="d-flex" style="height: 5rem;">
                                        <div class="vr" style="width: 3px;color:red; opacity:inherit;"></div>
                                    </div>

                                    <div class="col-6">
                                        <span
                                            class="text-white h3 fw-bolder">{{ $fatherpalm['balut']['hinggakini'] }}</span>
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
                                <h3 class="text-white">PENUAIAN</h3>

                                <div class="d-flex align-items-center mt-2">
                                    <div class="col-6">
                                        <span class="text-white h3 fw-bolder">{{ $fatherpalm['tuai']['hariini'] }}</span>
                                        <br>
                                        <span class="text-white h7">HARI INI</span>
                                    </div>
                                    <div class="d-flex" style="height: 5rem;">
                                        <div class="vr" style="width: 3px;color:red; opacity:inherit;"></div>
                                    </div>

                                    <div class="col-6">
                                        <span
                                            class="text-white h3 fw-bolder">{{ $fatherpalm['tuai']['hinggakini'] }}</span>
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
    </script>
@endsection
