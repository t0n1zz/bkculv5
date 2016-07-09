<table class="table table-hover">
    <tr>
        <td>Akses Halaman Pengumuman</td>
        <td><input name="pengumuman" value="1" type="checkbox"
            @if(!empty($data))
                @if($data->can('pengumuman'))
                    {{ 'checked' }}
                        @endif
                    @endif
                    /></td>
    </tr>
    <tr>
        <td>Akses Halaman Saran atau Kritik</td>
        <td><input name="saran" value="1" type="checkbox"
            @if(!empty($data))
                @if($data->can('saran'))
                    {{ 'checked' }}
                        @endif
                    @endif
                    /></td>
    </tr>
    <tr>
        <td>Akses Halaman Info Gerakan</td>
        <td><input name="infogerakan" value="1" type="checkbox"
            @if(!empty($data))
                @if($data->can('infogerakan'))
                    {{ 'checked' }}
                        @endif
                    @endif
                    /></td>
    </tr>
    <tr>
        <td>Akses Halaman Foto Kegiatan</td>
        <td><input name="gambarkegiatan" value="1" type="checkbox"
            @if(!empty($data))
                @if($data->can('gambarkegiatan'))
                    {{ 'checked' }}
                        @endif
                    @endif
                    /></td>
    </tr>
    <tr>
      <td>Akses Halaman Artikel</td>
      <td><input name="artikel" value="1" type="checkbox"
            @if(!empty($data))
               @if($data->can('artikel'))
                  {{ 'checked' }}
               @endif
            @endif
            /></td>
    <tr>
    <tr>
        <td>Akses Halaman Kategori Artikel</td>
        <td><input name="kategoriartikel" value="1" type="checkbox"
            @if(!empty($data))
                @if($data->can('kategoriartikel'))
                    {{ 'checked' }}
                        @endif
                    @endif
                    /></td>
    </tr>
    <tr>
        <td>Akses Halaman Kegiatan</td>
        <td><input name="kegiatan" value="1" type="checkbox"
            @if(!empty($data))
                @if($data->can('kegiatan'))
                    {{ 'checked' }}
                        @endif
                    @endif
                    /></td>
    </tr>
    <tr>
        <td>Akses Halaman CU Primer</td>
          <td><input name="cuprimer" value="1" type="checkbox"
                @if(!empty($data))
                   @if($data->can('cuprimer'))
                      {{ 'checked' }}
                   @endif
                @endif
                /></td>
    </tr>
    <tr>
        <td>Akses Halaman Wilayah Cu Primer</td>
        <td><input name="wilayahcuprimer" value="1" type="checkbox"
            @if(!empty($data))
                @if($data->can('wilayahcuprimer'))
                    {{ 'checked' }}
                        @endif
                    @endif
                    /></td>
    </tr>
    <tr>
        <td>Akses Halaman Staff</td>
          <td><input name="staff" value="1" type="checkbox"
                @if(!empty($data))
                   @if($data->can('staff'))
                      {{ 'checked' }}
                   @endif
                @endif
                /></td>
    </tr>
    <tr>
        <td>Akses Halaman Download</td>
        <td><input name="download" value="1" type="checkbox"
            @if(!empty($data))
                @if($data->can('download'))
                    {{ 'checked' }}
                        @endif
                    @endif
                    /></td>
    </tr>
    <tr>
        <td>Akses Halaman Admin</td>
        <td><input name="admin" value="1" type="checkbox"
            @if(!empty($data))
                @if($data->can('admin'))
                    {{ 'checked' }}
                        @endif
                    @endif
                    /></td>
    </tr>
</table>