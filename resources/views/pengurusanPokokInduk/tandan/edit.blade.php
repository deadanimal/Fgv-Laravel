@extends('layouts.base')

@section('content')
    <x-header main="Pengurusan Pokok Induk" sub="Tandan" sub2="Maklumat Tandan" />
    <div class="container mt-5">
        <form action="{{ route('pi.t.update', $tandan->id) }}" method="post" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="row justify-content-center">
                <div class="col-xl-8 mb-4">
                    <div class="row align-items-center">
                        <div class="col-xl-3 text-end">
                            <label for="">No Daftar</label>
                        </div>
                        <div class="col-xl-6">
                            <input type="text" class="form-control border-danger" value="{{ $tandan->no_daftar }}"
                                readonly>
                        </div>
                        <div class="col-xl-3">
                            <button class="btn btn-danger">Kemaskini
                                <span data-feather="check-circle"></span>
                            </button>
                        </div>

                    </div>
                </div>

                <div class="col-xl-10">
                    <div class="row mt-5 align-items-center">
                        <div class="col-4 mb-3">
                            <label for="">Nombor Pokok</label>
                        </div>
                        <div class="col-8 mb-3">
                            <select name="pokok_id" class="form-select" required>
                                <option selected disabled hidden> Sila Pilih</option>
                                @foreach ($pokoks as $pokok)
                                    <option {{ $pokok->id == $tandan->pokok_id ? 'selected' : '' }}
                                        value="{{ $pokok->id }}">{{ $pokok->no_pokok }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-4 mb-3">
                            <label for="">Tarikh Daftar</label>
                        </div>
                        <div class="col-8 mb-3">
                            <input type="date" class="form-control" name="tarikh_daftar"
                                value="{{ $tandan->tarikh_daftar }}" required>
                        </div>

                        <div class="col-4 mb-3">
                            <label for="">Umur Tandan</label>
                        </div>
                        <div class="col-8 mb-3">
                            <input type="number" class="form-control" name="umur" value="{{ $tandan->umur }}" required>
                        </div>

                        <h4 class="h4 text-main mt-5">Tugasan Tandan</h4>
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
                                                        @switch($tugasan->status)
                                                            @case('dicipta')
                                                                Dalam Proses
                                                            @break

                                                            @case('siap')
                                                                Selesai Dilaksanakan
                                                            @break

                                                            @case('sah')
                                                                Disahkan
                                                            @break

                                                            @case('rosak')
                                                                Rosak
                                                            @break

                                                            @default
                                                        @endswitch
                                                    </td>
                                                    <td class="tarikh">
                                                        {{ $tugasan->tarikh }}
                                                    </td>
                                                    <td>
                                                        <form action="{{ route('tugasan.update', $tugasan->id) }}"
                                                            method="post" class="d-inline-flex">
                                                            @csrf
                                                            @method('put')

                                                            @switch($tugasan->status)
                                                                @case('dicipta')
                                                                    <input type="hidden" name="status" value="siap">
                                                                    <button type="submit"
                                                                        class="btn btn-sm btn-primary">SIAP</button>
                                                                @break

                                                                @case('siap')
                                                                    <input type="hidden" name="status" value="sah">
                                                                    <button type="submit"
                                                                        class="btn btn-sm btn-success">SAH</button>
                                                                @break

                                                                @default
                                                                    <a href="{{ route('tugasan.show', $tugasan->id) }}"
                                                                        class="btn btn-sm btn-danger">
                                                                        <span class="fas fa-book-open"></span>
                                                                    </a>
                                                            @endswitch
                                                        </form>



                                                        @if ($tugasan->status == 'dicipta' || $tugasan->status == 'siap')
                                                            <form action="{{ route('tugasan.update', $tugasan->id) }}"
                                                                method="post" class="d-inline-flex">
                                                                @csrf
                                                                @method('put')
                                                                <input type="hidden" name="status" value="rosak">
                                                                <button type="submit"
                                                                    class="btn btn-warning btn-sm">ROSAK</button>
                                                            </form>
                                                            <form action="{{ route('tugasan.destroy', $tugasan->id) }}"
                                                                method="post" class="d-inline-flex">
                                                                @csrf
                                                                @method('delete')
                                                                <button type="submit" class="btn btn-danger btn-sm"><span
                                                                        class="fas fa-trash-alt"></span></button>
                                                            </form>
                                                        @endif


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
        </form>
    </div>
@endsection
