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
      <h4>FGV AGRI SERVICES SDN BHD<br>
      UNIT BAHAN TANAMAN 35371-M<br><br>
      Rumusan Kerosakan Blok
      </h4>
  </div>
  <div class="col-12 mt-4">
      <div class="table-responsive scrollbar">
      @foreach ($result as $key => $r)
        @if ($key == 'daysInMonth')
        @continue
      @endif
          <table class="table table-hover table-bordered overflow-hidden" width="100%">
              <thead class="border border-dark">
                  <tr>
                      <td>Penyelia</td>
                      <td>Blok</td>
                      <td>Baka</td>
                      <td>Jum. B.Bag</td>
                      <td>Jum. Rosak</td>
                      <td>Jum. Lulus</td>
                      <td>% Rosak</td>
                      <td>Anai-Anai</td>
                      <td>Tikus</td>
                      <td>Bag Pecah</td>
                      <td>I.Bawah T.Kemas</td>
                      <td>I.Atas T.Kemas</td>
                      <td>Bunga Mati</td>
                      <td>I.Atas Bunga</td>
                      <td>Patah</td>
                      <td>WM Masa CP</td>
                      <td>Kembang Tak Sekata</td>
                      <td>Bunga Tak CP</td>
                      <td>Serangan Haiwan</td>
                      <td>Sambang</td>
                      <td>Tenggelam Banjir</td>
                      <td>Catitan</td>
                  </tr>
              </thead>
              <tbody class="border border-dark">
                  <tr>
                    <td rowspan="2">{{ $r['nama'] }}</td>
                    <td>{{ $r['blok'] }}</td>
                    <td>{{ $r['baka'] }}</td>
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
                    <td>2</td>
                    <td>2</td>
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
                    <td colspan="2"><b>Jumlah</b></td>
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
                    <td colspan="2"><b>Peratus</b></td>
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
      @endforeach

          <table class="table table-hover table-bordered overflow-hidden" width="100%">
              <thead class="border border-dark">
                  <tr>
                      <td colspan='3'><b>Jumlah Keseluruhan</b></td>
                      <td>1</td>
                      <td>1</td>
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
                      <td colspan='5'><b>Peratus</b></td>
                      <td>2</td>
                      <td>2</td>
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
              </thead>
          </table>
      </div>

  </div>
