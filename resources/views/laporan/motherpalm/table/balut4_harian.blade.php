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
      <h4 class="mt-5 text-bold">LAPORAN HARIAN KEROSAKAN BUNGA SEBELUM PENDEBUNGAAN TERKAWAL (CP)</h4>
  </div>

  <div class="col-12 mt-4">
      <div class="table-responsive scrollbar">
          <table class="table table-bordered overflow-hidden" width="100%">
              <thead class="border border-dark">
                  <tr>
                      <td>Penyelia</td>
                      <td>Blok</td>
                      <td>Baka</td>
                      @for ($i = 1; $i <= $result['daysInMonth']; $i++)
                          <td>{{ $i }}</td>
                      @endfor
                      <td>Jumlah</td>
                  </tr>
              </thead>
              <tbody class="border border-dark">
                  @foreach ($result as $key => $r)
                      @if ($key == 'daysInMonth')
                          @continue
                      @endif

                      <tr>
                          <td>{{ $r['nama'] }}</td>
                          <td>{{ $r['blok'] }}</td>
                          <td>{{ $r['baka'] }}</td>
                          @foreach ($r['data'] as $item)
                              <td>{{ $item }}</td>
                          @endforeach
                          <td>{{ $r['jumlah'] }}</td>
                      </tr>
                  @endforeach
              </tbody>
          </table>
      </div>
  </div>
