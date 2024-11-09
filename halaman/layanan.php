
<?php
// Ambil kategori dari URL
$id_kategori_keluhan = isset($_GET['kategori']) ? $_GET['kategori'] : '';

?>
<div id="Layanan">   
</div>
<script>
        document.addEventListener('DOMContentLoaded', function() {
            if (window.location.hash) {
                const element = document.getElementById(window.location.hash.substring(1));
                if (element) {
                    scrollToElement(element);
                }
            }
        });

        function scrollToElement(element) {
            const navbarHeight = document.querySelector('.navbar').offsetHeight;
            const offset = 20; // Offset untuk margin
            const elementPosition = element.getBoundingClientRect().top + window.scrollY - navbarHeight - offset;

            window.scrollTo({
                top: elementPosition,
                behavior: 'smooth'
            });
        }
    </script>
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
          <div class="mt-auto"><a href="/rpl/kategori/1<?php echo isset($_SESSION['username']) ? '?user=' . urlencode($_SESSION['username']) : ''; ?>">
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
          <div class="mt-auto"><a href="/rpl/kategori/2<?php echo isset($_SESSION['username']) ? '?user=' . urlencode($_SESSION['username']) : ''; ?>">
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
          <div class="mt-auto"><a href="/rpl/kategori/3<?php echo isset($_SESSION['username']) ? '?user=' . urlencode($_SESSION['username']) : ''; ?>">
            <button type="submit" class="animated-button w-100">Laporkan</button>
          </a>
          </div>
        </div>
      </div>
    </div>
<!-- Layanan  --> 
<!-- <section class="services-section container">
<div class="services-title">
    <h1>Services</h1>
    <p>Menerima Semua Keluhan</p>
  </div>
  <div class="row"> -->
    <!-- Gambar -->
    <!-- <div class="col-md-6 image-kanan">
      <div id="carouselExampleIndicators1" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleIndicators1" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators1" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators1" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="src/img/rio.jpg" class="d-block w-100" alt="AC RUSAK">
            <div class="carousel-caption d-none d-md-block">
              <h5>AC RUSAK</h5>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad voluptatum cumque doloribus eligendi, sapiente magni iure quo ex est. Dignissimos?.</p>
            </div>
          </div>
          <div class="carousel-item">
            <img src="src/img/rio.jpg" class="d-block w-100" alt="Kursi">
            <div class="carousel-caption d-none d-md-block">
              <h5>Kursi</h5>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad voluptatum cumque doloribus eligendi, sapiente magni iure quo ex est. Dignissimos?.</p>
            </div>
          </div>
          <div class="carousel-item">
            <img src="src/img/rio.jpg" class="d-block w-100" alt="Meja">
            <div class="carousel-caption d-none d-md-block">
              <h5>Meja</h5>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad voluptatum cumque doloribus eligendi, sapiente magni iure quo ex est. Dignissimos?.</p>
            </div>
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators1" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators1" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div> -->
    <!-- text  -->
    <!-- <div class="col-md-6 text-side">
      <div class="text-content">
        <h2>Keluhan Fasilitas</h2>
        <p>Di bagian ini, mahasiswa dapat menyampaikan keluhan terkait kondisi fasilitas kampus, seperti ruang kelas, laboratorium, perpustakaan, fasilitas kelas seperti AC, dan area umum lainnya. Apakah ada fasilitas yang kurang memadai, tidak terawat, atau tidak berfungsi dengan baik? Kami ingin mendengar pengalaman Anda agar dapat meningkatkan kenyamanan dan aksesibilitas fasilitas yang ada.</p>
        <span class="navbar-text"><a href="laporan.html">
          <button type="submit" class="animated-button"> Laporkan </button>
        </a></span>
      </div>
    </div>
  </div>
</section> -->

<!-- <section class="services-section container">
  <div class="row" > -->
    <!-- Text -->
    <!-- <div class="col-md-6 text-side">
      <div class="text-content">
        <h2>Keluhan KBM</h2>
        <p>Kegiatan belajar mengajar adalah inti dari pengalaman akademis. Di sini, mahasiswa dapat memberikan masukan mengenai metode pengajaran, kurikulum, atau interaksi dengan dosen. Apakah Anda merasa kurang puas dengan materi yang diajarkan? Atau mungkin ada metode pengajaran yang perlu ditingkatkan? Umpan balik Anda sangat penting untuk menciptakan pengalaman belajar yang lebih baik dan efektif.</p>
        <span class="navbar-text"><a href="laporan.html">
          <button type="submit" class="animated-button"> Laporkan </button>
        </a></span>
      </div>
    </div> -->
    <!-- Gambar -->
    <!-- <div class="col-md-6 image-kanan">
      <div id="carouselExampleIndicators2" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleIndicators2" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators2" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators2" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="src/img/rio.jpg" class="d-block w-100" alt="KBM RUSAK">
            <div class="carousel-caption d-none d-md-block">
              <h5>KBM RUSAK</h5>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad voluptatum cumque doloribus eligendi, sapiente magni iure quo ex est. Dignissimos?.</p>
            </div>
          </div>
          <div class="carousel-item">
            <img src="src/img/rio.jpg" class="d-block w-100" alt="Meja KBM">
            <div class="carousel-caption d-none d-md-block">
              <h5>Meja KBM</h5>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad voluptatum cumque doloribus eligendi, sapiente magni iure quo ex est. Dignissimos?.</p>
            </div>
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators2" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators2" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>
  </div>
</section>

<section class="services-section container">
  <div class="row"> -->
    <!-- Gambar -->
    <!-- <div class="col-md-6 image-kanan">
      <div id="carouselExampleIndicators3" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleIndicators3" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators3" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators3" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="src/img/rio.jpg" class="d-block w-100" alt="AC RUSAK">
            <div class="carousel-caption d-none d-md-block">
              <h5>AC RUSAK</h5>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad voluptatum cumque doloribus eligendi, sapiente magni iure quo ex est. Dignissimos?.</p>
            </div>
          </div>
          <div class="carousel-item">
            <img src="src/img/rio.jpg" class="d-block w-100" alt="Kursi">
            <div class="carousel-caption d-none d-md-block">
              <h5>Kursi</h5>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad voluptatum cumque doloribus eligendi, sapiente magni iure quo ex est. Dignissimos?.</p>
            </div>
          </div>
          <div class="carousel-item">
            <img src="src/img/rio.jpg" class="d-block w-100" alt="Meja">
            <div class="carousel-caption d-none d-md-block">
              <h5>Meja</h5>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad voluptatum cumque doloribus eligendi, sapiente magni iure quo ex est. Dignissimos?.</p>
            </div>
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators3" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators3" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div> -->
    <!-- text  -->
    <!-- <div class="col-md-6 text-side">
      <div class="text-content">
        <h2>Keluhan Fasilitas</h2>
        <p>Di bagian ini, mahasiswa dapat menyampaikan keluhan terkait kondisi fasilitas kampus, seperti ruang kelas, laboratorium, perpustakaan, fasilitas kelas seperti AC, dan area umum lainnya. Apakah ada fasilitas yang kurang memadai, tidak terawat, atau tidak berfungsi dengan baik? Kami ingin mendengar pengalaman Anda agar dapat meningkatkan kenyamanan dan aksesibilitas fasilitas yang ada.</p>
        <span class="navbar-text"><a href="laporan.html">
          <button type="submit" class="animated-button"> Laporkan </button>
        </a></span>
      </div>
    </div>
  </div>
</section> -->

</body>