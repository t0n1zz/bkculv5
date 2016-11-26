<table class="table table-striped table-condensed">
	<?php $akses= "artikel_cu"; $logo= "fa-book"; ?>
    <tr id="{{ $akses }}">
        <td><h5 class="hakakses-title"><i class="fa {{ $logo }} fa-fw"></i> {{ ucfirst('artikel') }}</h5></td>
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
    <?php $akses= "kegiatan_cu"; $logo= "fa-calendar"; ?>
    <tr id="{{ $akses }}">
        <td><h5 class="hakakses-title"><i class="fa {{ $logo }} fa-fw"></i> {{ ucfirst('kegiatan') }}</h5></td>
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
        <td class="table-center">&nbsp;</td>
        <td class="table-center">&nbsp;</td>
        <td class="table-center"><div class="checkbox">
                <label><input name="{{$akses}}_destroy" value="1" type="checkbox" id="{{$akses}}_destroy"
                    @if(!empty($data)) @if($data->can($akses.'_destroy')) {{ 'checked' }} @endif @endif
                    /> <i class="fa fa-trash"></i> Hapus</label>
            </div>
        </td>
    </tr>
    <?php $akses= "cu_cu"; $logo= "fa-building-o"; ?>
    <tr id="{{ $akses }}">
        <td><h5 class="hakakses-title"><i class="fa {{ $logo }} fa-fw"></i> {{ ucfirst('cu') }}</h5></td>
        <td class="table-center">&nbsp;</td>
        <td class="table-center">&nbsp;</td>
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
        <td class="table-center">&nbsp;</td>
    </tr>
	<?php $akses= "tpcu_cu"; $judulakses="tp cu"; $logo= "fa-building-o"; ?>
    <tr id="{{ $akses }}">
        <td><h5 class="hakakses-title"><i class="fa {{ $logo }} fa-fw"></i> {{ ucfirst($judulakses) }}</h5></td>
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
    <?php $akses= "perkembangancu_cu"; $judulakses="perkembangan cu"; $logo= "fa-building-o"; ?>
    <tr id="{{ $akses }}">
        <td><h5 class="hakakses-title"><i class="fa {{ $logo }} fa-fw"></i> {{ ucfirst($judulakses) }}</h5></td>
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
    <?php $akses= "staf_cu"; $logo= "fa-sitemap"; ?>
    <tr id="{{ $akses }}">
        <td><h5 class="hakakses-title"><i class="fa {{ $logo }} fa-fw"></i> {{ ucfirst('Staf') }}</h5></td>
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