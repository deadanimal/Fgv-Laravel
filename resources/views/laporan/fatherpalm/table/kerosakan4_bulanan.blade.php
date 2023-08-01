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
      <h6 class="mt-2">Laporan Kerosakan Membalut Bunga Pisifera dan Kerosakan Sebelum dan Selepas Bunga di Tuai</h6>
  </div>

  <div class="col-xl-12 text-left">
      <span><b>Tempoh Laporan: {{$bulan_word}} {{$tahun}} - {{$bulan_akhir_word}} {{$tahun}}<b></span>
  </div>

  <div class="col-12 mt-4">
      <div class="table-responsive scrollbar">
      <font size="2px">Kerosakan Sebelum Bunga DiTuai</font>
          <table class="table table-bordered overflow-hidden" width="100%">
              <thead class="border border-dark" style="background-color: #d9d9d9;">
                  <tr>
                    <th>Blok</th>
                    <th>Jum. Pokok</th>
                    <th>Jum. Balut</th>
                    <th>Jum. Rosak</th>
                    <th>% Rosak</th>
                    <th>Kembang Awal</th>
                    <th>Beg Bocor</th>
                    <th>Bunga Mati</th>
                    <th>Lain-lain Banjir</th>
                    <th>Kembang Tak Sekata</th>
                    <th>Bunga Patah</th>
                    <th>Weevil</th>
                  </tr>
              </thead>
              <?php
              include_once("../database/Connect.php");

              $tarikh_akhir = date('Y-m-d', strtotime("+1 day", strtotime($tarikh_akhir)));

              $q_selection = "SELECT P.blok, P.baka, B.id_sv_balut, B.pokok_id
              FROM baggings B
              INNER JOIN pokoks P on B.pokok_id = P.id
              WHERE B.created_at >= '$tahun-$bulan-01'
              AND B.created_at <= '$tahun-$bulan_akhir-31'
              AND B.id_sv_balut != ''
              group by P.blok";
              $result_selection = $mysqli-> query($q_selection);
              if ($result_selection -> num_rows > 0)
              {
	              while($record_selection = $result_selection -> fetch_assoc())
	              {    
		                $user_id_selection = $record_selection['id_sv_balut'];

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
                        AND B.created_at >= '$tahun-$bulan-01'
                        AND B.created_at <= '$tahun-$bulan_akhir-31'";
                        $result_data_jumlah = $mysqli->query($sql_data_jumlah);
                        $row_data_jumlah = $result_data_jumlah->fetch_assoc();
                        $total_data_jumlah_pokok = $row_data_jumlah['num'];

                        $sql_data_jumlah_bawah = "SELECT COUNT(pokok_id) As num 
                        FROM baggings B
                        INNER JOIN pokoks P on B.pokok_id = P.id
                        WHERE  B.created_at >= '$tahun-$bulan-01'
                        AND B.created_at <= '$tahun-$bulan_akhir-31'";
                        $result_data_jumlah_bawah = $mysqli->query($sql_data_jumlah_bawah);
                        $row_data_jumlah_bawah = $result_data_jumlah_bawah->fetch_assoc();
                        $total_data_jumlah_pokok_bawah = $row_data_jumlah_bawah['num'];

                        $sql_data_jumlah_bagging = "SELECT COUNT(pokok_id) As num 
                        FROM baggings B
                        INNER JOIN pokoks P on B.pokok_id = P.id
                        WHERE  pokok_id = '$pokok_id'
                        AND B.created_at >= '$tahun-$bulan-01'
                        AND B.created_at <= '$tahun-$bulan_akhir-31'
                        AND B.pengesahan_bagging != ''";
                        $result_data_jumlah_bagging = $mysqli->query($sql_data_jumlah_bagging);
                        $row_data_jumlah_bagging = $result_data_jumlah_bagging->fetch_assoc();
                        $total_data_jumlah_bag = $row_data_jumlah_bagging['num'];

                        $sql_data_jumlah_bag_bawah = "SELECT COUNT(B.id) As num 
                        FROM baggings B
                        WHERE B.created_at >= '$tahun-$bulan-01'
                        AND B.created_at <= '$tahun-$bulan_akhir-31'
                        AND B.pengesahan_bagging != ''";
                        $result_data_jumlah_bag_bawah = $mysqli->query($sql_data_jumlah_bag_bawah);
                        $row_data_jumlah_bag_bawah = $result_data_jumlah_bag_bawah->fetch_assoc();
                        $total_data_jumlah_bag_bawah = $row_data_jumlah_bag_bawah['num'];


                        $sql_data_jumlah_rosak = "SELECT COUNT(pokok_id) As num 
                        FROM baggings B
                        INNER JOIN pokoks P on B.pokok_id = P.id
                        WHERE  pokok_id = '$pokok_id'
                        AND B.created_at >= '$tahun-$bulan-01'
                        AND B.created_at <= '$tahun-$bulan_akhir-31'
                        AND status = 'tolak'";
                        $result_data_jumlah_rosak = $mysqli->query($sql_data_jumlah_rosak);
                        $row_data_jumlah_rosak = $result_data_jumlah_rosak->fetch_assoc();
                        $total_data_jumlah_rosak = $row_data_jumlah_rosak['num'];

                        $sql_data_jumlah_rosak_bawah = "SELECT COUNT(B.id) As num 
                        FROM baggings B
                        INNER JOIN pokoks P on B.pokok_id = P.id
                        WHERE  pokok_id = '$pokok_id'
                        AND B.created_at >= '$tahun-$bulan-01'
                        AND B.created_at <= '$tahun-$bulan_akhir-31'
                        AND status = 'tolak'";
                        $result_data_jumlah_rosak_bawah = $mysqli->query($sql_data_jumlah_rosak_bawah);
                        $row_data_jumlah_rosak_bawah = $result_data_jumlah_rosak_bawah->fetch_assoc();
                        $total_data_jumlah_rosak_bawah = $row_data_jumlah_rosak_bawah['num'];

                        if ($total_data_jumlah_bag == 0)
                        {
                           $total_data_jumlah_percent_rosak = 0;
                        }
                        else
                        {
                            $total_data_jumlah_percent_rosak = number_format(($total_data_jumlah_rosak/$total_data_jumlah_bag) * 100,2);
                        }

                        $total_data_jumlah_lulus = $total_data_jumlah_bag - $total_data_jumlah_rosak;
                        $total_data_jumlah_lulus_bawah = $total_data_jumlah_bag_bawah - $total_data_jumlah_rosak_bawah;

                        if ($total_data_jumlah_bag_bawah == 0)
                        {
                           $total_data_jumlah_percent_rosak_bawah = 0;
                        }
                        else
                        {
                            $total_data_jumlah_percent_rosak_bawah = number_format(($total_data_jumlah_rosak_bawah/$total_data_jumlah_bag_bawah) * 100,2);
                        }

                        $kerosakan_id_looping = array("38", "32", "40", "37", "34", "43", "42");

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

                            if ($kerosakan_id_looping_list == '38')
                            {
                                $total_data_jumlah_kembang_awal = $total_data_jumlah_kerosakan;
                                $total_data_jumlah_kembang_awal_bawah = $total_data_jumlah_kerosakan_bawah;

                                if ($total_data_jumlah_bag_bawah == 0)
                                {
                                   $total_data_jumlah_kembang_awal_percent_bawah = 0;
                                }
                                else
                                {
                                    $total_data_jumlah_kembang_awal_percent_bawah = ($total_data_jumlah_kerosakan_bawah/$total_data_jumlah_bag_bawah) * 100;
                                }                          
                            }
                            else
                            if ($kerosakan_id_looping_list == '32')
                            {
                                $total_data_jumlah_beg_bocor = $total_data_jumlah_kerosakan;
                                $total_data_jumlah_beg_bocor_bawah = $total_data_jumlah_kerosakan_bawah;

                                if ($total_data_jumlah_bag_bawah == 0)
                                {
                                   $total_data_jumlah_beg_bocor_percent_bawah = 0;
                                }
                                else
                                {
                                    $total_data_jumlah_beg_bocor_percent_bawah = ($total_data_jumlah_kerosakan_bawah/$total_data_jumlah_bag_bawah) * 100;
                                }  
                            }
                            else
                            if ($kerosakan_id_looping_list == '40')
                            {
                                $total_data_jumlah_bunga_mati = $total_data_jumlah_kerosakan;
                                $total_data_jumlah_bunga_mati_bawah = $total_data_jumlah_kerosakan_bawah;

                                if ($total_data_jumlah_bag_bawah == 0)
                                {
                                   $total_data_jumlah_bunga_mati_percent_bawah = 0;
                                }
                                else
                                {
                                    $total_data_jumlah_bunga_mati_percent_bawah = ($total_data_jumlah_kerosakan_bawah/$total_data_jumlah_bag_bawah) * 100;
                                }
                            }
                            else
                            if ($kerosakan_id_looping_list == '37')
                            {
                                $total_data_jumlah_lain_banjir = $total_data_jumlah_kerosakan;
                                $total_data_jumlah_lain_banjir_bawah = $total_data_jumlah_kerosakan_bawah;

                                if ($total_data_jumlah_bag_bawah == 0)
                                {
                                   $total_data_jumlah_lain_banjir_percent_bawah = 0;
                                }
                                else
                                {
                                    $total_data_jumlah_lain_banjir_percent_bawah = ($total_data_jumlah_kerosakan_bawah/$total_data_jumlah_bag_bawah) * 100;
                                }
                            }
                            else
                            if ($kerosakan_id_looping_list == '34')
                            {
                                $total_data_jumlah_kembang = $total_data_jumlah_kerosakan;
                                $total_data_jumlah_kembang_bawah = $total_data_jumlah_kerosakan_bawah;

                                if ($total_data_jumlah_bag_bawah == 0)
                                {
                                   $total_data_jumlah_kembang_percent_bawah = 0;
                                }
                                else
                                {
                                    $total_data_jumlah_kembang_percent_bawah = ($total_data_jumlah_kerosakan_bawah/$total_data_jumlah_bag_bawah) * 100;
                                }
                            }
                            else
                            if ($kerosakan_id_looping_list == '43')
                            {
                                $total_data_jumlah_bunga_patah = $total_data_jumlah_kerosakan;
                                $total_data_jumlah_bunga_patah_bawah = $total_data_jumlah_kerosakan_bawah;

                                if ($total_data_jumlah_bag_bawah == 0)
                                {
                                   $total_data_jumlah_bunga_patah_percent_bawah = 0;
                                }
                                else
                                {
                                    $total_data_jumlah_bunga_patah_percent_bawah = ($total_data_jumlah_kerosakan_bawah/$total_data_jumlah_bag_bawah) * 100;
                                }
                            }
                            else
                            if ($kerosakan_id_looping_list == '42')
                            {
                                $total_data_jumlah_weevil = $total_data_jumlah_kerosakan;
                                $total_data_jumlah_weevil_bawah = $total_data_jumlah_kerosakan_bawah;

                                if ($total_data_jumlah_bag_bawah == 0)
                                {
                                   $total_data_jumlah_weevil_percent_bawah = 0;
                                }
                                else
                                {
                                    $total_data_jumlah_weevil_percent_bawah = ($total_data_jumlah_kerosakan_bawah/$total_data_jumlah_bag_bawah) * 100;
                                }
                            } 
                        }
              ?>
              <tbody class="border border-dark">
                  <tr>
                    <td>{{ $blok }}</td>
                    <td>{{ $total_data_jumlah_pokok }}</td>
                    <td>{{ $total_data_jumlah_bag }}</td>
                    <td>{{ $total_data_jumlah_rosak }}</td>
                    <td>{{ $total_data_jumlah_percent_rosak }}</td>
                    <td>{{ $total_data_jumlah_kembang_awal }}</td>
                    <td>{{ $total_data_jumlah_beg_bocor }}</td>
                    <td>{{ $total_data_jumlah_bunga_mati }}</td>
                    <td>{{ $total_data_jumlah_lain_banjir }}</td>
                    <td>{{ $total_data_jumlah_kembang }}</td>
                    <td>{{ $total_data_jumlah_bunga_patah }}</td>
                    <td>{{ $total_data_jumlah_weevil }}</td>
                  </tr>
                  <?php
                  }
              }
              ?>
                  
                  <tr style="background-color: #d9d9d9;">
                    <td><b>JUMLAH</b></td>
                    <td>{{ $total_data_jumlah_pokok_bawah }}</td>
                    <td>{{ $total_data_jumlah_bag_bawah }}</td>
                    <td>{{ $total_data_jumlah_rosak_bawah }} </td>
                    <td>{{ $total_data_jumlah_percent_rosak_bawah }}</td>
                    <td>{{ $total_data_jumlah_kembang_awal_bawah }}</td>
                    <td>{{ $total_data_jumlah_beg_bocor_bawah }}</td>
                    <td>{{ $total_data_jumlah_bunga_mati_bawah }}</td>
                    <td>{{ $total_data_jumlah_lain_banjir_bawah }}</td>
                    <td>{{ $total_data_jumlah_kembang_bawah }}</td>
                    <td>{{ $total_data_jumlah_bunga_patah_bawah }}</td>
                    <td>{{ $total_data_jumlah_weevil_bawah }}</td>
                  </tr>
              </tbody>
          </table>
      </div>
  </div>

  <div class="col-12 mt-4">
      <div class="table-responsive scrollbar">
      <font size="2px">Kerosakan Selepas Bunga DiTuai</font>
          <table class="table table-bordered overflow-hidden" width="100%">
              <thead class="border border-dark" style="background-color: #d9d9d9;">
                  <tr>
                    <th>Blok</th>
                    <th>Jum. Pokok</th>
                    <th>Jum. Balut</th>
                    <th>Jum. Rosak</th>
                    <th>% Rosak</th>
                    <th>Kembang Awal</th>
                    <th>Beg Bocor</th>
                    <th>Bunga Mati</th>
                    <th>Lain-lain Banjir</th>
                    <th>Kembang Tak Sekata</th>
                    <th>Bunga Patah</th>
                    <th>Weevil</th>
                  </tr>
              </thead>
              <?php
              include_once("../database/Connect.php");

              $tarikh_akhir = date('Y-m-d', strtotime("+1 day", strtotime($tarikh_akhir)));

              $q_selection = "SELECT P.blok, P.baka, B.id_sv_balut, B.pokok_id
              FROM baggings B
              INNER JOIN pokoks P on B.pokok_id = P.id
              WHERE B.created_at >= '$tahun-$bulan-01'
              AND B.created_at <= '$tahun-$bulan_akhir-31'
              AND B.id_sv_balut != ''
              group by P.blok";
              $result_selection = $mysqli-> query($q_selection);
              if ($result_selection -> num_rows > 0)
              {
	              while($record_selection = $result_selection -> fetch_assoc())
	              {    
		                $user_id_selection = $record_selection['id_sv_balut'];

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
                        AND B.created_at >= '$tahun-$bulan-01'
                        AND B.created_at <= '$tahun-$bulan_akhir-31'";
                        $result_data_jumlah = $mysqli->query($sql_data_jumlah);
                        $row_data_jumlah = $result_data_jumlah->fetch_assoc();
                        $total_data_jumlah_pokok = $row_data_jumlah['num'];

                        /*
                        $sql_data_jumlah_bawah = "SELECT COUNT(pokok_id) As num 
                        FROM baggings B
                        INNER JOIN pokoks P on B.pokok_id = P.id
                        WHERE  B.created_at >= '$tahun-$bulan-01'
                        AND B.created_at <= '$tahun-$bulan_akhir-31'";
                        $result_data_jumlah_bawah = $mysqli->query($sql_data_jumlah_bawah);
                        $row_data_jumlah_bawah = $result_data_jumlah_bawah->fetch_assoc();
                        $total_data_jumlah_pokok_bawah = $row_data_jumlah_bawah['num'];
                        */

                        $total_data_jumlah_pokok_bawah = $total_data_jumlah_pokok_bawah + $total_data_jumlah_pokok;

                        $sql_data_jumlah_bagging = "SELECT COUNT(pokok_id) As num 
                        FROM baggings B
                        INNER JOIN pokoks P on B.pokok_id = P.id
                        WHERE  pokok_id = '$pokok_id'
                        AND B.created_at >= '$tahun-$bulan-01'
                        AND B.created_at <= '$tahun-$bulan_akhir-31'
                        AND B.pengesahan_bagging != ''";
                        $result_data_jumlah_bagging = $mysqli->query($sql_data_jumlah_bagging);
                        $row_data_jumlah_bagging = $result_data_jumlah_bagging->fetch_assoc();
                        $total_data_jumlah_bag = $row_data_jumlah_bagging['num'];

                        $sql_data_jumlah_bag_bawah = "SELECT COUNT(B.id) As num 
                        FROM baggings B
                        WHERE B.created_at >= '$tahun-$bulan-01'
                        AND B.created_at <= '$tahun-$bulan_akhir-31'
                        AND B.pengesahan_bagging != ''";
                        $result_data_jumlah_bag_bawah = $mysqli->query($sql_data_jumlah_bag_bawah);
                        $row_data_jumlah_bag_bawah = $result_data_jumlah_bag_bawah->fetch_assoc();
                        $total_data_jumlah_bag_bawah = $row_data_jumlah_bag_bawah['num'];


                        $sql_data_jumlah_rosak = "SELECT COUNT(pokok_id) As num 
                        FROM baggings B
                        INNER JOIN pokoks P on B.pokok_id = P.id
                        WHERE  pokok_id = '$pokok_id'
                        AND B.created_at >= '$tahun-$bulan-01'
                        AND B.created_at <= '$tahun-$bulan_akhir-31'
                        AND status = 'tolak'";
                        $result_data_jumlah_rosak = $mysqli->query($sql_data_jumlah_rosak);
                        $row_data_jumlah_rosak = $result_data_jumlah_rosak->fetch_assoc();
                        $total_data_jumlah_rosak = $row_data_jumlah_rosak['num'];

                        $sql_data_jumlah_rosak_bawah = "SELECT COUNT(B.id) As num 
                        FROM baggings B
                        INNER JOIN pokoks P on B.pokok_id = P.id
                        WHERE  pokok_id = '$pokok_id'
                        AND B.created_at >= '$tahun-$bulan-01'
                        AND B.created_at <= '$tahun-$bulan_akhir-31'
                        AND status = 'tolak'";
                        $result_data_jumlah_rosak_bawah = $mysqli->query($sql_data_jumlah_rosak_bawah);
                        $row_data_jumlah_rosak_bawah = $result_data_jumlah_rosak_bawah->fetch_assoc();
                        $total_data_jumlah_rosak_bawah = $row_data_jumlah_rosak_bawah['num'];

                        if ($total_data_jumlah_bag == 0)
                        {
                           $total_data_jumlah_percent_rosak = 0;
                        }
                        else
                        {
                            $total_data_jumlah_percent_rosak = number_format(($total_data_jumlah_rosak/$total_data_jumlah_bag) * 100,2);
                        }

                        $total_data_jumlah_lulus = $total_data_jumlah_bag - $total_data_jumlah_rosak;
                        $total_data_jumlah_lulus_bawah = $total_data_jumlah_bag_bawah - $total_data_jumlah_rosak_bawah;

                        if ($total_data_jumlah_bag_bawah == 0)
                        {
                           $total_data_jumlah_percent_rosak_bawah = 0;
                        }
                        else
                        {
                            $total_data_jumlah_percent_rosak_bawah = number_format(($total_data_jumlah_rosak_bawah/$total_data_jumlah_bag_bawah) * 100,2);
                        }

                        $kerosakan_id_looping = array("38", "32", "40", "37", "34", "43", "42");

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

                            if ($kerosakan_id_looping_list == '38')
                            {
                                $total_data_jumlah_kembang_awal = $total_data_jumlah_kerosakan;
                                $total_data_jumlah_kembang_awal_bawah = $total_data_jumlah_kerosakan_bawah;

                                if ($total_data_jumlah_bag_bawah == 0)
                                {
                                   $total_data_jumlah_kembang_awal_percent_bawah = 0;
                                }
                                else
                                {
                                    $total_data_jumlah_kembang_awal_percent_bawah = ($total_data_jumlah_kerosakan_bawah/$total_data_jumlah_bag_bawah) * 100;
                                }                          
                            }
                            else
                            if ($kerosakan_id_looping_list == '32')
                            {
                                $total_data_jumlah_beg_bocor = $total_data_jumlah_kerosakan;
                                $total_data_jumlah_beg_bocor_bawah = $total_data_jumlah_kerosakan_bawah;

                                if ($total_data_jumlah_bag_bawah == 0)
                                {
                                   $total_data_jumlah_beg_bocor_percent_bawah = 0;
                                }
                                else
                                {
                                    $total_data_jumlah_beg_bocor_percent_bawah = ($total_data_jumlah_kerosakan_bawah/$total_data_jumlah_bag_bawah) * 100;
                                }  
                            }
                            else
                            if ($kerosakan_id_looping_list == '40')
                            {
                                $total_data_jumlah_bunga_mati = $total_data_jumlah_kerosakan;
                                $total_data_jumlah_bunga_mati_bawah = $total_data_jumlah_kerosakan_bawah;

                                if ($total_data_jumlah_bag_bawah == 0)
                                {
                                   $total_data_jumlah_bunga_mati_percent_bawah = 0;
                                }
                                else
                                {
                                    $total_data_jumlah_bunga_mati_percent_bawah = ($total_data_jumlah_kerosakan_bawah/$total_data_jumlah_bag_bawah) * 100;
                                }
                            }
                            else
                            if ($kerosakan_id_looping_list == '37')
                            {
                                $total_data_jumlah_lain_banjir = $total_data_jumlah_kerosakan;
                                $total_data_jumlah_lain_banjir_bawah = $total_data_jumlah_kerosakan_bawah;

                                if ($total_data_jumlah_bag_bawah == 0)
                                {
                                   $total_data_jumlah_lain_banjir_percent_bawah = 0;
                                }
                                else
                                {
                                    $total_data_jumlah_lain_banjir_percent_bawah = ($total_data_jumlah_kerosakan_bawah/$total_data_jumlah_bag_bawah) * 100;
                                }
                            }
                            else
                            if ($kerosakan_id_looping_list == '34')
                            {
                                $total_data_jumlah_kembang = $total_data_jumlah_kerosakan;
                                $total_data_jumlah_kembang_bawah = $total_data_jumlah_kerosakan_bawah;

                                if ($total_data_jumlah_bag_bawah == 0)
                                {
                                   $total_data_jumlah_kembang_percent_bawah = 0;
                                }
                                else
                                {
                                    $total_data_jumlah_kembang_percent_bawah = ($total_data_jumlah_kerosakan_bawah/$total_data_jumlah_bag_bawah) * 100;
                                }
                            }
                            else
                            if ($kerosakan_id_looping_list == '43')
                            {
                                $total_data_jumlah_bunga_patah = $total_data_jumlah_kerosakan;
                                $total_data_jumlah_bunga_patah_bawah = $total_data_jumlah_kerosakan_bawah;

                                if ($total_data_jumlah_bag_bawah == 0)
                                {
                                   $total_data_jumlah_bunga_patah_percent_bawah = 0;
                                }
                                else
                                {
                                    $total_data_jumlah_bunga_patah_percent_bawah = ($total_data_jumlah_kerosakan_bawah/$total_data_jumlah_bag_bawah) * 100;
                                }
                            }
                            else
                            if ($kerosakan_id_looping_list == '42')
                            {
                                $total_data_jumlah_weevil = $total_data_jumlah_kerosakan;
                                $total_data_jumlah_weevil_bawah = $total_data_jumlah_kerosakan_bawah;

                                if ($total_data_jumlah_bag_bawah == 0)
                                {
                                   $total_data_jumlah_weevil_percent_bawah = 0;
                                }
                                else
                                {
                                    $total_data_jumlah_weevil_percent_bawah = ($total_data_jumlah_kerosakan_bawah/$total_data_jumlah_bag_bawah) * 100;
                                }
                            } 
                        }
              ?>
              <tbody class="border border-dark">
                  <tr>
                    <td>{{ $blok }}</td>
                    <td>{{ $total_data_jumlah_pokok }}</td>
                    <td>{{ $total_data_jumlah_bag }}</td>
                    <td>{{ $total_data_jumlah_rosak }}</td>
                    <td>{{ $total_data_jumlah_percent_rosak }}</td>
                    <td>{{ $total_data_jumlah_kembang_awal }}</td>
                    <td>{{ $total_data_jumlah_beg_bocor }}</td>
                    <td>{{ $total_data_jumlah_bunga_mati }}</td>
                    <td>{{ $total_data_jumlah_lain_banjir }}</td>
                    <td>{{ $total_data_jumlah_kembang }}</td>
                    <td>{{ $total_data_jumlah_bunga_patah }}</td>
                    <td>{{ $total_data_jumlah_weevil }}</td>
                  </tr>
                  <?php
                  }
              }
              ?>
                  
                  <tr style="background-color: #d9d9d9;">
                    <td><b>JUMLAH</b></td>
                    <td>{{ $total_data_jumlah_pokok_bawah }}</td>
                    <td>{{ $total_data_jumlah_bag_bawah }}</td>
                    <td>{{ $total_data_jumlah_rosak_bawah }} </td>
                    <td>{{ $total_data_jumlah_percent_rosak_bawah }}</td>
                    <td>{{ $total_data_jumlah_kembang_awal_bawah }}</td>
                    <td>{{ $total_data_jumlah_beg_bocor_bawah }}</td>
                    <td>{{ $total_data_jumlah_bunga_mati_bawah }}</td>
                    <td>{{ $total_data_jumlah_lain_banjir_bawah }}</td>
                    <td>{{ $total_data_jumlah_kembang_bawah }}</td>
                    <td>{{ $total_data_jumlah_bunga_patah_bawah }}</td>
                    <td>{{ $total_data_jumlah_weevil_bawah }}</td>
                  </tr>
              </tbody>
          </table>
      </div>
  </div>
