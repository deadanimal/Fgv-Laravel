@extends('layouts.base')
@section('content')
    <x-header main="Pengurusan Pengguna" sub="Laporan Petugas" sub2="Maklumat Tugas" />
    <div class="row justify-content-center mt-4">
        <div class="col-10">

            <div class="row">

                <div class="col-xl-5">
                    <img src="{{ url('/storage/' . $tugasan->url_gambar ?? '/test-image/test1.png') }}" class="img-fluid">
                </div>

                <div class="col-xl-1"></div>

                <div class="col-xl-6">
                    {{-- <div class="row mb-3 g-3 align-items-center">
                        <div class="col-4">
                            <label class="col-form-label">Status</label>
                        </div>
                        <div class="col-8">
                            @if ($tugasan->status == 'sah')
                                <input type="text" class="form-control border-success" value="Disahkan" readonly>
                            @elseif($tugasan->status == 'rosak')
                                <input type="text" class="form-control border-danger" value="Rosak" readonly>
                            @endif
                        </div>
                    </div> --}}

                    <div class="row mb-3 g-3 align-items-center">
                        <div class="col-4">
                            <label class="col-form-label">Aktiviti Kerja</label>
                        </div>
                        <div class="col-8">
                            <input type="text" class="form-control" value="{{ $tugasan->jenis }}" readonly>
                        </div>
                    </div>

                    <div class="row mb-3 g-3 align-items-center">
                        <div class="col-4">
                            <label class="col-form-label">No. Daftar</label>
                        </div>
                        <div class="col-8">
                            <input type="text" class="form-control" value="{{ $tugasan->tandan->no_daftar ?? '' }}"
                                readonly>
                        </div>
                    </div>

                    <div class="row mb-3 g-3 align-items-center">
                        <div class="col-4">
                            <label class="col-form-label">No. Pokok</label>
                        </div>
                        <div class="col-8">
                            <input type="text" class="form-control" value="{{ $tugasan->pokok->no_pokok ?? '' }}"
                                readonly>
                        </div>
                    </div>

                    <div class="row mb-3 g-3 align-items-center">
                        <div class="col-4">
                            <label class="col-form-label">Tarikh @switch($type)
                                    @case(1)
                                        Balut
                                    @break

                                    @case(2)
                                        CP
                                    @break

                                    @case(3)
                                        QC
                                    @break

                                    @case(4)
                                        Tuai
                                    @break

                                    @default
                                @endswitch
                            </label>
                        </div>
                        <div class="col-8">
                            <input type="text" class="form-control" value="{{ $tugasan->created_at->format('d/m/Y') }}"
                                readonly>
                        </div>
                    </div>

                    <div class="row mb-3 g-3 align-items-center">
                        <div class="col-4">
                            <label class="col-form-label">Nama @switch($type)
                                    @case(1)
                                        Pembalut
                                    @break

                                    @case(4)
                                        Penuai
                                    @break

                                    @default
                                        Petugas
                                @endswitch
                            </label>
                        </div>
                        <div class="col-8">
                            <input type="text" class="form-control" value="{{ $tugasan->petugas->nama ?? '' }}" readonly>
                        </div>
                    </div>

                    <div class="row mb-3 g-3 align-items-center">
                        <div class="col-4">
                            <label class="col-form-label">Nama Penyelia</label>
                        </div>
                        <div class="col-8">
                            <input type="text" class="form-control" value="{{ $tugasan->pengesah->nama ?? '' }}"
                                readonly>
                        </div>
                    </div>

                    <div class="row mb-3 g-3 align-items-center">
                        <div class="col-4">
                            <label class="col-form-label">Tarikh Pengesahan</label>
                        </div>
                        <div class="col-8">
                            <input type="text" class="form-control"
                                value="{{ $tugasan->updated_at->format('d/m/Y') ?? '' }}" readonly>
                        </div>
                    </div>

                    <div class="row mb-3 g-3 align-items-center">
                        <div class="text-center">
                            <a class="btn btn-danger" href="{{ route('tugasan.index') }}">Kembali</a>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
