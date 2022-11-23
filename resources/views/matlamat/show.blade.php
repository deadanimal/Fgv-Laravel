@extends('layouts.base')
@section('content')
    <x-header main="Konfigurasi Data Rujukan" sub="Matlamat Bulanan / Tahunan" sub2="Lihat Matlamat" />

    <div class="row justify-content-center">
        <div class="col-xl-10">
            <h5 class="text-main mt-3 fw-bolder">MATLAMAT TAHUNAN </h5>
            <div class="card">
                <div class="card-body">
                    <div id="tableExample2" data-list='{"valueNames":["bil","proses","jumlah"],"page":5,"pagination":true}'>
                        <div class="table-responsive scrollbar table-striped">
                            <table class="table fs--1 mb-0 text-center">
                                <thead class=" text-900">
                                    <tr style="border-bottom-color: #F89521">
                                        <th class="sort" data-sort="bil">Bil</th>
                                        <th class="sort" data-sort="proses">Proses</th>
                                        <th class="sort" data-sort="jumlah">Jumlah Matlamat</th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    @foreach ($matlamatTahunan as $mat)
                                        <tr style="border-bottom:#fff">
                                            <td class="bil">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td class="proses">
                                                {{ $mat->proses }}
                                            </td>
                                            <td class="jumlah">
                                                {{ $mat->matlamat }}
                                            </td>
                                        </tr>
                                    @endforeach
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


        <div class="col-xl-10 my-5">
            <h5 class="text-main mt-5 fw-bolder">MATLAMAT BULANAN </h5>
            <div class="card">
                <div class="card-body">
                    <div id="tableExample1"
                        data-list='{"valueNames":["bil","bulan","proses","jumlah"],"page":5,"pagination":true}'>
                        <div class="table-responsive scrollbar table-striped">
                            <table class="table fs--1 mb-0 text-center">
                                <thead class=" text-900">
                                    <tr style="border-bottom-color: #F89521">
                                        <th class="sort" data-sort="bil">Bil</th>
                                        <th class="sort" data-sort="bulan">Bulan</th>
                                        <th class="sort" data-sort="proses">Proses</th>
                                        <th class="sort" data-sort="jumlah">Jumlah Matlamat</th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    @foreach ($matlamatTahunan as $mat)
                                        @foreach ($mat->bulan as $b)
                                            <tr style="border-bottom:#fff">
                                                <td class="bil">
                                                    {{ $loop->iteration }}
                                                </td>
                                                <td class="bulan">
                                                    {{ $b->bulan }}
                                                </td>
                                                <td class="proses">
                                                    {{ $b->proses }}
                                                </td>
                                                <td class="jumlah">
                                                    {{ $b->matlamat }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endforeach
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
@endsection
