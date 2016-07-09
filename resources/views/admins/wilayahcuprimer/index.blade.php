<?php
$title = "Kelola Wilayah CU";
$kelas = "wilayahcuprimer"
?>
@extends('admins._layouts.layout')

@section('content')
<!-- header -->
<section class="content-header">
    <h1>
        <i class="fa fa-archive"></i> {{ $title }}
        <small>Mengelola Data Wilayah CU Primer</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('admins') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><i class="fa fa-building"></i> {{ $title }}</li>
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
            <div class="form-group">
                <a type="button" accesskey="t"
                   class="btn btn-primary modal2" href="#"><i class="fa fa-plus"></i> <u>T</u>ambah Wilayah CU</a>
            </div>
        </div>
        <div class="box-body">
            <table class="table table-striped table-bordered table-hover table-fullwidth" id="dataTables-example" style="width:100%;">
                <thead>
                <tr>
                    <th></th>
                    <th>Nama Wilayah </th>
                    <th>Jumlah CU</th>
                    <th>Ubah</th>
                    <th>Hapus</th>
                </tr>
                </thead>
                <tbody>
                @foreach($datas as $data)
                    <tr>
                        <td></td>
                        @if(!is_null($data->name))
                            <td>{{ $data->name }}</td>
                        @else
                            <td>-</td>
                        @endif

                        @if($data && count($data->hascuprimer) > 0)
                            <td><a class="btn btn-warning" href="{{route('admins.cuprimer.index_wilayah', array($data->id))}}"
                                        >{{ $data->jumlah }}</a></td>
                        @else
                            <td>{{ $data->jumlah }}</td>
                        @endif

                        <td><a class="btn btn-primary modal3" href="#" name={{ $data->id }}>
                                <i class="fa fa-pencil"></i></a></td>

                        <td><button class="btn btn-danger modal1" name="{{ $data->id }}">
                                <i class="fa fa-trash"></i></button></td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
    <!--content-->
</section>
<!-- modal -->
<!-- tambah -->
<div class="modal fade" id="modal2show" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   {{ Form::open(array('route' => array('admins.'.$kelas.'.store'))) }}
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title "><i class="fa fa-plus"></i> Tambah Wilayah CU</h4>
        </div>
        <div class="modal-body">
          <strong>Menambah wilayah CU</strong>
          <input type="text" name="id" value="" id="modal2id" hidden>
            <div class="input-group">
                {{ Form::text('name',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan nama wilayah CU',
                    'autocomplete'=>'off'))}}
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-warning" id="modalbutton"><i class="fa fa-check"></i> Ok</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
   {{ Form::close() }}
</div>
<!-- /tambah -->
<!-- Hapus -->
<div class="modal fade" id="modal1show" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    {{ Form::open(array('route' => array('admins.'.$kelas.'.destroy',$kelas), 'method' => 'delete')) }}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="fa fa-trash"></i> Hapus Wilayah CU Primer</h4>
            </div>
            <div class="modal-body">
                <strong>Menghapus wilayah CU Primer ini ?</strong>
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
<!-- ubah -->
<div class="modal fade" id="modal3show" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
{{ Form::open(array('route' => array('admins.'.$kelas.'.update','$kelas'), 'method' => 'put')) }}
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title ">Ubah Wilayah CU</h4>
        </div>
        <div class="modal-body">
          <strong>Mengubah wilayah CU</strong>
          <input type="text" name="id" value="" id="modal3id" hidden>
            <div class="input-group">
                {{ Form::text('name',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan nama wilayah CU',
                 'autocomplete'=>'off'))}}
            </div>
        </div>
        <div class="modal-footer">
              <button type="submit" class="btn btn-primary" id="modalbutton"><i class="fa fa-check"></i> Ok</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
   {{ Form::close() }}
</div>
<!-- /ubah -->
<!-- /.modal -->
@stop