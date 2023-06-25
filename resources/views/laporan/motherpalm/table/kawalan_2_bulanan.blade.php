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
  <div class="col-xl-12 text-left">
      <span><b>Tempoh Laporan: {{$bulan_word}} {{$tahun}} - {{$bulan_akhir_word}} {{$tahun}}<b></span>
  </div>
  <div class="col-12 mt-4">
      <div class="table-responsive scrollbar">
    <?php
    include_once("../database/Connect.php");

    $tarikh_akhir = date('Y-m-d', strtotime("+1 day", strtotime($tarikh_akhir)));

    $q_selection = "SELECT P.blok, P.baka, B.id_sv_balut, B.pokok_id
    FROM baggings B
    INNER JOIN pokoks P on B.pokok_id = P.id
    WHERE B.created_at >= '$tahun-$bulan-01'
    AND B.created_at <= '$tahun-$bulan_akhir-31'
    AND B.id_sv_balut != ''
    group by B.id_sv_balut";
    $result_selection = $mysqli-> query($q_selection);
    if ($result_selection -> num_rows > 0)
    {
	    while($record_selection = $result_selection -> fetch_assoc())
	    {    
		    $user_id_selection = $record_selection['id_sv_balut'];
        ?>
          <table class="table table-hover table-bordered overflow-hidden" width="100%">
              <thead class="border border-dark" style="background-color: #d9d9d9;">
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
            <?php
                    $q = "SELECT P.blok, P.baka, B.id_sv_balut, B.pokok_id, B.tandan_id, B.catatan
                    FROM baggings B
                    INNER JOIN pokoks P on B.pokok_id = P.id
                    WHERE  id_sv_balut = '$user_id_selection'
                    AND B.created_at >= '$tahun-$bulan-01'
                    AND B.created_at <= '$tahun-$bulan_akhir-31'
                    group by B.pokok_id";
                    $result = $mysqli-> query($q);
                    if ($result -> num_rows > 0)
                    {
	                    while($record = $result -> fetch_assoc())
	                    {    
						    $pokok_id = $record['pokok_id'];
                            $tandan_id = $record['tandan_id'];
                            $blok = $record['blok'];
                            $baka = $record['baka'];
                            $catatan = $record['catatan'];

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
                            AND B.created_at >= '$tahun-$bulan-01'
                            AND B.created_at <= '$tahun-$bulan_akhir-31'";
                            $result_data_jumlah = $mysqli->query($sql_data_jumlah);
                            $row_data_jumlah = $result_data_jumlah->fetch_assoc();
                            $total_data_jumlah_bag = $row_data_jumlah['num'];

                            $sql_data_jumlah_bag_bawah = "SELECT COUNT(B.id) As num 
                            FROM baggings B
                            WHERE B.created_at >= '$tahun-$bulan-01'
                            AND B.created_at <= '$tahun-$bulan_akhir-31'
                            AND B.id_sv_balut = $user_id_selection";
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

                            $total_data_jumlah_lulus = $total_data_jumlah_bag - $total_data_jumlah_rosak;
                            $total_data_jumlah_lulus_bawah = $total_data_jumlah_bag_bawah - $total_data_jumlah_rosak_bawah;

                            $total_data_jumlah_percent_rosak = number_format(($total_data_jumlah_rosak/$total_data_jumlah_bag) * 100,2);
                            $total_data_jumlah_percent_rosak_bawah = number_format(($total_data_jumlah_rosak_bawah/$total_data_jumlah_bag_bawah) * 100,2);

                            $kerosakan_id_looping = array("30", "31", "32", "38", "39", "40", "41", "33", "42", "34", "43", "35", "36", "37");

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

                                if ($kerosakan_id_looping_list == '30')
                                {
                                    $total_data_jumlah_anai = $total_data_jumlah_kerosakan;
                                    $total_data_jumlah_anai_bawah = $total_data_jumlah_kerosakan_bawah;
                                    $total_data_jumlah_anai_percent_bawah = ($total_data_jumlah_kerosakan_bawah/$total_data_jumlah_bag_bawah) * 100;
                                }
                                else
                                if ($kerosakan_id_looping_list == '31')
                                {
                                    $total_data_jumlah_tikus = $total_data_jumlah_kerosakan;
                                    $total_data_jumlah_tikus_bawah = $total_data_jumlah_kerosakan_bawah;
                                    $total_data_jumlah_tikus_percent_bawah = ($total_data_jumlah_kerosakan_bawah/$total_data_jumlah_bag_bawah) * 100;
                                }
                                else
                                if ($kerosakan_id_looping_list == '32')
                                {
                                    $total_data_jumlah_beg_pecah = $total_data_jumlah_kerosakan;
                                    $total_data_jumlah_beg_pecah_bawah = $total_data_jumlah_kerosakan_bawah;
                                    $total_data_jumlah_beg_pecah_percent_bawah = ($total_data_jumlah_kerosakan_bawah/$total_data_jumlah_bag_bawah) * 100;
                                }
                                else
                                if ($kerosakan_id_looping_list == '38')
                                {
                                    $total_data_jumlah_bawah_kemas = $total_data_jumlah_kerosakan;
                                    $total_data_jumlah_bawah_kemas_bawah = $total_data_jumlah_kerosakan_bawah;
                                    $total_data_jumlah_bawah_kemas_percent_bawah = ($total_data_jumlah_kerosakan_bawah/$total_data_jumlah_bag_bawah) * 100;
                                }
                                else
                                if ($kerosakan_id_looping_list == '39')
                                {
                                    $total_data_jumlah_atas_kemas = $total_data_jumlah_kerosakan;
                                    $total_data_jumlah_atas_kemas_bawah = $total_data_jumlah_kerosakan_bawah;
                                    $total_data_jumlah_atas_kemas_percent_bawah = ($total_data_jumlah_kerosakan_bawah/$total_data_jumlah_bag_bawah) * 100;
                                }
                                else
                                if ($kerosakan_id_looping_list == '40')
                                {
                                    $total_data_jumlah_bunga_mati = $total_data_jumlah_kerosakan;
                                    $total_data_jumlah_bunga_mati_bawah = $total_data_jumlah_kerosakan_bawah;
                                    $total_data_jumlah_bunga_mati_percent_bawah = ($total_data_jumlah_kerosakan_bawah/$total_data_jumlah_bag_bawah) * 100;
                                }
                                else
                                if ($kerosakan_id_looping_list == '41')
                                {
                                    $total_data_jumlah_atas_bunga = $total_data_jumlah_kerosakan;
                                    $total_data_jumlah_atas_bunga_bawah = $total_data_jumlah_kerosakan_bawah;
                                    $total_data_jumlah_atas_bunga_percent_bawah = ($total_data_jumlah_kerosakan_bawah/$total_data_jumlah_bag_bawah) * 100;
                                }
                                else
                                if ($kerosakan_id_looping_list == '33')
                                {
                                    $total_data_jumlah_patah = $total_data_jumlah_kerosakan;
                                    $total_data_jumlah_patah_bawah = $total_data_jumlah_kerosakan_bawah;
                                    $total_data_jumlah_patah_percent_bawah = ($total_data_jumlah_kerosakan_bawah/$total_data_jumlah_bag_bawah) * 100;
                                }
                                else
                                if ($kerosakan_id_looping_list == '42')
                                {
                                    $total_data_jumlah_masa_cp = $total_data_jumlah_kerosakan;
                                    $total_data_jumlah_masa_cp_bawah = $total_data_jumlah_kerosakan_bawah;
                                    $total_data_jumlah_masa_cp_percent_bawah = ($total_data_jumlah_kerosakan_bawah/$total_data_jumlah_bag_bawah) * 100;
                                }
                                else
                                if ($kerosakan_id_looping_list == '34')
                                {
                                    $total_data_jumlah_kembang_tak_sekata = $total_data_jumlah_kerosakan;
                                    $total_data_jumlah_kembang_tak_sekata_bawah = $total_data_jumlah_kerosakan_bawah;
                                    $total_data_jumlah_kembang_tak_sekata_percent_bawah = ($total_data_jumlah_kerosakan_bawah/$total_data_jumlah_bag_bawah) * 100;
                                }
                                else
                                if ($kerosakan_id_looping_list == '43')
                                {
                                    $total_data_jumlah_bunga_tak_cp = $total_data_jumlah_kerosakan;
                                    $total_data_jumlah_bunga_tak_cp_bawah = $total_data_jumlah_kerosakan_bawah;
                                    $total_data_jumlah_bunga_tak_cp_percent_bawah = ($total_data_jumlah_kerosakan_bawah/$total_data_jumlah_bag_bawah) * 100;
                                }
                                else
                                if ($kerosakan_id_looping_list == '35')
                                {
                                    $total_data_jumlah_serangan_haiwan = $total_data_jumlah_kerosakan;
                                    $total_data_jumlah_serangan_haiwan_bawah = $total_data_jumlah_kerosakan_bawah;
                                    $total_data_jumlah_serangan_haiwan_percent_bawah = ($total_data_jumlah_kerosakan_bawah/$total_data_jumlah_bag_bawah) * 100;
                                }
                                else
                                if ($kerosakan_id_looping_list == '36')
                                {
                                    $total_data_jumlah_sambang = $total_data_jumlah_kerosakan;
                                    $total_data_jumlah_sambang_bawah = $total_data_jumlah_kerosakan_bawah;
                                    $total_data_jumlah_sambang_percent_bawah = ($total_data_jumlah_kerosakan_bawah/$total_data_jumlah_bag_bawah) * 100;
                                }
                                else
                                if ($kerosakan_id_looping_list == '37')
                                {
                                    $total_data_jumlah_tenggelam_banjir = $total_data_jumlah_kerosakan;
                                    $total_data_jumlah_tenggelam_banjir_bawah = $total_data_jumlah_kerosakan_bawah;
                                    $total_data_jumlah_tenggelam_banjir_percent_bawah = ($total_data_jumlah_kerosakan_bawah/$total_data_jumlah_bag_bawah) * 100;
                                }
                            }
                    ?>
                  <tr>
                    <td>{{ $user_nama }}</td>
                    <td>{{ $blok }}</td>
                    <td>{{ $baka }}</td>
                    <td>{{ $total_data_jumlah_bag }}</td>
                    <td>{{ $total_data_jumlah_rosak }}</td>
                    <td>{{ $total_data_jumlah_lulus }}</td>
                    <td>{{ $total_data_jumlah_percent_rosak }}</td>
                    <td>{{ $total_data_jumlah_anai }}</td>
                    <td>{{ $total_data_jumlah_tikus }}</td>
                    <td>{{ $total_data_jumlah_beg_pecah }}</td>
                    <td>{{ $total_data_jumlah_bawah_kemas }}</td>
                    <td>{{ $total_data_jumlah_atas_kemas }}</td>
                    <td>{{ $total_data_jumlah_bunga_mati }}</td>
                    <td>{{ $total_data_jumlah_atas_bunga }}</td>
                    <td>{{ $total_data_jumlah_patah }}</td>
                    <td>{{ $total_data_jumlah_masa_cp }}</td>
                    <td>{{ $total_data_jumlah_kembang_tak_sekata }}</td>
                    <td>{{ $total_data_jumlah_bunga_tak_cp }}</td>
                    <td>{{ $total_data_jumlah_serangan_haiwan }}</td>
                    <td>{{ $total_data_jumlah_sambang }}</td>
                    <td>{{ $total_data_jumlah_tenggelam_banjir }}</td>
                    <td>{{ $catatan }}</td>
                  </tr>
                  <?php 
                  }
                  }
                  ?>
                  <tr>
                    <td colspan="3"><b>Jumlah</b></td>
                    <td>{{ $total_data_jumlah_bag_bawah }}</td>
                    <td>{{ $total_data_jumlah_rosak_bawah }}</td>
                    <td>{{ $total_data_jumlah_lulus_bawah }}</td>
                    <td>{{ $total_data_jumlah_percent_rosak_bawah }}</td>
                    <td>{{ $total_data_jumlah_anai_bawah }}</td>
                    <td>{{ $total_data_jumlah_tikus_bawah }}</td>
                    <td>{{ $total_data_jumlah_beg_pecah_bawah }}</td>
                    <td>{{ $total_data_jumlah_bawah_kemas_bawah }}</td>
                    <td>{{ $total_data_jumlah_atas_kemas_bawah }}</td>
                    <td>{{ $total_data_jumlah_bunga_mati_bawah }}</td>
                    <td>{{ $total_data_jumlah_atas_bunga_bawah }}</td>
                    <td>{{ $total_data_jumlah_patah_bawah }}</td>
                    <td>{{ $total_data_jumlah_masa_cp_bawah }}</td>
                    <td>{{ $total_data_jumlah_kembang_tak_sekata_bawah }}</td>
                    <td>{{ $total_data_jumlah_bunga_tak_cp_bawah }}</td>
                    <td>{{ $total_data_jumlah_serangan_haiwan_bawah }}</td>
                    <td>{{ $total_data_jumlah_sambang_bawah }}</td>
                    <td>{{ $total_data_jumlah_tenggelam_banjir_bawah }}</td>
                    <td></td>
                  </tr>
                  <tr>
                    <td colspan="3"><b>Peratus</b></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>{{ $total_data_jumlah_anai_percent_bawah }}</td>
                    <td>{{ $total_data_jumlah_tikus_percent_bawah }}</td>
                    <td>{{ $total_data_jumlah_beg_pecah_percent_bawah }}</td>
                    <td>{{ $total_data_jumlah_bawah_kemas_percent_bawah }}</td>
                    <td>{{ $total_data_jumlah_atas_kemas_percent_bawah }}</td>
                    <td>{{ $total_data_jumlah_bunga_mati_percent_bawah }}</td>
                    <td>{{ $total_data_jumlah_atas_bunga_percent_bawah }}</td>
                    <td>{{ $total_data_jumlah_patah_percent_bawah }}</td>
                    <td>{{ $total_data_jumlah_masa_cp_percent_bawah }}</td>
                    <td>{{ $total_data_jumlah_kembang_tak_sekata_percent_bawah }}</td>
                    <td>{{ $total_data_jumlah_bunga_tak_cp_percent_bawah }}</td>
                    <td>{{ $total_data_jumlah_serangan_haiwan_percent_bawah }}</td>
                    <td>{{ $total_data_jumlah_sambang_percent_bawah }}</td>
                    <td>{{ $total_data_jumlah_tenggelam_banjir_percent_bawah }}</td>
                    <td></td>
                  </tr>                
              </tbody>
          </table>
      <?php 
      }
      }
      ?>
      </div>

  </div>
