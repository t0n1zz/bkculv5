<div id="staf-akses">
    <h2 class="page-header"><a href="#staf">Staf</a></h2>
    {{-- akses --}}
    <h2 class="page-header"><a href="#staf-akses">Akses <small>Staf</small></a></h2>
    {{ Html::image($imagepath.'staf-akses.png','akses', array('class' => 'img-responsive ','style'=>'margin-bottom:10px;')) }}
    <p class="lead">
        Halaman ini dapat diakses dengan menekan tombol <b>Staf</b> pada <a href="#dashboard-header">Header dibagian <code><i class="fa fa-home"></i> Staf</code></a> atau pada <a href="#dashboard-aksescepat">Akses cepat</a> di halaman <a href="#dasboard-all">Dashboard</a>.
    </p>
</div>
{{-- pengenalan --}}
<div id="staf-pengenalan">
    <h2 class="page-header"><a href="#staf-pengenalan">Pengenalan <small>Staf</small></a></h2>
    <p class="lead">
        Halaman <b>Staf</b> berfungsi sebagai daftar Staf CU yang berisi informasi umum seperti foto, alamat, kontak dan juga berisi infromasi riwayat pekerjaan, pendidikan dan organisasi. <br/>
        Halaman ini juga terhubung kepada bagian diklat yang dimana akan terdapat riwayat staf sebagai peserta maupun sebagai panitia atau fasilitator. <br/>
    </p>
    {{ Html::image($imagepath.'staf-all.png','cu', array('class' => 'img-responsive ','style'=>'margin-bottom:10px;')) }}
    <p class="lead">
        Inilah halaman <b>Staf</b>. Pada halaman ini terdapat beberapa komponen yaitu:
        <ol>
            <li><b>Pencarian</b>: fungsinya untuk melakukan pencarian pada tabel yang ditampilkan dibawah. Silahkan ketikkan saja kata kunci pencarian maka tabel akan memunculkan baris yang dicari sesuai dengan kata kunci yang diketikkan <b>jika ada</b>.</li>
            {{ Html::image($imagepath.'pencarian.png','pencarian', array('class' => 'img-responsive ','style'=>'margin-bottom:10px;')) }}
            <li><b>Toolbar</b>: merupakan bagian yang menyediakan tombol-tombol yang berfungsi untuk berinteraksi dengan tabel yang ditampilkan.
                <ul>
                    <li><b>Column Display Bar</b>: tombol yang berfungsi untuk mengatur kolom apa saja yang ingin ditampilkan pada tabel.</li>
                    {{ Html::image($imagepath.'diklat-columndisplay.png','column display', array('class' => 'img-responsive ','style'=>'margin-bottom:10px;')) }}
                    <li><b>Data Bar</b>: tombol yang berfungsi untuk menambah, mengubah, dan menghapus data Staf yang dipilih di tabel.</li>
                    {{ Html::image($imagepath.'staf-databar.png','data bar', array('class' => 'img-responsive ','style'=>'margin-bottom:10px;')) }}
                </ul>
            </li>
            <li><b>Tabel</b>: merupakan bagian tabel yang menampilkan data.</li>
        </ol>
    </p>
</div>  
{{-- tambah staf --}}
<div id="staf-tambah">
    <h2 class="page-header"><a href="#staf">Tambah <small>Staf</small></a></h2>
    <p class="lead">
        <ol>
            <li>Untuk menambah data pada Staf, pengguna pertama harus berada di halaman Staf <a href="#staf-akses">(caranya dapat dilihat di bagian Akses Staf)</a>,</li>

            <li>Kemudian menekan tombol <button class="btn btn-default btn-sm" disabled><i class="fa fa-plus"></i> <u>T</u>ambah</button>  pada bagian <b>Data Bar</b>,</li>

            {{ Html::image($imagepath.'staf-btntambah.png','tambah Staf', array('class' => 'img-responsive ','style'=>'margin-bottom:10px;')) }}

            <li>Selanjutnya pengguna akan diarahkan ke halaman <b>Tambah Staf</b>,</li>
            {{ Html::image($imagepath.'staf-form.png','tambah Staf', array('class' => 'img-responsive ','style'=>'margin-bottom:10px;')) }}

            <li>Apabila sudah terisi dengan benar maka pengguna tinggal menekan tombol <button class="btn btn-primary btn-sm" disabled><i class="fa fa-save"></i> <u>S</u>impan</button>, 
            apabila berencana untuk menambah <b>data baru</b> setelah menyimpan maka bisa <b>lebih cepat</b> jika menekan tombol <button class="btn btn-primary btn-sm" disabled><i class="fa fa-save"></i><i class="fa fa-plus"></i> Si<u>m</u>pan dan buat baru</button>. J
            ika ingin batal menambah data silakan menekan tombol <button class="btn btn-danger btn-sm" disabled><i class="fa fa-times"></i> <u>B</u>atal</button></li>
        </ol>
    </p>
</div>    
{{-- ubah staf --}}
<div id="staf-ubah">
    <h2 class="page-header"><a href="#staf-pengenalan">Ubah Identitas <small>Staf</small></a></h2>
    <p class="lead">
        <ol>
            <li>Untuk mengubah identitas Staf, pengguna pertama harus berada di halaman Staf <a href="#staf-akses">(caranya dapat dilihat di bagian Akses Staf)</a>,</li>

            <li>Kemudian pilih/klik tp mana yang ingin diubah di tabel,</li>

            <li>Kemudian menekan tombol <button class="btn btn-default btn-sm" disabled><i class="fa fa-pencil"></i> <u>U</u>bah</button> pada bagian <b>Data Bar</b>,</li>
            {{ Html::image($imagepath.'staf-btnubah.png','ubah Staf', array('class' => 'img-responsive ','style'=>'margin-bottom:10px;')) }}

            <li>Selanjutnya pengguna akan diarahkan ke halaman <b>Ubah Staf</b> yang tampilannya sama dengan halaman <b>Tambah Staf</b> cuma bedanya sekarang masing-masing <b>textbox</b> telah terisi data sesuai dengan Staf yang tadi dipilih di tabel,</li>
            <li>Pengguna tinggal mengubah bagian mana yang ingin diubah dan selanjutnya menekan tombol <button class="btn btn-primary btn-sm" disabled><i class="fa fa-save"></i> <u>S</u>impan</button> untuk menyimpan perubahan data, atau jika tidak ingin mengubah data tinggal menekan tombol <button class="btn btn-danger btn-sm" disabled><i class="fa fa-times"></i> <u>B</u>atal</button></li>
        </ol>
    </p>
</div>    
{{-- hapus staf --}}
<div id="staf-hapus">
    <h2 class="page-header"><a href="#staf-hapus">Hapus <small>Staf</small></a></h2>
    <p class="lead">
        <ol>
            <li>Untuk menghapus data pada Staf, pengguna pertama harus berada di halaman Staf <a href="#staf-akses">(caranya dapat dilihat di bagian Akses Staf)</a>,</li>

            <li>Kemudian pilih/klik tp mana yang ingin diubah di tabel</li>

            <li>Kemudian menekan tombol <button class="btn btn-default btn-sm" disabled><i class="fa fa-trash"></i> <u>H</u>apus</button> pada bagian <b>Data Bar</b>,</li>
            {{ Html::image($imagepath.'staf-btnhapus.png','hapus Staf', array('class' => 'img-responsive ','style'=>'margin-bottom:10px;')) }}

            <li>Maka akan muncul kotak dialog yang merupakan konfirmasi apakah benar TP ini akan dihapus</li>

            <li>Tekan tombol <button class="btn btn-danger btn-sm" disabled><i class="fa fa-trash"></i> Hapus</button> untuk menghapus data, data yang terhapus akan otomatis masuk ke <b>Tabel TP Terhapus</b>.Apabila tidak ingin menghapus maka menekan tombol <button class="btn btn-default btn-sm" disabled><i class="fa fa-times"></i> Batal</button>
            </li>
        </ol>
    </p>
</div>
{{-- detail staf --}}
<div id="staf-detail">
    <h2 class="page-header"><a href="#staf-detail">Detail <small>Staf</small></a></h2>
    <p class="lead">
        <ol>
            <li>Untuk mengakses halaman detail staf, anda pertama harus berada di halaman Staf <a href="#staf-akses">(caranya dapat dilihat di bagian Akses Staf)</a>,</li>

            <li>Kemudian pilih/klik staf mana yang ingin diubah di tabel,</li>

            <li>Kemudian menekan tombol <button class="btn btn-default btn-sm" disabled><i class="fa fa-database"></i> Detail</button> pada bagian <b>Data Bar</b>,</li>
            {{ Html::image($imagepath.'staf-btndetail.png','detail staf', array('class' => 'img-responsive ','style'=>'margin-bottom:10px;')) }}
            <li>Selanjutnya anda akan diarahkan ke halaman <b>Detail Staf</b></li>
        </ol>
    </p>
    {{ Html::image($imagepath.'staf-detail.png','laporan cu detail', array('class' => 'img-responsive ','style'=>'margin-bottom:10px;')) }}
    <p class="lead">
        Detail Staf adalah halaman yang berfungsi menampilkan informasi lengkap mengenai staf yang terdiri dari:
        <ol>
            <li><b>Identitas</b>: menampilkan informasi dasar staf seperti foto, alamat, kontak dan identitas staf tersebut.</li>
            <li><b>Riwayat</b>: menampilkan riwayat staf yang terdiri dari riwayat pekerjaan, riwayat pendidikan dan riwayat berorganisasi.</li>
            <li><b>Kegiatan</b>: menampilkan keterlibatan staf dalam kegiatan yang diselenggarakan oleh Puskopdit BKCU Kalimantan.</li>
            <li><b>Keluarga</b>: menampilkan informasi anggota keluarga staf.</li>
            <li><b>Keanggotaan CU</b>: menampilkan keanggotaan staf di CU.</li>
        </ol>
    </p>
</div>