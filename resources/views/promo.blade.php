@extends('_layouts.layout')

@section('content')
<!-- Page Title -->
<div class="page-banner" style="padding:40px 0; background: url(images/slide-02-bg.jpg) center #f9f9f9;">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2>Modul Pendidikan dan Pelatihan</h2>
            </div>
            <div class="col-md-6">
                <ul class="breadcrumbs">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>Modul Pendidikan dan Pelatihan</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- /Page Title -->
<div id="content">
    <div class="container">
        <div class="big-title text-center" data-animation="fadeInDown" data-animation-delay="01">
            <h4>Puskopdit BKCU Kalimantan telah menyusun modul pendidikan dan pelatihan yang bertujuan untuk sebagai panduan pada beberapa aspek-aspek yang krusial dalam ber Credit Union</h4>
            <hr/>
        </div>
        <div class="hr1" style="margin-bottom:40px;margin-top: 40px;"></div>
        <div class="row" data-animation="fadeInDown" data-animation-delay="01">
            <div class="col-sm-6">
                {{ Html::image('images/modul/tatakelolacu.jpg','tatakelola', array(
                    'class' => 'img-responsive img-thumbnail shadow','width' => '700px')) }}
            </div>
            <div class="col-sm-6">
                <h2>Tata Kelola Credit Union</h2>
                <hr/>
                <p style="font-size: medium;">
                    <i class="fa fa-user"></i> Sukoco Irianto
                    <br/><br/>
                    Tugas utama pengurus, pengawas, staf, dan anggota adalah menjaga agar credit union berkelanjutan (<i>sustainable</i>). Agar terhindar dari krisis, credit union harus fokus pada penguatan dua hal, yaitu: keberlanjutan ekonomi <i>economic sustainability</i>) dan keberlanjutan sosial (<i>social sustainability</i>). 
                    <br/><br/>
                     Untuk itu, credit union memerlukan tata kelola yang baik berdasarkan nilai-nilai sejati credit union. Tata kelola credit union yang baik tersebut harus dipamai dan diimplementasikan secara terus-menerus, baik oleh pengurus, pengawas, manajemen, maupun oleh seluruh anggotanya agar credit union terus berkelanjutan.
                </p>
                <hr/>
                <div class="classic-testimonials">
                  <div class="testimonial-content">
                    <p style="font-size: medium;">
                        Apabila anda tertarik dengan modul ini, silahkan menghubungi: <br/>
                        <b>Thomas More Anwar - Staf Diklat :</b> +62 813 4500 5622
                    </p>
                  </div>
                </div>
            </div>            
        </div>
        <div class="hr1" style="margin-bottom:40px;margin-top: 40px;"></div>
        <div class="row" data-animation="fadeInDown" data-animation-delay="01">
            <div class="col-sm-6">
                {{ Html::image('images/modul/manajemenresiko.jpg','manajemenresiko', array(
                    'class' => 'img-responsive img-thumbnail shadow','width' => '700px')) }}
            </div> 
            <div class="col-sm-6">
                <h2>Manajemen Risiko Credit Union</h2>
                <hr/>
                <p style="font-size: medium;">
                    <i class="fa fa-user"></i> Erowin, S.Hut.
                    <br/><br/>
                    Kualitas pertumbuhan CU harus dijaga agar mampu bertumbuh dan berkembang secara sehat serta aman sehingga dapat mendorong keberadaan CU secara terus-menerus. Penerapan tata kelola CU yang baik dan benar menjadi kunci bagi keberlanjutan CU yang didukung dengan penerapan manajemen risiko yang efektif dan efisien.
                    <br/><br/>
                     Penerapan manajemen risiko menjadi suatu keharusan sehingga berbagai risiko yang menanti dapat terkelola dengan baik. Risiko tidak selalu menjadi ancaman bagi perkembangan CU, namun risiko yang terjadi tanpa disadari oleh pengelola dapat memberikan dampak negatif bagi kelangsungan CU.
                     <br/><br/>
                     Apalagi risiko yang terjadi sengaja diciptakan oleh oknum-oknum pengurus atau pengawas atau manajemen, maka dengan demikian dapat dipastikan akan mengganggu kegiatan operasional CU dan bahkan kita berdampak pada keruntuhan CU.
                     <br/><br/>
                     Sudah ada beberapa contoh CU yang sampai hari ini masih berjuang keluar dari permasalahan yang terjadi karena terlambat menyadari masalah tersebut atau bahkan membiarkan masalah terjadi tanpa ada upaya mengatasinya.
                </p>
                <hr/>
                <div class="classic-testimonials">
                  <div class="testimonial-content">
                    <p style="font-size: medium;">
                        Apabila anda tertarik dengan modul ini, silahkan menghubungi: <br/>
                        <b>Thomas More Anwar - Staf Diklat :</b> +62 813 4500 5622
                    </p>
                  </div>
                </div>
            </div>                  
        </div>
        <div class="hr1" style="margin-bottom:40px;margin-top: 40px;"></div>
        <div class="row" data-animation="fadeInDown" data-animation-delay="01">
            <div class="col-sm-6">
                {{ Html::image('images/modul/akutansicreditunion.jpg','akutansicreditunion', array(
                    'class' => 'img-responsive img-thumbnail shadow','width' => '700px')) }}
            </div> 
            <div class="col-sm-6">
                <h2>Akuntansi Credit Union</h2>
                <hr/>
                <p style="font-size: medium;">
                    <i class="fa fa-user"></i> Dominikus Dakota • Masius Triadi
                    <br/><br/>
                    Buku ini berisi panduan melaksanakan pendidikan dan pelatihan (Diklat) tentang Akutansi Credit Union. Sistem akuntansi di Credit Union (CU) mempunyai karakteristik yang unuk dibandingkan akuntansi lembaga lainnya. Karena itulah Puskopdit BKCU Kalimantan secara regular sejak belasan tahun memberikan Diklat tentang akuntansi CU.
                    <br/><br/>
                     Tujuan Diklat ini adalah untuk memperdalam pengetahuan aktivis CU tentang prinsip-prinsip akuntansi yang berlaku umum, proses dan alur pembukuan yang digunakan di CU, dan standar penyajian laporan keuangan yang berlaku. Sehingga peserta mampu membuat laporan keuangan (neraca, perhitungan hasil usaha, perubahan ekuitas, laporan arus kas, dan catatan atas laporan keuangan).
                     <br/><br/>
                     Setelah mengikut Diklat ini peserta diharapkan dapat memahami dan mempraktekkan proses pencatatan pembukan yang berlaku di CU; mampu membuat laporan keuangan berdasarkan standar akuntansi berbasis SAK-ETAP; mampu bekerjasama sebagai tim dalam menyelesaikan laporan keuangan serta dapat menerbitkan laporan keuangan secara valid, akuntabel dan tepat waktu agar dapat memnghasilkan keputusan yang tepat guna sesuai dengan kondisi terkini keuangan credit union.
                </p>
                <hr/>
                <div class="classic-testimonials">
                  <div class="testimonial-content">
                    <p style="font-size: medium;">
                        Apabila anda tertarik dengan modul ini, silahkan menghubungi: <br/>
                        <b>Thomas More Anwar - Staf Diklat :</b> +62 813 4500 5622
                    </p>
                  </div>
                </div>
            </div>           
        </div>
        <div class="hr1" style="margin-bottom:40px;margin-top: 40px;"></div>
        <div class="row" data-animation="fadeInDown" data-animation-delay="01">
            <div class="col-sm-6">
                {{ Html::image('images/modul/analisiskreditcu.jpg','analisiskredit', array(
                    'class' => 'img-responsive img-thumbnail shadow','width' => '700px')) }}
            </div> 
            <div class="col-sm-6">
                <h2>Analisis Kredit dan Penanganan Kredit Lalai</h2>
                <hr/>
                <p style="font-size: medium;">
                    <i class="fa fa-user"></i> Frans Laten • Serapina Serapin
                    <br/><br/>
                    Begitu masuk menjadi anggota, mereka sering kali segera ingin meminjam. Mereka juga lupa bahwa uang yang mereka pinjam harus digunakan dengan benar. Mereka beranggapan bahwa dengan meminjam, mereka akan mendapat uang dan semua malah mereka akan selesai.Mereka memuaskan diri dengan fakta bahwa pendapatan akan masuk dan tidak ada risiko.
                    <br/><br/>
                     Ini adalah metode yang paling sering dan paling merugikan yang diterapkan di CU. Ini menyebabkan kekacauan hebat. Terjadi kemunduran pada anggota CU yang sejak awal memang sudah kepayahan, diperparah dengan pemberian pinjaman yang sembarangan.
                     <br/><br/>
                     Pinjaman-pinjaman mereka meningkat dan mereka tidak mampu pengangsur pinjaman. Saldo pinjaman dan bunga yang harus dibayar menumpuk, dan tindakan tegas dari pihak CU akhirnya tidak terelakkan.
                     <br/><br/>
                     Selain itu, mungkin para penjamin juga mengalami kerugian. Para rentenir tertawa gembira. Ketika penyelamatan CU harus menjadi prioritas utama, CU akhirnya harus merelakan para anggotanya terjebak dalam lingkarang kemiskinan yang membelenggu mereka.
                     <br></br>
                     - F.W. Raiffeisen
                </p>
                <hr/>
                <div class="classic-testimonials">
                  <div class="testimonial-content">
                    <p style="font-size: medium;">
                        Apabila anda tertarik dengan modul ini, silahkan menghubungi: <br/>
                        <b>Thomas More Anwar - Staf Diklat :</b> +62 813 4500 5622
                    </p>
                  </div>
                </div>
            </div>           
        </div>
        <div class="hr1" style="margin-bottom:40px;margin-top: 40px;"></div>
        <div class="row" data-animation="fadeInDown" data-animation-delay="01">
            <div class="col-sm-6">
                {{ Html::image('images/modul/cuccc.jpg','cuccc', array(
                    'class' => 'img-responsive img-thumbnail shadow','width' => '700px')) }}
            </div> 
            <div class="col-sm-6">
                <h2>Credit Union CEO's Competency Course</h2>
                <hr/>
                <p style="font-size: medium;">
                    <i class="fa fa-user"></i> Herculanus Cale • Frans Laten • Serapina Serapin
                    <br/><br/>
                    <i>Manager</i> (M) atau <i>general manager</i> (GM) atau <i>chief executive office</i> (CEO) menempati posisi tunggal dalam organisasi credit union. Dialah orang yang pertama-tama bertanggung jawab dalam menjalankan perencanaan strategis dan kebijakkan-kebijakkan yang diterapkan oleh pengurus.
                    <br/><br/>
                     Dia juga bertanggung jawab atas keberhasilan atau kegagalan sebuah credit union. Kegiatan operasional, pemasaran, strategi, keuangan, menciptakan budaya organisasi, mengelola sumber daya manusia, menggaji, memberhentikan, kepatuhan terhadap regulasi, penjualan, relasi publik, dan seterusnya semuanya berada di pundak seorang M/GM/CEO.direct-chat-text
                     <br/><br/>
                     CUCCC adalah kursus yang merupakan upaya sekaligus tantangan dalam membuka pikiran M/GM/CEO terhadap perubahan strategi kompetensi kepemimpinan dan rentang tanggung jawab terkait operasional credit union.
                     <br/><br/>
                     CUCCC mendorong seorang M/GM/CEO untuk meningkatkan kinerja credit union dari kondisi yang biasa-biasa saja menjadi posisi yang luar biasa dengan mengekplorasi perubahan pada perspektif organisasi, personal dan strategis.
                </p>
                <hr/>
                <div class="classic-testimonials">
                  <div class="testimonial-content">
                    <p style="font-size: medium;">
                        Apabila anda tertarik dengan modul ini, silahkan menghubungi: <br/>
                        <b>Thomas More Anwar - Staf Diklat :</b> +62 813 4500 5622
                    </p>
                  </div>
                </div>
            </div>           
        </div>
        <div class="hr1" style="margin-bottom:40px;margin-top: 40px;"></div>
        <div class="row" data-animation="fadeInDown" data-animation-delay="01">
            <div class="col-sm-6">
                {{ Html::image('images/modul/pengembangandiri.jpg','pengembangandiri', array(
                    'class' => 'img-responsive img-thumbnail shadow','width' => '700px')) }}
            </div>
            <div class="col-sm-6">
                <h2>Pengembangan Diri</h2>
                <hr/>
                <p style="font-size: medium;">
                    <i class="fa fa-user"></i> Agustinus Alibata • P.Leo Asuk, Pr. • Victorina Budi Astuti
                    <br/><br/>
                    Tanamlah gagasan, Petiklah tindakan! Tanamlah tindakan, Petiklah kebiasaan! Tanamlah kebiasaan, Petiklah watak! Tanamlah watak, Petiklah nasib!
                    <br/><br/>
                     Kata Samuel Smile tersebut sungguh mempertegas bahsa nasib seseorang ternyata ditentukan oleh gagasan, cara pandang, perspektif seseorang atau yang disebut sebagai paradigma. Paradigma itu melahirkan tindakan atau sikap dan perilaku kita.
                     <br/><br/>
                     Sikap dan perilaku itu dilakukan secara berulang-ulang melahikran kebiasaan. Kebiasaan yang sangat sulit kita ubah dan telah menjadi bagian yang tak terpisahkan dari diri kita disebut watak atau karakter.
                     <br/><br/>
                     Pada gilirannya, karakter inilah yang akan membawa nasib kita. Singkatnya nasib kita ditentukan oleh paradigma kita.
                     <br/><br/>
                     Modul ini membantu kita untuk menapaki jalan pengembangan diri, mulai dari mengenal kelebihan dan kelemahan kita, membongkar paradigma, mengidentifikasi kekuatan untuk perubahan, mengenal model dasar perubahan, memulai perubahan, membangun kepercayaan diri, berpikir positif, membangun paradigma yang berpusat pada prinsip, membangun mentalitas memberi, dan membangun komunikasi asertif.
                </p>
                <hr/>
                <div class="classic-testimonials">
                  <div class="testimonial-content">
                    <p style="font-size: medium;">
                        Apabila anda tertarik dengan modul ini, silahkan menghubungi: <br/>
                        <b>Thomas More Anwar - Staf Diklat :</b> +62 813 4500 5622
                    </p>
                  </div>
                </div>
            </div>            
        </div>
        <div class="hr1" style="margin-bottom:40px;margin-top: 40px;"></div>
        <div class="row" data-animation="fadeInDown" data-animation-delay="01">
            <div class="col-sm-6">
                {{ Html::image('images/modul/youthcu.jpg','youthcu', array(
                    'class' => 'img-responsive img-thumbnail shadow','width' => '700px')) }}
            </div> 
            <div class="col-sm-6">
                <h2>Youth Credit Union Training</h2>
                <hr/>
                <p style="font-size: medium;">
                    <i class="fa fa-user"></i> Herculanus Cale • Basuki Ruswanta
                    <br/><br/>
                    Peran kaum muda yang sehat, enerjik, cerdas dan kreatif sangat diperlukan dalam kehidupan keluarga, masyarakat, lingkungan dan juga dalam pengembangan gerakan credit union (CU). Namun nyatanya dalam kehidupan sehari-hari, tak dipungkiri banyak kekhawatiran yang timbul, terutama akibat perilaku hidup dan pergaulan yang salah dan akhirnya menjerumuskan kaum muda dalam kehidupan yang kurang bermutu seperti narkoba, pergaulan yang tidak sehat, penggunaan teknologi yang keliru, miras dan lain sebagainya.
                    <br/><br/>
                     Isu-isu tersebut tidak hanyam enjadi perhatian sosial pemerintah, tetapi juga menjadi perhatian dalam gerakan CU Internasional. 
                     <br/><br/>
                     Puskopdit BKCU Kalimantan sangat mendukung gerakan perkoperasian Indonesia dan turut serta dalam peningkatan kapasitas peran kaum muda; mendalami peran, mempersiapkan fisik dan mental kaum muda yang enerjik, kompeten dan kreatif, mampu berkarya dalam CU dan masyarakat, sehingga mampu mendukung gerakan CU dalam jaringan Puskopdit BKCU Kalimantan khususnya.
                     <br/><br/>
                     Untuk itu Puskopdit BKCU Kalimantan menyiapkan paket training khusus untuk para aktivis CU yang bertujuan mengajak aktivis CU menjadi leader bagi dirinya sendiri dan lingkungan sekitarnya, sehingga kelak mampu menjadi fasilitato dan motivator dalam CU.
                     <br/><br/>
                     Materi dalam training adalah tentang jati diri anak muda, tahap-tahap kehidupan, membedakan keinginan dengan kebutuhan, manusia pembelajar dan pemanfaatan teknologi yang benar, merintis wirausaha, kesehatan reproduksi dalam siklus hidup, dampak penyalahgunaan narkoba bagi anak muda dan kerjasama tim.
                </p>
                <hr/>
                <div class="classic-testimonials">
                  <div class="testimonial-content">
                    <p style="font-size: medium;">
                        Apabila anda tertarik dengan modul ini, silahkan menghubungi: <br/>
                        <b>Thomas More Anwar - Staf Diklat :</b> +62 813 4500 5622
                    </p>
                  </div>
                </div>
            </div>           
        </div>
    </div>
</div>
@stop