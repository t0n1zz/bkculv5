<?php
$title = "Kelola Perkembangan CU";
$kelas ='perkembangancu';
?>

@extends('admins._layouts.layout')

@section('content')
<!-- header -->
<section class="content-header">
    <h1>
        <i class="fa fa-archive"></i> {{ $title }}
        <small>Mengelola Data Perkembangan CU</small>
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
            <div class="form-group" id="datatablesButton">
                <a type="button" accesskey="t" class="btn btn-primary"
                   href="{{ route('admins.'.$kelas.'.create') }}"><i class="fa fa-fw fa-plus"></i> <u>T</u>ambah Perkembangan CU</a>
                <button class="btn btn-primary modalexcel" name="importExcel"><i class="fa fa-upload"></i> Import Excel</button>
            </div>
        </div>
        <div class="box-body">
            <table class="table table-striped table-hover" id="dataTables-example">
                <thead>
                <tr class="tableheader">
                    <th>No. BA</th>
                    <th data-priority="1">Nama Credit Union</th>
                    <th>Anggota <br/> Lelaki Biasa</th>
                    <th>Anggota <br/> Lelaki L.Biasa</th>
                    <th>Anggota <br/> Perempuan Biasa</th>
                    <th>Anggota <br/> Perempuan L.Biasa</th>
                    <th>Anggota <br/> Total</th>
                    <th>Kekayaan <br/> (ASET)</th>
                    <th>Aktiva <br/> LANCAR</th>
                    <th>Simpanan Saham <br/> (SP+SW)</th>
                    <th>Non Saham <br/> Unggulan</th>
                    <th>Non Saham <br/> Harian & Deposito</th>
                    <th>Hutang SPD</th>
                    <th>Piutang Beredar</th>
                    <th>Piutang Lalai <br/> 1-12 Bulan</th>
                    <th>Piutang Lalai <br/> > 12 Bulan</th>
                    <th>Dana Cadangan <br/> DCR</th>
                    <th>Dana Cadangan <br/> DCU</th>
                    <th>Total <br/> Pendapatan </th>
                    <th>Total <br/> Biaya</th>
                    <th>SHU</th>
                    <th>Data Per</th>
                    <th>Ubah</th>
                    <th>Hapus</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($datas as $data)
                    <tr>
                        @if(!empty($data->cuprimer))<td>{{ $data->cuprimer->no_ba }}</td>@else<td>-</td>@endif
                        @if(!empty($data->cuprimer))<td>{{ $data->cuprimer->name }}</td>@else<td>-</td>@endif
                        @if(!empty($data->l_biasa))<td>{{ $data->l_biasa }}</td>@else<td>-</td>@endif
                        @if(!empty($data->l_lbiasa))<td>{{ $data->l_lbiasa }}</td>@else<td>-</td>@endif
                        @if(!empty($data->p_biasa))<td>{{ $data->p_biasa }}</td>@else<td>-</td>@endif
                        @if(!empty($data->p_lbiasa))<td>{{ $data->p_lbiasa }}</td>@else<td>-</td>@endif
                        @if(!empty($data->l_biasa) || !empty($data->l_lbiasa) || !empty($data->p_biasa) ||!empty($data->p_lbiasa))
                            <?php $total = $data->l_biasa + $data->l_lbiasa + $data->p_biasa + $data->p_lbiasa  ?>
                            <td>{{ $total }}</td>
                        @else
                            <td>-</td>
                        @endif
                        @if(!empty($data->kekayaan))<td>{{ $data->kekayaan }}</td>@else<td>-</td>@endif
                        @if(!empty($data->aktivalancar))<td>{{ $data->aktivalancar }}</td>@else<td>-</td>@endif
                        @if(!empty($data->simpanansaham))<td>{{ $data->simpanansaham }}</td>@else<td>-</td>@endif
                        @if(!empty($data->nonsaham_unggulan))<td>{{ $data->nonsaham_unggulan }}</td>@else<td>-</td>@endif
                        @if(!empty($data->nonsaham_harian))<td>{{ $data->nonsaham_harian }}</td>@else<td>-</td>@endif
                        @if(!empty($data->hutangspd))<td>{{ $data->hutangspd }}</td>@else<td>-</td>@endif
                        @if(!empty($data->piutangberedar))<td>{{ $data->piutangberedar }}</td>@else<td>-</td>@endif
                        @if(!empty($data->piutanglalai_1bulan))<td>{{ $data->piutanglalai_1bulan }}</td>@else<td>-</td>@endif
                        @if(!empty($data->piutanglalai_12bulan))<td>{{ $data->piutanglalai_12bulan }}</td>@else<td>-</td>@endif
                        @if(!empty($data->danacadangan_dcr))<td>{{ $data->danacadangan_dcr }}</td>@else<td>-</td>@endif
                        @if(!empty($data->danacadangan_dcu))<td>{{ $data->danacadangan_dcu }}</td>@else<td>-</td>@endif
                        @if(!empty($data->totalpendapatan))<td>{{ $data->totalpendapatan }}</td>@else<td>-</td>@endif
                        @if(!empty($data->totalbiaya))<td>{{ $data->totalbiaya }}</td>@else<td>-</td>@endif
                        @if(!empty($data->shu))<td>{{ $data->shu }}</td>@else<td>-</td>@endif
                        @if(!empty($data->dataper))
                            <?php $date = new Date($data->dataper); ?>
                            <td><i hidden="true">{!! $data->dataper !!}</i>  {!! $date->format('d/m/Y') !!}</td>
                        @else
                            <td>-</td>
                        @endif

                        <td><a class="btn btn-primary" href="{{route('admins.'.$kelas.'.edit', array($data->id))}}">
                                <i class="fa fa-pencil"></i></a></td>

                        <td><button class="btn btn-danger modal1" name="{{ $data->id }}">
                                <i class="fa fa-trash"></i></button></td>
                        <td></td>        
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
          <h4 class="modal-title"><i class="fa fa-trash"></i> Hapus Data Perkembangan CU</h4>
        </div>
        <div class="modal-body">
          <strong>Menghapus data perkembangan CU ini ?</strong>
          <input type="text" name="id" value="" id="modal1id" hidden>
        </div>
        <div class="modal-footer">j
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
