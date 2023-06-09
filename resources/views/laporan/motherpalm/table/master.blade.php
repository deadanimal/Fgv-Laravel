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
</style>
<div class="col-xl-12 text-center">
    <h4 class="mt-5">WEB - KATEGORI LAPORAN (Master Record)</h4>
</div>
<div class="col-12 mt-4">
    <div class="table-responsive scrollbar">
        <table class="table table-hover table-bordered overflow-hidden" width="100%">
            <thead class="border border-dark">
                <tr>
                    <th rowspan="2">Bil</th>
                    <th rowspan="2">No. Daftar</th>
                    <th rowspan="2">No. Blok</th>
                    <th rowspan="2">No. Pokok</th>
                    <th rowspan="2">Baka</th>
                    <th rowspan="2">Tarikh Balut</th>
                    <th rowspan="2">Petugas Balut</th>
                    <th rowspan="2">Nama Penyelia</th>
                    <th rowspan="2">Rosak Sebelum CP</th>
                    <th rowspan="2">No. Pollen</th>
                    <th rowspan="2">% Visibiliti</th>
                    <th rowspan="2">Tarikh CP</th>
                    <th rowspan="2">Petugas CP</th>
                    <th rowspan="2">Tarikh Periksa QC</th>
                    <th rowspan="2">Nama Periksa QC</th>
                    <th rowspan="2">Status QC</th>
                    <th rowspan="2">Catatan</th>
                    <th rowspan="2">Umur Tandan</th>
                    <th rowspan="2">Tarikh Tuai</th>
                    <th rowspan="2">Berat Tandan (kg)</th>
                    <th rowspan="2">Rosak Belum Tuai</th>
                </tr>
            </thead>
            <tbody class="border border-dark">
                @foreach ($mTandanPokokBagging as $key => $m)
                    {{-- @if ($key != 'mTPB') --}}
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{$m->tandan->no_daftar}}</td>
                            <td>{{$m->pokok->blok}}</td>
                            <td>{{$m->pokok->no_pokok}}</td>
                            <td>{{$m->pokok->baka}}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                {{-- @foreach ($mTandan as $tandan)
                                        {{ $tandan['umur'] }}
                                @endforeach --}}
                            </td>
                            <td></td>
                            {{-- <td>{{$r['berat_tandan']}}</td> --}}
                            <td></td>
                            <td></td>
                        </tr>
                    {{-- @endif --}}
                @endforeach
                <thead class="border border-dark">
                    {{-- <tr bordercolor="red">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Jumlah</td>
                        @foreach ($result['T'] as $r)
                            <td>{{ $r }}</td>
                        @endforeach
                        <td></td>
                        <td></td>
                    </tr> --}}
                </thead>
            </tbody>
        </table>
    </div>

</div>
