<?php
$title = "Kelola Kegiatan";
$kelas = "kegiatan";
?>
@extends('admins._layouts.layout')

@section('content')
<!-- header -->
<section class="content-header">
    <h1>
        <i class="fa fa-archive"></i> {!! $title !!}
        <small>Mengelola Data Kegiatan</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{!! URL::to('admins') !!}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><i class="fa fa-calendar"></i> {!! $title !!}</li>
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
                   class="btn btn-primary" href="{{ route('admins.'.$kelas.'.create') }}">
                    <i class="fa fa-plus"></i> <u>T</u>ambah Kegiatan</a>
            </div>
        </div>
        <div class="box-body">
            <table class="table table-striped table-bordered table-hover" id="dataTables-example" width="100%">
                <thead>
                <tr>
                    <th data-priority="1">Nama </th>
                    <th>Wilayah</th>
                    <th>Tempat</th>
                    <th>Sasaran</th>
                    <th>Tanggal Dimulai</th>
                    <th>Tanggal Selesai</th>
                    <th data-priority="5">Status</th>
                    <th data-priority="4">Data</th>
                    <th data-priority="3">Ubah</th>
                    <th data-priority="2">Hapus</th>
                </tr>
                </thead>
                <tbody>
                @foreach($datas as $data)
                    <tr>
                        @if(!empty($data->name))
                            <td>{!! $data->name !!}</td>
                        @else
                            <td>-</td>
                        @endif

                        @if(!empty($data->wilayah))
                            <td>{!! $data->wilayah !!}</td>
                        @else
                            <td>-</td>
                        @endif

                        @if(!empty($data->tempat))
                            <td>{!! $data->tempat !!}</td>
                        @else
                            <td>-</td>
                        @endif

                        @if(!empty($data->sasaran))
                            <td>{!! $data->sasaran !!}</td>
                        @else
                            <td>-</td>
                        @endif

                        @if(!empty($data->tanggal))
                            <?php $date = new Date($data->tanggal); ?>
                            <td><i hidden="true">{!! $data->tanggal !!}</i> {!!  $date->format('d/n/Y') !!}</td>
                        @else
                            <td>-</td>
                        @endif

                        @if(!empty($data->tanggal2))
                            <?php $date2 = new Date($data->tanggal2); ?>
                            <td><i hidden="true">{!! $data->tanggal2 !!}</i> {!! $date2->format('d/n/Y') !!}</td>
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

                        <td><a class="btn btn-info" href="{{route('admins.'.$kelas.'.edit', array($data->id))}}">
                                <i class="fa fa-database"></i></a></td>

                        <td><a class="btn btn-primary" href="{{route('admins.'.$kelas.'.edit', array($data->id))}}">
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
<!-- Hapus -->
<div class="modal fade" id="modal2show" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   {{ Form::open(array('route' => array('admins.' .$kelas. '.destroy',$kelas), 'method' => 'delete')) }}
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Hapus Kegiatan</h4>
        </div>
        <div class="modal-body">
          <strong style="font-size: 16px">Menghapus kegiatan ini?</strong>
          <input type="text" name="id" value="" id="modal2id" hidden>
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