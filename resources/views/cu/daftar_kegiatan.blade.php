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
                <h2>DIKLAT {{ $data->name }}</h2>
                <p>Anda dapat mendaftarkan staf anda pada DIKLAT {{ $data->name }}</p>
            </div>
            <div class="col-md-6">
                <ul class="breadcrumbs">
                    <li><a href="{{ route('cu') }}">Dashboard</a></li>
                    <li><a href="{{ route('cu.kelola_kegiatan') }}">DIKLAT</a></li>
                    <li>Daftar DIKLAT</li>
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
                    <div class="col-md-4">
                        <br/>
                        <h3 class="classic-title"><span>Tinjauan Umum</span></h3>
                        <div class="call-action call-action-boxed call-action-style1 no-descripton clearfix">
                            <p>DIKLAT {{ $data->name }} dilaksanakan di District Office Barat di Pontianak</p>
                        </div>
                        <br/>
                        <div class="call-action call-action-boxed call-action-style3 no-descripton clearfix">
                            @if(!empty($data->tanggal))<?php $date = new Date($data->tanggal); ?>@endif
                            @if(!empty($data->tanggal2))<?php $date2 = new Date($data->tanggal2); ?>@endif
                            <h5 class="primary" style="color: white">{{  $date->format('d F Y') }} s.d. {{  $date2->format('d F Y') }}</h5>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <br/>
                        <h3 class="classic-title"><span>Fasilitator & Panitia</span></h3>
                        <div class="custom-carousel touch-carousel" data-appeared-items="4">
                            <div class="item">
                                <div class="team-member">
                                    <!-- Memebr Photo, Name & Position -->
                                    <div class="member-photo">
                                        <img alt="" src="{{ asset('images/no_image_man.jpg') }}" />
                                    </div>
                                    <!-- Memebr Words -->
                                    <div class="member-info">
                                        <strong>John Doe</strong>
                                        <br/>
                                        Fasilitator
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="team-member">
                                    <!-- Memebr Photo, Name & Position -->
                                    <div class="member-photo">
                                        <img alt="" src="{{ asset('images/no_image_man.jpg') }}" />
                                    </div>
                                    <!-- Memebr Words -->
                                    <div class="member-info">
                                        <strong>John Doe</strong>
                                        <br/>
                                        Fasilitator
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="team-member">
                                    <!-- Memebr Photo, Name & Position -->
                                    <div class="member-photo">
                                        <img alt="" src="{{ asset('images/no_image_man.jpg') }}" />
                                    </div>
                                    <!-- Memebr Words -->
                                    <div class="member-info">
                                        <strong>John Doe</strong>
                                        <br/>
                                        Fasilitator
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="team-member">
                                    <!-- Memebr Photo, Name & Position -->
                                    <div class="member-photo">
                                        <img alt="" src="{{ asset('images/no_image_man.jpg') }}" />
                                    </div>
                                    <!-- Memebr Words -->
                                    <div class="member-info">
                                        <strong>John Doe</strong>
                                        <br/>
                                        Fasilitator
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="team-member">
                                    <!-- Memebr Photo, Name & Position -->
                                    <div class="member-photo">
                                        <img alt="" src="{{ asset('images/no_image_man.jpg') }}" />
                                    </div>
                                    <!-- Memebr Words -->
                                    <div class="member-info">
                                        <strong>John Doe</strong>
                                        <br/>
                                        Fasilitator
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="team-member">
                                    <!-- Memebr Photo, Name & Position -->
                                    <div class="member-photo">
                                        <img alt="" src="{{ asset('images/no_image_man.jpg') }}" />
                                    </div>
                                    <!-- Memebr Words -->
                                    <div class="member-info">
                                        <strong>John Doe</strong>
                                        <br/>
                                        Fasilitator
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <br/>
                        <h3 class="classic-title"><span>Tujuan</span></h3>
                        <!-- Single Testimonial -->
                        <div class="classic-testimonials">
                            <div class="testimonial-content">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia.</p>
                            </div>
                        </div>
                        <!-- End Testimonial -->
                    </div>
                    <div class="col-md-6">
                        <br/>
                        <h3 class="classic-title"><span>Pokok Bahasan</span></h3>
                        <!-- Single Testimonial -->
                        <div class="classic-testimonials">
                            <div class="testimonial-content">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia.</p>
                            </div>
                        </div>
                        <!-- End Testimonial -->
                    </div>
                    <div class="col-md-12">
                        <br/>
                        <h3 class="classic-title"><span>Pendaftaran Staf</span></h3>
                        <a accesskey="t" class="btn btn-primary btn-sm" href="{{ route('cu.create_staf') }}">
                            <i class="fa fa-plus"></i> <u>T</u>ambah Staf Baru </a>
                        <br/><br/>
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Foto</th>
                                <th data-priority="1">Nama</th>
                                <th>Jabatan</th>
                                <th>Tp</th>
                                <th>Jenis Kelamin</th>
                                <th data-priority="3">Info</th>
                                <th data-priority="2">Daftar</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($datas as $data)
                                <tr>
                                    <td></td>
                                    @if(!empty($data->gambar) && is_file($imagepath.$data->gambar."n.jpg"))
                                        <td style="white-space: nowrap"><div class="modalphotos" >
                                                {{ HTML::image($imagepath.$data->gambar.'n.jpg',asset($imagepath.$data->gambar."jpg"),
                                                 array('class' => 'img-responsive',
                                                'id' => 'tampilgambar', 'width' => '50')) }}
                                            </div></td>
                                    @elseif(!empty($data->gambar) && is_file($imagepath.$data->gambar))
                                        <td style="white-space: nowrap"><div class="modalphotos" >
                                                {{ HTML::image($imagepath.$data->gambar,asset($imagepath.$data->gambar),
                                                    array('class' => 'img-responsive ',
                                                    'id' => 'tampilgambar', 'width' => '50')) }}
                                            </div></td>
                                    @else
                                        @if($data->kelamin == "Wanita")
                                            <td>{{ HTML::image('images/no_image_woman.jpg', 'a picture', array('class' => 'img-responsive',
                                                        'id' => 'tampilgambar', 'width' => '50')) }}</td>
                                        @else
                                            <td>{{ HTML::image('images/no_image_man.jpg', 'a picture', array('class' => 'img-responsive',
                                                        'id' => 'tampilgambar', 'width' => '50')) }}</td>
                                        @endif
                                    @endif

                                    @if(!empty($data->name))
                                        <td><b>{{ $data->name }}</b></td>
                                    @else
                                        <td>-</td>
                                    @endif

                                    @if(!empty($data->jabatan))
                                        @if(!empty($data->tingkat))
                                            @if($data->tingkat == 3 )
                                                <td>{{ $data->jabatan }}</td>
                                            @else
                                                @if($data->periode1 == '0' || $data->periode2 == '0')
                                                    <td>{{ $data->jabatan }}</td>
                                                @else
                                                    <td>{{ $data->jabatan }} Periode {{$data->periode1}} - {{ $data->periode2 }}</td>
                                                @endif
                                            @endif
                                        @else
                                            <td>-</td>
                                        @endif
                                    @else
                                        <td>-</td>
                                    @endif

                                    @if(!empty($data->tp))
                                        <td>{{ $data->tp }}</td>
                                    @else
                                        <td>-</td>
                                    @endif

                                    @if(!empty($data->kelamin))
                                        <td>{{ $data->kelamin }}</td>
                                    @else
                                        <td>-</td>
                                    @endif

                                    <td><a class="btn btn-info" href="{{route('cu.detail_staf', array($data->id))}}">
                                            <i class="fa fa-database"></i></a></td>

                                    <td><a class="btn btn-warning" href="{{route('cu.detail_staf', array($data->id))}}">
                                            <i class="fa fa-plus"></i></a></td>
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