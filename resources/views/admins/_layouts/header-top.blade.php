<?php
    $gambar = Auth::user()->getGambar();
    $imagepath = 'images_user/';

    // if(Auth::user()->getLogout() != "0000-00-00 00:00:00"){
    //     $date = new Date(Auth::user()->getLogout());
    //     $tanggal = "Terakhir Login: ".$date->format('j F Y | H:i:s');
    // }else{
    //     $tanggal = "Belum pernah login";
    // }
    $user = Auth::user();
    $cu = Auth::user()->getCU();
    $iduser = Auth::user()->getId();
    if($cu == '0'){
        $name_cu = 'BKCU';
    }else{
        $cuprimer = App\Cuprimer::withTrashed()->where('no_ba','=',$cu)->select('name')->first();
        $name_cu = $cuprimer->name;
    }
?>
<header class="main-header">
    <nav class="navbar navbar-static-top"> 
        <div class="navbar-header">
          @if(url()->previous() != url()->current() && url()->previous() != url('admins/login'))
            <a href="{{ url()->previous() }}" title="kembali ke halaman sebelumnya" class="navbar-brand"><i class="fa fa-arrow-circle-left"></i></a>
          @endif
          <a href="{{ route('admins') }}" class="navbar-brand" title="Sistem Informasi Manajemen Organisasi"><b>SIMO</b></a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <ul class="nav navbar-nav">
            {{-- dashboard --}}
            <li class="{{ Request::is('admins') ? 'active' : '' }}"><a href="{{ URL::to('admins')  }}"><i class="fa fa-dashboard fa-fw"></i> Dashboard <span class="sr-only">(current)</span></a></li>
            {{-- website --}}
            <li class="dropdown {{ Request::is('admins/pengumuman') || Request::is('admins/artikel') || Request::is('admins/artikel*') || Request::is('admins/kategoriartikel') || Request::is('admins/download') || Request::is('admins/download*') || Request::is('admins/statistik') || Request::is('admins/saran') ? 'active' : '' }}">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-globe fa-fw"></i> Website <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li class="divider"></li>
                @permission('create.artikel_create')
                  <li class="{{ Request::is('admins/artikel/create') ? 'active' : '' }}">
                    <a href="{{ route('admins.artikel.create') }}"><i class="fa fa-plus fa-fw""></i> Tambah Artikel</a>
                  </li>
                  <li class="divider"></li>
                @endpermission
                @permission('view.artikel_view|view.kategoriartikel_view')
                  <li class="{{ Request::is('admins/artikel') ? 'active' : '' }}">
                    <a href="{{ route('admins.artikel.index') }}"><i class="fa fa-book fa-fw""></i> Artikel</a>
                  </li>
                @endpermission   
                @permission('view.pengumuman_view')
                  <li class="{{ Request::is('admins/pengumuman') ? 'active' : '' }}">
                    <a href="{{ route('admins.pengumuman.index') }}"><i class="fa fa-comments-o fa-fw""></i> Pengumuman</a>
                  </li>
                @endpermission
                @permission('view.statistikweb_view')
                  <li class="{{ Request::is('admins/statistik') ? 'active' : '' }}">
                    <a href="{{ route('statistik') }}"><i class="fa fa-road fa-fw""></i> Statistik</a>
                  </li>
                @endpermission
                @permission('view.saran_view')  
                  <li class="{{ Request::is('admins/saran') ? 'active' : '' }}">
                    <a href="{{ route('admins.saran.index') }}"><i class="fa fa-paper-plane-o fa-fw""></i> Saran atau Kritik</a>
                  </li>
                @endpermission
                @permission('view.download_view')  
                  <li class="{{ Request::is('admins/download') ? 'active' : '' }}">
                    <a href="{{ route('admins.download.index') }}"><i class="fa fa-download fa-fw""></i> Download</a>
                  </li>
                @endpermission
                @permission('view.artikel_view|view.kategoriartikel_view|view.pengumuman_view|view.saran_view')
                  <li class="divider"></li>
                @endpermission
                <li>
                  <a href="https://www.flickr.com/photos/127271987@N07/" target="_blank"><i class="fa fa-picture-o fa-fw""></i> Foto Kegiatan</a>
                </li>
              </ul>
            </li>
            {{-- diklat --}}
            @permission('view.kegiatan_view|create.kegiatan_create')
              <li class="dropdown {{ Request::is('admins/kegiatan') || Request::is('admins/kegiatan*') ? 'active' : '' }}">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-suitcase fa-fw"></i> Diklat <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li class="divider"></li>
                  @permission('create.kegiatan_create')
                    <li class="{{ Request::is('admins/kegiatan/create') ? 'active' : '' }}">
                      <a href="{{ route('admins.kegiatan.create') }}"><i class="fa fa-plus fa-fw""></i> Tambah Diklat</a>
                    </li>
                    <li class="{{ Request::is('admins/tempat/create') ? 'active' : '' }}">
                      <a href="{{ route('admins.tempat.create') }}"><i class="fa fa-plus fa-fw""></i> Tambah Tempat</a>
                    </li>
                    <li class="divider"></li>
                  @endpermission
                  @permission('view.kegiatan_view')
                    <li class="{{ Request::is('admins/kegiatan') ? 'active' : '' }}">
                      <a href="{{ route('admins.kegiatan.index') }}"><i class="fa fa-suitcase fa-fw"></i> Diklat</a>
                    </li>
                  @endpermission  
                  @permission('create.kegiatan_create')
                    <li class="{{ Request::is('admins/tempat') ? 'active' : '' }}">
                      <a href="{{ route('admins.tempat.index') }}"><i class="fa fa-map-marker fa-fw"></i> Tempat</a>
                    </li>
                  @endpermission
                </ul>
              </li>
            @endpermission
            {{-- litbang --}}
            @permission('view.laporancu_view')
              <li class="dropdown {{ Request::is('admins/laporancu') || Request::is('admins/laporancu*') ? 'active' : '' }}"> 
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-bar-chart fa-fw"></i> Litbang <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li class="divider"></li>
                  @permission('create.laporancu_create')
                    <li class="{{ Request::is('admins/laporancu/create') ? 'active' : '' }}">
                      <a href="{{ route('admins.laporancu.create') }}"><i class="fa fa-plus fa-fw"></i> Tambah Laporan CU</a>
                    </li>
                    <li class="divider"></li>
                  @endpermission
                  @permission('view.laporancu_view')
                    <li class="{{ Request::is('admins/laporancu') || Request::is('admins/laporancu/index_cu*') || Request::is('admins/laporancu/index_hapus') || Request::is('admins/laporancu/index_bkcu') ? 'active' : '' }}">
                      <a href="{{ $cu == '0' ? route('admins.laporancu.index') : route('admins.laporancu.index_cu',array($cu)) }}"><i class="fa fa-bar-chart fa-fw"></i> Laporan CU</a>
                    </li>
                  @endpermission   
                </ul>
              </li>
            @endpermission
            {{-- cu primer --}}
            @permission('create.cuprimer_create|create.cuprimer_create|create.staf_create|view.cuprimer_view|view.wilayahcuprimer_view|view.tpcu_view|view.staf_view')
            <li class="dropdown {{ Request::is('admins/cuprimer') || Request::is('admins/cuprimer*') || Request::is('admins/wilayahcuprimer') || Request::is('admins/tpcu*') || Request::is('admins/staf') || Request::is('admins/staf*') ? 'active' : '' }}">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-building fa-fw"></i> CU <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li class="divider"></li>
                @permission('create.cuprimer_create') 
                  <li class="{{ Request::is('admins/cuprimer/create') ? 'active' : '' }}">
                    <a href="{{ route('admins.cuprimer.create') }}"><i class="fa fa-plus fa-fw""></i> Tambah CU</a>
                  </li>
                @endpermission   
                @permission('create.tpcu_create')   
                  <li class="{{ Request::is('admins/tpcu/create') ? 'active' : '' }}">
                    <a href="{{ route('admins.tpcu.create') }}"><i class="fa fa-plus fa-fw""></i> Tambah TP CU</a>
                  </li>
                @endpermission
                @permission('create.staf_create') 
                  <li class="{{ Request::is('admins/staf/create') ? 'active' : '' }}">
                    <a href="{{ route('admins.staf.create') }}"><i class="fa fa-plus fa-fw""></i> Tambah Staf CU</a>
                  </li>
                @endpermission
                @permission('create.cuprimer_create|create.cuprimer_create|create.staf_create')
                  <li class="divider"></li>
                @endpermission
                @permission('view.cuprimer_view|view.wilayahcuprimer_view')
                  <li class="{{ Request::is('admins/cuprimer') ? 'active' : '' }}">
                    <a href="{{ $cu == '0' ? route('admins.cuprimer.index') : route('admins.cuprimer.detail',array($cu)) }}"><i class="fa fa-building fa-fw""></i> CU</a>
                  </li>
                @endpermission
                @permission('view.tpcu_view')    
                  <li class="{{ Request::is('admins/tpcu') ? 'active' : '' }}">
                    <a href="{{ $cu == '0' ? route('admins.tpcu.index') : route('admins.tpcu.index_cu',array($cu)) }}"><i class="fa fa-home fa-fw""></i> TP CU</a>
                  </li>
                @endpermission
                @permission('view.staf_view')    
                  <li class="{{ Request::is('admins/staf') ? 'active' : '' }}">
                    <a href="{{ $cu == '0' ? route('admins.staf.index') : route('admins.staf.index_cu',array($cu)) }}"><i class="fa fa-sitemap fa-fw""></i> Staf CU</a>
                  </li>
                @endpermission  
              </ul>
            </li>
            @endpermission
            @permission('view.admin_view')
              <li class="{{ Request::is('admins/admin') ? 'active' : '' }}"><a href="#" data-toggle="modal" data-target="#modalcheckpass"><i class="fa fa-user-circle-o fa-fw"></i> Admin <span class="sr-only">(current)</span></a></li>
            @endpermission  
            <li><a href="{{ route('panduan') }}" target="_blank"><i class="fa fa-question-circle-o fa-fw"></i> Panduan</a></li>
          </ul>
        </div>
        <!-- /.navbar-collapse -->
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" onclick="notifikasi()" title="Lihat notifikasi">
                      <i class="fa fa-bell-o"></i>
                      @if(!empty($user->unreadNotifications ) && count($user->unreadNotifications ) > 0)
                        <span class="label label-warning" id="notifikasi_icon">{{ count($user->unreadNotifications ) }}</span>
                      @endif
                    </a>
                    <ul class="dropdown-menu" >
                        @if(!empty($user->notifications) && count($user->notifications) > 0 )
                        <li class="header">Kamu memiliki <span id="notifikasi_count">{{ count($user->unreadNotifications ) }}</span> pemberitahuan</li>
                        <li>
                          <!-- inner menu: contains the actual data -->
                          <ul class="menu">
                            @foreach($user->notifications as $i => $notification)
                            <?php
                                if ($i > 5) break;
                                $username = App\User::where('id',$notification->data['user'])->select('name')->first();
                            ?>
                            <li>
                                @if(strtolower($notification->data['tipe']) == 'menambah laporancu')
                                    <a href="{{ route('admins.laporancu.detail',array($notification->data['url'])) }}" style="white-space: normal;">
                                    <i class="fa fa-line-chart text-aqua"></i><b class="text-aqua">
                                @elseif(strtolower($notification->data['tipe']) == 'mengubah laporancu')
                                    <a href="{{ route('admins.laporancu.detail',array($notification->data['url'])) }}" style="white-space: normal;">
                                    <i class="fa fa-line-chart text-warning"></i><b class="text-warning">
                                @elseif(strtolower($notification->data['tipe']) == 'menghapus laporancu')
                                    <a href="{{ route('admins.laporancu.detail',array($notification->data['url'])) }}" style="white-space: normal;">
                                    <i class="fa fa-line-chart text-danger"></i><b class="text-danger">
                                @elseif(strtolower($notification->data['tipe']) == 'menulis diskusilaporan')
                                    <a href="{{ route('admins.laporancu.detail',array($notification->data['url'])) }}" style="white-space: normal;">
                                    <i class="fa fa-commenting-o text-aqua"></i><b class="text-aqua">
                                @elseif(strtolower($notification->data['tipe']) == 'mengubah diskusilaporan')
                                    <a href="{{ route('admins.laporancu.detail',array($notification->data['url'])) }}" style="white-space: normal;">
                                    <i class="fa fa-commenting-o text-warning"></i><b class="text-warning">
                                @elseif(strtolower($notification->data['tipe']) == 'menghapus diskusilaporan')
                                    <a href="{{ route('admins.laporancu.detail',array($notification->data['url'])) }}" style="white-space: normal;">
                                    <i class="fa fa-commenting-o text-danger"></i><b class="text-danger">
                                @endif
                                {{ $username->name }} [{{ $notification->data['cu'] }}]</b>
                                <?php $date = new Date($notification->created_at); ?>
                                {{ $notification->data['message'] }}<br/>

                                @if(!empty($notification->data['message2']))
                                    <div class="well well-sm" style="margin-bottom: 0px;">{{ $notification->data['message2']}}</div>
                                @endif

                                <small class="text-muted">{{ $date->format('d F') }} • {{ $date->format('H:i') }}</small>
                                </a>
                            </li>
                            @endforeach
                          </ul>
                        </li>
                        <li class="footer"><a href="{{ route('admins.pemberitahuan') }}">Lihat semua</a></li>
                        @else
                            <li class="header">Kamu memiliki tidak memiliki pemberitahuan.</li>
                        @endif
                    </ul>
                </li>
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    @if(!empty($gambar) && is_file($imagepath.$gambar.".jpg"))
                        <img src="{!! asset($imagepath.$gambar.".jpg") !!}" class="user-image" alt="User Image" />
                    @else
                        <img src="{!! asset($imagepath."user.jpg") !!}" class="user-image" alt="User Image" />
                    @endif
                    <span class="hidden-xs">{{ Auth::user()->getName() }} - {{ $name_cu }}</span></a>
                    <ul class="dropdown-menu">
                      <li class="user-header">
                        @if(!empty($gambar) && is_file($imagepath.$gambar.".jpg"))
                            <img src="{!! asset($imagepath.$gambar.".jpg") !!}" class="img-circle" alt="User Image" />
                        @else
                            <img src="{!! asset($imagepath."user.jpg") !!}" class="img-circle" alt="User Image" />
                        @endif
                        <p>
                          {{ Auth::user()->getName() }} <small>{{ $name_cu }}</small>
                        </p>
                      </li>
                      <li class="user-footer">
                        <div class="pull-left">
                            <a href="@permission('detail.admin_detail'){{ route('admins.admin.detail',array($iduser)) }}@endpermission" class="btn btn-default btn-flat"><i class="fa fa-fw fa-user"></i> Profil</a>
                        </div>
                        <div class="pull-right">
                            <a href="#" class="btn btn-default btn-flat modalsignout" data-toggle="modal" data-target="#modalsignout"><i class="fa fa-fw fa-sign-out"></i> Logout</a>
                        </div>
                      </li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- /.navbar-custom-menu -->
    </nav>
  </header>

  @section('jsnotif')
<script>
  function notifikasi(){
    $('#notifikasi_count').html('0');
    $('#notifikasi_icon').hide();

    var notif_count = {{ count($user->notifications) }};
    var id = {{ $user->getId() }};

    if(notif_count > 0){
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

      $.ajax({
          type: 'POST',
          url: '/admins/notifikasi/read',
          data: {'id': id},
          cache: false,
          error: function(xhr, textstatus,errorThrown){
            console.log(xhr,textstatus,errorThrown);
          }
      });
    }
  }
</script>
@stop