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
                @if(!empty($data->name))
                    <h2>{{ $data->name }}</h2>
                @endif
                @if(!empty($data->jabatan))
                    @if(!empty($data->tingkat))
                        @if($data->tingkat == 3 )
                            <p>{{ $data->jabatan }}</p>
                            <?php $jabatan = $data->jabatan; ?>
                        @else
                            @if($data->periode1 == '0' || $data->periode2 == '0')
                                <p>{{ $data->jabatan }}</p>
                                <?php $jabatan = $data->jabatan; ?>
                            @else
                                <p>{{ $data->jabatan }} Periode {{$data->periode1}} - {{ $data->periode2 }}</p>
                                <?php $jabatan = $data->jabatan.' Periode '.$data->periode1.' - '.$data->periode2; ?>
                            @endif
                        @endif
                     @endif
                @else
                    <p></p>
                @endif
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
                        <h3 class="classic-title"><span>Informasi Umum</span></h3>
                    </div>
                    <div class="col-md-2">
                        <div class="portfolio-item">
                            @if(!empty($data->gambar) && is_file($imagepath.$data->gambar."n.jpg"))
                                <a class="lightbox" title="{{ $data->judul }}" href="{{ asset($imagepath.$data->gambar.".jpg") }}">
                                    <div class="thumb-overlay"><i class="fa fa-arrows-alt"></i></div>
                                    <img class="img-responsive"
                                         src="{{asset($imagepath.$data->gambar.'n.jpg')}}" alt="{{$bkcu->judul}}" />
                                </a>
                            @else
                                @if($data->kelamin == "Wanita")
                                    <img class="img-responsive" src="{{asset('images/no_image_woman.jpg')}}" alt="{{$data->nama}}" />
                                @else
                                    <img class="img-responsive" src="{{asset('images/no_image_man.jpg')}}" alt="{{$data->nama}}" />
                                @endif
                            @endif
                        </div>
                    </div>
                    <div class="col-md-10">
                        @if(!empty($data->name))
                            <h4 style="padding-bottom: 1em;">{{ $data->name }}</h4>
                        @endif
                        @if(!empty($jabatan))
                            <strong>Jabatan : </strong>{{ $data->jabatan }}<br/>
                        @endif
                        @if(!empty($data->tempat_lahir))
                            <strong>Tempat Lahir: </strong>{{ $data->tempat_lahir }}<br/>
                        @endif
                        @if(!empty($data->tanggal_lahir))
                            <?php $tanggallahir = new Date($data->tanggal_lahir); ?>
                            <strong>Tanggal Lahir: </strong>{{ $tanggallahir->format('j F Y') }}<br/>
                        @endif
                        @if(!empty($data->agama))
                            <strong>Agama: </strong>{{ $data->agama }}<br/>
                        @endif
                        @if(!empty($data->status))
                            <strong>Status: </strong>{{ $data->status }}<br/>
                        @endif
                        @if(!empty($data->alamat))
                            <strong>Alamat: </strong>{{ $data->alamat }}<br/>
                        @endif
                        @if(!empty($data->kota))
                            <strong>Kota: </strong>{{ $data->kota }}<br/>
                        @endif
                        @if(!empty($data->hp))
                            <strong>hp: </strong>{{ $data->hp }}<br/>
                        @endif
                        @if(!empty($data->email))
                            <strong>E-mail: </strong>{{ $data->email }}<br/>
                        @endif
                    </div>
                    <div class="col-md-12">
                        <h3 class="classic-title"><span>Riwayat Pendidikan</span></h3>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Nama Lembaga Pendidikan</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Selesai</th>
                                <th>Ubah</th>
                                <th>Hapus</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($riwayats1 as $riwayat1)
                                <tr>
                                    @if(!empty($riwayat1->name))
                                        <td>{{ $riwayat1->name }}</td>
                                    @else
                                        <td>-</td>
                                    @endif
                                    @if(!empty($riwayat1->mulai ))
                                        <?php $date = new Date($riwayat1->mulai); ?>
                                        <td><i hidden="true">{{$riwayat1->mulai}}</i> {{ $date->format('d-n-Y') }}</td>
                                    @else
                                        <td>-</td>
                                    @endif
                                    @if(!empty($riwayat1->selesai ))
                                        <?php $date2 = new Date($riwayat1->selesai); ?>
                                        <td><i hidden="true">{{$riwayat1->selesai}}</i> {{ $date2->format('d-n-Y') }}</td>
                                    @else
                                        <td>-</td>
                                    @endif
                                    <td><a class="btn btn-primary modaltext2" href="#"
                                           data-id="1"
                                           data-tipe="Pendidikan"
                                           data-text1="{{ $riwayat1->name }}"
                                           data-text2="{{ $date->format('d-n-Y') }}"
                                           data-text3="{{ $date2->format('d-n-Y') }}"
                                           data-text4="{{ $riwayat1->id }}"
                                           data-target="#modaltext2"
                                           data-toggle="modal" data-placement="top">
                                            <i class="fa fa-pencil"></i></a></td>
                                    <td><button class="btn btn-danger modal1" name="{{ $riwayat1->id }}"
                                                title="{{ $data->id }}">
                                            <i class="fa fa-trash"></i></button></td>
                                </tr>
                            @endforeach
                            @if($riwayats1->isEmpty())
                                <tr>
                                    <td colspan="4">Belum terdapat data riwayat pendidikan</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        <h3 class="classic-title"><span>Riwayat Pekerjaan/Jabatan</span></h3>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Nama Pekerjaan/Jabatan</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Selesai</th>
                                <th>Ubah</th>
                                <th>Hapus</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($riwayats2 as $riwayat2)
                                <tr>
                                    @if(!empty($riwayat2->name))
                                        <td>{{ $riwayat2->name }}</td>
                                    @else
                                        <td>-</td>
                                    @endif
                                    @if(!empty($riwayat2->mulai ))
                                        <?php $date = new Date($riwayat2->mulai); ?>
                                        <td><i hidden="true">{{$riwayat2->mulai}}</i> {{ $date->format('d-n-Y') }}</td>
                                    @else
                                        <td>-</td>
                                    @endif
                                    @if(!empty($riwayat2->selesai ))
                                        <?php $date2 = new Date($riwayat2->selesai); ?>
                                        <td><i hidden="true">{{$riwayat2->selesai}}</i> {{ $date2->format('d-n-Y') }}</td>
                                    @else
                                        <td>-</td>
                                    @endif
                                    <td><a class="btn btn-primary modaltext2" href="#"
                                           data-id="2"
                                           data-tipe="Pekerjaan"
                                           data-text1="{{ $riwayat2->name }}"
                                           data-text2="{{ $date->format('d-n-Y') }}"
                                           data-text3="{{ $date2->format('d-n-Y') }}"
                                           data-text4="{{ $riwayat2->id }}"
                                           data-target="#modaltext2"
                                           data-toggle="modal" data-placement="top">
                                            <i class="fa fa-pencil"></i></a></td>
                                    <td><button class="btn btn-danger modal1" name="{{ $riwayat2->id }}"
                                                title="{{ $data->id }}">
                                            <i class="fa fa-trash"></i></button></td>
                                </tr>
                            @endforeach
                            @if($riwayats2->isEmpty())
                                <tr>
                                    <td colspan="4">Belum terdapat data riwayat pekerjaan</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        <h3 class="classic-title"><span>Pengalaman Organisasi</span></h3>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Nama Organisasi</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Selesai</th>
                                <th>Ubah</th>
                                <th>Hapus</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($riwayats3 as $riwayat3)
                                <tr>
                                    @if(!empty($riwayat3->name))
                                        <td>{{ $riwayat3->name }}</td>
                                    @else
                                        <td>-</td>
                                    @endif
                                    @if(!empty($riwayat3->mulai ))
                                        <?php $date = new Date($riwayat3->mulai); ?>
                                        <td><i hidden="true">{{$riwayat3->mulai}}</i> {{ $date->format('d-n-Y') }}</td>
                                    @else
                                        <td>-</td>
                                    @endif
                                    @if(!empty($riwayat3->selesai ))
                                        <?php $date2 = new Date($riwayat3->selesai); ?>
                                        <td><i hidden="true">{{$riwayat3->selesai}}</i> {{ $date2->format('d-n-Y') }}</td>
                                    @else
                                        <td>-</td>
                                    @endif
                                    <td><a class="btn btn-primary modaltext2" href="#"
                                           data-id="2"
                                           data-tipe="Pekerjaan"
                                           data-text1="{{ $riwayat3->name }}"
                                           data-text2="{{ $date->format('d-n-Y') }}"
                                           data-text3="{{ $date2->format('d-n-Y') }}"
                                           data-text4="{{ $riwayat3->id }}"
                                           data-target="#modaltext2"
                                           data-toggle="modal" data-placement="top">
                                            <i class="fa fa-pencil"></i></a></td>
                                    <td><button class="btn btn-danger modal1" name="{{ $riwayat3->id }}"
                                                title="{{ $data->id }}">
                                            <i class="fa fa-trash"></i></button></td>
                                </tr>
                            @endforeach
                            @if($riwayats3->isEmpty())
                                <tr>
                                    <td colspan="4">Belum terdapat data riwayat organisasi</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        <h3 class="classic-title"><span>DIKLAT Yang Sudah Diikuti</span></h3>
                    </div>
                    <div class="col-md-12">
                        <h3 class="classic-title"><span>DIKLAT Yang belum Diikuti</span></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Hapus -->
<div class="modal fade" id="modal1show" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    {{ Form::model($data, array('route' => array('cu.destroy_staf'), 'method' => 'delete')) }}
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