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

  <?php
    include_once("../database/Connect.php");

    $empat_bulan_20_hari_days = "140";
    $empat_bulan_25_hari_days = "145";
    $empat_bulan_26_hari_days = "146";
    $empat_bulan_29_hari_days = "149";
    $lima_bulan_days = "150";
    $lima_bulan_25_hari_days = "175";
    $lima_bulan_26_hari_days = "176";
    $enam_bulan_days = "180";
    $enam_bulan_more_days = "181";

    for ($i = 1; $i <= 31; $i++)
    {
        if ($i == 1)
        {
            $i_value = '01';
        }
        else
        if ($i == 2)
        {
            $i_value = '02';
        }
        else
        if ($i == 3)
        {
            $i_value = '03';
        }
        else
        if ($i == 4)
        {
            $i_value = '04';
        }
        else
        if ($i == 5)
        {
            $i_value = '05';
        }
        else
        if ($i == 6)
        {
            $i_value = '06';
        }
        else
        if ($i == 7)
        {
            $i_value = '07';
        }
        else
        if ($i == 8)
        {
            $i_value = '08';
        }
        else
        if ($i == 9)
        {
            $i_value = '09';
        }
        else
        {
            $i_value = $i;
        }

        // <4 Bulan 20 Hari
        $sql_count_row_1 = "SELECT COUNT(H.tandan_id) As num 
        FROM harvests H
        INNER JOIN tandans T
        ON H.tandan_id = T.id
        WHERE H.status = 'sah'
        AND H.created_at >= DATE_SUB(CURDATE(), INTERVAL $empat_bulan_20_hari_days DAY)
        AND H.created_at Like '$tahun-$bulan-$i_value%'";
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
        AND H.created_at Like '$tahun-$bulan-$i_value%'";
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
        AND H.created_at Like '$tahun-$bulan-$i_value%'";
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
        AND H.created_at Like '$tahun-$bulan-$i_value%'";
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
        AND H.created_at Like '$tahun-$bulan-$i_value%'";
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
        AND H.created_at Like '$tahun-$bulan-$i_value%'";
        $result_count_row_6 = $mysqli->query($sql_count_row_6);
        $row_count_row_6 = $result_count_row_6->fetch_assoc();
        $total_count_row_6 = $row_count_row_6['num'];

        if ($i == 1)
        {
            $day_1_row_1 = $total_count_row_1;
            $day_1_row_2 = $total_count_row_2;
            $day_1_row_3 = $total_count_row_3;
            $day_1_row_4 = $total_count_row_4;
            $day_1_row_5 = $total_count_row_5;
            $day_1_row_6 = $total_count_row_6;

            $total_day_1 = $day_1_row_1 + $day_1_row_2 + $day_1_row_3 + $day_1_row_4 + $day_1_row_5 + $day_1_row_6;

            if($day_1_row_1 != '0' && $total_day_1 != '0')
            {
                $day_1_row_1_percent = ($day_1_row_1/$total_day_1) * 100;
            }
            else
            {
                $day_1_row_1_percent = '0.00';
            }

            if($day_1_row_2 != '0' && $total_day_1 != '0')
            {
                $day_1_row_2_percent = ($day_1_row_2/$total_day_1) * 100;
            }
            else
            {
                $day_1_row_2_percent = '0.00';
            }

            if($day_1_row_3 != '0' && $total_day_1 != '0')
            {
                $day_1_row_3_percent = ($day_1_row_3/$total_day_1) * 100;
            }
            else
            {
                $day_1_row_3_percent = '0.00';
            }

            if($day_1_row_4 != '0' && $total_day_1 != '0')
            {
                $day_1_row_4_percent = ($day_1_row_4/$total_day_1) * 100;
            }
            else
            {
                $day_1_row_4_percent = '0.00';
            }

            if($day_1_row_5 != '0' && $total_day_1 != '0')
            {
                $day_1_row_5_percent = ($day_1_row_5/$total_day_1) * 100;
            }
            else
            {
                $day_1_row_5_percent = '0.00';
            }

            if($day_1_row_6 != '0' && $total_day_1 != '0')
            {
                $day_1_row_6_percent = ($day_1_row_6/$total_day_1) * 100;
            }
            else
            {
                $day_1_row_6_percent = '0.00';
            }

            $total_day_1_percent = $day_1_row_1_percent + $day_1_row_2_percent + $day_1_row_3_percent + $day_1_row_4_percent + $day_1_row_5_percent + $day_1_row_6_percent;
            
        }
        else
        if ($i == 2)
        {
            $day_2_row_1 = $total_count_row_1;
            $day_2_row_2 = $total_count_row_2;
            $day_2_row_3 = $total_count_row_3;
            $day_2_row_4 = $total_count_row_4;
            $day_2_row_5 = $total_count_row_5;
            $day_2_row_6 = $total_count_row_6;

            $total_day_2 = $day_2_row_1 + $day_2_row_2 + $day_2_row_3 + $day_2_row_4 + $day_2_row_5 + $day_2_row_6;

            if($day_2_row_1 != '0' && $total_day_2 != '0')
            {
                $day_2_row_1_percent = ($day_2_row_1/$total_day_2) * 100;
            }
            else
            {
                $day_2_row_1_percent = '0.00';
            }

            if($day_2_row_2 != '0' && $total_day_2 != '0')
            {
                $day_2_row_2_percent = ($day_2_row_2/$total_day_2) * 100;
            }
            else
            {
                $day_2_row_2_percent = '0.00';
            }

            if($day_2_row_3 != '0' && $total_day_2 != '0')
            {
                $day_2_row_3_percent = ($day_2_row_3/$total_day_2) * 100;
            }
            else
            {
                $day_2_row_3_percent = '0.00';
            }

            if($day_2_row_4 != '0' && $total_day_2 != '0')
            {
                $day_2_row_4_percent = ($day_2_row_4/$total_day_2) * 100;
            }
            else
            {
                $day_2_row_4_percent = '0.00';
            }

            if($day_2_row_5 != '0' && $total_day_2 != '0')
            {
                $day_2_row_5_percent = ($day_2_row_5/$total_day_2) * 100;
            }
            else
            {
                $day_2_row_5_percent = '0.00';
            }

            if($day_2_row_6 != '0' && $total_day_2 != '0')
            {
                $day_2_row_6_percent = ($day_2_row_6/$total_day_2) * 100;
            }
            else
            {
                $day_2_row_6_percent = '0.00';
            }

            $total_day_2_percent = $day_2_row_1_percent + $day_2_row_2_percent + $day_2_row_3_percent + $day_2_row_4_percent + $day_2_row_5_percent + $day_2_row_6_percent;
        }
        else
        if ($i == 3)
        {
            $day_3_row_1 = $total_count_row_1;
            $day_3_row_2 = $total_count_row_2;
            $day_3_row_3 = $total_count_row_3;
            $day_3_row_4 = $total_count_row_4;
            $day_3_row_5 = $total_count_row_5;
            $day_3_row_6 = $total_count_row_6;

            $total_day_3 = $day_3_row_1 + $day_3_row_2 + $day_3_row_3 + $day_3_row_4 + $day_3_row_5 + $day_3_row_6;

            if($day_3_row_1 != '0' && $total_day_3 != '0')
            {
                $day_3_row_1_percent = ($day_3_row_1/$total_day_3) * 100;
            }
            else
            {
                $day_3_row_1_percent = '0.00';
            }

            if($day_3_row_2 != '0' && $total_day_3 != '0')
            {
                $day_3_row_2_percent = ($day_3_row_2/$total_day_3) * 100;
            }
            else
            {
                $day_3_row_2_percent = '0.00';
            }

            if($day_3_row_3 != '0' && $total_day_3 != '0')
            {
                $day_3_row_3_percent = ($day_3_row_3/$total_day_3) * 100;
            }
            else
            {
                $day_3_row_3_percent = '0.00';
            }

            if($day_3_row_4 != '0' && $total_day_3 != '0')
            {
                $day_3_row_4_percent = ($day_3_row_4/$total_day_3) * 100;
            }
            else
            {
                $day_3_row_4_percent = '0.00';
            }

            if($day_3_row_5 != '0' && $total_day_3 != '0')
            {
                $day_3_row_5_percent = ($day_3_row_5/$total_day_3) * 100;
            }
            else
            {
                $day_3_row_5_percent = '0.00';
            }

            if($day_3_row_6 != '0' && $total_day_3 != '0')
            {
                $day_3_row_6_percent = ($day_3_row_6/$total_day_3) * 100;
            }
            else
            {
                $day_3_row_6_percent = '0.00';
            }

            $total_day_3_percent = $day_3_row_1_percent + $day_3_row_2_percent + $day_3_row_3_percent + $day_3_row_4_percent + $day_3_row_5_percent + $day_3_row_6_percent;
        }
        else
        if ($i == 4)
        {
            $day_4_row_1 = $total_count_row_1;
            $day_4_row_2 = $total_count_row_2;
            $day_4_row_3 = $total_count_row_3;
            $day_4_row_4 = $total_count_row_4;
            $day_4_row_5 = $total_count_row_5;
            $day_4_row_6 = $total_count_row_6;

            $total_day_4 = $day_4_row_1 + $day_4_row_2 + $day_4_row_3 + $day_4_row_4 + $day_4_row_5 + $day_4_row_6;

            if($day_4_row_1 != '0' && $total_day_4 != '0')
            {
                $day_4_row_1_percent = ($day_4_row_1/$total_day_4) * 100;
            }
            else
            {
                $day_4_row_1_percent = '0.00';
            }

            if($day_4_row_2 != '0' && $total_day_4 != '0')
            {
                $day_4_row_2_percent = ($day_4_row_2/$total_day_4) * 100;
            }
            else
            {
                $day_4_row_2_percent = '0.00';
            }

            if($day_4_row_3 != '0' && $total_day_4 != '0')
            {
                $day_4_row_3_percent = ($day_4_row_3/$total_day_4) * 100;
            }
            else
            {
                $day_4_row_3_percent = '0.00';
            }

            if($day_4_row_4 != '0' && $total_day_4 != '0')
            {
                $day_4_row_4_percent = ($day_4_row_4/$total_day_4) * 100;
            }
            else
            {
                $day_4_row_4_percent = '0.00';
            }

            if($day_4_row_5 != '0' && $total_day_4 != '0')
            {
                $day_4_row_5_percent = ($day_4_row_5/$total_day_4) * 100;
            }
            else
            {
                $day_4_row_5_percent = '0.00';
            }

            if($day_4_row_6 != '0' && $total_day_4 != '0')
            {
                $day_4_row_6_percent = ($day_4_row_6/$total_day_4) * 100;
            }
            else
            {
                $day_4_row_6_percent = '0.00';
            }

            $total_day_4_percent = $day_4_row_1_percent + $day_4_row_2_percent + $day_4_row_3_percent + $day_4_row_4_percent + $day_4_row_5_percent + $day_4_row_6_percent;
        }
        else
        if ($i == 5)
        {
            $day_5_row_1 = $total_count_row_1;
            $day_5_row_2 = $total_count_row_2;
            $day_5_row_3 = $total_count_row_3;
            $day_5_row_4 = $total_count_row_4;
            $day_5_row_5 = $total_count_row_5;
            $day_5_row_6 = $total_count_row_6;

            $total_day_5 = $day_5_row_1 + $day_5_row_2 + $day_5_row_3 + $day_5_row_4 + $day_5_row_5 + $day_5_row_6;

            if($day_5_row_1 != '0' && $total_day_5 != '0')
            {
                $day_5_row_1_percent = ($day_5_row_1/$total_day_5) * 100;
            }
            else
            {
                $day_5_row_1_percent = '0.00';
            }

            if($day_5_row_2 != '0' && $total_day_5 != '0')
            {
                $day_5_row_2_percent = ($day_5_row_2/$total_day_5) * 100;
            }
            else
            {
                $day_5_row_2_percent = '0.00';
            }

            if($day_5_row_3 != '0' && $total_day_5 != '0')
            {
                $day_5_row_3_percent = ($day_5_row_3/$total_day_5) * 100;
            }
            else
            {
                $day_5_row_3_percent = '0.00';
            }

            if($day_5_row_4 != '0' && $total_day_5 != '0')
            {
                $day_5_row_4_percent = ($day_5_row_4/$total_day_5) * 100;
            }
            else
            {
                $day_5_row_4_percent = '0.00';
            }

            if($day_5_row_5 != '0' && $total_day_5 != '0')
            {
                $day_5_row_5_percent = ($day_5_row_5/$total_day_5) * 100;
            }
            else
            {
                $day_5_row_5_percent = '0.00';
            }

            if($day_5_row_6 != '0' && $total_day_5 != '0')
            {
                $day_5_row_6_percent = ($day_5_row_6/$total_day_5) * 100;
            }
            else
            {
                $day_5_row_6_percent = '0.00';
            }

            $total_day_5_percent = $day_5_row_1_percent + $day_5_row_2_percent + $day_5_row_3_percent + $day_5_row_4_percent + $day_5_row_5_percent + $day_5_row_6_percent;
        }
        else
        if ($i == 6)
        {
            $day_6_row_1 = $total_count_row_1;
            $day_6_row_2 = $total_count_row_2;
            $day_6_row_3 = $total_count_row_3;
            $day_6_row_4 = $total_count_row_4;
            $day_6_row_5 = $total_count_row_5;
            $day_6_row_6 = $total_count_row_6;

            $total_day_6 = $day_6_row_1 + $day_6_row_2 + $day_6_row_3 + $day_6_row_4 + $day_6_row_5 + $day_6_row_6;

            if($day_6_row_1 != '0' && $total_day_6 != '0')
            {
                $day_6_row_1_percent = ($day_6_row_1/$total_day_6) * 100;
            }
            else
            {
                $day_6_row_1_percent = '0.00';
            }

            if($day_6_row_2 != '0' && $total_day_6 != '0')
            {
                $day_6_row_2_percent = ($day_6_row_2/$total_day_6) * 100;
            }
            else
            {
                $day_6_row_2_percent = '0.00';
            }

            if($day_6_row_3 != '0' && $total_day_6 != '0')
            {
                $day_6_row_3_percent = ($day_6_row_3/$total_day_6) * 100;
            }
            else
            {
                $day_6_row_3_percent = '0.00';
            }

            if($day_6_row_4 != '0' && $total_day_6 != '0')
            {
                $day_6_row_4_percent = ($day_6_row_4/$total_day_6) * 100;
            }
            else
            {
                $day_6_row_4_percent = '0.00';
            }

            if($day_6_row_5 != '0' && $total_day_6 != '0')
            {
                $day_6_row_5_percent = ($day_6_row_5/$total_day_6) * 100;
            }
            else
            {
                $day_6_row_5_percent = '0.00';
            }

            if($day_6_row_6 != '0' && $total_day_6 != '0')
            {
                $day_6_row_6_percent = ($day_6_row_6/$total_day_6) * 100;
            }
            else
            {
                $day_6_row_6_percent = '0.00';
            }

            $total_day_6_percent = $day_6_row_1_percent + $day_6_row_2_percent + $day_6_row_3_percent + $day_6_row_4_percent + $day_6_row_5_percent + $day_6_row_6_percent;
        }
        else
        if ($i == 7)
        {
            $day_7_row_1 = $total_count_row_1;
            $day_7_row_2 = $total_count_row_2;
            $day_7_row_3 = $total_count_row_3;
            $day_7_row_4 = $total_count_row_4;
            $day_7_row_5 = $total_count_row_5;
            $day_7_row_6 = $total_count_row_6;

            $total_day_7 = $day_7_row_1 + $day_7_row_2 + $day_7_row_3 + $day_7_row_4 + $day_7_row_5 + $day_7_row_6;

            if($day_7_row_1 != '0' && $total_day_7 != '0')
            {
                $day_7_row_1_percent = ($day_7_row_1/$total_day_7) * 100;
            }
            else
            {
                $day_7_row_1_percent = '0.00';
            }

            if($day_7_row_2 != '0' && $total_day_7 != '0')
            {
                $day_7_row_2_percent = ($day_7_row_2/$total_day_7) * 100;
            }
            else
            {
                $day_7_row_2_percent = '0.00';
            }

            if($day_7_row_3 != '0' && $total_day_7 != '0')
            {
                $day_7_row_3_percent = ($day_7_row_3/$total_day_7) * 100;
            }
            else
            {
                $day_7_row_3_percent = '0.00';
            }

            if($day_7_row_4 != '0' && $total_day_7 != '0')
            {
                $day_7_row_4_percent = ($day_7_row_4/$total_day_7) * 100;
            }
            else
            {
                $day_7_row_4_percent = '0.00';
            }

            if($day_7_row_5 != '0' && $total_day_7 != '0')
            {
                $day_7_row_5_percent = ($day_7_row_5/$total_day_7) * 100;
            }
            else
            {
                $day_7_row_5_percent = '0.00';
            }

            if($day_7_row_6 != '0' && $total_day_7 != '0')
            {
                $day_7_row_6_percent = ($day_7_row_6/$total_day_7) * 100;
            }
            else
            {
                $day_7_row_6_percent = '0.00';
            }

            $total_day_7_percent = $day_7_row_1_percent + $day_7_row_2_percent + $day_7_row_3_percent + $day_7_row_4_percent + $day_7_row_5_percent + $day_7_row_6_percent;
        }
        else
        if ($i == 8)
        {
            $day_8_row_1 = $total_count_row_1;
            $day_8_row_2 = $total_count_row_2;
            $day_8_row_3 = $total_count_row_3;
            $day_8_row_4 = $total_count_row_4;
            $day_8_row_5 = $total_count_row_5;
            $day_8_row_6 = $total_count_row_6;

            $total_day_8 = $day_8_row_1 + $day_8_row_2 + $day_8_row_3 + $day_8_row_4 + $day_8_row_5 + $day_8_row_6;

            if($day_8_row_1 != '0' && $total_day_8 != '0')
            {
                $day_8_row_1_percent = ($day_8_row_1/$total_day_8) * 100;
            }
            else
            {
                $day_8_row_1_percent = '0.00';
            }

            if($day_8_row_2 != '0' && $total_day_8 != '0')
            {
                $day_8_row_2_percent = ($day_8_row_2/$total_day_8) * 100;
            }
            else
            {
                $day_8_row_2_percent = '0.00';
            }

            if($day_8_row_3 != '0' && $total_day_8 != '0')
            {
                $day_8_row_3_percent = ($day_8_row_3/$total_day_8) * 100;
            }
            else
            {
                $day_8_row_3_percent = '0.00';
            }

            if($day_8_row_4 != '0' && $total_day_8 != '0')
            {
                $day_8_row_4_percent = ($day_8_row_4/$total_day_8) * 100;
            }
            else
            {
                $day_8_row_4_percent = '0.00';
            }

            if($day_8_row_5 != '0' && $total_day_8 != '0')
            {
                $day_8_row_5_percent = ($day_8_row_5/$total_day_8) * 100;
            }
            else
            {
                $day_8_row_5_percent = '0.00';
            }

            if($day_8_row_6 != '0' && $total_day_8 != '0')
            {
                $day_8_row_6_percent = ($day_8_row_6/$total_day_8) * 100;
            }
            else
            {
                $day_8_row_6_percent = '0.00';
            }

            $total_day_8_percent = $day_8_row_1_percent + $day_8_row_2_percent + $day_8_row_3_percent + $day_8_row_4_percent + $day_8_row_5_percent + $day_8_row_6_percent;
        }
        else
        if ($i == 9)
        {
            $day_9_row_1 = $total_count_row_1;
            $day_9_row_2 = $total_count_row_2;
            $day_9_row_3 = $total_count_row_3;
            $day_9_row_4 = $total_count_row_4;
            $day_9_row_5 = $total_count_row_5;
            $day_9_row_6 = $total_count_row_6;

            $total_day_9 = $day_9_row_1 + $day_9_row_2 + $day_9_row_3 + $day_9_row_4 + $day_9_row_5 + $day_9_row_6;

            if($day_9_row_1 != '0' && $total_day_9 != '0')
            {
                $day_9_row_1_percent = ($day_9_row_1/$total_day_9) * 100;
            }
            else
            {
                $day_9_row_1_percent = '0.00';
            }

            if($day_9_row_2 != '0' && $total_day_9 != '0')
            {
                $day_9_row_2_percent = ($day_9_row_2/$total_day_9) * 100;
            }
            else
            {
                $day_9_row_2_percent = '0.00';
            }

            if($day_9_row_3 != '0' && $total_day_9 != '0')
            {
                $day_9_row_3_percent = ($day_9_row_3/$total_day_9) * 100;
            }
            else
            {
                $day_9_row_3_percent = '0.00';
            }

            if($day_9_row_4 != '0' && $total_day_9 != '0')
            {
                $day_9_row_4_percent = ($day_9_row_4/$total_day_9) * 100;
            }
            else
            {
                $day_9_row_4_percent = '0.00';
            }

            if($day_9_row_5 != '0' && $total_day_9 != '0')
            {
                $day_9_row_5_percent = ($day_9_row_5/$total_day_9) * 100;
            }
            else
            {
                $day_9_row_5_percent = '0.00';
            }

            if($day_9_row_6 != '0' && $total_day_9 != '0')
            {
                $day_9_row_6_percent = ($day_9_row_6/$total_day_9) * 100;
            }
            else
            {
                $day_9_row_6_percent = '0.00';
            }

            $total_day_9_percent = $day_9_row_1_percent + $day_9_row_2_percent + $day_9_row_3_percent + $day_9_row_4_percent + $day_9_row_5_percent + $day_9_row_6_percent;
        }
        else
        if ($i == 10)
        {
            $day_10_row_1 = $total_count_row_1;
            $day_10_row_2 = $total_count_row_2;
            $day_10_row_3 = $total_count_row_3;
            $day_10_row_4 = $total_count_row_4;
            $day_10_row_5 = $total_count_row_5;
            $day_10_row_6 = $total_count_row_6;

            $total_day_10 = $day_10_row_1 + $day_10_row_2 + $day_10_row_3 + $day_10_row_4 + $day_10_row_5 + $day_10_row_6;

            if($day_10_row_1 != '0' && $total_day_10 != '0')
            {
                $day_10_row_1_percent = ($day_10_row_1/$total_day_10) * 100;
            }
            else
            {
                $day_10_row_1_percent = '0.00';
            }

            if($day_10_row_2 != '0' && $total_day_10 != '0')
            {
                $day_10_row_2_percent = ($day_10_row_2/$total_day_10) * 100;
            }
            else
            {
                $day_10_row_2_percent = '0.00';
            }

            if($day_10_row_3 != '0' && $total_day_10 != '0')
            {
                $day_10_row_3_percent = ($day_10_row_3/$total_day_10) * 100;
            }
            else
            {
                $day_10_row_3_percent = '0.00';
            }

            if($day_10_row_4 != '0' && $total_day_10 != '0')
            {
                $day_10_row_4_percent = ($day_10_row_4/$total_day_10) * 100;
            }
            else
            {
                $day_10_row_4_percent = '0.00';
            }

            if($day_10_row_5 != '0' && $total_day_10 != '0')
            {
                $day_10_row_5_percent = ($day_10_row_5/$total_day_10) * 100;
            }
            else
            {
                $day_10_row_5_percent = '0.00';
            }

            if($day_10_row_6 != '0' && $total_day_10 != '0')
            {
                $day_10_row_6_percent = ($day_10_row_6/$total_day_10) * 100;
            }
            else
            {
                $day_10_row_6_percent = '0.00';
            }

            $total_day_10_percent = $day_10_row_1_percent + $day_10_row_2_percent + $day_10_row_3_percent + $day_10_row_4_percent + $day_10_row_5_percent + $day_10_row_6_percent;
        }
        else
        if ($i == 11)
        {
            $day_11_row_1 = $total_count_row_1;
            $day_11_row_2 = $total_count_row_2;
            $day_11_row_3 = $total_count_row_3;
            $day_11_row_4 = $total_count_row_4;
            $day_11_row_5 = $total_count_row_5;
            $day_11_row_6 = $total_count_row_6;

            $total_day_11 = $day_11_row_1 + $day_11_row_2 + $day_11_row_3 + $day_11_row_4 + $day_11_row_5 + $day_11_row_6;

            if($day_11_row_1 != '0' && $total_day_11 != '0')
            {
                $day_11_row_1_percent = ($day_11_row_1/$total_day_11) * 100;
            }
            else
            {
                $day_11_row_1_percent = '0.00';
            }

            if($day_11_row_2 != '0' && $total_day_11 != '0')
            {
                $day_11_row_2_percent = ($day_11_row_2/$total_day_11) * 100;
            }
            else
            {
                $day_11_row_2_percent = '0.00';
            }

            if($day_11_row_3 != '0' && $total_day_11 != '0')
            {
                $day_11_row_3_percent = ($day_11_row_3/$total_day_11) * 100;
            }
            else
            {
                $day_11_row_3_percent = '0.00';
            }

            if($day_11_row_4 != '0' && $total_day_11 != '0')
            {
                $day_11_row_4_percent = ($day_11_row_4/$total_day_11) * 100;
            }
            else
            {
                $day_11_row_4_percent = '0.00';
            }

            if($day_11_row_5 != '0' && $total_day_11 != '0')
            {
                $day_11_row_5_percent = ($day_11_row_5/$total_day_11) * 100;
            }
            else
            {
                $day_11_row_5_percent = '0.00';
            }

            if($day_11_row_6 != '0' && $total_day_11 != '0')
            {
                $day_11_row_6_percent = ($day_11_row_6/$total_day_11) * 100;
            }
            else
            {
                $day_11_row_6_percent = '0.00';
            }

            $total_day_11_percent = $day_11_row_1_percent + $day_11_row_2_percent + $day_11_row_3_percent + $day_11_row_4_percent + $day_11_row_5_percent + $day_11_row_6_percent;
        }
        else
        if ($i == 12)
        {
            $day_12_row_1 = $total_count_row_1;
            $day_12_row_2 = $total_count_row_2;
            $day_12_row_3 = $total_count_row_3;
            $day_12_row_4 = $total_count_row_4;
            $day_12_row_5 = $total_count_row_5;
            $day_12_row_6 = $total_count_row_6;

            $total_day_12 = $day_12_row_1 + $day_12_row_2 + $day_12_row_3 + $day_12_row_4 + $day_12_row_5 + $day_12_row_6;

            if($day_12_row_1 != '0' && $total_day_12 != '0')
            {
                $day_12_row_1_percent = ($day_12_row_1/$total_day_12) * 100;
            }
            else
            {
                $day_12_row_1_percent = '0.00';
            }

            if($day_12_row_2 != '0' && $total_day_12 != '0')
            {
                $day_12_row_2_percent = ($day_12_row_2/$total_day_12) * 100;
            }
            else
            {
                $day_12_row_2_percent = '0.00';
            }

            if($day_12_row_3 != '0' && $total_day_12 != '0')
            {
                $day_12_row_3_percent = ($day_12_row_3/$total_day_12) * 100;
            }
            else
            {
                $day_12_row_3_percent = '0.00';
            }

            if($day_12_row_4 != '0' && $total_day_12 != '0')
            {
                $day_12_row_4_percent = ($day_12_row_4/$total_day_12) * 100;
            }
            else
            {
                $day_12_row_4_percent = '0.00';
            }

            if($day_12_row_5 != '0' && $total_day_12 != '0')
            {
                $day_12_row_5_percent = ($day_12_row_5/$total_day_12) * 100;
            }
            else
            {
                $day_12_row_5_percent = '0.00';
            }

            if($day_12_row_6 != '0' && $total_day_12 != '0')
            {
                $day_12_row_6_percent = ($day_12_row_6/$total_day_12) * 100;
            }
            else
            {
                $day_12_row_6_percent = '0.00';
            }

            $total_day_12_percent = $day_12_row_1_percent + $day_12_row_2_percent + $day_12_row_3_percent + $day_12_row_4_percent + $day_12_row_5_percent + $day_12_row_6_percent;
        }
        else
        if ($i == 13)
        {
            $day_13_row_1 = $total_count_row_1;
            $day_13_row_2 = $total_count_row_2;
            $day_13_row_3 = $total_count_row_3;
            $day_13_row_4 = $total_count_row_4;
            $day_13_row_5 = $total_count_row_5;
            $day_13_row_6 = $total_count_row_6;

            $total_day_13 = $day_13_row_1 + $day_13_row_2 + $day_13_row_3 + $day_13_row_4 + $day_13_row_5 + $day_13_row_6;

            if($day_13_row_1 != '0' && $total_day_13 != '0')
            {
                $day_13_row_1_percent = ($day_13_row_1/$total_day_13) * 100;
            }
            else
            {
                $day_13_row_1_percent = '0.00';
            }

            if($day_13_row_2 != '0' && $total_day_13 != '0')
            {
                $day_13_row_2_percent = ($day_13_row_2/$total_day_13) * 100;
            }
            else
            {
                $day_13_row_2_percent = '0.00';
            }

            if($day_13_row_3 != '0' && $total_day_13 != '0')
            {
                $day_13_row_3_percent = ($day_13_row_3/$total_day_13) * 100;
            }
            else
            {
                $day_13_row_3_percent = '0.00';
            }

            if($day_13_row_4 != '0' && $total_day_13 != '0')
            {
                $day_13_row_4_percent = ($day_13_row_4/$total_day_13) * 100;
            }
            else
            {
                $day_13_row_4_percent = '0.00';
            }

            if($day_13_row_5 != '0' && $total_day_13 != '0')
            {
                $day_13_row_5_percent = ($day_13_row_5/$total_day_13) * 100;
            }
            else
            {
                $day_13_row_5_percent = '0.00';
            }

            if($day_13_row_6 != '0' && $total_day_13 != '0')
            {
                $day_13_row_6_percent = ($day_13_row_6/$total_day_13) * 100;
            }
            else
            {
                $day_13_row_6_percent = '0.00';
            }

            $total_day_13_percent = $day_13_row_1_percent + $day_13_row_2_percent + $day_13_row_3_percent + $day_13_row_4_percent + $day_13_row_5_percent + $day_13_row_6_percent;
        }
        else
        if ($i == 14)
        {
            $day_14_row_1 = $total_count_row_1;
            $day_14_row_2 = $total_count_row_2;
            $day_14_row_3 = $total_count_row_3;
            $day_14_row_4 = $total_count_row_4;
            $day_14_row_5 = $total_count_row_5;
            $day_14_row_6 = $total_count_row_6;

            $total_day_14 = $day_14_row_1 + $day_14_row_2 + $day_14_row_3 + $day_14_row_4 + $day_14_row_5 + $day_14_row_6;

            if($day_14_row_1 != '0' && $total_day_14 != '0')
            {
                $day_14_row_1_percent = ($day_14_row_1/$total_day_14) * 100;
            }
            else
            {
                $day_14_row_1_percent = '0.00';
            }

            if($day_14_row_2 != '0' && $total_day_14 != '0')
            {
                $day_14_row_2_percent = ($day_14_row_2/$total_day_14) * 100;
            }
            else
            {
                $day_14_row_2_percent = '0.00';
            }

            if($day_14_row_3 != '0' && $total_day_14 != '0')
            {
                $day_14_row_3_percent = ($day_14_row_3/$total_day_14) * 100;
            }
            else
            {
                $day_14_row_3_percent = '0.00';
            }

            if($day_14_row_4 != '0' && $total_day_14 != '0')
            {
                $day_14_row_4_percent = ($day_14_row_4/$total_day_14) * 100;
            }
            else
            {
                $day_14_row_4_percent = '0.00';
            }

            if($day_14_row_5 != '0' && $total_day_14 != '0')
            {
                $day_14_row_5_percent = ($day_14_row_5/$total_day_14) * 100;
            }
            else
            {
                $day_14_row_5_percent = '0.00';
            }

            if($day_14_row_6 != '0' && $total_day_14 != '0')
            {
                $day_14_row_6_percent = ($day_14_row_6/$total_day_14) * 100;
            }
            else
            {
                $day_14_row_6_percent = '0.00';
            }

            $total_day_14_percent = $day_14_row_1_percent + $day_14_row_2_percent + $day_14_row_3_percent + $day_14_row_4_percent + $day_14_row_5_percent + $day_14_row_6_percent;
        }
        else
        if ($i == 15)
        {
            $day_15_row_1 = $total_count_row_1;
            $day_15_row_2 = $total_count_row_2;
            $day_15_row_3 = $total_count_row_3;
            $day_15_row_4 = $total_count_row_4;
            $day_15_row_5 = $total_count_row_5;
            $day_15_row_6 = $total_count_row_6;

            $total_day_15 = $day_15_row_1 + $day_15_row_2 + $day_15_row_3 + $day_15_row_4 + $day_15_row_5 + $day_15_row_6;

            if($day_15_row_1 != '0' && $total_day_15 != '0')
            {
                $day_15_row_1_percent = ($day_15_row_1/$total_day_15) * 100;
            }
            else
            {
                $day_15_row_1_percent = '0.00';
            }

            if($day_15_row_2 != '0' && $total_day_15 != '0')
            {
                $day_15_row_2_percent = ($day_15_row_2/$total_day_15) * 100;
            }
            else
            {
                $day_15_row_2_percent = '0.00';
            }

            if($day_15_row_3 != '0' && $total_day_15 != '0')
            {
                $day_15_row_3_percent = ($day_15_row_3/$total_day_15) * 100;
            }
            else
            {
                $day_15_row_3_percent = '0.00';
            }

            if($day_15_row_4 != '0' && $total_day_15 != '0')
            {
                $day_15_row_4_percent = ($day_15_row_4/$total_day_15) * 100;
            }
            else
            {
                $day_15_row_4_percent = '0.00';
            }

            if($day_15_row_5 != '0' && $total_day_15 != '0')
            {
                $day_15_row_5_percent = ($day_15_row_5/$total_day_15) * 100;
            }
            else
            {
                $day_15_row_5_percent = '0.00';
            }

            if($day_15_row_6 != '0' && $total_day_15 != '0')
            {
                $day_15_row_6_percent = ($day_15_row_6/$total_day_15) * 100;
            }
            else
            {
                $day_15_row_6_percent = '0.00';
            }

            $total_day_15_percent = $day_15_row_1_percent + $day_15_row_2_percent + $day_15_row_3_percent + $day_15_row_4_percent + $day_15_row_5_percent + $day_15_row_6_percent;
        }
        else
        if ($i == 16)
        {
            $day_16_row_1 = $total_count_row_1;
            $day_16_row_2 = $total_count_row_2;
            $day_16_row_3 = $total_count_row_3;
            $day_16_row_4 = $total_count_row_4;
            $day_16_row_5 = $total_count_row_5;
            $day_16_row_6 = $total_count_row_6;

            $total_day_16 = $day_16_row_1 + $day_16_row_2 + $day_16_row_3 + $day_16_row_4 + $day_16_row_5 + $day_16_row_6;

            if($day_16_row_1 != '0' && $total_day_16 != '0')
            {
                $day_16_row_1_percent = ($day_16_row_1/$total_day_16) * 100;
            }
            else
            {
                $day_16_row_1_percent = '0.00';
            }

            if($day_16_row_2 != '0' && $total_day_16 != '0')
            {
                $day_16_row_2_percent = ($day_16_row_2/$total_day_16) * 100;
            }
            else
            {
                $day_16_row_2_percent = '0.00';
            }

            if($day_16_row_3 != '0' && $total_day_16 != '0')
            {
                $day_16_row_3_percent = ($day_16_row_3/$total_day_16) * 100;
            }
            else
            {
                $day_16_row_3_percent = '0.00';
            }

            if($day_16_row_4 != '0' && $total_day_16 != '0')
            {
                $day_16_row_4_percent = ($day_16_row_4/$total_day_16) * 100;
            }
            else
            {
                $day_16_row_4_percent = '0.00';
            }

            if($day_16_row_5 != '0' && $total_day_16 != '0')
            {
                $day_16_row_5_percent = ($day_16_row_5/$total_day_16) * 100;
            }
            else
            {
                $day_16_row_5_percent = '0.00';
            }

            if($day_16_row_6 != '0' && $total_day_16 != '0')
            {
                $day_16_row_6_percent = ($day_16_row_6/$total_day_16) * 100;
            }
            else
            {
                $day_16_row_6_percent = '0.00';
            }

            $total_day_16_percent = $day_16_row_1_percent + $day_16_row_2_percent + $day_16_row_3_percent + $day_16_row_4_percent + $day_16_row_5_percent + $day_16_row_6_percent;
        }
        else
        if ($i == 17)
        {
            $day_17_row_1 = $total_count_row_1;
            $day_17_row_2 = $total_count_row_2;
            $day_17_row_3 = $total_count_row_3;
            $day_17_row_4 = $total_count_row_4;
            $day_17_row_5 = $total_count_row_5;
            $day_17_row_6 = $total_count_row_6;

            $total_day_17 = $day_17_row_1 + $day_17_row_2 + $day_17_row_3 + $day_17_row_4 + $day_17_row_5 + $day_17_row_6;

            if($day_17_row_1 != '0' && $total_day_17 != '0')
            {
                $day_17_row_1_percent = ($day_17_row_1/$total_day_17) * 100;
            }
            else
            {
                $day_17_row_1_percent = '0.00';
            }

            if($day_17_row_2 != '0' && $total_day_17 != '0')
            {
                $day_17_row_2_percent = ($day_17_row_2/$total_day_17) * 100;
            }
            else
            {
                $day_17_row_2_percent = '0.00';
            }

            if($day_17_row_3 != '0' && $total_day_17 != '0')
            {
                $day_17_row_3_percent = ($day_17_row_3/$total_day_17) * 100;
            }
            else
            {
                $day_17_row_3_percent = '0.00';
            }

            if($day_17_row_4 != '0' && $total_day_17 != '0')
            {
                $day_17_row_4_percent = ($day_17_row_4/$total_day_17) * 100;
            }
            else
            {
                $day_17_row_4_percent = '0.00';
            }

            if($day_17_row_5 != '0' && $total_day_17 != '0')
            {
                $day_17_row_5_percent = ($day_17_row_5/$total_day_17) * 100;
            }
            else
            {
                $day_17_row_5_percent = '0.00';
            }

            if($day_17_row_6 != '0' && $total_day_17 != '0')
            {
                $day_17_row_6_percent = ($day_17_row_6/$total_day_17) * 100;
            }
            else
            {
                $day_17_row_6_percent = '0.00';
            }

            $total_day_17_percent = $day_17_row_1_percent + $day_17_row_2_percent + $day_17_row_3_percent + $day_17_row_4_percent + $day_17_row_5_percent + $day_17_row_6_percent;
        }
        else
        if ($i == 18)
        {
            $day_18_row_1 = $total_count_row_1;
            $day_18_row_2 = $total_count_row_2;
            $day_18_row_3 = $total_count_row_3;
            $day_18_row_4 = $total_count_row_4;
            $day_18_row_5 = $total_count_row_5;
            $day_18_row_6 = $total_count_row_6;

            $total_day_18 = $day_18_row_1 + $day_18_row_2 + $day_18_row_3 + $day_18_row_4 + $day_18_row_5 + $day_18_row_6;

            if($day_18_row_1 != '0' && $total_day_18 != '0')
            {
                $day_18_row_1_percent = ($day_18_row_1/$total_day_18) * 100;
            }
            else
            {
                $day_18_row_1_percent = '0.00';
            }

            if($day_18_row_2 != '0' && $total_day_18 != '0')
            {
                $day_18_row_2_percent = ($day_18_row_2/$total_day_18) * 100;
            }
            else
            {
                $day_18_row_2_percent = '0.00';
            }

            if($day_18_row_3 != '0' && $total_day_18 != '0')
            {
                $day_18_row_3_percent = ($day_18_row_3/$total_day_18) * 100;
            }
            else
            {
                $day_18_row_3_percent = '0.00';
            }

            if($day_18_row_4 != '0' && $total_day_18 != '0')
            {
                $day_18_row_4_percent = ($day_18_row_4/$total_day_18) * 100;
            }
            else
            {
                $day_18_row_4_percent = '0.00';
            }

            if($day_18_row_5 != '0' && $total_day_18 != '0')
            {
                $day_18_row_5_percent = ($day_18_row_5/$total_day_18) * 100;
            }
            else
            {
                $day_18_row_5_percent = '0.00';
            }

            if($day_18_row_6 != '0' && $total_day_18 != '0')
            {
                $day_18_row_6_percent = ($day_18_row_6/$total_day_18) * 100;
            }
            else
            {
                $day_18_row_6_percent = '0.00';
            }

            $total_day_18_percent = $day_18_row_1_percent + $day_18_row_2_percent + $day_18_row_3_percent + $day_18_row_4_percent + $day_18_row_5_percent + $day_18_row_6_percent;
        }
        else
        if ($i == 19)
        {
            $day_19_row_1 = $total_count_row_1;
            $day_19_row_2 = $total_count_row_2;
            $day_19_row_3 = $total_count_row_3;
            $day_19_row_4 = $total_count_row_4;
            $day_19_row_5 = $total_count_row_5;
            $day_19_row_6 = $total_count_row_6;

            $total_day_19 = $day_19_row_1 + $day_19_row_2 + $day_19_row_3 + $day_19_row_4 + $day_19_row_5 + $day_19_row_6;

            if($day_19_row_1 != '0' && $total_day_19 != '0')
            {
                $day_19_row_1_percent = ($day_19_row_1/$total_day_19) * 100;
            }
            else
            {
                $day_19_row_1_percent = '0.00';
            }

            if($day_19_row_2 != '0' && $total_day_19 != '0')
            {
                $day_19_row_2_percent = ($day_19_row_2/$total_day_19) * 100;
            }
            else
            {
                $day_19_row_2_percent = '0.00';
            }

            if($day_19_row_3 != '0' && $total_day_19 != '0')
            {
                $day_19_row_3_percent = ($day_19_row_3/$total_day_19) * 100;
            }
            else
            {
                $day_19_row_3_percent = '0.00';
            }

            if($day_19_row_4 != '0' && $total_day_19 != '0')
            {
                $day_19_row_4_percent = ($day_19_row_4/$total_day_19) * 100;
            }
            else
            {
                $day_19_row_4_percent = '0.00';
            }

            if($day_19_row_5 != '0' && $total_day_19 != '0')
            {
                $day_19_row_5_percent = ($day_19_row_5/$total_day_19) * 100;
            }
            else
            {
                $day_19_row_5_percent = '0.00';
            }

            if($day_19_row_6 != '0' && $total_day_19 != '0')
            {
                $day_19_row_6_percent = ($day_19_row_6/$total_day_19) * 100;
            }
            else
            {
                $day_19_row_6_percent = '0.00';
            }

            $total_day_19_percent = $day_19_row_1_percent + $day_19_row_2_percent + $day_19_row_3_percent + $day_19_row_4_percent + $day_19_row_5_percent + $day_19_row_6_percent;
        }
        else
        if ($i == 20)
        {
            $day_20_row_1 = $total_count_row_1;
            $day_20_row_2 = $total_count_row_2;
            $day_20_row_3 = $total_count_row_3;
            $day_20_row_4 = $total_count_row_4;
            $day_20_row_5 = $total_count_row_5;
            $day_20_row_6 = $total_count_row_6;

            $total_day_20 = $day_20_row_1 + $day_20_row_2 + $day_20_row_3 + $day_20_row_4 + $day_20_row_5 + $day_20_row_6;

            if($day_20_row_1 != '0' && $total_day_20 != '0')
            {
                $day_20_row_1_percent = ($day_20_row_1/$total_day_20) * 100;
            }
            else
            {
                $day_20_row_1_percent = '0.00';
            }

            if($day_20_row_2 != '0' && $total_day_20 != '0')
            {
                $day_20_row_2_percent = ($day_20_row_2/$total_day_20) * 100;
            }
            else
            {
                $day_20_row_2_percent = '0.00';
            }

            if($day_20_row_3 != '0' && $total_day_20 != '0')
            {
                $day_20_row_3_percent = ($day_20_row_3/$total_day_20) * 100;
            }
            else
            {
                $day_20_row_3_percent = '0.00';
            }

            if($day_20_row_4 != '0' && $total_day_20 != '0')
            {
                $day_20_row_4_percent = ($day_20_row_4/$total_day_20) * 100;
            }
            else
            {
                $day_20_row_4_percent = '0.00';
            }

            if($day_20_row_5 != '0' && $total_day_20 != '0')
            {
                $day_20_row_5_percent = ($day_20_row_5/$total_day_20) * 100;
            }
            else
            {
                $day_20_row_5_percent = '0.00';
            }

            if($day_20_row_6 != '0' && $total_day_20 != '0')
            {
                $day_20_row_6_percent = ($day_20_row_6/$total_day_20) * 100;
            }
            else
            {
                $day_20_row_6_percent = '0.00';
            }

            $total_day_20_percent = $day_20_row_1_percent + $day_20_row_2_percent + $day_20_row_3_percent + $day_20_row_4_percent + $day_20_row_5_percent + $day_20_row_6_percent;
        }
        else
        if ($i == 21)
        {
            $day_21_row_1 = $total_count_row_1;
            $day_21_row_2 = $total_count_row_2;
            $day_21_row_3 = $total_count_row_3;
            $day_21_row_4 = $total_count_row_4;
            $day_21_row_5 = $total_count_row_5;
            $day_21_row_6 = $total_count_row_6;

            $total_day_21 = $day_21_row_1 + $day_21_row_2 + $day_21_row_3 + $day_21_row_4 + $day_21_row_5 + $day_21_row_6;

            if($day_21_row_1 != '0' && $total_day_21 != '0')
            {
                $day_21_row_1_percent = ($day_21_row_1/$total_day_21) * 100;
            }
            else
            {
                $day_21_row_1_percent = '0.00';
            }

            if($day_21_row_2 != '0' && $total_day_21 != '0')
            {
                $day_21_row_2_percent = ($day_21_row_2/$total_day_21) * 100;
            }
            else
            {
                $day_21_row_2_percent = '0.00';
            }

            if($day_21_row_3 != '0' && $total_day_21 != '0')
            {
                $day_21_row_3_percent = ($day_21_row_3/$total_day_21) * 100;
            }
            else
            {
                $day_21_row_3_percent = '0.00';
            }

            if($day_21_row_4 != '0' && $total_day_21 != '0')
            {
                $day_21_row_4_percent = ($day_21_row_4/$total_day_21) * 100;
            }
            else
            {
                $day_21_row_4_percent = '0.00';
            }

            if($day_21_row_5 != '0' && $total_day_21 != '0')
            {
                $day_21_row_5_percent = ($day_21_row_5/$total_day_21) * 100;
            }
            else
            {
                $day_21_row_5_percent = '0.00';
            }

            if($day_21_row_6 != '0' && $total_day_21 != '0')
            {
                $day_21_row_6_percent = ($day_21_row_6/$total_day_21) * 100;
            }
            else
            {
                $day_21_row_6_percent = '0.00';
            }

            $total_day_21_percent = $day_21_row_1_percent + $day_21_row_2_percent + $day_21_row_3_percent + $day_21_row_4_percent + $day_21_row_5_percent + $day_21_row_6_percent;
        }
        else
        if ($i == 22)
        {
            $day_22_row_1 = $total_count_row_1;
            $day_22_row_2 = $total_count_row_2;
            $day_22_row_3 = $total_count_row_3;
            $day_22_row_4 = $total_count_row_4;
            $day_22_row_5 = $total_count_row_5;
            $day_22_row_6 = $total_count_row_6;

            $total_day_22 = $day_22_row_1 + $day_22_row_2 + $day_22_row_3 + $day_22_row_4 + $day_22_row_5 + $day_22_row_6;

            if($day_22_row_1 != '0' && $total_day_22 != '0')
            {
                $day_22_row_1_percent = ($day_22_row_1/$total_day_22) * 100;
            }
            else
            {
                $day_22_row_1_percent = '0.00';
            }

            if($day_22_row_2 != '0' && $total_day_22 != '0')
            {
                $day_22_row_2_percent = ($day_22_row_2/$total_day_22) * 100;
            }
            else
            {
                $day_22_row_2_percent = '0.00';
            }

            if($day_22_row_3 != '0' && $total_day_22 != '0')
            {
                $day_22_row_3_percent = ($day_22_row_3/$total_day_22) * 100;
            }
            else
            {
                $day_22_row_3_percent = '0.00';
            }

            if($day_22_row_4 != '0' && $total_day_22 != '0')
            {
                $day_22_row_4_percent = ($day_22_row_4/$total_day_22) * 100;
            }
            else
            {
                $day_22_row_4_percent = '0.00';
            }

            if($day_22_row_5 != '0' && $total_day_22 != '0')
            {
                $day_22_row_5_percent = ($day_22_row_5/$total_day_22) * 100;
            }
            else
            {
                $day_22_row_5_percent = '0.00';
            }

            if($day_22_row_6 != '0' && $total_day_22 != '0')
            {
                $day_22_row_6_percent = ($day_22_row_6/$total_day_22) * 100;
            }
            else
            {
                $day_22_row_6_percent = '0.00';
            }

            $total_day_22_percent = $day_22_row_1_percent + $day_22_row_2_percent + $day_22_row_3_percent + $day_22_row_4_percent + $day_22_row_5_percent + $day_22_row_6_percent;
        }
        else
        if ($i == 23)
        {
            $day_23_row_1 = $total_count_row_1;
            $day_23_row_2 = $total_count_row_2;
            $day_23_row_3 = $total_count_row_3;
            $day_23_row_4 = $total_count_row_4;
            $day_23_row_5 = $total_count_row_5;
            $day_23_row_6 = $total_count_row_6;

            $total_day_23 = $day_23_row_1 + $day_23_row_2 + $day_23_row_3 + $day_23_row_4 + $day_23_row_5 + $day_23_row_6;

            if($day_23_row_1 != '0' && $total_day_23 != '0')
            {
                $day_23_row_1_percent = ($day_23_row_1/$total_day_23) * 100;
            }
            else
            {
                $day_23_row_1_percent = '0.00';
            }

            if($day_23_row_2 != '0' && $total_day_23 != '0')
            {
                $day_23_row_2_percent = ($day_23_row_2/$total_day_23) * 100;
            }
            else
            {
                $day_23_row_2_percent = '0.00';
            }

            if($day_23_row_3 != '0' && $total_day_23 != '0')
            {
                $day_23_row_3_percent = ($day_23_row_3/$total_day_23) * 100;
            }
            else
            {
                $day_23_row_3_percent = '0.00';
            }

            if($day_23_row_4 != '0' && $total_day_23 != '0')
            {
                $day_23_row_4_percent = ($day_23_row_4/$total_day_23) * 100;
            }
            else
            {
                $day_23_row_4_percent = '0.00';
            }

            if($day_23_row_5 != '0' && $total_day_23 != '0')
            {
                $day_23_row_5_percent = ($day_23_row_5/$total_day_23) * 100;
            }
            else
            {
                $day_23_row_5_percent = '0.00';
            }

            if($day_23_row_6 != '0' && $total_day_23 != '0')
            {
                $day_23_row_6_percent = ($day_23_row_6/$total_day_23) * 100;
            }
            else
            {
                $day_23_row_6_percent = '0.00';
            }

            $total_day_23_percent = $day_23_row_1_percent + $day_23_row_2_percent + $day_23_row_3_percent + $day_23_row_4_percent + $day_23_row_5_percent + $day_23_row_6_percent;
        }
        else
        if ($i == 24)
        {
            $day_24_row_1 = $total_count_row_1;
            $day_24_row_2 = $total_count_row_2;
            $day_24_row_3 = $total_count_row_3;
            $day_24_row_4 = $total_count_row_4;
            $day_24_row_5 = $total_count_row_5;
            $day_24_row_6 = $total_count_row_6;

            $total_day_24 = $day_24_row_1 + $day_24_row_2 + $day_24_row_3 + $day_24_row_4 + $day_24_row_5 + $day_24_row_6;

            if($day_24_row_1 != '0' && $total_day_24 != '0')
            {
                $day_24_row_1_percent = ($day_24_row_1/$total_day_24) * 100;
            }
            else
            {
                $day_24_row_1_percent = '0.00';
            }

            if($day_24_row_2 != '0' && $total_day_24 != '0')
            {
                $day_24_row_2_percent = ($day_24_row_2/$total_day_24) * 100;
            }
            else
            {
                $day_24_row_2_percent = '0.00';
            }

            if($day_24_row_3 != '0' && $total_day_24 != '0')
            {
                $day_24_row_3_percent = ($day_24_row_3/$total_day_24) * 100;
            }
            else
            {
                $day_24_row_3_percent = '0.00';
            }

            if($day_24_row_4 != '0' && $total_day_24 != '0')
            {
                $day_24_row_4_percent = ($day_24_row_4/$total_day_24) * 100;
            }
            else
            {
                $day_24_row_4_percent = '0.00';
            }

            if($day_24_row_5 != '0' && $total_day_24 != '0')
            {
                $day_24_row_5_percent = ($day_24_row_5/$total_day_24) * 100;
            }
            else
            {
                $day_24_row_5_percent = '0.00';
            }

            if($day_24_row_6 != '0' && $total_day_24 != '0')
            {
                $day_24_row_6_percent = ($day_24_row_6/$total_day_24) * 100;
            }
            else
            {
                $day_24_row_6_percent = '0.00';
            }

            $total_day_24_percent = $day_24_row_1_percent + $day_24_row_2_percent + $day_24_row_3_percent + $day_24_row_4_percent + $day_24_row_5_percent + $day_24_row_6_percent;
        }
        else
        if ($i == 25)
        {
            $day_25_row_1 = $total_count_row_1;
            $day_25_row_2 = $total_count_row_2;
            $day_25_row_3 = $total_count_row_3;
            $day_25_row_4 = $total_count_row_4;
            $day_25_row_5 = $total_count_row_5;
            $day_25_row_6 = $total_count_row_6;

            $total_day_25 = $day_25_row_1 + $day_25_row_2 + $day_25_row_3 + $day_25_row_4 + $day_25_row_5 + $day_25_row_6;

            if($day_25_row_1 != '0' && $total_day_25 != '0')
            {
                $day_25_row_1_percent = ($day_25_row_1/$total_day_25) * 100;
            }
            else
            {
                $day_25_row_1_percent = '0.00';
            }

            if($day_25_row_2 != '0' && $total_day_25 != '0')
            {
                $day_25_row_2_percent = ($day_25_row_2/$total_day_25) * 100;
            }
            else
            {
                $day_25_row_2_percent = '0.00';
            }

            if($day_25_row_3 != '0' && $total_day_25 != '0')
            {
                $day_25_row_3_percent = ($day_25_row_3/$total_day_25) * 100;
            }
            else
            {
                $day_25_row_3_percent = '0.00';
            }

            if($day_25_row_4 != '0' && $total_day_25 != '0')
            {
                $day_25_row_4_percent = ($day_25_row_4/$total_day_25) * 100;
            }
            else
            {
                $day_25_row_4_percent = '0.00';
            }

            if($day_25_row_5 != '0' && $total_day_25 != '0')
            {
                $day_25_row_5_percent = ($day_25_row_5/$total_day_25) * 100;
            }
            else
            {
                $day_25_row_5_percent = '0.00';
            }

            if($day_25_row_6 != '0' && $total_day_25 != '0')
            {
                $day_25_row_6_percent = ($day_25_row_6/$total_day_25) * 100;
            }
            else
            {
                $day_25_row_6_percent = '0.00';
            }

            $total_day_25_percent = $day_25_row_1_percent + $day_25_row_2_percent + $day_25_row_3_percent + $day_25_row_4_percent + $day_25_row_5_percent + $day_25_row_6_percent;
        }
        else
        if ($i == 26)
        {
            $day_26_row_1 = $total_count_row_1;
            $day_26_row_2 = $total_count_row_2;
            $day_26_row_3 = $total_count_row_3;
            $day_26_row_4 = $total_count_row_4;
            $day_26_row_5 = $total_count_row_5;
            $day_26_row_6 = $total_count_row_6;

            $total_day_26 = $day_26_row_1 + $day_26_row_2 + $day_26_row_3 + $day_26_row_4 + $day_26_row_5 + $day_26_row_6;

            if($day_26_row_1 != '0' && $total_day_26 != '0')
            {
                $day_26_row_1_percent = ($day_26_row_1/$total_day_26) * 100;
            }
            else
            {
                $day_26_row_1_percent = '0.00';
            }

            if($day_26_row_2 != '0' && $total_day_26 != '0')
            {
                $day_26_row_2_percent = ($day_26_row_2/$total_day_26) * 100;
            }
            else
            {
                $day_26_row_2_percent = '0.00';
            }

            if($day_26_row_3 != '0' && $total_day_26 != '0')
            {
                $day_26_row_3_percent = ($day_26_row_3/$total_day_26) * 100;
            }
            else
            {
                $day_26_row_3_percent = '0.00';
            }

            if($day_26_row_4 != '0' && $total_day_26 != '0')
            {
                $day_26_row_4_percent = ($day_26_row_4/$total_day_26) * 100;
            }
            else
            {
                $day_26_row_4_percent = '0.00';
            }

            if($day_26_row_5 != '0' && $total_day_26 != '0')
            {
                $day_26_row_5_percent = ($day_26_row_5/$total_day_26) * 100;
            }
            else
            {
                $day_26_row_5_percent = '0.00';
            }

            if($day_26_row_6 != '0' && $total_day_26 != '0')
            {
                $day_26_row_6_percent = ($day_26_row_6/$total_day_26) * 100;
            }
            else
            {
                $day_26_row_6_percent = '0.00';
            }

            $total_day_26_percent = $day_26_row_1_percent + $day_26_row_2_percent + $day_26_row_3_percent + $day_26_row_4_percent + $day_26_row_5_percent + $day_26_row_6_percent;
        }
        else
        if ($i == 27)
        {
            $day_27_row_1 = $total_count_row_1;
            $day_27_row_2 = $total_count_row_2;
            $day_27_row_3 = $total_count_row_3;
            $day_27_row_4 = $total_count_row_4;
            $day_27_row_5 = $total_count_row_5;
            $day_27_row_6 = $total_count_row_6;

            $total_day_27 = $day_27_row_1 + $day_27_row_2 + $day_27_row_3 + $day_27_row_4 + $day_27_row_5 + $day_27_row_6;

            if($day_27_row_1 != '0' && $total_day_27 != '0')
            {
                $day_27_row_1_percent = ($day_27_row_1/$total_day_27) * 100;
            }
            else
            {
                $day_27_row_1_percent = '0.00';
            }

            if($day_27_row_2 != '0' && $total_day_27 != '0')
            {
                $day_27_row_2_percent = ($day_27_row_2/$total_day_27) * 100;
            }
            else
            {
                $day_27_row_2_percent = '0.00';
            }

            if($day_27_row_3 != '0' && $total_day_27 != '0')
            {
                $day_27_row_3_percent = ($day_27_row_3/$total_day_27) * 100;
            }
            else
            {
                $day_27_row_3_percent = '0.00';
            }

            if($day_27_row_4 != '0' && $total_day_27 != '0')
            {
                $day_27_row_4_percent = ($day_27_row_4/$total_day_27) * 100;
            }
            else
            {
                $day_27_row_4_percent = '0.00';
            }

            if($day_27_row_5 != '0' && $total_day_27 != '0')
            {
                $day_27_row_5_percent = ($day_27_row_5/$total_day_27) * 100;
            }
            else
            {
                $day_27_row_5_percent = '0.00';
            }

            if($day_27_row_6 != '0' && $total_day_27 != '0')
            {
                $day_27_row_6_percent = ($day_27_row_6/$total_day_27) * 100;
            }
            else
            {
                $day_27_row_6_percent = '0.00';
            }

            $total_day_27_percent = $day_27_row_1_percent + $day_27_row_2_percent + $day_27_row_3_percent + $day_27_row_4_percent + $day_27_row_5_percent + $day_27_row_6_percent;
        }
        else
        if ($i == 28)
        {
            $day_28_row_1 = $total_count_row_1;
            $day_28_row_2 = $total_count_row_2;
            $day_28_row_3 = $total_count_row_3;
            $day_28_row_4 = $total_count_row_4;
            $day_28_row_5 = $total_count_row_5;
            $day_28_row_6 = $total_count_row_6;

            $total_day_28 = $day_28_row_1 + $day_28_row_2 + $day_28_row_3 + $day_28_row_4 + $day_28_row_5 + $day_28_row_6;

            if($day_28_row_1 != '0' && $total_day_28 != '0')
            {
                $day_28_row_1_percent = ($day_28_row_1/$total_day_28) * 100;
            }
            else
            {
                $day_28_row_1_percent = '0.00';
            }

            if($day_28_row_2 != '0' && $total_day_28 != '0')
            {
                $day_28_row_2_percent = ($day_28_row_2/$total_day_28) * 100;
            }
            else
            {
                $day_28_row_2_percent = '0.00';
            }

            if($day_28_row_3 != '0' && $total_day_28 != '0')
            {
                $day_28_row_3_percent = ($day_28_row_3/$total_day_28) * 100;
            }
            else
            {
                $day_28_row_3_percent = '0.00';
            }

            if($day_28_row_4 != '0' && $total_day_28 != '0')
            {
                $day_28_row_4_percent = ($day_28_row_4/$total_day_28) * 100;
            }
            else
            {
                $day_28_row_4_percent = '0.00';
            }

            if($day_28_row_5 != '0' && $total_day_28 != '0')
            {
                $day_28_row_5_percent = ($day_28_row_5/$total_day_28) * 100;
            }
            else
            {
                $day_28_row_5_percent = '0.00';
            }

            if($day_28_row_6 != '0' && $total_day_28 != '0')
            {
                $day_28_row_6_percent = ($day_28_row_6/$total_day_28) * 100;
            }
            else
            {
                $day_28_row_6_percent = '0.00';
            }

            $total_day_28_percent = $day_28_row_1_percent + $day_28_row_2_percent + $day_28_row_3_percent + $day_28_row_4_percent + $day_28_row_5_percent + $day_28_row_6_percent;
        }
        else
        if ($i == 29)
        {
            $day_29_row_1 = $total_count_row_1;
            $day_29_row_2 = $total_count_row_2;
            $day_29_row_3 = $total_count_row_3;
            $day_29_row_4 = $total_count_row_4;
            $day_29_row_5 = $total_count_row_5;
            $day_29_row_6 = $total_count_row_6;

            $total_day_29 = $day_29_row_1 + $day_29_row_2 + $day_29_row_3 + $day_29_row_4 + $day_29_row_5 + $day_29_row_6;

            if($day_29_row_1 != '0' && $total_day_29 != '0')
            {
                $day_29_row_1_percent = ($day_29_row_1/$total_day_29) * 100;
            }
            else
            {
                $day_29_row_1_percent = '0.00';
            }

            if($day_29_row_2 != '0' && $total_day_29 != '0')
            {
                $day_29_row_2_percent = ($day_29_row_2/$total_day_29) * 100;
            }
            else
            {
                $day_29_row_2_percent = '0.00';
            }

            if($day_29_row_3 != '0' && $total_day_29 != '0')
            {
                $day_29_row_3_percent = ($day_29_row_3/$total_day_29) * 100;
            }
            else
            {
                $day_29_row_3_percent = '0.00';
            }

            if($day_29_row_4 != '0' && $total_day_29 != '0')
            {
                $day_29_row_4_percent = ($day_29_row_4/$total_day_29) * 100;
            }
            else
            {
                $day_29_row_4_percent = '0.00';
            }

            if($day_29_row_5 != '0' && $total_day_29 != '0')
            {
                $day_29_row_5_percent = ($day_29_row_5/$total_day_29) * 100;
            }
            else
            {
                $day_29_row_5_percent = '0.00';
            }

            if($day_29_row_6 != '0' && $total_day_29 != '0')
            {
                $day_29_row_6_percent = ($day_29_row_6/$total_day_29) * 100;
            }
            else
            {
                $day_29_row_6_percent = '0.00';
            }

            $total_day_29_percent = $day_29_row_1_percent + $day_29_row_2_percent + $day_29_row_3_percent + $day_29_row_4_percent + $day_29_row_5_percent + $day_29_row_6_percent;
        }
        else
        if ($i == 30)
        {
            $day_30_row_1 = $total_count_row_1;
            $day_30_row_2 = $total_count_row_2;
            $day_30_row_3 = $total_count_row_3;
            $day_30_row_4 = $total_count_row_4;
            $day_30_row_5 = $total_count_row_5;
            $day_30_row_6 = $total_count_row_6;

            $total_day_30 = $day_30_row_1 + $day_30_row_2 + $day_30_row_3 + $day_30_row_4 + $day_30_row_5 + $day_30_row_6;

            if($day_30_row_1 != '0' && $total_day_30 != '0')
            {
                $day_30_row_1_percent = ($day_30_row_1/$total_day_30) * 100;
            }
            else
            {
                $day_30_row_1_percent = '0.00';
            }

            if($day_30_row_2 != '0' && $total_day_30 != '0')
            {
                $day_30_row_2_percent = ($day_30_row_2/$total_day_30) * 100;
            }
            else
            {
                $day_30_row_2_percent = '0.00';
            }

            if($day_30_row_3 != '0' && $total_day_30 != '0')
            {
                $day_30_row_3_percent = ($day_30_row_3/$total_day_30) * 100;
            }
            else
            {
                $day_30_row_3_percent = '0.00';
            }

            if($day_30_row_4 != '0' && $total_day_30 != '0')
            {
                $day_30_row_4_percent = ($day_30_row_4/$total_day_30) * 100;
            }
            else
            {
                $day_30_row_4_percent = '0.00';
            }

            if($day_30_row_5 != '0' && $total_day_30 != '0')
            {
                $day_30_row_5_percent = ($day_30_row_5/$total_day_30) * 100;
            }
            else
            {
                $day_30_row_5_percent = '0.00';
            }

            if($day_30_row_6 != '0' && $total_day_30 != '0')
            {
                $day_30_row_6_percent = ($day_30_row_6/$total_day_30) * 100;
            }
            else
            {
                $day_30_row_6_percent = '0.00';
            }

            $total_day_30_percent = $day_30_row_1_percent + $day_30_row_2_percent + $day_30_row_3_percent + $day_30_row_4_percent + $day_30_row_5_percent + $day_30_row_6_percent;
        }
        else
        if ($i == 31)
        {
            $day_31_row_1 = $total_count_row_1;
            $day_31_row_2 = $total_count_row_2;
            $day_31_row_3 = $total_count_row_3;
            $day_31_row_4 = $total_count_row_4;
            $day_31_row_5 = $total_count_row_5;
            $day_31_row_6 = $total_count_row_6;

            $total_day_31 = $day_31_row_1 + $day_31_row_2 + $day_31_row_3 + $day_31_row_4 + $day_31_row_5 + $day_31_row_6;

            if($day_31_row_1 != '0' && $total_day_31 != '0')
            {
                $day_31_row_1_percent = ($day_31_row_1/$total_day_31) * 100;
            }
            else
            {
                $day_31_row_1_percent = '0.00';
            }

            if($day_31_row_2 != '0' && $total_day_31 != '0')
            {
                $day_31_row_2_percent = ($day_31_row_2/$total_day_31) * 100;
            }
            else
            {
                $day_31_row_2_percent = '0.00';
            }

            if($day_31_row_3 != '0' && $total_day_31 != '0')
            {
                $day_31_row_3_percent = ($day_31_row_3/$total_day_31) * 100;
            }
            else
            {
                $day_31_row_3_percent = '0.00';
            }

            if($day_31_row_4 != '0' && $total_day_31 != '0')
            {
                $day_31_row_4_percent = ($day_31_row_4/$total_day_31) * 100;
            }
            else
            {
                $day_31_row_4_percent = '0.00';
            }

            if($day_31_row_5 != '0' && $total_day_31 != '0')
            {
                $day_31_row_5_percent = ($day_31_row_5/$total_day_31) * 100;
            }
            else
            {
                $day_31_row_5_percent = '0.00';
            }

            if($day_31_row_6 != '0' && $total_day_31 != '0')
            {
                $day_31_row_6_percent = ($day_31_row_6/$total_day_31) * 100;
            }
            else
            {
                $day_31_row_6_percent = '0.00';
            }

            $total_day_31_percent = $day_31_row_1_percent + $day_31_row_2_percent + $day_31_row_3_percent + $day_31_row_4_percent + $day_31_row_5_percent + $day_31_row_6_percent;
        }

        $target_bulanan = 3500;
        $target_selepas_qc = 2833;
        $tuai_sebenar = $total_day_1 + $total_day_2 + $total_day_3 + $total_day_4 + $total_day_5 + $total_day_6 + $total_day_7 + $total_day_8 + $total_day_9 + $total_day_10 + $total_day_11 + $total_day_12 + $total_day_13 + $total_day_14 + $total_day_15 + $total_day_16 + $total_day_17 + $total_day_18 + $total_day_19 + $total_day_20 + $total_day_21 + $total_day_22 + $total_day_23 + $total_day_24 + $total_day_25 + $total_day_26 + $total_day_27 + $total_day_28 + $total_day_29 + $total_day_30 + $total_day_31;
        $beza_tb_ts = $target_bulanan - $tuai_sebenar;
        $beza_tsqc_ts = $target_selepas_qc - $tuai_sebenar;

    }
                                    ?>
  <div class="col-xl-12 text-center">
      <h4 class="mt-2">Ladang Benih Pusat Pertanian Perkhidmatan Tun Razak</h64>
      <h4 class="mt-2">Rumusan Pencapaian Penuaian Harian Tandan Ladang Benih</h4>
  </div>

  <div class="col-xl-12 text-left">
      <span><b>Tempoh Laporan: {{$bulan_word}} {{$tahun}} - {{$bulan_akhir_word}} {{$tahun}}<b></span>
  </div>
  <div class="col-12 mt-4">
      <div class="table-responsive scrollbar">
          <table class="table table-bordered overflow-hidden" width="100%">
               <thead class="border border-dark" style="background-color: #d9d9d9;">
                  <tr>
                    <th rowspan="2">Kategori Tandan</th>
                    <th colspan="2">1hb</th>
                    <th colspan="2">2hb</th>
                    <th colspan="2">3hb</th>
                    <th colspan="2">4hb</th>
                    <th colspan="2">5hb</th>
                    <th colspan="2">6hb</th>
                    <th colspan="2">7hb</th>
                    <th colspan="2">8hb</th>
                    <th colspan="2">9hb</th>
                    <th colspan="2">10hb</th>
                    <th colspan="2">11hb</th>
                    <th colspan="2">12hb</th>
                    <th colspan="2">13hb</th>
                    <th colspan="2">14hb</th>
                    <th colspan="2">15hb</th>
                    <th colspan="2">16hb</th>
                    <th colspan="2">17hb</th>
                    <th colspan="2">18hb</th>
                    <th colspan="2">19hb</th>
                    <th colspan="2">20hb</th>
                    <th colspan="2">21hb</th>
                    <th colspan="2">22hb</th>
                    <th colspan="2">23hb</th>
                    <th colspan="2">24hb</th>
                    <th colspan="2">25hb</th>
                    <th colspan="2">26hb</th>
                    <th colspan="2">27hb</th>
                    <th colspan="2">28hb</th>
                    <th colspan="2">29hb</th>
                    <th colspan="2">30hb</th>
                    <th colspan="2">31hb</th>
                  </tr>
                  <tr>
                    <th>Tandan</th>
                    <th>%</th>
                    <th>Tandan</th>
                    <th>%</th>
                    <th>Tandan</th>
                    <th>%</th>
                    <th>Tandan</th>
                    <th>%</th>
                    <th>Tandan</th>
                    <th>%</th>
                    <th>Tandan</th>
                    <th>%</th>
                    <th>Tandan</th>
                    <th>%</th>
                    <th>Tandan</th>
                    <th>%</th>
                    <th>Tandan</th>
                    <th>%</th>
                    <th>Tandan</th>
                    <th>%</th>
                    <th>Tandan</th>
                    <th>%</th>
                    <th>Tandan</th>
                    <th>%</th>
                    <th>Tandan</th>
                    <th>%</th>
                    <th>Tandan</th>
                    <th>%</th>
                    <th>Tandan</th>
                    <th>%</th>
                    <th>Tandan</th>
                    <th>%</th>
                    <th>Tandan</th>
                    <th>%</th>
                    <th>Tandan</th>
                    <th>%</th>
                    <th>Tandan</th>
                    <th>%</th>
                    <th>Tandan</th>
                    <th>%</th>
                    <th>Tandan</th>
                    <th>%</th>
                    <th>Tandan</th>
                    <th>%</th>
                    <th>Tandan</th>
                    <th>%</th>
                    <th>Tandan</th>
                    <th>%</th>
                    <th>Tandan</th>
                    <th>%</th>
                    <th>Tandan</th>
                    <th>%</th>
                    <th>Tandan</th>
                    <th>%</th>
                    <th>Tandan</th>
                    <th>%</th>
                    <th>Tandan</th>
                    <th>%</th>
                    <th>Tandan</th>
                    <th>%</th>
                    <th>Tandan</th>
                    <th>%</th>
                  </tr>
               </thead>
               <tbody class="border border-dark">
                  <tr>
                    <td>&lt;4 Bulan 20 Hari</td>
                    <td>{{ $day_1_row_1 }}</td>
                    <td>{{ $day_1_row_1_percent }}</td>
                    <td>{{ $day_2_row_1 }}</td>
                    <td>{{ $day_2_row_1_percent }}</td>
                    <td>{{ $day_3_row_1 }}</td>
                    <td>{{ $day_3_row_1_percent }}</td>
                    <td>{{ $day_4_row_1 }}</td>
                    <td>{{ $day_4_row_1_percent }}</td>
                    <td>{{ $day_5_row_1 }}</td>
                    <td>{{ $day_5_row_1_percent }}</td>
                    <td>{{ $day_6_row_1 }}</td>
                    <td>{{ $day_6_row_1_percent }}</td>
                    <td>{{ $day_7_row_1 }}</td>
                    <td>{{ $day_7_row_1_percent }}</td>
                    <td>{{ $day_8_row_1 }}</td>
                    <td>{{ $day_8_row_1_percent }}</td>
                    <td>{{ $day_9_row_1 }}</td>
                    <td>{{ $day_9_row_1_percent }}</td>
                    <td>{{ $day_10_row_1 }}</td>
                    <td>{{ $day_10_row_1_percent }}</td>
                    <td>{{ $day_11_row_1 }}</td>
                    <td>{{ $day_11_row_1_percent }}</td>
                    <td>{{ $day_12_row_1 }}</td>
                    <td>{{ $day_12_row_1_percent }}</td>
                    <td>{{ $day_13_row_1 }}</td>
                    <td>{{ $day_13_row_1_percent }}</td>
                    <td>{{ $day_14_row_1 }}</td>
                    <td>{{ $day_14_row_1_percent }}</td>
                    <td>{{ $day_15_row_1 }}</td>
                    <td>{{ $day_15_row_1_percent }}</td>
                    <td>{{ $day_16_row_1 }}</td>
                    <td>{{ $day_16_row_1_percent }}</td>
                    <td>{{ $day_17_row_1 }}</td>
                    <td>{{ $day_17_row_1_percent }}</td>
                    <td>{{ $day_18_row_1 }}</td>
                    <td>{{ $day_18_row_1_percent }}</td>
                    <td>{{ $day_19_row_1 }}</td>
                    <td>{{ $day_19_row_1_percent }}</td>
                    <td>{{ $day_20_row_1 }}</td>
                    <td>{{ $day_20_row_1_percent }}</td>
                    <td>{{ $day_21_row_1 }}</td>
                    <td>{{ $day_21_row_1_percent }}</td>
                    <td>{{ $day_22_row_1 }}</td>
                    <td>{{ $day_22_row_1_percent }}</td>
                    <td>{{ $day_23_row_1 }}</td>
                    <td>{{ $day_23_row_1_percent }}</td>
                    <td>{{ $day_24_row_1 }}</td>
                    <td>{{ $day_24_row_1_percent }}</td>
                    <td>{{ $day_25_row_1 }}</td>
                    <td>{{ $day_25_row_1_percent }}</td>
                    <td>{{ $day_26_row_1 }}</td>
                    <td>{{ $day_26_row_1_percent }}</td>
                    <td>{{ $day_27_row_1 }}</td>
                    <td>{{ $day_27_row_1_percent }}</td>
                    <td>{{ $day_28_row_1 }}</td>
                    <td>{{ $day_28_row_1_percent }}</td>
                    <td>{{ $day_29_row_1 }}</td>
                    <td>{{ $day_29_row_1_percent }}</td>
                    <td>{{ $day_30_row_1 }}</td>
                    <td>{{ $day_30_row_1_percent }}</td>
                    <td>{{ $day_31_row_1 }}</td>
                    <td>{{ $day_31_row_1_percent }}</td>
                  </tr>
                  <tr>
                    <td>4 Bulan 20 Hari - 4 Bulan 25 Hari</td>
                    <td>{{ $day_1_row_2 }}</td>
                    <td>{{ $day_1_row_2_percent }}</td>
                    <td>{{ $day_2_row_2 }}</td>
                    <td>{{ $day_2_row_2_percent }}</td>
                    <td>{{ $day_3_row_2 }}</td>
                    <td>{{ $day_3_row_2_percent }}</td>
                    <td>{{ $day_4_row_2 }}</td>
                    <td>{{ $day_4_row_2_percent }}</td>
                    <td>{{ $day_5_row_2 }}</td>
                    <td>{{ $day_5_row_2_percent }}</td>
                    <td>{{ $day_6_row_2 }}</td>
                    <td>{{ $day_6_row_2_percent }}</td>
                    <td>{{ $day_7_row_2 }}</td>
                    <td>{{ $day_7_row_2_percent }}</td>
                    <td>{{ $day_8_row_2 }}</td>
                    <td>{{ $day_8_row_2_percent }}</td>
                    <td>{{ $day_9_row_2 }}</td>
                    <td>{{ $day_9_row_2_percent }}</td>
                    <td>{{ $day_10_row_2 }}</td>
                    <td>{{ $day_10_row_2_percent }}</td>
                    <td>{{ $day_11_row_2 }}</td>
                    <td>{{ $day_11_row_2_percent }}</td>
                    <td>{{ $day_12_row_2 }}</td>
                    <td>{{ $day_12_row_2_percent }}</td>
                    <td>{{ $day_13_row_2 }}</td>
                    <td>{{ $day_13_row_2_percent }}</td>
                    <td>{{ $day_14_row_2 }}</td>
                    <td>{{ $day_14_row_2_percent }}</td>
                    <td>{{ $day_15_row_2 }}</td>
                    <td>{{ $day_15_row_2_percent }}</td>
                    <td>{{ $day_16_row_2 }}</td>
                    <td>{{ $day_16_row_2_percent }}</td>
                    <td>{{ $day_17_row_2 }}</td>
                    <td>{{ $day_17_row_2_percent }}</td>
                    <td>{{ $day_18_row_2 }}</td>
                    <td>{{ $day_18_row_2_percent }}</td>
                    <td>{{ $day_19_row_2 }}</td>
                    <td>{{ $day_19_row_2_percent }}</td>
                    <td>{{ $day_20_row_2 }}</td>
                    <td>{{ $day_20_row_2_percent }}</td>
                    <td>{{ $day_21_row_2 }}</td>
                    <td>{{ $day_21_row_2_percent }}</td>
                    <td>{{ $day_22_row_2 }}</td>
                    <td>{{ $day_22_row_2_percent }}</td>
                    <td>{{ $day_23_row_2 }}</td>
                    <td>{{ $day_23_row_2_percent }}</td>
                    <td>{{ $day_24_row_2 }}</td>
                    <td>{{ $day_24_row_2_percent }}</td>
                    <td>{{ $day_25_row_2 }}</td>
                    <td>{{ $day_25_row_2_percent }}</td>
                    <td>{{ $day_26_row_2 }}</td>
                    <td>{{ $day_26_row_2_percent }}</td>
                    <td>{{ $day_27_row_2 }}</td>
                    <td>{{ $day_27_row_2_percent }}</td>
                    <td>{{ $day_28_row_2 }}</td>
                    <td>{{ $day_28_row_2_percent }}</td>
                    <td>{{ $day_29_row_2 }}</td>
                    <td>{{ $day_29_row_2_percent }}</td>
                    <td>{{ $day_30_row_2 }}</td>
                    <td>{{ $day_30_row_2_percent }}</td>
                    <td>{{ $day_31_row_2 }}</td>
                    <td>{{ $day_31_row_2_percent }}</td>
                  </tr>
                  <tr>
                    <td>4 Bulan 26 Hari - 4 Bulan 29 Hari</td>
                    <td>{{ $day_1_row_3 }}</td>
                    <td>{{ $day_1_row_3_percent }}</td>
                    <td>{{ $day_2_row_3 }}</td>
                    <td>{{ $day_2_row_3_percent }}</td>
                    <td>{{ $day_3_row_3 }}</td>
                    <td>{{ $day_3_row_3_percent }}</td>
                    <td>{{ $day_4_row_3 }}</td>
                    <td>{{ $day_4_row_3_percent }}</td>
                    <td>{{ $day_5_row_3 }}</td>
                    <td>{{ $day_5_row_3_percent }}</td>
                    <td>{{ $day_6_row_3 }}</td>
                    <td>{{ $day_6_row_3_percent }}</td>
                    <td>{{ $day_7_row_3 }}</td>
                    <td>{{ $day_7_row_3_percent }}</td>
                    <td>{{ $day_8_row_3 }}</td>
                    <td>{{ $day_8_row_3_percent }}</td>
                    <td>{{ $day_9_row_3 }}</td>
                    <td>{{ $day_9_row_3_percent }}</td>
                    <td>{{ $day_10_row_3 }}</td>
                    <td>{{ $day_10_row_3_percent }}</td>
                    <td>{{ $day_11_row_3 }}</td>
                    <td>{{ $day_11_row_3_percent }}</td>
                    <td>{{ $day_12_row_3 }}</td>
                    <td>{{ $day_12_row_3_percent }}</td>
                    <td>{{ $day_13_row_3 }}</td>
                    <td>{{ $day_13_row_3_percent }}</td>
                    <td>{{ $day_14_row_3 }}</td>
                    <td>{{ $day_14_row_3_percent }}</td>
                    <td>{{ $day_15_row_3 }}</td>
                    <td>{{ $day_15_row_3_percent }}</td>
                    <td>{{ $day_16_row_3 }}</td>
                    <td>{{ $day_16_row_3_percent }}</td>
                    <td>{{ $day_17_row_3 }}</td>
                    <td>{{ $day_17_row_3_percent }}</td>
                    <td>{{ $day_18_row_3 }}</td>
                    <td>{{ $day_18_row_3_percent }}</td>
                    <td>{{ $day_19_row_3 }}</td>
                    <td>{{ $day_19_row_3_percent }}</td>
                    <td>{{ $day_20_row_3 }}</td>
                    <td>{{ $day_20_row_3_percent }}</td>
                    <td>{{ $day_21_row_3 }}</td>
                    <td>{{ $day_21_row_3_percent }}</td>
                    <td>{{ $day_22_row_3 }}</td>
                    <td>{{ $day_22_row_3_percent }}</td>
                    <td>{{ $day_23_row_3 }}</td>
                    <td>{{ $day_23_row_3_percent }}</td>
                    <td>{{ $day_24_row_3 }}</td>
                    <td>{{ $day_24_row_3_percent }}</td>
                    <td>{{ $day_25_row_3 }}</td>
                    <td>{{ $day_25_row_3_percent }}</td>
                    <td>{{ $day_26_row_3 }}</td>
                    <td>{{ $day_26_row_3_percent }}</td>
                    <td>{{ $day_27_row_3 }}</td>
                    <td>{{ $day_27_row_3_percent }}</td>
                    <td>{{ $day_28_row_3 }}</td>
                    <td>{{ $day_28_row_3_percent }}</td>
                    <td>{{ $day_29_row_3 }}</td>
                    <td>{{ $day_29_row_3_percent }}</td>
                    <td>{{ $day_30_row_3 }}</td>
                    <td>{{ $day_30_row_3_percent }}</td>
                    <td>{{ $day_31_row_3 }}</td>
                    <td>{{ $day_31_row_3_percent }}</td>
                  </tr>
                  <tr>
                    <td>5 Bulan - 5.5 Bulan</td>
                    <td>{{ $day_1_row_4 }}</td>
                    <td>{{ $day_1_row_4_percent }}</td>
                    <td>{{ $day_2_row_4 }}</td>
                    <td>{{ $day_2_row_4_percent }}</td>
                    <td>{{ $day_3_row_4 }}</td>
                    <td>{{ $day_3_row_4_percent }}</td>
                    <td>{{ $day_4_row_4 }}</td>
                    <td>{{ $day_4_row_4_percent }}</td>
                    <td>{{ $day_5_row_4 }}</td>
                    <td>{{ $day_5_row_4_percent }}</td>
                    <td>{{ $day_6_row_4 }}</td>
                    <td>{{ $day_6_row_4_percent }}</td>
                    <td>{{ $day_7_row_4 }}</td>
                    <td>{{ $day_7_row_4_percent }}</td>
                    <td>{{ $day_8_row_4 }}</td>
                    <td>{{ $day_8_row_4_percent }}</td>
                    <td>{{ $day_9_row_4 }}</td>
                    <td>{{ $day_9_row_4_percent }}</td>
                    <td>{{ $day_10_row_4 }}</td>
                    <td>{{ $day_10_row_4_percent }}</td>
                    <td>{{ $day_11_row_4 }}</td>
                    <td>{{ $day_11_row_4_percent }}</td>
                    <td>{{ $day_12_row_4 }}</td>
                    <td>{{ $day_12_row_4_percent }}</td>
                    <td>{{ $day_13_row_4 }}</td>
                    <td>{{ $day_13_row_4_percent }}</td>
                    <td>{{ $day_14_row_4 }}</td>
                    <td>{{ $day_14_row_4_percent }}</td>
                    <td>{{ $day_15_row_4 }}</td>
                    <td>{{ $day_15_row_4_percent }}</td>
                    <td>{{ $day_16_row_4 }}</td>
                    <td>{{ $day_16_row_4_percent }}</td>
                    <td>{{ $day_17_row_4 }}</td>
                    <td>{{ $day_17_row_4_percent }}</td>
                    <td>{{ $day_18_row_4 }}</td>
                    <td>{{ $day_18_row_4_percent }}</td>
                    <td>{{ $day_19_row_4 }}</td>
                    <td>{{ $day_19_row_4_percent }}</td>
                    <td>{{ $day_20_row_4 }}</td>
                    <td>{{ $day_20_row_4_percent }}</td>
                    <td>{{ $day_21_row_4 }}</td>
                    <td>{{ $day_21_row_4_percent }}</td>
                    <td>{{ $day_22_row_4 }}</td>
                    <td>{{ $day_22_row_4_percent }}</td>
                    <td>{{ $day_23_row_4 }}</td>
                    <td>{{ $day_23_row_4_percent }}</td>
                    <td>{{ $day_24_row_4 }}</td>
                    <td>{{ $day_24_row_4_percent }}</td>
                    <td>{{ $day_25_row_4 }}</td>
                    <td>{{ $day_25_row_4_percent }}</td>
                    <td>{{ $day_26_row_4 }}</td>
                    <td>{{ $day_26_row_4_percent }}</td>
                    <td>{{ $day_27_row_4 }}</td>
                    <td>{{ $day_27_row_4_percent }}</td>
                    <td>{{ $day_28_row_4 }}</td>
                    <td>{{ $day_28_row_4_percent }}</td>
                    <td>{{ $day_29_row_4 }}</td>
                    <td>{{ $day_29_row_4_percent }}</td>
                    <td>{{ $day_30_row_4 }}</td>
                    <td>{{ $day_30_row_4_percent }}</td>
                    <td>{{ $day_31_row_4 }}</td>
                    <td>{{ $day_31_row_4_percent }}</td>
                  </tr>
                  <tr>
                    <td>5.6 Bulan - 6 Bulan</td>
                    <td>{{ $day_1_row_5 }}</td>
                    <td>{{ $day_1_row_5_percent }}</td>
                    <td>{{ $day_2_row_5 }}</td>
                    <td>{{ $day_2_row_5_percent }}</td>
                    <td>{{ $day_3_row_5 }}</td>
                    <td>{{ $day_3_row_5_percent }}</td>
                    <td>{{ $day_4_row_5 }}</td>
                    <td>{{ $day_4_row_5_percent }}</td>
                    <td>{{ $day_5_row_5 }}</td>
                    <td>{{ $day_5_row_5_percent }}</td>
                    <td>{{ $day_6_row_5 }}</td>
                    <td>{{ $day_6_row_5_percent }}</td>
                    <td>{{ $day_7_row_5 }}</td>
                    <td>{{ $day_7_row_5_percent }}</td>
                    <td>{{ $day_8_row_5 }}</td>
                    <td>{{ $day_8_row_5_percent }}</td>
                    <td>{{ $day_9_row_5 }}</td>
                    <td>{{ $day_9_row_5_percent }}</td>
                    <td>{{ $day_10_row_5 }}</td>
                    <td>{{ $day_10_row_5_percent }}</td>
                    <td>{{ $day_11_row_5 }}</td>
                    <td>{{ $day_11_row_5_percent }}</td>
                    <td>{{ $day_12_row_5 }}</td>
                    <td>{{ $day_12_row_5_percent }}</td>
                    <td>{{ $day_13_row_5 }}</td>
                    <td>{{ $day_13_row_5_percent }}</td>
                    <td>{{ $day_14_row_5 }}</td>
                    <td>{{ $day_14_row_5_percent }}</td>
                    <td>{{ $day_15_row_5 }}</td>
                    <td>{{ $day_15_row_5_percent }}</td>
                    <td>{{ $day_16_row_5 }}</td>
                    <td>{{ $day_16_row_5_percent }}</td>
                    <td>{{ $day_17_row_5 }}</td>
                    <td>{{ $day_17_row_5_percent }}</td>
                    <td>{{ $day_18_row_5 }}</td>
                    <td>{{ $day_18_row_5_percent }}</td>
                    <td>{{ $day_19_row_5 }}</td>
                    <td>{{ $day_19_row_5_percent }}</td>
                    <td>{{ $day_20_row_5 }}</td>
                    <td>{{ $day_20_row_5_percent }}</td>
                    <td>{{ $day_21_row_5 }}</td>
                    <td>{{ $day_21_row_5_percent }}</td>
                    <td>{{ $day_22_row_5 }}</td>
                    <td>{{ $day_22_row_5_percent }}</td>
                    <td>{{ $day_23_row_5 }}</td>
                    <td>{{ $day_23_row_5_percent }}</td>
                    <td>{{ $day_24_row_5 }}</td>
                    <td>{{ $day_24_row_5_percent }}</td>
                    <td>{{ $day_25_row_5 }}</td>
                    <td>{{ $day_25_row_5_percent }}</td>
                    <td>{{ $day_26_row_5 }}</td>
                    <td>{{ $day_26_row_5_percent }}</td>
                    <td>{{ $day_27_row_5 }}</td>
                    <td>{{ $day_27_row_5_percent }}</td>
                    <td>{{ $day_28_row_5 }}</td>
                    <td>{{ $day_28_row_5_percent }}</td>
                    <td>{{ $day_29_row_5 }}</td>
                    <td>{{ $day_29_row_5_percent }}</td>
                    <td>{{ $day_30_row_5 }}</td>
                    <td>{{ $day_30_row_5_percent }}</td>
                    <td>{{ $day_31_row_5 }}</td>
                    <td>{{ $day_31_row_5_percent }}</td>
                  </tr>
                  <tr>
                    <td>&gt;6 Bulan</td>
                    <td>{{ $day_1_row_6 }}</td>
                    <td>{{ $day_1_row_6_percent }}</td>
                    <td>{{ $day_2_row_6 }}</td>
                    <td>{{ $day_2_row_6_percent }}</td>
                    <td>{{ $day_3_row_6 }}</td>
                    <td>{{ $day_3_row_6_percent }}</td>
                    <td>{{ $day_4_row_6 }}</td>
                    <td>{{ $day_4_row_6_percent }}</td>
                    <td>{{ $day_5_row_6 }}</td>
                    <td>{{ $day_5_row_6_percent }}</td>
                    <td>{{ $day_6_row_6 }}</td>
                    <td>{{ $day_6_row_6_percent }}</td>
                    <td>{{ $day_7_row_6 }}</td>
                    <td>{{ $day_7_row_6_percent }}</td>
                    <td>{{ $day_8_row_6 }}</td>
                    <td>{{ $day_8_row_6_percent }}</td>
                    <td>{{ $day_9_row_6 }}</td>
                    <td>{{ $day_9_row_6_percent }}</td>
                    <td>{{ $day_10_row_6 }}</td>
                    <td>{{ $day_10_row_6_percent }}</td>
                    <td>{{ $day_11_row_6 }}</td>
                    <td>{{ $day_11_row_6_percent }}</td>
                    <td>{{ $day_12_row_6 }}</td>
                    <td>{{ $day_12_row_6_percent }}</td>
                    <td>{{ $day_13_row_6 }}</td>
                    <td>{{ $day_13_row_6_percent }}</td>
                    <td>{{ $day_14_row_6 }}</td>
                    <td>{{ $day_14_row_6_percent }}</td>
                    <td>{{ $day_15_row_6 }}</td>
                    <td>{{ $day_15_row_6_percent }}</td>
                    <td>{{ $day_16_row_6 }}</td>
                    <td>{{ $day_16_row_6_percent }}</td>
                    <td>{{ $day_17_row_6 }}</td>
                    <td>{{ $day_17_row_6_percent }}</td>
                    <td>{{ $day_18_row_6 }}</td>
                    <td>{{ $day_18_row_6_percent }}</td>
                    <td>{{ $day_19_row_6 }}</td>
                    <td>{{ $day_19_row_6_percent }}</td>
                    <td>{{ $day_20_row_6 }}</td>
                    <td>{{ $day_20_row_6_percent }}</td>
                    <td>{{ $day_21_row_6 }}</td>
                    <td>{{ $day_21_row_6_percent }}</td>
                    <td>{{ $day_22_row_6 }}</td>
                    <td>{{ $day_22_row_6_percent }}</td>
                    <td>{{ $day_23_row_6 }}</td>
                    <td>{{ $day_23_row_6_percent }}</td>
                    <td>{{ $day_24_row_6 }}</td>
                    <td>{{ $day_24_row_6_percent }}</td>
                    <td>{{ $day_25_row_6 }}</td>
                    <td>{{ $day_25_row_6_percent }}</td>
                    <td>{{ $day_26_row_6 }}</td>
                    <td>{{ $day_26_row_6_percent }}</td>
                    <td>{{ $day_27_row_6 }}</td>
                    <td>{{ $day_27_row_6_percent }}</td>
                    <td>{{ $day_28_row_6 }}</td>
                    <td>{{ $day_28_row_6_percent }}</td>
                    <td>{{ $day_29_row_6 }}</td>
                    <td>{{ $day_29_row_6_percent }}</td>
                    <td>{{ $day_30_row_6 }}</td>
                    <td>{{ $day_30_row_6_percent }}</td>
                    <td>{{ $day_31_row_6 }}</td>
                    <td>{{ $day_31_row_6_percent }}</td>
                  </tr>
                  <tr style="background-color: #d9d9d9;">
                    <td>Jumlah</td>
                    <td>{{ $total_day_1 }}</td>
                    <td>{{ $total_day_1_percent }}%</td>
                    <td>{{ $total_day_2 }}</td>
                    <td>{{ $total_day_2_percent }}%</td>
                    <td>{{ $total_day_3 }}</td>
                    <td>{{ $total_day_3_percent }}%</td>
                    <td>{{ $total_day_4 }}</td>
                    <td>{{ $total_day_4_percent }}%</td>
                    <td>{{ $total_day_5 }}</td>
                    <td>{{ $total_day_5_percent }}%</td>
                    <td>{{ $total_day_6 }}</td>
                    <td>{{ $total_day_6_percent }}%</td>
                    <td>{{ $total_day_7 }}</td>
                    <td>{{ $total_day_7_percent }}%</td>
                    <td>{{ $total_day_8 }}</td>
                    <td>{{ $total_day_8_percent }}%</td>
                    <td>{{ $total_day_9 }}</td>
                    <td>{{ $total_day_9_percent }}%</td>
                    <td>{{ $total_day_10 }}</td>
                    <td>{{ $total_day_10_percent }}%</td>
                    <td>{{ $total_day_11 }}</td>
                    <td>{{ $total_day_11_percent }}%</td>
                    <td>{{ $total_day_12 }}</td>
                    <td>{{ $total_day_12_percent }}%</td>
                    <td>{{ $total_day_13 }}</td>
                    <td>{{ $total_day_13_percent }}%</td>
                    <td>{{ $total_day_14 }}</td>
                    <td>{{ $total_day_14_percent }}%</td>
                    <td>{{ $total_day_15 }}</td>
                    <td>{{ $total_day_15_percent }}%</td>
                    <td>{{ $total_day_16 }}</td>
                    <td>{{ $total_day_16_percent }}%</td>
                    <td>{{ $total_day_17 }}</td>
                    <td>{{ $total_day_17_percent }}%</td>
                    <td>{{ $total_day_18 }}</td>
                    <td>{{ $total_day_18_percent }}%</td>
                    <td>{{ $total_day_19 }}</td>
                    <td>{{ $total_day_19_percent }}%</td>
                    <td>{{ $total_day_20 }}</td>
                    <td>{{ $total_day_20_percent }}%</td>
                    <td>{{ $total_day_21 }}</td>
                    <td>{{ $total_day_21_percent }}%</td>
                    <td>{{ $total_day_22 }}</td>
                    <td>{{ $total_day_22_percent }}%</td>
                    <td>{{ $total_day_23 }}</td>
                    <td>{{ $total_day_23_percent }}%</td>
                    <td>{{ $total_day_24 }}</td>
                    <td>{{ $total_day_24_percent }}%</td>
                    <td>{{ $total_day_25 }}</td>
                    <td>{{ $total_day_25_percent }}%</td>
                    <td>{{ $total_day_26 }}</td>
                    <td>{{ $total_day_26_percent }}%</td>
                    <td>{{ $total_day_27 }}</td>
                    <td>{{ $total_day_27_percent }}%</td>
                    <td>{{ $total_day_28 }}</td>
                    <td>{{ $total_day_28_percent }}%</td>
                    <td>{{ $total_day_29 }}</td>
                    <td>{{ $total_day_29_percent }}%</td>
                    <td>{{ $total_day_30 }}</td>
                    <td>{{ $total_day_30_percent }}%</td>
                    <td>{{ $total_day_31 }}</td>
                    <td>{{ $total_day_31_percent }}%</td>
                  </tr>
                </tbody>
          </table>

          <table>
            <thead>
              <tr>
                <th>Target Bulanan</th>
                <th>{{ $target_bulanan }}</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Target Selepas QC</td>
                <td>{{ $target_selepas_qc }}</td>
              </tr>
              <tr>
                <td>Tuai Sebenar</td>
                <td>{{ $tuai_sebenar }}</td>
              </tr>
              <tr>
                <td>Beza TB vs TS</td>
                <td>{{ $beza_tb_ts }}</td>
              </tr>
              <tr>
                <td>Beza TSQC vs TS</td>
                <td>{{ $beza_tsqc_ts }}</td>
              </tr>
            </tbody>
          </table>

      </div>

  </div>
