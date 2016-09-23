<?php
$title = "Kelola Perkembangan CU";
$kelas ='perkembangancu';
if(!Request::is('admins/perkembangancu/index_cu/*')){
    $wilayahcuprimers = App\Models\WilayahCuprimer::get();
}
?>

@extends('admins._layouts.layout')

@section('css')
@include('admins._components.datatable_CSS')
<link rel="stylesheet" type="text/css" href="{{asset('plugins/dataTables/extension/FixedColumns/css/fixedColumns.bootstrap.min.css')}}" >
@stop

@section('content')
<!-- header -->
<section class="content-header">
    <h1>
        <i class="fa fa-archive"></i> {{ $title }}
        <small>Mengelola Data Perkembangan CU</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('admins') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><i class="fa fa-book"></i> {{ $title }}</li>
    </ol>
</section>
<!-- /header -->
<section class="content">
    <!-- Alert -->
    @include('admins._layouts.alert')
    <!-- /Alert -->
    <!--content-->
    <div class="box box-solid">
        <div class="box-body">
            <div class="col-sm-6" style="padding-left: 0px; padding-right: .5em;">
                <div class="input-group">
                    <?php $culists = App\Models\Cuprimer::orderBy('name','asc')->get(); ?>
                    <div class="input-group-addon primary-color"><i class="fa fa-list"></i></div>
                    <select class="form-control" id="dynamic_select">
                        <option {{ Request::is('admins/perkembangancu') ? 'selected' : '' }}
                                value="/admins/perkembangancu">SEMUA CU</option>
                        @foreach($culists as $culist)
                            <option {{ Request::is('admins/perkembangancu/index_cu/'.$culist->no_ba) ? 'selected' : '' }}
                                    value="/admins/perkembangancu/index_cu/{{$culist->no_ba}}">{{ $culist->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            @if(!Request::is('admins/perkembangancu/index_cu/*'))
                <div class="col-sm-3" style="padding-left: 0px; padding-right: .5em;">
                    <div class="input-group">
                        <?php
                        $data = App\Models\PerkembanganCU::orderBy('dataper','DESC')->groupBy('dataper')->get(['dataper']);
                        $dataperiode = $data->groupBy('dataper');

                        $dataperiode1 = collect([]);
                        foreach ($dataperiode as $data){
                            $dataperiode1->push($data->first());
                        }

                        $periodes = array_column($dataperiode1->toArray(),'dataper');
                        ?>
                        <div class="input-group-addon primary-color"><i class="fa fa-list"></i></div>
                        <select class="form-control" id="dynamic_select2">
                            @foreach($periodes as $periode)
                                <?php $date = new Date($periode); ?>
                                <option {{ Request::is('admins/perkembangancu/index_periode/'.$periode) ? 'selected' : '' }}
                                        value="/admins/perkembangancu/index_periode/{{$periode}}">Data Per {{ $date->format('F Y') }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            @endif
            <div class="col-sm-3" style="padding-left: 0px; padding-right: .5em;">
                <a href="#" class="btn btn-default modal5" >
                    <i class="fa fa-upload"></i> Upload File
                </a>
            </div>
        </div>
    </div>

    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_cu" data-toggle="tab">Data Perkembangan Credit Union</a></li>
            @if(!Request::is('admins/perkembangancu/index_cu/*'))
                <li><a href="#tab_provinsi" data-toggle="tab">Data Perkembangan Per Provinsi</a></li>
                <li><a href="#tab_do" data-toggle="tab">Data Perkembangan Per District Office</a></li>
            @endif
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade in active" id="tab_cu">
                <div class="input-group tabletools">
                    <div class="input-group-addon"><i class="fa fa-search"></i></div>
                    <input type="text" id="searchtext" class="form-control" placeholder="Kata kunci pencarian..." autofocus>
                </div>

                <table class="table table-hover" id="dataTables-example">
                    <thead>
                    <tr class="bg-light-blue-active color-palette">
                        <th>#</th>
                        <th hidden></th>
                        @if(!Request::is('admins/perkembangancu/index_cu/*'))<th>Nama Credit Union</th>@endif
                        @if(!Request::is('admins/perkembangancu/index_cu/*'))<th>No. <br/> BA</th>@endif
                        @if(!Request::is('admins/perkembangancu/index_cu/*'))<th>District <br/> Office</th>@endif
                        @if(!Request::is('admins/perkembangancu/index_cu/*'))<th>Wilayah</th>@endif
                        <th>Anggota <br/> Lelaki Biasa</th>
                        <th>Anggota <br/> Lelaki L.Biasa</th>
                        <th>Anggota <br/> Perempuan Biasa</th>
                        <th>Anggota <br/> Perempuan L.Biasa</th>
                        <th>Anggota <br/> Total</th>
                        <th>Kekayaan <br/> (ASET)</th>
                        <th>Aktiva <br/> LANCAR</th>
                        <th>Simpanan Saham <br/> (SP+SW)</th>
                        <th>Non Saham <br/> Unggulan</th>
                        <th>Non Saham <br/> Harian & Deposito</th>
                        <th>Hutang <br/> SPD</th>
                        <th>Piutang <br/> Beredar</th>
                        <th>Piutang Lalai <br/> 1-12 Bulan</th>
                        <th>Piutang Lalai <br/> > 12 Bulan</th>
                        <th>Piutang <br/> Bersih</th>
                        <th>Rasio Piutang<br/>  Beredar</th>
                        <th>Rasio Piutang<br/>  Lalai</th>
                        <th>DCR</th>
                        <th>DCU</th>
                        <th>Total <br/> Pendapatan</th>
                        <th>Total <br/> Biaya</th>
                        <th>SHU</th>
                        <th>Data Per</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $tot_l_biasa = 0;
                    $tot_l_lbiasa = 0;
                    $tot_p_biasa = 0;
                    $tot_p_lbiasa = 0;
                    $tot_anggota = 0;
                    $tot_kekayaan = 0;
                    $tot_aktivalancar = 0;
                    $tot_simpanansaham = 0;
                    $tot_nonsaham_unggulan = 0;
                    $tot_nonsaham_harian = 0;
                    $tot_hutangspd = 0;
                    $tot_piutangberedar = 0;
                    $tot_piutanglalai_1bulan = 0;
                    $tot_piutanglalai_12bulan = 0;
                    $tot_piutangbersih = 0;
                    $tot_dcr = 0;
                    $tot_dcu = 0;
                    $tot_totalpendapatan = 0;
                    $tot_totalbiaya = 0;
                    $tot_shu = 0;
                    ?>
                    @foreach($datas as $data)
                        <tr
                        @if(!Request::is('admins/perkembangancu/index_cu/*'))
                            @if($data->dataper < $datas->first()->dataper){!! 'class="highlight"'  !!}@endif
                                @endif>
                            <td></td>
                            <td hidden>{{ $data->id }}</td>
                            @if(!Request::is('admins/perkembangancu/index_cu/*'))
                                @if(!empty($data->cuprimer))<td>{{ $data->cuprimer->name }}</td>@else<td>-</td>@endif
                            @endif

                            @if(!Request::is('admins/perkembangancu/index_cu/*'))
                                @if(!empty($data->cuprimer))<td>{{ $data->cuprimer->no_ba }}</td>@else<td>-</td>@endif
                            @endif

                            @if(!Request::is('admins/perkembangancu/index_cu/*'))
                                <?php
                                if($data->cuprimer->do == "1"){
                                    $do ="Barat";
                                }else if($data->cuprimer->do == "2"){
                                    $do ="Tengah";
                                }else if($data->cuprimer->do == "3"){
                                    $do ="Timur";
                                }
                                ?>
                                @if(!empty($data->cuprimer))<td>{{ $do }}</td>@else<td>-</td>@endif
                            @endif

                            @if(!Request::is('admins/perkembangancu/index_cu/*'))
                                <?php
                                foreach($wilayahcuprimers as $wilayahcuprimer){
                                    if($data->cuprimer->wilayah == $wilayahcuprimer->id){
                                        $wilayah =$wilayahcuprimer->name;
                                    }
                                }
                                ?>
                                @if(!empty($data->cuprimer))<td>{{ $wilayah }}</td>@else<td>-</td>@endif
                            @endif

                            @if(!empty($data->l_biasa))
                                <?php $l_biasa = number_format($data->l_biasa,"0",",","."); $tot_l_biasa += $data->l_biasa;?>
                                <td data-order="{{ $data->l_biasa }}">{{ $l_biasa }}</td>
                            @else
                                <td>0</td>
                            @endif

                            @if(!empty($data->l_lbiasa))
                                <?php $l_lbiasa = number_format($data->l_lbiasa,"0",",",".");  $tot_l_lbiasa += $data->l_lbiasa;?>
                                <td data-order="{{ $data->l_lbiasa }}">{{ $l_lbiasa }}</td>
                            @else
                                <td>0</td>
                            @endif

                            @if(!empty($data->p_biasa))
                                <?php $p_biasa = number_format($data->p_biasa,"0",",","."); $tot_p_biasa += $data->p_biasa;?>
                                <td data-order="{{ $data->p_biasa }}">{{ $p_biasa }}</td>
                            @else
                                <td>0</td>
                            @endif

                            @if(!empty($data->p_lbiasa))
                                <?php $p_lbiasa = number_format($data->p_lbiasa,"0",",","."); $tot_p_lbiasa += $data->p_lbiasa;?>
                                <td data-order="{{ $data->p_lbiasa }}">{{ $p_lbiasa }}</td>
                            @else
                                <td>0</td>
                            @endif

                            @if(!empty($data->l_biasa) || !empty($data->l_lbiasa) || !empty($data->p_biasa) ||!empty($data->p_lbiasa))
                                <?php
                                $total = $data->l_biasa + $data->l_lbiasa + $data->p_biasa + $data->p_lbiasa;
                                $total_num = number_format($total,"0",",",".");
                                $tot_anggota += $total;
                                ?>
                                <td data-order="{{ $total }}">{{ $total_num }}</td>
                            @else
                                <td>0</td>
                            @endif

                            @if(!empty($data->kekayaan))
                                <?php $kekayaan = number_format($data->kekayaan,"0",",","."); $tot_kekayaan += $data->kekayaan;?>
                                <td data-order="{{ $data->kekayaan }}">{{ $kekayaan }}</td>
                            @else
                                <td>0</td>
                            @endif

                            @if(!empty($data->aktivalancar))
                                <?php $aktivalancar = number_format($data->aktivalancar,"0",",","."); $tot_aktivalancar += $data->aktivalancar;?>
                                <td data-order="{{ $data->aktivalancar }}">{{ $aktivalancar }}</td>
                            @else
                                <td>0</td>
                            @endif

                            @if(!empty($data->simpanansaham))
                                <?php $simpanansaham = number_format($data->simpanansaham,"0",",","."); $tot_simpanansaham += $data->simpanansaham;?>
                                <td data-order="{{ $data->simpanansaham }}">{{ $simpanansaham }}</td>
                            @else
                                <td>0</td>
                            @endif

                            @if(!empty($data->nonsaham_unggulan))
                                <?php $nonsaham_unggulan = number_format($data->nonsaham_unggulan,"0",",","."); $tot_nonsaham_unggulan += $data->nonsaham_unggulan;?>
                                <td data-order="{{ $data->nonsaham_unggulan }}">{{ $nonsaham_unggulan }}</td>
                            @else
                                <td>0</td>
                            @endif

                            @if(!empty($data->nonsaham_harian))
                                <?php $nonsaham_harian = number_format($data->nonsaham_harian,"0",",","."); $tot_nonsaham_harian += $data->nonsaham_harian;?>
                                <td data-order="{{ $data->nonsaham_harian }}">{{ $nonsaham_harian }}</td>
                            @else
                                <td>0</td>
                            @endif

                            @if(!empty($data->hutangspd))
                                <?php $hutangspd = number_format($data->hutangspd,"0",",","."); $tot_hutangspd += $data->hutangspd;?>
                                <td data-order="{{ $data->hutangspd }}">{{ $hutangspd }}</td>
                            @else
                                <td>0</td>
                            @endif

                            @if(!empty($data->piutangberedar))
                                <?php $piutangberedar = number_format($data->piutangberedar,"0",",","."); $tot_piutangberedar += $data->piutangberedar;?>
                                <td data-order="{{ $data->piutangberedar }}">{{ $piutangberedar }}</td>
                            @else
                                <td>0</td>
                            @endif

                            @if(!empty($data->piutanglalai_1bulan))
                                <?php $piutanglalai_1bulan = number_format($data->piutanglalai_1bulan,"0",",","."); $tot_piutanglalai_1bulan += $data->piutanglalai_1bulan;?>
                                <td data-order="{{ $data->piutanglalai_1bulan }}">{{ $piutanglalai_1bulan }}</td>
                            @else
                                <td>0</td>
                            @endif

                            @if(!empty($data->piutanglalai_12bulan))
                                <?php $piutanglalai_12bulan = number_format($data->piutanglalai_12bulan,"0",",","."); $tot_piutanglalai_12bulan += $data->piutanglalai_12bulan;?>
                                <td data-order="{{ $data->piutanglalai_12bulan }}">{{ $piutanglalai_12bulan }}</td>
                            @else
                                <td>0</td>
                            @endif

                            @if(!empty($data->piutangberedar) || !empty($data->piutanglalai_1bulan) || !empty($data->piutanglalai_12bulan))
                                <?php
                                $piutangbersih = $data->piutangberedar - ($data->piutanglalai_1bulan + $data->piutanglalai_12bulan);
                                $piutangbersih_num = number_format($piutangbersih,"0",",",".");
                                $tot_piutangbersih += $piutangbersih;
                                ?>
                                <td data-order="{{ $piutangbersih }}">{{ $piutangbersih_num }}</td>
                            @else
                                <td>0</td>
                            @endif

                            @if(!empty($data->kekayaan) || !empty($data->piutangberedar))
                                <?php $rasio_beredar = number_format((($data->piutangberedar / $data->kekayaan)*100),2); ?>
                                <td data-order="{{ $rasio_beredar }}">{{ $rasio_beredar }} %</td>
                            @else
                                <td>0 %</td>
                            @endif

                            @if(!empty($data->piutangberedar) || !empty($data->piutanglalai_1bulan) || !empty($data->piutanglalai_12bulan))
                                <?php $rasio_lalai = number_format(((($data->piutanglalai_1bulan + $data->piutanglalai_12bulan) / $data->piutangberedar)*100),2); ?>
                                <td data-order="{{ $rasio_lalai }}">{{ $rasio_lalai }} %</td>
                            @else
                                <td>0 %</td>
                            @endif

                            @if(!empty($data->dcr))
                                <?php $dcr = number_format($data->dcr,"0",",","."); $tot_dcr += $data->dcr;?>
                                <td data-order="{{ $data->dcr }}">{{ $dcr }}</td>
                            @else
                                <td>0</td>
                            @endif

                            @if(!empty($data->dcu))
                                <?php $dcu = number_format($data->dcu,"0",",","."); $tot_dcu += $data->dcu;?>
                                <td data-order="{{ $data->dcu }}">{{ $dcu }}</td>
                            @else
                                <td>0</td>
                            @endif

                            @if(!empty($data->totalpendapatan))
                                <?php $totalpendapatan = number_format($data->totalpendapatan,"0",",","."); $tot_totalpendapatan += $data->totalpendapatan;?>
                                <td data-order="{{ $data->totalpendapatan }}">{{ $totalpendapatan }}</td>
                            @else
                                <td>0</td>
                            @endif

                            @if(!empty($data->totalbiaya))
                                <?php $totalbiaya = number_format($data->totalbiaya,"0",",","."); $tot_totalbiaya += $data->totalbiaya;?>
                                <td data-order="{{ $data->totalbiaya }}">{{ $totalbiaya }}</td>
                            @else
                                <td>0</td>
                            @endif

                            @if(!empty($data->shu))
                                <?php $shu = number_format($data->shu,"0",",","."); $tot_shu += $data->shu;?>
                                <td data-order="{{ $data->shu }}">{{ $shu }}</td>
                            @else
                                <td>0</td>
                            @endif

                            @if(!empty($data->dataper))
                                <?php $date = new Date($data->dataper); ?>
                                <td data-order="{{ $data->dataper }}"> {{ $date->format('F Y') }}</td>
                            @else
                                <td>0</td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr class="bg-lime-active color-palette">
                        <th>TOTAL</th>
                        <th hidden></th>
                        @if(!Request::is('admins/perkembangancu/index_cu/*'))<th></th>@endif
                        @if(!Request::is('admins/perkembangancu/index_cu/*'))<th></th>@endif
                        @if(!Request::is('admins/perkembangancu/index_cu/*'))<th></th>@endif
                        @if(!Request::is('admins/perkembangancu/index_cu/*'))<th></th>@endif
                        <th>{{ number_format($tot_l_biasa,"0",",",".") }}</th>
                        <th>{{ number_format($tot_l_lbiasa,"0",",",".") }}</th>
                        <th>{{ number_format($tot_p_biasa,"0",",",".") }}</th>
                        <th>{{ number_format($tot_p_lbiasa,"0",",",".") }}</th>
                        <th>{{ number_format($tot_anggota,"0",",",".")}}</th>
                        <th>{{ number_format($tot_kekayaan,"0",",",".") }}</th>
                        <th>{{ number_format($tot_aktivalancar,"0",",",".") }}</th>
                        <th>{{ number_format($tot_simpanansaham,"0",",",".") }}</th>
                        <th>{{ number_format($tot_nonsaham_unggulan,"0",",",".") }}</th>
                        <th>{{ number_format($tot_nonsaham_harian,"0",",",".") }}</th>
                        <th>{{ number_format($tot_hutangspd,"0",",",".") }}</th>
                        <th>{{ number_format($tot_piutangberedar,"0",",",".") }}</th>
                        <th>{{ number_format($tot_piutanglalai_1bulan,"0",",",".") }}</th>
                        <th>{{ number_format($tot_piutanglalai_12bulan,"0",",",".") }}</th>
                        <th>{{ number_format($tot_piutangbersih,"0",",",".") }}</th>
                        <th>-</th>
                        <th>-</th>
                        <th>{{ number_format($tot_dcr,"0",",",".") }}</th>
                        <th>{{ number_format($tot_dcu,"0",",",".") }}</th>
                        <th>{{ number_format($tot_totalpendapatan,"0",",",".") }}</th>
                        <th>{{ number_format($tot_totalbiaya,"0",",",".") }}</th>
                        <th>{{ number_format($tot_shu,"0",",",".") }}</th>
                        <th></th>
                    </tr>
                    </tfoot>
                </table>
            </div>
            @if(!Request::is('admins/perkembangancu/index_cu/*'))
                <div class="tab-pane fade" id="tab_provinsi">
                    <table class="table table-hover" id="dataTables-example3">
                        <thead>
                        <tr class="bg-light-blue-active color-palette">
                            <th>Provinsi</th>
                            <th>Anggota <br/> Lelaki Biasa</th>
                            <th>Anggota <br/> Lelaki L.Biasa</th>
                            <th>Anggota <br/> Perempuan Biasa</th>
                            <th>Anggota <br/> Perempuan L.Biasa</th>
                            <th>Anggota <br/> Total</th>
                            <th>Kekayaan <br/> (ASET)</th>
                            <th>Aktiva <br/> LANCAR</th>
                            <th>Simpanan Saham <br/> (SP+SW)</th>
                            <th>Non Saham <br/> Unggulan</th>
                            <th>Non Saham <br/> Harian & Deposito</th>
                            <th>Hutang <br/> SPD</th>
                            <th>Piutang <br/> Beredar</th>
                            <th>Piutang Lalai <br/> 1-12 Bulan</th>
                            <th>Piutang Lalai <br/> > 12 Bulan</th>
                            <th>Piutang <br/> Bersih</th>
                            <th>Rasio Piutang<br/>  Beredar</th>
                            <th>Rasio Piutang<br/>  Lalai</th>
                            <th>DCR</th>
                            <th>DCU</th>
                            <th>Total <br/> Pendapatan</th>
                            <th>Total <br/> Biaya</th>
                            <th>SHU</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $tot_l_biasa = 0;
                        $tot_l_lbiasa = 0;
                        $tot_p_biasa = 0;
                        $tot_p_lbiasa = 0;
                        $tot_anggota = 0;
                        $tot_kekayaan = 0;
                        $tot_aktivalancar = 0;
                        $tot_simpanansaham = 0;
                        $tot_nonsaham_unggulan = 0;
                        $tot_nonsaham_harian = 0;
                        $tot_hutangspd = 0;
                        $tot_piutangberedar = 0;
                        $tot_piutanglalai_1bulan = 0;
                        $tot_piutanglalai_12bulan = 0;
                        $tot_piutangbersih = 0;
                        $tot_dcr = 0;
                        $tot_dcu = 0;
                        $tot_totalpendapatan = 0;
                        $tot_totalbiaya = 0;
                        $tot_shu = 0;

                        foreach($wilayahcuprimers as $wilayahcuprimer){
                            $wilayahs[$wilayahcuprimer->id] = array(
                                    'id'=> $wilayahcuprimer->id,'nama'=> $wilayahcuprimer->name,'l_biasa' => 0.0,'l_lbiasa' => 0.0,'p_biasa' => 0.0,'p_lbiasa' => 0.0,'kekayaan' => 0.0,
                                    'aktivalancar' => 0.0,'simpanansaham' => 0.0,'nonsaham_unggulan' => 0.0,'nonsaham_harian' => 0.0,
                                    'hutangspd' => 0.0,'piutangberedar' => 0.0,'piutanglalai_1bulan' => 0.0,'piutanglalai_12bulan' => 0.0,
                                    'dcr' => 0.0,'dcu' => 0.0,'totalpendapatan' => 0.0,'totalbiaya' => 0.0,'shu' => 0.0
                            );
                        }

                        foreach($wilayahs as $wil){
                            foreach($datas as $data){
                                if($data->cuprimer->wilayah == $wil['id']){
                                    $wilayahs[$data->cuprimer->wilayah]['l_biasa'] += $data->l_biasa;
                                    $wilayahs[$data->cuprimer->wilayah]['l_lbiasa'] += $data->l_lbiasa;
                                    $wilayahs[$data->cuprimer->wilayah]['p_biasa'] += $data->p_biasa;
                                    $wilayahs[$data->cuprimer->wilayah]['p_lbiasa'] += $data->p_lbiasa;
                                    $wilayahs[$data->cuprimer->wilayah]['kekayaan'] += $data->kekayaan;
                                    $wilayahs[$data->cuprimer->wilayah]['aktivalancar'] += $data->aktivalancar;
                                    $wilayahs[$data->cuprimer->wilayah]['simpanansaham'] += $data->simpanansaham;
                                    $wilayahs[$data->cuprimer->wilayah]['nonsaham_unggulan'] += $data->nonsaham_unggulan;
                                    $wilayahs[$data->cuprimer->wilayah]['nonsaham_harian'] += $data->nonsaham_harian;
                                    $wilayahs[$data->cuprimer->wilayah]['hutangspd'] += $data->hutangspd;
                                    $wilayahs[$data->cuprimer->wilayah]['piutangberedar'] += $data->piutangberedar;
                                    $wilayahs[$data->cuprimer->wilayah]['piutanglalai_1bulan'] += $data->piutanglalai_1bulan;
                                    $wilayahs[$data->cuprimer->wilayah]['piutanglalai_12bulan'] += $data->piutanglalai_12bulan;
                                    $wilayahs[$data->cuprimer->wilayah]['dcr'] += $data->dcr;
                                    $wilayahs[$data->cuprimer->wilayah]['dcu'] += $data->dcu;
                                    $wilayahs[$data->cuprimer->wilayah]['totalpendapatan'] += $data->totalpendapatan;
                                    $wilayahs[$data->cuprimer->wilayah]['totalbiaya'] += $data->totalbiaya;
                                    $wilayahs[$data->cuprimer->wilayah]['shu'] += $data->shu;
                                }
                            };
                        }

                        ?>
                        @foreach($wilayahs as $data)
                            <tr >
                                <td><b>{{ $data['nama'] }}</b></td>

                                <?php $l_biasa = number_format($data['l_biasa'],"0",",","."); $tot_l_biasa += $data['l_biasa'];?>
                                <td data-order="{{ $data['l_biasa'] }}">{{ $l_biasa }}</td>

                                <?php $l_lbiasa = number_format($data['l_lbiasa'],"0",",",".");  $tot_l_lbiasa += $data['l_lbiasa'];?>
                                <td data-order="{{ $data['l_lbiasa'] }}">{{ $l_lbiasa }}</td>


                                <?php $p_biasa = number_format($data['p_biasa'],"0",",","."); $tot_p_biasa += $data['p_biasa'];?>
                                <td data-order="{{ $data['p_biasa'] }}">{{ $p_biasa }}</td>


                                <?php $p_lbiasa = number_format($data['p_lbiasa'],"0",",","."); $tot_p_lbiasa += $data['p_lbiasa'];?>
                                <td data-order="{{ $data['p_lbiasa'] }}">{{ $p_lbiasa }}</td>

                                <?php
                                $total = $data['l_biasa'] + $data['l_lbiasa'] + $data['p_biasa'] + $data['p_lbiasa'];
                                $total_num = number_format($total,"0",",",".");
                                $tot_anggota += $total;
                                ?>
                                <td data-order="{{ $total }}">{{ $total_num }}</td>

                                <?php $kekayaan = number_format($data['kekayaan'],"0",",","."); $tot_kekayaan += $data['kekayaan'];?>
                                <td data-order="{{ $data['kekayaan'] }}">{{ $kekayaan }}</td>

                                <?php $aktivalancar = number_format($data['aktivalancar'],"0",",","."); $tot_aktivalancar += $data['aktivalancar'];?>
                                <td data-order="{{ $data['aktivalancar'] }}">{{ $aktivalancar }}</td>

                                <?php $simpanansaham = number_format($data['simpanansaham'],"0",",","."); $tot_simpanansaham += $data['simpanansaham'];?>
                                <td data-order="{{ $data['simpanansaham'] }}">{{ $simpanansaham }}</td>

                                <?php $nonsaham_unggulan = number_format($data['nonsaham_unggulan'],"0",",","."); $tot_nonsaham_unggulan += $data['nonsaham_unggulan'];?>
                                <td data-order="{{ $data['nonsaham_unggulan'] }}">{{ $nonsaham_unggulan }}</td>

                                <?php $nonsaham_harian = number_format($data['nonsaham_harian'],"0",",","."); $tot_nonsaham_harian += $data['nonsaham_harian'];?>
                                <td data-order="{{ $data['nonsaham_harian'] }}">{{ $nonsaham_harian }}</td>

                                <?php $hutangspd = number_format($data['hutangspd'],"0",",","."); $tot_hutangspd += $data['hutangspd'];?>
                                <td data-order="{{ $data['hutangspd'] }}">{{ $hutangspd }}</td>

                                <?php $piutangberedar = number_format($data['piutangberedar'],"0",",","."); $tot_piutangberedar += $data['piutangberedar'];?>
                                <td data-order="{{ $data['piutangberedar'] }}">{{ $piutangberedar }}</td>

                                <?php $piutanglalai_1bulan = number_format($data['piutanglalai_1bulan'],"0",",","."); $tot_piutanglalai_1bulan += $data['piutanglalai_1bulan'];?>
                                <td data-order="{{ $data['piutanglalai_1bulan'] }}">{{ $piutanglalai_1bulan }}</td>

                                <?php $piutanglalai_12bulan = number_format($data['piutanglalai_12bulan'],"0",",","."); $tot_piutanglalai_12bulan += $data['piutanglalai_12bulan'];?>
                                <td data-order="{{ $data['piutanglalai_12bulan'] }}">{{ $piutanglalai_12bulan }}</td>

                                <?php
                                $piutangbersih = $data['piutangberedar'] - ($data['piutanglalai_1bulan'] + $data['piutanglalai_12bulan']);
                                $piutangbersih_num = number_format($piutangbersih,"0",",",".");
                                $tot_piutangbersih += $piutangbersih;
                                ?>
                                <td data-order="{{ $piutangbersih }}">{{ $piutangbersih_num }}</td>

                                <?php $rasio_beredar = number_format((($data['piutangberedar'] / $data['kekayaan'])*100),2); ?>
                                <td data-order="{{ $rasio_beredar }}">{{ $rasio_beredar }} %</td>

                                <?php $rasio_lalai = number_format(((($data['piutanglalai_1bulan'] + $data['piutanglalai_12bulan']) / $data['piutangberedar'])*100),2); ?>
                                <td data-order="{{ $rasio_lalai }}">{{ $rasio_lalai }} %</td>

                                <?php $dcr = number_format($data['dcr'],"0",",","."); $tot_dcr += $data['dcr'];?>
                                <td data-order="{{ $data['dcr'] }}">{{ $dcr }}</td>

                                <?php $dcu = number_format($data['dcu'],"0",",","."); $tot_dcu += $data['dcu'];?>
                                <td data-order="{{ $data['dcu'] }}">{{ $dcu }}</td>

                                <?php $totalpendapatan = number_format($data['totalpendapatan'],"0",",","."); $tot_totalpendapatan += $data['totalpendapatan'];?>
                                <td data-order="{{ $data['totalpendapatan'] }}">{{ $totalpendapatan }}</td>

                                <?php $totalbiaya = number_format($data['totalbiaya'],"0",",","."); $tot_totalbiaya += $data['totalbiaya'];?>
                                <td data-order="{{ $data['totalbiaya'] }}">{{ $totalbiaya }}</td>

                                <?php $shu = number_format($data['shu'],"0",",","."); $tot_shu += $data['shu'];?>
                                <td data-order="{{ $data['shu'] }}">{{ $shu }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr class="bg-lime-active color-palette">
                            <th>TOTAL</th>
                            <th>{{ number_format($tot_l_biasa,"0",",",".") }}</th>
                            <th>{{ number_format($tot_l_lbiasa,"0",",",".") }}</th>
                            <th>{{ number_format($tot_p_biasa,"0",",",".") }}</th>
                            <th>{{ number_format($tot_p_lbiasa,"0",",",".") }}</th>
                            <th>{{ number_format($tot_anggota,"0",",",".")}}</th>
                            <th>{{ number_format($tot_kekayaan,"0",",",".") }}</th>
                            <th>{{ number_format($tot_aktivalancar,"0",",",".") }}</th>
                            <th>{{ number_format($tot_simpanansaham,"0",",",".") }}</th>
                            <th>{{ number_format($tot_nonsaham_unggulan,"0",",",".") }}</th>
                            <th>{{ number_format($tot_nonsaham_harian,"0",",",".") }}</th>
                            <th>{{ number_format($tot_hutangspd,"0",",",".") }}</th>
                            <th>{{ number_format($tot_piutangberedar,"0",",",".") }}</th>
                            <th>{{ number_format($tot_piutanglalai_1bulan,"0",",",".") }}</th>
                            <th>{{ number_format($tot_piutanglalai_12bulan,"0",",",".") }}</th>
                            <th>{{ number_format($tot_piutangbersih,"0",",",".") }}</th>
                            <th>-</th>
                            <th>-</th>
                            <th>{{ number_format($tot_dcr,"0",",",".") }}</th>
                            <th>{{ number_format($tot_dcu,"0",",",".") }}</th>
                            <th>{{ number_format($tot_totalpendapatan,"0",",",".") }}</th>
                            <th>{{ number_format($tot_totalbiaya,"0",",",".") }}</th>
                            <th>{{ number_format($tot_shu,"0",",",".") }}</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="tab-pane fade" id="tab_do">
                    <table class="table table-hover" id="dataTables-example2">
                        <thead>
                        <tr class="bg-light-blue-active color-palette">
                            <th>District Office</th>
                            <th>Anggota <br/> Lelaki Biasa</th>
                            <th>Anggota <br/> Lelaki L.Biasa</th>
                            <th>Anggota <br/> Perempuan Biasa</th>
                            <th>Anggota <br/> Perempuan L.Biasa</th>
                            <th>Anggota <br/> Total</th>
                            <th>Kekayaan <br/> (ASET)</th>
                            <th>Aktiva <br/> LANCAR</th>
                            <th>Simpanan Saham <br/> (SP+SW)</th>
                            <th>Non Saham <br/> Unggulan</th>
                            <th>Non Saham <br/> Harian & Deposito</th>
                            <th>Hutang <br/> SPD</th>
                            <th>Piutang <br/> Beredar</th>
                            <th>Piutang Lalai <br/> 1-12 Bulan</th>
                            <th>Piutang Lalai <br/> > 12 Bulan</th>
                            <th>Piutang <br/> Bersih</th>
                            <th>Rasio Piutang<br/>  Beredar</th>
                            <th>Rasio Piutang<br/>  Lalai</th>
                            <th>DCR</th>
                            <th>DCU</th>
                            <th>Total <br/> Pendapatan</th>
                            <th>Total <br/> Biaya</th>
                            <th>SHU</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $tot_l_biasa = 0;
                        $tot_l_lbiasa = 0;
                        $tot_p_biasa = 0;
                        $tot_p_lbiasa = 0;
                        $tot_anggota = 0;
                        $tot_kekayaan = 0;
                        $tot_aktivalancar = 0;
                        $tot_simpanansaham = 0;
                        $tot_nonsaham_unggulan = 0;
                        $tot_nonsaham_harian = 0;
                        $tot_hutangspd = 0;
                        $tot_piutangberedar = 0;
                        $tot_piutanglalai_1bulan = 0;
                        $tot_piutanglalai_12bulan = 0;
                        $tot_piutangbersih = 0;
                        $tot_dcr = 0;
                        $tot_dcu = 0;
                        $tot_totalpendapatan = 0;
                        $tot_totalbiaya = 0;
                        $tot_shu = 0;

                        $do = array(
                                'do_barat'=>
                                        array(
                                                'nama' => 'BARAT',
                                                'l_biasa' => 0.0,'l_lbiasa' => 0.0,'p_biasa' => 0.0,'p_lbiasa' => 0.0,'kekayaan' => 0.0,
                                                'aktivalancar' => 0.0,'simpanansaham' => 0.0,'nonsaham_unggulan' => 0.0,'nonsaham_harian' => 0.0,
                                                'hutangspd' => 0.0,'piutangberedar' => 0.0,'piutanglalai_1bulan' => 0.0,'piutanglalai_12bulan' => 0.0,
                                                'dcr' => 0.0,'dcu' => 0.0,'totalpendapatan' => 0.0,'totalbiaya' => 0.0,'shu' => 0.0
                                        ),
                                'do_timur'=>
                                        array(
                                                'nama' => 'TIMUR',
                                                'l_biasa' => 0.0,'l_lbiasa' => 0.0,'p_biasa' => 0.0,'p_lbiasa' => 0.0,'kekayaan' => 0.0,
                                                'aktivalancar' => 0.0,'simpanansaham' => 0.0,'nonsaham_unggulan' => 0.0,'nonsaham_harian' => 0.0,
                                                'hutangspd' => 0.0,'piutangberedar' => 0.0,'piutanglalai_1bulan' => 0.0,'piutanglalai_12bulan' => 0.0,
                                                'dcr' => 0.0,'dcu' => 0.0,'totalpendapatan' => 0.0,'totalbiaya' => 0.0,'shu' => 0.0
                                        ),
                                'do_tengah'=>
                                        array(
                                                'nama' => 'TENGAH',
                                                'l_biasa' => 0.0,'l_lbiasa' => 0.0,'p_biasa' => 0.0,'p_lbiasa' => 0.0,'kekayaan' => 0.0,
                                                'aktivalancar' => 0.0,'simpanansaham' => 0.0,'nonsaham_unggulan' => 0.0,'nonsaham_harian' => 0.0,
                                                'hutangspd' => 0.0,'piutangberedar' => 0.0,'piutanglalai_1bulan' => 0.0,'piutanglalai_12bulan' => 0.0,
                                                'dcr' => 0.0,'dcu' => 0.0,'totalpendapatan' => 0.0,'totalbiaya' => 0.0,'shu' => 0.0
                                        ),
                        );
                        foreach($datas as $data){
                            if($data->cuprimer->do == "1"){
                                $do['do_barat']['l_biasa'] += $data->l_biasa;
                                $do['do_barat']['l_lbiasa'] += $data->l_lbiasa;
                                $do['do_barat']['p_biasa'] += $data->p_biasa;
                                $do['do_barat']['p_lbiasa'] += $data->p_lbiasa;
                                $do['do_barat']['kekayaan'] += $data->kekayaan;
                                $do['do_barat']['aktivalancar'] += $data->aktivalancar;
                                $do['do_barat']['simpanansaham'] += $data->simpanansaham;
                                $do['do_barat']['nonsaham_unggulan'] += $data->nonsaham_unggulan;
                                $do['do_barat']['nonsaham_harian'] += $data->nonsaham_harian;
                                $do['do_barat']['hutangspd'] += $data->hutangspd;
                                $do['do_barat']['piutangberedar'] += $data->piutangberedar;
                                $do['do_barat']['piutanglalai_1bulan'] += $data->piutanglalai_1bulan;
                                $do['do_barat']['piutanglalai_12bulan'] += $data->piutanglalai_12bulan;
                                $do['do_barat']['dcr'] += $data->dcr;
                                $do['do_barat']['dcu'] += $data->dcu;
                                $do['do_barat']['totalpendapatan'] += $data->totalpendapatan;
                                $do['do_barat']['totalbiaya'] += $data->totalbiaya;
                                $do['do_barat']['shu'] += $data->shu;
                            }else if($data->cuprimer->do == "2"){
                                $do['do_tengah']['l_biasa'] += $data->l_biasa;
                                $do['do_tengah']['l_lbiasa'] += $data->l_lbiasa;
                                $do['do_tengah']['p_biasa'] += $data->p_biasa;
                                $do['do_tengah']['p_lbiasa'] += $data->p_lbiasa;
                                $do['do_tengah']['kekayaan'] += $data->kekayaan;
                                $do['do_tengah']['aktivalancar'] += $data->aktivalancar;
                                $do['do_tengah']['simpanansaham'] += $data->simpanansaham;
                                $do['do_tengah']['nonsaham_unggulan'] += $data->nonsaham_unggulan;
                                $do['do_tengah']['nonsaham_harian'] += $data->nonsaham_harian;
                                $do['do_tengah']['hutangspd'] += $data->hutangspd;
                                $do['do_tengah']['piutangberedar'] += $data->piutangberedar;
                                $do['do_tengah']['piutanglalai_1bulan'] += $data->piutanglalai_1bulan;
                                $do['do_tengah']['piutanglalai_12bulan'] += $data->piutanglalai_12bulan;
                                $do['do_tengah']['dcr'] += $data->dcr;
                                $do['do_tengah']['dcu'] += $data->dcu;
                                $do['do_tengah']['totalpendapatan'] += $data->totalpendapatan;
                                $do['do_tengah']['totalbiaya'] += $data->totalbiaya;
                                $do['do_tengah']['shu'] += $data->shu;
                            }else if($data->cuprimer->do == "3"){
                                $do['do_timur']['l_biasa'] += $data->l_biasa;
                                $do['do_timur']['l_lbiasa'] += $data->l_lbiasa;
                                $do['do_timur']['p_biasa'] += $data->p_biasa;
                                $do['do_timur']['p_lbiasa'] += $data->p_lbiasa;
                                $do['do_timur']['kekayaan'] += $data->kekayaan;
                                $do['do_timur']['aktivalancar'] += $data->aktivalancar;
                                $do['do_timur']['simpanansaham'] += $data->simpanansaham;
                                $do['do_timur']['nonsaham_unggulan'] += $data->nonsaham_unggulan;
                                $do['do_timur']['nonsaham_harian'] += $data->nonsaham_harian;
                                $do['do_timur']['hutangspd'] += $data->hutangspd;
                                $do['do_timur']['piutangberedar'] += $data->piutangberedar;
                                $do['do_timur']['piutanglalai_1bulan'] += $data->piutanglalai_1bulan;
                                $do['do_timur']['piutanglalai_12bulan'] += $data->piutanglalai_12bulan;
                                $do['do_timur']['dcr'] += $data->dcr;
                                $do['do_timur']['dcu'] += $data->dcu;
                                $do['do_timur']['totalpendapatan'] += $data->totalpendapatan;
                                $do['do_timur']['totalbiaya'] += $data->totalbiaya;
                                $do['do_timur']['shu'] += $data->shu;
                            }
                        };
                        ?>
                        @foreach($do as $data)
                            <tr >
                                <td><b>{{ $data['nama'] }}</b></td>

                                <?php $l_biasa = number_format($data['l_biasa'],"0",",","."); $tot_l_biasa += $data['l_biasa'];?>
                                <td data-order="{{ $data['l_biasa'] }}">{{ $l_biasa }}</td>

                                <?php $l_lbiasa = number_format($data['l_lbiasa'],"0",",",".");  $tot_l_lbiasa += $data['l_lbiasa'];?>
                                <td data-order="{{ $data['l_lbiasa'] }}">{{ $l_lbiasa }}</td>


                                <?php $p_biasa = number_format($data['p_biasa'],"0",",","."); $tot_p_biasa += $data['p_biasa'];?>
                                <td data-order="{{ $data['p_biasa'] }}">{{ $p_biasa }}</td>


                                <?php $p_lbiasa = number_format($data['p_lbiasa'],"0",",","."); $tot_p_lbiasa += $data['p_lbiasa'];?>
                                <td data-order="{{ $data['p_lbiasa'] }}">{{ $p_lbiasa }}</td>

                                <?php
                                $total = $data['l_biasa'] + $data['l_lbiasa'] + $data['p_biasa'] + $data['p_lbiasa'];
                                $total_num = number_format($total,"0",",",".");
                                $tot_anggota += $total;
                                ?>
                                <td data-order="{{ $total }}">{{ $total_num }}</td>

                                <?php $kekayaan = number_format($data['kekayaan'],"0",",","."); $tot_kekayaan += $data['kekayaan'];?>
                                <td data-order="{{ $data['kekayaan'] }}">{{ $kekayaan }}</td>

                                <?php $aktivalancar = number_format($data['aktivalancar'],"0",",","."); $tot_aktivalancar += $data['aktivalancar'];?>
                                <td data-order="{{ $data['aktivalancar'] }}">{{ $aktivalancar }}</td>

                                <?php $simpanansaham = number_format($data['simpanansaham'],"0",",","."); $tot_simpanansaham += $data['simpanansaham'];?>
                                <td data-order="{{ $data['simpanansaham'] }}">{{ $simpanansaham }}</td>

                                <?php $nonsaham_unggulan = number_format($data['nonsaham_unggulan'],"0",",","."); $tot_nonsaham_unggulan += $data['nonsaham_unggulan'];?>
                                <td data-order="{{ $data['nonsaham_unggulan'] }}">{{ $nonsaham_unggulan }}</td>

                                <?php $nonsaham_harian = number_format($data['nonsaham_harian'],"0",",","."); $tot_nonsaham_harian += $data['nonsaham_harian'];?>
                                <td data-order="{{ $data['nonsaham_harian'] }}">{{ $nonsaham_harian }}</td>

                                <?php $hutangspd = number_format($data['hutangspd'],"0",",","."); $tot_hutangspd += $data['hutangspd'];?>
                                <td data-order="{{ $data['hutangspd'] }}">{{ $hutangspd }}</td>

                                <?php $piutangberedar = number_format($data['piutangberedar'],"0",",","."); $tot_piutangberedar += $data['piutangberedar'];?>
                                <td data-order="{{ $data['piutangberedar'] }}">{{ $piutangberedar }}</td>

                                <?php $piutanglalai_1bulan = number_format($data['piutanglalai_1bulan'],"0",",","."); $tot_piutanglalai_1bulan += $data['piutanglalai_1bulan'];?>
                                <td data-order="{{ $data['piutanglalai_1bulan'] }}">{{ $piutanglalai_1bulan }}</td>

                                <?php $piutanglalai_12bulan = number_format($data['piutanglalai_12bulan'],"0",",","."); $tot_piutanglalai_12bulan += $data['piutanglalai_12bulan'];?>
                                <td data-order="{{ $data['piutanglalai_12bulan'] }}">{{ $piutanglalai_12bulan }}</td>

                                <?php
                                $piutangbersih = $data['piutangberedar'] - ($data['piutanglalai_1bulan'] + $data['piutanglalai_12bulan']);
                                $piutangbersih_num = number_format($piutangbersih,"0",",",".");
                                $tot_piutangbersih += $piutangbersih;
                                ?>
                                <td data-order="{{ $piutangbersih }}">{{ $piutangbersih_num }}</td>

                                <?php $rasio_beredar = number_format((($data['piutangberedar'] / $data['kekayaan'])*100),2); ?>
                                <td data-order="{{ $rasio_beredar }}">{{ $rasio_beredar }} %</td>

                                <?php $rasio_lalai = number_format(((($data['piutanglalai_1bulan'] + $data['piutanglalai_12bulan']) / $data['piutangberedar'])*100),2); ?>
                                <td data-order="{{ $rasio_lalai }}">{{ $rasio_lalai }} %</td>

                                <?php $dcr = number_format($data['dcr'],"0",",","."); $tot_dcr += $data['dcr'];?>
                                <td data-order="{{ $data['dcr'] }}">{{ $dcr }}</td>

                                <?php $dcu = number_format($data['dcu'],"0",",","."); $tot_dcu += $data['dcu'];?>
                                <td data-order="{{ $data['dcu'] }}">{{ $dcu }}</td>

                                <?php $totalpendapatan = number_format($data['totalpendapatan'],"0",",","."); $tot_totalpendapatan += $data['totalpendapatan'];?>
                                <td data-order="{{ $data['totalpendapatan'] }}">{{ $totalpendapatan }}</td>

                                <?php $totalbiaya = number_format($data['totalbiaya'],"0",",","."); $tot_totalbiaya += $data['totalbiaya'];?>
                                <td data-order="{{ $data['totalbiaya'] }}">{{ $totalbiaya }}</td>

                                <?php $shu = number_format($data['shu'],"0",",","."); $tot_shu += $data['shu'];?>
                                <td data-order="{{ $data['shu'] }}">{{ $shu }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr class="bg-lime-active color-palette">
                            <th>TOTAL</th>
                            <th>{{ number_format($tot_l_biasa,"0",",",".") }}</th>
                            <th>{{ number_format($tot_l_lbiasa,"0",",",".") }}</th>
                            <th>{{ number_format($tot_p_biasa,"0",",",".") }}</th>
                            <th>{{ number_format($tot_p_lbiasa,"0",",",".") }}</th>
                            <th>{{ number_format($tot_anggota,"0",",",".")}}</th>
                            <th>{{ number_format($tot_kekayaan,"0",",",".") }}</th>
                            <th>{{ number_format($tot_aktivalancar,"0",",",".") }}</th>
                            <th>{{ number_format($tot_simpanansaham,"0",",",".") }}</th>
                            <th>{{ number_format($tot_nonsaham_unggulan,"0",",",".") }}</th>
                            <th>{{ number_format($tot_nonsaham_harian,"0",",",".") }}</th>
                            <th>{{ number_format($tot_hutangspd,"0",",",".") }}</th>
                            <th>{{ number_format($tot_piutangberedar,"0",",",".") }}</th>
                            <th>{{ number_format($tot_piutanglalai_1bulan,"0",",",".") }}</th>
                            <th>{{ number_format($tot_piutanglalai_12bulan,"0",",",".") }}</th>
                            <th>{{ number_format($tot_piutangbersih,"0",",",".") }}</th>
                            <th>-</th>
                            <th>-</th>
                            <th>{{ number_format($tot_dcr,"0",",",".") }}</th>
                            <th>{{ number_format($tot_dcu,"0",",",".") }}</th>
                            <th>{{ number_format($tot_totalpendapatan,"0",",",".") }}</th>
                            <th>{{ number_format($tot_totalbiaya,"0",",",".") }}</th>
                            <th>{{ number_format($tot_shu,"0",",",".") }}</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            @endif
        </div>
    </div>
    <!--grafik-->
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_cu" data-toggle="tab">Grafik Perkembangan Credit Union</a></li>
            @if(!Request::is('admins/perkembangancu/index_cu/*'))
                <li><a href="#tab_provinsi" data-toggle="tab">Grafik Perkembangan Per Provinsi</a></li>
                <li><a href="#tab_do" data-toggle="tab">Grafik Perkembangan Per District Office</a></li>
            @endif
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade in active" id="tab_cu">
                <?php
                $gl_biasa = array_column($dataarray,'l_biasa');
                $gl_lbiasa = array_column($dataarray,'l_lbiasa');
                $gp_biasa = array_column($dataarray,'p_biasa');
                $gp_lbiasa = array_column($dataarray,'p_lbiasa');
                $gkekayaan = array_column($dataarray,'kekayaan');
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
                    $rasioberedar = number_format((($data['piutangberedar'] / $data['kekayaan'])*100),2);
                    $rasiolalai = number_format(((($data['piutanglalai_1bulan'] + $data['piutanglalai_12bulan']) / $data['piutangberedar'])*100),2);
                    $gtotalanggota[] = $totalanggota;
                    $gpiutangbersih[] = $piutangbersih;
                    $grasioberedar[] = $rasioberedar;
                    $grasiolalai[] = $rasiolalai;
                }
                ?>
                <canvas id="chart" height="100em"></canvas>
                <div class="input-group">
                    <?php $culists = App\Models\Cuprimer::orderBy('name','asc')->get(); ?>
                    <div class="input-group-addon primary-color"><i class="fa fa-list"></i></div>
                    <select class="form-control" id="chart_select">
                        <option value="l_biasa">Anggota Lelaki Biasa</option>
                        <option value="l_lbiasa">Anggota Lelaki Luar Biasa</option>
                        <option value="p_biasa">Anggota Perempuan Biasa</option>
                        <option value="p_lbiasa">Anggota Perempuan Luar Biasa</option>
                        <option value="totalanggota">Total Anggota</option>
                        <option value="aktivalancar">Aktiva Lancar</option>
                        <option value="simpanansaham">Simpanan Saham</option>
                        <option value="nonsaham_unggulan">Simpanan Non Saham Unggulan</option>
                        <option value="nonsaham_harian">Simpanan Non Saham Harian & Deposito</option>
                        <option value="hutangspd">Hutang SPD</option>
                        <option value="kekayaan">Kekayaan (ASET)</option>
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
            @if(!Request::is('admins/perkembangancu/index_cu/*'))
                <div class="tab-pane fade" id="tab_provinsi">
                    <?php
                    $gdataper2 = array_column($wilayahs,'nama');
                    $gl_biasa2 = array_column($wilayahs,'l_biasa');
                    $gl_lbiasa2 = array_column($wilayahs,'l_lbiasa');
                    $gp_biasa2 = array_column($wilayahs,'p_biasa');
                    $gp_lbiasa2 = array_column($wilayahs,'p_lbiasa');
                    $gkekayaan2 = array_column($wilayahs,'kekayaan');
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
                        $rasioberedar2 = number_format((($data['piutangberedar'] / $data['kekayaan'])*100),2);
                        $rasiolalai2 = number_format(((($data['piutanglalai_1bulan'] + $data['piutanglalai_12bulan']) / $data['piutangberedar'])*100),2);
                        $gtotalanggota2[] = $totalanggota2;
                        $gpiutangbersih2[] = $piutangbersih2;
                        $grasioberedar2[] = $rasioberedar2;
                        $grasiolalai2[] = $rasiolalai2;
                    }
                    ?>
                    <canvas id="chart2" height="100em"></canvas>
                    <div class="input-group">
                        <div class="input-group-addon primary-color"><i class="fa fa-list"></i></div>
                        <select class="form-control" id="chart_select2">
                            <option value="l_biasa">Anggota Lelaki Biasa</option>
                            <option value="l_lbiasa">Anggota Lelaki Luar Biasa</option>
                            <option value="p_biasa">Anggota Perempuan Biasa</option>
                            <option value="p_lbiasa">Anggota Perempuan Luar Biasa</option>
                            <option value="totalanggota">Total Anggota</option>
                            <option value="aktivalancar">Aktiva Lancar</option>
                            <option value="simpanansaham">Simpanan Saham</option>
                            <option value="nonsaham_unggulan">Simpanan Non Saham Unggulan</option>
                            <option value="nonsaham_harian">Simpanan Non Saham Harian & Deposito</option>
                            <option value="hutangspd">Hutang SPD</option>
                            <option value="kekayaan">Kekayaan (ASET)</option>
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
                <div class="tab-pane fade" id="tab_do">
                    <?php
                    $gdataper3 = array_column($do,'nama');
                    $gl_biasa3= array_column($do,'l_biasa');
                    $gl_lbiasa3 = array_column($do,'l_lbiasa');
                    $gp_biasa3 = array_column($do,'p_biasa');
                    $gp_lbiasa3 = array_column($do,'p_lbiasa');
                    $gkekayaan3 = array_column($do,'kekayaan');
                    $gaktivalancar3 = array_column($do,'aktivalancar');
                    $gsimpanansaham3 = array_column($do,'simpanansaham');
                    $gnonsaham_unggulan3 = array_column($do,'nonsaham_unggulan');
                    $gnonsaham_harian3 = array_column($do,'nonsaham_harian');
                    $ghutangspd3 = array_column($do,'hutangspd');
                    $gpiutangberedar3 = array_column($do,'piutangberedar');
                    $gpiutanglalai_1bulan3 = array_column($do,'piutanglalai_1bulan');
                    $gpiutanglalai_12bulan3 = array_column($do,'piutanglalai_12bulan');
                    $gdcr3 = array_column($do,'dcr');
                    $gdcu3 = array_column($do,'dcu');
                    $gtotalpendapatan3 = array_column($do,'totalpendapatan');
                    $gtotalbiaya3 = array_column($do,'totalbiaya');
                    $gshu3 = array_column($do,'shu');

                    foreach ($do as $data){
                        $totalanggota3 = $data['l_biasa'] + $data['l_lbiasa'] + $data['p_biasa'] + $data['p_lbiasa'];
                        $piutangbersih3 = $data['piutangberedar'] - ($data['piutanglalai_1bulan'] + $data['piutanglalai_12bulan']);
                        $rasioberedar3 = number_format((($data['piutangberedar'] / $data['kekayaan'])*100),2);
                        $rasiolalai3 = number_format(((($data['piutanglalai_1bulan'] + $data['piutanglalai_12bulan']) / $data['piutangberedar'])*100),2);
                        $gtotalanggota3[] = $totalanggota3;
                        $gpiutangbersih3[] = $piutangbersih3;
                        $grasioberedar3[] = $rasioberedar3;
                        $grasiolalai3[] = $rasiolalai3;
                    }
                    ?>
                    <canvas id="chart3" height="100em"></canvas>
                    <div class="input-group">
                        <div class="input-group-addon primary-color"><i class="fa fa-list"></i></div>
                        <select class="form-control" id="chart_select3">
                            <option value="l_biasa">Anggota Lelaki Biasa</option>
                            <option value="l_lbiasa">Anggota Lelaki Luar Biasa</option>
                            <option value="p_biasa">Anggota Perempuan Biasa</option>
                            <option value="p_lbiasa">Anggota Perempuan Luar Biasa</option>
                            <option value="totalanggota">Total Anggota</option>
                            <option value="aktivalancar">Aktiva Lancar</option>
                            <option value="simpanansaham">Simpanan Saham</option>
                            <option value="nonsaham_unggulan">Simpanan Non Saham Unggulan</option>
                            <option value="nonsaham_harian">Simpanan Non Saham Harian & Deposito</option>
                            <option value="hutangspd">Hutang SPD</option>
                            <option value="kekayaan">Kekayaan (ASET)</option>
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
        </div>
    </div>
</section>

<!-- modal -->
<!-- Hapus -->
<div class="modal fade" id="modal1show" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   {{ Form::model($datas, array('route' => array('admins.'.$kelas.'.destroy',$kelas), 'method' => 'delete')) }}
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title"><i class="fa fa-trash"></i> Hapus Data Perkembangan CU</h4>
        </div>
        <div class="modal-body">
          <h4>Menghapus data perkembangan CU ini ?</h4>
          <input type="text" name="id" value="" id="modal1id" hidden>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-warning" id="modalbutton"><i class="fa fa-check"></i> Iya</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
   {{ Form::close() }}
</div>
<!-- /Hapus -->
<!-- upload excel -->
<div class="modal fade" id="modal5show" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    {{ Form::open(array('route' => array('admins.'.$kelas.'.importexcel'), 'files' => true)) }}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="fa fa-upload"></i> Upload File Excel</h4>
            </div>
            <div class="modal-body">
                <h4>Upload file excel</h4>
                <input type="file" class="form-control" name="import_file"
                       accept="application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-warning" id="modalbutton"><i class="fa fa-check"></i> Upload</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
    {{ Form::close() }}
</div>
<!-- /upload excel-->
<!-- /.modal -->
@stop

@section('js')
@include('admins._components.datatable_JS')
{{--<script type="text/javascript" src="{{ URL::asset('plugins/dataTables/extension/FixedColumns/js/dataTables.fixedColumns.min.js') }}"></script>--}}
<script type="text/javascript" src="{{ URL::asset('admin/datatable.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('plugins/chartJS/Chart.bundle.js') }}"></script>
{{--data grafik--}}
<script>
    var data_l_biasa = {
        labels: {!! json_encode($gdataper,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Anggota Lelaki Biasa",
                data: {!! json_encode($gl_biasa,JSON_NUMERIC_CHECK) !!}
            }
        ]
    };
    var data_l_lbiasa = {
        labels: {!! json_encode($gdataper,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Anggota Lelaki Luar Biasa",
                data: {!! json_encode($gl_lbiasa,JSON_NUMERIC_CHECK) !!}
            }
        ]
    };
    var data_p_biasa = {
        labels: {!! json_encode($gdataper,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Anggota Perempuan Biasa",
                data: {!! json_encode($gp_biasa,JSON_NUMERIC_CHECK) !!}
            }

        ]
    };
    var data_p_lbiasa = {
        labels: {!! json_encode($gdataper,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Anggota Perempuan Luar Biasa",
                data: {!! json_encode($gp_lbiasa,JSON_NUMERIC_CHECK) !!}
            }
        ]
    };
    var data_kekayaan = {
        labels: {!! json_encode($gdataper,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Kekayaan (ASET)",
                data: {!! json_encode($gkekayaan,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_aktivalancar = {
        labels: {!! json_encode($gdataper,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Aktiva Lancar",
                data: {!! json_encode($gaktivalancar,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_simpanansaham = {
        labels: {!! json_encode($gdataper,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Simpanan Saham",
                data: {!! json_encode($gsimpanansaham,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_nonsaham_unggulan = {
        labels: {!! json_encode($gdataper,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Simpanan Non Saham Unggulan",
                data: {!! json_encode($gnonsaham_unggulan,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_nonsaham_harian = {
        labels: {!! json_encode($gdataper,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Simpanan Non Saham Harian & Deposito",
                data: {!! json_encode($gnonsaham_harian,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_hutangspd = {
        labels: {!! json_encode($gdataper,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Hutang SPD",
                data: {!! json_encode($ghutangspd,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_piutangberedar = {
        labels: {!! json_encode($gdataper,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Piutang Beredar",
                data: {!! json_encode($gpiutangberedar,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_piutanglalai_1bulan = {
        labels: {!! json_encode($gdataper,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Piutang Lalai 1-12 Bulan",
                data: {!! json_encode($gpiutanglalai_1bulan,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_piutanglalai_12bulan = {
        labels: {!! json_encode($gdataper,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Piutang Lalai > 12 Bulan",
                data: {!! json_encode($gpiutanglalai_12bulan,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_dcr = {
        labels: {!! json_encode($gdataper,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "DCR",
                data: {!! json_encode($gdcr,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_dcu = {
        labels: {!! json_encode($gdataper,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "DCU",
                data: {!! json_encode($gdcu,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_totalpendapatan = {
        labels: {!! json_encode($gdataper,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Total Pendapatan",
                data: {!! json_encode($gtotalpendapatan,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_totalbiaya = {
        labels: {!! json_encode($gdataper,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Total Biaya",
                data: {!! json_encode($gtotalbiaya,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_shu = {
        labels: {!! json_encode($gdataper,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "SHU",
                data: {!! json_encode($gshu,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_totalanggota = {
        labels: {!! json_encode($gdataper,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Total Anggota",
                data: {!! json_encode($gtotalanggota,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_piutangbersih = {
        labels: {!! json_encode($gdataper,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Piutang Bersih",
                data: {!! json_encode($gpiutangbersih,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_rasioberedar = {
        labels: {!! json_encode($gdataper,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Rasio Piutang Beredar",
                data: {!! json_encode($grasioberedar,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_rasiolalai = {
        labels: {!! json_encode($gdataper,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Rasio Piutang Lalai",
                data: {!! json_encode($grasiolalai,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_anggota = {
        labels: {!! json_encode($gdataper,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Anggota Lelaki Biasa",
                data: {!! json_encode($gl_biasa,JSON_NUMERIC_CHECK) !!}
            },
            {
                label: "Anggota Lelaki Luar Biasa",
                data: {!! json_encode($gl_lbiasa,JSON_NUMERIC_CHECK) !!}
            },
            {
                label: "Anggota Perempuan Biasa",
                data: {!! json_encode($gp_biasa,JSON_NUMERIC_CHECK) !!}
            },
            {
                label: "Anggota Perempuan Luar Biasa",
                data: {!! json_encode($gp_lbiasa,JSON_NUMERIC_CHECK) !!}
            }
        ]
    };
@if(!Request::is('admins/perkembangancu/index_cu/*'))
    var data_l_biasa2 = {
        labels: {!! json_encode($gdataper2,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Anggota Lelaki Biasa",
                data: {!! json_encode($gl_biasa2,JSON_NUMERIC_CHECK) !!}
            }
        ]
    };
    var data_l_lbiasa2 = {
        labels: {!! json_encode($gdataper2,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Anggota Lelaki Luar Biasa",
                data: {!! json_encode($gl_lbiasa2,JSON_NUMERIC_CHECK) !!}
            }
        ]
    };
    var data_p_biasa2 = {
        labels: {!! json_encode($gdataper2,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Anggota Perempuan Biasa",
                data: {!! json_encode($gp_biasa2,JSON_NUMERIC_CHECK) !!}
            }

        ]
    };
    var data_p_lbiasa2 = {
        labels: {!! json_encode($gdataper2,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Anggota Perempuan Luar Biasa",
                data: {!! json_encode($gp_lbiasa2,JSON_NUMERIC_CHECK) !!}
            }
        ]
    };
    var data_kekayaan2 = {
        labels: {!! json_encode($gdataper2,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Kekayaan (ASET)",
                data: {!! json_encode($gkekayaan2,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_aktivalancar2 = {
        labels: {!! json_encode($gdataper2,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Aktiva Lancar",
                data: {!! json_encode($gaktivalancar2,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_simpanansaham2 = {
        labels: {!! json_encode($gdataper2,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Simpanan Saham",
                data: {!! json_encode($gsimpanansaham2,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_nonsaham_unggulan2 = {
        labels: {!! json_encode($gdataper2,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Simpanan Non Saham Unggulan",
                data: {!! json_encode($gnonsaham_unggulan2,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_nonsaham_harian2 = {
        labels: {!! json_encode($gdataper2,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Simpanan Non Saham Harian & Deposito",
                data: {!! json_encode($gnonsaham_harian2,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_hutangspd2 = {
        labels: {!! json_encode($gdataper2,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Hutang SPD",
                data: {!! json_encode($ghutangspd2,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_piutangberedar2 = {
        labels: {!! json_encode($gdataper2,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Piutang Beredar",
                data: {!! json_encode($gpiutangberedar2,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_piutanglalai_1bulan2 = {
        labels: {!! json_encode($gdataper2,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Piutang Lalai 1-12 Bulan",
                data: {!! json_encode($gpiutanglalai_1bulan2,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_piutanglalai_12bulan2 = {
        labels: {!! json_encode($gdataper2,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Piutang Lalai > 12 Bulan",
                data: {!! json_encode($gpiutanglalai_12bulan2,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_dcr2 = {
        labels: {!! json_encode($gdataper2,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "DCR",
                data: {!! json_encode($gdcr2,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_dcu2 = {
        labels: {!! json_encode($gdataper2,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "DCU",
                data: {!! json_encode($gdcu2,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_totalpendapatan2 = {
        labels: {!! json_encode($gdataper2,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Total Pendapatan",
                data: {!! json_encode($gtotalpendapatan2,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_totalbiaya2 = {
        labels: {!! json_encode($gdataper2,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Total Biaya",
                data: {!! json_encode($gtotalbiaya2,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_shu2 = {
        labels: {!! json_encode($gdataper2,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "SHU",
                data: {!! json_encode($gshu2,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_totalanggota2 = {
        labels: {!! json_encode($gdataper2,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Total Anggota",
                data: {!! json_encode($gtotalanggota2,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_piutangbersih2 = {
        labels: {!! json_encode($gdataper2,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Piutang Bersih",
                data: {!! json_encode($gpiutangbersih2,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_rasioberedar2 = {
        labels: {!! json_encode($gdataper2,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Rasio Piutang Beredar",
                data: {!! json_encode($grasioberedar2,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_rasiolalai2 = {
        labels: {!! json_encode($gdataper2,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Rasio Piutang Lalai",
                data: {!! json_encode($grasiolalai2,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };

    var data_l_biasa3 = {
        labels: {!! json_encode($gdataper3,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Anggota Lelaki Biasa",
                data: {!! json_encode($gl_biasa3,JSON_NUMERIC_CHECK) !!}
            }
        ]
    };
    var data_l_lbiasa3 = {
        labels: {!! json_encode($gdataper3,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Anggota Lelaki Luar Biasa",
                data: {!! json_encode($gl_lbiasa3,JSON_NUMERIC_CHECK) !!}
            }
        ]
    };
    var data_p_biasa3 = {
        labels: {!! json_encode($gdataper3,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Anggota Perempuan Biasa",
                data: {!! json_encode($gp_biasa3,JSON_NUMERIC_CHECK) !!}
            }

        ]
    };
    var data_p_lbiasa3 = {
        labels: {!! json_encode($gdataper3,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Anggota Perempuan Luar Biasa",
                data: {!! json_encode($gp_lbiasa3,JSON_NUMERIC_CHECK) !!}
            }
        ]
    };
    var data_kekayaan3 = {
        labels: {!! json_encode($gdataper3,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Kekayaan (ASET)",
                data: {!! json_encode($gkekayaan3,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_aktivalancar3 = {
        labels: {!! json_encode($gdataper3,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Aktiva Lancar",
                data: {!! json_encode($gaktivalancar3,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_simpanansaham3 = {
        labels: {!! json_encode($gdataper3,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Simpanan Saham",
                data: {!! json_encode($gsimpanansaham3,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_nonsaham_unggulan3 = {
        labels: {!! json_encode($gdataper3,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Simpanan Non Saham Unggulan",
                data: {!! json_encode($gnonsaham_unggulan3,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_nonsaham_harian3 = {
        labels: {!! json_encode($gdataper3,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Simpanan Non Saham Harian & Deposito",
                data: {!! json_encode($gnonsaham_harian3,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_hutangspd3 = {
        labels: {!! json_encode($gdataper3,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Hutang SPD",
                data: {!! json_encode($ghutangspd3,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_piutangberedar3 = {
        labels: {!! json_encode($gdataper3,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Piutang Beredar",
                data: {!! json_encode($gpiutangberedar3,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_piutanglalai_1bulan3 = {
        labels: {!! json_encode($gdataper3,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Piutang Lalai 1-12 Bulan",
                data: {!! json_encode($gpiutanglalai_1bulan3,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_piutanglalai_12bulan3 = {
        labels: {!! json_encode($gdataper3,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Piutang Lalai > 12 Bulan",
                data: {!! json_encode($gpiutanglalai_12bulan3,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_dcr3 = {
        labels: {!! json_encode($gdataper3,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "DCR",
                data: {!! json_encode($gdcr3,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_dcu3 = {
        labels: {!! json_encode($gdataper3,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "DCU",
                data: {!! json_encode($gdcu3,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_totalpendapatan3 = {
        labels: {!! json_encode($gdataper3,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Total Pendapatan",
                data: {!! json_encode($gtotalpendapatan3,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_totalbiaya3 = {
        labels: {!! json_encode($gdataper3,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Total Biaya",
                data: {!! json_encode($gtotalbiaya3,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_shu3 = {
        labels: {!! json_encode($gdataper3,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "SHU",
                data: {!! json_encode($gshu3,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_totalanggota3 = {
        labels: {!! json_encode($gdataper3,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Total Anggota",
                data: {!! json_encode($gtotalanggota3,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_piutangbersih3 = {
        labels: {!! json_encode($gdataper3,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Piutang Bersih",
                data: {!! json_encode($gpiutangbersih3,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_rasioberedar3 = {
        labels: {!! json_encode($gdataper3,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Rasio Piutang Beredar",
                data: {!! json_encode($grasioberedar3,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_rasiolalai3 = {
        labels: {!! json_encode($gdataper3,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Rasio Piutang Lalai",
                data: {!! json_encode($grasiolalai3,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
@endif
</script>
{{--grafik--}}
<script>
    var randomColorFactor = function() {
        return Math.round(Math.random() * 255);
    };
    var randomColor = function(opacity) {
        return 'rgba(' + randomColorFactor() + ',' + randomColorFactor() + ',' + randomColorFactor() + ',' + (opacity || '.3') + ')';
    };
    var config = {
        type: 'bar',
        data: data_l_biasa,
        options:{
            responsive: true,
            legend: {
                position: 'top'
            },
            title: {
                display: true,
                text: ''
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
            }
        }
    };
@if(!Request::is('admins/perkembangancu/index_cu/*'))
    var config2 = {
        type: 'bar',
        data: data_l_biasa2,
        options:{
            responsive: true,
            legend: {
                position: 'top'
            },
            title: {
                display: true,
                text: ''
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
            }
        }
    };
    var config3 = {
        type: 'bar',
        data: data_l_biasa3,
        options:{
            responsive: true,
            legend: {
                position: 'top'
            },
            title: {
                display: true,
                text: ''
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
            }
        }
    };
@endif

    $.each(config.data.datasets, function(i, dataset) {
        dataset.borderColor = randomColor(0.4);
        dataset.backgroundColor = randomColor(0.5);
        dataset.pointBorderColor = randomColor(0.7);
        dataset.pointBackgroundColor = randomColor(0.5);
        dataset.pointBorderWidth = 1;
    });
@if(!Request::is('admins/perkembangancu/index_cu/*'))
        $.each(config2.data.datasets, function(i, dataset) {
        dataset.borderColor = randomColor(0.4);
        dataset.backgroundColor = randomColor(0.5);
        dataset.pointBorderColor = randomColor(0.7);
        dataset.pointBackgroundColor = randomColor(0.5);
        dataset.pointBorderWidth = 1;
    });
    $.each(config3.data.datasets, function(i, dataset) {
        dataset.borderColor = randomColor(0.4);
        dataset.backgroundColor = randomColor(0.5);
        dataset.pointBorderColor = randomColor(0.7);
        dataset.pointBackgroundColor = randomColor(0.5);
        dataset.pointBorderWidth = 1;
    });
@endif
    window.onload = function() {
        var ctx = document.getElementById("chart").getContext("2d");
        window.chart = new Chart(ctx, config);
        @if(!Request::is('admins/perkembangancu/index_cu/*'))
            var ctx2 = document.getElementById("chart2").getContext("2d");
            var ctx3 = document.getElementById("chart3").getContext("2d");
            window.chart2 = new Chart(ctx2, config2);
            window.chart3 = new Chart(ctx3, config3);
        @endif
    };
</script>
{{--tombol grafik--}}
<script>
    $(function(){
        // bind change event to select
        $('#chart_select').on('change', function () {
            var id = $(this).val(); // get selected value
            if (id == "l_biasa") { // require a URL
                config.data = data_l_biasa;
            }else if(id == "l_lbiasa"){
                config.data = data_l_lbiasa;
            }else if(id =="p_biasa"){
                config.data = data_p_biasa;
            }else if(id =="p_lbiasa"){
                config.data = data_p_lbiasa;
            }else if(id =="totalanggota"){
                config.data = data_totalanggota;
            }else if(id =="kekayaan"){
                config.data = data_kekayaan;
            }else if(id =="aktivalancar"){
                config.data = data_aktivalancar;
            }else if(id =="simpanansaham"){
                config.data = data_simpanansaham;
            }else if(id =="nonsaham_unggulan"){
                config.data = data_nonsaham_unggulan;
            }else if(id =="nonsaham_harian"){
                config.data = data_nonsaham_harian
            }else if(id =="hutangspd"){
                config.data = data_hutangspd
            }else if(id =="piutangberedar"){
                config.data = data_piutangberedar;
            }else if(id =="piutanglalai_1bulan"){
                config.data = data_piutanglalai_1bulan;
            }else if(id =="piutanglalai_12bulan"){
                config.data = data_piutanglalai_12bulan;
            }else if(id =="dcr"){
                config.data = data_dcr;
            }else if(id =="dcu"){
                config.data = data_dcu;
            }else if(id =="totalpendapatan"){
                config.data = data_totalpendapatan;
            }else if(id =="totalbiaya"){
                config.data = data_totalbiaya;
            }else if(id =="shu"){
                config.data = data_shu;
            }else if(id =="piutangbersih"){
                config.data = data_piutangbersih;
            }else if(id =="rasioberedar"){
                config.data = data_rasioberedar;
            }else if(id =="rasiolalai"){
                config.data = data_rasiolalai;
            }
            $.each(config.data.datasets, function(i, dataset) {
                dataset.borderColor = randomColor(0.4);
                dataset.backgroundColor = randomColor(0.5);
                dataset.pointBorderColor = randomColor(0.7);
                dataset.pointBackgroundColor = randomColor(0.5);
                dataset.pointBorderWidth = 1;
            });
            window.chart.update();
            return false;
        });
        @if(!Request::is('admins/perkembangancu/index_cu/*'))
            $('#chart_select2').on('change', function () {
                var id = $(this).val(); // get selected value
                if (id == "l_biasa") { // require a URL
                    config2.data = data_l_biasa2;
                }else if(id == "l_lbiasa"){
                    config2.data = data_l_lbiasa2;
                }else if(id =="p_biasa"){
                    config2.data = data_p_biasa2;
                }else if(id =="p_lbiasa"){
                    config2.data = data_p_lbiasa2;
                }else if(id =="totalanggota"){
                    config2.data = data_totalanggota2;
                }else if(id =="kekayaan"){
                    config2.data = data_kekayaan2;
                }else if(id =="aktivalancar"){
                    config2.data = data_aktivalancar2;
                }else if(id =="simpanansaham"){
                    config2.data = data_simpanansaham2;
                }else if(id =="nonsaham_unggulan"){
                    config2.data = data_nonsaham_unggulan2;
                }else if(id =="nonsaham_harian"){
                    config2.data = data_nonsaham_harian2;
                }else if(id =="hutangspd"){
                    config2.data = data_hutangspd2;
                }else if(id =="piutangberedar"){
                    config2.data = data_piutangberedar2;
                }else if(id =="piutanglalai_1bulan"){
                    config2.data = data_piutanglalai_1bulan2;
                }else if(id =="piutanglalai_12bulan"){
                    config2.data = data_piutanglalai_12bulan2;
                }else if(id =="dcr"){
                    config2.data = data_dcr2;
                }else if(id =="dcu"){
                    config2.data = data_dcu2;
                }else if(id =="totalpendapatan"){
                    config2.data = data_totalpendapatan2;
                }else if(id =="totalbiaya"){
                    config2.data = data_totalbiaya2;
                }else if(id =="shu"){
                    config2.data = data_shu2;
                }else if(id =="piutangbersih"){
                    config2.data = data_piutangbersih2;
                }else if(id =="rasioberedar"){
                    config2.data = data_rasioberedar2;
                }else if(id =="rasiolalai"){
                    config2.data = data_rasiolalai2;
                }
                $.each(config2.data.datasets, function(i, dataset) {
                    dataset.borderColor = randomColor(0.4);
                    dataset.backgroundColor = randomColor(0.5);
                    dataset.pointBorderColor = randomColor(0.7);
                    dataset.pointBackgroundColor = randomColor(0.5);
                    dataset.pointBorderWidth = 1;
                });
                window.chart2.update();
                return false;
            });
            $('#chart_select3').on('change', function () {
            var id = $(this).val(); // get selected value
            if (id == "l_biasa") { // require a URL
                config3.data = data_l_biasa3;
            }else if(id == "l_lbiasa"){
                config3.data = data_l_lbiasa3;
            }else if(id =="p_biasa"){
                config3.data = data_p_biasa3;
            }else if(id =="p_lbiasa"){
                config3.data = data_p_lbiasa3;
            }else if(id =="totalanggota"){
                config3.data = data_totalanggota3;
            }else if(id =="kekayaan"){
                config3.data = data_kekayaan3;
            }else if(id =="aktivalancar"){
                config3.data = data_aktivalancar3;
            }else if(id =="simpanansaham"){
                config3.data = data_simpanansaham3;
            }else if(id =="nonsaham_unggulan"){
                config3.data = data_nonsaham_unggulan3;
            }else if(id =="nonsaham_harian"){
                config3.data = data_nonsaham_harian3;
            }else if(id =="hutangspd"){
                config3.data = data_hutangspd3;
            }else if(id =="piutangberedar"){
                config3.data = data_piutangberedar3;
            }else if(id =="piutanglalai_1bulan"){
                config3.data = data_piutanglalai_1bulan3;
            }else if(id =="piutanglalai_12bulan"){
                config3.data = data_piutanglalai_12bulan3;
            }else if(id =="dcr"){
                config3.data = data_dcr3;
            }else if(id =="dcu"){
                config3.data = data_dcu3;
            }else if(id =="totalpendapatan"){
                config3.data = data_totalpendapatan3;
            }else if(id =="totalbiaya"){
                config3.data = data_totalbiaya3;
            }else if(id =="shu"){
                config3.data = data_shu3;
            }else if(id =="piutangbersih"){
                config3.data = data_piutangbersih3;
            }else if(id =="rasioberedar"){
                config3.data = data_rasioberedar3;
            }else if(id =="rasiolalai"){
                config3.data = data_rasiolalai3;
            }
            $.each(config3.data.datasets, function(i, dataset) {
                dataset.borderColor = randomColor(0.4);
                dataset.backgroundColor = randomColor(0.5);
                dataset.pointBorderColor = randomColor(0.7);
                dataset.pointBackgroundColor = randomColor(0.5);
                dataset.pointBorderWidth = 1;
            });
            window.chart3.update();
            return false;
        });
        @endif
    });
</script>
{{--table--}}
<script>
//    new $.fn.dataTable.FixedColumns( table, {
//        leftColumns : 1
//    } );
    table.on( 'order.dt search.dt', function () {
        table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();

    new $.fn.dataTable.Buttons(table,{
        buttons: [
            {
                extend:'colvis',
                columns: ':not(:contains(#))',
                text: '<i class="fa fa-table"></i>'
            },
            {
                extend:'colvisGroup',
                text: 'Semua',
                show: ':hidden'
            },
                @if(!Request::is('admins/perkembangancu/index_cu/*'))
                {
                    extend: 'colvisGroup',
                    text: 'Anggota',
                    show: [ 0,1,2,6,7,8,9,10,28 ],
                    hide: [ 3,4,5,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27 ]
                },
                {
                    extend: 'colvisGroup',
                    text: 'SHU',
                    show: [ 0,1,2,25,26,27,28 ],
                    hide: [ 3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24 ]
                },
                {
                    extend: 'colvisGroup',
                    text: 'Piutang',
                    show: [ 0,1,2,11,17,18,19,20,21,22,28 ],
                    hide: [ 3,4,5,6,7,8,9,10,12,13,14,15,16,23,24,25,26,27 ]
                },
            @else
                {
                    extend: 'colvisGroup',
                    text: 'Anggota',
                    show: [ 2,3,4,5,6,24 ],
                    hide: [ 7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23]
                },
                {
                    extend: 'colvisGroup',
                    text: 'SHU',
                    show: [ 21,22,23,24 ],
                    hide: [ 1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19 ]
                },
                {
                    extend: 'colvisGroup',
                    text: 'Piutang',
                    show: [ 7,13,14,15,16,17,18,24 ],
                    hide: [ 1,2,3,4,5,6,8,9,10,11,12,19,20,21,22,23 ]
                },
            @endif
        ]
    });
    table.buttons( 0, null ).container().prependTo(
            table.table().container()
    );

    new $.fn.dataTable.Buttons(table,{
        buttons: [
            {
                text: '<i class="fa fa-plus"></i> <u>T</u>ambah',
                key: {
                    altKey: true,
                    key: 't'
                },
                action: function(){
                    window.location.href = "{{URL::to('admins/'.$kelas.'/create')}}";
                }
            },
            {
                text: '<i class="fa fa-pencil"></i> <u>U</u>bah',
                key: {
                    altKey: true,
                    key: 'u'
                },
                action: function(){
                    var id = $.map(table.rows({ selected: true }).data(),function(item){
                        return item[1];
                    });
                    var kelas = "{{ $kelas }}";
                    if(id != ""){
                        window.location.href =  "/admins/" + kelas + "/" + id + "/edit";
                    }
                }
            },
            {
                text: '<i class="fa fa-trash"></i> <u>H</u>apus',
                key: {
                    altKey: true,
                    key: 'h'
                },
                action: function(){
                    var id = $.map(table.rows({ selected:true }).data(),function(item){
                        return item[1];
                    });
                    if(id != ""){
                        $('#modal1show').modal({show:true});
                        $('#modal1id').attr('value',id);
                    }
                }
            }
        ]
    });
    table.buttons( 0, null ).container().prependTo(
            table.table().container()
    );

    new $.fn.dataTable.Buttons(table,{
        buttons: [
            {
                text: '<i class="fa fa-database"></i> Detail',
                action: function(){
                    var id = $.map(table.rows({ selected: true }).data(),function(item){
                        return item[3];
                    });
                    var kelas = "{{ $kelas }}";
                    if(id != ""){
                        window.location.href = "/admins/" + kelas + "/index_cu/" + id ;
                    }
                }
            }
        ]
    });
    table.buttons( 0, null ).container().prependTo(
            table.table().container()
    );

    new $.fn.dataTable.Buttons(table,{
        buttons: [
            {
                extend:'excelHtml5',
                text: '<i class="fa fa-file-excel-o"></i> Excel',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend:'print',
                text: '<i class="fa fa-print"></i> Print',
                exportOptions: {
                    stripHtml: false,
                    columns: ':visible'
                }
            }
        ]
    });
    table.buttons( 0, null ).container().prependTo(
            table.table().container()
    );
</script>
{{--table2--}}
<script>
    var table2 = $('#dataTables-example2').DataTable({
        dom: 'Bti',
        select: true,
        scrollX: true,
        "autoWidth": false,
        scrollCollapse : true,
        paging : false,
        stateSave : false,
        columnDefs: [ {
            "searchable": false,
            "orderable": false,
            "targets": 0
        } ],
        order : [[ 0, "asc" ]],
        buttons: [
            {
                extend:'colvis',
                text: '<i class="fa fa-table"></i>'
            },
            {
                extend:'colvisGroup',
                text: 'Semua',
                show: ':hidden'
            },
            {
                extend: 'colvisGroup',
                text: 'Anggota',
                show: [ 0,1,2,3,4,5 ],
                hide: [ 6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22 ]
            },
            {
                extend: 'colvisGroup',
                text: 'SHU',
                show: [ 0,20,21,22 ],
                hide: [ 1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19 ]
            },
            {
                extend: 'colvisGroup',
                text: 'Piutang',
                show: [ 0,6,12,13,14,15,16,17 ],
                hide: [ 1,2,3,4,5,7,8,9,10,11,18,19,20,21,22 ]
            }
        ],
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
    new $.fn.dataTable.Buttons(table2,{
        buttons: [
            {
                extend:'excelHtml5',
                text: '<i class="fa fa-file-excel-o"></i> Excel',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend:'print',
                text: '<i class="fa fa-print"></i> Print',
                exportOptions: {
                    stripHtml: false,
                    columns: ':visible'
                }
            }
        ]
    });
    table2.buttons( 0, null ).container().prependTo(
            table2.table().container()
    );

</script>
{{--table3--}}
<script>
    var table3 = $('#dataTables-example3').DataTable({
        dom: 'Bti',
        select: true,
        scrollY : '80vh',
        scrollX: true,
        "autoWidth": false,
        scrollCollapse : true,
        paging : false,
        stateSave : false,
        columnDefs: [ {
            "searchable": false,
            "orderable": false,
            "targets": 0
        } ],
        order : [[ 0, "asc" ]],
        buttons: [
            {
                extend:'colvis',
                text: '<i class="fa fa-table"></i>'
            },
            {
                extend:'colvisGroup',
                text: 'Semua',
                show: ':hidden'
            },
            {
                extend: 'colvisGroup',
                text: 'Anggota',
                show: [ 0,1,2,3,4,5 ],
                hide: [ 6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22 ]
            },
            {
                extend: 'colvisGroup',
                text: 'SHU',
                show: [ 0,20,21,22 ],
                hide: [ 1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19 ]
            },
            {
                extend: 'colvisGroup',
                text: 'Piutang',
                show: [ 0,6,12,13,14,15,16,17 ],
                hide: [ 1,2,3,4,5,7,8,9,10,11,18,19,20,21,22 ]
            }
        ],
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
    new $.fn.dataTable.Buttons(table3,{
        buttons: [
            {
                extend:'excelHtml5',
                text: '<i class="fa fa-file-excel-o"></i> Excel',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend:'print',
                text: '<i class="fa fa-print"></i> Print',
                exportOptions: {
                    stripHtml: false,
                    columns: ':visible'
                }
            }
        ]
    });
    table3.buttons( 0, null ).container().prependTo(
            table3.table().container()
    );
</script>
{{--common function--}}
<script>
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
    $('.nav-tabs li a').click(function (e) {
        //get selected href
        var href = $(this).attr('href');

        //set all nav tabs to inactive
        $('.nav-tabs li').removeClass('active');

        //get all nav tabs matching the href and set to active
        $('.nav-tabs li a[href="'+href+'"]').closest('li').addClass('active');

        //active tab
        $('.tab-pane').removeClass('fade active in');
        $('.tab-pane'+href).addClass('fade active in');
    })
</script>
@stop
