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
      <h6 class="mt-2">REKOD PROGRESS MEMBALUT & TUAI BAGI BUNGA PISIFERA LADANG BENIH</h6>
  </div>
  <div class="col-xl-12 text-left">
      <span><b>Tempoh Laporan: {{$tarikh_mula_word}} - {{$tarikh_akhir_word}}<b></span>
  </div>
  <div class="col-12 mt-4">
      <div class="table-responsive scrollbar">
          <table class="table table-bordered overflow-hidden" width="100%">
              <thead class="border border-dark" style="background-color: #d9d9d9;">
                  <tr>
                    <th rowspan="2">TARIKH</th>
                    <th rowspan="2">(BALUT) JUM. JAMBAK</th>
                    <th colspan="6">JENIS KEROSAKAN</th>
                    <th rowspan="2">(TUAI) JUM.JAMBAK</th>
                    <th>JENIS KEROSAKAN</th>
                    <th rowspan="2">JUM. POLLEN (gram)</th>
                    <th rowspan="2">CATITAN</th>
                  </tr>
                  <tr>
                    <th colspan="6">SEBELUM TUAI</th>
                    <th>SELEPAS TUAI</th>
                  </tr>
                  <tr>
                    <td></td>
                    <td></td>
                    <td>PATAH TIKUS</td>
                    <td>KEMBANG TAK SEKATA</td>
                    <td>BEG PECAH TIKUS</td>
                    <td>BUNGA MATI BANJIR</td>
                    <td>ANAI-ANAI</td>
                    <td>LAIN-LAIN SEMUT</td>
                    <td></td>
                    <td>WEEVIL</td>
                    <td></td>
                    <td></td>
                  </tr>
              </thead>
              <?php
              include_once("../database/Connect.php");

              $tarikh_akhir = date('Y-m-d', strtotime("+1 day", strtotime($tarikh_akhir)));

              $q_selection = "SELECT P.blok, P.baka, B.id_sv_balut, B.pokok_id, B.created_at, DATE(B.created_at) DateOnly, B.catatan
              FROM baggings B
              INNER JOIN pokoks P on B.pokok_id = P.id
              WHERE B.created_at >= '$tarikh_mula'
              AND B.created_at <= '$tarikh_akhir'
              AND B.id_sv_balut != ''
              group by DateOnly Asc";
              $result_selection = $mysqli-> query($q_selection);
              if ($result_selection -> num_rows > 0)
              {
	              while($record_selection = $result_selection -> fetch_assoc())
	              {    
		                $user_id_selection = $record_selection['id_sv_balut'];
                        $created_at = date('d.m.Y', strtotime($record_selection['created_at']));
                        $created_at_value = $record_selection['DateOnly'];
                        $pokok_id = $record_selection['pokok_id'];
                        $tandan_id = $record_selection['tandan_id'];
                        $blok = $record_selection['blok'];
                        $baka = $record_selection['baka'];
                        $catatan = $record_selection['catatan'];

                        $sql_user = "SELECT *
				                    FROM users
				                    Where id  = '$user_id_selection'";
                        $result_user = $mysqli-> query($sql_user);
                        if ($result_user -> num_rows > 0)
                        {
	                        $row_user = $result_user ->fetch_assoc();
	                        $user_nama = $row_user['nama'];
                        }

                        $sql_data_jumlah = "SELECT COUNT(pokok_id) As num 
                        FROM baggings B
                        INNER JOIN pokoks P on B.pokok_id = P.id
                        WHERE  pokok_id = '$pokok_id'
                        AND P.blok = '$blok'
                        AND jenis = 'Balut'
                        AND B.created_at Like '$created_at_value%'";
                        $result_data_jumlah = $mysqli->query($sql_data_jumlah);
                        $row_data_jumlah = $result_data_jumlah->fetch_assoc();
                        $total_data_jumlah_balut = $row_data_jumlah['num'];

                        $total_data_jumlah_balut_bawah = $total_data_jumlah_balut_bawah + $total_data_jumlah_balut;

                        $sql_data_jumlah_tuai = "SELECT COUNT(pokok_id) As num 
                        FROM baggings B
                        INNER JOIN pokoks P on B.pokok_id = P.id
                        WHERE  pokok_id = '$pokok_id'
                        AND P.blok = '$blok'
                        AND jenis = 'Tuai'
                        AND B.created_at Like '$created_at_value%'";
                        $result_data_jumlah_tuai = $mysqli->query($sql_data_jumlah_tuai);
                        $row_data_jumlah_tuai = $result_data_jumlah_tuai->fetch_assoc();
                        $total_data_jumlah_tuai = $row_data_jumlah_tuai['num'];

                        $total_data_jumlah_tuai_bawah = $total_data_jumlah_tuai_bawah + $total_data_jumlah_tuai;

                        $sql_pollen = "SELECT *
				                       FROM pollens
				                       Where pokok_id  = '$pokok_id'
                                       AND tandan_id = '$tandan_id' ";
                        $result_pollen = $mysqli-> query($sql_pollen);
                        if ($result_pollen -> num_rows > 0)
                        {
	                        $row_pollen = $result_pollen ->fetch_assoc();
	                        $berat_pollen = $row_pollen['berat_pollen'];
                        }

                        $sql_data_harvest = "SELECT SUM(jumlah_tandan) As num 
                        FROM harvests
                        Where pokok_id  = '$pokok_id'
                        AND tandan_id = '$tandan_id'";
                        $result_data_harvest = $mysqli->query($sql_data_harvest);
                        $row_data_harvest = $result_data_harvest->fetch_assoc();
                        $total_jumlah_tandan = $row_data_harvest['num'];

                        $total_jumlah_tandan_bawah = $total_jumlah_tandan_bawah + $total_jumlah_tandan;

                        $berat_pollen_bawah = $berat_pollen_bawah + $berat_pollen;

                        

                        $kerosakan_id_looping = array("33", "34", "32", "40", "30", "44", "42");

                        foreach ($kerosakan_id_looping as $kerosakan_id_looping_list) 
		                {
                            $sql_data_jumlah_kerosakan = "SELECT COUNT(id) As num 
                            FROM harvests
                            WHERE pokok_id = '$pokok_id'
                            AND tandan_id  = '$tandan_id'
                            AND kerosakan_id = '$kerosakan_id_looping_list'";
                            $result_data_jumlah_kerosakan= $mysqli->query($sql_data_jumlah_kerosakan);
                            $row_data_jumlah_kerosakan = $result_data_jumlah_kerosakan->fetch_assoc();
                            $total_data_jumlah_kerosakan = $row_data_jumlah_kerosakan['num'];

                            $sql_data_jumlah_kerosakan_bawah = "SELECT COUNT(id) As num 
                            FROM harvests
                            WHERE pokok_id = '$pokok_id'
                            AND tandan_id  = '$tandan_id'
                            AND kerosakan_id = '$kerosakan_id_looping_list'";
                            $result_data_jumlah_kerosakan_bawah = $mysqli->query($sql_data_jumlah_kerosakan_bawah);
                            $row_data_jumlah_kerosakan_bawah = $result_data_jumlah_kerosakan_bawah ->fetch_assoc();
                            $total_data_jumlah_kerosakan_bawah = $row_data_jumlah_kerosakan_bawah['num'];

                            if ($kerosakan_id_looping_list == '33')
                            {
                                $total_data_jumlah_patah_tikus = $total_data_jumlah_kerosakan;
                                $total_data_jumlah_patah_tikus_bawah = $total_data_jumlah_patah_tikus_bawah + $total_data_jumlah_patah_tikus;
                                
                            }
                            else
                            if ($kerosakan_id_looping_list == '34')
                            {
                                $total_data_jumlah_kembang = $total_data_jumlah_kerosakan;
                                $total_data_jumlah_kembang_bawah = $total_data_jumlah_kembang_bawah + $total_data_jumlah_kembang;
                            }
                            else
                            if ($kerosakan_id_looping_list == '32')
                            {
                                $total_data_jumlah_beg_pecah = $total_data_jumlah_kerosakan;
                                $total_data_jumlah_beg_pecah_bawah = $total_data_jumlah_beg_pecah_bawah + $total_data_jumlah_beg_pecah;
                            }
                            else
                            if ($kerosakan_id_looping_list == '40')
                            {
                                $total_data_jumlah_bunga_mati = $total_data_jumlah_kerosakan;
                                $total_data_jumlah_bunga_mati_bawah = $total_data_jumlah_bunga_mati_bawah + $total_data_jumlah_bunga_mati;
                            }
                            else
                            if ($kerosakan_id_looping_list == '30')
                            {
                                $total_data_jumlah_anai_anai = $total_data_jumlah_kerosakan;
                                $total_data_jumlah_anai_anai_bawah = $total_data_jumlah_anai_anai_bawah + $total_data_jumlah_anai_anai;
                            }
                            else
                            if ($kerosakan_id_looping_list == '44')
                            {
                                $total_data_jumlah_lain_lain = $total_data_jumlah_kerosakan;
                                $total_data_jumlah_lain_lain_bawah = $total_data_jumlah_lain_lain_bawah + $total_data_jumlah_lain_lain;
                            }
                            else
                            if ($kerosakan_id_looping_list == '42')
                            {
                                $total_data_jumlah_weevil = $total_data_jumlah_kerosakan;
                                $total_data_jumlah_weevil_bawah = $total_data_jumlah_weevil_bawah + $total_data_jumlah_weevil;
                            }
                        }
                        ?>
              <tbody class="border border-dark">
                  <tr>
                    <td>{{ $created_at }}</td>
                    <td>{{ $total_data_jumlah_balut }}</td>
                    <td>{{ $total_data_jumlah_patah_tikus }}</td>
                    <td>{{ $total_data_jumlah_kembang }}</td>
                    <td>{{ $total_data_jumlah_beg_pecah }}</td>
                    <td>{{ $total_data_jumlah_bunga_mati }}</td>
                    <td>{{ $total_data_jumlah_anai_anai }}</td>
                    <td>{{ $total_data_jumlah_lain_lain }}</td>
                    <td>{{ $total_data_jumlah_tuai }}</td>
                    <td>{{ $total_data_jumlah_weevil }}</td>
                    <td>{{ $berat_pollen }}</td>
                    <td>{{ $catatan }}</td>
                  </tr>
                  <?php
                  }
              }
              ?>
                  <tr style="background-color: #d9d9d9;">
                    <td>JUMlAH</td>
                    <td>{{ $total_data_jumlah_balut_bawah }}</td>
                    <td>{{ $total_data_jumlah_patah_tikus_bawah }}</td>
                    <td>{{ $total_data_jumlah_kembang_bawah }}</td>
                    <td>{{ $total_data_jumlah_beg_pecah_bawah }}</td>
                    <td>{{ $total_data_jumlah_bunga_mati_bawah }}</td>
                    <td>{{ $total_data_jumlah_anai_anai_bawah }}</td>
                    <td>{{ $total_data_jumlah_lain_lain_bawah }}</td>
                    <td>{{ $total_data_jumlah_tuai_bawah }}</td>
                    <td>{{ $total_data_jumlah_weevil_bawah }}</td>
                    <td>{{ $berat_pollen_bawah }}</td>
                    <td></td>
                  </tr>    
              </tbody>
          </table>
      </div>

  </div>
