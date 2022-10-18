@extends('layouts.base')
@section('content')
    <x-header main="Pengurusan Pengguna" sub="Laporan Petugas" sub2="Maklumat Tugas" />


    <div class="row justify-content-center mt-4">
        <div class="col-10">

            <div class="row">

                <div class="col-xl-5">
                    <img src="/test-image/test1.png" class="img-fluid">
                </div>

                <div class="col-xl-1"></div>

                <div class="col-xl-6">
                    <div class="row mb-3 g-3 align-items-center">
                        <div class="col-4">
                            <label class="col-form-label">Aktiviti Kerja</label>
                        </div>
                        <div class="col-8">
                            <input type="text" class="form-control" value="Balut" readonly>
                        </div>
                    </div>

                    <div class="row mb-3 g-3 align-items-center">
                        <div class="col-4">
                            <label class="col-form-label">No. Daftar</label>
                        </div>
                        <div class="col-8">
                            <input type="text" class="form-control" value="21C00065B2R" readonly>
                        </div>
                    </div>

                    <div class="row mb-3 g-3 align-items-center">
                        <div class="col-4">
                            <label class="col-form-label">No. Pokok</label>
                        </div>
                        <div class="col-8">
                            <input type="text" class="form-control" value="FJ2-81" readonly>
                        </div>
                    </div>

                    <div class="row mb-3 g-3 align-items-center">
                        <div class="col-4">
                            <label class="col-form-label">Tarikh Balut</label>
                        </div>
                        <div class="col-8">
                            <input type="text" class="form-control" value="21/10/2021" readonly>
                        </div>
                    </div>

                    <div class="row mb-3 g-3 align-items-center">
                        <div class="col-4">
                            <label class="col-form-label">Nama Pembalut</label>
                        </div>
                        <div class="col-8">
                            <input type="text" class="form-control" value="Muhammad Ali" readonly>
                        </div>
                    </div>

                    <div class="row mb-3 g-3 align-items-center">
                        <div class="col-4">
                            <label class="col-form-label">Nama Penyelia</label>
                        </div>
                        <div class="col-8">
                            <input type="text" class="form-control" value="Abu bin Bakar" readonly>
                        </div>
                    </div>

                    <div class="row mb-3 g-3 align-items-center">
                        <div class="col-4">
                            <label class="col-form-label">Tarikh Pengesahan</label>
                        </div>
                        <div class="col-8">
                            <input type="text" class="form-control" value="01/11/2021" readonly>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
