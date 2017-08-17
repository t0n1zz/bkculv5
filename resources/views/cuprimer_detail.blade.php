@extends('_layouts.layout')

@section('content')
 <!-- Page Title -->
<div class="page-banner" style="padding:40px 0;">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2>Credit Union {{ $cudetail->name }}</h2>
                <p>Credit Union Wilayah {{$cudetail->wilayahcuprimer->name}}</p>
            </div>
            <div class="col-md-6">
                <ul class="breadcrumbs">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('cuprimer') }}">Credit Union</a></li>
                    <li>Credit Union {{ $cudetail->name }}</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div id="content">
    <div class="container">
        <div class="page-content">
            <div class="big-title text-center">
                @if(!empty($cudetail->logo) && is_file("images_cu/{$cudetail->logo}"))
                    <img src="{{ asset('images_cu/'.$cudetail->logo) }}" alt="{{ $cudetail->name }}">
                @endif
                <h1>Selamat Datang Di <strong>Credit Union {{ $cudetail->name }}</strong></h1>
                <hr/>
                <p>
                    Kami merupakan CU yang memberikan pelayanan di wilayah {{$cudetail->wilayahcuprimer->name}}
                    @if(!empty($cudetail->bergabung))
                        <?php $datejoin = new Date($cudetail->bergabung); ?>
                        {{ 'sejak '.$datejoin->format('Y') }}<br/>
                    @endif
                    @if(!empty($cudetail->tp))
                        {{'dan saat ini telah memiliki '.$cudetail->tp. ' tempat pelayanan/kantor pelayanan'}}<br/>
                    @endif
                </p>
            </div>
            @if(!empty($cudetail->ultah))
                <?php
                $date = new Date($cudetail->ultah);
                $date2 = Date::now()->format('d-m');
                ?>
                @if($date->format('d-m') == $date2)
                    <?php
                    $year1 = new Date($cudetail->ultah);
                    $year2 = Date::now()->format('Y');
                    $totalyear = $year2 - $year1->format('Y');
                    ?>
                    <div class="row">
                        <div class="col-md-12" data-animation="fadeInDown" data-animation-delay="01">
                            <div class="hr1 margin-top"></div>
                            <div class="call-action call-action-boxed call-action-style1 clearfix">
                                <div class="button-side" style="margin-top:4px;">
                                    <a href="{{ asset('images/birthday-card.jpg') }}"
                                       title="Selamat Ulang Tahun Ke {{$totalyear}} untuk Credit Union {{ $cudetail->name }}
                                               Semoga Semakin Maju dan Terus Berkarya" target="_blank"
                                        class="btn-system border-btn btn-medium lightbox">Happy Birthday!!</a></div>
                                <h2 class="primary">Hari ini Credit Union {{ $cudetail->name }} berulang tahun yang ke <strong>{{$totalyear}}</strong></h2>
                                <p>Kami seluruh jajaran Pengurus, Pengawas, Komite dan Manajemen Puskopdit BKCU Kalimantan mengucapkan
                                    <br/>
                                    Selamat Ulang Tahun Ke {{$totalyear}} untuk Credit Union {{ $cudetail->name }} Semoga semakin bertumbuh
                                    dan berkembang bersama anggota serta semakin unggul dalam
                                    memberdayakan dan mensejahterakan masyarakat dengan semangat dan jiwa Credit Union </p>
                            </div>
                        </div>
                    </div>
                    <div class="hr1" style="margin-bottom:50px;"></div>
                @endif
            @endif
            <div class="row">
                <div class="col-md-7">
                    <h4 class="classic-title"><span>Informasi Umum</span></h4>
                    <p>
                        @if(!empty($cudetail->badan_hukum))
                            <strong>No. Badan Hukum: </strong>{{ $cudetail->badan_hukum }}<br/>
                        @endif
                        @if(!empty($cudetail->ultah))
                            <?php $date = new Date($cudetail->ultah); ?>
                            <strong>Tanggal Berdiri: </strong>{{$date->format('j F Y')}}<br/>
                        @endif
                        @if(!empty($cudetail->bergabung))
                            <?php $datejoin = new Date($cudetail->bergabung); ?>
                            <strong>Tanggal Bergabung: </strong>{{ $datejoin->format('j F Y') }}<br/>
                        @endif
                        @if(!empty($cudetail->tp))
                            <strong>Jumlah Tempat Pelayanan / Kantor Pelayanan: </strong>{{$cudetail->tp}}<br/>
                        @endif
                        <br/>
                        @if(!empty($cudetail->telp))
                            <strong>No. Telepon: </strong>{{$cudetail->telp}}<br/>
                        @endif
                        @if(!empty($cudetail->hp))
                            <strong>No. Handphone: </strong>{{$cudetail->hp}}<br/>
                        @endif
                        @if(!empty($cudetail->email))
                            <strong>Email: </strong><a target="_blank" href="mailto:{{$cudetail->email}}">{{$cudetail->email}}</a><br/>
                        @endif
                        @if(!empty($cudetail->website))
                            <strong>Website: </strong><a target="_blank" href="http://{{$cudetail->website}}">{{$cudetail->website}}</a><br/>
                        @endif
                        <br/>
                        @if(!empty($cudetail->pos))
                            <strong>Kode Pos: </strong>{{$cudetail->pos}}<br/>
                        @endif
                        @if(!empty($cudetail->alamat))
                            <strong>Alamat: </strong><br/>
                            {{$cudetail->alamat}}
                        @endif

                    </p>
                </div>
                <div class="col-md-5 portfolio-item">
                    <div class="portfolio-thumb">
                        <?php $imagepath = 'images_cu/';?>
                        @if(!empty($cudetail->gambar) && is_file($imagepath.$cudetail->gambar.".jpg"))
                            <a class="lightbox" title="{{ $cudetail->name }}" href="{{ asset($imagepath.$cudetail->gambar.".jpg") }}">
                            <div class="thumb-overlay"><i class="fa fa-arrows-alt"></i></div>
                                {{ Html::image($imagepath.$cudetail->gambar.'.jpg',$cudetail->name,
                                    array('class' => 'img-responsive ')) }}
                            </a>
                        @else
                        <a class="lightbox" title="{{ $cudetail->name }}" href="{{ asset('images/image-cu.jpg') }}">
                            <div class="thumb-overlay"><i class="fa fa-arrows-alt"></i></div>
                            {{ Html::image('images/image-cu.jpg', $cudetail->name, array(
                                'class' => 'img-responsive')) }}
                        </a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="hr1" style="margin-bottom:50px;"></div>
            @if(!empty($cudetail->deskripsi))
                <div class="big-title text-center" data-animation="fadeInDown" data-animation-delay="01">
                    <h1>Deskripsi <strong>Credit Union {{ $cudetail->name }}</strong></h1>
                    <p>Deskripsi umum mengenai Credit Union {{ $cudetail->name }}</p>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        {!! $cudetail->deskripsi !!}
                    </div>
                </div>
                <div class="hr1" style="margin-bottom:50px;"></div>
            @endif
         {{--    @if(!$stafs->isEmpty())
                <div class="big-title text-center" data-animation="fadeInDown" data-animation-delay="01">
                    <h1>Pengurus, Pengawas dan Manajemen <strong>Credit Union {{ $cudetail->name }}</strong></h1>
                    <p>Daftar Pengurus, Pengawas dan Manajemen Credit Union {{ $cudetail->name }}</p>
                </div>
                <div class="hr1" style="margin-bottom:50px;"></div>
                <div class="row" data-animation="fadeInDown" data-animation-delay="01">
                    <div class="col-md-12 col-sm-12">
                        <div class="table-responsive" >
                            <table class="table table-stripped table-hover" id="dataTables-example">
                                <thead>
                                <tr>
                                    <th>Nama </th>
                                    <th>Jabatan</th>
                                    <th>Tingkat</th>
                                    <th>Foto</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($stafs as $staff)
                                    <tr>

                                        @if(!empty($staff->name))
                                            <td>{{ $staff->name}}</td>
                                        @else
                                            <td>-</td>
                                        @endif

                                        @if(!empty($staff->jabatan))
                                            <td>{{ $staff->jabatan }}</td>
                                        @else
                                            <td><a>-</a></td>
                                        @endif

                                        @if(!empty($staff->tingkat))
                                            @if($staff->tingkat == 1 )
                                                @if($staff->periode1 > 0 && $staff->periode2 > 0)
                                                    <td>Pengurus Periode {{ $staff->periode1 }} - {{ $staff->periode2 }}</td>
                                                @else
                                                    <td></td>Pengurus</td>
                                                @endif
                                            @elseif($staff->tingkat == 2)
                                                @if($staff->periode1 > 0 && $staff->periode2 > 0)
                                                    <td>Pengawas Periode {{ $staff->periode1 }} - {{ $staff->periode2 }}</td>
                                                @else
                                                    <td>Pengawas</td>
                                                @endif
                                            @elseif($staff->tingkat == 3)
                                                <td>Manajemen</td>
                                            @endif
                                        @else
                                            <td>-</td>
                                        @endif

                                        @if(!empty($staff->gambar) && is_file("images_cu/{$staff->gambar}"))
                                            <td>{{ Html::image('images_cu/'.$staff->gambar, 'a picture', array('class' => 'img-responsive',
			        	'id' => 'tampilgambar', 'width' => '50')) }}</td>
                                        @else
                                            @if($staff->kelamin == "Wanita")
                                                <td>{{ Html::image('images/no_image_woman.jpg', 'a picture', array('class' => 'img-responsive',
                                                'id' => 'tampilgambar', 'width' => '50')) }}</td>
                                            @else
                                                <td>{{ Html::image('images/no_image_man.jpg', 'a picture', array('class' => 'img-responsive',
                                                'id' => 'tampilgambar', 'width' => '50')) }}</td>
                                            @endif
                                        @endif

                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="hr1" style="margin-bottom:50px;"></div>
            @endif --}}
        </div>
    </div>
</div>
@stop