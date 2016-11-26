<?php
$cusidebars = App\Models\Cuprimer::orderBy('name','asc')->get();
$cu = Auth::user()->getCU();
?>
<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu">
            <!-- dashboard -->
            <li {{ Request::is('admins') ? 'class=active' : '' }}>
                <a href="{{ URL::to('admins')  }}"><i class="fa fa-dashboard fa-fw"></i> <span>Dashboard</span></a>
            </li>
            <!-- /dashboard -->
            <!-- pengumuman -->
            @permission('view.pengumuman_view')
                <li {!! Request::is('admins/pengumuman') ? 'class="active"' : '' !!}>
                    <a href="{!! route('admins.pengumuman.index') !!}"><i class="fa fa-comments-o fa-fw"></i> <span>Pengumuman</span></a>
                </li>
            @endpermission
            <!-- /pengumuman -->
            <!-- saran -->
            @permission('view.saran_view')
                <li {!! Request::is('admins/saran') ? 'class="active"' : '' !!}>
                    <a href="{!! route('admins.saran.index') !!}"><i class="fa fa-paper-plane-o fa-fw"></i> <span>Saran atau Kritik</span></a>
                </li>
            @endpermission
            <!-- /saran -->
            <!-- foto kegiatan -->
            <li>
                <a href="https://www.flickr.com/photos/127271987@N07/"
                   target="_blank"><i class="fa fa-picture-o fa-fw"></i> <span>Foto Kegiatan</span></a>
            </li>
            <!-- /foto kegiatan -->
            <!-- statistik -->
            @permission('view.statistikweb_view')
                <li {!! Request::is('admins/statistik') ? 'class="active"' : '' !!}>
                    <a href="{{ route('statistik') }}"><i class="fa fa-road fa-fw"></i> <span>Statistik Website</span></a>
                </li>
            @endpermission
            <!-- /statistik -->
            <!-- artikel -->
            @permission('view.artikel_view|view.kategoriartikel_view')
                <li {!! Request::is('admins/artikel') || Request::is('admins/artikel*') || Request::is('admins/kategoriartikel') ? 'class="active"' : '' !!} >
                    <a href="{{ route('admins.artikel.index') }}"><i class="fa fa-book fa-fw"></i> <span>Artikel</span></a>
                </li>
            @endpermission
            <!-- /artikel -->
            <!-- kegiatan -->
            @permission('view.kegiatan_view')
                <li {!! Request::is('admins/kegiatan') || Request::is('admins/kegiatan*') ? 'class="active"' : '' !!} >
                    <a href="{{ route('admins.kegiatan.index') }}"><i class="fa fa-suitcase fa-fw"></i> <span>Kegiatan</span></a>
                </li>
            @endpermission
            <!-- /kegiatan -->
            <!-- cuprimer -->
            @permission('view.cuprimer_view|view.tpcu_view|view.wilayahcuprimer_view')
                <li {!! Request::is('admins/cuprimer') || Request::is('admins/cuprimer*') || Request::is('admins/wilayahcuprimer') || Request::is('admins/tpcu*') ? 'class="active"' : '' !!} >
                    <a href="{{ route('admins.cuprimer.index') }}"><i class="fa fa-building-o fa-fw"></i> <span>CU</span></a>
                </li>
            @endpermission
            <!-- /cuprimer -->
            <!-- staf -->
            @permission('view.staf_view')
                <li {!! Request::is('admins/staf') || Request::is('admins/staf*') ? 'class="active"' : '' !!} >
                    <a @permission('view.staf_view')
                            @if($cu == '0')
                                href="{{ route('admins.staf.index') }}"
                            @elseif($cu > '0')
                                href="{{ route('admins.staf.index_cu',array($cu)) }}"
                            @endif
                        @endpermission ><i class="fa fa-sitemap fa-fw"></i> <span>Staf</span></a>
                </li>
            @endpermission
            <!-- /staf -->
            <!-- laporancu -->
            @permission('view.laporancu_view|view.laporancudetail_view')
                <li {!! Request::is('admins/laporancu') || Request::is('admins/laporancu*') ? 'class="active"' : '' !!} >
                    <a @if(Auth::check() && Auth::user()->can('view.laporancu_view'))
                            href="{{ route('admins.laporancu.index') }}"
                        @elseif(Auth::check() && Auth::user()->can('view.laporancudetail_view') && $cu > '0')
                            <?php 
                                $cuprimer = App\Models\Cuprimer::where('id','=',$cu)->select('no_ba')->first();
                                $no_ba = $cuprimer->no_ba;
                            ?>
                            href="{{ route('admins.laporancu.index_cu',array($no_ba)) }}"
                        @endif><i class="fa fa-line-chart fa-fw"></i> <span>Laporan CU</span></a>
                </li>
            @endpermission
            <!-- /laporancu -->
            <!-- download -->
            @permission('view.download_view')
                <li {!! Request::is('admins/download') || Request::is('admins/download*') ? 'class="active"' : '' !!} >
                    <a href="{{ route('admins.download.index') }}"><i class="fa fa-download fa-fw"></i> <span>Download</span></a>
                </li>
            @endpermission
            <!-- /download -->
            <!-- admin -->
            @permission('view.admin_view')
                <li {!! Request::is('admins/admin') || Request::is('admins/admin*') ? 'class="active"' : '' !!} >
                    <a href="{{ route('admins.admin.index') }}"><i class="fa fa-user-circle-o fa-fw"></i> <span>Admin</span></a>
                </li>
            @endpermission   
            <!-- /admin -->
        </ul>
    </section>
</aside>
