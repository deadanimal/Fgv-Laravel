@extends('layouts.base')
@section('content')
    <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>

    <x-header main="Pengurusan Pokok Induk" sub="Pokok" sub2="" />


    <h4 class="text-center mt-4">JUMLAH POKOK</h4>
    <h1 class="text-center text-danger fw-bold">{{ App\Models\Pokok::all()->count() }}</h1>


    <div class="row justify-content-center mt-4">
        <div class="col-10">

            <div class="row justify-content-center mb-5">
                <div class="col-xl-5 border-end">
                    <h4 class="text-center">POKOK AKTIF</h4>
                    <h1 class="text-center text-success fw-bold">{{ $aktif }}</h1>
                </div>
                <div class="col-xl-6">
                    <h4 class="text-center">POKOK TIDAK AKTIF</h4>
                    <h1 class="text-center text-danger fw-bold">{{ $tidak_aktif }}</h1>
                </div>
            </div>

            <form action="{{ route('search.pokok') }}" method="POST" class="row mb-3">
                @csrf
                <div class="col-xl-6 mb-3">
                    <div class="row g-3 align-items-center">
                        <div class="col-xl-2">
                            <label class="col-form-label">Blok</label>
                        </div>
                        <div class="col-xl-8">
                            <input type="text"class="form-control border-danger" name="blok"
                                placeholder="SILA TAIP DI SINI" value="{{ $blok ?? '' }}">
                        </div>
                    </div>
                </div>

                <div class="col-xl-6 mb-3">
                    <div class="row g-3 align-items-center">
                        <div class="col-xl-4 text-end">
                            <label class="col-form-label">Progeny</label>
                        </div>
                        <div class="col-xl-8">
                            <input type="text"class="form-control border-danger" name="progeny"
                                placeholder="SILA TAIP DI SINI" value="{{ $progeny ?? '' }}">
                        </div>
                    </div>
                </div>

                <div class="col-xl-6">
                    <div class="row g-3 align-items-center">
                        <div class="col-xl-2">
                            <label class="col-form-label">Baka</label>
                        </div>
                        <div class="col-xl-8">
                            <input type="text"class="form-control border-danger" name="baka"
                                placeholder="SILA TAIP DI SINI" value="{{ $baka ?? '' }}">
                        </div>
                    </div>
                </div>

                <div class="col-xl-6">
                    <div class="row g-3 align-items-center">
                        <div class="col-xl-4 text-end">
                            <label class="col-form-label">No. Pokok</label>
                        </div>
                        <div class="col-xl-8">
                            <input type="text"class="form-control border-danger" name="no_pokok"
                                placeholder="SILA TAIP DI SINI" value="{{ $no_pokok ?? '' }}">
                        </div>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-sm btn-danger" id="btnSearch">Cari
                        <span data-feather="search"></span>
                    </button>
                    <a href="{{ route('pi.p.index') }}" class="btn btn-sm btn-link">
                        <span class="refreshbtn" style="color:grey" data-feather="refresh-ccw"></span>
                    </a>
                </div>
            </form>



            <div class="text-end mb-3 mt-4">
                <button class="btn btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#modalQRBulk">
                    Pilih QR
                    <span class="text-white" data-feather="download"></span>
                </button>
                <button class="btn btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#modalQRAll">
                    Semua QR
                    <span class="text-white" data-feather="download"></span>
                </button>
                {{-- <a href="{{ route('pokok.bulkqr') }}" class="btn btn-danger">
                    Semua QR
                    <span class="text-white" data-feather="download"></span>
                </a> --}}
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
                                        <th>Blok</th>
                                        <th>Baka</th>
                                        <th>Progeny</th>
                                        <th>No Pokok</th>
                                        <th>Tindakan</th>
                                        <th>QR Code</th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    @foreach ($pokoks as $pokok)
                                        <tr style="border-bottom:#fff">
                                            <td>
                                                {{ $loop->iteration }}
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
                                                {{ $pokok->no_pokok }}
                                            </td>

                                            <td>
                                                <form action="{{ route('pi.p.delete', $pokok->id) }}" method="post"
                                                    class="d-inline-flex">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn-del btn btn-sm btn-danger">
                                                        <span class="fas fa-trash-alt" style="width:15px;"></span>
                                                    </button>
                                                </form>

                                                <a href="{{ route('pi.p.edit', $pokok->id) }}"
                                                    class="ms-1 btn btn-sm btn-danger">
                                                    <span data-feather="edit" style="width:15px;"></span>
                                                </a>
                                            </td>

                                            <td>
                                                <button
                                                    onclick="qrbtn('{{ URL::to('/pengurusan-pokok-induk/pokok/edit/' . $pokok->id) }}')"
                                                    type="button" class="btn btn-danger btn-sm ms-1">
                                                    <span data-feather="eye" style="width:15px;"></span>
                                                </button>
                                                <a href="{{ route('downloadqrpokok', $pokok->id) }}"
                                                    class="ms-2 btn btn-danger btn-sm">
                                                    <span class="fas fa-download" style="width:15px;"></span>
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

    <div class="modal fade" id="modalQRAll" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px">
            <div class="modal-content position-relative">
                <div class="position-absolute top-0 end-0 mt-2 me-2 z-index-1">
                    <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base"
                        data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <div class="rounded-top-lg py-3 ps-4 pe-6 bg-light">
                        <h4 class="mb-1">QR CODE</h4>
                    </div>
                    <div class="p-4 text-center ms-2">
                        <a href="{{ route('pokok.bulkqr') }}" class="btn btn-danger">Jana Qr Terkini <span
                                class="fas fa-cog"></span></a>
                        <a href="{{ route('pokok.dbulkqr') }}" class="btn btn-danger">Download <span
                                class="fas fa-download"></span></a>
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Kembali</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modalQRBulk" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 45%">
            <div class="modal-content position-relative">
                <div class="position-absolute top-0 end-0 mt-2 me-2 z-index-1">
                    <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base"
                        data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('pokok.selbulkqr') }}" method="POST">
                    @csrf
                    <div class="modal-body px-4">
                        <div class="rounded-top-lg py-3 ps-4 pe-6 bg-light">
                            <h4 class="mb-1">QR Download</h4>
                        </div>
                        <div class="p-4 ">
                            <label for="">No Pokok untuk di muat turun</label>
                            <select class="form-select js-choice" id="organizerMultiple" multiple="multiple"
                                size="1" name="pokoks[]"
                                data-options='{"removeItemButton":true,"placeholder":true}'>
                                <option value="">Pilih pokok...</option>
                                @foreach ($pokoks as $pokok)
                                    <option value="{{ $pokok->id }}">
                                        Blok:{{ $pokok->blok }}, Baka:{{ $pokok->baka }},
                                        Progeny:{{ $pokok->progeny }},
                                        No Pokok:{{ $pokok->no_pokok }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Kembali</button>
                        <button class="btn btn-danger" type="submit">Muat Turun</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px">
            <div class="modal-content position-relative">
                <div class="position-absolute top-0 end-0 mt-2 me-2 z-index-1">
                    <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base"
                        data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <div class="rounded-top-lg py-3 ps-4 pe-6 bg-light">
                        <h4 class="mb-1">QR CODE</h4>
                    </div>
                    <div class="p-4 ">
                        <div class="text-center" id="qrcode"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Kembali</button>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        var qrcode = new QRCode(document.getElementById("qrcode"), {
            text: "none",
            width: 128,
            height: 128,
            colorDark: "#000000",
            colorLight: "#ffffff",
            correctLevel: QRCode.CorrectLevel.H
        });
        $("#qrcode > img").css({
            "margin": "auto"
        });


        function qrbtn(url) {
            qrcode.clear();
            qrcode.makeCode(url);
            $('#modal').modal('show');
        }
    </script>
@endsection
