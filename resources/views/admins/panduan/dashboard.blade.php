<div id="dashboard-all">
    <h2 class="page-header"><a href="#dashboard-all">Dashboard</a></h2>
    {{ Html::image($imagepath.'dashboard-all.png','dashboard', array('class' => 'img-responsive ','style'=>'margin-bottom:10px;')) }}
    <p class="lead">
        Dashboard merupakan halaman yang paling pertama pengguna temui setelah <a href="#login"><b>login</b></a>. Halaman ini menampilkan ringkasan serta akses cepat ke fitur-fitur yang terdapat dalam aplikasi.<br/>
        Komponen yang terdapat yaitu:
        <ol>
            <li><a href="#dashboard-header">Header</a>.</li>
            <li><a href="#dashboard-aksescepat">Akses cepat</a>.</li>
            <li><a href="#dashboard-panelperkembangan">Panel perkembangan</a>.</li>
            <li><a href="#dashboard-panelkegiatan">Panel kegiatan</a>.</li>
            <li><a href="#dashboard-footer">Footer</a>.</li>
        </ol>
    </p>
    <div class="callout callout-warning lead">
        <h4>Perhatian!</h4>
        <p>
            Komponen dalam halaman ini akan berbeda-beda sesuai dengan hak akses yang diberikan kepada pengguna.
        </p>
    </div>
</div>
{{-- header --}}
<div id="dashboard-header">
    <h2 class="page-header"><a href="#dashboard-header">Header <small>Dashboard</small></a></h2>
    {{ Html::image($imagepath.'dashboard-header.png','header', array('class' => 'img-responsive ','style'=>'margin-bottom:10px;')) }}
    <p class="lead">
        Header terletak di bagian paling atas dari aplikasi ini dan memiliki komponen sebagai berikut:
        <ol>
            <li><b>Logo</b>: Nama Aplikasi</li>
            <li><b>Menu</b>: Menu navigasi aplikasi</li>
            <li><b>Pemberitahuan</b>: Tombol untuk menampilkan pemberitahuan terbaru.</li>
            <li><b>Mini Profile</b>: Foto serta nama dan asal lembaga pengguna aplikasi, serta ketika anda mengarahkan cursor disana, maka akan muncul kotak yang berisi tombol untuk logout/keluar dari aplikasi dan tombol profile yang berguna untuk melakukan pengubahan pada akun anda (foto,nama, dan password)</li>
        </ol>
    </p>
</div>
{{-- akses cepat --}}
<div id="dashboard-aksescepat">
    <h2 class="page-header"><a href="#dashboard-aksescepat">Akses Cepat <small>Dashboard</small></a></h2>
    {{ Html::image($imagepath.'dashboard-aksescepat.png','akses cepat', array('class' => 'img-responsive ','style'=>'margin-bottom:10px;')) }}
    <p class="lead">
        Akses cepat terletak di halaman <a href="#dashboard">dashboard</a>. Fungsinya adalah sebagai tombol untuk menuju halaman lain pada aplikasi ini serta menampilkan informasi dasar mengenai konten pada halaman yang akan dituju tersebut. Tombol yang tampil bervariasi tergantung pada hak akses yang dimiliki oleh pengguna.
    </p>
</div>
{{-- panel perkembangan --}}
<div id="dashboard-panelperkembangan">
    <h2 class="page-header"><a href="#dashboard-panelperkembangan">Panel Perkembangan <small>Dashboard</small></a></h2>
    {{ Html::image($imagepath.'dashboard-panelperkembangan.png','panel perkembangan', array('class' => 'img-responsive ','style'=>'margin-bottom:10px;')) }}
    <p class="lead">
        Panel perkembangan terletak di halaman <a href="#dashboard">dashboard</a>. Fungsinya adalah menampilkan informasi perkembangan keuangan CU pengguna yang disajikan dalam bentuk grafik serta perbandingan dengan laporan keuangan bulan/periode sebelumnya.
    </p>
    {{ Html::image($imagepath.'dashboard-grafikubah.png','ubah grafik', array('class' => 'img-responsive ','style'=>'margin-bottom:10px;')) }}
    <p class="lead">
       Pada <b>tab Perkembangan CU</b>, grafik yang ditampilkan merupakan grafik interaktif, yang artinya tidak hanya menampilkan grafik perkembangan total anggota (seperti yang terlihat), tetapi juga bisa dipilih grafik perkembangan apa yang dibutuhkan untuk ditampilkan (mis: grafik perkembangan aset). Untuk mengubahnya adalah dengan memilih di bagian <code><i class="fa fa-line-chart"></i> Grafik Laporan Berdasarkan</code>
    </p>
    {{ Html::image($imagepath.'dashboard-tabpanelperkembangan.png','panel perkembangan', array('class' => 'img-responsive ','style'=>'margin-bottom:10px;')) }}
    <p class="lead">
       Dibagian atas kanan pada panel perkembangan terdapat 2 <b>tab</b> yaitu <b>Perkembangan CU</b> dan <b>P.E.A.R.L.S</b>, silahkan tekan salah satu untuk menampilkan panel sesuai nama tab. Secara otomatis yang terbuka adalah tab Perkembangan CU, untuk melihat P.E.A.R.L.S. pengguna cukup menekan tab bertuliskan P.E.A.R.L.S. maka akan panel akan berubah dan menampilkan data P.E.A.R.L.S. pada bulan/periode terakhir/terbaru yang terdapat pada program.
    </p>
    {{ Html::image($imagepath.'dashboard-panelpearls.png','pearls', array('class' => 'img-responsive ','style'=>'margin-bottom:10px;')) }}
</div>
{{-- kegiatan --}}
<div id="dashboard-panelkegiatan">
    <h2 class="page-header"><a href="#dashboard-panelkegiatan">Panel Kegiatan <small>Dashboard</small></a></h2>
    {{ Html::image($imagepath.'dashboard-kegiatan.png','panel kegiatan', array('class' => 'img-responsive ','style'=>'margin-bottom:10px;')) }}
    <p class="lead">
        Panel kegiatan terletak di halaman <a href="#dashboard">dashboard</a>. Fungsinya adalah menampilkan informasi kegiatan yang akan dilaksanakan dalam kurun waktu 3 bulan kedepan serta menampilkan kegiatan yang sedang berlangsung saat ini. Terdapat juga kalender hari ini.
    </p>
</div>
{{-- footer --}}
<div id="dashboard-footer">
    <h2 class="page-header"><a href="#dashboard-footer">Footer <small>Dashboard</small></a></h2>
    {{ Html::image($imagepath.'dashboard-footer.png','footer', array('class' => 'img-responsive ','style'=>'margin-bottom:10px;')) }}
    <p class="lead">
        Footer terletak di bagian bawah aplikasi. Berfungsi untuk menampilkan informasi hak cipta aplikasi, dan versi dari aplikasi yang sedang digunakan. Jika menekan tulisan <code>{{ $appname }} {{ $versi }}</code> akan mengarahkan pengguna ke halaman <b>version</b> yang menampilkan secara detail sejarah perkembangan aplikasi ini serta fitur apa saja yang ditambahkan, diperbaiki atau dihilangkan dari aplikasi {{ $appname }}. 
    </p>
</div>