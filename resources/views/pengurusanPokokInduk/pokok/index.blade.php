@extends('layouts.base')
@section('content')
    <x-header main="Pengurusan Pokok Induk" sub="Pokok" sub2="" />

    {{-- 
    <h4 class="text-center mt-4">JUMLAH POKOK</h4>
    <h1 class="text-center text-danger fw-bold">123,456,213</h1> --}}


    <div class="row justify-content-center mt-4">
        <div class="col-10">
            <div class="row justify-content-center mb-5">
                <div class="col-xl-5 border-end">
                    <h4 class="text-center">JUMLAH AKTIF</h4>
                    <h1 class="text-center text-success fw-bold">123,456,213</h1>
                </div>
                <div class="col-xl-6">
                    <h4 class="text-center">TANDAN TIDAK AKTIF</h4>
                    <h1 class="text-center text-danger fw-bold">123,456,213</h1>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-xl-6">
                    <div class="row g-3 align-items-center">
                        <div class="col-xl-2">
                            <label class="col-form-label">Blok</label>
                        </div>
                        <div class="col-xl-8">
                            <input type="text"class="form-control border-danger" placeholder="SILA TAIP DISINI">
                        </div>
                    </div>
                </div>

                <div class="col-xl-6">
                    <div class="row g-3 align-items-center">
                        <div class="col-xl-4 text-center">
                            <label class="col-form-label">Progeny</label>
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
                        <div class="col-xl-2">
                            <label class="col-form-label">Baka</label>
                        </div>
                        <div class="col-xl-8">
                            <input type="text"class="form-control border-danger" placeholder="SILA TAIP DISINI">
                        </div>
                    </div>
                </div>

                <div class="col-xl-6">
                    <div class="row g-3 align-items-center">
                        <div class="col-xl-4 text-center">
                            <label class="col-form-label">No. Pokok</label>
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


            <div class="text-end mb-3 mt-5">
                <a href="{{ route('pi.p.create') }}" class="btn btn-danger">Daftar
                    <span class="text-white" data-feather="plus-circle"></span>
                </a>
            </div>
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <div id="tableExample2"
                            data-list='{"valueNames":["bil","blok","baka","progeny","noPokok"],"page":5,"pagination":true}'>
                            <div class="table-responsive scrollbar table-striped">
                                <table class="table fs--1 mb-0 text-center">
                                    <thead class=" text-900">
                                        <tr style="border-bottom-color: #F89521">
                                            <th class="sort" data-sort="bil">Bil</th>
                                            <th class="sort" data-sort="blok">No. Kakitangan</th>
                                            <th class="sort" data-sort="baka">Nama Pekerja</th>
                                            <th class="sort" data-sort="progeny">Nama Pekerja</th>
                                            <th class="sort" data-sort="noPokok">Nama Pekerja</th>
                                            <th>Tindakan</th>
                                        </tr>
                                    </thead>
                                    <tbody class="list">
                                        @foreach ($pokoks as $pokok)
                                            <tr style="border-bottom:#fff">
                                                <td class="bil">
                                                    {{ $loop->iteration }}
                                                </td>
                                                <td class="blok">
                                                    {{ $pokok->blok }}
                                                </td>
                                                <td class="baka">
                                                    {{ $pokok->baka }}
                                                </td>
                                                <td class="progeny">
                                                    {{ $pokok->progeny }}
                                                </td>
                                                <td class="noPokok">
                                                    {{ $pokok->no_pokok }}
                                                </td>
                                                <td>
                                                    <form action="{{ route('pi.p.delete', $pokok->id) }}" method="post"
                                                        class="d-inline-flex">
                                                        @csrf
                                                        @method('delete')
                                                        <button class=" btn btn-sm btn-danger">
                                                            <span data-feather="trash-2" style="width:15px;"></span>
                                                        </button>
                                                    </form>

                                                    <a href="{{ route('pi.p.edit', $pokok->id) }}"
                                                        class="ms-2 btn btn-sm btn-danger">
                                                        <span data-feather="edit" style="width:15px;"></span>
                                                    </a>
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

        </div>

    </div>
@endsection
