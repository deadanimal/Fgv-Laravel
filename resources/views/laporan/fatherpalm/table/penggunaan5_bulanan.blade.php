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
      <h4 class="mt-5">UNIT BAHAN TANAMAN</h4>
      <h6 class="mt-2">DATA PENGGUNAAN POLLEN MENGIKUT BLOK TAHUN {{ $tahun }}</h6>
      <h6 class="mt-2">LAPORAN BULAN: {{ $bulan }} {{ $tahun }}</h6>
  </div>

  <div class="col-12 mt-4">
      <div class="table-responsive scrollbar">
          <table class="table table-bordered overflow-hidden" width="100%">
              <thead class="border border-dark">
                  <tr>
                    <th rowspan="2">BIL</th>
                    <th rowspan="2">BLOK</th>
                    <th rowspan="2">PENYELIA BLOK</th>
                    <th rowspan="2">AMBIL POLLEN (gm)</th>
                    <th rowspan="2">KEMBALIKAN POLLEN (gm)</th>
                    <th rowspan="2">JUMLAH BUNGA CP SEPATUT</th>
                    <th rowspan="2">JUMLAH BUNGA CP SEBENAR</th>
                    <th colspan="2">PENGGUNAAN POLLEN GRAM/BUNGA (gm)</th>
                    <th rowspan="2">JUM. POLLEN (gm)</th>
                    <th>PURATA</th>
                    <th rowspan="2">BILANGAN BUNGA DI CP DUA KALI</th>
                  </tr>
                  <tr>
                    <th>SEBENAR DI GUNAKAN</th>
                    <th>SEPATUT DI GUNAKAN</th>
                    <th>POLLEN/BUNGA (gm SEBENAR)</th>
                  </tr>
              </thead>
              <tbody class="border border-dark">
                  <tr>
                    <td>1</td>
                    <td>5CB/18R</td>
                    <td>RAMLI</td>
                    <td>163.30</td>
                    <td>95.50</td>
                    <td>540</td>
                    <td>301</td>
                    <td>67.50</td>
                    <td>37.63</td>
                    <td>29.88</td>
                    <td>0.22</td>
                    <td>239</td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td>KG 6</td>
                    <td>SUHAIRI</td>
                    <td>163.30</td>
                    <td>95.50</td>
                    <td>540</td>
                    <td>301</td>
                    <td>67.50</td>
                    <td>37.63</td>
                    <td>29.88</td>
                    <td>0.22</td>
                    <td>239</td>
                  </tr>
                  <tr>
                    <td>3</td>
                    <td>1/2 KOPI</td>
                    <td>ROSDI</td>
                    <td>163.30</td>
                    <td>95.50</td>
                    <td>540</td>
                    <td>301</td>
                    <td>67.50</td>
                    <td>37.63</td>
                    <td>29.88</td>
                    <td>0.22</td>
                    <td>239</td>
                  </tr>
                  <tr>
                    <td colspan="3">Jumlah</td>
                    <td>489.9</td>
                    <td>1</td>
                    <td>1</td>
                    <td>1</td>
                    <td>1</td>
                    <td>1</td>
                    <td>1</td>
                    <td>1</td>
                    <td>1</td>
                  </tr>
              </tbody>
          </table>
      </div>
  </div>
