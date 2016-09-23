/**
 * Created by Tony on 7/7/2016.
 */
//modal 1
$('.modal1').on('click',function(){
    $('#modal1show').modal({
        show: true,
    })

    var myvalue = this.name;
    var myvalue2 = this.title;
    $('#modal1id').attr('value',myvalue);
    $('#modal1id2').attr('value',myvalue2);
});

//modal 2
$('.modal2').on('click',function(){
    $('#modal2show').modal({
        show: true,
    })

    var myvalue = this.name;
    var myvalue2 = this.title;
    $('#modal2id').attr('value',myvalue);
    $('#modal2id2').attr('value',myvalue2);
});

//modal 3
$('.modal3').on('click',function(){
    $('#modal3show').modal({
        show: true,
    })

    var myvalue = this.name;
    var myvalue2 = this.title;
    $('#modal3id').attr('value',myvalue);
    $('#modal3id2').attr('value',myvalue2);
});

//modal 4
$('.modal4').on('click',function(){
    $('#modal4show').modal({
        show: true,
    })

    var myvalue = this.name;
    var myvalue2 = this.title;
    $('#modal4id').attr('value',myvalue);
    $('#modal4id2').attr('value',myvalue2);
});

//modal 5
$('.modal5').on('click',function(){
    $('#modal5show').modal({
        show: true,
    })

    var myvalue = this.name;
    var myvalue2 = this.title;
    $('#modal5id').attr('value',myvalue);
    $('#modal5id2').attr('value',myvalue2);
});

//modal 6
$('.modal6').on('click',function(){
    $('#modal6show').modal({
        show: true,
    })

    var myvalue = this.name;
    var myvalue2 = this.title;
    $('#modal6id').attr('value',myvalue);
    $('#modal6id2').attr('value',myvalue2);
});


//preview gambar upload
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#tampilgambar').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

//munculkan dan hilangkan objek
function changeFunc($i) {
    if($i == "tambah"){
        document.getElementById('pilihan').style.display='inline';
    }else{
        document.getElementById('pilihan').style.display='none';
    }
}

function changeFunc2($i) {
    if($i == "1" || $i == "2"){
        document.getElementById('pilihan').style.display='inline';
    }else{
        document.getElementById('pilihan').style.display='none';
    }
}

function changeFuncUser($i) {
    if($i == "2"){
        $('#pilihan').show();
        $('#pilihan2').hide();
    }else{
        $('#pilihan').hide();
        $('#pilihan2').show();
    }
}

$("#tampilinputgambar").change(function() {
    if(this.checked) {
        document.getElementById('inputgambar').style.display='inline';
        document.getElementById('gambartext').value ='Iya, gambar akan muncul di list artikel dan view artikel';
    }else{
        document.getElementById('inputgambar').style.display='none';
        document.getElementById('gambartext').value ='Tidak';
    }
});

$("#artikelpilihan").change(function() {
    if(this.checked) {
        document.getElementById('artikeltext').value ='Iya, artikel akan muncul di slideshow';
    }else{
        document.getElementById('artikeltext').value ='Tidak';
    }
});

$("#terbitkanartikel").change(function() {
    if(this.checked) {
        document.getElementById('statustext').value ='Iya, artikel akan di terbitkan';
    }else{
        document.getElementById('statustext').value ='Tidak';
    }
});
