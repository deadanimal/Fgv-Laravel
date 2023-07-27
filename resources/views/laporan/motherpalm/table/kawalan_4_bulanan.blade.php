
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
      UNIT BAHAN TANAMAN<br>
      LAPORAN KAWALAN KUALITI MEMBALUT DAN PENDEBUNGAAN TERKAWAL LADANG BENIH<br>
      Rumusan Kerosakan Keseluruhan Tahun {{ $tahun }}
      </h4>
  </div>
  <div class="col-xl-12 text-left">
      <span><b>Tempoh Laporan: {{$bulan_word}} {{$tahun}} - {{$bulan_akhir_word}} {{$tahun}}<b></span>
  </div>
  <div class="col-12 mt-4">
      <div class="table-responsive scrollbar">
          <table class="table table-hover table-bordered overflow-hidden" width="100%">
              <thead class="border border-dark" style="background-color: #d9d9d9;">
                  <tr>
                      <th rowspan="3">Bulan</th>
                      <th colspan="14">JENIS KEROSAKAN</th>
                      <th rowspan="3">Jumlah Periksa</th>
                      <th rowspan="3">Jumlah Rosak</th>
                      <th rowspan="3">Jumlah Lulus</th>
                      <th rowspan="3">Peratus Rosak</th>
                      <th rowspan="3">Jumlah Rosak Faktor Manusia</th>
                      <th rowspan="3">Peratus Rosak Faktor Manusia</th>
                      <th rowspan="3">Jumlah Rosak Faktor Alam</th>
                      <th rowspan="3">Peratus Rosak Faktor Alam</th>
                  </tr>
                  <tr>
                      <th colspan="7">Faktor Manusia</th>
                      <th colspan="7">Faktor Alam</th>
                  </tr>
                  <tr>
                      <td>Patah</td>
                      <td>Tikus</td>
                      <td>Bag Pecah</td>
                      <td>Kembang Tak Sekata</td>
                      <td>Anai-Anai</td>
                      <td>Bunga Mati</td>
                      <td>Tenggelam Banjir</td>
                      <td>Bunga Mati</td>
                      <td>Masuk Masa CP</td>
                      <td>I.Bawah T.Kemas</td>
                      <td>Bunga Tak CP</td>
                      <td>Serangan Haiwan</td>
                      <td>Sambang</td>
                      <td>I.Atas T.Kemas</td>
                  </tr>
              </thead>
              <tbody class="border border-dark">

              <?php
                include_once("../database/Connect.php");

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

                    $sql_data_jumlah_Patah = "SELECT COUNT(QC.id) As num 
                    FROM quality_controls QC
                    INNER JOIN kerosakans K
                    ON QC.kerosakan_id = K.id
                    WHERE K.faktor = 'Manusia'
                    AND K.nama = 'Patah'
                    AND QC.created_at >= '$tahun-$i_value-01'
                    AND QC.created_at <= '$tahun-$i_value-$last_day'";
                    $result_data_jumlah_Patah = $mysqli->query($sql_data_jumlah_Patah);
                    $row_data_jumlah_Patah = $result_data_jumlah_Patah->fetch_assoc();
                    $total_data_jumlah_Patah = $row_data_jumlah_Patah['num'];

                    $sql_data_jumlah_Tikus = "SELECT COUNT(QC.id) As num 
                    FROM quality_controls QC
                    INNER JOIN kerosakans K
                    ON QC.kerosakan_id = K.id
                    WHERE K.faktor = 'Manusia'
                    AND K.nama = 'Tikus'
                    AND QC.created_at >= '$tahun-$i_value-01'
                    AND QC.created_at <= '$tahun-$i_value-$last_day'";
                    $result_data_jumlah_Tikus = $mysqli->query($sql_data_jumlah_Tikus);
                    $row_data_jumlah_Tikus = $result_data_jumlah_Tikus->fetch_assoc();
                    $total_data_jumlah_Tikus = $row_data_jumlah_Tikus['num'];

                    $sql_data_jumlah_Beg_Pecah = "SELECT COUNT(QC.id) As num 
                    FROM quality_controls QC
                    INNER JOIN kerosakans K
                    ON QC.kerosakan_id = K.id
                    WHERE K.faktor = 'Manusia'
                    AND K.nama = 'Beg Pecah'
                    AND QC.created_at >= '$tahun-$i_value-01'
                    AND QC.created_at <= '$tahun-$i_value-$last_day'";
                    $result_data_jumlah_Beg_Pecah = $mysqli->query($sql_data_jumlah_Beg_Pecah);
                    $row_data_jumlah_Beg_Pecah = $result_data_jumlah_Beg_Pecah->fetch_assoc();
                    $total_data_jumlah_Beg_Pecah = $row_data_jumlah_Beg_Pecah['num'];

                    $sql_data_jumlah_KembangTidakSekata = "SELECT COUNT(QC.id) As num 
                    FROM quality_controls QC
                    INNER JOIN kerosakans K
                    ON QC.kerosakan_id = K.id
                    WHERE K.faktor = 'Manusia'
                    AND K.nama = 'Kembang Tidak Sekata'
                    AND QC.created_at >= '$tahun-$i_value-01'
                    AND QC.created_at <= '$tahun-$i_value-$last_day'";
                    $result_data_jumlah_KembangTidakSekata = $mysqli->query($sql_data_jumlah_KembangTidakSekata);
                    $row_data_jumlah_KembangTidakSekata = $result_data_jumlah_KembangTidakSekata->fetch_assoc();
                    $total_data_jumlah_KembangTidakSekata = $row_data_jumlah_KembangTidakSekata['num'];

                    $sql_data_jumlah_Anai = "SELECT COUNT(QC.id) As num 
                    FROM quality_controls QC
                    INNER JOIN kerosakans K
                    ON QC.kerosakan_id = K.id
                    WHERE K.faktor = 'Manusia'
                    AND K.nama = 'Anai - anai'
                    AND QC.created_at >= '$tahun-$i_value-01'
                    AND QC.created_at <= '$tahun-$i_value-$last_day'";
                    $result_data_jumlah_Anai = $mysqli->query($sql_data_jumlah_Anai);
                    $row_data_jumlah_Anai = $result_data_jumlah_Anai->fetch_assoc();
                    $total_data_jumlah_Anai = $row_data_jumlah_Anai['num'];

                    $sql_data_jumlah_BungaMati = "SELECT COUNT(QC.id) As num 
                    FROM quality_controls QC
                    INNER JOIN kerosakans K
                    ON QC.kerosakan_id = K.id
                    WHERE K.faktor = 'Manusia'
                    AND K.nama = 'Bunga Mati'
                    AND QC.created_at >= '$tahun-$i_value-01'
                    AND QC.created_at <= '$tahun-$i_value-$last_day'";
                    $result_data_jumlah_BungaMati = $mysqli->query($sql_data_jumlah_BungaMati);
                    $row_data_jumlah_BungaMati = $result_data_jumlah_BungaMati->fetch_assoc();
                    $total_data_jumlah_BungaMati = $row_data_jumlah_BungaMati['num'];

                    $sql_data_jumlah_TenggelamBanjir = "SELECT COUNT(QC.id) As num 
                    FROM quality_controls QC
                    INNER JOIN kerosakans K
                    ON QC.kerosakan_id = K.id
                    WHERE K.faktor = 'Manusia'
                    AND K.nama = 'Tenggelam Banjir'
                    AND QC.created_at >= '$tahun-$i_value-01'
                    AND QC.created_at <= '$tahun-$i_value-$last_day'";
                    $result_data_jumlah_TenggelamBanjir = $mysqli->query($sql_data_jumlah_TenggelamBanjir);
                    $row_data_jumlah_TenggelamBanjir = $result_data_jumlah_TenggelamBanjir->fetch_assoc();
                    $total_data_jumlah_TenggelamBanjir = $row_data_jumlah_TenggelamBanjir['num'];

                    $sql_data_jumlah_BungaMatiAlam = "SELECT COUNT(QC.id) As num 
                    FROM quality_controls QC
                    INNER JOIN kerosakans K
                    ON QC.kerosakan_id = K.id
                    WHERE K.faktor = 'Alam'
                    AND K.nama = 'Bunga Mati'
                    AND QC.created_at >= '$tahun-$i_value-01'
                    AND QC.created_at <= '$tahun-$i_value-$last_day'";
                    $result_data_jumlah_BungaMatiAlam = $mysqli->query($sql_data_jumlah_BungaMatiAlam);
                    $row_data_jumlah_BungaMatiAlam = $result_data_jumlah_BungaMatiAlam->fetch_assoc();
                    $total_data_jumlah_BungaMatiAlam = $row_data_jumlah_BungaMatiAlam['num'];

                    $sql_data_jumlah_MasukMasaCP = "SELECT COUNT(QC.id) As num 
                    FROM quality_controls QC
                    INNER JOIN kerosakans K
                    ON QC.kerosakan_id = K.id
                    WHERE K.faktor = 'Alam'
                    AND K.nama = 'Masuk Masa CP'
                    AND QC.created_at >= '$tahun-$i_value-01'
                    AND QC.created_at <= '$tahun-$i_value-$last_day'";
                    $result_data_jumlah_MasukMasaCP = $mysqli->query($sql_data_jumlah_MasukMasaCP);
                    $row_data_jumlah_MasukMasaCP = $result_data_jumlah_MasukMasaCP->fetch_assoc();
                    $total_data_jumlah_MasukMasaCP = $row_data_jumlah_MasukMasaCP['num'];

                    $sql_data_jumlah_BawahTKemas = "SELECT COUNT(QC.id) As num 
                    FROM quality_controls QC
                    INNER JOIN kerosakans K
                    ON QC.kerosakan_id = K.id
                    WHERE K.faktor = 'Alam'
                    AND K.nama = 'I.Bawah T.Kemas'
                    AND QC.created_at >= '$tahun-$i_value-01'
                    AND QC.created_at <= '$tahun-$i_value-$last_day'";
                    $result_data_jumlah_BawahTKemas = $mysqli->query($sql_data_jumlah_BawahTKemas);
                    $row_data_jumlah_BawahTKemas = $result_data_jumlah_BawahTKemas->fetch_assoc();
                    $total_data_jumlah_BawahTKemas = $row_data_jumlah_BawahTKemas['num'];

                    $sql_data_jumlah_BungaTakCP = "SELECT COUNT(QC.id) As num 
                    FROM quality_controls QC
                    INNER JOIN kerosakans K
                    ON QC.kerosakan_id = K.id
                    WHERE K.faktor = 'Alam'
                    AND K.nama = 'Bunga Tak CP'
                    AND QC.created_at >= '$tahun-$i_value-01'
                    AND QC.created_at <= '$tahun-$i_value-$last_day'";
                    $result_data_jumlah_BungaTakCP = $mysqli->query($sql_data_jumlah_BungaTakCP);
                    $row_data_jumlah_BungaTakCP = $result_data_jumlah_BungaTakCP->fetch_assoc();
                    $total_data_jumlah_BungaTakCP = $row_data_jumlah_BungaTakCP['num'];

                    $sql_data_jumlah_SeranganHaiwan = "SELECT COUNT(QC.id) As num 
                    FROM quality_controls QC
                    INNER JOIN kerosakans K
                    ON QC.kerosakan_id = K.id
                    WHERE K.faktor = 'Alam'
                    AND K.nama = 'Serangan Haiwan'
                    AND QC.created_at >= '$tahun-$i_value-01'
                    AND QC.created_at <= '$tahun-$i_value-$last_day'";
                    $result_data_jumlah_SeranganHaiwan = $mysqli->query($sql_data_jumlah_SeranganHaiwan);
                    $row_data_jumlah_SeranganHaiwan = $result_data_jumlah_SeranganHaiwan->fetch_assoc();
                    $total_data_jumlah_SeranganHaiwan = $row_data_jumlah_SeranganHaiwan['num'];

                    $sql_data_jumlah_Sambang = "SELECT COUNT(QC.id) As num 
                    FROM quality_controls QC
                    INNER JOIN kerosakans K
                    ON QC.kerosakan_id = K.id
                    WHERE K.faktor = 'Alam'
                    AND K.nama = 'Sambang'
                    AND QC.created_at >= '$tahun-$i_value-01'
                    AND QC.created_at <= '$tahun-$i_value-$last_day'";
                    $result_data_jumlah_Sambang = $mysqli->query($sql_data_jumlah_Sambang);
                    $row_data_jumlah_Sambang = $result_data_jumlah_Sambang->fetch_assoc();
                    $total_data_jumlah_Sambang = $row_data_jumlah_Sambang['num'];

                    $sql_data_jumlah_AtasTKemas = "SELECT COUNT(QC.id) As num 
                    FROM quality_controls QC
                    INNER JOIN kerosakans K
                    ON QC.kerosakan_id = K.id
                    WHERE K.faktor = 'Alam'
                    AND K.nama = 'I.Atas T.Kemas'
                    AND QC.created_at >= '$tahun-$i_value-01'
                    AND QC.created_at <= '$tahun-$i_value-$last_day'";
                    $result_data_jumlah_AtasTKemas = $mysqli->query($sql_data_jumlah_AtasTKemas);
                    $row_data_jumlah_AtasTKemas = $result_data_jumlah_AtasTKemas->fetch_assoc();
                    $total_data_jumlah_AtasTKemas = $row_data_jumlah_AtasTKemas['num'];

                    $sql_data_jumlah_JumlahPeriksa = "SELECT Count(QC.id) As num 
                    FROM baggings QC
                    WHERE status = 'sah'
                    AND QC.created_at >= '$tahun-$i_value-01'
                    AND QC.created_at <= '$tahun-$i_value-$last_day'";
                    $result_data_jumlah_JumlahPeriksa = $mysqli->query($sql_data_jumlah_JumlahPeriksa);
                    $row_data_jumlah_JumlahPeriksa = $result_data_jumlah_JumlahPeriksa->fetch_assoc();
                    $total_data_jumlah_JumlahPeriksa = $row_data_jumlah_JumlahPeriksa['num'];

                    $sql_data_jumlah_JumlahRosak = "SELECT Count(QC.id) As num 
                    FROM quality_controls QC
                    WHERE kerosakan_id IS NOT NULL
                    AND QC.created_at >= '$tahun-$i_value-01'
                    AND QC.created_at <= '$tahun-$i_value-$last_day'";
                    $result_data_jumlah_JumlahRosak = $mysqli->query($sql_data_jumlah_JumlahRosak);
                    $row_data_jumlah_JumlahRosak = $result_data_jumlah_JumlahRosak->fetch_assoc();
                    $total_data_jumlah_JumlahRosak = $row_data_jumlah_JumlahRosak['num'];

                    $sql_data_jumlah_FaktorManusia = "SELECT COUNT(QC.id) As num 
                    FROM quality_controls QC
                    INNER JOIN kerosakans K
                    ON QC.kerosakan_id = K.id
                    WHERE K.faktor = 'Manusia'
                    AND QC.created_at >= '$tahun-$i_value-01'
                    AND QC.created_at <= '$tahun-$i_value-$last_day'";
                    $result_data_jumlah_FaktorManusia = $mysqli->query($sql_data_jumlah_FaktorManusia);
                    $row_data_jumlah_FaktorManusia = $result_data_jumlah_FaktorManusia->fetch_assoc();
                    $total_data_jumlah_FaktorManusia = $row_data_jumlah_FaktorManusia['num'];

                    $sql_data_jumlah_FaktorAlam = "SELECT COUNT(QC.id) As num 
                    FROM quality_controls QC
                    INNER JOIN kerosakans K
                    ON QC.kerosakan_id = K.id
                    WHERE K.faktor = 'Alam'
                    AND QC.created_at >= '$tahun-$i_value-01'
                    AND QC.created_at <= '$tahun-$i_value-$last_day'";
                    $result_data_jumlah_FaktorAlam = $mysqli->query($sql_data_jumlah_FaktorAlam);
                    $row_data_jumlah_FaktorAlam = $result_data_jumlah_FaktorAlam->fetch_assoc();
                    $total_data_jumlah_FaktorAlam = $row_data_jumlah_FaktorAlam['num'];

                    $total_data_jumlah_JumlahLulus = $total_data_jumlah_JumlahPeriksa - $total_data_jumlah_JumlahRosak;

                    if ($total_data_jumlah_JumlahRosak != 0 && $total_data_jumlah_JumlahPeriksa != 0)
                    {
                        $total_data_jumlah_PeratusRosak = ($total_data_jumlah_JumlahRosak/$total_data_jumlah_JumlahPeriksa) * 100;
                        $total_data_jumlah_PeratusRosak = number_format($total_data_jumlah_PeratusRosak,2);
                    }
                    else
                    {
                        $total_data_jumlah_PeratusRosak = 0;
                    }
                    
                    $total_data_jumlah_FaktorSemua = $total_data_jumlah_FaktorManusia + $total_data_jumlah_FaktorAlam;

                    if ($total_data_jumlah_FaktorSemua == 0)
                    {
                        $total_data_jumlah_FaktorManusiaPeratus = 0;
                        $total_data_jumlah_FaktorAlamPeratus = 0;
                    }
                    else
                    {
                        $total_data_jumlah_FaktorManusiaPeratus = ($total_data_jumlah_FaktorManusia/$total_data_jumlah_FaktorSemua) * 100;
                        $total_data_jumlah_FaktorAlamPeratus = ($total_data_jumlah_FaktorAlam/$total_data_jumlah_FaktorSemua) * 100;
                    }

                    if ($i == 1)
                    {
                        $bulan_1_Patah = $total_data_jumlah_Patah;
                        $bulan_1_Tikus = $total_data_jumlah_Tikus;
                        $bulan_1_Beg_Pecah = $total_data_jumlah_Beg_Pecah;
                        $bulan_1_KembangTidakSekata = $total_data_jumlah_KembangTidakSekata;
                        $bulan_1_Anai = $total_data_jumlah_Anai;
                        $bulan_1_BungaMati = $total_data_jumlah_BungaMati;
                        $bulan_1_TenggelamBanjir = $total_data_jumlah_TenggelamBanjir;
                        $bulan_1_BungaMatiAlam = $total_data_jumlah_BungaMatiAlam;
                        $bulan_1_MasukMasaCP = $total_data_jumlah_MasukMasaCP;
                        $bulan_1_BawahTKemas = $total_data_jumlah_BawahTKemas;
                        $bulan_1_BungaTakCP = $total_data_jumlah_BungaTakCP;
                        $bulan_1_SeranganHaiwan = $total_data_jumlah_SeranganHaiwan;
                        $bulan_1_Sambang = $total_data_jumlah_Sambang;
                        $bulan_1_AtasTKemas = $total_data_jumlah_AtasTKemas;
                        $bulan_1_JumlahPeriksa = $total_data_jumlah_JumlahPeriksa;
                        $bulan_1_JumlahRosak = $total_data_jumlah_JumlahRosak;
                        $bulan_1_JumlahLulus = $total_data_jumlah_JumlahLulus;
                        $bulan_1_PeratusRosak = $total_data_jumlah_PeratusRosak;
                        $bulan_1_FaktorManusia = $total_data_jumlah_FaktorManusia;
                        $bulan_1_FaktorManusiaPeratus = number_format($total_data_jumlah_FaktorManusiaPeratus,2);
                        $bulan_1_FaktorAlam = $total_data_jumlah_FaktorAlam;
                        $bulan_1_FaktorAlamPeratus = number_format($total_data_jumlah_FaktorAlamPeratus,2);
                    }
                    else
                    if ($i == 2)
                    {
                        $bulan_2_Patah = $total_data_jumlah_Patah;
                        $bulan_2_Tikus = $total_data_jumlah_Tikus;
                        $bulan_2_Beg_Pecah = $total_data_jumlah_Beg_Pecah;
                        $bulan_2_KembangTidakSekata = $total_data_jumlah_KembangTidakSekata;
                        $bulan_2_Anai = $total_data_jumlah_Anai;
                        $bulan_2_BungaMati = $total_data_jumlah_BungaMati;
                        $bulan_2_TenggelamBanjir = $total_data_jumlah_TenggelamBanjir;
                        $bulan_2_BungaMatiAlam = $total_data_jumlah_BungaMatiAlam;
                        $bulan_2_MasukMasaCP = $total_data_jumlah_MasukMasaCP;
                        $bulan_2_BawahTKemas = $total_data_jumlah_BawahTKemas;
                        $bulan_2_BungaTakCP = $total_data_jumlah_BungaTakCP;
                        $bulan_2_SeranganHaiwan = $total_data_jumlah_SeranganHaiwan;
                        $bulan_2_Sambang = $total_data_jumlah_Sambang;
                        $bulan_2_AtasTKemas = $total_data_jumlah_AtasTKemas;
                        $bulan_2_JumlahPeriksa = $total_data_jumlah_JumlahPeriksa;
                        $bulan_2_JumlahRosak = $total_data_jumlah_JumlahRosak;
                        $bulan_2_JumlahLulus = $total_data_jumlah_JumlahLulus;
                        $bulan_2_PeratusRosak = $total_data_jumlah_PeratusRosak;
                        $bulan_2_FaktorManusia = $total_data_jumlah_FaktorManusia;
                        $bulan_2_FaktorManusiaPeratus = number_format($total_data_jumlah_FaktorManusiaPeratus,2);
                        $bulan_2_FaktorAlam = $total_data_jumlah_FaktorAlam;
                        $bulan_2_FaktorAlamPeratus = number_format($total_data_jumlah_FaktorAlamPeratus,2);
                    }
                    else
                    if ($i == 3)
                    {
                        $bulan_3_Patah = $total_data_jumlah_Patah;
                        $bulan_3_Tikus = $total_data_jumlah_Tikus;
                        $bulan_3_Beg_Pecah = $total_data_jumlah_Beg_Pecah;
                        $bulan_3_KembangTidakSekata = $total_data_jumlah_KembangTidakSekata;
                        $bulan_3_Anai = $total_data_jumlah_Anai;
                        $bulan_3_BungaMati = $total_data_jumlah_BungaMati;
                        $bulan_3_TenggelamBanjir = $total_data_jumlah_TenggelamBanjir;
                        $bulan_3_BungaMatiAlam = $total_data_jumlah_BungaMatiAlam;
                        $bulan_3_MasukMasaCP = $total_data_jumlah_MasukMasaCP;
                        $bulan_3_BawahTKemas = $total_data_jumlah_BawahTKemas;
                        $bulan_3_BungaTakCP = $total_data_jumlah_BungaTakCP;
                        $bulan_3_SeranganHaiwan = $total_data_jumlah_SeranganHaiwan;
                        $bulan_3_Sambang = $total_data_jumlah_Sambang;
                        $bulan_3_AtasTKemas = $total_data_jumlah_AtasTKemas;
                        $bulan_3_JumlahPeriksa = $total_data_jumlah_JumlahPeriksa;
                        $bulan_3_JumlahRosak = $total_data_jumlah_JumlahRosak;
                        $bulan_3_JumlahLulus = $total_data_jumlah_JumlahLulus;
                        $bulan_3_PeratusRosak = $total_data_jumlah_PeratusRosak;
                        $bulan_3_FaktorManusia = $total_data_jumlah_FaktorManusia;
                        $bulan_3_FaktorManusiaPeratus = number_format($total_data_jumlah_FaktorManusiaPeratus,2);
                        $bulan_3_FaktorAlam = $total_data_jumlah_FaktorAlam;
                        $bulan_3_FaktorAlamPeratus = number_format($total_data_jumlah_FaktorAlamPeratus,2);
                    }
                    else
                    if ($i == 4)
                    {
                        $bulan_4_Patah = $total_data_jumlah_Patah;
                        $bulan_4_Tikus = $total_data_jumlah_Tikus;
                        $bulan_4_Beg_Pecah = $total_data_jumlah_Beg_Pecah;
                        $bulan_4_KembangTidakSekata = $total_data_jumlah_KembangTidakSekata;
                        $bulan_4_Anai = $total_data_jumlah_Anai;
                        $bulan_4_BungaMati = $total_data_jumlah_BungaMati;
                        $bulan_4_TenggelamBanjir = $total_data_jumlah_TenggelamBanjir;
                        $bulan_4_BungaMatiAlam = $total_data_jumlah_BungaMatiAlam;
                        $bulan_4_MasukMasaCP = $total_data_jumlah_MasukMasaCP;
                        $bulan_4_BawahTKemas = $total_data_jumlah_BawahTKemas;
                        $bulan_4_BungaTakCP = $total_data_jumlah_BungaTakCP;
                        $bulan_4_SeranganHaiwan = $total_data_jumlah_SeranganHaiwan;
                        $bulan_4_Sambang = $total_data_jumlah_Sambang;
                        $bulan_4_AtasTKemas = $total_data_jumlah_AtasTKemas;
                        $bulan_4_JumlahPeriksa = $total_data_jumlah_JumlahPeriksa;
                        $bulan_4_JumlahRosak = $total_data_jumlah_JumlahRosak;
                        $bulan_4_JumlahLulus = $total_data_jumlah_JumlahLulus;
                        $bulan_4_PeratusRosak = $total_data_jumlah_PeratusRosak;
                        $bulan_4_FaktorManusia = $total_data_jumlah_FaktorManusia;
                        $bulan_4_FaktorManusiaPeratus = number_format($total_data_jumlah_FaktorManusiaPeratus,2);
                        $bulan_4_FaktorAlam = $total_data_jumlah_FaktorAlam;
                        $bulan_4_FaktorAlamPeratus = number_format($total_data_jumlah_FaktorAlamPeratus,2);
                    }
                    else
                    if ($i == 5)
                    {
                        $bulan_5_Patah = $total_data_jumlah_Patah;
                        $bulan_5_Tikus = $total_data_jumlah_Tikus;
                        $bulan_5_Beg_Pecah = $total_data_jumlah_Beg_Pecah;
                        $bulan_5_KembangTidakSekata = $total_data_jumlah_KembangTidakSekata;
                        $bulan_5_Anai = $total_data_jumlah_Anai;
                        $bulan_5_BungaMati = $total_data_jumlah_BungaMati;
                        $bulan_5_TenggelamBanjir = $total_data_jumlah_TenggelamBanjir;
                        $bulan_5_BungaMatiAlam = $total_data_jumlah_BungaMatiAlam;
                        $bulan_5_MasukMasaCP = $total_data_jumlah_MasukMasaCP;
                        $bulan_5_BawahTKemas = $total_data_jumlah_BawahTKemas;
                        $bulan_5_BungaTakCP = $total_data_jumlah_BungaTakCP;
                        $bulan_5_SeranganHaiwan = $total_data_jumlah_SeranganHaiwan;
                        $bulan_5_Sambang = $total_data_jumlah_Sambang;
                        $bulan_5_AtasTKemas = $total_data_jumlah_AtasTKemas;
                        $bulan_5_JumlahPeriksa = $total_data_jumlah_JumlahPeriksa;
                        $bulan_5_JumlahRosak = $total_data_jumlah_JumlahRosak;
                        $bulan_5_JumlahLulus = $total_data_jumlah_JumlahLulus;
                        $bulan_5_PeratusRosak = $total_data_jumlah_PeratusRosak;
                        $bulan_5_FaktorManusia = $total_data_jumlah_FaktorManusia;
                        $bulan_5_FaktorManusiaPeratus = number_format($total_data_jumlah_FaktorManusiaPeratus,2);
                        $bulan_5_FaktorAlam = $total_data_jumlah_FaktorAlam;
                        $bulan_5_FaktorAlamPeratus = number_format($total_data_jumlah_FaktorAlamPeratus,2);
                    }
                    else
                    if ($i == 6)
                    {
                        $bulan_6_Patah = $total_data_jumlah_Patah;
                        $bulan_6_Tikus = $total_data_jumlah_Tikus;
                        $bulan_6_Beg_Pecah = $total_data_jumlah_Beg_Pecah;
                        $bulan_6_KembangTidakSekata = $total_data_jumlah_KembangTidakSekata;
                        $bulan_6_Anai = $total_data_jumlah_Anai;
                        $bulan_6_BungaMati = $total_data_jumlah_BungaMati;
                        $bulan_6_TenggelamBanjir = $total_data_jumlah_TenggelamBanjir;
                        $bulan_6_BungaMatiAlam = $total_data_jumlah_BungaMatiAlam;
                        $bulan_6_MasukMasaCP = $total_data_jumlah_MasukMasaCP;
                        $bulan_6_BawahTKemas = $total_data_jumlah_BawahTKemas;
                        $bulan_6_BungaTakCP = $total_data_jumlah_BungaTakCP;
                        $bulan_6_SeranganHaiwan = $total_data_jumlah_SeranganHaiwan;
                        $bulan_6_Sambang = $total_data_jumlah_Sambang;
                        $bulan_6_AtasTKemas = $total_data_jumlah_AtasTKemas;
                        $bulan_6_JumlahPeriksa = $total_data_jumlah_JumlahPeriksa;
                        $bulan_6_JumlahRosak = $total_data_jumlah_JumlahRosak;
                        $bulan_6_JumlahLulus = $total_data_jumlah_JumlahLulus;
                        $bulan_6_PeratusRosak = $total_data_jumlah_PeratusRosak;
                        $bulan_6_FaktorManusia = $total_data_jumlah_FaktorManusia;
                        $bulan_6_FaktorManusiaPeratus = number_format($total_data_jumlah_FaktorManusiaPeratus,2);
                        $bulan_6_FaktorAlam = $total_data_jumlah_FaktorAlam;
                        $bulan_6_FaktorAlamPeratus = number_format($total_data_jumlah_FaktorAlamPeratus,2);
                    }
                    else
                    if ($i == 7)
                    {
                        $bulan_7_Patah = $total_data_jumlah_Patah;
                        $bulan_7_Tikus = $total_data_jumlah_Tikus;
                        $bulan_7_Beg_Pecah = $total_data_jumlah_Beg_Pecah;
                        $bulan_7_KembangTidakSekata = $total_data_jumlah_KembangTidakSekata;
                        $bulan_7_Anai = $total_data_jumlah_Anai;
                        $bulan_7_BungaMati = $total_data_jumlah_BungaMati;
                        $bulan_7_TenggelamBanjir = $total_data_jumlah_TenggelamBanjir;
                        $bulan_7_BungaMatiAlam = $total_data_jumlah_BungaMatiAlam;
                        $bulan_7_MasukMasaCP = $total_data_jumlah_MasukMasaCP;
                        $bulan_7_BawahTKemas = $total_data_jumlah_BawahTKemas;
                        $bulan_7_BungaTakCP = $total_data_jumlah_BungaTakCP;
                        $bulan_7_SeranganHaiwan = $total_data_jumlah_SeranganHaiwan;
                        $bulan_7_Sambang = $total_data_jumlah_Sambang;
                        $bulan_7_AtasTKemas = $total_data_jumlah_AtasTKemas;
                        $bulan_7_JumlahPeriksa = $total_data_jumlah_JumlahPeriksa;
                        $bulan_7_JumlahRosak = $total_data_jumlah_JumlahRosak;
                        $bulan_7_JumlahLulus = $total_data_jumlah_JumlahLulus;
                        $bulan_7_PeratusRosak = $total_data_jumlah_PeratusRosak;
                        $bulan_7_FaktorManusia = $total_data_jumlah_FaktorManusia;
                        $bulan_7_FaktorManusiaPeratus = number_format($total_data_jumlah_FaktorManusiaPeratus,2);
                        $bulan_7_FaktorAlam = $total_data_jumlah_FaktorAlam;
                        $bulan_7_FaktorAlamPeratus = number_format($total_data_jumlah_FaktorAlamPeratus,2);
                    }
                    else
                    if ($i == 8)
                    {
                        $bulan_8_Patah = $total_data_jumlah_Patah;
                        $bulan_8_Tikus = $total_data_jumlah_Tikus;
                        $bulan_8_Beg_Pecah = $total_data_jumlah_Beg_Pecah;
                        $bulan_8_KembangTidakSekata = $total_data_jumlah_KembangTidakSekata;
                        $bulan_8_Anai = $total_data_jumlah_Anai;
                        $bulan_8_BungaMati = $total_data_jumlah_BungaMati;
                        $bulan_8_TenggelamBanjir = $total_data_jumlah_TenggelamBanjir;
                        $bulan_8_BungaMatiAlam = $total_data_jumlah_BungaMatiAlam;
                        $bulan_8_MasukMasaCP = $total_data_jumlah_MasukMasaCP;
                        $bulan_8_BawahTKemas = $total_data_jumlah_BawahTKemas;
                        $bulan_8_BungaTakCP = $total_data_jumlah_BungaTakCP;
                        $bulan_8_SeranganHaiwan = $total_data_jumlah_SeranganHaiwan;
                        $bulan_8_Sambang = $total_data_jumlah_Sambang;
                        $bulan_8_AtasTKemas = $total_data_jumlah_AtasTKemas;
                        $bulan_8_JumlahPeriksa = $total_data_jumlah_JumlahPeriksa;
                        $bulan_8_JumlahRosak = $total_data_jumlah_JumlahRosak;
                        $bulan_8_JumlahLulus = $total_data_jumlah_JumlahLulus;
                        $bulan_8_PeratusRosak = $total_data_jumlah_PeratusRosak;
                        $bulan_8_FaktorManusia = $total_data_jumlah_FaktorManusia;
                        $bulan_8_FaktorManusiaPeratus = number_format($total_data_jumlah_FaktorManusiaPeratus,2);
                        $bulan_8_FaktorAlam = $total_data_jumlah_FaktorAlam;
                        $bulan_8_FaktorAlamPeratus = number_format($total_data_jumlah_FaktorAlamPeratus,2);
                    }
                    else
                    if ($i == 9)
                    {
                        $bulan_9_Patah = $total_data_jumlah_Patah;
                        $bulan_9_Tikus = $total_data_jumlah_Tikus;
                        $bulan_9_Beg_Pecah = $total_data_jumlah_Beg_Pecah;
                        $bulan_9_KembangTidakSekata = $total_data_jumlah_KembangTidakSekata;
                        $bulan_9_Anai = $total_data_jumlah_Anai;
                        $bulan_9_BungaMati = $total_data_jumlah_BungaMati;
                        $bulan_9_TenggelamBanjir = $total_data_jumlah_TenggelamBanjir;
                        $bulan_9_BungaMatiAlam = $total_data_jumlah_BungaMatiAlam;
                        $bulan_9_MasukMasaCP = $total_data_jumlah_MasukMasaCP;
                        $bulan_9_BawahTKemas = $total_data_jumlah_BawahTKemas;
                        $bulan_9_BungaTakCP = $total_data_jumlah_BungaTakCP;
                        $bulan_9_SeranganHaiwan = $total_data_jumlah_SeranganHaiwan;
                        $bulan_9_Sambang = $total_data_jumlah_Sambang;
                        $bulan_9_AtasTKemas = $total_data_jumlah_AtasTKemas;
                        $bulan_9_JumlahPeriksa = $total_data_jumlah_JumlahPeriksa;
                        $bulan_9_JumlahRosak = $total_data_jumlah_JumlahRosak;
                        $bulan_9_JumlahLulus = $total_data_jumlah_JumlahLulus;
                        $bulan_9_PeratusRosak = $total_data_jumlah_PeratusRosak;
                        $bulan_9_FaktorManusia = $total_data_jumlah_FaktorManusia;
                        $bulan_9_FaktorManusiaPeratus = number_format($total_data_jumlah_FaktorManusiaPeratus,2);
                        $bulan_9_FaktorAlam = $total_data_jumlah_FaktorAlam;
                        $bulan_9_FaktorAlamPeratus = number_format($total_data_jumlah_FaktorAlamPeratus,2);
                    }
                    else
                    if ($i == 10)
                    {
                        $bulan_10_Patah = $total_data_jumlah_Patah;
                        $bulan_10_Tikus = $total_data_jumlah_Tikus;
                        $bulan_10_Beg_Pecah = $total_data_jumlah_Beg_Pecah;
                        $bulan_10_KembangTidakSekata = $total_data_jumlah_KembangTidakSekata;
                        $bulan_10_Anai = $total_data_jumlah_Anai;
                        $bulan_10_BungaMati = $total_data_jumlah_BungaMati;
                        $bulan_10_TenggelamBanjir = $total_data_jumlah_TenggelamBanjir;
                        $bulan_10_BungaMatiAlam = $total_data_jumlah_BungaMatiAlam;
                        $bulan_10_MasukMasaCP = $total_data_jumlah_MasukMasaCP;
                        $bulan_10_BawahTKemas = $total_data_jumlah_BawahTKemas;
                        $bulan_10_BungaTakCP = $total_data_jumlah_BungaTakCP;
                        $bulan_10_SeranganHaiwan = $total_data_jumlah_SeranganHaiwan;
                        $bulan_10_Sambang = $total_data_jumlah_Sambang;
                        $bulan_10_AtasTKemas = $total_data_jumlah_AtasTKemas;
                        $bulan_10_JumlahPeriksa = $total_data_jumlah_JumlahPeriksa;
                        $bulan_10_JumlahRosak = $total_data_jumlah_JumlahRosak;
                        $bulan_10_JumlahLulus = $total_data_jumlah_JumlahLulus;
                        $bulan_10_PeratusRosak = $total_data_jumlah_PeratusRosak;
                        $bulan_10_FaktorManusia = $total_data_jumlah_FaktorManusia;
                        $bulan_10_FaktorManusiaPeratus = number_format($total_data_jumlah_FaktorManusiaPeratus,2);
                        $bulan_10_FaktorAlam = $total_data_jumlah_FaktorAlam;
                        $bulan_10_FaktorAlamPeratus = number_format($total_data_jumlah_FaktorAlamPeratus,2);
                    }
                    else
                    if ($i == 11)
                    {
                        $bulan_11_Patah = $total_data_jumlah_Patah;
                        $bulan_11_Tikus = $total_data_jumlah_Tikus;
                        $bulan_11_Beg_Pecah = $total_data_jumlah_Beg_Pecah;
                        $bulan_11_KembangTidakSekata = $total_data_jumlah_KembangTidakSekata;
                        $bulan_11_Anai = $total_data_jumlah_Anai;
                        $bulan_11_BungaMati = $total_data_jumlah_BungaMati;
                        $bulan_11_TenggelamBanjir = $total_data_jumlah_TenggelamBanjir;
                        $bulan_11_BungaMatiAlam = $total_data_jumlah_BungaMatiAlam;
                        $bulan_11_MasukMasaCP = $total_data_jumlah_MasukMasaCP;
                        $bulan_11_BawahTKemas = $total_data_jumlah_BawahTKemas;
                        $bulan_11_BungaTakCP = $total_data_jumlah_BungaTakCP;
                        $bulan_11_SeranganHaiwan = $total_data_jumlah_SeranganHaiwan;
                        $bulan_11_Sambang = $total_data_jumlah_Sambang;
                        $bulan_11_AtasTKemas = $total_data_jumlah_AtasTKemas;
                        $bulan_11_JumlahPeriksa = $total_data_jumlah_JumlahPeriksa;
                        $bulan_11_JumlahRosak = $total_data_jumlah_JumlahRosak;
                        $bulan_11_JumlahLulus = $total_data_jumlah_JumlahLulus;
                        $bulan_11_PeratusRosak = $total_data_jumlah_PeratusRosak;
                        $bulan_11_FaktorManusia = $total_data_jumlah_FaktorManusia;
                        $bulan_11_FaktorManusiaPeratus = number_format($total_data_jumlah_FaktorManusiaPeratus,2);
                        $bulan_11_FaktorAlam = $total_data_jumlah_FaktorAlam;
                        $bulan_11_FaktorAlamPeratus = number_format($total_data_jumlah_FaktorAlamPeratus,2);
                    }
                    else
                    if ($i == 12)
                    {
                        $bulan_12_Patah = $total_data_jumlah_Patah;
                        $bulan_12_Tikus = $total_data_jumlah_Tikus;
                        $bulan_12_Beg_Pecah = $total_data_jumlah_Beg_Pecah;
                        $bulan_12_KembangTidakSekata = $total_data_jumlah_KembangTidakSekata;
                        $bulan_12_Anai = $total_data_jumlah_Anai;
                        $bulan_12_BungaMati = $total_data_jumlah_BungaMati;
                        $bulan_12_TenggelamBanjir = $total_data_jumlah_TenggelamBanjir;
                        $bulan_12_BungaMatiAlam = $total_data_jumlah_BungaMatiAlam;
                        $bulan_12_MasukMasaCP = $total_data_jumlah_MasukMasaCP;
                        $bulan_12_BawahTKemas = $total_data_jumlah_BawahTKemas;
                        $bulan_12_BungaTakCP = $total_data_jumlah_BungaTakCP;
                        $bulan_12_SeranganHaiwan = $total_data_jumlah_SeranganHaiwan;
                        $bulan_12_Sambang = $total_data_jumlah_Sambang;
                        $bulan_12_AtasTKemas = $total_data_jumlah_AtasTKemas;
                        $bulan_12_JumlahPeriksa = $total_data_jumlah_JumlahPeriksa;
                        $bulan_12_JumlahRosak = $total_data_jumlah_JumlahRosak;
                        $bulan_12_JumlahLulus = $total_data_jumlah_JumlahLulus;
                        $bulan_12_PeratusRosak = $total_data_jumlah_PeratusRosak;
                        $bulan_12_FaktorManusia = $total_data_jumlah_FaktorManusia;
                        $bulan_12_FaktorManusiaPeratus = number_format($total_data_jumlah_FaktorManusiaPeratus,2);
                        $bulan_12_FaktorAlam = $total_data_jumlah_FaktorAlam;
                        $bulan_12_FaktorAlamPeratus = number_format($total_data_jumlah_FaktorAlamPeratus,2);
                    }
                }
              ?>
                <tr>
                    <td>Jan</td>
                    <td>{{ $bulan_1_Patah }}</td>
                    <td>{{ $bulan_1_Tikus }}</td>
                    <td>{{ $bulan_1_Beg_Pecah }}</td>
                    <td>{{ $bulan_1_KembangTidakSekata }}</td>
                    <td>{{ $bulan_1_Anai }}</td>
                    <td>{{ $bulan_1_BungaMati }}</td>
                    <td>{{ $bulan_1_TenggelamBanjir }}</td>
                    <td>{{ $bulan_1_BungaMatiAlam }}</td>
                    <td>{{ $bulan_1_MasukMasaCP }}</td>
                    <td>{{ $bulan_1_BawahTKemas }}</td>
                    <td>{{ $bulan_1_BungaTakCP }}</td>
                    <td>{{ $bulan_1_SeranganHaiwan }}</td>
                    <td>{{ $bulan_1_Sambang }}</td>
                    <td>{{ $bulan_1_AtasTKemas }}</td>
                    <td>{{ $bulan_1_JumlahPeriksa }}</td>
                    <td>{{ $bulan_1_JumlahRosak }}</td>
                    <td>{{ $bulan_1_JumlahLulus }}</td>
                    <td>{{ $bulan_1_PeratusRosak }}</td>
                    <td>{{ $bulan_1_FaktorManusia }}</td>
                    <td>{{ $bulan_1_FaktorManusiaPeratus }}</td>
                    <td>{{ $bulan_1_FaktorAlam }}</td>
                    <td>{{ $bulan_1_FaktorAlamPeratus }}</td>
                </tr>
                <tr>
                    <td>Feb</td>
                    <td>{{ $bulan_2_Patah }}</td>
                    <td>{{ $bulan_2_Tikus }}</td>
                    <td>{{ $bulan_2_Beg_Pecah }}</td>
                    <td>{{ $bulan_2_KembangTidakSekata }}</td>
                    <td>{{ $bulan_2_Anai }}</td>
                    <td>{{ $bulan_2_BungaMati }}</td>
                    <td>{{ $bulan_2_TenggelamBanjir }}</td>
                    <td>{{ $bulan_2_BungaMatiAlam }}</td>
                    <td>{{ $bulan_2_MasukMasaCP }}</td>
                    <td>{{ $bulan_2_BawahTKemas }}</td>
                    <td>{{ $bulan_2_BungaTakCP }}</td>
                    <td>{{ $bulan_2_SeranganHaiwan }}</td>
                    <td>{{ $bulan_2_Sambang }}</td>
                    <td>{{ $bulan_2_AtasTKemas }}</td>
                    <td>{{ $bulan_2_JumlahPeriksa }}</td>
                    <td>{{ $bulan_2_JumlahRosak }}</td>
                    <td>{{ $bulan_2_JumlahLulus }}</td>
                    <td>{{ $bulan_2_PeratusRosak }}</td>
                    <td>{{ $bulan_2_FaktorManusia }}</td>
                    <td>{{ $bulan_2_FaktorManusiaPeratus }}</td>
                    <td>{{ $bulan_2_FaktorAlam }}</td>
                    <td>{{ $bulan_2_FaktorAlamPeratus }}</td>
                </tr>
                <tr>
                    <td>Mac</td>
                    <td>{{ $bulan_3_Patah }}</td>
                    <td>{{ $bulan_3_Tikus }}</td>
                    <td>{{ $bulan_3_Beg_Pecah }}</td>
                    <td>{{ $bulan_3_KembangTidakSekata }}</td>
                    <td>{{ $bulan_3_Anai }}</td>
                    <td>{{ $bulan_3_BungaMati }}</td>
                    <td>{{ $bulan_3_TenggelamBanjir }}</td>
                    <td>{{ $bulan_3_BungaMatiAlam }}</td>
                    <td>{{ $bulan_3_MasukMasaCP }}</td>
                    <td>{{ $bulan_3_BawahTKemas }}</td>
                    <td>{{ $bulan_3_BungaTakCP }}</td>
                    <td>{{ $bulan_3_SeranganHaiwan }}</td>
                    <td>{{ $bulan_3_Sambang }}</td>
                    <td>{{ $bulan_3_AtasTKemas }}</td>
                    <td>{{ $bulan_3_JumlahPeriksa }}</td>
                    <td>{{ $bulan_3_JumlahRosak }}</td>
                    <td>{{ $bulan_3_JumlahLulus }}</td>
                    <td>{{ $bulan_3_PeratusRosak }}</td>
                    <td>{{ $bulan_3_FaktorManusia }}</td>
                    <td>{{ $bulan_3_FaktorManusiaPeratus }}</td>
                    <td>{{ $bulan_3_FaktorAlam }}</td>
                    <td>{{ $bulan_3_FaktorAlamPeratus }}</td>
                </tr>
                <tr>
                    <td>April</td>
                    <td>{{ $bulan_4_Patah }}</td>
                    <td>{{ $bulan_4_Tikus }}</td>
                    <td>{{ $bulan_4_Beg_Pecah }}</td>
                    <td>{{ $bulan_4_KembangTidakSekata }}</td>
                    <td>{{ $bulan_4_Anai }}</td>
                    <td>{{ $bulan_4_BungaMati }}</td>
                    <td>{{ $bulan_4_TenggelamBanjir }}</td>
                    <td>{{ $bulan_4_BungaMatiAlam }}</td>
                    <td>{{ $bulan_4_MasukMasaCP }}</td>
                    <td>{{ $bulan_4_BawahTKemas }}</td>
                    <td>{{ $bulan_4_BungaTakCP }}</td>
                    <td>{{ $bulan_4_SeranganHaiwan }}</td>
                    <td>{{ $bulan_4_Sambang }}</td>
                    <td>{{ $bulan_4_AtasTKemas }}</td>
                    <td>{{ $bulan_4_JumlahPeriksa }}</td>
                    <td>{{ $bulan_4_JumlahRosak }}</td>
                    <td>{{ $bulan_4_JumlahLulus }}</td>
                    <td>{{ $bulan_4_PeratusRosak }}</td>
                    <td>{{ $bulan_4_FaktorManusia }}</td>
                    <td>{{ $bulan_4_FaktorManusiaPeratus }}</td>
                    <td>{{ $bulan_4_FaktorAlam }}</td>
                    <td>{{ $bulan_4_FaktorAlamPeratus }}</td>
                </tr>
                <tr>
                    <td>Mei</td>
                    <td>{{ $bulan_5_Patah }}</td>
                    <td>{{ $bulan_5_Tikus }}</td>
                    <td>{{ $bulan_5_Beg_Pecah }}</td>
                    <td>{{ $bulan_5_KembangTidakSekata }}</td>
                    <td>{{ $bulan_5_Anai }}</td>
                    <td>{{ $bulan_5_BungaMati }}</td>
                    <td>{{ $bulan_5_TenggelamBanjir }}</td>
                    <td>{{ $bulan_5_BungaMatiAlam }}</td>
                    <td>{{ $bulan_5_MasukMasaCP }}</td>
                    <td>{{ $bulan_5_BawahTKemas }}</td>
                    <td>{{ $bulan_5_BungaTakCP }}</td>
                    <td>{{ $bulan_5_SeranganHaiwan }}</td>
                    <td>{{ $bulan_5_Sambang }}</td>
                    <td>{{ $bulan_5_AtasTKemas }}</td>
                    <td>{{ $bulan_5_JumlahPeriksa }}</td>
                    <td>{{ $bulan_5_JumlahRosak }}</td>
                    <td>{{ $bulan_5_JumlahLulus }}</td>
                    <td>{{ $bulan_5_PeratusRosak }}</td>
                    <td>{{ $bulan_5_FaktorManusia }}</td>
                    <td>{{ $bulan_5_FaktorManusiaPeratus }}</td>
                    <td>{{ $bulan_5_FaktorAlam }}</td>
                    <td>{{ $bulan_5_FaktorAlamPeratus }}</td>
                </tr>
                <tr>
                    <td>Jun</td>
                    <td>{{ $bulan_6_Patah }}</td>
                    <td>{{ $bulan_6_Tikus }}</td>
                    <td>{{ $bulan_6_Beg_Pecah }}</td>
                    <td>{{ $bulan_6_KembangTidakSekata }}</td>
                    <td>{{ $bulan_6_Anai }}</td>
                    <td>{{ $bulan_6_BungaMati }}</td>
                    <td>{{ $bulan_6_TenggelamBanjir }}</td>
                    <td>{{ $bulan_6_BungaMatiAlam }}</td>
                    <td>{{ $bulan_6_MasukMasaCP }}</td>
                    <td>{{ $bulan_6_BawahTKemas }}</td>
                    <td>{{ $bulan_6_BungaTakCP }}</td>
                    <td>{{ $bulan_6_SeranganHaiwan }}</td>
                    <td>{{ $bulan_6_Sambang }}</td>
                    <td>{{ $bulan_6_AtasTKemas }}</td>
                    <td>{{ $bulan_6_JumlahPeriksa }}</td>
                    <td>{{ $bulan_6_JumlahRosak }}</td>
                    <td>{{ $bulan_6_JumlahLulus }}</td>
                    <td>{{ $bulan_6_PeratusRosak }}</td>
                    <td>{{ $bulan_6_FaktorManusia }}</td>
                    <td>{{ $bulan_6_FaktorManusiaPeratus }}</td>
                    <td>{{ $bulan_6_FaktorAlam }}</td>
                    <td>{{ $bulan_6_FaktorAlamPeratus }}</td>
                </tr>
                <tr>
                    <td>Julai</td>
                    <td>{{ $bulan_7_Patah }}</td>
                    <td>{{ $bulan_7_Tikus }}</td>
                    <td>{{ $bulan_7_Beg_Pecah }}</td>
                    <td>{{ $bulan_7_KembangTidakSekata }}</td>
                    <td>{{ $bulan_7_Anai }}</td>
                    <td>{{ $bulan_7_BungaMati }}</td>
                    <td>{{ $bulan_7_TenggelamBanjir }}</td>
                    <td>{{ $bulan_7_BungaMatiAlam }}</td>
                    <td>{{ $bulan_7_MasukMasaCP }}</td>
                    <td>{{ $bulan_7_BawahTKemas }}</td>
                    <td>{{ $bulan_7_BungaTakCP }}</td>
                    <td>{{ $bulan_7_SeranganHaiwan }}</td>
                    <td>{{ $bulan_7_Sambang }}</td>
                    <td>{{ $bulan_7_AtasTKemas }}</td>
                    <td>{{ $bulan_7_JumlahPeriksa }}</td>
                    <td>{{ $bulan_7_JumlahRosak }}</td>
                    <td>{{ $bulan_7_JumlahLulus }}</td>
                    <td>{{ $bulan_7_PeratusRosak }}</td>
                    <td>{{ $bulan_7_FaktorManusia }}</td>
                    <td>{{ $bulan_7_FaktorManusiaPeratus }}</td>
                    <td>{{ $bulan_7_FaktorAlam }}</td>
                    <td>{{ $bulan_7_FaktorAlamPeratus }}</td>
                </tr>
                <tr>
                    <td>Ogos</td>
                    <td>{{ $bulan_8_Patah }}</td>
                    <td>{{ $bulan_8_Tikus }}</td>
                    <td>{{ $bulan_8_Beg_Pecah }}</td>
                    <td>{{ $bulan_8_KembangTidakSekata }}</td>
                    <td>{{ $bulan_8_Anai }}</td>
                    <td>{{ $bulan_8_BungaMati }}</td>
                    <td>{{ $bulan_8_TenggelamBanjir }}</td>
                    <td>{{ $bulan_8_BungaMatiAlam }}</td>
                    <td>{{ $bulan_8_MasukMasaCP }}</td>
                    <td>{{ $bulan_8_BawahTKemas }}</td>
                    <td>{{ $bulan_8_BungaTakCP }}</td>
                    <td>{{ $bulan_8_SeranganHaiwan }}</td>
                    <td>{{ $bulan_8_Sambang }}</td>
                    <td>{{ $bulan_8_AtasTKemas }}</td>
                    <td>{{ $bulan_8_JumlahPeriksa }}</td>
                    <td>{{ $bulan_8_JumlahRosak }}</td>
                    <td>{{ $bulan_8_JumlahLulus }}</td>
                    <td>{{ $bulan_8_PeratusRosak }}</td>
                    <td>{{ $bulan_8_FaktorManusia }}</td>
                    <td>{{ $bulan_8_FaktorManusiaPeratus }}</td>
                    <td>{{ $bulan_8_FaktorAlam }}</td>
                    <td>{{ $bulan_8_FaktorAlamPeratus }}</td>
                </tr>
                <tr>
                    <td>Sept</td>
                    <td>{{ $bulan_9_Patah }}</td>
                    <td>{{ $bulan_9_Tikus }}</td>
                    <td>{{ $bulan_9_Beg_Pecah }}</td>
                    <td>{{ $bulan_9_KembangTidakSekata }}</td>
                    <td>{{ $bulan_9_Anai }}</td>
                    <td>{{ $bulan_9_BungaMati }}</td>
                    <td>{{ $bulan_9_TenggelamBanjir }}</td>
                    <td>{{ $bulan_9_BungaMatiAlam }}</td>
                    <td>{{ $bulan_9_MasukMasaCP }}</td>
                    <td>{{ $bulan_9_BawahTKemas }}</td>
                    <td>{{ $bulan_9_BungaTakCP }}</td>
                    <td>{{ $bulan_9_SeranganHaiwan }}</td>
                    <td>{{ $bulan_9_Sambang }}</td>
                    <td>{{ $bulan_9_AtasTKemas }}</td>
                    <td>{{ $bulan_9_JumlahPeriksa }}</td>
                    <td>{{ $bulan_9_JumlahRosak }}</td>
                    <td>{{ $bulan_9_JumlahLulus }}</td>
                    <td>{{ $bulan_9_PeratusRosak }}</td>
                    <td>{{ $bulan_9_FaktorManusia }}</td>
                    <td>{{ $bulan_9_FaktorManusiaPeratus }}</td>
                    <td>{{ $bulan_9_FaktorAlam }}</td>
                    <td>{{ $bulan_9_FaktorAlamPeratus }}</td>
                </tr>
                <tr>
                    <td>Okt</td>
                    <td>{{ $bulan_10_Patah }}</td>
                    <td>{{ $bulan_10_Tikus }}</td>
                    <td>{{ $bulan_10_Beg_Pecah }}</td>
                    <td>{{ $bulan_10_KembangTidakSekata }}</td>
                    <td>{{ $bulan_10_Anai }}</td>
                    <td>{{ $bulan_10_BungaMati }}</td>
                    <td>{{ $bulan_10_TenggelamBanjir }}</td>
                    <td>{{ $bulan_10_BungaMatiAlam }}</td>
                    <td>{{ $bulan_10_MasukMasaCP }}</td>
                    <td>{{ $bulan_10_BawahTKemas }}</td>
                    <td>{{ $bulan_10_BungaTakCP }}</td>
                    <td>{{ $bulan_10_SeranganHaiwan }}</td>
                    <td>{{ $bulan_10_Sambang }}</td>
                    <td>{{ $bulan_10_AtasTKemas }}</td>
                    <td>{{ $bulan_10_JumlahPeriksa }}</td>
                    <td>{{ $bulan_10_JumlahRosak }}</td>
                    <td>{{ $bulan_10_JumlahLulus }}</td>
                    <td>{{ $bulan_10_PeratusRosak }}</td>
                    <td>{{ $bulan_10_FaktorManusia }}</td>
                    <td>{{ $bulan_10_FaktorManusiaPeratus }}</td>
                    <td>{{ $bulan_10_FaktorAlam }}</td>
                    <td>{{ $bulan_10_FaktorAlamPeratus }}</td>
                </tr>
                <tr>
                    <td>Nov</td>
                    <td>{{ $bulan_11_Patah }}</td>
                    <td>{{ $bulan_11_Tikus }}</td>
                    <td>{{ $bulan_11_Beg_Pecah }}</td>
                    <td>{{ $bulan_11_KembangTidakSekata }}</td>
                    <td>{{ $bulan_11_Anai }}</td>
                    <td>{{ $bulan_11_BungaMati }}</td>
                    <td>{{ $bulan_11_TenggelamBanjir }}</td>
                    <td>{{ $bulan_11_BungaMatiAlam }}</td>
                    <td>{{ $bulan_11_MasukMasaCP }}</td>
                    <td>{{ $bulan_11_BawahTKemas }}</td>
                    <td>{{ $bulan_11_BungaTakCP }}</td>
                    <td>{{ $bulan_11_SeranganHaiwan }}</td>
                    <td>{{ $bulan_11_Sambang }}</td>
                    <td>{{ $bulan_11_AtasTKemas }}</td>
                    <td>{{ $bulan_11_JumlahPeriksa }}</td>
                    <td>{{ $bulan_11_JumlahRosak }}</td>
                    <td>{{ $bulan_11_JumlahLulus }}</td>
                    <td>{{ $bulan_11_PeratusRosak }}</td>
                    <td>{{ $bulan_11_FaktorManusia }}</td>
                    <td>{{ $bulan_11_FaktorManusiaPeratus }}</td>
                    <td>{{ $bulan_11_FaktorAlam }}</td>
                    <td>{{ $bulan_11_FaktorAlamPeratus }}</td>
                </tr>
                <tr>
                    <td>Dec</td>
                    <td>{{ $bulan_12_Patah }}</td>
                    <td>{{ $bulan_12_Tikus }}</td>
                    <td>{{ $bulan_12_Beg_Pecah }}</td>
                    <td>{{ $bulan_12_KembangTidakSekata }}</td>
                    <td>{{ $bulan_12_Anai }}</td>
                    <td>{{ $bulan_12_BungaMati }}</td>
                    <td>{{ $bulan_12_TenggelamBanjir }}</td>
                    <td>{{ $bulan_12_BungaMatiAlam }}</td>
                    <td>{{ $bulan_12_MasukMasaCP }}</td>
                    <td>{{ $bulan_12_BawahTKemas }}</td>
                    <td>{{ $bulan_12_BungaTakCP }}</td>
                    <td>{{ $bulan_12_SeranganHaiwan }}</td>
                    <td>{{ $bulan_12_Sambang }}</td>
                    <td>{{ $bulan_12_AtasTKemas }}</td>
                    <td>{{ $bulan_12_JumlahPeriksa }}</td>
                    <td>{{ $bulan_12_JumlahRosak }}</td>
                    <td>{{ $bulan_12_JumlahLulus }}</td>
                    <td>{{ $bulan_12_PeratusRosak }}</td>
                    <td>{{ $bulan_12_FaktorManusia }}</td>
                    <td>{{ $bulan_12_FaktorManusiaPeratus }}</td>
                    <td>{{ $bulan_12_FaktorAlam }}</td>
                    <td>{{ $bulan_12_FaktorAlamPeratus }}</td>
                </tr>
              </tbody>
          </table>
      </div>

  </div>
