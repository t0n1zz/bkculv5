<?php
$title = "Kelola Staf";

if(!empty($datas->first()->cuprimer))
    $title2 ="CU " . $datas->first()->cuprimer->name;
else
    $title2 ="Puskopdit BKCU Kalimantan";


$kelas = "staf";
$imagepath = "images_staf/";
?>
@extends('admins._layouts.layout')

@section('css')
    @include('admins._components.datatable_CSS')
@stop

@section('content')
    <!-- header -->
    <section class="content-header">
        <h1>
            <i class="fa fa-sitemap"></i> {{ $title }}
            <small>Mengelola Data Staf {!! $title2 !!}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ URL::to('admins') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-sitemap"></i> {!! $title !!}</li>
        </ol>
    </section>
    <!-- /header -->
    <!-- /header -->
    <section class="content">
        <!-- Alert -->
    @include('admins._layouts.alert')
    <!-- /Alert -->
        <!--content-->
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_staf" data-toggle="tab">Staf</a></li>
            </ul>
            <div class="tab-content"> 
                <div class="tab-pane active" id="tab_staf">
                    @if(Auth::user()->getCU() == '0')
                        <div class="col-sm-8" style="padding: .2em ;">
                    @else
                        <div class="col-sm-12" style="padding: .2em ;">
                    @endif
                        <div class="input-group tabletools">
                            <div class="input-group-addon"><i class="fa fa-search"></i></div>
                            <input type="text" id="searchtext" class="form-control" placeholder="Kata kunci pencarian..." autofocus>
                        </div>
                    </div>
                    @if(Auth::user()->getCU() == '0')
                        <div class="col-sm-4" style="padding: .2em ;">
                            <?php 
                                $culists = App\Models\Cuprimer::orderBy('name','asc')->where('status','=','1')->get();
                                $culists_non = App\Models\Cuprimer::orderBy('name','asc')->where('status','=','0')->get();
                            ?>
                            <div class="input-group tabletools">
                                <div class="input-group-addon primary-color"><i class="fa fa-users"></i> Staf CU</div>
                                <select class="form-control"  id="dynamic_select">
                                    <option {{ Request::is('admins/staf/') ? 'selected' : '' }}
                                            value="/admins/staf/"><b>PUSKOPDIT BKCU Kalimantan</b></option>
                                    <option disabled>-------CU Aktif-------</option>       
                                    @foreach($culists as $culist)
                                        <option {{ Request::is('admins/staf/index_cu/'.$culist->no_ba) ? 'selected' : '' }}
                                                value="/admins/staf/index_cu/{{$culist->no_ba}}"><b>{{ $culist->name }}</b></option>
                                    @endforeach
                                    <option disabled>-------CU Non-Aktif-------</option>
                                    @foreach($culists_non as $culist)
                                        <option {{ Request::is('admins/staf/index_cu/'.$culist->no_ba) ? 'selected' : '' }}
                                                value="/admins/staf/index_cu/{{$culist->no_ba}}"><b>{{ $culist->name }}</b></option>
                                    @endforeach   
                                </select>
                            </div>
                        </div>
                    @endif
                    <table class="table table-hover" id="dataTables-example"  width="100%">
                        <thead class="bg-light-blue-active color-palette">
                            <tr>
                                <th data-sortable="false">#</th>
                                <th hidden></th>
                                <th data-sortable="false">Foto</th>
                                <th>Nama </th>
                                <th>Jenis Kelamin</th>
                                <th>Jabatan</th>
                                <th>Status</th>
                                <th>Agama</th>
                                <th>Pendidikan</th>
                                <th>No. Telepon</th>
                                <th>No. Handphone</th>
                                <th>E-mail</th>
                                <th>Alamat</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($datas as $data)
                            <?php
                                $newarr = explode("\n",$data->alamat);
                                foreach($newarr as $str){
                                    $alamat = $str;
                                }

                                $jabatans = \App\Models\StafRiwayat::where('id_staf','=',$data->id)
                                                ->where('tipe','=',3)->get();
                                
                                $pekerjaan = array();
                                $i = 0;
                                foreach ($jabatans as $j){
                                    if($i < 1){
                                        if($j->keterangan == $id){
                                            if($j->keterangan2 == 'Manajemen'){
                                                if($j->sekarang == "1"){
                                                    $pekerjaan[] = $j->name;
                                                    $i++;
                                                }
                                            }else{
                                                $mulai = \Carbon\Carbon::createFromFormat('Y-m-d', $j->mulai)->format('Y');
                                                $selesai = \Carbon\Carbon::createFromFormat('Y-m-d', $j->selesai)->format('Y');
                                                $now =   \Carbon\Carbon::now()->format('Y');
                                                if($selesai >= $now){
                                                    $pekerjaan[] = $j->name.' periode '.$mulai.' - '.$selesai;
                                                    $i++;
                                                }
                                            }
                                        }
                                    }
                                }
                            ?>
                            <tr >
                                <td class="bg-aqua disabled color-palette"></td>    
                                <td hidden>{{$data->id}}</td>
                                @if(!empty($data->gambar) && is_file($imagepath.$data->gambar."n.jpg"))
                                    <td style="white-space: nowrap"><div class="modalphotos" >
                                            {{ Html::image($imagepath.$data->gambar.'n.jpg',asset($imagepath.$data->gambar."jpg"),
                                             array('class' => 'img-responsive',
                                            'id' => 'tampilgambar', 'width' => '40px')) }}
                                        </div></td>
                                @elseif(!empty($data->gambar) && is_file($imagepath.$data->gambar))
                                    <td style="white-space: nowrap"><div class="modalphotos" >
                                            {{ Html::image($imagepath.$data->gambar,asset($imagepath.$data->gambar),
                                                array('class' => 'img-responsive ',
                                                'id' => 'tampilgambar', 'width' => '40px')) }}
                                        </div></td>
                                @else
                                    @if($data->kelamin == "Wanita")
                                        <td>{{ Html::image('images/no_image_woman.jpg', 'a picture', array('class' => 'img-responsive',
                                                            'id' => 'tampilgambar', 'width' => '40px')) }}</td>
                                    @else
                                        <td>{{ Html::image('images/no_image_man.jpg', 'a picture', array('class' => 'img-responsive',
                                                            'id' => 'tampilgambar', 'width' => '40px')) }}</td>
                                    @endif
                                @endif
                                
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->kelamin }}</td>
                                <td>
                                @foreach($pekerjaan as $p)
                                    {{ $p  }}<br/>
                                @endforeach
                                </td>
                                <td>{{ $data->status }}</td>
                                <td>{{ $data->agama }}</td>
                                <td>{{ $data->pendidikan }}</td>
                                <td>{{ $data->telp }}</td>
                                <td>{{ $data->handphone }}</td>
                                <td>{{ $data->email }}</td>
                                <td>{{ $alamat }}</td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
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
                    <h4 class="modal-title"><i class="fa fa-trash"></i> Hapus Staf</h4>
                </div>
                <div class="modal-body">
                    <h4>Menghapus staf ini ?</h4>
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

@section('js')
    @include('admins._components.datatable_JS')
    <script type="text/javascript" src="{{ URL::asset('admin/datatable.js') }}"></script>
    <script>
        function format ( dataSource ) {
            var html = '<table class="table table-bordered" cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
            for (var key in dataSource){
                html += '<tr>'+
                        '<td>' + key             +'</td>'+
                        '<td>' + dataSource[key] +'</td>'+
                        '</tr>';
            }
            return html += '</table>';
        }


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
                            window.location.href = "/admins/" + kelas + "/" + id + "/edit";
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
                                $('#modalhapus_id').attr('value',id);
                                $('#modalhapus_judul').text('Hapus Staf');
                                $('#modalhapus_detail').text('Yakin menghapus staf ini ?');
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
        new $.fn.dataTable.Buttons(table,{
            buttons: [
                {
                    text: '<i class="fa fa-database"></i> Detail',
                    action: function(){
                        var id = $.map(table.rows({ selected: true }).data(),function(item){
                            return item[1];
                        });
                        var kelas = "{{ $kelas }}";
                        if(id != ""){
                            window.location.href = "/admins/" + kelas + "/" + id + "/detail";
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

        $(function(){
            // bind change event to select
            $('#dynamic_select').on('change', function () {
                var url = $(this).val(); // get selected value
                if (url) { // require a URL
                    window.location.href = url; // redirect
                }
                return false;
            });

            // $('#dataTables-example').on('click', 'td.details-control', function () {
            //     var tr = $(this).closest('tr');
            //     var row = table.row(tr);

            //     if (row.child.isShown()) {
            //         // This row is already open - close it
            //         row.child.hide();
            //         tr.removeClass('shown');
            //     } else {
            //         // Open this row
            //         row.child(format({
            //             'No. Telepon ' : tr.data('key-telp'),
            //             'No. Handphone' :  tr.data('key-handphone'),
            //             'Email' : tr.data('key-email'),
            //             'Kota' : tr.data('key-kota'),
            //             'Alamat' : tr.data('key-alamat')
            //         })).show();
            //         tr.addClass('shown');
            //     }
            // });
        });

    </script>
@stop