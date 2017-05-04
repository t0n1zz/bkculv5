<?php
  $bulan = new Date('+12 weeks');
  $now = new Date('today');
  $kegiatans = App\Kegiatan::with('tempat','total_peserta')->whereDate('tanggal','<',$bulan)->get();
?>
<div class="col-sm-8">
  <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_kegiatandekat" data-toggle="tab" data-target="#tab_kegiatandekat">Kegiatan Terdekat <small class="text-muted">(3 Bulan Kedepan)</small></a></li>
            <li><a href="#tab_kegiatanjalan" data-toggle="tab" data-toggle="tab_kegiatanjalan">Kegiatan Berjalan</a></li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane fade in active" id="tab_kegiatandekat">
            <div class="table-responsive">
              <table class="table no-margin table-striped">
                <thead class="bg-light-blue-active color-palette">
                <tr>
                  <th class="warptext">Nama</th>
                  <th>Kota</th>
                  <th>Mulai</th>
                  <th>Selesai</th>
                  <th>Daftar</th>
                </tr>
                </thead>
                <tbody>
                @foreach($kegiatans as $kegiatan)
                  <?php
                    $date = new Date($kegiatan->tanggal);
                    $date2 = new Date($kegiatan->tanggal2); 

                    $sasaran = '';
                    if(!empty($kegiatan->sasaranhub)){
                        foreach ($kegiatan->sasaranhub as $sr) {
                            $sasaran .= '<a class="btn btn-info btn-sm nopointer marginbottom" >' . $sr->sasaran->name . '</a> ';
                        }
                    }
                  ?>
                  <tr>
                    <td class="warptext">{{ $kegiatan->name }}</td>
                    @if(!empty($kegiatan->tempat))
                        <td>{{ $kegiatan->tempat->kota }}</td>
                    @elseif(!empty($kegiatan->kota))
                        <td>{{ $kegiatan->kota }}</td>
                    @else
                        <td>-</td>
                    @endif
                    @if(!empty($kegiatan->tanggal))
                        <td data-order="{{ $kegiatan->tanggal }}"><i hidden="true">{{ $kegiatan->tanggal }}</i> {{  $date->format('d F Y') }}</td>
                    @else
                        <td>-</td>
                    @endif

                    @if(!empty($kegiatan->tanggal2))
                        <td data-order="{{ $kegiatan->tanggal2 }}"><i hidden="true">{{ $kegiatan->tanggal2 }}</i> {{ $date2->format('d F Y') }}</td>
                    @else
                        <td>-</td>
                    @endif
                    <td><a href="{{ route('admins.kegiatan.detail',array($kegiatan->id))}}" class="btn btn-default"><i class="fa fa-database"></i> Daftar</a></td>
                  </tr>
                @endforeach
                </tbody>
              </table>
            </div>
            <hr/>
            <a href="{{ route('admins.kegiatan.index') }}" class="btn btn-default btn-flat btn-block"><i class="fa fa-suitcase"></i> Lihat semua kegiatan</a>
        </div>
        <div class="tab-pane fade" id="tab_kegiatanjalan">
            <div class="table-responsive">
              <table class="table no-margin table-striped">
                <thead class="bg-light-blue-active color-palette">
                <tr>
                  <th class="warptext">Nama</th>
                  <th>Kota</th>
                  <th>Mulai</th>
                  <th>Selesai</th>
                  <th>Peserta</th>
                </tr>
                </thead>
                <tbody>
                @foreach($kegiatans as $kegiatan)
                  @if($kegiatan->tanggal >= $now && $kegiatan->tanggal2 <= $now)
                    <?php
                      $date = new Date($kegiatan->tanggal);
                      $date2 = new Date($kegiatan->tanggal2); 

                      $sasaran = '';
                      if(!empty($kegiatan->sasaranhub)){
                          foreach ($kegiatan->sasaranhub as $sr) {
                              $sasaran .= '<a class="btn btn-info btn-sm nopointer marginbottom" >' . $sr->sasaran->name . '</a> ';
                          }
                      }
                    ?>
                    <tr>
                      <td class="warptext">{{ $kegiatan->name }}</td>
                      <td>{{ $kegiatan->kota }}</td>
                      @if(!empty($kegiatan->tanggal))
                          <td data-order="{{ $kegiatan->tanggal }}"><i hidden="true">{{ $kegiatan->tanggal }}</i> {{  $date->format('d F Y') }}</td>
                      @else
                          <td>-</td>
                      @endif

                      @if(!empty($kegiatan->tanggal2))
                          <td data-order="{{ $kegiatan->tanggal2 }}"><i hidden="true">{{ $kegiatan->tanggal2 }}</i> {{ $date2->format('d F Y') }}</td>
                      @else
                          <td>-</td>
                      @endif
                      <td>{{ $kegiatan->total_peserta->count() }} Orang</td>
                    </tr>
                  @else
                    <tr><td colspan="5" class="text-center text-muted">Tidak terdapat kegiatan yang sedang berjalan saat ini</td></tr>
                    @break 
                  @endif
                @endforeach
                </tbody>
              </table>
            </div>
            <hr/>
            <a href="{{ route('admins.kegiatan.index') }}" class="btn btn-default btn-flat btn-block"><i class="fa fa-suitcase"></i> Lihat semua kegiatan</a>
        </div>
      </div>
  </div>
</div>
<div class="col-sm-4">
  <div class="box box-solid bg-aqua-gradient">
    <div class="box-header">
      <i class="fa fa-calendar"></i>
      <h3 class="box-title">Kalender</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body no-padding">
      <!--The calendar -->
      <div id="calendar" style="width: 100%"></div>
    </div>
    <!-- /.box-body -->
    <div class="box-footer text-black">
      <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
            <input class="form-control" type="text" value="Hari ini {{ $now->format('l, d F Y') }}" readonly />
        </div>
    </div>
  </div>
</div>