<div id="laporancu-akses">
    <h2 class="page-header"><a href="#laporancu">Laporan CU</a></h2>
    {{-- akses --}}
    <h2 class="page-header"><a href="#laporancu-akses">Akses <small>Laporan CU</small></a></h2>
    {{ Html::image($imagepath.'laporancu-akses.png','akses', array('class' => 'img-responsive ','style'=>'margin-bottom:10px;')) }}
    <p class="lead">
        Halaman ini dapat diakses dengan menekan tombol <b>Laporan CU</b> pada <a href="#dashboard-header">Header dibagian <code><i class="fa fa-bar-chart"></i> Litbang</code></a> atau pada <a href="#dashboard-aksescepat">Akses cepat</a> di halaman <a href="#dasboard-all">Dashboard</a>.
    </p>
</div>
{{-- pengenalan --}}
<div id="laporancu-pengenalan">
    <h2 class="page-header"><a href="#laporancu-pengenalan">Pengenalan <small>Laporan CU</small></a></h2>
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
    {{ Html::image($imagepath.'laporancu-all.png','laporan cu', array('class' => 'img-responsive ','style'=>'margin-bottom:10px;')) }}
    <p class="lead">
        Inilah halaman <b>Laporan CU</b>. Pada halaman ini terdapat beberapa komponen yaitu:
        <ol>
            <li><b>Tab tabel</b>: sama fungsinya seperti tab pada <a href="#dashboard-panelperkembangan">Panel perkembangan</a>, yaitu untuk mengatur panel menampilkan tabel sesuai dengan nama tab tersebut. Tab yang ada yaitu
                <ul>
                    <li><b>Tab Tabel Perkembangan</b>: menampilkan tabel perkembangan CU yang meliputi data anggota, aset, piutang, hutang, dll.</li>
                    {{ Html::image($imagepath.'laporancu-tabelperkembangan.png','tabel perkembangan', array('class' => 'img-responsive ','style'=>'margin-bottom:10px;')) }}
                    <li><b>Tab Tabel Pertumbuhan</b>: menampilkan tabel pertumbuhan CU yang meliputi data anggota, aset, piutang, hutang, dll.</li>
                    {{ Html::image($imagepath.'laporancu-tabelpertumbuhan.png','tabel perkembangan', array('class' => 'img-responsive ','style'=>'margin-bottom:10px;')) }}
                    <li><b>Tab Tabel P.E.A.R.L.S.</b>: menampilkan tabel hasil perhitungan P.E.A.R.L.S.
                        {{ Html::image($imagepath.'laporancu-tabelpearls.png','tabel perkembangan', array('class' => 'img-responsive ','style'=>'margin-bottom:5px;')) }}
                        <ul>
                            <li>Pada tabel perhitungan P.E.A.R.L.S. sudah otomatis dalam bentuk persentase disertai penanda apakah indikator tersebut <span class="label bg-aqua">IDEAL</span> atau <span class="label bg-red">TIDAK IDEAL</span></li>
                            <li>Untuk melihat perhitungan pada indikator tersebut, cukup klik pada bagian yang ingin diketahui perhitungannya</li>
                            {{ Html::image($imagepath.'laporancu-tabelpearlspilih.png','tabel perkembangan', array('class' => 'img-responsive ','style'=>'margin-bottom:5px;')) }}
                            <li>Selanjutnya akan muncul kotak dialog yang berisi rumus serta perhitungan pada indikator yang dipilih</li>
                            {{ Html::image($imagepath.'laporancu-tabelpearlshitung.png','tabel perkembangan', array('class' => 'img-responsive ','style'=>'margin-bottom:5px;')) }}
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
                    {{ Html::image($imagepath.'laporancu-columndisplay.png','column display', array('class' => 'img-responsive ','style'=>'margin-bottom:10px;')) }}
                    <li><b>Data Bar</b>: tombol yang berfungsi untuk menambah, mengubah, menghapus serta melihat detail dari laporan yang dipilih di tabel.</li>
                    {{ Html::image($imagepath.'laporancu-databar.png','data bar', array('class' => 'img-responsive ','style'=>'margin-bottom:10px;')) }}
                    <li><b>Download Excel</b>: tombol yang berfungsi untuk mendownload tabel yang ditampilkan menjadi file excel.</li>
                    {{ Html::image($imagepath.'laporancu-downloadexcel.png','download excel', array('class' => 'img-responsive ','style'=>'margin-bottom:10px;')) }}
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
</div>
{{-- tambah laporan --}}
<div id="laporancu-tambah">
    <h2 class="page-header"><a href="#laporancu">Tambah <small>Laporan CU</small></a></h2>
    <p class="lead">
        <ol>
            <li>Untuk menambah data pada laporan CU, pengguna pertama harus berada di halaman Laporan CU <a href="#laporancu-akses">(caranya dapat dilihat di bagian Akses Laporan CU)</a>,</li>

            <li>Kemudian menekan tombol <button class="btn btn-default btn-sm" disabled><i class="fa fa-plus"></i> <u>T</u>ambah</button>  pada bagian <b>Data Bar</b>,</li>

            {{ Html::image($imagepath.'laporancu-tambah.png','tambah laporan cu', array('class' => 'img-responsive ','style'=>'margin-bottom:10px;')) }}

            <li>Selanjutnya pengguna akan diarahkan ke halaman <b>Tambah Laporan CU</b>,</li>
            {{ Html::image($imagepath.'laporancu-form.png','tambah laporan cu', array('class' => 'img-responsive ','style'=>'margin-bottom:10px;')) }}

            <li>Pengguna tinggal mengisikan sesuai dengan tempat yang telah disediakan berupa <b>textbox</b>.</li>
            {{ Html::image($imagepath.'laporancu-textbox.png','tambah laporan cu', array('class' => 'img-responsive ','style'=>'margin-bottom:10px;')) }}

            <li>Untuk beberapa bagian akan terdapat logo <code><i class="fa fa-question-circle-o"></i></code> maka itu berarti ada keterangan lebih lanjut, untuk membacanya tinggal arahkan cursor ke logo <code><i class="fa fa-question-circle-o"></i></code>,</li>

            <li>Apabila sudah terisi dengan benar maka pengguna tinggal menekan tombol <button class="btn btn-primary btn-sm" disabled><i class="fa fa-save"></i> <u>S</u>impan</button>, 
            apabila berencana untuk menambah <b>data laporan baru</b> setelah menyimpan maka bisa <b>lebih cepat</b> jika menekan tombol <button class="btn btn-primary btn-sm" disabled><i class="fa fa-save"></i><i class="fa fa-plus"></i> Si<u>m</u>pan dan buat baru</button>. J
            ika ingin batal menambah data silakan menekan tombol <button class="btn btn-danger btn-sm" disabled><i class="fa fa-times"></i> <u>B</u>atal</button></li>
        </ol>
    </p>
</div>    
{{-- ubah laporan --}}
<div id="laporancu-ubah">
    <h2 class="page-header"><a href="#laporancu-pengenalan">Ubah <small>Laporan CU</small></a></h2>
    <p class="lead">
        <ol>
            <li>Untuk mengubah data pada laporan CU, pengguna pertama harus berada di halaman Laporan CU <a href="#laporancu-akses">(caranya dapat dilihat di bagian Akses Laporan CU)</a>,</li>

            <li>Kemudian pilih/klik laporan mana yang ingin diubah di tabel (mis: memilih laporan periode September 2016),</li>
             {{ Html::image($imagepath.'laporancu-tabelpilih.png','pilih tabel laporan', array('class' => 'img-responsive ','style'=>'margin-bottom:10px;')) }}

            <li>Kemudian menekan tombol <button class="btn btn-default btn-sm" disabled><i class="fa fa-pencil"></i> <u>U</u>bah</button> pada bagian <b>Data Bar</b>,</li>
            {{ Html::image($imagepath.'laporancu-ubah.png','ubah laporan cu', array('class' => 'img-responsive ','style'=>'margin-bottom:10px;')) }}

            <li>Selanjutnya pengguna akan diarahkan ke halaman <b>Ubah Laporan CU</b> yang tampilannya sama dengan halaman <b>Tambah Laporan CU</b> cuma bedanya sekarang masing-masing <b>textbox</b> telah terisi angka sesuai dengan data yang tadi dipilih di tabel,</li>
            <li>Pengguna tinggal mengubah bagian mana yang ingin diubah dan selanjutnya menekan tombol <button class="btn btn-primary btn-sm" disabled><i class="fa fa-save"></i> <u>S</u>impan</button> untuk menyimpan perubahan data, atau jika tidak ingin mengubah data tinggal menekan tombol <button class="btn btn-danger btn-sm" disabled><i class="fa fa-times"></i> <u>B</u>atal</button></li>
        </ol>
    </p>
</div>    
{{-- hapus laporan --}}
<div id="laporancu-hapus">
    <h2 class="page-header"><a href="#laporancu-pengenalan">Hapus <small>Laporan CU</small></a></h2>
    <p class="lead">
        <ol>
            <li>Untuk menghapus data pada laporan CU, pengguna pertama harus berada di halaman Laporan CU <a href="#laporancu-akses">(caranya dapat dilihat di bagian Akses Laporan CU)</a>,</li>

            <li>Kemudian pilih/klik laporan mana yang ingin diubah di tabel (mis: memilih laporan periode September 2016),</li>
             {{ Html::image($imagepath.'laporancu-tabelpilih.png','pilih tabel laporan', array('class' => 'img-responsive ','style'=>'margin-bottom:10px;')) }}

            <li>Kemudian menekan tombol <button class="btn btn-default btn-sm" disabled><i class="fa fa-trash"></i> <u>H</u>apus</button> pada bagian <b>Data Bar</b>,</li>
            {{ Html::image($imagepath.'laporancu-hapus.png','hapus laporan cu', array('class' => 'img-responsive ','style'=>'margin-bottom:10px;')) }}

            <li>Maka akan muncul kotak dialog yang merupakan konfirmasi apakah benar laporan ini akan dihapus</li>
            {{ Html::image($imagepath.'laporancu-hapusmodal.png','hapus laporan cu modal', array('class' => 'img-responsive ','style'=>'margin-bottom:10px;')) }}

            <li>Tekan tombol <button class="btn btn-danger btn-sm" disabled><i class="fa fa-trash"></i> Hapus</button> untuk menghapus laporan, laporan yang terhapus akan otomatis masuk ke <b>Tabel Laporan Terhapus</b>.Apabila tidak ingin menghapus maka menekan tombol <button class="btn btn-default btn-sm" disabled><i class="fa fa-times"></i> Batal</button>
            </li>
        </ol>
    </p>
</div>
{{-- detail laporan --}}
<div id="laporancu-detail">
    <h2 class="page-header"><a href="#laporancu-pengenalan">Detail <small>Laporan CU</small></a></h2>
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
    {{ Html::image($imagepath.'laporancu-detail.png','laporan cu detail', array('class' => 'img-responsive ','style'=>'margin-bottom:10px;')) }}
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
            {{ Html::image($imagepath.'laporancu-diskusi.png','laporan cu diskusi', array('class' => 'img-responsive ','style'=>'margin-bottom:10px;')) }}
            <li><b>Panel revisi</b> yang berguna untuk menampilkan sejarah perubahan data pada laporan CU.</li>
             {{ Html::image($imagepath.'laporancu-revisi.png','laporan cu revisi', array('class' => 'img-responsive ','style'=>'margin-bottom:10px;')) }}
        </ol>    
    </p>
</div>