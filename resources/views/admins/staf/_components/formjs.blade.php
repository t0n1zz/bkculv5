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
        $('#selectlembaga').prop('disabled',false);
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

        if($i == "bkcu"){
            $('#tipepekerjaan').val('3');
        }else{
            $('#tipepekerjaan').val('1');
        }
         
        $('#namapekerjaan').val('');
        $('#selecttingkatcu').val($('#selecttingkatcu option:first').val());
        $('#selecttingkatlembaga').val($('#selecttingkatlembaga option:first').val()); 
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
        $('#selecttingkatlembaga').val($('#selecttingkatlembaga option:first').val());
    }

    function func_selecttingkatan($i){
        if($i == "Pengawas" || $i == "Pengurus" || $i == "Komite"){
            $('#bidang').hide();
            $('#btnsekarang').hide();
            $('#sekarangpekerjaan').val('0');
        }else{
            $('#bidang').show();
            $('#btnsekarang').show();
        }
        $('#waktupekerjaan').show();
    }

    function cekbidang(checkbox) {
        if(checkbox.checked == true){
            $('#tambahbidang').show();
        }else{
            $('#tambahbidang').hide();
       }
       $('#bidangbaru').val('');
    }

    // pendidikan
    function func_selectpendidikan($i){
        $('#pendidikangroup').show();

        if($i == "SD" || $i == "SMP"){
            $('#namapendidikan').val('');
            $('#jurusan').hide();
        }else{
            $('#namapendidikan').val('');
            $('#jurusan').show(); 
        }
    }

    // organisasi
    function func_organsasiyes(){
        $('#tipeorganisasi').val('1');
        $('#organisasi').show();
    }
    
    function func_organsasino(){
        $('#tipeorganisasi').val('0');
        $('#organisasi').hide();

        $('#namaorganisasi').val('');
    }

        function func_selectstatus($i){
        if($i == "Belum Menikah"){
            $('#pasangan').hide();
            $('#anak').hide();
        }else{
             $('#pasangan').show();
             $('#anak').show();
        }
    }

    var counteranak = 0;
    function func_anaktambah(){
        $('#anaktambah').before("<div class='form-group' id='formanak"+ counteranak +"'><h4>Nama Anak</h4><div class='input-group'><span class='input-group-addon'><i class='fa fa-font'></i></span><input type='text' class='form-control' name='nameanak[]' placeholder='Silahkan masukkan nama anak' /><div class='input-group-btn'><button type='button' class='btn btn-default' onclick='func_anakkurang()' ><i class='fa fa-times'></i></button></div></div></div>");
        $('#anaktambah').text('Tambah Anak');
        counteranak++;
    }

    function func_anakkurang(){
        counteranak--;
        $('#formanak'+counteranak).remove();
        if(counteranak == 0){
            $('#anaktambah').text('Punya Anak');
        }
    }

    var countercu = 0;
    function func_cutambah(){
        $('#cutambah').before("<div class='form-group' id='formcu"+ countercu +"'><div class='input-group'><span class='input-group-addon'><i class='fa fa-font'></i></span><input type='text' class='form-control' name='namecu[]' placeholder='Silahkan masukkan nama CU' /><span class='input-group-addon'>0-9</span><input type='text' class='form-control' name='nocu[]' placeholder='Silahkan masukkan no anggota CU' /><div class='input-group-btn'><button type='button' class='btn btn-default' onclick='func_cukurang()' ><i class='fa fa-times'></i></button></div></div></div>");
        $('#cutambah').text('Tambah Keanggotaan di CU');
        countercu++;
    }

    function func_cukurang(){
        countercu--;
        $('#formcu'+countercu).remove();
        if(countercu == 0){
            $('#cutambah').text('Punya keanggotaan di CU');
        }
    }
</script>