<?php
$currentpage = $_SERVER['REQUEST_URI'];
?>
<div class="hidden-header"></div>
<header class="clearfix">
    {{--top bar--}}
    <div class="top-bar dark-bar">
        <div class="marquee" style="padding: 5px 10px;border-bottom: 1px solid white;color: white;">
            <?php $i = 0; ?>
            @foreach($pengumumans as $pengumuman)
                @if($i == 0) {!!'<i class="fa fa-fw fa-circle"></i>'!!}@endif
                <b>{!! $pengumuman->name !!}</b>
                <?php $i++; ?>
                @if($i < $pengumumans->count()) {!!'<i class="fa fa-fw fa-circle"></i>'!!}@endif
            @endforeach
        </div>
    </div>
    {{--top bar--}}

    {{--logo & navigation--}}
    <div class="navbar navbar-default navbar-top">
        <div class="container">
            <div class="navbar-header">
                {{--mobile menu--}}
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <i class="fa fa-bars"></i>
                </button>
                {{--mobile menu--}}
                <a class="navbar-brand" href="{{ route('home') }}">
                    <div class="hidden-xs">
                        <img alt="" src="{{ asset('images/logo3.png') }}">
                    </div>
                    <div class="visible-xs-inline">
                        <img alt="" src="{{ asset('images/logo4.png') }}">
                    </div>
                </a>
            </div>
            <div class="navbar-collapse collapse">
                {{--search--}}
                {{--<div class="search-side">--}}
                    {{--<a class="show-search"><i class="fa fa-search"></i></a>--}}
                    {{--<div class="search-form">--}}
                        {{--<form autocomplete="off" role="search" method="get" class="searchform" action="#">--}}
                            {{--<input type="text" value="" name="s" id="s" placeholder="Search the site...">--}}
                        {{--</form>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--search--}}
                @if(\Request::is('cu/*') || \Request::is('cu'))
                {{--cu--}}
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{ route('home') }}" @if($currentpage == "/") {{'class="active"'}} @endif>Home</a></li>
                    <li><a href="{{ route('cu') }}" @if($currentpage == "/cu") {{'class="active"'}} @endif>Dashboard</a></li>
                    <li><a href="{{ route('cu.kelola_kegiatan') }}" @if($currentpage == "/cu/kelola_kegiatan") {{'class="active"'}} @endif>DIKLAT</a></li>
                    <li>
                        <a href="#"
                        @if($currentpage == "/cu/edit_info" || $currentpage == "/cu/edit_deskripsi")
                            {{'class="active"'}}
                                @endif>CU</a>
                        <ul class="dropdown">
                            <li><a href="{{ route('cu.edit_deskripsi') }}" @if($currentpage == "/cu/edit_deskripsi") {{'class="active"'}} @endif
                                        >Profil</a></li>
                            <li><a href="{{ route('cu.edit_info') }}" @if($currentpage == "/cu/edit_info") {{'class="active"'}} @endif
                                        >Informasi Umum</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"
                        @if($currentpage == "/cu/kelola_staf")
                            {{'class="active"'}}
                                @endif>Staf</a>
                        <ul class="dropdown">
                            <li><a href="{{ route('cu.create_staf') }}" @if($currentpage == "/cu/create_staf") {{'class="active"'}} @endif
                                        >Tambah Staf</a></li>
                            <li><a href="{{ route('cu.kelola_staf') }}" @if($currentpage == "/cu/kelola_staf") {{'class="active"'}} @endif
                                        >Kelola Staf</a></li>
                        </ul>
                    </li>
                    <li><a href="{{ route('cu.logout') }}">Logout</a></li>
                </ul>
                {{--cu--}}
                @else
                {{--public--}}
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{ route('home') }}" @if($currentpage == "/") {{'class="active"'}} @endif>Home</a></li>
                    <li><a href="{{ route('kegiatan') }}" @if($currentpage == "/kegiatan") {{'class="active"'}} @endif>Kegiatan</a></li>
                    <li>
                        <a href="#"
                        @if($currentpage == "/artikel/0" || $currentpage == "/artikel/2" || $currentpage == "/artikel/5" ||
                            $currentpage == "/artikel/6" || $currentpage == "/artikel/7" || $currentpage == "/artikel/9")
                            {{'class="active"'}}
                        @endif>Berita </a>
                        <ul class="dropdown">
                            <li><a href="{{ route('artikel',array(0)) }}" @if($currentpage == "/artikel/0") {{'class="active"'}} @endif
                                        >Semua Berita</a></li>
                            @foreach($navberita as $berita)
                                <li><a href="{{ route('artikel',array($berita->id)) }}" @if($currentpage == "/artikel/$berita->id") {{'class="active"'}} @endif
                                            >{{$berita->name}}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    <li>
                        <a href="#"
                        @if($currentpage == "/profil" || $currentpage == "/pengurus" || $currentpage == "/pengawas" ||
                            $currentpage == "/manajemen" || $currentpage == "/pelayanan" || $currentpage == "/cuprimer" ||
                            $currentpage == "/artikel/4" || $currentpage == "/artikel/8")
                            {{'class="active"'}}
                        @endif>Tentang Kami </a>
                        <ul class="dropdown">
                            <li><a href="{{ route('profil') }}" @if($currentpage == "/profil") {{'class="active"'}} @endif>Profil</a></li>
                            <li><a href="{{ route('pengurus') }}" @if($currentpage == "/pengurus") {{'class="active"'}} @endif>Pengurus</a></li>
                            <li><a href="{{ route('pengawas') }}" @if($currentpage == "/pengawas") {{'class="active"'}} @endif>Pengawas</a></li>
                            <li><a href="{{ route('manajemen') }}" @if($currentpage == "/manajemen") {{'class="active"'}} @endif>Manajemen</a></li>
                            <li><a href="{{ route('pelayanan') }}" @if($currentpage == "/pelayanan") {{'class="active"'}} @endif>Pelayanan</a></li>
                            <li><a href="{{ route('cuprimer') }}" @if($currentpage == "/cuprimer") {{'class="active"'}} @endif>Credit Union</a></li>
                            <li><a href="{{ route('artikel',array(4)) }}" @if($currentpage == "/artikel/4") {{'class="active"'}} @endif>Filosofi</a></li>
                            <li><a href="{{ route('artikel',array(8)) }}" @if($currentpage == "/artikel/8") {{'class="active"'}} @endif>Sejarah</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"
                        @if($currentpage == "/download" || $currentpage == "/hymnecu")
                            {{'class="active"'}}
                        @endif>Lain-lain </a>
                        <ul class="dropdown">
                            <li><a href="{{ route('download') }}" @if($currentpage == "/download") {{'class="active"'}} @endif>Download</a></li>
                            <li><a href="https://www.flickr.com/photos/127271987@N07/" target="_BLANK">Foto Kegiatan</a></li>
                            <li><a href="{{ route('hymnecu') }}" @if($currentpage == "/hymnecu") {{'class="active"'}} @endif>Hymne CU</a></li>
                        </ul>
                    </li>
                    <!-- <li><a href="{{ route('cu.login') }}" @if($currentpage == "/cu/login") {{'class="active"'}} @endif>Login</a></li> -->
                </ul>
                {{--public--}}
                @endif
            </div>
        </div>

        {{--mobile menu--}}
        <ul class="wpb-mobile-menu">
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="{{ route('kegiatan') }}">Kegiatan</a></li>
            <li>
                <a href="#">Berita </a>
                <ul class="dropdown">
                    <li><a href="{{ route('artikel',array(0)) }}">Semua Berita</a></li>
                    @foreach($navberita as $berita)
                        <li><a href="{{ route('artikel',array($berita->id)) }}">{{$berita->name}}</a></li>
                    @endforeach
                </ul>
            </li>
            <li>
                <a href="#" >Tentang Kami </a>
                <ul class="dropdown">
                    <li><a href="{{ route('profil') }}">Profil</a></li>
                    <li><a href="{{ route('pengurus') }}">Pengurus</a></li>
                    <li><a href="{{ route('pengawas') }}">Pengawas</a></li>
                    <li><a href="{{ route('manajemen') }}">Manajemen</a></li>
                    <li><a href="{{ route('pelayanan') }}">Pelayanan</a></li>
                    <li><a href="{{ route('cuprimer') }}">CU Primer</a></li>
                    <li><a href="{{ route('artikel',array(4)) }}">Filosofi</a></li>
                    <li><a href="{{ route('artikel',array(8)) }}">Sejarah</a></li>
                </ul>
            </li>
            <li>
                <a href="#" >Lain-lain </a>
                <ul class="dropdown">
                    <li><a href="{{ route('download') }}">Download</a></li>
                    <li><a href="https://www.flickr.com/photos/127271987@N07/" target="_BLANK">Foto Kegiatan</a></li>
                    <li><a href="{{ route('hymnecu') }}">Hymne CU</a></li>
                </ul>
            </li>
            <!-- <li><a href="{{ route('cu.login') }}">Login</a> </li> -->
        </ul>
    </div>

</header>


