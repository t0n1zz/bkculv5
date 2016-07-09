<?php
$title = "Kelola Data Litbang";
$kelas ='litbang';
?>

@extends('admins._layouts.layout')

@section('content')
<!-- header -->
<section class="content-header">
    <h1>
        <i class="fa fa-archive"></i> {{ $title }}
        <small>Mengelola Data Artikel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('admins') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><i class="fa fa-book"></i> {{ $title }}</li>
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
                <a type="button" accesskey="t" class="btn btn-primary"
                   href="{{ route('admins.'.$kelas.'.create') }}"><i class="fa fa-fw fa-plus"></i> <u>T</u>ambah Data Litbang</a>
            </div>
        </div>
        <div class="box-body">
            <table class="table table-striped table-hover" id="dataTables-example">
                <thead>
                <tr>
                    <th rowspan="3"></th>
                    <th rowspan="3">No. BA</th>
                    <th data-priority="1" rowspan="3">Nama Credit Union</th>
                    <th colspan="5">Jumlah Anggota</th>
                    <th>Kekayaan</th>
                    <th>Aktiva</th>
                    <th>Simpanan Saham</th>
                    <th colspan="2">Non Saham</th>
                    <th rowspan="2">Hutang SPD</th>
                    <th>Piutang</th>
                    <th colspan="2">Piutang Lalai</th>
                    <th colspan="2">Dana Cadangan</th>
                    <th>Total</th>
                    <th>Total</th>
                    <th rowspan="3">SHU</th>
                    <th rowspan="3">Data Per</th>
                    <th data-priority="3">Ubah</th>
                    <th data-priority="2">Hapus</th>
                </tr>
                <tr>
                    <th colspan="2">L</th>
                    <th colspan="2">P</th>
                    <th rowspan="2">Total</th>
                    <th rowspan="2">(ASET)</th>
                    <th rowspan="2">LANCAR</th>
                    <th rowspan="2">(SP+SW)</th>
                    <th rowspan="2">Unggulan</th>
                    <th rowspan="2">Harian & Deposito</th>
                    <th rowspan="2">Beredar</th>
                    <th rowspan="2">1-12 Bulan</th>
                    <th rowspan="2">>12 Bulan</th>
                    <th rowspan="2">DCR</th>
                    <th rowspan="2">DCU</th>
                    <th rowspan="2">Pendapatan</th>
                    <th rowspan="2">Biaya</th>
                </tr>
                <tr>
                    <th>Biasa</th>
                    <th>L.Biasa</th>
                    <th>Biasa</th>
                    <th>L.Biasa</th>
                </tr>
                </thead>
                <tbody>
                @foreach($datas as $data)
                    <tr>
                        <td></td>
                        @if(!empty($data->judul))
                            <td>{{ $data->judul }}</td>
                        @else
                            <td>-</td>
                        @endif


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
</section>

<!-- modal -->
<!-- Hapus -->
<div class="modal fade" id="modal1show" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   {{ Form::model($datas, array('route' => array('admins.'.$kelas.'.destroy',$kelas), 'method' => 'delete')) }}
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title"><i class="fa fa-trash"></i> Hapus Data Litbang</h4>
        </div>
        <div class="modal-body">
          <strong>Menghapus data litbang ini ?</strong>
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
