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
      <h4>LAPORAN HARIAN
          @switch($type)
              @case('balut')
                  BALUT (BAGGING)
              @break

              @case('debung')
                  PENDEBUNGAAN TERKAWAL (CONTROL POLLINATION)
              @break

              @default
          @endswitch

      </h4>
  </div>
  <div class="col-12 mt-4">
      <div class="table-responsive scrollbar">
          <table class="table table-hover table-bordered overflow-hidden" width="100%">
              <thead class="border border-dark">
                  <td>PENYELIA</td>
                  <td>BLOK</td>
                  <td>BAKA</td>
                  @for ($i = 1; $i <= $days; $i++)
                      <td>
                          {{ $i }}
                      </td>
                  @endfor
                  <td>JUMLAH</td>
              </thead>
              <tbody>
                  <?php $temp = ''; ?>

                  @foreach ($results as $key1 => $result)
                      @foreach ($result as $key2 => $b)
                          @foreach ($b as $key3 => $a)
                              <tr>
                                  @if ($temp != $key1)
                                      <td rowspan="{{ $row }}">{{ $key1 }}</td>
                                  @endif
                                  <?php $temp = $key1; ?>
                                  <td>{{ $key2 }}</td>
                                  <td>{{ $key3 }}</td>
                                  @for ($i = 1; $i <= $days; $i++)
                                      <td>
                                          {{ $day[$i][$key1][$key2][$key3] }}
                                      </td>
                                      <?php $total[$i] += $day[$i][$key1][$key2][$key3]; ?>
                                  @endfor
                                  <td>{{ $results[$key1][$key2][$key3]->count() }}</td>
                              </tr>
                          @endforeach
                      @endforeach

                      <tr>
                          <td></td>
                          <td>JUMLAH</td>
                          @for ($i = 1; $i <= $days; $i++)
                              <td>
                                  {{ $total[$i] }}
                              </td>
                          @endfor
                          <td></td>
                      </tr>
                  @endforeach

              </tbody>
          </table>
      </div>

  </div>
