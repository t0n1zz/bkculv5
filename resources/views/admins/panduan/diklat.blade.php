<div id="diklat-akses">
    <h2 class="page-header"><a href="#diklat">Diklat</a></h2>
    {{-- akses --}}
    <h2 class="page-header"><a href="#diklat-akses">Akses <small>Diklat</small></a></h2>
    {{ Html::image($imagepath.'diklat-akses.png','akses', array('class' => 'img-responsive ','style'=>'margin-bottom:10px;')) }}
    <p class="lead">
        Halaman ini dapat diakses dengan menekan tombol <b>Diklat</b> pada <a href="#dashboard-header">Header dibagian <code><i class="fa fa-suitcase"></i> Diklat</code></a> atau pada <a href="#dashboard-aksescepat">Akses cepat</a> di halaman <a href="#dashboard-all">Dashboard</a>.
    </p>
</div>
{{-- pengenalan --}}
<div id="diklat-pengenalan">
    <h2 class="page-header"><a href="#diklat-pengenalan">Pengenalan <small>Diklat</small></a></h2>
    <p class="lead">
        Halaman <b>Diklat</b> merupakan daftar lengkap diklat yang telah, sedang dan akan dilaksanakan/diselenggarakan oleh Puskopdit BKCU Kalimantan. Anda dapat melihat daftar diklat yang telah di urutkan berdasarkan periode dan dapat mendaftarkan staf untuk mengikuti diklat sesuai yang tertera. <br/><br/>  
    </p>
    {{ Html::image($imagepath.'diklat-all.png','Diklat', array('class' => 'img-responsive ','style'=>'margin-bottom:10px;')) }}
    <p class="lead">
        Inilah halaman <b>Diklat</b>. Pada halaman ini terdapat beberapa komponen yaitu:
        <ol>
            <li><b>Pencarian</b>: fungsinya untuk melakukan pencarian pada tabel yang ditampilkan dibawah. Silahkan ketikkan saja kata kunci pencarian maka tabel akan memunculkan baris yang dicari sesuai dengan kata kunci yang diketikkan <b>jika ada</b>.</li>
            {{ Html::image($imagepath.'pencarian.png','pencarian', array('class' => 'img-responsive ','style'=>'margin-bottom:10px;')) }}
             <li><b>Periode Diklat</b>: fungsinya untuk mengatur diklat pada periode berapa yang akan ditampilkan.</li>
            <li><b>Toolbar</b>: merupakan bagian yang menyediakan tombol-tombol yang berfungsi untuk berinteraksi dengan tabel yang ditampilkan.
                <ul>
                    <li><b>Column Display Bar</b>: tombol yang berfungsi untuk mengatur kolom apa saja yang ingin ditampilkan pada tabel.</li>
                    {{ Html::image($imagepath.'diklat-columndisplay.png','column display', array('class' => 'img-responsive ','style'=>'margin-bottom:10px;')) }}
                    <li><b>Daftar</b>: tombol yang berfungsi masuk ke halaman pendaftaran staf sesuai diklat yang dipilih.</li>
                    {{ Html::image($imagepath.'diklat-btndaftar.png','column display', array('class' => 'img-responsive ','style'=>'margin-bottom:10px;')) }}
                </ul>
            </li>
            <li><b>Tabel</b>: merupakan bagian tabel yang menampilkan data.</li>
            <li><b>Expand</b>: merupakan tombol yang berfungsi untuk menampilkan informasi tambahan pada baris tabel tersebut.</li>
            {{ Html::image($imagepath.'expand.png','column display', array('class' => 'img-responsive ','style'=>'margin-bottom:10px;')) }}
        </ol>
    </p>
</div>
{{-- daftar --}}
<div id="diklat-daftar">
    <h2 class="page-header"><a href="#diklat-daftar">Daftar <small>Diklat</small></a></h2>
    <p class="lead">
        Halaman <b>Daftar Diklat</b> merupakan halaman untuk mendaftarkan staf pada diklat yang dipilih, pada halaman ini terdapat informasi umum mengenai diklat tersebut dan tabel yang merupakan tempat mendaftarkan staf untuk mengikuti diklat.<br/><br/>  
    </p>
    {{ Html::image($imagepath.'diklat-daftar.png','Diklat', array('class' => 'img-responsive ','style'=>'margin-bottom:10px;')) }}
    <p class="lead">
        Inilah halaman <b>Daftar Diklat</b>. Pada halaman ini terdapat beberapa komponen yaitu:
        <ol>
            <li><b>Panel Info</b>: fungsinya untuk menampilkan informasi mendasar diklat yang dipilih.</li>
            <li><b>Panel Pendaftaran</b>: merupakan panel yang memiliki tabel peserta diklat. Pada panel ini anda akan menemukan tombol untuk melakukan pendaftaran peserta. Beberapa tombol yang disediakan adalah:
                <ul>
                    <li><b>Tambah</b>: tombol yang berfungsi menambah/mendaftarkan peserta. Dengan menekan tombol ini maka akan muncul kotak dialog yang akan menampilkan daftar staf CU anda yang dilengkapi dengan informasi dasar staf tersebut. Anda cukup memilih staf mana yang akan didaftarkan dan kemudian menekan tombol simpan.</li>
                    {{ Html::image($imagepath.'diklat-tambahpeserta.png','daftar peserta', array('class' => 'img-responsive ','style'=>'margin-bottom:10px;')) }}
                    <li><b>Hapus</b>: tombol yang berfungsi menghapus staf yang sudah terdaftar.</li>
                    <li><b>Keterangan</b>: tombol yang berfungsi memberikan keterangan atau informasi khusus mengenai staf kepada pihak penyelenggara diklat. Misalnya: staf alergi udang, atau staf sedang pantang atau yang kondisi khusus lainnya yang dirasa perlu dan penting untuk diketahui pihak penyelenggara diklat.</li>
                    <li><b>Profil</b>: tombol yang berfungsi untuk menuju profil dari staf yang dipilih.</li>
                </ul>
            </li>
        </ol>
    </p>
</div>