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
        $('#selectcu').prop('required',true);
        $('#selectlembaga').prop('disabled',true);
        $('#selectlembaga').prop('required',false);
        $('#selectlembaga').val($('#selectlembaga option:first').val()); 

        $('#jabatan').hide();
        $('#tingkatcu').hide();
        $('#tingkatlembaga').hide(); 
        $('#bidang').hide(); 
        $('#lembagabaru').hide();
        $('#waktupekerjaan').hide();
    }

    function func_radiolembaga(){
        $('#selectcu').prop('disabled',true);
        $('#selectcu').prop('required',false);
        $('#selectcu').val($('#selectcu option:first').val());
        $('#selectlembaga').prop('disabled',false);
        $('#selectlembaga').prop('required',true);
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
        $('#waktupekerjaan').show();

        if($i == "bkcu"){
            $('#tipepekerjaan').val('3');
        }else{
            $('#tipepekerjaan').val('1');
        }
         
        $('#namapekerjaan').val('');
        $('#selecttingkatcu').val($('#selecttingkatcu option:first').val());
        $('#selecttingkatlembaga').val($('#selecttingkatlembaga option:first').val());

        $('#namapekerjaan').prop('required',true);
        $('#selecttingkatcu').prop('required',true);
        $('#selecttingkatlembaga').prop('required',false);  
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

        $('#namapekerjaan').prop('required',true);
        $('#selecttingkatcu').prop('required',false);
        $('#selecttingkatlembaga').prop('required',true);  
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
        
        if($i == "1" || $i == "2"){
            $('#jurusan').hide();
            $('#namapendidikan').val('');
        }else{
            $('#jurusan').show();
            $('#namapendidikan').val('');
        }
    }

    // organisasi
    function func_organsasiyes(){
        $('#tipeorganisasi').val('1');
        $('#organisasi').show();

        $('#namaorganisasi').prop('required',true);
        $('#jabatanorganisasi').prop('required',true);
    }
    
    function func_organsasino(){
        $('#tipeorganisasi').val('0');
        $('#organisasi').hide();

        $('#namaorganisasi').val('');
        $('#namaorganisasi').prop('required',false);
        $('#jabatanorganisasi').prop('required',false);
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
    var countersimpanan = 0;

    function func_cutambah(){
        var htmlcu = '<div id="formcu'+ countercu +'">';
                htmlcu += '<div class="form-group">';
                    htmlcu += '<div class="input-group">';
                        htmlcu += '<span class="input-group-addon"><i class="fa fa-font"></i></span>';
                            htmlcu += '<input type="text" class="form-control" name="namecu[] "placeholder="Silahkan masukkan nama CU" />';
                        htmlcu += '<span class="input-group-addon">0-9</span>';
                            htmlcu += '<input type="text" class="form-control" name="nocu[] " placeholder="Silahkan masukkan no anggota CU" />';
                        htmlcu += '<div class="input-group-btn"><button type="button" class="btn btn-default" onclick="func_cukurang('+ countercu +')" ><i class="fa fa-times"></i></button></div>';
                    htmlcu +='</div><br/>';
                    htmlcu += func_htmlsimpanan();
                htmlcu +='</div>';
            htmlcu +='</div><hr/>';

        $('#cutambah').before(htmlcu);

        $('#cutambah').text('Tambah Keanggotaan di CU');
        countercu++;
    }

    function func_htmlsimpanan(){
        var htmlsimpanan = '<div class="row" id="simpanancu'+countercu+'">';
                htmlsimpanan +='<div class="col-sm-1"></div>';
                htmlsimpanan +='<div class="col-sm-11">';
                    htmlsimpanan += '<div class="form-group">';
                        htmlsimpanan += '<div class="input-group">';
                            htmlsimpanan += '<span class="input-group-addon"><i class="fa fa-font"></i></span>';
                                htmlsimpanan += '<input type="text" class="form-control" name="namecu[] "placeholder="Silahkan masukkan nama CU" />';
                            htmlsimpanan += '<span class="input-group-addon">0-9</span>';
                                htmlsimpanan += '<input type="text" class="form-control" name="nocu[] " placeholder="Silahkan masukkan no anggota CU" />';
                            htmlsimpanan += '<div class="input-group-btn"><button type="button" class="btn btn-default" onclick="func_cukurang('+ countercu +')" ><i class="fa fa-times"></i></button></div>';
                        htmlsimpanan +='</div><br/>';
                htmlsimpanan +='</div>';
            htmlsimpanan +='</div>';

        return htmlsimpanan;    
    }

    function func_cukurang(countcu){
        countercu--;
        $('#formcu'+countcu).remove();
        if(countercu == 0){
            $('#cutambah').text('Punya keanggotaan di CU');
        }
    }
</script>