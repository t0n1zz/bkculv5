<?php
  $cu = Auth::user()->getCU();

  if(Auth::user()->can('view.laporancu_view') && $cu == '0' && !Request::is('admins/laporancu/detail*')){
      $periodeiode1 = collect([]);
      foreach ($periodeiode as $data){
          $periodeiode1->push($data->first());
      }

      $periodes = array_column($periodeiode1->toArray(),'periode');

      foreach ($periodes as $periode) {
          $datacu = App\LaporanCu::where('periode','<=',$periode)->orderBy('periode','DESC')->get();
          $datacu1= $datacu->groupBy('no_ba');

          $datascu = collect([]);
          foreach ($datacu1 as $data2){
              $datascu->push($data2->first());
          }

          $tot_l_biasa = 0;
          $tot_l_lbiasa = 0;
          $tot_p_biasa = 0;
          $tot_p_lbiasa = 0;
          $tot_simpanansaham = 0;
          $tot_nonsaham_unggulan = 0;
          $tot_nonsaham_harian = 0;
          $tot_piutangberedar = 0;
          $tot_piutanglalai_1bulan = 0;
          $tot_piutanglalai_12bulan = 0;
          $tot_aset = 0;
          $tot_aktivalancar = 0;
          $tot_dcr = 0;
          $tot_dcu = 0;
          $tot_totalpendapatan = 0;
          $tot_totalbiaya = 0;
          $tot_shu = 0;

          foreach($datascu as $data){
              $tot_l_biasa += $data->l_biasa;
              $tot_l_lbiasa += $data->l_lbiasa;
              $tot_p_biasa += $data->p_biasa;
              $tot_p_lbiasa += $data->p_lbiasa;
              $tot_aset += $data->aset;
              $tot_aktivalancar += $data->aktivalancar;
              $tot_simpanansaham += $data->simpanansaham;
              $tot_nonsaham_unggulan += $data->nonsaham_unggulan;
              $tot_nonsaham_harian += $data->nonsaham_harian;
              $tot_piutangberedar += $data->piutangberedar;
              $tot_piutanglalai_1bulan += $data->piutanglalai_1bulan;
              $tot_piutanglalai_12bulan += $data->piutanglalai_12bulan;
              $tot_dcr += $data->dcr;
              $tot_dcu += $data->dcu;
              $tot_totalpendapatan += $data->totalpendapatan;
              $tot_totalbiaya += $data->totalbiaya;
              $tot_shu += $data->shu;
          } 
          $date = new Date($periode);
          $gperiode[] = $date->format('F Y');

          $infogerakans[$periode] = array(
              'periode' => $date->format('F Y'),
              'l_biasa' => $tot_l_biasa,
              'l_lbiasa' => $tot_l_lbiasa,
              'p_biasa' => $tot_p_biasa,
              'p_lbiasa' => $tot_p_lbiasa,
              'aset' => $tot_aset,
              'aktivalancar' => $tot_aktivalancar,
              'simpanansaham' => $tot_simpanansaham,
              'nonsaham_unggulan' => $tot_nonsaham_unggulan,
              'nonsaham_harian' => $tot_nonsaham_harian,
              'piutangberedar' => $tot_piutangberedar,
              'piutanglalai_1bulan' => $tot_piutanglalai_1bulan,
              'piutanglalai_12bulan' => $tot_piutanglalai_12bulan,
              'dcr' => $tot_dcr,
              'dcu' => $tot_dcu,
              'totalpendapatan' => $tot_totalpendapatan,
              'totalbiaya' => $tot_totalbiaya,
              'shu' => $tot_shu
          );
      };
      $dataarray = $infogerakans;
      $data1 = array_last($infogerakans);
      $data2 = array_last(array_slice($infogerakans,-2,1));
  }

  if(Auth::user()->can('view.laporancu_view') && $cu != '0' || Request::is('admins/laporancu/detail*') ){
      
      if(Request::is('admins/laporancu/detail*')){
        $datas = App\LaporanCu::where('no_ba','=',$no_ba)->where('periode','<=',$periode)->orderBy('periode','desc')->get();
      }else{
        $datas = App\LaporanCu::where('no_ba','=',$cu)->orderBy('periode','desc')->get();
      }

      $dataarray = $datas->sortBy('periode')->toArray();
      $periode = array_column($dataarray,'periode');

      foreach ($periode as $a){
          $gperiode[] = date('F Y', strtotime($a));
      }

      $data1 = array_last($dataarray);
      $data2 = array_last(array_slice($dataarray,-2,1));

      $tot_nonsaham = $data1['nonsaham_harian'] + $data1['nonsaham_unggulan'];
      $tot_anggota =  $data1['l_biasa'] + $data1['p_biasa'] + $data1['l_lbiasa'] + $data1['p_lbiasa'];

      $p1 = $data1['piutanglalai_12bulan'] != 0 ? $data1['dcr']/$data1['piutanglalai_12bulan'] : $data1['dcr']/ 0.01;
      $p2 = $data1['piutanglalai_1bulan'] != 0 ? ($data1['dcr'] - $data1['piutanglalai_12bulan'])/$data1['piutanglalai_1bulan'] : ($data1['dcr'] - $data1['piutanglalai_12bulan'])/ 0.01 ;
      if($p1 == 1 && $p2 > 0.35){
          $e1 = $data1['aset'] != 0 ? ($data1['piutangberedar'] - (($data1['piutanglalai_12bulan']) + ((35/100) * $data1['piutanglalai_1bulan']))) / $data1['aset'] : ($data1['piutangberedar'] - (($data1['piutanglalai_12bulan']) + ((35/100) * $data1['piutanglalai_1bulan']))) / 0.01;
      }else{
          $e1 = $data1['aset'] != 0 ? ($data1['piutangberedar'] - $data1['dcr']) / $data1['aset'] : ($data1['piutangberedar'] - $data1['dcr']) / 0.01;
      }
      $e5 = $data1['aset'] != 0 ? ($data1['nonsaham_unggulan'] + $data1['nonsaham_harian']) / $data1['aset'] : ($data1['nonsaham_unggulan'] + $data1['nonsaham_harian']) / 0.01;
      $e6 = $data1['aset'] != 0 ? $data1['totalhutang_pihak3'] / $data1['aset'] : $data1['totalhutang_pihak3'] / 0.01;
      $e9 = $data1['aset'] != 0 ? (($data1['dcr'] + $data1['dcu'] + $data1['iuran_gedung'] + $data1['donasi'] + $data1['shu_lalu']) - ($data1['piutanglalai_12bulan'] + ((35/100) * $data1['piutanglalai_1bulan']) + $data1['aset_masalah'])) / $data1['aset'] : (($data1['dcr'] + $data1['dcu'] + $data1['iuran_gedung'] + $data1['donasi'] + $data1['shu_lalu']) - ($data1['piutanglalai_12bulan'] + ((35/100) * $data1['piutanglalai_1bulan']) + $data1['aset_masalah'])) / 0.01;
      $a1 = $data1['piutangberedar'] != 0 ? ($data1['piutanglalai_1bulan'] + $data1['piutanglalai_12bulan']) / $data1['piutangberedar'] : ($data1['piutanglalai_1bulan'] + $data1['piutanglalai_12bulan']) / 0.01; 
      $a2 = $data1['aset'] != 0 ? $data1['aset_tidak_menghasilkan'] / $data1['aset'] : $data1['aset_tidak_menghasilkan'] / 0.01;
      $ratasaham1 = ((($data1['simpanansaham_des']+ $data1['simpanansaham'])/2)/$date->format('m'))*12;
      $r7 = $data1['bjs_saham'] / $ratasaham1;
      $r7_2 = $data1['bjs_saham'] / (($data1['simpanansaham_lalu']+ $data1['simpanansaham'])/2);
      if($data1['simpanansaham_des'] == 0 && $data1['simpanansaham_lalu'] != 0){
          $r7 = $r7_2;
      }
      $r9 = ($data1['totalbiaya'] - $data1['beban_penyisihandcr']) / (($data1['shu'] + $data1['shu_lalu'])/ 2);
      $l1 = $tot_nonsaham != 0 ? (($data1['investasi_likuid'] + $data1['aset_likuid_tidak_menghasilkan']) - $data1['hutang_tidak_berbiaya_30hari']) / $tot_nonsaham : (($data1['investasi_likuid'] + $data1['aset_likuid_tidak_menghasilkan']) - $data1['hutang_tidak_berbiaya_30hari']) / 0.01;
      $s10 = $data1['totalanggota_lalu'] != 0 ? ($tot_anggota - $data1['totalanggota_lalu']) / $data1['totalanggota_lalu'] : ($tot_anggota - $data1['totalanggota_lalu']) / 0.01;
      $s11 = $data1['aset_lalu'] != 0 ? ($data1['aset'] - $data1['aset_lalu']) / $data1['aset_lalu'] : ($data1['aset'] - $data1['aset_lalu']) / 0.01;

      $p1 = $p1 > 1 ? 1 : $p1;
      $p2 = $p2 > 1 ? 1 : $p2;
      $e1 = $e1 > 1 ? 1 : $e1;
      $e5 = $e5 > 1 ? 1 : $e5;
      $e6 = $e6 > 1 ? 1 : $e6;
      $e9 = $e9 > 1 ? 1 : $e9;
      $a1 = $a1 > 1 ? 1 : $a1;
      $a2 = $a2 > 1 ? 1 : $a2;
      $r7 = $r7 > 1 ? 1 : $r7;
      $r7_2 = $r7_2 > 1 ? 1 : $r7_2;
      $l1 = $l1 > 1 ? 1 : $l1;
      $s10 = $s10 > 1 ? 1 : $s10;
      $s11 = $s11 > 1 ? 1 : $s11;

      $p1 = $p1 < 0 ? 0 : $p1;
      $p2 = $p2 < 0 ? 0 : $p2;
      $e1 = $e1 < 0 ? 0 : $e1;
      $e5 = $e5 < 0 ? 0 : $e5;
      $e6 = $e6 < 0 ? 0 : $e6;
      $e9 = $e9 < 0 ? 0 : $e9;
      $a1 = $a1 < 0 ? 0 : $a1;
      $a2 = $a2 < 0 ? 0 : $a2;
      $r7 = $r7 < 0 ? 0 : $r7;
      $r7_2 = $r7 < 0 ? 0 : $r7_2;
      $l1 = $l1 < 0 ? 0 : $l1;
      $s10 = $s10 < 0 ? 0 : $s10;
      $s11 = $s11 < 0 ? 0 : $s11;

      $p1 = number_format($p1*100,0);
      $p2 = number_format($p2*100,0);
      $e1 = number_format($e1*100,0);
      $e5 = number_format($e5*100,0);
      $e6 = number_format($e6*100,0);
      $e9 = number_format($e9*100,0);
      $a1 = number_format($a1*100,0);
      $a2 = number_format($a2*100,0);
      $r7 = number_format($r7*100,0);
      $r7_2 = number_format($r7_2*100,2);
      $r9 = number_format($r9*100,0);
      $l1 = number_format($l1*100,0);
      $s10 = number_format($s10*100,0);
      $s11 = number_format($s11*100,0);
  }

  if(Auth::user()->can('view.laporancu_view')){
      $l_biasa = $data1['l_biasa'] - $data2['l_biasa'];
      $l_lbiasa = $data1['l_lbiasa'] - $data2['l_lbiasa'];
      $p_biasa = $data1['p_biasa'] - $data2['p_biasa'];
      $p_lbiasa = $data1['p_lbiasa'] - $data2['p_lbiasa'];
      $tot_anggota1 =  $data1['l_biasa'] + $data1['p_biasa'] + $data1['l_lbiasa'] + $data1['p_lbiasa'];
      $tot_anggota2 =  $data2['l_biasa'] + $data2['p_biasa'] + $data2['l_lbiasa'] + $data2['p_lbiasa'];
      $tot_anggota = $tot_anggota1 - $tot_anggota2;
      $aktivalancar = $data1['aktivalancar'] - $data2['aktivalancar'];
      $simpanansaham = $data1['simpanansaham'] - $data2['simpanansaham'];
      $nonsaham_unggulan = $data1['nonsaham_unggulan'] - $data2['nonsaham_unggulan'];
      $nonsaham_harian = $data1['nonsaham_harian'] - $data2['nonsaham_harian'];
      $simpanan_nonsaham = $nonsaham_unggulan + $nonsaham_harian;
      $piutangberedar = $data1['piutangberedar'] - $data2['piutangberedar'];
      $piutanglalai_1bulan = $data1['piutanglalai_1bulan'] - $data2['piutanglalai_1bulan'];
      $piutanglalai_12bulan = $data1['piutanglalai_12bulan'] - $data2['piutanglalai_12bulan'];
      $piutangbersih1 = $data1['piutangberedar'] - ($data1['piutanglalai_1bulan'] + $data1['piutanglalai_12bulan']);
      $piutangbersih2 = $data2['piutangberedar'] - ($data2['piutanglalai_1bulan'] + $data2['piutanglalai_12bulan']);
      $piutangbersih = $piutangbersih1 - $piutangbersih2;
      $aset = $data1['aset'] - $data2['aset'];
      $dcr = $data1['dcr'] - $data2['dcr'];
      $dcu = $data1['dcu'] - $data2['dcu'];
      $totalpendapatan = $data1['totalpendapatan'] - $data2['totalpendapatan'];
      $totalbiaya = $data1['totalbiaya'] - $data2['totalbiaya'];
      $shu = $data1['shu'] - $data2['shu'];

      if($data1['aset'] != 0){
          $rasio_beredar1 = number_format((($data1['piutangberedar'] / $data1['aset'])*100),2);
      }else{
          $rasio_beredar1 = 0;
      }
      if($data1['piutangberedar'] != 0){
          $rasio_lalai1 = number_format(((($data1['piutanglalai_1bulan'] + $data1['piutanglalai_12bulan']) / $data1['piutangberedar'])*100),2);
      }else{
          $rasio_lalai1 = 0;
      }
      if($data2['aset'] != 0){
          $rasio_beredar2 = number_format((($data2['piutangberedar'] / $data2['aset'])*100),2);
      }else{
          $rasio_beredar2 = 0;
      }
      if($data2['piutangberedar'] != 0){
          $rasio_lalai2 = number_format(((($data2['piutanglalai_1bulan'] + $data2['piutanglalai_12bulan']) / $data2['piutangberedar'])*100),2);
      }else{
          $rasio_lalai2 = 0;
      }
      $rasio_beredar = $rasio_beredar1 - $rasio_beredar2;
      $rasio_lalai = $rasio_lalai1 - $rasio_lalai2;

      $gl_biasa = array_column($dataarray,'l_biasa');
      $gl_lbiasa = array_column($dataarray,'l_lbiasa');
      $gp_biasa = array_column($dataarray,'p_biasa');
      $gp_lbiasa = array_column($dataarray,'p_lbiasa');
      $gaset = array_column($dataarray,'aset');
      $gaktivalancar = array_column($dataarray,'aktivalancar');
      $gsimpanansaham = array_column($dataarray,'simpanansaham');
      $gnonsaham_unggulan = array_column($dataarray,'nonsaham_unggulan');
      $gnonsaham_harian = array_column($dataarray,'nonsaham_harian');
      $ghutangspd = array_column($dataarray,'hutangspd');
      $gpiutangberedar = array_column($dataarray,'piutangberedar');
      $gpiutanglalai_1bulan = array_column($dataarray,'piutanglalai_1bulan');
      $gpiutanglalai_12bulan = array_column($dataarray,'piutanglalai_12bulan');
      $gdcr = array_column($dataarray,'dcr');
      $gdcu = array_column($dataarray,'dcu');
      $gtotalpendapatan = array_column($dataarray,'totalpendapatan');
      $gtotalbiaya = array_column($dataarray,'totalbiaya');
      $gshu = array_column($dataarray,'shu');

      foreach ($dataarray as $data){
          $totalanggota = $data['l_biasa'] + $data['l_lbiasa'] + $data['p_biasa'] + $data['p_lbiasa'];
          $piutangbersih = $data['piutangberedar'] - ($data['piutanglalai_1bulan'] + $data['piutanglalai_12bulan']);
          if($data['aset'] != 0){
                  $rasioberedar = number_format((($data['piutangberedar'] / $data['aset'])*100),2);
          }else{
              $rasioberedar = 0;
          }
          if($data['piutangberedar'] != 0){
              $rasiolalai = number_format(((($data['piutanglalai_1bulan'] + $data['piutanglalai_12bulan']) / $data['piutangberedar'])*100),2);
          }else{
              $rasiolalai = 0;
          }
          $gtotalanggota[] = $totalanggota;
          $gpiutangbersih[] = $piutangbersih;
          $grasioberedar[] = $rasioberedar;
          $grasiolalai[] = $rasiolalai;
      }
  }
?>

<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        @if($cu != '0' || Request::is('admins/laporancu/detail*'))
            <li class="active"><a href="#tab_perkembangan" data-toggle="tab">Perkembangan CU</a></li>
            <li><a href="#tab_pearls" data-toggle="tab">P.E.A.R.L.S.</a></li>
        @else
            <li class="active"><a href="#tab_perkembangan" data-toggle="tab">Perkembangan CU (Konsolidasi)</a></li>
            <li class="pull-right"><a href="#" class="text-muted ">Periode <b>{{ $data1['periode'] }}</b></a></li>  
        @endif
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="tab_perkembangan">
          <div class="row">
            <div class="col-md-10">
              <div class="chart">
                <!-- Sales Chart Canvas -->
                <canvas id="chart" height="100em"></canvas>
                <br/>
                <div class="input-group">
                    <div class="input-group-addon primary-color"><i class="fa fa-fw fa-line-chart"></i> Grafik Laporan Berdasarkan</div>
                    <select class="form-control" id="chart_select">
                        <option value="totalanggota">Total Anggota</option>
                        <option value="l_biasa">Anggota Lelaki Biasa</option>
                        <option value="l_lbiasa">Anggota Lelaki Luar Biasa</option>
                        <option value="p_biasa">Anggota Perempuan Biasa</option>
                        <option value="p_lbiasa">Anggota Perempuan Luar Biasa</option>
                        <option value="aktivalancar">Aktiva Lancar</option>
                        <option value="simpanansaham">Simpanan Saham</option>
                        <option value="nonsaham_unggulan">Simpanan Non Saham Unggulan</option>
                        <option value="nonsaham_harian">Simpanan Non Saham Harian & Deposito</option>
                        <option value="hutangspd">Hutang SPD</option>
                        <option value="aset">Aset</option>
                        <option value="piutangberedar">Piutang Beredar</option>
                        <option value="piutanglalai_1bulan">Piutang Lalai 1-12 Bulan</option>
                        <option value="piutanglalai_12bulan">Piutang Lalai > 12 Bulan</option>
                        <option value="piutangbersih">Piutang Bersih</option>
                        <option value="rasioberedar">Rasio Piutang Beredar</option>
                        <option value="rasiolalai">Rasio Piutang Lalai</option>
                        <option value="dcr">DCR</option>
                        <option value="dcu">DCU</option>
                        <option value="totalpendapatan">Total Pendapatan</option>
                        <option value="totalbiaya">Total Biaya</option>
                        <option value="shu">SHU</option>
                    </select>
                </div>
              </div>
              <!-- /.chart-responsive -->
            </div>
            <!-- /.col -->
            <div class="col-md-2">
              <br/>
              <p class="text-center"><strong>ANGGOTA</strong></p>
              <div class="pad box-pane-right bg-aqua" style="min-height: 280px">
                <div class="description-block margin-bottom" style="margin-bottom: .5em;">
                  <span><i class="fa fa-male"></i> Laki-laki</span>
                  <h5 class="description-header" style="margin-top:.5em;"> {{ number_format($data1['l_biasa'],"0",",",".") }}</h5>
                  @if($l_biasa > 0)
                    <i class="fa fa-caret-up"></i>
                  @elseif($l_biasa < 0)
                    <i class="fa fa-caret-down"></i>
                  @else
                    <i class="fa fa-caret-left"></i>
                  @endif 
                  {{ number_format(abs($l_biasa),"0",",",".") }}
                </div>
                <hr style="padding: 0;margin:0;" />
                <!-- /.description-block -->
                <div class="description-block margin-bottom" style="margin-bottom: .5em;">
                  <span><i class="fa fa-female"></i> Perempuan</span>
                  <h5 class="description-header" style="margin-top:.5em;"> {{ number_format($data1['p_biasa'],"0",",",".") }}</h5>
                  @if($p_biasa > 0)
                    <i class="fa fa-caret-up"></i>
                  @elseif($p_biasa < 0)
                    <i class="fa fa-caret-down"></i>
                  @else
                    <i class="fa fa-caret-left"></i>
                  @endif 
                  {{ number_format(abs($p_biasa),"0",",",".") }}
                </div>
                <hr style="padding: 0;margin:0;" />
                <!-- /.description-block -->
                <div class="description-block margin-bottom" style="margin-bottom: .5em;">
                  <span><i class="fa fa-child"></i> Laki-laki Luar Biasa</span>
                  <h5 class="description-header" style="margin-top:.5em;"> {{ number_format($data1['l_lbiasa'],"0",",",".") }}</h5>
                  @if($l_lbiasa > 0)
                    <i class="fa fa-caret-up"></i>
                  @elseif($l_lbiasa < 0)
                    <i class="fa fa-caret-down"></i>
                  @else
                    <i class="fa fa-caret-left"></i>
                  @endif 
                  {{ number_format(abs($l_lbiasa),"0",",",".") }}
                </div>
                <hr style="padding: 0;margin:0;" />
                <!-- /.description-block -->
                <div class="description-block margin-bottom" style="margin-bottom: .5em;">
                  <span><i class="fa fa-child"></i> Perempuan Luar Biasa</span>
                  <h5 class="description-header" style="margin-top:.5em;"> {{ number_format($data1['p_lbiasa'],"0",",",".") }}</h5>
                  @if($p_lbiasa > 0)
                    <i class="fa fa-caret-up"></i>
                  @elseif($p_lbiasa < 0)
                    <i class="fa fa-caret-down"></i>
                  @else
                    <i class="fa fa-caret-left"></i>
                  @endif 
                  {{ number_format(abs($p_lbiasa),"0",",",".") }}
                </div>
                <!-- /.description-block -->
              </div>
            </div>
            <!-- /.col -->
          </div>
          <div class="row"><div class="col-sm-12"><hr/></div> </div>
          <div class="row">
            <div class="col-sm-2 col-xs-6">
                <div class="description-block border-right">
                  @if($tot_anggota > 0)
                    <span class="description-percentage text-aqua"><i class="fa fa-caret-up"></i>
                  @elseif($tot_anggota < 0)
                    <span class="description-percentage text-red"><i class="fa fa-caret-down"></i>
                  @else
                    <span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i>
                  @endif 
                  {{ number_format(abs($tot_anggota),"0",",",".") }}</span>
                  <h5 class="description-header">{{ number_format($tot_anggota1,"0",",",".") }}</h5>
                  <span class="description-text">Total Anggota</span>
                </div>
                <!-- /.description-block -->
            </div>
            <div class="col-sm-2 col-xs-6">
                <div class="description-block border-right">
                  @if($aktivalancar > 0)
                    <span class="description-percentage text-aqua"><i class="fa fa-caret-up"></i>
                  @elseif($aktivalancar < 0)
                    <span class="description-percentage text-red"><i class="fa fa-caret-down"></i>
                  @else
                    <span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i>
                  @endif 
                  {{ number_format(abs($aktivalancar),"0",",",".") }}</span>
                  <h5 class="description-header">{{ number_format($data1['aktivalancar'],"0",",",".") }}</h5>
                  <span class="description-text">Aktiva Lancar</span>
                </div>
                <!-- /.description-block -->
            </div>
            <!-- /.col -->
            <div class="col-sm-2 col-xs-6">
              <div class="description-block border-right">
                @if($simpanansaham > 0)
                  <span class="description-percentage text-aqua"><i class="fa fa-caret-up"></i>
                @elseif($simpanansaham < 0)
                  <span class="description-percentage text-red"><i class="fa fa-caret-down"></i>
                @else
                  <span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i>
                @endif 
                {{ number_format(abs($simpanansaham),"0",",",".") }}</span>
                <h5 class="description-header">{{ number_format($data1['simpanansaham'],"0",",",".") }}</h5>
                <span class="description-text">Simpanan Saham</span>
              </div>
              <!-- /.description-block -->
            </div>
            <!-- /.col -->  
            <div class="col-sm-3 col-xs-6">
              <div class="description-block">
                @if($nonsaham_harian > 0)
                  <span class="description-percentage text-aqua"><i class="fa fa-caret-up"></i>
                @elseif($nonsaham_harian < 0)
                  <span class="description-percentage text-red"><i class="fa fa-caret-down"></i>
                @else
                  <span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i>
                @endif 
                {{ number_format(abs($nonsaham_harian),"0",",",".") }}</span>
                <h5 class="description-header">{{ number_format($data1['nonsaham_harian'],"0",",",".") }}</h5>
                <span class="description-text">Simpanan Non Saham Harian</span>
              </div>
              <!-- /.description-block -->
            </div>
             <!-- /.col -->  
            <div class="col-sm-3 col-xs-6">
              <div class="description-block">
                @if($nonsaham_unggulan > 0)
                  <span class="description-percentage text-aqua"><i class="fa fa-caret-up"></i>
                @elseif($nonsaham_unggulan < 0)
                  <span class="description-percentage text-red"><i class="fa fa-caret-down"></i>
                @else
                  <span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i>
                @endif 
                {{ number_format(abs($nonsaham_unggulan),"0",",",".") }}</span>
                <h5 class="description-header">{{ number_format($data1['nonsaham_unggulan'],"0",",",".") }}</h5>
                <span class="description-text">Simpanan Non Saham Unggulan</span>
              </div>
              <!-- /.description-block -->
            </div>
          </div>
          <div class="row"><div class="col-sm-12"><hr/></div> </div>
          <div class="row">
                <div class="col-sm-2 col-xs-6">
                  <div class="description-block border-right">
                    @if($aset > 0)
                      <span class="description-percentage text-aqua"><i class="fa fa-caret-up"></i>
                    @elseif($aset < 0)
                      <span class="description-percentage text-red"><i class="fa fa-caret-down"></i>
                    @else
                      <span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i>
                    @endif 
                    {{ number_format(abs($aset),"0",",",".") }}</span>
                    <h5 class="description-header">{{ number_format($data1['aset'],"0",",",".") }}</h5>
                    <span class="description-text">Aset</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-2 col-xs-6">
                  <div class="description-block border-right">
                    @if($dcr > 0)
                      <span class="description-percentage text-aqua"><i class="fa fa-caret-up"></i>
                    @elseif($dcr < 0)
                      <span class="description-percentage text-red"><i class="fa fa-caret-down"></i>
                    @else
                      <span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i>
                    @endif 
                    {{ number_format(abs($dcr),"0",",",".") }}</span>
                    <h5 class="description-header">{{ number_format($data1['dcr'],"0",",",".") }}</h5>
                    <span class="description-text">DCR</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-2 col-xs-6">
                  <div class="description-block border-right">
                    @if($dcu > 0)
                      <span class="description-percentage text-aqua"><i class="fa fa-caret-up"></i>
                    @elseif($dcu < 0)
                      <span class="description-percentage text-red"><i class="fa fa-caret-down"></i>
                    @else
                      <span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i>
                    @endif 
                    {{ number_format(abs($dcu),"0",",",".") }}</span>
                    <h5 class="description-header">{{ number_format($data1['dcu'],"0",",",".") }}</h5>
                    <span class="description-text">DCU</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-2 col-xs-6">
                  <div class="description-block border-right">
                    @if($totalbiaya > 0)
                      <span class="description-percentage text-aqua"><i class="fa fa-caret-up"></i>
                    @elseif($totalbiaya < 0)
                      <span class="description-percentage text-red"><i class="fa fa-caret-down"></i>
                    @else
                      <span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i>
                    @endif 
                    {{ number_format(abs($totalbiaya),"0",",",".") }}</span>
                    <h5 class="description-header">{{ number_format($data1['totalbiaya'],"0",",",".") }}</h5>
                    <span class="description-text">Biaya</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-2 col-xs-6">
                  <div class="description-block border-right">
                    @if($totalpendapatan > 0)
                      <span class="description-percentage text-aqua"><i class="fa fa-caret-up"></i>
                    @elseif($totalpendapatan < 0)
                      <span class="description-percentage text-red"><i class="fa fa-caret-down"></i>
                    @else
                      <span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i>
                    @endif 
                    {{ number_format(abs($totalpendapatan),"0",",",".") }}</span>
                    <h5 class="description-header">{{ number_format($data1['totalpendapatan'],"0",",",".") }}</h5>
                    <span class="description-text">Pendapatan</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->  
                <div class="col-sm-2 col-xs-6">
                  <div class="description-block">
                    @if($shu > 0)
                      <span class="description-percentage text-aqua"><i class="fa fa-caret-up"></i>
                    @elseif($shu < 0)
                      <span class="description-percentage text-red"><i class="fa fa-caret-down"></i>
                    @else
                      <span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i>
                    @endif 
                    {{ number_format(abs($shu),"0",",",".") }}</span>
                    <h5 class="description-header">{{ number_format($data1['shu'],"0",",",".") }}</h5>
                    <span class="description-text">SHU</span>
                  </div>
                  <!-- /.description-block -->
                </div>
          </div>
          <div class="row"><div class="col-sm-12"><hr/></div> </div>
          <div class="row">
                <div class="col-sm-2 col-xs-6">
                  <div class="description-block border-right">
                    @if($piutangberedar > 0)
                      <span class="description-percentage text-aqua"><i class="fa fa-caret-up"></i>
                    @elseif($piutangberedar < 0)
                      <span class="description-percentage text-red"><i class="fa fa-caret-down"></i>
                    @else
                      <span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i>
                    @endif 
                    {{ number_format(abs($piutangberedar),"0",",",".") }}</span>
                    <h5 class="description-header">{{ number_format($data1['piutangberedar'],"0",",",".") }}</h5>
                    <span class="description-text">Piutang Beredar</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-2 col-xs-6">
                  <div class="description-block border-right">
                    @if($piutangbersih > 0)
                      <span class="description-percentage text-aqua"><i class="fa fa-caret-up"></i>
                    @elseif($piutangbersih < 0)
                      <span class="description-percentage text-red"><i class="fa fa-caret-down"></i>
                    @else
                      <span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i>
                    @endif 
                    {{ number_format(abs($piutangbersih),"0",",",".") }}</span>
                    <h5 class="description-header">{{ number_format($piutangbersih1,"0",",",".") }}</h5>
                    <span class="description-text">Piutang Bersih</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-2 col-xs-6">
                  <div class="description-block border-right">
                    @if($piutanglalai_1bulan > 0)
                      <span class="description-percentage text-aqua"><i class="fa fa-caret-up"></i>
                    @elseif($piutanglalai_1bulan < 0)
                      <span class="description-percentage text-red"><i class="fa fa-caret-down"></i>
                    @else
                      <span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i>
                    @endif 
                    {{ number_format(abs($piutanglalai_1bulan),"0",",",".") }}</span>
                    <h5 class="description-header">{{ number_format($data1['piutanglalai_1bulan'],"0",",",".") }}</h5>
                    <span class="description-text">Piutang Lalai 1-12 Bulan</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-2 col-xs-6">
                  <div class="description-block border-right">
                    @if($piutanglalai_12bulan > 0)
                      <span class="description-percentage text-aqua"><i class="fa fa-caret-up"></i>
                    @elseif($piutanglalai_12bulan < 0)
                      <span class="description-percentage text-red"><i class="fa fa-caret-down"></i>
                    @else
                      <span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i>
                    @endif 
                    {{ number_format(abs($piutanglalai_12bulan),"0",",",".") }}</span>
                    <h5 class="description-header">{{ number_format($data1['piutanglalai_12bulan'],"0",",",".") }}</h5>
                    <span class="description-text">Piutang Lalai > 12 Bulan</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-2 col-xs-6">
                  <div class="description-block border-right">
                    @if($rasio_beredar > 0)
                      <span class="description-percentage text-aqua"><i class="fa fa-caret-up"></i>
                    @elseif($rasio_beredar < 0)
                      <span class="description-percentage text-red"><i class="fa fa-caret-down"></i>
                    @else
                      <span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i>
                    @endif 
                    {{ abs($rasio_beredar) }} %</span>
                    <h5 class="description-header">{{ $rasio_beredar1 }} %</h5>
                    <span class="description-text">Rasio Piutang Beredar</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->  
                <div class="col-sm-2 col-xs-6">
                  <div class="description-block">
                    @if($rasio_lalai > 0)
                      <span class="description-percentage text-aqua"><i class="fa fa-caret-up"></i>
                    @elseif($rasio_lalai < 0)
                      <span class="description-percentage text-red"><i class="fa fa-caret-down"></i>
                    @else
                      <span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i>
                    @endif 
                    {{ abs($rasio_lalai) }} %</span>
                    <h5 class="description-header">{{ $rasio_lalai1 }} %</h5>
                    <span class="description-text">Rasio Piutang Lalai</span>
                  </div>
                  <!-- /.description-block -->
                </div>
          </div>
        </div>
        @if($cu != '0' || Request::is('admins/laporancu/detail*'))
            <div class="tab-pane" id="tab_pearls">
              <div class="row">  
                <div class="col-md-3 col-sm-6 col-xs-12">
                  @if($p1 < 100)<div class="info-box bg-red"> @else <div class="info-box bg-aqua"> @endif
                    <span class="info-box-icon">P1</span>
                    <div class="info-box-content">
                      <span class="info-box-text">{{ $p1 }} % </span>
                      <span class="info-box-number">@if($p1 < 100)<b>Tidak Ideal</b>@else<b>Ideal</b>@endif</span>
                      <div class="progress">
                        <div class="progress-bar" style="width: {{$p1}}%"></div>
                      </div>
                          <span class="progress-description">
                            Protection ( = 100% )
                          </span>
                    </div>
                  </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                  @if($p2 < 35)<div class="info-box bg-red"> @else <div class="info-box bg-aqua"> @endif
                    <span class="info-box-icon">P2</span>
                    <div class="info-box-content">
                      <span class="info-box-text">{{ $p2 }} %</span>
                      <span class="info-box-number"> @if($p2 < 35)<b>Tidak Ideal</b>@else<b>Ideal</b>@endif</span>
                      <div class="progress">
                        <div class="progress-bar" style="width: {{$p2}}%"></div>
                      </div>
                          <span class="progress-description">
                            Protection ( &gt; 35% )
                          </span>
                    </div>
                  </div>
                </div> 
                <div class="col-md-3 col-sm-6 col-xs-12">
                  @if($e1 < 70 || $e1 > 80)<div class="info-box bg-red"> @else <div class="info-box bg-aqua"> @endif
                    <span class="info-box-icon">E1</span>
                    <div class="info-box-content">
                      <span class="info-box-text">{{ $e1 }} %</span>
                      <span class="info-box-number"> @if($e1 < 70 || $e1 > 80)<b>Tidak Ideal</b>@else<b>Ideal</b>@endif </span>
                      <div class="progress">
                        <div class="progress-bar" style="width: {{$e1}}%"></div>
                      </div>
                          <span class="progress-description">
                            Effective Financial ( 70-80% )
                          </span>
                    </div>
                  </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                  @if($e5 < 70 || $e5 > 80)<div class="info-box bg-red"> @else <div class="info-box bg-aqua"> @endif
                    <span class="info-box-icon">E5</span>
                    <div class="info-box-content">
                      <span class="info-box-text">{{ $e5 }} %</span>
                      <span class="info-box-number"> @if($e5 < 70 || $e5 > 80)<b>Tidak Ideal</b>@else<b>Ideal</b>@endif </span>
                      <div class="progress">
                        <div class="progress-bar" style="width: {{$e5}}%"></div>
                      </div>
                          <span class="progress-description">
                             Effective Financial ( 70-80% )
                          </span>
                    </div>
                  </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                  @if($e6 > 5 )<div class="info-box bg-red"> @else <div class="info-box bg-aqua"> @endif
                    <span class="info-box-icon">E6</span>
                    <div class="info-box-content">
                      <span class="info-box-text">{{ $e6 }} %</span>
                      <span class="info-box-number"> @if($e6 > 5)<b>Tidak Ideal</b>@else<b>Ideal</b>@endif </span>
                      <div class="progress">
                        <div class="progress-bar" style="width: {{$e6}}%"></div>
                      </div>
                          <span class="progress-description">
                            Effective Financial ( &le; 5% )
                          </span>
                    </div>
                  </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                  @if($e9 < 10 )<div class="info-box bg-red"> @else <div class="info-box bg-aqua"> @endif
                    <span class="info-box-icon">E9</span>
                    <div class="info-box-content">
                      <span class="info-box-text">{{ $e9 }} %</span>
                      <span class="info-box-number"> @if($e9 < 10)<b>Tidak Ideal</b>@else<b>Ideal</b>@endif </span>
                      <div class="progress">
                        <div class="progress-bar" style="width: {{$e9}}%"></div>
                      </div>
                          <span class="progress-description">
                             Effective Financial ( &ge; 10% )
                          </span>
                    </div>
                  </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                  @if($a1 > 10 )<div class="info-box bg-red"> @else <div class="info-box bg-aqua"> @endif
                    <span class="info-box-icon">A1</span>
                    <div class="info-box-content">
                      <span class="info-box-text">{{ $a1 }} %</span>
                      <span class="info-box-number">  @if($a1 > 5)<b>Tidak Ideal</b>@else<b>Ideal</b>@endif </span>
                      <div class="progress">
                        <div class="progress-bar" style="width: {{$a1}}%"></div>
                      </div>
                          <span class="progress-description">
                             Asset Quality ( &le; 5% )
                          </span>
                    </div>
                  </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                  @if($a2 > 10 )<div class="info-box bg-red"> @else <div class="info-box bg-aqua"> @endif
                    <span class="info-box-icon">A2</span>
                    <div class="info-box-content">
                      <span class="info-box-text">{{ $a2 }} %</span>
                      <span class="info-box-number"> @if($a2 > 5)<b>Tidak Ideal</b>@else<b>Ideal</b>@endif </span>
                      <div class="progress">
                        <div class="progress-bar" style="width: {{$a2}}%"></div>
                      </div>
                          <span class="progress-description">
                            Asset Quality ( &lt; 5% )
                          </span>
                    </div>
                  </div>
                </div>  
                <div class="col-md-3 col-sm-6 col-xs-12">
                  @if($r7 != $data1['hargapasar'])<div class="info-box bg-red"> @else <div class="info-box bg-aqua"> @endif
                    <span class="info-box-icon">R7</span>
                    <div class="info-box-content">
                      <span class="info-box-text">{{ $r7 }} %</span>
                      <span class="info-box-number"> @if($r7 != $data1['hargapasar'])<b>Tidak Ideal</b>@else<b>Ideal</b>@endif </span>
                      <div class="progress">
                        <div class="progress-bar" style="width: {{$r7}}%"></div>
                      </div>
                          <span class="progress-description">
                            Rates of Return ( = harga pasar )
                          </span>
                    </div>
                  </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                  @if($r9 != 5 )<div class="info-box bg-red"> @else <div class="info-box bg-aqua"> @endif
                    <span class="info-box-icon">R9</span>
                    <div class="info-box-content">
                      <span class="info-box-text">{{ $r9 }} %</span>
                      <span class="info-box-number"> @if($r9 != 5)<b>Tidak Ideal</b>@else<b>Ideal</b>@endif </span>
                      <div class="progress">
                        <div class="progress-bar" style="width: {{$r9}}%"></div>
                      </div>
                          <span class="progress-description">
                            Rates of Return ( = 5% )
                          </span>
                    </div>
                  </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                  @if($l1 < 15 || $l1 > 20 )<div class="info-box bg-red"> @else <div class="info-box bg-aqua"> @endif
                    <span class="info-box-icon">L1</span>
                    <div class="info-box-content">
                      <span class="info-box-text">{{ $l1 }} %</span>
                      <span class="info-box-number"> @if($l1 < 15 || $l1 > 20)<b>Tidak Ideal</b>@else<b>Ideal</b>@endif </span>
                      <div class="progress">
                        <div class="progress-bar" style="width: {{$l1}}%"></div>
                      </div>
                          <span class="progress-description">
                            Liquidity ( 15-20% )
                          </span>
                    </div>
                  </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                  @if($s10 < 12 )<div class="info-box bg-red"> @else <div class="info-box bg-aqua"> @endif
                    <span class="info-box-icon">S10</span>
                    <div class="info-box-content">
                      <span class="info-box-text">{{ $s10 }} %</span>
                      <span class="info-box-number"> @if($s10 < 12)<b>Tidak Ideal</b>@else<b>Ideal</b>@endif </span>
                      <div class="progress">
                        <div class="progress-bar" style="width: {{$s10}}%"></div>
                      </div>
                          <span class="progress-description">
                             Signs of Growth ( &gt; 12% )
                          </span>
                    </div>
                  </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                  @if($s11 < $data1['lajuinflasi'] + 10 )<div class="info-box bg-red"> @else <div class="info-box bg-aqua"> @endif
                    <span class="info-box-icon">S11</span>
                    <div class="info-box-content">
                      <span class="info-box-text">{{ $s11 }} %</span>
                      <span class="info-box-number"> @if($s11 < $data1['lajuinflasi'] + 10)<b>Tidak Ideal</b>@else<b>Ideal</b>@endif </span>
                      <div class="progress">
                        <div class="progress-bar" style="width: {{$s11}}%"></div>
                      </div>
                          <span class="progress-description">
                             Signs of Growth ( &gt; 10% + Laju Inflasi )
                          </span>
                    </div>
                  </div>
                </div>  
              </div>
            </div>
        @endif
    </div>
</div> 


@section('js2')
    @include('admins._components.datatable_JS')
    <script type="text/javascript" src="{{ URL::asset('plugins/chartJS/Chart.bundle.js') }}"></script>
    @include('admins.laporancu._component.grafik_data')
    <script>
      window.onload = function() {
          var ctx = document.getElementById("chart").getContext("2d");
          window.chart = new Chart(ctx, config);
      };
    </script>
@stop