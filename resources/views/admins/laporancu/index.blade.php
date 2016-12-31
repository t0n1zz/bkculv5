<?php
    $culists = App\Models\Cuprimer::orderBy('name','asc')->where('status','=','1')->get();
    $culists_non = App\Models\Cuprimer::orderBy('name','asc')->where('status','=','0')->get();
    if(Request::is('admins/laporancu/index_cu/*')){
        $cuname = App\Models\Cuprimer::orderBy('name','asc')->where('no_ba',$id)->first();
        $title = "Laporan CU " .$cuname->name;
    }elseif(Request::is('admins/laporancu') || Request::is('admins/laporancu/index_periode/*')){
        $title = "Laporan CU";
    }else{
        $title = "Laporan Konsolidasi CU";
    }

    $kelas ='laporancu';
    $cu = Auth::user()->getCU();
?>

@extends('admins._layouts.layout')

@section('css')
@include('admins._components.datatable_CSS')
{{-- <link rel="stylesheet" type="text/css" href="{{asset('plugins/dataTables/extension/FixedColumns/css/fixedColumns.bootstrap.min.css')}}" > --}}
@stop

@section('content')
<!-- header -->
<section class="content-header">
    <h1>
        <i class="fa fa-line-chart"></i> Kelola {{ $title }}
        <small>Mengelola {{ $title }}</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('admins') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><i class="fa fa-line-chart"></i> Kelola Laporan CU</li>
    </ol>
</section>

<!-- /header -->
<section class="content">
    <!-- Alert -->
    @include('admins._layouts.alert')
    <!-- /Alert -->
    <!--content-->
    @if($cu == '0')
    <div class="box box-solid">
        <div class="box-body">
            @if(Request::is('admins/laporancu') || Request::is('admins/laporancu/index_periode*'))
                <div class="col-sm-6" style="padding: .2em ;">
            @elseif(Request::is('admins/laporancu/index_bkcu') || Request::is('admins/laporancu/index_cu*'))
                <div class="col-sm-12" style="padding: .2em ;">
            @endif
                <div class="input-group">
                    <div class="input-group-addon primary-color"><i class="fa fa-file-o fa-fw"></i> Laporan</div>
                    <select class="form-control" id="dynamic_select">
                        <option {{ Request::is('admins/laporancu') ? 'selected' : '' }}
                                value="/admins/laporancu">Semua Credit Union</option>
                        <option {{ Request::is('admins/laporancu/index_bkcu') ? 'selected' : '' }}
                                value="/admins/laporancu/index_bkcu">Konsolidasi</option>
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
                        $data = App\Models\laporancu::orderBy('periode','DESC')->groupBy('periode')->get(['periode']);
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
                <li><a href="#tab_provinsi" data-toggle="tab">Tabel Perkembangan (Provinsi)</a></li>
                <li><a href="#tab_do" data-toggle="tab">Tabel Perkembangan (District Office)</a></li>
            @elseif(Request::is('admins/laporancu/index_cu*') || Request::is('admins/laporancu/index_bkcu')) 
                <li class="active"><a href="#tab_konsolidasi" data-toggle="tab">Tabel Perkembangan</a></li>
                <li><a href="#tab_pertumbuhan" data-toggle="tab">Tabel Pertumbuhan</a></li> 
            @endif

            @if(!Request::is('admins/laporancu/index_bkcu')) 
                <li><a href="#tab_pearls" data-toggle="tab">Tabel P.E.A.R.L.S</a></li>
            @endif
        </ul>
        <div class="tab-content">          
            @if(Request::is('admins/laporancu') || Request::is('admins/laporancu/index_periode/*'))  
                <div class="tab-pane active" id="tab_cu">
                    <div class="input-group tabletools">
                        <div class="input-group-addon"><i class="fa fa-search"></i></div>
                        <input type="text" id="searchtext" class="form-control" placeholder="Kata kunci pencarian..." autofocus>
                    </div>
                    <table class="table table-hover table-bordered" id="dataTables-all" width="100%" > 
                        <thead class="bg-light-blue-active color-palette">
                            <tr>
                                <th rowspan="2" data-sortable="false" >#</th>
                                <th rowspan="2" hidden></th>
                                <th rowspan="2" hidden></th>
                                <th rowspan="2" hidden></th>
                                <th rowspan="2">Credit Union</th>
                                <th rowspan="2">No.Ba</th>
                                <th rowspan="2">District Office</th>
                                <th rowspan="2">Wilayah</th>
                                <th rowspan="2">Periode Laporan</th>
                                <th colspan="5" class="text-center">Anggota</th>
                                <th rowspan="2">ASET</th>
                                <th rowspan="2">Aktiva LANCAR</th>
                                <th rowspan="2">Simpanan Saham(SP+SW)</th>
                                <th colspan="2" class="text-center">Simpanan Non Saham</th>
                                <th rowspan="2">Hutang SPD</th>
                                <th colspan="2" class="text-center">Piutang</th>
                                <th colspan="2" class="text-center">Piutang Lalai</th>
                                <th colspan="2" class="text-center">Rasio Piutang</th>
                                <th rowspan="2">DCR</th>
                                <th rowspan="2">DCU</th>
                                <th colspan="2" class="text-center">Total</th>
                                <th rowspan="2">SHU</th>
                                <th rowspan="2">Tanggal Masuk</th>
                                <th rowspan="2">Tanggal Ubah</th>
                            </tr>
                            <tr>
                                <th>Lelaki Biasa</th>
                                <th>Lelaki L.Biasa</th>
                                <th>Perempuan Biasa</th>
                                <th>Perempuan L.Biasa</th>
                                <th>Total</th>
                                <th>Unggulan</th>
                                <th>Harian & Deposito</th>
                                <th>Beredar</th>
                                <th>Bersih</th>
                                <th> 1-12 Bulan</th>
                                <th> > 12 Bulan</th>
                                <th>Beredar</th>
                                <th>Lalai</th>
                                <th>Pendapatan</th>
                                <th>Biaya</th>
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
                                    $rasio_beredar = $data->aset != 0 ? ($data->piutangberedar / $data->aset)*100 : ($data->piutangberedar / 1)*100; 
                                    $rasio_lalai = $data->piutangberedar != 0 ? (($data->piutanglalai_1bulan + $data->piutanglalai_12bulan) / $data->piutangberedar)*100 : (($data->piutanglalai_1bulan + $data->piutanglalai_12bulan) / 1)*100;
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
                                ?>
                                <tr @if($data->periode < $datas->first()->periode){!! 'class="highlight"'  !!} @endif>
                                    <td class="bg-blue disabled color-palette"></td>
                                    <td hidden>{{ $data->id }}</td>
                                    <td hidden>{{ $data->no_ba }}</td>
                                    @if(!empty($data->cuprimer))
                                        <td hidden>{{ $data->cuprimer->no_ba }}</td>
                                        <td>{{ $data->cuprimer->name }}</td>
                                        <td>{{ $data->cuprimer->no_ba }}</td>
                                    @else
                                        <td hidden>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                    @endif
                                    <td>{{ $do }}</td>
                                    <td>{{ $wilayah }}</td>
                                    <td data-order="{{ $data->periode }}"> @if(!empty($data->periode)){{ $periode }}@else{{ '-' }}@endif</td>
                                    <td>{{ number_format($data->l_biasa,"0",",",".") }}</td>
                                    <td>{{ number_format($data->l_lbiasa,"0",",",".") }}</td>
                                    <td>{{ number_format($data->p_biasa,"0",",",".") }}</td>    
                                    <td>{{ number_format($data->p_lbiasa,"0",",",".") }}</td>
                                    <td>{{ number_format($total,"0",",",".") }}</td>
                                    <td>{{ number_format($data->aset,"0",",",".") }}</td>
                                    <td>{{ number_format($data->aktivalancar,"0",",",".") }}</td>
                                    <td>{{ number_format($data->simpanansaham,"0",",",".") }}</td>
                                    <td>{{ number_format($data->nonsaham_unggulan,"0",",",".") }}</td>
                                    <td>{{ number_format($data->nonsaham_harian,"0",",",".") }}</td>
                                    <td>{{ number_format($data->hutangspd,"0",",",".") }}</td>
                                    <td>{{ number_format($data->piutangberedar,"0",",",".")}}</td>
                                    <td>{{ number_format($piutangbersih,"0",",",".") }}</td>
                                    <td>{{ number_format($data->piutanglalai_1bulan,"0",",",".") }}</td>
                                    <td>{{ number_format($data->piutanglalai_12bulan,"0",",",".") }}</td>
                                    <td>{{ number_format($rasio_beredar,"0",",",".") }} %</td>
                                    <td>{{ number_format($rasio_lalai,"0",",",".") }} %</td>
                                    <td>{{ number_format($data->dcr,"0",",",".") }}</td>
                                    <td>{{ number_format($data->dcu,"0",",",".")}}</td>
                                    <td>{{ number_format($data->totalpendapatan,"0",",",".") }}</td>
                                    <td>{{ number_format($data->totalbiaya,"0",",",".") }}</td>
                                    <td>{{ number_format($data->shu,"0",",",".") }}</td>
                                    <td data-order="{{ $data->created_at }}">@if(!empty($data->created_at)){{ $data->created_at->format('l, j F Y') }}@else{{ '-' }}@endif</td>
                                    <td data-order="{{ $data->updated_at }}">@if(!empty($data->updated_at)){{ $data->updated_at->format('l, j F Y') }}@else{{ '-' }}@endif</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <hr/>
                    <table class="table table-hover table-bordered" id="dataTables-total" width="100%">
                        <thead>
                            <tr class="bg-light-blue-active color-palette">
                                <th rowspan="2" data-sortable="false">&nbsp</th>
                                <th colspan="5" class="text-center">Anggota</th>
                                <th rowspan="2">ASET</th>
                                <th rowspan="2">Aktiva LANCAR</th>
                                <th rowspan="2">Simpanan Saham(SP+SW)</th>
                                <th colspan="2" class="text-center">Simpanan Non Saham</th>
                                <th rowspan="2">Hutang SPD</th>
                                <th colspan="2" class="text-center">Piutang</th>
                                <th colspan="2" class="text-center">Piutang Lalai</th>
                                <th colspan="2" class="text-center">Rasio Piutang</th>
                                <th rowspan="2">DCR</th>
                                <th rowspan="2">DCU</th>
                                <th colspan="2" class="text-center">Total</th>
                                <th rowspan="2">SHU</th>
                            </tr>
                            <tr class="bg-light-blue-active color-palette">
                                <th>Lelaki Biasa</th>
                                <th>Lelaki L.Biasa</th>
                                <th>Perempuan Biasa</th>
                                <th>Perempuan L.Biasa</th>
                                <th>Total</th>
                                <th>Unggulan</th>
                                <th>Harian & Deposito</th>
                                <th>Beredar</th>
                                <th>Bersih</th>
                                <th> 1-12 Bulan</th>
                                <th> > 12 Bulan</th>
                                <th>Beredar</th>
                                <th>Lalai</th>
                                <th>Pendapatan</th>
                                <th>Biaya</th>
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
                <div class="tab-pane" id="tab_provinsi">
                    <div class="input-group tabletools">
                        <div class="input-group-addon"><i class="fa fa-search"></i></div>
                        <input type="text" id="searchtextprov" class="form-control" placeholder="Kata kunci pencarian..." >
                    </div>
                    <table class="table table-hover table-bordered" id="dataTables-provinsi" width="100%">
                        <thead>
                        <tr class="bg-light-blue-active color-palette">
                            <th rowspan="2" data-sortable="false">#</th>
                            <th rowspan="2">Provinsi / Wilayah</th>
                            <th colspan="5" class="text-center">Anggota</th>
                            <th rowspan="2">ASET</th>
                            <th rowspan="2">Aktiva LANCAR</th>
                            <th rowspan="2">Simpanan Saham(SP+SW)</th>
                            <th colspan="2" class="text-center">Simpanan Non Saham</th>
                            <th rowspan="2">Hutang SPD</th>
                            <th colspan="2" class="text-center">Piutang</th>
                            <th colspan="2" class="text-center">Piutang Lalai</th>
                            <th colspan="2" class="text-center">Rasio Piutang</th>
                            <th rowspan="2">DCR</th>
                            <th rowspan="2">DCU</th>
                            <th colspan="2" class="text-center">Total</th>
                            <th rowspan="2">SHU</th>
                        </tr>
                        <tr class="bg-light-blue-active color-palette">
                            <th>Lelaki Biasa</th>
                            <th>Lelaki L.Biasa</th>
                            <th>Perempuan Biasa</th>
                            <th>Perempuan L.Biasa</th>
                            <th>Total</th>
                            <th>Unggulan</th>
                            <th>Harian & Deposito</th>
                            <th>Beredar</th>
                            <th>Bersih</th>
                            <th> 1-12 Bulan</th>
                            <th> > 12 Bulan</th>
                            <th>Beredar</th>
                            <th>Lalai</th>
                            <th>Pendapatan</th>
                            <th>Biaya</th>
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
                        <thead>
                        <tr class="bg-light-blue-active color-palette">
                            <th rowspan="2" data-sortable="false">#</th>
                            <th rowspan="2">District Office</th>
                            <th colspan="5" class="text-center">Anggota</th>
                            <th rowspan="2">ASET</th>
                            <th rowspan="2">Aktiva LANCAR</th>
                            <th rowspan="2">Simpanan Saham(SP+SW)</th>
                            <th colspan="2" class="text-center">Simpanan Non Saham</th>
                            <th rowspan="2">Hutang SPD</th>
                            <th colspan="2" class="text-center">Piutang</th>
                            <th colspan="2" class="text-center">Piutang Lalai</th>
                            <th colspan="2" class="text-center">Rasio Piutang</th>
                            <th rowspan="2">DCR</th>
                            <th rowspan="2">DCU</th>
                            <th colspan="2" class="text-center">Total</th>
                            <th rowspan="2">SHU</th>
                        </tr>
                        <tr class="bg-light-blue-active color-palette">
                            <th>Lelaki Biasa</th>
                            <th>Lelaki L.Biasa</th>
                            <th>Perempuan Biasa</th>
                            <th>Perempuan L.Biasa</th>
                            <th>Total</th>
                            <th>Unggulan</th>
                            <th>Harian & Deposito</th>
                            <th>Beredar</th>
                            <th>Bersih</th>
                            <th> 1-12 Bulan</th>
                            <th> > 12 Bulan</th>
                            <th>Beredar</th>
                            <th>Lalai</th>
                            <th>Pendapatan</th>
                            <th>Biaya</th>
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
                        <input type="text" id="searchtextkonsolidasi" class="form-control" placeholder="Kata kunci pencarian..." autofocus>
                    </div>
                    <table class="table table-hover table-bordered" id="dataTables-konsolidasi" width="100%" > 
                        <thead class="bg-light-blue-active color-palette">
                            <tr>
                                <th rowspan="2" data-sortable="false" >#</th>
                                @if(Request::is('admins/laporancu/index_cu/*'))
                                    <th rowspan="2" hidden></th>
                                @endif
                                <th rowspan="2" >Periode Laporan</th>
                                @if(!Request::is('admins/laporancu/index_cu/*'))
                                    <th rowspan="2">CU</th>
                                    <th rowspan="2">CU <br/>Tepat<br/>Waktu</th>
                                @endif
                                <th colspan="5" class="text-center">Anggota</th>
                                <th rowspan="2">Kekayaan (ASET)</th>
                                <th rowspan="2">Aktiva LANCAR</th>
                                <th rowspan="2">Simpanan Saham(SP+SW)</th>
                                <th colspan="2" class="text-center">Simpanan Non Saham</th>
                                <th rowspan="2">Hutang SPD</th>
                                <th colspan="2" class="text-center">Piutang</th>
                                <th colspan="2" class="text-center">Piutang Lalai</th>
                                <th colspan="2" class="text-center">Rasio Piutang</th>
                                <th rowspan="2">DCR</th>
                                <th rowspan="2">DCU</th>
                                <th colspan="2" class="text-center">Total</th>
                                <th rowspan="2">SHU</th>
                                @if(Request::is('admins/laporancu/index_cu/*'))
                                    <th rowspan="2">Tgl. Terima</th>
                                    <th rowspan="2">Tgl. Ubah</th>
                                @endif
                            </tr>
                            <tr>
                                <th>Lelaki Biasa</th>
                                <th>Lelaki L.Biasa</th>
                                <th>Perempuan Biasa</th>
                                <th>Perempuan L.Biasa</th>
                                <th>Total</th>
                                <th>Unggulan</th>
                                <th>Harian & Deposito</th>
                                <th>Beredar</th>
                                <th>Bersih</th>
                                <th> 1-12 Bulan</th>
                                <th> > 12 Bulan</th>
                                <th>Beredar</th>
                                <th>Lalai</th>
                                <th>Pendapatan</th>
                                <th>Biaya</th>
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
                                        $date2 = new Date($data['created_at']);
                                        $created = $date2->format('d/m/Y');

                                        $date3 = new Date($data['updated_at']);
                                        $updated = $date3->format('d/m/Y');
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
                                    <td data-order="{{ $data['periode'] }}">{{ $periode }}</td>
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
                        <input type="text" id="searchtextkonsolidasi" class="form-control" placeholder="Kata kunci pencarian..." autofocus>
                    </div>
                    <table class="table table-hover table-bordered" id="dataTables-do" width="100%" > 
                        <thead class="bg-light-blue-active color-palette">
                            <tr>
                                <th rowspan="2" data-sortable="false" >#</th>
                                <th rowspan="2">Periode Laporan</th>
                                <th colspan="5" class="text-center">Anggota</th>
                                <th rowspan="2">Kekayaan (ASET)</th>
                                <th rowspan="2">Aktiva LANCAR</th>
                                <th rowspan="2">Simpanan Saham(SP+SW)</th>
                                <th colspan="2" class="text-center">Simpanan Non Saham</th>
                                <th rowspan="2">Hutang SPD</th>
                                <th colspan="2" class="text-center">Piutang</th>
                                <th colspan="2" class="text-center">Piutang Lalai</th>
                                <th colspan="2" class="text-center">Rasio Piutang</th>
                                <th rowspan="2">DCR</th>
                                <th rowspan="2">DCU</th>
                                <th colspan="2" class="text-center">Total</th>
                                <th rowspan="2">SHU</th>
                            </tr>
                            <tr>
                                <th>Lelaki Biasa</th>
                                <th>Lelaki L.Biasa</th>
                                <th>Perempuan Biasa</th>
                                <th>Perempuan L.Biasa</th>
                                <th>Total</th>
                                <th>Unggulan</th>
                                <th>Harian & Deposito</th>
                                <th>Beredar</th>
                                <th>Bersih</th>
                                <th> 1-12 Bulan</th>
                                <th> > 12 Bulan</th>
                                <th>Beredar</th>
                                <th>Lalai</th>
                                <th>Pendapatan</th>
                                <th>Biaya</th>
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
                                            <span class="text-aqua"><i class="fa fa-caret-square-o-up"></i> {{ number_format($l_biasa1,"0",",",".")}}</span>
                                        @elseif($l_biasa1 < 0)
                                            <span class="text-red"><i class="fa fa-caret-square-o-down"></i> {{ number_format(abs($l_biasa1),"0",",",".")}}</span>
                                        @else
                                            -    
                                        @endif
                                    </td>
                                    <td data-order="{{ $l_lbiasa1 }}">
                                        @if($l_lbiasa1 > 0)
                                            <span class="text-aqua"><i class="fa fa-caret-square-o-up"></i> {{ number_format($l_lbiasa1,"0",",",".")}}</span>
                                        @elseif($l_lbiasa1 < 0)
                                            <span class="text-red"><i class="fa fa-caret-square-o-down"></i> {{ number_format(abs($l_lbiasa1),"0",",",".")}}</span>
                                        @else
                                            - 
                                        @endif
                                    </td>
                                    <td data-order="{{ $p_biasa1 }}">
                                        @if($p_biasa1 > 0)
                                            <span class="text-aqua"><i class="fa fa-caret-square-o-up"></i> {{ number_format($p_biasa1,"0",",",".")}}</span>
                                        @elseif($p_biasa1 < 0)
                                            <span class="text-red"><i class="fa fa-caret-square-o-down"></i> {{ number_format(abs($p_biasa1),"0",",",".")}}</span>
                                        @else
                                            - 
                                        @endif
                                    </td>
                                    <td data-order="{{ $p_lbiasa1 }}">
                                        @if($p_lbiasa1 > 0)
                                            <span class="text-aqua"><i class="fa fa-caret-square-o-up"></i> {{ number_format($p_lbiasa1,"0",",",".")}}</span>
                                        @elseif($p_lbiasa1 < 0)
                                            <span class="text-red"><i class="fa fa-caret-square-o-down"></i> {{ number_format(abs($p_lbiasa1),"0",",",".")}}</span>
                                        @else
                                            - 
                                        @endif
                                    </td>
                                    <td data-order="{{ $total1 }}">
                                        @if($total1 > 0)
                                            <span class="text-aqua"><i class="fa fa-caret-square-o-up"></i> {{ number_format($total1,"0",",",".")}}</span>
                                        @elseif($total1 < 0)
                                            <span class="text-red"><i class="fa fa-caret-square-o-down"></i> {{ number_format(abs($total1),"0",",",".")}}</span>
                                        @else
                                            - 
                                        @endif
                                    </td>
                                    <td data-order="{{ $aset1 }}">
                                        @if($aset1 > 0)
                                            <span class="text-aqua"><i class="fa fa-caret-square-o-up"></i> {{ number_format($aset1,"0",",",".")}}</span>
                                        @elseif($aset1 < 0)
                                            <span class="text-red"><i class="fa fa-caret-square-o-down"></i> {{ number_format(abs($aset1),"0",",",".")}}</span>
                                        @else
                                            - 
                                        @endif
                                    </td>
                                    <td data-order="{{ $aktivalancar1 }}">
                                        @if($aktivalancar1 > 0)
                                            <span class="text-aqua"><i class="fa fa-caret-square-o-up"></i> {{ number_format($aktivalancar1,"0",",",".")}}</span>
                                        @elseif($aktivalancar1 < 0)
                                            <span class="text-red"><i class="fa fa-caret-square-o-down"></i> {{ number_format(abs($aktivalancar1),"0",",",".")}}</span>
                                        @else
                                            - 
                                        @endif
                                    </td>
                                    <td data-order="{{ $simpanansaham1 }}">
                                        @if($simpanansaham1 > 0)
                                            <span class="text-aqua"><i class="fa fa-caret-square-o-up"></i> {{ number_format($simpanansaham1,"0",",",".")}}</span>
                                        @elseif($simpanansaham1 < 0)
                                            <span class="text-red"><i class="fa fa-caret-square-o-down"></i> {{ number_format(abs($simpanansaham1),"0",",",".")}}</span>
                                        @else
                                            - 
                                        @endif
                                    </td>
                                    <td data-order="{{ $nonsaham_unggulan1 }}">
                                        @if($nonsaham_unggulan1 > 0)
                                            <span class="text-aqua"><i class="fa fa-caret-square-o-up"></i> {{ number_format($nonsaham_unggulan1,"0",",",".")}}</span>
                                        @elseif($nonsaham_unggulan1 < 0)
                                            <span class="text-red"><i class="fa fa-caret-square-o-down"></i> {{ number_format(abs($nonsaham_unggulan1),"0",",",".")}}</span>
                                        @else
                                            - 
                                        @endif
                                    </td>
                                    <td data-order="{{ $nonsaham_harian1 }}">
                                        @if($nonsaham_harian1 > 0)
                                            <span class="text-aqua"><i class="fa fa-caret-square-o-up"></i> {{ number_format($nonsaham_harian1,"0",",",".")}}</span>
                                        @elseif($nonsaham_harian1 < 0)
                                            <span class="text-red"><i class="fa fa-caret-square-o-down"></i> {{ number_format(abs($nonsaham_harian1),"0",",",".")}}</span>
                                        @else
                                            - 
                                        @endif
                                    </td>
                                    <td data-order="{{ $hutangspd1 }}">
                                        @if($hutangspd1 > 0)
                                            <span class="text-aqua"><i class="fa fa-caret-square-o-up"></i> {{ number_format($hutangspd1,"0",",",".")}}</span>
                                        @elseif($hutangspd1 < 0)
                                            <span class="text-red"><i class="fa fa-caret-square-o-down"></i> {{ number_format(abs($hutangspd1),"0",",",".")}}</span>
                                        @else
                                            - 
                                        @endif
                                    </td>
                                    <td data-order="{{ $piutangberedar1 }}">
                                        @if($piutangberedar1 > 0)
                                            <span class="text-aqua"><i class="fa fa-caret-square-o-up"></i> {{ number_format($piutangberedar1,"0",",",".")}}</span>
                                        @elseif($piutangberedar1 < 0)
                                            <span class="text-red"><i class="fa fa-caret-square-o-down"></i> {{ number_format(abs($piutangberedar1),"0",",",".")}}</span>
                                        @else
                                            - 
                                        @endif
                                    </td>
                                    <td data-order="{{ $piutanglalai_1bulan1 }}">
                                        @if($piutanglalai_1bulan1 > 0)
                                            <span class="text-aqua"><i class="fa fa-caret-square-o-up"></i> {{ number_format($piutanglalai_1bulan1,"0",",",".")}}</span>
                                        @elseif($piutanglalai_1bulan1 < 0)
                                            <span class="text-red"><i class="fa fa-caret-square-o-down"></i> {{ number_format(abs($piutanglalai_1bulan1),"0",",",".")}}</span>
                                        @else
                                            - 
                                        @endif
                                    </td>
                                    <td data-order="{{ $piutanglalai_12bulan1 }}">
                                        @if($piutanglalai_12bulan1 > 0)
                                            <span class="text-aqua"><i class="fa fa-caret-square-o-up"></i> {{ number_format($piutanglalai_12bulan1,"0",",",".")}}</span>
                                        @elseif($piutanglalai_12bulan1 < 0)
                                            <span class="text-red"><i class="fa fa-caret-square-o-down"></i> {{ number_format(abs($piutanglalai_12bulan1),"0",",",".")}}</span>
                                        @else
                                            - 
                                        @endif
                                    </td>
                                    <td data-order="{{ $piutangbersih1 }}">
                                        @if($piutangbersih1 > 0)
                                            <span class="text-aqua"><i class="fa fa-caret-square-o-up"></i> {{ number_format($piutangbersih1,"0",",",".")}}</span>
                                        @elseif($piutangbersih1 < 0)
                                            <span class="text-red"><i class="fa fa-caret-square-o-down"></i> {{ number_format(abs($piutangbersih1),"0",",",".")}}</span>
                                        @else
                                            - 
                                        @endif
                                    </td>
                                    <td data-order="{{ $rasio_beredar1 }}">
                                        @if($rasio_beredar1 > 0)
                                            <span class="text-aqua"><i class="fa fa-caret-square-o-up"></i> {{ number_format(($rasio_beredar1*100),2) }} %</span>
                                        @elseif($rasio_beredar1 < 0)
                                            <span class="text-red"><i class="fa fa-caret-square-o-down"></i> {{ number_format((abs($rasio_beredar1)*100),2) }} %</span>
                                        @else
                                            - 
                                        @endif
                                    </td>
                                    <td data-order="{{ $rasio_lalai1 }}">
                                        @if($rasio_lalai1 > 0)
                                            <span class="text-aqua"><i class="fa fa-caret-square-o-up"></i> {{ number_format(($rasio_lalai1*100),2) }} %</span>
                                        @elseif($rasio_lalai1 < 0)
                                            <span class="text-red"><i class="fa fa-caret-square-o-down"></i> {{ number_format((abs($rasio_lalai1)*100),2) }} %</span>
                                        @else   
                                            - 
                                        @endif
                                    </td>
                                    <td data-order="{{ $dcr1 }}">
                                        @if($dcr1 > 0)
                                            <span class="text-aqua"><i class="fa fa-caret-square-o-up"></i> {{ number_format($dcr1,"0",",",".")}}</span>
                                        @elseif($dcr1 < 0)
                                            <span class="text-red"><i class="fa fa-caret-square-o-down"></i> {{ number_format(abs($dcr1),"0",",",".")}}</span>
                                        @else
                                            - 
                                        @endif
                                    </td>
                                    <td data-order="{{ $dcu1 }}">
                                        @if($dcu1 > 0)
                                            <span class="text-aqua"><i class="fa fa-caret-square-o-up"></i> {{ number_format($dcu1,"0",",",".")}}</span>
                                        @elseif($dcu1 < 0)
                                            <span class="text-red"><i class="fa fa-caret-square-o-down"></i> {{ number_format(abs($dcu1),"0",",",".")}}</span>
                                        @else
                                            - 
                                        @endif
                                    </td>
                                    <td data-order="{{ $totalpendapatan1 }}">
                                        @if($totalpendapatan1 > 0)
                                            <span class="text-aqua"><i class="fa fa-caret-square-o-up"></i> {{ number_format($totalpendapatan1,"0",",",".")}}</span>
                                        @elseif($totalpendapatan1 < 0)
                                            <span class="text-red"><i class="fa fa-caret-square-o-down"></i> {{ number_format(abs($totalpendapatan1),"0",",",".")}}</span>
                                        @else
                                            - 
                                        @endif
                                    </td>
                                    <td data-order="{{ $totalbiaya1 }}">
                                        @if($totalbiaya1 > 0)
                                            <span class="text-aqua"><i class="fa fa-caret-square-o-up"></i> {{ number_format($totalbiaya1,"0",",",".")}}</span>
                                        @elseif($totalbiaya1 < 0)
                                            <span class="text-red"><i class="fa fa-caret-square-o-down"></i> {{ number_format(abs($totalbiaya1),"0",",",".")}}</span>
                                        @else
                                            - 
                                        @endif
                                    </td>
                                    <td data-order="{{ $shu1 }}">
                                        @if($shu1 > 0)
                                            <span class="text-aqua"><i class="fa fa-caret-square-o-up"></i> {{ number_format($shu1,"0",",",".")}}</span>
                                        @elseif($shu1 < 0)
                                            <span class="text-red"><i class="fa fa-caret-square-o-down"></i> {{ number_format(abs($shu1),"0",",",".")}}</span>
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
            @endif

            @if(!Request::is('admins/laporancu/index_bkcu')) 
                <div class="tab-pane" id="tab_pearls">
                    <div class="input-group tabletools">
                        <div class="input-group-addon"><i class="fa fa-search"></i></div>
                        <input type="text" id="searchtextpearls" class="form-control" placeholder="Kata kunci pencarian..." autofocus>
                    </div>
                    <table class="table table-hover table-bordered" id="dataTables-pearls" width="100%" > 
                        <thead class="bg-light-blue-active color-palette">
                            <tr>
                                <th rowspan="2" data-sortable="false" >#</th>
                                @if(!Request::is('admins/laporancu/index_cu/*'))<th rowspan="2">Credit Union</th>@endif
                                <th rowspan="2">Periode Laporan</th>
                                <th colspan="2" class="text-center">[P]<small>rotection</small></th>
                                <th colspan="4" class="text-center">[E]<small>ffective Financial</small></th>
                                <th colspan="2" class="text-center">[A]<small>sset Quality</small></th>
                                <th colspan="2" class="text-center">[R]<small>ates of Return</small></th>
                                <th class="text-center">[L]<small>iquidity</small></th>
                                <th colspan="2" class="text-center">[S]<small>igns of Growth</small></th>
                                <th rowspan="2">Harga Pasar</th>
                                <th rowspan="2">Laju Inflasi</th>
                            </tr>
                            <tr>
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
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i =0; ?>
                            @foreach($datas as $data)
                                <?php  
                                    $date = new Date($data->periode);
                                    $tot_nonsaham = $data->nonsaham_harian + $data->nonsaham_unggulan;
                                    $tot_anggota = $data->l_biasa + $data->l_lbiasa + $data->p_biasa + $data->p_lbiasa;

                                    $p1 = $data->piutanglalai_12bulan != 0 ? $data->dcr / $data->piutanglalai_12bulan : $data->dcr / 0.01;
                                    $p2 = $data->piutanglalai_1bulan != 0 ? ($data->dcr - $data->piutanglalai_12bulan) / $data->piutanglalai_1bulan : ($data->dcr - $data->piutanglalai_12bulan) / 0.01;
                                    if($p1 == 1 && $p2 > 0.35){
                                        $e1 = $data->aset != 0 ? ($data->piutanganggota - (($data->piutanglalai_12bulan) + ((35/100) * $data->piutanglalai_1bulan))) / $data->aset : ($data->piutanganggota - (($data->piutanglalai_12bulan) + ((35/100) * $data->piutanglalai_1bulan))) / 0.01;
                                    }else{
                                        $e1 = $data->aset != 0 ? ($data->piutangberedar - $data->dcr) / $data->aset : ($data->piutangberedar - $data->dcr) / 0.01;
                                    }
                                    $e5 = $data->aset != 0 ? ($data->nonsaham_unggulan + $data->nonsaham_harian) / $data->aset : ($data->nonsaham_unggulan + $data->nonsaham_harian) / 0.01;
                                    $e6 = $data->aset != 0 ? $data->totalhutang_pihak3 / $data->aset : $data->totalhutang_pihak3 / 0.01;
                                    $e9 = $data->aset != 0 ? (($data->dcr + $data->dcu + $data->iuran_gedung + $data->donasi + $data->shu_lalu) - ($data->piutanglalai_12bulan + ((35/100) * $data->piutanglalai_1bulan) + $data->aset_masalah)) / $data->aset : (($data->dcr + $data->dcu + $data->iuran_gedung + $data->donasi + $data->shu_lalu) - ($data->piutanglalai_12bulan + ((35/100) * $data->piutanglalai_1bulan) + $data->aset_masalah)) / 0.01;
                                    $a1 = $data->piutangberedar != 0 ? ($data->piutanglalai_1bulan + $data->piutanglalai_12bulan) / $data->piutangberedar : ($data->piutanglalai_1bulan + $data->piutanglalai_12bulan) / 0.01; 
                                    $a2 = $data->aset != 0 ? $data->aset_tidak_menghasilkan / $data->aset : $data->aset_tidak_menghasilkan / 0.01;
                                    $r7 = $data->ratasaham != 0 ? $data->bjs_saham / $data->ratasaham : $data->bjs_saham / 0.01;
                                    $r9 = $data->rataaset != 0 ? $data->beban_operasional / $data->rataaset : $data->beban_operasional / 0.01;
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
                                    $l1 = $l1 > 1 ? 1 : $l1;
                                    $s10 = $s10 > 1 ? 1 : $s10;
                                    $s11 = $s11 > 1 ? 1 : $s11;

                                    $p1 = number_format($p1*100,2);
                                    $p2 = number_format($p2*100,2);
                                    $e1 = number_format($e1*100,2);
                                    $e5 = number_format($e5*100,2);
                                    $e6 = number_format($e6*100,2);
                                    $e9 = number_format($e9*100,2);
                                    $a1 = number_format($a1*100,2);
                                    $a2 = number_format($a2*100,2);
                                    $r7 = number_format($r7*100,2);
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
                                    ?>  
                                <tr>
                                    <td class="bg-blue disabled color-palette"></td>
                                    @if(!Request::is('admins/laporancu/index_cu/*'))
                                        @if(!empty($data->cuprimer))
                                            <td>{{ $data->cuprimer->name }}</td>
                                        @else
                                            <td>-</td>    
                                        @endif    
                                    @endif
                                    <td data-order="{{ $data->periode }}"> {{ $date->format('F Y') }}</td>
                                    
                                    <td @if($p1 < 100) {!! 'class="bg-red disabled color-palette"' !!} @endif 
                                    > {{ $p1 }} %</td>
                                    
                                    <td @if($p2 < 35) {!! 'class="bg-red disabled color-palette"' !!} @endif 
                                    >{{ $p2 }} %</td>

                                    <td @if($e1 < 70 || $e1 > 80) {!! 'class="bg-red disabled color-palette"' !!} @endif 
                                    >{{ $e1 }} %</td>

                                    <td @if($e5 < 70 || $e5 > 80) {!! 'class="bg-red disabled color-palette"' !!} @endif 
                                    >{{ $e5 }} %</td>

                                    <td @if($e6 > 5) {!! 'class="bg-red disabled color-palette"' !!} @endif 
                                    >{{ $e6 }} %</td>

                                    <td @if($e9 < 10) {!! 'class="bg-red disabled color-palette"' !!} @endif 
                                    >{{ $e9 }} %</td>

                                    <td @if($a1 > 5) {!! 'class="bg-red disabled color-palette"' !!} @endif
                                    >{{ $a1 }} %</td>

                                    <td @if($a2 > 5) {!! 'class="bg-red disabled color-palette"' !!} @endif
                                    >{{ $a2 }} %</td>

                                    <td @if($r7 != $data->hargapasar) {!! 'class="bg-red disabled color-palette"' !!} @endif
                                    >{{ $r7 }} %</td>

                                    <td @if($r9 != 5) {!! 'class="bg-red disabled color-palette"' !!} @endif
                                    >{{ $r9 }} %</td>

                                    <td @if($l1 < 15 || $l1 > 20) {!! 'class="bg-red disabled color-palette"' !!} @endif
                                    >{{ $l1 }} %</td>
                                    
                                    <td @if($s10 < 12) {!! 'class="bg-red disabled color-palette"' !!} @endif
                                    >{{ $s10 }} %</td>

                                    <td @if($s11 < $data->lajuinflasi + 10) {!! 'class="bg-red disabled color-palette"' !!} @endif
                                    >{{ $s11 }} %</td>

                                    <td>{{ number_format($data->hargapasar,2) }} %</td>

                                    <td>{{ number_format($data->lajuinflasi,2) }} %</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div> 
            @endif
        </div>
    </div>
    {{-- table --}}
    <!--grafik-->
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
                    <?php $culists = App\Models\Cuprimer::orderBy('name','asc')->get(); ?>
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
                        <?php $culists = App\Models\Cuprimer::orderBy('name','asc')->get(); ?>
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
                @if($cu == '0')
                    <h5>Silahkan pilih tipe file excel yang akan diupload.</h5>
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
                        <h5>Pilih CU</h5>
                        <div class="input-group" style="margin-bottom: 20px;">
                            <div class="input-group-addon primary-color"><i class="fa fa-building"></i></div>
                            <select class="form-control" id="dynamic_select" name="nama_cu">    
                                @foreach($culists as $culist)
                                    <option value="{{$culist->no_ba}}">{{ $culist->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <h5>Periode Laporan</h5>
                        <div class="input-group" style="margin-bottom: 20px;">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <input type="text" name="peritode" class="form-control"
                                   data-inputmask="'alias': 'date'" placeholder="dd/mm/yyyy" />
                        </div>
                        <h5>Masukkan file excel disini</h5>
                        <input type="file" class="form-control" name="import_single"
                               accept="application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
                        <p>Pastikan menggunakan format berikut: <a href="">format excel</a></p> 
                    </div> 
                    <div id="multidiv" style="display: none;">
                        <h5>Masukkan file excel disini</h5>
                        <input type="file" class="form-control" name="import_multi"
                               accept="application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
                        <p>Pastikan menggunakan format berikut: <a href="">format excel</a></p> 
                    </div>
                @else
                    <h5>Masukkan file excel disini</h5>
                    <input type="file" class="form-control" name="import_multi"
                           accept="application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
                    <p>Pastikan menggunakan format berikut: <a href="">format excel</a></p>         
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
@stop

@section('js')
@include('admins._components.datatable_JS')
<script type="text/javascript" src="{{ URL::asset('plugins/chartJS/Chart.bundle.js') }}"></script>
@include('admins.laporancu._component.grafik_data')

<script>
    $(document).ready(function() {
        $('a[data-toggle="tab"]').on( 'shown.bs.tab', function (e) {
            $.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust();
        } );
    } );
</script>

@if(Request::is('admins/laporancu') || Request::is('admins/laporancu/index_periode*'))
    @include('admins.laporancu._component.datatable_semua')
    @include('admins.laporancu._component.datatable_total')
    @include('admins.laporancu._component.datatable_provinsi')
    @include('admins.laporancu._component.datatable_do')
    @include('admins.laporancu._component.grafik_data2')
    @include('admins.laporancu._component.grafik_data3')
@elseif(Request::is('admins/laporancu/index_bkcu') || Request::is('admins/laporancu/index_cu*'))
    @include('admins.laporancu._component.datatable_konsolidasi')
    @include('admins.laporancu._component.datatable_do')
    @include('admins.laporancu._component.grafik_data3')
@endif

@if(!Request::is('admins/laporancu/index_bkcu'))
    @include('admins.laporancu._component.datatable_pearls')
    @include('admins.laporancu._component.grafik_datapearls')
@endif

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

{{-- @include('admins.laporancu._component.grafik')
@include('admins.laporancu._component.grafik_tombol')
 --}}

{{--common function--}}
<script>
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
