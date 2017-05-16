<div id="tpcu-akses">
    <h2 class="page-header"><a href="#tpcu">TP CU</a></h2>
    {{-- akses --}}
    <h2 class="page-header"><a href="#tpcu-akses">Akses <small>TP CU</small></a></h2>
    {{ Html::image($imagepath.'tpcu-akses.png','akses', array('class' => 'img-responsive ','style'=>'margin-bottom:10px;')) }}
    <p class="lead">
        Halaman ini dapat diakses dengan menekan tombol <b>TP CU</b> pada <a href="#dashboard-header">Header dibagian <code><i class="fa fa-home"></i> TP CU</code></a> atau pada <a href="#dashboard-aksescepat">Akses cepat</a> di halaman <a href="#dasboard-all">Dashboard</a>.
    </p>
</div>
{{-- pengenalan --}}
<div id="tpcu-pengenalan">
    <h2 class="page-header"><a href="#tpcu-pengenalan">Pengenalan <small>TP CU</small></a></h2>
    <p class="lead">
        Halaman <b>TP CU</b> berfungsi sebagai daftar TP CU anda beserta informasi umum seperti foto kantor, alamat dan kontak.
    </p>
    {{ Html::image($imagepath.'tpcu-all.png','cu', array('class' => 'img-responsive ','style'=>'margin-bottom:10px;')) }}
    <p class="lead">
        Inilah halaman <b>TP CU</b>. Pada halaman ini terdapat beberapa komponen yaitu:
        <ol>
            <li><b>Pencarian</b>: fungsinya untuk melakukan pencarian pada tabel yang ditampilkan dibawah. Silahkan ketikkan saja kata kunci pencarian maka tabel akan memunculkan baris yang dicari sesuai dengan kata kunci yang diketikkan <b>jika ada</b>.</li>
            {{ Html::image($imagepath.'pencarian.png','pencarian', array('class' => 'img-responsive ','style'=>'margin-bottom:10px;')) }}
            <li><b>Toolbar</b>: merupakan bagian yang menyediakan tombol-tombol yang berfungsi untuk berinteraksi dengan tabel yang ditampilkan.
                <ul>
                    <li><b>Column Display Bar</b>: tombol yang berfungsi untuk mengatur kolom apa saja yang ingin ditampilkan pada tabel.</li>
                    {{ Html::image($imagepath.'diklat-columndisplay.png','column display', array('class' => 'img-responsive ','style'=>'margin-bottom:10px;')) }}
                    <li><b>Data Bar</b>: tombol yang berfungsi untuk menambah, mengubah, dan menghapus data TP CU yang dipilih di tabel.</li>
                    {{ Html::image($imagepath.'databar.png','data bar', array('class' => 'img-responsive ','style'=>'margin-bottom:10px;')) }}
                </ul>
            </li>
            <li><b>Tabel</b>: merupakan bagian tabel yang menampilkan data.</li>
        </ol>
    </p>
</div>  
{{-- tambah tpcu --}}
<div id="tpcu-tambah">
    <h2 class="page-header"><a href="#tpcu">Tambah <small>TP CU</small></a></h2>
    <p class="lead">
        <ol>
            <li>Untuk menambah data pada TP CU, pengguna pertama harus berada di halaman TP CU <a href="#tpcu-akses">(caranya dapat dilihat di bagian Akses TP CU)</a>,</li>

            <li>Kemudian menekan tombol <button class="btn btn-default btn-sm" disabled><i class="fa fa-plus"></i> <u>T</u>ambah</button>  pada bagian <b>Data Bar</b>,</li>

            {{ Html::image($imagepath.'btntambah.png','tambah tp cu', array('class' => 'img-responsive ','style'=>'margin-bottom:10px;')) }}

            <li>Selanjutnya pengguna akan diarahkan ke halaman <b>Tambah TP CU</b>,</li>
            {{ Html::image($imagepath.'tpcu-form.png','tambah tp cu', array('class' => 'img-responsive ','style'=>'margin-bottom:10px;')) }}

            <li>Apabila sudah terisi dengan benar maka pengguna tinggal menekan tombol <button class="btn btn-primary btn-sm" disabled><i class="fa fa-save"></i> <u>S</u>impan</button>, 
            apabila berencana untuk menambah <b>data baru</b> setelah menyimpan maka bisa <b>lebih cepat</b> jika menekan tombol <button class="btn btn-primary btn-sm" disabled><i class="fa fa-save"></i><i class="fa fa-plus"></i> Si<u>m</u>pan dan buat baru</button>. J
            ika ingin batal menambah data silakan menekan tombol <button class="btn btn-danger btn-sm" disabled><i class="fa fa-times"></i> <u>B</u>atal</button></li>
        </ol>
    </p>
</div>    
{{-- ubah laporan --}}
<div id="tpcu-ubah">
    <h2 class="page-header"><a href="#tpcu-pengenalan">Ubah <small>TP CU</small></a></h2>
    <p class="lead">
        <ol>
            <li>Untuk mengubah data pada tp CU, pengguna pertama harus berada di halaman tp CU <a href="#tpcu-akses">(caranya dapat dilihat di bagian Akses tp CU)</a>,</li>

            <li>Kemudian pilih/klik tp mana yang ingin diubah di tabel,</li>

            <li>Kemudian menekan tombol <button class="btn btn-default btn-sm" disabled><i class="fa fa-pencil"></i> <u>U</u>bah</button> pada bagian <b>Data Bar</b>,</li>
            {{ Html::image($imagepath.'btnubah.png','ubah tp cu', array('class' => 'img-responsive ','style'=>'margin-bottom:10px;')) }}

            <li>Selanjutnya pengguna akan diarahkan ke halaman <b>Ubah TP CU</b> yang tampilannya sama dengan halaman <b>Tambah TP CU</b> cuma bedanya sekarang masing-masing <b>textbox</b> telah terisi data sesuai dengan TP CU yang tadi dipilih di tabel,</li>
            <li>Pengguna tinggal mengubah bagian mana yang ingin diubah dan selanjutnya menekan tombol <button class="btn btn-primary btn-sm" disabled><i class="fa fa-save"></i> <u>S</u>impan</button> untuk menyimpan perubahan data, atau jika tidak ingin mengubah data tinggal menekan tombol <button class="btn btn-danger btn-sm" disabled><i class="fa fa-times"></i> <u>B</u>atal</button></li>
        </ol>
    </p>
</div>    
{{-- hapus laporan --}}
<div id="tpcu-hapus">
    <h2 class="page-header"><a href="#tpcu-hapus">Hapus <small>TP CU</small></a></h2>
    <p class="lead">
        <ol>
            <li>Untuk menghapus data pada TP CU, pengguna pertama harus berada di halaman TP CU <a href="#tpcu-akses">(caranya dapat dilihat di bagian Akses TP CU)</a>,</li>

            <li>Kemudian pilih/klik tp mana yang ingin diubah di tabel</li>

            <li>Kemudian menekan tombol <button class="btn btn-default btn-sm" disabled><i class="fa fa-trash"></i> <u>H</u>apus</button> pada bagian <b>Data Bar</b>,</li>
            {{ Html::image($imagepath.'btnhapus.png','hapus tp cu', array('class' => 'img-responsive ','style'=>'margin-bottom:10px;')) }}

            <li>Maka akan muncul kotak dialog yang merupakan konfirmasi apakah benar TP ini akan dihapus</li>

            <li>Tekan tombol <button class="btn btn-danger btn-sm" disabled><i class="fa fa-trash"></i> Hapus</button> untuk menghapus data, data yang terhapus akan otomatis masuk ke <b>Tabel TP Terhapus</b>.Apabila tidak ingin menghapus maka menekan tombol <button class="btn btn-default btn-sm" disabled><i class="fa fa-times"></i> Batal</button>
            </li>
        </ol>
    </p>
</div>