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
      <h4 class="mt-5">FELDA AGRICULTURAL SERVICE SDN BHD</h4>
      <h6 class="mt-2">UNIT BAHAN TANAMAN</h6>
      <h6 class="mt-2">REKOD PENGGUNAAN HARIAN POLLEN KE LADANG BENIH</h6>
  </div>
  <div class="col-xl-12 text-left">
      <span><b>Tempoh Laporan: {{$tarikh_mula_word}} - {{$tarikh_akhir_word}}<b></span>
  </div>
  <div class="col-12 mt-4">
      <div class="table-responsive scrollbar">
          <table class="table table-bordered overflow-hidden" width="100%">
              <thead class="border border-dark" style="background-color: #d9d9d9;">
                  <tr>
                    <th>BIL</th>
                    <th>NAMA PENYELIA BLOK</th>
                    <th>BLOK</th>
                    <th>NAMA PENGAMBIL POLLEN</th>
                    <th>JENIS POLLEN</th>
                    <th>% POLLEN</th>
                    <th>KELUAR (g)</th>
                    <th>KEMBALIKAN(g)</th>
                    <th>%KEMBALI</th>
                    <th>GUNA (g)</th>
                    <th>CATITAN</th>
                  </tr>
              </thead>
              <?php
                include_once("../database/Connect.php");

                $tarikh_akhir = date('Y-m-d', strtotime("+1 day", strtotime($tarikh_akhir)));

                $q_selection = "SELECT *
                FROM pollens
                WHERE created_at >= '$tarikh_mula'
                AND created_at <= '$tarikh_akhir'
                GROUP By pengesah_id";
                $result_selection = $mysqli-> query($q_selection);
                if ($result_selection -> num_rows > 0)
                {
	                while($record_selection = $result_selection -> fetch_assoc())
	                {    
						$user_id_selection = $record_selection['pengesah_id'];
                        $pokok_id  = $record_selection['pokok_id'];
                        $pollen_id  = $record_selection['id'];
                        $pollen_jenis  = $record_selection['jenis'];
                        $viabiliti_pollen  = $record_selection['viabiliti_pollen'];
                        $catatan  = $record_selection['catatan'];

                        ?>
                          <tbody class="border border-dark">
                          <?php	
                            $bil = 0;

                            $q = "SELECT *
                            FROM pokoks
                            WHERE id = '$pokok_id'
                            GROUP BY blok, baka";
                            $result = $mysqli-> query($q);
                            if ($result -> num_rows > 0)
                            {
	                            while($record = $result -> fetch_assoc())
	                            {
                                    $bil = $bil + 1;
						            $id = $record['id'];
                                    $blok = $record['blok'];
                                    $induk = $record['induk'];
                                    $baka = $record['baka'];
                                    $progeny = $record['progeny'];
                                    $no_pokok = $record['no_pokok'];
                                    $user_id  = $record['user_id'];
                                    

                                    $sql_user = "SELECT *
				                                FROM users
				                                Where id  = '$user_id_selection'";
                                    $result_user = $mysqli-> query($sql_user);
                                    if ($result_user -> num_rows > 0)
                                    {
	                                    $row_user = $result_user ->fetch_assoc();
	                                    $user_nama = $row_user['nama'];
                                    }

                                    $sql_penyelia = "SELECT *
				                            FROM users
				                            Where id  = '$user_id'";
                                    $result_penyelia = $mysqli-> query($sql_penyelia);
                                    if ($result_penyelia -> num_rows > 0)
                                    {
	                                    $row_penyelia = $result_penyelia ->fetch_assoc();
	                                    $user_penyelia = $row_penyelia['nama'];
                                    }

                                    $sql_pollen = "SELECT *
				                    FROM stok_pollens
				                    Where pollen_id  = '$pollen_id'";
                                    $result_pollen = $mysqli-> query($sql_pollen);
                                    if ($result_pollen -> num_rows > 0)
                                    {
	                                    $row_pollen = $result_pollen ->fetch_assoc();
	                                    $amaun_keluar = $row_pollen['amaun_keluar'];
                                        $amaun_kembali = $row_pollen['amaun_kembali'];
                                        $amaun_semasa = $row_pollen['amaun_semasa'];
                                    }

                                    if ($amaun_kembali == 0 OR $amaun_keluar == 0)
                                    {
                                        $peratus_kembali = 0;
                                    }
                                    else
                                    {
                                        $peratus_kembali = ($amaun_kembali/$amaun_keluar) * 100;
                                    }

                                    $amaun_guna = $amaun_keluar - $amaun_kembali;
                                    

                                    ?>
              <tbody class="border border-dark">
                  <tr>
                    <td>{{ $bil }}</td>
                    <td>{{ $user_penyelia }}</td>
                    <td>{{ $blok }}</td>
                    <td>{{ $user_nama }}</td>
                    <td>{{ $pollen_jenis }}</td>
                    <td>{{ $viabiliti_pollen }}</td>
                    <td>{{ $amaun_keluar }}</td>
                    <td>{{ $amaun_kembali }}</td>
                    <td>{{ $peratus_kembali }}</td>
                    <td>{{ $amaun_guna }}</td>
                    <td>{{ $catatan }}</td>
                  </tr>
                  <?php 
                    }
                    }
                    ?>
                    <?php 
                    }
                    }
                    ?>  
              </tbody>
          </table>
      </div>

  </div>
