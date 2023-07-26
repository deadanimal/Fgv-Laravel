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
    <h4 class="mt-5">Motherpalm - Master Rekod</h4>
</div>

<div class="col-xl-12 text-left">
      <span><b>Tempoh Laporan: {{$tarikh_mula_word}} - {{$tarikh_akhir_word}}<b></span>
</div>

<div class="col-12 mt-4">
    <div class="table-responsive scrollbar">
        <table class="table table-hover table-bordered overflow-hidden" width="100%">
            <thead class="border border-dark" style="background-color: #d9d9d9;">
                <tr>
                    <th rowspan="2">Bil</th>
                    <th rowspan="2">No.Daftar</th>
                    <th rowspan="2">No.Blok</th>
                    <th rowspan="2">No.Pokok</th>
                    <th rowspan="2">No.Baka</th>
                    <th rowspan="2">Aktiviti</th>
                    <th rowspan="2">Tarikh Aktiviti</th>
                    <th rowspan="2">Status</th>
                    <th rowspan="2">Petugas</th>
                    <th rowspan="2">Penyelia</th>
                    <th rowspan="2">Kerosakan</th>
                    <th rowspan="2">Catatan</th>
                    <th rowspan="2">Peratus Pollen</th>
                    <th rowspan="2">% Viabiliti</th>
                    <th rowspan="2">Umur Tandan</th>
                    <th rowspan="2">Berat Tandan</th>
                </tr>
            </thead>
            <?php
            include_once("../database/Connect.php");

            $tarikh_akhir = date('Y-m-d', strtotime("+1 day", strtotime($tarikh_akhir)));
            $bil = 0;

            $q_selection = "SELECT B.no_bagging, P.blok, P.no_pokok, P.progeny, P.baka, B.created_at, B.status, B.id_sv_balut, B.pengesah_id, B.catatan_pengesah, B.tandan_id
            FROM baggings B       
            INNER JOIN pokoks P
            ON B.pokok_id = P.id
            WHERE P.jantina = 'Motherpalm'
            AND P.baka != 'Pesifera'
            AND B.created_at >= '$tarikh_mula'
            AND B.created_at <= '$tarikh_akhir'";
            $result_selection = $mysqli-> query($q_selection);
            if ($result_selection -> num_rows > 0)
            {
	            while($record_selection = $result_selection -> fetch_assoc())
	            {    
					$no_bagging = $record_selection['no_bagging'];
                    $blok = $record_selection['blok'];
                    $no_pokok_1 = $record_selection['no_pokok'];
                    $progeny = $record_selection['progeny'];
                    $no_pokok = $progeny."-".$no_pokok_1;
                    $baka = $record_selection['baka'];
                    $created_at = date('d-m-Y', strtotime($record_selection['created_at']));
                    $status = $record_selection['status'];
                    $id_sv_balut  = $record_selection['id_sv_balut'];
                    $pengesah_id  = $record_selection['pengesah_id'];
                    $catatan_pengesah  = $record_selection['catatan_pengesah'];
                    $tandan_id  = $record_selection['tandan_id'];

                    $bil = $bil + 1;

                    $sql_user = "SELECT *
				                FROM users
				                Where id  = '$id_sv_balut'";
                    $result_user = $mysqli-> query($sql_user);
                    if ($result_user -> num_rows > 0)
                    {
	                    $row_user = $result_user ->fetch_assoc();
	                    $nama_petugas = $row_user['nama'];
                    }

                    $sql_pengesah = "SELECT *
				                FROM users
				                Where id  = '$pengesah_id'";
                    $result_pengesah = $mysqli-> query($sql_pengesah);
                    if ($result_pengesah -> num_rows > 0)
                    {
	                    $row_pengesah = $result_pengesah ->fetch_assoc();
	                    $nama_penyelia = $row_pengesah['nama'];
                    }

                    $sql_tandan = "SELECT *
				                FROM tandans
				                Where id  = '$tandan_id'";
                    $result_tandan = $mysqli-> query($sql_tandan);
                    if ($result_tandan -> num_rows > 0)
                    {
	                    $row_tandan = $result_tandan ->fetch_assoc();
                        $no_daftar = $row_tandan['no_daftar'];
	                    $umur_tandan = $row_tandan['umur'];
                        $kerosakans_id = $row_tandan['kerosakans_id'];
                    }

                    $sql_kerosakan = "SELECT *
				                FROM kerosakans
				                Where id  = '$kerosakans_id'";
                    $result_kerosakan = $mysqli-> query($sql_kerosakan);
                    if ($result_kerosakan -> num_rows > 0)
                    {
	                    $row_kerosakan = $result_kerosakan ->fetch_assoc();
                        $nama_kerosakan = $row_kerosakan['nama'];
                    }

                    ?>               
            <tbody class="border border-dark">
                <tr>
                    <td>{{ $bil }}</td>
                    <td>{{ $no_daftar }}</td>
                    <td>{{ $blok }}</td>
                    <td>{{ $no_pokok }}</td>
                    <td>{{ $baka }}</td>
                    <td>BAGGING</td>
                    <td>{{ $created_at }}</td>
                    <td>{{ $status }}</td>
                    <td>{{ $nama_petugas }}</td>
                    <td>{{ $nama_penyelia }}</td>
                    <td>{{ $nama_kerosakan }}</td>
                    <td>{{ $catatan_pengesah }}</td>
                    <td></td>
                    <td></td>
                    <td>{{ $umur_tandan }}</td>
                    <td></td>
                </tr>
            </tbody>
            <?php 
            }
            }
            ?>
            <?php
            include_once("../database/Connect.php");

            $tarikh_akhir = date('Y-m-d', strtotime("+1 day", strtotime($tarikh_akhir)));
            $bil = 0;

            $q_selection = "SELECT B.no_cp, P.blok, P.no_pokok, P.progeny, P.baka, B.created_at, B.status, B.id_sv_cp, B.pengesah_id, B.catatan_pengesah, B.tandan_id, B.peratus_pollen
            FROM control_pollinations B       
            INNER JOIN pokoks P
            ON B.pokok_id = P.id
            WHERE P.jantina = 'Motherpalm'
            AND P.baka != 'Pesifera'
            AND B.created_at >= '$tarikh_mula'
            AND B.created_at <= '$tarikh_akhir'";
            $result_selection = $mysqli-> query($q_selection);
            if ($result_selection -> num_rows > 0)
            {
	            while($record_selection = $result_selection -> fetch_assoc())
	            {    
					$no_cp = $record_selection['no_cp'];
                    $blok = $record_selection['blok'];
                    $no_pokok_1 = $record_selection['no_pokok'];
                    $progeny = $record_selection['progeny'];
                    $no_pokok = $progeny."-".$no_pokok_1;
                    $baka = $record_selection['baka'];
                    $created_at = date('d-m-Y', strtotime($record_selection['created_at']));
                    $status = $record_selection['status'];
                    $id_sv_cp  = $record_selection['id_sv_cp'];
                    $pengesah_id  = $record_selection['pengesah_id'];
                    $catatan_pengesah  = $record_selection['catatan_pengesah'];
                    $tandan_id  = $record_selection['tandan_id'];
                    $peratus_pollen  = $record_selection['peratus_pollen'];

                    $bil = $bil + 1;

                    $sql_user = "SELECT *
				                FROM users
				                Where id  = '$id_sv_cp'";
                    $result_user = $mysqli-> query($sql_user);
                    if ($result_user -> num_rows > 0)
                    {
	                    $row_user = $result_user ->fetch_assoc();
	                    $nama_petugas = $row_user['nama'];
                    }

                    $sql_pengesah = "SELECT *
				                FROM users
				                Where id  = '$pengesah_id'";
                    $result_pengesah = $mysqli-> query($sql_pengesah);
                    if ($result_pengesah -> num_rows > 0)
                    {
	                    $row_pengesah = $result_pengesah ->fetch_assoc();
	                    $nama_penyelia = $row_pengesah['nama'];
                    }

                    $sql_tandan = "SELECT *
				                FROM tandans
				                Where id  = '$tandan_id'";
                    $result_tandan = $mysqli-> query($sql_tandan);
                    if ($result_tandan -> num_rows > 0)
                    {
	                    $row_tandan = $result_tandan ->fetch_assoc();
                        $no_daftar = $row_tandan['no_daftar'];
	                    $umur_tandan = $row_tandan['umur'];
                        $kerosakans_id = $row_tandan['kerosakans_id'];
                    }

                    $sql_kerosakan = "SELECT *
				                FROM kerosakans
				                Where id  = '$kerosakans_id'";
                    $result_kerosakan = $mysqli-> query($sql_kerosakan);
                    if ($result_kerosakan -> num_rows > 0)
                    {
	                    $row_kerosakan = $result_kerosakan ->fetch_assoc();
                        $nama_kerosakan = $row_kerosakan['nama'];
                    }

                    ?>               
            <tbody class="border border-dark">
                <tr>
                    <td>{{ $bil }}</td>
                    <td>{{ $no_daftar }}</td>
                    <td>{{ $blok }}</td>
                    <td>{{ $no_pokok }}</td>
                    <td>{{ $baka }}</td>
                    <td>CP</td>
                    <td>{{ $created_at }}</td>
                    <td>{{ $status }}</td>
                    <td>{{ $nama_petugas }}</td>
                    <td>{{ $nama_penyelia }}</td>
                    <td>{{ $nama_kerosakan }}</td>
                    <td>{{ $catatan_pengesah }}</td>
                    <td>{{ $peratus_pollen }}</td>
                    <td></td>
                    <td>{{ $umur_tandan }}</td>
                    <td></td>
                </tr>
            </tbody>
            <?php 
            }
            }
            ?>
            <?php
            include_once("../database/Connect.php");

            $tarikh_akhir = date('Y-m-d', strtotime("+1 day", strtotime($tarikh_akhir)));
            $bil = 0;

            $q_selection = "SELECT B.no_qc, P.blok, P.no_pokok, P.progeny, P.baka, B.created_at, B.status, B.id_sv_qc, B.pengesah_id, B.catatan_pengesah, B.tandan_id
            FROM quality_controls B       
            INNER JOIN pokoks P
            ON B.pokok_id = P.id
            WHERE P.jantina = 'Motherpalm'
            AND P.baka != 'Pesifera'
            AND B.created_at >= '$tarikh_mula'
            AND B.created_at <= '$tarikh_akhir'";
            $result_selection = $mysqli-> query($q_selection);
            if ($result_selection -> num_rows > 0)
            {
	            while($record_selection = $result_selection -> fetch_assoc())
	            {    
					$no_qc = $record_selection['no_qc'];
                    $blok = $record_selection['blok'];
                    $no_pokok_1 = $record_selection['no_pokok'];
                    $progeny = $record_selection['progeny'];
                    $no_pokok = $progeny."-".$no_pokok_1;
                    $baka = $record_selection['baka'];
                    $created_at = date('d-m-Y', strtotime($record_selection['created_at']));
                    $status = $record_selection['status'];
                    $id_sv_qc  = $record_selection['id_sv_qc'];
                    $pengesah_id  = $record_selection['pengesah_id'];
                    $catatan_pengesah  = $record_selection['catatan_pengesah'];
                    $tandan_id  = $record_selection['tandan_id'];
                    $peratus_pollen  = $record_selection['peratus_pollen'];

                    $bil = $bil + 1;

                    $sql_user = "SELECT *
				                FROM users
				                Where id  = '$id_sv_qc'";
                    $result_user = $mysqli-> query($sql_user);
                    if ($result_user -> num_rows > 0)
                    {
	                    $row_user = $result_user ->fetch_assoc();
	                    $nama_petugas = $row_user['nama'];
                    }

                    $sql_pengesah = "SELECT *
				                FROM users
				                Where id  = '$pengesah_id'";
                    $result_pengesah = $mysqli-> query($sql_pengesah);
                    if ($result_pengesah -> num_rows > 0)
                    {
	                    $row_pengesah = $result_pengesah ->fetch_assoc();
	                    $nama_penyelia = $row_pengesah['nama'];
                    }

                    $sql_tandan = "SELECT *
				                FROM tandans
				                Where id  = '$tandan_id'";
                    $result_tandan = $mysqli-> query($sql_tandan);
                    if ($result_tandan -> num_rows > 0)
                    {
	                    $row_tandan = $result_tandan ->fetch_assoc();
                        $no_daftar = $row_tandan['no_daftar'];
	                    $umur_tandan = $row_tandan['umur'];
                        $kerosakans_id = $row_tandan['kerosakans_id'];
                    }

                    $sql_kerosakan = "SELECT *
				                FROM kerosakans
				                Where id  = '$kerosakans_id'";
                    $result_kerosakan = $mysqli-> query($sql_kerosakan);
                    if ($result_kerosakan -> num_rows > 0)
                    {
	                    $row_kerosakan = $result_kerosakan ->fetch_assoc();
                        $nama_kerosakan = $row_kerosakan['nama'];
                    }

                    ?>               
            <tbody class="border border-dark">
                <tr>
                    <td>{{ $bil }}</td>
                    <td>{{ $no_daftar }}</td>
                    <td>{{ $blok }}</td>
                    <td>{{ $no_pokok }}</td>
                    <td>{{ $baka }}</td>
                    <td>QC</td>
                    <td>{{ $created_at }}</td>
                    <td>{{ $status }}</td>
                    <td>{{ $nama_petugas }}</td>
                    <td>{{ $nama_penyelia }}</td>
                    <td>{{ $nama_kerosakan }}</td>
                    <td>{{ $catatan_pengesah }}</td>
                    <td>{{ $peratus_pollen }}</td>
                    <td></td>
                    <td>{{ $umur_tandan }}</td>
                    <td></td>
                </tr>
            </tbody>
            <?php 
            }
            }
            ?>
            <?php
            include_once("../database/Connect.php");

            $tarikh_akhir = date('Y-m-d', strtotime("+1 day", strtotime($tarikh_akhir)));
            $bil = 0;

            $q_selection = "SELECT B.no_harvest, P.blok, P.no_pokok, P.progeny, P.baka, B.created_at, B.status, B.id_sv_harvest, B.pengesah_id, B.catatan_pengesah, B.tandan_id
            FROM harvests B       
            INNER JOIN pokoks P
            ON B.pokok_id = P.id
            WHERE P.jantina = 'Motherpalm'
            AND P.baka != 'Pesifera'
            AND B.created_at >= '$tarikh_mula'
            AND B.created_at <= '$tarikh_akhir'";
            $result_selection = $mysqli-> query($q_selection);
            if ($result_selection -> num_rows > 0)
            {
	            while($record_selection = $result_selection -> fetch_assoc())
	            {    
					$no_harvest = $record_selection['no_harvest'];
                    $blok = $record_selection['blok'];
                    $no_pokok_1 = $record_selection['no_pokok'];
                    $progeny = $record_selection['progeny'];
                    $no_pokok = $progeny."-".$no_pokok_1;
                    $baka = $record_selection['baka'];
                    $created_at = date('d-m-Y', strtotime($record_selection['created_at']));
                    $status = $record_selection['status'];
                    $id_sv_harvest  = $record_selection['id_sv_harvest'];
                    $pengesah_id  = $record_selection['pengesah_id'];
                    $catatan_pengesah  = $record_selection['catatan_pengesah'];
                    $tandan_id  = $record_selection['tandan_id'];

                    $bil = $bil + 1;

                    $sql_user = "SELECT *
				                FROM users
				                Where id  = '$id_sv_harvest'";
                    $result_user = $mysqli-> query($sql_user);
                    if ($result_user -> num_rows > 0)
                    {
	                    $row_user = $result_user ->fetch_assoc();
	                    $nama_petugas = $row_user['nama'];
                    }

                    $sql_pengesah = "SELECT *
				                FROM users
				                Where id  = '$pengesah_id'";
                    $result_pengesah = $mysqli-> query($sql_pengesah);
                    if ($result_pengesah -> num_rows > 0)
                    {
	                    $row_pengesah = $result_pengesah ->fetch_assoc();
	                    $nama_penyelia = $row_pengesah['nama'];
                    }

                    $sql_tandan = "SELECT *
				                FROM tandans
				                Where id  = '$tandan_id'";
                    $result_tandan = $mysqli-> query($sql_tandan);
                    if ($result_tandan -> num_rows > 0)
                    {
	                    $row_tandan = $result_tandan ->fetch_assoc();
                        $no_daftar = $row_tandan['no_daftar'];
	                    $umur_tandan = $row_tandan['umur'];
                        $kerosakans_id = $row_tandan['kerosakans_id'];
                    }

                    $sql_kerosakan = "SELECT *
				                FROM kerosakans
				                Where id  = '$kerosakans_id'";
                    $result_kerosakan = $mysqli-> query($sql_kerosakan);
                    if ($result_kerosakan -> num_rows > 0)
                    {
	                    $row_kerosakan = $result_kerosakan ->fetch_assoc();
                        $nama_kerosakan = $row_kerosakan['nama'];
                    }

                    ?>               
            <tbody class="border border-dark">
                <tr>
                    <td>{{ $bil }}</td>
                    <td>{{ $no_daftar }}</td>
                    <td>{{ $blok }}</td>
                    <td>{{ $no_pokok }}</td>
                    <td>{{ $baka }}</td>
                    <td>HARVEST</td>
                    <td>{{ $created_at }}</td>
                    <td>{{ $status }}</td>
                    <td>{{ $nama_petugas }}</td>
                    <td>{{ $nama_penyelia }}</td>
                    <td>{{ $nama_kerosakan }}</td>
                    <td>{{ $catatan_pengesah }}</td>
                    <td></td>
                    <td></td>
                    <td>{{ $umur_tandan }}</td>
                    <td></td>
                </tr>
            </tbody>
            <?php 
            }
            }
            ?>
        </table>
    </div>

</div>
