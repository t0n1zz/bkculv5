<?php
    $culists = App\Models\Cuprimer::orderBy('name','asc')->select('no_ba','name')->get();
    if(Request::is('admins/laporancu/index_cu/*')){
        foreach ($culists as $culist) {
            if($culist->no_ba == $id)
                $title = "Kelola Laporan CU " .$culist->name;
        }
        
    }else{
        $title = "Kelola Laporan CU";
    }

    $kelas ='laporancu';
    $cu = Auth::user()->getCU();

    if(!Request::is('admins/laporancu/index_cu/*')){
        $wilayahcuprimers = App\Models\WilayahCuprimer::get();

        // $periodeiode = $datas->first();
        // $periode = new Date($periodeiode->periode);
        // $periode->sub('31 day'); 
        // $periode->format('Y-m-d');

        // $dataprev = App\Models\laporancu::where('periode','<=',$periode)->get();
        // $dataprev1 = $dataprev->groupBy('cu');

        // $datasprev = collect([]);
        // foreach ($dataprev1 as $dataprev2){
        //     $datasprev->push($dataprev2->first());
        // }
    }else{
        // $datasprev = $datas->first();
        // $prev_l_biasa = $datasprev->l_biasa;
        // $prev_l_lbiasa = $datasprev->l_lbiasa;
        // $prev_p_biasa = $datasprev->p_biasa;
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
        <i class="fa fa-line-chart"></i> {{ $title }}
        <small>Mengelola Laporan CU</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('admins') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><i class="fa fa-line-chart"></i> {{ $title }}</li>
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
            @if(Auth::check() && Auth::user()->can('view.laporancudetail_view') && $cu == '0')
                <div class="col-sm-6" style="padding: .2em ;">
                    <div class="input-group">
                        <div class="input-group-addon primary-color"><i class="fa fa-file-o fa-fw"></i> Laporan Dari</div>
                        <select class="form-control" id="dynamic_select">
                            <option {{ Request::is('admins/laporancu') ? 'selected' : '' }}
                                    value="/admins/laporancu">Semua Credit Union</option>
                            <option disabled>--------------</option>        
                            @foreach($culists as $culist)
                                <option {{ Request::is('admins/laporancu/index_cu/'.$culist->no_ba) ? 'selected' : '' }}
                                        value="/admins/laporancu/index_cu/{{$culist->no_ba}}">{{ $culist->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            @endif
            @if(!Request::is('admins/laporancu/index_cu/*'))
                <div class="col-sm-4" style="padding: .2em ;">
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
            @if(!Request::is('admins/laporancu/index_cu/*'))
                @permission('upload.laporancu_upload')
                    <div class="col-sm-2" style="padding: .2em ;">   
                        <a href="#" class="btn btn-default btn-block" data-toggle="modal" data-target="#modalexcel">
                            <i class="fa fa-upload fa-fw"></i> Upload Excel
                        </a>  
                    </div>
                @endpermission
            @elseif(Request::is('admins/laporancu/index_cu/*'))
                @permission('upload.laporancudetail_upload')
                    <div class="col-sm-2" style="padding: .2em ;">   
                        <a href="#" class="btn btn-default btn-block" data-toggle="modal" data-target="#modalexcel">
                            <i class="fa fa-upload fa-fw"></i> Upload Excel
                        </a>  
                    </div>
                @endpermission
            @endif
        </div>
    </div>
    {{-- table --}}
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_cu" data-toggle="tab">Laporan CU</a></li>
            @if(!Request::is('admins/laporancu/index_cu/*'))
                <li><a href="#tab_provinsi" data-toggle="tab">Laporan CU (Provinsi)</a></li>
                <li><a href="#tab_do" data-toggle="tab">Laporan CU (District Office)</a></li>
            @endif
            <li><a href="#tab_pearls" data-toggle="tab">P.E.A.R.L.S</a></li>
        </ul>
        <div class="tab-content"> 
            <div class="tab-pane fade in active" id="tab_cu">
                <div class="input-group tabletools">
                    <div class="input-group-addon"><i class="fa fa-search"></i></div>
                    <input type="text" id="searchtext" class="form-control" placeholder="Kata kunci pencarian..." autofocus>
                </div>
                <table class="table table-hover table-bordered" id="dataTables-all" width="100%" > 
                    <thead class="bg-light-blue-active color-palette">
                        <tr>
                            <th rowspan="2" data-sortable="false" >#</th>
                            <th rowspan="2" hidden></th>
                            @if(!Request::is('admins/laporancu/index_cu/*'))<th rowspan="2">Credit Union</th>@endif
                            @if(!Request::is('admins/laporancu/index_cu/*'))<th rowspan="2">No.Ba</th>@endif
                            @if(!Request::is('admins/laporancu/index_cu/*'))<th rowspan="2">District Office</th>@endif
                            @if(!Request::is('admins/laporancu/index_cu/*'))<th rowspan="2">Wilayah</th>@endif
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
                                if(!Request::is('admins/laporancu/index_cu/*')){
                                    $cu_name = !empty($data->cuprimer->name) ? $data->cuprimer->name : ‘-’;
                                    $no_ba = !empty($data->cuprimer->no_ba) ? $data->cuprimer->no_ba : ‘-’;
                                    if(!empty($data->cuprimer->do)){
                                        if($data->cuprimer->do == "1"){
                                            $do ="BARAT";
                                        }else if($data->cuprimer->do == "2"){
                                            $do ="TENGAH";
                                        }else if($data->cuprimer->do == "3"){
                                            $do ="TIMUR";
                                        }else{
                                            $do ='-';
                                        }
                                    }else{
                                        $do ='-';
                                    }
                                    if(!empty($data->cuprimer->wilayah)){
                                        foreach($wilayahcuprimers as $wilayahcuprimer){
                                            if($data->cuprimer->wilayah == $wilayahcuprimer->id){
                                                $wilayah =$wilayahcuprimer->name;
                                            }
                                        }
                                    }else{
                                        $wilayah = '-';
                                    }
                                }

                                $periode_pertama = !empty($data->first()->periode) ? $data->first()->periode : '-';
                                $l_biasa = !empty($data->l_biasa) ? $data->l_biasa : '0';
                                $l_lbiasa = !empty($data->l_lbiasa) ? $data->l_lbiasa : '0';
                                $p_biasa = !empty($data->p_biasa) ? $data->p_biasa : '0';
                                $p_lbiasa = !empty($data->p_lbiasa) ? $data->p_lbiasa : '0';
                                $aset = !empty($data->aset) ? $data->aset : '0';
                                $aktivalancar = !empty($data->aktivalancar) ? $data->aktivalancar : '0';
                                $simpanansaham = !empty($data->simpanansaham) ? $data->simpanansaham : '0';
                                $nonsaham_unggulan = !empty($data->nonsaham_unggulan) ? $data->nonsaham_unggulan : '0';
                                $nonsaham_harian = !empty($data->nonsaham_harian) ? $data->nonsaham_harian : '0';
                                $hutangspd = !empty($data->hutangspd) ? $data->hutangspd : '0';
                                $piutangberedar = !empty($data->piutangberedar) ? $data->piutangberedar : '0';
                                $piutanglalai_1bulan = !empty($data->piutanglalai_1bulan) ? $data->piutanglalai_1bulan : '0';
                                $piutanglalai_12bulan = !empty($data->piutanglalai_12bulan) ? $data->piutanglalai_12bulan : '0';
                                $dcr = !empty($data->dcr) ? $data->dcr : '0';
                                $dcu = !empty($data->dcu) ? $data->dcu : '0';
                                $totalpendapatan = !empty($data->totalpendapatan) ? $data->totalpendapatan : '0';
                                $totalbiaya = !empty($data->totalbiaya) ? $data->totalbiaya : '0';
                                $shu = !empty($data->shu) ? $data->shu : '0';
                                if(!empty($data->created_at)){
                                    $date = new date($data->created_at);
                                    $created_at = $date->format('d/n/Y');
                                }else{
                                    $create_at = '-';
                                }
                                if(!empty($data->updated_at)){
                                    $date = new date($data->updated_at);
                                    $updated_at = $date->format('d/n/Y');
                                }else{
                                    $updated_at = '-';
                                }
                                if(!empty($data->periode)){
                                    $date = new date($data->periode);
                                    $periode = $date->format('F Y');
                                }else{
                                    $periode = '-';
                                }
                                $tot_cu++;
                                ?>
                            <tr
                            @if(!Request::is('admins/laporancu/index_cu/*'))
                                @if($data->periode < $datas->first()->periode){!! 'class="highlight"'  !!}@endif
                                    @endif>
                                <td class="bg-aqua disabled color-palette"></td>
                                <td hidden>{{ $data->id }}</td>
                                @if(!Request::is('admins/laporancu/index_cu/*'))
                                    <td>{{ $cu_name }}</td>
                                    <td>{{ $no_ba }}</td>
                                    <td>{{ $do }}</td>
                                    <td>{{ $wilayah }}</td>
                                @endif

                                @if(!empty($data->periode))
                                    <?php $date = new Date($data->periode); ?>
                                    <td data-order="{{ $data->periode }}"> {{ $date->format('F Y') }}</td>
                                @else
                                    <td>0</td>
                                @endif

                                @if(!empty($data->l_biasa))
                                    <?php 
                                        $l_biasa = number_format($data->l_biasa,"0",",","."); $tot_l_biasa += $data->l_biasa;

                                    ?>
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

                                @if(!empty($data->aset))
                                    <?php $aset = number_format($data->aset,"0",",","."); $tot_aset += $data->aset;?>
                                    <td data-order="{{ $data->aset }}">{{ $aset }}</td>
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

                               

                                @if(!empty($data->aset) || !empty($data->piutangberedar))
                                    <?php $rasio_beredar = number_format((($data->piutangberedar / $data->aset)*100),2); $tot_beredar += $rasio_beredar; ?>
                                    <td data-order="{{ $rasio_beredar }}">{{ $rasio_beredar }} %</td>
                                @else
                                    <td>0 %</td>
                                @endif

                                @if(!empty($data->piutangberedar) || !empty($data->piutanglalai_1bulan) || !empty($data->piutanglalai_12bulan))
                                    <?php $rasio_lalai = number_format(((($data->piutanglalai_1bulan + $data->piutanglalai_12bulan) / $data->piutangberedar)*100),2); $tot_lalai += $rasio_lalai;?>
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

                                @if(!empty($data->created_at ))
                                    <?php $date = new Date($data->created_at); ?>
                                    <td><i hidden="true">{{$data->created_at}}</i> {{ $date->format('d/n/Y') }}</td>
                                @else
                                    <td>-</td>
                                @endif

                                @if(!empty($data->updated_at ))
                                    <?php $date = new Date($data->updated_at); ?>
                                    <td><i hidden="true">{{$data->updated_at}}</i> {{ $date->format('d/n/Y') }}</td>
                                @else
                                    <td>-</td>
                                @endif    
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>          
            @if(!Request::is('admins/laporancu/index_cu/*'))             
                <div class="tab-pane fade" id="tab_provinsi">
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
                        <?php

                            foreach($wilayahcuprimers as $wilayahcuprimer){
                                $wilayahs[$wilayahcuprimer->id] = array(
                                        'id'=> $wilayahcuprimer->id,'nama'=> $wilayahcuprimer->name,'l_biasa' => 0.0,'l_lbiasa' => 0.0,'p_biasa' => 0.0,'p_lbiasa' => 0.0,'aset' => 0.0,
                                        'aktivalancar' => 0.0,'simpanansaham' => 0.0,'nonsaham_unggulan' => 0.0,'nonsaham_harian' => 0.0,
                                        'hutangspd' => 0.0,'piutangberedar' => 0.0,'piutanglalai_1bulan' => 0.0,'piutanglalai_12bulan' => 0.0,
                                        'dcr' => 0.0,'dcu' => 0.0,'totalpendapatan' => 0.0,'totalbiaya' => 0.0,'shu' => 0.0
                                );
                            }

                            foreach($wilayahs as $wil){
                                foreach($datas as $data){
                                    if(!empty($data->cuprimer)){
                                        if($data->cuprimer->wilayah == $wil['id']){
                                            $wilayahs[$data->cuprimer->wilayah]['l_biasa'] += $data->l_biasa;
                                            $wilayahs[$data->cuprimer->wilayah]['l_lbiasa'] += $data->l_lbiasa;
                                            $wilayahs[$data->cuprimer->wilayah]['p_biasa'] += $data->p_biasa;
                                            $wilayahs[$data->cuprimer->wilayah]['p_lbiasa'] += $data->p_lbiasa;
                                            $wilayahs[$data->cuprimer->wilayah]['aset'] += $data->aset;
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
                                    }
                                };
                            }
                        ?>
                        @foreach($wilayahs as $data)
                            <tr >
                                <td class="bg-aqua disabled color-palette"></td>
                                <td>{{ $data['nama'] }}</td>

                                <?php $l_biasa = number_format($data['l_biasa'],"0",",",".");?>
                                <td data-order="{{ $data['l_biasa'] }}">{{ $l_biasa }}</td>

                                <?php $l_lbiasa = number_format($data['l_lbiasa'],"0",",",".");?>
                                <td data-order="{{ $data['l_lbiasa'] }}">{{ $l_lbiasa }}</td>

                                <?php $p_biasa = number_format($data['p_biasa'],"0",",",".");?>
                                <td data-order="{{ $data['p_biasa'] }}">{{ $p_biasa }}</td>

                                <?php $p_lbiasa = number_format($data['p_lbiasa'],"0",",",".");?>
                                <td data-order="{{ $data['p_lbiasa'] }}">{{ $p_lbiasa }}</td>

                                <?php
                                $total = $data['l_biasa'] + $data['l_lbiasa'] + $data['p_biasa'] + $data['p_lbiasa'];
                                $total_num = number_format($total,"0",",",".");
                                ?>
                                <td data-order="{{ $total }}">{{ $total_num }}</td>

                                <?php $aset = number_format($data['aset'],"0",",",".");?>
                                <td data-order="{{ $data['aset'] }}">{{ $aset }}</td>

                                <?php $aktivalancar = number_format($data['aktivalancar'],"0",",",".");?>
                                <td data-order="{{ $data['aktivalancar'] }}">{{ $aktivalancar }}</td>

                                <?php $simpanansaham = number_format($data['simpanansaham'],"0",",",".");?>
                                <td data-order="{{ $data['simpanansaham'] }}">{{ $simpanansaham }}</td>

                                <?php $nonsaham_unggulan = number_format($data['nonsaham_unggulan'],"0",",",".");?>
                                <td data-order="{{ $data['nonsaham_unggulan'] }}">{{ $nonsaham_unggulan }}</td>

                                <?php $nonsaham_harian = number_format($data['nonsaham_harian'],"0",",",".");?>
                                <td data-order="{{ $data['nonsaham_harian'] }}">{{ $nonsaham_harian }}</td>

                                <?php $hutangspd = number_format($data['hutangspd'],"0",",",".");?>
                                <td data-order="{{ $data['hutangspd'] }}">{{ $hutangspd }}</td>

                                <?php $piutangberedar = number_format($data['piutangberedar'],"0",",",".");?>
                                <td data-order="{{ $data['piutangberedar'] }}">{{ $piutangberedar }}</td>

                                <?php $piutanglalai_1bulan = number_format($data['piutanglalai_1bulan'],"0",",",".");?>
                                <td data-order="{{ $data['piutanglalai_1bulan'] }}">{{ $piutanglalai_1bulan }}</td>

                                <?php $piutanglalai_12bulan = number_format($data['piutanglalai_12bulan'],"0",",",".");?>
                                <td data-order="{{ $data['piutanglalai_12bulan'] }}">{{ $piutanglalai_12bulan }}</td>

                                <?php
                                $piutangbersih = $data['piutangberedar'] - ($data['piutanglalai_1bulan'] + $data['piutanglalai_12bulan']);
                                $piutangbersih_num = number_format($piutangbersih,"0",",",".");
                                ?>
                                <td data-order="{{ $piutangbersih }}">{{ $piutangbersih_num }}</td>

                                <?php 
                                if($data['aset'] != 0){
                                    $rasio_beredar = number_format((($data['piutangberedar'] / $data['aset'])*100),2);
                                }else{
                                    $rasio_beredar = 0;
                                }       
                                ?>
                                <td data-order="{{ $rasio_beredar }}">{{ $rasio_beredar }} %</td>

                                <?php 
                                if($data['piutangberedar'] != 0){
                                    $rasio_lalai = number_format(((($data['piutanglalai_1bulan'] + $data['piutanglalai_12bulan']) / $data['piutangberedar'])*100),2); 
                                }else{
                                    $rasio_lalai = 0;
                                }            
                                ?>
                                <td data-order="{{ $rasio_lalai }}">{{ $rasio_lalai }} %</td>

                                <?php $dcr = number_format($data['dcr'],"0",",",".");?>
                                <td data-order="{{ $data['dcr'] }}">{{ $dcr }}</td>

                                <?php $dcu = number_format($data['dcu'],"0",",",".");?>
                                <td data-order="{{ $data['dcu'] }}">{{ $dcu }}</td>

                                <?php $totalpendapatan = number_format($data['totalpendapatan'],"0",",",".");?>
                                <td data-order="{{ $data['totalpendapatan'] }}">{{ $totalpendapatan }}</td>

                                <?php $totalbiaya = number_format($data['totalbiaya'],"0",",",".");?>
                                <td data-order="{{ $data['totalbiaya'] }}">{{ $totalbiaya }}</td>

                                <?php $shu = number_format($data['shu'],"0",",",".");?>
                                <td data-order="{{ $data['shu'] }}">{{ $shu }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>                  
                <div class="tab-pane fade" id="tab_do">
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
                        <?php
                            $do = array(
                                    'do_barat'=>
                                            array(
                                                    'nama' => 'BARAT',
                                                    'l_biasa' => 0.0,'l_lbiasa' => 0.0,'p_biasa' => 0.0,'p_lbiasa' => 0.0,'aset' => 0.0,
                                                    'aktivalancar' => 0.0,'simpanansaham' => 0.0,'nonsaham_unggulan' => 0.0,'nonsaham_harian' => 0.0,
                                                    'hutangspd' => 0.0,'piutangberedar' => 0.0,'piutanglalai_1bulan' => 0.0,'piutanglalai_12bulan' => 0.0,
                                                    'dcr' => 0.0,'dcu' => 0.0,'totalpendapatan' => 0.0,'totalbiaya' => 0.0,'shu' => 0.0
                                            ),
                                    'do_timur'=>
                                            array(
                                                    'nama' => 'TIMUR',
                                                    'l_biasa' => 0.0,'l_lbiasa' => 0.0,'p_biasa' => 0.0,'p_lbiasa' => 0.0,'aset' => 0.0,
                                                    'aktivalancar' => 0.0,'simpanansaham' => 0.0,'nonsaham_unggulan' => 0.0,'nonsaham_harian' => 0.0,
                                                    'hutangspd' => 0.0,'piutangberedar' => 0.0,'piutanglalai_1bulan' => 0.0,'piutanglalai_12bulan' => 0.0,
                                                    'dcr' => 0.0,'dcu' => 0.0,'totalpendapatan' => 0.0,'totalbiaya' => 0.0,'shu' => 0.0
                                            ),
                                    'do_tengah'=>
                                            array(
                                                    'nama' => 'TENGAH',
                                                    'l_biasa' => 0.0,'l_lbiasa' => 0.0,'p_biasa' => 0.0,'p_lbiasa' => 0.0,'aset' => 0.0,
                                                    'aktivalancar' => 0.0,'simpanansaham' => 0.0,'nonsaham_unggulan' => 0.0,'nonsaham_harian' => 0.0,
                                                    'hutangspd' => 0.0,'piutangberedar' => 0.0,'piutanglalai_1bulan' => 0.0,'piutanglalai_12bulan' => 0.0,
                                                    'dcr' => 0.0,'dcu' => 0.0,'totalpendapatan' => 0.0,'totalbiaya' => 0.0,'shu' => 0.0
                                            ),
                            );
                            foreach($datas as $data){
                                if(!empty($data->cuprimer)){
                                    if($data->cuprimer->do == "1"){
                                        $do['do_barat']['l_biasa'] += $data->l_biasa;
                                        $do['do_barat']['l_lbiasa'] += $data->l_lbiasa;
                                        $do['do_barat']['p_biasa'] += $data->p_biasa;
                                        $do['do_barat']['p_lbiasa'] += $data->p_lbiasa;
                                        $do['do_barat']['aset'] += $data->aset;
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
                                        $do['do_tengah']['aset'] += $data->aset;
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
                                        $do['do_timur']['aset'] += $data->aset;
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
                                }    
                            };
                        ?>
                        @foreach($do as $data)
                            <tr >
                                <td class="bg-aqua disabled color-palette"></td>
                                <td>{{ $data['nama'] }}</td>

                                <?php $l_biasa = number_format($data['l_biasa'],"0",",",".");?>
                                <td data-order="{{ $data['l_biasa'] }}">{{ $l_biasa }}</td>

                                <?php $l_lbiasa = number_format($data['l_lbiasa'],"0",",",".");?>
                                <td data-order="{{ $data['l_lbiasa'] }}">{{ $l_lbiasa }}</td>


                                <?php $p_biasa = number_format($data['p_biasa'],"0",",",".");?>
                                <td data-order="{{ $data['p_biasa'] }}">{{ $p_biasa }}</td>


                                <?php $p_lbiasa = number_format($data['p_lbiasa'],"0",",",".");?>
                                <td data-order="{{ $data['p_lbiasa'] }}">{{ $p_lbiasa }}</td>

                                <?php
                                    $total = $data['l_biasa'] + $data['l_lbiasa'] + $data['p_biasa'] + $data['p_lbiasa'];
                                    $total_num = number_format($total,"0",",",".");
                                ?>
                                <td data-order="{{ $total }}">{{ $total_num }}</td>

                                <?php $aset = number_format($data['aset'],"0",",",".");?>
                                <td data-order="{{ $data['aset'] }}">{{ $aset }}</td>

                                <?php $aktivalancar = number_format($data['aktivalancar'],"0",",",".");?>
                                <td data-order="{{ $data['aktivalancar'] }}">{{ $aktivalancar }}</td>

                                <?php $simpanansaham = number_format($data['simpanansaham'],"0",",",".");?>
                                <td data-order="{{ $data['simpanansaham'] }}">{{ $simpanansaham }}</td>

                                <?php $nonsaham_unggulan = number_format($data['nonsaham_unggulan'],"0",",",".");?>
                                <td data-order="{{ $data['nonsaham_unggulan'] }}">{{ $nonsaham_unggulan }}</td>

                                <?php $nonsaham_harian = number_format($data['nonsaham_harian'],"0",",",".");?>
                                <td data-order="{{ $data['nonsaham_harian'] }}">{{ $nonsaham_harian }}</td>

                                <?php $hutangspd = number_format($data['hutangspd'],"0",",",".");?>
                                <td data-order="{{ $data['hutangspd'] }}">{{ $hutangspd }}</td>

                                <?php $piutangberedar = number_format($data['piutangberedar'],"0",",",".");?>
                                <td data-order="{{ $data['piutangberedar'] }}">{{ $piutangberedar }}</td>

                                <?php $piutanglalai_1bulan = number_format($data['piutanglalai_1bulan'],"0",",",".");?>
                                <td data-order="{{ $data['piutanglalai_1bulan'] }}">{{ $piutanglalai_1bulan }}</td>

                                <?php $piutanglalai_12bulan = number_format($data['piutanglalai_12bulan'],"0",",",".");?>
                                <td data-order="{{ $data['piutanglalai_12bulan'] }}">{{ $piutanglalai_12bulan }}</td>

                                <?php
                                $piutangbersih = $data['piutangberedar'] - ($data['piutanglalai_1bulan'] + $data['piutanglalai_12bulan']);
                                $piutangbersih_num = number_format($piutangbersih,"0",",",".");
                                ?>
                                <td data-order="{{ $piutangbersih }}">{{ $piutangbersih_num }}</td>

                                <?php if($data['aset'] != 0){
                                    $rasio_beredar = number_format((($data['piutangberedar'] / $data['aset'])*100),2);
                                }else{
                                    $rasio_beredar = 0;
                                }  ?>
                                <td data-order="{{ $rasio_beredar }}">{{ $rasio_beredar }} %</td>

                                <?php if($data['piutangberedar'] != 0){
                                    $rasio_lalai = number_format(((($data['piutanglalai_1bulan'] + $data['piutanglalai_12bulan']) / $data['piutangberedar'])*100),2); 
                                }else{
                                    $rasio_lalai = 0;
                                }     ?>
                                <td data-order="{{ $rasio_lalai }}">{{ $rasio_lalai }} %</td>

                                <?php $dcr = number_format($data['dcr'],"0",",",".");?>
                                <td data-order="{{ $data['dcr'] }}">{{ $dcr }}</td>

                                <?php $dcu = number_format($data['dcu'],"0",",",".");?>
                                <td data-order="{{ $data['dcu'] }}">{{ $dcu }}</td>

                                <?php $totalpendapatan = number_format($data['totalpendapatan'],"0",",",".");?>
                                <td data-order="{{ $data['totalpendapatan'] }}">{{ $totalpendapatan }}</td>

                                <?php $totalbiaya = number_format($data['totalbiaya'],"0",",",".");?>
                                <td data-order="{{ $data['totalbiaya'] }}">{{ $totalbiaya }}</td>

                                <?php $shu = number_format($data['shu'],"0",",",".");?>
                                <td data-order="{{ $data['shu'] }}">{{ $shu }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
            <div class="tab-pane fade" id="tab_pearls">
                <div class="input-group tabletools">
                    <div class="input-group-addon"><i class="fa fa-search"></i></div>
                    <input type="text" id="searchtextpearls" class="form-control" placeholder="Kata kunci pencarian..." autofocus>
                </div>
                <table class="table table-hover table-bordered" id="dataTables-pearls" width="100%" > 
                    <thead class="bg-light-blue-active color-palette">
                        <tr>
                            <th rowspan="2" data-sortable="false" >#</th>
                            <th rowspan="2" hidden></th>
                            @if(!Request::is('admins/laporancu/index_cu/*'))<th rowspan="2">Credit Union</th>@endif
                            @if(Request::is('admins/laporancu/index_cu/*'))<th rowspan="2">Periode Laporan</th>@endif
                            <th colspan="2" class="text-center">[P]<small>rotection</small></th>
                            <th colspan="4" class="text-center">[E]<small>ffective Financial</small></th>
                            <th colspan="2" class="text-center">[A]<small>sset Quality</small></th>
                            <th colspan="2" class="text-center">[R]<small>ates of Return</small></th>
                            <th class="text-center">[L]<small>iquidity</small></th>
                            <th colspan="2" class="text-center">[S]<small>igns of Growth</small></th>
                            <th rowspan="2">Harga Pasar</th>
                            <th rowspan="2">Laju Inflasi</th>
                            @if(!Request::is('admins/laporancu/index_cu/*'))<th rowspan="2">Periode Laporan</th>@endif
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
                                if(!Request::is('admins/laporancu/index_cu/*')){ 
                                    $cu_name = '-';
                                    $cu_noba = '-';
                                    $cu_do = '-';
                                    $cu_wilayah = '-';

                                    if(!empty($data->cuprimer)){
                                        $cu_name = !empty($data->cuprimer->name) ? $data->cuprimer->name : '-';
                                        $cu_noba = !empty($data->cuprimer->no_ba) ? $data->cuprimer->no_ba : '-';
                                        if($data->cuprimer->do == "1"){
                                            $cu_do ="Barat";
                                        }else if($data->cuprimer->do == "2"){
                                            $cu_do ="Tengah";
                                        }else if($data->cuprimer->do == "3"){
                                            $cu_do ="Timur";
                                        }else{
                                            $cu_do ='-';
                                        }
                                        foreach($wilayahcuprimers as $wilayahcuprimer){
                                            if($data->cuprimer->wilayah == $wilayahcuprimer->id){
                                                $cu_wilayah =$wilayahcuprimer->name;
                                            }
                                        }
                                    }
                                }

                                $periode = !empty($data->periode) ? $data->periode : '-';
                                    
                                $l_biasa = !empty($data->l_biasa) ? $data->l_biasa : 0;
                                $l_lbiasa = !empty($data->l_lbiasa) ? $data->l_lbiasa : 0;
                                $p_biasa = !empty($data->p_biasa) ? $data->p_biasa : 0;
                                $p_lbiasa = !empty($data->p_lbiasa) ? $data->p_lbiasa : 0;
                                $tot_agt = $l_biasa + $l_lbiasa + $p_biasa + $p_lbiasa;
                                $totalanggota_lalu = !empty($data->totalanggota_lalu) ? $data->totalanggota_lalu : 0;
                                $piutanglalai_1bulan = !empty($data->piutanglalai_1bulan) ? $data->piutanglalai_1bulan : 0;
                                $piutanglalai_12bulan = !empty($data->piutanglalai_12bulan) ? $data->piutanglalai_12bulan : 0;
                                $aset = !empty($data->aset) ? $data->aset : 0;
                                $aset_lalu = !empty($data->aset_lalu) ? $data->aset_lalu : 0;
                                $rataaset = ($aset + $aset_lalu) / 2;
                                $piutangberedar = !empty($data->piutangberedar) ? $data->piutangberedar : 0;
                                $piutanganggota = !empty($data->piutanganggota) ? $data->piutanganggota : 0;
                                $dcr = !empty($data->dcr) ? $data->dcr : 0;
                                $dcu = !empty($data->dcu) ? $data->dcu : 0;
                                $simpanansaham = !empty($data->simpanansaham) ? $data->simpanansaham : 0;
                                $simpanansaham_lalu = !empty($data->simpanansaham_lalu) ? $data->simpanansaham_lalu : 0;
                                $ratasaham = ($simpanansaham + $simpanansaham_lalu) / 2;
                                $nonsaham_unggulan = !empty($data->nonsaham_unggulan) ? $data->nonsaham_unggulan : 0;
                                $nonsaham_harian = !empty($data->nonsaham_harian) ? $data->nonsaham_harian : 0;
                                $tot_nonsaham = $nonsaham_unggulan + $nonsaham_harian;
                                $totalhutang_pihak3 = !empty($data->totalhutang_pihak3) ? $data->totalhutang_pihak3 : 0;
                                $iuran_gedung = !empty($data->iuran_gedung) ? $data->iuran_gedung : 0;
                                $donasi = !empty($data->donasi) ? $data->donasi : 0;
                                $shu_lalu = !empty($data->shu_lalu) ? $data->shu_lalu : 0;
                                $bjs_saham = !empty($data->bjs_saham) ? $data->bjs_saham : 0;
                                $beban_operasional = !empty($data->beban_operasional) ? $data->beban_operasional : 0;
                                $investasi_likuid = !empty($data->investasi_likuid) ? $data->investasi_likuid : 0;
                                $aset_masalah = !empty($data->aset_masalah) ? $data->aset_masalah : 0;
                                $aset_tidak_menghasilkan = !empty($data->aset_tidak_menghasilkan) ? $data->aset_tidak_menghasilkan : 0;
                                $aset_likuid_tidak_menghasilkan = !empty($data->aset_likuid_tidak_menghasilkan) ? $data->aset_likuid_tidak_menghasilkan : 0;
                                $hutang_tidak_berbiaya_30hari = !empty($data->hutang_tidak_berbiaya_30hari) ? $data->hutang_tidak_berbiaya_30hari : 0;
                                $hargapasar = !empty($data->hargapasar) ? $data->hargapasar : 0;
                                $lajuinflasi = !empty($data->lajuinflasi) ? $data->lajuinflasi : 0;


                                $p1 = $piutanglalai_12bulan != 0 ? $dcr / $piutanglalai_12bulan : $dcr / 0.01;
                                $p2 = $piutanglalai_1bulan != 0 ? ($dcr - $piutanglalai_12bulan) / $piutanglalai_1bulan : ($dcr - $piutanglalai_12bulan) / 0.01;
                                if($p1 == 1 && $p2 > 0.35){
                                    $e1 = $aset != 0 ? ($piutanganggota - (($piutanglalai_12bulan) + ((35/100) * $piutanglalai_1bulan))) / $aset : ($piutanganggota - (($piutanglalai_12bulan) + ((35/100) * $piutanglalai_1bulan))) / 0.01;
                                }else{
                                    $e1 = $aset != 0 ? ($piutangberedar - $dcr) / $aset : ($piutangberedar - $dcr) / 0.01;
                                }
                                $e5 = $aset != 0 ? ($nonsaham_unggulan + $nonsaham_harian) / $aset : ($nonsaham_unggulan + $nonsaham_harian) / 0.01;
                                $e6 = $aset != 0 ? $totalhutang_pihak3 / $aset : $totalhutang_pihak3 / 0.01;
                                $e9 = $aset != 0 ? (($dcr + $dcu + $iuran_gedung + $donasi + $shu_lalu) - ($piutanglalai_12bulan + ((35/100) * $piutanglalai_1bulan) + $aset_masalah)) / $aset : (($dcr + $dcu + $iuran_gedung + $donasi + $shu_lalu) - ($piutanglalai_12bulan + ((35/100) * $piutanglalai_1bulan) + $aset_masalah)) / 0.01;
                                $a1 = $piutangberedar != 0 ? ($piutanglalai_1bulan + $piutanglalai_12bulan) / $piutangberedar : ($piutanglalai_1bulan + $piutanglalai_12bulan) / 0.01; 
                                $a2 = $aset != 0 ? $aset_tidak_menghasilkan / $aset : $aset_tidak_menghasilkan / 0.01;
                                $r7 = $ratasaham != 0 ? $bjs_saham / $ratasaham : $bjs_saham / 0.01;
                                $r9 = $rataaset != 0 ? $beban_operasional / $rataaset : $beban_operasional / 0.01;
                                $l1 = $tot_nonsaham != 0 ? (($investasi_likuid + $aset_likuid_tidak_menghasilkan) - $hutang_tidak_berbiaya_30hari) / $tot_nonsaham : (($investasi_likuid + $aset_likuid_tidak_menghasilkan) - $hutang_tidak_berbiaya_30hari) / 0.01;
                                $s10 = $totalanggota_lalu != 0 ? ($tot_agt - $totalanggota_lalu) / $totalanggota_lalu : ($tot_agt - $totalanggota_lalu) / 0.01;
                                $s11 = $aset_lalu != 0 ? ($aset - $aset_lalu) / $aset_lalu : ($aset - $aset_lalu) / 0.01;

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
                                <td class="bg-aqua disabled color-palette"></td>

                                <td hidden>{{ $data->id }}</td>
                                
                                @if(!Request::is('admins/laporancu/index_cu/*'))<td>{{ $cu_name }}</td>@endif

                                @if(Request::is('admins/laporancu/index_cu/*'))
                                    <?php $date = new Date($periode); ?>
                                    <td data-order="{{ $periode }}"> {{ $date->format('F Y') }}</td>
                                @endif
                                
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

                                <td @if($r7 != $hargapasar) {!! 'class="bg-red disabled color-palette"' !!} @endif
                                >{{ $r7 }} %</td>

                                <td @if($r9 != 5) {!! 'class="bg-red disabled color-palette"' !!} @endif
                                >{{ $r9 }} %</td>

                                <td @if($l1 < 15 || $l1 > 20) {!! 'class="bg-red disabled color-palette"' !!} @endif
                                >{{ $l1 }} %</td>
                                
                                <td @if($s10 < 12) {!! 'class="bg-red disabled color-palette"' !!} @endif
                                >{{ $s10 }} %</td>

                                <td @if($s11 < $lajuinflasi + 10) {!! 'class="bg-red disabled color-palette"' !!} @endif
                                >{{ $s11 }} %</td>

                                <td>{{ number_format($hargapasar,2) }} %</td>

                                <td>{{ number_format($lajuinflasi,2) }} %</td>

                                @if(!Request::is('admins/laporancu/index_cu/*'))
                                    <?php $date = new Date($periode); ?>
                                    <td data-order="{{ $periode }}"> {{ $date->format('F Y') }}</td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div> 
        </div>
    </div>
        {{-- total --}}
    @if(!Request::is('admins/laporancu/index_cu/*')) 
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_total" data-toggle="tab">Total & Rata-rata</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade in active" id="tab_total">
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
                            <td class="bg-aqua disabled color-palette"><b>Total</b></td>
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
                            <td class="bg-aqua disabled color-palette"><b>Rata - Rata</b></td>
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
        </div>
    </div>
    @endif
    {{-- table --}}
    <!--grafik-->
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_grafik_cu" data-toggle="tab">Grafik Laporan CU</a></li>
            @if(!Request::is('admins/laporancu/index_cu/*'))
                <li><a href="#tab_grafik_provinsi" data-toggle="tab">Grafik Laporan CU (Provinsi)</a></li>
                <li><a href="#tab_grafik_do" data-toggle="tab">Grafik Laporan CU (District Office)</a></li>
            @endif
            <li><a href="#tab_grafik_pearls" data-toggle="tab">Grafik P.E.A.R.L.S</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade in active" id="tab_grafik_cu">
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
                    <div class="input-group-addon primary-color"><i class="fa fa-fw fa-bar-chart"></i> Grafik Laporan Berdasarkan</div>
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
                        <option value="aset">aset (ASET)</option>
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
            @if(!Request::is('admins/laporancu/index_cu/*'))
                <div class="tab-pane fade" id="tab_grafik_provinsi">
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
                            <option value="aset">ASET</option>
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
                <div class="tab-pane fade" id="tab_grafik_do">
                    <?php
                    $gperiode3 = array_column($do,'nama');
                    $gl_biasa3= array_column($do,'l_biasa');
                    $gl_lbiasa3 = array_column($do,'l_lbiasa');
                    $gp_biasa3 = array_column($do,'p_biasa');
                    $gp_lbiasa3 = array_column($do,'p_lbiasa');
                    $gaset3 = array_column($do,'aset');
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
                        <div class="input-group-addon primary-color"><i class="fa fa-fw fa-bar-chart"></i> Grafik Laporan Berdasarkan</div>
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
                            <option value="aset">ASET</option>
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
            <div class="tab-pane fade" id="tab_grafik_pearls">
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
                    <div class="input-group-addon primary-color"><i class="fa fa-fw fa-bar-chart"></i> Grafik P.E.A.R.L.S Berdasarkan</div>
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
                <h4>Upload file excel</h4>
                <input type="file" class="form-control" name="import_file"
                       accept="application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
                <p>Pastikan menggunakan format berikut: <a href="">format excel</a></p>      
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-default" id="modalbutton"><i class="fa fa-upload"></i> Upload</button>
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
{{-- <script type="text/javascript" src="{{ URL::asset('plugins/dataTables/extension/FixedColumns/js/dataTables.fixedColumns.min.js') }}"></script> --}}
@include('admins.laporancu._component.grafik_data')
@include('admins.laporancu._component.grafik')
@include('admins.laporancu._component.grafik_tombol')
<script>
    $(document).ready(function(){
        $('a[data-toggle="tab"]').on( 'shown.bs.tab', function (e) {
            $.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust();
        } );
    });
</script>
@include('admins.laporancu._component.datatable_semua')
@include('admins.laporancu._component.datatable_provinsi')
@include('admins.laporancu._component.datatable_do')
@include('admins.laporancu._component.datatable_pearls')
@include('admins.laporancu._component.datatable_total')
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
