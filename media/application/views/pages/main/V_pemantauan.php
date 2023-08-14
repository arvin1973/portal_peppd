<!-- author  : Muhamad Munawir Amin
Email        : muhamadmunawiramin@gmail.com
Last Update  : 03 July 2021 -->

<div class="container-fluid" style="width: 90%; margin-top: 5rem">

  <!-- <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent">
          <li class="breadcrumb-item active" aria-current="page">Penghargaan</li>
        </ol>
      </nav> -->

  <div class="row d-flex justify-content-center">
    <div class="col-lg-9">
      <!-- Section Pemantauan -->
      <div class="col-md-12">
        <section class="article">
          <hr />

          <div class="card">
            <div class="card-header">
              <div class="text-center">
                <h3>Pemantauan Pembangunan Daerah</h3>
              </div>
            </div>
            <div class="card-body">
              <div class="text-justify" style="font-size: 16px">
                Dalam kerangka pembangunan nasional, peranan pemantauan pembangunan daerah menjadi penting dan strategis. Pelaksanaan pemantauan rencana pembangunan dilakukan dalam rangka mengendalikan pelaksanaan rencana pembangunan agar target yang ditetapkan dapat tercapai. Kegiatan pemantauan pembangunan juga ditujukan untuk mengidentifikasi kendala dan hambatan serta memberikan rekomendasi solusi dalam mengatasi dan mengantisipasi kendala yang akan muncul.
                <br />
                <br />
                Direktorat Pemantauan, Evaluasi, dan Pengendalian Daerah (PEPPD) melaksanakan kegiatan Pemantauan Pembangunan Daerah dengan fokus pada tiga hal yaitu: 1) Pemantauan keterkaitan rencana pembangunan nasional dengan rencana pembangunan daerah; 2) Pemantauan pembangunan kewilayahan; dan 3) Sistem digital <i>monitoring</i>, evaluasi, dan <i>database</i>.
                <hr />
                <h4>Tujuan kegiatan Pemantauan Pembangunan Daerah, yaitu:</h4>
                <ol>
                  <li>Memantau keterkaitan rencana pembangunan nasional dengan rencana pembangunan daerah di 34 provinsi;</li>
                  <li>Memantau pembangunan kewilayahan;</li>
                  <li>Memantau capaian pembangunan di 34 provinsi menggunakan indikator target pembangunan wilayah pada RPJMN 2020 – 2024.</li>
                </ol>
                <hr />
                <div class="d-flex justify-content-between">
                  <img src="<?= base_url() ?>/assets/images/img/pemantauan/cover_pemantauan_sistem.png" style="width: 30%;" alt="Sistem" class="img-thumbnail">
                  <img src="<?= base_url() ?>/assets/images/img/pemantauan/cover_pemantauan_pembangunan_kewilayahan.png" style="width: 30%;" alt="Sistem" class="img-thumbnail">
                  <img src="<?= base_url() ?>/assets/images/img/pemantauan/cover_pemantauan_keterkaitan_perencanaan_pusat_dan_daerah.png" style="width: 30%;" alt="Sistem" class="img-thumbnail">
                </div>
              </div>
            </div>
          </div>

        </section>
      </div>
      <!-- End Section Pemantauan -->
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    $("#publication_search").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      // $(".publication-list-row").filter(function() {
      $(".publication-list-content-card").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  });
</script>