@extends('layouts.base')
@section('content')
    <x-header main="Jejak Audit" sub="Audit" sub2="" />


    <div class="row justify-content-center mt-4">

        <form class="col-7" action="{{ route('search.audit') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-4">
                    <p class="fw-bold">No. Kakitangan</p>
                </div>
                <div class="col-8">
                    <input type="text" name="no_kakitangan" class="form-control mb-3" value="{{ $no_kakitangan ?? '' }}">
                </div>
                <div class="col-4">
                    <p class="fw-bold">Aktiviti</p>
                </div>
                <div class="col-8">
                    <select name="aktiviti" class="form-select mb-3">
                        @isset($aktiviti)
                            <option @selected($aktiviti == 'CIPTA') value="CIPTA">CIPTA</option>
                            <option @selected($aktiviti == 'KEMASKINI') value="KEMASKINI">KEMASKINI</option>
                            <option @selected($aktiviti == 'HAPUS') value="HAPUS">HAPUS</option>
                            <option @selected($aktiviti == 'LOG MASUK') value="LOG MASUK">LOG MASUK</option>
                            <option @selected($aktiviti == 'LOG KELUAR') value="LOG KELUAR">LOG KELUAR</option>
                        @else
                            <option value="" selected disabled hidden></option>
                            <option value="CIPTA">CIPTA</option>
                            <option value="KEMASKINI">KEMASKINI</option>
                            <option value="HAPUS">HAPUS</option>
                            <option value="LOG MASUK">LOG MASUK</option>
                            <option value="LOG KELUAR">LOG KELUAR</option>
                        @endisset
                    </select>
                    {{-- <input type="text" name="aktiviti" class="form-control mb-3" value="{{ $aktiviti ?? '' }}"> --}}
                </div>
                <div class="col-4">
                    <p class="fw-bold">Tarikh</p>
                </div>
                <div class="col-8">
                    <div class="input-group">
                        <input class="form-control datetimepicker border-right-0" type="text" placeholder="SILA PILIH"
                            data-options='{"disableMobile":true}' aria-describedby="date" name="tarikh_daftar"
                            value="{{ $tarikh_daftar ?? '' }}" />
                        <button type="button" class="btn border-secondary border-left-0" id="date"><span
                                class="far fa-calendar-alt text-secondary"></button>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-12 text-center">
                    <button class="btn btn-sm btn-danger" id="btnSearch">Cari
                        <span data-feather="search"></span>
                    </button>
                    <a href="{{ route('audit') }}" class="btn btn-sm btn-link">
                        <span class="refreshbtn" style="color:grey" data-feather="refresh-ccw"></span>
                    </a>
                </div>
            </div>
        </form>


        <div class="col-10 mt-5">
            <div class="row">
                <div class="card">
                    <div class="card-body ">
                        <div class="table-responsive scrollbar table-striped">
                            <table class="table fs--1 mb-0 text-center datatable">
                                <thead class=" text-900">
                                    <tr style="border-bottom-color: #F89521">
                                        <th>Bil</th>
                                        <th>No. Kakitangan</th>
                                        <th>Aktiviti</th>
                                        <th>Keterangan</th>
                                        <th>Tarikh Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    @foreach ($logs as $log)
                                        <tr style="border-bottom:#fff">
                                            <td>
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>
                                                {{ $log->causer->no_kakitangan ?? '' }}
                                            </td>
                                            <td>
                                                {{ $log->event }}
                                            </td>
                                            <td>
                                                {{ $log->description }}
                                            </td>
                                            <td>
                                                {{ $log->updated_at->format('d/m/Y') }}
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

    <script>
        $('#date').click(function() {
            $('.datetimepicker').trigger('click');

        });
    </script>
@endsection
