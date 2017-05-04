<?php
$title = "Tempat";
$kelas ='tempat';
$imagepath = 'images_tempat/';
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
        <i class="fa fa-map-marker"></i> {{ $title }}
        <small>Mengelola Data {{ $title }}</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('admins') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><i class="fa fa-map-marker"></i> {{ $title }}</li>
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
            <li class="active"><a href="#tab_tempat" data-toggle="tab">Tempat</a></li>
        </ul>
        <div class="tab-content"> 
            <div class="tab-pane fade in active" id="tab_tempat">
                <div class="input-group tabletools">
                    <div class="input-group-addon"><i class="fa fa-search"></i></div>
                    <input type="text" id="searchtext" class="form-control" placeholder="Kata kunci pencarian...">
                </div>

                <table class="table table-hover dt-responsive" id="dataTables-example" width="100%">
                    <thead class="bg-light-blue-active color-palette">
                    <tr>
                        <th hidden></th>
                        <th data-sortable="false">Foto</th>
                        <th class="sort" data-priority="1">Name</th>
                        <th>Kota</th>
                        <th>Keterangan</th>
                        <th>&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($datas as $data)
                        <tr>
                            <td hidden>{{ $data->id }}</td>
                            @if(!empty($data->gambar) && is_file($imagepath.$data->gambar."n.jpg"))
                                <td style="white-space: nowrap"><div class="modalphotos" >
                                        {{ Html::image(($imagepath.$data->gambar).'n.jpg',asset(($imagepath.$data->gambar)."jpg"),
                                            array('class' => 'img-responsive ',
                                            'id' => 'tampilgambar', 'width' => '50')) }}
                                    </div></td>
                            @else
                                <td>{{ Html::image('images/no_image.jpg', 'a picture', array('class' => 'img-responsive',
                                                'id' => 'tampilgambar', 'width' => '50')) }}</td>
                            @endif
                            <td class="warptext">{{ $data->name }}</td>    
                            <td>{{ $data->kota }}</td>
                            <td class="warptext">{{ $data->keterangan }}</td>
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
@stop

@section('js')
    @include('admins._components.datatable_JS')
    <script type="text/javascript" src="{{ URL::asset('plugins/dataTables/extension/Responsive/js/dataTables.responsive.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('plugins/dataTables/extension/Responsive/js/responsive.bootstrap.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('a[data-toggle="tab"]').on( 'shown.bs.tab', function (e) {
                $.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust();
            } );
        });
    </script>
    <script type="text/javascript" src="{{ URL::asset('admin/datatable_responsive.js') }}"></script>
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
                        }else{
                            $('#modalwarning').modal({show:true});
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
                        var judul = $.map(table.rows({ selected:true }).data(),function(item){
                            return item[1];
                        });
                        if(id != ""){
                            $('#modalhapus').modal({show:true});
                                $('#modalhapus_id').attr('value',id);
                                $('#modalhapus_judul').text('Hapus Artikel');
                                $('#modalhapus_detail').text('Yakin menghapus artikel "' + judul + '" ?');
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
    </script>
@stop