<table class="table table-striped table-condensed">
    <?php $akses= "pengumuman"; $logo= "fa-comments-o"; ?>
    <tr>
        <td><h5 class="hakakses-title"><i class="fa {{ $logo }}"></i> {{ ucfirst($akses) }}</h5></td>
        <td class="table-center"><div class="checkbox">
                <label><input name="{{$akses}}_index" value="1" type="checkbox" id="{{$akses}}_index" 
                    @if(!empty($data)) @if($data->can($akses.'_index')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-eye"></i> Lihat</label>
            </div>
        </td>
        <td class="table-center"><div class="checkbox">
                <label><input name="{{$akses}}_create" value="1" type="checkbox" id="{{$akses}}_create" 
                    @if(!empty($data)) @if($data->can($akses.'_create')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-plus"></i> Tambah</label>
            </div>
        </td>
        <td class="table-center"><div class="checkbox">
                <label><input name="{{$akses}}_update" value="1" type="checkbox" id="{{$akses}}_update" 
                    @if(!empty($data)) @if($data->can($akses.'_update')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-pencil"></i> Ubah</label>
            </div>
        </td>
        <td class="table-center">&nbsp;</td>
        <td class="table-center"><div class="checkbox">
                <label><input name="{{$akses}}_destroy" value="1" type="checkbox" id="{{$akses}}_destroy"
                    @if(!empty($data)) @if($data->can($akses.'_destroy')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-trash"></i> Hapus</label>
            </div>
        </td>
    </tr>
    <?php $akses= "saran"; $logo= "fa-paper-plane-o"; ?>
    <tr>
        <td><h5 class="hakakses-title"><i class="fa {{ $logo }}"></i> {{ ucfirst($akses) }}</h5></td>
        <td class="table-center"><div class="checkbox">
                <label><input name="{{$akses}}_index" value="1" type="checkbox" id="{{$akses}}_index" 
                    @if(!empty($data)) @if($data->can($akses.'_index')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-eye"></i> Lihat</label>
            </div>
        </td>
        <td class="table-center">&nbsp;</td>
        <td class="table-center">&nbsp;</td>
        <td class="table-center">&nbsp;</td>
        <td class="table-center"><div class="checkbox">
                <label><input name="{{$akses}}_destroy" value="1" type="checkbox" id="{{$akses}}_destroy"
                    @if(!empty($data)) @if($data->can($akses.'_destroy')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-trash"></i> Hapus</label>
            </div>
        </td>
    </tr>
    <?php $akses= "artikel"; $logo= "fa-book"; ?>
    <tr>
        <td><h5 class="hakakses-title"><i class="fa {{ $logo }}"></i> {{ ucfirst($akses) }}</h5></td>
        <td class="table-center"><div class="checkbox">
                <label><input name="{{$akses}}_index" value="1" type="checkbox" id="{{$akses}}_index" 
                    @if(!empty($data)) @if($data->can($akses.'_index')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-eye"></i> Lihat</label>
            </div>
        </td>
        <td class="table-center"><div class="checkbox">
                <label><input name="{{$akses}}_create" value="1" type="checkbox" id="{{$akses}}_create" 
                    @if(!empty($data)) @if($data->can($akses.'_create')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-plus"></i> Tambah</label>
            </div>
        </td>
        <td class="table-center"><div class="checkbox">
                <label><input name="{{$akses}}_update" value="1" type="checkbox" id="{{$akses}}_update" 
                    @if(!empty($data)) @if($data->can($akses.'_update')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-pencil"></i> Ubah</label>
            </div>
        </td>
        <td class="table-center">&nbsp;</td>
        <td class="table-center"><div class="checkbox">
                <label><input name="{{$akses}}_destroy" value="1" type="checkbox" id="{{$akses}}_destroy"
                    @if(!empty($data)) @if($data->can($akses.'_destroy')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-trash"></i> Hapus</label>
            </div>
        </td>
    </tr>
    <?php $akses= "kategoriartikel"; $judulakses="Kategori Artikel"; $logo= "fa-book"; ?>
    <tr>
        <td><h5 class="hakakses-title"><i class="fa {{ $logo }}"></i> {{ ucfirst($akses) }}</h5></td>
        <td class="table-center"><div class="checkbox">
                <label><input name="{{$akses}}_index" value="1" type="checkbox" id="{{$akses}}_index" 
                    @if(!empty($data)) @if($data->can($akses.'_index')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-eye"></i> Lihat</label>
            </div>
        </td>
        <td class="table-center"><div class="checkbox">
                <label><input name="{{$akses}}_create" value="1" type="checkbox" id="{{$akses}}_create" 
                    @if(!empty($data)) @if($data->can($akses.'_create')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-plus"></i> Tambah</label>
            </div>
        </td>
        <td class="table-center"><div class="checkbox">
                <label><input name="{{$akses}}_update" value="1" type="checkbox" id="{{$akses}}_update" 
                    @if(!empty($data)) @if($data->can($akses.'_update')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-pencil"></i> Ubah</label>
            </div>
        </td>
        <td class="table-center">&nbsp;</td>
        <td class="table-center"><div class="checkbox">
                <label><input name="{{$akses}}_destroy" value="1" type="checkbox" id="{{$akses}}_destroy"
                    @if(!empty($data)) @if($data->can($akses.'_destroy')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-trash"></i> Hapus</label>
            </div>
        </td>
    </tr>
    <?php $akses= "kegiatan"; $logo= "fa-calendar"; ?>
    <tr>
        <td><h5 class="hakakses-title"><i class="fa {{ $logo }}"></i> {{ ucfirst($akses) }}</h5></td>
        <td class="table-center"><div class="checkbox">
                <label><input name="{{$akses}}_index" value="1" type="checkbox" id="{{$akses}}_index" 
                    @if(!empty($data)) @if($data->can($akses.'_index')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-eye"></i> Lihat</label>
            </div>
        </td>
        <td class="table-center"><div class="checkbox">
                <label><input name="{{$akses}}_create" value="1" type="checkbox" id="{{$akses}}_create" 
                    @if(!empty($data)) @if($data->can($akses.'_create')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-plus"></i> Tambah</label>
            </div>
        </td>
        <td class="table-center"><div class="checkbox">
                <label><input name="{{$akses}}_update" value="1" type="checkbox" id="{{$akses}}_update" 
                    @if(!empty($data)) @if($data->can($akses.'_update')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-pencil"></i> Ubah</label>
            </div>
        </td>
        <td class="table-center"><div class="checkbox">
                <label><input name="{{$akses}}_detail" value="1" type="checkbox" id="{{$akses}}_detail"
                    @if(!empty($data)) @if($data->can($akses.'detail')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-database"></i> Detail</label>
            </div>
        </td>
        <td class="table-center"><div class="checkbox">
                <label><input name="{{$akses}}_destroy" value="1" type="checkbox" id="{{$akses}}_destroy"
                    @if(!empty($data)) @if($data->can($akses.'_destroy')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-trash"></i> Hapus</label>
            </div>
        </td>
    </tr>
    <?php $akses= "cu"; $logo= "fa-building-o"; ?>
    <tr>
        <td><h5 class="hakakses-title"><i class="fa {{ $logo }}"></i> {{ ucfirst($akses) }}</h5></td>
        <td class="table-center"><div class="checkbox">
                <label><input name="{{$akses}}_index" value="1" type="checkbox" id="{{$akses}}_index" 
                    @if(!empty($data)) @if($data->can($akses.'_index')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-eye"></i> Lihat</label>
            </div>
        </td>
        <td class="table-center"><div class="checkbox">
                <label><input name="{{$akses}}_create" value="1" type="checkbox" id="{{$akses}}_create" 
                    @if(!empty($data)) @if($data->can($akses.'_create')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-plus"></i> Tambah</label>
            </div>
        </td>
        <td class="table-center"><div class="checkbox">
                <label><input name="{{$akses}}_update" value="1" type="checkbox" id="{{$akses}}_update" 
                    @if(!empty($data)) @if($data->can($akses.'_update')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-pencil"></i> Ubah</label>
            </div>
        </td>
        <td class="table-center"><div class="checkbox">
                <label><input name="{{$akses}}_detail" value="1" type="checkbox" id="{{$akses}}_detail"
                    @if(!empty($data)) @if($data->can($akses.'detail')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-database"></i> Detail</label>
            </div>
        </td>
        <td class="table-center"><div class="checkbox">
                <label><input name="{{$akses}}_destroy" value="1" type="checkbox" id="{{$akses}}_destroy"
                    @if(!empty($data)) @if($data->can($akses.'_destroy')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-trash"></i> Hapus</label>
            </div>
        </td>
    </tr>
    <?php $akses= "tpcu"; $judulakses="tp cu"; $logo= "fa-building-o"; ?>
    <tr>
        <td><h5 class="hakakses-title"><i class="fa {{ $logo }}"></i> {{ ucfirst($judulakses) }}</h5></td>
        <td class="table-center"><div class="checkbox">
                <label><input name="{{$akses}}_index" value="1" type="checkbox" id="{{$akses}}_index" 
                    @if(!empty($data)) @if($data->can($akses.'_index')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-eye"></i> Lihat</label>
            </div>
        </td>
        <td class="table-center"><div class="checkbox">
                <label><input name="{{$akses}}_create" value="1" type="checkbox" id="{{$akses}}_create" 
                    @if(!empty($data)) @if($data->can($akses.'_create')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-plus"></i> Tambah</label>
            </div>
        </td>
        <td class="table-center"><div class="checkbox">
                <label><input name="{{$akses}}_update" value="1" type="checkbox" id="{{$akses}}_update" 
                    @if(!empty($data)) @if($data->can($akses.'_update')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-pencil"></i> Ubah</label>
            </div>
        </td>
        <td class="table-center">&nbsp;</td>
        <td class="table-center"><div class="checkbox">
                <label><input name="{{$akses}}_destroy" value="1" type="checkbox" id="{{$akses}}_destroy"
                    @if(!empty($data)) @if($data->can($akses.'_destroy')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-trash"></i> Hapus</label>
            </div>
        </td>
    </tr>
    <?php $akses= "wilayahcu"; $judulakses="wilayah cu"; $logo= "fa-building-o"; ?>
    <tr>
        <td><h5 class="hakakses-title"><i class="fa {{ $logo }}"></i> {{ ucfirst($judulakses) }}</h5></td>
        <td class="table-center"><div class="checkbox">
                <label><input name="{{$akses}}_index" value="1" type="checkbox" id="{{$akses}}_index" 
                    @if(!empty($data)) @if($data->can($akses.'_index')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-eye"></i> Lihat</label>
            </div>
        </td>
        <td class="table-center"><div class="checkbox">
                <label><input name="{{$akses}}_create" value="1" type="checkbox" id="{{$akses}}_create" 
                    @if(!empty($data)) @if($data->can($akses.'_create')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-plus"></i> Tambah</label>
            </div>
        </td>
        <td class="table-center"><div class="checkbox">
                <label><input name="{{$akses}}_update" value="1" type="checkbox" id="{{$akses}}_update" 
                    @if(!empty($data)) @if($data->can($akses.'_update')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-pencil"></i> Ubah</label>
            </div>
        </td>
        <td class="table-center">&nbsp;</td>
        <td class="table-center"><div class="checkbox">
                <label><input name="{{$akses}}_destroy" value="1" type="checkbox" id="{{$akses}}_destroy"
                    @if(!empty($data)) @if($data->can($akses.'_destroy')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-trash"></i> Hapus</label>
            </div>
        </td>
    </tr>
    <?php $akses= "perkembangancu"; $judulakses="perkembangan cu"; $logo= "fa-building-o"; ?>
    <tr>
        <td><h5 class="hakakses-title"><i class="fa {{ $logo }}"></i> {{ ucfirst($judulakses) }}</h5></td>
        <td class="table-center"><div class="checkbox">
                <label><input name="{{$akses}}_index" value="1" type="checkbox" id="{{$akses}}_index" 
                    @if(!empty($data)) @if($data->can($akses.'_index')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-eye"></i> Lihat</label>
            </div>
        </td>
        <td class="table-center"><div class="checkbox">
                <label><input name="{{$akses}}_create" value="1" type="checkbox" id="{{$akses}}_create" 
                    @if(!empty($data)) @if($data->can($akses.'_create')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-plus"></i> Tambah</label>
            </div>
        </td>
        <td class="table-center"><div class="checkbox">
                <label><input name="{{$akses}}_update" value="1" type="checkbox" id="{{$akses}}_update" 
                    @if(!empty($data)) @if($data->can($akses.'_update')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-pencil"></i> Ubah</label>
            </div>
        </td>
        <td class="table-center"><div class="checkbox">
                <label><input name="{{$akses}}_detail" value="1" type="checkbox" id="{{$akses}}_detail"
                    @if(!empty($data)) @if($data->can($akses.'detail')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-database"></i> Detail</label>
            </div>
        </td>
        <td class="table-center"><div class="checkbox">
                <label><input name="{{$akses}}_destroy" value="1" type="checkbox" id="{{$akses}}_destroy"
                    @if(!empty($data)) @if($data->can($akses.'_destroy')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-trash"></i> Hapus</label>
            </div>
        </td>
    </tr>
    <?php $akses= "staf"; $logo= "fa-sitemap"; ?>
    <tr>
        <td><h5 class="hakakses-title"><i class="fa {{ $logo }}"></i> {{ ucfirst($akses) }}</h5></td>
        <td class="table-center"><div class="checkbox">
                <label><input name="{{$akses}}_index" value="1" type="checkbox" id="{{$akses}}_index" 
                    @if(!empty($data)) @if($data->can($akses.'_index')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-eye"></i> Lihat</label>
            </div>
        </td>
        <td class="table-center"><div class="checkbox">
                <label><input name="{{$akses}}_create" value="1" type="checkbox" id="{{$akses}}_create" 
                    @if(!empty($data)) @if($data->can($akses.'_create')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-plus"></i> Tambah</label>
            </div>
        </td>
        <td class="table-center"><div class="checkbox">
                <label><input name="{{$akses}}_update" value="1" type="checkbox" id="{{$akses}}_update" 
                    @if(!empty($data)) @if($data->can($akses.'_update')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-pencil"></i> Ubah</label>
            </div>
        </td>
        <td class="table-center"><div class="checkbox">
                <label><input name="{{$akses}}_detail" value="1" type="checkbox" id="{{$akses}}_detail"
                    @if(!empty($data)) @if($data->can($akses.'detail')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-database"></i> Detail</label>
            </div>
        </td>
        <td class="table-center"><div class="checkbox">
                <label><input name="{{$akses}}_destroy" value="1" type="checkbox" id="{{$akses}}_destroy"
                    @if(!empty($data)) @if($data->can($akses.'_destroy')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-trash"></i> Hapus</label>
            </div>
        </td>
    </tr>
    <?php $akses= "download"; $logo="fa-download"; ?>
    <tr>
        <td><h5 class="hakakses-title"><i class="fa {{ $logo }}"></i> {{ ucfirst($akses) }}</h5></td>
        <td class="table-center"><div class="checkbox">
                <label><input name="{{$akses}}_index" value="1" type="checkbox" id="{{$akses}}_index" 
                    @if(!empty($data)) @if($data->can($akses.'_index')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-eye"></i> Lihat</label>
            </div>
        </td>
        <td class="table-center"><div class="checkbox">
                <label><input name="{{$akses}}_create" value="1" type="checkbox" id="{{$akses}}_create" 
                    @if(!empty($data)) @if($data->can($akses.'_create')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-plus"></i> Tambah</label>
            </div>
        </td>
        <td class="table-center"><div class="checkbox">
                <label><input name="{{$akses}}_update" value="1" type="checkbox" id="{{$akses}}_update" 
                    @if(!empty($data)) @if($data->can($akses.'_update')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-pencil"></i> Ubah</label>
            </div>
        </td>
        <td class="table-center">&nbsp;</td>
        <td class="table-center"><div class="checkbox">
                <label><input name="{{$akses}}_destroy" value="1" type="checkbox" id="{{$akses}}_destroy"
                    @if(!empty($data)) @if($data->can($akses.'_destroy')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-trash"></i> Hapus</label>
            </div>
        </td>
    </tr>
    <?php $akses= "Admin"; $logo="fa-user"; ?>
    <tr>
        <td><h5 class="hakakses-title"><i class="fa {{ $logo }}"></i> {{ ucfirst($akses) }}</h5></td>
        <td class="table-center"><div class="checkbox">
                <label><input name="{{$akses}}_index" value="1" type="checkbox" id="{{$akses}}_index" 
                    @if(!empty($data)) @if($data->can($akses.'_index')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-eye"></i> Lihat</label>
            </div>
        </td>
        <td class="table-center"><div class="checkbox">
                <label><input name="{{$akses}}_create" value="1" type="checkbox" id="{{$akses}}_create" 
                    @if(!empty($data)) @if($data->can($akses.'_create')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-plus"></i> Tambah</label>
            </div>
        </td>
        <td class="table-center"><div class="checkbox">
                <label><input name="{{$akses}}_update" value="1" type="checkbox" id="{{$akses}}_update" 
                    @if(!empty($data)) @if($data->can($akses.'_update')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-pencil"></i> Ubah</label>
            </div>
        </td>
        <td class="table-center"><div class="checkbox">
                <label><input name="{{$akses}}_detail" value="1" type="checkbox" id="{{$akses}}_detail"
                    @if(!empty($data)) @if($data->can($akses.'detail')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-database"></i> Detail</label>
            </div>
        </td>
        <td class="table-center"><div class="checkbox">
                <label><input name="{{$akses}}_destroy" value="1" type="checkbox" id="{{$akses}}_destroy"
                    @if(!empty($data)) @if($data->can($akses.'_destroy')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-trash"></i> Hapus</label>
            </div>
        </td>
    </tr>
</table>



