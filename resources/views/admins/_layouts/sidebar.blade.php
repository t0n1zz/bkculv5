<?php
$cusidebars = App\Models\Cuprimer::orderBy('name','asc')->get();
$cu = Auth::user()->getCU();
$iduser = Auth::user()->getId();
?>
<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <?php
                    $gambar = Auth::user()->getGambar();
                    $imagepath = 'images/';
                ?>
                @if(!empty($gambar) && is_file($imagepath.$gambar.".jpg"))
                    <div class="pull-left image">
                        <img src="{!! asset($imagepath.$gambar.".jpg") !!}" class="img-circle" alt="User Image" />
                    </div>
                @else
                    <div class="pull-left image">
                        <img src="{!! asset($imagepath."user.png") !!}" class="img-circle" alt="User Image" />
                    </div>
                @endif
                <div class="pull-left info">
                    <p>{!! Auth::user()->getName() !!}</p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
            <!-- Sidebar user panel -->
            <li class="header">NAVIGASI UTAMA</li>
            <!-- dashboard -->
            <li {{ Request::is('admins') ? 'class=active' : '' }}>
                <a href="{{ URL::to('admins')  }}"><i class="fa fa-dashboard "></i> <span>Dashboard</span></a>
            </li>
            <!-- /dashboard -->
            <!-- pengumuman -->
            @permission('view.pengumuman_view')
                <li {!! Request::is('admins/pengumuman') ? 'class="active""' : '' !!}>

                    <a href="{!! route('admins.pengumuman.index') !!}"><i class="fa fa-comments-o "></i> <span>Pengumuman</span></a>
                </li>
            @endpermission
            <!-- /pengumuman -->
            <!-- artikel -->
            @permission('view.artikel_view|view.kategoriartikel_view|create.artikel_create')
                <li {!! Request::is('admins/artikel') || Request::is('admins/artikel*') || Request::is('admins/kategoriartikel') ? 'class="treeview active"' : 'treeview' !!} >
                    <a href="#"><i class="fa fa-book"></i> <span>Artikel</span> <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                    <ul {{ Request::is('admins/artikel*') ? 'class=treeview-menu menu open style=display:block;' : 'class=treeview-menu' }}>
                        @permission('create.artikel_create')
                        <li {!! Request::is('admins/artikel/create') ? 'class="treeview active"' : '' !!} >
                            <a  href="{{ route('admins.artikel.create') }}"><i class="fa fa-plus"></i> Tambah</a>
                        </li>
                        @endpermission
                        @permission('view.artikel_view|view.kategoriartikel_view')
                        <li {!! Request::is('admins/artikel') ? 'class="treeview active"' : '' !!} >
                            <a href="{{ route('admins.artikel.index') }}"><i class="fa fa-circle-o"></i> Kelola</a>
                        </li>
                        @endpermission
                    </ul>
                </li>
            @endpermission
            <!-- /artikel -->
            <!-- kegiatan -->
            @permission('view.kegiatan_view|create.kegiatan_create')
                @if($cu !=0)
                    <li {!! Request::is('admins/kegiatan') ? 'class="active"' : '' !!}>
                        <a href="{{ route('admins.kegiatan.index') }}"><i class="fa fa-suitcase"></i> <span>Kegiatan BKCU</span></a>
                    </li>
                @else
                <li {!! Request::is('admins/kegiatan') || Request::is('admins/kegiatan*') ? 'class="treeview active"' : 'treeview' !!} >
                    <a href="#"><i class="fa fa-suitcase"></i> <span>Kegiatan</span> <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                    <ul {{ Request::is('admins/kegiatan*') ? 'class=treeview-menu menu open style=display:block;' : 'class=treeview-menu' }}>
                        @permission('create.kegiatan_create')
                        <li {!! Request::is('admins/kegiatan/create') ? 'class="treeview active"' : '' !!} >
                            <a href="{{ route('admins.kegiatan.create') }}"><i class="fa fa-plus"></i> Tambah</a>
                        </li>
                        @endpermission
                        @permission('view.kegiatan_view')
                        <li {!! Request::is('admins/kegiatan') ? 'class="treeview active"' : '' !!} >
                            <a href="{{ route('admins.kegiatan.index') }}"><i class="fa fa-circle-o"></i> Kelola</a>
                        </li>
                        @endpermission
                    </ul>
                </li>
                @endif
            @endpermission
            <!-- /kegiatan -->
            <!-- cuprimer -->
            @permission('view.cuprimer_view|view.wilayahcuprimer_view|create.cuprimer_create')
                @if($cu !=0)
                    <li {!! Request::is('admins/cuprimer*') ? 'class="active"' : '' !!}>
                        <a href="{{ route('admins.cuprimer.detail',array($cu)) }}"><i class="fa fa-building"></i> <span>Profil CU</span></a>
                    </li>
                @else
                <li {!! Request::is('admins/cuprimer') || Request::is('admins/cuprimer*') || Request::is('admins/wilayahcuprimer') ? 'class="treeview active"' : 'treeview' !!} >
                    <a href="#"><i class="fa fa-building-o"></i> <span>CU</span> <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                    <ul {{ Request::is('admins/cuprimer*') ? 'class=treeview-menu menu open style=display:block;' : 'class=treeview-menu' }}>
                        @permission('create.cuprimer_create')
                        <li {!! Request::is('admins/cuprimer/create') ? 'class="treeview active"' : '' !!} >
                            <a href="{{ route('admins.cuprimer.create') }}"><i class="fa fa-plus"></i> Tambah</a>
                        </li>
                        @endpermission
                        @permission('view.cuprimer_view|view.tpcu_view|view.wilayahcuprimer_view')
                        <li {!! Request::is('admins/cuprimer') ? 'class="treeview active"' : '' !!} >
                            <a href="{{ route('admins.cuprimer.index') }}"><i class="fa fa-circle-o"></i> Kelola</a>
                        </li>
                        @endpermission
                    </ul>    
                </li>
                @endif
            @endpermission
            <!-- /cuprimer -->
            <!-- tpcu -->
            @permission('view.tpcu_view|create.tpcu_create')
                <li {!! Request::is('admins/tpcu*') ? 'class="treeview active"' : 'treeview' !!} >
                    <a href="#"><i class="fa fa-home"></i> <span>TP CU</span> <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                    <ul {{ Request::is('admins/tpcu*') ? 'class=treeview-menu menu open style=display:block;' : 'class=treeview-menu' }}>
                        @permission('create.tpcu_create')
                        <li {!! Request::is('admins/tpcu/create') ? 'class="treeview active"' : '' !!} >
                            <a href="{{ route('admins.tpcu.create') }}"><i class="fa fa-plus"></i> Tambah</a>
                        </li>
                        @endpermission
                        @permission('view.tpcu_view')
                        <li {!! Request::is('admins/tpcu') || Request::is('admins/tpcu/index_cu*') ? 'class="treeview active"' : '' !!} >
                            <a @if($cu == '0')
                                    href="{{ route('admins.tpcu.index') }}"
                                @elseif($cu > '0')
                                    href="{{ route('admins.tpcu.index_cu',array($cu)) }}"
                                @endif
                            ><i class="fa fa-circle-o"></i> Kelola</a>
                        </li>
                        @endpermission
                    </ul>    
                </li>
            @endpermission
            <!-- /tpcu -->
            <!-- staf -->
            @permission('view.staf_view|create.staf_create')
                <li {!! Request::is('admins/staf') || Request::is('admins/staf*') ? 'class="treeview active"' : 'treeview' !!} >
                    <a href="#"><i class="fa fa-sitemap"></i> <span>Staf</span> <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                    <ul {{ Request::is('admins/staf*') ? 'class=treeview-menu menu open style=display:block;' : 'class=treeview-menu' }}>
                        @permission('create.staf_create')
                        <li {!! Request::is('admins/staf/create') ? 'class="treeview active"' : '' !!} >
                            <a href="{{ route('admins.staf.create') }}"><i class="fa fa-plus"></i> Tambah</a>
                        </li>
                        @endpermission
                        @permission('view.staf_view')
                        <li {!! Request::is('admins/staf') ? 'class="treeview active"' : '' !!} >
                            <a  @if($cu == '0')
                                    href="{{ route('admins.staf.index') }}"
                                @elseif($cu > '0')
                                    href="{{ route('admins.staf.index_cu',array($cu)) }}"
                                @endif
                            ><i class="fa fa-circle-o"></i> Kelola</a>
                        </li>
                        @endpermission     
                    </ul>    
                </li>
            @endpermission
            <!-- /staf -->
            <!-- laporancu -->
            @permission('view.laporancu_view|view.laporancudetail_view|create.laporancu_create|create.laporancudetail_create')
                <li {!! Request::is('admins/laporancu') || Request::is('admins/laporancu*') ? 'class="treeview active"' : 'treeview' !!} >
                    <a href="#"><i class="fa fa-line-chart"></i> <span>Laporan CU</span> <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                    <ul {{ Request::is('admins/laporancu*') ? 'class=treeview-menu menu open style=display:block;' : 'class=treeview-menu' }}>
                        @permission('create.laporancu_create|create.laporancudetail_create')
                        <li {!! Request::is('admins/laporancu/create') ? 'class="treeview active"' : '' !!} >
                            <a href="{!! route('admins.laporancu.create') !!}"><i class="fa fa-plus"></i> Tambah</a>
                        </li>
                        @endpermission
                        @permission('view.laporancu_view|view.laporancudetail_view')
                        <li {!! Request::is('admins/laporancu') || Request::is('admins/laporancu/index_cu*') || Request::is('admins/laporancu/index_bkcu') || Request::is('admins/laporancu/index_periode*') ? 'class="treeview active"' : '' !!} >
                            <a @if(Auth::check() && Auth::user()->can('view.laporancu_view'))
                                    href="{{ route('admins.laporancu.index') }}"
                                @elseif(Auth::check() && Auth::user()->can('view.laporancudetail_view') && $cu > '0')
                                    href="{{ route('admins.laporancu.index_cu',array($cu)) }}"
                                @endif><i class="fa fa-circle-o"></i> Kelola</a>
                        </li>
                        @endpermission        
                    </ul>    
                </li>
            @endpermission
            <!-- /laporancu -->
            <!-- download -->
            @permission('view.download_view')
                <li {!! Request::is('admins/download') || Request::is('admins/download*') ? 'class="treeview active"' : 'treeview' !!} >
                    <a href="#"><i class="fa fa-download"></i> <span>Download</span> <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                    <ul {{ Request::is('admins/download*') ? 'class=treeview-menu menu open style=display:block;' : 'class=treeview-menu' }}>
                        <li {!! Request::is('admins/download/create') ? 'class="treeview active"' : '' !!} >
                            <a href="{{ route('admins.download.create') }}"><span class="fa fa-plus"></span> Tambah</a>
                        </li>
                        <li {!! Request::is('admins/download') ? 'class="treeview active"' : '' !!} >
                            <a href="{{ route('admins.download.index') }}"><i class="fa fa-circle-o"></i> Kelola</a>
                        </li>
                    </ul>
                </li>
            @endpermission
            <!-- /download -->
            <!-- admin -->
            @if($cu !=0)
                <li {!! Request::is('admins/admin*') ? 'class="active"' : '' !!}>
                    <a href="{{ route('admins.admin.detail',array($iduser)) }}"><i class="fa fa-user-circle-o"></i> <span>Admin</span></a>
                </li>
            @else
            @permission('view.admin_view|create.admin_create')
                <li {!! Request::is('admins/admin') || Request::is('admins/admin*') ? 'class="active"' : '' !!} >
                    <a href="#"><i class="fa fa-user-circle-o"></i> <span>Admin</span> <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                    <ul {{ Request::is('admins/admin*') ? 'class=treeview-menu menu open style=display:block;' : 'class=treeview-menu' }}>
                        @permission('create.admin_create')
                        <li {!! Request::is('admins/admin/create') ? 'class="treeview active"' : '' !!} >
                            <a href="{{ route('admins.admin.create') }}"><span class="fa fa-plus"></span> Tambah</a>
                        </li>
                        @endpermission
                        @permission('view.admin_view')
                        <li {!! Request::is('admins/admin') ? 'class="treeview active"' : '' !!} >
                            <a href="{{ route('admins.admin.index') }}"><i class="fa fa-circle-o"></i> Kelola</a>
                        </li>
                        @endpermission    
                    </ul>
                </li>
            @endpermission
            @endif   
            <!-- /admin -->
            <li class="header">LAIN-LAIN</li>
            <!-- foto kegiatan -->
            <li>
                <a href="https://www.flickr.com/photos/127271987@N07/"
                   target="_blank"><i class="fa fa-picture-o"></i> <span>Foto Kegiatan</span></a>
            </li>
            <!-- /foto kegiatan -->
            <!-- statistik -->
            @permission('view.statistikweb_view')
                <li {!! Request::is('admins/statistik') ? 'class="active"' : '' !!}>
                    <a href="{{ route('statistik') }}"><i class="fa fa-road"></i> <span>Statistik Website</span></a>
                </li>
            @endpermission
            <!-- /statistik -->
            <!-- saran -->
            @permission('view.saran_view')
                <li {!! Request::is('admins/saran') ? 'class="active"' : '' !!}>
                    <a href="{!! route('admins.saran.index') !!}"><i class="fa fa-paper-plane-o"></i> <span>Saran atau Kritik</span></a>
                </li>
            @endpermission
            <!-- /saran -->
        </ul>
    </section>
</aside>
