<?php 
$title="Dashboard";
$data = App\Models\LaporanCu::orderBy('periode','ASC')->groupBy('periode')->get(['periode']);
$periodeiode = $data->groupBy('periode');
$cu = Auth::user()->getCU();
$iduser = Auth::user()->getId();

if(Auth::user()->can('view.laporancu_view') && $cu == '0'){
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
    $data1 = array_last($infogerakans);
    $gvalue = array_column($dataarray,'aset'); 
}
if(Auth::user()->can('view.laporancu_view') && $cu != '0'){

    $datas = App\Models\LaporanCu::where('no_ba','=',$cu)->orderBy('periode','desc')->get();

    $dataarray = $datas->sortBy('periode')->toArray();
    $periode = array_column($dataarray,'periode');

    foreach ($periode as $a){
        $gperiode[] = date('F Y', strtotime($a));
    }
    $data1 = array_last($dataarray);
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
                    <?php 
                      if($cu == '0'){
                        $total_cuprimer = App\Models\Cuprimer::count();
                        $route = route('admins.cuprimer.index');
                      }else{
                        $route = route('admins.cuprimer.detail',array($cu));
                      }    
                    ?>
                    <div class="inner">
                        <a href="{{ $route }}" style="color:white">
                          @if($cu == '0') 
                            <h3>{{ $total_cuprimer }}</h3>
                            <p>CU</p>
                          @else
                            <h3>&nbsp</h3>
                            <p>Profil CU</p>
                          @endif
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
        <!-- tpcu -->
        @permission('view.cuprimer_view')
            <div class="col-xs-6 col-sm-3 col-md-2">
                <div class="small-box bg-aqua">
                    <?php 
                      if($cu == '0'){
                        $total_tp = App\Models\TpCU::count();
                        $route = route('admins.tpcu.index');
                      }else{
                        $total_tp = App\Models\TpCU::where('cu','=',$cu)->count(); 
                        $route = route('admins.tpcu.index_cu',array($cu));
                      }    
                    ?>
                    <div class="inner">
                        <a href="{{ $route }}" style="color:white">
                            <h3>{{ $total_tp }}</h3>
                            <p>TP CU</p>
                        </a>    
                    </div>
                    <div class="icon">
                        <a href="{{ $route }}" style="color: rgba(0, 0, 0, 0.15)"> 
                            <i class="fa fa-home"></i>
                        </a>    
                    </div>
                    <a href="{{ $route }}"
                       class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        @endpermission
        <!-- /tpcu -->
        <!-- laporancu -->
        @permission('view.laporancu_view|view.laporancudetail_view')
            <div class="col-xs-6 col-sm-3 col-md-2">
                <div class="small-box bg-green">
                    <?php
                        if($cu != 0)
                            $total_laporan = App\Models\LaporanCu::where('no_ba','=',$cu)->count(); 
                        else
                            $total_laporan = App\Models\LaporanCu::count(); 
                        if(Auth::user()->can('view.laporancu_view') && $cu == '0'){ 
                            $route = route('admins.laporancu.index');
                        }elseif(Auth::user()->can('view.laporancu_view') && $cu != '0'){
                            $route = route('admins.laporancu.index_cu',array($cu));
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
                <div class="small-box bg-yellow">
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
        @permission('view.admin_view|detail.admin_detail')
            <div class="col-xs-6 col-sm-3 col-md-2">
                <div class="small-box bg-aqua">
                    <?php 
                      if($cu == '0'){
                        $total_admin = App\Models\User::count(); 
                        $route = route('admins.admin.index');
                      }else{
                        $route = route('admins.admin.detail',array($iduser));
                      }
                    ?>
                    <div class="inner">
                        @permission('detail.admin_detail')
                            <a href="{{ route('admins.admin.detail',array($iduser)) }}"  style="color:white">
                        @else
                             <a href="#" data-toggle="modal" data-target="#modalcheckpass" style="color:white">
                        @endpermission
                          @if($cu == '0')
                            <h3>{{ $total_admin }}</h3>
                            <p>Admin</p>
                          @else
                            <h3>&nbsp</h3>
                            <p>Admin</p>
                          @endif  
                        </a>    
                    </div>
                    <div class="icon">
                        @permission('detail.admin_detail')
                            <a href="{{ route('admins.admin.detail',array($iduser)) }}" style="color: rgba(0, 0, 0, 0.15)">
                        @else
                            <a href="#" data-toggle="modal" data-target="#modalcheckpass" style="color: rgba(0, 0, 0, 0.15)">
                        @endpermission    
                            <i class="fa fa-user-circle-o"></i>
                        </a>
                    </div>
                    @permission('detail.admin_detail')
                        <a href="{{ route('admins.admin.detail',array($iduser)) }}" class="small-box-footer">
                    @else
                        <a href="#" data-toggle="modal" data-target="#modalcheckpass" class="small-box-footer">
                    @endpermission 
                       Lihat <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        @endpermission
        <!-- /admin -->
    </div>
    <!-- /Small boxes (Stat box) -->
    <!-- Main content -->
    <div class="row">
        @if(Auth::user()->can('view.laporanbkcu_view') || Auth::user()->can('view.laporancu_view'))
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
                          <h5 class="description-header" style="margin-top:.5em;"> {{ number_format($data1['l_biasa'],"0",",",".") }}</h5>
                        </div>
                        <hr style="padding: 0;margin:0;" />
                        <!-- /.description-block -->
                        <div class="description-block margin-bottom" style="margin-bottom: .5em;">
                          <span><i class="fa fa-female"></i> Perempuan</span>
                          <h5 class="description-header" style="margin-top:.5em;"> {{ number_format($data1['p_biasa'],"0",",",".") }}</h5>
                        </div>
                        <hr style="padding: 0;margin:0;" />
                        <!-- /.description-block -->
                        <div class="description-block margin-bottom" style="margin-bottom: .5em;">
                          <span><i class="fa fa-child"></i> Laki-laki Luar Biasa</span>
                          <h5 class="description-header" style="margin-top:.5em;"> {{ number_format($data1['l_lbiasa'],"0",",",".") }}</h5>
                        </div>
                        <hr style="padding: 0;margin:0;" />
                        <!-- /.description-block -->
                        <div class="description-block margin-bottom" style="margin-bottom: .5em;">
                          <span><i class="fa fa-child"></i> Perempuan Luar Biasa</span>
                          <h5 class="description-header" style="margin-top:.5em;"> {{ number_format($data1['p_lbiasa'],"0",",",".") }}</h5>
                        </div>
                        <hr style="padding: 0;margin:0;" />
                        <!-- /.description-block -->
                        <div class="description-block margin-bottom" style="margin-bottom: .5em;">
                          <span><i class="fa fa-male"></i><i class="fa fa-child"></i><i class="fa fa-female"></i> Total</span>
                          <?php $tot_anggota =  $data1['l_biasa'] + $data1['p_biasa'] + $data1['l_lbiasa'] + $data1['p_lbiasa'];  ?>
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
                            <h5 class="description-header">{{ number_format($data1['aktivalancar'],"0",",",".") }}</h5>
                            <span class="description-text">Aktiva Lancar</span>
                          </div>
                          <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-2 col-xs-6">
                          <div class="description-block border-right">
                            <h5 class="description-header">{{ number_format($data1['dcr'],"0",",",".") }}</h5>
                            <span class="description-text">DCR</span>
                          </div>
                          <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-2 col-xs-6">
                          <div class="description-block border-right">
                            <h5 class="description-header">{{ number_format($data1['dcu'],"0",",",".") }}</h5>
                            <span class="description-text">DCU</span>
                          </div>
                          <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-2 col-xs-6">
                          <div class="description-block border-right">
                            <h5 class="description-header">{{ number_format($data1['totalbiaya'],"0",",",".") }}</h5>
                            <span class="description-text">Biaya</span>
                          </div>
                          <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-2 col-xs-6">
                          <div class="description-block border-right">
                            <h5 class="description-header">{{ number_format($data1['totalpendapatan'],"0",",",".") }}</h5>
                            <span class="description-text">Pendapatan</span>
                          </div>
                          <!-- /.description-block -->
                        </div>
                        <!-- /.col -->  
                        <div class="col-sm-2 col-xs-6">
                          <div class="description-block">
                            <h5 class="description-header">{{ number_format($data1['shu'],"0",",",".") }}</h5>
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
                            <h5 class="description-header">{{ number_format($data1['piutangberedar'],"0",",",".") }}</h5>
                            <span class="description-text">Piutang Beredar</span>
                          </div>
                          <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-2 col-xs-6">
                          <div class="description-block border-right">
                            <?php  ?>
                            <h5 class="description-header">{{ number_format($data1['piutangberedar'] - ($data1['piutanglalai_1bulan'] + $data1['piutanglalai_12bulan']),"0",",",".") }}</h5>
                            <span class="description-text">Piutang Bersih</span>
                          </div>
                          <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-2 col-xs-6">
                          <div class="description-block border-right">
                            <h5 class="description-header">{{ number_format($data1['piutanglalai_1bulan'],"0",",",".") }}</h5>
                            <span class="description-text">Piutang Lalai 1-12 Bulan</span>
                          </div>
                          <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-2 col-xs-6">
                          <div class="description-block border-right">
                            <h5 class="description-header">{{ number_format($data1['piutanglalai_12bulan'],"0",",",".") }}</h5>
                            <span class="description-text">Piutang Lalai > 12 Bulan</span>
                          </div>
                          <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-2 col-xs-6">
                          <div class="description-block border-right">
                            <h5 class="description-header">{{ number_format($data1['simpanansaham'],"0",",",".") }}</h5>
                            <span class="description-text">Simpanan Saham</span>
                          </div>
                          <!-- /.description-block -->
                        </div>
                        <!-- /.col -->  
                        <div class="col-sm-2 col-xs-6">
                          <div class="description-block">
                            <h5 class="description-header">{{ number_format($data1['nonsaham_harian'] + $data1['nonsaham_unggulan'],"0",",",".") }}</h5>
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
        @if(Auth::user()->can('view.laporancu_view') && $cu != '0')
          <?php
            $tot_nonsaham = $data1['nonsaham_harian'] + $data1['nonsaham_unggulan'];

            $p1 = $data1['piutanglalai_12bulan'] != 0 ? $data1['dcr']/$data1['piutanglalai_12bulan'] : $data1['dcr']/ 0.01;
            $p2 = $data1['piutanglalai_1bulan'] != 0 ? ($data1['dcr'] - $data1['piutanglalai_12bulan'])/$data1['piutanglalai_1bulan'] : ($data1['dcr'] - $data1['piutanglalai_12bulan'])/ 0.01 ;
            if($p1 == 1 && $p2 > 0.35){
                $e1 = $data1['aset'] != 0 ? ($data1['piutanganggota'] - (($data1['piutanglalai_12bulan']) + ((35/100) * $data1['piutanglalai_1bulan']))) / $data1['aset'] : ($data1['piutanganggota'] - (($data1['piutanglalai_12bulan']) + ((35/100) * $data1['piutanglalai_1bulan']))) / 0.01;
            }else{
                $e1 = $data1['aset'] != 0 ? ($data1['piutangberedar'] - $data1['dcr']) / $data1['aset'] : ($data1['piutangberedar'] - $data1['dcr']) / 0.01;
            }
            $e5 = $data1['aset'] != 0 ? ($data1['nonsaham_unggulan'] + $data1['nonsaham_harian']) / $data1['aset'] : ($data1['nonsaham_unggulan'] + $data1['nonsaham_harian']) / 0.01;
            $e6 = $data1['aset'] != 0 ? $data1['totalhutang_pihak3'] / $data1['aset'] : $data1['totalhutang_pihak3'] / 0.01;
            $e9 = $data1['aset'] != 0 ? (($data1['dcr'] + $data1['dcu'] + $data1['iuran_gedung'] + $data1['donasi'] + $data1['shu_lalu']) - ($data1['piutanglalai_12bulan'] + ((35/100) * $data1['piutanglalai_1bulan']) + $data1['aset_masalah'])) / $data1['aset'] : (($data1['dcr'] + $data1['dcu'] + $data1['iuran_gedung'] + $data1['donasi'] + $data1['shu_lalu']) - ($data1['piutanglalai_12bulan'] + ((35/100) * $data1['piutanglalai_1bulan']) + $data1['aset_masalah'])) / 0.01;
            $a1 = $data1['piutangberedar'] != 0 ? ($data1['piutanglalai_1bulan'] + $data1['piutanglalai_12bulan']) / $data1['piutangberedar'] : ($data1['piutanglalai_1bulan'] + $data1['piutanglalai_12bulan']) / 0.01; 
            $a2 = $data1['aset'] != 0 ? $data1['aset_tidak_menghasilkan'] / $data1['aset'] : $data1['aset_tidak_menghasilkan'] / 0.01;
            $r7 = $data1['ratasaham'] != 0 ? $data1['bjs_saham'] / $data1['ratasaham'] : $data1['bjs_saham'] / 0.01;
            $r9 = $data1['rataaset'] != 0 ? $data1['beban_operasional'] / $data1['rataaset'] : $data1['beban_operasional'] / 0.01;
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
            $l1 = $l1 > 1 ? 1 : $l1;
            $s10 = $s10 > 1 ? 1 : $s10;
            $s11 = $s11 > 1 ? 1 : $s11;

            $p1 = number_format($p1*100,0);
            $p2 = number_format($p2*100,0);
            $e1 = number_format($e1*100,0);
            $e5 = number_format($e5*100,0);
            $e6 = number_format($e6*100,0);
            $e9 = number_format($e9*100,0);
            $a1 = number_format($a1*100,0);
            $a2 = number_format($a2*100,0);
            $r7 = number_format($r7*100,0);
            $r9 = number_format($r9*100,0);
            $l1 = number_format($l1*100,0);
            $s10 = number_format($s10*100,0);
            $s11 = number_format($s11*100,0);
          ?>
          <div class="col-md-3 col-sm-6 col-xs-12">
            @if($p1 < 100)<div class="info-box bg-red"> @else <div class="info-box bg-aqua"> @endif
              <span class="info-box-icon">P1</span>
              <div class="info-box-content">
                <span class="info-box-text">&nbsp</span>
                <span class="info-box-number">{{ $p1 }} % [@if($p1 < 100)<b>Tidak Ideal</b>@else<b>Ideal</b>@endif]</span>
                <div class="progress">
                  <div class="progress-bar" style="width: {{$p1}}%"></div>
                </div>
                    <span class="progress-description">
                      Protection
                    </span>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-6 col-xs-12">
            @if($p2 < 35)<div class="info-box bg-red"> @else <div class="info-box bg-aqua"> @endif
              <span class="info-box-icon">P2</span>
              <div class="info-box-content">
                <span class="info-box-text">&nbsp</span>
                <span class="info-box-number">{{ $p2 }} % [@if($p2 < 35)<b>Tidak Ideal</b>@else<b>Ideal</b>@endif]</span>
                <div class="progress">
                  <div class="progress-bar" style="width: {{$p2}}%"></div>
                </div>
                    <span class="progress-description">
                      Protection
                    </span>
              </div>
            </div>
          </div> 
          <div class="col-md-3 col-sm-6 col-xs-12">
            @if($e1 < 70 || $e1 > 80)<div class="info-box bg-red"> @else <div class="info-box bg-aqua"> @endif
              <span class="info-box-icon">E1</span>
              <div class="info-box-content">
                <span class="info-box-text">&nbsp</span>
                <span class="info-box-number">{{ $e1 }} % [ @if($e1 < 70 || $e1 > 80)<b>Tidak Ideal</b>@else<b>Ideal</b>@endif ]</span>
                <div class="progress">
                  <div class="progress-bar" style="width: {{$e1}}%"></div>
                </div>
                    <span class="progress-description">
                      Effective Financial
                    </span>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-6 col-xs-12">
            @if($e5 < 70 || $e5 > 80)<div class="info-box bg-red"> @else <div class="info-box bg-aqua"> @endif
              <span class="info-box-icon">E5</span>
              <div class="info-box-content">
                <span class="info-box-text">&nbsp</span>
                <span class="info-box-number">{{ $e5 }} % [ @if($e5 < 70 || $e5 > 80)<b>Tidak Ideal</b>@else<b>Ideal</b>@endif ]</span>
                <div class="progress">
                  <div class="progress-bar" style="width: {{$e5}}%"></div>
                </div>
                    <span class="progress-description">
                       Effective Financial
                    </span>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-6 col-xs-12">
            @if($e6 > 5 )<div class="info-box bg-red"> @else <div class="info-box bg-aqua"> @endif
              <span class="info-box-icon">E6</span>
              <div class="info-box-content">
                <span class="info-box-text">&nbsp</span>
                <span class="info-box-number">{{ $e6 }} % [ @if($e6 > 5)<b>Tidak Ideal</b>@else<b>Ideal</b>@endif ]</span>
                <div class="progress">
                  <div class="progress-bar" style="width: {{$e6}}%"></div>
                </div>
                    <span class="progress-description">
                      Effective Financial
                    </span>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-6 col-xs-12">
            @if($e9 < 10 )<div class="info-box bg-red"> @else <div class="info-box bg-aqua"> @endif
              <span class="info-box-icon">E9</span>
              <div class="info-box-content">
                <span class="info-box-text">&nbsp</span>
                <span class="info-box-number">{{ $e9 }} % [ @if($e9 < 10)<b>Tidak Ideal</b>@else<b>Ideal</b>@endif ]</span>
                <div class="progress">
                  <div class="progress-bar" style="width: {{$e9}}%"></div>
                </div>
                    <span class="progress-description">
                       Effective Financial
                    </span>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-6 col-xs-12">
            @if($a1 > 10 )<div class="info-box bg-red"> @else <div class="info-box bg-aqua"> @endif
              <span class="info-box-icon">A1</span>
              <div class="info-box-content">
                <span class="info-box-text">&nbsp</span>
                <span class="info-box-number">{{ $a1 }} % [ @if($a1 > 5)<b>Tidak Ideal</b>@else<b>Ideal</b>@endif ]</span>
                <div class="progress">
                  <div class="progress-bar" style="width: {{$a1}}%"></div>
                </div>
                    <span class="progress-description">
                       Asset Quality
                    </span>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-6 col-xs-12">
            @if($a2 > 10 )<div class="info-box bg-red"> @else <div class="info-box bg-aqua"> @endif
              <span class="info-box-icon">A2</span>
              <div class="info-box-content">
                <span class="info-box-text">&nbsp</span>
                <span class="info-box-number">{{ $a2 }} % [ @if($a2 > 5)<b>Tidak Ideal</b>@else<b>Ideal</b>@endif ]</span>
                <div class="progress">
                  <div class="progress-bar" style="width: {{$a2}}%"></div>
                </div>
                    <span class="progress-description">
                      Asset Quality
                    </span>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-6 col-xs-12">
            @if($r7 != $data1['hargapasar'])<div class="info-box bg-red"> @else <div class="info-box bg-aqua"> @endif
              <span class="info-box-icon">R7</span>
              <div class="info-box-content">
                <span class="info-box-text">&nbsp</span>
                <span class="info-box-number">{{ $r7 }} % [ @if($r7 != $data1['hargapasar'])<b>Tidak Ideal</b>@else<b>Ideal</b>@endif ]</span>
                <div class="progress">
                  <div class="progress-bar" style="width: {{$r7}}%"></div>
                </div>
                    <span class="progress-description">
                      Rates of Return
                    </span>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-6 col-xs-12">
            @if($r9 != 5 )<div class="info-box bg-red"> @else <div class="info-box bg-aqua"> @endif
              <span class="info-box-icon">R9</span>
              <div class="info-box-content">
                <span class="info-box-text">&nbsp</span>
                <span class="info-box-number">{{ $r9 }} % [ @if($r9 != 5)<b>Tidak Ideal</b>@else<b>Ideal</b>@endif ]</span>
                <div class="progress">
                  <div class="progress-bar" style="width: {{$r9}}%"></div>
                </div>
                    <span class="progress-description">
                      Rates of Return
                    </span>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-6 col-xs-12">
            @if($l1 < 15 || $l1 > 20 )<div class="info-box bg-red"> @else <div class="info-box bg-aqua"> @endif
              <span class="info-box-icon">L1</span>
              <div class="info-box-content">
                <span class="info-box-text">&nbsp</span>
                <span class="info-box-number">{{ $l1 }} % [ @if($l1 > 5)<b>Tidak Ideal</b>@else<b>Ideal</b>@endif ]</span>
                <div class="progress">
                  <div class="progress-bar" style="width: {{$l1}}%"></div>
                </div>
                    <span class="progress-description">
                      Liquidity
                    </span>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-6 col-xs-12">
            @if($s10 < 12 )<div class="info-box bg-red"> @else <div class="info-box bg-aqua"> @endif
              <span class="info-box-icon">S10</span>
              <div class="info-box-content">
                <span class="info-box-text">&nbsp</span>
                <span class="info-box-number">{{ $s10 }} % [ @if($s10 < 12)<b>Tidak Ideal</b>@else<b>Ideal</b>@endif ]</span>
                <div class="progress">
                  <div class="progress-bar" style="width: {{$s10}}%"></div>
                </div>
                    <span class="progress-description">
                       Signs of Growth
                    </span>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-6 col-xs-12">
            @if($s11 < $data1['lajuinflasi'] + 10 )<div class="info-box bg-red"> @else <div class="info-box bg-aqua"> @endif
              <span class="info-box-icon">S11</span>
              <div class="info-box-content">
                <span class="info-box-text">&nbsp</span>
                <span class="info-box-number">{{ $s11 }} % [ @if($s11 < $data1['lajuinflasi'] + 10)<b>Tidak Ideal</b>@else<b>Ideal</b>@endif ]</span>
                <div class="progress">
                  <div class="progress-bar" style="width: {{$s11}}%"></div>
                </div>
                    <span class="progress-description">
                       Signs of Growth
                    </span>
              </div>
            </div>
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
    @if(Auth::user()->can('view.laporancu_view'))
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
    @endif
@stop