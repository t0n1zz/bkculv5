
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
                <li @if($title == "Kelola Pengumuman"){!! "class='active'" !!}@endif>
                    <a href="{!! route('admins.pengumuman.index') !!}"><i class="fa fa-comments-o fa-fw"></i> <span>Pengumuman</span></a>
                </li>
            @endif
            <!-- /pengumuman -->
            <!-- saran -->
            @if(Entrust::can('saran'))
                <li @if($title == "Kelola Saran atau Kritik"){!! "class='active'" !!}@endif>
                    <a href="{!! route('admins.saran.index') !!}"><i class="fa fa-paper-plane-o fa-fw"></i> <span>Saran atau Kritik</span></a>
                </li>
            @endif
            <!-- /saran -->
            <!-- artikel -->
            @if(Entrust::can('artikel'))
                <li {{ Request::is('admins/artikel') ? 'class=treeview active' : 'class=treeview' }}>
                    <a href="#"><i class="fa fa-book fa-fw"></i> <span>Artikel</span> <i class="fa fa-angle-left pull-right"></i></a>
                    <ul {{ Request::is('admins/artikel*') ? 'class=treeview-menu menu open style=display:block;' : 'class=treeview-menu' }}>
                        <li @if($title == "Tambah Artikel" ){!! "class='treeview active'" !!}@endif>
                            <a  href="{!! route('admins.artikel.create') !!}"><i class="fa fa-plus"></i> Tambah Artikel</a>
                        </li>
                        <li @if($title == "Kelola Artikel" ){!! "class='treeview active'" !!}@endif>
                            <a  href="{!! route('admins.artikel.index') !!}"><i class="fa fa-archive"></i> Kelola Artikel</a>
                        </li>
                        @if(Entrust::can('kategoriartikel'))
                            <li @if($title == "Kelola Kateogri Artikel" ){!! "class='treeview active'" !!}@endif>
                                <a  href="{!! route('admins.kategoriartikel.index') !!}"><i class="fa fa-archive"></i> Kelola Kategori Artikel</a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif
            <!-- /artikel -->
            <!-- diklat -->
            @if(Entrust::can('kegiatan'))
                <li @if($title == "Kelola Kegiatan" || $title == "Tambah Kegiatan" || $title == "Ubah Kegiatan" )
                        {!! "class='treeview active'" !!}
                    @else
                        {!! "class='treeview'" !!}
                    @endif>
                    <a href="#"><i class="fa fa-calendar fa-fw"></i> <span>Kegiatan</span> <i class="fa fa-angle-left pull-right"></i></a>
                    <ul @if($title == "Kelola Kegiatan" || $title == "Tambah Kegiatan" || $title == "Ubah Kegiatan" )
                            {!! "class='treeview-menu menu-open' style='display:block;'" !!}
                        @else
                            {!! "class='treeview-menu'" !!}
                        @endif>
                        <li @if($title == "Tambah Kegiatan" ){!! "class='treeview active'" !!}@endif>
                            <a href="{!! route('admins.kegiatan.create') !!}"><span class="fa fa-plus"></span> Tambah Kegiatan</a>
                        </li>
                        <li @if($title == "Kelola Kegiatan" ){!! "class='treeview active'" !!}@endif>
                            <a href="{!! route('admins.kegiatan.index') !!}"><span class="fa fa-archive"></span> Kelola Kegiatan</a>
                        </li>
                    </ul>
                </li>
            @endif
            <!-- /diklat -->
            <!-- cuprimer -->
            @if(Entrust::can('cuprimer'))
                <li @if($title == "Kelola CU" || $title == "Tambah CU" || $title == "Ubah CU" || $title == "Kelola Wilayah CU" ||
                    $title == "Kelola Staff CU" || $title == "Tambah Staff CU" || $title == "Ubah Staff CU")
                        {!! "class='treeview active'" !!}
                    @else
                        {!! "class='treeview'" !!}
                    @endif>
                    <a href="#"><i class="fa fa-building-o fa-fw"></i> <span>CU</span> <i class="fa fa-angle-left pull-right"></i></a>
                    <ul @if($title == "Kelola CU" || $title == "Tambah CU" || $title == "Ubah CU" || $title == "Kelola Wilayah CU" ||
                        $title == "Kelola Staff CU" || $title == "Tambah Staff CU" || $title == "Ubah Staff CU")
                            {!! "class='treeview-menu menu-open' style='display:block;'" !!}
                        @else
                            {!! "class='treeview-menu'" !!}
                        @endif>
                        <li @if($title == "Tambah CU" ){!! "class='treeview active'" !!}@endif>
                            <a href="{!! route('admins.cuprimer.create') !!}"><span class="fa fa-plus"></span> Tambah CU</a>
                        </li>
                        <li @if($title == "Kelola CU" ){!! "class='treeview active'" !!}@endif>
                            <a href="{!! route('admins.cuprimer.index') !!}"><span class="fa fa-archive"></span> Kelola CU</a>
                        </li>
                        @if(Entrust::can('wilayahcuprimer'))
                            <li @if($title == "Kelola Wilayah CU" ){!! "class='treeview active'" !!}@endif>
                                <a href="{!! route('admins.wilayahcuprimer.index') !!}"><span class="fa fa-archive"></span> Kelola Wilayah CU</a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif
            <!-- /cuprimer -->
            <!-- perkembangan cu -->
            @if(Entrust::can('infogerakan'))
                <li @if($title == "Kelola Perkembangan CU" || $title == "Tambah Perkembangan CU" || $title == "Ubah Perkembangan CU")
                        {!! "class='treeview active'" !!}
                        @else
                        {!! "class='treeview'" !!}
                    @endif>
                    <a href="#"><i class="fa fa-line-chart fa-fw"></i> <span>Perkembangan CU</span> <i class="fa fa-angle-left pull-right"></i></a>
                    <ul @if($title == "Kelola Perkembangan CU" || $title == "Tambah Perkembangan CU" || $title == "Ubah Perkembangan CU")
                            {!! "class='treeview-menu menu-open' style='display:block;'" !!}
                        @else
                            {!! "class='treeview-menu'" !!}
                        @endiF>
                        <li @if($title == "Tambah Perkembangan CU" ){!! "class='treeview active'" !!}@endif>
                            <a  href="{!! route('admins.perkembangancu.create') !!}"><i class="fa fa-plus"></i> Tambah Perkembangan CU</a>
                        </li>
                        <li @if($title == "Kelola Perkembangan CU" ){!! "class='treeview active'" !!}@endif>
                            <a  href="{!! route('admins.perkembangancu.index') !!}"><i class="fa fa-archive"></i> Kelola Perkembangan CU</a>
                        </li>
                    </ul>
                </li>
            @endif
            <!-- perkembangan cu -->
            <!-- staff -->
            @if(Entrust::can('staff'))
                <li @if($title == "Kelola Staf" || $title == "Tambah Staf" || $title == "Ubah Staf" || $title == "Detail Staf"  )
                        {!! "class='treeview active'" !!}
                    @endif>
                    <a href="#"><i class="fa fa-sitemap fa-fw"></i> <span>Staf</span> <i class="fa fa-angle-left pull-right"></i></a>
                    <ul
                    @if($title == "Kelola Staf" || $title == "Tambah Staf" || $title == "Ubah Staf" )
                        {!! "class='treeview-menu menu-open' style='display:block;'" !!}
                    @else
                        {!! "class='treeview-menu'" !!}
                    @endif>
                        <li @if($title == "Tambah Staf" ){!! "class='treeview active'" !!}@endif>
                            <a href="{!! route('admins.staf.create') !!}"><span class="fa fa-plus"></span> Tambah Staf</a>
                        </li>
                        <li @if($title == "Kelola Staf"){!! "class='treeview active'" !!}@endif>
                            <a href="#"><i class="fa fa-archive"></i> Kelola staf <i class="fa fa-angle-left pull-right"></i></a>
                            <ul @if($title == "Kelola Staf")
                                {!! "class='treeview-menu menu-open' style='display:block;'" !!}
                                    @else
                                {!! "class='treeview-menu'" !!}
                                @endif>
                                <li @if(!empty($title2) && $title2 == "Semua CU"){!! "class='treeview active'" !!}@endif
                                ><a href="{!! route('admins.staf.index') !!}"><i class="fa fa-circle-o"></i> Semua</a></li>
                                <li @if(!empty($title2) && $title2 == "Puskopdit BKCU Kalimantan"){!! "class='treeview active'" !!}@endif
                                ><a href="{!! route('admins.staf.index_bkcu') !!}"><i class="fa fa-circle-o"></i> BKCU</a></li>
                            <?php
                                $cusidebars = App\Models\Cuprimer::orderBy('name','asc')->get();
                            ?>
                                @foreach($cusidebars as $cusidebar)
                                    <li @if(!empty($title2) && $title2 == "CU " . $cusidebar->name){!! "class='treeview active'" !!}@endif
                                            ><a href="{!! route('admins.staf.index_cu',array($cusidebar->id)) !!}"><i class="fa fa-circle-o"></i> {!! $cusidebar->name !!}</a></li>
                                @endforeach
                            </ul>
                        </li>
                    </ul>
                </li>
            @endif
            <!-- /staff -->
            <!-- download -->
            @if(Entrust::can('download'))
                <li @if($title == "Kelola File" || $title == "Tambah File" || $title == "Ubah File" )
                        {!! "class='treeview active'" !!}
                    @else
                        {!! "class='treeview'" !!}
                    @endif>
                    <a href="#"><i class="fa fa-download fa-fw"></i> <span>Download</span> <i class="fa fa-angle-left pull-right"></i></a>
                    <ul @if($title == "Kelola File" || $title == "Tambah File" || $title == "Ubah File" )
                            {!! "class='treeview-menu menu-open' style='display:block;'" !!}
                        @else
                            {!! "class='treeview-menu'" !!}
                        @endif>
                        <li @if($title == "Tambah File" ){!! "class='treeview active'" !!}@endif>
                            <a href="{!! route('admins.download.create') !!}"><span class="fa fa-plus"></span> Tambah File</a>
                        </li>
                        <li @if($title == "Kelola File" ){!! "class='treeview active'" !!}@endif>
                            <a href="{!! route('admins.download.index') !!}"><span class="fa fa-archive"></span> Kelola File</a>
                        </li>
                    </ul>
                </li>
            @endif
            <!-- /download -->
            <!-- admin -->
            @if(Entrust::can('admin'))
                <li @if($title == "Kelola Admin" || $title == "Tambah Admin" || $title == "Ubah Admin" )
                        {!! "class='treeview active'" !!}
                    @else
                        {!! "class='treeview'" !!}
                    @endif>
                <a href="#"><i class="fa fa-user fa-fw"></i> <span>Admin</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul @if($title == "Kelola Admin" || $title == "Tambah Admin" || $title == "Ubah Admin" )
                        {!! "class='treeview-menu menu-open' style='display:block;'" !!}
                    @else
                        {!! "class='treeview-menu'" !!}
                    @endif>
                    <li @if($title == "Tambah Admin" ){!! "class='treeview active'" !!}@endif>
                        <a href="{!! route('admins.admin.create') !!}"><span class="fa fa-plus"></span> Tambah Admin</a>
                    </li>
                    <li @if($title == "Kelola Admin" ){!! "class='treeview active'" !!}@endif>
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
