<?php
$culists = App\Cuprimer::orderBy('name','asc')->get();
$culists_non = App\Cuprimer::onlyTrashed()->orderBy('name','asc')->get();

if(Request::is('admins/laporancu/index_cu/*')){
    $cuname = App\Cuprimer::withTrashed()->orderBy('name','asc')->where('no_ba',$id)->first();
    $title = "Laporan CU " .$cuname->name;
}elseif(Request::is('admins/laporancu') || Request::is('admins/laporancu/index_periode/*')){
    $title = "Laporan CU";
}elseif(Request::is('admins/laporancu/index_bkcu')){
    $title = "Laporan Konsolidasi CU";
}elseif(Request::is('admins/laporancu/index_hapus')){
    $title = "Laporan Terhapus";
}

$kelas ='laporancu';
$cu = Auth::user()->getCU();
?>

@extends('admins._layouts.layout')

@section('css')
@include('admins._components.datatable_CSS')
{{-- <link rel="stylesheet" type="text/css" href="{{asset('plugins/dataTables/extension/FixedColumns/css/fixedColumns.bootstrap.min.css')}}" > --}}
@if(!Request::is('admins/laporancu/index_bkcu') && !Request::is('admins/laporancu/index_hapus'))
    <script type="text/javascript" data-cfasync="false" async src="https://cdn.mathjax.org/mathjax/latest/MathJax.js?config=AM_CHTML"></script>
@endif
@stop

@section('content')
<!-- header -->
<section class="content-header">
    <h1>
        <i class="fa fa-bar-chart"></i> {{ $title }}
        <small>Mengelola Data {{ $title }}</small> 
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('admins') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><i class="fa fa-bar-chart"></i> Kelola Laporan CU</li>
    </ol>
</section>
<!-- /header -->
<section class="content">
    <!-- Alert -->
    @include('admins._layouts.alert')
    <!-- /Alert -->
    <!--content-->
    @if($cu == '0')
    <div class="box box-solid" style="color: red;">
        <div class="box-body">
            @if(Request::is('admins/laporancu') || Request::is('admins/laporancu/index_periode*'))
                <div class="col-sm-6" style="padding: .2em ;">
            @elseif(Request::is('admins/laporancu/index_bkcu') || Request::is('admins/laporancu/index_cu*') || Request::is('admins/laporancu/index_hapus'))
                <div class="col-sm-12" style="padding: .2em ;">
            @endif
                <div class="input-group">
                    <div class="input-group-addon primary-color"><i class="fa fa-file-o fa-fw"></i> Laporan</div>
                    <select class="form-control" id="dynamic_select">
                        <option {{ Request::is('admins/laporancu') ? 'selected' : '' }}
                                value="/admins/laporancu">Semua Credit Union</option>
                        <option {{ Request::is('admins/laporancu/index_bkcu') ? 'selected' : '' }}
                                value="/admins/laporancu/index_bkcu">Konsolidasi</option>
                        <option {{ Request::is('admins/laporancu/index_hapus') ? 'selected' : '' }}
                                value="/admins/laporancu/index_hapus">Terhapus</option>
                        <option disabled>-------CU Aktif-------</option>
                        @foreach($culists as $culist)
                            <option {{ Request::is('admins/laporancu/index_cu/'.$culist->no_ba) ? 'selected' : '' }}
                                    value="/admins/laporancu/index_cu/{{$culist->no_ba}}">{{ $culist->name }}</option>
                        @endforeach
                        <option disabled>-------CU Non-Aktif-------</option>
                        @foreach($culists_non as $culist)
                            <option {{ Request::is('admins/laporancu/index_cu/'.$culist->no_ba) ? 'selected' : '' }}
                                    value="/admins/laporancu/index_cu/{{$culist->no_ba}}">{{ $culist->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            @if(Request::is('admins/laporancu') || Request::is('admins/laporancu/index_periode/*'))
                <div class="col-sm-6" style="padding: .2em ;">
                    <?php
                        $data = App\laporancu::orderBy('periode','DESC')->groupBy('periode')->get(['periode']);
                        $periodeiode = $data->groupBy('periode');

                        $periodeiode1 = collect([]);
                        foreach ($periodeiode as $data){
                            $periodeiode1->push($data->first());
                        }

                        $periodes = array_column($periodeiode1->toArray(),'periode');
                    ?>
                    <div class="input-group">
                        <div class="input-group-addon primary-color"><i class="fa fa-clock-o fa-fw"></i> Periode Laporan</div>
                        <select class="form-control" id="dynamic_select2">
                            @foreach($periodes as $periode)
                                <?php $date = new Date($periode); ?>
                                <option {{ Request::is('admins/laporancu/index_periode/'.$periode) ? 'selected' : '' }}
                                        value="/admins/laporancu/index_periode/{{$periode}}">{{ $date->format('F Y') }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            @endif
        </div>
    </div>
    @endif
    {{-- table --}}
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            @if(Request::is('admins/laporancu') || Request::is('admins/laporancu/index_periode/*'))
                <li class="active"><a href="#tab_cu" data-toggle="tab">Tabel Perkembangan</a></li>
                <li><a href="#tab_pertumbuhan" data-toggle="tab">Tabel Pertumbuhan</a></li>
                <li><a href="#tab_provinsi" data-toggle="tab">Tabel Perkembangan (Provinsi)</a></li>
                <li><a href="#tab_do" data-toggle="tab">Tabel Perkembangan (District Office)</a></li>
            @elseif(Request::is('admins/laporancu/index_cu*') || Request::is('admins/laporancu/index_bkcu'))
                <li class="active"><a href="#tab_konsolidasi" data-toggle="tab">Tabel Perkembangan</a></li>
                <li><a href="#tab_pertumbuhan" data-toggle="tab">Tabel Pertumbuhan</a></li>
            @elseif(Request::is('admins/laporancu/index_hapus'))  
                <li class="active"><a href="#tab_hapus" data-toggle="tab">Laporan Terhapus</a></li>  
            @endif
            @if(!Request::is('admins/laporancu/index_bkcu') && !Request::is('admins/laporancu/index_hapus'))
                <li><a href="#tab_pearls" data-toggle="tab">Tabel P.E.A.R.L.S</a></li>
            @endif
            @if(Request::is('admins/laporancu/index_cu*'))
                <li><a href="#tab_hapus" data-toggle="tab">Laporan Terhapus</a></li> 
            @endif
        </ul>
        <div class="tab-content">
            @if(Request::is('admins/laporancu') || Request::is('admins/laporancu/index_periode/*'))
                <div class="tab-pane active" id="tab_cu">
                    <div class="input-group tabletools">
                        <div class="input-group-addon"><i class="fa fa-search"></i></div>
                        <input type="text" id="searchtext" class="form-control" placeholder="Kata kunci pencarian...">
                    </div>
                    <table class="table table-hover" id="dataTables-all" cellspacing="0" width="100%" >
                        <thead class="bg-light-blue-active color-palette">
                            <tr>
                                <th data-sortable="false" >#</th>
                                <th hidden></th>
                                <th hidden></th>
                                <th hidden></th>
                                <th>Credit Union</th>
                                <th>No.Ba</th>
                                <th>District Office</th>
                                <th>Wilayah</th>
                                <th>Periode Laporan</th>
                                <th class="text-right">Anggota Lelaki Biasa</th>
                                <th class="text-right">Anggota Lelaki L.Biasa</th>
                                <th class="text-right">Anggota Perempuan Biasa</th>
                                <th class="text-right">Anggota Perempuan L.Biasa</th>
                                <th class="text-right">Total Anggota</th>
                                <th class="text-right">ASET</th>
                                <th class="text-right">Aktiva LANCAR</th>
                                <th class="text-right">Simpanan Saham(SP+SW)</th>
                                <th class="text-right">Simpanan Non-Saham Unggulan</th>
                                <th class="text-right">Simpanan Non-Saham Harian & Deposito</th>
                                <th class="text-right">Hutang SPD</th>
                                <th class="text-right">Piutang Beredar</th>
                                <th class="text-right">Piutang Bersih</th>
                                <th class="text-right">Piutang Lalai 1-12 Bulan</th>
                                <th class="text-right">Piutang Lalai > 12 Bulan</th>
                                <th class="text-right">Rasio Piutang Beredar</th>
                                <th class="text-right">Rasio Piutang Lalai</th>
                                <th class="text-right">DCR</th>
                                <th class="text-right">DCU</th>
                                <th class="text-right">Total Pendapatan</th>
                                <th class="text-right">Total Biaya</th>
                                <th class="text-right">SHU</th>
                                <th>Tgl. Terima</th>
                                <th>Tgl. Ubah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $tot_l_biasa = 0;
                                $tot_l_lbiasa = 0;
                                $tot_p_biasa = 0;
                                $tot_p_lbiasa = 0;
                                $tot_anggota = 0;
                                $tot_aset = 0;
                                $tot_aktivalancar = 0;
                                $tot_simpanansaham = 0;
                                $tot_nonsaham_unggulan = 0;
                                $tot_nonsaham_harian = 0;
                                $tot_hutangspd = 0;
                                $tot_piutangberedar = 0;
                                $tot_piutanglalai_1bulan = 0;
                                $tot_piutanglalai_12bulan = 0;
                                $tot_piutangbersih = 0;
                                $tot_beredar = 0;
                                $tot_lalai = 0;
                                $tot_dcr = 0;
                                $tot_dcu = 0;
                                $tot_totalpendapatan = 0;
                                $tot_totalbiaya = 0;
                                $tot_shu = 0;
                                $tot_cu = 0;
                                ?>
                            @foreach($datas as $data)
                                <?php
                                    if(!empty($data->cuprimer)){
                                        if($data->cuprimer->do == "1"){
                                            $do ="Barat";
                                        }else if($data->cuprimer->do == "2"){
                                            $do ="Tengah";
                                        }else if($data->cuprimer->do == "3"){
                                            $do ="Timur";
                                        }else{
                                            $do ='-';
                                        }
                                        foreach($wilayahcuprimers as $wilayahcuprimer){
                                            if($data->cuprimer->wilayah == $wilayahcuprimer->id){
                                                $wilayah =$wilayahcuprimer->name;
                                            }
                                        }
                                    }else{
                                        $do = '-';
                                        $wilayah = '-';
                                    }

                                    $date = new Date($data->periode);
                                    $periode = $date->format('F Y');
                                    $rasio_beredar = $data->aset != 0 ? ($data->piutangberedar / $data->aset) : ($data->piutangberedar / 1);
                                    $rasio_lalai = $data->piutangberedar != 0 ? (($data->piutanglalai_1bulan + $data->piutanglalai_12bulan) / $data->piutangberedar) : (($data->piutanglalai_1bulan + $data->piutanglalai_12bulan) / 1);
                                    $total = $data->l_biasa + $data->l_lbiasa + $data->p_biasa + $data->p_lbiasa;
                                    $piutangbersih = $data->piutangberedar - ($data->piutanglalai_1bulan + $data->piutanglalai_12bulan);

                                    $tot_cu++;
                                    $tot_l_biasa += $data->l_biasa;
                                    $tot_l_lbiasa += $data->l_lbiasa;
                                    $tot_p_biasa += $data->p_biasa;
                                    $tot_p_lbiasa += $data->p_lbiasa;
                                    $tot_anggota += $total;
                                    $tot_aset += $data->aset;
                                    $tot_aktivalancar += $data->aktivalancar;
                                    $tot_simpanansaham += $data->simpanansaham;
                                    $tot_nonsaham_unggulan += $data->nonsaham_unggulan;
                                    $tot_nonsaham_harian += $data->nonsaham_harian;
                                    $tot_hutangspd += $data->hutangspd;
                                    $tot_piutangberedar += $data->piutangberedar;
                                    $tot_piutangbersih += $piutangbersih;
                                    $tot_piutanglalai_1bulan += $data->piutanglalai_1bulan;
                                    $tot_piutanglalai_12bulan += $data->piutanglalai_12bulan;
                                    $tot_beredar += $rasio_beredar;
                                    $tot_lalai += $rasio_lalai;
                                    $tot_dcr += $data->dcr;
                                    $tot_dcu += $data->dcu;
                                    $tot_totalpendapatan += $data->totalpendapatan;
                                    $tot_totalbiaya += $data->totalbiaya;
                                    $tot_shu += $data->shu;

                                    $l_biasa1 = $data->l_biasa;
                                    $l_lbiasa1 = $data->l_lbiasa;
                                    $p_biasa1 = $data->p_biasa;
                                    $p_lbiasa1 = $data->p_lbiasa;
                                    $total1 = $total;
                                    $aset1 = $data->aset;
                                    $aktivalancar1 = $data->aktivalancar;
                                    $simpanansaham1 = $data->simpanansaham;
                                    $nonsaham_unggulan1 = $data->nonsaham_unggulan;
                                    $nonsaham_harian1 = $data->nonsaham_harian;
                                    $hutangspd1 = $data->hutangspd;
                                    $piutangberedar1 = $data->piutangberedar;
                                    $piutanglalai_1bulan1 = $data->piutanglalai_1bulan;
                                    $piutanglalai_12bulan1 = $data->piutanglalai_12bulan;
                                    $rasio_lalai1 = $rasio_lalai;
                                    $rasio_beredar1 = $rasio_beredar;
                                    $piutangbersih1 = $piutangbersih;
                                    $dcr1 = $data->dcr;
                                    $dcu1 = $data->dcu;
                                    $totalpendapatan1 = $data->totalpendapatan;
                                    $totalbiaya1 = $data->totalbiaya;
                                    $shu1 = $data->shu;


                                    foreach($datasold as $dataold){
                                        if(!empty($dataold)){
                                            if($data->no_ba == $dataold->no_ba){
                                                $total_old = $dataold->l_biasa + $dataold->l_lbiasa + $dataold->p_biasa + $dataold->p_lbiasa;
                                                $piutangbersih_old = $dataold->piutangberedar - ($dataold->piutanglalai_1bulan + $dataold->piutanglalai_12bulan);
                                                $dataold->aset == 0 ? $rasio_beredar_old = 0 : $rasio_beredar_old =  ($dataold->piutangberedar / $dataold->aset);
                                                $dataold->piutangberedar == 0 ? $rasio_lalai_old = 0 : $rasio_lalai_old = ($dataold->piutanglalai_1bulan + $dataold->piutanglalai_12bulan) / $dataold->piutangberedar;

                                                $l_biasa1 = $data->l_biasa - $dataold->l_biasa;
                                                $l_lbiasa1 = $data->l_lbiasa - $dataold->l_lbiasa;
                                                $p_biasa1 = $data->p_biasa - $dataold->p_biasa;
                                                $p_lbiasa1 = $data->p_lbiasa - $dataold->p_lbiasa;
                                                $total1 = $total - $total_old;
                                                $aset1 = $data->aset - $dataold->aset;
                                                $aktivalancar1 = $data->aktivalancar - $dataold->aktivalancar;
                                                $simpanansaham1 = $data->simpanansaham - $dataold->simpanansaham;
                                                $nonsaham_unggulan1 = $data->nonsaham_unggulan - $dataold->nonsaham_unggulan;
                                                $nonsaham_harian1 = $data->nonsaham_harian - $dataold->nonsaham_harian;
                                                $hutangspd1 = $data->hutangspd - $dataold->hutangspd;
                                                $piutangberedar1 = $data->piutangberedar - $dataold->piutangberedar;
                                                $piutanglalai_12bulan1 = $data->piutanglalai_12bulan - $dataold->piutanglalai_12bulan;
                                                $rasio_lalai1 = $rasio_lalai - $rasio_lalai_old;
                                                $rasio_beredar1 = $rasio_beredar - $rasio_beredar_old;
                                                $piutangbersih1 = $piutangbersih - $piutangbersih_old;
                                                $dcr1 = $data->dcr - $dataold->dcr;
                                                $dcu1 = $data->dcu - $dataold->dcu;
                                                $totalpendapatan1 = $data->totalpendapatan - $dataold->totalpendapatan;
                                                $totalbiaya1 = $data->totalbiaya - $dataold->totalbiaya;
                                                $shu1 = $data->shu - $dataold->shu;
                                            }
                                        }  
                                    }
                                ?>
                                <tr @if($data->periode < $datas->first()->periode){!! 'class="highlight"'  !!} @endif>
                                    <td class="bg-blue disabled color-palette"></td>
                                    <td hidden>{{ $data->id }}</td>
                                    <td hidden>{{ $data->no_ba }}</td>
                                    @if(!empty($data->cuprimer))
                                        <td hidden>{{ $data->cuprimer->no_ba }}</td>
                                        <td>{{ $data->cuprimer->name }}
                                            @if($data->diskusi->count() > 0)
                                                <i class="fa fa-comments-o text-aqua" data-toggle="tooltip" data-placement="right" title="Terdapat diskusi pada laporan periode ini. Silahkan tekan tombol detail untuk melihat."></i>   
                                            @endif
                                        </td>
                                        <td>{{ $data->cuprimer->no_ba }}</td>
                                    @else
                                        <td hidden>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                    @endif
                                    <td>{{ $do }}</td>
                                    <td>{{ $wilayah }}</td>
                                    <td data-order="{{ $data->periode }}"> @if(!empty($data->periode)){{ $periode }}@else{{ '-' }}@endif</td>
                                    <td class="text-right">{{ number_format($data->l_biasa,"0",",",".") }} 
                                        @if($l_biasa1 != $data->l_biasa)
                                            @if($l_biasa1 > 0)
                                                <i class="fa fa-caret-square-o-up fa-fw text-aqua" data-toggle="tooltip" data-placement="right" title="Bertambah {{ number_format($l_biasa1,"0",",",".")}}"></i>
                                            @elseif($l_biasa1 < 0)
                                                <i class="fa fa-caret-square-o-down fa-fw text-red" data-toggle="tooltip" data-placement="right" title="Berkurang {{ number_format(abs($l_biasa1),"0",",",".")}}"></i>
                                            @endif
                                        @endif
                                    </td>
                                    <td class="text-right">{{ number_format($data->l_lbiasa,"0",",",".") }}
                                        @if($l_lbiasa1 != $data->l_lbiasa)
                                            @if($l_lbiasa1 > 0)
                                                <i class="fa fa-caret-square-o-up fa-fw text-aqua" data-toggle="tooltip" data-placement="right" title="Bertambah {{ number_format($l_lbiasa1,"0",",",".")}}"></i>
                                            @elseif($l_lbiasa1 < 0)
                                                <i class="fa fa-caret-square-o-down fa-fw text-red" data-toggle="tooltip" data-placement="right" title="Berkurang {{ number_format(abs($l_lbiasa1),"0",",",".")}}"></i>
                                            @endif
                                        @endif
                                    </td>
                                    <td class="text-right">{{ number_format($data->p_biasa,"0",",",".") }}
                                        @if($p_biasa1 != $data->p_biasa)
                                            @if($p_biasa1 > 0)
                                                <i class="fa fa-caret-square-o-up fa-fw text-aqua" data-toggle="tooltip" data-placement="right" title="Bertambah {{ number_format($p_biasa1,"0",",",".")}}"></i>
                                            @elseif($p_biasa1 < 0)
                                                <i class="fa fa-caret-square-o-down fa-fw text-red" data-toggle="tooltip" data-placement="right" title="Berkurang {{ number_format(abs($p_biasa1),"0",",",".")}}"></i>
                                            @endif
                                        @endif
                                    </td>
                                    <td class="text-right">{{ number_format($data->p_lbiasa,"0",",",".") }}
                                        @if($p_lbiasa1 != $data['p_lbiasa'])
                                            @if($p_lbiasa1 > 0)
                                                <i class="fa fa-caret-square-o-up fa-fw text-aqua" data-toggle="tooltip" data-placement="right" title="Bertambah {{ number_format($p_lbiasa1,"0",",",".")}}"></i>
                                            @elseif($p_lbiasa1 < 0)
                                                <i class="fa fa-caret-square-o-down fa-fw text-red" data-toggle="tooltip" data-placement="right" title="Berkurang {{ number_format(abs($p_lbiasa1),"0",",",".")}}"></i>
                                            @endif
                                        @endif
                                    </td>
                                    <td class="text-right">{{ number_format($total,"0",",",".") }}
                                        @if($total1 != $total)
                                            @if($total1 > 0)
                                                <i class="fa fa-caret-square-o-up fa-fw text-aqua" data-toggle="tooltip" data-placement="right" title="Bertambah {{ number_format($total1,"0",",",".")}}"></i>
                                            @elseif($total1 < 0)
                                                <i class="fa fa-caret-square-o-down fa-fw text-red" data-toggle="tooltip" data-placement="right" title="Berkurang {{ number_format(abs($total1),"0",",",".")}}"></i>
                                            @endif
                                        @endif
                                    </td>
                                    <td class="text-right">{{ number_format($data->aset,"0",",",".") }}
                                        @if($aset1 != $data->aset)
                                            @if($aset1 > 0)
                                                <i class="fa fa-caret-square-o-up fa-fw text-aqua" data-toggle="tooltip" data-placement="right" title="Bertambah {{ number_format($aset1,"0",",",".")}}"></i>
                                            @elseif($aset1 < 0)
                                                <i class="fa fa-caret-square-o-down fa-fw text-red" data-toggle="tooltip" data-placement="right" title="Berkurang {{ number_format(abs($aset1),"0",",",".")}}"></i>
                                            @endif
                                        @endif
                                    </td>
                                    <td class="text-right">{{ number_format($data->aktivalancar,"0",",",".") }}
                                        @if($aktivalancar1 != $data->aktivalancar)
                                            @if($aktivalancar1 > 0)
                                                <i class="fa fa-caret-square-o-up fa-fw text-aqua" data-toggle="tooltip" data-placement="right" title="Bertambah {{ number_format($aktivalancar1,"0",",",".")}}"></i>
                                            @elseif($aktivalancar1 < 0)
                                                <i class="fa fa-caret-square-o-down fa-fw text-red" data-toggle="tooltip" data-placement="right" title="Berkurang {{ number_format(abs($aktivalancar1),"0",",",".")}}"></i>
                                            @endif
                                        @endif
                                    </td>
                                    <td class="text-right">{{ number_format($data->simpanansaham,"0",",",".") }}
                                        @if($simpanansaham1 != $data->simpanansaham)
                                            @if($simpanansaham1 > 0)
                                                <i class="fa fa-caret-square-o-up fa-fw text-aqua" data-toggle="tooltip" data-placement="right" title="Bertambah {{ number_format($simpanansaham1,"0",",",".")}}"></i>
                                            @elseif($simpanansaham1 < 0)
                                                <i class="fa fa-caret-square-o-down fa-fw text-red" data-toggle="tooltip" data-placement="right" title="Berkurang {{ number_format(abs($simpanansaham1),"0",",",".")}}"></i>
                                            @endif
                                        @endif
                                    </td>
                                    <td class="text-right">{{ number_format($data->nonsaham_unggulan,"0",",",".") }}
                                        @if($nonsaham_unggulan1 != $data->nonsaham_unggulan)
                                            @if($nonsaham_unggulan1 > 0)
                                                <i class="fa fa-caret-square-o-up fa-fw text-aqua" data-toggle="tooltip" data-placement="right" title="Bertambah {{ number_format($nonsaham_unggulan1,"0",",",".")}}"></i>
                                            @elseif($nonsaham_unggulan1 < 0)
                                                <i class="fa fa-caret-square-o-down fa-fw text-red" data-toggle="tooltip" data-placement="right" title="Berkurang {{ number_format(abs($nonsaham_unggulan1),"0",",",".")}}"></i>
                                            @endif
                                        @endif
                                    </td>
                                    <td class="text-right">{{ number_format($data->nonsaham_harian,"0",",",".") }}
                                        @if($nonsaham_harian1 != $data->nonsaham_harian)
                                            @if($nonsaham_harian1 > 0)
                                                <i class="fa fa-caret-square-o-up fa-fw text-aqua" data-toggle="tooltip" data-placement="right" title="Bertambah {{ number_format($nonsaham_harian1,"0",",",".")}}"></i>
                                            @elseif($nonsaham_harian1 < 0)
                                                <i class="fa fa-caret-square-o-down fa-fw text-red" data-toggle="tooltip" data-placement="right" title="Berkurang {{ number_format(abs($nonsaham_harian1),"0",",",".")}}"></i>
                                            @endif
                                        @endif
                                    </td>
                                    <td class="text-right">{{ number_format($data->hutangspd,"0",",",".") }}
                                        @if($hutangspd1 != $data->hutangspd)
                                            @if($hutangspd1 > 0)
                                                <i class="fa fa-caret-square-o-up fa-fw text-aqua" data-toggle="tooltip" data-placement="right" title="Bertambah {{ number_format($hutangspd1,"0",",",".")}}"></i>
                                            @elseif($hutangspd1 < 0)
                                                <i class="fa fa-caret-square-o-down fa-fw text-red" data-toggle="tooltip" data-placement="right" title="Berkurang {{ number_format(abs($hutangspd1),"0",",",".")}}"></i>
                                            @endif
                                        @endif
                                    </td>
                                    <td class="text-right">{{ number_format($data->piutangberedar,"0",",",".")}}
                                        @if($piutangberedar1 != $data->piutangberedar)
                                            @if($piutangberedar1 > 0)
                                                <i class="fa fa-caret-square-o-up fa-fw text-aqua" data-toggle="tooltip" data-placement="right" title="Bertambah {{ number_format($piutangberedar1,"0",",",".")}}"></i>
                                            @elseif($piutangberedar1 < 0)
                                                <i class="fa fa-caret-square-o-down fa-fw text-red" data-toggle="tooltip" data-placement="right" title="Berkurang {{ number_format(abs($piutangberedar1),"0",",",".")}}"></i>
                                            @endif
                                        @endif
                                    </td>
                                    <td class="text-right">{{ number_format($piutangbersih,"0",",",".") }}
                                        @if($piutangbersih1 != $piutangbersih)
                                            @if($piutangbersih1 > 0)
                                                <i class="fa fa-caret-square-o-up fa-fw text-aqua" data-toggle="tooltip" data-placement="right" title="Bertambah {{ number_format($piutangbersih1,"0",",",".")}}"></i>
                                            @elseif($piutangbersih1 < 0)
                                                <i class="fa fa-caret-square-o-down fa-fw text-red" data-toggle="tooltip" data-placement="right" title="Berkurang {{ number_format(abs($piutangbersih1),"0",",",".")}}"></i>
                                            @endif
                                        @endif
                                    </td>
                                    <td class="text-right">{{ number_format($data->piutanglalai_1bulan,"0",",",".") }}
                                        @if($piutanglalai_1bulan1 != $data->piutanglalai_1bulan)
                                            @if($piutanglalai_1bulan1 > 0)
                                                <i class="fa fa-caret-square-o-up fa-fw text-aqua" data-toggle="tooltip" data-placement="right" title="Bertambah {{ number_format($piutanglalai_1bulan1,"0",",",".")}}"></i>
                                            @elseif($piutanglalai_1bulan1 < 0)
                                                <i class="fa fa-caret-square-o-down fa-fw text-red" data-toggle="tooltip" data-placement="right" title="Berkurang {{ number_format(abs($piutanglalai_1bulan1),"0",",",".")}}"></i>
                                            @endif
                                        @endif
                                    </td>
                                    <td class="text-right">{{ number_format($data->piutanglalai_12bulan,"0",",",".") }}
                                        @if($piutanglalai_12bulan1 != $data->piutanglalai_12bulan)
                                            @if($piutanglalai_12bulan1 > 0)
                                                <i class="fa fa-caret-square-o-up fa-fw text-aqua" data-toggle="tooltip" data-placement="right" title="Bertambah {{ number_format($piutanglalai_12bulan1,"0",",",".")}}"></i>
                                            @elseif($piutanglalai_12bulan1 < 0)
                                                <i class="fa fa-caret-square-o-down fa-fw text-red" data-toggle="tooltip" data-placement="right" title="Berkurang {{ number_format(abs($piutanglalai_12bulan1),"0",",",".")}}"></i>
                                            @endif
                                        @endif
                                    </td>
                                    <td class="text-right">{{ number_format($rasio_beredar*100,"0",",",".") }} %
                                        @if($rasio_beredar1 != $rasio_beredar)
                                            @if($rasio_beredar1 > 0)
                                                <i class="fa fa-caret-square-o-up fa-fw text-aqua" data-toggle="tooltip" data-placement="right" title="Bertambah {{ number_format(($rasio_beredar1*100),2) }} %"></i>
                                            @elseif($rasio_beredar1 < 0)
                                                <i class="fa fa-caret-square-o-down fa-fw text-red" data-toggle="tooltip" data-placement="right" title="Berkurang {{ number_format((abs($rasio_beredar1)*100),2) }} %"></i>
                                            @endif
                                        @endif
                                    </td>
                                    <td class="text-right">{{ number_format($rasio_lalai*100,"0",",",".") }} %
                                        @if($rasio_lalai1 != $rasio_lalai)
                                            @if($rasio_lalai1 > 0)
                                                <i class="fa fa-caret-square-o-up fa-fw text-aqua" data-toggle="tooltip" data-placement="right" title="Bertambah {{ number_format(($rasio_lalai1*100),2) }} %"></i>
                                            @elseif($rasio_lalai1 < 0)
                                                <i class="fa fa-caret-square-o-down fa-fw text-red" data-toggle="tooltip" data-placement="right" title="Berkurang {{ number_format((abs($rasio_lalai1)*100),2) }} %"></i>
                                            @endif
                                        @endif
                                    </td>
                                    <td class="text-right">{{ number_format($data->dcr,"0",",",".") }}
                                        @if($dcr1 != $data->dcr)
                                            @if($dcr1 > 0)
                                                <i class="fa fa-caret-square-o-up fa-fw text-aqua" data-toggle="tooltip" data-placement="right" title="Bertambah {{ number_format($dcr1,"0",",",".")}}"></i>
                                            @elseif($dcr1 < 0)
                                                <i class="fa fa-caret-square-o-down fa-fw text-red" data-toggle="tooltip" data-placement="right" title="Berkurang {{ number_format(abs($dcr1),"0",",",".")}}"></i>
                                            @endif
                                        @endif
                                    </td>
                                    <td class="text-right">{{ number_format($data->dcu,"0",",",".")}}
                                        @if($dcu1 != $data->dcu)
                                            @if($dcu1 > 0)
                                                <i class="fa fa-caret-square-o-up fa-fw text-aqua" data-toggle="tooltip" data-placement="right" title="Bertambah {{ number_format($dcu1,"0",",",".")}}"></i>
                                            @elseif($dcu1 < 0)
                                                <i class="fa fa-caret-square-o-down fa-fw text-red" data-toggle="tooltip" data-placement="right" title="Berkurang {{ number_format(abs($dcu1),"0",",",".")}}"></i>
                                            @endif
                                        @endif
                                    </td>
                                    <td class="text-right">{{ number_format($data->totalpendapatan,"0",",",".") }}
                                        @if($totalpendapatan1 != $data->totalpendapatan)
                                            @if($totalpendapatan1 > 0)
                                                <i class="fa fa-caret-square-o-up fa-fw text-aqua" data-toggle="tooltip" data-placement="right" title="Bertambah {{ number_format($totalpendapatan1,"0",",",".")}}"></i>
                                            @elseif($totalpendapatan1 < 0)
                                                <i class="fa fa-caret-square-o-down fa-fw text-red" data-toggle="tooltip" data-placement="right" title="Berkurang {{ number_format(abs($totalpendapatan1),"0",",",".")}}"></i>
                                            @endif
                                        @endif
                                    </td>
                                    <td class="text-right">{{ number_format($data->totalbiaya,"0",",",".") }}
                                        @if($totalbiaya1 != $data->totalbiaya)
                                            @if($totalbiaya1 > 0)
                                                <i class="fa fa-caret-square-o-up fa-fw text-aqua" data-toggle="tooltip" data-placement="right" title="Bertambah {{ number_format($totalbiaya1,"0",",",".")}}"></i>
                                            @elseif($totalbiaya1 < 0)
                                                <i class="fa fa-caret-square-o-down fa-fw text-red" data-toggle="tooltip" data-placement="right" title="Berkurang {{ number_format(abs($totalbiaya1),"0",",",".")}}"></i>
                                            @endif
                                        @endif
                                    </td>
                                    <td class="text-right">{{ number_format($data->shu,"0",",",".") }}
                                        @if($shu1 != $data->shu)
                                            @if($shu1 > 0)
                                                <i class="fa fa-caret-square-o-up fa-fw text-aqua" data-toggle="tooltip" data-placement="right" title="Bertambah {{ number_format($shu1,"0",",",".")}}"></i>
                                            @elseif($shu1 < 0)
                                                <i class="fa fa-caret-square-o-down fa-fw text-red" data-toggle="tooltip" data-placement="right" title="Berkurang {{ number_format(abs($shu1),"0",",",".")}}"></i>
                                            @endif
                                        @endif
                                    </td>
                                    <td data-order="{{ $data->created_at }}">@if(!empty($data->created_at)){{ $data->created_at->format('d/m/Y') }}@else{{ '-' }}@endif</td>
                                    <td data-order="{{ $data->updated_at }}">@if(!empty($data->updated_at)){{ $data->updated_at->format('d/m/Y') }}@else{{ '-' }}@endif</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <hr/>
                    <table class="table table-hover table-bordered" id="dataTables-total" width="100%">
                        <thead class="bg-light-blue-active color-palette">
                            <tr>
                                <th data-sortable="false">&nbsp</th>
                                <th>Anggota Lelaki Biasa</th>
                                <th>Anggota Lelaki L.Biasa</th>
                                <th>Anggota Perempuan Biasa</th>
                                <th>Anggota Perempuan L.Biasa</th>
                                <th>Total Anggota</th>
                                <th>ASET</th>
                                <th>Aktiva LANCAR</th>
                                <th>Simpanan Saham(SP+SW)</th>
                                <th>Simpanan Non-Saham Unggulan</th>
                                <th>Simpanan Non-Saham Harian & Deposito</th>
                                <th>Hutang SPD</th>
                                <th>Piutang Beredar</th>
                                <th>Piutang Bersih</th>
                                <th>Piutang Lalai 1-12 Bulan</th>
                                <th>Piutang Lalai > 12 Bulan</th>
                                <th>Rasio Piutang Beredar</th>
                                <th>Rasio Piutang Lalai</th>
                                <th>DCR</th>
                                <th>DCU</th>
                                <th>Total Pendapatan</th>
                                <th>Total Biaya</th>
                                <th>SHU</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="bg-blue disabled color-palette"><b>Total</b></td>
                                <td>{{ number_format($tot_l_biasa,"0",",",".") }}</td>
                                <td>{{ number_format($tot_l_lbiasa,"0",",",".") }}</td>
                                <td>{{ number_format($tot_p_biasa,"0",",",".") }}</td>
                                <td>{{ number_format($tot_p_lbiasa,"0",",",".") }}</td>
                                <td>{{ number_format($tot_anggota,"0",",",".")}}</td>
                                <td>{{ number_format($tot_aset,"0",",",".") }}</td>
                                <td>{{ number_format($tot_aktivalancar,"0",",",".") }}</td>
                                <td>{{ number_format($tot_simpanansaham,"0",",",".") }}</td>
                                <td>{{ number_format($tot_nonsaham_unggulan,"0",",",".") }}</td>
                                <td>{{ number_format($tot_nonsaham_harian,"0",",",".") }}</td>
                                <td>{{ number_format($tot_hutangspd,"0",",",".") }}</td>
                                <td>{{ number_format($tot_piutangberedar,"0",",",".") }}</td>
                                <td>{{ number_format($tot_piutanglalai_1bulan,"0",",",".") }}</td>
                                <td>{{ number_format($tot_piutanglalai_12bulan,"0",",",".") }}</td>
                                <td>{{ number_format($tot_piutangbersih,"0",",",".") }}</td>
                                <td>-</td>
                                <td>-</td>
                                <td>{{ number_format($tot_dcr,"0",",",".") }}</td>
                                <td>{{ number_format($tot_dcu,"0",",",".") }}</td>
                                <td>{{ number_format($tot_totalpendapatan,"0",",",".") }}</td>
                                <td>{{ number_format($tot_totalbiaya,"0",",",".") }}</td>
                                <td>{{ number_format($tot_shu,"0",",",".") }}</td>
                            </tr>
                            <tr>
                                <td class="bg-blue disabled color-palette"><b>Rata - Rata</b></td>
                                @if($tot_cu != 0)
                                    <td>{{ number_format($tot_l_biasa/$tot_cu,"0",",",".") }}</td>
                                    <td>{{ number_format($tot_l_lbiasa/$tot_cu,"0",",",".") }}</td>
                                    <td>{{ number_format($tot_p_biasa/$tot_cu,"0",",",".") }}</td>
                                    <td>{{ number_format($tot_p_lbiasa/$tot_cu,"0",",",".") }}</td>
                                    <td>{{ number_format($tot_anggota/$tot_cu,"0",",",".")}}</td>
                                    <td>{{ number_format($tot_aset/$tot_cu,"0",",",".") }}</td>
                                    <td>{{ number_format($tot_aktivalancar/$tot_cu,"0",",",".") }}</td>
                                    <td>{{ number_format($tot_simpanansaham/$tot_cu,"0",",",".") }}</td>
                                    <td>{{ number_format($tot_nonsaham_unggulan/$tot_cu,"0",",",".") }}</td>
                                    <td>{{ number_format($tot_nonsaham_harian/$tot_cu,"0",",",".") }}</td>
                                    <td>{{ number_format($tot_hutangspd/$tot_cu,"0",",",".") }}</td>
                                    <td>{{ number_format($tot_piutangberedar/$tot_cu,"0",",",".") }}</td>
                                    <td>{{ number_format($tot_piutanglalai_1bulan/$tot_cu,"0",",",".") }}</td>
                                    <td>{{ number_format($tot_piutanglalai_12bulan/$tot_cu,"0",",",".") }}</td>
                                    <td>{{ number_format($tot_piutangbersih/$tot_cu,"0",",",".") }}</td>
                                    <td>{{ number_format( $tot_beredar/$tot_cu,"2",",",".") }} %</td>
                                    <td>{{ number_format( $tot_lalai/$tot_cu,"2",",",".") }} %</td>
                                    <td>{{ number_format($tot_dcr/$tot_cu,"0",",",".") }}</td>
                                    <td>{{ number_format($tot_dcu/$tot_cu,"0",",",".") }}</td>
                                    <td>{{ number_format($tot_totalpendapatan/$tot_cu,"0",",",".") }}</td>
                                    <td>{{ number_format($tot_totalbiaya/$tot_cu,"0",",",".") }}</td>
                                    <td>{{ number_format($tot_shu/$tot_cu,"0",",",".") }}</td>
                                @endif
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane" id="tab_pertumbuhan">
                    <div class="input-group tabletools">
                        <div class="input-group-addon"><i class="fa fa-search"></i></div>
                        <input type="text" id="searchtextkonsolidasi" class="form-control" placeholder="Kata kunci pencarian...">
                    </div>
                    <table class="table table-hover table-bordered" id="dataTables-konsolidasi" cellspacing="0" width="100%" >
                        <thead class="bg-light-blue-active color-palette">
                            <tr>
                                <th data-sortable="false" >#</th>
                                <th>Credit Union</th>
                                <th>Periode Laporan</th>
                                <th>Anggota Lelaki Biasa</th>
                                <th>Anggota Lelaki L.Biasa</th>
                                <th>Anggota Perempuan Biasa</th>
                                <th>Anggota Perempuan L.Biasa</th>
                                <th>Total Anggota</th>
                                <th>ASET</th>
                                <th>Aktiva LANCAR</th>
                                <th>Simpanan Saham(SP+SW)</th>
                                <th>Simpanan Non-Saham Unggulan</th>
                                <th>Simpanan Non-Saham Harian & Deposito</th>
                                <th>Hutang SPD</th>
                                <th>Piutang Beredar</th>
                                <th>Piutang Bersih</th>
                                <th>Piutang Lalai 1-12 Bulan</th>
                                <th>Piutang Lalai > 12 Bulan</th>
                                <th>Rasio Piutang Beredar</th>
                                <th>Rasio Piutang Lalai</th>
                                <th>DCR</th>
                                <th>DCU</th>
                                <th>Total Pendapatan</th>
                                <th>Total Biaya</th>
                                <th>SHU</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($datas as $data)
                                <?php
                                    $date = new Date($data->periode);
                                    $periode = $date->format('F Y');
                                    $rasio_beredar = $data->aset != 0 ? ($data->piutangberedar / $data->aset) : ($data->piutangberedar / 1);
                                    $rasio_lalai = $data->piutangberedar != 0 ? (($data->piutanglalai_1bulan + $data->piutanglalai_12bulan) / $data->piutangberedar) : (($data->piutanglalai_1bulan + $data->piutanglalai_12bulan) / 1);
                                    $total = $data->l_biasa + $data->l_lbiasa + $data->p_biasa + $data->p_lbiasa;
                                    $piutangbersih = $data->piutangberedar - ($data->piutanglalai_1bulan + $data->piutanglalai_12bulan);

                                    $l_biasa1 = $data->l_biasa;
                                    $l_lbiasa1 = $data->l_lbiasa;
                                    $p_biasa1 = $data->p_biasa;
                                    $p_lbiasa1 = $data->p_lbiasa;
                                    $total1 = $total;
                                    $aset1 = $data->aset;
                                    $aktivalancar1 = $data->aktivalancar;
                                    $simpanansaham1 = $data->simpanansaham;
                                    $nonsaham_unggulan1 = $data->nonsaham_unggulan;
                                    $nonsaham_harian1 = $data->nonsaham_harian;
                                    $hutangspd1 = $data->hutangspd;
                                    $piutangberedar1 = $data->piutangberedar;
                                    $piutanglalai_1bulan1 = $data->piutanglalai_1bulan;
                                    $piutanglalai_12bulan1 = $data->piutanglalai_12bulan;
                                    $rasio_lalai1 = $rasio_lalai;
                                    $rasio_beredar1 = $rasio_beredar;
                                    $piutangbersih1 = $piutangbersih;
                                    $dcr1 = $data->dcr;
                                    $dcu1 = $data->dcu;
                                    $totalpendapatan1 = $data->totalpendapatan;
                                    $totalbiaya1 = $data->totalbiaya;
                                    $shu1 = $data->shu;

                                    foreach($datasold as $dataold){
                                        if(!empty($dataold)){
                                            if($data->no_ba == $dataold->no_ba){
                                                $total_old = $dataold->l_biasa + $dataold->l_lbiasa + $dataold->p_biasa + $dataold->p_lbiasa;
                                                $piutangbersih_old = $dataold->piutangberedar - ($dataold->piutanglalai_1bulan + $dataold->piutanglalai_12bulan);
                                                $dataold->aset == 0 ? $rasio_beredar_old = 0 : $rasio_beredar_old =  ($dataold->piutangberedar / $dataold->aset);
                                                $dataold->piutangberedar == 0 ? $rasio_lalai_old = 0 : $rasio_lalai_old = ($dataold->piutanglalai_1bulan + $dataold->piutanglalai_12bulan) / $dataold->piutangberedar;

                                                $l_biasa1 = $data->l_biasa - $dataold->l_biasa;
                                                $l_lbiasa1 = $data->l_lbiasa - $dataold->l_lbiasa;
                                                $p_biasa1 = $data->p_biasa - $dataold->p_biasa;
                                                $p_lbiasa1 = $data->p_lbiasa - $dataold->p_lbiasa;
                                                $total1 = $total - $total_old;
                                                $aset1 = $data->aset - $dataold->aset;
                                                $aktivalancar1 = $data->aktivalancar - $dataold->aktivalancar;
                                                $simpanansaham1 = $data->simpanansaham - $dataold->simpanansaham;
                                                $nonsaham_unggulan1 = $data->nonsaham_unggulan - $dataold->nonsaham_unggulan;
                                                $nonsaham_harian1 = $data->nonsaham_harian - $dataold->nonsaham_harian;
                                                $hutangspd1 = $data->hutangspd - $dataold->hutangspd;
                                                $piutangberedar1 = $data->piutangberedar - $dataold->piutangberedar;
                                                $piutanglalai_1bulan1 = $data->piutanglalai_1bulan - $dataold->piutanglalai_1bulan;
                                                $piutanglalai_12bulan1 = $data->piutanglalai_12bulan - $dataold->piutanglalai_12bulan;
                                                $rasio_lalai1 = $rasio_lalai - $rasio_lalai_old;
                                                $rasio_beredar1 = $rasio_beredar - $rasio_beredar_old;
                                                $piutangbersih1 = $piutangbersih - $piutangbersih_old;
                                                $dcr1 = $data->dcr - $dataold->dcr;
                                                $dcu1 = $data->dcu - $dataold->dcu;
                                                $totalpendapatan1 = $data->totalpendapatan - $dataold->totalpendapatan;
                                                $totalbiaya1 = $data->totalbiaya - $dataold->totalbiaya;
                                                $shu1 = $data->shu - $dataold->shu;
                                            }
                                        }  
                                    }
                                ?>
                                <tr @if($data->periode < $datas->first()->periode){!! 'class="highlight"'  !!} @endif>
                                    <td class="bg-blue disabled color-palette"></td>
                                    @if(!empty($data->cuprimer))
                                        <td>{{ $data->cuprimer->name }}</td>
                                    @else
                                        <td>-</td>
                                    @endif
                                    <td data-order="{{ $data->periode }}"> @if(!empty($data->periode)){{ $periode }}@else{{ '-' }}@endif</td>
                                    <td>
                                        @if($l_biasa1 > 0)
                                            <i class="fa fa-caret-square-o-up fa-fw text-aqua"></i> {{ number_format($l_biasa1,"0",",",".")}}
                                        @elseif($l_biasa1 < 0)
                                            <i class="fa fa-caret-square-o-down fa-fw text-red"></i> {{ number_format(abs($l_biasa1),"0",",",".")}}
                                        @else
                                            - 
                                        @endif
                                    </td>
                                    <td>
                                        @if($l_lbiasa1 > 0)
                                            <i class="fa fa-caret-square-o-up fa-fw text-aqua"></i> {{ number_format($l_lbiasa1,"0",",",".")}}
                                        @elseif($l_lbiasa1 < 0)
                                            <i class="fa fa-caret-square-o-down fa-fw text-red"></i> {{ number_format(abs($l_lbiasa1),"0",",",".")}}
                                        @else
                                            - 
                                        @endif
                                    </td>
                                    <td>
                                        @if($p_biasa1 > 0)
                                            <i class="fa fa-caret-square-o-up fa-fw text-aqua"></i> {{ number_format($p_biasa1,"0",",",".")}}
                                        @elseif($p_biasa1 < 0)
                                            <i class="fa fa-caret-square-o-down fa-fw text-red"></i> {{ number_format(abs($p_biasa1),"0",",",".")}}
                                        @else
                                            - 
                                        @endif
                                    </td>
                                    <td>
                                        @if($p_lbiasa1 > 0)
                                            <i class="fa fa-caret-square-o-up fa-fw text-aqua"></i> {{ number_format($p_lbiasa1,"0",",",".")}}
                                        @elseif($p_lbiasa1 < 0)
                                            <i class="fa fa-caret-square-o-down fa-fw text-red"></i> {{ number_format(abs($p_lbiasa1),"0",",",".")}}
                                        @else
                                            - 
                                        @endif
                                    </td>
                                    <td>
                                        @if($total1 > 0)
                                            <i class="fa fa-caret-square-o-up fa-fw text-aqua"></i> {{ number_format($total1,"0",",",".")}}
                                        @elseif($total1 < 0)
                                            <i class="fa fa-caret-square-o-down fa-fw text-red"></i> {{ number_format(abs($total1),"0",",",".")}}
                                        @else
                                            -    
                                        @endif
                                    </td>
                                    <td>
                                        @if($aset1 > 0)
                                            <i class="fa fa-caret-square-o-up fa-fw text-aqua"></i> {{ number_format($aset1,"0",",",".")}}
                                        @elseif($aset1 < 0)
                                            <i class="fa fa-caret-square-o-down fa-fw text-red"></i> {{ number_format(abs($aset1),"0",",",".")}}
                                        @else
                                            - 
                                        @endif
                                    </td>
                                    <td>
                                        @if($aktivalancar1 > 0)
                                            <i class="fa fa-caret-square-o-up fa-fw text-aqua"></i> {{ number_format($aktivalancar1,"0",",",".")}}
                                        @elseif($aktivalancar1 < 0)
                                            <i class="fa fa-caret-square-o-down fa-fw text-red"></i> {{ number_format(abs($aktivalancar1),"0",",",".")}}
                                        @else
                                            - 
                                        @endif
                                    </td>
                                    <td>
                                        @if($simpanansaham1 > 0)
                                            <i class="fa fa-caret-square-o-up fa-fw text-aqua"></i> {{ number_format($simpanansaham1,"0",",",".")}}
                                        @elseif($simpanansaham1 < 0)
                                            <i class="fa fa-caret-square-o-down fa-fw text-red"></i> {{ number_format(abs($simpanansaham1),"0",",",".")}}
                                        @else
                                            - 
                                        @endif
                                    </td>
                                    <td>
                                        @if($nonsaham_unggulan1 > 0)
                                            <i class="fa fa-caret-square-o-up fa-fw text-aqua"></i> {{ number_format($nonsaham_unggulan1,"0",",",".")}}
                                        @elseif($nonsaham_unggulan1 < 0)
                                            <i class="fa fa-caret-square-o-down fa-fw text-red"></i> {{ number_format(abs($nonsaham_unggulan1),"0",",",".")}}
                                        @else
                                            - 
                                        @endif
                                    </td>
                                    <td>
                                        @if($nonsaham_harian1 > 0)
                                            <i class="fa fa-caret-square-o-up fa-fw text-aqua"></i> {{ number_format($nonsaham_harian1,"0",",",".")}}
                                        @elseif($nonsaham_harian1 < 0)
                                            <i class="fa fa-caret-square-o-down fa-fw text-red"></i> {{ number_format(abs($nonsaham_harian1),"0",",",".")}}
                                        @else
                                            - 
                                        @endif
                                    </td>
                                    <td>
                                        @if($hutangspd1 > 0)
                                            <i class="fa fa-caret-square-o-up fa-fw text-aqua"></i> {{ number_format($hutangspd1,"0",",",".")}}
                                        @elseif($hutangspd1 < 0)
                                            <i class="fa fa-caret-square-o-down fa-fw text-red"></i> {{ number_format(abs($hutangspd1),"0",",",".")}}
                                        @else
                                            - 
                                        @endif
                                    </td>
                                    <td>
                                        @if($piutangberedar1 > 0)
                                            <i class="fa fa-caret-square-o-up fa-fw text-aqua"></i> {{ number_format($piutangberedar1,"0",",",".")}}
                                        @elseif($piutangberedar1 < 0)
                                            <i class="fa fa-caret-square-o-down fa-fw text-red"></i> {{ number_format(abs($piutangberedar1),"0",",",".")}}
                                        @else
                                            - 
                                        @endif
                                    </td>
                                    <td>
                                        @if($piutangbersih1 > 0)
                                            <i class="fa fa-caret-square-o-up fa-fw text-aqua"></i> {{ number_format($piutangbersih1,"0",",",".")}}
                                        @elseif($piutangbersih1 < 0) 
                                            <i class="fa fa-caret-square-o-down fa-fw text-red"></i> {{ number_format(abs($piutangbersih1),"0",",",".")}}
                                        @else
                                            - 
                                        @endif
                                    </td>
                                    <td>
                                        @if($piutanglalai_1bulan1 > 0)
                                            <i class="fa fa-caret-square-o-up fa-fw text-aqua"></i> {{ number_format($piutanglalai_1bulan1,"0",",",".")}}
                                        @elseif($piutanglalai_1bulan1 < 0)
                                            <i class="fa fa-caret-square-o-down fa-fw text-red"></i> {{ number_format(abs($piutanglalai_1bulan1),"0",",",".")}}
                                        @else
                                            - 
                                        @endif
                                    </td>
                                    <td>
                                        @if($piutanglalai_12bulan1 > 0)
                                            <i class="fa fa-caret-square-o-up fa-fw text-aqua"></i> {{ number_format($piutanglalai_12bulan1,"0",",",".")}}
                                        @elseif($piutanglalai_12bulan1 < 0)
                                            <i class="fa fa-caret-square-o-down fa-fw text-red"></i> {{ number_format(abs($piutanglalai_12bulan1),"0",",",".")}}
                                        @else
                                            - 
                                        @endif
                                    </td>
                                    <td>
                                        @if($rasio_beredar1 > 0)
                                            <i class="fa fa-caret-square-o-up fa-fw text-aqua"></i> {{ number_format(($rasio_beredar1*100),2) }} %
                                        @elseif($rasio_beredar1 < 0)
                                            <i class="fa fa-caret-square-o-down fa-fw text-red"></i> {{ number_format((abs($rasio_beredar1)*100),2) }} %
                                        @else
                                            - 
                                        @endif
                                    </td>
                                    <td>
                                        @if($rasio_lalai1 > 0)
                                            <i class="fa fa-caret-square-o-up fa-fw text-aqua"></i> {{ number_format(($rasio_lalai1*100),2) }} %
                                        @elseif($rasio_lalai1 < 0)
                                            <i class="fa fa-caret-square-o-down fa-fw text-red"></i> {{ number_format((abs($rasio_lalai1)*100),2) }} %
                                        @else
                                            - 
                                        @endif
                                    </td>
                                    <td>
                                        @if($dcr1 > 0)
                                            <i class="fa fa-caret-square-o-up fa-fw text-aqua"></i> {{ number_format($dcr1,"0",",",".")}}
                                        @elseif($dcr1 < 0)
                                            <i class="fa fa-caret-square-o-down fa-fw text-red"></i> {{ number_format(abs($dcr1),"0",",",".")}}
                                        @else
                                            - 
                                        @endif
                                    </td>
                                    <td>
                                        @if($dcu1 > 0)
                                            <i class="fa fa-caret-square-o-up fa-fw text-aqua"></i> {{ number_format($dcu1,"0",",",".")}}
                                        @elseif($dcu1 < 0)
                                            <i class="fa fa-caret-square-o-down fa-fw text-red"></i> {{ number_format(abs($dcu1),"0",",",".")}}
                                        @else
                                            - 
                                        @endif
                                    </td>
                                    <td>
                                        @if($totalpendapatan1 > 0)
                                            <i class="fa fa-caret-square-o-up fa-fw text-aqua"></i> {{ number_format($totalpendapatan1,"0",",",".")}}
                                        @elseif($totalpendapatan1 < 0)
                                            <i class="fa fa-caret-square-o-down fa-fw text-red"></i> {{ number_format(abs($totalpendapatan1),"0",",",".")}}
                                        @else
                                            - 
                                        @endif
                                    </td>
                                    <td>
                                        @if($totalbiaya1 > 0)
                                            <i class="fa fa-caret-square-o-up fa-fw text-aqua"></i> {{ number_format($totalbiaya1,"0",",",".")}}
                                        @elseif($totalbiaya1 < 0) 
                                            <i class="fa fa-caret-square-o-down fa-fw text-red"></i> {{ number_format(abs($totalbiaya1),"0",",",".")}}
                                        @else
                                            - 
                                        @endif
                                    </td>
                                    <td>
                                        @if($shu1 > 0)
                                            <i class="fa fa-caret-square-o-up fa-fw text-aqua"></i> {{ number_format($shu1,"0",",",".")}}
                                        @elseif($shu1 < 0)
                                            <i class="fa fa-caret-square-o-down fa-fw text-red"></i> {{ number_format(abs($shu1),"0",",",".")}}
                                        @else
                                            - 
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>                
                </div>
                <div class="tab-pane" id="tab_provinsi">
                    <div class="input-group tabletools">
                        <div class="input-group-addon"><i class="fa fa-search"></i></div>
                        <input type="text" id="searchtextprov" class="form-control" placeholder="Kata kunci pencarian..." >
                    </div>
                    <table class="table table-hover table-bordered" id="dataTables-provinsi" width="100%">
                        <thead  class="bg-light-blue-active color-palette">
                        <tr>
                            <th data-sortable="false">#</th>
                            <th>Provinsi / Wilayah</th>
                            <th>CU</th>
                            <th>Anggota Lelaki Biasa</th>
                            <th>Anggota Lelaki L.Biasa</th>
                            <th>Anggota Perempuan Biasa</th>
                            <th>Anggota Perempuan L.Biasa</th>
                            <th>Total Anggota</th>
                            <th>ASET</th>
                            <th>Aktiva LANCAR</th>
                            <th>Simpanan Saham(SP+SW)</th>
                            <th>Simpanan Non-Saham Unggulan</th>
                            <th>Simpanan Non-Saham Harian & Deposito</th>
                            <th>Hutang SPD</th>
                            <th>Piutang Beredar</th>
                            <th>Piutang Bersih</th>
                            <th>Piutang Lalai 1-12 Bulan</th>
                            <th>Piutang Lalai > 12 Bulan</th>
                            <th>Rasio Piutang Beredar</th>
                            <th>Rasio Piutang Lalai</th>
                            <th>DCR</th>
                            <th>DCU</th>
                            <th>Total Pendapatan</th>
                            <th>Total Biaya</th>
                            <th>SHU</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($wilayahs as $data)
                            <?php
                                $total = $data['l_biasa'] + $data['l_lbiasa'] + $data['p_biasa'] + $data['p_lbiasa'];
                                $piutangbersih = $data['piutangberedar'] - ($data['piutanglalai_1bulan'] + $data['piutanglalai_12bulan']);
                                $data['aset'] == 0 ? $rasio_beredar = 0 : $rasio_beredar =  ($data['piutangberedar'] / $data['aset']);
                                $data['piutangberedar'] == 0 ? $rasio_lalai = 0 : $rasio_lalai = ($data['piutanglalai_1bulan'] + $data['piutanglalai_12bulan']) / $data['piutangberedar'];
                            ?>
                            <tr >
                                <td class="bg-blue disabled color-palette"></td>
                                <td>{{ $data['nama'] }}</td>
                                <td>{{ $data['cu'] }}</td>
                                <td>{{ number_format($data['l_biasa'],"0",",",".") }}</td>
                                <td>{{ number_format($data['l_lbiasa'],"0",",",".") }}</td>
                                <td>{{ number_format($data['p_biasa'],"0",",",".") }}</td>
                                <td>{{ number_format($data['p_lbiasa'],"0",",",".") }}</td>
                                <td>{{ number_format($total,"0",",",".") }}</td>
                                <td>{{ number_format($data['aset'],"0",",",".") }}</td>
                                <td>{{ number_format($data['aktivalancar'],"0",",",".") }}</td>
                                <td>{{ number_format($data['simpanansaham'],"0",",",".") }}</td>
                                <td>{{ number_format($data['nonsaham_unggulan'],"0",",",".") }}</td>
                                <td>{{ number_format($data['nonsaham_harian'],"0",",",".") }}</td>
                                <td>{{ number_format($data['hutangspd'],"0",",",".") }}</td>
                                <td>{{ number_format($data['piutangberedar'],"0",",",".") }}</td>
                                <td>{{ number_format($data['piutanglalai_1bulan'],"0",",",".") }}</td>
                                <td>{{ number_format($data['piutanglalai_12bulan'],"0",",",".") }}</td>
                                <td>{{ number_format($piutangbersih,"0",",",".") }}</td>
                                <td>{{ number_format(($rasio_beredar*100),2) }} %</td>
                                <td>{{ number_format(($rasio_lalai*100),2) }} %</td>
                                <td>{{ number_format($data['dcr'],"0",",",".") }}</td>
                                <td>{{ number_format($data['dcu'],"0",",",".") }}</td>
                                <td>{{ number_format($data['totalpendapatan'],"0",",",".") }}</td>
                                <td>{{ number_format($data['totalbiaya'],"0",",",".") }}</td>
                                <td>{{ number_format($data['shu'],"0",",",".") }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane" id="tab_do">
                    <table class="table table-hover table-bordered" id="dataTables-do" width="100%">
                        <thead class="bg-light-blue-active color-palette">
                        <tr>
                            <th data-sortable="false">#</th>
                            <th>District Office</th>
                            <th>CU</th>
                            <th>Anggota Lelaki Biasa</th>
                            <th>Anggota Lelaki L.Biasa</th>
                            <th>Anggota Perempuan Biasa</th>
                            <th>Anggota Perempuan L.Biasa</th>
                            <th>Total Anggota</th>
                            <th>ASET</th>
                            <th>Aktiva LANCAR</th>
                            <th>Simpanan Saham(SP+SW)</th>
                            <th>Simpanan Non-Saham Unggulan</th>
                            <th>Simpanan Non-Saham Harian & Deposito</th>
                            <th>Hutang SPD</th>
                            <th>Piutang Beredar</th>
                            <th>Piutang Bersih</th>
                            <th>Piutang Lalai 1-12 Bulan</th>
                            <th>Piutang Lalai > 12 Bulan</th>
                            <th>Rasio Piutang Beredar</th>
                            <th>Rasio Piutang Lalai</th>
                            <th>DCR</th>
                            <th>DCU</th>
                            <th>Total Pendapatan</th>
                            <th>Total Biaya</th>
                            <th>SHU</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($dos as $data)
                            <?php
                                $total = $data['l_biasa'] + $data['l_lbiasa'] + $data['p_biasa'] + $data['p_lbiasa'];
                                $piutangbersih = $data['piutangberedar'] - ($data['piutanglalai_1bulan'] + $data['piutanglalai_12bulan']);
                                $data['aset'] == 0 ? $rasio_beredar = 0 : $rasio_beredar =  ($data['piutangberedar'] / $data['aset']);
                                $data['piutangberedar'] == 0 ? $rasio_lalai = 0 : $rasio_lalai = ($data['piutanglalai_1bulan'] + $data['piutanglalai_12bulan']) / $data['piutangberedar'];
                            ?>
                            <tr >
                                <td class="bg-blue disabled color-palette"></td>
                                <td>{{ $data['nama'] }}</td>
                                <td>{{ $data['cu'] }}</td>
                                <td>{{ number_format($data['l_biasa'],"0",",",".") }}</td>
                                <td>{{ number_format($data['l_lbiasa'],"0",",",".")}}</td>
                                <td>{{ number_format($data['p_biasa'],"0",",",".") }}</td>
                                <td>{{ number_format($data['p_lbiasa'],"0",",",".") }}</td>
                                <td>{{ number_format($total,"0",",",".") }}</td>
                                <td>{{ number_format($data['aset'],"0",",",".") }}</td>
                                <td>{{ number_format($data['aktivalancar'],"0",",",".") }}</td>
                                <td>{{ number_format($data['simpanansaham'],"0",",",".") }}</td>
                                <td>{{ number_format($data['nonsaham_unggulan'],"0",",",".") }}</td>
                                <td>{{ number_format($data['nonsaham_harian'],"0",",",".") }}</td>
                                <td>{{ number_format($data['hutangspd'],"0",",",".") }}</td>
                                <td>{{ number_format($data['piutangberedar'],"0",",",".") }}</td>
                                <td>{{ number_format($data['piutanglalai_1bulan'],"0",",",".") }}</td>
                                <td>{{ number_format($data['piutanglalai_12bulan'],"0",",",".") }}</td>
                                <td>{{ number_format($piutangbersih,"0",",",".") }}</td>
                                <td>{{ number_format(($rasio_beredar*100),2) }} %</td>
                                <td>{{ number_format(($rasio_lalai*100),2) }} %</td>
                                <td>{{ number_format($data['dcr'],"0",",",".") }}</td>
                                <td>{{ number_format($data['dcr'],"0",",",".") }}</td>
                                <td>{{ number_format($data['totalpendapatan'],"0",",",".") }}</td>
                                <td>{{ number_format($data['totalbiaya'],"0",",",".") }}</td>
                                <td>{{ number_format($data['shu'],"0",",",".") }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @elseif(Request::is('admins/laporancu/index_cu*') || Request::is('admins/laporancu/index_bkcu'))
                <div class="tab-pane active" id="tab_konsolidasi">
                    <div class="input-group tabletools">
                        <div class="input-group-addon"><i class="fa fa-search"></i></div>
                        <input type="text" id="searchtextkonsolidasi" class="form-control" placeholder="Kata kunci pencarian...">
                    </div>
                    <table class="table table-hover table-bordered" id="dataTables-konsolidasi" width="100%" >
                        <thead class="bg-light-blue-active color-palette">
                            <tr>
                                <th data-sortable="false" >#</th>
                                @if(Request::is('admins/laporancu/index_cu/*'))
                                    <th hidden></th>
                                @endif
                                <th>Periode Laporan</th>
                                @if(!Request::is('admins/laporancu/index_cu/*'))
                                    <th>CU</th>
                                    <th>CU Tepat Waktu</th>
                                @endif
                                <th>Anggota Lelaki Biasa</th>
                                <th>Anggota Lelaki L.Biasa</th>
                                <th>Anggota Perempuan Biasa</th>
                                <th>Anggota Perempuan L.Biasa</th>
                                <th>Total Anggota</th>
                                <th>ASET</th>
                                <th>Aktiva LANCAR</th>
                                <th>Simpanan Saham(SP+SW)</th>
                                <th>Simpanan Non-Saham Unggulan</th>
                                <th>Simpanan Non-Saham Harian & Deposito</th>
                                <th>Hutang SPD</th>
                                <th>Piutang Beredar</th>
                                <th>Piutang Bersih</th>
                                <th>Piutang Lalai 1-12 Bulan</th>
                                <th>Piutang Lalai > 12 Bulan</th>
                                <th>Rasio Piutang Beredar</th>
                                <th>Rasio Piutang Lalai</th>
                                <th>DCR</th>
                                <th>DCU</th>
                                <th>Total Pendapatan</th>
                                <th>Total Biaya</th>
                                <th>SHU</th>
                                @if(Request::is('admins/laporancu/index_cu/*'))
                                    <th>Tgl. Terima</th>
                                    <th>Tgl. Ubah</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $l_biasa2 = 0;
                                $l_lbiasa2 = 0;
                                $p_biasa2 = 0;
                                $p_lbiasa2 = 0;
                                $total2 = 0;
                                $aset2 = 0;
                                $aktivalancar2 = 0;
                                $simpanansaham2 = 0;
                                $nonsaham_unggulan2 = 0;
                                $nonsaham_harian2 = 0;
                                $hutangspd2 = 0;
                                $piutangberedar2 = 0;
                                $piutanglalai_1bulan2 = 0;
                                $piutanglalai_12bulan2 = 0;
                                $piutangbersih2 = 0;
                                $rasio_beredar2 = 0;
                                $rasio_lalai2 = 0;
                                $dcr2 = 0;
                                $dcu2 = 0;
                                $totalpendapatan2 = 0;
                                $totalbiaya2 = 0;
                                $shu2 = 0;
                            ?>
                            @foreach($datas2 as $data)
                                <?php
                                    $total = $data['l_biasa'] + $data['l_lbiasa'] + $data['p_biasa'] + $data['p_lbiasa'];
                                    $piutangbersih = $data['piutangberedar'] - ($data['piutanglalai_1bulan'] + $data['piutanglalai_12bulan']);
                                    $data['aset'] == 0 ? $rasio_beredar = 0 : $rasio_beredar =  ($data['piutangberedar'] / $data['aset']);
                                    $data['piutangberedar'] == 0 ? $rasio_lalai = 0 : $rasio_lalai = ($data['piutanglalai_1bulan'] + $data['piutanglalai_12bulan']) / $data['piutangberedar'];
                                    $date = new Date($data['periode']);
                                    $periode = $date->format('F Y');

                                    if(Request::is('admins/laporancu/index_cu/*')){
                                        if(empty($data['created_at'])){
                                            $created = "-";
                                        }else{
                                            $date2 = new Date($data['created_at']);
                                            $created = $date2->format('d/m/Y');
                                        }
                                        if(empty($data['updated_at'])){
                                            $updated = "-";
                                        }else{
                                            $date3 = new Date($data['updated_at']);
                                            $updated = $date3->format('d/m/Y');
                                        }
                                    }

                                    $l_biasa1 = $data['l_biasa'] - $l_biasa2;
                                    $l_lbiasa1 = $data['l_lbiasa'] - $l_lbiasa2;
                                    $p_biasa1 = $data['p_biasa'] - $p_biasa2;
                                    $p_lbiasa1 = $data['p_lbiasa'] - $p_lbiasa2;
                                    $total1 = $total - $total2;
                                    $aset1 = $data['aset'] - $aset2;
                                    $aktivalancar1 = $data['aktivalancar'] - $aktivalancar2;
                                    $simpanansaham1 = $data['simpanansaham'] - $simpanansaham2;
                                    $nonsaham_unggulan1 = $data['nonsaham_unggulan'] - $nonsaham_unggulan2;
                                    $nonsaham_harian1 = $data['nonsaham_harian'] - $nonsaham_harian2;
                                    $hutangspd1 = $data['hutangspd'] - $hutangspd2;
                                    $piutangberedar1 = $data['piutangberedar'] - $piutangberedar2;
                                    $piutanglalai_1bulan1 = $data['piutanglalai_1bulan'] - $piutanglalai_1bulan2;
                                    $piutanglalai_12bulan1 = $data['piutanglalai_12bulan'] - $piutanglalai_12bulan2;
                                    $piutangbersih1 = $piutangbersih - $piutangbersih2;
                                    $rasio_beredar1 = $rasio_beredar - $rasio_beredar2;
                                    $rasio_lalai1 = $rasio_lalai - $rasio_lalai2;
                                    $dcr1 = $data['dcr'] - $dcr2;
                                    $dcu1 = $data['dcu'] - $dcu2;
                                    $totalpendapatan1 = $data['totalpendapatan'] - $totalpendapatan2;
                                    $totalbiaya1 = $data['totalbiaya'] - $totalbiaya2;
                                    $shu1 = $data['shu'] - $shu2;
                                ?>
                                <tr >
                                    <td class="bg-blue disabled color-palette"></td>
                                    @if(Request::is('admins/laporancu/index_cu/*'))
                                        <td hidden>{{ $data['id'] }}</td>
                                    @endif
                                    <td data-order="{{ $data['periode'] }}">
                                        {{ $periode }} 
                                        @if(!empty($data['diskusi']))
                                            <i class="fa fa-comments-o text-aqua" data-toggle="tooltip" data-placement="right" title="Terdapat diskusi pada laporan periode ini. Silahkan tekan tombol detail untuk melihat."></i>   
                                        @endif
                                    </td>
                                    @if(!Request::is('admins/laporancu/index_cu/*'))
                                        <td>{{ $data['tot_cu'] }}</td>
                                        <td>{{ $data['tot_culaporan'] }}</td>
                                    @endif
                                    <td>{{ number_format($data['l_biasa'],"0",",",".") }}
                                        @if($l_biasa1 != $data['l_biasa'])
                                            @if($l_biasa1 > 0)
                                                <i class="fa fa-caret-square-o-up fa-fw text-aqua" data-toggle="tooltip" data-placement="right" title="Bertambah {{ number_format($l_biasa1,"0",",",".")}}"></i>
                                            @elseif($l_biasa1 < 0)
                                                <i class="fa fa-caret-square-o-down fa-fw text-red" data-toggle="tooltip" data-placement="right" title="Berkurang {{ number_format(abs($l_biasa1),"0",",",".")}}"></i>
                                            @endif
                                        @endif
                                    </td>
                                    <td>{{ number_format($data['l_lbiasa'],"0",",",".")}}
                                        @if($l_lbiasa1 != $data['l_lbiasa'])
                                            @if($l_lbiasa1 > 0)
                                                <i class="fa fa-caret-square-o-up fa-fw text-aqua" data-toggle="tooltip" data-placement="right" title="Bertambah {{ number_format($l_lbiasa1,"0",",",".")}}"></i>
                                            @elseif($l_lbiasa1 < 0)
                                                <i class="fa fa-caret-square-o-down fa-fw text-red" data-toggle="tooltip" data-placement="right" title="Berkurang {{ number_format(abs($l_lbiasa1),"0",",",".")}}"></i>
                                            @endif
                                        @endif
                                    </td>
                                    <td>{{ number_format($data['p_biasa'],"0",",",".") }}
                                        @if($p_biasa1 != $data['p_biasa'])
                                            @if($p_biasa1 > 0)
                                                <i class="fa fa-caret-square-o-up fa-fw text-aqua" data-toggle="tooltip" data-placement="right" title="Bertambah {{ number_format($p_biasa1,"0",",",".")}}"></i>
                                            @elseif($p_biasa1 < 0)
                                                <i class="fa fa-caret-square-o-down fa-fw text-red" data-toggle="tooltip" data-placement="right" title="Berkurang {{ number_format(abs($p_biasa1),"0",",",".")}}"></i>
                                            @endif
                                        @endif
                                    </td>
                                    <td>{{ number_format($data['p_lbiasa'],"0",",",".") }}
                                        @if($p_lbiasa1 != $data['p_lbiasa'])
                                            @if($p_lbiasa1 > 0)
                                                <i class="fa fa-caret-square-o-up fa-fw text-aqua" data-toggle="tooltip" data-placement="right" title="Bertambah {{ number_format($p_lbiasa1,"0",",",".")}}"></i>
                                            @elseif($p_lbiasa1 < 0)
                                                <i class="fa fa-caret-square-o-down fa-fw text-red" data-toggle="tooltip" data-placement="right" title="Berkurang {{ number_format(abs($p_lbiasa1),"0",",",".")}}"></i>
                                            @endif
                                        @endif
                                    </td>
                                    <td>{{ number_format($total,"0",",",".") }}
                                        @if($total1 != $total)
                                            @if($total1 > 0)
                                                <i class="fa fa-caret-square-o-up fa-fw text-aqua" data-toggle="tooltip" data-placement="right" title="Bertambah {{ number_format($total1,"0",",",".")}}"></i>
                                            @elseif($total1 < 0)
                                                <i class="fa fa-caret-square-o-down fa-fw text-red" data-toggle="tooltip" data-placement="right" title="Berkurang {{ number_format(abs($total1),"0",",",".")}}"></i>
                                            @endif
                                        @endif
                                    </td>
                                    <td>{{ number_format($data['aset'],"0",",",".") }}
                                        @if($aset1 != $data['aset'])
                                            @if($aset1 > 0)
                                                <i class="fa fa-caret-square-o-up fa-fw text-aqua" data-toggle="tooltip" data-placement="right" title="Bertambah {{ number_format($aset1,"0",",",".")}}"></i>
                                            @elseif($aset1 < 0)
                                                <i class="fa fa-caret-square-o-down fa-fw text-red" data-toggle="tooltip" data-placement="right" title="Berkurang {{ number_format(abs($aset1),"0",",",".")}}"></i>
                                            @endif
                                        @endif
                                    </td>
                                    <td>{{ number_format($data['aktivalancar'],"0",",",".") }}
                                        @if($aktivalancar1 != $data['aktivalancar'])
                                            @if($aktivalancar1 > 0)
                                                <i class="fa fa-caret-square-o-up fa-fw text-aqua" data-toggle="tooltip" data-placement="right" title="Bertambah {{ number_format($aktivalancar1,"0",",",".")}}"></i>
                                            @elseif($aktivalancar1 < 0)
                                                <i class="fa fa-caret-square-o-down fa-fw text-red" data-toggle="tooltip" data-placement="right" title="Berkurang {{ number_format(abs($aktivalancar1),"0",",",".")}}"></i>
                                            @endif
                                        @endif
                                    </td>
                                    <td>{{ number_format($data['simpanansaham'],"0",",",".") }}
                                        @if($simpanansaham1 != $data['simpanansaham'])
                                            @if($simpanansaham1 > 0)
                                                <i class="fa fa-caret-square-o-up fa-fw text-aqua" data-toggle="tooltip" data-placement="right" title="Bertambah {{ number_format($simpanansaham1,"0",",",".")}}"></i>
                                            @elseif($simpanansaham1 < 0)
                                                <i class="fa fa-caret-square-o-down fa-fw text-red" data-toggle="tooltip" data-placement="right" title="Berkurang {{ number_format(abs($simpanansaham1),"0",",",".")}}"></i>
                                            @endif
                                        @endif
                                    </td>
                                    <td>{{ number_format($data['nonsaham_unggulan'],"0",",",".") }}
                                        @if($nonsaham_unggulan1 != $data['nonsaham_unggulan'])
                                            @if($nonsaham_unggulan1 > 0)
                                                <i class="fa fa-caret-square-o-up fa-fw text-aqua" data-toggle="tooltip" data-placement="right" title="Bertambah {{ number_format($nonsaham_unggulan1,"0",",",".")}}"></i>
                                            @elseif($nonsaham_unggulan1 < 0)
                                                <i class="fa fa-caret-square-o-down fa-fw text-red" data-toggle="tooltip" data-placement="right" title="Berkurang {{ number_format(abs($nonsaham_unggulan1),"0",",",".")}}"></i>
                                            @endif
                                        @endif
                                    </td>
                                    <td>{{ number_format($data['nonsaham_harian'],"0",",",".") }}
                                        @if($nonsaham_harian1 != $data['nonsaham_harian'])
                                            @if($nonsaham_harian1 > 0)
                                                <i class="fa fa-caret-square-o-up fa-fw text-aqua" data-toggle="tooltip" data-placement="right" title="Bertambah {{ number_format($nonsaham_harian1,"0",",",".")}}"></i>
                                            @elseif($nonsaham_harian1 < 0)
                                                <i class="fa fa-caret-square-o-down fa-fw text-red" data-toggle="tooltip" data-placement="right" title="Berkurang {{ number_format(abs($nonsaham_harian1),"0",",",".")}}"></i>
                                            @endif
                                        @endif
                                    </td>
                                    <td>{{ number_format($data['hutangspd'],"0",",",".") }}
                                        @if($hutangspd1 != $data['hutangspd'])
                                            @if($hutangspd1 > 0)
                                                <i class="fa fa-caret-square-o-up fa-fw text-aqua" data-toggle="tooltip" data-placement="right" title="Bertambah {{ number_format($hutangspd1,"0",",",".")}}"></i>
                                            @elseif($hutangspd1 < 0)
                                                <i class="fa fa-caret-square-o-down fa-fw text-red" data-toggle="tooltip" data-placement="right" title="Berkurang {{ number_format(abs($hutangspd1),"0",",",".")}}"></i>
                                            @endif
                                        @endif
                                    </td>
                                    <td>{{ number_format($data['piutangberedar'],"0",",",".") }}
                                        @if($piutangberedar1 != $data['piutangberedar'])
                                            @if($piutangberedar1 > 0)
                                                <i class="fa fa-caret-square-o-up fa-fw text-aqua" data-toggle="tooltip" data-placement="right" title="Bertambah {{ number_format($piutangberedar1,"0",",",".")}}"></i>
                                            @elseif($piutangberedar1 < 0)
                                                <i class="fa fa-caret-square-o-down fa-fw text-red" data-toggle="tooltip" data-placement="right" title="Berkurang {{ number_format(abs($piutangberedar1),"0",",",".")}}"></i>
                                            @endif
                                        @endif
                                    </td>
                                    <td>{{ number_format($data['piutanglalai_1bulan'],"0",",",".") }}
                                        @if($piutanglalai_1bulan1 != $data['piutanglalai_1bulan'])
                                            @if($piutanglalai_1bulan1 > 0)
                                                <i class="fa fa-caret-square-o-up fa-fw text-aqua" data-toggle="tooltip" data-placement="right" title="Bertambah {{ number_format($piutanglalai_1bulan1,"0",",",".")}}"></i>
                                            @elseif($piutanglalai_1bulan1 < 0)
                                                <i class="fa fa-caret-square-o-down fa-fw text-red" data-toggle="tooltip" data-placement="right" title="Berkurang {{ number_format(abs($piutanglalai_1bulan1),"0",",",".")}}"></i>
                                            @endif
                                        @endif
                                    </td>
                                    <td>{{ number_format($data['piutanglalai_12bulan'],"0",",",".") }}
                                        @if($piutanglalai_12bulan1 != $data['piutanglalai_12bulan'])
                                            @if($piutanglalai_12bulan1 > 0)
                                                <i class="fa fa-caret-square-o-up fa-fw text-aqua" data-toggle="tooltip" data-placement="right" title="Bertambah {{ number_format($piutanglalai_12bulan1,"0",",",".")}}"></i>
                                            @elseif($piutanglalai_12bulan1 < 0)
                                                <i class="fa fa-caret-square-o-down fa-fw text-red" data-toggle="tooltip" data-placement="right" title="Berkurang {{ number_format(abs($piutanglalai_12bulan1),"0",",",".")}}"></i>
                                            @endif
                                        @endif
                                    </td>
                                    <td>{{ number_format($piutangbersih,"0",",",".") }}
                                        @if($piutangbersih1 != $piutangbersih)
                                            @if($piutangbersih1 > 0)
                                                <i class="fa fa-caret-square-o-up fa-fw text-aqua" data-toggle="tooltip" data-placement="right" title="Bertambah {{ number_format($piutangbersih1,"0",",",".")}}"></i>
                                            @elseif($piutangbersih1 < 0)
                                                <i class="fa fa-caret-square-o-down fa-fw text-red" data-toggle="tooltip" data-placement="right" title="Berkurang {{ number_format(abs($piutangbersih1),"0",",",".")}}"></i>
                                            @endif
                                        @endif
                                    </td>
                                    <td>{{ number_format(($rasio_beredar*100),2) }} %
                                        @if($rasio_beredar1 != $rasio_beredar)
                                            @if($rasio_beredar1 > 0)
                                                <i class="fa fa-caret-square-o-up fa-fw text-aqua" data-toggle="tooltip" data-placement="right" title="Bertambah {{ number_format(($rasio_beredar1*100),2) }} %"></i>
                                            @elseif($rasio_beredar1 < 0)
                                                <i class="fa fa-caret-square-o-down fa-fw text-red" data-toggle="tooltip" data-placement="right" title="Berkurang {{ number_format((abs($rasio_beredar1)*100),2) }} %"></i>
                                            @endif
                                        @endif
                                    </td>
                                    <td>{{ number_format(($rasio_lalai*100),2) }} %
                                        @if($rasio_lalai1 != $rasio_lalai)
                                            @if($rasio_lalai1 > 0)
                                                <i class="fa fa-caret-square-o-up fa-fw text-aqua" data-toggle="tooltip" data-placement="right" title="Bertambah {{ number_format(($rasio_lalai1*100),2) }} %"></i>
                                            @elseif($rasio_lalai1 < 0)
                                                <i class="fa fa-caret-square-o-down fa-fw text-red" data-toggle="tooltip" data-placement="right" title="Berkurang {{ number_format((abs($rasio_lalai1)*100),2) }} %"></i>
                                            @endif
                                        @endif
                                    </td>
                                    <td>{{ number_format($data['dcr'],"0",",",".") }}
                                        @if($dcr1 != $data['dcr'])
                                            @if($dcr1 > 0)
                                                <i class="fa fa-caret-square-o-up fa-fw text-aqua" data-toggle="tooltip" data-placement="right" title="Bertambah {{ number_format($dcr1,"0",",",".")}}"></i>
                                            @elseif($dcr1 < 0)
                                                <i class="fa fa-caret-square-o-down fa-fw text-red" data-toggle="tooltip" data-placement="right" title="Berkurang {{ number_format(abs($dcr1),"0",",",".")}}"></i>
                                            @endif
                                        @endif
                                    </td>
                                    <td>{{ number_format($data['dcu'],"0",",",".") }}
                                        @if($dcu1 != $data['dcu'])
                                            @if($dcu1 > 0)
                                                <i class="fa fa-caret-square-o-up fa-fw text-aqua" data-toggle="tooltip" data-placement="right" title="Bertambah {{ number_format($dcu1,"0",",",".")}}"></i>
                                            @elseif($dcu1 < 0)
                                                <i class="fa fa-caret-square-o-down fa-fw text-red" data-toggle="tooltip" data-placement="right" title="Berkurang {{ number_format(abs($dcu1),"0",",",".")}}"></i>
                                            @endif
                                        @endif
                                    </td>
                                    <td>{{ number_format($data['totalpendapatan'],"0",",",".") }}
                                        @if($totalpendapatan1 != $data['totalpendapatan'])
                                            @if($totalpendapatan1 > 0)
                                                <i class="fa fa-caret-square-o-up fa-fw text-aqua" data-toggle="tooltip" data-placement="right" title="Bertambah {{ number_format($totalpendapatan1,"0",",",".")}}"></i>
                                            @elseif($totalpendapatan1 < 0)
                                                <i class="fa fa-caret-square-o-down fa-fw text-red" data-toggle="tooltip" data-placement="right" title="Berkurang {{ number_format(abs($totalpendapatan1),"0",",",".")}}"></i>
                                            @endif
                                        @endif
                                    </td>
                                    <td>{{ number_format($data['totalbiaya'],"0",",",".") }}
                                        @if($totalbiaya1 != $data['totalbiaya'])
                                            @if($totalbiaya1 > 0)
                                                <i class="fa fa-caret-square-o-up fa-fw text-aqua" data-toggle="tooltip" data-placement="right" title="Bertambah {{ number_format($totalbiaya1,"0",",",".")}}"></i>
                                            @elseif($totalbiaya1 < 0)
                                                <i class="fa fa-caret-square-o-down fa-fw text-red" data-toggle="tooltip" data-placement="right" title="Berkurang {{ number_format(abs($totalbiaya1),"0",",",".")}}"></i>
                                            @endif
                                        @endif
                                    </td>
                                    <td>{{ number_format($data['shu'],"0",",",".") }}
                                        @if($shu1 != $data['shu'])
                                            @if($shu1 > 0)
                                                <i class="fa fa-caret-square-o-up fa-fw text-aqua" data-toggle="tooltip" data-placement="right" title="Bertambah {{ number_format($shu1,"0",",",".")}}"></i>
                                            @elseif($shu1 < 0)
                                                <i class="fa fa-caret-square-o-down fa-fw text-red" data-toggle="tooltip" data-placement="right" title="Berkurang {{ number_format(abs($shu1),"0",",",".")}}"></i>
                                            @endif
                                        @endif
                                    </td>
                                    @if(Request::is('admins/laporancu/index_cu/*'))
                                        <td>{{ $created }}</td>
                                        <td>{{ $updated }}</td>
                                    @endif
                                </tr>
                                <?php
                                   $l_biasa2= $data['l_biasa'];
                                   $l_lbiasa2= $data['l_lbiasa'];
                                   $p_biasa2= $data['p_biasa'];
                                   $p_lbiasa2= $data['p_lbiasa'];
                                   $total2= $total;
                                   $aset2= $data['aset'];
                                   $aktivalancar2= $data['aktivalancar'];
                                   $simpanansaham2= $data['simpanansaham'];
                                   $nonsaham_unggulan2= $data['nonsaham_unggulan'];
                                   $hutangspd2= $data['hutangspd'];
                                   $piutangberedar2= $data['piutangberedar'];
                                   $piutanglalai_1bulan2= $data['piutanglalai_1bulan'];
                                   $piutanglalai_12bulan2= $data['piutanglalai_12bulan'];
                                   $piutangbersih2= $piutangbersih;
                                   $rasio_beredar2= $rasio_beredar;
                                   $rasio_lalai2= $rasio_lalai;
                                   $dcr2= $data['dcr'];
                                   $dcu2= $data['dcu'];
                                   $totalpendapatan2= $data['totalpendapatan'];
                                   $totalbiaya2= $data['totalbiaya'];
                                   $shu2= $data['shu'];
                                ?>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane " id="tab_pertumbuhan">
                    <div class="input-group tabletools">
                        <div class="input-group-addon"><i class="fa fa-search"></i></div>
                        <input type="text" id="searchtextdo" class="form-control" placeholder="Kata kunci pencarian...">
                    </div>
                    <table class="table table-hover table-bordered" id="dataTables-do" width="100%" >
                        <thead class="bg-light-blue-active color-palette">
                            <tr>
                                <th data-sortable="false" >#</th>
                                <th>Periode Laporan</th>
                                <th>Anggota Lelaki Biasa</th>
                                <th>Anggota Lelaki L.Biasa</th>
                                <th>Anggota Perempuan Biasa</th>
                                <th>Anggota Perempuan L.Biasa</th>
                                <th>Total Anggota</th>
                                <th>ASET</th>
                                <th>Aktiva LANCAR</th>
                                <th>Simpanan Saham(SP+SW)</th>
                                <th>Simpanan Non-Saham Unggulan</th>
                                <th>Simpanan Non-Saham Harian & Deposito</th>
                                <th>Hutang SPD</th>
                                <th>Piutang Beredar</th>
                                <th>Piutang Bersih</th>
                                <th>Piutang Lalai 1-12 Bulan</th>
                                <th>Piutang Lalai > 12 Bulan</th>
                                <th>Rasio Piutang Beredar</th>
                                <th>Rasio Piutang Lalai</th>
                                <th>DCR</th>
                                <th>DCU</th>
                                <th>Total Pendapatan</th>
                                <th>Total Biaya</th>
                                <th>SHU</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $l_biasa2 = 0;
                                $l_lbiasa2 = 0;
                                $p_biasa2 = 0;
                                $p_lbiasa2 = 0;
                                $total2 = 0;
                                $aset2 = 0;
                                $aktivalancar2 = 0;
                                $simpanansaham2 = 0;
                                $nonsaham_unggulan2 = 0;
                                $nonsaham_harian2 = 0;
                                $hutangspd2 = 0;
                                $piutangberedar2 = 0;
                                $piutanglalai_1bulan2 = 0;
                                $piutanglalai_12bulan2 = 0;
                                $piutangbersih2 = 0;
                                $rasio_beredar2 = 0;
                                $rasio_lalai2 = 0;
                                $dcr2 = 0;
                                $dcu2 = 0;
                                $totalpendapatan2 = 0;
                                $totalbiaya2 = 0;
                                $shu2 = 0;

                                $i = 0;
                            ?>
                            @foreach($datas2 as $data)
                                <?php
                                    $total = $data['l_biasa'] + $data['l_lbiasa'] + $data['p_biasa'] + $data['p_lbiasa'];
                                    $piutangbersih = $data['piutangberedar'] - ($data['piutanglalai_1bulan'] + $data['piutanglalai_12bulan']);
                                    $data['aset'] == 0 ? $rasio_beredar = 0 : $rasio_beredar =  ($data['piutangberedar'] / $data['aset']);
                                    $data['piutangberedar'] == 0 ? $rasio_lalai = 0 : $rasio_lalai = ($data['piutanglalai_1bulan'] + $data['piutanglalai_12bulan']) / $data['piutangberedar'];
                                    $date = new Date($data['periode']);
                                    $periode = $date->format('F Y');

                                    $l_biasa1 = $data['l_biasa'] - $l_biasa2;
                                    $l_lbiasa1 = $data['l_lbiasa'] - $l_lbiasa2;
                                    $p_biasa1 = $data['p_biasa'] - $p_biasa2;
                                    $p_lbiasa1 = $data['p_lbiasa'] - $p_lbiasa2;
                                    $total1 = $total - $total2;
                                    $aset1 = $data['aset'] - $aset2;
                                    $aktivalancar1 = $data['aktivalancar'] - $aktivalancar2;
                                    $simpanansaham1 = $data['simpanansaham'] - $simpanansaham2;
                                    $nonsaham_unggulan1 = $data['nonsaham_unggulan'] - $nonsaham_unggulan2;
                                    $nonsaham_harian1 = $data['nonsaham_harian'] - $nonsaham_harian2;
                                    $hutangspd1 = $data['hutangspd'] - $hutangspd2;
                                    $piutangberedar1 = $data['piutangberedar'] - $piutangberedar2;
                                    $piutanglalai_1bulan1 = $data['piutanglalai_1bulan'] - $piutanglalai_1bulan2;
                                    $piutanglalai_12bulan1 = $data['piutanglalai_12bulan'] - $piutanglalai_12bulan2;
                                    $piutangbersih1 = $piutangbersih - $piutangbersih2;
                                    $rasio_beredar1 = $rasio_beredar - $rasio_beredar2;
                                    $rasio_lalai1 = $rasio_lalai - $rasio_lalai2;
                                    $dcr1 = $data['dcr'] - $dcr2;
                                    $dcu1 = $data['dcu'] - $dcu2;
                                    $totalpendapatan1 = $data['totalpendapatan'] - $totalpendapatan2;
                                    $totalbiaya1 = $data['totalbiaya'] - $totalbiaya2;
                                    $shu1 = $data['shu'] - $shu2;

                                    $l_biasa1 = $l_biasa1 !=  $data['l_biasa'] ? $l_biasa1 : 0;
                                    $l_lbiasa1 = $l_lbiasa1 !=  $data['l_lbiasa'] ? $l_lbiasa1 : 0;
                                    $p_biasa1 = $p_biasa1 !=  $data['p_biasa'] ? $p_biasa1 : 0;
                                    $p_lbiasa1 = $p_lbiasa1 !=  $data['p_lbiasa'] ? $p_lbiasa1 : 0;
                                    $total1 = $total1 !=  $total ? $total1 : 0;
                                    $aset1 = $aset1 !=  $data['aset'] ? $aset1 : 0;
                                    $aktivalancar1 = $aktivalancar1 !=  $data['aktivalancar'] ? $aktivalancar1 : 0;
                                    $simpanansaham1 = $simpanansaham1 !=  $data['simpanansaham'] ? $simpanansaham1 : 0;
                                    $nonsaham_unggulan1 = $nonsaham_unggulan1 !=  $data['nonsaham_unggulan'] ? $nonsaham_unggulan1 : 0;
                                    $nonsaham_harian1 = $nonsaham_harian1 !=  $data['nonsaham_harian'] ? $nonsaham_harian1 : 0;
                                    $hutangspd1 = $hutangspd1 !=  $data['hutangspd'] ? $hutangspd1 : 0;
                                    $piutangberedar1 = $piutangberedar1 !=  $data['piutangberedar'] ? $piutangberedar1 : 0;
                                    $piutanglalai_1bulan1 = $piutanglalai_1bulan1 !=  $data['piutanglalai_1bulan'] ? $piutanglalai_1bulan1 : 0;
                                    $piutanglalai_12bulan1 = $piutanglalai_12bulan1 !=  $data['piutanglalai_12bulan'] ? $piutanglalai_12bulan1 : 0;
                                    $piutangbersih1 = $piutangbersih1 !=  $piutangbersih ? $piutangbersih1 : 0;
                                    $rasio_beredar1 = $rasio_beredar1 !=  $rasio_beredar ? $rasio_beredar1 : 0;
                                    $rasio_lalai1 = $rasio_lalai1 !=  $rasio_lalai ? $rasio_lalai1 : 0;
                                    $dcr1 = $dcr1 !=  $data['dcr'] ? $dcr1 : 0;
                                    $dcu1 = $dcu1 !=  $data['dcu'] ? $dcu1 : 0;
                                    $totalpendapatan1 = $totalpendapatan1 !=  $data['totalpendapatan'] ? $totalpendapatan1 : 0;
                                    $totalbiaya1 = $totalbiaya1 !=  $data['totalbiaya'] ? $totalbiaya1 : 0;
                                    $shu1 = $shu1 !=  $data['shu'] ? $shu1 : 0;

                                    $datatumbuh[$i] = array(
                                        'nama' => $periode,
                                        'l_biasa' => $l_biasa1,
                                        'l_lbiasa' => $l_lbiasa1,
                                        'p_biasa' => $p_biasa1,
                                        'p_lbiasa' => $p_lbiasa1,
                                        'total' => $total1,
                                        'aset' => $aset1,
                                        'aktivalancar' => $aktivalancar1,
                                        'simpanansaham' => $simpanansaham1,
                                        'nonsaham_unggulan' => $nonsaham_unggulan1,
                                        'nonsaham_harian' => $nonsaham_harian1,
                                        'hutangspd' => $hutangspd1,
                                        'piutangberedar' => $piutangberedar1,
                                        'piutanglalai_1bulan' => $piutanglalai_1bulan1,
                                        'piutanglalai_12bulan' => $piutanglalai_12bulan1,
                                        'piutangbersih' => $piutangbersih1,
                                        'rasio_beredar' => $rasio_beredar1*100,
                                        'rasio_lalai' => $rasio_lalai1*100,
                                        'dcr' => $dcr1,
                                        'dcu' => $dcu1,
                                        'totalpendapatan' => $totalpendapatan1,
                                        'totalbiaya' => $totalbiaya1,
                                        'shu' => $shu1
                                    );

                                    $i++;
                                ?>
                                <tr >
                                    <td class="bg-blue disabled color-palette"></td>
                                    <td data-order="{{ $data['periode'] }}">{{ $periode }}</td>
                                    <td data-order="{{ $l_biasa1 }}">
                                        @if($l_biasa1 > 0)
                                            <i class="fa fa-caret-square-o-up text-aqua"></i> {{ number_format($l_biasa1,"0",",",".")}}
                                        @elseif($l_biasa1 < 0)
                                            <i class="fa fa-caret-square-o-down text-red"></i> {{ number_format(abs($l_biasa1),"0",",",".")}}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td data-order="{{ $l_lbiasa1 }}">
                                        @if($l_lbiasa1 > 0)
                                            <i class="fa fa-caret-square-o-up text-aqua"></i> {{ number_format($l_lbiasa1,"0",",",".")}}
                                        @elseif($l_lbiasa1 < 0)
                                            <i class="fa fa-caret-square-o-down text-red"></i> {{ number_format(abs($l_lbiasa1),"0",",",".")}}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td data-order="{{ $p_biasa1 }}">
                                        @if($p_biasa1 > 0)
                                            <i class="fa fa-caret-square-o-up text-aqua"></i> {{ number_format($p_biasa1,"0",",",".")}}
                                        @elseif($p_biasa1 < 0)
                                            <i class="fa fa-caret-square-o-down text-red"></i> {{ number_format(abs($p_biasa1),"0",",",".")}}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td data-order="{{ $p_lbiasa1 }}">
                                        @if($p_lbiasa1 > 0)
                                            <i class="fa fa-caret-square-o-up text-aqua"></i> {{ number_format($p_lbiasa1,"0",",",".")}}
                                        @elseif($p_lbiasa1 < 0)
                                            <i class="fa fa-caret-square-o-down text-red"></i> {{ number_format(abs($p_lbiasa1),"0",",",".")}}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td data-order="{{ $total1 }}">
                                        @if($total1 > 0)
                                            <i class="fa fa-caret-square-o-up text-aqua"></i> {{ number_format($total1,"0",",",".")}}
                                        @elseif($total1 < 0)
                                            <i class="fa fa-caret-square-o-down text-red"></i> {{ number_format(abs($total1),"0",",",".")}}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td data-order="{{ $aset1 }}">
                                        @if($aset1 > 0)
                                            <i class="fa fa-caret-square-o-up text-aqua"></i> {{ number_format($aset1,"0",",",".")}}
                                        @elseif($aset1 < 0)
                                            <i class="fa fa-caret-square-o-down text-red"></i> {{ number_format(abs($aset1),"0",",",".")}}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td data-order="{{ $aktivalancar1 }}">
                                        @if($aktivalancar1 > 0)
                                            <i class="fa fa-caret-square-o-up text-aqua"></i> {{ number_format($aktivalancar1,"0",",",".")}}
                                        @elseif($aktivalancar1 < 0)
                                            <i class="fa fa-caret-square-o-down text-red"></i> {{ number_format(abs($aktivalancar1),"0",",",".")}}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td data-order="{{ $simpanansaham1 }}">
                                        @if($simpanansaham1 > 0)
                                            <i class="fa fa-caret-square-o-up text-aqua"></i> {{ number_format($simpanansaham1,"0",",",".")}}
                                        @elseif($simpanansaham1 < 0)
                                            <i class="fa fa-caret-square-o-down text-red"></i> {{ number_format(abs($simpanansaham1),"0",",",".")}}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td data-order="{{ $nonsaham_unggulan1 }}">
                                        @if($nonsaham_unggulan1 > 0)
                                            <i class="fa fa-caret-square-o-up text-aqua"></i> {{ number_format($nonsaham_unggulan1,"0",",",".")}}
                                        @elseif($nonsaham_unggulan1 < 0)
                                            <i class="fa fa-caret-square-o-down text-red"></i> {{ number_format(abs($nonsaham_unggulan1),"0",",",".")}}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td data-order="{{ $nonsaham_harian1 }}">
                                        @if($nonsaham_harian1 > 0)
                                            <i class="fa fa-caret-square-o-up text-aqua"></i> {{ number_format($nonsaham_harian1,"0",",",".")}}
                                        @elseif($nonsaham_harian1 < 0)
                                            <i class="fa fa-caret-square-o-down text-red"></i> {{ number_format(abs($nonsaham_harian1),"0",",",".")}}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td data-order="{{ $hutangspd1 }}">
                                        @if($hutangspd1 > 0)
                                            <i class="fa fa-caret-square-o-up text-aqua"></i> {{ number_format($hutangspd1,"0",",",".")}}
                                        @elseif($hutangspd1 < 0)
                                            <i class="fa fa-caret-square-o-down text-red"></i> {{ number_format(abs($hutangspd1),"0",",",".")}}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td data-order="{{ $piutangberedar1 }}">
                                        @if($piutangberedar1 > 0)
                                            <i class="fa fa-caret-square-o-up text-aqua"></i> {{ number_format($piutangberedar1,"0",",",".")}}
                                        @elseif($piutangberedar1 < 0)
                                            <i class="fa fa-caret-square-o-down text-red"></i> {{ number_format(abs($piutangberedar1),"0",",",".")}}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td data-order="{{ $piutanglalai_1bulan1 }}">
                                        @if($piutanglalai_1bulan1 > 0)
                                            <i class="fa fa-caret-square-o-up text-aqua"></i> {{ number_format($piutanglalai_1bulan1,"0",",",".")}}
                                        @elseif($piutanglalai_1bulan1 < 0)
                                            <i class="fa fa-caret-square-o-down text-red"></i> {{ number_format(abs($piutanglalai_1bulan1),"0",",",".")}}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td data-order="{{ $piutanglalai_12bulan1 }}">
                                        @if($piutanglalai_12bulan1 > 0)
                                            <i class="fa fa-caret-square-o-up text-aqua"></i> {{ number_format($piutanglalai_12bulan1,"0",",",".")}}
                                        @elseif($piutanglalai_12bulan1 < 0)
                                            <i class="fa fa-caret-square-o-down text-red"></i> {{ number_format(abs($piutanglalai_12bulan1),"0",",",".")}}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td data-order="{{ $piutangbersih1 }}">
                                        @if($piutangbersih1 > 0)
                                            <i class="fa fa-caret-square-o-up text-aqua"></i> {{ number_format($piutangbersih1,"0",",",".")}}
                                        @elseif($piutangbersih1 < 0)
                                            <i class="fa fa-caret-square-o-down text-red"></i> {{ number_format(abs($piutangbersih1),"0",",",".")}}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td data-order="{{ $rasio_beredar1 }}">
                                        @if($rasio_beredar1 > 0)
                                            <i class="fa fa-caret-square-o-up text-aqua"></i> {{ number_format(($rasio_beredar1*100),2) }} %
                                        @elseif($rasio_beredar1 < 0)
                                            <i class="fa fa-caret-square-o-down text-red"></i> {{ number_format((abs($rasio_beredar1)*100),2) }} %
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td data-order="{{ $rasio_lalai1 }}">
                                        @if($rasio_lalai1 > 0)
                                            <i class="fa fa-caret-square-o-up text-aqua"></i> {{ number_format(($rasio_lalai1*100),2) }} %
                                        @elseif($rasio_lalai1 < 0)
                                            <i class="fa fa-caret-square-o-down text-red"></i> {{ number_format((abs($rasio_lalai1)*100),2) }} %
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td data-order="{{ $dcr1 }}">
                                        @if($dcr1 > 0)
                                            <i class="fa fa-caret-square-o-up text-aqua"></i> {{ number_format($dcr1,"0",",",".")}}
                                        @elseif($dcr1 < 0)
                                            <i class="fa fa-caret-square-o-down text-red"></i> {{ number_format(abs($dcr1),"0",",",".")}}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td data-order="{{ $dcu1 }}">
                                        @if($dcu1 > 0)
                                            <i class="fa fa-caret-square-o-up text-aqua"></i> {{ number_format($dcu1,"0",",",".")}}
                                        @elseif($dcu1 < 0)
                                            <i class="fa fa-caret-square-o-down text-red"></i> {{ number_format(abs($dcu1),"0",",",".")}}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td data-order="{{ $totalpendapatan1 }}">
                                        @if($totalpendapatan1 > 0)
                                            <i class="fa fa-caret-square-o-up text-aqua"></i> {{ number_format($totalpendapatan1,"0",",",".")}}
                                        @elseif($totalpendapatan1 < 0)
                                            <i class="fa fa-caret-square-o-down text-red"></i> {{ number_format(abs($totalpendapatan1),"0",",",".")}}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td data-order="{{ $totalbiaya1 }}">
                                        @if($totalbiaya1 > 0)
                                            <i class="fa fa-caret-square-o-up text-aqua"></i> {{ number_format($totalbiaya1,"0",",",".")}}
                                        @elseif($totalbiaya1 < 0)
                                            <i class="fa fa-caret-square-o-down text-red"></i> {{ number_format(abs($totalbiaya1),"0",",",".")}}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td data-order="{{ $shu1 }}">
                                        @if($shu1 > 0)
                                            <i class="fa fa-caret-square-o-up text-aqua"></i> {{ number_format($shu1,"0",",",".")}}
                                        @elseif($shu1 < 0)
                                            <i class="fa fa-caret-square-o-down text-red"></i> {{ number_format(abs($shu1),"0",",",".")}}
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                                 <?php
                                   $l_biasa2= $data['l_biasa'];
                                   $l_lbiasa2= $data['l_lbiasa'];
                                   $p_biasa2= $data['p_biasa'];
                                   $p_lbiasa2= $data['p_lbiasa'];
                                   $total2= $total;
                                   $aset2= $data['aset'];
                                   $aktivalancar2= $data['aktivalancar'];
                                   $simpanansaham2= $data['simpanansaham'];
                                   $nonsaham_unggulan2= $data['nonsaham_unggulan'];
                                   $hutangspd2= $data['hutangspd'];
                                   $piutangberedar2= $data['piutangberedar'];
                                   $piutanglalai_1bulan2= $data['piutanglalai_1bulan'];
                                   $piutanglalai_12bulan2= $data['piutanglalai_12bulan'];
                                   $piutangbersih2= $piutangbersih;
                                   $rasio_beredar2= $rasio_beredar;
                                   $rasio_lalai2= $rasio_lalai;
                                   $dcr2= $data['dcr'];
                                   $dcu2= $data['dcu'];
                                   $totalpendapatan2= $data['totalpendapatan'];
                                   $totalbiaya2= $data['totalbiaya'];
                                   $shu2= $data['shu'];
                                ?>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @elseif(Request::is('admins/laporancu/index_hapus'))
                <div class="tab-pane active" id="tab_hapus">
                    @include('admins.laporancu._component.table_hapus')
                </div>    
            @endif

            @if(!Request::is('admins/laporancu/index_bkcu') && !Request::is('admins/laporancu/index_hapus'))
                <div class="tab-pane" id="tab_pearls">
                    <div class="input-group tabletools">
                        <div class="input-group-addon"><i class="fa fa-search"></i></div>
                        <input type="text" id="searchtextpearls" class="form-control" placeholder="Kata kunci pencarian...">
                    </div>
                    <table class="table table-hover table-bordered" id="dataTables-pearls" width="100%" >
                        <thead class="bg-light-blue-active color-palette">
                            <tr>
                                <th data-sortable="false" >#</th>
                                <th hidden></th>
                                @if(!Request::is('admins/laporancu/index_cu/*'))<th>Credit Union</th>@endif
                                <th>Periode Laporan</th>
                                <th>Ideal</th>
                                <th>Tidak Ideal</th>
                                <th>P1 <small>(100%)</small></th>
                                <th>P2 <small>(&gt; 35%)</small></th>
                                <th>E1 <small>(70-80%)</small></th>
                                <th>E5 <small>(70-80%)</small></th>
                                <th>E6 <small>(&le; 5%)</small></th>
                                <th>E9 <small>(&ge; 10%)</small></th>
                                <th>A1 <small>(&le; 5%)</small></th>
                                <th>A2 <small>(&lt; 5%)</small></th>
                                <th>R7 <small>(= harga pasar)</small></th>
                                <th>R9 <small>(= 5%)</small></th>
                                <th>L1 <small>(15-20%)</small></th>
                                <th>S10 <small>(&gt; 12%)</small></th>
                                <th>S11 <small>(&gt; 10% + Laju Inflasi)</small></th>
                                <th>Harga Pasar</th>
                                <th>Laju Inflasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i =0; ?>
                            @foreach($datas as $data)
                                <?php
                                    $date = new Date($data->periode);
                                    if(Request::is('admins/laporancu') || Request::is('admins/laporancu/index_periode/*')){
                                        $datacu = "CU " . $data->cuprimer->name;
                                    }elseif(Request::is('admins/laporancu/index_cu*')){
                                        $datacu = "Periode " . $date->format('F Y');
                                    }
                                    
                                    $tot_nonsaham = $data->nonsaham_harian + $data->nonsaham_unggulan;
                                    $tot_anggota = $data->l_biasa + $data->l_lbiasa + $data->p_biasa + $data->p_lbiasa;

                                    $p1 = $data->piutanglalai_12bulan != 0 ? $data->dcr / $data->piutanglalai_12bulan : $data->dcr / 0.01;
                                    $p2 = $data->piutanglalai_1bulan != 0 ? ($data->dcr - $data->piutanglalai_12bulan) / $data->piutanglalai_1bulan : ($data->dcr - $data->piutanglalai_12bulan) / 0.01;

                                    if($p1 == 1 && $p2 > 0.35){
                                        $e1 = $data->aset != 0 ? ($data->piutangberedar - (($data->piutanglalai_12bulan) + ((35/100) * $data->piutanglalai_1bulan))) / $data->aset : ($data->piutangberedar - (($data->piutanglalai_12bulan) + ((35/100) * $data->piutanglalai_1bulan))) / 0.01;
                                    }else{
                                        $e1 = $data->aset != 0 ? ($data->piutangberedar - $data->dcr) / $data->aset : ($data->piutangberedar - $data->dcr) / 0.01;
                                    }

                                    $e5 = $data->aset != 0 ? ($data->nonsaham_unggulan + $data->nonsaham_harian) / $data->aset : ($data->nonsaham_unggulan + $data->nonsaham_harian) / 0.01;
                                    $e6 = $data->aset != 0 ? $data->totalhutang_pihak3 / $data->aset : $data->totalhutang_pihak3 / 0.01;

                                    $piutang_bersih = $data->dcr + $data->dcu + $data->iuran_gedung + $data->donasi + $data->shu_lalu;
                                    $e9 = $data->aset != 0 ? (($piutang_bersih) - ($data->piutanglalai_12bulan + ((35/100) * $data->piutanglalai_1bulan) + $data->aset_masalah)) / $data->aset : (($data->dcr + $data->dcu + $data->iuran_gedung + $data->donasi + $data->shu_lalu) - ($data->piutanglalai_12bulan + ((35/100) * $data->piutanglalai_1bulan) + $data->aset_masalah)) / 0.01;

                                    $a1 = $data->piutangberedar != 0 ? ($data->piutanglalai_1bulan + $data->piutanglalai_12bulan) / $data->piutangberedar : ($data->piutanglalai_1bulan + $data->piutanglalai_12bulan) / 0.01;
                                    $a2 = $data->aset != 0 ? $data->aset_tidak_menghasilkan / $data->aset : $data->aset_tidak_menghasilkan / 0.01;
                                    
                                    $ratasaham1 = ((($data->simpanansaham_des+ $data->simpanansaham)/2)/$date->format('m'))*12;
                                    $r7 = $ratasaham1 != 0 ? $data->bjs_saham / $ratasaham1 : $data->bjs_saham / 0.01;
                                    $r7_2 = ($data->simpanansaham_lalu+ $data->simpanansaham)/2 != 0 ? $data->bjs_saham / (($data->simpanansaham_lalu+ $data->simpanansaham)/2) : $data->bjs_saham / 0.01;
                                    if($data->simpanansaham_des == 0 && $data->simpanansaham_lalu != 0){
                                        $r7 = $r7_2;
                                    }
                                    
                                    $r9 = ($data->aset + $data->aset_lalu)/2 != 0 ? ($data->totalbiaya - $data->beban_penyisihandcr) / (($data->aset + $data->aset_lalu)/2) : ($data->totalbiaya - $data->beban_penyisihandcr) / 0.01;
                                    $l1 = $tot_nonsaham != 0 ? (($data->investasi_likuid + $data->aset_likuid_tidak_menghasilkan) - $data->hutang_tidak_berbiaya_30hari) / $tot_nonsaham : (($data->investasi_likuid + $data->aset_likuid_tidak_menghasilkan) - $data->hutang_tidak_berbiaya_30hari) / 0.01;
                                    $s10 = $data->totalanggota_lalu != 0 ? ($tot_anggota - $data->totalanggota_lalu) / $data->totalanggota_lalu : ($tot_anggota - $data->totalanggota_lalu) / 0.01;
                                    $s11 = $data->aset_lalu != 0 ? ($data->aset - $data->aset_lalu) / $data->aset_lalu : ($data->aset - $data->aset_lalu) / 0.01;

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

                                    $p1 = number_format($p1*100,2);
                                    $p2 = number_format($p2*100,2);
                                    $e1 = number_format($e1*100,2);
                                    $e5 = number_format($e5*100,2);
                                    $e6 = number_format($e6*100,2);
                                    $e9 = number_format($e9*100,2);
                                    $a1 = number_format($a1*100,2);
                                    $a2 = number_format($a2*100,2);
                                    $r7 = number_format($r7*100,2);
                                    $r7_2 = number_format($r7_2*100,2);
                                    $r9 = number_format($r9*100,2);
                                    $l1 = number_format($l1*100,2);
                                    $s10 = number_format($s10*100,2);
                                    $s11 = number_format($s11*100,2);

                                    $datapearls[$i] = array(
                                        'p1' => $p1,
                                        'p2' => $p2,
                                        'e1' => $e1,
                                        'e5' => $e5,
                                        'e6' => $e6,
                                        'e9' => $e9,
                                        'a1' => $a1,
                                        'a2' => $a2,
                                        'r7' => $r7,
                                        'r9' => $r9,
                                        'l1' => $l1,
                                        's10' => $s10,
                                        's11' => $s11
                                    );

                                    $i++;
                                    $ideal = 0;

                                    if($p1 >= 100)
                                        $ideal++;
                                    if($p2 > 35)
                                        $ideal++;
                                    if($e1 > 70 && $e1 < 80)
                                        $ideal++;
                                    if($e5 > 70 && $e5 < 80)
                                        $ideal++;
                                    if($e6 <= 5)
                                        $ideal++;
                                    if($e9 >= 10)
                                        $ideal++;
                                    if($a1 <= 5)
                                        $ideal++;
                                    if($a2 < 5)
                                        $ideal++;
                                    if($r7 == $data->hargapasar)
                                        $ideal++;
                                    if($r9 == 5)
                                        $ideal++;
                                    if($l1 > 15 && $l1 < 20)
                                        $ideal++;
                                    if($s10 > 12)
                                        $ideal++;
                                    if($s11 > $data->lajuinflasi + 10)
                                        $ideal++;
                                    ?>
                                <tr>
                                    <td class="bg-blue disabled color-palette"></td>
                                    <td hidden>{{ $data->id }}</td>
                                    @if(!Request::is('admins/laporancu/index_cu/*'))
                                        @if(!empty($data->cuprimer))
                                            <td>{{ $data->cuprimer->name }}</td>
                                        @else
                                            <td>-</td>
                                        @endif
                                    @endif
                                    <td data-order="{{ $data->periode }}"> {{ $date->format('F Y') }}</td>

                                    <td>{{ $ideal }}</td>

                                    <td>{{ 13 - $ideal }}</td>
{{-- p1  --}}
                                    <td><span data-toggle="modal" data-target="#modalformula"style="cursor:pointer;"
                                        data-judul ='P1 - Provisi pinjaman lalai di atas 12 bulan'
                                        data-cu ='{{ $datacu }}' 
                                        data-indikator='100% provisi tersedia untuk pinjaman lalai di atas 12 bulan dan setiap triwulan dilakukan charge off secara konsisten.'
                                        data-formula='`sf"P1" = sf"Cadangan Resiko"/sf"Piutang Lalai Di Atas 12 Bulan" xx 100 % = 100 % sf"(IDEAL)"`'
                                        data-nilai='`sf"P1" = sf"{{ number_format($data->dcr,"0",",",".") }}"/sf"{{ number_format($data->piutanglalai_12bulan,"0",",",".") }}" xx 100 % = {{ $p1 }}% @if($p1 < 100) sf"(TIDAK IDEAL)" @else sf"(IDEAL)" @endif`'
                
                                        data-id = {{ $data->id }}
                                        data-ubahjudul1 = 'Cadangan Resiko'
                                        data-ubahjudul2 = 'Piutang Lalai Di Atas 12 Bulan'
                                        data-ubahparam1 = 'dcr';
                                        data-ubahparam2 = 'piutanglalai_12bulan';
                                        data-ubahvalue1 = {{ $data->dcr != 0? $data->dcr : 0  }}
                                        data-ubahvalue2 = {{ $data->piutanglalai_12bulan != 0? $data->piutanglalai_12bulan : 0  }}
                                        >{{ $p1 }} %
                                        @if($p1 < 100) 
                                            <span class="label bg-red">TIDAK IDEAL</span> 
                                        @else 
                                            <span class="label bg-aqua">IDEAL</span> 
                                        @endif</span>
                                    </td>
{{-- p2 --}}
                                    <td><span data-toggle="modal" data-target="#modalformula"style="cursor:pointer;"
                                        data-judul ='P2 - Provisi pinjaman lalai 1 - 12 bulan'
                                        data-cu ='{{ $datacu }}' 
                                        data-indikator='35% provisi tersedia untuk pinjaman lalai 1 – 12 bulan dan setiap triwulan dilakukan charge off dari waktu ke waktu.'
                                        data-formula='`sf"P2" = sf"Saldo Cadangan Resiko setelah P1 [Cadangan Resiko - Piutang Lalai Di Atas 12 Bulan]"/sf"Piutang Lalai 1 - 12 Bulan" xx 100 % = sf"Di Atas 35 % (IDEAL)"`'
                                        data-nilai='`sf"P2" = (sf"{{ number_format($data->dcr,"0",",",".") }}"-sf"{{ number_format($data->piutanglalai_12bulan,"0",",",".") }}")/sf"{{ number_format($data->piutanglalai_1bulan,"0",",",".") }}" xx 100 % = {{ $p2 }}% @if($p2 < 35) sf"(TIDAK IDEAL)" @else sf"(IDEAL)" @endif`'

                                        data-id = {{ $data->id }}
                                        data-ubahjudul1 = 'Cadangan Resiko '
                                        data-ubahjudul2 = 'Piutang Lalai Di Atas 12 Bulan'
                                        data-ubahjudul3 = 'Piutang Lalai 1 - 12 Bulan'
                                        data-ubahparam1 = 'dcr';
                                        data-ubahparam2 = 'piutanglalai_12bulan';
                                        data-ubahparam3 = 'piutanglalai_1bulan';
                                        data-ubahvalue1 = {{ $data->dcr != 0? $data->dcr : 0 }}
                                        data-ubahvalue2 = {{ $data->piutanglalai_12bulan != 0? $data->piutanglalai_12bulan : 0 }}
                                        data-ubahvalue3 = {{ $data->piutanglalai_1bulan != 0? $data->piutanglalai_1bulan : 0 }}
                                        >
                                        {{ $p2 }} % 
                                        @if($p2 < 35) 
                                            <small class="label bg-red">TIDAK IDEAL</small> 
                                        @else 
                                            <small class="label bg-aqua">IDEAL</small> 
                                        @endif</span>
                                    </td>
{{-- e1 --}}
                                    <td><span data-toggle="modal" data-target="#modalformula"style="cursor:pointer;"
                                        data-judul ='E1 - Piutang Bersih / Total Aset'
                                        data-cu ='{{ $datacu }}'
                                        data-indikator='Rasio Piutang Bersih adalah 70% – 80% dari total aset dan portofolio pinjaman beragam dengan setidaknya 5 macam produk pinjaman yang berbeda.'
                                        data-keterangan="Rumus Pertama: Apabila P1 dan P2 IDEAL."
                                        data-keterangan2="Rumus Kedua: Apabila P1 atau P2 TIDAK IDEAL"
                                        data-formula='`sf"E1" = (sf"Piutang Beredar" - ((sf"100%" xx sf"Piutang Lalai Di Atas 12 Bulan") + (sf"35%" xx sf"Piutang lalai 1 - 12 Bulan")))/sf"Aset" xx 100 % = sf"70 % Sampai 80 % (IDEAL)"`'
                                        data-formula2='`sf"E1" = (sf"Piutang Beredar"-sf"DCR")/sf"Aset" xx 100 % = sf"70 % Sampai 80 % (IDEAL)"`'
                                        @if($p1 == 100 && $p2 > 35)
                                            data-keterangan3="Dikarenakan P1 dan P2 IDEAL, maka rumus yang digunakan adalah yang pertama."     
                                            data-nilai='`sf"E1" = (sf"{{ number_format($data->piutangberedar,"0",",",".") }}"-((100% xx sf"{{ number_format($data->piutanglalai_12bulan,"0",",",".") }}")+(35% xx sf"{{ number_format($data->piutanglalai_1bulan,"0",",",".") }}")))/sf"{{ number_format($data->aset,"0",",",".") }}" xx 100 % = {{ $e1 }} %  @if($e1 < 70 || $e1 > 80) sf"(TIDAK IDEAL)" @else sf"(IDEAL)" @endif`'
        
                                            data-ubahjudul1 = 'Piutang Beredar'
                                            data-ubahjudul2 = 'Piutang Lalai Di Atas 12 Bulan'
                                            data-ubahjudul3 = 'Piutang lalai 1 - 12 Bulan'
                                            data-ubahjudul4 = 'Aset'
                                            data-ubahparam1 = 'piutangberedar';
                                            data-ubahparam2 = 'piutanglalai_12bulan';
                                            data-ubahparam3 = 'piutanglalai_1bulan';
                                            data-ubahparam4 = 'aset';
                                            data-ubahvalue1 = {{ $data->piutangberedar != 0? $data->piutangberedar : 0 }}
                                            data-ubahvalue2 = {{ $data->piutanglalai_12bulan != 0? $data->piutanglalai_12bulan : 0 }}
                                            data-ubahvalue3 = {{ $data->piutanglalai_1bulan != 0? $data->piutanglalai_1bulan : 0 }}
                                            data-ubahvalue4 = {{ $data->aset != 0? $data->aset : 0 }}
                                        @else
                                            data-keterangan3="Dikarenakan P1 dan P2 TIDAK IDEAL, maka rumus yang digunakan adalah yang kedua."    
                                            data-nilai='`sf"E1" = (sf"{{ number_format($data->piutangberedar,"0",",",".") }}"-sf"{{ number_format($data->dcr,"0",",",".") }}")/sf"{{ number_format($data->aset,"0",",",".") }}" xx 100 % = {{ $e1 }}% @if($e1 < 70 || $e1 > 80) sf"(TIDAK IDEAL)" @else sf"(IDEAL)" @endif`'
                                            
                                            data-ubahjudul1 = 'Piutang Beredar'
                                            data-ubahjudul2 = 'Cadangan Resiko'
                                            data-ubahjudul3 = 'Aset'
                                            data-ubahparam1 = 'piutangberedar';
                                            data-ubahparam2 = 'dcr';
                                            data-ubahparam3 = 'aset';
                                            data-ubahvalue1 = {{ $data->piutangberedar != 0? $data->piutangberedar : 0 }}
                                            data-ubahvalue2 = {{ $data->dcr != 0? $data->dcr : 0 }}
                                            data-ubahvalue3 = {{ $data->aset != 0? $data->aset : 0 }}
                                        @endif
                                        data-id = {{ $data->id }}
                                        >
                                        {{ $e1 }} % 
                                        @if($e1 < 70 || $e1 > 80) 
                                            <small class="label bg-red">TIDAK IDEAL</small> 
                                        @else 
                                            <small class="label bg-aqua">IDEAL</small> 
                                        @endif</span>
                                    </td>
{{-- e5 --}}
                                    <td><span data-toggle="modal" data-target="#modalformula"style="cursor:pointer;"
                                        data-judul ='E5 - Simpanan Non Saham / Total Aset'
                                        data-cu ='{{ $datacu }}'
                                        data-indikator='Rasio 70% – 80% dari total aset dan memiliki beragam jenis simpanan minimal 5 jenis produk simpanan yang berbeda.'
                                        data-formula='`sf"E5" = (sf"Simpanan Non Saham Unggulan"+sf"Simpanan Non Saham Harian")/sf"Aset" xx 100 % = sf"70 % Sampai 80 % (IDEAL)"`'
                                        data-nilai='`sf"E5" = (sf"{{ number_format($data->nonsaham_unggulan,"0",",",".") }}"+sf"{{ number_format($data->nonsaham_harian,"0",",",".") }}")/ sf"{{ number_format($data->aset,"0",",",".") }}" xx 100 % = {{ $e5 }}% @if($e5 < 70 || $e5 > 80) sf"(TIDAK IDEAL)" @else sf"(IDEAL)" @endif`'

                                        data-id = {{ $data->id }}
                                        data-ubahjudul1 = 'Simpanan Non Saham Unggulan'
                                        data-ubahjudul2 = 'Simpanan Non Saham Harian'
                                        data-ubahjudul3 = 'Aset'
                                        data-ubahparam1 = 'nonsaham_unggulan';
                                        data-ubahparam2 = 'nonsaham_harian';
                                        data-ubahparam3 = 'aset';
                                        data-ubahvalue1 = {{ $data->nonsaham_unggulan != 0? $data->nonsaham_unggulan : 0 }}
                                        data-ubahvalue2 = {{ $data->nonsaham_harian != 0? $data->nonsaham_harian : 0 }}
                                        data-ubahvalue3 = {{ $data->aset != 0? $data->aset : 0 }}
                                        >
                                        {{ $e5 }} % 
                                        @if($e5 < 70 || $e5 > 80) 
                                            <small class="label bg-red">TIDAK IDEAL</small> 
                                        @else 
                                            <small class="label bg-aqua">IDEAL</small> 
                                        @endif</span>
                                    </td>
{{-- e6 --}}
                                    <td><span data-toggle="modal" data-target="#modalformula"style="cursor:pointer;"
                                        data-judul ='E6 - Pinjaman kepada pihak luar terhadap total aset'
                                        data-cu ='{{ $datacu }}'
                                        data-indikator='Jumlah pinjaman kepada pihak eksternal 1% – 19% dari total aset.'
                                        data-formula='`sf"E6" = sf"Total Hutang Pihak Ke-3"/sf"Aset" xx 100 % = sf"Kurang Dari Sama Dengan 5 % (IDEAL)"`'
                                        data-nilai='`sf"E6" = sf"{{ number_format($data->totalhutang_pihak3,"0",",",".") }}"/ sf"{{ number_format($data->aset,"0",",",".") }}" xx 100 % = {{ $e6 }}% @if($e6 > 5) sf"(TIDAK IDEAL)" @else sf"(IDEAL)" @endif`'

                                        data-id = {{ $data->id }}
                                        data-ubahjudul1 = 'Aset'
                                        data-ubahjudul2 = 'Total Hutang Pihak Ke-3'
                                        data-ubahparam1 = 'aset';
                                        data-ubahparam2 = 'totalhutang_pihak3';
                                        data-ubahvalue1 = {{ $data->aset != 0? $data->aset : 0 }}
                                        data-ubahvalue2 = {{ $data->totalhutang_pihak3 != 0? $data->totalhutang_pihak3 : 0 }}
                                        >
                                        {{ $e6 }} % 
                                        @if($e6 > 5) 
                                            <small class="label bg-red">TIDAK IDEAL</small> 
                                        @else 
                                            <small class="label bg-aqua">IDEAL</small> 
                                        @endif</span>
                                    </td>
{{-- e9 --}}
                                    <td><span data-toggle="modal" data-target="#modalformula"style="cursor:pointer;"
                                        data-judul ='E9 - Modal lembaga bersih'
                                        data-cu ='{{ $datacu }}'
                                        data-indikator='Modal lembaga bersih sebesar 10% dari total aset.'
                                        data-formula='`sf"E9" = ((sf"Cadangan Resiko" + sf"Cadangan Umum" + sf"Dana Gedung" + sf"Donasi" + sf"SHU Tahun Lalu") - ((100% xx sf"Piutang Lalai Di Atas 12 Bulan") + (35% xx sf"Piutang lalai 1 - 12 Bulan") + sf"Aset Bermasalah")) / sf"Aset" xx 100 % = sf"Lebih Dari Sama Dengan 10% (IDEAL)"`'
                                        data-nilai='`sf"E9" = ((sf"{{ number_format($data->dcr,"0",",",".") }}" + sf"{{ number_format($data->dcu,"0",",",".") }}" + sf"{{ number_format($data->iuran_gedung,"0",",",".") }}" + sf"{{ number_format($data->donasi,"0",",",".") }}" + sf"{{ number_format($data->shu_lalu,"0",",",".") }}")-((100% xx sf"{{ number_format($data->piutanglalai_12bulan,"0",",",".") }}") + (35% xx sf"{{ number_format($data->piutanglalai_1bulan,"0",",",".") }}") + sf"{{ number_format($data->aset_masalah,"0",",",".") }}"))/sf"{{ number_format($data->aset,"0",",",".") }}" xx 100 % = {{ $e9 }}% @if($e9 < 10) sf"(TIDAK IDEAL)" @else sf"(IDEAL)" @endif`'

                                        data-id = {{ $data->id }}
                                        data-ubahjudul1 = 'Cadangan Resiko'
                                        data-ubahjudul2 = 'Cadangan Umum'
                                        data-ubahjudul3 = 'Dana Gedung'
                                        data-ubahjudul4 = 'Donasi'
                                        data-ubahjudul5 = 'SHU Tahun Lalu'
                                        data-ubahjudul6 = 'Piutang Lalai Di Atas 12 Bulan'
                                        data-ubahjudul7 = 'Piutang lalai 1 - 12 Bulan'
                                        data-ubahjudul8 = 'Aset Bermasalah'
                                        data-ubahjudul9 = 'Aset'
                                        data-ubahparam1 = 'dcr';
                                        data-ubahparam2 = 'dcu';
                                        data-ubahparam3 = 'iuran_gedung';
                                        data-ubahparam4 = 'donasi';
                                        data-ubahparam5 = 'shu_lalu';
                                        data-ubahparam6 = 'piutanglalai_12bulan';
                                        data-ubahparam7 = 'piutanglalai_1bulan';
                                        data-ubahparam8 = 'aset_masalah';
                                        data-ubahparam9 = 'aset';
                                        data-ubahvalue1 = {{ $data->dcr != 0? $data->dcr : 0 }}
                                        data-ubahvalue2 = {{ $data->dcu != 0? $data->dcu : 0 }}
                                        data-ubahvalue3 = {{ $data->iuran_gedung != 0? $data->iuran_gedung : 0 }}
                                        data-ubahvalue4 = {{ $data->donasi != 0? $data->donasi : 0 }}
                                        data-ubahvalue5 = {{ $data->shu_lalu != 0? $data->shu_lalu : 0 }}
                                        data-ubahvalue6 = {{ $data->piutanglalai_12bulan != 0? $data->piutanglalai_12bulan : 0 }}
                                        data-ubahvalue7 = {{ $data->piutanglalai_1bulan != 0? $data->piutanglalai_1bulan : 0 }}
                                        data-ubahvalue8 = {{ $data->aset_masalah != 0? $data->aset_masalah : 0 }}
                                        data-ubahvalue9 = {{ $data->aset != 0? $data->aset : 0 }}
                                        >
                                        {{ $e9 }} % 
                                        @if($e9 < 10) 
                                            <small class="label bg-red">TIDAK IDEAL</small> 
                                        @else 
                                            <small class="label bg-aqua">IDEAL</small> 
                                        @endif</span>
                                    </td>
{{-- a1 --}}
                                    <td><span data-toggle="modal" data-target="#modalformula"style="cursor:pointer;"
                                        data-judul ='A1 - Total Pinjaman Lalai / Total Pinjaman Beredar'
                                        data-cu ='{{ $datacu }}' 
                                        data-indikator='Total pinjaman lalai < 5% dari total pinjaman beredar.'
                                        data-formula='`sf"A1" = (sf"Piutang Lalai" (sf"Piutang Lalai 1-12 Bulan" + sf"Piutang Lalai Di Atas 12 Bulan"))/sf"Piutang Beredar" xx 100 % = sf"Kurang Dari Sama Dengan 5 % (IDEAL)"`'
                                        data-nilai='`sf"A1" = (sf"{{ number_format($data->piutanglalai_1bulan,"0",",",".") }}"+sf"{{ number_format($data->piutanglalai_12bulan,"0",",",".") }}")/ sf"{{ number_format($data->piutangberedar,"0",",",".") }}" xx 100 % = {{ $a1 }}% @if($a1 > 5) sf"(TIDAK IDEAL)" @else sf"(IDEAL)" @endif`'

                                        data-id = {{ $data->id }}
                                        data-ubahjudul1 = 'Piutang Lalai 1-12 Bulan'
                                        data-ubahjudul2 = 'Piutang Lalai Di Atas 12 Bulan'
                                        data-ubahjudul3 = 'Piutang Beredar'
                                        data-ubahparam1 = 'piutanglalai_1bulan';
                                        data-ubahparam2 = 'piutanglalai_12bulan';
                                        data-ubahparam3 = 'piutangberedar';
                                        data-ubahvalue1 = {{ $data->piutanglalai_1bulan != 0? $data->piutanglalai_1bulan : 0 }}
                                        data-ubahvalue2 = {{ $data->piutanglalai_12bulan != 0? $data->piutanglalai_12bulan : 0 }}
                                        data-ubahvalue3 = {{ $data->piutangberedar != 0? $data->piutangberedar : 0 }}
                                        >
                                        {{ $a1 }} % 
                                        @if($a1 > 5) 
                                            <small class="label bg-red">TIDAK IDEAL</small> 
                                        @else 
                                            <small class="label bg-aqua">IDEAL</small> 
                                        @endif</span>
                                    </td>
{{-- a2 --}}
                                    <td><span data-toggle="modal" data-target="#modalformula"style="cursor:pointer;"
                                        data-judul ='A2 - Aset-aset yang tidak menghasilkan / Total aset'
                                        data-cu ='{{ $datacu }}' 
                                        data-indikator='Aset-aset tidak menghasilkan 5% dari total aset.'
                                        data-formula='`sf"A2" = sf"Aset Tidak Menghasilkan"/sf"Aset" xx 100 % = sf"Kurang Dari 5% (IDEAL)"`'
                                        data-nilai='`sf"A2" = sf"{{ number_format($data->aset_tidak_menghasilkan,"0",",",".") }}"/ sf"{{ number_format($data->piutangberedar,"0",",",".") }}" xx 100 % = {{ $a2 }}% @if($a2 > 5) sf"(TIDAK IDEAL)" @else sf"(IDEAL)" @endif`'

                                        data-id = {{ $data->id }}
                                        data-ubahjudul1 = 'Aset Tidak Menghasilkan'
                                        data-ubahjudul2 = 'Aset'
                                        data-ubahparam1 = 'aset_tidak_menghasilkan';
                                        data-ubahparam2 = 'aset';
                                        data-ubahvalue1 = {{ $data->aset_tidak_menghasilkan != 0 ? $data->aset_tidak_menghasilkan : 0 }}
                                        data-ubahvalue2 = {{ $data->aset != 0 ? $data->aset : 0 }}
                                        >
                                        {{ $a2 }} % 
                                        @if($a2 > 5) 
                                            <small class="label bg-red">TIDAK IDEAL</small> 
                                        @else 
                                            <small class="label bg-aqua">IDEAL</small> 
                                        @endif</span>
                                    </td>
{{-- r7 --}}
                                    <td><span data-toggle="modal" data-target="#modalformula"style="cursor:pointer;"
                                        data-judul ='R7 - BJS Saham terhadap rata-rata aset'
                                        data-cu ='{{ $datacu }}' 
                                        data-indikator='Dividen saham dibayar 1% lebih tinggi daripada suku bunga pasar.'
                                        data-keterangan="Jika Simpanan Saham bersumber dari saldo bulan Desember tahun lalu."
                                        data-keterangan2="Jika Simpanan Saham bersumber dari saldo tahun lalu bulan {{ $date->format('F') }}. "
                                        data-formula='`sf"R7" = sf"BJS Saham"/(sf"Simpanan Saham Rata-rata"((((sf"Simpanan Saham Bulan Desember" + sf"Simpanan Saham Bulan {{ $date->format('F') }}")sf"/ 2")/sf"Jumlah Bulan Berjalan") xx 12)) xx 100 % = sf"Harga Pasar (IDEAL)"`'
                                        data-formula2='`sf"R7" = sf"BJS Saham"/(sf"Simpanan Saham Rata-rata"((sf"Simpanan Saham Tahun Lalu Bulan {{ $date->format('F') }}" + sf"Simpanan Saham Tahun Ini Bulan {{ $date->format('F') }}")/2)) xx 100 % = sf"Harga Pasar (IDEAL)"`'
                                        @if($data->simpanansaham_des != 0)
                                            data-nilai='`sf"R7" = sf"{{ number_format($data->bjs_saham,"0",",",".") }}"/ ((((sf"{{ number_format($data->simpanansaham_des,"0",",",".") }}" + sf"{{ number_format($data->simpanansaham,"0",",",".") }}")sf"/ 2")/sf"{{ $date->format('m') }}") xx 12) xx 100 % = {{ $r7 }}% @if($r7 != $data->hargapasar) sf"(TIDAK IDEAL)" @else sf"(IDEAL)" @endif`'

                                            data-ubahjudul1 = 'BJS Saham'
                                            data-ubahjudul2 = 'Simpanan Saham Bulan Desember'
                                            data-ubahjudul3 = 'Simpanan Saham Bulan {{ $date->format('F') }}'
                                            data-ubahjudul4 = 'Harga Pasar'
                                            data-ubahparam1 = 'bjs_saham';
                                            data-ubahparam2 = 'simpanansaham_des';
                                            data-ubahparam3 = 'simpanansaham'
                                            data-ubahparam4 = 'hargapasar'
                                            data-ubahvalue1 = {{ $data->bjs_saham  != 0 ? $data->bjs_saham : 0 }}
                                            data-ubahvalue2 = {{ $data->simpanansaham_des != 0 ? $data->simpanansaham_des : 0 }}
                                            data-ubahvalue3 = {{ $data->simpanansaham != 0 ? $data->simpanansaham : 0  }}
                                            data-ubahvalue4 = {{ $data->hargapasar != 0 ? $data->hargapasar : 0 }}
                                        @endif
                                        @if($data->simpanansaham_lalu != 0)
                                            data-nilai2='`sf"R7" = sf"{{ number_format($data->bjs_saham,"0",",",".") }}"/ ((sf"{{ number_format($data->simpanansaham_lalu,"0",",",".") }}" + sf"{{ number_format($data->simpanansaham,"0",",",".") }}")/2) xx 100 % = {{ $r7_2 }}% @if($r7_2 != $data->hargapasar) sf"(TIDAK IDEAL)" @else sf"(IDEAL)" @endif`'
        
                                            data-ubahjudul1 = 'BJS Saham'
                                            data-ubahjudul2 = 'Simpanan Saham Tahun Lalu Bulan {{ $date->format('F') }}'
                                            data-ubahjudul3 = 'Simpanan Saham Bulan {{ $date->format('F') }}'
                                            data-ubahjudul4 = 'Harga Pasar'
                                            data-ubahparam1 = 'bjs_saham';
                                            data-ubahparam2 = 'simpanansaham_lalu';
                                            data-ubahparam3 = 'simpanansaham'
                                            data-ubahparam4 = 'hargapasar'
                                            data-ubahvalue1 = {{ $data->bjs_saham  != 0? $data->bjs_saham : 0  }}
                                            data-ubahvalue2 = {{ $data->simpanansaham_lalu  != 0 ? $data->simpanansaham_lalu : 0 }}
                                            data-ubahvalue3 = {{ $data->simpanansaham  != 0 ? $data->simpanansaham : 0 }}
                                            data-ubahvalue4 = {{ $data->hargapasar  != 0 ? $data->hargapasar : 0 }}
                                        @endif
                                        @if($data->simpanansaham_des == 0 && $data->simpanansaham_lalu == 0)
                                            data-nilai='`sf"R7" = sf"{{ number_format($data->bjs_saham,"0",",",".") }}"/ ((((sf"{{ number_format($data->simpanansaham_des,"0",",",".") }}" + sf"{{ number_format($data->simpanansaham,"0",",",".") }}")sf"/ 2")/sf"{{ $date->format('m') }}") xx 12) xx 100 % = {{ $r7 }}% @if($r7 != $data->hargapasar) sf"(TIDAK IDEAL)" @else sf"(IDEAL)" @endif`'
                                            data-nilai2='`sf"R7" = sf"{{ number_format($data->bjs_saham,"0",",",".") }}"/ ((sf"{{ number_format($data->simpanansaham_lalu,"0",",",".") }}" + sf"{{ number_format($data->simpanansaham,"0",",",".") }}")/2) xx 100 % = {{ $r7_2 }}% @if($r7_2 != $data->hargapasar) sf"(TIDAK IDEAL)" @else sf"(IDEAL)" @endif`'

                                            data-ubahjudul1 = 'BJS Saham'
                                            data-ubahjudul2 = 'Simpanan Saham Bulan Desember'
                                            data-ubahjudul3 = 'Simpanan Saham Tahun Lalu Bulan {{ $date->format('F') }}'
                                            data-ubahjudul4 = 'Simpanan Saham Bulan {{ $date->format('F') }}'
                                            data-ubahjudul5 = 'Harga Pasar'
                                            data-ubahparam1 = 'bjs_saham';
                                            data-ubahparam2 = 'simpanansaham_des';
                                            data-ubahparam3 = 'simpanansaham_lalu'
                                            data-ubahparam4 = 'simpanansaham'
                                            data-ubahparam5 = 'hargapasar'
                                            data-ubahvalue1 = {{ $data->bjs_saham != 0? $data->bjs_saham : 0   }}
                                            data-ubahvalue2 = {{ $data->simpanansaham_des != 0? $data->simpanansaham_des : 0  }}
                                            data-ubahvalue3 = {{ $data->simpanansaham_lalu != 0? $data->simpanansaham_lalu : 0  }}
                                            data-ubahvalue4 = {{ $data->simpanansaham != 0? $data->simpanansaham : 0  }}
                                            data-ubahvalue5 = {{ $data->hargapasar != 0? $data->hargapasar : 0  }}
                                        @endif
                                        data-id = {{ $data->id }}
                                        >
                                        @if($data->simpanansaham_des != 0 && $data->simpanansaham_lalu != 0)
                                            {{ $r7 }} % 
                                            @if($r7 != $data->hargapasar) 
                                                <small class="label bg-red">TIDAK IDEAL</small> 
                                            @else 
                                                <small class="label bg-aqua">IDEAL</small> 
                                            @endif / 
                                            {{ $r7_2 }} % 
                                            @if($r7_2 != $data->hargapasar) 
                                                <small class="label bg-red">TIDAK IDEAL</small> 
                                            @else 
                                                <small class="label bg-aqua">IDEAL</small> 
                                            @endif
                                        @else
                                            {{ $r7 }} % 
                                            @if($r7 != $data->hargapasar) 
                                                <small class="label bg-red">TIDAK IDEAL</small> 
                                            @else 
                                                <small class="label bg-aqua">IDEAL</small> 
                                            @endif
                                        @endif       
                                        </span>
                                    </td>
{{-- r9 --}}
                                    <td><span data-toggle="modal" data-target="#modalformula"style="cursor:pointer;"
                                        data-judul ='R9 - Biaya operasional terhadap rata-rata aset'
                                        data-cu ='{{ $datacu }}' 
                                        data-indikator='Beban Operasional terhadap rata-rata aset sebesar 5%.'
                                        data-formula='`sf"R9" = (sf"Beban Operasional"(sf"Total Biaya" - sf"Beban Penyisihan Cadangan Resiko"))/(sf"Rata-rata Aset" ((sf"Aset Tahun Ini"+sf"Aset Tahun Lalu")/2)) xx 100 % = sf"5 % (IDEAL)"`'
                                        data-nilai='`sf"R9" = (sf"{{ number_format($data->totalbiaya,"0",",",".") }}" - sf"{{ number_format($data->beban_penyisihandcr,"0",",",".") }}")/ ((sf"{{ number_format($data->aset,"0",",",".") }}" + sf"{{ number_format($data->aset_lalu,"0",",",".") }}")/2) xx 100 % = {{ $r9 }}% @if($r9 != 5) sf"(TIDAK IDEAL)" @else sf"(IDEAL)" @endif`'

                                        data-id = {{ $data->id }}
                                        data-ubahjudul1 = 'Total Biaya'
                                        data-ubahjudul2 = 'Beban Penyisihan Cadangan Resiko'
                                        data-ubahjudul3 = 'Aset Tahun Ini'
                                        data-ubahjudul4 = 'Aset Tahun Lalu'
                                        data-ubahparam1 = 'totalbiaya'
                                        data-ubahparam2 = 'beban_penyisihandcr'
                                        data-ubahparam3 = 'aset'
                                        data-ubahparam4 = 'aset_lalu'
                                        data-ubahvalue1 = {{ $data->totalbiaya != 0? $data->totalbiaya : 0 }}
                                        data-ubahvalue2 = {{ $data->beban_penyisihandcr != 0? $data->beban_penyisihandcr : 0 }}
                                        data-ubahvalue3 = {{ $data->aset != 0? $data->aset : 0 }}
                                        data-ubahvalue4 = {{ $data->aset_lalu != 0? $data->aset_lalu : 0 }}
                                        >
                                        {{ $r9 }} % 
                                        @if($r9 != 5) 
                                            <small class="label bg-red">TIDAK IDEAL</small> 
                                        @else 
                                            <small class="label bg-aqua">IDEAL</small> 
                                        @endif</span>
                                    </td>
{{-- l1 --}}
                                    <td><span data-toggle="modal" data-target="#modalformula"style="cursor:pointer;"
                                        data-judul ='L1 - (Investasi likuid + Aset-aset Likuid – Hutang Jangka Pendek < 30 hari )/ Simpanan Non Saham'
                                        data-cu ='{{ $datacu }}' 
                                        data-indikator='Likuiditas sebesar 15% dari total simpanan non saham tetapi tidak melampaui 20% dari total aset.'
                                        data-formula='`sf"L1" = ((sf"Investasi Likuid" + sf"Aset Likuid Tidak Menghasilkan") - sf"Hutang Tidak Berbiaya < 30 Hari")/sf"Total Simpanan Non-Saham" xx 100 % = sf"15 % Sampai  20 % (IDEAL)"`'
                                        data-nilai='`sf"L1" = ((sf"{{ number_format($data->investasi_likuid,"0",",",".") }}" + sf"{{ number_format($data->aset_likuid_tidak_menghasilkan,"0",",",".") }}") - sf"{{ number_format($data->hutang_tidak_berbiaya_30hari,"0",",",".") }}")/ sf"{{ number_format($tot_nonsaham,"0",",",".") }}" xx 100 % = {{ $l1 }}% @if($l1 < 15 || $l1 > 20) sf"(TIDAK IDEAL)" @else sf"(IDEAL)" @endif`'

                                        data-id = {{ $data->id }}
                                        data-ubahjudul1 = 'Investasi Likuid'
                                        data-ubahjudul2 = 'Aset Likuid Tidak Menghasilkan'
                                        data-ubahjudul3 = 'Hutang Tidak Berbiaya < 30 Hari'
                                        data-ubahjudul4 = 'Total Simpanan Non-Saham'
                                        data-ubahparam1 = 'investasi_likuid';
                                        data-ubahparam2 = 'aset_likuid_tidak_menghasilkan';
                                        data-ubahparam3 = 'hutang_tidak_berbiaya_30hari'
                                        data-ubahparam4 = 'tot_nonsaham'
                                        data-ubahvalue1 = {{ $data->investasi_likuid != 0? $data->investasi_likuid : 0 }}
                                        data-ubahvalue2 = {{ $data->aset_likuid_tidak_menghasilkan != 0? $data->aset_likuid_tidak_menghasilkan : 0 }}
                                        data-ubahvalue3 = {{ $data->hutang_tidak_berbiaya_30hari != 0? $data->hutang_tidak_berbiaya_30hari : 0 }}
                                        data-ubahvalue4 = {{ $tot_nonsaham != 0? $tot_nonsaham : 0 }}
                                        >
                                        {{ $l1 }} % 
                                        @if($l1 < 15 || $l1 > 20) 
                                            <small class="label bg-red">TIDAK IDEAL</small> 
                                        @else 
                                            <small class="label bg-aqua">IDEAL</small> 
                                        @endif</span>
                                    </td>
{{-- s10 --}}
                                    <td><span data-toggle="modal" data-target="#modalformula"style="cursor:pointer;"
                                        data-judul ='S10 - Pertumbuhan Anggota'
                                        data-cu ='{{ $datacu }}'
                                        data-indikator='Pertumbuhan anggota 12% per tahun.'
                                        data-formula='`sf"S10" = (sf"Total Anggota Tahun Ini" - sf"Total Anggota Tahun Lalu")/sf"Total Anggota Tahun Lalu" xx 100 % = sf" Kurang Dari 12 % (IDEAL)"`'
                                        data-nilai='`sf"S10" = (sf"{{ number_format($tot_anggota,"0",",",".") }}" - sf"{{ number_format($data->totalanggota_lalu,"0",",",".") }}")/ sf"{{ number_format($data->totalanggota_lalu,"0",",",".") }}" xx 100 % = {{ $s10 }}% @if($s10 < 12) sf"(TIDAK IDEAL)" @else sf"(IDEAL)" @endif`'

                                        data-id = {{ $data->id }}
                                        data-ubahjudul1 = 'Anggota Laki-laki Biasa'
                                        data-ubahjudul2 = 'Anggota Laki-laki Luar Biasa'
                                        data-ubahjudul3 = 'Anggota Perempuan Biasa'
                                        data-ubahjudul4 = 'Anggota Perempuan Luar Biasa'
                                        data-ubahjudul5 = 'Total Anggota Tahun Lalu'
                                        data-ubahparam1 = 'l_biasa';
                                        data-ubahparam2 = 'l_lbiasa';
                                        data-ubahparam3 = 'p_biasa'
                                        data-ubahparam4 = 'p_lbiasa'
                                        data-ubahparam5 = 'totalanggota_lalu'
                                        data-ubahvalue1 = {{ $data->l_biasa != 0? $data->l_biasa : 0  }}
                                        data-ubahvalue2 = {{ $data->l_lbiasa != 0? $data->l_lbiasa : 0  }}
                                        data-ubahvalue3 = {{ $data->p_biasa != 0? $data->p_biasa : 0  }}
                                        data-ubahvalue4 = {{ $data->p_lbiasa != 0? $data->p_lbiasa : 0  }}
                                        data-ubahvalue5 = {{ $data->totalanggota_lalu != 0? $data->totalanggota_lalu : 0  }}
                                        >
                                        {{ $s10 }} % 
                                        @if($s10 < 12) 
                                            <small class="label bg-red">TIDAK IDEAL</small> 
                                        @else 
                                            <small class="label bg-aqua">IDEAL</small> 
                                        @endif</span>
                                    </td>
{{-- s11 --}}
                                    <td><span data-toggle="modal" data-target="#modalformula"style="cursor:pointer;"
                                        data-judul ='S11 - Pertumbuhan Anggota'
                                        data-cu ='{{ $datacu }}' 
                                        data-indikator='Pertumbuhan anggota 12% per tahun.'
                                        data-formula='`sf"S11" = (sf"Total Anggota Tahun Ini" - sf"Total Anggota Tahun Lalu")/sf"Total Anggota Tahun Lalu" xx 100 % = sf"10 % Di Atas Laju Inflasi (IDEAL)"`'
                                        data-nilai='`sf"S11" = (sf"{{ number_format($tot_anggota,"0",",",".") }}" - sf"{{ number_format($data->totalanggota_lalu,"0",",",".") }}")/ sf"{{ number_format($data->totalanggota_lalu,"0",",",".") }}" xx 100 % = {{ $s11 }}% @if($s11 < $data->lajuinflasi + 10) sf"(TIDAK IDEAL)" @else sf"(IDEAL)" @endif`'

                                        data-id = {{ $data->id }}
                                        data-ubahjudul1 = 'Anggota Laki-laki Biasa'
                                        data-ubahjudul2 = 'Anggota Laki-laki Luar Biasa'
                                        data-ubahjudul3 = 'Anggota Perempuan Biasa'
                                        data-ubahjudul4 = 'Anggota Perempuan Luar Biasa'
                                        data-ubahjudul5 = 'Total Anggota Tahun Lalu'
                                        data-ubahparam1 = 'l_biasa';
                                        data-ubahparam2 = 'l_lbiasa';
                                        data-ubahparam3 = 'p_biasa'
                                        data-ubahparam4 = 'p_lbiasa'
                                        data-ubahparam5 = 'totalanggota_lalu'
                                        data-ubahvalue1 = {{ $data->l_biasa != 0? $data->l_biasa : 0  }}
                                        data-ubahvalue2 = {{ $data->l_lbiasa != 0? $data->l_lbiasa : 0  }}
                                        data-ubahvalue3 = {{ $data->p_biasa != 0? $data->p_biasa : 0  }}
                                        data-ubahvalue4 = {{ $data->p_lbiasa != 0? $data->p_lbiasa : 0  }}
                                        data-ubahvalue5 = {{ $data->totalanggota_lalu != 0? $data->totalanggota_lalu : 0  }}
                                        >
                                        {{ $s11 }} % 
                                        @if($s11 < $data->lajuinflasi + 10) 
                                            <small class="label bg-red">TIDAK IDEAL</small> 
                                        @else 
                                            <small class="label bg-aqua">IDEAL</small> 
                                        @endif</span>
                                    </td>
            
                                    <td>{{ number_format($data->hargapasar,2) }} %</td>
                                    <td>{{ number_format($data->lajuinflasi,2) }} %</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

            @if(Request::is('admins/laporancu/index_cu*'))
                <div class="tab-pane" id="tab_hapus">
                    @include('admins.laporancu._component.table_hapus')
                </div> 
            @endif
        </div>
    </div>
    {{-- table --}}
    <!--grafik-->
    @if(!Request::is('admins/laporancu/index_hapus'))
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_cu_graf" data-toggle="tab">Grafik Perkembangan</a></li>
                @if(Request::is('admins/laporancu') || Request::is('admins/laporancu/index_periode/*'))
                    <li><a href="#tab_provinsi_graf" data-toggle="tab">Grafik Perkembangan (Provinsi)</a></li>
                    <li><a href="#tab_do_graf" data-toggle="tab">Grafik Perkembangan (District Office)</a></li>
                @endif
                @if(Request::is('admins/laporancu/index_bkcu') || Request::is('admins/laporancu/index_cu*'))
                    <li><a href="#tab_tumbuh_graf" data-toggle="tab">Grafik Pertumbuhan</a></li>
                @endif
                @if(!Request::is('admins/laporancu/index_bkcu'))
                    <li><a href="#tab_pearls_graf" data-toggle="tab">Grafik P.E.A.R.L.S</a></li>
                @endif
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_cu_graf">
                    <?php
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
                    ?>
                    <canvas id="chart" height="100em"></canvas>
                    <hr/>
                    <div class="input-group">
                        <?php $culists = App\Cuprimer::orderBy('name','asc')->get(); ?>
                        <div class="input-group-addon primary-color">
                        @if(Request::is('admins/laporancu'))
                            <i class="fa fa-fw fa-bar-chart"></i>
                        @else
                            <i class="fa fa-fw fa-line-chart"></i>
                        @endif
                        Grafik Laporan Berdasarkan</div>
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
                @if(Request::is('admins/laporancu') || Request::is('admins/laporancu/index_periode/*'))
                    <div class="tab-pane" id="tab_provinsi_graf">
                        <?php
                        $gperiode2 = array_column($wilayahs,'nama');
                        $gl_biasa2 = array_column($wilayahs,'l_biasa');
                        $gl_lbiasa2 = array_column($wilayahs,'l_lbiasa');
                        $gp_biasa2 = array_column($wilayahs,'p_biasa');
                        $gp_lbiasa2 = array_column($wilayahs,'p_lbiasa');
                        $gaset2 = array_column($wilayahs,'aset');
                        $gaktivalancar2 = array_column($wilayahs,'aktivalancar');
                        $gsimpanansaham2 = array_column($wilayahs,'simpanansaham');
                        $gnonsaham_unggulan2 = array_column($wilayahs,'nonsaham_unggulan');
                        $gnonsaham_harian2 = array_column($wilayahs,'nonsaham_harian');
                        $ghutangspd2 = array_column($wilayahs,'hutangspd');
                        $gpiutangberedar2 = array_column($wilayahs,'piutangberedar');
                        $gpiutanglalai_1bulan2 = array_column($wilayahs,'piutanglalai_1bulan');
                        $gpiutanglalai_12bulan2 = array_column($wilayahs,'piutanglalai_12bulan');
                        $gdcr2 = array_column($wilayahs,'dcr');
                        $gdcu2 = array_column($wilayahs,'dcu');
                        $gtotalpendapatan2 = array_column($wilayahs,'totalpendapatan');
                        $gtotalbiaya2 = array_column($wilayahs,'totalbiaya');
                        $gshu2 = array_column($wilayahs,'shu');

                        foreach ($wilayahs as $data){
                            $totalanggota2 = $data['l_biasa'] + $data['l_lbiasa'] + $data['p_biasa'] + $data['p_lbiasa'];
                            $piutangbersih2 = $data['piutangberedar'] - ($data['piutanglalai_1bulan'] + $data['piutanglalai_12bulan']);
                            if($data['aset'] != 0){
                                $rasioberedar2 = number_format((($data['piutangberedar'] / $data['aset'])*100),2);
                            }else{
                                $rasioberedar2 = 0;
                            }
                            if($data['piutangberedar'] != 0){
                                $rasiolalai2 = number_format(((($data['piutanglalai_1bulan'] + $data['piutanglalai_12bulan']) / $data['piutangberedar'])*100),2);
                            }else{
                                $rasiolalai2 = 0;
                            }
                            $gtotalanggota2[] = $totalanggota2;
                            $gpiutangbersih2[] = $piutangbersih2;
                            $grasioberedar2[] = $rasioberedar2;
                            $grasiolalai2[] = $rasiolalai2;
                        }
                        ?>
                        <canvas id="chart2" height="100em"></canvas>
                        <hr/>
                        <div class="input-group">
                            <div class="input-group-addon primary-color"><i class="fa fa-fw fa-bar-chart"></i> Grafik Laporan Berdasarkan</div>
                            <select class="form-control" id="chart_select2">
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
                    <div class="tab-pane" id="tab_do_graf">
                        <?php
                            $gperiode3 = array_column($dos,'nama');
                            $gl_biasa3= array_column($dos,'l_biasa');
                            $gl_lbiasa3 = array_column($dos,'l_lbiasa');
                            $gp_biasa3 = array_column($dos,'p_biasa');
                            $gp_lbiasa3 = array_column($dos,'p_lbiasa');
                            $gaset3 = array_column($dos,'aset');
                            $gaktivalancar3 = array_column($dos,'aktivalancar');
                            $gsimpanansaham3 = array_column($dos,'simpanansaham');
                            $gnonsaham_unggulan3 = array_column($dos,'nonsaham_unggulan');
                            $gnonsaham_harian3 = array_column($dos,'nonsaham_harian');
                            $ghutangspd3 = array_column($dos,'hutangspd');
                            $gpiutangberedar3 = array_column($dos,'piutangberedar');
                            $gpiutanglalai_1bulan3 = array_column($dos,'piutanglalai_1bulan');
                            $gpiutanglalai_12bulan3 = array_column($dos,'piutanglalai_12bulan');
                            $gdcr3 = array_column($dos,'dcr');
                            $gdcu3 = array_column($dos,'dcu');
                            $gtotalpendapatan3 = array_column($dos,'totalpendapatan');
                            $gtotalbiaya3 = array_column($dos,'totalbiaya');
                            $gshu3 = array_column($dos,'shu');

                            foreach ($dos as $data){
                                $totalanggota3 = $data['l_biasa'] + $data['l_lbiasa'] + $data['p_biasa'] + $data['p_lbiasa'];
                                $piutangbersih3 = $data['piutangberedar'] - ($data['piutanglalai_1bulan'] + $data['piutanglalai_12bulan']);
                                 if($data['aset'] != 0){
                                    $rasioberedar3 = number_format((($data['piutangberedar'] / $data['aset'])*100),2);
                                }else{
                                    $rasioberedar3 = 0;
                                }
                                if($data['piutangberedar'] != 0){
                                    $rasiolalai3 = number_format(((($data['piutanglalai_1bulan'] + $data['piutanglalai_12bulan']) / $data['piutangberedar'])*100),2);
                                }else{
                                    $rasiolalai3 = 0;
                                }
                                $gtotalanggota3[] = $totalanggota3;
                                $gpiutangbersih3[] = $piutangbersih3;
                                $grasioberedar3[] = $rasioberedar3;
                                $grasiolalai3[] = $rasiolalai3;
                            }
                        ?>
                        <canvas id="chart3" height="100em"></canvas>
                        <hr/>
                        <div class="input-group">
                            <div class="input-group-addon primary-color">
                            @if(Request::is('admins/laporancu'))
                                <i class="fa fa-fw fa-bar-chart"></i>
                            @else
                                <i class="fa fa-fw fa-line-chart"></i>
                            @endif
                            Grafik Laporan Berdasarkan</div>
                            <select class="form-control" id="chart_select3">
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
                @endif
                @if(Request::is('admins/laporancu/index_bkcu') || Request::is('admins/laporancu/index_cu*'))
                    <div class="tab-pane" id="tab_tumbuh_graf">
                        <?php
                            if(!empty($datatumbuh)){
                                $gperiode3 = array_column($datatumbuh,'nama');
                                $gl_biasa3= array_column($datatumbuh,'l_biasa');
                                $gl_lbiasa3 = array_column($datatumbuh,'l_lbiasa');
                                $gp_biasa3 = array_column($datatumbuh,'p_biasa');
                                $gp_lbiasa3 = array_column($datatumbuh,'p_lbiasa');
                                $gtotalanggota3  = array_column($datatumbuh,'total');
                                $gaset3 = array_column($datatumbuh,'aset');
                                $gaktivalancar3 = array_column($datatumbuh,'aktivalancar');
                                $gsimpanansaham3 = array_column($datatumbuh,'simpanansaham');
                                $gnonsaham_unggulan3 = array_column($datatumbuh,'nonsaham_unggulan');
                                $gnonsaham_harian3 = array_column($datatumbuh,'nonsaham_harian');
                                $ghutangspd3 = array_column($datatumbuh,'hutangspd');
                                $gpiutangbersih3 = array_column($datatumbuh,'piutangbersih');
                                $gpiutangberedar3 = array_column($datatumbuh,'piutangberedar');
                                $gpiutanglalai_1bulan3 = array_column($datatumbuh,'piutanglalai_1bulan');
                                $gpiutanglalai_12bulan3 = array_column($datatumbuh,'piutanglalai_12bulan');
                                $grasioberedar3 = array_column($datatumbuh,'rasio_beredar');
                                $grasiolalai3 = array_column($datatumbuh,'rasio_lalai');
                                $gdcr3 = array_column($datatumbuh,'dcr');
                                $gdcu3 = array_column($datatumbuh,'dcu');
                                $gtotalpendapatan3 = array_column($datatumbuh,'totalpendapatan');
                                $gtotalbiaya3 = array_column($datatumbuh,'totalbiaya');
                                $gshu3 = array_column($datatumbuh,'shu');
                            }
                        ?>
                        <canvas id="chart3" height="100em"></canvas>
                        <hr/>
                        <div class="input-group">
                            <div class="input-group-addon primary-color"><i class="fa fa-fw fa-line-chart"></i> Grafik Laporan Berdasarkan</div>
                            <select class="form-control" id="chart_select3">
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
                @endif
                @if(!Request::is('admins/laporancu/index_bkcu'))
                    <div class="tab-pane" id="tab_pearls_graf">
                        <?php
                            if(!empty($datapearls)){
                                $gp1 = array_column($datapearls,'p1');
                                $gp2 = array_column($datapearls,'p2');
                                $ge1 = array_column($datapearls,'e1');
                                $ge5 = array_column($datapearls,'e5');
                                $ge6 = array_column($datapearls,'e6');
                                $ge9 = array_column($datapearls,'e9');
                                $ga1 = array_column($datapearls,'a1');
                                $ga2 = array_column($datapearls,'a2');
                                $gr7 = array_column($datapearls,'r7');
                                $gr9 = array_column($datapearls,'r9');
                                $gl1 = array_column($datapearls,'l1');
                                $gs10 = array_column($datapearls,'s10');
                                $gs11 = array_column($datapearls,'s11');
                            }
                            ?>
                        <canvas id="chart4" height="100em"></canvas>
                        <hr/>
                        <div class="input-group">
                            <?php $culists = App\Cuprimer::orderBy('name','asc')->get(); ?>
                            <div class="input-group-addon primary-color">
                            @if(Request::is('admins/laporancu'))
                                <i class="fa fa-fw fa-bar-chart"></i>
                            @else
                                <i class="fa fa-fw fa-line-chart"></i>
                            @endif
                            Grafik P.E.A.R.L.S Berdasarkan</div>
                            <select class="form-control" id="chart_select4">
                                <option value="p1">P1</option>
                                <option value="p2">P2</option>
                                <option value="e1">E1</option>
                                <option value="e5">E5</option>
                                <option value="e6">E6</option>
                                <option value="e9">E9</option>
                                <option value="a1">A1</option>
                                <option value="a2">A2</option>
                                <option value="r7">R7</option>
                                <option value="r9">R9</option>
                                <option value="l1">L1</option>
                                <option value="s10">S10</option>
                                <option value="s11">S11</option>
                            </select>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    @endif
    <!--grafik-->

</section>
<!-- upload excel -->
<div class="modal fade" id="modalexcel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    {{ Form::open(array('route' => array('admins.'.$kelas.'.importexcel'), 'files' => true)) }}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-light-blue-active color-palette">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="fa fa-upload"></i> Upload File Excel</h4>
            </div>
            <div class="modal-body">
                @if(Request::is('admins/laporancu') || Request::is('admins/laporancu/index_periode/*'))
                    <h4>Silahkan pilih tipe file excel yang akan diupload.</h4>
                    <table class="table table-condese table-bordered">
                        <tr>
                            <td><label class="radio-inline">
                              <input type="radio" name="radiobtn" id="singlebtn" value="single" onclick="func_single()">Satu CU
                            </label></td>
                            <td><label class="radio-inline">
                              <input type="radio" name="radiobtn" id="multibtn" value="multi" onclick="func_multi()">Beberapa CU
                            </label></td>
                        </tr>
                    </table>
                    <div id="singlediv" style="display: none;">
                        <h4>Pilih CU</h4>
                        <div class="input-group" style="margin-bottom: 20px;">
                            <div class="input-group-addon primary-color"><i class="fa fa-building"></i></div>
                            <select class="form-control" id="dynamic_select" name="nama_cu">
                                @foreach($culists as $culist)
                                    <option value="{{$culist->no_ba}}">{{ $culist->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <h4>Periode Laporan</h4>
                        <div class="input-group" style="margin-bottom: 20px;">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <input type="text" name="peritode" class="form-control"
                                   data-inputmask="'alias': 'date'" placeholder="dd/mm/yyyy" />
                        </div>
                        <h4>Masukkan file excel disini</h4>
                        <input type="file" class="form-control" name="import_single"
                               accept="application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
                        <p>Pastikan menggunakan format berikut: <a href="">format excel</a></p>
                    </div>
                    <div id="multidiv" style="display: none;">
                        <h4>Masukkan file excel disini</h4>
                        <input type="file" class="form-control" name="import_multi"
                               accept="application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
                        <p>Pastikan menggunakan format berikut: <a href="{{ route('file',array('formatcu1.xlsx'))}}">format excel</a></p>
                    </div>
                @else
                    <h4>Periode Laporan</h4>
                    <div class="input-group" style="margin-bottom: 20px;">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <input type="text" name="peritode" class="form-control"
                               data-inputmask="'alias': 'date'" placeholder="dd/mm/yyyy" />
                    </div>
                    <h4>Masukkan file excel disini</h4>
                    <input type="file" class="form-control" name="import_multi"
                           accept="application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
                    <p>Pastikan menggunakan format berikut: <a href="{{ route('file',array('formatcu1.xlsx'))}}">format excel</a></p>
                @endif
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="modalbutton"><i class="fa fa-upload"></i> Upload</button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
    {{ Form::close() }}
</div>
<!-- /upload excel-->

{{-- puliahkan --}}
@if(Request::is('admins/laporancu/index_hapus') || Request::is('admins/laporancu/index_cu*'))
    <div class="modal fade" id="modalpulih" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        {{ Form::model($datashapus,array('route' => array('admins.'.$kelas.'.restore'))) }}
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-light-blue-active color-palette">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title "><i class="fa fa-check"></i> Pulihkan Laporan</h4>
                </div>
                <div class="modal-body">
                    <input type="text" name="id" value="" id="modalpulih_id" hidden>
                    <h4>Memulihkan laporan ini?</h4>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="modalbutton"><i class="fa fa-check"></i> Pulihkan</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
        {{ Form::close() }}
    </div>
@endif
{{-- /pulihkan --}}

{{-- detail pearls --}}
<div class="modal fade" id="modalformula" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    {{ Form::open(array('route' => array('admins.'.$kelas.'.update_pearls'))) }}
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-light-blue-active color-palette">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="judul"></h4>
            </div>
            <div class="modal-body">
                <h4>Rumus</h4>
                <p id='keterangan'></p>
                <div class="well pre-scrollable"><p style="margin-bottom: 0px;" id="formula" class="text-center"></p></div>
                <p id='keterangan2'></p>
                <div class="well pre-scrollable" id="formula2well"><p style="margin-bottom: 0px;" id="formula2" class="text-center"></p></div>
                <b><u>Indikator:</u></b>
                <p id='indikator'></p>
                <hr/>
                <h4>Perhitungan <span id='cu'></span></h4>
                 <p id='keterangan3'></p>
                <div class="well pre-scrollable" id="nilaiwell" style="margin-bottom: 5px;"><p style="margin-bottom: 0px;" id="nilai" class="text-center"></p></div>
                <div class="well pre-scrollable" id="nilai2well" style="margin-bottom: 5px;"><p style="margin-bottom: 0px;" id="nilai2" class="text-center"></p></div>
                
                <hr id="hrubah" style="display:none"/>
                <div id="areaubah" style="display:none">
                    <input type="text" name="id_ubah" id="id_ubah" hidden />
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" OnClick="func_ubah()" id="btn_ubah"><i class="fa fa-pencil"></i> Ubah</button>
                <button type="submit" class="btn btn-primary" id="btn_simpan"><i class="fa fa-save"></i> Simpan</button>
                <button type="button" class="btn btn-default" OnClick="func_batal()" id="btn_batal"><i class="fa fa-ban"></i> Batal</button>
                <button type="button" class="btn btn-default" id="btn_ok" data-dismiss="modal"><i class="fa fa-check"></i> Ok</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
    {{ Form::close() }}
</div>
{{-- detail pearls --}}
@stop

@section('js')
@include('admins._components.datatable_JS')
<script type="text/javascript" src="{{ URL::asset('plugins/chartJS/Chart.bundle.js') }}"></script>

@if(!Request::is('admins/laporancu/index_hapus'))
    @include('admins.laporancu._component.grafik_data')
@endif

@if(Request::is('admins/laporancu') || Request::is('admins/laporancu/index_periode*'))
    @include('admins.laporancu._component.datatable_semua')
    @include('admins.laporancu._component.datatable_total')
    @include('admins.laporancu._component.datatable_konsolidasi')
    @include('admins.laporancu._component.datatable_provinsi')
    @include('admins.laporancu._component.datatable_do')
    @include('admins.laporancu._component.grafik_data2')
    @include('admins.laporancu._component.grafik_data3')
@elseif(Request::is('admins/laporancu/index_bkcu') || Request::is('admins/laporancu/index_cu*'))
    @include('admins.laporancu._component.datatable_konsolidasi')
    @include('admins.laporancu._component.datatable_do')
    @include('admins.laporancu._component.grafik_data3')
@endif

@if(!Request::is('admins/laporancu/index_bkcu') && !Request::is('admins/laporancu/index_hapus'))
    @include('admins.laporancu._component.datatable_pearls')
    @include('admins.laporancu._component.grafik_datapearls')
@endif

@if(Request::is('admins/laporancu/index_hapus') || Request::is('admins/laporancu/index_cu*'))
    @include('admins.laporancu._component.datatable_semua')   
@endif

@if(!Request::is('admins/laporancu/index_hapus'))
    <script>
        window.onload = function() {
            var ctx = document.getElementById("chart").getContext("2d");
            window.chart = new Chart(ctx, config);

            @if(Request::is('admins/laporancu') || Request::is('admins/laporancu/index_periode*'))
                var ctx2 = document.getElementById("chart2").getContext("2d");
                var ctx3 = document.getElementById("chart3").getContext("2d");
                window.chart2 = new Chart(ctx2, config2);
                window.chart3 = new Chart(ctx3, config3);
            @elseif(Request::is('admins/laporancu/index_bkcu') || Request::is('admins/laporancu/index_cu*'))
                var ctx3 = document.getElementById("chart3").getContext("2d");
                window.chart3 = new Chart(ctx3, config3);
            @endif

            @if(!Request::is('admins/laporancu/index_bkcu'))
                var ctx4 = document.getElementById("chart4").getContext("2d");
                window.chart4 = new Chart(ctx4, config4);
            @endif
        };
    </script>
@endif

{{-- @include('admins.laporancu._component.grafik')
@include('admins.laporancu._component.grafik_tombol')
 --}}

{{--common function--}}
<script>
    var htmlubah = '';
    var areaubah = $('#areaubah'); 
    var id = '';
    var l_biasa = '';
    var l_lbiasa = '';
    var p_biasa = '';
    var p_lbiasa = '';
    var totalanggota_lalu = '';
    var dcu = '';
    var dcr = '';
    var simpanansaham = '';
    var simpanansaham_des = '';
    var nonsaham_unggulan = '';
    var nonsaham_harian = '';
    var totalhutang_pihak3 = '';
    var iuran_gedung = '';
    var donasi = '';
    var shu_lalu = '';
    var dcr = '';
    var aset = '';
    var aset_lalu = '';
    var aset_masalah = '';
    var aset_tidak_menghasilkan = '';
    var piutangberedar = '';
    var piutanglalai_1bulan = '';
    var piutanglalai_12bulan = '';
    var totalbiaya = '';
    var beban_penyisihandcr = '';
    var investasi_likuid = '';
    var aset_likuid_tidak_menghasilkan = '';
    var hutang_tidak_berbiaya_30hari = '';
    var hargapasar = '';
    var lajuinflasi = '';
    var bulan = '';

    $('#modalformula').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget);
      var judul = button.data('judul');
      var cu = button.data('cu');
      var indikator = button.data('indikator');
      var keterangan = button.data('keterangan');
      var keterangan2 = button.data('keterangan2');
      var keterangan3 = button.data('keterangan3');
      var formula = button.data('formula');
      var formula2 = button.data('formula2');
      var nilai = button.data('nilai');
      var nilai2 = button.data('nilai2');

      $('#judul').text(judul);
      $('#cu').text(cu);
      $('#formula').text(formula);
      $('#indikator').text(indikator);

      $('#areaubah').hide();
      $('#btn_simpan').hide();
      $('#btn_batal').hide();
      $('#btn_ubah').show();
      $('#btn_ok').show();

      if(keterangan == null){
        $('#keterangan').text('');
      }else{
        $('#keterangan').text(keterangan);
      }

      if(keterangan2 == null){
        $('#keterangan2').text('');
      }else{
        $('#keterangan2').text(keterangan2);
      }

      if(keterangan3 == null){
        $('#keterangan3').text('');
      }else{
        $('#keterangan3').text(keterangan3);
      }

      if(formula2 == null){
        $('#formula2well').hide();
        $('#formula2').text('');
      }else{
        $('#formula2well').show();
        $('#formula2').text(formula2);
      }

      if(nilai == null){
        $('#nilaiwell').hide();
        $('#nilai').text('');
      }else{
        $('#nilaiwell').show();
        $('#nilai').text(nilai);
      }

      if(nilai2 == null){
        $('#nilai2well').hide();
        $('#nilai2').text('');
      }else{
        $('#nilai2well').show();
        $('#nilai2').text(nilai2);
      }

      MathJax.Hub.Queue(["Typeset",MathJax.Hub]);

      id = button.data('id');

      $('#id_ubah').val(id);
      $('#ubahkonten').remove();
      $('#hrubah').hide();
      htmlubah = '';
      htmlubah += '<div id="ubahkonten" class="row">';
      for(i=1; i< 10; i++){
            var ubahjudul = button.data('ubahjudul'+i);
            var ubahparam = button.data('ubahparam'+i);
            var ubahvalue = button.data('ubahvalue'+i);
            if(ubahvalue  != null){
                htmlubah += func_htmlubah(ubahparam,ubahjudul,ubahvalue,'ubahid'+i);
            }
       }
      htmlubah += '</div>';  
      
    })

    function func_ubah(){
        areaubah.prepend(htmlubah);
        func_addinputmask();

        $('#hrubah').show();
        $('#areaubah').show();
        $('#btn_simpan').show();
        $('#btn_batal').show();

        $('#btn_ubah').hide();
        $('#btn_ok').hide();
    }

    function func_batal(){
        $('#ubahkonten').remove();
        $('#areaubah').hide();
        $('#hrubah').hide();
        $('#btn_simpan').hide();
        $('#btn_batal').hide();

        $('#btn_ubah').show();
        $('#btn_ok').show();
    }

    function func_addinputmask(){
       for(i=1; i< 10; i++){
            func_inputmask('ubahid'+i);
       }
    }

    function func_inputmask(id)
    {
        $('#'+id).inputmask({alias:'numeric',groupSeparator:'.',autoGroup:true,digits:0,radixPoint:',',autoUnmask:true,removeMaskOnSubmit:true
        });
    }

    function func_htmlubah(param,judul,value,id){
        var htmlubah = '<div class="col-sm-6"><div class="form-group">';
            htmlubah +='<h5>'+judul+'</h5>';
            htmlubah +='<div class="input-group">';
                htmlubah +='<span class="input-group-addon">0-9</span>';
                htmlubah +='<input type="text" name='+param+' class="form-control" id='+id+' value='+value+' />';
            htmlubah +='</div>';
           htmlubah +='<div class="help-block">Isi 0 apabila tidak ada.</div>';
        htmlubah +='</div></div>';

        return htmlubah;
    }



    function func_single(){
        $('#singlediv').show();
        $('#multidiv').hide();
    }
    function func_multi(){
        $('#singlediv').hide();
        $('#multidiv').show();
    }
    $(function(){
        // bind change event to select
        $('#dynamic_select').on('change', function () {
            var url = $(this).val(); // get selected value
            if (url) { // require a URL
                window.location.href = url; // redirect
            }
            return false;
        });
    });
    $(function(){
        // bind change event to select
        $('#dynamic_select2').on('change', function () {
            var url = $(this).val(); // get selected value
            if (url) { // require a URL
                window.location.href = url; // redirect
            }
            return false;
        });
    });
    // $('.nav-tabs li a').click(function (e) {
    //     //get selected href
    //     var href = $(this).attr('href');

    //     //set all nav tabs to inactive
    //     $('.nav-tabs li').removeClass('active');

    //     //get all nav tabs matching the href and set to active
    //     $('.nav-tabs li a[href="'+href+'"]').closest('li').addClass('active');

    //     //active tab
    //     $('.tab-pane').removeClass('fade active in');
    //     $('.tab-pane'+href).addClass('fade active in');
    // })
</script>
@stop
