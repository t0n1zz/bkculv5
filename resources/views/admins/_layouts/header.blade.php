<?php
    $gambar = Auth::user()->getGambar();
    $imagepath = 'images/';

    // if(Auth::user()->getLogout() != "0000-00-00 00:00:00"){
    //     $date = new Date(Auth::user()->getLogout());
    //     $tanggal = "Terakhir Login: ".$date->format('j F Y | H:i:s');
    // }else{
    //     $tanggal = "Belum pernah login";
    // }

    $id_cu = Auth::user()->getCU();
    if($id_cu == '0'){
        $name_cu = 'BKCU';
    }else{
        $cuprimer = App\Models\Cuprimer::where('id','=',$id_cu)->select('name')->first();
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
                <li><a href="#" ><i class="fa fa-fw fa-user-circle-o"></i> {{ Auth::user()->getName() }} - {{ $name_cu }}</a></li>
                <li><a href="#" class="modalsignout" data-toggle="modal" data-target="#modalsignout"><i class="fa fa-fw fa-sign-out" ></i> Logout</a></li>
            </ul>
        </div>
        <!-- /navbar right menu -->
    </nav>
    <!-- /header navbar -->
</header>

