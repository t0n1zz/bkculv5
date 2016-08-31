<header class="main-header">
    <!-- logo -->
    <a class="logo" href="{!! route('admins') !!}" style="font-size: 1em">
        <span class="logo-mini"><img src="{!! asset('images/logo.png') !!}" width="30" alt="logo"></span>
        <span class="logo-lg">Puskopdit <b>BKCU Kalimantan</b></span>
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
                    <?php
                        $gambar = Auth::user()->getGambar();
                        $imagepath = 'images/';

                        if(Auth::user()->getLogout() != "0000-00-00 00:00:00"){
                            $date = new Date(Auth::user()->getLogout());
                            $tanggal = $date->format('l, j F Y, H:i:s');
                        }else{
                            $tanggal = "Belum pernah login";
                        }
                    ?>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        @if(!empty($gambar) && is_file($imagepath.$gambar.".jpg"))
                            <img src="{!! asset($imagepath.$gambar.".jpg") !!}" class="user-image" alt="User Image" />
                        @else
                            <img src="{!! asset($imagepath."user.png") !!}" class="user-image" alt="User Image" />
                        @endif
                        <span class="hidden-xs">{!! Auth::user()->getName() !!}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            @if(!empty($gambar) && is_file($imagepath.$gambar.".jpg"))
                                <img src="{!! asset($imagepath.$gambar.".jpg") !!}" class="img-circle" alt="User Image" />
                            @else
                                <img src="{!! asset($imagepath."user.png") !!}" class="img-circle" alt="User Image" />
                            @endif
                            <p>
                                {!! Auth::user()->getName() !!}
                                <small>Terakhir login pada : <br/>{!! $tanggal !!}</small>
                            </p>
                        </li>
                        <li class="user-footer">
                            <!-- <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">Profile</a>
                            </div> -->
                            <div class="pull-right">
                                <a href="{!! route('admins.logout') !!}" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- /navbar right menu -->
    </nav>
    <!-- /header navbar -->
</header>

