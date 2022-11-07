@extends('layouts.base')
@section('content')
    <x-header main="Pengurusan Pokok Induk" sub="Pokok" sub2="" />


    <h4 class="text-center mt-4">JUMLAH POKOK</h4>
    <h1 class="text-center text-danger fw-bold">{{ count($pokoks) }}</h1>


    <div class="row justify-content-center mt-4">
        <div class="col-10">
            {{-- <div class="row justify-content-center mb-5">
                <div class="col-xl-5 border-end">
                    <h4 class="text-center">JUMLAH AKTIF</h4>
                    <h1 class="text-center text-success fw-bold">{{ $aktif }}</h1>
                </div>
                <div class="col-xl-6">
                    <h4 class="text-center">TANDAN TIDAK AKTIF</h4>
                    <h1 class="text-center text-danger fw-bold">{{ $tidak_aktif }}</h1>
                </div>
            </div> --}}

            <div class="text-end mb-3 mt-5">
                <a href="{{ route('pi.p.create') }}" class="btn btn-danger">Daftar
                    <span class="text-white" data-feather="plus-circle"></span>
                </a>
            </div>
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive scrollbar table-striped">
                            <table class="table fs--1 mb-0 text-center datatable">
                                <thead class=" text-900">
                                    <tr style="border-bottom-color: #F89521">
                                        <th>Bil</th>
                                        <th>No Pokok</th>
                                        <th>Blok</th>
                                        <th>Baka</th>
                                        <th>Progeny</th>
                                        <th>Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    @foreach ($pokoks as $pokok)
                                        <tr style="border-bottom:#fff">
                                            <td>
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>
                                                {{ $pokok->no_pokok }}
                                            </td>
                                            <td>
                                                {{ $pokok->blok }}
                                            </td>
                                            <td>
                                                {{ $pokok->baka }}
                                            </td>
                                            <td>
                                                {{ $pokok->progeny }}
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
                                                    class="ms-1 btn btn-sm btn-danger">
                                                    <span data-feather="edit" style="width:15px;"></span>
                                                </a>

                                                <button type="button" class="btn btn-danger btn-sm ms-1"
                                                    data-bs-toggle="modal" data-bs-target="#modal{{ $pokok->id }}">
                                                    <span data-feather="eye" style="width:15px;"></span>
                                                </button>
                                                <div class="modal fade" id="modal{{ $pokok->id }}" tabindex="-1"
                                                    role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document"
                                                        style="max-width: 500px">
                                                        <div class="modal-content position-relative">
                                                            <div class="position-absolute top-0 end-0 mt-2 me-2 z-index-1">
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
                                                                        {!! QrCode::size(100)->generate(URL::to('/pengurusan-pokok-induk/pokok/edit/' . $pokok->id)) !!}
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
