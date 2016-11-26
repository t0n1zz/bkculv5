<?php
    $title = "Kelola Laporan BKCU";
    $kelas ='infogerakan';
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
        <small>Mengelola Laporan BKCU</small>
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
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_perkembangan" data-toggle="tab">Perkembangan Gerakan</a></li>
        </ul>
        <div class="tab-content"> 
            <div class="tab-pane fade in active" id="tab_perkembangan">
                <div class="input-group tabletools">
                    <div class="input-group-addon"><i class="fa fa-search"></i></div>
                    <input type="text" id="searchtext" class="form-control" placeholder="Kata kunci pencarian..." autofocus>
                </div>
                <table class="table table-hover table-bordered" id="dataTables-info" width="100%" > 
                    <thead class="bg-light-blue-active color-palette">
                        <tr>
                            <th rowspan="2" data-sortable="false" >#</th>
                            <th rowspan="2">Periode Laporan</th>
                            <th rowspan="2">CU</th>
                            <th rowspan="2">CU <br/>Tepat<br/>Waktu</th>
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
                        @foreach($infogerakans as $data)
                            <tr >
                                <td class="bg-aqua disabled color-palette"></td>
                                <td>{{ $data['periode'] }}</td>
                                <td>{{ $data['tot_cu'] }}</td>
                                <td>{{ $data['tot_culaporan'] }}</td>

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
        </div>
    </div>
    <!--grafik-->
	<div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_grafik_perkembangangerakan" data-toggle="tab">Grafik Perkembangan Gerakan</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade in active" id="tab_grafik_perkembangangerakan">
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
                    <div class="input-group-addon primary-color"><i class="fa fa-fw fa-bar-chart"></i> Grafik Perkembangan Berdasarkan</div>
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
        </div>
    </div>
</section>

@stop

@section('js')
@include('admins._components.datatable_JS')
<script type="text/javascript" src="{{ URL::asset('plugins/chartJS/Chart.bundle.js') }}"></script>
{{-- datatable --}}
<script>
    var table = $('#dataTables-info').DataTable({
        dom: 'Bti',
        select: true,
        scrollY : '80vh',
        scrollX: true,
        autoWidth: true,
        scrollCollapse : true,
        paging : false,
        stateSave : false,
        order : [[ 1, 'desc']],
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
                show: [ 0,1,2,3,4,5,6,7,8 ],
                hide: [ 9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25 ]
            },
            {
                extend: 'colvisGroup',
                text: 'SHU',
                show: [ 0,1,2,3,23,24,25 ],
                hide: [ 4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22 ]
            },
            {
                extend: 'colvisGroup',
                text: 'Piutang',
                show: [ 0,1,2,3,9,15,16,17,18,19,20 ],
                hide: [ 4,5,6,7,8,10,11,12,13,14,21,22,23,24,25 ]
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
        },
        fnInitComplete:function(){
            $('.dataTables_scrollBody').perfectScrollbar();
        },
        fnDrawCallback: function( oSettings ) {
            $('.dataTables_scrollBody').perfectScrollbar('destroy').perfectScrollbar();
        }
    });
    $('#searchtextprov').keyup(function(){
        table.search($(this).val()).draw() ;
    });

    table.on( 'order.dt search.dt', function () {
        table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();

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
{{-- /datatable --}}
{{-- data grafik --}}
<script>
    var data_l_biasa = {
        labels: {!! json_encode($gperiode,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Anggota Lelaki Biasa",
                data: {!! json_encode($gl_biasa,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_l_lbiasa = {
        labels: {!! json_encode($gperiode,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Anggota Lelaki Luar Biasa",
                data: {!! json_encode($gl_lbiasa,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_p_biasa = {
        labels: {!! json_encode($gperiode,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Anggota Perempuan Biasa",
                data: {!! json_encode($gp_biasa,JSON_NUMERIC_CHECK) !!},
                fill: false
            }

        ]
    };
    var data_p_lbiasa = {
        labels: {!! json_encode($gperiode,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Anggota Perempuan Luar Biasa",
                data: {!! json_encode($gp_lbiasa,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_aset = {
        labels: {!! json_encode($gperiode,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "aset (ASET)",
                data: {!! json_encode($gaset,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_aktivalancar = {
        labels: {!! json_encode($gperiode,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Aktiva Lancar",
                data: {!! json_encode($gaktivalancar,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_simpanansaham = {
        labels: {!! json_encode($gperiode,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Simpanan Saham",
                data: {!! json_encode($gsimpanansaham,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_nonsaham_unggulan = {
        labels: {!! json_encode($gperiode,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Simpanan Non Saham Unggulan",
                data: {!! json_encode($gnonsaham_unggulan,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_nonsaham_harian = {
        labels: {!! json_encode($gperiode,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Simpanan Non Saham Harian & Deposito",
                data: {!! json_encode($gnonsaham_harian,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_hutangspd = {
        labels: {!! json_encode($gperiode,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Hutang SPD",
                data: {!! json_encode($ghutangspd,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_piutangberedar = {
        labels: {!! json_encode($gperiode,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Piutang Beredar",
                data: {!! json_encode($gpiutangberedar,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_piutanglalai_1bulan = {
        labels: {!! json_encode($gperiode,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Piutang Lalai 1-12 Bulan",
                data: {!! json_encode($gpiutanglalai_1bulan,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_piutanglalai_12bulan = {
        labels: {!! json_encode($gperiode,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Piutang Lalai > 12 Bulan",
                data: {!! json_encode($gpiutanglalai_12bulan,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_dcr = {
        labels: {!! json_encode($gperiode,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "DCR",
                data: {!! json_encode($gdcr,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_dcu = {
        labels: {!! json_encode($gperiode,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "DCU",
                data: {!! json_encode($gdcu,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_totalpendapatan = {
        labels: {!! json_encode($gperiode,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Total Pendapatan",
                data: {!! json_encode($gtotalpendapatan,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_totalbiaya = {
        labels: {!! json_encode($gperiode,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Total Biaya",
                data: {!! json_encode($gtotalbiaya,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_shu = {
        labels: {!! json_encode($gperiode,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "SHU",
                data: {!! json_encode($gshu,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_totalanggota = {
        labels: {!! json_encode($gperiode,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Total Anggota",
                data: {!! json_encode($gtotalanggota,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_piutangbersih = {
        labels: {!! json_encode($gperiode,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Piutang Bersih",
                data: {!! json_encode($gpiutangbersih,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_rasioberedar = {
        labels: {!! json_encode($gperiode,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Rasio Piutang Beredar",
                data: {!! json_encode($grasioberedar,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_rasiolalai = {
        labels: {!! json_encode($gperiode,JSON_NUMERIC_CHECK) !!},
        datasets: [
            {
                label: "Rasio Piutang Lalai",
                data: {!! json_encode($grasiolalai,JSON_NUMERIC_CHECK) !!},
                fill: false
            }
        ]
    };
    var data_anggota = {
        labels: {!! json_encode($gperiode,JSON_NUMERIC_CHECK) !!},
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
</script>
{{-- /data grafik --}}
{{-- grafik --}}
<script>
	var randomColorFactor = function() {
        return Math.round(Math.random() * 255);
    };
    var randomColor = function(opacity) {
        return 'rgba(' + randomColorFactor() + ',' + randomColorFactor() + ',' + randomColorFactor() + ',' + (opacity || '.3') + ')';
    };
    var config = {
        type: 'line',
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

    $.each(config.data.datasets, function(i, dataset) {
        dataset.borderColor = randomColor(0.4);
        dataset.backgroundColor = randomColor(0.5);
        dataset.pointBorderColor = randomColor(0.7);
        dataset.pointBackgroundColor = randomColor(0.5);
        dataset.pointBorderWidth = 1;
    });

    window.onload = function() {
        var ctx = document.getElementById("chart").getContext("2d");
        window.chart = new Chart(ctx, config);
    };
</script>
{{-- /grafik --}}
{{-- btn grafik --}}
<script>
	$(function(){
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
            }else if(id =="aset"){
                config.data = data_aset;
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
	});
</script>
{{-- /btn grafik --}}
@stop