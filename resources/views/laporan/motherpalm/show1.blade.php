@extends('layouts.base')
@section('content')
    <div class="row mx-2">
        <div class="col-xl-12 text-center">
            <h4 class="mt-5">Ladang Benih Pusat Pertanian Perkhidmatan Tun Razak</h4>
            <h6 class="mt-2">Rumusan Pencapaian Penuaian Harian Tandan Ladang Benih</h6>
        </div>
        <div class="col-6 ">
            <button class="btn btn-danger btn-sm">Jengka</button>
        </div>
        <div class="col-6 text-end">
            <button class="btn btn-danger btn-sm">Muat Turun Dokumen</button>
        </div>

        <div class="col-12 mt-4">
            <div class="table-responsive scrollbar">
                <table class="table table-hover table-bordered overflow-hidden">
                    <thead>
                        <tr>
                            <th rowspan="2" colspan="2">Kategori Tandan</th>
                            @foreach ($dates as $date)
                                <th colspan="2">{{ $date }}</th>
                            @endforeach
                        </tr>
                        <tr>
                            @foreach ($dates as $date)
                                <th>Tandan</th>
                                <th>%</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                < 4 Bulan 20 Hari </td>
                        </tr>
                        <tr>
                            <td>
                                4 Bulan 20 Hari - 4 Bulan 25 Hari
                            </td>
                        </tr>
                        <tr>
                            <td>
                                4 Bulan 26 Hari - 4 Bulan 29 Hari
                            </td>
                        </tr>
                        <tr>
                            <td>
                                5 Bulan - 5.5 Bulan
                            </td>
                        </tr>
                        <tr>
                            <td>
                                5.6 Bulan - 6 Bulan
                            </td>
                        </tr>
                        <tr>
                            <td>
                                > 6 Bulan
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Total
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
