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

                $q = "SELECT *
                FROM pokoks
                WHERE jantina = 'Motherpalm'
                AND created_at >= '$tarikh_mula'
                AND created_at <= '$tarikh_akhir'";
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
                        $user_id  = $record['user_id'];
                        $catatan  = $record['catatan'];

                        $sql_user = "SELECT *
				                    FROM users
				                    Where id  = '$user_id'";
                        $result_user = $mysqli-> query($sql_user);
                        if ($result_user -> num_rows > 0)
                        {
	                        $row_user = $result_user ->fetch_assoc();
	                        $user_nama = $row_user['nama'];
                        }

                        $bil = $bil + 1;
                ?>
                <tr>
                    <td>{{ $bil }}</td>
                    <td>{{ $blok }}</td>
                    <td>{{ $induk }}</td>
                    <td>{{ $baka }}</td>
                    <td>{{ $progeny }}</td>
                    <td>{{ $no_pokok }}</td>
                    <td>{{ $user_nama }}</td>
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
                      <td></td>
                      <td></td>
                </tr>
                <?php 
                }
                }
                ?>
                  <thead class="border border-dark" style="background-color: #d9d9d9;">
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Jumlah</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                  </thead>
              </tbody>
          </table>
      </div>
  </div>
