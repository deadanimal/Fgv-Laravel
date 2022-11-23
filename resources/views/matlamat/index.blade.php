@extends('layouts.base')
@section('content')
    <x-header main="Konfigurasi Data Rujukan" sub="Matlamat Bulanan / Tahunan" sub2="" />

    <div class="row justify-content-center mt-4">
        <div class="col-xl-10">
            <div class="col-xl-8 mb-3">
                <div class="row g-3 align-items-center">
                    <div class="col-xl-2">
                        <label class="col-form-label">Tahun</label>
                    </div>
                    <div class="col-xl-4">
                        <input type="text"class="form-control border-danger" name="blok" placeholder="SILA TAIP DI SINI"
                            value="{{ $blok ?? '' }}">
                    </div>
                    <div class="col-xl-4">
                        <button class="btn btn-sm btn-danger">Cari <span class="fas fa-search"></span></button>
                        <a href="{{ route('matlamat.index') }}" class="btn btn-sm btn-link">
                            <span class="refreshbtn" style="color:grey" data-feather="refresh-ccw"></span>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center mt-4">
        <div class="col-xl-10">
            <div class="text-end mb-3">
                <a href="{{ route('matlamat.create') }}" class="btn btn-danger">Daftar
                    <span class="text-white" data-feather="plus-circle"></span>
                </a>
            </div>

            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <div id="tableExample2" data-list='{"valueNames":["bil","tahun"],"page":5,"pagination":true}'>
                            <div class="table-responsive scrollbar table-striped">
                                <table class="table fs--1 mb-0 text-center">
                                    <thead class=" text-900">
                                        <tr style="border-bottom-color: #F89521">
                                            <th class="sort" data-sort="bil">Bil</th>
                                            <th class="sort" data-sort="tahun">Tahun</th>
                                        </tr>
                                    </thead>
                                    <tbody class="list">
                                        @foreach ($matlamat as $m => $data)
                                            <tr style="border-bottom:#fff"
                                                onclick="rowClick('{{ URL::to('/konfigurasi/matlamat/' . $m) }}')">
                                                <td class="bil">
                                                    {{ $loop->iteration }}
                                                </td>
                                                <td class="tahun">
                                                    {{ $m }}
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

    <script>
        function rowClick(a) {
            location.href = a;
        }
    </script>
@endsection
