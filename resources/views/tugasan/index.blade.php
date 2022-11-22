@extends('layouts.base')
@section('content')
    <x-header main="Pengurusan Pengguna" sub="Laporan Petugas" sub2="" />


    <div class="row mt-3">
        <div class="col-1"></div>
        <form class="col-xl-7" action="{{ route('search.tugasan') }}" method="POST">
            @csrf
            <div class="row mb-3">
                <div class="col-3">
                    <p class="fw-bold pt-1">No. Kakitangan</p>
                </div>
                <div class="col-6">
                    <input type="text" class="form-control border-danger" name="no_kakitangan"
                        value="{{ $no_kakitangan ?? old('no_kakitangan') }}" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-3">
                    <p class="fw-bold pt-1">Tarikh Mula</p>
                </div>
                <div class="col-6">
                    <div class="input-group">
                        <input class="form-control datetimepicker border-danger border-right-0" type="text"
                            placeholder="SILA PILIH" data-options='{"disableMobile":true}' aria-describedby="date"
                            name="tarikh_mula" value="{{ $tarikh_mula ?? old('tarikh_mula') }}" required />
                        <button type="button" class="btn border-danger border-left-0 date"><span
                                class="far fa-calendar-alt text-danger"></button>
                    </div>
                </div>
                <div class="col-3 px-0 mt-1">
                    <button class="btn btn-sm btn-danger" type="submit">Cari
                        <span data-feather="search"></span>
                    </button>
                    <a class="btn btn-sm btn-link" href="{{ route('tugasan.index') }}">
                        <span class="refreshbtn" style="color:grey" data-feather="refresh-ccw"></span>
                    </a>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-3">
                    <p class="fw-bold pt-1">Tarikh Tamat</p>
                </div>
                <div class="col-6">
                    <div class="input-group">
                        <input class="form-control datetimepicker border-danger border-right-0" type="text"
                            placeholder="SILA PILIH" data-options='{"disableMobile":true}' aria-describedby="date"
                            name="tarikh_tamat" value="{{ $tarikh_tamat ?? old('tarikh_tamat') }}" required />
                        <button type="button" class="btn border-danger border-left-0 date"><span
                                class="far fa-calendar-alt text-danger"></button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="row justify-content-center mt-4">


        <div class="col-10 mt-5">

            {{-- <div class="row">
                <div class="text-end">
                    <a href="{{ route('tugasan.create') }}" class="btn btn-danger">Tambah Tugasan <span
                            class="fas fa-plus"></span></a>
                </div>
            </div> --}}

            <div class="row mt-4">
                <div class="card">
                    <div class="card-body ">
                        <div id="tableExample2"
                            data-list='{"valueNames":["bil","kakitangan","aktiviti","status","tarikh"],"page":5,"pagination":true}'>
                            <div class="table-responsive scrollbar table-striped ">
                                <table class="table fs--1 mb-0 text-center">
                                    <thead class=" text-900">
                                        <tr style="border-bottom-color: #F89521">
                                            <th class="sort" data-sort="bil">Bil</th>
                                            <th class="sort" data-sort="kakitangan">No. Kakitangan</th>
                                            <th class="sort" data-sort="aktiviti">Aktiviti</th>
                                            <th class="sort" data-sort="status">Status</th>
                                            <th class="sort" data-sort="tarikh">Tarikh</th>
                                            {{-- <th>Tindakan</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody class="list" id="tablebody">
                                        @foreach ($tugasans as $tugasan)
                                            <tr style="border-bottom:#fff"
                                                onclick="rowClick('{{ URL::to('/pengurusan_pengguna/tugasan/' . $tugasan->id) . '/' . $tugasan->jenis }}')">
                                                <td class="bil">
                                                    {{ $loop->iteration }}
                                                </td>
                                                <td class="kakitangan">
                                                    {{ $tugasan->petugas->no_kakitangan ?? 'Petugas Tidak Wujud' }}
                                                </td>
                                                <td class="aktiviti">
                                                    {{ $tugasan->jenis }}
                                                </td>

                                                <td class="status">
                                                    @switch($tugasan->status)
                                                        @case('dicipta')
                                                            <span class="badge rounded-pill badge-soft-info"> Dalam Proses</span>
                                                        @break

                                                        @case('siap')
                                                            <span class="badge rounded-pill badge-soft-warning"> Selesai
                                                                Dilaksanakan
                                                            </span>
                                                        @break

                                                        @case('sah')
                                                            <span class="badge rounded-pill badge-soft-success">Disahkan</span>
                                                        @break

                                                        @case('rosak')
                                                            <span class="badge rounded-pill badge-soft-danger">Rosak</span>
                                                        @break

                                                        @default
                                                            <span class="badge rounded-pill badge-soft-info"> Dalam Proses</span>
                                                    @endswitch
                                                </td>
                                                <td class="tarikh">
                                                    {{ $tugasan->created_at->format('d/m/Y') }}
                                                </td>
                                                {{-- <td>
                                                    @switch($tugasan->status)
                                                        @case('dicipta')
                                                            <button class="btn btn-sm btn-primary" type="button"
                                                                data-bs-toggle="modal" data-bs-target="#modal-siap">SIAP</button>
                                                            <div class="modal fade" id="modal-siap" tabindex="-1" role="dialog"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered" role="document"
                                                                    style="max-width: 500px">
                                                                    <div class="modal-content position-relative">
                                                                        <div
                                                                            class="position-absolute top-0 end-0 mt-2 me-2 z-index-1">
                                                                            <button
                                                                                class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base"
                                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <form action="{{ route('tugasan.update', $tugasan->id) }}"
                                                                            method="post" enctype="multipart/form-data">
                                                                            @csrf
                                                                            @method('put')
                                                                            <div class="modal-body p-0">
                                                                                <div class="rounded-top-lg py-3 ps-4 pe-6 bg-light">
                                                                                    <h4 class="mb-1"> Siap
                                                                                        Tugasan</h4>
                                                                                </div>
                                                                                <div class="p-4 pb-0">
                                                                                    <div class="mb-3">
                                                                                        <label
                                                                                            class="col-form-label">Catatan</label>
                                                                                        <textarea class="form-control" name="catatan_petugas"></textarea>
                                                                                    </div>
                                                                                    <input type="hidden" name="status"
                                                                                        value="siap">
                                                                                </div>
                                                                                <div class="p-4 pb-0">
                                                                                    <div class="mb-3">
                                                                                        <label
                                                                                            class="col-form-label">Gambar</label>
                                                                                        <input type="file" class="form-control"
                                                                                            name="url_gambar"accept="image/png, image/gif, image/jpeg">
                                                                                    </div>
                                                                                    <input type="hidden" name="status"
                                                                                        value="siap">
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button class="btn btn-secondary" type="button"
                                                                                    data-bs-dismiss="modal">Tutup</button>
                                                                                <button class="btn btn-success"
                                                                                    type="submit">Simpan
                                                                                </button>
                                                                            </div>
                                                                        </form>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @break

                                                        @case('siap')
                                                            @if (auth()->user()->peranan != 'pekerja')
                                                                <button class="btn btn-sm btn-success" type="button"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#modal-sah">SAH</button>
                                                                <div class="modal fade" id="modal-sah" tabindex="-1"
                                                                    role="dialog" aria-hidden="true">
                                                                    <div class="modal-dialog modal-dialog-centered"
                                                                        role="document" style="max-width: 500px">
                                                                        <div class="modal-content position-relative">
                                                                            <div
                                                                                class="position-absolute top-0 end-0 mt-2 me-2 z-index-1">
                                                                                <button
                                                                                    class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base"
                                                                                    data-bs-dismiss="modal"
                                                                                    aria-label="Close"></button>
                                                                            </div>
                                                                            <form
                                                                                action="{{ route('tugasan.update', $tugasan->id) }}"
                                                                                method="post">
                                                                                @csrf
                                                                                @method('put')
                                                                                <div class="modal-body p-0">
                                                                                    <div
                                                                                        class="rounded-top-lg py-3 ps-4 pe-6 bg-light">
                                                                                        <h4 class="mb-1"> Sah Tugasan</h4>
                                                                                    </div>

                                                                                    <div class="p-4 pb-0">
                                                                                        <div class="mb-3">
                                                                                            <label
                                                                                                class="col-form-label">Catatan</label>
                                                                                            <textarea class="form-control" name="catatan_pengesah"></textarea>
                                                                                        </div>
                                                                                        <input type="hidden" name="status"
                                                                                            value="sah">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button class="btn btn-secondary"
                                                                                        type="button"
                                                                                        data-bs-dismiss="modal">Tutup</button>
                                                                                    <button class="btn btn-success"
                                                                                        type="submit">Simpan
                                                                                    </button>
                                                                                </div>
                                                                            </form>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @break

                                                        @default
                                                            <a href="{{ route('tugasan.show', $tugasan->id) }}"
                                                                class="btn btn-sm btn-danger">
                                                                <span class="fas fa-book-open"></span>
                                                            </a>
                                                    @endswitch




                                                    @if ($tugasan->status == 'dicipta')
                                                        <form action="{{ route('tugasan.update', $tugasan->id) }}"
                                                            method="post" class="d-inline-flex">
                                                            @csrf
                                                            @method('put')
                                                            <input type="hidden" name="status" value="rosak">
                                                            <button type="submit"
                                                                class="btn btn-warning btn-sm">ROSAK</button>
                                                        </form>
                                                    @endif

                                                    @if ($tugasan->status == 'siap')
                                                        <a href="{{ route('tugasan.show', $tugasan->id) }}"
                                                            class="btn btn-sm btn-danger">
                                                            <span class="fas fa-book-open"></span>
                                                        </a>
                                                    @endif
                                                    @if (auth()->user()->peranan != 'pekerja')
                                                        <form action="{{ route('tugasan.destroy', $tugasan->id) }}"
                                                            method="post" class="d-inline-flex">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit"
                                                                class="btn-del btn btn-danger btn-sm"><span
                                                                    class="fas fa-trash-alt"></span></button>
                                                        </form>
                                                    @endif


                                                </td> --}}
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

        $(".date").click(function() {
            $(this).siblings("input").trigger("click");
        });
    </script>
@endsection
