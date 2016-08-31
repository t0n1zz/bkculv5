<?php
$cusidebars = App\Models\Cuprimer::orderBy('name','asc')->get();
?>
<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu">
            <!-- Sidebar user panel -->
            {{--<div class="user-panel">--}}
                {{--<?php--}}
                    {{--$gambar = Auth::user()->getGambar();--}}
                    {{--$imagepath = 'images/';--}}
                {{--?>--}}
                {{--@if(!empty($gambar) && is_file($imagepath.$gambar.".jpg"))--}}
                    {{--<div class="pull-left image">--}}
                        {{--<img src="{!! asset($imagepath.$gambar.".jpg") !!}" class="img-circle" alt="User Image" />--}}
                    {{--</div>--}}
                {{--@else--}}
                    {{--<div class="pull-left image">--}}
                        {{--<img src="{!! asset($imagepath."user.png") !!}" class="img-circle" alt="User Image" />--}}
                    {{--</div>--}}
                {{--@endif--}}
                {{--<div class="pull-left info">--}}
                    {{--<p><small>{!! Auth::user()->getName() !!}</small></p>--}}
                    {{--<p><i class="fa fa-circle text-success"></i> Online</p>--}}
                {{--</div>--}}
            {{--</div>--}}
            <!-- Sidebar user panel -->
            <!-- search form -->
           <!--  <form action="#" method="get" class="sidebar-form">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
                </div>
            </form> -->
            <!-- /.search form -->
            {{--<li class="header"><b>&nbsp;</b></li>--}}
            <!-- dashboard -->
            <li {{ Request::is('admins') ? 'class=active' : '' }}>
                <a href="{{ URL::to('admins')  }}"><i class="fa fa-dashboard fa-fw"></i> <span>Dashboard</span></a>
            </li>
            <!-- /dashboard -->
            <!-- pengumuman -->
            @if(Entrust::can('pengumuman'))
                <li {!! Request::is('admins/pengumuman') ? 'class="active"' : '' !!}>
                    <a href="{!! route('admins.pengumuman.index') !!}"><i class="fa fa-comments-o fa-fw"></i> <span>Pengumuman</span></a>
                </li>
            @endif
            <!-- /pengumuman -->
            <!-- saran -->
            @if(Entrust::can('saran'))
                <li {!! Request::is('admins/saran') ? 'class="active"' : '' !!}>
                    <a href="{!! route('admins.saran.index') !!}"><i class="fa fa-paper-plane-o fa-fw"></i> <span>Saran atau Kritik</span></a>
                </li>
            @endif
            <!-- /saran -->
            <!-- artikel -->
            @if(Entrust::can('artikel'))
                <li {!! Request::is('admins/artikel') || Request::is('admins/artikel*') || Request::is('admins/kategoriartikel') ? 'class="treeview active"' : 'class=treeview' !!} >
                    <a href="#"><i class="fa fa-book fa-fw"></i> <span>Artikel</span> <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                    <ul {{ Request::is('admins/artikel*') ? 'class=treeview-menu menu open style=display:block;' : 'class=treeview-menu' }}>
                        <li {!! Request::is('admins/artikel/create') ? 'class="treeview active"' : '' !!} >
                            <a  href="{!! route('admins.artikel.create') !!}"><i class="fa fa-plus"></i> Tambah Artikel</a>
                        </li>
                        <li {!! Request::is('admins/artikel') ? 'class="treeview active"' : '' !!} >
                            <a  href="{!! route('admins.artikel.index') !!}"><i class="fa fa-archive"></i> Kelola Artikel</a>
                        </li>
                        @if(Entrust::can('kategoriartikel'))
                            <li {!! Request::is('admins/kategoriartikel') ? 'class="treeview active"' : '' !!} >
                                <a  href="{!! route('admins.kategoriartikel.index') !!}"><i class="fa fa-archive"></i> Kelola Kategori Artikel</a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif
            <!-- /artikel -->
            <!-- kegiatan -->
            @if(Entrust::can('kegiatan'))
                <li {!! Request::is('admins/kegiatan') || Request::is('admins/kegiatan*') ? 'class="treeview active"' : 'class=treeview' !!} >
                    <a href="#"><i class="fa fa-calendar fa-fw"></i> <span>Kegiatan</span> <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                    <ul {{ Request::is('admins/kegiatan*') ? 'class=treeview-menu menu open style=display:block;' : 'class=treeview-menu' }}>
                        <li {!! Request::is('admins/kegiatan/create') ? 'class="treeview active"' : '' !!} >
                            <a href="{!! route('admins.kegiatan.create') !!}"><span class="fa fa-plus"></span> Tambah Kegiatan</a>
                        </li>
                        <li {!! Request::is('admins/kegiatan') ? 'class="treeview active"' : '' !!} >
                            <a href="{!! route('admins.kegiatan.index') !!}"><span class="fa fa-archive"></span> Kelola Kegiatan</a>
                        </li>
                    </ul>
                </li>
            @endif
            <!-- /kegiatan -->
            <!-- cuprimer -->
            @if(Entrust::can('cuprimer'))
                <li {!! Request::is('admins/cuprimer') || Request::is('admins/cuprimer*') || Request::is('admins/wilayahcuprimer')
                    || Request::is('admins/perkembangancu')|| Request::is('admins/perkembangancu*') || Request::is('admins/tpcu*') ? 'class="treeview active"' : 'class=treeview' !!} >
                    <a href="#"><i class="fa fa-building-o fa-fw"></i> <span>CU</span> <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                    <ul {{ Request::is('admins/cuprimer*') ? 'class=treeview-menu menu open style=display:block;' : 'class=treeview-menu' }}>
                        <li {!! Request::is('admins/cuprimer/create') ? 'class="treeview active"' : '' !!} >
                            <a href="{!! route('admins.cuprimer.create') !!}"><span class="fa fa-plus"></span> Tambah CU</a>
                        </li>
                        <li {!! Request::is('admins/tpcu/create') ? 'class="treeview active"' : '' !!} >
                            <a  href="{!! route('admins.tpcu.create') !!}"><i class="fa fa-plus"></i> Tambah TP CU</a>
                        </li>
                        <li {!! Request::is('admins/perkembangancu/create') ? 'class="treeview active"' : '' !!} >
                            <a  href="{!! route('admins.perkembangancu.create') !!}"><i class="fa fa-plus"></i> Tambah Perkembangan CU</a>
                        </li>
                        <li {!! Request::is('admins/cuprimer') ? 'class="treeview active"' : '' !!} >
                            <a href="{!! route('admins.cuprimer.index') !!}"><span class="fa fa-archive"></span> Kelola CU</a>
                        </li>
                        <li {!! Request::is('admins/tpcu') ? 'class="treeview active"' : '' !!} >
                            <a href="{!! route('admins.tpcu.index') !!}"><i class="fa fa-archive"></i> Kelola TP CU</a></li>
                        @if(Entrust::can('wilayahcuprimer'))
                            <li {!! Request::is('admins/wilayahcuprimer') ? 'class="treeview active"' : '' !!} >
                                <a href="{!! route('admins.wilayahcuprimer.index') !!}"><span class="fa fa-archive"></span> Kelola Wilayah CU</a>
                            </li>
                        @endif
                        <li {!! Request::is('admins/perkembangancu') || Request::is('admins/perkembangancu*') ? 'class="treeview active"' : '' !!} >
                            <a href="{!! route('admins.perkembangancu.index') !!}"><i class="fa fa-archive"></i> Kelola Perkembangan CU</a></li>
                    </ul>
                </li>
            @endif
            <!-- /cuprimer -->
            <!-- staf -->
            @if(Entrust::can('staff'))
                <li {!! Request::is('admins/staf') || Request::is('admins/staf*') ? 'class="treeview active"' : 'class=treeview' !!} >
                    <a href="#"><i class="fa fa-sitemap fa-fw"></i> <span>Staf</span> <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                    <ul {{ Request::is('admins/staf*') ? 'class=treeview-menu menu open style=display:block;' : 'class=treeview-menu' }}>
                        <li {!! Request::is('admins/staf/create') ? 'class="treeview active"' : '' !!} >
                            <a href="{!! route('admins.staf.create') !!}"><span class="fa fa-plus"></span> Tambah Staf</a>
                        </li>
                        <li {!! Request::is('admins/staf') ? 'class="treeview active"' : '' !!} >
                            <a href="{!! route('admins.staf.index') !!}"><i class="fa fa-archive"></i> Kelola staf</a></li>
                    </ul>
                </li>
            @endif
            <!-- /staf -->
            <!-- download -->
            @if(Entrust::can('download'))
                <li {!! Request::is('admins/download') || Request::is('admins/download*') ? 'class="treeview active"' : 'class=treeview' !!} >
                    <a href="#"><i class="fa fa-download fa-fw"></i> <span>Download</span> <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                    <ul {{ Request::is('admins/download*') ? 'class=treeview-menu menu open style=display:block;' : 'class=treeview-menu' }}>
                        <li {!! Request::is('admins/download/create') ? 'class="treeview active"' : '' !!} >
                            <a href="{!! route('admins.download.create') !!}"><span class="fa fa-plus"></span> Tambah File</a>
                        </li>
                        <li {!! Request::is('admins/download') ? 'class="treeview active"' : '' !!} >
                            <a href="{!! route('admins.download.index') !!}"><span class="fa fa-archive"></span> Kelola File</a>
                        </li>
                    </ul>
                </li>
            @endif
            <!-- /download -->
            <!-- admin -->
            @if(Entrust::can('admin'))
                <li {!! Request::is('admins/admin') || Request::is('admins/admin*') ? 'class="treeview active"' : 'class=treeview' !!} >
                <a href="#"><i class="fa fa-user fa-fw"></i> <span>Admin</span> <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                    <ul {{ Request::is('admins/admin*') ? 'class=treeview-menu menu open style=display:block;' : 'class=treeview-menu' }}>
                        <li {!! Request::is('admins/admin/create') ? 'class="treeview active"' : '' !!} >
                        <a href="{!! route('admins.admin.create') !!}"><span class="fa fa-plus"></span> Tambah Admin</a>
                    </li>
                        <li {!! Request::is('admins/admin') ? 'class="treeview active"' : '' !!} >
                        <a href="{!! route('admins.admin.index') !!}"><span class="fa fa-archive"></span> Kelola Admin</a>
                    </li>
                </ul>
                </li>
            @endif
            <!-- /admin -->
            {{--<li class="header"><b>&nbsp;</b></li>--}}
            <!-- foto kegiatan -->
            @if(Entrust::can('gambarkegiatan'))
                <li>
                    <a href="https://login.yahoo.com/config/login?.src=flickrsignin&.pc=8190&.scrumb=0&.pd=c%3DH6T9XcS72e4mRnW3NpTAiU8ZkA--&.intl=id&.lang=en&mg=1&.done=https%3A%2F%2Flogin.yahoo.com%2Fconfig%2Fvalidate%3F.src%3Dflickrsignin%26.pc%3D8190%26.scrumb%3D0%26.pd%3Dc%253DJvVF95K62e6PzdPu7MBv2V8-%26.intl%3Did%26.done%3Dhttps%253A%252F%252Fwww.flickr.com%252Fsignin%252Fyahoo%252F%253Fredir%253Dhttps%25253A%25252F%25252Fwww.flickr.com%25252F"
                       target="_blank"><i class="fa fa-picture-o fa-fw"></i> <span>Foto Kegiatan</span></a>
                </li>
            @endif
            <!-- /foto kegiatan -->
            <li @if($title == "Version" ){!! "class='treeview active'" !!}@endif>
                <a href="{!! route('admins.version') !!}"><i class="fa fa-th-list fa-fw"></i> <span>Version</span></a>
            </li>
        </ul>
    </section>
</aside>
