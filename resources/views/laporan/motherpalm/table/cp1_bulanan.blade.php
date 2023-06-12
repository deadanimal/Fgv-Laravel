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
      <h4 class="mt-5 text-bold">LAPORAN BULANAN PENDEBUNGAAN TERKAWAL (CP)</h4>
  </div>

  <div class="col-12 mt-4">
      <div class="table-responsive scrollbar">
          <table class="table table-bordered overflow-hidden" width="100%">
              <thead class="border border-dark">
                  <tr>
                      <td>Penyelia</td>
                      <td>Blok</td>
                      <td>Baka</td>
                      <td>JAN</td>
                      <td>FEB</td>
                      <td>MAR</td>
                      <td>APR</td>
                      <td>MAY</td>
                      <td>JUN</td>
                      <td>JUL</td>
                      <td>AUG</td>
                      <td>SEP</td>
                      <td>OCT</td>
                      <td>NOV</td>
                      <td>DEC</td>
                      <td>Jumlah</td>
                  </tr>
              </thead>
              <tbody class="border border-dark">
                  @foreach ($results['listPenyeliaCP'] as $key => $penyelia)
                      @if ($key == 'daysInMonth')
                          @continue
                      @endif
                      <tr>
                          <td>{{ $penyelia['nama'] }}</td>
                          <td>{{ $penyelia['blok'] }}</td>
                          <td>{{ $penyelia['baka'] }}</td>
                          <td>0</td>
                          <td>0</td>
                          <td>0</td>
                          <td>0</td>
                          <td>0</td>
                          <td>0</td>
                          <td>0</td>
                          <td>0</td>
                          <td>0</td>
                          <td>0</td>
                          <td>0</td>
                          <td>0</td>
                          <td>{{ $penyelia['jumlah'] }}</td>
                      </tr>
                  @endforeach
              </tbody>
          </table>
      </div>
  </div>
