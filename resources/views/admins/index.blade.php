<?php
$title="Dashboard";
$data = App\LaporanCu::orderBy('periode','ASC')->groupBy('periode')->get(['periode']);
$periodeiode = $data->groupBy('periode');
$cu = Auth::user()->getCU();
$iduser = Auth::user()->getId();
$date = Date::now()->format('d-m');
$query = "SELECT  id,name FROM cuprimer WHERE DATE_FORMAT(ultah, '%d-%m') = '$date' ";
$ultahcu = DB::select(DB::raw($query));


?>
@extends('admins._layouts.layout')

@permission('view.saran_view')
@section('css')
    @include('admins._components.datatable_CSS')
@stop
@endpermission

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
    <!-- birthday -->
    @if(!empty($ultahcu))
        <div class="alert alert-info alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-birthday-cake"></i> Selamat ulang tahun kepada
                @foreach($ultahcu as $ultah)
                    {{ 'CU ' . $ultah->name}}
                @endforeach
            </h4>
        </div>
    @endif
    <!-- birthday -->
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <!-- pengumuman -->
        @permission('view.pengumuman_view')
            <div class="col-xs-6 col-sm-3 col-md-2">
                <div class="small-box bg-aqua">
                    <?php $route = route('admins.pengumuman.index'); ?>
                    <div class="inner">
                        <a href="{{ $route }}" style="color:white">
                            <h3>&nbsp;</h3>
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
                    <?php $route = route('admins.artikel.index');?>
                    <div class="inner">
                        <a href="{{ $route }}" style="color:white">
                            <h3>&nbsp;</h3>
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
                    <?php $route = route('admins.kegiatan.index'); ?>
                    <div class="inner">
                        <a href="{{ $route }}" style="color:white">
                            <h3>&nbsp;</h3>
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
                        $route = route('admins.cuprimer.index');
                      }else{
                        $route = route('admins.cuprimer.detail',array($cu));
                      }
                    ?>
                    <div class="inner">
                        <a href="{{ $route }}" style="color:white">
                          @if($cu == '0')
                            <h3>&nbsp;</h3>
                            <p>CU</p>
                          @else
                            <h3>&nbsp;</h3>
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
                        $route = route('admins.tpcu.index');
                      }else{
                        $route = route('admins.tpcu.index_cu',array($cu));
                      }
                    ?>
                    <div class="inner">
                        <a href="{{ $route }}" style="color:white">
                            <h3>&nbsp</h3>
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
                        if(Auth::user()->can('view.laporancu_view') && $cu == '0'){
                            $route = route('admins.laporancu.index');
                        }elseif(Auth::user()->can('view.laporancu_view') && $cu != '0'){
                            $route = route('admins.laporancu.index_cu',array($cu));
                        }
                        ?>
                    <div class="inner">
                         <a href="{{ $route }}" style="color:white">
                            <h3>&nbsp;</h3>
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
                  if($cu == '0'){
                    $route = route('admins.staf.index');
                  }else{
                    $route = route('admins.staf.index_cu',array($cu));
                  }
                ?>
                    <div class="inner">
                        <a href="{{ $route }}" style="color:white">
                            <h3>&nbsp;</h3>
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
                    <?php $route = route('admins.download.index');?>
                    <div class="inner">
                        <a href="{{ $route }}" style="color:white">
                            <h3>&nbsp;</h3>
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
                            <h3>&nbsp;</h3>
                            <p>Admin</p>
                          @else
                            <h3>&nbsp;</h3>
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
    @if(Auth::user()->can('view.laporanbkcu_view') || Auth::user()->can('view.laporancu_view'))
        @include('admins._components.laporancu')
    @endif
    <div class="row">
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
                    <?php $sarans = App\Saran::orderBy('created_at','desc')->take(10)->get(); ?>
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
@permission('view.saran_view')
@section('js')
    @include('admins._components.datatable_JS')
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
            }
        });

        table.on( 'order.dt search.dt', function () {
            table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell.innerHTML = i+1;
            } );
        } ).draw();
    </script>
@stop
@endpermission
