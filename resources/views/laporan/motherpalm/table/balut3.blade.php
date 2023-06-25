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
      <h4 class="mt-5 text-bold">Rumusan Mengikut Bulan Batch</h4>
  </div>
  <div class="col-xl-12 text-left">
      <span><b>Tempoh Laporan: {{$bulan_word}} {{$tahun}} - {{$bulan_akhir_word}} {{$tahun}}<b></span>
  </div>

  @if ($hb == 'b')
      @if ($bulan == 'all')
          @foreach ($result as $key => $r)
              <div class="col-12 mt-4">
                  <div class="table-responsive scrollbar">
                      <table class="table table-bordered overflow-hidden" width="100%">
                          <thead class="border border-dark" style="background-color: #d9d9d9;">
                              <tr>
                                  <td>Bulan</td>
                                  <td>Tarikh</td>
                                  <td>Bagging</td>
                                  <td>Rosak Sebelum CP</td>
                                  <td>CP</td>
                                  <td>QC</td>
                                  <td>Rosak Selepas CP</td>
                                  <td>Tuai</td>
                                  <td>Rosak Selepas Tuai</td>
                              </tr>
                          </thead>
                          <tbody class="border border-dark">

                              <tr>
                                  <td rowspan="3">{{ $key }}</td>
                                  <td>1-10</td>
                                  <td>{{ $r['bagging'][1] }}</td>
                                  <td>{{ $r['kcp'][1] }}</td>
                                  <td>{{ $r['cp'][1] }}</td>
                                  <td>{{ $r['qc'][1] }}</td>
                                  <td>{{ $r['kqc'][1] }}</td>
                                  <td>{{ $r['h'][1] }}</td>
                                  <td>{{ $r['kh'][1] }}</td>
                              </tr>
                              <tr>
                                  <td>11-20</td>
                                  <td>{{ $r['bagging'][2] }}</td>
                                  <td>{{ $r['kcp'][2] }}</td>
                                  <td>{{ $r['cp'][2] }}</td>
                                  <td>{{ $r['qc'][2] }}</td>
                                  <td>{{ $r['kqc'][2] }}</td>
                                  <td>{{ $r['h'][2] }}</td>
                                  <td>{{ $r['kh'][2] }}</td>
                              </tr>
                              <tr>
                                  <td>21-{{ $r['monthEndDay'] }}</td>
                                  <td>{{ $r['bagging'][3] }}</td>
                                  <td>{{ $r['kcp'][3] }}</td>
                                  <td>{{ $r['cp'][3] }}</td>
                                  <td>{{ $r['qc'][3] }}</td>
                                  <td>{{ $r['kqc'][3] }}</td>
                                  <td>{{ $r['h'][3] }}</td>
                                  <td>{{ $r['kh'][3] }}</td>
                              </tr>
                              <tr class="border border-dark">
                                  <td></td>
                                  <td>Jumlah</td>
                                  <td>{{ $r['bagging'][4] }}</td>
                                  <td>{{ $r['kcp'][4] }}</td>
                                  <td>{{ $r['cp'][4] }}</td>
                                  <td>{{ $r['qc'][4] }}</td>
                                  <td>{{ $r['kqc'][4] }}</td>
                                  <td>{{ $r['h'][4] }}</td>
                                  <td>{{ $r['kh'][4] }}</td>
                              </tr>
                          </tbody>
                      </table>
                  </div>
              </div>
          @endforeach
      @else
          @switch($bulan)
              @case('01')
                  <div class="col-12 mt-4">
                      <div class="table-responsive scrollbar">
                          <table class="table table-bordered overflow-hidden" width="100%">
                              <thead class="border border-dark" style="background-color: #d9d9d9;">
                                  <tr>
                                      <td>Bulan</td>
                                      <td>Tarikh</td>
                                      <td>Bagging</td>
                                      <td>Rosak Sebelum CP</td>
                                      <td>CP</td>
                                      <td>QC</td>
                                      <td>Rosak Selepas CP</td>
                                      <td>Tuai</td>
                                      <td>Rosak Selepas Tuai</td>
                                  </tr>
                              </thead>
                              <tbody>

                                  <tr>
                                      <td rowspan="3">Jan</td>
                                      <td>1-10</td>
                                      <td>{{ $result['Jan']['bagging'][1] }}</td>
                                      <td>{{ $result['Jan']['kcp'][1] }}</td>
                                      <td>{{ $result['Jan']['cp'][1] }}</td>
                                      <td>{{ $result['Jan']['qc'][1] }}</td>
                                      <td>{{ $result['Jan']['kqc'][1] }}</td>
                                      <td>{{ $result['Jan']['h'][1] }}</td>
                                      <td>{{ $result['Jan']['kh'][1] }}</td>
                                  </tr>
                                  <tr>
                                      <td>11-20</td>
                                      <td>{{ $result['Jan']['bagging'][2] }}</td>
                                      <td>{{ $result['Jan']['kcp'][2] }}</td>
                                      <td>{{ $result['Jan']['cp'][2] }}</td>
                                      <td>{{ $result['Jan']['qc'][2] }}</td>
                                      <td>{{ $result['Jan']['kqc'][2] }}</td>
                                      <td>{{ $result['Jan']['h'][2] }}</td>
                                      <td>{{ $result['Jan']['kh'][2] }}</td>
                                  </tr>
                                  <tr>
                                      <td>21-{{ $result['Jan']['monthEndDay'] }}</td>
                                      <td>{{ $result['Jan']['bagging'][3] }}</td>
                                      <td>{{ $result['Jan']['kcp'][3] }}</td>
                                      <td>{{ $result['Jan']['cp'][3] }}</td>
                                      <td>{{ $result['Jan']['qc'][3] }}</td>
                                      <td>{{ $result['Jan']['kqc'][3] }}</td>
                                      <td>{{ $result['Jan']['h'][3] }}</td>
                                      <td>{{ $result['Jan']['kh'][3] }}</td>
                                  </tr>
                                  <tr class="border border-dark">
                                      <td></td>
                                      <td>Jumlah</td>
                                      <td>{{ $result['Jan']['bagging'][4] }}</td>
                                      <td>{{ $result['Jan']['kcp'][4] }}</td>
                                      <td>{{ $result['Jan']['cp'][4] }}</td>
                                      <td>{{ $result['Jan']['qc'][4] }}</td>
                                      <td>{{ $result['Jan']['kqc'][4] }}</td>
                                      <td>{{ $result['Jan']['h'][4] }}</td>
                                      <td>{{ $result['Jan']['kh'][4] }}</td>
                                  </tr>
                              </tbody>
                          </table>
                      </div>
                  </div>
              @break

              @case('02')
                  <div class="col-12 mt-4">
                      <div class="table-responsive scrollbar">
                          <table class="table table-bordered overflow-hidden" width="100%">
                              <thead class="border border-dark" style="background-color: #d9d9d9;">
                                  <tr>
                                      <td>Bulan</td>
                                      <td>Tarikh</td>
                                      <td>Bagging</td>
                                      <td>Rosak Sebelum CP</td>
                                      <td>CP</td>
                                      <td>QC</td>
                                      <td>Rosak Selepas CP</td>
                                      <td>Tuai</td>
                                      <td>Rosak Selepas Tuai</td>
                                  </tr>
                              </thead>
                              <tbody>

                                  <tr>
                                      <td rowspan="3">Feb</td>
                                      <td>1-10</td>
                                      <td>{{ $result['Feb']['bagging'][1] }}</td>
                                      <td>{{ $result['Feb']['kcp'][1] }}</td>
                                      <td>{{ $result['Feb']['cp'][1] }}</td>
                                      <td>{{ $result['Feb']['qc'][1] }}</td>
                                      <td>{{ $result['Feb']['kqc'][1] }}</td>
                                      <td>{{ $result['Feb']['h'][1] }}</td>
                                      <td>{{ $result['Feb']['kh'][1] }}</td>
                                  </tr>
                                  <tr>
                                      <td>11-20</td>
                                      <td>{{ $result['Feb']['bagging'][2] }}</td>
                                      <td>{{ $result['Feb']['kcp'][2] }}</td>
                                      <td>{{ $result['Feb']['cp'][2] }}</td>
                                      <td>{{ $result['Feb']['qc'][2] }}</td>
                                      <td>{{ $result['Feb']['kqc'][2] }}</td>
                                      <td>{{ $result['Feb']['h'][2] }}</td>
                                      <td>{{ $result['Feb']['kh'][2] }}</td>
                                  </tr>
                                  <tr>
                                      <td>21-{{ $result['Feb']['monthEndDay'] }}</td>
                                      <td>{{ $result['Feb']['bagging'][3] }}</td>
                                      <td>{{ $result['Feb']['kcp'][3] }}</td>
                                      <td>{{ $result['Feb']['cp'][3] }}</td>
                                      <td>{{ $result['Feb']['qc'][3] }}</td>
                                      <td>{{ $result['Feb']['kqc'][3] }}</td>
                                      <td>{{ $result['Feb']['h'][3] }}</td>
                                      <td>{{ $result['Feb']['kh'][3] }}</td>
                                  </tr>
                                  <tr class="border border-dark">
                                      <td></td>
                                      <td>Jumlah</td>
                                      <td>{{ $result['Feb']['bagging'][4] }}</td>
                                      <td>{{ $result['Feb']['kcp'][4] }}</td>
                                      <td>{{ $result['Feb']['cp'][4] }}</td>
                                      <td>{{ $result['Feb']['qc'][4] }}</td>
                                      <td>{{ $result['Feb']['kqc'][4] }}</td>
                                      <td>{{ $result['Feb']['h'][4] }}</td>
                                      <td>{{ $result['Feb']['kh'][4] }}</td>
                                  </tr>
                              </tbody>
                          </table>
                      </div>
                  </div>
              @break

              @case('03')
                  <div class="col-12 mt-4">
                      <div class="table-responsive scrollbar">
                          <table class="table table-bordered overflow-hidden" width="100%">
                              <thead class="border border-dark" style="background-color: #d9d9d9;">
                                  <tr>
                                      <td>Bulan</td>
                                      <td>Tarikh</td>
                                      <td>Bagging</td>
                                      <td>Rosak Sebelum CP</td>
                                      <td>CP</td>
                                      <td>QC</td>
                                      <td>Rosak Selepas CP</td>
                                      <td>Tuai</td>
                                      <td>Rosak Selepas Tuai</td>
                                  </tr>
                              </thead>
                              <tbody>

                                  <tr>
                                      <td rowspan="3">Mar</td>
                                      <td>1-10</td>
                                      <td>{{ $result['Mar']['bagging'][1] }}</td>
                                      <td>{{ $result['Mar']['kcp'][1] }}</td>
                                      <td>{{ $result['Mar']['cp'][1] }}</td>
                                      <td>{{ $result['Mar']['qc'][1] }}</td>
                                      <td>{{ $result['Mar']['kqc'][1] }}</td>
                                      <td>{{ $result['Mar']['h'][1] }}</td>
                                      <td>{{ $result['Mar']['kh'][1] }}</td>
                                  </tr>
                                  <tr>
                                      <td>11-20</td>
                                      <td>{{ $result['Mar']['bagging'][2] }}</td>
                                      <td>{{ $result['Mar']['kcp'][2] }}</td>
                                      <td>{{ $result['Mar']['cp'][2] }}</td>
                                      <td>{{ $result['Mar']['qc'][2] }}</td>
                                      <td>{{ $result['Mar']['kqc'][2] }}</td>
                                      <td>{{ $result['Mar']['h'][2] }}</td>
                                      <td>{{ $result['Mar']['kh'][2] }}</td>
                                  </tr>
                                  <tr>
                                      <td>21-{{ $result['Mar']['monthEndDay'] }}</td>
                                      <td>{{ $result['Mar']['bagging'][3] }}</td>
                                      <td>{{ $result['Mar']['kcp'][3] }}</td>
                                      <td>{{ $result['Mar']['cp'][3] }}</td>
                                      <td>{{ $result['Mar']['qc'][3] }}</td>
                                      <td>{{ $result['Mar']['kqc'][3] }}</td>
                                      <td>{{ $result['Mar']['h'][3] }}</td>
                                      <td>{{ $result['Mar']['kh'][3] }}</td>
                                  </tr>
                                  <tr class="border border-dark">
                                      <td></td>
                                      <td>Jumlah</td>
                                      <td>{{ $result['Mar']['bagging'][4] }}</td>
                                      <td>{{ $result['Mar']['kcp'][4] }}</td>
                                      <td>{{ $result['Mar']['cp'][4] }}</td>
                                      <td>{{ $result['Mar']['qc'][4] }}</td>
                                      <td>{{ $result['Mar']['kqc'][4] }}</td>
                                      <td>{{ $result['Mar']['h'][4] }}</td>
                                      <td>{{ $result['Mar']['kh'][4] }}</td>
                                  </tr>
                              </tbody>
                          </table>
                      </div>
                  </div>
              @break

              @case('04')
                  <div class="col-12 mt-4">
                      <div class="table-responsive scrollbar">
                          <table class="table table-bordered overflow-hidden" width="100%">
                              <thead class="border border-dark" style="background-color: #d9d9d9;">
                                  <tr>
                                      <td>Bulan</td>
                                      <td>Tarikh</td>
                                      <td>Bagging</td>
                                      <td>Rosak Sebelum CP</td>
                                      <td>CP</td>
                                      <td>QC</td>
                                      <td>Rosak Selepas CP</td>
                                      <td>Tuai</td>
                                      <td>Rosak Selepas Tuai</td>
                                  </tr>
                              </thead>
                              <tbody>

                                  <tr>
                                      <td rowspan="3">Apr</td>
                                      <td>1-10</td>
                                      <td>{{ $result['Apr']['bagging'][1] }}</td>
                                      <td>{{ $result['Apr']['kcp'][1] }}</td>
                                      <td>{{ $result['Apr']['cp'][1] }}</td>
                                      <td>{{ $result['Apr']['qc'][1] }}</td>
                                      <td>{{ $result['Apr']['kqc'][1] }}</td>
                                      <td>{{ $result['Apr']['h'][1] }}</td>
                                      <td>{{ $result['Apr']['kh'][1] }}</td>
                                  </tr>
                                  <tr>
                                      <td>11-20</td>
                                      <td>{{ $result['Apr']['bagging'][2] }}</td>
                                      <td>{{ $result['Apr']['kcp'][2] }}</td>
                                      <td>{{ $result['Apr']['cp'][2] }}</td>
                                      <td>{{ $result['Apr']['qc'][2] }}</td>
                                      <td>{{ $result['Apr']['kqc'][2] }}</td>
                                      <td>{{ $result['Apr']['h'][2] }}</td>
                                      <td>{{ $result['Apr']['kh'][2] }}</td>
                                  </tr>
                                  <tr>
                                      <td>21-{{ $result['Apr']['monthEndDay'] }}</td>
                                      <td>{{ $result['Apr']['bagging'][3] }}</td>
                                      <td>{{ $result['Apr']['kcp'][3] }}</td>
                                      <td>{{ $result['Apr']['cp'][3] }}</td>
                                      <td>{{ $result['Apr']['qc'][3] }}</td>
                                      <td>{{ $result['Apr']['kqc'][3] }}</td>
                                      <td>{{ $result['Apr']['h'][3] }}</td>
                                      <td>{{ $result['Apr']['kh'][3] }}</td>
                                  </tr>
                                  <tr class="border border-dark">
                                      <td></td>
                                      <td>Jumlah</td>
                                      <td>{{ $result['Apr']['bagging'][4] }}</td>
                                      <td>{{ $result['Apr']['kcp'][4] }}</td>
                                      <td>{{ $result['Apr']['cp'][4] }}</td>
                                      <td>{{ $result['Apr']['qc'][4] }}</td>
                                      <td>{{ $result['Apr']['kqc'][4] }}</td>
                                      <td>{{ $result['Apr']['h'][4] }}</td>
                                      <td>{{ $result['Apr']['kh'][4] }}</td>
                                  </tr>
                              </tbody>
                          </table>
                      </div>
                  </div>
              @break

              @case('05')
                  <div class="col-12 mt-4">
                      <div class="table-responsive scrollbar">
                          <table class="table table-bordered overflow-hidden" width="100%">
                              <thead class="border border-dark" style="background-color: #d9d9d9;">
                                  <tr>
                                      <td>Bulan</td>
                                      <td>Tarikh</td>
                                      <td>Bagging</td>
                                      <td>Rosak Sebelum CP</td>
                                      <td>CP</td>
                                      <td>QC</td>
                                      <td>Rosak Selepas CP</td>
                                      <td>Tuai</td>
                                      <td>Rosak Selepas Tuai</td>
                                  </tr>
                              </thead>
                              <tbody>

                                  <tr>
                                      <td rowspan="3">May</td>
                                      <td>1-10</td>
                                      <td>{{ $result['May']['bagging'][1] }}</td>
                                      <td>{{ $result['May']['kcp'][1] }}</td>
                                      <td>{{ $result['May']['cp'][1] }}</td>
                                      <td>{{ $result['May']['qc'][1] }}</td>
                                      <td>{{ $result['May']['kqc'][1] }}</td>
                                      <td>{{ $result['May']['h'][1] }}</td>
                                      <td>{{ $result['May']['kh'][1] }}</td>
                                  </tr>
                                  <tr>
                                      <td>11-20</td>
                                      <td>{{ $result['May']['bagging'][2] }}</td>
                                      <td>{{ $result['May']['kcp'][2] }}</td>
                                      <td>{{ $result['May']['cp'][2] }}</td>
                                      <td>{{ $result['May']['qc'][2] }}</td>
                                      <td>{{ $result['May']['kqc'][2] }}</td>
                                      <td>{{ $result['May']['h'][2] }}</td>
                                      <td>{{ $result['May']['kh'][2] }}</td>
                                  </tr>
                                  <tr>
                                      <td>21-{{ $result['May']['monthEndDay'] }}</td>
                                      <td>{{ $result['May']['bagging'][3] }}</td>
                                      <td>{{ $result['May']['kcp'][3] }}</td>
                                      <td>{{ $result['May']['cp'][3] }}</td>
                                      <td>{{ $result['May']['qc'][3] }}</td>
                                      <td>{{ $result['May']['kqc'][3] }}</td>
                                      <td>{{ $result['May']['h'][3] }}</td>
                                      <td>{{ $result['May']['kh'][3] }}</td>
                                  </tr>
                                  <tr class="border border-dark">
                                      <td></td>
                                      <td>Jumlah</td>
                                      <td>{{ $result['May']['bagging'][4] }}</td>
                                      <td>{{ $result['May']['kcp'][4] }}</td>
                                      <td>{{ $result['May']['cp'][4] }}</td>
                                      <td>{{ $result['May']['qc'][4] }}</td>
                                      <td>{{ $result['May']['kqc'][4] }}</td>
                                      <td>{{ $result['May']['h'][4] }}</td>
                                      <td>{{ $result['May']['kh'][4] }}</td>
                                  </tr>
                              </tbody>
                          </table>
                      </div>
                  </div>
              @break

              @case('06')
                  <div class="col-12 mt-4">
                      <div class="table-responsive scrollbar">
                          <table class="table table-bordered overflow-hidden" width="100%">
                              <thead class="border border-dark" style="background-color: #d9d9d9;">
                                  <tr>
                                      <td>Bulan</td>
                                      <td>Tarikh</td>
                                      <td>Bagging</td>
                                      <td>Rosak Sebelum CP</td>
                                      <td>CP</td>
                                      <td>QC</td>
                                      <td>Rosak Selepas CP</td>
                                      <td>Tuai</td>
                                      <td>Rosak Selepas Tuai</td>
                                  </tr>
                              </thead>
                              <tbody>

                                  <tr>
                                      <td rowspan="3">Jun</td>
                                      <td>1-10</td>
                                      <td>{{ $result['Jun']['bagging'][1] }}</td>
                                      <td>{{ $result['Jun']['kcp'][1] }}</td>
                                      <td>{{ $result['Jun']['cp'][1] }}</td>
                                      <td>{{ $result['Jun']['qc'][1] }}</td>
                                      <td>{{ $result['Jun']['kqc'][1] }}</td>
                                      <td>{{ $result['Jun']['h'][1] }}</td>
                                      <td>{{ $result['Jun']['kh'][1] }}</td>
                                  </tr>
                                  <tr>
                                      <td>11-20</td>
                                      <td>{{ $result['Jun']['bagging'][2] }}</td>
                                      <td>{{ $result['Jun']['kcp'][2] }}</td>
                                      <td>{{ $result['Jun']['cp'][2] }}</td>
                                      <td>{{ $result['Jun']['qc'][2] }}</td>
                                      <td>{{ $result['Jun']['kqc'][2] }}</td>
                                      <td>{{ $result['Jun']['h'][2] }}</td>
                                      <td>{{ $result['Jun']['kh'][2] }}</td>
                                  </tr>
                                  <tr>
                                      <td>21-{{ $result['Jun']['monthEndDay'] }}</td>
                                      <td>{{ $result['Jun']['bagging'][3] }}</td>
                                      <td>{{ $result['Jun']['kcp'][3] }}</td>
                                      <td>{{ $result['Jun']['cp'][3] }}</td>
                                      <td>{{ $result['Jun']['qc'][3] }}</td>
                                      <td>{{ $result['Jun']['kqc'][3] }}</td>
                                      <td>{{ $result['Jun']['h'][3] }}</td>
                                      <td>{{ $result['Jun']['kh'][3] }}</td>
                                  </tr>
                                  <tr class="border border-dark">
                                      <td></td>
                                      <td>Jumlah</td>
                                      <td>{{ $result['Jun']['bagging'][4] }}</td>
                                      <td>{{ $result['Jun']['kcp'][4] }}</td>
                                      <td>{{ $result['Jun']['cp'][4] }}</td>
                                      <td>{{ $result['Jun']['qc'][4] }}</td>
                                      <td>{{ $result['Jun']['kqc'][4] }}</td>
                                      <td>{{ $result['Jun']['h'][4] }}</td>
                                      <td>{{ $result['Jun']['kh'][4] }}</td>
                                  </tr>
                              </tbody>
                          </table>
                      </div>
                  </div>
              @break

              @case('07')
                  <div class="col-12 mt-4">
                      <div class="table-responsive scrollbar">
                          <table class="table table-bordered overflow-hidden" width="100%">
                              <thead class="border border-dark" style="background-color: #d9d9d9;">
                                  <tr>
                                      <td>Bulan</td>
                                      <td>Tarikh</td>
                                      <td>Bagging</td>
                                      <td>Rosak Sebelum CP</td>
                                      <td>CP</td>
                                      <td>QC</td>
                                      <td>Rosak Selepas CP</td>
                                      <td>Tuai</td>
                                      <td>Rosak Selepas Tuai</td>
                                  </tr>
                              </thead>
                              <tbody>

                                  <tr>
                                      <td rowspan="3">Jul</td>
                                      <td>1-10</td>
                                      <td>{{ $result['Jul']['bagging'][1] }}</td>
                                      <td>{{ $result['Jul']['kcp'][1] }}</td>
                                      <td>{{ $result['Jul']['cp'][1] }}</td>
                                      <td>{{ $result['Jul']['qc'][1] }}</td>
                                      <td>{{ $result['Jul']['kqc'][1] }}</td>
                                      <td>{{ $result['Jul']['h'][1] }}</td>
                                      <td>{{ $result['Jul']['kh'][1] }}</td>
                                  </tr>
                                  <tr>
                                      <td>11-20</td>
                                      <td>{{ $result['Jul']['bagging'][2] }}</td>
                                      <td>{{ $result['Jul']['kcp'][2] }}</td>
                                      <td>{{ $result['Jul']['cp'][2] }}</td>
                                      <td>{{ $result['Jul']['qc'][2] }}</td>
                                      <td>{{ $result['Jul']['kqc'][2] }}</td>
                                      <td>{{ $result['Jul']['h'][2] }}</td>
                                      <td>{{ $result['Jul']['kh'][2] }}</td>
                                  </tr>
                                  <tr>
                                      <td>21-{{ $result['Jul']['monthEndDay'] }}</td>
                                      <td>{{ $result['Jul']['bagging'][3] }}</td>
                                      <td>{{ $result['Jul']['kcp'][3] }}</td>
                                      <td>{{ $result['Jul']['cp'][3] }}</td>
                                      <td>{{ $result['Jul']['qc'][3] }}</td>
                                      <td>{{ $result['Jul']['kqc'][3] }}</td>
                                      <td>{{ $result['Jul']['h'][3] }}</td>
                                      <td>{{ $result['Jul']['kh'][3] }}</td>
                                  </tr>
                                  <tr class="border border-dark">
                                      <td></td>
                                      <td>Jumlah</td>
                                      <td>{{ $result['Jul']['bagging'][4] }}</td>
                                      <td>{{ $result['Jul']['kcp'][4] }}</td>
                                      <td>{{ $result['Jul']['cp'][4] }}</td>
                                      <td>{{ $result['Jul']['qc'][4] }}</td>
                                      <td>{{ $result['Jul']['kqc'][4] }}</td>
                                      <td>{{ $result['Jul']['h'][4] }}</td>
                                      <td>{{ $result['Jul']['kh'][4] }}</td>
                                  </tr>
                              </tbody>
                          </table>
                      </div>
                  </div>
              @break

              @case('08')
                  <div class="col-12 mt-4">
                      <div class="table-responsive scrollbar">
                          <table class="table table-bordered overflow-hidden" width="100%">
                              <thead class="border border-dark" style="background-color: #d9d9d9;">
                                  <tr>
                                      <td>Bulan</td>
                                      <td>Tarikh</td>
                                      <td>Bagging</td>
                                      <td>Rosak Sebelum CP</td>
                                      <td>CP</td>
                                      <td>QC</td>
                                      <td>Rosak Selepas CP</td>
                                      <td>Tuai</td>
                                      <td>Rosak Selepas Tuai</td>
                                  </tr>
                              </thead>
                              <tbody>

                                  <tr>
                                      <td rowspan="3">Aug</td>
                                      <td>1-10</td>
                                      <td>{{ $result['Aug']['bagging'][1] }}</td>
                                      <td>{{ $result['Aug']['kcp'][1] }}</td>
                                      <td>{{ $result['Aug']['cp'][1] }}</td>
                                      <td>{{ $result['Aug']['qc'][1] }}</td>
                                      <td>{{ $result['Aug']['kqc'][1] }}</td>
                                      <td>{{ $result['Aug']['h'][1] }}</td>
                                      <td>{{ $result['Aug']['kh'][1] }}</td>
                                  </tr>
                                  <tr>
                                      <td>11-20</td>
                                      <td>{{ $result['Aug']['bagging'][2] }}</td>
                                      <td>{{ $result['Aug']['kcp'][2] }}</td>
                                      <td>{{ $result['Aug']['cp'][2] }}</td>
                                      <td>{{ $result['Aug']['qc'][2] }}</td>
                                      <td>{{ $result['Aug']['kqc'][2] }}</td>
                                      <td>{{ $result['Aug']['h'][2] }}</td>
                                      <td>{{ $result['Aug']['kh'][2] }}</td>
                                  </tr>
                                  <tr>
                                      <td>21-{{ $result['Aug']['monthEndDay'] }}</td>
                                      <td>{{ $result['Aug']['bagging'][3] }}</td>
                                      <td>{{ $result['Aug']['kcp'][3] }}</td>
                                      <td>{{ $result['Aug']['cp'][3] }}</td>
                                      <td>{{ $result['Aug']['qc'][3] }}</td>
                                      <td>{{ $result['Aug']['kqc'][3] }}</td>
                                      <td>{{ $result['Aug']['h'][3] }}</td>
                                      <td>{{ $result['Aug']['kh'][3] }}</td>
                                  </tr>
                                  <tr class="border border-dark">
                                      <td></td>
                                      <td>Jumlah</td>
                                      <td>{{ $result['Aug']['bagging'][4] }}</td>
                                      <td>{{ $result['Aug']['kcp'][4] }}</td>
                                      <td>{{ $result['Aug']['cp'][4] }}</td>
                                      <td>{{ $result['Aug']['qc'][4] }}</td>
                                      <td>{{ $result['Aug']['kqc'][4] }}</td>
                                      <td>{{ $result['Aug']['h'][4] }}</td>
                                      <td>{{ $result['Aug']['kh'][4] }}</td>
                                  </tr>
                              </tbody>
                          </table>
                      </div>
                  </div>
              @break

              @case('09')
                  <div class="col-12 mt-4">
                      <div class="table-responsive scrollbar">
                          <table class="table table-bordered overflow-hidden" width="100%">
                              <thead class="border border-dark" style="background-color: #d9d9d9;">
                                  <tr>
                                      <td>Bulan</td>
                                      <td>Tarikh</td>
                                      <td>Bagging</td>
                                      <td>Rosak Sebelum CP</td>
                                      <td>CP</td>
                                      <td>QC</td>
                                      <td>Rosak Selepas CP</td>
                                      <td>Tuai</td>
                                      <td>Rosak Selepas Tuai</td>
                                  </tr>
                              </thead>
                              <tbody>

                                  <tr>
                                      <td rowspan="3">Sep</td>
                                      <td>1-10</td>
                                      <td>{{ $result['Sep']['bagging'][1] }}</td>
                                      <td>{{ $result['Sep']['kcp'][1] }}</td>
                                      <td>{{ $result['Sep']['cp'][1] }}</td>
                                      <td>{{ $result['Sep']['qc'][1] }}</td>
                                      <td>{{ $result['Sep']['kqc'][1] }}</td>
                                      <td>{{ $result['Sep']['h'][1] }}</td>
                                      <td>{{ $result['Sep']['kh'][1] }}</td>
                                  </tr>
                                  <tr>
                                      <td>11-20</td>
                                      <td>{{ $result['Sep']['bagging'][2] }}</td>
                                      <td>{{ $result['Sep']['kcp'][2] }}</td>
                                      <td>{{ $result['Sep']['cp'][2] }}</td>
                                      <td>{{ $result['Sep']['qc'][2] }}</td>
                                      <td>{{ $result['Sep']['kqc'][2] }}</td>
                                      <td>{{ $result['Sep']['h'][2] }}</td>
                                      <td>{{ $result['Sep']['kh'][2] }}</td>
                                  </tr>
                                  <tr>
                                      <td>21-{{ $result['Sep']['monthEndDay'] }}</td>
                                      <td>{{ $result['Sep']['bagging'][3] }}</td>
                                      <td>{{ $result['Sep']['kcp'][3] }}</td>
                                      <td>{{ $result['Sep']['cp'][3] }}</td>
                                      <td>{{ $result['Sep']['qc'][3] }}</td>
                                      <td>{{ $result['Sep']['kqc'][3] }}</td>
                                      <td>{{ $result['Sep']['h'][3] }}</td>
                                      <td>{{ $result['Sep']['kh'][3] }}</td>
                                  </tr>
                                  <tr class="border border-dark">
                                      <td></td>
                                      <td>Jumlah</td>
                                      <td>{{ $result['Sep']['bagging'][4] }}</td>
                                      <td>{{ $result['Sep']['kcp'][4] }}</td>
                                      <td>{{ $result['Sep']['cp'][4] }}</td>
                                      <td>{{ $result['Sep']['qc'][4] }}</td>
                                      <td>{{ $result['Sep']['kqc'][4] }}</td>
                                      <td>{{ $result['Sep']['h'][4] }}</td>
                                      <td>{{ $result['Sep']['kh'][4] }}</td>
                                  </tr>
                              </tbody>
                          </table>
                      </div>
                  </div>
              @break

              @case('10')
                  <div class="col-12 mt-4">
                      <div class="table-responsive scrollbar">
                          <table class="table table-bordered overflow-hidden" width="100%">
                              <thead class="border border-dark" style="background-color: #d9d9d9;">
                                  <tr>
                                      <td>Bulan</td>
                                      <td>Tarikh</td>
                                      <td>Bagging</td>
                                      <td>Rosak Sebelum CP</td>
                                      <td>CP</td>
                                      <td>QC</td>
                                      <td>Rosak Selepas CP</td>
                                      <td>Tuai</td>
                                      <td>Rosak Selepas Tuai</td>
                                  </tr>
                              </thead>
                              <tbody>

                                  <tr>
                                      <td rowspan="3">Oct</td>
                                      <td>1-10</td>
                                      <td>{{ $result['Oct']['bagging'][1] }}</td>
                                      <td>{{ $result['Oct']['kcp'][1] }}</td>
                                      <td>{{ $result['Oct']['cp'][1] }}</td>
                                      <td>{{ $result['Oct']['qc'][1] }}</td>
                                      <td>{{ $result['Oct']['kqc'][1] }}</td>
                                      <td>{{ $result['Oct']['h'][1] }}</td>
                                      <td>{{ $result['Oct']['kh'][1] }}</td>
                                  </tr>
                                  <tr>
                                      <td>11-20</td>
                                      <td>{{ $result['Oct']['bagging'][2] }}</td>
                                      <td>{{ $result['Oct']['kcp'][2] }}</td>
                                      <td>{{ $result['Oct']['cp'][2] }}</td>
                                      <td>{{ $result['Oct']['qc'][2] }}</td>
                                      <td>{{ $result['Oct']['kqc'][2] }}</td>
                                      <td>{{ $result['Oct']['h'][2] }}</td>
                                      <td>{{ $result['Oct']['kh'][2] }}</td>
                                  </tr>
                                  <tr>
                                      <td>21-{{ $result['Oct']['monthEndDay'] }}</td>
                                      <td>{{ $result['Oct']['bagging'][3] }}</td>
                                      <td>{{ $result['Oct']['kcp'][3] }}</td>
                                      <td>{{ $result['Oct']['cp'][3] }}</td>
                                      <td>{{ $result['Oct']['qc'][3] }}</td>
                                      <td>{{ $result['Oct']['kqc'][3] }}</td>
                                      <td>{{ $result['Oct']['h'][3] }}</td>
                                      <td>{{ $result['Oct']['kh'][3] }}</td>
                                  </tr>
                                  <tr class="border border-dark">
                                      <td></td>
                                      <td>Jumlah</td>
                                      <td>{{ $result['Oct']['bagging'][4] }}</td>
                                      <td>{{ $result['Oct']['kcp'][4] }}</td>
                                      <td>{{ $result['Oct']['cp'][4] }}</td>
                                      <td>{{ $result['Oct']['qc'][4] }}</td>
                                      <td>{{ $result['Oct']['kqc'][4] }}</td>
                                      <td>{{ $result['Oct']['h'][4] }}</td>
                                      <td>{{ $result['Oct']['kh'][4] }}</td>
                                  </tr>
                              </tbody>
                          </table>
                      </div>
                  </div>
              @break

              @case('11')
                  <div class="col-12 mt-4">
                      <div class="table-responsive scrollbar">
                          <table class="table table-bordered overflow-hidden" width="100%">
                              <thead class="border border-dark" style="background-color: #d9d9d9;">
                                  <tr>
                                      <td>Bulan</td>
                                      <td>Tarikh</td>
                                      <td>Bagging</td>
                                      <td>Rosak Sebelum CP</td>
                                      <td>CP</td>
                                      <td>QC</td>
                                      <td>Rosak Selepas CP</td>
                                      <td>Tuai</td>
                                      <td>Rosak Selepas Tuai</td>
                                  </tr>
                              </thead>
                              <tbody>

                                  <tr>
                                      <td rowspan="3">Nov</td>
                                      <td>1-10</td>
                                      <td>{{ $result['Nov']['bagging'][1] }}</td>
                                      <td>{{ $result['Nov']['kcp'][1] }}</td>
                                      <td>{{ $result['Nov']['cp'][1] }}</td>
                                      <td>{{ $result['Nov']['qc'][1] }}</td>
                                      <td>{{ $result['Nov']['kqc'][1] }}</td>
                                      <td>{{ $result['Nov']['h'][1] }}</td>
                                      <td>{{ $result['Nov']['kh'][1] }}</td>
                                  </tr>
                                  <tr>
                                      <td>11-20</td>
                                      <td>{{ $result['Nov']['bagging'][2] }}</td>
                                      <td>{{ $result['Nov']['kcp'][2] }}</td>
                                      <td>{{ $result['Nov']['cp'][2] }}</td>
                                      <td>{{ $result['Nov']['qc'][2] }}</td>
                                      <td>{{ $result['Nov']['kqc'][2] }}</td>
                                      <td>{{ $result['Nov']['h'][2] }}</td>
                                      <td>{{ $result['Nov']['kh'][2] }}</td>
                                  </tr>
                                  <tr>
                                      <td>21-{{ $result['Nov']['monthEndDay'] }}</td>
                                      <td>{{ $result['Nov']['bagging'][3] }}</td>
                                      <td>{{ $result['Nov']['kcp'][3] }}</td>
                                      <td>{{ $result['Nov']['cp'][3] }}</td>
                                      <td>{{ $result['Nov']['qc'][3] }}</td>
                                      <td>{{ $result['Nov']['kqc'][3] }}</td>
                                      <td>{{ $result['Nov']['h'][3] }}</td>
                                      <td>{{ $result['Nov']['kh'][3] }}</td>
                                  </tr>
                                  <tr class="border border-dark">
                                      <td></td>
                                      <td>Jumlah</td>
                                      <td>{{ $result['Nov']['bagging'][4] }}</td>
                                      <td>{{ $result['Nov']['kcp'][4] }}</td>
                                      <td>{{ $result['Nov']['cp'][4] }}</td>
                                      <td>{{ $result['Nov']['qc'][4] }}</td>
                                      <td>{{ $result['Nov']['kqc'][4] }}</td>
                                      <td>{{ $result['Nov']['h'][4] }}</td>
                                      <td>{{ $result['Nov']['kh'][4] }}</td>
                                  </tr>
                              </tbody>
                          </table>
                      </div>
                  </div>
              @break

              @case('12')
                  <div class="col-12 mt-4">
                      <div class="table-responsive scrollbar">
                          <table class="table table-bordered overflow-hidden" width="100%">
                              <thead class="border border-dark" style="background-color: #d9d9d9;">
                                  <tr>
                                      <td>Bulan</td>
                                      <td>Tarikh</td>
                                      <td>Bagging</td>
                                      <td>Rosak Sebelum CP</td>
                                      <td>CP</td>
                                      <td>QC</td>
                                      <td>Rosak Selepas CP</td>
                                      <td>Tuai</td>
                                      <td>Rosak Selepas Tuai</td>
                                  </tr>
                              </thead>
                              <tbody>

                                  <tr>
                                      <td rowspan="3">Dec</td>
                                      <td>1-10</td>
                                      <td>{{ $result['Dec']['bagging'][1] }}</td>
                                      <td>{{ $result['Dec']['kcp'][1] }}</td>
                                      <td>{{ $result['Dec']['cp'][1] }}</td>
                                      <td>{{ $result['Dec']['qc'][1] }}</td>
                                      <td>{{ $result['Dec']['kqc'][1] }}</td>
                                      <td>{{ $result['Dec']['h'][1] }}</td>
                                      <td>{{ $result['Dec']['kh'][1] }}</td>
                                  </tr>
                                  <tr>
                                      <td>11-20</td>
                                      <td>{{ $result['Dec']['bagging'][2] }}</td>
                                      <td>{{ $result['Dec']['kcp'][2] }}</td>
                                      <td>{{ $result['Dec']['cp'][2] }}</td>
                                      <td>{{ $result['Dec']['qc'][2] }}</td>
                                      <td>{{ $result['Dec']['kqc'][2] }}</td>
                                      <td>{{ $result['Dec']['h'][2] }}</td>
                                      <td>{{ $result['Dec']['kh'][2] }}</td>
                                  </tr>
                                  <tr>
                                      <td>21-{{ $result['Dec']['monthEndDay'] }}</td>
                                      <td>{{ $result['Dec']['bagging'][3] }}</td>
                                      <td>{{ $result['Dec']['kcp'][3] }}</td>
                                      <td>{{ $result['Dec']['cp'][3] }}</td>
                                      <td>{{ $result['Dec']['qc'][3] }}</td>
                                      <td>{{ $result['Dec']['kqc'][3] }}</td>
                                      <td>{{ $result['Dec']['h'][3] }}</td>
                                      <td>{{ $result['Dec']['kh'][3] }}</td>
                                  </tr>
                                  <tr class="border border-dark">
                                      <td></td>
                                      <td>Jumlah</td>
                                      <td>{{ $result['Dec']['bagging'][4] }}</td>
                                      <td>{{ $result['Dec']['kcp'][4] }}</td>
                                      <td>{{ $result['Dec']['cp'][4] }}</td>
                                      <td>{{ $result['Dec']['qc'][4] }}</td>
                                      <td>{{ $result['Dec']['kqc'][4] }}</td>
                                      <td>{{ $result['Dec']['h'][4] }}</td>
                                      <td>{{ $result['Dec']['kh'][4] }}</td>
                                  </tr>
                              </tbody>
                          </table>
                      </div>
                  </div>
              @break

              @default
          @endswitch
      @endif
  @else
      <div class="col-12 mt-4">
          <div class="table-responsive scrollbar">
              <table class="table table-bordered overflow-hidden" width="100%">
                  <thead class="border border-dark" style="background-color: #d9d9d9;">
                      <tr>
                          <td>Tarikh</td>
                          <td>Bagging</td>
                          <td>Rosak Sebelum CP</td>
                          <td>CP</td>
                          <td>QC</td>
                          <td>Rosak Selepas CP</td>
                          <td>Tuai</td>
                          <td>Rosak Selepas Tuai</td>
                      </tr>
                  </thead>
                  <tbody>

                      <tr>
                          <td rowspan="3">{{ $tm }} - {{ $ta }}</td>
                          <td>{{ $result['bagging'] }}</td>
                          <td>{{ $result['kcp'] }}</td>
                          <td>{{ $result['cp'] }}</td>
                          <td>{{ $result['qc'] }}</td>
                          <td>{{ $result['kqc'] }}</td>
                          <td>{{ $result['h'] }}</td>
                          <td>{{ $result['kh'] }}</td>
                      </tr>
                  </tbody>
              </table>
          </div>
      </div>
  @endif
