<?php
$title = "Kelola TP CU";
$kelas = 'tpcu';
$imagepath = 'images_tpcu/';
?>

@extends('admins._layouts.layout')

@section('css')
    @include('admins._components.datatable_CSS')
@stop

@section('content')
    <!-- header -->
    <section class="content-header">
        <h1>
            <i class="fa fa-building"></i> {{ $title }}
            <small>Mengelola Data TP CU Primer</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ URL::to('admins')  }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-building"></i> {{ $title }}</li>
        </ol>
    </section>
    <!-- /header -->
    <!-- Main content -->
    <section class="content">
        <!-- Alert -->
    @include('admins._layouts.alert')
    <!-- /Alert -->
        <!-- content -->
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_tpcu" data-toggle="tab">TP CU</a></li>
            </ul>
            <div class="tab-content"> 
                <div class="tab-pane active" id="tab_tpcu">
                    @if(Auth::user()->getCU() == '0')
                        <div class="col-sm-8" style="padding: .2em ;">
                    @else
                        <div class="col-sm-12" style="padding: .2em ;">
                    @endif
                        <div class="input-group tabletools">
                            <div class="input-group-addon"><i class="fa fa-search"></i></div>
                            <input type="text" id="searchtext" class="form-control" placeholder="Kata kunci pencarian...">
                        </div>
                    </div>
                    @if(Auth::user()->getCU() == '0')
                    <div class="col-sm-4" style="padding: .2em ;">
                        <?php 
                            $culists = App\Cuprimer::orderBy('name','asc')->get();
                            $culists_non = App\Cuprimer::onlyTrashed()->orderBy('name','asc')->get();
                        ?>
                        <div class="input-group tabletools">
                            <div class="input-group-addon primary-color"><i class="fa fa-building"></i> TP CU</div>
                            <select class="form-control" id="dynamic_select">
                                <option {{ Request::is('admins/tpcu') ? 'selected' : '' }}
                                        value="/admins/tpcu">SEMUA CU</option>
                                <option disabled>-------CU Aktif-------</option>        
                                @foreach($culists as $culist)
                                    <option {{ Request::is('admins/tpcu/index_cu/'.$culist->no_ba) ? 'selected' : '' }}
                                            value="/admins/tpcu/index_cu/{{$culist->no_ba}}">{{ $culist->name }}</option>
                                @endforeach
                                <option disabled>-------CU Non-Aktif-------</option>        
                                @foreach($culists_non as $culist)
                                    <option {{ Request::is('admins/tpcu/index_cu/'.$culist->no_ba) ? 'selected' : '' }}
                                            value="/admins/tpcu/index_cu/{{$culist->no_ba}}">{{ $culist->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @endif
                    <table class="table table-hover order-column" id="dataTables-example" width="100%">
                        <thead class="bg-light-blue-active color-palette">
                        <tr>
                            <th data-sortable="false">#</th>
                            <th hidden></th>
                            <th data-sortable="false">Foto</th>
                            @if(Request::is('admins/tpcu'))<th>Nama Credit Union</th>@endif
                            <th>Nama @if(Request::is('admins/tpcu')) TP @endif</th>
                            <th>No. TP</th>
                            <th>Tanggal Berdiri</th>
                            <th>Telepon</th>
                            <th>Handphone</th>
                            <th>Kode Pos</th>
                            <th>Alamat</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($datas as $data)
                            <?php $date = new Date($data->ultah); ?>
                            <tr>
                                <td class="bg-aqua disabled color-palette"></td>
                                <td hidden>{{ $data->id }}</td>
                                 @if(!empty($data->gambar) && is_file($imagepath.$data->gambar."n.jpg"))
                                    <th><img class="img-responsive"  width="50px" src="{{ asset($imagepath.$data->gambar.'n.jpg') }}"
                                             id="tampilgambar" alt="{{ asset($imagepath.$data->gambar."jpg") }}"></th>
                                @elseif(!empty($data->gambar) && is_file($imagepath.$data->gambar))
                                    <th><img class="img-responsive" width="50px" src="{{ asset($imagepath.$data->gambar) }}"
                                             id="tampilgambar" alt="{{ asset($imagepath.$data->gambar) }}"></th>
                                @else
                                    <th><img class="img-responsive" width="50px" src="{{ asset('images/image-cu.jpg') }}"
                                         id="tampilgambar" alt="cu profile"></th>
                                @endif  
                                @if(Request::is('admins/tpcu'))<td>@if(!empty($data->cuprimer)){{ $data->cuprimer->name }}@endif</td>@endif
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->no_tp }}</td>
                                <td><i hidden="true">{{ $data->ultah }}</i>  {{ $date->format('d/m/Y') }}</td>
                                <td>{{ $data->telp }}</td>
                                <td>{{ $data->hp }}</td>
                                <td>{{ $data->pos }}</td>
                                <td>{{ $data->alamat }}</td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- content -->
    </section>
@stop

@section('js')
    @include('admins._components.datatable_JS')
    <script type="text/javascript" src="{{ URL::asset('admin/datatable.js') }}"></script>
    <script>
        $(function(){
            // bind change event to select
            $('#dynamic_select').on('change', function () {
                var url = $(this).val(); // get selected value
                if (url) { // require a URL
                    window.location.href = url; // redirect
                }
                return false;
            });
        });

        new $.fn.dataTable.Buttons(table,{
            buttons: [
                @permission('create.'.$kelas.'_create')
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
                @endpermission
                @permission('update.'.$kelas.'_update')
                {
                    text: '<i class="fa fa-pencil"></i> <u>U</u>bah',
                    key: {
                        altKey: true,
                        key: 'u'
                    },
                    action: function(){
                        var id = $.map(table.rows({ selected: true }).data(),function(item){
                            return item[1];
                        });
                        var kelas = "{{ $kelas }}";
                        if(id != ""){
                            window.location.href =  "/admins/" + kelas + "/" + id + "/edit";
                        }else{
                            $('#modalwarning').modal({show:true});
                        }
                    }
                },
                @endpermission
                @permission('destroy.'.$kelas.'_destroy')
                {
                    text: '<i class="fa fa-trash"></i> <u>H</u>apus',
                    key: {
                        altKey: true,
                        key: 'h'
                    },
                    action: function(){
                        var id = $.map(table.rows({ selected:true }).data(),function(item){
                            return item[1];
                        });
                        if(id != ""){
                            $('#modalhapus').modal({show:true});
                            $('#modalhapus_judul').text('Hapus TP CU');
                            $('#modalhapus_detail').text('Hapus TP CU');
                            $('#modalhapus_id').attr('value',id);
                        }else{
                            $('#modalwarning').modal({show:true});
                        }
                    }
                }
                @endpermission
            ]
        });
        table.buttons( 0, null ).container().prependTo(
                table.table().container()
        );
    </script>
@stop