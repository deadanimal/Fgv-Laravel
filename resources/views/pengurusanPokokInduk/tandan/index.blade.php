@extends('layouts.base')
@section('content')
    <x-header main="Pengurusan Pokok Induk" sub="Tandan" sub2="" />


    <div class="row justify-content-center mt-5">
        <div class="col-8">
            <div class="row align-items-center">
                <div class="col-2 text-end">
                    <p class="fw-bold">No. Daftar</p>
                </div>
                <div class="col-7 ">
                    <input type="text" name="search" id="search" class="form-control">
                </div>
                <div class="col-3 px-0">
                    <button class="btn btn-sm btn-danger">Cari
                        <span data-feather="search"></span>
                    </button>
                    <button class="btn btn-sm btn-link btnRefresh">
                        <span class="refreshbtn" style="color:grey" data-feather="refresh-ccw"></span>
                    </button>
                </div>
                <div class="col-2 mt-4 text-end">
                    <p class="fw-bold">Bulan</p>
                </div>
                <div class="col-7 mt-3">
                    <select id="bulan" class="form-select">
                        <option selected disabled hidden>Sila Pilih</option>
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="$i">{{ $i }}</option>
                        @endfor
                    </select>
                </div>
            </div>
        </div>
    </div>



    <div class="row justify-content-center mt-7">
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
                            data-list='{"valueNames":["bil","no_daftar","no_pokok"],"page":5,"pagination":true}'>
                            <div class="table-responsive scrollbar table-striped">
                                <table class="table fs--1 mb-0 text-center">
                                    <thead class=" text-900">
                                        <tr style="border-bottom-color: #F89521">
                                            <th class="sort" data-sort="bil">Bil</th>
                                            <th class="sort" data-sort="no_daftar">No. Daftar</th>
                                            <th class="sort" data-sort="no_pokok">No. Pokok</th>
                                            <th>Kod QR</th>
                                            <th>Tindakan</th>
                                        </tr>
                                    </thead>
                                    <tbody class="list">
                                        @foreach ($tandans as $tandan)
                                            <tr style="border-bottom:#fff">
                                                <td class="bil">
                                                    {{ $loop->iteration }}
                                                </td>
                                                <td class="no_daftar">
                                                    {{ $tandan->no_daftar }}
                                                </td>
                                                <td class="no_pokok">
                                                    {{ $tandan->pokok->no_pokok ?? 'Belum didaftar pokok' }}
                                                </td>
                                                <td>
                                                    <a href="" class="btn btn-danger btn-sm">
                                                        <span class="fas fa-eye" style="width:15px;"></span>
                                                    </a>
                                                    <a href="" class="ms-2 btn btn-danger btn-sm">
                                                        <span class="fas fa-download" style="width:15px;"></span>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="{{ route('pi.t.edit', $tandan->id) }}"
                                                        class="btn btn-sm btn-danger">
                                                        <span class="fas fa-edit" style="width:15px;"></span>
                                                    </a>
                                                    <form action="{{ route('pi.t.delete', $tandan->id) }}" method="post"
                                                        class="d-inline ms-2">
                                                        @method('delete')
                                                        @csrf
                                                        <button class=" btn btn-sm btn-danger">
                                                            <span class="fas fa-trash" style="width:15px;"></span>
                                                        </button>
                                                    </form>
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
