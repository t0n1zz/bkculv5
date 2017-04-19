<?php
$title = "Kelola Staf";

if(!empty($datas->first()->cuprimer))
    $title2 ="CU " . $datas->first()->cuprimer->name;
else
    $title2 ="Puskopdit BKCU Kalimantan";


$kelas = "staf";
$imagepath = "images_staf/";
$id_old="";
?>
@extends('admins._layouts.layout')

@section('css')
    @include('admins._components.datatable_CSS')
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/dataTables/extension/Responsive/css/responsive.bootstrap.min.css')}}" >
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
                                $culists = App\Cuprimer::orderBy('name','asc')->get();
                                $culists_non = App\Cuprimer::onlyTrashed()->orderBy('name','asc')->get();
                            ?>
                            <div class="input-group tabletools">
                                <div class="input-group-addon primary-color"><i class="fa fa-building-o"></i> Lembaga</div>
                                <select class="form-control"  id="dynamic_select">
                                    <option {{ Request::is('admins/staf/') ? 'selected' : '' }}
                                            value="/admins/staf/"><b>Puskopdit BKCU Kalimantan</b></option>
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
                                <th hidden></th>
                                <th data-sortable="false">Foto</th>
                                <th class="sort" data-priority="1">Nama </th>
                                <th>NIM</th>
                                <th>No.Identitas</th>
                                <th>Jabatan</th>
                                <th>Pendidikan Tertinggi</th>
                                <th>Agama</th>
                                <th>Status</th>
                                <th>Tgl. Lahir</th>
                                <th>Umur</th>
                                <th class="none">Alamat</th>
                                <th class="none">Kontak</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($datas as $data)
                            <?php
                                if($id_old == $data->id_staf)
                                    break;

                                $pekerjaan ='';
                                $i = 0;
                                $date = new Date($data->tanggal_lahir);

                                if(!empty($data->staf->pekerjaan_aktif)){
                                    foreach($data->staf->pekerjaan_aktif as $p){
                                        $i++;
                                        if($p->tipe == "1"){
                                            $pekerjaan .= $p->name . ' CU ' . $p->cuprimer->name;
                                        }elseif($p->tipe == "2"){
                                            $pekerjaan .= $p->name . ' ' . $p->lembaga->name;
                                        }elseif($p->tipe == "3"){
                                            $pekerjaan .=$p->name . ' Puskopdit BKCU Kalimantan';
                                        }
                                        if($i < $data->staf->pekerjaan_aktif->count()){
                                            $pekerjaan .= ', ';
                                        }
                                    }
                                }

                                if(!empty($data->staf->pendidikan)){
                                    $pendidikan = $data->staf->pendidikan->first();
                                }

                                $newarr = explode("\n",$data->staf->alamat);
                                foreach($newarr as $str){
                                    $alamat = $str;
                                }

                                $newarr2 = explode("\n",$data->staf->kontak);
                                foreach($newarr2 as $str2){
                                    $kontak = $str2;
                                }

                                if($data->staf->status == 1){
                                    $status = "Menikah";
                                }elseif($data->staf->status == 2){
                                    $status = "Belum Menikah";
                                }elseif($data->staf->status == 3){
                                    $status = "Duda/Janda";
                                }else{
                                    $status = "";
                                }

                                 if($pendidikan->tingkat == 1){
                                        $tingkat = "SD";
                                    }elseif($pendidikan->tingkat == 2){
                                        $tingkat = "SMP";
                                    }elseif($pendidikan->tingkat == 3){
                                        $tingkat = "SMA/SMK";
                                    }elseif($pendidikan->tingkat == 4){
                                        $tingkat = "D1";
                                    }elseif($pendidikan->tingkat == 5){
                                        $tingkat = "D2";
                                    }elseif($pendidikan->tingkat == 6){
                                        $tingkat = "D3";
                                    }elseif($pendidikan->tingkat == 7){
                                        $tingkat = "D4";
                                    }elseif($pendidikan->tingkat == 8){
                                        $tingkat = "S1";
                                    }elseif($pendidikan->tingkat == 9){
                                        $tingkat = "S2";
                                    }elseif($pendidikan->tingkat == 10){
                                        $tingkat = "S3";
                                    }else{
                                        $tingkat = "Lain-lain";
                                    }
                            ?>
                            <tr >  
                                <td hidden>{{$data->staf->id}}</td>
                                @if(!empty($data->staf->gambar) && is_file($imagepath.$data->staf->gambar."n.jpg"))
                                    <td style="white-space: nowrap"><div class="modalphotos" >
                                            {{ Html::image($imagepath.$data->staf->gambar.'n.jpg',asset($imagepath.$data->staf->gambar."jpg"),
                                             array('class' => 'img-responsive',
                                            'id' => 'tampilgambar', 'width' => '40px')) }}
                                        </div></td>
                                @else
                                    @if($data->staf->kelamin == "Wanita")
                                        <td>{{ Html::image('images/no_image_woman.jpg', 'a picture', array('class' => 'img-responsive',
                                                            'id' => 'tampilgambar', 'width' => '40px')) }}</td>
                                    @else
                                        <td>{{ Html::image('images/no_image_man.jpg', 'a picture', array('class' => 'img-responsive',
                                                            'id' => 'tampilgambar', 'width' => '40px')) }}</td>
                                    @endif
                                @endif
                                
                                <td>{{ $data->staf->name }}</td>
                                <td>{{ $data->staf->nim }}</td>
                                <td>{{ $data->staf->nid }}</td>
                                <td class="warptext">{!! $pekerjaan !!}</td>
                                @if(!empty($pendidikan))
                                    <td class="warptext">{{ $tingkat . ' ' . $pendidikan->name . ' di ' . $pendidikan->tempat}}</td>
                                @else
                                    <td></td>    
                                @endif
                                <td>{{ $data->staf->agama }}</td>
                                <td>{{ $status }}</td>
                                <td data-order="{{ $data->tanggal_lahir }}">{{ $date->format('d F Y') }}</td>
                                <td>{{ $data->staf->age }} Tahun</td>
                                <td>{{ $alamat }}</td>
                                <td>{{ $kontak }}</td>
                                <td></td>
                            </tr>
                            <?php $id_old = $data->id_staf; ?>
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
    <script type="text/javascript" src="{{ URL::asset('plugins/dataTables/extension/Responsive/js/dataTables.responsive.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('plugins/dataTables/extension/Responsive/js/responsive.bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('admin/datatable_responsive.js') }}"></script>
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
                    text: '<i class="fa fa-pencil"></i> <u>U</u>bah Identitas',
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
                            return item[0];
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
                },
                @endpermission
                {
                    text: '<i class="fa fa-database"></i> Detail',
                    action: function(){
                        var id = $.map(table.rows({ selected: true }).data(),function(item){
                            return item[0];
                        });
                        var kelas = "{{ $kelas }}";
                        if(id != ""){
                            window.location.href = "/admins/" + kelas + "/detail/"+ id ;
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