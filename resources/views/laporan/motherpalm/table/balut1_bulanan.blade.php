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
  <div class="col-xl-12 text-center">
      <h4 class="mt-5">Ladang Benih Pusat Pertanian Perkhidmatan Tun Razak</h4>
      <h6 class="mt-2">Rumusan Pencapaian Penuaian Bulanan Tandan Ladang Benih</h6>
      <h6 class="mt-2">LAPORAN 1P1F (Motherpalm)</h6>
  </div>
  <div class="col-xl-12 text-left">
      <span><b>Tempoh Laporan: {{$bulan_word}} {{$tahun}} - {{$bulan_akhir_word}} {{$tahun}}<b></span>
  </div>
  <div class="col-12 mt-4">
      <div class="table-responsive scrollbar">
          <table class="table table-bordered overflow-hidden" width="100%">
              <thead class="border border-dark" style="background-color: #d9d9d9;">
                  <tr>
                      <th rowspan="2">Bil</th>
                      <th rowspan="2">Blok</th>
                      <th rowspan="2">Baka</th>
                      <th rowspan="2">Jumlah Motherpalm</th>
                      <th colspan="12">Jumlah Bunga</th>
                      <th rowspan="2">Jumlah</th>
                      <th rowspan="2">Bunga/Pokok/Tahun</th>
                  </tr>
                  <tr>
                      <th>JAN</th>
                      <th>FEB</th>
                      <th>MAR</th>
                      <th>APR</th>
                      <th>MAY</th>
                      <th>JUN</th>
                      <th>JUL</th>
                      <th>AUG</th>
                      <th>SEP</th>
                      <th>OCT</th>
                      <th>NOV</th>
                      <th>DEC</th>
                  </tr>
              </thead>
              <tbody class="border border-dark">
                  @foreach ($result['listBlokBaka'] as $key => $r)
                      @if ($key != 'T')
                          <tr>
                              <td>{{ $loop->iteration }}</td>
                              <td>{{ $r['blok'] }}</td>
                              <td>{{ $r['baka'] }}</td>
                              <td>{{ $result[$key]['j_motherpalm'] ?? 0 }}</td>
                              <td>{{ $result[$key]['01'] ?? 0 }}</td>
                              <td>{{ $result[$key]['02'] ?? 0 }}</td>
                              <td>{{ $result[$key]['03'] ?? 0 }}</td>
                              <td>{{ $result[$key]['04'] ?? 0 }}</td>
                              <td>{{ $result[$key]['05'] ?? 0 }}</td>
                              <td>{{ $result[$key]['06'] ?? 0 }}</td>
                              <td>{{ $result[$key]['07'] ?? 0 }}</td>
                              <td>{{ $result[$key]['08'] ?? 0 }}</td>
                              <td>{{ $result[$key]['09'] ?? 0 }}</td>
                              <td>{{ $result[$key]['10'] ?? 0 }}</td>
                              <td>{{ $result[$key]['11'] ?? 0 }}</td>
                              <td>{{ $result[$key]['12'] ?? 0 }}</td>
                              <td>{{ $result[$key]['jumlah'] ?? 0 }}</td>
                              <td>{{ $result[$key]['takRosak'] ?? 0 }}</td>
                          </tr>
                      @endif
                  @endforeach
                  <thead class="border border-dark" style="background-color: #d9d9d9;">
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Jumlah</td>
                      @foreach ($result['T'] as $r)
                          <td>{{ $r }}</td>
                      @endforeach
                      <td></td>
                      <td></td>
                  </thead>
              </tbody>
          </table>
      </div>

  </div>
