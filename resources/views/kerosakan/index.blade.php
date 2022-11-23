@extends('layouts.base')
@section('content')
    <x-header main="Konfigurasi Data Rujukan" sub="Kerosakan" sub2="" />


    <div class="row justify-content-center mt-4">
        <div class="col-xl-10">
            <div class="text-end mb-3">
                <button class="btn btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#error-modal">Daftar
                    <span class="text-white" data-feather="plus-circle"></span>
                </button>
            </div>

            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive scrollbar table-striped">
                            <table class="table fs--1 mb-0 text-center datatable">
                                <thead class=" text-900">
                                    <tr style="border-bottom-color: #F89521">
                                        <th>Bil</th>
                                        <th>Faktor Kerosakan</th>
                                        <th>Nama Kerosakan</th>
                                        <th>Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    @foreach ($kerosakans as $kerosakan)
                                        <tr style="border-bottom:#fff">
                                            <td>
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>
                                                {{ $kerosakan->faktor }}
                                            </td>
                                            <td>
                                                {{ $kerosakan->nama }}
                                            </td>

                                            <td>
                                                <button data-bs-toggle="modal"
                                                    data-bs-target="#modal-edit-{{ $kerosakan->id }}"
                                                    class="btn btn-sm btn-danger">
                                                    <span class="fas fa-edit" style="width:15px;"></span>
                                                </button>
                                                <div class="modal fade" id="modal-edit-{{ $kerosakan->id }}" tabindex="-1"
                                                    role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document"
                                                        style="max-width: 500px">
                                                        <div class="modal-content position-relative">
                                                            <div class="position-absolute top-0 end-0 mt-2 me-2 z-index-1">
                                                                <button
                                                                    class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form action="{{ route('k.update', $kerosakan->id) }}"
                                                                method="POST">
                                                                @method('PUT')
                                                                @csrf
                                                                <div class="modal-body p-0">
                                                                    <div class="rounded-top-lg py-3 ps-4 pe-6 bg-light">
                                                                        <h4 class="mb-1" id="modalExampleDemoLabel">Daftar
                                                                            Kerosakan</h4>
                                                                    </div>
                                                                    <div class="p-4 pb-0">
                                                                        <div class="mb-3">
                                                                            <label class="col-form-label text-main"
                                                                                for="faktor-name">Faktor
                                                                                Kerosakan:</label>
                                                                            <select name="faktor" id="faktor-name"
                                                                                class="form-select border-danger">
                                                                                <option @selected($kerosakan->faktor == 'Manusia')
                                                                                    value="Manusia">Manusia</option>
                                                                                <option @selected($kerosakan->faktor == 'Alam')
                                                                                    value="Alam">Alam
                                                                                </option>
                                                                            </select>

                                                                        </div>
                                                                        <div class="mb-5">
                                                                            <label class="col-form-label text-main"
                                                                                for="nama-name">Nama Kerosakan:</label>
                                                                            <input class="form-control border-danger"
                                                                                name="nama" id="nama-name" type="text"
                                                                                value="{{ $kerosakan->nama }}" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-secondary" type="button"
                                                                        data-bs-dismiss="modal">Tutup</button>
                                                                    <button class="btn btn-danger" type="submit">Simpan
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <form action="{{ route('k.delete', $kerosakan->id) }}" method="post"
                                                    class="d-inline-flex">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-del btn-sm btn-danger">
                                                        <span class="fas fa-trash-alt" style="width:15px;"></span>
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


            <div class="modal fade" id="error-modal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px">
                    <div class="modal-content position-relative">
                        <div class="position-absolute top-0 end-0 mt-2 me-2 z-index-1">
                            <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base"
                                data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('k.store') }}" method="POST">
                            @csrf
                            <div class="modal-body p-0">
                                <div class="rounded-top-lg py-3 ps-4 pe-6 bg-light">
                                    <h4 class="mb-1" id="modalExampleDemoLabel">Daftar Kerosakan</h4>
                                </div>
                                <div class="p-4 pb-0">
                                    <div class="mb-3">
                                        <label class="col-form-label text-main" for="faktor-name">Faktor
                                            Kerosakan:</label>
                                        <select name="faktor" id="faktor-name" class="form-select border-danger">
                                            <option selected disabled hidden>Sila Pilih</option>
                                            <option value="Manusia">Manusia</option>
                                            <option value="Alam">Alam</option>
                                        </select>

                                    </div>
                                    <div class="mb-5">
                                        <label class="col-form-label text-main" for="nama-name">Nama Kerosakan:</label>
                                        <input class="form-control border-danger" name="nama" id="nama-name"
                                            type="text" />
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Tutup</button>
                                <button class="btn btn-danger" type="submit">Simpan </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>



        </div>
    </div>
@endsection
