<?php 
$title="Dashboard"; 
?>
@extends('admins._layouts.layout')

@section('content')
<section class="content-header">
    <h1>
        <i class="fa fa-dashboard"></i> <b>Dashboard</b>
        <small>Panel Informasi Dasar</small>
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
        @if(Entrust::can('pengumuman'))
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-aqua">
                    <?php
                    $total_pengumuman = App\Models\Pengumuman::count();
                    ?>
                    <div class="inner">
                        <h3>{{ $total_pengumuman }}</h3>
                        <p>Pengumuman</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-comments-o"></i>
                    </div>
                    <a href="{{ route('admins.pengumuman.index') }}"
                       class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        @endif
        <!-- /pengumuman -->
        <!-- artikel -->
        @if(Entrust::can('artikel'))
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-green">
                    <?php
                    $total_artikel = App\Models\Artikel::count();
                    ?>
                    <div class="inner">
                        <h3>{{ $total_artikel }}</h3>
                        <p>Artikel</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-book"></i>
                    </div>
                    <a href="{{ route('admins.artikel.index') }}"
                       class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        @endif
        <!-- /artikel -->
        <!-- kegiatan -->
        @if(Entrust::can('kegiatan'))
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-red">
                    <?php
                    $total_kegiatan = App\Models\Kegiatan::count();
                    ?>
                    <div class="inner">
                        <h3>{{ $total_kegiatan }}</h3>
                        <p>Kegiatan</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <a href="{{ route('admins.kegiatan.index') }}"
                       class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        @endif
        <!-- /kegiatan -->
        <!-- cuprimer -->
        @if(Entrust::can('cuprimer'))
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-yellow">
                    <?php
                    $total_cuprimer = App\Models\Cuprimer::count();
                    ?>
                    <div class="inner">
                        <h3>{{ $total_cuprimer }}</h3>
                        <p>CU</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-building"></i>
                    </div>
                    <a href="{{ route('admins.cuprimer.index') }}"
                       class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        @endif
        <!-- /cuprimer -->
        <!-- staf -->
        @if(Entrust::can('staff'))
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-red">
                    <?php
                    $total_staff = App\Models\Staf::count();
                    ?>
                    <div class="inner">
                        <h3>{{ $total_staff }}</h3>
                        <p>Staf</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-sitemap"></i>
                    </div>
                    <a href="{{ route('admins.staf.index') }}"
                       class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        @endif
        <!-- /staf -->
        <!-- download -->
        @if(Entrust::can('download'))
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-green">
                    <?php
                    $total_download = App\Models\Download::count();
                    ?>
                    <div class="inner">
                        <h3>{{ $total_download }}</h3>
                        <p>Download</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-download"></i>
                    </div>
                    <a href="{{ route('admins.download.index') }}"
                       class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        @endif
        <!-- /download -->
        <!-- admin -->
        @if(Entrust::can('admin'))
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-aqua">
                    <?php
                    $total_admin = App\Models\Admin::count();
                    ?>
                    <div class="inner">
                        <h3>{{ $total_admin }}</h3>
                        <p>Admin</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user"></i>
                    </div>
                    <a href="{{ route('admins.admin.index') }}"
                       class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        @endif
        <!-- /admin -->
    </div>
    <!-- /Small boxes (Stat box) -->
    <!-- main -->
    <div class="row">
        <div class="col-lg-5">
            <!--statistik website-->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <i class="fa fa-road"></i>
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
            <!--info gerakan-->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <i class="fa fa-university"></i>
                    <h3 class="box-title"> Informasi Gerakan</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <?php $infogerakan = App\Models\InfoGerakan::find(1); ?>
                    @if(!empty($infogerakan->tanggal))
                        <?php $date = new Date($infogerakan->tanggal) ?>
                        <b>Per tanggal :</b> {{ $date->format('j F Y ')}}
                        <br/>
                    @endif
                    @if(!empty($infogerakan->jumlah_anggota))
                        <b>Jumlah Anggota :</b> {{ number_format($infogerakan->jumlah_anggota,0,",",".") }} orang
                        <br/>
                    @endif
                    @if(!empty($infogerakan->jumlah_cu))
                        <b>Jumlah CU Primer :</b> {{ number_format($infogerakan->jumlah_cu,0,",",".")}}
                        <br/>
                    @endif
                    @if(!empty($infogerakan->jumlah_staff_cu))
                        <b>Jumlah Staff CU Primer :</b> {{ number_format($infogerakan->jumlah_staff_cu,0,",",".") }} orang
                        <br/>
                    @endif
                    @if(!empty($infogerakan->asset))
                        <b>Jumlah Asset :</b> Rp. {{ number_format($infogerakan->asset,0,",",".") }}
                        <br/>
                    @endif
                    @if(!empty($infogerakan->piutang_beredar))
                        <b>Jumlah Piutang Beredar :</b> Rp. {{ number_format($infogerakan->piutang_beredar,0,",",".") }}
                        <br/>
                    @endif
                    @if(!empty($infogerakan->piutang_lalai_1))
                        <b>Jumlah Piutang Lalai 1 s.d. 12 Bulan  :</b> Rp. {{ number_format($infogerakan->piutang_lalai_1,0,",",".") }}
                        <br/>
                    @endif
                    @if(!empty($infogerakan->piutang_lalai_2))
                        <b>Jumlah Piutang > 12 Bulan  :</b> Rp. {{ number_format($infogerakan->piutang_lalai_2,0,",",".") }}
                        <br/>
                    @endif
                    @if(!empty($infogerakan->piutang_bersih))
                        <b>Jumlah Piutang Bersih  :</b> Rp. {{ number_format($infogerakan->piutang_bersih,0,",",".") }}
                        <br/>
                    @endif
                    @if(!empty($infogerakan->shu))
                        <b>SHU  :</b> Rp. {{ number_format($infogerakan->shu,0,",",".") }}
                        <br/>
                    @endif
                </div>
                <div class="box-footer clearfix">
                    @if(Entrust::can('infogerakan'))
                        <a href="{{ route('admins.infogerakan.edit',array(1)) }}" class="btn btn-primary btn-block">
                            <div>
                                <span class="pull-left"><b>Detail</b></span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    @endif
                </div>
            </div>
            <!--/info gerakan-->
        </div>
        <div class="col-lg-7">
            <!-- saran -->
            <div class="box box-primary direct-chat direct-chat-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-paper-plane-o fa-fw"></i> Saran Atau Kritik</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <!-- Conversations are loaded here -->
                    <div class="direct-chat-messages">
                        <!-- Message. Default to the left -->
                        <?php
                        $sarans = App\Models\Saran::orderBy('created_at','desc')->take(10)->get();
                        ?>
                        @foreach($sarans as $saran )
                            <div class="direct-chat-msg">
                                <div class='direct-chat-info clearfix'>
                                    @if(!empty($saran->name))
                                        <span class='direct-chat-name pull-left'>{{ $saran->name }}</span>
                                    @else
                                        <span class='direct-chat-name pull-left'>-</span>
                                    @endif
                                    @if(!empty($saran->created_at ))
                                        <?php $date = new Date($saran->created_at); ?>
                                        <span class='direct-chat-timestamp pull-right'>{{  $date->format('d/n/Y') }}</span>
                                    @else
                                        <span class='direct-chat-timestamp pull-right'>-</span>
                                    @endif
                                </div><!-- /.direct-chat-info -->
                                <img class="direct-chat-img" src="{{ asset('images/user.png')}}" alt="message user image" /><!-- /.direct-chat-img -->
                                @if(!empty($saran->content))
                                    <div class="direct-chat-text">
                                        {{{ $saran->content }}}
                                    </div><!-- /.direct-chat-text -->
                                @else
                                    <div class="direct-chat-text">
                                        -
                                    </div><!-- /.direct-chat-text -->
                                @endif
                            </div><!-- /.direct-chat-msg -->
                        @endforeach
                    </div><!--/.direct-chat-messages-->
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
            <!-- admin login -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <i class="fa fa-user"></i>
                    <h3 class="box-title"> Admin</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <?php
                    $logins = App\Models\Admin::select('name','username','login')
                            ->orderBy('login','desc')
                            ->take(6)->get();
                    ?>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Nama </th>
                                <th>Username </th>
                                <th><i class="fa fa-calendar"></i></th>
                                <th><i class="fa fa-clock-o"></i></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i=0; ?>
                            @foreach($logins as $login)
                                <?php $i++; ?>
                                <tr>
                                    @if(!empty($login->name))
                                        <td>{{ $login->name }}</td>
                                    @else
                                        <td>-</td>
                                    @endif

                                    @if(!empty($login->username))
                                        <td>{{ $login->username }}</td>
                                    @else
                                        <td>-</td>
                                    @endif

                                    @if(!empty($login->login))
                                        @if($login->login != "0000-00-00 00:00:00")
                                            <?php $datelogin = new Date($login->login); ?>
                                            <td>{{ $datelogin->format('l, j F Y') }}</td>
                                        @else
                                            <td>-</td>
                                        @endif
                                    @else
                                        <td>-</td>
                                    @endif

                                    @if(!empty($login->login))
                                        @if($login->login != "0000-00-00 00:00:00")
                                            <?php $datelogin = new Date($login->login); ?>
                                            <td>{{ $datelogin->format('H:i:s') }}</td>
                                        @else
                                            <td>-</td>
                                        @endif
                                    @else
                                        <td>-</td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="box-footer clearfix">
                    <a href="{{ route('admins.admin.index') }}" class="btn btn-primary btn-block">
                        <div>
                            <span class="pull-left"><b>Detail</b></span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <!-- /admin login -->
    </div>
    <!-- /main -->
</section>
<!-- Main content -->
@stop