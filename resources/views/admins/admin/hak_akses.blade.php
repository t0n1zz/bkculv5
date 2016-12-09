<div class="table-responsive">
<table class="table table-condensed">
    <?php $akses= "pengumuman"; $logo= "fa-comments-o"; ?>
    <tr id="{{ $akses }}" class="bkcu">
        <td class="bg-light-blue-active color-palette">
            <h5 class="hakakses-title"><i class="fa {{ $logo }} fa-fw"></i> {{ ucfirst($akses) }}</h5>
        </td>
        <td>
            <div class="checkbox">
                <label><input name="{{$akses}}_view" value="1" type="checkbox" id="{{$akses}}_view" 
                    @if(!empty($data)) @if($data->can($akses.'_view')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-eye"></i> Lihat</label>
            </div>
        </td>
        <td>
            <div class="checkbox">
                <label><input name="{{$akses}}_create" value="1" type="checkbox" id="{{$akses}}_create" 
                    @if(!empty($data)) @if($data->can($akses.'_create')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-plus"></i> Tambah</label>
            </div>
        </td>
        <td>
            <div class="checkbox">
                <label><input name="{{$akses}}_update" value="1" type="checkbox" id="{{$akses}}_update" 
                    @if(!empty($data)) @if($data->can($akses.'_update')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-pencil"></i> Ubah</label>
            </div>
        </td>
        <td>
            <div class="checkbox">
                <label><input name="{{$akses}}_destroy" value="1" type="checkbox" id="{{$akses}}_destroy"
                    @if(!empty($data)) @if($data->can($akses.'_destroy')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-trash"></i> Hapus</label>
            </div> 
        </td>
        <td
            <div class="checkbox">
                <label><input name="{{$akses}}_update_urutan" value="1" type="checkbox" id="{{$akses}}_update_urutan" 
                    @if(!empty($data)) @if($data->can($akses.'_update')) {{ 'checked' }} @endif @endif
                    /><i class="fa fa-ellipsis-v"></i> Urutan</label>
            </div>
        </td>
    </tr>
    <?php $akses= "saran"; $logo= "fa-paper-plane-o"; ?>
    <tr id="{{ $akses }}" class="bkcu">
        <td class="bg-light-blue-active color-palette"><h5 class="hakakses-title"><i class="fa {{ $logo }} fa-fw"></i> {{ ucfirst($akses) }}</h5></td>
        <td>
            <div class="checkbox">
                <label><input name="{{$akses}}_view" value="1" type="checkbox" id="{{$akses}}_view" 
                    @if(!empty($data)) @if($data->can($akses.'_view')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-eye"></i> Lihat</label>
            </div>
        </td>
        <td>
            <div class="checkbox">
                <label><input name="{{$akses}}_destroy" value="1" type="checkbox" id="{{$akses}}_destroy"
                    @if(!empty($data)) @if($data->can($akses.'_destroy')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-trash"></i> Hapus</label>
            </div>
        </td>
    </tr>
    <?php $akses= "statistikweb"; $logo= "fa-road"; ?>
    <tr id="{{ $akses }}" class="bkcu">
        <td class="bg-light-blue-active color-palette"><h5 class="hakakses-title"><i class="fa {{ $logo }} fa-fw"></i> Statistik Website</h5></td>
        <td><div class="checkbox">
                <label><input name="{{$akses}}_view" value="1" type="checkbox" id="{{$akses}}_view" 
                    @if(!empty($data)) @if($data->can($akses.'_view')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-eye"></i> Lihat</label>
            </div>
        </td>
    </tr>
    <?php $akses= "artikel"; $logo= "fa-book"; ?>
    <tr id="{{ $akses }}">
        <td rowspan="2" class="bg-light-blue-active color-palette"><h5 class="hakakses-title"><i class="fa {{ $logo }} fa-fw"></i> {{ ucfirst($akses) }}</h5></td>
        <td>
            <div class="checkbox">
                <label><input name="{{$akses}}_view" value="1" type="checkbox" id="{{$akses}}_view" 
                    @if(!empty($data)) @if($data->can($akses.'_view')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-eye"></i> Lihat</label>
            </div>
        </td>
        <td>
            <div class="checkbox">
                <label><input name="{{$akses}}_create" value="1" type="checkbox" id="{{$akses}}_create" 
                    @if(!empty($data)) @if($data->can($akses.'_create')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-plus"></i> Tambah</label>
            </div>
        </td>
        <td><div class="checkbox">
                <label><input name="{{$akses}}_update" value="1" type="checkbox" id="{{$akses}}_update" 
                    @if(!empty($data)) @if($data->can($akses.'_update')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-pencil"></i> Ubah</label>
            </div>
        </td>
        <td><div class="checkbox">
                <label><input name="{{$akses}}_destroy" value="1" type="checkbox" id="{{$akses}}_destroy"
                    @if(!empty($data)) @if($data->can($akses.'_destroy')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-trash"></i> Hapus</label>
            </div>
        </td>
        <td class="bkcu"><div class="checkbox" >
                <label><input name="{{$akses}}_update_status" value="1" type="checkbox" id="{{$akses}}_update_status"
                    @if(!empty($data)) @if($data->can($akses.'_destroy')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-check-square"></i> Status</label>
            </div>
        </td>
    </tr>
    <tr>
        <td class="bkcu"><div class="checkbox" >
                <label><input name="{{$akses}}_update_pilihan" value="1" type="checkbox" id="{{$akses}}_update_pilihan"
                    @if(!empty($data)) @if($data->can($akses.'_destroy')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-dot-circle-o"></i> Pilihan</label>
            </div>
        </td>
    </tr>
    <?php $akses= "kategoriartikel"; $logo= "fa-book"; ?>
    <tr id="{{ $akses }}" class="bkcu">
        <td class="bg-light-blue-active color-palette"><h5 class="hakakses-title"><i class="fa {{ $logo }} fa-fw"></i> Kategori Artikel</h5></td>
        <td><div class="checkbox">
                <label><input name="{{$akses}}_view" value="1" type="checkbox" id="{{$akses}}_view" 
                    @if(!empty($data)) @if($data->can($akses.'_view')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-eye"></i> Lihat</label>
            </div>
        </td>
        <td><div class="checkbox">
                <label><input name="{{$akses}}_create" value="1" type="checkbox" id="{{$akses}}_create" 
                    @if(!empty($data)) @if($data->can($akses.'_create')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-plus"></i> Tambah</label>
            </div>
        </td>
        <td><div class="checkbox">
                <label><input name="{{$akses}}_update" value="1" type="checkbox" id="{{$akses}}_update" 
                    @if(!empty($data)) @if($data->can($akses.'_update')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-pencil"></i> Ubah</label>
            </div>
        </td>
        <td><div class="checkbox">
                <label><input name="{{$akses}}_destroy" value="1" type="checkbox" id="{{$akses}}_destroy"
                    @if(!empty($data)) @if($data->can($akses.'_destroy')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-trash"></i> Hapus</label>
            </div>
        </td>
    </tr>
    <?php $akses= "kegiatan"; $logo= "fa-suitcase"; ?>
    <tr id="{{ $akses }}">
        <td class="bg-light-blue-active color-palette"><h5 class="hakakses-title"><i class="fa {{ $logo }} fa-fw"></i> {{ ucfirst($akses) }}</h5></td>
        <td><div class="checkbox">
                <label><input name="{{$akses}}_view" value="1" type="checkbox" id="{{$akses}}_view" 
                    @if(!empty($data)) @if($data->can($akses.'_view')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-eye"></i> Lihat</label>
            </div>
        </td>
        <td class="bkcu"><div class="checkbox">
                <label><input name="{{$akses}}_create" value="1" type="checkbox" id="{{$akses}}_create" 
                    @if(!empty($data)) @if($data->can($akses.'_create')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-plus"></i> Tambah</label>
            </div>
        </td>
        <td class="bkcu"><div class="checkbox">
                <label><input name="{{$akses}}_update" value="1" type="checkbox" id="{{$akses}}_update" 
                    @if(!empty($data)) @if($data->can($akses.'_update')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-pencil"></i> Ubah</label>
            </div>
        </td>
        <td class="bkcu"><div class="checkbox">
                <label><input name="{{$akses}}_destroy" value="1" type="checkbox" id="{{$akses}}_destroy"
                    @if(!empty($data)) @if($data->can($akses.'_destroy')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-trash"></i> Hapus</label>
            </div>
        </td>
    </tr>
    <?php $akses= "kegiatandetail"; $logo= "fa-suitcase"; ?>
    <tr id="{{ $akses }}" class="bkcu">
        <td class="bg-light-blue-active color-palette"><h5 class="hakakses-title"><i class="fa {{ $logo }} fa-fw"></i> Kegiatan (Detail)</h5></td>
        <td><div class="checkbox">
                <label><input name="{{$akses}}_view" value="1" type="checkbox" id="{{$akses}}_view" 
                    @if(!empty($data)) @if($data->can($akses.'_view')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-eye"></i> Lihat</label>
            </div>
        </td>
        <td><div class="checkbox">
                <label><input name="{{$akses}}_peserta" value="1" type="checkbox" id="{{$akses}}_peserta" 
                    @if(!empty($data)) @if($data->can($akses.'_peserta')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-user"></i> Peserta</label>
            </div>
        </td>
        <td><div class="checkbox">
                <label><input name="{{$akses}}_biaya" value="1" type="checkbox" id="{{$akses}}_biaya" 
                    @if(!empty($data)) @if($data->can($akses.'_biaya')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-calculator"></i> Biaya</label>
            </div>
        </td>
        <td><div class="checkbox">
                <label><input name="{{$akses}}_evaluasi" value="1" type="checkbox" id="{{$akses}}_evaluasi"
                    @if(!empty($data)) @if($data->can($akses.'_evaluasi')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-edit"></i> Evaluasi</label>
            </div>
        </td>
    </tr>
    <?php $akses= "cuprimer"; $logo= "fa-building-o"; ?>
    <tr id="{{ $akses }}">
        <td class="bg-light-blue-active color-palette"><h5 class="hakakses-title"><i class="fa {{ $logo }} fa-fw"></i> CU</h5></td>
        <td><div class="checkbox">
                <label><input name="{{$akses}}_view" value="1" type="checkbox" id="{{$akses}}_view" 
                    @if(!empty($data)) @if($data->can($akses.'_view')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-eye"></i> Lihat</label>
            </div>
        </td>
        <td class="bkcu"><div class="checkbox">
                <label><input name="{{$akses}}_create" value="1" type="checkbox" id="{{$akses}}_create" 
                    @if(!empty($data)) @if($data->can($akses.'_create')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-plus"></i> Tambah</label>
            </div>
        </td>
        <td><div class="checkbox">
                <label><input name="{{$akses}}_update" value="1" type="checkbox" id="{{$akses}}_update" 
                    @if(!empty($data)) @if($data->can($akses.'_update')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-pencil"></i> Ubah</label>
            </div>
        </td>
        <td class="bkcu"><div class="checkbox">
                <label><input name="{{$akses}}_destroy" value="1" type="checkbox" id="{{$akses}}_destroy"
                    @if(!empty($data)) @if($data->can($akses.'_destroy')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-trash"></i> Hapus</label>
            </div>
        </td>
    </tr>
    <?php $akses= "tpcu"; $logo= "fa-building-o"; ?>
    <tr id="{{ $akses }}">
        <td class="bg-light-blue-active color-palette"><h5 class="hakakses-title"><i class="fa {{ $logo }} fa-fw"></i> TP CU</h5></td>
        <td><div class="checkbox">
                <label><input name="{{$akses}}_view" value="1" type="checkbox" id="{{$akses}}_view" 
                    @if(!empty($data)) @if($data->can($akses.'_view')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-eye"></i> Lihat</label>
            </div>
        </td>
        <td><div class="checkbox">
                <label><input name="{{$akses}}_create" value="1" type="checkbox" id="{{$akses}}_create" 
                    @if(!empty($data)) @if($data->can($akses.'_create')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-plus"></i> Tambah</label>
            </div>
        </td>
        <td><div class="checkbox">
                <label><input name="{{$akses}}_update" value="1" type="checkbox" id="{{$akses}}_update" 
                    @if(!empty($data)) @if($data->can($akses.'_update')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-pencil"></i> Ubah</label>
            </div>
        </td>
        <td><div class="checkbox">
                <label><input name="{{$akses}}_destroy" value="1" type="checkbox" id="{{$akses}}_destroy"
                    @if(!empty($data)) @if($data->can($akses.'_destroy')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-trash"></i> Hapus</label>
            </div>
        </td>
    </tr>
    <?php $akses= "wilayahcuprimer"; $logo= "fa-building-o"; ?>
    <tr id="{{ $akses }}" class="bkcu">
        <td class="bg-light-blue-active color-palette"><h5 class="hakakses-title"><i class="fa {{ $logo }} fa-fw"></i> Wilayah CU</h5></td>
        <td><div class="checkbox">
                <label><input name="{{$akses}}_view" value="1" type="checkbox" id="{{$akses}}_view" 
                    @if(!empty($data)) @if($data->can($akses.'_view')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-eye"></i> Lihat</label>
            </div>
        </td>
        <td><div class="checkbox">
                <label><input name="{{$akses}}_create" value="1" type="checkbox" id="{{$akses}}_create" 
                    @if(!empty($data)) @if($data->can($akses.'_create')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-plus"></i> Tambah</label>
            </div>
        </td>
        <td><div class="checkbox">
                <label><input name="{{$akses}}_update" value="1" type="checkbox" id="{{$akses}}_update" 
                    @if(!empty($data)) @if($data->can($akses.'_update')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-pencil"></i> Ubah</label>
            </div>
        </td>
        <td><div class="checkbox">
                <label><input name="{{$akses}}_destroy" value="1" type="checkbox" id="{{$akses}}_destroy"
                    @if(!empty($data)) @if($data->can($akses.'_destroy')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-trash"></i> Hapus</label>
            </div>
        </td>
    </tr>
    <?php $akses= "laporancu"; $logo= "fa-line-chart"; ?>
    <tr id="{{ $akses }}">
        <td class="bg-light-blue-active color-palette"><h5 class="hakakses-title"><i class="fa {{ $logo }} fa-fw"></i> Laporan CU</h5></td>
        <td><div class="checkbox">
                <label><input name="{{$akses}}_view" value="1" type="checkbox" id="{{$akses}}_view" 
                    @if(!empty($data)) @if($data->can($akses.'_view')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-eye"></i> Lihat</label>
            </div>
        </td>
        <td><div class="checkbox">
                <label><input name="{{$akses}}_create" value="1" type="checkbox" id="{{$akses}}_create" 
                    @if(!empty($data)) @if($data->can($akses.'_create')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-plus"></i> Tambah</label>
            </div>
        </td>
        <td><div class="checkbox">
                <label><input name="{{$akses}}_update" value="1" type="checkbox" id="{{$akses}}_update" 
                    @if(!empty($data)) @if($data->can($akses.'_update')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-pencil"></i> Ubah</label>
            </div>
        </td>
        <td><div class="checkbox">
                <label><input name="{{$akses}}_destroy" value="1" type="checkbox" id="{{$akses}}_destroy"
                    @if(!empty($data)) @if($data->can($akses.'_destroy')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-trash"></i> Hapus</label>
            </div>
        </td>
        <td><div class="checkbox">
                <label><input name="{{$akses}}_upload" value="1" type="checkbox" id="{{$akses}}_upload"
                    @if(!empty($data)) @if($data->can($akses.'_upload')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-upload"></i> Upload</label>
            </div>
        </td>
    </tr>
    <?php $akses= "staf"; $logo= "fa-users"; ?>
    <tr id="{{ $akses }}">
        <td class="bg-light-blue-active color-palette"><h5 class="hakakses-title"><i class="fa {{ $logo }} fa-fw"></i> {{ ucfirst($akses) }}</h5></td>
        <td><div class="checkbox">
                <label><input name="{{$akses}}_view" value="1" type="checkbox" id="{{$akses}}_view" 
                    @if(!empty($data)) @if($data->can($akses.'_view')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-eye"></i> Lihat</label>
            </div>
        </td>
        <td><div class="checkbox">
                <label><input name="{{$akses}}_create" value="1" type="checkbox" id="{{$akses}}_create" 
                    @if(!empty($data)) @if($data->can($akses.'_create')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-plus"></i> Tambah</label>
            </div>
        </td>
        <td><div class="checkbox">
                <label><input name="{{$akses}}_update" value="1" type="checkbox" id="{{$akses}}_update" 
                    @if(!empty($data)) @if($data->can($akses.'_update')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-pencil"></i> Ubah</label>
            </div>
        </td>
        <td><div class="checkbox">
                <label><input name="{{$akses}}_destroy" value="1" type="checkbox" id="{{$akses}}_destroy"
                    @if(!empty($data)) @if($data->can($akses.'_destroy')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-trash"></i> Hapus</label>
            </div>
        </td>
    </tr>
    <?php $akses= "stafdetail"; $logo= "fa-users"; ?>
    <tr id="{{ $akses }}" class="bkcu">
        <td class="bg-light-blue-active color-palette"><h5 class="hakakses-title"><i class="fa {{ $logo }} fa-fw"></i> Staf (Detail)</h5></td>
        <td><div class="checkbox">
                <label><input name="{{$akses}}_view" value="1" type="checkbox" id="{{$akses}}_view" 
                    @if(!empty($data)) @if($data->can($akses.'_view')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-eye"></i> Lihat</label>
            </div>
        </td>
        <td><div class="checkbox">
                <label><input name="{{$akses}}_riwayat" value="1" type="checkbox" id="{{$akses}}_riwayat" 
                    @if(!empty($data)) @if($data->can($akses.'_riwayat')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-address-card-o"></i> Riwayat</label>
            </div>
        </td>
        <td><div class="checkbox">
                <label><input name="{{$akses}}_kegiatan" value="1" type="checkbox" id="{{$akses}}_kegiatan" 
                    @if(!empty($data)) @if($data->can($akses.'_kegiatan')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-calendar"></i> Kegiatan</label>
            </div>
        </td>
    </tr>
    <?php $akses= "download"; $logo="fa-download"; ?>
    <tr id="{{ $akses }}" class="bkcu">
        <td class="bg-light-blue-active color-palette"><h5 class="hakakses-title"><i class="fa {{ $logo }} fa-fw"></i> {{ ucfirst($akses) }}</h5></td>
        <td><div class="checkbox">
                <label><input name="{{$akses}}_view" value="1" type="checkbox" id="{{$akses}}_view" 
                    @if(!empty($data)) @if($data->can($akses.'_view')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-eye"></i> Lihat</label>
            </div>
        </td>
        <td><div class="checkbox">
                <label><input name="{{$akses}}_create" value="1" type="checkbox" id="{{$akses}}_create" 
                    @if(!empty($data)) @if($data->can($akses.'_create')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-plus"></i> Tambah</label>
            </div>
        </td>
        <td><div class="checkbox">
                <label><input name="{{$akses}}_update" value="1" type="checkbox" id="{{$akses}}_update" 
                    @if(!empty($data)) @if($data->can($akses.'_update')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-pencil"></i> Ubah</label>
            </div>
        </td>
        <td><div class="checkbox">
                <label><input name="{{$akses}}_destroy" value="1" type="checkbox" id="{{$akses}}_destroy"
                    @if(!empty($data)) @if($data->can($akses.'_destroy')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-trash"></i> Hapus</label>
            </div>
        </td>
    </tr>
    <?php $akses= "admin"; $logo="fa-user-circle-o"; ?>
    <tr id="{{ $akses }}">
        <td rowspan="2" class="bg-light-blue-active color-palette"><h5 class="hakakses-title"><i class="fa {{ $logo }} fa-fw"></i> {{ ucfirst($akses) }}</h5></td>
        <td class="bkcu"><div class="checkbox">
                <label><input name="{{$akses}}_view" value="1" type="checkbox" id="{{$akses}}_view" 
                    @if(!empty($data)) @if($data->can($akses.'_view')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-eye"></i> Lihat</label>
            </div>
        </td>
        <td class="bkcu"><div class="checkbox">
                <label><input name="{{$akses}}_create" value="1" type="checkbox" id="{{$akses}}_create" 
                    @if(!empty($data)) @if($data->can($akses.'_create')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-plus"></i> Tambah</label>
            </div>
        </td>
        
        <td class="bkcu"><div class="checkbox">
                <label><input name="{{$akses}}_destroy" value="1" type="checkbox" id="{{$akses}}_destroy"
                    @if(!empty($data)) @if($data->can($akses.'_destroy')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-trash"></i> Hapus</label>
            </div>
        </td>
        <td><div class="checkbox">
                <label><input name="{{$akses}}_detail" value="1" type="checkbox" id="{{$akses}}_detail"
                    @if(!empty($data)) @if($data->can($akses.'_status')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-id-badge"></i> Detail</label>
            </div>
        </td>
        <td><div class="checkbox">
                <label><input name="{{$akses}}_update_password" value="1" type="checkbox" id="{{$akses}}_update_password" 
                    @if(!empty($data)) @if($data->can($akses.'_update_password')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-key"></i> Password</label>
            </div>
        </td>
    </tr>
    <tr>
        <td class="bkcu"><div class="checkbox">
                <label><input name="{{$akses}}_update_akses" value="1" type="checkbox" id="{{$akses}}_update_akses"
                    @if(!empty($data)) @if($data->can($akses.'_update_akses')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-hand-paper-o"></i> Akses</label>
            </div>
        </td>
        <td class="bkcu"><div class="checkbox">
                <label><input name="{{$akses}}_update_status" value="1" type="checkbox" id="{{$akses}}_update_status"
                    @if(!empty($data)) @if($data->can($akses.'_status')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-check-square"></i> Status</label>
            </div>
        </td>
    </tr>
</table>
</div>



