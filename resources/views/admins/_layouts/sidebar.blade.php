<?php
$cusidebars = App\Cuprimer::orderBy('name','asc')->get();
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
                    $imagepath = 'images_user/';
                ?>
                @if(!empty($gambar) && is_file($imagepath.$gambar.".jpg"))
                    <div class="pull-left image">
                        <img src="{!! asset($imagepath.$gambar.".jpg") !!}" class="img-circle" alt="User Image" />
                    </div>
                @else
                    <div class="pull-left image">
                        <img src="{!! asset($imagepath."user.jpg") !!}" class="img-circle" alt="User Image" />
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
            @permission('view.artikel_view|view.kategoriartikel_view')
                <li {!! Request::is('admins/artikel') || Request::is('admins/artikel*') || Request::is('admins/kategoriartikel') ? 'class="active"' : '' !!} >
                    <a href="{{ route('admins.artikel.index') }}"><i class="fa fa-book"></i> <span>Artikel</span></a>
                </li>
            @endpermission
            <!-- /artikel -->
            <!-- kegiatan -->
            @permission('view.kegiatan_view')
                @if($cu !=0)
                    <li {!! Request::is('admins/kegiatan') ? 'class="active"' : '' !!}>
                        <a href="{{ route('admins.kegiatan.index') }}"><i class="fa fa-suitcase"></i> <span>Kegiatan BKCU</span></a>
                    </li>
                @else
                    <li {!! Request::is('admins/kegiatan') || Request::is('admins/kegiatan*') ? 'class="active"' : '' !!} >
                        <a href="{{ route('admins.kegiatan.index') }}"><i class="fa fa-suitcase"></i> <span>Kegiatan</span></a>
                    </li>
                @endif
            @endpermission
            <!-- /kegiatan -->
            <!-- cuprimer -->
            @permission('view.cuprimer_view|view.wilayahcuprimer_view')
                @if($cu !=0)
                    <li {!! Request::is('admins/cuprimer*') ? 'class="active"' : '' !!}>
                        <a href="{{ route('admins.cuprimer.detail',array($cu)) }}"><i class="fa fa-building"></i> <span>Profil CU</span></a>
                    </li>
                @else
                    <li {!! Request::is('admins/cuprimer') || Request::is('admins/cuprimer*') || Request::is('admins/wilayahcuprimer') ? 'class="active"' : '' !!} >
                        <a href="{{ route('admins.cuprimer.index') }}"><i class="fa fa-building-o"></i> <span>CU</span></a>
                    </li>
                @endif
            @endpermission
            <!-- /cuprimer -->
            <!-- tpcu -->
            @permission('view.tpcu_view')
                <li {!! Request::is('admins/tpcu*') ? 'class="active"' : '' !!} >
                    <a @if($cu == '0')
                            href="{{ route('admins.tpcu.index') }}"
                        @elseif($cu > '0')
                            href="{{ route('admins.tpcu.index_cu',array($cu)) }}"
                        @endif
                    ><i class="fa fa-home"></i> <span>TP CU</span></a>  
                </li>
            @endpermission
            <!-- /tpcu -->
            <!-- staf -->
            @permission('view.staf_view')
                <li {!! Request::is('admins/staf') || Request::is('admins/staf*') ? 'class="active"' : '' !!} >
                    <a  @if($cu == '0')
                            href="{{ route('admins.staf.index') }}"
                        @elseif($cu > '0')
                            href="{{ route('admins.staf.index_cu',array($cu)) }}"
                        @endif
                    ><i class="fa fa-sitemap"></i> <span>Staf</span></a>
                </li>
            @endpermission
            <!-- /staf -->
            <!-- laporancu -->
            @permission('view.laporancu_view')
                <li {!! Request::is('admins/laporancu') || Request::is('admins/laporancu*') ? 'class="active"' : '' !!} >
                    <a @if($cu == '0'))
                            href="{{ route('admins.laporancu.index') }}"
                        @else
                            href="{{ route('admins.laporancu.index_cu',array($cu)) }}"
                        @endif
                    ><i class="fa fa-line-chart"></i> <span>Laporan CU</span></a>       
                </li>
            @endpermission
            <!-- /laporancu -->
            <!-- download -->
            @permission('view.download_view')
                <li {!! Request::is('admins/download') || Request::is('admins/download*') ? 'class="active"' : '' !!} >
                    <a href="{{ route('admins.download.index') }}"><i class="fa fa-download"></i> <span>Download</span></a>
                </li>
            @endpermission
            <!-- /download -->
            <!-- admin -->
            @permission('detail.admin_detail')
                <li {!! Request::is('admins/admin*') ? 'class="active"' : '' !!}>
                    <a href="{{ route('admins.admin.detail',array($iduser)) }}"><i class="fa fa-user-circle-o"></i> <span>Admin</span></a>
                </li>
            @endpermission
            @permission('view.admin_view')
                <li {!! Request::is('admins/admin') || Request::is('admins/admin*') ? 'class="active"' : '' !!} >
                    <a href="#" data-toggle="modal" data-target="#modalcheckpass"><i class="fa fa-user-circle-o"></i> <span>Admin</span></a>
                </li>
            @endpermission  
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
