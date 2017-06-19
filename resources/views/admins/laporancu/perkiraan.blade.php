<?php
$kelas= "artikel";
$title = "Perkiraan";
?>

@extends('admins._layouts.layout')

@section('css')
    @include('admins._components.datatable_CSS')
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/dataTables/extension/Responsive/css/responsive.bootstrap.css')}}" >
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/dataTables/extension/RowGroup/css/rowGroup.bootstrap.min.css')}}" >
    <style>
        table.dataTable tr.group-start td {
            border-bottom: .5px solid #00c0ef;
        }
        table.dataTable tr.group-end td {
            border-top: .5px solid #00c0ef;
        }
        table.dataTable tr.group td {
            background-color:white;
        }
    </style>
@stop

@section('content')
<!-- header -->
<section class="content-header">
    <h1>
        <i class="fa fa-compass"></i> {{ $title }}
        <small>Mengelola Data {{ $title }} {{ $cu->NMCU }}</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('admins') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><i class="fa fa-compass"></i> {{ $title }}</li>
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
            <div class="col-sm-3" style="padding: .2em ;">
                <div class="input-group">
                    <div class="input-group-addon">CU</div>
                    <input type="text" name="nama_cu" class="form-control" value="{{ $cu->NMCU }}">
                </div>
            </div>
            <div class="col-sm-3">
                <div class="input-group">
                    <div class="input-group-addon">Bulan Saham</div>
                    <input type="text" name="blnsaham" class="form-control" value="{{ $blnsaham }}">
                </div>
            </div>
        </div>
    </div>
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_perkiraan" data-toggle="tab">Perkiraan</a></li>
        </ul>
        <div class="tab-content"> 
            <div class="tab-pane active" id="tab_perkiraan">
                <div class="input-group tabletools">
                    <div class="input-group-addon"><i class="fa fa-search"></i></div>
                    <input type="text" id="searchtext" class="form-control" placeholder="Kata kunci pencarian...">
                </div>
                <table class="table table-hover dt-responsive" id="dataTables-example" width="100%">
                    <thead class="bg-light-blue-active color-palette">
                    <tr>
                        <th hidden></th>
                        <th hidden></th>
                        <th hidden></th>
                        <th>No. Perkiraan</th>
                        <th>Nama Perkiraan</th>
                        <th>Induk</th>
                        <th>Kelompok</th>
                        <th class="text-right">Saldo Awal</th>
                        <th class="text-right">Saldo Akhir</th>
                        <th class="text-right">Total Saldo</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($datas as $data)
                        <?php 
                            $indukNO = "";
                            $indukNM = "";
                            foreach($juduls as $judul){
                                if($judul->NOPRK == $data->INDUK){
                                    $indukNO = $judul->NOPRK;
                                    $indukNM = strtoupper($judul->NMPRK);
                                }
                            }
                            $sldakr = 0;
                            $perksa = $data->PERKSA->FIRST();  
                            foreach($data->JURNALDTL as $jurnal){
                                $sldakr = $sldakr + $jurnal->JUMLAH;
                            }
                            $sldawl = 0;
                            $sldawl = !empty($perksa) ? $perksa->SLDAWL : 0;
                            $total = $sldawl + $sldakr;
                        ?>
                        <tr>
                            <td hidden>{{ number_format($sldawl,"0","","") }}</td>
                            <td hidden>{{ number_format($sldakr,"0","","") }}</td>
                            <td hidden>{{ number_format($total,"0","","") }}</td>
                            <td>{{ $data->NOPRK }}</td>
                            <td>{{ $data->NMPRK }}</td>
                            @if(!empty($indukNM))
                                <td>{{ '[ '.$indukNO.' ] '. $indukNM }}</td>
                            @else
                                <td></td>
                            @endif
                            <td>{{ $data->KELOMPOK }}</td>
                            <td class="text-right">{{ number_format(abs($sldawl),"0",",",".") }}
                                {!! $sldawl < 0 ? '<b class="label label-danger">K</b>' : '<b class="label label-info">D</b>' !!}
                            </td>
                            <td class="text-right">{{ number_format(abs($sldakr),"0",",",".") }}
                                {!! $sldakr < 0 ? '<b class="label label-danger">K</b>' : '<b class="label label-info">D</b>' !!}
                            </td>
                            <td class="text-right">{{ number_format(abs($total),"0",",",".") }}
                                {!! $total < 0 ? '<b class="label label-danger">K</b>' : '<b class="label label-info">D</b>' !!}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--content-->
</section>
@stop

@section('js')
    @include('admins._components.datatable_JS')
    <script type="text/javascript" src="{{ URL::asset('plugins/dataTables/extension/RowGroup/js/dataTables.rowGroup.min.js') }}"></script>
    <script>
        var table = $('#dataTables-example').DataTable({
            dom: 'Bti',
            scrollY: '80vh',
            scrollX: true,
            autoWidth: true,
            scrollCollapse : true,
            paging : false,
            stateSave : false ,
            select: {
                style:    'os',
                selector: 'td:not(:last-child)'
            },
            orderFixed: [5, 'asc'],
            order: [3,'asc'],
            rowGroup:{
                endRender: function(rows,group){
                    var sldawl_tipe ="";
                    var sldakr_tipe ="";
                    var ttl_tipe ="";
                    var sldawl=rows
                            .data()
                            .pluck(0)
                            .reduce(function(a,b){
                                return a + b*1;
                            },0);
                    var sldakr=rows
                            .data()
                            .pluck(1)
                            .reduce(function(a,b){
                                return a + b*1;
                            },0);
                    var ttl=rows
                            .data()
                            .pluck(2)
                            .reduce(function(a,b){
                                return a + b*1;
                            },0);        
                    if(sldawl >= 0){
                        sldawl_tipe = "[D]";
                    }else{
                        sldawl_tipe = "[K]";
                    }
                    if(sldakr >= 0){
                        sldakr_tipe = "[D]";
                    }else{
                        sldakr_tipe = "[K]";
                    }
                    if(ttl >= 0){
                        ttl_tipe = "[D]";
                    }else{
                        ttl_tipe = "[K]";
                    }     
                    return $('<tr/>')
                    .append( '<td></td>' )
                    .append( '<td colspan="2" class="text-right text-aqua">TOTAL '+group+'</td>' )
                    .append( '<td class="bg-aqua disabled color-palette text-right " >'+$.fn.dataTable.render.number('.', ',', 0,).display( Math.abs(sldawl) )+' '+sldawl_tipe+'</td>' )
                    .append( '<td class="bg-aqua disabled color-palette text-right ">'+$.fn.dataTable.render.number('.', ',', 0,).display( Math.abs(sldakr) )+' '+sldakr_tipe+'</td>' )
                    .append( '<td class="bg-aqua disabled color-palette text-right ">'+$.fn.dataTable.render.number('.', ',', 0,).display( Math.abs(ttl) )+' '+ttl_tipe+'</td>' )
                },
                dataSrc: '5'
            },
            columnDefs: [ { "visible": false, "targets": 5 } ],
            buttons: [
                {
                    text: 'Berdasarkan Induk',
                    action: function(){
                        table.rowGroup().dataSrc(5);
                        table.order.fixed({pre: [[5,'asc']]}).draw();
                        table.column(3).order('asc').draw();
                        table.column(5).visible(false);
                        table.column(6).visible(true);
                    }
                },
                {
                    text: 'Berdasarkan Kelompok',
                    action: function(){
                        table.rowGroup().dataSrc(6);
                        table.order.fixed({pre: [[6,'asc']]}).draw();
                        table.column(3).order('asc').draw();
                        table.column(6).visible(false);
                        table.column(5).visible(true);
                    }
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

        table.columns('.sort').order('asc').draw();

        $('#searchtext').keyup(function(){
            table.search($(this).val()).draw() ;
        });  
    </script>
@stop