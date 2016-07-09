<?php
$title = "Kelola Kategori Artikel";
$kelas = "kategoriartikel";
?>
@extends('admins._layouts.layout')

@section('content')
<!-- header -->
<section class="content-header">
    <h1>
        <i class="fa fa-archive"></i> {!! $title !!}
        <small>Mengelola Data Kategori Artikel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('admins') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><i class="fa fa-book"></i> {!! $title !!}</li>
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
                <a type="button" accesskey="t" class="btn btn-primary modal2"
                   href="#"><i class="fa fa-plus"></i> <u>T</u>ambah Kategori Artikel</a>
            </div>
        </div>
        <div class="box-body">
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                <tr>
                    <th></th>
                    <th>Nama Kategori </th>
                    <th>Jumlah Artikel</th>
                    <th>Ubah</th>
                    <th>Hapus</th>
                </tr>
                </thead>
                <tbody>
                @foreach($datas as $data)
                    <tr>
                        <td></td>
                        @if(!empty($data->name))
                            @if($data->id > 1)
                                <td>{!! $data->name !!}</td>
                            @else
                                <td>{!! $data->name !!}</td>
                            @endif
                        @else
                            <td>-</td>
                        @endif

                        @if($data->hasartikel->count() > 0)
                            <td><a class="btn btn-warning" href="{{route('admins.artikel.index_kategori', array($data->id))}}">
                                    {!! $data->jumlah !!}</a></td>
                        @else
                            <td><a href="#" class="btn btn-warning">{!! $data->hasartikel->count() !!}</a> </td>
                        @endif

                        <td><a class="btn btn-primary modal3" href="#" name={!! $data->id !!}>
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
<!-- Hapus -->
<div class="modal fade" id="modal1show" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    {{ Form::open(array('route' => array('admins.'.$kelas.'.destroy',$kelas), 'method' => 'delete')) }}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="fa fa-trash"></i> Hapus Kategori Artikel</h4>
            </div>
            <div class="modal-body">
                <strong>Menghapus kategori artikel ini ?</strong>
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
<!-- tambah -->
<div class="modal fade" id="modal2show" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   {{ Form::open(array('route' => array('admins.'.$kelas.'.store'))) }}
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title "><i class="fa fa-plus"></i> Tambah Kategori Artikel</h4>
        </div>
        <div class="modal-body">
          <strong>Menambah Kategori Artikel</strong>
          <input type="text" name="id" value="" id="modal2id" hidden>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-font"></i></span>
                {{ Form::text('name',null,array('class' => 'form-control',
                  'placeholder' => 'Silahkan masukkan nama kategori artikel','autocomplete'=>'off'))}}
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
<!-- ubah -->
<div class="modal fade" id="modal3show" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
{{ Form::open(array('route' => array('admins.'.$kelas.'.update',$kelas), 'method' => 'put')) }}
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title "><i class="fa fa-pencil-square-o"></i> Ubah Kategori Artikel</h4>
        </div>
        <div class="modal-body">
          <strong>Mengubah kategori artikel</strong>
          <input type="text" name="id" value="" id="modal3id" hidden>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-font"></i></span>
                {{ Form::text('name',null,array('class' => 'form-control','id'=>'modal3id2',
                'placeholder' => 'Silahkan masukkan nama kategori artikel baru','autocomplete'=>'off'))}}
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
<!-- /ubah -->
<!-- /.modal -->
@stop