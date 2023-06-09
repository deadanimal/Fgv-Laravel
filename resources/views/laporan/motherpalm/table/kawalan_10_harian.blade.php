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
      <h4 class="mt-5 text-bold">LADANG BENIH <br>
      REKOD HARIAN PEMERIKSAAN PETUGAS (QC)</h4>
  </div>

  <div class="col-xl-12 text-left">
      JUMLAH PERIKSA:
      <span style="margin-left:900px">BULAN: </span>
  </div>

  <div class="col-12 mt-4">
      <div class="table-responsive scrollbar">
          <table class="table table-bordered overflow-hidden" width="100%">
              <thead class="border border-dark">
                  <tr>
                      <td>BIL</td>
                      <td>NAMA</td>
                      @for ($i = 1; $i <= $result['daysInMonth']; $i++)
                          <td>{{ $i }}</td>
                      @endfor
                      <td>JUMLAH</td>
                  </tr>
              </thead>
              <tbody class="border border-dark">
                  @foreach ($result as $key => $r)
                      @if ($key == 'daysInMonth')
                          @continue
                      @endif

                      <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $r['nama'] }}</td>
                          @foreach ($r['data'] as $item)
                              <td>{{ $item }}</td>
                          @endforeach
                          <td>{{ $r['jumlah'] }}</td>
                      </tr>
                  @endforeach

                      <tr>
                          <td colspan="2"><b>HARI INI</b></td>
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
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                      </tr>
                      <tr>
                          <td colspan="2"><b>HINGGA KINI</b></td>
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
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                      </tr>
              </tbody>
          </table>
      </div>
  </div>
