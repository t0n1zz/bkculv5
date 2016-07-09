<?php
$title = "Kelola Download";
$kelas ='download';
?>

@extends('admins._layouts.layout')

@section('content')
<!-- header -->
<section class="content-header">
    <h1>
        <i class="fa fa-archive"></i> {!! $title !!}
        <small>Mengelola File Download</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('admins') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><i class="fa fa-download"></i> {!! $title !!}</li>
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
                <a accesskey="t" class="btn btn-primary" href="{{ route('admins.'.$kelas.'.create') }}">
                    <i class="fa fa-plus"></i> <u>T</u>ambah File</a>
            </div>
        </div>
        <div class="box-body">
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                <tr>
                    <th></th>
                    <th>Nama </th>
                    <th>Tanggal</th>
                    <th>Ubah</th>
                    <th>Hapus</th>
                </tr>
                </thead>
                <tbody>
                @foreach($datas as $data)
                    <tr>
                        <td></td>
                        @if(!empty($data->name))
                            <td>{{ $data->name }}</td>
                        @else
                            <td>-</td>
                        @endif

                        @if(!empty($data->created_at))
                            <?php $date = new Date($data->created_at); ?>
                            <td><i hidden="true">{{$data->created_at}}</i> {{  $date->format('d/n/Y') }}</td>
                        @else
                            <td>-</td>
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
</section>

<!-- modal -->
<!-- ubah -->
<div class="modal fade" id="modal3show" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
{{ Form::open(array('route' => array('admins.'.$kelas.'.update',$kelas), 'method' => 'put')) }}
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title "><i class="fa fa-pencil"></i> Ubah Nama File</h4>
        </div>
        <div class="modal-body">
          <strong>Mengubah nama file ?</strong>
          <input type="text" name="id" value="" id="modal3id" hidden>
                {{ Form::text('name',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan informasi pengumuman baru'))}}
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
<!-- Hapus -->
<div class="modal fade" id="modal1show" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    {{ Form::model($datas, array('route' => array('admins.'.$kelas.'.destroy',$kelas), 'method' => 'delete')) }}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="fa fa-trash"></i> Hapus File</h4>
            </div>
            <div class="modal-body">
                <strong>Menghapus file ini ?</strong>
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
<!-- /.modal -->
@stop
