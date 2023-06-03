@extends('layouts.base')
<style type="text/css">
    @page {
        size: A4 landscape;
        margin: 30px;
    }

    table,
    th,
    td {
        border: 1px solid black;
        border-collapse: collapse;
        font-size: 10px;
        padding: 5px;
        text-transform: capitalize;
    }

    td {
        text-align: center;
    }

    .text-center {
        text-align: center;
    }

    thead.border-dark td {
        border-color: black !important;
    }
</style>
@php
    use App\Models\Pokok;
@endphp
@section('content')
    <div class="row mx-2">

        <div class="col-9 mt-5"></div>
        <div class="col-3 text-end mt-5">
            <select id="download" class="form-select bg-danger text-white">
                <option selected disabled hidden>Muat Turun Dokumen</option>
                <option value="1">PDF (.pdf)</option>
                <option value="2">Excel (.xlxs)</option>
                <option value="3">CSV (.csv)</option>
            </select>
        </div>

        <div class="col-12 mt-4">
            {{-- @include('laporan.motherpalm.table.bagging') --}}
            <div class="col-xl-12 text-center">
                <h4 class="mt-5">LAPORAN HARIAN BALUT(BAGGING)</h4>
                {{-- <h6 class="mt-2">Rumusan Pencapaian Penuaian Harian Tandan Ladang Benih</h6> --}}
            </div>
            <div class="col-xl-12">
                <h5>BULAN : {{ $bulan . ' ' . $tahun }}</h5>
            </div>
            <div class="col-12 mt-4">
                <div class="table-responsive scrollbar">
                    <table class="table table-bordered overflow-hidden" width="100%">
                        <thead class="border border-dark">
                            <tr>
                                <th>PENYELIA</th>
                                <th>BLOK</th>
                                <th>BAKA</th>
                                @for ($i = 1; $i < 32; $i++)
                                    <th>{{ $i }}</th>
                                @endfor
                                <th>JUMLAH</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($list as $k => $pokok)
                                @foreach ($pokok as $l => $bagging)
                                    <tr>
                                        @php
                                            // $p = Pokok::find($l);
                                            $string = $l;
                                            $array = explode('|', $string);
                                            $c = 0;
                                        @endphp

                                        @if ($loop->index == 0)
                                            <td rowspan="{{ count($pokok) }}">{{ $k }}</td>
                                        @endif
                                        <td>{{ $array['0'] }}</td>
                                        <td>{{ $array['1'] }}</td>
                                        {{-- @foreach ($bagging as $m => $value) --}}

                                        @for ($i = 1; $i < 32; $i++)
                                            @if (!isset($bagging[$i]))
                                                <td>0</td>
                                            @else
                                                <td>{{ $bagging[$i] }}</td>
                                                @php
                                                    $c = $c + $bagging[$i];
                                                @endphp
                                            @endif
                                        @endfor
                                        <td>{{ $c }}</td>

                                        {{-- @endforeach --}}
                                    </tr>
                                @endforeach
                                <tr>
                                    <td></td>
                                    <td colspan="2">Jumlah</td>
                                    @for ($i = 0; $i < 31; $i++)
                                        <td></td>
                                    @endfor
                                    <td></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection
