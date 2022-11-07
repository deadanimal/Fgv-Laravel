@extends('layouts.base')
@section('content')
    <x-header main="Pengurusan Pokok Induk" sub="Tandan" sub2="" />


    {{-- <div class="row justify-content-center mt-5">
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
    </div> --}}



    <div class="row justify-content-center mt-5">
        <div class="col-10">
            <div class="d-flex flex-row-reverse mb-3">
                <a href="{{ route('pi.t.create') }}" class="ms-3 btn btn-danger">Daftar
                    <span class="text-white" data-feather="plus-circle"></span>
                </a>

                <button class="btn btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#error-modal">Cipta
                    QR</button>
                <div class="modal fade" id="error-modal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px">
                        <div class="modal-content position-relative">
                            <div class="position-absolute top-0 end-0 mt-2 me-2 z-index-1">
                                <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base"
                                    data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ route('generateQR') }}" method="POST">
                                @csrf
                                <div class="modal-body p-0">
                                    <div class="rounded-top-lg py-3 ps-4 pe-6 bg-light">
                                        <h4 class="mb-1" id="modalExampleDemoLabel">Cipta QR</h4>
                                    </div>
                                    <div class="p-4 pb-0">
                                        <div class="mb-3">
                                            <label class="col-form-label" for="bilqr">Isi bilangan QR yang akan
                                                dicipta:</label>
                                            <input class="form-control" id="bilqr" type="number" name="bilqr"
                                                required />
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Padam</button>
                                    <button class="btn btn-danger" type="submit">Teruskan </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive scrollbar table-striped">
                            <table class="table fs--1 mb-0 text-center datatable">
                                <thead class=" text-900">
                                    <tr style="border-bottom-color: #F89521">
                                        <th>Bil</th>
                                        <th>No. Daftar</th>
                                        <th>No. Pokok</th>
                                        <th>Kod QR</th>
                                        <th>Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tandans as $tandan)
                                        <tr style="border-bottom:#fff">
                                            <td>
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>
                                                {{ $tandan->no_daftar }}
                                            </td>
                                            <td>
                                                {{ $tandan->pokok->no_pokok ?? 'Belum didaftar pokok' }}
                                            </td>
                                            <td>
                                                @if ($tandan->pokok)
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        data-bs-toggle="modal" data-bs-target="#modal{{ $tandan->id }}">
                                                        <span class="fas fa-eye" style="width:15px;"></span>
                                                    </button>
                                                    <div class="modal fade" id="modal{{ $tandan->id }}" tabindex="-1"
                                                        role="dialog" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document"
                                                            style="max-width: 500px">
                                                            <div class="modal-content position-relative">
                                                                <div
                                                                    class="position-absolute top-0 end-0 mt-2 me-2 z-index-1">
                                                                    <button
                                                                        class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base"
                                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body p-0">
                                                                    <div class="rounded-top-lg py-3 ps-4 pe-6 bg-light">
                                                                        <h4 class="mb-1">QR CODE</h4>
                                                                    </div>
                                                                    <div class="p-4">
                                                                        <div class="visible-print text-center">
                                                                            {!! QrCode::size(100)->generate(URL::to('/pengurusan-pokok-induk/tandan/edit/' . $tandan->id)) !!}
                                                                            {{-- <p>Scan me to return to the original page.</p> --}}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-secondary" type="button"
                                                                        data-bs-dismiss="modal">Padam</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <a href="{{ route('downloadqr', $tandan->id) }}"
                                                        class="ms-2 btn btn-danger btn-sm">
                                                        <span class="fas fa-download" style="width:15px;"></span>
                                                    </a>
                                                @else
                                                    Perlu daftar Pokok
                                                @endif



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
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
