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
      <h4>  FGV AGRI SERVICES SDN BHD (353791-M)<br>
            FELDA AGRICULTURAL SERVICES SDN BHD (353791-M)<br>
            UNIT BAHAN TANAMAN<br>
            RUMUSAN KEROSAKAN PETUGAS BALUT DAN CP
      </h4>
  </div>
  <!--div class="col-xl-12 text-left">
      Nama Penyelia: Mohd Tarmizi Mohd Desa<br>
      Pkt./Blok: 2/5C 1
  </div-->

  <div class="col-xl-12 text-left">
      <span><b>Tempoh Laporan: {{$bulan_word}} {{$tahun}} - {{$bulan_akhir_word}} {{$tahun}}<b></span>
  </div>

  <div class="col-12 mt-4">
      <div class="table-responsive scrollbar">
          <table class="table table-hover table-bordered overflow-hidden" width="100%">
              <thead class="border border-dark" style="background-color: #d9d9d9;">
                  <tr>
                    <th rowspan="2">Bil</th>
                    <th rowspan="2">Pkt./Blok</th>
                    <th rowspan="2">No. Daftar</th>
                    <th rowspan="2">No. Pokok</th>
                    <th rowspan="2">Nama Pembalut</th>
                    <th colspan="3">Tarikh</th>
                    <th rowspan="2">Jenis Pollen</th>
                    <th colspan="3">Beg</th>
                    <th rowspan="2">Label</th>
                    <th rowspan="2">Jenis Kerosakan</th>
                    <th rowspan="2">Catatan</th>
                  </tr>
                  <tr>
                    <th>Balut</th>
                    <th>CP</th>
                    <th>QC</th>
                    <th>Ikatan Atas</th>
                    <th>Ikatan Bawah</th>
                    <th>Lapisan Bag</th>
                  </tr>
              </thead>
              <tbody class="border border-dark">
              <?php
                include_once("../database/Connect.php");

                $tarikh_akhir = date('Y-m-d', strtotime("+1 day", strtotime($tarikh_akhir)));

                $bil = 0;

                $q = "SELECT P.id, P.blok, P.induk, P.baka, P.progeny, P.no_pokok, P.user_id, P.catatan
                FROM pokoks P
                INNER JOIN tandans T
                ON P.id = T.pokok_id
                WHERE P.jantina = 'Motherpalm'
                AND P.created_at >= '$tahun-$bulan-01'
                AND P.created_at <= '$tahun-$bulan_akhir-31'
                AND T.no_daftar != ''
                GROUP BY P.blok";
                $result = $mysqli-> query($q);
                if ($result -> num_rows > 0)
                {
	                while($record = $result -> fetch_assoc())
	                {    
					    $pokok_id = $record['id'];
                        $blok = $record['blok'];
                        $induk = $record['induk'];
                        $baka = $record['baka'];
                        $progeny = $record['progeny'];
                        $no_pokok = $record['no_pokok'];
                        $user_id  = $record['user_id'];
                        $catatan  = $record['catatan'];

                        $sql_tandan = "SELECT *
				        FROM tandans
				        Where pokok_id  = '$pokok_id'";
                        $result_tandan = $mysqli-> query($sql_tandan);
                        if ($result_tandan -> num_rows > 0)
                        {
	                        $row_tandan = $result_tandan ->fetch_assoc();
                            $no_daftar = $row_tandan['no_daftar'];
	                        $umur_tandan = $row_tandan['umur'];
                            $kerosakans_id = $row_tandan['kerosakans_id'];
                        }

                        $sql_bagging = "SELECT *
				        FROM baggings
				        Where pokok_id  = '$pokok_id'";
                        $result_bagging = $mysqli-> query($sql_bagging);
                        if ($result_bagging -> num_rows > 0)
                        {
	                        $row_bagging = $result_bagging ->fetch_assoc();
                            $id_sv_balut = $row_bagging['id_sv_balut'];
                            $balut_created_at = date('d-m-Y', strtotime($row_bagging['created_at']));
                        }

                        $sql_cp = "SELECT *
				        FROM control_pollinations
				        Where pokok_id  = '$pokok_id'";
                        $result_cp = $mysqli-> query($sql_cp);
                        if ($result_cp -> num_rows > 0)
                        {
	                        $row_cp = $result_cp ->fetch_assoc();
                            $cp_created_at = date('d-m-Y', strtotime($row_cp['created_at']));
                        }

                        $sql_qc = "SELECT *
				        FROM quality_controls
				        Where pokok_id  = '$pokok_id'";
                        $result_qc = $mysqli-> query($sql_qc);
                        if ($result_qc -> num_rows > 0)
                        {
	                        $row_qc = $result_qc ->fetch_assoc();
                            $qc_created_at = date('d-m-Y', strtotime($row_qc['created_at']));
                        }

                        $sql_pollen = "SELECT *
				        FROM pollens
				        Where pokok_id  = '$pokok_id'";
                        $result_pollen = $mysqli-> query($sql_pollen);
                        if ($result_pollen -> num_rows > 0)
                        {
	                        $row_pollen = $result_pollen ->fetch_assoc();
                            $jenis_pollen = $row_pollen['jenis'];
                        }

                        $sql_user = "SELECT *
				                FROM users
				                Where id  = '$id_sv_balut'";
                        $result_user = $mysqli-> query($sql_user);
                        if ($result_user -> num_rows > 0)
                        {
	                        $row_user = $result_user ->fetch_assoc();
	                        $user_nama = $row_user['nama'];
                        }

                        $bil = $bil + 1;
                  ?>
                  <tr>
                    <td>{{ $bil }}</td>
                    <td>{{ $blok }}</td>
                    <td>{{ $no_daftar }}</td>
                    <td>{{ $no_pokok }}</td>
                    <td>{{ $user_nama }}</td>
                    <td>{{ $balut_created_at }}</td>
                    <td>{{ $cp_created_at }}</td>
                    <td>{{ $qc_created_at }}</td>
                    <td>{{ $jenis_pollen }}</td>
                    <td>--</td>
                    <td>--</td>
                    <td>--</td>
                    <td>--</td>
                    <td>--</td>
                    <td>{{ $catatan }}</td>
                  </tr>
                  <?php 
                  }
                  }
                  ?>
              </tbody>
          </table>
      </div>

  </div>
