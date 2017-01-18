<?php
    $gambar = Auth::user()->getGambar();
    $imagepath = 'images/';

    // if(Auth::user()->getLogout() != "0000-00-00 00:00:00"){
    //     $date = new Date(Auth::user()->getLogout());
    //     $tanggal = "Terakhir Login: ".$date->format('j F Y | H:i:s');
    // }else{
    //     $tanggal = "Belum pernah login";
    // }

    $cu = Auth::user()->getCU();
    if($cu == '0'){
        $name_cu = 'BKCU';
    }else{
        $cuprimer = App\Models\Cuprimer::where('no_ba','=',$cu)->select('name')->first();
        $name_cu = $cuprimer->name;
    }
?>
<header class="main-header">
    <!-- logo -->
    <a class="logo" href="{!! route('admins') !!}" >
        <span class="logo-mini"><img src="{!! asset('images/logo.png') !!}" width="30" alt="logo"></span>
        <span class="logo-lg"><b>Admin</b>BKCU</span>
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
                <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <i class="fa fa-bell-o"></i>
                      <span class="label label-warning">10</span>
                    </a>
                    <ul class="dropdown-menu">
                      <li class="header">You have 10 notifications</li>
                      <li>
                        <!-- inner menu: contains the actual data -->
                        <ul class="menu">
                          <li>
                            <a href="#">
                              <i class="fa fa-users text-aqua"></i> 5 new members joined today
                            </a>
                          </li>
                          <li>
                            <a href="#">
                              <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the
                              page and may cause design problems
                            </a>
                          </li>
                          <li>
                            <a href="#">
                              <i class="fa fa-users text-red"></i> 5 new members joined
                            </a>
                          </li>
                          <li>
                            <a href="#">
                              <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                            </a>
                          </li>
                          <li>
                            <a href="#">
                              <i class="fa fa-user text-red"></i> You changed your username
                            </a>
                          </li>
                        </ul>
                      </li>
                      <li class="footer"><a href="#">View all</a></li>
                    </ul>
                </li>
                <li class="dropdown user user-menu"><a href="#" >
                    @if(!empty($gambar) && is_file($imagepath.$gambar.".jpg"))
                            <img src="{!! asset($imagepath.$gambar.".jpg") !!}" class="user-image" alt="User Image" />
                    @else
                            <img src="{!! asset($imagepath."user.png") !!}" class="user-image" alt="User Image" />
                    @endif

                 {{ Auth::user()->getName() }} - {{ $name_cu }}</a></li>
                <li><a href="#" class="modalsignout" data-toggle="modal" data-target="#modalsignout"><i class="fa fa-fw fa-sign-out" ></i> Logout</a></li>
            </ul>
        </div>
        <!-- /navbar right menu -->
    </nav>
    <!-- /header navbar -->
</header>

