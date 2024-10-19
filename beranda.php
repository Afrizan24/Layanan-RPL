<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Ngeluh Mulu Pantek</title>
    <link rel="stylesheet" href="boostrap/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="src/shit.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body class="vh-100 ">
    <!-- navbar  -->
    <nav class="navbar navbar-expand-lg navbar-light customnav sticky-top">
        <div class="container">
          <a class="navbar-brand d-flex align-items-center " href="#">
            <img src="src/img/Polnes.png" alt="Logo"> 
            <div class="ms-2">
              <h4 class="navbar-title mb-0 text-bold">SUMA</h4>
              <p class="navbar-subtitle mb-0">Layanan Keluhan TI</p>
          </div>
          </a>
          
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
              <li class="nav-item">
                <a class="nav-link" href="beranda.php">Beranda</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="beranda.php?p=layanan">Layanan</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="beranda.php?p=laporan">Laporkan</a>
              </li>
            </ul>
            <?php
                       session_start();
                       if (isset($_SESSION['username'])) {
                           echo '<form action="proses_mhs/logout.php" method="POST">
                                   <input type="submit" class="animated-button" value="Logout">
                                 </form>';
                       } else {
                           echo '<span class="navbar-text"><a href="halaman/login.php">
              <button type="submit" class="animated-button"> Log-In </button>
            </a>';
                       }
                       ?>
            <!-- <span class="navbar-text"><a href="halaman/login.php">
              <button type="submit" class="animated-button"> Log-In </button>
            </a> -->
              <div class="social-icons">
                <a href="#"><i class="bi bi-facebook"></i></a>
                <a href="#"><i class="bi bi-messenger"></i></a>
                <a href="#"><i class="bi bi-linkedin"></i></a>
              </div>
            </span>
          </div>
        </div>
      </nav>

<!-- beranda hal depan  -->
<section class="complaint-form-section">
  <div data-aos="zoom-out-down"  class="container-custom-1">
    <div class="row align-items-center">
      <!-- Form -->
      <div class="col-lg-6 col-md-6">
        <h2 class="form-title">Layanan Keluhan TI SUMA</h2>
        <p class="form-title">Karena kami peduli dengan kalian</p>
        <p>
          Selamat Datang di Layanan Keluhan Kampus
          Kami memahami betapa pentingnya kenyamanan dan kualitas lingkungan akademis bagi seluruh mahasiswa. Oleh karena itu, kami menyediakan platform ini agar Anda dapat menyampaikan setiap keluhan terkait fasilitas kampus, kegiatan belajar mengajar, serta layanan dari dosen dan staf kampus. Pendapat dan saran Anda adalah kunci bagi kami untuk terus memperbaiki dan meningkatkan pengalaman belajar yang lebih baik di kampus ini.</p>
        <p></p>
          <button type="submit" class="animated-button">Ajukan Keluhan</button>
        </form>
      </div>
      <div class="col-lg-6 col-md-6 form-side-image">
        <img src="src/img/rio.jpg" alt="Side Image"> 
      </div>
    </div>
  </div>
</section>

<!-- tampilan service  -->

 <section class="services-section container">
  <div class="services-title">
    <h1>Layanan</h1>
    <p class="service-title">Setiap keluhan yang Anda laporkan akan kami tanggapi dengan serius, dan kami berkomitmen untuk memberikan solusi secepat mungkin. Bersama-sama, mari kita ciptakan lingkungan kampus yang nyaman, efisien, dan menyenangkan untuk belajar.</p>
</div>
    <div class="row">

    <!-- Card 1 -->
    <div class=" col-md-6 col-lg-4 mb-4">
      <div class="card h-100 d-flex flex-column">
        <div class="card-body d-flex flex-column">
          <h5 class="card-title">Keluhan Fasilitas</h5>
          <p class="card-text">Di bagian ini, mahasiswa dapat menyampaikan keluhan terkait kondisi fasilitas kampus, seperti ruang kelas, laboratorium, perpustakaan, fasilitas kelas seperti AC, dan area umum lainnya. Apakah ada fasilitas yang kurang memadai, tidak terawat, atau tidak berfungsi dengan baik? Kami ingin mendengar pengalaman Anda agar dapat meningkatkan kenyamanan dan aksesibilitas fasilitas yang ada.</p>
          <div class="mt-auto"><a href="laporan.html">
            <button type="submit" class="animated-button w-100">Laporkan</button>
          </a>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Card 2 -->
    <div class="col-md-6 col-lg-4 mb-4">
      <div class="card h-100 d-flex flex-column">
        <div class="card-body d-flex flex-column">
          <h5 class="card-title">Keluhan SDA</h5>
          <p class="card-text">Bagian ini memberikan kesempatan bagi mahasiswa untuk menyampaikan pendapat mengenai pelayanan dari dosen, staf administrasi, maupun petugas kebersihan. Apakah Anda mengalami kendala dalam berinteraksi dengan pihak kampus? Atau mungkin ada saran untuk meningkatkan kualitas layanan dari sumber daya manusia? Setiap masukan akan membantu kami memastikan bahwa semua pihak di kampus berkontribusi secara optimal terhadap pengalaman mahasiswa.</p>
          <div class="mt-auto"><a href="laporan.html">
            <button type="submit" class="animated-button w-100">Laporkan</button>
          </a>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Card 3 -->
    <div class="col-md-6 col-lg-4 mb-4">
      <div class="card h-100 d-flex flex-column">
        <div class="card-body d-flex flex-column">
          <h5 class="card-title">Keluhan KBM</h5>
          <p class="card-text">Kegiatan belajar mengajar adalah inti dari pengalaman akademis. Di sini, mahasiswa dapat memberikan masukan mengenai metode pengajaran, kurikulum, atau interaksi dengan dosen. Apakah Anda merasa kurang puas dengan materi yang diajarkan? Atau mungkin ada metode pengajaran yang perlu ditingkatkan? Umpan balik Anda sangat penting untuk menciptakan pengalaman belajar yang lebih baik dan efektif.</p>
          <div class="mt-auto"><a href="laporan.html">
            <button type="submit" class="animated-button w-100">Laporkan</button>
          </a>
          </div>
        </div>
      </div>
    </div>
    

  
</div>
</section>
  <div class="row">
  <!-- Content Dinamis -->
  <div class="col-sm-12">
      <?php
      $pages_dir = 'halaman';
      if (!empty($_GET['p'])) {
          $pages = scandir($pages_dir, 0);
          unset($pages[0], $pages[1]);
          $p = $_GET['p'];
          if (in_array($p.'.php', $pages)) {
              include($pages_dir.'/'.$p.'.php');
          } }
      ?>  
  </div> 
</div>


<!-- tentang  -->
<section class="services-section container">
  <section class="services-section container">
    <div class="services-title">
      <h1>Tentang Kami</h1>
      <p>
        Tentang Kami
        Selamat datang di SUMA, platform yang didedikasikan untuk mendengar dan merespons suara mahasiswa. Kami percaya bahwa setiap mahasiswa berhak memiliki pengalaman belajar yang optimal dan menyenangkan.
        
        Di [Nama Website], kami menyediakan ruang bagi mahasiswa untuk menyampaikan keluhan dan saran mengenai berbagai aspek kehidupan kampus, termasuk Fasilitas, Kegiatan Belajar Mengajar, danSumber Daya Manusia
        
        Kami berkomitmen untuk menjadi jembatan antara mahasiswa dan pihak kampus. Melalui umpan balik yang konstruktif, kami berharap dapat menciptakan lingkungan belajar yang lebih baik dan mendukung.
        
        Bergabunglah dengan kami untuk membuat suara Anda terdengar! Setiap keluhan dan saran Anda akan diperlakukan dengan serius dan ditindaklanjuti untuk perbaikan bersama.</p>
    </div>
</section>

<footer class="text-center py-3">
  <div class="container">
    <p>&copy; 2024 Ti Polnes. Hak Cipta Dilindungi.</p>
    <div class="social-icons">
      <a href="#" class="mx-2"><i class="bi bi-facebook"></i></a>
      <a href="#" class="mx-2"><i class="bi bi-twitter"></i></a>
      <a href="#" class="mx-2"><i class="bi bi-instagram"></i></a>
      <a href="#" class="mx-2"><i class="bi bi-linkedin"></i></a>
    </div>
  </div>
</footer>


</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="boostrap/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
  AOS.init();
</script>
</html>