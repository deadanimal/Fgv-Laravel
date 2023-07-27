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
      <h4 class="mt-5">Ladang Benih Pusat Pertanian Perkhidmatan Tun Razak</h4>
      <h6 class="mt-2">Rumusan Pencapaian Penuaian Bulanan Tandan Ladang Benih</h6>
      <h6 class="mt-2">LAPORAN 1P1F (Motherpalm)</h6>
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
                      <th rowspan="2">BAKA</th>
                      <th rowspan="2">JUMLAH MOTHERPALM</th>
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

                $bil = 0;

                $q_selection = "SELECT B.id, P.blok, P.induk, P.jantina, P.baka, P.progeny, P.no_pokok, B.catatan
                FROM baggings B
                INNER JOIN pokoks P
                ON B.pokok_id = P.id
                WHERE B.jenis = 'Balut'
                AND P.jantina = 'Motherpalm'
                AND P.baka != 'Pesifera'
                AND B.created_at >= '$tahun-$bulan-01'
                AND B.created_at <= '$tahun-$bulan_akhir-$last_day'
                GROUP BY P.blok, P.baka
                ORDER BY P.blok, P.baka";
                $result_selection = $mysqli-> query($q_selection);
                if ($result_selection -> num_rows > 0)
                {
	                while($record_selection = $result_selection -> fetch_assoc())
	                {   
						$id = $record_selection['id'];
                        $blok = $record_selection['blok'];
                        $induk = $record_selection['induk'];
                        $baka = $record_selection['baka'];
                        $progeny = $record_selection['progeny'];
                        $no_pokok = $record_selection['no_pokok'];
                        $catatan  = $record_selection['catatan'];

                        $bil = $bil + 1;

                        $sql_data_jumlah = "SELECT COUNT(B.id) As num 
                        FROM baggings B
                        INNER JOIN pokoks P
                        ON B.pokok_id = P.id
                        WHERE B.jenis = 'Balut'
                        AND P.jantina = 'Motherpalm'
                        AND P.baka = '$baka'
                        AND P.blok = '$blok'
                        AND P.baka != 'Pesifera'
                        AND B.created_at >= '$tahun-01-01'
                        AND B.created_at <= '$tahun-12-31'";
                        $result_data_jumlah = $mysqli->query($sql_data_jumlah);
                        $row_data_jumlah = $result_data_jumlah->fetch_assoc();
                        $total_data_jumlah = $row_data_jumlah['num'];

                        $sql_data_jumlah_motherpalm = "SELECT COUNT(P.id) As num 
                        FROM pokoks P
                        WHERE P.jantina = 'Motherpalm'
                        AND P.baka = '$baka'
                        AND P.blok = '$blok'
                        AND P.baka != 'Pesifera'";
                        $result_data_jumlah_motherpalm = $mysqli->query($sql_data_jumlah_motherpalm);
                        $row_data_jumlah_motherpalm = $result_data_jumlah_motherpalm->fetch_assoc();
                        $total_data_jumlah_motherpalm = $row_data_jumlah_motherpalm['num'];


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
                            AND P.jantina = 'Motherpalm'
                            AND P.baka = '$baka'
                            AND P.blok = '$blok'
                            AND P.baka != 'Pesifera'
                            AND B.created_at >= '$tahun-$i_value-01'
                            AND B.created_at <= '$tahun-$i_value-$last_day'";
                            $result_data = $mysqli->query($sql_data);
                            $row_data = $result_data->fetch_assoc();
                            $total_data = $row_data['num'];


                            if ($i == 1)
                            {
                                $bulan_1 = $total_data;
                            }
                            else
                            if ($i == 2)
                            {
                                $bulan_2 = $total_data;
                            }
                            else
                            if ($i == 3)
                            {
                                $bulan_3 = $total_data;
                            }
                            else
                            if ($i == 4)
                            {
                                $bulan_4 = $total_data;
                            }
                            else
                            if ($i == 5)
                            {
                                $bulan_5 = $total_data;
                            }
                            else
                            if ($i == 6)
                            {
                                $bulan_6 = $total_data;
                            }
                            else
                            if ($i == 7)
                            {
                                $bulan_7 = $total_data;
                            }
                            else
                            if ($i == 8)
                            {
                                $bulan_8 = $total_data;
                            }
                            else
                            if ($i == 9)
                            {
                                $bulan_9 = $total_data;
                            }
                            else
                            if ($i == 10)
                            {
                                $bulan_10 = $total_data;
                            }
                            else
                            if ($i == 11)
                            {
                                $bulan_11 = $total_data;
                            }
                            else
                            if ($i == 12)
                            {
                                $bulan_12 = $total_data;
                            }
                        }                
                        ?>
                            <tbody>
                            <tr>
                                <td>{{ $bil }}</td>
                                <td>{{ $blok }}</td>
                                <td>{{ $baka }}</td>
                                <td>{{ $total_data_jumlah_motherpalm }}</td>
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
                            </tbody>
                        <?php 
                        }
                        }
                        ?>
                      </table>
                  </div>

              </div>
