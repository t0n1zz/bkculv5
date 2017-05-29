<?php
$title = "Error Log";
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
        <i class="fa fa-exclamation-triangle"></i> {{ $title }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('admins') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><i class="fa fa-exclamation-triangle"></i> {{ $title }}</li>
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
            <li class="active"><a href="#tab_saran" data-toggle="tab">Error Log</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade in active" id="tab_saran">
                <div class="input-group tabletools">
                    <div class="input-group-addon"><i class="fa fa-search"></i></div>
                    <input type="text" id="searchtext" class="form-control" placeholder="Kata kunci pencarian...">
                </div>
                <table class="table table-hover dt-responsive" id="dataTables-example" width="100%">
                    <thead class="bg-light-blue-active color-palette">
                    <tr>
                        <th>Level </th>
                        <th>Context</th>
                        <th>Date</th>
                        <th>Content</th>
                        <th class="never"></th>
                        <th class="never"></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($logs as $key => $data)
                        <?php $date = new Date($data['date']); ?>
                        <tr>
                            <td class="text-{{ $data['level_class'] }}"><span class="fa fa-{{ $data['level_img'] }}" aria-hidden="true"></span> &nbsp;{{$data['level']}}</td>
                            <td>{{{ $data['context'] }}}</td>
                            <td data-order="{{$data['date']}}">{{  $date->format('d F Y | H:i:s') }}</td>
                            <td class="warptext">{{ $data['text'] }}</td>
                            <td class="never">{{ $data['in_file'] }}</td>
                            <td class="never">{{ $data['stack'] }}</td>
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
<div class="modal fade" id="modaldetail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-light-blue-active color-palette">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title "><i class="fa fa-database"></i> Detail Error</h4>
        </div>
        <div class="modal-body">
          <h4 id="content"></h4>
          <p id="in_file"></p>
          <pre class="pre-scrollable" id="stack">
          </pre>
          <p id="date"></p>
        </div>
        <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<div class="modal fade" id="modalhapuslog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
{{ Form::open(array('route' => array('admins.errorlog.destroy'))) }}
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-red-active color-palette">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title "><i class="fa fa-trash"></i> Hapus Log</h4>
        </div>
        <div class="modal-body">
            <h4>Hapus Log?</h4>
        </div>
        <div class="modal-footer">

            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
{{ Form::close() }}    
</div>
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
                    text: '<i class="fa fa-database"></i> Detail',
                    action: function(){
                        var id = $.map(table.rows({ selected: true }).data(),function(item){
                            return item[0];
                        });
                        var date = $.map(table.rows({ selected:true }).data(),function(item){
                            return item[2].display;
                        });
                        var content = $.map(table.rows({ selected: true }).data(),function(item){
                            return item[3];
                        });
                        var in_file = $.map(table.rows({ selected:true }).data(),function(item){
                            return item[4];
                        });
                        var stack = $.map(table.rows({ selected:true }).data(),function(item){
                            return item[5];
                        });
                        if(id != ""){
                            $('#modaldetail').modal({show:true});
                            $('#date').text(date);
                            $('#content').text(content);
                            $('#in_file').text(in_file);
                            $('#stack').text(stack);
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
            new $.fn.dataTable.Buttons(table,{
            buttons: [
                {
                    text: '<i class="fa fa-download"></i> Download Log',
                    action: function(){
                        window.location.href = "{{URL::to('admins/errorlog/download')}}";
                    }
                },
                {
                    text: '<i class="fa fa-trash"></i> Hapus Log',
                    action: function(){
                        $('#modalhapuslog').modal({show:true});
                    }
                }
            ]
        });
        table.buttons( 0, null ).container().prependTo(
                table.table().container()
        );
    </script>
@stop