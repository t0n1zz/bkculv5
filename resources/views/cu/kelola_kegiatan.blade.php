<?php
$title="Kelola Staf";
$imagepath = "images_staf/";
?>
@extends('_layouts.layout')

@section('css')
        <!-- DataTables CSS -->
{{ HTML::style('plugins/dataTables/bootstrap/dataTables.bootstrap.css') }}
{{ HTML::style('plugins/dataTables/extension/Responsive/css/dataTables.responsive.css') }}
@stop

@section('content')
        <!-- Page Title -->
<div class="page-banner" style="padding:40px 0; background: url(images/slide-02-bg.jpg) center #f9f9f9;">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2>DIKLAT</h2>
                <p>Anda dapat mendaftarkan staf anda pada DIKLAT yang kami sediakan</p>
            </div>
            <div class="col-md-6">
                <ul class="breadcrumbs">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>CU</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div id="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @include('cu.alert')
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                            <tr>
                                <th></th>
                                <th data-priority="1">Nama </th>
                                <th>Wilayah</th>
                                <th>Tempat</th>
                                <th>Sasaran</th>
                                <th>Tanggal Dimulai</th>
                                <th>Tanggal Selesai</th>
                                <th data-priority="2">Daftar</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($datas as $data)
                                <tr>
                                    <td></td>
                                    @if(!empty($data->name))
                                        <td><b>{{ $data->name }}</b></td>
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
                                        <td>{{ $data->sasaran }}</td>
                                    @else
                                        <td>-</td>
                                    @endif

                                    @if(!empty($data->tanggal))
                                        <?php $date = new Date($data->tanggal); ?>
                                        <td><i hidden="true">{{$data->tanggal}}</i> {{  $date->format('d/n/Y') }}</td>
                                    @else
                                        <td>-</td>
                                    @endif

                                    @if(!empty($data->tanggal2))
                                        <?php $date2 = new Date($data->tanggal2); ?>
                                        <td><i hidden="true">{{$data->tanggal2}}</i> {{ $date2->format('d/n/Y') }}</td>
                                    @else
                                        <td>-</td>
                                    @endif

                                    @if($data->status == "0")
                                        <td><a href="#" class="btn btn-default" disabled>
                                                <i hidden="true">tidak</i><i class="fa fa-ban"></i></a></td>
                                    @else
                                        <td><a href="{{ route('cu.daftar_kegiatan',array($data->id)) }}" class="btn btn-warning">
                                                <i hidden="true">iya</i><i class="fa fa-plus"></i></a></td>
                                    @endif
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Hapus -->
<div class="modal fade" id="modal1show" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    {{ Form::model($datas, array('route' => array('cu.destroy_staf'), 'method' => 'delete')) }}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="fa fa-trash"></i> Hapus Staf</h4>
            </div>
            <div class="modal-body">
                <strong style="font-size: 16px">Menghapus staf ini?</strong>
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
@stop

@section('javascript')
        <!-- DataTables JavaScript -->
{{ HTML::script('plugins/dataTables/jquery.dataTables.js') }}
{{ HTML::script('plugins/dataTables/bootstrap/dataTables.bootstrap.js') }}
{{ HTML::script('plugins/dataTables/extension/Responsive/js/dataTables.responsive.js') }}
<script>
    $(document).ready(function() {
        var table = $('#dataTables-example').dataTable({
            responsive: {
                details: {
                    type: 'column'
                }
            },
            columnDefs: [ {
                className: 'control',
                orderable: false,
                targets:   0
            } ],
            pagingType : "full_numbers",
            autoWidth: false,
            stateSave : true,
            order : [[ 0, "asc" ]]
        });

        $('.modal1').on('click',function(){
            $('#modal1show').modal({
                show: true,
            })

            var myvalue = this.name;
            var myvalue2 = this.title;
            $('#modal1id').attr('value',myvalue);
            $('#modal1id2').attr('value',myvalue2);
        });
    });
</script>
@stop