<?php
$kelas= "perkiraan";
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
            <div class="col-sm-3" style="padding: .2em ;">
                <div class="input-group">
                    <div class="input-group-addon">CU</div>
                    <select class="form-control" name="selectcu" id="selectcu" onchange="load_tp();">
                        <option hidden>Silahkan pilih CU</option>
                        @foreach($culists as $culist)
                            <option {{ !empty($kdcu) ? $culist->cu == $kdcu ? 'selected' : '' : '' }}
                             value="{{ $culist->cu }}">{{ $culist->cuprimer->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-sm-3" style="padding: .2em ;">
                <div class="input-group">
                    <div class="input-group-addon">Tp</div>
                    <select class="form-control" name="selecttp" id="selecttp" onchange="load_periode();" disabled>
                        <option hidden>Silahkan pilih TP</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-3" style="padding: .2em ;">
                <div class="input-group">
                    <div class="input-group-addon">Periode</div>
                    <select class="form-control" name="selectperiode" id="selectperiode" disabled>
                        <option hidden>Silahkan pilih Periode</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-3" style="padding: .2em ;">
                <button type="button" class="btn btn-default btn-block" onclick="load_perkiraan()"><i class="fa fa-search-plus"></i> Tampilkan Data Perkiraan</button>
            </div>
        </div>
    </div>
    <div class="nav-tabs-custom" id="div_table" style="display: none">
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
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--content-->
</section>

<div class="modal fade" id="modalperkiraan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   {{ Form::open(array('route' => array('admins.'.$kelas.'.save'),'data-toggle' => 'validator','role' => 'form')) }}
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-light-blue-active color-palette">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="modalperkiraan_judul"></h4>
        </div>
        <div class="modal-body">
          <input type="text" name="id_perkiraan" id="id_perkiraan" hidden>
          <input type="text" name="kdcu" value="{{!empty($kdcu) ? $kdcu : ''}}" hidden>
          <input type="text" name="kdtp" value="{{!empty($kdtp) ? $kdtp : ''}}" hidden>
          @include('admins.perkiraan._components.form')
          <hr/>
          <h4>Saran perbaikan:</h4>
          <div class="table-responsive">
              <table class="table">
                <thead class="bg-light-blue disabled color-palette">
                    <th>Nama Perkiraan</th>
                    <th>Induk</th>
                    <th>Kelompok</th>
                </thead>
                <tbody>
                    <tr>
                        <td>Kas</td>
                        <td>[102] Kas Induk</td>
                        <td>Aktiva</td>
                    </tr>    
                </tbody>
              </table>
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
    <script type="text/javascript" src="{{ URL::asset('plugins/dataTables/extension/RowGroup/js/dataTables.rowGroup.min.js') }}"></script>
     <script type="text/javascript" src="{{ URL::asset('plugins/dataTables/extension/RowGroup/js/dataTables.rowGroup.min.js') }}"></script>
     @include('admins.perkiraan._components.perkiraan_js')
@stop