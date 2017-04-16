<?php 
$appname = "AdminBKCU";
$versi = "2.1.2";
$imagepath = "images_panduan/";
?>
@extends('admins.panduan.layout')

@section('css')
@stop

@section('content')
<section id="pendahuluan">
    <h2 class="page-header"><a href="#pendahuluan">Pendahuluan</a></h2>
    <p class="lead">
        Selamat datang di panduan pengoperasian aplikasi berbasis website <b>{{ $appname }}</b>. Panduan ini dibuat untuk memberikan pemahaman kepada pengguna, cara pengoperasian aplikasi <b>{{ $appname }}</b>.
    </p>
    <div class="callout callout-warning lead">
        <h4>Perhatian!</h4>
        <p>
            Panduan ini untuk aplikasi website <b>{{ $appname }}</b> versi {{ $versi }}, jadi mungkin akan terdapat perbedaan dalam penjelasan apabila versi panduan ini dan versi aplikasi <b>{{ $appname }}</b> berbeda. Untuk mengetahui versi aplikasi {{ $appname }}, bisa lihat penjelasannya di bagian <a href="#dashboard-footer"><b>footer</b></a>. <br/>
        </p>
    </div>
    <div class="callout callout-danger lead">
        <h4>Penting!</h4>
        <p>
            Aplikasi ini memerlukan <b>koneksi internet</b> dan browser yang digunakan mesti sudah mendukung <b>HTML5</b> dan <b>Javascript</b>. Hubungi bagian IT apabila terjadi masalah dalam mengakses aplikasi.
        </p>
    </div>
</section>
<section id="login">
    <h2 class="page-header"><a href="#login">Login</a></h2>
    <p class="lead">
        Aplikasi <b>{{ $appname }}</b> merupakan aplikasi berbasis website, maka untuk mengaksesnya adalah melalui <b>browser</b> pada komputer/gadget pengguna. Kemudian di <b>address bar</b> ketikkan <code><a href="http://puskopditbkcukalimantan.org/admins" target="_blank">www.puskopditbkcukalimantan.org/admins</a></code> kemudian pengguna akan sampai ke halaman login. 
    </p>
    {{ Html::image($imagepath.'login.png','Login', array('class' => 'img-responsive ','style'=>'margin-bottom:10px;')) }}
    <p class="lead">
        Pada halaman <b>login</b> pengguna mesti mengisi <b>username</b> dan <b>password</b> sesuai dengan yang telah diberikan dari <b>Puskopdit BKCU Kalimantan</b> kemudian menekan tombol <button class="btn btn-primary btn-float disabled"><i class="fa fa-sign-in"></i> Login</button> untuk masuk kedalam aplikasi {{ $appname }}.
    </p>
</section>
<section id="dashboard" data-spy="scroll" data-target="#scrollspy-components">
    <h2 class="page-header"><a href="#dashboard">Dashboard</a></h2>
    {{ Html::image($imagepath.'dashboard1.png','dashboard', array('class' => 'img-responsive ','style'=>'margin-bottom:10px;')) }}
    <p class="lead">
        Dashboard merupakan halaman yang paling pertama pengguna temui setelah <a href="#login"><b>login</b></a>. Halaman ini menampilkan ringkasan serta akses cepat ke fitur-fitur yang terdapat dalam aplikasi.<br/>
        Komponen yang terdapat yaitu:
        <ol>
            <li><a href="#dashboard-header">Header</a>.</li>
            <li><a href="#dashboard-panelnavigasi">Panel navigasi</a>.</li>
            <li><a href="#dashboard-aksescepat">Akses cepat</a>.</li>
            <li><a href="#dashboard-panelperkembangan">Panel perkembangan</a>.</li>
            </li>
            <li><a href="#dashboard-footer">Footer</a>.</li>
        </ol>
    </p>
    <div class="callout callout-warning lead">
        <h4>Perhatian!</h4>
        <p>
            Komponen dalam halaman ini akan berbeda-beda sesuai dengan hak akses yang diberikan kepada pengguna.
        </p>
    </div>
    {{-- header --}}
    <h3 id="dashboard-header">1. Header</h3>
    {{ Html::image($imagepath.'header.png','header', array('class' => 'img-responsive ','style'=>'margin-bottom:10px;')) }}
    <p class="lead">
        Header terletak di bagian paling atas dari aplikasi ini dan memiliki komponen sebagai berikut:
        <ol>
            <li><b>Logo</b>: Logo lembaga</li>
            <li><b>Toggle</b>: Tombol untuk melebarkan (FULL) atau mengecilkan (MINI) <a href="#dashboard-panelnavigasi">panel navigasi</a>.</li>
            <li><b>Mini Profile</b>: Foto serta nama dan asal lembaga pengguna aplikasi.</li>
            <li><b>Pemberitahuan</b>: Tombol untuk menampilkan pemberitahuan terbaru.</li>
            <li><b>Logout</b>: Tombol untuk keluar dari aplikasi.</li>
        </ol>
    </p>
    {{-- panel navigasi --}}
    <h3 id="dashboard-panelnavigasi">2. Panel Navigasi</h3>
    {{ Html::image($imagepath.'panelnavigasi.png','panel navigasi', array('class' => 'img-responsive ','style'=>'margin-bottom:10px;')) }}
    <p class="lead">
        Panel navigasi terletak di bagian tepi kiri dari aplikasi ini. Fungsinya adalah sebagai menu navigasi yang menampilkan semua halaman yang dapat diakses oleh pengguna pada aplikasi.<br/><br/>
        Terdapat 2 macam tipe yang bisa diubah ketika menekan tombol <b>toggle</b> pada bagian <a href="#dashboard-header">header</a> yaitu:
        <ul>
            <li><b>Mini</b>: menu navigasi ringkas yang hanya menampilkan icon untuk masing-masing halaman yang ada pada aplikasi.</li>
            <li><b>FULL</b>: menu navigasi detail yang menampilkan icon serta nama dari masing-masing halaman yang ada pada aplikasi.</li>
        </ul>
    </p>
    {{-- akses cepat --}}
    <h3 id="dashboard-aksescepat">3. Akses Cepat</h3>
    {{ Html::image($imagepath.'aksescepat.png','akses cepat', array('class' => 'img-responsive ','style'=>'margin-bottom:10px;')) }}
    <p class="lead">
        Akses cepat terletak di halaman <a href="#dashboard">dasboard</a>. Fungsinya adalah sebagai tombol untuk menuju halaman lain pada aplikasi ini serta menampilkan informasi dasar mengenai konten pada halaman yang akan dituju tersebut. Tombol yang tampil bervariasi tergantung pada hak akses yang dimiliki oleh pengguna.
    </p>
    {{-- panel perkembangan --}}
    <h3 id="dashboard-panelperkembangan">4. Panel Perkembangan</h3>
    {{ Html::image($imagepath.'panelperkembangan.png','panel perkembangan', array('class' => 'img-responsive ','style'=>'margin-bottom:10px;')) }}
    <p class="lead">
        Panel perkembangan terletak di halaman <a href="#dashboard">dasboard</a>. Fungsinya adalah menampilkan informasi perkembangan keuangan CU pengguna yang disajikan dalam bentuk grafik serta perbandingan dengan laporan keuangan bulan/periode sebelumnya.
    </p>
    {{ Html::image($imagepath.'grafikubah.png','ubah grafik', array('class' => 'img-responsive ','style'=>'margin-bottom:10px;')) }}
    <p class="lead">
       Pada <b>tab Perkembangan CU</b>, grafik yang ditampilkan merupakan grafik interaktif, yang artinya tidak hanya menampilkan grafik perkembangan total anggota (seperti yang terlihat), tetapi juga bisa dipilih grafik perkembangan apa yang dibutuhkan untuk ditampilkan (mis: grafik perkembangan aset). Untuk mengubahnya adalah dengan memilih di bagian <code><i class="fa fa-line-chart"></i> Grafik Laporan Berdasarkan</code>
    </p>
    {{ Html::image($imagepath.'tabpanelperkembangan.png','panel perkembangan', array('class' => 'img-responsive ','style'=>'margin-bottom:10px;')) }}
    <p class="lead">
       Dibagian atas kanan pada panel perkembangan terdapat 2 <b>tab</b> yaitu <b>Perkembangan CU</b> dan <b>P.E.A.R.L.S</b>, silahkan tekan salah satu untuk menampilkan panel sesuai nama tab. Secara otomatis yang terbuka adalah tab Perkembangan CU, untuk melihat P.E.A.R.L.S. pengguna cukup menekan tab bertuliskan P.E.A.R.L.S. maka akan panel akan berubah dan menampilkan data P.E.A.R.L.S. pada bulan/periode terakhir/terbaru yang terdapat pada program.
    </p>
    {{ Html::image($imagepath.'pearls.png','pearls', array('class' => 'img-responsive ','style'=>'margin-bottom:10px;')) }}
    
    {{-- footer --}}
    <h3 id="dashboard-footer">4. Footer</h3>
    {{ Html::image($imagepath.'footer.png','footer', array('class' => 'img-responsive ','style'=>'margin-bottom:10px;')) }}
    <p class="lead">
        Footer terletak di bagian bawah aplikasi. Berfungsi untuk menampilkan informasi hak cipta aplikasi, dan versi dari aplikasi yang sedang digunakan. Jika menekan tulisan <code>{{ $appname }} {{ $versi }}</code> akan mengarahkan pengguna ke halaman <b>version</b> yang menampilkan secara detail sejarah perkembangan aplikasi ini serta fitur apa saja yang ditambahkan, diperbaiki atau dihilangkan dari aplikasi {{ $appname }}. 
    </p>
</section>
<section id="laporancu"data-spy="scroll" data-target="#scrollspy-components">
    <h2 class="page-header"><a href="#laporancu">Laporan CU</a></h2>
    {{-- akses --}}
    <h3 id="laporancu-akses">Akses Laporan CU</h3>
    <p class="lead">
        Halaman ini dapat diakses dengan menekan tombol <b>Laporan CU</b> pada <a href="#panelnavigasi">Panel navigasi</a> atau pada <a href="#aksescepat">Akses cepat</a> di halaman <a href="#dasboard">Dashboard</a>.
    </p>
    {{ Html::image($imagepath.'laporancupilih.png','pilih laporan cu', array('class' => 'img-responsive ','style'=>'margin-bottom:10px;')) }}
    {{-- pengenalan --}}
    <h3 id="laporancu-pengenalan">Pengenalan Laporan CU</h3>
    <p class="lead">
        Halaman <b>Laporan CU</b> merupakan pusat dari pengelolaan laporan keuangan CU. Secara umum pengguna dapat melakukan: 
        <ul>
            <li>Melihat tabel perkembangan, pertumbuhan,dan P.E.A.R.L.S.</li>
            <li>Melihat grafik perkembangan, pertumbuhan,dan P.E.A.R.L.S.</li>
            <li>Menambah / memasukkan, mengubah, menghapus dan mencetak dalam bentuk file excel data laporan yang nanti akan diolah dan ditampilkan pada tabel dan grafik perkembangan, pertumbuhan,dan P.E.A.R.L.S. </li>
            <li>Melakukan komunikasi antara pengguna aplikasi di CU dengan pihak Puskopdit BKCU Kalimantan mengenai laporan pada periode tertentu.</li>
        </ul>
    </p>
    <div class="callout callout-info lead">
        <h4>Kesepakatan</h4>
        <p>
            Dengan mengunakan halaman <b>Laporan CU</b>, maka pengguna menyetujui dan mengetahui bahwa pihak Puskopdit BKCU Kalimantan dapat mengakses, serta melakukan perbaikan terhadap data yang dimasukkan dengan pemberitahuan/persetujuan dari pihak CU yang memiliki data.
        </p>
    </div>
    <div class="callout callout-warning lead">
        <h4>Perhatian!</h4>
        <p>
            Laporan yang ditampilkan <b>HANYA</b> laporan milik CU pengguna aplikasi saja. Jadi pengguna tidak dapat melihat laporan milik CU lain kecuali punya miliknya, begitu juga dengan penambahan, pengubahan, penghapusan laporan serta diskusi kepada pihak Puskopdit BKCU Kalimantan. Segala kegiatan yang terjadi hanya mempengaruhi data laporan pada CU pengguna.
        </p>
    </div>
    {{ Html::image($imagepath.'laporancu.png','laporan cu', array('class' => 'img-responsive ','style'=>'margin-bottom:10px;')) }}
    <p class="lead">
        Inilah halaman <b>Laporan CU</b>. Pada halaman ini terdapat beberapa komponen yaitu:
        <ol>
            <li><b>Tab tabel</b>: sama fungsinya seperti tab pada <a href="#dashboard-panelperkembangan">Panel perkembangan</a>, yaitu untuk mengatur panel menampilkan tabel sesuai dengan nama tab tersebut. Tab yang ada yaitu
                <ul>
                    <li><b>Tab Tabel Perkembangan</b>: menampilkan tabel perkembangan CU yang meliputi data anggota, aset, piutang, hutang, dll.</li>
                    {{ Html::image($imagepath.'tabelperkembangan.png','tabel perkembangan', array('class' => 'img-responsive ','style'=>'margin-bottom:10px;')) }}
                    <li><b>Tab Tabel Pertumbuhan</b>: menampilkan tabel pertumbuhan CU yang meliputi data anggota, aset, piutang, hutang, dll.</li>
                    {{ Html::image($imagepath.'tabelpertumbuhan.png','tabel perkembangan', array('class' => 'img-responsive ','style'=>'margin-bottom:10px;')) }}
                    <li><b>Tab Tabel P.E.A.R.L.S.</b>: menampilkan tabel hasil perhitungan P.E.A.R.L.S.
                        {{ Html::image($imagepath.'tabelpearls.png','tabel perkembangan', array('class' => 'img-responsive ','style'=>'margin-bottom:5px;')) }}
                        <ul>
                            <li>Pada tabel perhitungan P.E.A.R.L.S. sudah otomatis dalam bentuk persentase disertai penanda apakah indikator tersebut <span class="label bg-aqua">IDEAL</span> atau <span class="label bg-red">TIDAK IDEAL</span></li>
                            <li>Untuk melihat perhitungan pada indikator tersebut, cukup klik pada bagian yang ingin diketahui perhitungannya</li>
                            {{ Html::image($imagepath.'tabelpearlspilih.png','tabel perkembangan', array('class' => 'img-responsive ','style'=>'margin-bottom:5px;')) }}
                            <li>Selanjutnya akan muncul kotak dialog yang berisi rumus serta perhitungan pada indikator yang dipilih</li>
                            {{ Html::image($imagepath.'tabelpearlshitung.png','tabel perkembangan', array('class' => 'img-responsive ','style'=>'margin-bottom:5px;')) }}
                        </ul>
                    </li>
                    
                    <li>
                        <b>Tab Laporan Terhapus</b>: Apabila terjadi ketidaksengajaan menghapus laporan, maka laporan yang terhapus tidak langsung hilang begitu saja, tapi akan tetap ada tetapi di posisi lain sehingga dapat dipulihkan kembali.ntuk memulihkan laporan tinggal memilih laporan yang ingin dipulih
                        kan di tabel kemudian tekan <button class="btn btn-default" disabled><i class="fa fa-check"></i> Pulihkan</button>
                    </li>
                    <br/>
                    <div class="callout callout-warning lead">
                        <h4>Perhatian!</h4>
                        <p>
                            Laporan yang berada di bagian <b>Laporan Terhapus</b> tidak akan diproses oleh aplikasi untuk grafik, laporan konsolidasi dan kebutuhan lainnya.
                        </p>
                    </div>
                </ul>
            </li>
            <li><b>Pencarian</b>: fungsinya untuk melakukan pencarian pada tabel yang ditampilkan dibawah. Silahkan ketikkan saja kata kunci pencarian maka tabel akan memunculkan baris yang dicari sesuai dengan kata kunci yang diketikkan <b>jika ada</b>.</li>
            <li><b>Toolbar</b>: merupakan bagian yang menyediakan tombol-tombol yang berfungsi untuk berinteraksi dengan tabel yang ditampilkan.
                <ul>
                    <li><b>Column Display Bar</b>: tombol yang berfungsi untuk mengatur kolom apa saja yang ingin ditampilkan pada tabel.</li>
                    {{ Html::image($imagepath.'columndisplay.png','column display', array('class' => 'img-responsive ','style'=>'margin-bottom:10px;')) }}
                    <li><b>Data Bar</b>: tombol yang berfungsi untuk menambah, mengubah, menghapus serta melihat detail dari laporan yang dipilih di tabel.</li>
                    {{ Html::image($imagepath.'databar.png','data bar', array('class' => 'img-responsive ','style'=>'margin-bottom:10px;')) }}
                    <li><b>Download Excel</b>: tombol yang berfungsi untuk mendownload tabel yang ditampilkan menjadi file excel.</li>
                    {{ Html::image($imagepath.'downloadexcel.png','download excel', array('class' => 'img-responsive ','style'=>'margin-bottom:10px;')) }}
                </ul>
            </li>
            <li><b>Tabel</b>: merupakan bagian tabel yang menampilkan data.</li>
            <li><b>Tab grafik</b>: sama fungsinya seperti tab tabel, yaitu untuk mengatur panel menampilkan grafik sesuai dengan nama tab tersebut. Tab yang ada yaitu
                <ul>
                    <li><b>Tab Grafik Perkembangan</b>: menampilkan grafik perkembangan CU yang meliputi data anggota, aset, piutang, hutang, dll.</li>
                    <li><b>Tab Grafik Pertumbuhan</b>: menampilkan grafik pertumbuhan CU yang meliputi data anggota, aset, piutang, hutang, dll.</li>
                    <li><b>Tab Grafik P.E.A.R.L.S.</b>: menampilkan grafik hasil perhitungan P.E.A.R.L.S.</li>
                </ul>
            </li>
            <li><b>Grafik</b>: merupakan bagian yang menampilkan grafik.</li>
            <li><b>Grafik Selection</b>: fungsinya sama dengan pada <a href="#dashboard-panelperkembangan">Panel perkembangan</a>, yaitu untuk mengubah data yang ditampilkan grafik.</li>
        </ol>
    </p>
    {{-- tambah laporan --}}
    <h3 id="laporancu-tambah">Tambah Laporan CU</h3>
    <p class="lead">
        <ol>
            <li>Untuk menambah data pada laporan CU, pengguna pertama harus berada di halaman Laporan CU <a href="#laporancu-akses">(caranya dapat dilihat di bagian Akses Laporan CU)</a>,</li>

            <li>Kemudian menekan tombol <button class="btn btn-default btn-sm" disabled><i class="fa fa-plus"></i> <u>T</u>ambah</button>  pada bagian <b>Data Bar</b>,</li>

            {{ Html::image($imagepath.'laporancutambah.png','tambah laporan cu', array('class' => 'img-responsive ','style'=>'margin-bottom:10px;')) }}

            <li>Selanjutnya pengguna akan diarahkan ke halaman <b>Tambah Laporan CU</b>,</li>
            {{ Html::image($imagepath.'laporancuform.png','tambah laporan cu', array('class' => 'img-responsive ','style'=>'margin-bottom:10px;')) }}

            <li>Pengguna tinggal mengisikan sesuai dengan tempat yang telah disediakan berupa <b>textbox</b>.</li>
            {{ Html::image($imagepath.'textbox.png','tambah laporan cu', array('class' => 'img-responsive ','style'=>'margin-bottom:10px;')) }}

            <li>Untuk beberapa bagian akan terdapat logo <code><i class="fa fa-question-circle-o"></i></code> maka itu berarti ada keterangan lebih lanjut, untuk membacanya tinggal arahkan cursor ke logo <code><i class="fa fa-question-circle-o"></i></code>,</li>

            <li>Apabila sudah terisi dengan benar maka pengguna tinggal menekan tombol <button class="btn btn-primary btn-sm" disabled><i class="fa fa-save"></i> <u>S</u>impan</button>, 
            apabila berencana untuk menambah <b>data laporan baru</b> setelah menyimpan maka bisa <b>lebih cepat</b> jika menekan tombol <button class="btn btn-primary btn-sm" disabled><i class="fa fa-save"></i><i class="fa fa-plus"></i> Si<u>m</u>pan dan buat baru</button>. J
            ika ingin batal menambah data silakan menekan tombol <button class="btn btn-danger btn-sm" disabled><i class="fa fa-times"></i> <u>B</u>atal</button></li>
        </ol>
    </p>
    {{-- ubah laporan --}}
    <h3 id="laporancu-ubah">Ubah Laporan CU</h3>
    <p class="lead">
        <ol>
            <li>Untuk mengubah data pada laporan CU, pengguna pertama harus berada di halaman Laporan CU <a href="#laporancu-akses">(caranya dapat dilihat di bagian Akses Laporan CU)</a>,</li>

            <li>Kemudian pilih/klik laporan mana yang ingin diubah di tabel (mis: memilih laporan periode September 2016),</li>
             {{ Html::image($imagepath.'laporancutabelpilih.png','pilih tabel laporan', array('class' => 'img-responsive ','style'=>'margin-bottom:10px;')) }}

            <li>Kemudian menekan tombol <button class="btn btn-default btn-sm" disabled><i class="fa fa-pencil"></i> <u>U</u>bah</button> pada bagian <b>Data Bar</b>,</li>
            {{ Html::image($imagepath.'laporancuubah.png','ubah laporan cu', array('class' => 'img-responsive ','style'=>'margin-bottom:10px;')) }}

            <li>Selanjutnya pengguna akan diarahkan ke halaman <b>Ubah Laporan CU</b> yang tampilannya sama dengan halaman <b>Tambah Laporan CU</b> cuma bedanya sekarang masing-masing <b>textbox</b> telah terisi angka sesuai dengan data yang tadi dipilih di tabel,</li>
            <li>Pengguna tinggal mengubah bagian mana yang ingin diubah dan selanjutnya menekan tombol <button class="btn btn-primary btn-sm" disabled><i class="fa fa-save"></i> <u>S</u>impan</button> untuk menyimpan perubahan data, atau jika tidak ingin mengubah data tinggal menekan tombol <button class="btn btn-danger btn-sm" disabled><i class="fa fa-times"></i> <u>B</u>atal</button></li>
        </ol>
    </p>
    {{-- hapus laporan --}}
    <h3 id="laporancu-hapus">Hapus Laporan CU</h3>
    <p class="lead">
        <ol>
            <li>Untuk menghapus data pada laporan CU, pengguna pertama harus berada di halaman Laporan CU <a href="#laporancu-akses">(caranya dapat dilihat di bagian Akses Laporan CU)</a>,</li>

            <li>Kemudian pilih/klik laporan mana yang ingin diubah di tabel (mis: memilih laporan periode September 2016),</li>
             {{ Html::image($imagepath.'laporancutabelpilih.png','pilih tabel laporan', array('class' => 'img-responsive ','style'=>'margin-bottom:10px;')) }}

            <li>Kemudian menekan tombol <button class="btn btn-default btn-sm" disabled><i class="fa fa-trash"></i> <u>H</u>apus</button> pada bagian <b>Data Bar</b>,</li>
            {{ Html::image($imagepath.'laporancuhapus.png','hapus laporan cu', array('class' => 'img-responsive ','style'=>'margin-bottom:10px;')) }}

            <li>Maka akan muncul kotak dialog yang merupakan konfirmasi apakah benar laporan ini akan dihapus</li>
            {{ Html::image($imagepath.'laporancuhapusmodal.png','hapus laporan cu modal', array('class' => 'img-responsive ','style'=>'margin-bottom:10px;')) }}

            <li>Tekan tombol <button class="btn btn-danger btn-sm" disabled><i class="fa fa-trash"></i> Hapus</button> untuk menghapus laporan, laporan yang terhapus akan otomatis masuk ke <b>Tabel Laporan Terhapus</b>.Apabila tidak ingin menghapus maka menekan tombol <button class="btn btn-default btn-sm" disabled><i class="fa fa-times"></i> Batal</button>
            </li>
        </ol>
    </p>
    {{-- detail laporan --}}
    <h3 id="laporancu-detail">Detail Laporan CU</h3>
     <p class="lead">
        <ol>
            <li>Untuk menghapus data pada laporan CU, pengguna pertama harus berada di halaman Laporan CU <a href="#laporancu-akses">(caranya dapat dilihat di bagian Akses Laporan CU)</a>,</li>

            <li>Kemudian pilih/klik laporan mana yang ingin diubah di tabel (mis: memilih laporan periode September 2016),</li>
             {{ Html::image($imagepath.'laporancutabelpilih.png','pilih tabel laporan', array('class' => 'img-responsive ','style'=>'margin-bottom:10px;')) }}

            <li>Kemudian menekan tombol <button class="btn btn-default btn-sm" disabled><i class="fa fa-database"></i> Detail</button> pada bagian <b>Data Bar</b>,</li>
            {{ Html::image($imagepath.'laporancutomboldetail.png','detail laporan cu', array('class' => 'img-responsive ','style'=>'margin-bottom:10px;')) }}
            <li>Selanjutnya pengguna akan diarahkan ke halaman <b>Detail Laporan CU</b></li>
        </ol>
    </p>
    {{ Html::image($imagepath.'laporancudetail.png','laporan cu detail', array('class' => 'img-responsive ','style'=>'margin-bottom:10px;')) }}
    <p class="lead">
        Detail Laporan CU adalah halaman yang berfungsi untuk melihat secara lebih terfokus dan mendetail mengenai laporan pada bulan/periode tertentu. Pada halaman ini akan ditampilkan beberapa komponen yaitu: 
        <ol>
            <li><b>Periode Laporan</b> yang berfungsi untuk memilih periode laporan mana yang ingin di tampilkan.</li>
            <li><b><a href="#dashboard-panelperkembangan">Panel perkembangan</a></b> sesuai bulan/periode yang dipilih. </li>
            <li><b>Panel diskusi</b> yang berguna untuk komunikasi antar pengguna dengan pihak Puskopdit BKCU Kalimantan berkaitan dengan laporan pada periode tersebut.<br/>
            Untuk memulai diskusi maka:
            <ol>
                <li>Ketikkan pesan yang ingin disampaikan/didiskusikan,</li>
                <li>Tekan tombol <button class="btn btn-primary btn-sm" disabled><i class="fa fa-send"></i></button></li>
            </ol>
            </li>
            {{ Html::image($imagepath.'laporancudiskusi.png','laporan cu diskusi', array('class' => 'img-responsive ','style'=>'margin-bottom:10px;')) }}
            <li><b>Panel revisi</b> yang berguna untuk menampilkan sejarah perubahan data pada laporan CU.</li>
             {{ Html::image($imagepath.'laporancurevisi.png','laporan cu revisi', array('class' => 'img-responsive ','style'=>'margin-bottom:10px;')) }}
        </ol>    
    </p>
</section>
@stop
@section('js')
    <script type="text/javascript">
    </script>
@stop