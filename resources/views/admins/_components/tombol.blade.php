{{-- tombol --}}
<div class="box box-solid">
    <div class="box-body">
        <div class="form-group" style="margin-bottom: 0px;">
            <button type="submit" name="simpan" accesskey="s" class="btn btn-primary">
                <i class="fa fa-save"></i> <u>S</u>impan</button>
            @if(empty($no_simpan2))
            <button type="submit" name="simpan2" accesskey="m" class="btn btn-primary">
                <i class="fa fa-save fa-fw"></i><i class="fa fa-plus"></i> Si<u>m</u>pan dan buat baru</button>
            @endif    
            <a href="{{ $batal_route }}" name="batal" accesskey="b" class="btn btn-danger">
                <i class="fa fa-times"></i> <u>B</u>atal</a>
        </div>
    </div>
</div>