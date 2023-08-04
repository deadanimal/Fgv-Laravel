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
      <h4 class="mt-2">Ladang Benih Pusat Pertanian Perkhidmatan Tun Razak</h4>
      <h4 class="mt-2">Rumusan Pencapaian Penuaian Harian Tandan Ladang Benih</h4>
  </div>
  <div class="col-xl-12 text-left">
      <span><b>Tempoh Laporan: {{$tarikh_mula_word}} - {{$tarikh_akhir_word}}<b></span>
  </div>

  <?php
    include_once("../database/Connect.php");

    $tarikh_akhir = date('Y-m-d', strtotime("+1 day", strtotime($tarikh_akhir)));

    $empat_bulan_20_hari_days = "140";
    $empat_bulan_25_hari_days = "145";
    $empat_bulan_26_hari_days = "146";
    $empat_bulan_29_hari_days = "149";
    $lima_bulan_days = "150";
    $lima_bulan_25_hari_days = "175";
    $lima_bulan_26_hari_days = "176";
    $enam_bulan_days = "180";
    $enam_bulan_more_days = "181";

    // <4 Bulan 20 Hari
    $sql_count_row_1 = "SELECT COUNT(H.tandan_id) As num 
    FROM harvests H
    INNER JOIN tandans T
    ON H.tandan_id = T.id
    WHERE H.status = 'sah'
    AND H.created_at >= DATE_SUB(CURDATE(), INTERVAL $empat_bulan_20_hari_days DAY)
    AND H.created_at >= '$tarikh_mula'
    AND H.created_at <= '$tarikh_akhir'";
    $result_count_row_1 = $mysqli->query($sql_count_row_1);
    $row_count_row_1 = $result_count_row_1->fetch_assoc();
    $total_count_row_1 = $row_count_row_1['num'];

    //4 Bulan 20 Hari - 4 Bulan 25 Hari
    $sql_count_row_2 = "SELECT COUNT(H.tandan_id) As num 
    FROM harvests H
    INNER JOIN tandans T
    ON H.tandan_id = T.id
    WHERE H.status = 'sah'
    AND H.created_at >= DATE_SUB(CURDATE(), INTERVAL $empat_bulan_20_hari_days DAY)
    AND H.created_at <= DATE_SUB(CURDATE(), INTERVAL $empat_bulan_25_hari_days DAY)
    AND H.created_at >= '$tarikh_mula'
    AND H.created_at <= '$tarikh_akhir'";
    $result_count_row_2 = $mysqli->query($sql_count_row_2);
    $row_count_row_2 = $result_count_row_2->fetch_assoc();
    $total_count_row_2 = $row_count_row_2['num'];

    //4 Bulan 26 Hari - 4 Bulan 29 Hari
    $sql_count_row_3 = "SELECT COUNT(H.tandan_id) As num 
    FROM harvests H
    INNER JOIN tandans T
    ON H.tandan_id = T.id
    WHERE H.status = 'sah'
    AND H.created_at >= DATE_SUB(CURDATE(), INTERVAL $empat_bulan_26_hari_days DAY)
    AND H.created_at <= DATE_SUB(CURDATE(), INTERVAL $empat_bulan_29_hari_days DAY)
    AND H.created_at >= '$tarikh_mula'
    AND H.created_at <= '$tarikh_akhir'";
    $result_count_row_3 = $mysqli->query($sql_count_row_3);
    $row_count_row_3 = $result_count_row_3->fetch_assoc();
    $total_count_row_3 = $row_count_row_3['num'];

    //5 Bulan - 5.5 Bulan
    $sql_count_row_4 = "SELECT COUNT(H.tandan_id) As num 
    FROM harvests H
    INNER JOIN tandans T
    ON H.tandan_id = T.id
    WHERE H.status = 'sah'
    AND H.created_at >= DATE_SUB(CURDATE(), INTERVAL $lima_bulan_days DAY)
    AND H.created_at <= DATE_SUB(CURDATE(), INTERVAL $lima_bulan_25_hari_days DAY)
    AND H.created_at >= '$tarikh_mula'
    AND H.created_at <= '$tarikh_akhir'";
    $result_count_row_4 = $mysqli->query($sql_count_row_4);
    $row_count_row_4 = $result_count_row_4->fetch_assoc();
    $total_count_row_4 = $row_count_row_4['num'];

    //5.6 Bulan - 6 Bulan
    $sql_count_row_5 = "SELECT COUNT(H.tandan_id) As num 
    FROM harvests H
    INNER JOIN tandans T
    ON H.tandan_id = T.id
    WHERE H.status = 'sah'
    AND H.created_at >= DATE_SUB(CURDATE(), INTERVAL $lima_bulan_26_hari_days DAY)
    AND H.created_at <= DATE_SUB(CURDATE(), INTERVAL $enam_bulan_days DAY)
    AND H.created_at >= '$tarikh_mula'
    AND H.created_at <= '$tarikh_akhir'";
    $result_count_row_5 = $mysqli->query($sql_count_row_5);
    $row_count_row_5 = $result_count_row_5->fetch_assoc();
    $total_count_row_5 = $row_count_row_5['num'];

    //>6 Bulan
    $sql_count_row_6 = "SELECT COUNT(H.tandan_id) As num 
    FROM harvests H
    INNER JOIN tandans T
    ON H.tandan_id = T.id
    WHERE H.status = 'sah'
    AND H.created_at >= DATE_SUB(CURDATE(), INTERVAL $enam_bulan_more_days DAY)
    AND H.created_at >= '$tarikh_mula'
    AND H.created_at <= '$tarikh_akhir'";
    $result_count_row_6 = $mysqli->query($sql_count_row_6);
    $row_count_row_6 = $result_count_row_6->fetch_assoc();
    $total_count_row_6 = $row_count_row_6['num'];

    $jumlah_tandan = $total_count_row_1 + $total_count_row_2 + $total_count_row_3 + $total_count_row_4 + $total_count_row_5 + $total_count_row_6;

    if ($total_count_row_1 != 0 && $jumlah_tandan != 0)
    {
        $total_percent_row_1 = ($total_count_row_1/$jumlah_tandan) * 100;
    }
    else
    {
        $total_percent_row_1 = 0.00;
    }

    if ($total_count_row_2 != 0 && $jumlah_tandan != 0)
    {
        $total_percent_row_2 = ($total_count_row_2/$jumlah_tandan) * 100;
    }
    else
    {
        $total_percent_row_2 = 0.00;
    }

    if ($total_count_row_3 != 0 && $jumlah_tandan != 0)
    {
        $total_percent_row_3 = ($total_count_row_3/$jumlah_tandan) * 100;
    }
    else
    {
        $total_percent_row_3 = 0.00;
    }

    if ($total_count_row_4 != 0 && $jumlah_tandan != 0)
    {
        $total_percent_row_4 = ($total_count_row_4/$jumlah_tandan) * 100;
    }
    else
    {
        $total_percent_row_4 = 0.00;
    }

    if ($total_count_row_5 != 0 && $jumlah_tandan != 0)
    {
        $total_percent_row_5 = ($total_count_row_5/$jumlah_tandan) * 100;
    }
    else
    {
        $total_percent_row_5 = 0.00;
    }

    if ($total_count_row_6 != 0 && $jumlah_tandan != 0)
    {
        $total_percent_row_6 = ($total_count_row_6/$jumlah_tandan) * 100;
    }
    else
    {
        $total_percent_row_6 = 0.00;
    }

    $jumlah_percent = $total_percent_row_1 + $total_percent_row_2 + $total_percent_row_3 + $total_percent_row_4 + $total_percent_row_5 + $total_percent_row_6;
  ?>


  <div class="col-12 mt-4">
      <div class="table-responsive scrollbar">
          <table class="table table-bordered overflow-hidden" width="100%">
              <thead class="border border-dark" style="background-color: #d9d9d9;">
                  <tr>
                    <th rowspan="2">Kategori Tandan</th>
                    <th colspan="2">Rumusan</th>
                  </tr>
                  <tr>
                    <th>Tandan</th>
                    <th>%</th>
                  </tr>
               </thead>
               <tbody class="border border-dark">
                  <tr>
                    <td>&lt;4 Bulan 20 Hari</td>
                    <td>{{ $total_count_row_1 }}</td>
                    <td>{{ $total_percent_row_1 }} %</td>
                  </tr>
                  <tr>
                    <td>4 Bulan 20 Hari - 4 Bulan 25 Hari</td>
                    <td>{{ $total_count_row_2 }}</td>
                    <td>{{ $total_percent_row_2 }} %</td>
                  </tr>
                  <tr>
                    <td>4 Bulan 26 Hari - 4 Bulan 29 Hari</td>
                    <td>{{ $total_count_row_3 }}</td>
                    <td>{{ $total_percent_row_3 }} %</td>
                  </tr>
                  <tr>
                    <td>5 Bulan - 5.5 Bulan</td>
                    <td>{{ $total_count_row_4 }}</td>
                    <td>{{ $total_percent_row_4 }} %</td>
                  </tr>
                  <tr>
                    <td>5.6 Bulan - 6 Bulan</td>
                    <td>{{ $total_count_row_5 }}</td>
                    <td>{{ $total_percent_row_5 }} %</td>
                  </tr>
                  <tr>
                    <td>&gt;6 Bulan</td>
                    <td>{{ $total_count_row_6 }}</td>
                    <td>{{ $total_percent_row_6 }} %</td>
                  </tr>
                  <tr style="background-color: #d9d9d9;">
                    <td>Jumlah</td>
                    <td>{{ $jumlah_tandan }}</td>
                    <td>{{ $jumlah_percent }} %</td>
                  </tr>
                </tbody>
          </table>
      </div>

  </div>
