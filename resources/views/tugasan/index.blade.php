@extends('layouts.base')
@section('content')
    <x-header main="Pengurusan Pengguna" sub="Laporan Petugas" sub2="" />


    <div class="row justify-content-center mt-4">
        <div class="col-10">

            <div class="row">
                <div class="text-end">
                    <a href="{{ route('tugasan.create') }}" class="btn btn-danger">Tambah Tugasan <span
                            class="fas fa-plus"></span></a>
                </div>
            </div>

            <div class="row mt-4">
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
                                                <form action="{{ route('tugasan.update', $tugasan->id) }}" method="post"
                                                    class="d-inline-flex">
                                                    @csrf
                                                    @method('put')

                                                    @switch($tugasan->status)
                                                        @case('dicipta')
                                                            <input type="hidden" name="status" value="siap">
                                                            <button type="submit" class="btn btn-sm btn-primary">SIAP</button>
                                                        @break

                                                        @case('siap')
                                                            <input type="hidden" name="status" value="sah">
                                                            <button type="submit" class="btn btn-sm btn-success">SAH</button>
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
                                                        <button type="submit" class="btn btn-warning btn-sm">ROSAK</button>
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
@endsection
