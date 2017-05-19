<?php
$title = "Pemilihan";
$kelas = "pemilihan";
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
        <small>Mengelola Data {{ $title }}</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('admins') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><i class="fa fa-pencil-square-o"></i> {{ $title }}</li>
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
            <li class="active"><a href="#tab_pemilihan" data-toggle="tab">{{ $title }}</a></li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="tab_pemilihan">
                <div class="input-group tabletools">
                    <div class="input-group-addon"><i class="fa fa-search"></i></div>
                    <input type="text" id="searchtext" class="form-control" placeholder="Kata kunci pencarian...">
                </div>
                <table class="table table-hover dt-responsive" id="dataTables-example" width="100%">
                    <thead class="bg-light-blue-active color-palette">
                    <tr>
                        <th hidden></th>
                        <th class="sort" data-priority="1">Nama</th>
                        <th>Mulai</th>
                        <th>Selesai</th>
                        <th>&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($datas as $data)
                        <tr>
                            <td hidden>{{ $data->id }}</td>
                            <td class="warptext">{{ $data->name }}</td>
                            @if(!empty($data->mulai ))
                                <?php $date = new Date($data->mulai); ?>
                                <td data-order="{{$data->mulai}}">{{  $date->format('d/m/Y') }}</td>
                            @else
                                <td>-</td>
                            @endif
                             @if(!empty($data->selesai ))
                                <?php $date2 = new Date($data->selesai); ?>
                                <td data-order="{{$data->selesai}}">{{  $date2->format('d/m/Y') }}</td>
                            @else
                                <td>-</td>
                            @endif
                            <td></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>  
        </div>
    </div>
    <!--content-->
</section>

<!-- modal -->
<!-- tambah -->
<div class="modal fade" id="modaltambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    {{ Form::open(array('route' => array('admins.'.$kelas.'.store'),'data-toggle' => 'validator','role' => 'form')) }}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-light-blue-active color-palette">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title "><i class="fa fa-plus"></i> Tambah Pemilihan</h4>
            </div>
            <div class="modal-body">
                <input type="text" name="id" value="" id="modaltambah_id" hidden>
                <div class="form-group">
                    <h4>Nama pemilihan</h4>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-font"></i></span>
                        {{ Form::text('name',null,array('class' => 'form-control','id'=>'modaltambah_name',
                        'placeholder' => 'Silahkan masukkan pemilihan','autocomplete'=>'off','required'))}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <h4>Tanggal Mulai</h4>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                {{ Form::text('mulai',null,array('class' => 'form-control','autocomplete'=>'off', 'data-inputmask'=>"'alias':'date'",'placeholder'=>'dd/mm/yyyy'))}}
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <h4>Tanggal Selesai</h4>
                            <div class="input-group" id="groupselesaipekerjaan">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                {{ Form::text('selesai',null,array('class' => 'form-control',
                                    'autocomplete'=>'off', 'data-inputmask'=>"'alias':'date'",'placeholder'=>'dd/mm/yyyy'))}}
                            </div>
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
<!-- /tambah -->
<!-- ubah -->
<div class="modal fade" id="modalubah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    {{ Form::open(array('route' => array('admins.'.$kelas.'.update',$kelas), 'method' => 'put','data-toggle' => 'validator','role' => 'form')) }}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-light-blue-active color-palette">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title "><i class="fa fa-pencil"></i> Ubah Pemilihan</h4>
            </div>
            <div class="modal-body">
                <input type="text" name="id" value="" id="modalubah_id" hidden>
                <div class="form-group">
                    <h4>Mengubah pemilihan</h4>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-font"></i></span>
                        {{ Form::text('name',null,array('class' => 'form-control','id'=>'modalubah_name',
                        'placeholder' => 'Silahkan masukkan pemilihan','autocomplete'=>'off','required','data-minlength' => '5'))}}
                    </div>
                </div>
                 <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <h4>Tanggal Mulai</h4>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                {{ Form::text('mulai',null,array('class' => 'form-control','id'=>'mulai','autocomplete'=>'off', 'data-inputmask'=>"'alias':'date'",'placeholder'=>'dd/mm/yyyy'))}}
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <h4>Tanggal Selesai</h4>
                            <div class="input-group" id="groupselesaipekerjaan">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                {{ Form::text('selesai',null,array('class' => 'form-control','id'=>'selesai',
                                    'autocomplete'=>'off', 'data-inputmask'=>"'alias':'date'",'placeholder'=>'dd/mm/yyyy'))}}
                            </div>
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
<!-- /ubah -->
<!-- /.modal -->
@stop

@section('js')
    @include('admins._components.datatable_JS')
    <script type="text/javascript" src="{{ URL::asset('plugins/dataTables/extension/Responsive/js/dataTables.responsive.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('plugins/dataTables/extension/Responsive/js/responsive.bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('admin/datatable_responsive.js') }}"></script>
    <script>
        new $.fn.dataTable.Buttons(table,{
            buttons: [
                {
                    text: '<i class="fa fa-plus"></i> <u>T</u>ambah',
                    key: {
                        altKey: true,
                        key: 't'
                    },
                    action: function(){
                        var id = $.map(table.rows({ selected:true }).data(),function(item){
                            return item[1];
                        });
                        $('#modaltambah').modal({show:true});
                        $('#modaltambah_id').attr('value',id);
                        
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
                            return item[0];
                        });
                        var name = $.map(table.rows({ selected: true }).data(),function(item){
                            return item[1];
                        });
                        var mulai = $.map(table.rows({ selected: true }).data(),function(item){
                            return item[2].display;
                        });
                        var selesai = $.map(table.rows({ selected: true }).data(),function(item){
                            return item[3].display;
                        });
                        if(id != ""){
                            $('#modalubah').modal({show:true});
                            $('#modalubah_id').attr('value',id);
                            $('#modalubah_name').attr('value',name);
                            $('#mulai').val(mulai);
                            $('#selesai').val(selesai);
                        }else{
                            $('#modalwarning').modal({show:true});
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
                            return item[0];
                        });
                        if(id != ""){
                            $('#modalhapus').modal({show:true});
                                $('#modalhapus_id').attr('value',id);
                                $('#modalhapus_judul').text('Hapus Pemilihan');
                                $('#modalhapus_detail').text('Yakin menghapus pemilihan ini ?');
                        }else{
                            $('#modalwarning').modal({show:true});
                        }
                    }
                },
                {
                    text: '<i class="fa fa-database"></i> Detail',
                    action: function(){
                        var id = $.map(table.rows({ selected: true }).data(),function(item){
                            return item[0];
                        });
                        var kelas = "{{ $kelas }}";
                        if(id != ""){
                            window.location.href =  kelas + "/calon/" + id;
                        }else{
                            $('#modalwarning').modal({show:true});
                        }
                    }
                }
            ]
        });
        table.buttons( 0, null ).container().prependTo(
                table.table().container()
        );
    </script>
@stop