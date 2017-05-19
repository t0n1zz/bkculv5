<?php
$title = "Pemilihan";

$kelas = "pemilihan";
$imagepath2 = "images_staf/";
$id_old="";
$cu = Auth::user()->getCU();
$culists = App\Cuprimer::orderBy('name','asc')->get();

?>
@extends('admins._layouts.layout')

@section('css')
@include('admins._components.datatable_CSS')
<link rel="stylesheet" type="text/css" href="{{asset('plugins/dataTables/extension/Responsive/css/responsive.bootstrap.css')}}" >
@stop

@section('content')
<!-- header -->
<section class="content-header">
    <h1>
        <i class="fa fa-pencil-square-o"></i> {{ $title }}
        <small>Mengelola Data {{ $title }} </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('admins') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><i class="fa fa-pencil-square-o"></i> {!! $title !!}</li>
    </ol>
</section>
<!-- /header -->
<!-- /header -->
<section class="content">
<!-- Alert -->
@include('admins._layouts.alert')
<!-- /Alert -->
<div class="alert alert-info">
    <h2 style="margin-top: 0px;">{{ $data->name }}</h2>
    <p>{{ $data->deskripsi }}</p>
</div>
@if($cu != 0)
    <a href="#tambahcalon" data-toggle="modal" data-target="#tambahcalon" class="btn btn-default btn-block"><i class="fa fa-plus"></i> Tambah Calon</a>
    <br/>
@else    
    <div class="well well-sm">
        <p>Pada pemilihan kali ini CU anda diberikan kesempatan untuk 1x memilih siapa yang dianggap pantas dan layak menjadi General Manager dari daftar calon dibawah, serta anda juga dapat mengusung 2 orang kandidat diluar daftar calon anda dimana ketentuannya adalah 1 orang berasal dari dalam CU dan 1 orang yang bukan dari CU.</p>
        <a href="#tambahcalon" data-toggle="modal" data-target="#tambahcalon" class="btn btn-primary">1 orang calon dari dalam CU</a>
        <a href="#" class="btn btn-primary">1 orang calon dari luar CU</a>
    </div>
@endif
<div class="row">
    @foreach($datas as $calon)
        <div class="col-sm-3">
            <div class="box box-primary">
                <div class="box-body box-profile">
                    @if(!empty($calon->staf->gambar) && is_file($imagepath2.$calon->staf->gambar."n.jpg"))
                        <div class="modalphotos" >
                        <img class="profile-user-img img-responsive" src="{{ asset($imagepath2.$calon->staf->gambar.'n.jpg') }}"
                             id="tampilgambar" alt="{{ asset($imagepath2.$calon->staf->gambar."jpg") }}">
                        </div>
                    @else
                        @if($calon->staf->kelamin == "Wanita")
                            <img class="profile-user-img img-responsive" src="{{ asset('images/no_image_woman.jpg') }}"
                                 id="tampilgambar" alt="Woman profile">
                        @else
                            <img class="profile-user-img img-responsive" src="{{ asset('images/no_image_man.jpg') }}"
                                 id="tampilgambar" alt="Man Profile">
                        @endif
                    @endif
                    <h3 class="profile-username text-center">{{ $calon->staf->name }}</h3>
                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>Jabatan:</b>
                            <span class="pull-right">{{ $calon->jabatan }}</span>
                        </li>
                        <li class="list-group-item">
                            <b>CU Pengusung:</b>
                            <span class="pull-right"> 
                            @if($calon->id_cu != 0)
                                {{ $calon->cu->name }}
                            @else
                                Puskopdit BKCU Kalimantan
                            @endif
                            </span>    
                        </li>
                    </ul>   
                    <a href="#" class="btn btn-default btn-block"><i class="fa fa-user"></i> Profile</a>
                    @if(!empty($pemilih) || $cu == 0)
                        <a class="btn btn-primary btn-block disabled">Pemilih: {{ $calon->pemilihanhub->count() }}</a>
                    @else
                        <a data-toggle="modal" data-id_calon="{{ $calon->id }}" class="btn btn-primary btn-block modalpilih"><i class="fa fa-pencil-square-o"></i> Pilih</a>
                    @endif
                </div><!-- /.box-body -->
            </div>
        </div>
    @endforeach
</div>

</section>
<!-- modal -->
<div class="modal fade" id="pilih" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    {{ Form::open(array('route' => array('admins.'.$kelas.'.store_pilih'))) }}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-light-blue-active color-palette">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="fa fa-pencil-square-o"></i> Pilih</h4>
            </div>
            <div class="modal-body">
                <input type="text" name="id_pemilihan" value="{{ $data->id }}" hidden>
                <input type="text" name="id_calon" value="" id="id_calon" hidden>
                <input type="text" name="id_cu" value="{{ $cu }}" id="id_cu" hidden>
                <h4>Pilih dia?</h4>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="modalbutton"><i class="fa fa-check"></i> Ya</button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
    {{ Form::close() }}
</div>
<div class="modal fade" id="tambahcalon" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    {{ Form::open(array('route' => array('admins.'.$kelas.'.store_calon'),'role' => 'form','id'=>'form_pemilihan')) }}
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-light-blue-active color-palette">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 clasas="modal-title"><i class="fa fa-plus"></i> Tambah Calon</h4>
            </div>
            <div class="modal-body">
                <input type="text" name="id_pemilihan" value="{{ $data->id }}" hidden>
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_pilih_pemilihan" data-toggle="tab" id='nav_pilih_pemilihan' data-target="#tab_pilih_pemilihan">Pilih</a></li>
                        <li><a href="#tab_baru_pemilihan" data-toggle="tab" id='nav_baru_pemilihan' data-target="#tab_baru_pemilihan">Buat Baru</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="tab_pilih_pemilihan">
                            <div class="row">
                                <div id="areapemilihan"></div>
                                @if($cu != 0)
                                    <input type="text" value="{{ $cu }}" name="id_cu" hidden>
                                @else
                                    <div class="col-sm-12" id="tugaspemilihan" style="display: none;">
                                        <div class="form-group">
                                            <h4>CU Pengusung</h4>
                                            <div class="input-group tabletools">
                                                <div class="input-group-addon primary-color"><i class="fa fa-building-o"></i></div>
                                                <select class="form-control" name="id_cu" id="id_cu">
                                                    <option value="0"><b>Puskopdit BKCU Kalimantan</b></option>
                                                    <option disabled>-------CU-------</option>       
                                                    @foreach($culists as $culist)
                                                        <option value="{{$culist->no_ba}}"><b>{{ $culist->name }}</b></option>
                                                    @endforeach 
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="col-sm-12"><hr/></div>
                                <div class="col-sm-12">
                                    <div class="input-group tabletools">
                                        <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                        <input type="text" id="searchpemilihan" class="form-control" placeholder="Kata kunci pencarian..." autofocus>
                                    </div>
                                    <table class="table table-hover dt-responsive" id="datatabletambahpemilihan" cellspacing="0" width="100%">
                                        @include('admins.kegiatan._component.tambahtable')
                                    </table>
                                </div>
                             </div>   
                        </div>
                        <div class="tab-pane" id="tab_baru_pemilihan">
                            <a href="{{ route('admins.staf.create')}}" class="btn btn-default btn-block"><i class="fa fa-plus"></i> Tambah Staf</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="modalbutton"><i class="fa fa-save"></i> Simpan</button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
    {{ Form::close() }}
</div>    
@stop

@section('js')
@include('admins._components.datatable_JS')
<script type="text/javascript" src="{{ URL::asset('plugins/dataTables/extension/Responsive/js/dataTables.responsive.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('plugins/dataTables/extension/Responsive/js/responsive.bootstrap.min.js') }}"></script>
<script>
    $('.modalpilih').on('click',function(){
        $('#pilih').modal({
            show: true,
        })

        var id_calon = $(this).data('id_calon');
        $('#id_calon').attr('value',id_calon);
    });
</script>
<script>
    var areapemilihan = $('#areapemilihan');
    var tabletambahpemilihan = $('#datatabletambahpemilihan').DataTable({
        dom: 'tip',
        autoWidth: true,
        paging : true,
        pagingType: 'full_numbers',
        stateSave : false ,
        select: {
            style:    'multiple',
            selector: 'td:not(:last-child)'
        },
        responsive:{
            details:{
                type: 'column',
                target: -1
            }
        },
        columnDefs: [ {
            className: 'control',
            orderable: false,
            targets:   -1
        }],
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
            "paginate": {
              "previous": "&lt;",
              "next": "&gt;",
              "first": "&lt;&lt;",
              "last": "&gt;&gt;"
            }
        }
    });

    tabletambahpemilihan.columns('.sort').order('asc').draw();

    $('#searchpemilihan').keyup(function(){
        tabletambahpemilihan.search($(this).val()).draw() ;
    });

    tabletambahpemilihan
        .on( 'select', function ( e, dt, type, indexes ) {
            var id = $.map(tabletambahpemilihan.rows({ selected: true }).data(),function(item){
                        return item[0];
                    });
            var foto = $.map(tabletambahpemilihan.rows({ selected: true }).data(),function(item){
                        return item[1];
                    });
            var name = $.map(tabletambahpemilihan.rows({ selected: true }).data(),function(item){
                        return item[3];
                    });
            var jabatan = $.map(tabletambahpemilihan.rows({ selected: true }).data(),function(item){
                        return item[5];
                    });
            var htmlpemilihan = '<div class="col-sm-12" id="widgetpeserta">';
                htmlpemilihan += '<div class="box box-widget widget-user-2"">';
                    htmlpemilihan += '<div class="widget-user-header bg-aqua">' ;
                        htmlpemilihan += '<div class="widget-user-image">';
                            htmlpemilihan += '<img class="img-thumbnail" src="'+foto+'" alt="User Image">';
                        htmlpemilihan += '</div>';
                        htmlpemilihan += '<input type="text" name="staf" style="display:none;" value="'+id+'"/>'
                        htmlpemilihan += '<input type="text" name="jabatan" style="display:none;" value="'+jabatan+'"/>'
                        htmlpemilihan += '<h3 class="widget-user-username">'+name+'</h3>';
                        htmlpemilihan += '<h5 class="widget-user-desc">'+jabatan+'</h5>';  
                    htmlpemilihan += '</div>';            
                htmlpemilihan += '</div>';                
                htmlpemilihan += '</div>';

            areapemilihan.prepend(htmlpemilihan);
            $('#tugaspemilihan').show();
        } )
        .on('deselect',function(e, dt, type, indexes){
            $('#widgetpeserta').remove();
            $('#tugaspemilihan').hide();
        });
</script>
@stop