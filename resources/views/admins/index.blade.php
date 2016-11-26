<?php 
$title="Dashboard";
$data = App\Models\LaporanCu::orderBy('periode','ASC')->groupBy('periode')->get(['periode']);
$periodeiode = $data->groupBy('periode');
$cu = Auth::user()->getCU();

if(Auth::user()->can('view.laporanbkcu_view') && $cu == '0'){
    $periodeiode1 = collect([]);
    foreach ($periodeiode as $data){
        $periodeiode1->push($data->first());
    }

    $periodes = array_column($periodeiode1->toArray(),'periode');

    foreach ($periodes as $periode) {
        $datacu = App\Models\LaporanCu::where('periode','<=',$periode)->orderBy('periode','DESC')->get();
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
    $dataarrayfirst = array_last($infogerakans);
    $gvalue = array_column($dataarray,'aset');
}elseif(Auth::user()->can('view.laporancudetail_view') && $cu != '0'){
    $cuprimer = App\Models\Cuprimer::where('id','=',$cu)->select('no_ba')->first();
    $no_ba = $cuprimer->no_ba;

    $datas = App\Models\LaporanCu::where('no_ba','=',$no_ba)->orderBy('periode','desc')->get();

    $dataarray = $datas->sortBy('periode')->toArray();
    $periode = array_column($dataarray,'periode');

    foreach ($periode as $a){
        $gperiode[] = date('F Y', strtotime($a));
    }
    $dataarrayfirst = array_last($dataarray);
    $gvalue = array_column($dataarray,'aset');
}   
?>
@extends('admins._layouts.layout')

@section('css')
    @include('admins._components.datatable_CSS')
@stop

@section('content')
<section class="content-header">
    <h1>
        <i class="fa fa-dashboard"></i> <b>Dashboard</b>
        <small>Panel Informasi</small>
    </h1>
    <ol class="breadcrumb">
        <li class="active"><i class="fa fa-dashboard"></i> Dashboard</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Alert -->
    @include('admins._layouts.alert')
    <!-- Alert -->
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <!-- pengumuman -->
        @permission('view.pengumuman_view')
            <div class="col-xs-6 col-sm-3 col-md-2">
                <div class="small-box bg-aqua">
                    <?php $total_pengumuman = App\Models\Pengumuman::count(); $route = route('admins.pengumuman.index'); ?>
                    <div class="inner">
                        <a href="{{ $route }}" style="color:white"> 
                            <h3>{{ $total_pengumuman }}</h3>
                            <p>Pengumuman</p>
                        </a>
                    </div>
                    <div class="icon">
                       <a href="{{ $route }}" style="color: rgba(0, 0, 0, 0.15)"> 
                            <i class="fa fa-comments-o"></i>
                       </a>
                    </div>
                    <a href="{{ $route }}"
                       class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        @endpermission
        <!-- /pengumuman -->
        <!-- saran -->
        @permission('view.saran_view')
            <div class="col-xs-6 col-sm-3 col-md-2">
                <div class="small-box bg-yellow">
                    <?php $total_saran = App\Models\Saran::count(); $route = route('admins.saran.index');?>
                    <div class="inner">
                         <a href="{{ $route }}" style="color:white"> 
                            <h3>{{ $total_saran }}</h3>
                            <p>Saran & Kritik</p>
                        </a>    
                    </div>
                    <div class="icon">
                        <a href="{{ $route }}" style="color: rgba(0, 0, 0, 0.15)"> 
                            <i class="fa fa-paper-plane-o"></i>
                        </a>
                    </div>
                     <a href="{{ $route }}"
                       class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        @endpermission
        <!-- /saran -->
        <!-- artikel -->
        @permission('view.artikel_view')
            <div class="col-xs-6 col-sm-3 col-md-2">
                <div class="small-box bg-green">
                    <?php $total_artikel = App\Models\Artikel::count(); $route = route('admins.artikel.index');?>
                    <div class="inner">
                        <a href="{{ $route }}" style="color:white"> 
                            <h3>{{ $total_artikel }}</h3>
                            <p>Artikel</p>
                        </a>    
                    </div>
                    <div class="icon">
                        <a href="{{ $route }}" style="color: rgba(0, 0, 0, 0.15)"> 
                            <i class="fa fa-book"></i>
                        </a>    
                    </div>
                    <a href="{{ $route }}"
                       class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        @endpermission
        <!-- /artikel -->
        <!-- kegiatan -->
        @permission('view.kegiatan_view')
            <div class="col-xs-6 col-sm-3 col-md-2">
                <div class="small-box bg-red">
                    <?php $total_kegiatan = App\Models\Kegiatan::count();$route = route('admins.kegiatan.index'); ?>
                    <div class="inner">
                        <a href="{{ $route }}" style="color:white"> 
                            <h3>{{ $total_kegiatan }}</h3>
                            <p>Kegiatan</p>
                        </a>
                    </div>
                    <div class="icon">
                        <a href="{{ $route }}" style="color: rgba(0, 0, 0, 0.15)"> 
                            <i class="fa fa-suitcase"></i>  
                        </a>
                    </div>
                    <a href="{{ $route }}"
                       class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        @endpermission
        <!-- /kegiatan -->
        <!-- cuprimer -->
        @permission('view.cuprimer_view')
            <div class="col-xs-6 col-sm-3 col-md-2">
                <div class="small-box bg-yellow">
                    <?php $total_cuprimer = App\Models\Cuprimer::count();$route = route('admins.cuprimer.index');  ?>
                    <div class="inner">
                        <a href="{{ $route }}" style="color:white"> 
                            <h3>{{ $total_cuprimer }}</h3>
                            <p>CU</p>
                        </a>    
                    </div>
                    <div class="icon">
                        <a href="{{ $route }}" style="color: rgba(0, 0, 0, 0.15)"> 
                            <i class="fa fa-building"></i>
                        </a>    
                    </div>
                    <a href="{{ $route }}"
                       class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        @endpermission
        <!-- /cuprimer -->
        <!-- laporancu -->
        @permission('view.laporancu_view|view.laporancudetail_view')
            <div class="col-xs-6 col-sm-3 col-md-2">
                <div class="small-box bg-green">
                    <?php
                        if($cu != 0)
                            $total_laporan = App\Models\LaporanCu::where('no_ba','=',$no_ba)->count(); 
                        else
                            $total_laporan = App\Models\LaporanCu::count(); 

                        if(Auth::user()->can('view.laporancu_view') && $cu == '0'){ 
                            $route = route('admins.laporancu.index');
                        }elseif(Auth::user()->can('view.laporancudetail_view') && $cu != '0'){
                            $cuprimer = App\Models\Cuprimer::where('id','=',$cu)->select('no_ba')->first();
                            $no_ba = $cuprimer->no_ba;
                            $route = route('admins.laporancu.index_cu',array($no_ba));
                        }
                        ?>
                    <div class="inner">
                         <a href="{{ $route }}" style="color:white">
                            <h3>{{ $total_laporan }}</h3>
                            <p>Laporan CU</p>
                        </a>
                    </div>
                    <div class="icon">
                        <a href="{{ $route }}" style="color: rgba(0, 0, 0, 0.15)"> 
                            <i class="fa fa-line-chart"></i>
                        </a>
                    </div>   
                        <a href="{{ $route }}"
                           class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a> 
                </div>
            </div>
        @endpermission
        <!-- /laporancu -->
        <!-- staf -->
        @permission('view.staf_view')
            <div class="col-xs-6 col-sm-3 col-md-2">
                <div class="small-box bg-red">
                    <?php 
                        if($cu != 0)
                            $total_staff = App\Models\Staf::with('cuprimer')->where('cu','=',$cu)->count(); 
                        else
                            $total_staff = App\Models\Staf::count(); 
                        
                        $route = route('admins.staf.index');
                        ?>
                    <div class="inner">
                        <a href="{{ $route }}" style="color:white"> 
                            <h3>{{ $total_staff }}</h3>
                            <p>Staf</p>
                        </a>   
                    </div>
                    <div class="icon">
                        <a href="{{ $route }}" style="color: rgba(0, 0, 0, 0.15)">
                            <i class="fa fa-sitemap"></i>
                        </a>
                    </div>
                    <a href="{{ $route }}"
                       class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        @endpermission
        <!-- /staf -->
        <!-- download -->
        @permission('view.download_view')
            <div class="col-xs-6 col-sm-3 col-md-2">
                <div class="small-box bg-green">
                    <?php $total_download = App\Models\Download::count(); $route = route('admins.download.index');?>
                    <div class="inner">
                        <a href="{{ $route }}" style="color:white"> 
                            <h3>{{ $total_download }}</h3>
                            <p>Download</p>
                        </a>
                    </div>
                    <div class="icon">
                        <a href="{{ $route }}" style="color: rgba(0, 0, 0, 0.15)">
                            <i class="fa fa-download"></i>
                        </a>    
                    </div>
                    <a href="{{ $route }}"
                       class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        @endpermission
        <!-- /download -->
        <!-- admin -->
        @permission('view.admin_view')
            <div class="col-xs-6 col-sm-3 col-md-2">
                <div class="small-box bg-aqua">
                    <?php $total_admin = App\Models\User::count(); $route = route('admins.admin.index'); ?>
                    <div class="inner">
                        <a href="{{ $route }}" style="color:white">
                            <h3>{{ $total_admin }}</h3>
                            <p>Admin</p>
                        </a>    
                    </div>
                    <div class="icon">
                        <a href="{{ $route }}" style="color: rgba(0, 0, 0, 0.15)">
                            <i class="fa fa-user-circle-o"></i>
                        </a>
                    </div>
                    <a href="{{ route('admins.admin.index') }}"
                       class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        @endpermission
        <!-- /admin -->
    </div>
    <!-- /Small boxes (Stat box) -->
    <!-- Main content -->
    <div class="row">
        @if(Auth::user()->can('view.laporanbkcu_view') || Auth::user()->can('view.laporancudetail_view'))
            <div class="col-md-12">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title"> Perkembangan CU</h3>
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-10">
                      <p class="text-center">
                        <strong>ASET</strong>
                      </p>

                      <div class="chart">
                        <!-- Sales Chart Canvas -->
                        <canvas id="chart" height="100em"></canvas>
                        <br/>
                      </div>
                      <!-- /.chart-responsive -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-2">
                      <p class="text-center">
                        <strong>ANGGOTA</strong>
                      </p>
                      <div class="pad box-pane-right bg-aqua" style="min-height: 280px">
                        <div class="description-block margin-bottom" style="margin-bottom: .5em;">
                          <span><i class="fa fa-male"></i> Laki-laki</span>
                          <h5 class="description-header" style="margin-top:.5em;"> {{ number_format($dataarrayfirst['l_biasa'],"0",",",".") }}</h5>
                        </div>
                        <hr style="padding: 0;margin:0;" />
                        <!-- /.description-block -->
                        <div class="description-block margin-bottom" style="margin-bottom: .5em;">
                          <span><i class="fa fa-female"></i> Perempuan</span>
                          <h5 class="description-header" style="margin-top:.5em;"> {{ number_format($dataarrayfirst['p_biasa'],"0",",",".") }}</h5>
                        </div>
                        <hr style="padding: 0;margin:0;" />
                        <!-- /.description-block -->
                        <div class="description-block margin-bottom" style="margin-bottom: .5em;">
                          <span><i class="fa fa-child"></i> Laki-laki Luar Biasa</span>
                          <h5 class="description-header" style="margin-top:.5em;"> {{ number_format($dataarrayfirst['l_lbiasa'],"0",",",".") }}</h5>
                        </div>
                        <hr style="padding: 0;margin:0;" />
                        <!-- /.description-block -->
                        <div class="description-block margin-bottom" style="margin-bottom: .5em;">
                          <span><i class="fa fa-child"></i> Perempuan Luar Biasa</span>
                          <h5 class="description-header" style="margin-top:.5em;"> {{ number_format($dataarrayfirst['p_lbiasa'],"0",",",".") }}</h5>
                        </div>
                        <hr style="padding: 0;margin:0;" />
                        <!-- /.description-block -->
                        <div class="description-block margin-bottom" style="margin-bottom: .5em;">
                          <span><i class="fa fa-male"></i><i class="fa fa-child"></i><i class="fa fa-female"></i> Total</span>
                          <?php $tot_anggota =  $dataarrayfirst['l_biasa'] + $dataarrayfirst['p_biasa'] + $dataarrayfirst['l_lbiasa'] + $dataarrayfirst['p_lbiasa'];?>
                          <h5 class="description-header" style="margin-top:.5em;"> {{ number_format($tot_anggota,"0",",",".") }}</h5>
                        </div>
                        <!-- /.description-block -->
                      </div>
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
                </div>
                <!-- ./box-body -->
                <div class="box-footer">
                    <div class="row">
                        <div class="col-sm-2 col-xs-6">
                          <div class="description-block border-right">
                            <h5 class="description-header">{{ number_format($dataarrayfirst['aktivalancar'],"0",",",".") }}</h5>
                            <span class="description-text">Aktiva Lancar</span>
                          </div>
                          <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-2 col-xs-6">
                          <div class="description-block border-right">
                            <h5 class="description-header">{{ number_format($dataarrayfirst['dcr'],"0",",",".") }}</h5>
                            <span class="description-text">DCR</span>
                          </div>
                          <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-2 col-xs-6">
                          <div class="description-block border-right">
                            <h5 class="description-header">{{ number_format($dataarrayfirst['dcu'],"0",",",".") }}</h5>
                            <span class="description-text">DCU</span>
                          </div>
                          <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-2 col-xs-6">
                          <div class="description-block border-right">
                            <h5 class="description-header">{{ number_format($dataarrayfirst['totalbiaya'],"0",",",".") }}</h5>
                            <span class="description-text">Biaya</span>
                          </div>
                          <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-2 col-xs-6">
                          <div class="description-block border-right">
                            <h5 class="description-header">{{ number_format($dataarrayfirst['totalpendapatan'],"0",",",".") }}</h5>
                            <span class="description-text">Pendapatan</span>
                          </div>
                          <!-- /.description-block -->
                        </div>
                        <!-- /.col -->  
                        <div class="col-sm-2 col-xs-6">
                          <div class="description-block">
                            <h5 class="description-header">{{ number_format($dataarrayfirst['shu'],"0",",",".") }}</h5>
                            <span class="description-text">SHU</span>
                          </div>
                          <!-- /.description-block -->
                        </div>
                    </div>
                  <div class="row">
                      <div class="col-sm-12"><hr/></div>
                  </div>
                    <div class="row">
                        <div class="col-sm-2 col-xs-6">
                          <div class="description-block border-right">
                            <h5 class="description-header">{{ number_format($dataarrayfirst['piutangberedar'],"0",",",".") }}</h5>
                            <span class="description-text">Piutang Beredar</span>
                          </div>
                          <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-2 col-xs-6">
                          <div class="description-block border-right">
                            <?php  ?>
                            <h5 class="description-header">{{ number_format($dataarrayfirst['piutangberedar'] - ($dataarrayfirst['piutanglalai_1bulan'] + $dataarrayfirst['piutanglalai_12bulan']),"0",",",".") }}</h5>
                            <span class="description-text">Piutang Bersih</span>
                          </div>
                          <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-2 col-xs-6">
                          <div class="description-block border-right">
                            <h5 class="description-header">{{ number_format($dataarrayfirst['piutanglalai_1bulan'],"0",",",".") }}</h5>
                            <span class="description-text">Piutang Lalai 1-12 Bulan</span>
                          </div>
                          <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-2 col-xs-6">
                          <div class="description-block border-right">
                            <h5 class="description-header">{{ number_format($dataarrayfirst['piutanglalai_12bulan'],"0",",",".") }}</h5>
                            <span class="description-text">Piutang Lalai > 12 Bulan</span>
                          </div>
                          <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-2 col-xs-6">
                          <div class="description-block border-right">
                            <h5 class="description-header">{{ number_format($dataarrayfirst['simpanansaham'],"0",",",".") }}</h5>
                            <span class="description-text">Simpanan Saham</span>
                          </div>
                          <!-- /.description-block -->
                        </div>
                        <!-- /.col -->  
                        <div class="col-sm-2 col-xs-6">
                          <div class="description-block">
                            <h5 class="description-header">{{ number_format($dataarrayfirst['nonsaham_harian'] + $dataarrayfirst['nonsaham_unggulan'],"0",",",".") }}</h5>
                            <span class="description-text">Simpanan Non Saham</span>
                          </div>
                          <!-- /.description-block -->
                        </div>
                    </div>
                  <!-- /.row -->
                </div>
                <!-- /.box-footer -->
              </div>
              <!-- /.box -->
            </div>
        @endif

        <div class="col-lg-5">
            @permission('view.statistikweb_view')
            <!--statistik website-->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Statistik Pengunjung Website</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <?php
                    $tabel = "stat_pengunjung";
                    $tanggal = date("Ymd");
                    $pengunjung = DB::table($tabel)
                            ->where('tanggal',$tanggal)
                            ->groupBy('ip')
                            ->count();
                    $totalpengunjung = DB::table($tabel)
                            ->count();
                    $bataswaktu       = time() - 300;
                    $pengunjungonline = DB::table($tabel)
                            ->where('online','>',$bataswaktu)
                            ->count();
                    $tanggal_hariini  = date('d-m-Y');
                    ?>
                    <h4 style="text-align: center;" ><b>Pengunjung Hari Ini</b></h4>
                    <h4 style="text-align: center;" >{{ Date::now()->format('l , j F Y ')}}</h4>
                    <h3 style="text-align: center;" ><b>{{$pengunjung}}</b> orang</h3>
                    <hr />
                    <dl class="dl-horizontal">
                        <dt><b style="font-size: 13px" >Total Pengunjung : </b></dt>
                        <dd><b style="font-size: 13px" >{{$totalpengunjung}} orang</b></dd>
                        <dt><b style="font-size: 13px" >Pengunjung Online : </b></dt>
                        <dd><b style="font-size: 13px" >{{$pengunjungonline}} orang</b></dd>
                        <dt><b style="font-size: 13px" >Reset : </b></dt>
                        <dd><b style="font-size: 13px" > 5 September 2014 </b></dd>
                    </dl>
                </div>
                <div class="box-footer clearfix">
                    <a href="{{ route('statistik') }}" class="btn btn-primary btn-block">
                        <div>
                            <span class="pull-left"><b>Detail</b></span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <!--/statistik website-->
            @endpermission
        </div>
        <div class="col-lg-7">
            @permission('view.saran_view')
            <!-- saran -->
            <div class="box box-primary ">
                <div class="box-header with-border">
                    <h3 class="box-title">Saran Atau Kritik</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <?php $sarans = App\Models\Saran::orderBy('created_at','desc')->take(10)->get(); ?>
                    <table class="table table-hover" id="dataTables-saran" width="100%">
                        <thead class="bg-light-blue-active color-palette">
                            <tr >
                                <th hidden></th>
                                <th>Nama </th>
                                <th>Saran dan Kritik</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sarans as $data)
                                <tr>
                                    <td hidden></td>
                                    @if(!empty($data->name))
                                        <td class="warptext">{{ $data->name }}</td>
                                    @else
                                        <td>-</td>
                                    @endif
                                    @if(!empty($data->content))
                                        <td class="warptext">{{{ $data->content }}}</td>
                                    @else
                                        <td>-</td>
                                    @endif

                                    @if(!empty($data->created_at ))
                                        <?php $date = new Date($data->created_at); ?>
                                        <td><i hidden="true">{{$data->created_at}}</i> {{  $date->format('d/n/Y') }}</td>
                                    @else
                                        <td>-</td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                    <a href="{{ route('admins.saran.index') }}" class="btn btn-primary btn-block">
                        <div>
                            <span class="pull-left"><b>Detail</b></span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
                <!-- /saran -->
            </div>
            <!-- /saran -->
            @endpermission
        </div>
    </div>    
</section>

@stop

@section('js')
    @include('admins._components.datatable_JS')
    <script type="text/javascript" src="{{ URL::asset('plugins/chartJS/Chart.bundle.js') }}"></script>
    <script type="text/javascript">
        var table = $('#dataTables-saran').DataTable({
            dom: 't',
            select: true,
            scrollY: '40vh',
            scrollX: true,
            autoWidth: true,
            scrollCollapse : true,
            paging : false,
            stateSave : false,
            order : [],
            buttons: [],
            language: {
                buttons : {},
                select:{
                    rows:{
                        _: "",
                        0: "",
                        1: ""
                    }
                },
                "sProcessing":   "Sedang proses...",
                "sLengthMenu":   "Tampilan _MENU_ entri",
                "sZeroRecords":  "Tidak ditemukan data yang sesuai",
                "sInfo":         "Tampilan _START_ sampai _END_ dari _TOTAL_ entri",
                "sInfoEmpty":    "Tampilan 0 hingga 0 dari 0 entri",
                "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
                "sInfoPostFix":  "",
            },
            fnInitComplete:function(){
                $('.dataTables_scrollBody').perfectScrollbar();
            },
            fnDrawCallback: function( oSettings ) {
                $('.dataTables_scrollBody').perfectScrollbar('destroy').perfectScrollbar();
            }
        });

        table.on( 'order.dt search.dt', function () {
            table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell.innerHTML = i+1;
            } );
        } ).draw();
    </script>
    <script>
    var randomColorFactor = function() {
        return Math.round(Math.random() * 255);
    };
    var randomColor = function(opacity) {
        return 'rgba(' + randomColorFactor() + ',' + randomColorFactor() + ',' + randomColorFactor() + ',' + (opacity || '.3') + ')';
    };
    var data = {
        labels: {!! json_encode($gperiode,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Aset",
                data: {!! json_encode($gvalue,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var config = {
        type: 'line',
        data: data,
        options:{
            responsive: true,
            legend: {
                position: 'false'
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true,
                        callback: function(value, index, values) {
                            if(parseInt(value) > 1000){
                                return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                            } else {
                                return value;
                            }
                        }
                    }
                }]
            },
            tooltips: {
                callbacks: {
                    label: function(tooltipItem, data) {
                        return Number(tooltipItem.yLabel).toFixed(0).replace(/./g, function(c, i, a) {
                            return i > 0 && c !== "," && (a.length - i) % 3 === 0 ? "." + c : c;
                        });
                    }
                }
            }
        },
    };
    $.each(config.data.datasets, function(i, dataset) {
        dataset.borderColor = "#9fe3f4";
        dataset.backgroundColor = "#00c0ef";
        dataset.pointBorderColor = "#0483a2";
        dataset.pointBackgroundColor = "#fff";
        dataset.pointBorderWidth = 1;
        dataset.pointHoverBackgroundColor = "#00c0ef";
        dataset.pointHoverBorderColor = "#0483a2";
        dataset.pointHoverBorderWidth = 2;
        dataset.pointRadius = 5;
        dataset.pointHitRadios = 10;
    });
    window.onload = function() {
        var ctx = document.getElementById("chart").getContext("2d");
        window.chart = new Chart(ctx, config);
    };
</script>
@stop