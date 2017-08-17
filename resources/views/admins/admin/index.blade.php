<?php
$title = "Kelola Admin";
$kelas = "admin";
$imagepath = "images_user/";

$file_max = ini_get('upload_max_filesize');
$file_max_str_leng = strlen($file_max);
$file_max_meassure_unit = substr($file_max,$file_max_str_leng - 1,1);
$file_max_meassure_unit = $file_max_meassure_unit == 'K' ? 'kb' : ($file_max_meassure_unit == 'M' ? 'mb' : ($file_max_meassure_unit == 'G' ? 'gb' : 'unidades'));
$file_max = substr($file_max,0,$file_max_str_leng - 1);
$file_max = intval($file_max);
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
        <i class="fa fa-user-circle-o"></i> {{ $title }}
        <small>Mengelola Data Admin</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('admins') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><i class="fa fa-user-circle-o"></i> {{ $title }}</li>
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
            <li class="active"><a href="#tab_" data-toggle="tab">Admin BKCU</a></li>
            <li class="active"><a href="#tab_admin" data-toggle="tab">Admin CU</a></li>
        </ul>
        <div class="tab-content"> 
            <div class="tab-pane active" id="tab_admin">
                <div class="input-group tabletools">
                    <div class="input-group-addon"><i class="fa fa-search"></i></div>
                    <input type="text" id="searchtext" class="form-control" placeholder="Kata kunci pencarian...">
                </div>
                <table class="table table-hover" id="dataTables-example" width="100%">
                    <thead class="bg-light-blue-active color-palette">
                    <tr >
                        <th hidden></th>
                        <th hidden></th>
                        <th hidden></th>
                        <th data-sortable="false">Foto</th>
                        <th data-priority="1">Username</th>
                        <th>Nama</th>
                        <th class="sort">CU</th>
                        <th>Terakhir Login</th>
                        <th>Terakhir Logout</th>
                        <th data-priority="2">Status</th>
                        <th>&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($datas as $data)
                        <tr>
                            <td hidden>{{ $data->id }}</td>
                            @if(!empty($data->gambar) && is_file($imagepath.$data->gambar.".jpg"))
                                <td hidden>{{  asset($imagepath.$data->gambar.'.jpg') }}</td> 
                            @else
                                <td hidden>{{ asset('images/no_image_man.jpg') }}</td>
                            @endif
                            <td hidden>{{ $data->status  }}</td>
                            @if(!empty($data->gambar) && is_file($imagepath.$data->gambar.".jpg"))
                                <td style="white-space: nowrap"><div class="modalphotos" >
                                        {{ Html::image($imagepath.$data->gambar.'.jpg',asset($imagepath.$data->gambar."jpg"),
                                         array('class' => 'img-responsive', 'width' => '40px')) }}
                                    </div></td>
                            @else
                                <td>{{ Html::image('images/no_image_man.jpg', 'a picture', array('class' => 'img-responsive',
                                                     'width' => '40px')) }}</td>
                            @endif
                            <td>{{ $data->username }}</td>
                            <td>{{ $data->name }}</td>

                            @if($data->cu == "0")
                                <td>BKCU</td>
                            @else
                                @if(!empty($data->cuprimer))
                                    <td>{{ $data->cuprimer->name }}</td>
                                @else
                                    <td>-</td>
                                @endif    
                            @endif

                            @if($data->login != "0000-00-00 00:00:00")
                                <?php $date = new Date($data->login); ?>
                                <td><i hidden="true">{{$data->login}}</i> {{ $date->format('j F Y | H:i:s') }}</td>
                            @else
                                <td>-</td>
                            @endif

                            @if($data->logout != "0000-00-00 00:00:00")
                                <?php $date = new Date($data->logout); ?>
                                <td><i hidden="true">{{$data->logout}}</i> {{ $date->format('j F Y | H:i:s') }}</td>
                            @else
                                <td>-</td>
                            @endif
                            @if($data->status == 1)
                                <td><a class="btn btn-info nopointer"><i class="fa fa-check"></i> Aktif</a></td>
                            @else
                                <td><a class="btn btn-default nopointer"><i class="fa fa-ban"></i> Tidak Aktif</a></td>";
                            @endif
                            <td></td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<!-- modal -->
<div class="modal fade" id="modalpassword" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    {{ Form::open(array('route' => array('admins.'.$kelas.'.update_password'),'data-toggle'=>'validator','role'=>'form')) }}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-light-blue-active color-palette">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title "><i class="fa fa-key"></i> Ubah Password</h4>
            </div>
            <div class="modal-body">
                <input type="text" name="id" id="modalpassword_id" value="" hidden>
                <div class="form-group has-feedback">
                    <h5>Password Baru</h5>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-font"></i></span>
                        {{ Form::password('password',array('class' => 'form-control','id'=>'password',
                        'placeholder' => 'Silahkan masukkan password baru','required','data-minlength'=>'5'))}}
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    </div>
                    <div class="help-block">Password minimal 5 karakter.</div>
                </div>
                <div class="form-group has-feedback">
                    <h5>Ulangi Password</h5>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-font"></i></span>
                        {{ Form::password('password2',array('class' => 'form-control','id'=>'konfirmpassword',
                        'placeholder' => 'Silahkan masukkan password admin sekali lagi','required',
                        'data-match'=>'#password','data-match-error'=>'Maaf, password tidak sesuai.'))}}
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    </div>
                    <div class="help-block">Silahkan tulis ulang password anda.</div>
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
<div class="modal fade" id="modalhakakses" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    {{ Form::open(array('route' => array('admins.'.$kelas.'.update_akses'))) }}
    <div class="modal-dialog modal-lg">
        <div class="modal-content ">
            <div class="modal-header bg-light-blue-active color-palette">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title "><i class="fa fa-hand-paper-o"></i> Ubah Hak Akses</h4>
            </div>
            <div class="modal-body">
                <input type="text" name="id" id="modalhakakses_id" value="" hidden>
                @include('admins.'.$kelas.'.hak_akses')  
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="modalbutton"><i class="fa fa-save"></i> Simpan</button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
    {{ Form::close() }}
</div>
<div class="modal fade" id="modalstatus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    {{ Form::model($datas, array('route' => array('admins.'.$kelas.'.update_status'))) }}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-light-blue-active color-palette">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="fa fa-check-square"></i> Ubah Status</h4>
            </div>
            <div class="modal-body">
                <input type="text" name="id" value="" id="modalstatus_id" hidden>
                <h4 id="judul"></h4>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="modalbutton"><i class="fa fa-check"></i> Ya</button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
    {{ Form::close() }}
</div>
<div class="modal fade" id="modalgambar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    {{ Form::model($datas, array('route' => array('admins.'.$kelas.'.update_gambar'),'files' => true, 'data-toggle'=>'validator')) }}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-light-blue-active color-palette">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="fa fa-picture-o"></i> Ubah Foto</h4>
            </div>
            <div class="modal-body">
                <input type="text" value="" name="id" id="modalgambar_id" hidden>
                <input type="text" value="" name="name" id="modalgambar_name" hidden>
                <div>
                    <h4>Foto</h4>
                    <div class="thumbnail" >
                            {{ Html::image('images_user/user.jpg', 'a picture', array('class' => 'img-responsive', 'id' => 'tampilgambar', 'width' => '200')) }}
                        <div class="caption">
                            {{ Form::file('gambar', array('onChange' => 'readURL(this)','required')) }}
                        </div>
                    </div>
                    <div class="help-block">Ukuran maksimum file gambar adalah {!! $file_max. ' ' .$file_max_meassure_unit !!}.</div>
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
<!-- /.modal -->
@stop

@section('js')
    @include('admins._components.datatable_JS')
    <script type="text/javascript" src="{{ URL::asset('plugins/dataTables/extension/Responsive/js/dataTables.responsive.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('plugins/dataTables/extension/Responsive/js/responsive.bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('admin/datatable_responsive.js') }}"></script>
    <script>
        new $.fn.dataTable.Buttons(table,{
            buttons: [
                @permission('create.'.$kelas.'_create')
                {
                    text: '<i class="fa fa-plus"></i> <u>T</u>ambah',
                    titleAttr: 'Copy',
                    key: {
                        altKey: true,
                        key: 't'
                    },
                    action: function(){
                        window.location.href = "{{URL::to('admins/'.$kelas.'/create')}}";
                    }
                },
                @endpermission
                @permission('update_password.'.$kelas.'_update_password')
                {
                    text: '<i class="fa fa-key"></i> Ubah Password',
                    action: function(){
                        var id = $.map(table.rows({ selected:true }).data(),function(item){
                            return item[0];
                        });
                        if(id != ""){
                            $('#modalpassword').modal({show:true});
                            $('#modalpassword_id').attr('value',id);
                        }else{
                            $('#modalwarning').modal({show:true});
                        }
                    }
                },
                @endpermission
                @permission('update_akses.'.$kelas.'_update_akses')
                {
                    text: '<i class="fa fa-hand-paper-o"></i> Ubah Hak Akses',
                    action: function(){
                        var id = $.map(table.rows({ selected:true }).data(),function(item){
                            return item[0];
                        });
                        var cu = $.map(table.rows({ selected:true }).data(),function(item){
                            return item[6];
                        });
                        if(id != ""){
                            $('input:checkbox').removeAttr('checked');
                            $('#modalhakakses').modal({show:true});
                            $('#modalhakakses_id').attr('value',id);

                            if(cu != "BKCU"){
                                $('.bkcu').hide();
                            }else{
                                $('.bkcu').show();
                            }

                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });

                            $.ajax({
                               type: 'GET',
                                url: '/admins/admin/edit_akses/'+id,
                                success: function(data){
                                    $.each(data,function(index,value){
                                       $('#'+value).prop('checked',true);
                                    });
                                    console.log(data);
                                },
                                error: function(xhr, textstatus,errorThrown){
                                }
                            });

                        }else{
                            $('#modalwarning').modal({show:true});
                        }
                    }
                },
                @endpermission
                @permission('update_status.'.$kelas.'_update_status')
                {
                    text: '<i class="fa fa-check-square"></i> Ubah Status',
                    action: function(){
                        var id = $.map(table.rows({ selected:true }).data(),function(item){
                            return item[0];
                        });
                        var status = $.map(table.rows({ selected:true }).data(),function(item){
                            return item[2];
                        });
                        if(id != ""){
                            $('#modalstatus').modal({show:true});
                            if(status !="1"){
                                $('#judul').text('Aktifkan admin ini?');
                            }else{
                                $('#judul').text('Non-aktifkan admin ini?');
                            }
                            $('#modalstatus_id').attr('value',id);
                        }else{
                            $('#modalwarning').modal({show:true});
                        }
                    }
                },
                @endpermission
                {
                    text: '<i class="fa fa-picture-o"></i> Ubah Foto',
                    action: function(){
                        var id = $.map(table.rows({ selected:true }).data(),function(item){
                            return item[0];
                        });
                        var foto = $.map(table.rows({ selected:true }).data(),function(item){
                            return item[1];
                        });
                        var nama = $.map(table.rows({ selected:true }).data(),function(item){
                            return item[5];
                        });
                        if(id != ""){
                            $('#modalgambar').modal({show:true});
                            $('#modalgambar_id').attr('value',id);
                            $('#modalgambar_name').attr('value',nama);
                            $('#tampilgambar').attr('src',foto);
                            console.log(foto);
                        }else{
                            $('#modalwarning').modal({show:true});
                        }
                    }
                },
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
                        var username = $.map(table.rows({ selected:true }).data(),function(item){
                            return item[5];
                        });
                        if(id != ""){
                            if(id != "1"){
                                $('#modalhapus').modal({show:true});
                                $('#modalhapus_id').attr('value',id);
                                $('#modalhapus_judul').text('Hapus Admin');
                                $('#modalhapus_detail').text('Yakin menghapus admin ' + username + "?");
                            }
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