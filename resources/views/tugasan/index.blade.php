@extends('layouts.base')
@section('content')
    <x-header main="Pengurusan Pengguna" sub="Laporan Petugas" sub2="" />


    <div class="row justify-content-center mt-4">
        <div class="col-10">

            {{-- <div class="row mb-3">
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
            </div>

            <div class="row">
                <div class="col-xl-6">
                    <div class="row g-3 align-items-center">
                        <div class="col-xl-4">
                            <label class="col-form-label">Tarikh Mula</label>
                        </div>
                        <div class="col-xl-8">
                            <x-custom-date-input name="tarikh_mula" />
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="row g-3 align-items-center">
                        <div class="col-xl-4 text-end">
                            <label class="col-form-label">Tarikh Akhir</label>
                        </div>
                        <div class="col-xl-8">
                            <x-custom-date-input name="tarikh_mula" />
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
            </div> --}}
            <div class="row">
                <div class="text-end">
                    <a href="{{ route('tugasan.create') }}" class="btn btn-danger">Tambah Tugasan <span
                            class="fas fa-plus"></span></a>
                </div>
            </div>

            <div class="row mt-4">
                <div class="card">
                    <div class="card-body ">
                        <div class="table-responsive scrollbar table-striped ">
                            <table class="table fs--1 mb-0 text-center datatable">
                                <thead class=" text-900">
                                    <tr style="border-bottom-color: #F89521">
                                        <th class="sort" data-sort="bil">Bil</th>
                                        <th class="sort" data-sort="kakitangan">No. Kakitangan</th>
                                        <th class="sort" data-sort="aktiviti">Aktiviti</th>
                                        <th class="sort" data-sort="status">Status</th>
                                        <th class="sort" data-sort="tarikh">Tarikh</th>
                                        <th>Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    @foreach ($tugasans as $tugasan)
                                        <tr style="border-bottom:#fff">
                                            <td class="bil">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td class="kakitangan">
                                                {{ $tugasan->petugas->no_kakitangan }}
                                            </td>
                                            <td class="aktiviti">
                                                {{ $tugasan->aktiviti }}
                                            </td>
                                            <td class="status">
                                                {{ $tugasan->status }}
                                            </td>
                                            <td class="tarikh">
                                                {{ $tugasan->tarikh }}
                                            </td>
                                            <td class="">
                                                <a href="{{ route('pp.maklumat') }}" class="btn btn-sm btn-danger">
                                                    <span data-feather="book-open" style="width:15px;"></span>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection
