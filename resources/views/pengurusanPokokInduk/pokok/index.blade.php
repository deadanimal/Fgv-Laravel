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
                                        <th>Blok</th>
                                        <th>Baka</th>
                                        <th>Progeny</th>
                                        <th>No Pokok</th>
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
                                                    class="ms-2 btn btn-sm btn-danger">
                                                    <span data-feather="edit" style="width:15px;"></span>
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
@endsection
