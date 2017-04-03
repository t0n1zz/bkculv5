<script>
    function masihaktifpekerjaan(){
        $('#sekarangpekerjaan').val('1');
        $('#masihpekerjaan').show();
        $('#groupselesaipekerjaan').hide();
    }
    function nonaktifpekerjaan() {
        $('#sekarangpekerjaan').val('0');
        $('#masihpekerjaan').hide();
        $('#groupselesaipekerjaan').show();
    }
    function masihaktifpendidikan(){
        $('#sekarangpendidikan').val('1');
        $('#masihpendidikan').show();
        $('#groupselesaipendidikan').hide();
    }
    function nonaktifpendidikan() {
        $('#sekarangpendidikan').val('0');
        $('#masihpendidikan').hide();
        $('#groupselesaipendidikan').show();
    }
    function masihaktiforganisasi(){
        $('#sekarangorganisasi').val('1');
        $('#masihorganisasi').show();
        $('#groupselesaiorganisasi').hide();
    }
    function nonaktiforganisasi() {
        $('#sekarangorganisasi').val('0');
        $('#masihorganisasi').hide();
        $('#groupselesaiorganisasi').show();
    }
    
    // pekerjaan
    function func_radiocu(){
        $('#selectcu').prop('disabled',false);
        $("#selectcu").prop('required',true);
        $("#selectlembaga").prop('required',false);
        $('#selectlembaga').prop('disabled',true);
        $('#selectlembaga').val($('#selectlembaga option:first').val()); 
        $('#tipepekerjaan').val('1');

        $('#jabatan').hide();
        $('#tingkatcu').hide();
        $('#tingkatlembaga').hide(); 
        $('#bidang').hide(); 
        $('#lembagabaru').hide();
        $('#waktupekerjaan').hide();
    }

    function func_radiolembaga(){
        $('#selectcu').prop('disabled',true);
        $('#selectcu').val($('#selectcu option:first').val());
        $("#selectcu").prop('required',false);
        $('#selectlembaga').prop('disabled',false);
        $("#selectlembaga").prop('required',true);
        $('#tipepekerjaan').val('2');

        $('#jabatan').hide();
        $('#tingkatcu').hide();
        $('#tingkatlembaga').hide(); 
        $('#bidang').hide(); 
        $('#lembagabaru').hide();
        $('#waktupekerjaan').hide();
    }

    function func_selectcu($i) { //cu
        $('#jabatan').show();
        $('#tingkatcu').show();
         
        $('#namapekerjaan').val('');
        $('#selecttingkatcu').val($('#selecttingkatcu option:first').val());
        $('#selectbidangcu').val($('#selectbidangcu option:first').val());
        $('#selecttingkatlembaga').val($('#selecttingkatlembaga option:first').val());

        $("#namapekerjaan").prop('required',true);
        $("#selecttingkatcu").prop('required',true);
        $("#selectbidangcu").prop('required',true);
        $("#selecttingkatlembaga").prop('required',false);
    }

    function func_selectlembaga($i) { // lembaga
        if($i == "tambah"){
            $('#lembagabaru').show();
            $("#namalembaga").prop('required',true);
            $("#alamatlembaga").prop('required',true);
        }else{
            $('#lembagabaru').hide();
            $("#namalembaga").prop('required',false);
            $("#alamatlembaga").prop('required',false);
        }

        $('#jabatan').show();
        $('#tingkatlembaga').show();
        $('#waktupekerjaan').show();
        $('#btnsekarang').show();

        $('#namapekerjaan').val('');
        $('#selecttingkatcu').val($('#selecttingkatcu option:first').val());
        $('#selectbidangcu').val($('#selectbidangcu option:first').val());
        $('#selecttingkatlembaga').val($('#selecttingkatlembaga option:first').val());

        $("#namapekerjaan").prop('required',true);
        $("#selecttingkatlembaga").prop('required',true);
        $("#selecttingkatcu").prop('required',false);
        $("#selectbidangcu").prop('required',false);
    }

    function func_selecttingkatan($i){
        if($i == "Pengurus" || $i == "Pengawas" || $i == "Komite"){
            $('#bidang').hide();
            $('#btnsekarang').hide();
            $('#sekarangpekerjaan').val('0');
        }else{
            $('#bidang').show();
            $('#btnsekarang').show();
        }
        $('#waktupekerjaan').show();
    }

    // pendidikan
    function func_selectpendidikan($i){
        $('#pendidikangroup').show();

        if($i == "SD" || $i == "SMP"){
            $('#namapendidikan').val('');
            $('#jurusan').hide();
            $("#namapendidikan").prop('required',false); 
        }else{
            $('#namapendidikan').val('');
            $('#jurusan').show(); 
            $("#namapendidikan").prop('required',true);
        }

        $("#tempatpendidikan").prop('required',true);
        $("#mulaipendidikan").prop('required',true);
    }

    // organisasi
    function func_organsasiyes(){
        $('#tipeorganisasi').val('1');
        $('#organisasi').show();

        $("#namaorganisasi").prop('required',true);
        $("#jabatanorganisasi").prop('required',true);
        $("#tempatorganisasi").prop('required',true);
        $("#mulaiorganisasi").prop('required',true);
    }
    
    function func_organsasino(){
        $('#tipeorganisasi').val('0');
        $('#organisasi').hide();

        $('#namaorganisasi').val('');
        $("#namaorganisasi").prop('required',false);
        $("#jabatanorganisasi").prop('required',false);
        $("#tempatorganisasi").prop('required',false);
        $("#mulaiorganisasi").prop('required',false);
    }
</script>