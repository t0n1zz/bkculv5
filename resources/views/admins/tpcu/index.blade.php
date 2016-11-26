<?php
$title = "Kelola TP CU";
$kelas = 'tpcu';
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
                <div class="tab-pane fade in active" id="tab_tpcu">
                    <div class="col-sm-9" style="padding: .2em ;">
                        <div class="input-group tabletools">
                            <div class="input-group-addon"><i class="fa fa-search"></i></div>
                            <input type="text" id="searchtext" class="form-control" placeholder="Kata kunci pencarian..." autofocus>
                        </div>
                    </div>
                    <div class="col-sm-3" style="padding: .2em ;">
                        <?php $culists = App\Models\Cuprimer::orderBy('name','asc')->get(); ?>
                        <div class="input-group tabletools">
                            <div class="input-group-addon primary-color"><i class="fa fa-building"></i> TP CU</div>
                            <select class="form-control" id="dynamic_select">
                                <option {{ Request::is('admins/tpcu') ? 'selected' : '' }}
                                        value="/admins/tpcu">SEMUA CU</option>
                                <option disabled>--------------</option>         
                                @foreach($culists as $culist)
                                    <option {{ Request::is('admins/tpcu/index_cu/'.$culist->id) ? 'selected' : '' }}
                                            value="/admins/tpcu/index_cu/{{$culist->id}}">{{ $culist->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <table class="table table-hover order-column" id="dataTables-example" width="100%">
                        <thead class="bg-light-blue-active color-palette">
                        <tr>
                            <th>#</th>
                            <th hidden></th>
                            @if(Request::is('admins/tpcu'))<th>Nama Credit Union</th>@endif
                            @if(Request::is('admins/tpcu'))<th>No. BA</th>@endif
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
                            <tr>
                                <td class="bg-aqua disabled color-palette"></td>
                                <td hidden>{{ $data->id }}</td>

                                @if(Request::is('admins/tpcu'))
                                    @if(!empty($data->cuprimer))<td>{{ $data->cuprimer->name }}</td>@else<td>-</td>@endif
                                @endif

                                @if(Request::is('admins/tpcu'))
                                    @if(!empty($data->cuprimer))<td>{{ $data->cuprimer->no_ba }}</td>@else<td>-</td>@endif
                                @endif

                                @if(!empty($data->name))
                                    <td>{{ $data->name }}</td>
                                @else
                                    <td>-</td>
                                @endif

                                @if(!empty($data->no_tp))
                                    <td>{{ $data->no_tp }}</td>
                                @else
                                    <td>-</td>
                                @endif

                                @if(!empty($data->ultah))
                                    <?php $date = new Date($data->ultah); ?>
                                    <td><i hidden="true">{{ $data->ultah }}</i>  {{ $date->format('d/m/Y') }}</td>
                                @else
                                    <td>-</td>
                                @endif

                                @if(!empty($data->telp))
                                    <td>{{ $data->telp }}</td>
                                @else
                                    <td>-</td>
                                @endif

                                @if(!empty($data->hp))
                                    <td>{{ $data->hp }}</td>
                                @else
                                    <td>-</td>
                                @endif

                                @if(!empty($data->pos))
                                    <td>{{ $data->pos }}</td>
                                @else
                                    <td>-</td>
                                @endif

                                @if(!empty($data->alamat))
                                    <td>{{ $data->alamat }}</td>
                                @else
                                    <td>-</td>
                                @endif

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
                            window.location.href =  kelas + "/" + id + "/edit";
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
                            $('#hapus-id').attr('value',id);
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