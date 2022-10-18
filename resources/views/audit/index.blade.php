@extends('layouts.base')
@section('content')
    <x-header main="Jejak Audit" sub="Audit" sub2="" />


    <div class="row justify-content-center mt-4">
        <div class="col-10">

            <div class="row mb-3">
                <div class="col-xl-6">
                    <div class="row g-3 align-items-center">
                        <div class="col-xl-4">
                            <label class="col-form-label">No. Kakitangan</label>
                        </div>
                        <div class="col-xl-8">
                            <input type="text"class="form-control border-danger" placeholder="SILA TAIP DISINI">
                        </div>
                    </div>
                </div>

                <div class="col-xl-6">
                    <div class="row g-3 align-items-center">
                        <div class="col-xl-4 text-end">
                            <label class="col-form-label">Tarikh</label>
                        </div>
                        <div class="col-xl-8">
                            <input class="form-select datetimepicker border-danger" type="date" placeholder="SILA PILIH"
                                data-options='{"disableMobile":true}' />
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-6">
                    <div class="row g-3 align-items-center">
                        <div class="col-xl-4">
                            <label class="col-form-label">Aktiviti</label>
                        </div>
                        <div class="col-xl-8">
                            <input type="text"class="form-control border-danger" placeholder="SILA TAIP DISINI">
                        </div>
                    </div>
                </div>

            </div>

            <div class="row mt-5">
                <div class="text-center">
                    <button class="btn btn-sm btn-danger">Cari
                        <span data-feather="search"></span>
                    </button>
                    <button class="btn btn-sm btn-link">
                        <span class="refreshbtn" style="color:grey" data-feather="refresh-ccw"></span>
                    </button>
                </div>
            </div>

            <div class="row mt-5">
                <div class="card mt-5">
                    <div class="card-body ">
                        <div id="tableExample2"
                            data-list='{"valueNames":["bil","kakitangan","tindakan","keterangan","tarikhTindakan"],"page":5,"pagination":true}'>
                            <div class="table-responsive scrollbar table-striped ">
                                <table class="table fs--1 mb-0 text-center">
                                    <thead class=" text-900">
                                        <tr style="border-bottom-color: #F89521">
                                            <th class="sort" data-sort="bil">Bil</th>
                                            <th class="sort" data-sort="kakitangan">No. Kakitangan</th>
                                            <th class="sort" data-sort="tindakan">Tindakan</th>
                                            <th class="sort" data-sort="keterangan">Keterangan</th>
                                            <th class="sort" data-sort="tarikhTindakan">Tarikh Tindakan</th>
                                        </tr>
                                    </thead>
                                    <tbody class="list">
                                        @for ($i = 0; $i < 50; $i++)
                                            <tr style="border-bottom:#fff">
                                                <td class="bil">
                                                    {{ $i }}
                                                </td>
                                                <td class="kakitangan">
                                                    312213213
                                                </td>
                                                <td class="tindakan">
                                                    abda
                                                </td>
                                                <td class="keterangan">
                                                    sadas
                                                </td>
                                                <td class="tarikhTindakan">
                                                    22/10/2021
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
