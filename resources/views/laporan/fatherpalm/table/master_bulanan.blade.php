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
    <h4 class="mt-5">Fatherpalm - Master Rekod</h4>
</div>

<div class="col-xl-12 text-left">
    <span><b>Tempoh Laporan: {{$bulan_word}} {{$tahun}} - {{$bulan_akhir_word}} {{$tahun}}<b></span>
</div>

<div class="col-12 mt-4">
    <div class="table-responsive scrollbar">
        <table class="table table-hover table-bordered overflow-hidden" width="100%">
            <thead class="border border-dark" style="background-color: #d9d9d9;">
              <tr>
                <th rowspan="2">No. Daftar</th>
                <th rowspan="2">Nama Petugas</th>
                <th rowspan="2">Progeni</th>
                <th rowspan="2">Aktiviti</th>
                <th rowspan="2">Tarikh Aktiviti</th>
                <th rowspan="2">Status</th>
                <th colspan="2">4 Jam Bilik Panas</th>
                <th colspan="2">24 Jam Bilik Panas</th>
                <th rowspan="2">Peratus Pollen</th>
                <th rowspan="2">QC Passed</th>
                <th rowspan="2">Viabiliti Pollen</th>
                <th rowspan="2">%</th>
                <th rowspan="2">Berat Pollen</th>
                <th rowspan="2">Catatan</th>
              </tr>
              <tr>
                <th>Waktu Masuk</th>
                <th>Waktu Keluar</th>
                <th>Waktu Masuk</th>
                <th>Waktu Keluar</th>
              </tr>
            </thead>
            <?php
            include_once("../database/Connect.php");

            $tarikh_akhir = date('Y-m-d', strtotime("+1 day", strtotime($tarikh_akhir)));
            $bil = 0;

            $q_selection = "SELECT P.blok, P.no_pokok, P.baka, P.progeny, B.created_at, B.no_pollen, B.viabiliti_pollen, B.berat_pollen, B.status, B.id_sv_pollen, B.pengesah_id, B.catatan_pengesah, B.tandan_id,
            B.tarikh_ketuk, B.tarikh_ayak, B.tarikh_uji, B.tarikh_qc,
            B.masa_masuk_pertama, B.masa_keluar_pertama, B.masa_masuk_kedua, B.masa_keluar_kedua
            FROM pollens B       
            INNER JOIN pokoks P
            ON B.pokok_id = P.id
            WHERE P.jantina = 'Fatherpalm'
            AND B.created_at >= '$tahun-$bulan-01'
            AND B.created_at <= '$tahun-$bulan_akhir-31'";
            $result_selection = $mysqli-> query($q_selection);
            if ($result_selection -> num_rows > 0)
            {
	            while($record_selection = $result_selection -> fetch_assoc())
	            {    
                    $blok = $record_selection['blok'];
                    $no_pokok = $record_selection['no_pokok'];
                    $baka = $record_selection['baka'];
                    $progeny = $record_selection['progeny'];
                    $created_at = date('d-m-Y', strtotime($record_selection['created_at']));
                    $no_pollen = $record_selection['no_pollen'];
                    $viabiliti_pollen = $record_selection['viabiliti_pollen'];
                    $berat_pollen = $record_selection['berat_pollen'];
                    $status = $record_selection['status'];
                    $id_sv_pollen  = $record_selection['id_sv_pollen'];
                    $pengesah_id  = $record_selection['pengesah_id'];
                    $catatan_pengesah  = $record_selection['catatan_pengesah'];
                    $tandan_id  = $record_selection['tandan_id'];
                    $tarikh_ketuk  = $record_selection['tarikh_ketuk'];
                    $tarikh_ayak  = $record_selection['tarikh_ayak'];
                    $tarikh_uji  = $record_selection['tarikh_uji'];
                    $tarikh_qc  = $record_selection['tarikh_qc'];
                    $masa_masuk_pertama  = date('d-m-Y h:i:s a', strtotime($record_selection['masa_masuk_pertama']));
                    $masa_keluar_pertama  = date('d-m-Y h:i:s a', strtotime($record_selection['masa_keluar_pertama']));
                    $masa_masuk_kedua  = date('d-m-Y h:i:s a', strtotime($record_selection['masa_masuk_kedua']));
                    $masa_keluar_kedua  = date('d-m-Y h:i:s a', strtotime($record_selection['masa_keluar_kedua']));

                    $bil = $bil + 1;

                    if ($tarikh_ketuk != "")
                    {
                        $aktiviti = "Ketuk";
                        $tarikh_aktiviti = date('d-m-Y', strtotime($tarikh_ketuk));
                    }
                    else
                    if ($tarikh_ayak != "")
                    {
                        $aktiviti = "Ayak";
                        $tarikh_aktiviti = date('d-m-Y', strtotime($tarikh_ayak));
                    }
                    else
                    if ($tarikh_uji != "")
                    {
                        $aktiviti = "";
                        $tarikh_aktiviti = date('d-m-Y', strtotime($tarikh_uji));
                    }
                    else
                    if ($tarikh_qc != "")
                    {
                        $aktiviti = "QC";
                        $tarikh_aktiviti = date('d-m-Y', strtotime($tarikh_qc));
                    }


                    $sql_user = "SELECT *
				                FROM users
				                Where id  = '$id_sv_pollen'";
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
	                    $pengesah_nama = $row_pengesah['nama'];
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

                    $sql_cp = "SELECT *
				              FROM control_pollinations
				              Where no_pollen  = '$no_pollen'";
                    $result_cp = $mysqli-> query($sql_cp);
                    if ($result_cp -> num_rows > 0)
                    {
	                    $row_cp = $result_cp ->fetch_assoc();
                        $peratus_pollen = $row_cp['peratus_pollen'];
                        $status_qc = $row_cp['status'];
                    }

                    ?>               
            <tbody class="border border-dark">
                <tr>
                    <td>{{ $no_daftar }}</td>
                    <td>{{ $nama_petugas }}</td>
                    <td>{{ $progeny }}</td>
                    <td>{{ $aktiviti }}</td>
                    <td>{{ $tarikh_aktiviti }}</td>
                    <td>{{ $status }}</td>
                    <td>{{ $masa_masuk_pertama }}</td>
                    <td>{{ $masa_keluar_pertama }}</td>
                    <td>{{ $masa_masuk_kedua }}</td>
                    <td>{{ $masa_keluar_kedua }}</td>
                    <td>{{ $peratus_pollen }}</td>
                    <td>{{ $status_qc }}</td>
                    <td>{{ $viabiliti_pollen }}</td>
                    <td>{{ $viabiliti_pollen }}</td>
                    <td>{{ $berat_pollen }}</td>
                    <td>{{ $catatan_pengesah }}</td>
                </tr>
            </tbody>
            <?php 
            }
            }
            ?>
        </table>
    </div>

</div>
