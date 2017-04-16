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
    
    if($cu == '0'){
        $name_cu = 'BKCU';
    }else{
        $cuprimer = App\Cuprimer::withTrashed()->where('no_ba','=',$cu)->select('name')->first();
        $name_cu = $cuprimer->name;
    }
?>
<header class="main-header">
    <!-- logo -->
    <a class="logo" href="{!! route('admins') !!}" >
        <span class="logo-mini"><img src="{!! asset('images/logo.png') !!}" width="30" alt="logo"></span>
        <span class="logo-lg"><b>SIMO</b></span>
    </a>
    <!-- /logo -->
    <!-- header navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- toggle -->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle Navigation</span>
        </a>
        <!-- /toggle -->
        <!-- navbar right menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" style="pointer-events:none; cursor:default;">
                    @if(!empty($gambar) && is_file($imagepath.$gambar.".jpg"))
                            <img src="{!! asset($imagepath.$gambar.".jpg") !!}" class="user-image" alt="User Image" />
                    @else
                            <img src="{!! asset($imagepath."user.jpg") !!}" class="user-image" alt="User Image" />
                    @endif
                    {{ Auth::user()->getName() }} - {{ $name_cu }}</a>
                </li>
                <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" onclick="notifikasi()" title="Lihat notifikasi">
                      <i class="fa fa-bell-o"></i>
                      @if(!empty($user->unreadNotifications ) && count($user->unreadNotifications ) > 0)
                        <span class="label label-warning" id="notifikasi_icon">{{ count($user->unreadNotifications ) }}</span>
                      @endif
                    </a>
                    <ul class="dropdown-menu" style="width: 70vh;">
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
                <li><a href="#" class="modalsignout" data-toggle="modal" data-target="#modalsignout"><i class="fa fa-fw fa-sign-out" title="Keluar dari aplikasi"></i> Logout</a></li>
            </ul>
        </div>
        <!-- /navbar right menu -->
    </nav>
    <!-- /header navbar -->
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
