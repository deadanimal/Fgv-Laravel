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
      <h4 class="mt-2">Ladang Benih Pusat Pertanian Perkhidmatan Tun Razak</h64>
      <h4 class="mt-2">Rumusan Bulanan Jenis Kerosakan</h4>
  </div>
  <div class="col-xl-12 text-left">
      <span><b>Tempoh Laporan: {{$bulan_word}} {{$tahun}} - {{$bulan_akhir_word}} {{$tahun}}<b></span>
  </div>

  <div class="col-12 mt-4">
      <div class="table-responsive scrollbar">

        <?php
        include_once("../database/Connect.php");

        $tarikh_akhir = date('Y-m-d', strtotime("+1 day", strtotime($tarikh_akhir)));

        $q_selection = "SELECT *
        FROM harvests
        WHERE created_at >= '$tahun-$bulan-01'
        AND created_at <= '$tahun-$bulan_akhir-31'
        AND kerosakan_id != ''
        GROUP By pengesah_id";
        $result_selection = $mysqli-> query($q_selection);
        if ($result_selection -> num_rows > 0)
        {
	        while($record_selection = $result_selection -> fetch_assoc())
	        {    
				$user_id_selection = $record_selection['pengesah_id'];
                $kerosakan_id = $record_selection['kerosakan_id'];

                $sql_user = "SELECT *
				            FROM users
				            Where id  = '$user_id_selection'";
                $result_user = $mysqli-> query($sql_user);
                if ($result_user -> num_rows > 0)
                {
	                $row_user = $result_user ->fetch_assoc();
	                $user_nama = $row_user['nama'];
                }
          ?>
          <table class="table table-bordered overflow-hidden" width="100%">
               <thead class="border border-dark" style="background-color: #d9d9d9;">
                  <tr>
                    <th rowspan="2">PENYELIA</th>
                    <th rowspan="2">BLOK</th>
                    <th rowspan="2">JUMLAH BALUT</th>
                    <th colspan="5">FAKTOR MANUSIA</th>
                    <th colspan="7">FAKTOR ALAM</th>
                    <th rowspan="2">JUMLAH ROSAK</th>
                    <th rowspan="2">PERATUS ROSAK</th>
                  </tr>
                  <tr>
                    <th>BUNGA MATI</th>
                    <th>IKAT ATAS BUNGA</th>
                    <th>KEMBANG AWAL</th>
                    <th>WEEVIL</th>
                    <th>TIDAK CP</th>
                    <th>TIKUS</th>
                    <th>BERUK</th>
                    <th>BEG PECAH</th>
                    <th>SEMUT</th>
                    <th>DURI</th>
                    <th>KEMBANG TIDAK SEKATA</th>
                    <th>LAIN-LAIN</th>
                  </tr>
                </thead>
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

                        $q_info = "SELECT *
                        FROM pokoks
                        WHERE blok IN ($newString)
                        AND baka != 'Pesifera'
                        group by blok";
                        $result_info = $mysqli-> query($q_info);
                        if ($result_info -> num_rows > 0)
                        {
	                        while($record_info = $result_info -> fetch_assoc())
	                        {    
				                $pokok_id = $record_info['id'];
                                $blok = $record_info['blok'];
                                $created_at = date('d-m-Y', strtotime($record_info['created_at']));
                                $status = $record_info['status'];

                                $sql_bagging = "SELECT COUNT(id) As num 
				                FROM baggings
				                Where pokok_id = '$pokok_id'";
                                $result_bagging = $mysqli-> query($sql_bagging);
                                if ($result_bagging -> num_rows > 0)
                                {
	                                $row_bagging = $result_bagging ->fetch_assoc();
                                    $jumlah_balut = $row_bagging['num'];
                                }

                                $kerosakan_id_looping = array("40", "41", "48", "42", "43", "31", "35", "32", "49", "50", "34", "44");

                                foreach ($kerosakan_id_looping as $kerosakan_id_looping_list) 
		                        {
                                    if ($kerosakan_id_looping_list == $kerosakan_id)
                                    {
                                        $sql_count_kerosakan = "SELECT COUNT(H.id) As num
                                                                FROM harvests H
				                                                Inner Join kerosakans K
                                                                On H.kerosakan_id = K.id
                                                                Inner Join pokoks P
                                                                On H.pokok_id = P.id
                                                                WHERE P.blok = '$blok'
				                                                AND K.id  = '$kerosakan_id_looping_list'";
                                        $result_count_kerosakan = $mysqli-> query($sql_count_kerosakan);
                                        if ($result_count_kerosakan -> num_rows > 0)
                                        {
	                                        $row_count_kerosakan = $result_count_kerosakan ->fetch_assoc();
                                            $num_kerosakan = $row_count_kerosakan['num'];
                                        }

                                        if ($kerosakan_id_looping_list == '40') //BUNGA MATI
                                        {
                                            $kerosakan_count_bunga_mati = $num_kerosakan;
                                        }
                                        else
                                        if ($kerosakan_id_looping_list == '41') //IKAT ATAS BUNGA
                                        {
                                            $kerosakan_count_ikat_atas_bunga = $num_kerosakan;
                                        }
                                        else
                                        if ($kerosakan_id_looping_list == '48') //KEMBANG AWAL
                                        {
                                            $kerosakan_count_kembang_awal = $num_kerosakan;
                                        }
                                        else
                                        if ($kerosakan_id_looping_list == '42') //WEEVIL
                                        {
                                            $kerosakan_count_weevil = $num_kerosakan;
                                        }
                                        else
                                        if ($kerosakan_id_looping_list == '43') //TIDAK CP
                                        {
                                            $kerosakan_count_tidak_cp = $num_kerosakan;
                                        }
                                        else
                                        if ($kerosakan_id_looping_list == '31') //Tikus
                                        {
                                            $kerosakan_count_tikus = $num_kerosakan;
                                        }
                                        else
                                        if ($kerosakan_id_looping_list == '35') //BERUK
                                        {
                                            $kerosakan_count_beruk = $num_kerosakan;
                                        }
                                        else
                                        if ($kerosakan_id_looping_list == '32') //BEG PECAH
                                        {
                                            $kerosakan_count_beg_pecah = $num_kerosakan;
                                        }
                                        else
                                        if ($kerosakan_id_looping_list == '49') //SEMUT
                                        {
                                            $kerosakan_count_semut = $num_kerosakan;
                                        }
                                        else
                                        if ($kerosakan_id_looping_list == '50') //DURI
                                        {
                                            $kerosakan_count_duri = $num_kerosakan;
                                        }
                                        else
                                        if ($kerosakan_id_looping_list == '34') //KEMBANG TIDAK SEKATA
                                        {
                                            $kerosakan_count_kembang_tidak_sekata = $num_kerosakan;
                                        }
                                        else
                                        if ($kerosakan_id_looping_list == '44') //LAIN-LAIN
                                        {
                                            $kerosakan_count_lain = $num_kerosakan;
                                        } 
                                    }
                                }

                                if ($kerosakan_count_bunga_mati == "") {$kerosakan_count_bunga_mati = 0;}
                                if ($kerosakan_count_ikat_atas_bunga == "") {$kerosakan_count_ikat_atas_bunga = 0;}
                                if ($kerosakan_count_kembang_awal == "") {$kerosakan_count_kembang_awal = 0;}
                                if ($kerosakan_count_weevil == "") {$kerosakan_count_weevil = 0;}
                                if ($kerosakan_count_tidak_cp == "") {$kerosakan_count_tidak_cp = 0;}
                                if ($kerosakan_count_tikus == "") {$kerosakan_count_tikus = 0;}
                                if ($kerosakan_count_beruk == "") {$kerosakan_count_beruk = 0;}
                                if ($kerosakan_count_beg_pecah == "") {$kerosakan_count_beg_pecah = 0;}
                                if ($kerosakan_count_semut == "") {$kerosakan_count_semut = 0;}
                                if ($kerosakan_count_duri == "") {$kerosakan_count_duri = 0;}
                                if ($kerosakan_count_kembang_tidak_sekata == "") {$kerosakan_count_kembang_tidak_sekata = 0;}
                                if ($kerosakan_count_lain == "") {$kerosakan_count_lain = 0;}

                                $jumlah_rosak = $kerosakan_count_bunga_mati + $kerosakan_count_ikat_atas_bunga + $kerosakan_count_kembang_awal + $kerosakan_count_weevil + $kerosakan_count_tidak_cp + $kerosakan_count_tikus + $kerosakan_count_beruk + $kerosakan_count_beg_pecah + $kerosakan_count_semut +  $kerosakan_count_duri + $kerosakan_count_kembang_tidak_sekata + $kerosakan_count_lain;

                                if ($jumlah_rosak != '0' && $jumlah_balut != '0')
                                {
                                    $peratus_rosak = ($jumlah_rosak / $jumlah_balut) * 100;
                                    $peratus_rosak = number_format($peratus_rosak,2);
                                }
                                else
                                {
                                    $peratus_rosak = 0.00;
                                }
                        

                                /*
                                $sql_kerosakan = "SELECT *
				                                  FROM kerosakans
				                                  Where id  = '$kerosakan_id'";
                                $result_kerosakan = $mysqli-> query($sql_kerosakan);
                                if ($result_kerosakan -> num_rows > 0)
                                {
	                                $row_kerosakan = $result_kerosakan ->fetch_assoc();
                                    $nama_kerosakan = $row_kerosakan['nama'];
                                }
                                */
                ?>
                  <tr>
                    <td>{{ $user_nama }}</td>
                    <td>{{ $blok }}</td>
                    <td>{{ $jumlah_balut }}</td>
                    <td>{{ $kerosakan_count_bunga_mati }}</td><!-- BUNGA MATI -->
                    <td>{{ $kerosakan_count_ikat_atas_bunga }}</td><!-- IKAT ATAS BUNGA -->
                    <td>{{ $kerosakan_count_kembang_awal }}</td><!-- KEMBANG AWAL -->
                    <td>{{ $kerosakan_count_weevil }}</td><!-- WEEVIL -->
                    <td>{{ $kerosakan_count_tidak_cp }}</td><!-- TIDAK CP -->
                    <td>{{ $kerosakan_count_tikus }}</td><!-- TIKUS -->
                    <td>{{ $kerosakan_count_beruk }}</td><!-- BERUK -->
                    <td>{{ $kerosakan_count_beg_pecah }}</td><!-- BEG PECAH -->
                    <td>{{ $kerosakan_count_semut }}</td><!-- SEMUT -->
					<td>{{ $kerosakan_count_duri }}</td><!-- DURI -->
                    <td>{{ $kerosakan_count_kembang_tidak_sekata }}</td><!-- KEMBANG TIDAK SEKATA -->
                    <td>{{ $kerosakan_count_lain }}</td><!-- LAIN-LAIN -->
                    <td>{{ $jumlah_rosak }}</td>
                    <td>{{ $peratus_rosak }}%</td>
                  </tr>
                  <?php
                  }
                  }
                  }
                  ?>
                </tbody>
          </table>
          <?php
          }
          }
          }
          ?>
      </div>
  </div>
