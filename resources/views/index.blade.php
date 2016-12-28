<?php $page = ""; ?>
@extends('_layouts.layout')

@section('content')
{{--slider--}}
<section id="home" class="hidden-xs">
    {{--carousel--}}
    <div id="main-slide" class="carousel slide" data-ride="carousel">
        {{--indicators--}}
        <ol class="carousel-indicators">
            <?php $i = 0; ?>
            <li data-target="#main-slide" data-slide-to="{{$i}}" class="active"></li>
            <?php $i++; ?>
            <li data-target="#main-slide" data-slide-to="{{$i}}"></li>
            @if(!empty($ultahcu))
                <?php $i++; ?>
                <li data-target="#main-slide" data-slide-to="{{$i}}"></li>
            @endif

            @foreach($artikelpilihans as $artikelpilihan)
                <?php $i++; ?>
                <li data-target="#main-slide" data-slide-to="{{$i}}"></li>
            @endforeach
        </ol>
        {{--indicator--}}

        {{--carousel inner--}}
        <div class="carousel-inner">
            <?php $i = 0; ?>
            <div class="item active">
                <div class="black">
                    {{ Html::image('images/slider-welcome.jpg', 'Selamat Datang', array(
                   'class' => 'img-responsive')) }}
                </div>
                <div class="slider-content">
                    <div class="col-md-12 text-center" style="padding-right: 60px;padding-left: 60px;padding-top: -60px">
                        <?php $min=2;$max=8;$random1 = mt_rand($min,$max);$random2 = mt_rand($min,$max);
                              $random3 = mt_rand($min,$max);?>
                        <h3 class="animated{{$random1}}">
                            <span class="text-shadow" style="color: white">
                                Selamat Datang Di Puskopdit BKCU Kalimantan
                            </span>
                        </h3>
                        <hr class="animated{{$random2}} text-shadow" />
                        <p class="animated{{$random3}} text-shadow" style="font-size: medium;color: #ccc">
                            Sebuah gerakan Credit Union yang terdiri dari Credit Union di Nusantara yang memiliki
                            kesamaan semangat dan jiwa dalam mensejahterakan masyarakat sekitar.Dan kami hadir untuk
                            memberikan pelayanan kepada Credit Union demi terwujudnya visi dan misi sejati Credit Union
                        </p>
                    </div>
                </div>
            </div>
            <div class="item">
               <div class="">
                   {{ Html::image('images/natal.jpg', 'Selamat Menunaikan Ibadah Puasa', array(
                  'class' => 'img-responsive')) }}
               </div>
               <div class="slider-content">
               </div>
            </div>
       {{--     <div class="item">
                <div class="">
                    {{ Html::image('images/slider-imlek.jpg', 'Chinese New Year 2016', array(
                   'class' => 'img-responsive')) }}
                </div>
                <div class="slider-content">
                </div>
            </div>--}}
            @if(!empty($ultahcu))
                <div class="item">
                    <div class="black" >
                        {{ Html::image('images/birthday.jpg','birthday',array('class' => 'portrait ','id' => 'tampilgambar')) }}
                    </div>
                    <div class="slider-content" style="padding-right: 60px;padding-left: 60px;padding-top: -60px">
                        <div class="col-md-12 text-center">
                            <p class="animated3 text-shadow" style="font-size: medium;color: #ccc">
                                Seluruh Jajaran Pengurus, Pengawas, Komite dan Manajemen Puskopdit BKCU Kalimantan mengucapkan
                            </p>
                            <h3 class="animated7 text-shadow" style="margin-top: 10px"><span style="color: white">
                                    Selamat Ulang Tahun
                                </span></h3>
                            @foreach($ultahcu as $ultah)
                                <a class="animated4 slider btn btn-system btn-medium btn-min-block text-shadow" style="margin-top: 20px"
                                   href="{{ route('cuprimer_detail',array($ultah->id)) }}">{{ 'CU ' . $ultah->name }}</a>
                            @endforeach
                            <hr class="animated5 text-shadow" />
                            <p class="animated8 text-shadow" style="font-size: medium;color: #ccc">
                                Semoga semakin bertumbuh dan berkembang bersama anggota serta semakin unggul dalam
                                memberdayakan dan mensejahterakan masyarakat dengan semangat dan jiwa Credit Union
                            </p>
                        </div>
                    </div>
                </div>
            @endif
            <?php $imagepath = 'images_artikel/';?>
            @foreach($artikelpilihans as $artikelpilihan)
                <div class="item">
                    <div class="black">
                        @if(!empty($artikelpilihan->gambar) && is_file($imagepath.$artikelpilihan->gambar."b.jpg"))
                            {{ Html::image($imagepath.$artikelpilihan->gambar.'b.jpg',$artikelpilihan->judul,
                                array('class' => 'img-responsive ')) }}
                        @else
                            {{ Html::image('images/image-articleb.jpg', $artikelpilihan->judul, array(
                                'class' => 'img-responsive')) }}
                        @endif
                    </div>
                    <div class="slider-content">
                        <div class="col-md-12 text-center" style="padding-right: 60px;padding-left: 60px;padding-top: -60px">
                            <?php $min=2;$max=8;$random1 = mt_rand($min,$max);$random2 = mt_rand($min,$max);
                            $random3 = mt_rand($min,$max);?>
                            <h3 class="animated{{ $random1 }}">
                                <span class="text-shadow">
                                    <a href="{{ route('artikel_detail',array($artikelpilihan->id)) }}" style="color: white">
                                    {{ str_limit($artikelpilihan->judul,50) }}
                                </span>
                            </h3>
                            <hr class="animated{{ $random2 }} text-shadow" />
                            <p class="animated{{ $random3 }} text-shadow" style="font-size: medium">
                                <a href="{{ route('artikel_detail',array($artikelpilihan->id)) }}" style="color: #ccc">
                                {{ str_limit(preg_replace('/(<.*?>)|(&.*?;)/', '', $artikelpilihan->content),200) }}
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{--carousel inner--}}

        {{--controls--}}
        <a class="left carousel-control" href="#main-slide" data-slide="prev">
            <span><i class="fa fa-angle-left"></i></span>
        </a>
        <a class="right carousel-control" href="#main-slide" data-slide="next">
            <span><i class="fa fa-angle-right"></i></span>
        </a>
        {{--controls--}}
    </div>
</section>
<div class="visible-xs-inline">
    <div class="page-banner " style="padding:40px 0; background: url(images/slide-02-bg.jpg) center #f9f9f9;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Selamat Datang Di Puskopdit BKCU Kalimantan</h2>
                    <p>Sebuah gerakan Credit Union yang terdiri dari Credit Union di Nusantara yang memiliki
                        kesamaan semangat dan jiwa dalam mensejahterakan masyarakat sekitar.</p>
                </div>
            </div>
        </div>
    </div>
</div>
{{--slider--}}
{{--content--}}
<div id="content">
    <div class="container">
    <div class="big-title text-center" data-animation="fadeInDown" data-animation-delay="01">
        <h1>Bidang <strong>Pelayanan</strong> yang kami berikan</h1>
    </div>
    <p class="text-center">Puskopdit BKCU Kalimantan hadir menawarkan pelayanan dalam bidang-bidang yang
        diyakini dapat membantu mewujudkan visi dan misi sejati Credit Union</p>
    {{--layanan--}}
    <div class="row">
        <div class="col-md-4 col-sm-6 service-box service-center">
            <a href="{{ route('pelayanan') }}">
            <div class="service-boxed">
                <div class="service-icon" style="margin-top:-25px;">
                    <i class="fa fa-money icon-medium-effect icon-effect-2"></i>
                </div>
                <div class="service-content">
                    <h4>Keuangan</h4>
                    <p>Terdiri dari Operasional Umum dan Silang Pinjam Daerah yang terdiri dari SIKODIT,
                       SIKLUS, Pinjaman Umum, Aktiva Tetap, Likuiditas, dan Siklus.</p>
                </div>
            </div>
            </a>
        </div>
        <div class="col-md-4 col-sm-6 service-box service-center">
            <a href="{{ route('pelayanan') }}">
            <div class="service-boxed">
                <div class="service-icon" style="margin-top:-25px;">
                    <i class="fa fa-life-ring icon-medium-effect icon-effect-2"></i>
                </div>
                <div class="service-content">
                    <h4>JALINAN</h4>
                    <p>Berfungsi mengelola resiko atas perlindungan simpanan dan piutang anggota CU yang
                       terdiri dari 2 produk yaitu TUNAS dan LINTANG</p>
                </div>
            </div>
            </a>
        </div>
        <div class="col-md-4 col-sm-6 service-box service-center">
            <a href="{{ route('pelayanan') }}">
            <div class="service-boxed">
                <div class="service-icon" style="margin-top:-25px;">
                    <i class="fa fa-users icon-medium-effect icon-effect-2"></i>
                </div>
                <div class="service-content">
                    <h4>NON KEUANGAN</h4>
                    <p>Terdiri dari DIKLAT, Audit dan Monitoring, Penelitian dan Pengembangan,
                        Teknologi Informasi serta Administrasi Umum. </p>
                </div>
            </div>
            </a>
        </div>
    </div>
    {{--layanan--}}
    <div class="hr1 margin-top"></div>
    {{--berita--}}
    <div class="row latest-posts-classic">
        <div class="col-md-12">
            <h4 class="classic-title"><span>Berita Terbaru</span></h4>
        </div>
        <?php $imagepath = 'images_artikel/';?>
        @foreach($beritaBKCUs as $bkcu)
            <div class="col-md-4 col-sm-6">
                <div class="post-row portfolio-item">
                    <div class="portfolio-thumb" style="padding-bottom: 1em">
                        @if(!empty($bkcu->gambar) && is_file($imagepath.$bkcu->gambar."n.jpg"))
                            <a class="lightbox" title="{{ $bkcu->judul }}" href="{{ asset($imagepath.$bkcu->gambar.".jpg") }}">
                                <div class="thumb-overlay"><i class="fa fa-arrows-alt"></i></div>
                                <img class="img-responsive"
                                     src="{{$imagepath.$bkcu->gambar.'n.jpg'}}" alt="{{$bkcu->judul}}" />
                            </a>
                        @else
                            <a class="lightbox" title="{{ $bkcu->judul }}" href="{{ asset('images/image-article.jpg') }}">
                                <div class="thumb-overlay"><i class="fa fa-arrows-alt"></i></div>
                                <img class="img-responsive"
                                     src="{{'images/image-articlen.jpg'}}" alt="{{$bkcu->judul}}" />
                            </a>
                        @endif
                    </div>
                    <h4 style="border-bottom: thin solid #00afd1 ;padding-bottom:1em;">
                        <a href="{{ route('artikel_detail',array($bkcu->id)) }}">{{ $bkcu->judul}}</a>
                        <?php $date = new Date($bkcu->created_at); ?>
                        <br/><small>
                            <i class="fa fa-fw fa-calendar"></i> {{ $date->format('l, j F Y, H:i') }}
                            &nbsp&nbsp&nbsp
                            <i class="fa fa-fw fa-user"></i> {{ $bkcu->penulis }}
                        </small>
                    </h4>
                    <p>
                        <a href="{{ route('artikel_detail',array($bkcu->id)) }}" style="color:#666;">
                            {{ str_limit(preg_replace('/(<.*?>)|(&.*?;)/', '', $bkcu->content),200) }}
                        </a>
                    </p>
                </div>
            </div>
        @endforeach
    </div>
    {{--berita--}}
    </div>
</div>
{{--kegiatan--}}
<?php
$min=1;
$max=3;
$random = mt_rand($min,$max); ?>

<div class="section @if($random == 1){{ "purchase1" }}@elseif($random == 2){{ "purchase2" }}@else{{ "purchase3" }}@endif">
    <div class="container">
        <div class="section-video-content text-center">
            <h1 class="fittext wite-text uppercase tlt">
                  <span class="texts">
                        <span>dimulai dengan</span>
                        <span>berkembang melalui</span>
                        <span>dikontrol oleh</span>
                        <span>bergantung pada</span>
                  </span>
                  <strong>pendidikan</strong><hr/> mari kita mengembangkan potensi dalam diri dengan mengikuti pelatihan
            </h1>
            <a href="{{ route('kegiatan') }}" class="btn-system btn-large"><i class="fa fa-tasks"></i> Lihat Jadwal</a>
        </div>
    </div>
</div>
{{--kegiatan--}}
{{--about--}}
<div class="section" style="padding-top:60px; padding-bottom:60px; border-top:1px solid #eee; border-bottom:1px solid #eee; background:#f9f9f9;">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="big-title">
                    <h1><strong>Tentang</strong> Credit Union</h1>
                    <p class="title-desc">Apa itu Credit Union?</p>
                </div>
                <p>Credit Union (CU) adalah lembaga yang dimiliki oleh sekumpulan orang yang saling percaya dalam ikatan pemersatu, yang
                    bersepakat untuk menabungkan uang mereka sehingga menciptakan modal bersama guna dipinjamkan di antara sesama mereka dengan bunga
                    yang layak untuk tujuan produktif dan kesejahteraan.<br/>
                </p>
                <div class="visible-lg-inline"><p>Credit Union memiliki beberapa nilai dasar yaitu</p>
                    <div class="hr1" style="margin-bottom:14px;"></div>
                    <div class="row">
                        <div class="col-md-4">
                            <ul class="icons-list">
                                <li><i class="fa fa-check-circle"></i> Keadilan</li>
                                <li><i class="fa fa-check-circle"></i> Integritas</li>
                                <li><i class="fa fa-check-circle"></i> Profesionalisme</li>
                                <li><i class="fa fa-check-circle"></i> Bertanggungjawab</li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <ul class="icons-list">
                                <li><i class="fa fa-check-circle"></i> Kerjasama</li>
                                <li><i class="fa fa-check-circle"></i> Perayaan.</li>
                                <li><i class="fa fa-check-circle"></i> Saling Menghormati.</li>
                                <li><i class="fa fa-check-circle"></i> Tanggung gugat .</li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <ul class="icons-list">
                                <li><i class="fa fa-check-circle"></i> Integrasi</li>
                                <li><i class="fa fa-check-circle"></i> Inovasi.</li>
                            </ul>
                        </div>
                    </div>
                    <div class="hr1" style="margin-bottom:20px;"></div>
                </div>
                <br/>
            </div>
            <div class="col-md-6 portfolio-item">
                <div class="portfolio-thumb ">
                <a class="lightbox" data-lightbox-type="ajax" title="Strategic Planning Tahun Buku 2016 - 2020" href="{{ asset('images/tentang_cu.jpg') }}">
                    <div class="thumb-overlay"><i class="fa fa-arrows-alt"></i></div>
                    <img src="{{ asset('images/tentang_cu.jpg') }}" width="800" height="450">
                </a>
                </div>
            </div>
        </div>
    </div>
</div>
{{--about--}}
{{--cu--}}
<div id="content">
    <div class="container">
        <div class="row">
            <div class="big-title text-center">
                <h1><strong>Credit Union</strong> Primer</h1>
                <p class="title-desc">Credit Union yang tergabung dalam jaringan Puskopdit BKCU Kalimantan</p>
            </div>
            <div class="col-md-12">
                <div class="recent-projects">
                    <div class="projects-carousel touch-carousel navigation-3">
                        <?php $imagepath = 'images_cu/';?>
                        @foreach($cuprimers as $cuprimer)
                            <div class="portfolio-item item">
                                <div class="portfolio-border">
                                    <div class="portfolio-thumb ">
                                        @if(!empty($cuprimer->gambar) && is_file($imagepath.$cuprimer->gambar."n.jpg"))
                                            <a class="lightbox" data-lightbox-type="ajax" title="{{ 'CU '.$cuprimer->name }}" href="{{ asset($imagepath.$cuprimer->gambar.".jpg") }}">
                                                <div class="thumb-overlay"><i class="fa fa-arrows-alt"></i></div>
                                                <img class="img-responsive"
                                                     src="{{$imagepath.$cuprimer->gambar.'n.jpg'}}" alt="{{$cuprimer->name}}" />
                                            </a>
                                        @else
                                            <a class="lightbox" data-lightbox-type="ajax" title="{{ 'CU '.$cuprimer->name }}" href="{{ asset('images/image-cu.jpg') }}">
                                                <div class="thumb-overlay"><i class="fa fa-arrows-alt"></i></div>
                                                <img class="img-responsive"
                                                     src="{{'images/image-cu.jpg'}}" alt="{{$cuprimer->name}}" />
                                            </a>
                                        @endif
                                    </div>
                                    <div class="portfolio-details">
                                        <a href="{{ route('cuprimer_detail',array($cuprimer->id)) }}">
                                            @if(!empty($cuprimer->name))
                                                <h4>CU {{ $cuprimer->name }}</h4>
                                            @endif
                                            @if(!empty($cuprimer->wilayahcuprimer->name))
                                                <span>{{$cuprimer->wilayahcuprimer->name}}</span>
                                            @endif
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @if(!empty($ultahcu))
        <div class="hr1" style="margin-bottom:40px;"></div>
        <div class="row">
            <div class="col-md-12">
                <div class="call-action call-action-boxed call-action-style2 clearfix">
                        <div class="button-side" style="margin-top:4px;">
                            <a href="{{ asset('images/birthday-card.jpg') }}"
                               title="Selamat Ulang Tahun Ke kepada Mbr/
               @foreach($ultahcu as $ultah)
                               {{ 'CU '.$ultah->name .' '}}
                               @endforeach
                                       Semoga Semakin Maju dan Terus Berkarya" target="_blank"
                               class="btn-system border-btn btn-medium lightbox">Happy Birthday!!</a></div>
                        <h2 class="primary">Selamat Ulang Tahun Kepada <br/> <strong>
                                @foreach($ultahcu as $ultah)
                                    {{ 'CU '.$ultah->name .' '}}
                                @endforeach
                            </strong></h2>
                        <p>Kami seluruh jajaran Pengurus, Pengawas, Komite dan Manajemen Puskopdit BKCU Kalimantan mengucapkan
                            <br/>
                            Selamat Ulang Tahun dan Semoga semakin bertumbuh dan berkembang bersama anggota serta semakin unggul dalam
                            memberdayakan dan mensejahterakan masyarakat dengan semangat dan jiwa Credit Union</p>
                    </div>
            </div>
        </div>
        @endif
    </div>
</div>
{{--cu--}}


@stop

@section('javascript')
{{ Html::script('js/jquery.parallax.js') }}
@stop