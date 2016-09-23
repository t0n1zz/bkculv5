<?php
$title = "Kelola Kegiatan";
$kelas = "kegiatan";
?>
@extends('admins._layouts.layout')

@section('css')
    @include('admins._components.datatable_CSS')
@stop

@section('content')
<!-- header -->
<section class="content-header">
    <h1>
        <i class="fa fa-archive"></i> {{ $title }}
        <small>Mengelola Data Kegiatan</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('admins') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><i class="fa fa-calendar"></i> {{ $title }}</li>
    </ol>
</section>
<!-- /header -->
<section class="content">
    <!-- Alert -->
    @include('admins._layouts.alert')
    <!-- /Alert -->
    <!--content-->
    <div class="box box-primary">
        <div class="box-header with-border">
            <div class="input-group">
                <div class="input-group-addon primary-color"><i class="fa fa-list"></i></div>
                <select class="form-control"  id="">
                    <option value="">Kegiatan Periode 2016</option>
                    <option value="">Kegiatan Periode 2015</option>
                </select>
            </div>
        </div>
        <div class="box-body">
            <table class="table table-striped table-hover" id="dataTables-example" width="100%">
                <thead>
                <tr class="bg-light-blue-active color-palette">
                    <th hidden></th>
                    <th>Nama </th>
                    <th>Wilayah</th>
                    <th>Tempat</th>
                    <th>Sasaran</th>
                    <th>Tanggal Dimulai</th>
                    <th>Tanggal Selesai</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                @foreach($datas as $data)
                    <tr>
                        <td hidden>{{ $data->id }}</td>
                        @if(!empty($data->name))
                            <td class="warptext">{{ $data->name }}</td>
                        @else
                            <td>-</td>
                        @endif

                        @if(!empty($data->wilayah))
                            <td>{{ $data->wilayah }}</td>
                        @else
                            <td>-</td>
                        @endif

                        @if(!empty($data->tempat))
                            <td>{{ $data->tempat }}</td>
                        @else
                            <td>-</td>
                        @endif

                        @if(!empty($data->sasaran))
                            <td class="warptext">{{ $data->sasaran }}</td>
                        @else
                            <td>-</td>
                        @endif

                        @if(!empty($data->tanggal))
                            <?php $date = new Date($data->tanggal); ?>
                            <td><i hidden="true">{{ $data->tanggal }}</i> {{  $date->format('d/n/Y') }}</td>
                        @else
                            <td>-</td>
                        @endif

                        @if(!empty($data->tanggal2))
                            <?php $date2 = new Date($data->tanggal2); ?>
                            <td><i hidden="true">{{ $data->tanggal2 }}</i> {{ $date2->format('d/n/Y') }}</td>
                        @else
                            <td>-</td>
                        @endif

                        @if($data->status == "0")
                            <td><a href="#" class="btn btn-default" disabled>
                                    <i hidden="true">tidak</i><i class="fa fa-ban"></i></a></td>
                        @else
                            <td><a href="#" class="btn btn-warning" disabled>
                                    <i hidden="true">iya</i><i class="fa fa-check"></i></a></td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!--content-->
</section>
<!-- Hapus -->
<div class="modal fade" id="modal1show" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   {{ Form::open(array('route' => array('admins.' .$kelas. '.destroy',$kelas), 'method' => 'delete')) }}
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Hapus Kegiatan</h4>
        </div>
        <div class="modal-body">
          <h4>Menghapus kegiatan ini?</h4>
          <input type="text" name="id" value="" id="modal1id" hidden>
        </div>
        <div class="modal-footer">
              <button type="submit" class="btn btn-primary" id="modalbutton"><i class="fa fa-check"></i> Ok</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
   {{ Form::close() }}
</div>
<!-- /Hapus -->
@stop

@section('js')
    @include('admins._components.datatable_JS')
    <script type="text/javascript" src="{{ URL::asset('admin/datatable.js') }}"></script>
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
                            return item[0];
                        });
                        var kelas = "{{ $kelas }}";
                        if(id != ""){
                            window.location.href =  kelas + "/" + id + "/edit";
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
                            return item[0];
                        });
                        var kelas = "{{ $kelas }}";
                        if(id != ""){
                            window.location.href =  kelas + "/" + id + "/detail";
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