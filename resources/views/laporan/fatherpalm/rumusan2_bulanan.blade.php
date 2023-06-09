@extends('layouts.base')
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
            @include('laporan.fatherpalm.table.rumusan2_bulanan')
        </div>
    </div>


    <script>
        $('#download').change(function(e) {
            let val = $(this).val();
            switch (val) {
                case '1':
                    $.ajax({
                        type: "GET",
                        url: "{{ route('laporanBalut1', 'pdf') }}",
                        data: {
                            'bulan': "{{ $bulan ?? 'false' }}",
                            'tahun': "{{ $tahun ?? 'false' }}",
                            'tarikh_mula': "{{ $tarikh_mula ?? 'false' }}",
                            'tarikh_akhir': "{{ $tarikh_akhir ?? 'false' }}",
                            'hb': "{{ $hb }}",
                        },
                    });
                    break;
                case '2':
                    downloadExcelCsv('excel');
                    break;
                case '3':
                    downloadExcelCsv('csv');
                    break;

                default:
                    break;
            }
        });


        function downloadExcelCsv(type) {
            let url = new URL("{{ route('laporanBalut1', '+type+') }}");
            let params = {
                'bulan': "{{ $bulan ?? 'false' }}",
                'tahun': "{{ $tahun ?? 'false' }}",
                'tarikh_mula': "{{ $tarikh_mula ?? 'false' }}",
                'tarikh_akhir': "{{ $tarikh_akhir ?? 'false' }}",
                'hb': "{{ $hb }}",
            };

            Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

            let link = document.createElement('a');
            link.href = url;
            if (type == 'excel') {
                link.download = '1P1F.xlsx';
            }
            if (type == 'csv') {
                link.download = '1P1F.csv';
            }
            link.style.display = 'none';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }
    </script>
@endsection
