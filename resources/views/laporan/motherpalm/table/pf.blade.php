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
      <h4 class="mt-5">Ladang Benih Pusat Pertanian Perkhidmatan Tun Razak</h4>
      <h6 class="mt-2">Rumusan Pencapaian Penuaian Harian Tandan Ladang Benih</h6>
  </div>
  <div class="col-12 mt-4">
      <div class="table-responsive scrollbar">
          <table class="table table-hover table-bordered overflow-hidden" width="100%">
              <thead class="border border-dark">
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
              <tbody>
                  @foreach ($result as $r)
                      <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $r['blok'] }}</td>
                          <td>{{ $r['baka'] }}</td>
                          <td>{{ $r['j_motherpalm'] }}</td>
                          <td>{{ $r['jan'] }}</td>
                          <td>{{ $r['feb'] }}</td>
                          <td>{{ $r['mar'] }}</td>
                          <td>{{ $r['apr'] }}</td>
                          <td>{{ $r['may'] }}</td>
                          <td>{{ $r['jun'] }}</td>
                          <td>{{ $r['jul'] }}</td>
                          <td>{{ $r['aug'] }}</td>
                          <td>{{ $r['sep'] }}</td>
                          <td>{{ $r['oct'] }}</td>
                          <td>{{ $r['nov'] }}</td>
                          <td>{{ $r['dec'] }}</td>
                          <td>{{ $r['j_bunga'] }}</td>
                          <td>{{ number_format((float) $r['average'], 2, '.', '') }}</td>
                      </tr>
                  @endforeach
              </tbody>
          </table>
      </div>

  </div>
