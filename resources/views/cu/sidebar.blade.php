<div class="col-md-3">
        <h3 class="classic-title"><span>Navigasi</span></h3>
    <div class="list-group">
        <a href="{{ route('cu') }}" class="list-group-item
            @if($title == "Home")
                {{ "active" }}
            @endif
                ">
            <h4 class="list-group-item-heading"><i class="fa fa-fw fa-home"></i> Home</h4>
            <p class="list-group-item-text">Halaman Utama CU</p>
        </a>
        <a href="{{ route('cu.edit_info') }}" class="list-group-item
            @if($title == "Ubah Info")
                {{ "active" }}
            @endif
        ">
            <h4 class="list-group-item-heading"><i class="fa fa-fw fa-info"></i> Ubah Info</h4>
            <p class="list-group-item-text">Mengubah Informasi Dasar CU</p>
        </a>
        <a href="{{ route('cu.edit_deskripsi') }}" class="list-group-item
            @if($title == "Ubah Deskripsi")
                {{ "active" }}
            @endif
                ">
            <h4 class="list-group-item-heading"><i class="fa fa-fw fa-newspaper-o"></i> Ubah Deskripsi</h4>
            <p class="list-group-item-text">Mengubah Deskripsi CU</p>
        </a>
        <a href="{{ route('cu.kelola_staf') }}" class="list-group-item
            @if($title == "Kelola Staf")
        {{ "active" }}
        @endif
                ">
            <h4 class="list-group-item-heading"><i class="fa fa-fw fa-archive"></i> Kelola Staf CU</h4>
            <p class="list-group-item-text">Mengelola Data Staf CU</p>
        </a>
        <a href="{{ route('cu.logout') }}" class="list-group-item">
            <h4 class="list-group-item-heading"><i class="fa fa-fw fa-sign-out"></i> Logout</h4>
            <p class="list-group-item-text">Keluar dari halaman CU</p>
        </a>
    </div>
</div>