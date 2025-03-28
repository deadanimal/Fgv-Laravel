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
      <h6 class="mt-2">Rumusan Pencapaian Penuaian Harian Tandan Ladang Benih</h6>
      <h6 class="mt-2">LAPORAN 1P1F (Motherpalm)</h6>
  </div>
  <div class="col-xl-12 text-left">
      <span><b>Tempoh Laporan: {{$tarikh_mula_word}} - {{$tarikh_akhir_word}}<b></span>
  </div>
  <div class="col-12 mt-4">
      <div class="table-responsive scrollbar">
          <table class="table table-bordered overflow-hidden" width="100%">
              <thead class="border border-dark" style="background-color: #d9d9d9;">
                  <tr>
                      <td>BIL</td>
                      <td>Blok</td>
                      <td>Induk</td>
                      <td>Baka</td>
                      <td>Progeni</td>
                      <td>No.Pokok</td>
                      <td>Nama Pembalut</td>
                      <td>1</td>
                      <td>2</td>
                      <td>3</td>
                      <td>4</td>
                      <td>5</td>
                      <td>6</td>
                      <td>7</td>
                      <td>8</td>
                      <td>9</td>
                      <td>10</td>
                      <td>11</td>
                      <td>12</td>
                      <td>13</td>
                      <td>14</td>
                      <td>15</td>
                      <td>16</td>
                      <td>17</td>
                      <td>18</td>
                      <td>19</td>
                      <td>20</td>
                      <td>21</td>
                      <td>22</td>
                      <td>23</td>
                      <td>24</td>
                      <td>25</td>
                      <td>26</td>
                      <td>27</td>
                      <td>28</td>
                      <td>29</td>
                      <td>30</td>
                      <td>31</td>
                      <td>Jumlah</td>
                      <td>Catatan</td>
                  </tr>
              </thead>
              <tbody class="border border-dark">
                <?php
                include_once("../database/Connect.php");

                $tarikh_akhir = date('Y-m-d', strtotime("+1 day", strtotime($tarikh_akhir)));
                $bil = 0;

                $q = "SELECT B.id, P.blok, P.induk, P.jantina, P.baka, P.progeny, P.no_pokok, B.id_sv_balut, B.catatan
                FROM baggings B
                INNER JOIN pokoks P
                ON B.pokok_id = P.id
                WHERE B.jenis = 'Balut'
                AND P.jantina = 'Motherpalm'
                AND P.baka != 'Pesifera'
                AND B.created_at >= '$tarikh_mula'
                AND B.created_at <= '$tarikh_akhir'
                GROUP BY id_sv_balut, P.blok, P.baka
                ORDER BY id_sv_balut";
                $result = $mysqli-> query($q);
                if ($result -> num_rows > 0)
                {
	                while($record = $result -> fetch_assoc())
	                {    
						$id = $record['id'];
                        $blok = $record['blok'];
                        $jantina = $record['jantina'];
                        $baka = $record['baka'];
                        $progeny = $record['progeny'];
                        $no_pokok_1 = $record['no_pokok'];
                        $no_pokok = $progeny."-".$no_pokok_1;
                        $id_sv_balut  = $record['id_sv_balut'];
                        $catatan  = $record['catatan'];

                        $sql_user = "SELECT *
				                    FROM users
				                    Where id  = '$id_sv_balut'";
                        $result_user = $mysqli-> query($sql_user);
                        if ($result_user -> num_rows > 0)
                        {
	                        $row_user = $result_user ->fetch_assoc();
	                        $user_nama = $row_user['nama'];
                        }

                        $sql_data = "SELECT COUNT(B.id) As num 
                        FROM baggings B
                        INNER JOIN pokoks P
                        ON B.pokok_id = P.id
                        WHERE B.jenis = 'Balut'
                        AND B.id_sv_balut = '$id_sv_balut'
                        AND P.jantina = 'Motherpalm'
                        AND P.blok = '$blok'
                        AND P.baka = '$baka'
                        AND P.baka != 'Pesifera'
                        AND B.created_at Like '$selected_year-$selected_bulan-%'";
                        $result_data = $mysqli->query($sql_data);
                        $row_data = $result_data->fetch_assoc();
                        $total_data_kanan = $row_data['num'];

                        $bil = $bil + 1;

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

                            $sql_data = "SELECT COUNT(B.id) As num 
                            FROM baggings B
                            INNER JOIN pokoks P
                            ON B.pokok_id = P.id
                            WHERE B.jenis = 'Balut'
                            AND B.id_sv_balut = '$id_sv_balut'
                            AND P.jantina = 'Motherpalm'
                            AND P.blok = '$blok'
                            AND P.baka = '$baka'
                            AND P.baka != 'Pesifera'
                            AND B.created_at Like '$selected_year-$selected_bulan-$i_value%'";
                            $result_data = $mysqli->query($sql_data);
                            $row_data = $result_data->fetch_assoc();
                            $total_data = $row_data['num'];

                            $sql_data_jumlah_bawah = "SELECT COUNT(B.id) As num 
                            FROM baggings B
                            INNER JOIN pokoks P
                            ON B.pokok_id = P.id
                            WHERE B.jenis = 'Balut'
                            AND P.jantina = 'Motherpalm'
                            AND P.baka != 'Pesifera'
                            AND B.created_at Like '$selected_year-$selected_bulan-$i_value%'";
                            $result_data_jumlah_bawah = $mysqli->query($sql_data_jumlah_bawah);
                            $row_data_jumlah_bawah = $result_data_jumlah_bawah->fetch_assoc();
                            $total_data_jumlah_bawah = $row_data_jumlah_bawah['num'];

                            if ($i == 1)
                            {
                                $day_1 = $total_data;
                                $day_1_bawah = $total_data_jumlah_bawah;
                            }
                            
                            if ($i == 2)
                            {
                                $day_2 = $total_data;
                                $day_2_bawah = $total_data_jumlah_bawah;
                            }
                            
                            if ($i == 3)
                            {
                                $day_3 = $total_data;
                                $day_3_bawah = $total_data_jumlah_bawah;
                            }
                            
                            if ($i == 4)
                            {
                                $day_4 = $total_data;
                                $day_4_bawah = $total_data_jumlah_bawah;
                            }
                            
                            if ($i == 5)
                            {
                                $day_5 = $total_data;
                                $day_5_bawah = $total_data_jumlah_bawah;
                            }
                            
                            if ($i == 6)
                            {
                                $day_6 = $total_data;
                                $day_6_bawah = $total_data_jumlah_bawah;
                            }
                            
                            if ($i == 7)
                            {
                                $day_7 = $total_data;
                                $day_7_bawah = $total_data_jumlah_bawah;
                            }
                            
                            if ($i == 8)
                            {
                                $day_8 = $total_data;
                                $day_8_bawah = $total_data_jumlah_bawah;
                            }
                            
                            if ($i == 9)
                            {
                                $day_9 = $total_data;
                                $day_9_bawah = $total_data_jumlah_bawah;
                            }
                            
                            if ($i == 10)
                            {
                                $day_10 = $total_data;
                                $day_10_bawah = $total_data_jumlah_bawah;
                            }
                            
                            if ($i == 11)
                            {
                                $day_11 = $total_data;
                                $day_11_bawah = $total_data_jumlah_bawah;
                            }
                            
                            if ($i == 12)
                            {
                                $day_12 = $total_data;
                                $day_12_bawah = $total_data_jumlah_bawah;
                            }
                            
                            if ($i == 13)
                            {
                                $day_13 = $total_data;
                                $day_13_bawah = $total_data_jumlah_bawah;
                            }
                            
                            if ($i == 14)
                            {
                                $day_14 = $total_data;
                                $day_14_bawah = $total_data_jumlah_bawah;
                            }
                            
                            if ($i == 15)
                            {
                                $day_15 = $total_data;
                                $day_15_bawah = $total_data_jumlah_bawah;
                            }
                            
                            if ($i == 16)
                            {
                                $day_16 = $total_data;
                                $day_16_bawah = $total_data_jumlah_bawah;
                            }
                            
                            if ($i == 17)
                            {
                                $day_17 = $total_data;
                                $day_17_bawah = $total_data_jumlah_bawah;
                            }
                            
                            if ($i == 18)
                            {
                                $day_18 = $total_data;
                                $day_18_bawah = $total_data_jumlah_bawah;
                            }
                            
                            if ($i == 19)
                            {
                                $day_19 = $total_data;
                                $day_19_bawah = $total_data_jumlah_bawah;
                            }
                            
                            if ($i == 20)
                            {
                                $day_20 = $total_data;
                                $day_20_bawah = $total_data_jumlah_bawah;
                            }
                            
                            if ($i == 21)
                            {
                                $day_21 = $total_data;
                                $day_21_bawah = $total_data_jumlah_bawah;
                            }
                            
                            if ($i == 22)
                            {
                                $day_22 = $total_data;
                                $day_22_bawah = $total_data_jumlah_bawah;
                            }
                            
                            if ($i == 23)
                            {
                                $day_23 = $total_data;
                                $day_23_bawah = $total_data_jumlah_bawah;
                            }
                            
                            if ($i == 24)
                            {
                                $day_24 = $total_data;
                                $day_24_bawah = $total_data_jumlah_bawah;
                            }
                            
                            if ($i == 25)
                            {
                                $day_25 = $total_data;
                                $day_25_bawah = $total_data_jumlah_bawah;
                            }
                            
                            if ($i == 26)
                            {
                                $day_26 = $total_data;
                                $day_26_bawah = $total_data_jumlah_bawah;
                            }
                            
                            if ($i == 27)
                            {
                                $day_27 = $total_data;
                                $day_27_bawah = $total_data_jumlah_bawah;
                            }
                            
                            if ($i == 28)
                            {
                                $day_28 = $total_data;
                                $day_28_bawah = $total_data_jumlah_bawah;
                            }
                            
                            if ($i == 29)
                            {
                                $day_29 = $total_data;
                                $day_29_bawah = $total_data_jumlah_bawah;
                            }
                            
                            if ($i == 30)
                            {
                                $day_30 = $total_data;
                                $day_30_bawah = $total_data_jumlah_bawah;
                            }
                            
                            if ($i == 31)
                            {
                                $day_31 = $total_data;
                                $day_31_bawah = $total_data_jumlah_bawah;
                            }
                        }
                ?>
                <tr>
                    <td>{{ $bil }}</td>
                    <td>{{ $blok }}</td>
                    <td>{{ $jantina }}</td>
                    <td>{{ $baka }}</td>
                    <td>{{ $progeny }}</td>
                    <td>{{ $no_pokok }}</td>
                    <td>{{ $user_nama }}</td>
                    <td>{{ $day_1 }}</td>
                    <td>{{ $day_2 }}</td>
                    <td>{{ $day_3 }}</td>
                    <td>{{ $day_4 }}</td>
                    <td>{{ $day_5 }}</td>
                    <td>{{ $day_6 }}</td>
                    <td>{{ $day_7 }}</td>
                    <td>{{ $day_8 }}</td>
                    <td>{{ $day_9 }}</td>
                    <td>{{ $day_10 }}</td>
                    <td>{{ $day_11 }}</td>
                    <td>{{ $day_12 }}</td>
                    <td>{{ $day_13 }}</td>
                    <td>{{ $day_14 }}</td>
                    <td>{{ $day_15 }}</td>
                    <td>{{ $day_16 }}</td>
                    <td>{{ $day_17 }}</td>
                    <td>{{ $day_18 }}</td>
                    <td>{{ $day_19 }}</td>
                    <td>{{ $day_20 }}</td>
                    <td>{{ $day_21 }}</td>
                    <td>{{ $day_22 }}</td>
                    <td>{{ $day_23 }}</td>
                    <td>{{ $day_24 }}</td>
                    <td>{{ $day_25 }}</td>
                    <td>{{ $day_26 }}</td>
                    <td>{{ $day_27 }}</td>
                    <td>{{ $day_28 }}</td>
                    <td>{{ $day_29 }}</td>
                    <td>{{ $day_30 }}</td>
                    <td>{{ $day_31 }}</td>
                    <td>{{ $total_data_kanan }}</td>
                    <td>{{ $catatan }}</td>
                </tr>
                <?php 
                }
                }
                ?>
                  <thead class="border border-dark" style="background-color: #d9d9d9;">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Jumlah</td>
                        <td>{{ $day_1_bawah }}</td>
                        <td>{{ $day_2_bawah }}</td>
                        <td>{{ $day_3_bawah }}</td>
                        <td>{{ $day_4_bawah }}</td>
                        <td>{{ $day_5_bawah }}</td>
                        <td>{{ $day_6_bawah }}</td>
                        <td>{{ $day_7_bawah }}</td>
                        <td>{{ $day_8_bawah }}</td>
                        <td>{{ $day_9_bawah }}</td>
                        <td>{{ $day_10_bawah }}</td>
                        <td>{{ $day_11_bawah }}</td>
                        <td>{{ $day_12_bawah }}</td>
                        <td>{{ $day_13_bawah }}</td>
                        <td>{{ $day_14_bawah }}</td>
                        <td>{{ $day_15_bawah }}</td>
                        <td>{{ $day_16_bawah }}</td>
                        <td>{{ $day_17_bawah }}</td>
                        <td>{{ $day_18_bawah }}</td>
                        <td>{{ $day_19_bawah }}</td>
                        <td>{{ $day_20_bawah }}</td>
                        <td>{{ $day_21_bawah }}</td>
                        <td>{{ $day_22_bawah }}</td>
                        <td>{{ $day_23_bawah }}</td>
                        <td>{{ $day_24_bawah }}</td>
                        <td>{{ $day_25_bawah }}</td>
                        <td>{{ $day_26_bawah }}</td>
                        <td>{{ $day_27_bawah }}</td>
                        <td>{{ $day_28_bawah }}</td>
                        <td>{{ $day_29_bawah }}</td>
                        <td>{{ $day_30_bawah }}</td>
                        <td>{{ $day_31_bawah }}</td>
                        <td></td>
                        <td></td>
                  </thead>
              </tbody>
          </table>
      </div>
  </div>
