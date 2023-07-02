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
  </div>
  <div class="col-xl-12 text-left">
      <span><b>Tempoh Laporan: {{$bulan_word}} {{$tahun}} - {{$bulan_akhir_word}} {{$tahun}}<b></span>
  </div>

  <div class="col-12 mt-4">
      <div class="table-responsive scrollbar">
          <table class="table table-bordered overflow-hidden" width="100%">
              <thead class="border border-dark" style="background-color: #d9d9d9;">
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
              <?php
              include_once("../database/Connect.php");

              $tarikh_akhir = date('Y-m-d', strtotime("+1 day", strtotime($tarikh_akhir)));
              $bil = 0;

              $q_selection = "SELECT P.blok, P.baka, P.user_id, B.pokok_id, B.berat_pollen, B.id
              FROM pollens B
              INNER JOIN pokoks P on B.pokok_id = P.id
              WHERE B.created_at >= '$tahun-$bulan-01'
              AND B.created_at <= '$tahun-$bulan_akhir-31'
              group by P.blok";
              $result_selection = $mysqli-> query($q_selection);
              if ($result_selection -> num_rows > 0)
              {
	              while($record_selection = $result_selection -> fetch_assoc())
	              {    
		                $user_id_selection = $record_selection['user_id'];
                        $pollens_id = $record_selection['id'];
                        $pokok_id = $record_selection['pokok_id'];
                        $tandan_id = $record_selection['tandan_id'];
                        $blok = $record_selection['blok'];
                        $baka = $record_selection['baka'];
                        $catatan = $record_selection['catatan'];
                        $berat_pollen = $record_selection['berat_pollen'];

                        $bil = $bil + 1;

                        $berat_pollen_bawah = $berat_pollen_bawah + $berat_pollen;

                        $sql_user = "SELECT *
				                    FROM users
				                    Where id  = '$user_id_selection'";
                        $result_user = $mysqli-> query($sql_user);
                        if ($result_user -> num_rows > 0)
                        {
	                        $row_user = $result_user ->fetch_assoc();
	                        $user_nama = $row_user['nama'];
                        }

                        $sql_pollen = "SELECT *
				                    FROM stok_pollens
				                    Where pollen_id  = '$pollens_id'";
                        $result_pollen = $mysqli-> query($sql_pollen);
                        if ($result_pollen -> num_rows > 0)
                        {
	                        $row_pollen = $result_pollen ->fetch_assoc();
	                        $amaun_keluar = $row_pollen['amaun_keluar'];
                            $amaun_kembali = $row_pollen['amaun_kembali'];
                            $amaun_semasa = $row_pollen['amaun_semasa'];
                        }

                        $amaun_keluar_bawah = $amaun_keluar_bawah + $amaun_keluar;
                        $amaun_kembali_bawah = $amaun_kembali_bawah + $amaun_kembali;
                        $amaun_semasa_bawah = $amaun_semasa_bawah + $amaun_semasa;

                        $sebenar_digunakan = $amaun_keluar - $amaun_kembali;

                        $sebenar_digunakan_bawah = $sebenar_digunakan_bawah + $sebenar_digunakan;

                        $sql_cp = "SELECT Count(id) as num
				        FROM control_pollinations
				        Where pokok_id  = '$pokok_id'";
                        $result_cp = $mysqli-> query($sql_cp);
                        if ($result_cp -> num_rows > 0)
                        {
	                        $row_cp = $result_cp ->fetch_assoc();
                            $jumlah_bunga_cp = $row_cp['jumlah_bunga_cp'];
                            $no_pollen = $row_cp['no_pollen'];
                        }

                        $jumlah_bunga_cp_bawah = $jumlah_bunga_cp_bawah + $jumlah_bunga_cp;
                        $no_pollen_bawah = $no_pollen_bawah + $no_pollen;
              ?>
              <tbody class="border border-dark">
                  <tr>
                    <td>{{ $bil }}</td>
                    <td>{{ $blok }}</td>
                    <td>{{ $user_nama }}</td>
                    <td>{{ $amaun_keluar }}</td>
                    <td>{{ $amaun_kembali }}</td>
                    <td>{{ $jumlah_bunga_cp }}</td>
                    <td>{{ $jumlah_bunga_cp }}</td>
                    <td>{{ $sebenar_digunakan }}</td>
                    <td>{{ $amaun_keluar }}</td>
                    <td>{{ $amaun_semasa }}</td>
                    <td>{{ $berat_pollen }}</td>
                    <td>{{ $no_pollen }}</td>
                  </tr>
                  <?php
                  }
              }
              ?>
                  <tr style="background-color: #d9d9d9;">
                    <td colspan="3">Jumlah</td>
                    <td>{{ $amaun_keluar_bawah }}</td>
                    <td>{{ $amaun_kembali_bawah }}</td>
                    <td>{{ $jumlah_bunga_cp_bawah }}</td>
                    <td>{{ $jumlah_bunga_cp_bawah }}</td>
                    <td>{{ $sebenar_digunakan_bawah }}</td>
                    <td>{{ $amaun_keluar_bawah }}</td>
                    <td>{{ $amaun_semasa_bawah }}</td>
                    <td>{{ $berat_pollen_bawah }}</td>
                    <td>{{ $no_pollen_bawah }}</td>
                  </tr>
              </tbody>
          </table>
      </div>
  </div>
