<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Si Piko</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

 <!-- Favicons -->
<link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
<link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

<!-- Vendor CSS Files -->
<link href="{{ asset('assets/vendor/animate.css/animate.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

<!-- Template Main CSS File -->
<link href="{{ asset('assets/css/landing.css') }}" rel="stylesheet">



  <!-- =======================================================
  * Template Name: Selecao
  * Template URL: https://bootstrapmade.com/selecao-bootstrap-template/
  * Updated: Mar 17 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center  header-transparent ">
    <div class="container d-flex align-items-center justify-content-between">

      <div class="logo">
        <h1><a href="index.html">Si Piko</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
          <li><a class="nav-link scrollto" href="#about">Tentang Si Piko</a></li>
          <li><a class="nav-link scrollto" href="#services">Panduan </a></li>
          <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
          <li><a class="nav-link scrollto" href="{{ route('login') }}">Login</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex flex-column justify-content-end align-items-center">
    <div id="heroCarousel" data-bs-interval="5000" class="container carousel carousel-fade" data-bs-ride="carousel">

      <!-- Slide 1 -->
      <div class="carousel-item active">
        <div class="carousel-container">
          <h2 class="animate__animated animate__fadeInDown"><span>Sistem Pendukung Keputusan Pinjaman Pada Koperasi</span></h2>
          <p class="animate__animated fanimate__adeInUp">Sistem ini menggunakan metode perhitungan Topsis (Technique for Order of Preference by Similarity to Ideal Solution)</p>
          <a href="{{ route('login') }}" class="btn-get-started animate__animated animate__fadeInUp scrollto">Mulai</a>

        </div>
      </div>
     </div>

    <svg class="hero-waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28 " preserveAspectRatio="none">
      <defs>
        <path id="wave-path" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z">
      </defs>
      <g class="wave1">
        <use xlink:href="#wave-path" x="50" y="3" fill="rgba(255,255,255, .1)">
      </g>
      <g class="wave2">
        <use xlink:href="#wave-path" x="50" y="0" fill="rgba(255,255,255, .2)">
      </g>
      <g class="wave3">
        <use xlink:href="#wave-path" x="50" y="9" fill="#fff">
      </g>
    </svg>

  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container">

        <div class="section-title" data-aos="zoom-out">
          <h2>Tentang Kami</h2>
          <p>Apa Itu Si Piko?</p>
        </div>

        <div class="row content" data-aos="fade-up">
          <div class="col-lg-6">
            <p>
              Si Piko adalah sebuah platform pendukung keputusan pinjaman pada Koperasi yang 
              dirancang untuk membantu petugas koperasi dalam mengambil keputusan yang 
              tepat terkait pengajuan pinjaman oleh anggota. Dengan menggunakan metode Topsis,
              sistem ini dapat mengidentifikasi opsi terbaik berdasarkan beberapa kriteria yang telah ditetapkan.
            </p>
            <ul>
              <li><i class="ri-check-double-line"></i> Mempermudah dalam pengambilan Keputusan Kelayakan Pembaerian Pinjaman</li>
              <li><i class="ri-check-double-line"></i> Memberikan transparansi dalam proses penilaian dan pengambilan keputusan.</li>
            </ul>
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0">
            <p>
              Dengan sistem ini kami berharap dapat membantu mempercepat petugas dalam memproses pengajuan pinjaman,
            
            </p>
          </div>
        </div>

      </div>
    </section><!-- End About Section -->

    <!-- ======= Features Section ======= -->
    <section id="features" class="features">
      <div class="container">

        <ul class="nav nav-tabs row d-flex">
          <li class="nav-item col-3" data-aos="zoom-in">
              <a class="nav-link active show" data-bs-toggle="tab" href="#tab-1">
                  <i class="ri-user-line"></i>
                  <h4 class="d-none d-lg-block">Data Nasabah</h4>
              </a>
          </li>
          <li class="nav-item col-3" data-aos="zoom-in" data-aos-delay="200">
              <a class="nav-link" data-bs-toggle="tab" href="#tab-3">
                  <i class="ri-calculator-line"></i>
                  <h4 class="d-none d-lg-block">Penilaian</h4>
              </a>
          </li>
      </ul>
      
        <div class="tab-content" data-aos="fade-up">
          <div class="tab-pane active show" id="tab-1">
            <div class="row">
              <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0">

                <p class="fst-italic">
                  Anda dapat menambahkan,mengedit,menghapus data nasabah dan tersimpan dengan aman serta terorganisir, dengan ini dapat memudahkan petugas koperasi untuk meangkses data.
                </p>
                <ul>
                  <li><i class="ri-check-double-line"></i>Menambahkan Data</li>
                  <li><i class="ri-check-double-line"></i> Mengedit Data</li>
                  <li><i class="ri-check-double-line"></i> Menghapus Data</li>
                </ul>
              </div>
              <div class="col-lg-6 order-1 order-lg-2 text-center">
                <img src="assets/img/features-1.png" alt="" class="img-fluid">
              </div>
            </div>
          </div>
          <div class="tab-pane" id="tab-3">
            <div class="row">
              <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0">
                <p> Sistem pendukung keputusan ini dilengkapi dengan metode perhitungan Technique for Order of Preference by Similarity to Ideal Solution (TOPSIS)
                  yang akan membantu dalam proses penilaian dan pemilihan calon nasabah berdasarkan kriteria yang telah ditentukan
                </p>
                <ul>
                  <li><i class="ri-check-double-line"></i> Menambahkan,Mengedit,Menghapus Kriteria</li>
                  <li><i class="ri-check-double-line"></i> Menambahkan,Mengedit,Menghapus SubKriteria</li>
                  <li><i class="ri-check-double-line"></i> Menambahkan,Mengedit,Menghapus Penilaian</li>
                  <li><i class="ri-check-double-line"></i> Memproses perhitungan dengan metode TOPSIS</li>
                </ul>
              </div>
              <div class="col-lg-6 order-1 order-lg-2 text-center">
                <img src="assets/img/features-3.png" alt="" class="img-fluid">
              </div>
            </div>
          </div>
         </div>

      </div>
    </section><!-- End Features Section -->

    <!-- ======= Services Section ======= -->
<section id="services" class="services">
  <div class="container">

    <div class="section-title" data-aos="zoom-out">
      <h2>Panduan Penggunaan</h2>
      <p>Bagaimana Langkah-langkah penggunaannya?</p>
    </div>

    <div class="row">
      <div class="col-lg-4 col-md-6">
        <div class="icon-box" data-aos="zoom-in-left">
          <div class="icon"><i class="bi bi-person-plus" style="color: #ff689b;"></i></div>
          <h4 class="title"><a href="">Tambah Data Nasabah</a></h4>
          <p class="description">Login ke sistem dan tambahkan data nasabah sebagai alternatif yang akan dinilai. Data nasabah termasuk informasi seperti nama, jumlah pinjaman, dan profil keuangan.</p>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 mt-5 mt-md-0">
        <div class="icon-box" data-aos="zoom-in-left" data-aos-delay="100">
          <div class="icon"><i class="bi bi-file-earmark-text" style="color: #e9bf06;"></i></div>
          <h4 class="title"><a href="">Tentukan Kriteria dan Bobot</a></h4>
          <p class="description">Tambah kriteria yang akan digunakan dalam penilaian, seperti bunga, jangka waktu pinjaman, dan kapasitas pembayaran. Tentukan bobot untuk setiap kriteria berdasarkan kepentingannya.</p>
        </div>
      </div>

      <div class="col-lg-4 col-md-6 mt-5 mt-lg-0">
        <div class="icon-box" data-aos="zoom-in-left" data-aos-delay="200">
          <div class="icon"><i class="bi bi-list-task" style="color: #3fcdc7;"></i></div>
          <h4 class="title"><a href="">Tambah Subkriteria</a></h4>
          <p class="description">Tambahkan subkriteria untuk setiap kriteria jika diperlukan. Subkriteria membantu dalam memberikan penilaian yang lebih mendetail dan terperinci untuk setiap alternatif.</p>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 mt-5">
        <div class="icon-box" data-aos="zoom-in-left" data-aos-delay="300">
          <div class="icon"><i class="bi bi-check-square" style="color:#41cf2e;"></i></div>
          <h4 class="title"><a href="">Lakukan Penilaian</a></h4>
          <p class="description">Penilaian dilakukan dengan memilih alternatif dan memasukkan nilai untuk setiap kriteria berdasarkan data yang tersedia. Sistem akan mengumpulkan dan menyimpan data penilaian.</p>
        </div>
      </div>

      <div class="col-lg-4 col-md-6 mt-5">
        <div class="icon-box" data-aos="zoom-in-left" data-aos-delay="400">
          <div class="icon"><i class="bi bi-bar-chart-line" style="color: #d6ff22;"></i></div>
          <h4 class="title"><a href="">Proses Perhitungan TOPSIS</a></h4>
          <p class="description">Sistem akan melakukan perhitungan otomatis menggunakan metode TOPSIS. Ini meliputi normalisasi data, pembobotan kriteria, dan penilaian akhir untuk menentukan alternatif terbaik.</p>
        </div>
      </div>
    </div>

  </div>
</section><!-- End Services Section -->




    <!-- ======= F.A.Q Section ======= -->
    <section id="faq" class="faq">
      <div class="container">

        <div class="section-title" data-aos="zoom-out">
          <p>Pertanyaan Tentang Si Piko</p>
        </div>

        <ul class="faq-list">

          <li>
            <div data-bs-toggle="collapse" class="collapsed question" href="#faq1">Apa sih Si Piko itu? <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
            <div id="faq1" class="collapse" data-bs-parent=".faq-list">
              <p>
                Si Piko adalah sebuah platform pendukung keputusan pinjaman pada Koperasi yang dirancang untuk membantu petugas koperasi dalam mengambil keputusan yang tepat terkait pengajuan pinjaman oleh anggota. 
              </p>
            </div>
          </li>

          <li>
            <div data-bs-toggle="collapse" href="#faq2" class="collapsed question"> Apa itu Topsis?<i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
            <div id="faq2" class="collapse" data-bs-parent=".faq-list">
              <p>
                TOPSIS (Technique for Order of Preference by Similarity to Ideal Solution) adalah sebuah metode dalam pengambilan keputusan multikriteria yang digunakan untuk menentukan alternatif terbaik dari berbagai opsi berdasarkan beberapa kriteria. Metode ini mengukur seberapa dekat setiap alternatif dengan solusi ideal dan seberapa jauh dari solusi buruk.
              </p>
            </div>
          </li>

          <li>
            <div data-bs-toggle="collapse" href="#faq3" class="collapsed question">Apa saja fitur di Si Piko ini?<i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
            <div id="faq3" class="collapse" data-bs-parent=".faq-list">
              <p>
               Si Piko memliki fitur manajemen data nasabah dan perhitungan pendukung keputusan menggunakan metode TOPSIS untuk memudahkan petugas koperasi dalam memberikan kelayakan pinjaman pada calon nasabah baru.
              </p>
            </div>
          </li>
        </ul>

      </div>
    </section><!-- End F.A.Q Section -->

   

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container">

        <div class="section-title" data-aos="zoom-out">
          <h2>Kontak</h2>
          <p>Kontak Si Piko</p>
        </div>

        <div class="row mt-5">

          <div class="col-lg-4" data-aos="fade-right">
            <div class="info">
              <div class="email">
                <i class="bi bi-envelope"></i>
                <h4>Email:</h4>
                <p>sipiko@gmail.com</p>
              </div>

              <div class="phone">
                <i class="bi bi-phone"></i>
                <h4>Telepon:</h4>
                <p>+62 8583 2626 851</p>
              </div>

            </div>

          </div>

          <div class="col-lg-8 mt-5 mt-lg-0" data-aos="fade-left">

            <form action="forms/contact.php" method="post" role="form" class="php-email-form">
              <div class="row">
                <div class="col-md-6 form-group">
                  <input type="text" name="name" class="form-control" id="name" placeholder="Nama Anda" required>
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Email Anda" required>
                </div>
              </div>
              <div class="form-group mt-3">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subjek" required>
              </div>
              <div class="form-group mt-3">
                <textarea class="form-control" name="message" rows="5" placeholder="Pesan" required></textarea>
              </div>
              <div class="my-3">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Your message has been sent. Thank you!</div>
              </div>
              <div class="text-center"><button type="submit">Kirim</button></div>
            </form>

          </div>

        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="container">
      <h3>Si Piko</h3>
      <p>Sistem Pendukung Keputusan dengan Metode Topsis</p>
      <div class="copyright">
        &copy; Copyright <strong><span>Si Piko</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/selecao-bootstrap-template/ -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>