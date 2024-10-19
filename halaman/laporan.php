<div class="services-title">
    <h1>Form Laporan</h1>
</div>

<!-- Laporan -->
<section class="complaint-form-section">
    <div class="container-custom">
        <div class="row align-items-center">
            <!-- Form -->  
            <div class="col-lg-6 col-md-6">
                <h2 class="form-title">Formulir Keluhan</h2>
                <form action="process_keluhan.php" method="POST">
                    <div class="mb-3">
                        <label for="complaint" class="form-label">Pilih Keluhan</label>
                        <select class="form-select" id="complaint" name="id_kategori_keluhan" required>
                            <option selected disabled>Pilih Keluhan</option>
                            <option value="1">Keluhan 1</option>
                            <option value="2">Keluhan 2</option>
                            <option value="3">Keluhan 3</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="location" class="form-label">Lokasi (Optional)</label>
                        <input type="text" class="form-control" id="location" name="lokasi" placeholder="Lokasi">
                    </div>

                    <div class="mb-3">
                        <label for="date" class="form-label">Tanggal</label>
                        <div class="d-flex">
                            <select class="form-select me-2" id="month" name="month" required>
                                <option selected disabled>Month</option>
                                <option value="1">January</option>
                                <option value="2">February</option>
                                <!-- Add other months -->
                            </select>
                            <select class="form-select me-2" id="day" name="day" required>
                                <option selected disabled>Day</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <!-- Add other days -->
                            </select>
                            <select class="form-select" id="year" name="year" required>
                                <option selected disabled>Year</option>
                                <option value="2024">2024</option>
                                <option value="2023">2023</option>
                                <!-- Add other years -->
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi *</label>
                        <textarea class="form-control" id="description" name="deskripsi" rows="4" required></textarea>
                    </div>

                    <button type="submit" class="animated-button">Send</button>
                </form>
            </div>

            <div class="col-lg-6 col-md-6 form-side-image">
                <img src="/src/img/WIN_20240622_12_17_35_Pro.jpg" alt="Side Image"> 
            </div>
        </div>
    </div>
</section>
