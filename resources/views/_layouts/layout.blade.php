<?php
    $pengumumans = App\Models\Pengumuman::orderBy('urutan','asc')->get();
    $currentpage = $_SERVER['REQUEST_URI'];
    $navberita = App\Models\KategoriArtikel::whereNotIn('id',array(1,4,8))->get();
/*
    if (Auth::check()) {
        Auth::logout();
    }
*/
?>
<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><html lang="en" class="no-js"> <![endif]-->
<html lang="en">
<head>
    <title>Puskopdit BKCU Kalimantan</title>
    <link rel="shortcut icon" href="{{ asset('images/logo.png') }}">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="author" content="Laurensius">
    <meta property="og:type" content="website" />
    <meta property="fb:app_id" content="296017390598287" />

    @if(!empty($detail_artikel))
        <title>Puskopdit BKCU Kalimantan | {{ $detail_artikel->judul }}</title>
        <!-- Facebook Open Graph Meta Tags -->
        <meta property="og:title" content="{{ $detail_artikel->judul }}" />
        <meta property="og:url" content="{{Request::url()}}" />
        <meta property="og:image" content="{{ asset('images_artikel/'.$detail_artikel->gambar.'.jpg') }}" />
        <meta property="og:description" content="{{ str_limit(preg_replace('/(<.*?>)|(&.*?;)/', '', $detail_artikel->content),200) }}" />
    @elseif(!empty($artikels))
        <title>Puskopdit BKCU Kalimantan | Artikel</title>
        <meta name="description" content="
        Artikel yang berisi informasi dan berita seputar Puskopdit BKCU Kalimantan, Credit Union Primer
        dalam jaringan kami, dan mengenai Credit Union secara umum.
        ">
    @elseif($currentpage =="/kegiatan")
        <title>Puskopdit BKCU Kalimantan | Kegiatan</title>
        <meta name="description" content="
        Kegiatan yang diselenggarakan oleh Puskopdit BKCU .
        ">
    @elseif($currentpage =="/profil")
        <title>Puskopdit BKCU Kalimantan | Profil</title>
        <meta name="description" content="
        Sebuah gerakan Credit Union yang terdiri dari Credit Union di Nusantara yang memiliki
        kesamaan semangat dan jiwa dalam mensejahterakan masyarakat sekitar.
        ">
    @elseif($currentpage =="/pengurus")
        <title>Puskopdit BKCU Kalimantan | Pengurus</title>
        <meta name="description" content="
        Sebuah gerakan Credit Union yang terdiri dari Credit Union di Nusantara yang memiliki
        kesamaan semangat dan jiwa dalam mensejahterakan masyarakat sekitar.
        ">
    @elseif($currentpage =="/pengawas")
        <title>Puskopdit BKCU Kalimantan | Pengawas</title>
        <meta name="description" content="
        Sebuah gerakan Credit Union yang terdiri dari Credit Union di Nusantara yang memiliki
        kesamaan semangat dan jiwa dalam mensejahterakan masyarakat sekitar.
        ">
    @elseif($currentpage =="/manajemen")
        <title>Puskopdit BKCU Kalimantan | Manajemen</title>
        <meta name="description" content="
        Sebuah gerakan Credit Union yang terdiri dari Credit Union di Nusantara yang memiliki
        kesamaan semangat dan jiwa dalam mensejahterakan masyarakat sekitar.
        ">
    @else
        <title>Puskopdit BKCU Kalimantan | Home</title>
        <meta name="description" content="
        Sebuah gerakan Credit Union yang terdiri dari Credit Union di Nusantara yang memiliki
                            kesamaan semangat dan jiwa dalam mensejahterakan masyarakat sekitar.
        ">
    @endif

    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" >
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" >
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Raleway:400,300,700" >
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/font-awesome/css/font-awesome.min.css')}}" >
    <link rel="stylesheet" type="text/css" href="{{asset('css/main-dist.css')}}" >
    <link rel="stylesheet" type="text/css" href="{{asset('css/owl.css')}}" >
    <link rel="stylesheet" type="text/css" href="{{asset('css/secondary-dist.css')}}" >

    @yield('css')
    <!--[if IE 8]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    <!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

    <script type="text/javascript" src="{{ URL::asset('js/main-dist.js') }}"></script>
    @yield('map')
</head>
<body >
<div id="container" class="boxed-page">


    @include('_layouts.header')
    @yield('content')

 {{--    <img class="img-responsive" src="{{ asset('images/footer/footernatal.png') }}"
       width="100%"  style="vertical-align: bottom;margin-top: -3%;"/> --}}
    @include('_layouts.footer')

            <!--modal photos-->
    <div class="modal fade" id="modalphotoshow">
        <div class="modal-body">
            <img class="pointer img-responsive center-block" src="" id="modalimage"/>
        </div>
    </div>
    <!--/modal photos-->
</div>



<!-- Go To Top Link -->
<a href="#" class="back-to-top"><i class="fa fa-angle-up"></i></a>

{{--<div id="loader">--}}
    {{--<div class="spinner">--}}
        {{--<div class="dot1"></div>--}}
        {{--<div class="dot2"></div>--}}
    {{--</div>--}}
{{--</div>--}}


@yield('javascript')
<script type="text/javascript" src="{{ URL::asset('js/script-dist.js') }}" async></script>
<script>
//    $(window).load(function () {
//        "use strict";
//        $('#loader').fadeOut();
//    })

    $(document).ready(function() {

        $('.marquee').marquee({
            pauseOnHover: false,
            //speed in milliseconds of the marquee
            duration: 20000,
            //gap in pixels between the tickers
            gap: 5,
            //time in milliseconds before the marquee will start animating
            delayBeforeStart: 0,
            //'left' or 'right'
            direction: 'left',
            //true or false - should the marquee be duplicated to show an effect of continues flow
            duplicated: true
        });

        //modal photo
        $('.modalphotos img').on('click',function(){
            $('#modalphotoshow').modal({
                show: true,
            })

            var myscr = this.src;
            $('#modalimage').attr('src',myscr);
            $('#modalimage').on('click',function(){
                $('#modalphotoshow').modal('hide')
            })
        });
    });
</script>
</body>
</html>