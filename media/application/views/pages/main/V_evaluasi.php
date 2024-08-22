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
      <!-- Section Koordinasi -->
      <div class="col-md-12">
        <section class="article">
          <hr />

          <div class="card">
            <div class="card-header">
              <div class="text-center">
                <h3>EVALUASI PEMBANGUNAN DAERAH</h3>
              </div>
            </div>
            <div class="card-body">
              <div class="text-justify" style="font-size: 16px">
                <p>Pelaksanaan pembangunan nasional yang baik ditentukan oleh peran dan strategi pembangunan yang dilakukan secara terpadu oleh Kementerian/Lembaga dan Pemerintah Daerah sesuai dengan kewenangannya.</p>
                <p>Besarnya skala dan cakupan pembangunan nasional membutuhkan sinergi, integrasi dan koordinasi antar pemangku kepentingan, terutama pemerintah pusat dan daerah dalam rangka mencapai sasaran pembangunan nasional. Adanya pendekatan perencanaan berbasis Tematik, Holistik, Integratif, dan Spasial (THIS) juga menguatkan prinsip bahwa kontribusi pembangunan daerah sangat penting dalam pencapaian sasaran pembangunan nasional.</p>
                <p>Dalam rangka mengevaluasi pelaksanaan dan pencapaian pembangunan nasional di daerah, Kementerian PPN/Bappenas yang dikoordinasikan oleh Kedeputian Bidang Pemantauan, Evaluasi dan Pengendalian Pembangunan melaksanakan kegiatan Evaluasi Pembangunan Daerah.</p>
                <p>Evaluasi Pembangunan Daerah (EPD) merupakan kegiatan evaluasi untuk menilai pencapaian sasaran pembangunan nasional di daerah serta menganalisis permasalahan dan faktor keberhasilan dalam proses pelaksanaan pembangunan sehingga menjadi <i>lesson learned</i> bagi perbaikan kebijakan pembangunan daerah pada tahap berikutnya.</p>
                <hr />
                <h4>Tujuan Pelaksanaan EPD</h4>
                <ol>
                  <li>Memperoleh informasi hasil pencapaian pembangunan nasional di daerah</li>
                  <li>Memperoleh rekomendasi berdasarkan hasil evaluasi pembangunan daerah untuk perencanaan pembangunan periode selanjutnya</li>
                </ol>
                <hr />
                <h4>Manfaat Pelaksanaan EPD</h4>
                <p>Kegiatan ini diharapkan dapat bermanfaat untuk memberikan rekomendasi bagi perencanaan pembangunan pusat dan daerah berdasarkan hasil evaluasi pembangunan daerah.</p>
                <hr />
                <h4>Hasil Evaluasi RKP</h4>
                <select id="pn" name="pn" class="selectpicker">
                  <option value="" disabled selected>Select an option</option>
                  <?php foreach($list_pn as $pn) :?>
                  <option value="<?= $pn['id_pn'] ?>">Prioritas Nasional <?= $pn['id_pn'] ?></option>
                  <?php endforeach ?>
                </select>
                <div id="container"></div>
                <hr />
                <h4>Download Laporan Evaluasi Pembangunan Daerah</h4>

                <div class="d-flex justify-content-between">

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