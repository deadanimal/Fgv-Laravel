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
