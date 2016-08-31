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
            <i class="fa fa-archive"></i> {{ $title }}
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
        <div class="box box-primary">
            <div class="box-header with-border">
                <?php
                $culists = App\Models\Cuprimer::orderBy('name','asc')->get();
                ?>
                <div class="input-group">
                    <div class="input-group-addon primary-color"><i class="fa fa-list"></i></div>
                    <select class="form-control" id="dynamic_select">
                        <option {{ Request::is('admins/tpcu') ? 'selected' : '' }}
                                value="/admins/tpcu">SEMUA CU</option>
                        @foreach($culists as $culist)
                            <option {{ Request::is('admins/tpcu/index_cu/'.$culist->id) ? 'selected' : '' }}
                                    value="/admins/tpcu/index_cu/{{$culist->id}}">{{ $culist->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped table-hover order-column" id="dataTables-example">
                    <thead>
                    <tr>
                        <th hidden></th>
                        @if(Request::is('admins/tpcu'))<th>No. BA</th>@endif
                        @if(Request::is('admins/tpcu'))<th>Nama Credit Union</th>@endif
                        <th>No. TP</th>
                        <th>Nama </th>
                        <th>Tanggal Berdiri</th>
                        <th>Anggota <br/> Lelaki Biasa</th>
                        <th>Anggota <br/> Lelaki L.Biasa</th>
                        <th>Anggota <br/> Perempuan Biasa</th>
                        <th>Anggota <br/> Perempuan L.Biasa</th>
                        <th>Anggota <br/> Total</th>
                        <th>Staf Perempuan</th>
                        <th>Staf Lelaki</th>
                        <th>Alamat</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($datas as $data)
                        <tr>
                            <td hidden>{{ $data->id }}</td>

                            @if(Request::is('admins/tpcu'))
                                @if(!empty($data->cuprimer))<td>{{ $data->cuprimer->no_ba }}</td>@else<td>-</td>@endif
                            @endif

                            @if(Request::is('admins/tpcu'))
                                @if(!empty($data->cuprimer))<td>{{ $data->cuprimer->name }}</td>@else<td>-</td>@endif
                            @endif

                            @if(!empty($data->no_tp))
                                <td>{{ $data->no_tp }}</td>
                            @else
                                <td>-</td>
                            @endif

                            @if(!empty($data->name))
                                <td>{{ $data->name }}</td>
                            @else
                                <td>-</td>
                            @endif

                            @if(!empty($data->ultah))
                                <?php $date = new Date($data->ultah); ?>
                                <td><i hidden="true">{{ $data->ultah }}</i>  {{ $date->format('d/m/Y') }}</td>
                            @else
                                <td>-</td>
                            @endif

                            @if(!empty($data->l_biasa))
                                <?php $l_biasa = number_format($data->l_biasa,"0",",","."); ?>
                                <td>{{ $l_biasa }}</td>
                            @else<td>-</td>@endif

                            @if(!empty($data->l_lbiasa))
                                <?php $l_lbiasa = number_format($data->l_lbiasa,"0",",","."); ?>
                                <td>{{ $l_lbiasa }}</td>
                            @else<td>-</td>@endif

                            @if(!empty($data->p_biasa))
                                <?php $p_biasa = number_format($data->p_biasa,"0",",","."); ?>
                                <td>{{ $p_biasa }}</td>
                            @else<td>-</td>@endif

                            @if(!empty($data->p_lbiasa))
                                <?php $p_lbiasa = number_format($data->p_lbiasa,"0",",","."); ?>
                                <td>{{ $p_lbiasa }}</td>
                            @else<td>-</td>@endif

                            @if(!empty($data->l_biasa) || !empty($data->l_lbiasa) || !empty($data->p_biasa) ||!empty($data->p_lbiasa))
                                <?php
                                $total = $data->l_biasa + $data->l_lbiasa + $data->p_biasa + $data->p_lbiasa;
                                $total_num = number_format($total,"0",",",".");
                                ?>
                                <td>{{ $total_num }}</td>
                            @else
                                <td>-</td>
                            @endif

                            @if(!empty($data->l_staf))
                                <?php $l_staf = number_format($data->l_staf,"0",",","."); ?>
                                <td>{{ $l_staf }}</td>
                            @else<td>-</td>@endif
                            @if(!empty($data->p_staf))
                                <?php $p_staf = number_format($data->p_staf,"0",",","."); ?>
                                <td>{{ $p_staf }}</td>
                            @else<td>-</td>@endif

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
        <!-- content -->
    </section>

    <!-- modal -->
    <!-- Hapus -->
    <div class="modal fade" id="modal1show" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        {{ Form::model($datas, array('route' => array('admins.'.$kelas.'.destroy',$kelas), 'method' => 'delete')) }}
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-trash"></i> Hapus TP</h4>
                </div>
                <div class="modal-body">
                    <h4>Menghapus TP ini?</h4>
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
                        if(id != ""){
                            $('#modal1show').modal({show:true});
                            $('#modal1id').attr('value',id);
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