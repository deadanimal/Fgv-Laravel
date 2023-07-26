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
      <h4 class="mt-2">LAPORAN BULANAN BALUT (BAGGING)</h4>
  </div>
  <div class="col-xl-12 text-left">
      <span><b>Tempoh Laporan: {{$bulan_word}} {{$tahun}} - {{$bulan_akhir_word}} {{$tahun}}<b></span>
  </div>
  <div class="col-12 mt-4">
      <div class="table-responsive scrollbar">
          <table class="table table-bordered overflow-hidden" width="100%">
              <thead class="border border-dark" style="background-color: #d9d9d9;">
                  <tr>
                      <th rowspan="2">PENYELIA</th>
                      <th rowspan="2">BLOK</th>
                      <th rowspan="2">BAKA</th>
                      <th colspan="12">BULAN</th>
                      <th rowspan="2">Jumlah</th>
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
              <?php
                include_once("../database/Connect.php");

                $tarikh_akhir = date('Y-m-d', strtotime("+1 day", strtotime($tarikh_akhir)));

                if ($bulan_akhir == '01')
                {
                    $last_day = '31';
                }
                else
                if ($bulan_akhir == '02')
                {
                    $last_day = '28';
                }
                else
                if ($bulan_akhir == '03')
                {
                    $last_day = '31';
                }
                else
                if ($bulan_akhir == '04')
                {
                    $last_day = '30';
                }
                else
                if ($bulan_akhir == '05')
                {
                    $last_day = '31';
                }
                else
                if ($bulan_akhir == '06')
                {
                    $last_day = '30';
                }
                else
                if ($bulan_akhir == '07')
                {
                    $last_day = '31';
                }
                else
                if ($bulan_akhir == '08')
                {
                    $last_day = '31';
                }
                else
                if ($bulan_akhir == '09')
                {
                    $last_day = '30';
                }
                else
                if ($bulan_akhir == '10')
                {
                    $last_day = '31';
                }
                else
                if ($bulan_akhir == '11')
                {
                    $last_day = '30';
                }
                else
                if ($bulan_akhir == '12')
                {
                    $last_day = '31';
                }

                $q_selection = "SELECT *
                FROM baggings
                WHERE created_at >= '$tahun-$bulan-01'
                AND created_at <= '$tahun-$bulan_akhir-$last_day'
                GROUP By pengesah_id";
                $result_selection = $mysqli-> query($q_selection);
                if ($result_selection -> num_rows > 0)
                {
	                while($record_selection = $result_selection -> fetch_assoc())
	                {    
						$user_id_selection = $record_selection['pengesah_id'];
                        $pokok_id = $record_selection['pokok_id'];

                        ?>
                          <tbody class="border border-dark">
                          <?php
                          $q = "SELECT *
                               FROM users
                               WHERE id = '$user_id_selection'";
                            $result = $mysqli-> query($q);
                            if ($result -> num_rows > 0)
                            {
	                            while($record = $result -> fetch_assoc())
	                            {    
						            $id = $record['id'];
                                    $list_of_bloks = $record['blok'];

                                    $specificCharacter = ',';
                                    $outputString = str_replace($specificCharacter, "'" . $specificCharacter, $list_of_bloks);
                                    $characterToReplace = ',';
                                    $newString = str_replace($characterToReplace, $characterToReplace."'", $outputString);
                                    $newString = "'" . $newString . "'";
                               
                                    $q = "SELECT *
                                    FROM pokoks
                                    WHERE blok IN ($newString)
                                    group by blok, baka";
                                    $result = $mysqli-> query($q);
                                    if ($result -> num_rows > 0)
                                    {
	                                    while($record = $result -> fetch_assoc())
	                                    {    
						                    $id = $record['id'];
                                            $blok = $record['blok'];
                                            $induk = $record['induk'];
                                            $baka = $record['baka'];
                                            $progeny = $record['progeny'];
                                            $no_pokok = $record['no_pokok'];
                                            $catatan  = $record['catatan'];

                                            $sql_user = "SELECT *
				                                        FROM users
				                                        Where id  = '$user_id_selection'";
                                            $result_user = $mysqli-> query($sql_user);
                                            if ($result_user -> num_rows > 0)
                                            {
	                                            $row_user = $result_user ->fetch_assoc();
	                                            $user_nama = $row_user['nama'];
                                            }

                                            $sql_data_jumlah = "SELECT COUNT(B.id) As num 
                                            FROM baggings B
                                            INNER JOIN pokoks P
                                            ON B.pokok_id = P.id
                                            WHERE B.jenis = 'Balut'
                                            AND B.pengesah_id = '$user_id_selection'
                                            AND P.jantina = 'Motherpalm'
                                            AND P.baka = '$baka'
                                            AND P.blok = '$blok'
                                            AND P.baka != 'Pesifera'
                                            AND B.created_at >= '$tahun-01-01'
                                            AND B.created_at <= '$tahun-12-31'";
                                            $result_data_jumlah = $mysqli->query($sql_data_jumlah);
                                            $row_data_jumlah = $result_data_jumlah->fetch_assoc();
                                            $total_data_jumlah = $row_data_jumlah['num'];

                                            $sql_data_jumlah_bawah_all = "SELECT COUNT(B.id) As num 
                                            FROM baggings B
                                            INNER JOIN pokoks P
                                            ON B.pokok_id = P.id
                                            WHERE B.jenis = 'Balut'
                                            AND B.pengesah_id = '$user_id_selection'
                                            AND P.jantina = 'Motherpalm'
                                            AND P.baka != 'Pesifera'
                                            AND B.created_at >= '$tahun-01-01'
                                            AND B.created_at <= '$tahun-12-31'";
                                            $result_data_jumlah_bawah_all = $mysqli->query($sql_data_jumlah_bawah_all);
                                            $row_data_jumlah_bawah_all = $result_data_jumlah_bawah_all->fetch_assoc();
                                            $total_data_jumlah_bawah_all = $row_data_jumlah_bawah_all['num'];

                                            for ($i = 1; $i <= 12; $i++)
                                            {
                                                if ($i == 1)
                                                {
                                                    $i_value = '01';
                                                    $last_day = '31';
                                                }
                                                else
                                                if ($i == 2)
                                                {
                                                    $i_value = '02';
                                                    $last_day = '28';
                                                }
                                                else
                                                if ($i == 3)
                                                {
                                                    $i_value = '03';
                                                    $last_day = '31';
                                                }
                                                else
                                                if ($i == 4)
                                                {
                                                    $i_value = '04';
                                                    $last_day = '30';
                                                }
                                                else
                                                if ($i == 5)
                                                {
                                                    $i_value = '05';
                                                    $last_day = '31';
                                                }
                                                else
                                                if ($i == 6)
                                                {
                                                    $i_value = '06';
                                                    $last_day = '30';
                                                }
                                                else
                                                if ($i == 7)
                                                {
                                                    $i_value = '07';
                                                    $last_day = '31';
                                                }
                                                else
                                                if ($i == 8)
                                                {
                                                    $i_value = '08';
                                                    $last_day = '31';
                                                }
                                                else
                                                if ($i == 9)
                                                {
                                                    $i_value = '09';
                                                    $last_day = '30';
                                                }
                                                else
                                                if ($i == 10)
                                                {
                                                    $i_value = '10';
                                                    $last_day = '31';
                                                }
                                                else
                                                if ($i == 11)
                                                {
                                                    $i_value = '11';
                                                    $last_day = '30';
                                                }
                                                else
                                                if ($i == 12)
                                                {
                                                    $i_value = '12';
                                                    $last_day = '31';
                                                }
                                                else
                                                {
                                                    $i_value = $i;
                                                }

                                                $day = "31";
                                                $tarikh_akhir_value = date('Y-m-d', strtotime("+1 day", strtotime($tahun-$i_value-$day)));

                                                $sql_data = "SELECT COUNT(B.id) As num 
                                                FROM baggings B
                                                INNER JOIN pokoks P
                                                ON B.pokok_id = P.id
                                                WHERE B.jenis = 'Balut'
                                                AND B.pengesah_id = '$user_id_selection'
                                                AND P.jantina = 'Motherpalm'
                                                AND P.baka = '$baka'
                                                AND P.blok = '$blok'
                                                AND P.baka != 'Pesifera'
                                                AND B.created_at >= '$tahun-$i_value-01'
                                                AND B.created_at <= '$tahun-$i_value-$last_day'";
                                                $result_data = $mysqli->query($sql_data);
                                                $row_data = $result_data->fetch_assoc();
                                                $total_data = $row_data['num'];

                                                $sql_data_jumlah_bawah = "SELECT COUNT(B.id) As num 
                                                FROM baggings B
                                                INNER JOIN pokoks P
                                                ON B.pokok_id = P.id
                                                WHERE B.jenis = 'Balut'
                                                AND B.pengesah_id = '$user_id_selection'
                                                AND P.jantina = 'Motherpalm'
                                                AND P.baka != 'Pesifera'
                                                AND B.created_at >= '$tahun-$i_value-01'
                                                AND B.created_at <= '$tahun-$i_value-$last_day'";
                                                $result_data_jumlah_bawah = $mysqli->query($sql_data_jumlah_bawah);
                                                $row_data_jumlah_bawah = $result_data_jumlah_bawah->fetch_assoc();
                                                $total_data_jumlah_bawah = $row_data_jumlah_bawah['num'];

                                                if ($i == 1)
                                                {
                                                    $bulan_1 = $total_data;
                                                    $bulan_1_bawah = $total_data_jumlah_bawah;
                                                }
                                                else
                                                if ($i == 2)
                                                {
                                                    $bulan_2 = $total_data;
                                                    $bulan_2_bawah = $total_data_jumlah_bawah;
                                                }
                                                else
                                                if ($i == 3)
                                                {
                                                    $bulan_3 = $total_data;
                                                    $bulan_3_bawah = $total_data_jumlah_bawah;
                                                }
                                                else
                                                if ($i == 4)
                                                {
                                                    $bulan_4 = $total_data;
                                                    $bulan_4_bawah = $total_data_jumlah_bawah;
                                                }
                                                else
                                                if ($i == 5)
                                                {
                                                    $bulan_5 = $total_data;
                                                    $bulan_5_bawah = $total_data_jumlah_bawah;
                                                }
                                                else
                                                if ($i == 6)
                                                {
                                                    $bulan_6 = $total_data;
                                                    $bulan_6_bawah = $total_data_jumlah_bawah;
                                                }
                                                else
                                                if ($i == 7)
                                                {
                                                    $bulan_7 = $total_data;
                                                    $bulan_7_bawah = $total_data_jumlah_bawah;
                                                }
                                                else
                                                if ($i == 8)
                                                {
                                                    $bulan_8 = $total_data;
                                                    $bulan_8_bawah = $total_data_jumlah_bawah;
                                                }
                                                else
                                                if ($i == 9)
                                                {
                                                    $bulan_9 = $total_data;
                                                    $bulan_9_bawah = $total_data_jumlah_bawah;
                                                }
                                                else
                                                if ($i == 10)
                                                {
                                                    $bulan_10 = $total_data;
                                                    $bulan_10_bawah = $total_data_jumlah_bawah;
                                                }
                                                else
                                                if ($i == 11)
                                                {
                                                    $bulan_11 = $total_data;
                                                    $bulan_11_bawah = $total_data_jumlah_bawah;
                                                }
                                                else
                                                if ($i == 12)
                                                {
                                                    $bulan_12 = $total_data;
                                                    $bulan_12_bawah = $total_data_jumlah_bawah;
                                                }
                                            }
                                    ?>
                                      <tr>
                                          <td>{{ $user_nama }}</td>
                                          <td>{{ $blok }}</td>
                                          <td>{{ $baka }}</td>
                                          <td>{{ $bulan_1 }}</td>
                                          <td>{{ $bulan_2 }}</td>
                                          <td>{{ $bulan_3 }}</td>
                                          <td>{{ $bulan_4 }}</td>
                                          <td>{{ $bulan_5 }}</td>
                                          <td>{{ $bulan_6 }}</td>
                                          <td>{{ $bulan_7 }}</td>
                                          <td>{{ $bulan_8 }}</td>
                                          <td>{{ $bulan_9 }}</td>
                                          <td>{{ $bulan_10 }}</td>
                                          <td>{{ $bulan_11 }}</td>
                                          <td>{{ $bulan_12 }}</td>
                                          <td>{{ $total_data_jumlah }}</td>
                                      </tr>
                                  <?php 
                                    }
                                    }
                                    }
                                    ?>
                              <thead class="border border-dark" style="background-color: #d9d9d9;">
                                  <td></td>
                                  <td></td>
                                  <td>Jumlah</td>
                                  <td>{{ $bulan_1_bawah }}</td>
                                  <td>{{ $bulan_2_bawah }}</td>
                                  <td>{{ $bulan_3_bawah }}</td>
                                  <td>{{ $bulan_4_bawah }}</td>
                                  <td>{{ $bulan_5_bawah }}</td>
                                  <td>{{ $bulan_6_bawah }}</td>
                                  <td>{{ $bulan_7_bawah }}</td>
                                  <td>{{ $bulan_8_bawah }}</td>
                                  <td>{{ $bulan_9_bawah }}</td>
                                  <td>{{ $bulan_10_bawah }}</td>
                                  <td>{{ $bulan_11_bawah }}</td>
                                  <td>{{ $bulan_12_bawah }}</td>
                                  <td>{{ $total_data_jumlah_bawah_all }}</td>
                              </thead>
                          </tbody>
                          <?php 
                            }
                            }
                            }
                           ?>
          </table>
      </div>

  </div>
