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
  <div class="col-12 mt-4">
      <div class="table-responsive scrollbar">
          <table class="table table-hover table-bordered overflow-hidden" width="100%">
              <thead class="border border-dark">
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
              @switch($bulan)
                  @case('01')
                  <tr>
                    <td>Jan</td>
                    <td>{{ $result[1] }}</td>
                    <td>{{ $result[2] }}</td>
                    <td>{{ $result[3] }}</td>
                    <td>{{ $result[4] }}</td>
                    <td>{{ $result[5] }}</td>
                    <td>{{ $result[6] }}</td>
                    <td>{{ $result[7] }}</td>
                    <td>{{ $result[8] }}</td>
                    <td>{{ $result[9] }}</td>
                    <td>{{ $result[10] }}</td>
                    <td>{{ $result[11] }}</td>
                    <td>{{ $result[12] }}</td>
                    <td>{{ $result[13] }}</td>
                    <td>{{ $result[14] }}</td>
                    <td>{{ $result[15] }}</td>
                    <td>{{ $result[16] }}</td>
                    <td>{{ $result[17] }}</td>
                    <td>{{ $result[18] }}</td>
                    <td>{{ $result[19] }}</td>
                    <td>{{ $result[20] }}</td>
                    <td>{{ $result[21] }}</td>
                    <td>{{ $result[22] }}</td>
                  </tr>
                  @break

                  @case('02')
                  <tr>
                    <td>Feb</td>
                    <td>{{ $result[1] }}</td>
                    <td>{{ $result[2] }}</td>
                    <td>{{ $result[3] }}</td>
                    <td>{{ $result[4] }}</td>
                    <td>{{ $result[5] }}</td>
                    <td>{{ $result[6] }}</td>
                    <td>{{ $result[7] }}</td>
                    <td>{{ $result[8] }}</td>
                    <td>{{ $result[9] }}</td>
                    <td>{{ $result[10] }}</td>
                    <td>{{ $result[11] }}</td>
                    <td>{{ $result[12] }}</td>
                    <td>{{ $result[13] }}</td>
                    <td>{{ $result[14] }}</td>
                    <td>{{ $result[15] }}</td>
                    <td>{{ $result[16] }}</td>
                    <td>{{ $result[17] }}</td>
                    <td>{{ $result[18] }}</td>
                    <td>{{ $result[19] }}</td>
                    <td>{{ $result[20] }}</td>
                    <td>{{ $result[21] }}</td>
                    <td>{{ $result[22] }}</td>
                  </tr>
                  @break

                  @case('03')
                  <tr>
                    <td>Mac</td>
                    <td>{{ $result[1] }}</td>
                    <td>{{ $result[2] }}</td>
                    <td>{{ $result[3] }}</td>
                    <td>{{ $result[4] }}</td>
                    <td>{{ $result[5] }}</td>
                    <td>{{ $result[6] }}</td>
                    <td>{{ $result[7] }}</td>
                    <td>{{ $result[8] }}</td>
                    <td>{{ $result[9] }}</td>
                    <td>{{ $result[10] }}</td>
                    <td>{{ $result[11] }}</td>
                    <td>{{ $result[12] }}</td>
                    <td>{{ $result[13] }}</td>
                    <td>{{ $result[14] }}</td>
                    <td>{{ $result[15] }}</td>
                    <td>{{ $result[16] }}</td>
                    <td>{{ $result[17] }}</td>
                    <td>{{ $result[18] }}</td>
                    <td>{{ $result[19] }}</td>
                    <td>{{ $result[20] }}</td>
                    <td>{{ $result[21] }}</td>
                    <td>{{ $result[22] }}</td>
                  </tr>
                  @break

                  @case('04')
                  <tr>
                    <td>April</td>
                    <td>{{ $result[1] }}</td>
                    <td>{{ $result[2] }}</td>
                    <td>{{ $result[3] }}</td>
                    <td>{{ $result[4] }}</td>
                    <td>{{ $result[5] }}</td>
                    <td>{{ $result[6] }}</td>
                    <td>{{ $result[7] }}</td>
                    <td>{{ $result[8] }}</td>
                    <td>{{ $result[9] }}</td>
                    <td>{{ $result[10] }}</td>
                    <td>{{ $result[11] }}</td>
                    <td>{{ $result[12] }}</td>
                    <td>{{ $result[13] }}</td>
                    <td>{{ $result[14] }}</td>
                    <td>{{ $result[15] }}</td>
                    <td>{{ $result[16] }}</td>
                    <td>{{ $result[17] }}</td>
                    <td>{{ $result[18] }}</td>
                    <td>{{ $result[19] }}</td>
                    <td>{{ $result[20] }}</td>
                    <td>{{ $result[21] }}</td>
                    <td>{{ $result[22] }}</td>
                  </tr>
                  @break

                  @case('05')
                  <tr>
                    <td>Mei</td>
                    <td>{{ $result[1] }}</td>
                    <td>{{ $result[2] }}</td>
                    <td>{{ $result[3] }}</td>
                    <td>{{ $result[4] }}</td>
                    <td>{{ $result[5] }}</td>
                    <td>{{ $result[6] }}</td>
                    <td>{{ $result[7] }}</td>
                    <td>{{ $result[8] }}</td>
                    <td>{{ $result[9] }}</td>
                    <td>{{ $result[10] }}</td>
                    <td>{{ $result[11] }}</td>
                    <td>{{ $result[12] }}</td>
                    <td>{{ $result[13] }}</td>
                    <td>{{ $result[14] }}</td>
                    <td>{{ $result[15] }}</td>
                    <td>{{ $result[16] }}</td>
                    <td>{{ $result[17] }}</td>
                    <td>{{ $result[18] }}</td>
                    <td>{{ $result[19] }}</td>
                    <td>{{ $result[20] }}</td>
                    <td>{{ $result[21] }}</td>
                    <td>{{ $result[22] }}</td>
                  </tr>
                  @break

                  @case('06')
                  <tr>
                    <td>Jun</td>
                    <td>{{ $result[1] }}</td>
                    <td>{{ $result[2] }}</td>
                    <td>{{ $result[3] }}</td>
                    <td>{{ $result[4] }}</td>
                    <td>{{ $result[5] }}</td>
                    <td>{{ $result[6] }}</td>
                    <td>{{ $result[7] }}</td>
                    <td>{{ $result[8] }}</td>
                    <td>{{ $result[9] }}</td>
                    <td>{{ $result[10] }}</td>
                    <td>{{ $result[11] }}</td>
                    <td>{{ $result[12] }}</td>
                    <td>{{ $result[13] }}</td>
                    <td>{{ $result[14] }}</td>
                    <td>{{ $result[15] }}</td>
                    <td>{{ $result[16] }}</td>
                    <td>{{ $result[17] }}</td>
                    <td>{{ $result[18] }}</td>
                    <td>{{ $result[19] }}</td>
                    <td>{{ $result[20] }}</td>
                    <td>{{ $result[21] }}</td>
                    <td>{{ $result[22] }}</td>
                  </tr>
                  @break

                  @case('07')
                  <tr>
                    <td>Jul</td>
                    <td>{{ $result[1] }}</td>
                    <td>{{ $result[2] }}</td>
                    <td>{{ $result[3] }}</td>
                    <td>{{ $result[4] }}</td>
                    <td>{{ $result[5] }}</td>
                    <td>{{ $result[6] }}</td>
                    <td>{{ $result[7] }}</td>
                    <td>{{ $result[8] }}</td>
                    <td>{{ $result[9] }}</td>
                    <td>{{ $result[10] }}</td>
                    <td>{{ $result[11] }}</td>
                    <td>{{ $result[12] }}</td>
                    <td>{{ $result[13] }}</td>
                    <td>{{ $result[14] }}</td>
                    <td>{{ $result[15] }}</td>
                    <td>{{ $result[16] }}</td>
                    <td>{{ $result[17] }}</td>
                    <td>{{ $result[18] }}</td>
                    <td>{{ $result[19] }}</td>
                    <td>{{ $result[20] }}</td>
                    <td>{{ $result[21] }}</td>
                    <td>{{ $result[22] }}</td>
                  </tr>
                  @break

                  @case('08')
                  <tr>
                    <td>Ogos</td>
                    <td>{{ $result[1] }}</td>
                    <td>{{ $result[2] }}</td>
                    <td>{{ $result[3] }}</td>
                    <td>{{ $result[4] }}</td>
                    <td>{{ $result[5] }}</td>
                    <td>{{ $result[6] }}</td>
                    <td>{{ $result[7] }}</td>
                    <td>{{ $result[8] }}</td>
                    <td>{{ $result[9] }}</td>
                    <td>{{ $result[10] }}</td>
                    <td>{{ $result[11] }}</td>
                    <td>{{ $result[12] }}</td>
                    <td>{{ $result[13] }}</td>
                    <td>{{ $result[14] }}</td>
                    <td>{{ $result[15] }}</td>
                    <td>{{ $result[16] }}</td>
                    <td>{{ $result[17] }}</td>
                    <td>{{ $result[18] }}</td>
                    <td>{{ $result[19] }}</td>
                    <td>{{ $result[20] }}</td>
                    <td>{{ $result[21] }}</td>
                    <td>{{ $result[22] }}</td>
                  </tr>
                  @break

                  @case('09')
                  <tr>
                    <td>Sep</td>
                    <td>{{ $result[1] }}</td>
                    <td>{{ $result[2] }}</td>
                    <td>{{ $result[3] }}</td>
                    <td>{{ $result[4] }}</td>
                    <td>{{ $result[5] }}</td>
                    <td>{{ $result[6] }}</td>
                    <td>{{ $result[7] }}</td>
                    <td>{{ $result[8] }}</td>
                    <td>{{ $result[9] }}</td>
                    <td>{{ $result[10] }}</td>
                    <td>{{ $result[11] }}</td>
                    <td>{{ $result[12] }}</td>
                    <td>{{ $result[13] }}</td>
                    <td>{{ $result[14] }}</td>
                    <td>{{ $result[15] }}</td>
                    <td>{{ $result[16] }}</td>
                    <td>{{ $result[17] }}</td>
                    <td>{{ $result[18] }}</td>
                    <td>{{ $result[19] }}</td>
                    <td>{{ $result[20] }}</td>
                    <td>{{ $result[21] }}</td>
                    <td>{{ $result[22] }}</td>
                  </tr>
                  @break

                  @case('10')
                  <tr>
                    <td>Okt</td>
                    <td>{{ $result[1] }}</td>
                    <td>{{ $result[2] }}</td>
                    <td>{{ $result[3] }}</td>
                    <td>{{ $result[4] }}</td>
                    <td>{{ $result[5] }}</td>
                    <td>{{ $result[6] }}</td>
                    <td>{{ $result[7] }}</td>
                    <td>{{ $result[8] }}</td>
                    <td>{{ $result[9] }}</td>
                    <td>{{ $result[10] }}</td>
                    <td>{{ $result[11] }}</td>
                    <td>{{ $result[12] }}</td>
                    <td>{{ $result[13] }}</td>
                    <td>{{ $result[14] }}</td>
                    <td>{{ $result[15] }}</td>
                    <td>{{ $result[16] }}</td>
                    <td>{{ $result[17] }}</td>
                    <td>{{ $result[18] }}</td>
                    <td>{{ $result[19] }}</td>
                    <td>{{ $result[20] }}</td>
                    <td>{{ $result[21] }}</td>
                    <td>{{ $result[22] }}</td>
                  </tr>
                  @break

                  @case('11')
                  <tr>
                    <td>Nov</td>
                    <td>{{ $result[1] }}</td>
                    <td>{{ $result[2] }}</td>
                    <td>{{ $result[3] }}</td>
                    <td>{{ $result[4] }}</td>
                    <td>{{ $result[5] }}</td>
                    <td>{{ $result[6] }}</td>
                    <td>{{ $result[7] }}</td>
                    <td>{{ $result[8] }}</td>
                    <td>{{ $result[9] }}</td>
                    <td>{{ $result[10] }}</td>
                    <td>{{ $result[11] }}</td>
                    <td>{{ $result[12] }}</td>
                    <td>{{ $result[13] }}</td>
                    <td>{{ $result[14] }}</td>
                    <td>{{ $result[15] }}</td>
                    <td>{{ $result[16] }}</td>
                    <td>{{ $result[17] }}</td>
                    <td>{{ $result[18] }}</td>
                    <td>{{ $result[19] }}</td>
                    <td>{{ $result[20] }}</td>
                    <td>{{ $result[21] }}</td>
                    <td>{{ $result[22] }}</td>
                  </tr>
                  @break

                  @case('12')
                  <tr>
                    <td>Dis</td>
                    <td>{{ $result[1] }}</td>
                    <td>{{ $result[2] }}</td>
                    <td>{{ $result[3] }}</td>
                    <td>{{ $result[4] }}</td>
                    <td>{{ $result[5] }}</td>
                    <td>{{ $result[6] }}</td>
                    <td>{{ $result[7] }}</td>
                    <td>{{ $result[8] }}</td>
                    <td>{{ $result[9] }}</td>
                    <td>{{ $result[10] }}</td>
                    <td>{{ $result[11] }}</td>
                    <td>{{ $result[12] }}</td>
                    <td>{{ $result[13] }}</td>
                    <td>{{ $result[14] }}</td>
                    <td>{{ $result[15] }}</td>
                    <td>{{ $result[16] }}</td>
                    <td>{{ $result[17] }}</td>
                    <td>{{ $result[18] }}</td>
                    <td>{{ $result[19] }}</td>
                    <td>{{ $result[20] }}</td>
                    <td>{{ $result[21] }}</td>
                    <td>{{ $result[22] }}</td>
                  </tr>
                  @break

                  @case('all')
                  <tr>
                    <td>Jan</td>
                    <td>{{ $result[1] }}</td>
                    <td>{{ $result[2] }}</td>
                    <td>{{ $result[3] }}</td>
                    <td>{{ $result[4] }}</td>
                    <td>{{ $result[5] }}</td>
                    <td>{{ $result[6] }}</td>
                    <td>{{ $result[7] }}</td>
                    <td>{{ $result[8] }}</td>
                    <td>{{ $result[9] }}</td>
                    <td>{{ $result[10] }}</td>
                    <td>{{ $result[11] }}</td>
                    <td>{{ $result[12] }}</td>
                    <td>{{ $result[13] }}</td>
                    <td>{{ $result[14] }}</td>
                    <td>{{ $result[15] }}</td>
                    <td>{{ $result[16] }}</td>
                    <td>{{ $result[17] }}</td>
                    <td>{{ $result[18] }}</td>
                    <td>{{ $result[19] }}</td>
                    <td>{{ $result[20] }}</td>
                    <td>{{ $result[21] }}</td>
                    <td>{{ $result[22] }}</td>
                  </tr>
                  <tr>
                    <td>Feb</td>
                    <td>{{ $result[23] }}</td>
                    <td>{{ $result[24] }}</td>
                    <td>{{ $result[25] }}</td>
                    <td>{{ $result[26] }}</td>
                    <td>{{ $result[27] }}</td>
                    <td>{{ $result[28] }}</td>
                    <td>{{ $result[29] }}</td>
                    <td>{{ $result[30] }}</td>
                    <td>{{ $result[31] }}</td>
                    <td>{{ $result[32] }}</td>
                    <td>{{ $result[33] }}</td>
                    <td>{{ $result[34] }}</td>
                    <td>{{ $result[35] }}</td>
                    <td>{{ $result[36] }}</td>
                    <td>{{ $result[37] }}</td>
                    <td>{{ $result[38] }}</td>
                    <td>{{ $result[39] }}</td>
                    <td>{{ $result[40] }}</td>
                    <td>{{ $result[41] }}</td>
                    <td>{{ $result[42] }}</td>
                    <td>{{ $result[43] }}</td>
                    <td>{{ $result[44] }}</td>
                  </tr>
                  <tr>
                    <td>Mac</td>
                    <td>{{ $result[45] }}</td>
                    <td>{{ $result[46] }}</td>
                    <td>{{ $result[47] }}</td>
                    <td>{{ $result[48] }}</td>
                    <td>{{ $result[49] }}</td>
                    <td>{{ $result[50] }}</td>
                    <td>{{ $result[51] }}</td>
                    <td>{{ $result[52] }}</td>
                    <td>{{ $result[53] }}</td>
                    <td>{{ $result[54] }}</td>
                    <td>{{ $result[55] }}</td>
                    <td>{{ $result[56] }}</td>
                    <td>{{ $result[57] }}</td>
                    <td>{{ $result[58] }}</td>
                    <td>{{ $result[59] }}</td>
                    <td>{{ $result[60] }}</td>
                    <td>{{ $result[61] }}</td>
                    <td>{{ $result[62] }}</td>
                    <td>{{ $result[63] }}</td>
                    <td>{{ $result[64] }}</td>
                    <td>{{ $result[65] }}</td>
                    <td>{{ $result[66] }}</td>
                  </tr>
                  <tr>
                    <td>April</td>
                    <td>{{ $result[67] }}</td>
                    <td>{{ $result[68] }}</td>
                    <td>{{ $result[69] }}</td>
                    <td>{{ $result[70] }}</td>
                    <td>{{ $result[71] }}</td>
                    <td>{{ $result[72] }}</td>
                    <td>{{ $result[73] }}</td>
                    <td>{{ $result[74] }}</td>
                    <td>{{ $result[75] }}</td>
                    <td>{{ $result[76] }}</td>
                    <td>{{ $result[77] }}</td>
                    <td>{{ $result[78] }}</td>
                    <td>{{ $result[79] }}</td>
                    <td>{{ $result[80] }}</td>
                    <td>{{ $result[81] }}</td>
                    <td>{{ $result[82] }}</td>
                    <td>{{ $result[83] }}</td>
                    <td>{{ $result[84] }}</td>
                    <td>{{ $result[85] }}</td>
                    <td>{{ $result[86] }}</td>
                    <td>{{ $result[87] }}</td>
                    <td>{{ $result[88] }}</td>
                  </tr>
                  <tr>
                    <td>Mei</td>
                    <td>{{ $result[89] }}</td>
                    <td>{{ $result[90] }}</td>
                    <td>{{ $result[91] }}</td>
                    <td>{{ $result[92] }}</td>
                    <td>{{ $result[93] }}</td>
                    <td>{{ $result[94] }}</td>
                    <td>{{ $result[95] }}</td>
                    <td>{{ $result[96] }}</td>
                    <td>{{ $result[97] }}</td>
                    <td>{{ $result[98] }}</td>
                    <td>{{ $result[99] }}</td>
                    <td>{{ $result[100] }}</td>
                    <td>{{ $result[101] }}</td>
                    <td>{{ $result[102] }}</td>
                    <td>{{ $result[103] }}</td>
                    <td>{{ $result[104] }}</td>
                    <td>{{ $result[105] }}</td>
                    <td>{{ $result[106] }}</td>
                    <td>{{ $result[107] }}</td>
                    <td>{{ $result[108] }}</td>
                    <td>{{ $result[109] }}</td>
                    <td>{{ $result[110] }}</td>
                  </tr>
                  <tr>
                    <td>Jun</td>
                    <td>{{ $result[111] }}</td>
                    <td>{{ $result[112] }}</td>
                    <td>{{ $result[113] }}</td>
                    <td>{{ $result[114] }}</td>
                    <td>{{ $result[115] }}</td>
                    <td>{{ $result[116] }}</td>
                    <td>{{ $result[117] }}</td>
                    <td>{{ $result[118] }}</td>
                    <td>{{ $result[119] }}</td>
                    <td>{{ $result[120] }}</td>
                    <td>{{ $result[121] }}</td>
                    <td>{{ $result[122] }}</td>
                    <td>{{ $result[123] }}</td>
                    <td>{{ $result[124] }}</td>
                    <td>{{ $result[125] }}</td>
                    <td>{{ $result[126] }}</td>
                    <td>{{ $result[127] }}</td>
                    <td>{{ $result[128] }}</td>
                    <td>{{ $result[129] }}</td>
                    <td>{{ $result[130] }}</td>
                    <td>{{ $result[131] }}</td>
                    <td>{{ $result[132] }}</td>
                  </tr>
                  <tr>
                    <td>Jul</td>
                    <td>{{ $result[133] }}</td>
                    <td>{{ $result[134] }}</td>
                    <td>{{ $result[135] }}</td>
                    <td>{{ $result[136] }}</td>
                    <td>{{ $result[137] }}</td>
                    <td>{{ $result[138] }}</td>
                    <td>{{ $result[139] }}</td>
                    <td>{{ $result[140] }}</td>
                    <td>{{ $result[141] }}</td>
                    <td>{{ $result[142] }}</td>
                    <td>{{ $result[143] }}</td>
                    <td>{{ $result[144] }}</td>
                    <td>{{ $result[145] }}</td>
                    <td>{{ $result[146] }}</td>
                    <td>{{ $result[147] }}</td>
                    <td>{{ $result[148] }}</td>
                    <td>{{ $result[149] }}</td>
                    <td>{{ $result[150] }}</td>
                    <td>{{ $result[151] }}</td>
                    <td>{{ $result[152] }}</td>
                    <td>{{ $result[153] }}</td>
                    <td>{{ $result[154] }}</td>
                  </tr>
                  <tr>
                    <td>Ogos</td>
                    <td>{{ $result[155] }}</td>
                    <td>{{ $result[156] }}</td>
                    <td>{{ $result[157] }}</td>
                    <td>{{ $result[158] }}</td>
                    <td>{{ $result[159] }}</td>
                    <td>{{ $result[160] }}</td>
                    <td>{{ $result[161] }}</td>
                    <td>{{ $result[162] }}</td>
                    <td>{{ $result[163] }}</td>
                    <td>{{ $result[164] }}</td>
                    <td>{{ $result[165] }}</td>
                    <td>{{ $result[166] }}</td>
                    <td>{{ $result[167] }}</td>
                    <td>{{ $result[168] }}</td>
                    <td>{{ $result[169] }}</td>
                    <td>{{ $result[170] }}</td>
                    <td>{{ $result[171] }}</td>
                    <td>{{ $result[172] }}</td>
                    <td>{{ $result[173] }}</td>
                    <td>{{ $result[174] }}</td>
                    <td>{{ $result[175] }}</td>
                    <td>{{ $result[176] }}</td>
                  </tr>
                  <tr>
                    <td>Sep</td>
                    <td>{{ $result[177] }}</td>
                    <td>{{ $result[178] }}</td>
                    <td>{{ $result[179] }}</td>
                    <td>{{ $result[180] }}</td>
                    <td>{{ $result[181] }}</td>
                    <td>{{ $result[182] }}</td>
                    <td>{{ $result[183] }}</td>
                    <td>{{ $result[184] }}</td>
                    <td>{{ $result[185] }}</td>
                    <td>{{ $result[186] }}</td>
                    <td>{{ $result[187] }}</td>
                    <td>{{ $result[188] }}</td>
                    <td>{{ $result[189] }}</td>
                    <td>{{ $result[190] }}</td>
                    <td>{{ $result[191] }}</td>
                    <td>{{ $result[192] }}</td>
                    <td>{{ $result[193] }}</td>
                    <td>{{ $result[194] }}</td>
                    <td>{{ $result[195] }}</td>
                    <td>{{ $result[196] }}</td>
                    <td>{{ $result[197] }}</td>
                    <td>{{ $result[198] }}</td>
                  </tr>
                  <tr>
                    <td>Okt</td>
                    <td>{{ $result[199] }}</td>
                    <td>{{ $result[200] }}</td>
                    <td>{{ $result[201] }}</td>
                    <td>{{ $result[202] }}</td>
                    <td>{{ $result[203] }}</td>
                    <td>{{ $result[204] }}</td>
                    <td>{{ $result[205] }}</td>
                    <td>{{ $result[206] }}</td>
                    <td>{{ $result[207] }}</td>
                    <td>{{ $result[208] }}</td>
                    <td>{{ $result[209] }}</td>
                    <td>{{ $result[210] }}</td>
                    <td>{{ $result[211] }}</td>
                    <td>{{ $result[212] }}</td>
                    <td>{{ $result[213] }}</td>
                    <td>{{ $result[214] }}</td>
                    <td>{{ $result[215] }}</td>
                    <td>{{ $result[216] }}</td>
                    <td>{{ $result[217] }}</td>
                    <td>{{ $result[218] }}</td>
                    <td>{{ $result[219] }}</td>
                    <td>{{ $result[220] }}</td>
                  </tr>
                  <tr>
                    <td>Nov</td>
                    <td>{{ $result[221] }}</td>
                    <td>{{ $result[222] }}</td>
                    <td>{{ $result[223] }}</td>
                    <td>{{ $result[224] }}</td>
                    <td>{{ $result[225] }}</td>
                    <td>{{ $result[226] }}</td>
                    <td>{{ $result[227] }}</td>
                    <td>{{ $result[228] }}</td>
                    <td>{{ $result[229] }}</td>
                    <td>{{ $result[230] }}</td>
                    <td>{{ $result[231] }}</td>
                    <td>{{ $result[232] }}</td>
                    <td>{{ $result[233] }}</td>
                    <td>{{ $result[234] }}</td>
                    <td>{{ $result[235] }}</td>
                    <td>{{ $result[236] }}</td>
                    <td>{{ $result[237] }}</td>
                    <td>{{ $result[238] }}</td>
                    <td>{{ $result[239] }}</td>
                    <td>{{ $result[240] }}</td>
                    <td>{{ $result[241] }}</td>
                    <td>{{ $result[242] }}</td>
                  <tr>
                    <td>Dis</td>
                    <td>{{ $result[243] }}</td>
                    <td>{{ $result[244] }}</td>
                    <td>{{ $result[245] }}</td>
                    <td>{{ $result[246] }}</td>
                    <td>{{ $result[247] }}</td>
                    <td>{{ $result[248] }}</td>
                    <td>{{ $result[249] }}</td>
                    <td>{{ $result[250] }}</td>
                    <td>{{ $result[251] }}</td>
                    <td>{{ $result[252] }}</td>
                    <td>{{ $result[253] }}</td>
                    <td>{{ $result[254] }}</td>
                    <td>{{ $result[255] }}</td>
                    <td>{{ $result[256] }}</td>
                    <td>{{ $result[257] }}</td>
                    <td>{{ $result[258] }}</td>
                    <td>{{ $result[259] }}</td>
                    <td>{{ $result[260] }}</td>
                    <td>{{ $result[261] }}</td>
                    <td>{{ $result[262] }}</td>
                    <td>{{ $result[263] }}</td>
                    <td>{{ $result[264] }}</td>
                  </tr>
                  @break

                  @default
          @endswitch
                  <tr>
                    <td><b>Jumlah</b></td>
                    <td>{{ $result[265] }}</td>
                    <td>{{ $result[266] }}</td>
                    <td>{{ $result[267] }}</td>
                    <td>{{ $result[268] }}</td>
                    <td>{{ $result[269] }}</td>
                    <td>{{ $result[270] }}</td>
                    <td>{{ $result[271] }}</td>
                    <td>{{ $result[272] }}</td>
                    <td>{{ $result[273] }}</td>
                    <td>{{ $result[274] }}</td>
                    <td>{{ $result[275] }}</td>
                    <td>{{ $result[276] }}</td>
                    <td>{{ $result[277] }}</td>
                    <td>{{ $result[278] }}</td>
                    <td>{{ $result[279] }}</td>
                    <td>{{ $result[280] }}</td>
                    <td>{{ $result[281] }}</td>
                    <td>{{ $result[282] }}</td>
                    <td>{{ $result[283] }}</td>
                    <td>{{ $result[284] }}</td>
                    <td>{{ $result[285] }}</td>
                    <td>{{ $result[286] }}</td>
                  </tr>
                  <tr>
                    <td><b>Peratus</b></td>
                    <td>{{ $result[287] }}</td>
                    <td>{{ $result[288] }}</td>
                    <td>{{ $result[289] }}</td>
                    <td>{{ $result[290] }}</td>
                    <td>{{ $result[291] }}</td>
                    <td>{{ $result[292] }}</td>
                    <td>{{ $result[293] }}</td>
                    <td>{{ $result[294] }}</td>
                    <td>{{ $result[295] }}</td>
                    <td>{{ $result[296] }}</td>
                    <td>{{ $result[297] }}</td>
                    <td>{{ $result[298] }}</td>
                    <td>{{ $result[299] }}</td>
                    <td>{{ $result[300] }}</td
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
              </tbody>
          </table>
      </div>

  </div>
