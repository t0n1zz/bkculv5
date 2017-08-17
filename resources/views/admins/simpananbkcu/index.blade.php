<?php
$kelas= "simpanan";
$title = "Simpanan BKCU";
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
        <small>Mengelola Data {{ $title }}</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('admins') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><i class="fa fa-compass"></i> {{ $title }}</li>
    </ol>
</section>
<!-- /header -->
<section class="content" >
    <!-- Alert -->
    @include('admins._layouts.alert')
    <!-- /Alert -->
    <!--content-->
    <div class="box box-solid" id="perkiraanController">
        <div class="box-body">
            <div class="input-group">
                <div class="input-group-addon">Jenis</div>
                <select class="form-control" name="selectsimpanan" id="selectsimpanan" onchange="load_simpanan();">
                    <option hidden>Silahkan pilih jenis Simpanan</option>
                    <option value="SKL">SIKLUS</option>
                    <option value="PTS">PANTAS</option>
                </select>
            </div>
        </div>
    </div>
    <div class="nav-tabs-custom" id="div_table" style="display: none">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_simpanan" data-toggle="tab"><span class="jenissimpanan"></span></a></li>
        </ul>
        <div class="tab-content"> 
            <div class="tab-pane active" id="tab_perkiraan">
                <div class="input-group tabletools">
                    <div class="input-group-addon"><i class="fa fa-search"></i></div>
                    <input type="text" id="searchtext" class="form-control" placeholder="Kata kunci pencarian...">
                </div>
                <table class="table table-hover dt-responsive" id="dataTables-example" width="100%">
                    <thead class="bg-light-blue-active color-palette">
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--content-->
</section>
<div class="modal fade" id="modalsimpanan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-light-blue-active color-palette">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="fa fa-database"></i> Detail Transaksi <span class="jenissimpanan"></span></h4>
            </div>
            <div class="modal-body">
                <div class="input-group tabletools">
                    <div class="input-group-addon"><i class="fa fa-search"></i></div>
                    <input type="text" id="searchtext2" class="form-control" placeholder="Kata kunci pencarian...">
                </div>
                <table class="table table-hover dt-responsive" id="dataTables-example2" width="100%">
                    <thead class="bg-light-blue-active color-palette">
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
@stop

@section('js')
    @include('admins._components.datatable_JS')
    <script type="text/javascript" src="{{ URL::asset('plugins/dataTables/extension/RowGroup/js/dataTables.rowGroup.min.js') }}"></script>
    <script type="text/javascript">
        var tableloaded = false;
        function load_simpanan()
        {
            var jns = $('#selectsimpanan').val();
            var nmjns = $("#selectsimpanan option:selected").text();
            $('.jenissimpanan').text(nmjns);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'POST',
                data: {
                    jns:jns,
                   },
                url: '/admins/simpanan/load_simpananbkcu',
                success: function(data){
                    if(!tableloaded){
                        $('#div_table').show();
                        tableloaded = true;
                        var table = $('#dataTables-example').DataTable({
                            dom: 'Bt',
                            data: data,
                            scrollY: '80vh',
                            scrollX: true,
                            scrollCollapse : true,
                            paging : false,
                            stateSave : false,
                            select: {
                                style:    'single'
                            },
                            columns: [
                                { data: "id", searchable:false, orderable:false, visible:false },
                                { data: "no", visible:false },
                                { data: "no_rek", searchable:false, orderable:false, visible:false },
                                { data: "no_rek", title:"No. Rekening", render:function(data){
                                    return $.fn.dataTable.render.number('.', ',', 0,).display(data);
                                }},
                                { data: "no_ba", title:"No. BA" },
                                { data: "name" , title:"Nama CU"},
                                { data: "wilayah" , title:"Wilayah"},
                                { data: "buka" , title:"Tgl. Buka Rekening"},
                                { data: "awal" , title:"Saldo Awal", className:"text-right", render:function(data){
                                    if(data < 0){
                                        return $.fn.dataTable.render.number('.', ',', 0,).display(Math.abs(data))  + ' <b class="label label-danger">K</b>';
                                    }else{
                                        return $.fn.dataTable.render.number('.', ',', 0,).display(Math.abs(data))  + ' <b class="label label-info">D</b>';
                                    }
                                }},
                                { data: "akhir" , title:"Saldo Akhir", className:"text-right", render:function(data){
                                    if(data < 0){
                                        return $.fn.dataTable.render.number('.', ',', 0,).display(Math.abs(data))  + ' <b class="label label-danger">K</b>';
                                    }else{
                                        return $.fn.dataTable.render.number('.', ',', 0,).display(Math.abs(data))  + ' <b class="label label-info">D</b>';
                                    }
                                }},
                                { data: "total", title:"Total Saldo", className:"text-right", render:function(data){
                                    if(data < 0){
                                        return $.fn.dataTable.render.number('.', ',', 0,).display(Math.abs(data))  + ' <b class="label label-danger">K</b>';
                                    }else{
                                        return $.fn.dataTable.render.number('.', ',', 0,).display(Math.abs(data))  + ' <b class="label label-info">D</b>';
                                    }
                                }}
                            ],
                            order: [3,'asc'],
                            rowGroup:{
                                endRender:function(rows,group){
                                    var sldawl_tipe ="";
                                    var sldakr_tipe ="";
                                    var ttl_tipe ="";
                                    var sldawl=rows
                                            .data()
                                            .pluck('awal')
                                            .reduce(function(a,b){
                                                return a + b*1;
                                            },0);
                                    var sldakr=rows
                                            .data()
                                            .pluck('akhir')
                                            .reduce(function(a,b){
                                                return a + b*1;
                                            },0);
                                    var ttl=rows
                                            .data()
                                            .pluck('total')
                                            .reduce(function(a,b){
                                                return a + b*1;
                                            },0);        
                                    if(sldawl >= 0){
                                        sldawl_tipe = "[D]";
                                        sldawal_class = "bg-aqua";
                                    }else{
                                        sldawl_tipe = "[K]";
                                        sldawal_class = "bg-red";
                                    }
                                    if(sldakr >= 0){
                                        sldakr_tipe = "[D]";
                                        sldakr_class = "bg-aqua";
                                    }else{
                                        sldakr_tipe = "[K]";
                                        sldakr_class = "bg-red";
                                    }
                                    if(ttl >= 0){
                                        ttl_tipe = "[D]";
                                        ttl_class = "bg-aqua";
                                    }else{
                                        ttl_tipe = "[K]";
                                        ttl_class = "bg-red";
                                    }     
                                    return $('<tr/>')
                                    .append( '<td></td>' )
                                    .append( '<td colspan="4" class="tdtotal text-right">TOTAL '+group+'</td>' )
                                    .append( '<td class="'+sldawal_class+' disabled color-palette text-right " >'+$.fn.dataTable.render.number('.', ',', 0,).display( Math.abs(sldawl) )+' '+sldawl_tipe+'</td>' )
                                    .append( '<td class="'+sldakr_class+' disabled color-palette text-right ">'+$.fn.dataTable.render.number('.', ',', 0,).display( Math.abs(sldakr) )+' '+sldakr_tipe+'</td>' )
                                    .append( '<td class="'+ttl_class+' disabled color-palette text-right ">'+$.fn.dataTable.render.number('.', ',', 0,).display( Math.abs(ttl) )+' '+ttl_tipe+'</td>' )
                                },
                                dataSrc: 'no'
                            },
                            buttons: [
                                {
                                    text: '<i class="fa fa-object-group"></i>',
                                    className: 'nokelompok disabled',
                                    titleAttr: 'Tidak dikelompokkan',
                                    action: function(){
                                        table.rowGroup().enable().draw();
                                        table.rowGroup().dataSrc('no');
                                        table.order.fixed({pre: [[1,'asc']]}).draw(false);
                                        table.column(3).order('asc').draw();
                                        table.column(6).visible(true);
                                        $('.nokelompok').addClass('disabled');
                                        $('.wilayah').removeClass('disabled'); 
                                        $('.tdtotal').attr('colspan',4);
                                    }
                                },
                                {
                                    text: 'Kelompok Wilayah',
                                    className: 'wilayah',
                                    titleAttr: 'Dikelompokkan berdasarkan wilayah CU',
                                    action: function(){
                                        table.rowGroup().enable().draw();
                                        table.rowGroup().dataSrc('wilayah');
                                        table.order.fixed({pre: [[6,'asc']]}).draw();
                                        table.column(3).order('asc').draw();
                                        table.column(6).visible(false);
                                        $('.nokelompok').removeClass('disabled');
                                        $('.wilayah').addClass('disabled'); 
                                        $('.tdtotal').attr('colspan',3);
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

                        new $.fn.dataTable.Buttons(table,{
                            buttons: [
                                {
                                    text: '<i class="fa fa-database"></i> Detail',
                                    titleAttr: 'Detail Simpanan',
                                    action: function(){
                                        var no_rek = $.map(table.rows({ selected: true }).data(),function(item){
                                                return item.no_rek;
                                            });
                                        $.ajaxSetup({
                                            headers: {
                                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                            }
                                        });

                                        $.ajax({
                                            type : 'POST',
                                            data: {
                                                no_rek:no_rek
                                            },
                                            url: '/admins/simpanan/load_simpananbkcutr',
                                            success: function(data){
                                                $('#modalsimpanan').modal({show:true});

                                                var table2 = $('#dataTables-example2').DataTable();
                                                table2.clear().rows.add(data).draw();
                                                table2.column(1).order('asc').draw();
                                            },
                                            error: function(xhr, textstatus,errorThrown){
                                            }
                                        })
                                    },
                                    init: function ( dt, node, config ) {
                                        var that = this;
                                        dt.on( 'select.dt.DT deselect.dt.DT', function () {
                                            that.enable( dt.rows( { selected: true } ).any() );
                                        } );
                                        this.disable();
                                    }
                                },
                            ]
                        });
                        table.buttons( 0, null ).container().prependTo(
                                table.table().container()
                        ); 
                    }else{
                        var table = $('#dataTables-example').DataTable();
                        table.clear().rows.add(data).draw();
                    } 
                },
                error: function(xhr, textstatus,errorThrown){
                }
            });
        }
    </script>
    <script>
        var data2 = null;
        var table2 = $('#dataTables-example2').DataTable({
            dom: 'Bt',
            data: data2,
            scrollY: '70vh',
            scrollX: true,
            scrollCollapse : true,
            paging : false,
            stateSave : false,
            select: {
                style:    'single'
            },
            columns: [
                { data: "id", searchable:false, orderable:false, visible:false },
                { data: "no_slip", title:"No. Slip", render:function(data){
                    return $.fn.dataTable.render.number('.', ',', 0,).display(data);
                }},
                { data: "snd", title:"SND" },
                { data: "jenis" , title:"Jenis"},
                { data: "penyetor" , title:"Penyetor"},
                { data: "keterangan" , title:"Keterangan"},
                { data: "operator" , title:"Operator"},
                { data: "tanggal" , title:"Tanggal", visible:false},
                { data: "jumlah", title:"Jumlah", className:"text-right", render:function(data){
                    if(data < 0){
                        return $.fn.dataTable.render.number('.', ',', 0,).display(Math.abs(data))  + ' <b class="label label-danger">K</b>';
                    }else{
                        return $.fn.dataTable.render.number('.', ',', 0,).display(Math.abs(data))  + ' <b class="label label-info">D</b>';
                    }
                }}
            ],
            orderFixed: [7, 'asc'],
            order: [1,'asc'],
            rowGroup:{
                endRender:function(rows,group){
                    var ttl_tipe ="";
                    var ttl=rows
                            .data()
                            .pluck('jumlah')
                            .reduce(function(a,b){
                                return a + b*1;
                            },0);        
                    if(ttl >= 0){
                        ttl_tipe = "[D]";
                        ttl_class = "bg-aqua";
                    }else{
                        ttl_tipe = "[K]";
                        ttl_class = "bg-red";
                    }     
                    return $('<tr/>')
                    .append( '<td></td>' )
                    .append( '<td colspan="5" class="tdtotal text-right">TOTAL '+group+'</td>' )
                    .append( '<td class="'+ttl_class+' disabled color-palette text-right ">'+$.fn.dataTable.render.number('.', ',', 0,).display( Math.abs(ttl) )+' '+ttl_tipe+'</td>' )
                },
                dataSrc: 'tanggal'
            },
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

        $('#searchtext2').keyup(function(){
            table2.search($(this).val()).draw() ;
        });

        $('#modalsimpanan').on('shown.bs.modal', function () {
            $.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust();
        })
    </script>
@stop