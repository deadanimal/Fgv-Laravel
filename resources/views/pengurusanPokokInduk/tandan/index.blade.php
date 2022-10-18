@extends('layouts.base')
@section('content')
    <x-header main="Pengurusan Pokok Induk" sub="Tandan" sub2="" />


    <div class="row justify-content-center mt-5">


        <div class="row mt-5">
            <div class="col-2">
                <p class="fw-bold">No. Kakitangan</p>
            </div>
            <div class="col-8 mt-1">
                <input type="text" name="search" class="form-control">
            </div>
            <div class="col-2 px-0 mt-1">
                <button class="btn btn-sm btn-danger">Cari
                    <span data-feather="search"></span>
                </button>
                <button class="btn btn-sm btn-link">
                    <span class="refreshbtn" style="color:grey" data-feather="refresh-ccw"></span>
                </button>
            </div>
        </div>

    </div>



    <div class="row justify-content-center mt-5">

        <div class="col-10">

            <div class="d-flex flex-row-reverse mb-3">
                <a href="{{ route('pi.t.create') }}" class="ms-3 btn btn-danger">Daftar
                    <span class="text-white" data-feather="plus-circle"></span>
                </a>
                <a href="{{ route('pi.t.create') }}" class="ms-3 btn btn-danger">Kod QR Pelupusan
                    <span class="text-white fas fas fa-qrcode"></span>
                </a>
                <a href="{{ route('pi.t.muat') }}" class="ms-3 btn btn-danger">Muat Naik Dokumen
                    <span class="text-white" data-feather="upload-cloud"></span>
                </a>

            </div>

            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <div id="tableExample2"
                            data-list='{"valueNames":["bil","kakitangan","no_pokok","kod_qr"],"page":5,"pagination":true}'>
                            <div class="table-responsive scrollbar table-striped">
                                <table class="table fs--1 mb-0 text-center">
                                    <thead class=" text-900">
                                        <tr style="border-bottom-color: #F89521">
                                            <th class="sort" data-sort="bil">Bil</th>
                                            <th class="sort" data-sort="kakitangan">No. Daftar</th>
                                            <th class="sort" data-sort="no_pokok">No. Pokok</th>
                                            <th class="sort" data-sort="kod_qr">Kod QR</th>
                                            <th>Tindakan</th>
                                        </tr>
                                    </thead>
                                    <tbody class="list">
                                        @for ($i = 0; $i < 50; $i++)
                                            <tr style="border-bottom:#fff">
                                                <td class="bil">
                                                    {{ $i }}
                                                </td>
                                                <td class="kakitangan">Anna
                                                </td>
                                                <td class="no_pokok">
                                                    anna@example.com
                                                </td>
                                                <td class="kod_qr">
                                                    kodokdm</td>
                                                <td>
                                                    <button class=" btn btn-sm btn-danger">
                                                        <span data-feather="trash-2" style="width:15px;"></span>
                                                    </button>
                                                    <a href="{{ route('pi.p.edit', $tandan) }}"
                                                        class="ms-2 btn btn-sm btn-danger">
                                                        <span data-feather="edit" style="width:15px;"></span>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endfor
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-center mt-3">
                                <button class="btn btn-sm btn-falcon-default me-1" type="button" title="Previous"
                                    data-list-pagination="prev"><span class="fas fa-chevron-left"></span></button>
                                <ul class="pagination mb-0"></ul>
                                <button class="btn btn-sm btn-falcon-default ms-1" type="button" title="Next"
                                    data-list-pagination="next"><span class="fas fa-chevron-right"> </span></button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
