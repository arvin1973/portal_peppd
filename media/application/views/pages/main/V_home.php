<div class="dekstop">
  <div class="container-fluid" style="width: 90%; margin-top: 8rem">
    <div class="row">
      <div class="col-lg-8">
        <!-- Section Carousel-->
        <div class="col-md-12 order-1">
          <section class="carousel">
            <div id="carouselExampleIndicators" class="carousel slide img-thumbnail" data-ride="carousel" style="border-radius: 0">
              <ol class="carousel-indicators" style="justify-content: left; margin-left: 5%;">
                <?php for ($i = 0; $i < count($carousel_content); $i++) { ?>
                  <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $i; ?>" class="<?php echo ($i == 0 ? 'active' : '') ?>"></li>
                <?php } ?>
              </ol>
              <div class="carousel-inner">
                <?php for ($i = 0; $i < count($carousel_content); $i++) { ?>
                  <div class="carousel-item <?php echo ($i == 0 ? 'active' : '') ?>">
                    <!-- <img
                      class="d-block w-100"
                      src="<?= base_url(); ?>assets/images/img/carousel/carousel_1_1min.png"
                      alt="First slide"
                  /> -->
                    <a class="btn-read-more-article" data-id="<?php echo $carousel_content[$i][0]->id ?>" href="<?= base_url(); ?>news/<?php echo $carousel_content[$i][0]->slug ?>" target="_blank" rel="noopener">
                      <img class="d-block w-100" style="height: 28vw;" src="<?= base_url(); ?>assets/images/summernote/<?php echo $carousel_content[$i][0]->title_picture ?>" alt="<?php echo $i ?> slide" />
                      <div class="carousel-caption d-none d-md-block" style="background-color: rgba(0, 0, 0, 0.7); right: 0!important; left: 0!important; bottom: 0!important; padding: 1% 5% 3% 5%; text-align: left;">
                        <p class="animate__animated animate__fadeInLeft"><strong><?php echo $carousel_content[$i][0]->title ?></strong></p>
                      </div>
                    </a>
                  </div>
                <?php } ?>
                <!-- <div class="carousel-item">
                    <a href="<?= base_url(); ?>karir" target="_blank" rel="noopener">
                      <img
                          class="d-block w-100"
                          style="height: 28vw;"
                          src="<?= base_url(); ?>assets/images/img/carousel/career.png"
                          alt="career slide"
                      />
                      <div class="carousel-caption d-none d-md-block" style="background-color: rgba(0, 0, 0, 0.7); right: 0!important; left: 0!important; bottom: 0!important; padding: 1% 5% 3% 5%; text-align: left;">
                          <p class="animate__animated animate__fadeInLeft"><strong>Buat sahabat pembangunan yang ingin bergabung menjadi bagian dari kami, yuk segera daftarkan diri kalian</strong></p>
                      </div>
                    </a>
                  </div> -->
              </div>
              <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>
          </section>
        </div>

        <!-- End Section Carousel -->

        <!-- infografis card -->
        <div class="col-md-12 order-4">
          <section class="card-infografis">
            <a href="<?= base_url('infograph'); ?>" target="_blank" style="color: black;">
              Infografis
              <i class="fa fa-angle-double-right" aria-hidden="true"></i>
            </a>
            <hr />
            <div class="owl-carousel owl-theme">
              <?php foreach ($indikator as $i): ?>
                <div class="item">
                  <div class="card card-infograph">
                    <div class="card-header">
                      <h6 class="card-title infograph-title-text"><b>
                          <?= $i[0]['nm_indikator'] ?>
                        </b></h6>
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-4">
                          <img class="w-100"
                            src="<?= base_url() ?>assets/images/img/icon_pemantauan/<?= str_replace(' ', '_', strtolower($i[0]['nm_indikator'])) ?>.jpg">
                        </div>
                        <div class="col-8">
                          <div class="infograph-body-text">
                            <p><b>
                                <?= $i[0]['tahun'] . '-' . $i[0]['periode'] ?>:
                              </b>
                              <?= $i[0]['nilai_satuan'] ?>
                              <!-- <?= number_format($i[0]['nilai'], 2) . ' ' . $i[0]['satuan'] ?> -->
                            </p>
                            <?php if ($i[0]['jenis'] == 'positif') { ?>
                              <?php if ($i[0]['nilai'] >= $i[1]['nilai']) { ?>
                                <h6><span class="badge badge-success mx-2"><i class="fa fa-arrow-up" aria-hidden="true"
                                      title="Naik <?= number_format(abs($i[0]['nilai'] - $i[1]['nilai']), 2) . ' ' . $i[0]['satuan'] ?>"></i></span>
                                </h6>
                              <?php } elseif ($i[0]['nilai'] < $i[1]['nilai']) { ?>
                                <h6><span class="badge badge-warning mx-2"><i class="fa fa-arrow-down" aria-hidden="true"
                                      title="Turun <?= number_format(abs($i[0]['nilai'] - $i[1]['nilai']), 2) . ' ' . $i[0]['satuan'] ?>"></i></span>
                                </h6>
                              <?php } ?>
                            <?php } elseif ($i[0]['jenis'] == 'negatif') { ?>
                              <?php if ($i[0]['nilai'] <= $i[1]['nilai']) { ?>
                                <h6><span class="badge badge-success mx-2"><i class="fa fa-arrow-down" aria-hidden="true"
                                      title="Turun <?= number_format(abs($i[0]['nilai'] - $i[1]['nilai']), 2) . ' ' . $i[0]['satuan'] ?>"></i></span>
                                </h6>
                              <?php } elseif ($i[0]['nilai'] > $i[1]['nilai']) { ?>
                                <h6><span class="badge badge-warning mx-2"><i class="fa fa-arrow-up" aria-hidden="true"
                                      title="Naik <?= number_format(abs($i[0]['nilai'] - $i[1]['nilai']), 2) . ' ' . $i[0]['satuan'] ?>"></i></span>
                                </h6>
                              <?php } ?>
                            <?php } ?>
                          </div>
                          <div class="infograph-body-text">
                            <p><b>
                                <?= $i[1]['tahun'] . '-' . $i[1]['periode'] ?>:
                              </b>
                              <?= $i[1]['nilai_satuan'] ?>
                              <!-- <?= number_format($i[1]['nilai'], 2) . ' ' . $i[1]['satuan'] ?> -->
                            </p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="card-footer">
                      <button type="button" class="button-detail-infograph" data-id="<?= $i[0]['id_indikator'] ?>"
                        onclick="openDetailPage('<?= str_replace(' ', '_', $i[0]['nm_indikator']) ?>', 'nasional')">
                        Detail <i class="fa fa-caret-right"></i>
                      </button>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          </section>
        </div>
        <!-- end infografis card -->

        <!-- Section News -->
        <div class="col-md-12 order-3">
          <section class="news">
            <a href="<?= base_url(); ?>news" style="color: black;">
              Berita
              <i class="fa fa-angle-double-right" aria-hidden="true"></i>
            </a>
            <hr />
            <?php foreach ($articles as $article) { ?>
              <!-- <div class="card mb-3">
                <div class="row no-gutters">
                  <div class="col-md-5">
                    <img
                      class="w-100 img-news"
                      src="<?= base_url(); ?>assets/images/summernote/<?php echo $article->title_picture ?>"
                      alt="<?php echo $article->title ?>"
                    />
                  </div>
                  <div class="col-md-7">
                    <div class="card-body">
                      <p class="card-text">
                        <small class="text-muted"
                          ><?php echo $article->created_at ?></small
                        >
                        <span class="badge badge-secondary float-right"
                          ><?php echo $article->name ?></span
                        >
                      </p>
                      <h5 class="card-title title-news">
                        <b
                          ><?php echo $article->title ?></b
                        >
                      </h5>
                      <p class="card-text text-news">
                        <?php echo (strlen($article->description) > 130) ? substr($article->description, 0, 126) . '...' : $article->description ?>
                        <i><a class="btn-read-more-article" data-id="<?php $article->id ?>" target="_blank" rel="noopener" href="<?= base_url(); ?>news/<?php echo $article->slug ?>" title="<?php echo $article->title ?>">selengkapnya</a></i>
                      </p>
                    </div>
                  </div>
                </div>
              </div> -->
            <?php } ?>
            <div class="list_article"></div>
            <div align="right" class="pagination_link"></div>
          </section>
        </div>
        <!-- End Section News -->

        <!-- Section Publication -->
        <div class="col-md-12 order-5">
          <section class="publication">
            <a href="<?= base_url(); ?>publication" style="color: black;">
              Publikasi
              <i class="fa fa-angle-double-right" aria-hidden="true"></i>
            </a>
            <hr />
            <!-- <?php var_dump($list_publications) ?>
              <br>
              <br>
              <?php var_dump($list_pub) ?>
              <br> -->
            <div class="row publication-scroll" style="overflow-x: auto; flex-wrap: nowrap;">
              <?php for ($i = 0; $i < count($list_pub); $i++) { ?>
                <?php foreach ($list_pub[$i] as $list) { ?>
                  <div class="my-2 mx-2">

                    <!-- <div class="img-publication-box" title="<?php echo $list->name ?>">
                    <img
                      src="<?= base_url(); ?>assets/file_publication/<?php echo str_replace(" ", "-", $list->name); ?>/<?php echo $list->title_picture ?>"
                      class="img-thumbnail img-publication"
                      alt="<?php echo $list->name ?>"
                    />
                    <a href="<?= base_url(); ?>assets/file_publication/<?php echo str_replace(" ", "-", $list->name); ?>/<?php echo $list->file ?>" target="_blank" rel="noopener" class="d-flex justify-content-center">
                    <a href="<?= base_url(); ?>file_publication/<?php echo str_replace(" ", "-", $list->name); ?>/<?php echo $list->file; ?>" target="_blank" rel="noopener" class="d-flex justify-content-center">
                      <img
                        src="<?= base_url(); ?>assets/images/img/see_more.png"
                        alt="Download <?php echo $list->name ?>"
                        class="align-self-center"
                        height="70"
                        width="70"
                      />
                    </a>
                  </div> -->

                    <div class="card img-publication-box" style="max-width:fit-content;" title="<?php echo $list->name ?>">
                      <span class="badge badge-info" style="position: absolute; margin: 10px; right: 0;">Page Hint:
                        <?php echo $list->sum_of_log ?>
                      </span>
                      <img class="card-img-top img-publication p-1"
                        src="<?= base_url(); ?>assets/file_publication/<?php echo str_replace(" ", "-", $list->name); ?>/<?php echo $list->title_picture ?>"
                        alt="<?php echo $list->name ?>">
                      <div class="card-body p-2">
                        <p class="card-text">
                          <?php echo (strlen($list->name) > 26) ? substr($list->name, 0, 23) . '...' : $list->name ?>
                        </p>

                      </div>
                      <!-- <a href="<?= base_url(); ?>assets/file_publication/<?php echo str_replace(" ", "-", $list->name); ?>/<?php echo $list->file ?>" target="_blank" rel="noopener" class="d-flex justify-content-center"> -->
                      <!-- <a href="<?= base_url(); ?>file_publication/<?php echo str_replace(" ", "-", $list->name); ?>/<?php echo $list->file; ?>" target="_blank" rel="noopener" class="d-flex justify-content-center"> -->
                      <!-- <a href="https://online.flippingbook.com/view/617112841/" target="_blank" rel="noopener" class="d-flex justify-content-center"> -->
                      <?php if ($list->name == 'Knowledge Sharing Pembangunan Daerah 2018') { ?>
                        <script
                          src="//static.fliphtml5.com/web/js/plugin/LightBox/js/fliphtml5-light-box-api-min.js"></script>
                        <a class="d-flex justify-content-center btn-read-publication" data-id="<?php echo $list->id ?>"
                          data-rel="fh5-light-box-demo" data-href="https://online.fliphtml5.com/dmeid/ghjy/" data-width="900"
                          data-height="500" data-title="Knowledge Sharing Pembangunan Daerah 2018">
                        <?php } else if ($list->name == 'Prosiding Knowledge Sharing 2018') { ?>
                            <script
                              src="//static.fliphtml5.com/web/js/plugin/LightBox/js/fliphtml5-light-box-api-min.js"></script>
                            <a class="d-flex justify-content-center btn-read-publication" data-id="<?php echo $list->id ?>"
                              data-rel="fh5-light-box-demo" data-href="https://online.fliphtml5.com/dmeid/qrsg/"
                              data-width="900" data-height="500" data-title="Prosiding Knowledge Sharing 2018">
                          <?php } else if ($list->name == 'Prosiding Knowledge Sharing 2019') { ?>
                                <script
                                  src="//static.fliphtml5.com/web/js/plugin/LightBox/js/fliphtml5-light-box-api-min.js"></script>
                                <a class="d-flex justify-content-center btn-read-publication" data-id="<?php echo $list->id ?>"
                                  data-rel="fh5-light-box-demo" data-href="https://online.fliphtml5.com/dmeid/ksbx/"
                                  data-width="900" data-height="500" data-title="Prosiding Knowledge Sharing 2019">
                            <?php } else if ($list->name == 'Knowledge Sharing Pembangunan Daerah 2019 - 2020') { ?>
                                    <script
                                      src="//static.fliphtml5.com/web/js/plugin/LightBox/js/fliphtml5-light-box-api-min.js"></script>
                                    <a class="d-flex justify-content-center btn-read-publication" data-id="<?php echo $list->id ?>"
                                      data-rel="fh5-light-box-demo" data-href="https://online.fliphtml5.com/dmeid/kvbv/"
                                      data-width="900" data-height="500"
                                      data-title="Knowledge Sharing Pembangunan Daerah 2019 - 2020">
                              <?php } else { ?>
                                      <a href="<?= base_url(); ?>file_publication/<?php echo str_replace(" ", "-", $list->name); ?>/<?php echo $list->file; ?>"
                                        data-id="<?php echo $list->id ?>" target="_blank" rel="noopener"
                                        class="d-flex justify-content-center btn-read-publication">
                                <?php } ?>
                                <!-- <img
                              src="<?= base_url(); ?>assets/images/img/see_more.png"
                              alt="Download <?php echo $list->name ?>"
                              class="align-self-center"
                              height="70"
                              width="70"
                          /> -->
                                <script src="https://cdn.lordicon.com/libs/mssddfmo/lord-icon-2.1.0.js"></script>
                                <lord-icon src="https://cdn.lordicon.com/nocovwne.json" trigger="morph"
                                  colors="primary:#000000,secondary:#000000" style="width:250px;height:250px">
                                </lord-icon>
                              </a>
                              <!-- <script async defer src="https://online.flippingbook.com/EmbedScriptUrl.aspx?m=redir&hid=617112841"></script> -->
                    </div>
                    <a type="button" style="display: flex; justify-content: center; align-self: center;"
                      href="<?= base_url(); ?>assets/file_publication/<?php echo str_replace(" ", "-", $list->name); ?>/<?php echo $list->file; ?>"
                      class="btn-download-publication" data-id="<?php echo $list->id ?>"
                      download="<?php echo $list->file; ?>">
                      <!-- <i class="fa fa-arrow-circle-down" style="align-self: center; margin-right: 5px"></i>  -->
                      Unduh
                      <span class="badge badge-light page-hint-unduh-publikasi"
                        style="font-size: 0.6rem; padding: 0.10em; align-self: center; margin-left: 4px;">
                        <?php echo $list->sum_of_download ?>
                      </span>
                    </a>
                  </div>
                <?php } ?>
              <?php } ?>
            </div>
          </section>
        </div>
        <!-- End Section Publication -->

      </div>
      <div class="col-lg-4">

        <!-- Section Activity -->
        <div class="col-md-12 order-2">
          <section class="activity">
            Kegiatan
            <hr />
            <div class="row">
              <div class="col-12 col-md-6 col-lg-12 my-1 rounded-3">
                <a href="<?= base_url(); ?>kegiatan/penghargaan" style="text-decoration: none;">
                  <div class="card card-activity">
                    <div class="row">
                      <div class="col-4 box-icon-activity">
                        <img class="img-fluid mb-3 w-100"
                          src="<?= base_url(); ?>assets/images/img/logo-kegiatan/ppd-min.png" alt="card image" />
                      </div>
                      <div class="col-8 box-text-activity">
                        <div class="col">
                          <p class="card-text text-center text-activity">
                            PENGHARGAAN PEMBANGUNAN DAERAH
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
                </a>
              </div>
              <div class="col-12 col-md-6 col-lg-12 my-1 rounded-3">
                <a href="<?= base_url(); ?>kegiatan/penghargaan" style="text-decoration: none;">
                  <div class="card card-activity">
                    <div class="row">
                      <div class="col-4 box-icon-activity">
                        <img class="img-fluid mb-3 w-100"
                          src="<?= base_url(); ?>assets/images/img/logo-kegiatan/epd-min.png" alt="card image" />
                      </div>
                      <div class="col-8 box-text-activity">
                        <div class="box-img-activity col">
                          <p class="card-text text-center text-activity">
                            EVALUASI PEMBANGUNAN DAERAH
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
                </a>
              </div>
              <div class="col-12 col-md-6 col-lg-12 my-1 rounded-3">
                <a href="<?= base_url(); ?>kegiatan/penghargaan" style="text-decoration: none;">
                  <div class="card card-activity">
                    <div class="row">
                      <div class="col-4 box-icon-activity">
                        <img class="img-fluid mb-3 w-100"
                          src="<?= base_url(); ?>assets/images/img/logo-kegiatan/koordinasi_pembangunan-min.png"
                          alt="card image" />
                      </div>
                      <div class="col-8 box-text-activity">
                        <div class="box-img-activity col">
                          <p class="card-text text-center text-activity">
                            KOORDINASI PEMBANGUNAN
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
                </a>
              </div>
              <!-- <div class="col-12 col-md-6 col-lg-12 my-2 rounded-3">
                <a href="<?= base_url(); ?>kegiatan/koordinasi" style="text-decoration: none;">
                  <div class="card card-activity">
                    <div class="card-body" style="padding: 1rem;">
                      <div class="box-img-activity col d-flex">
                        <img class="img-fluid mb-3 w-25" src="<?= base_url(); ?>assets/images/img/logo-kegiatan/koordinasi_pembangunan-min.png" alt="card image" />
                      </div>
                      <p class="card-text text-center text-activity">
                        KOORDINASI PEMBANGUNAN
                      </p>
                    </div>
                  </div>
                </a>
              </div> -->
            </div>
          </section>
        </div>
        <!-- End Section Activity -->

        <!-- Section Application -->
        <div class="col-md-12 order-4">
          <section class="application">
            Aplikasi
            <hr />
            <div class="card card-application my-3">
              <div class="img-application">
                <img src="<?= base_url(); ?>assets/images/img/penilaian_ppd.png" class="card-img-top"
                  alt="Aplikasi Penilaian PPD" />
                <div class="card-body">
                  <p class="card-text text-center">LOGIN SISTEM PENILAIAN PPD</p>
                </div>
                <a href="https://peppd.bappenas.go.id/jumper_ppd/" target="_blank" rel="noopener"
                  class="d-flex justify-content-center">
                  <!-- <img
                      class="align-self-center"
                      src="<?= base_url(); ?>assets/images/img/External_link_font_awesome.png"
                      alt="Login Sistem Penilaian PPD"
                      height="100"
                      width="100"
                    /> -->
                  <script src="https://cdn.lordicon.com/libs/mssddfmo/lord-icon-2.1.0.js"></script>
                  <lord-icon src="https://cdn.lordicon.com/udwhdpod.json" trigger="morph"
                    colors="primary:#121331,secondary:#08a88a" style="width:180px;height:180px">
                  </lord-icon>
                </a>
              </div>
            </div>
            <div class="card card-application my-3">
              <div class="img-application">
                <img src="<?= base_url(); ?>assets/images/img/aplikasi_pemantauan.png" class="card-img-top"
                  alt="Aplikasi Pemantauan" />
                <div class="card-body">
                  <p class="card-text text-center">LOGIN SISTEM PEMANTAUAN</p>
                </div>
                <a href="https://peppd.bappenas.go.id/pemantauan/" target="_blank" rel="noopener"
                  class="d-flex justify-content-center">
                  <!-- <img
                      class="align-self-center"
                      src="<?= base_url(); ?>assets/images/img/External_link_font_awesome.png"
                      alt="Login Sistem Pemantauan"
                      height="100"
                      width="100"
                    /> -->
                  <script src="https://cdn.lordicon.com/libs/mssddfmo/lord-icon-2.1.0.js"></script>
                  <lord-icon src="https://cdn.lordicon.com/udwhdpod.json" trigger="morph"
                    colors="primary:#121331,secondary:#08a88a" style="width:180px;height:180px">
                  </lord-icon>
                </a>
              </div>
            </div>
          </section>
        </div>
        <!-- End Section Application -->

        <!-- Section Contact Us -->
        <div class="col-md-12 order-6">
          <section class="contact-us">
            Hubungi Kami
            <hr />
            <div class="card my-3">
              <a href="https://docs.google.com/forms/d/e/1FAIpQLSfcACkyqgiSTD7QrSYHBXxg47xwenTZfi7ofACM598Kjg8Jzw/viewform?usp=pp_url"
                target="_blank" rel="noopener">
                <img src="<?= base_url(); ?>assets/images/img/Contact-Centre-02.png" class="card-img-top"
                  alt="Aplikasi Penilaian PPD" />
                <div class="card-body">
                  <p class="card-text text-center">HUBUNGI KAMI</p>
                </div>
              </a>
            </div>
          </section>
        </div>
        <!-- End Section Contact Us -->

        <!-- Section career -->
        <!-- <div class="col-md-12 order-7">
            <section class="career">
              Karir
              <hr />
              <div class="row" style="display: flex; justify-content: center;">
                <div class="card" style="width: 22vw;">
                  <a href="<?= base_url(); ?>karir" target="_blank" rel="noopener">
                    <img
                      src="<?= base_url(); ?>assets/images/img/carousel/career1.png"
                      class="card-img-top"
                      alt="Rekrutmen Tenagan Pendukung Analis Ekonomi"
                    />
                  </a>
                  <div class="card-body m-0 p-3">
                    <hr>
                    <a type="button" href="<?= base_url(); ?>assets/images/img/carousel/career1.png" class="btn-download-publication m-0" download="Lowongan_Kerja_Tenagan_Pendukung_Analis_Ekonomi_Bappenas.png"><i class="fa fa-arrow-circle-down"></i> Unduh Brosur</a>
                  </div>
                </div>
              </div>
            </section>
          </div> -->
        <!-- End Section Career -->

      </div>
    </div>
  </div>
</div>

<div class="mobile">
  <div class="container-fluid" style="width: 90%; margin-top: 7rem">
    <div class="row">
      <!-- Section Carousel-->
      <div class="col-md-12 order-1">
        <section class="carousel">
          <div id="carouselExampleIndicators" class="carousel slide img-thumbnail" data-ride="carousel"
            style="border-radius: 0">
            <ol class="carousel-indicators" style="justify-content: left; margin-left: 5%;">
              <?php for ($i = 0; $i < count($carousel_content); $i++) { ?>
                <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $i; ?>"
                  class="<?php echo ($i == 0 ? 'active' : '') ?>"></li>
              <?php } ?>
            </ol>
            <div class="carousel-inner">
              <?php for ($i = 0; $i < count($carousel_content); $i++) { ?>
                <div class="carousel-item <?php echo ($i == 0 ? 'active' : '') ?>">
                  <!-- <img
                      class="d-block w-100"
                      src="<?= base_url(); ?>assets/images/img/carousel/carousel_1_1min.png"
                      alt="First slide"
                    /> -->
                  <a class="btn-read-more-article" data-id="<?php echo $carousel_content[$i][0]->id ?>"
                    href="<?= base_url(); ?>news/<?php echo $carousel_content[$i][0]->slug ?>" target="_blank"
                    rel="noopener">
                    <img class="d-block w-100" style="height: 45vw;"
                      src="<?= base_url(); ?>assets/images/summernote/<?php echo $carousel_content[$i][0]->title_picture ?>"
                      alt="<?php echo $i ?> slide" />
                    <div class="carousel-caption d-none d-md-block"
                      style="background-color: rgba(0, 0, 0, 0.7); right: 0!important; left: 0!important; bottom: 0!important; padding: 1% 5% 3% 5%; text-align: left;">
                      <!-- <h5><mark><?php echo $carousel_content[$i][0]->title ?></mark></h5> -->
                      <p class="animate__animated animate__fadeInLeft"><strong>
                          <?php echo $carousel_content[$i][0]->title ?>
                        </strong></p>
                    </div>
                  </a>
                </div>
              <?php } ?>
              <!-- <div class="carousel-item">
                    <a href="<?= base_url(); ?>karir" target="_blank" rel="noopener">
                    <img
                      class="d-block w-100"
                      style="height: 45vw;"
                      src="<?= base_url(); ?>assets/images/img/carousel/career.png"
                      alt="Career slide"
                    />
                    <div class="carousel-caption d-none d-md-block" style="background-color: rgba(0, 0, 0, 0.7); right: 0!important; left: 0!important; bottom: 0!important; padding: 1% 5% 3% 5%; text-align: left;">
                      <p class="animate__animated animate__fadeInLeft"><strong>Rekrutmen Tenaga Pendukung Analis Ekonomi</strong></p>
                    </div>
                    </a>
                  </div> -->
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
        </section>
      </div>
      <!-- End Section Carousel -->

      <!-- Section News -->
      <div class="col-md-12 order-4">
        <section class="news">
          <a href="<?= base_url(); ?>news" style="color: black;">
            Berita
            <i class="fa fa-angle-double-right" aria-hidden="true"></i>
          </a>
          <hr />
          <?php foreach ($articles as $article) { ?>
            <!-- <div class="card mb-3">
              <div class="row no-gutters">
                <div class="col-md-5">
                  <img
                    class="w-100 img-news"
                    src="<?= base_url(); ?>assets/images/summernote/<?php echo $article->title_picture ?>"
                    alt="<?php echo $article->title ?>"
                  />
                </div>
                <div class="col-md-7">
                  <div class="card-body">
                    <p class="card-text">
                      <small class="text-muted"
                        ><?php echo $article->created_at ?></small
                      >
                      <span class="badge badge-secondary float-right"
                        ><?php echo $article->name ?></span
                      >
                    </p>
                    <h5 class="card-title title-news">
                      <b
                        ><?php echo $article->title ?></b
                      >
                    </h5>
                    <p class="card-text text-news">
                      <?php echo (strlen($article->description) > 130) ? substr($article->description, 0, 126) . '...' : $article->description ?>
                      <i><a class="btn-read-more-article" data-id="<?php echo $article->id ?>" target="_blank" rel="noopener" href="<?= base_url(); ?>news/<?php echo $article->slug ?>" title="<?php echo $article->title ?>">selengkapnya</a></i>
                    </p>
                  </div>
                </div>
              </div>
            </div> -->
          <?php } ?>
          <div class="list_article"></div>
          <div align="right" class="pagination_link"></div>
        </section>
      </div>
      <!-- End Section News -->

      <div class="col-md-12 order-3">
        <section class="card-infografis">
          <a href="<?= base_url(); ?>infograph" target="_blank" style="color: black;">
            Infografis
            <i class="fa fa-angle-double-right" aria-hidden="true"></i>
          </a>
          <hr />
          <div class="owl-carousel owl-theme">
            <?php foreach ($indikator as $i): ?>
              <div class="item">
                <div class="card card-infograph">
                  <div class="card-header">
                    <p class="card-title infograph-title-text"><b>
                        <?= $i[0]['nm_indikator'] ?>
                      </b></p>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-12">
                        <div class="infograph-body-text">
                          <p><b>
                              <?= $i[0]['tahun'] . '-' . $i[0]['periode'] ?>:
                            </b>
                            <?= number_format($i[0]['nilai'], 2) . ' ' . $i[0]['satuan'] ?>
                          </p>
                          <?php if ($i[0]['jenis'] == 'positif') { ?>
                            <?php if ($i[0]['nilai'] >= $i[1]['nilai']) { ?>
                              <h6><span class="badge badge-success mx-2"><i class="fa fa-arrow-up" aria-hidden="true"
                                    title="Naik <?= number_format(abs($i[0]['nilai'] - $i[1]['nilai']), 2) . ' ' . $i[0]['satuan'] ?>"></i></span>
                              </h6>
                            <?php } elseif ($i[0]['nilai'] < $i[1]['nilai']) { ?>
                              <h6><span class="badge badge-warning mx-2"><i class="fa fa-arrow-down" aria-hidden="true"
                                    title="Turun <?= number_format(abs($i[0]['nilai'] - $i[1]['nilai']), 2) . ' ' . $i[0]['satuan'] ?>"></i></span>
                              </h6>
                            <?php } ?>
                          <?php } elseif ($i[0]['jenis'] == 'negatif') { ?>
                            <?php if ($i[0]['nilai'] <= $i[1]['nilai']) { ?>
                              <h6><span class="badge badge-success mx-2"><i class="fa fa-arrow-down" aria-hidden="true"
                                    title="Turun <?= number_format(abs($i[0]['nilai'] - $i[1]['nilai']), 2) . ' ' . $i[0]['satuan'] ?>"></i></span>
                              </h6>
                            <?php } elseif ($i[0]['nilai'] > $i[1]['nilai']) { ?>
                              <h6><span class="badge badge-warning mx-2"><i class="fa fa-arrow-up" aria-hidden="true"
                                    title="Naik <?= number_format(abs($i[0]['nilai'] - $i[1]['nilai']), 2) . ' ' . $i[0]['satuan'] ?>"></i></span>
                              </h6>
                            <?php } ?>
                          <?php } ?>
                        </div>
                        <div class="infograph-body-text">
                          <p><b>
                              <?= $i[1]['tahun'] . '-' . $i[1]['periode'] ?>:
                            </b>
                            <?= number_format($i[1]['nilai'], 2) . ' ' . $i[1]['satuan'] ?>
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer">
                    <button type="button" class="button-detail-infograph"
                      onclick="openDetailPage('<?= str_replace(' ', '_', $i[0]['nm_indikator']) ?>', 'nasional')">
                      Detail <i class="fa fa-caret-right"></i>
                    </button>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </section>
      </div>

      <!-- Section Publication -->
      <div class="col-md-12 order-5">
        <section class="publication">
          <a href="<?= base_url(); ?>publication" style="color: black">
            Publikasi
            <i class="fa fa-angle-double-right" aria-hidden="true"></i>
          </a>
          <hr />
          <div class="row">
            <?php foreach ($list_publications as $list) { ?>
              <div class="my-2 mx-2">

                <!-- <div class="img-publication-box" title="<?php echo $list->name ?>">
                    <img
                      src="<?= base_url(); ?>assets/file_publication/<?php echo str_replace(" ", "-", $list->name); ?>/<?php echo $list->title_picture ?>"
                      class="img-thumbnail img-publication"
                      alt="<?php echo $list->name ?>"
                    />
                    <a href="<?= base_url(); ?>assets/file_publication/<?php echo str_replace(" ", "-", $list->name); ?>/<?php echo $list->file ?>" target="_blank" rel="noopener" class="d-flex justify-content-center">
                    <a href="<?= base_url(); ?>file_publication/<?php echo str_replace(" ", "-", $list->name); ?>/<?php echo $list->file; ?>" target="_blank" rel="noopener" class="d-flex justify-content-center">
                      <img
                        src="<?= base_url(); ?>assets/images/img/see_more.png"
                        alt="Download <?php echo $list->name ?>"
                        class="align-self-center"
                        height="70"
                        width="70"
                      />
                    </a>
                  </div> -->

                <div class="card img-publication-box" style="max-width:fit-content;" title="<?php echo $list->name ?>">
                  <img class="card-img-top img-publication p-1"
                    src="<?= base_url(); ?>assets/file_publication/<?php echo str_replace(" ", "-", $list->name); ?>/<?php echo $list->title_picture ?>"
                    alt="<?php echo $list->name ?>">
                  <div class="card-body p-2">
                    <p class="card-text">
                      <?php echo $list->name ?>
                    </p>
                  </div>
                  <!-- <a href="<?= base_url(); ?>assets/file_publication/<?php echo str_replace(" ", "-", $list->name); ?>/<?php echo $list->file ?>" target="_blank" rel="noopener" class="d-flex justify-content-center"> -->
                  <!-- <a href="<?= base_url(); ?>file_publication/<?php echo str_replace(" ", "-", $list->name); ?>/<?php echo $list->file; ?>" target="_blank" rel="noopener" class="d-flex justify-content-center"> -->
                  <!-- <a href="https://online.flippingbook.com/view/617112841/" target="_blank" rel="noopener" class="d-flex justify-content-center"> -->
                  <?php if ($list->name == 'Knowledge Sharing Pembangunan Daerah 2018') { ?>
                    <script src="//static.fliphtml5.com/web/js/plugin/LightBox/js/fliphtml5-light-box-api-min.js"></script>
                    <a class="d-flex justify-content-center btn-read-publication" data-id="<?php echo $list->id ?>"
                      data-rel="fh5-light-box-demo" data-href="https://online.fliphtml5.com/dmeid/ghjy/" data-width="900"
                      data-height="500" data-title="Knowledge Sharing Pembangunan Daerah 2018">
                    <?php } else if ($list->name == 'Prosiding Knowledge Sharing 2018') { ?>
                        <script
                          src="//static.fliphtml5.com/web/js/plugin/LightBox/js/fliphtml5-light-box-api-min.js"></script>
                        <a class="d-flex justify-content-center btn-read-publication" data-id="<?php echo $list->id ?>"
                          data-rel="fh5-light-box-demo" data-href="https://online.fliphtml5.com/dmeid/qrsg/" data-width="900"
                          data-height="500" data-title="Prosiding Knowledge Sharing 2018">
                      <?php } else if ($list->name == 'Prosiding Knowledge Sharing 2019') { ?>
                            <script
                              src="//static.fliphtml5.com/web/js/plugin/LightBox/js/fliphtml5-light-box-api-min.js"></script>
                            <a class="d-flex justify-content-center btn-read-publication" data-id="<?php echo $list->id ?>"
                              data-rel="fh5-light-box-demo" data-href="https://online.fliphtml5.com/dmeid/ksbx/"
                              data-width="900" data-height="500" data-title="Prosiding Knowledge Sharing 2019">
                        <?php } else if ($list->name == 'Knowledge Sharing Pembangunan Daerah 2019 - 2020') { ?>
                                <script
                                  src="//static.fliphtml5.com/web/js/plugin/LightBox/js/fliphtml5-light-box-api-min.js"></script>
                                <a class="d-flex justify-content-center btn-read-publication" data-id="<?php echo $list->id ?>"
                                  data-rel="fh5-light-box-demo" data-href="https://online.fliphtml5.com/dmeid/kvbv/"
                                  data-width="900" data-height="500"
                                  data-title="Knowledge Sharing Pembangunan Daerah 2019 - 2020">
                          <?php } else { ?>
                                  <a href="<?= base_url(); ?>file_publication/<?php echo str_replace(" ", "-", $list->name); ?>/<?php echo $list->file; ?>"
                                    data-id="<?php echo $list->id ?>" target="_blank" rel="noopener"
                                    class="d-flex justify-content-center btn-read-publication">
                            <?php } ?>
                            <!-- <img
                              src="<?= base_url(); ?>assets/images/img/see_more.png"
                              alt="Download <?php echo $list->name ?>"
                              class="align-self-center"
                              height="70"
                              width="70"
                          /> -->
                            <script src="https://cdn.lordicon.com/libs/mssddfmo/lord-icon-2.1.0.js"></script>
                            <lord-icon src="https://cdn.lordicon.com/nocovwne.json" trigger="morph"
                              colors="primary:#000000,secondary:#000000" style="width:250px;height:250px">
                            </lord-icon>
                          </a>
                          <!-- <script async defer src="https://online.flippingbook.com/EmbedScriptUrl.aspx?m=redir&hid=617112841"></script> -->
                </div>

              </div>
            <?php } ?>
          </div>
        </section>
      </div>
      <!-- End Section Publication -->

      <!-- Section Activity -->
      <div class="col-md-12 order-2">
        <section class="activity">
          Kegiatan
          <hr />
          <div class="row">
            <div class="col-6 col-md-3 col-lg-6 my-2 rounded-3">
              <a href="<?= base_url(); ?>kegiatan/penghargaan" style="text-decoration: none;">
                <div class="card card-activity">
                  <div class="card-body">
                    <div class="box-img-activity col d-flex justify-content-center">
                      <img class="img-fluid mb-3 w-50"
                        src="<?= base_url(); ?>assets/images/img/logo-kegiatan/ppd-min.png" alt="card image" />
                    </div>
                    <p class="card-text text-center text-activity">
                      PENGHARGAAN PEMBANGUNAN DAERAH
                    </p>
                  </div>
                </div>
              </a>
            </div>
            <div class="col-6 col-md-3 col-lg-6 my-2 rounded-3">
              <a href="<?= base_url(); ?>kegiatan/pemantauan" style="text-decoration: none;">
                <div class="card card-activity">
                  <div class="card-body">
                    <div class="box-img-activity col d-flex justify-content-center">
                      <img class="img-fluid mb-3 w-50"
                        src="<?= base_url(); ?>assets/images/img/logo-kegiatan/pemantauan-min.png" alt="card image" />
                    </div>
                    <p class="card-text text-center text-activity">
                      PEMANTAUAN PEMBANGUNAN DAERAH
                    </p>
                  </div>
                </div>
              </a>
            </div>
            <div class="col-6 col-md-3 col-lg-6 my-2 rounded-3">
              <a href="<?= base_url(); ?>kegiatan/evaluasi" style="text-decoration: none;">
                <div class="card card-activity">
                  <div class="card-body">
                    <div class="box-img-activity col d-flex justify-content-center">
                      <img class="img-fluid mb-3 w-50"
                        src="<?= base_url(); ?>assets/images/img/logo-kegiatan/epd-min.png" alt="card image" />
                    </div>
                    <p class="card-text text-center text-activity">
                      EVALUASI PEMBANGUNAN DAERAH
                    </p>
                  </div>
                </div>
              </a>
            </div>
            <div class="col-6 col-md-3 col-lg-6 my-2 rounded-3">
              <a href="<?= base_url(); ?>kegiatan/koordinasi" style="text-decoration: none;">
                <div class="card card-activity">
                  <div class="card-body">
                    <div class="box-img-activity col d-flex justify-content-center">
                      <img class="img-fluid mb-3 w-50"
                        src="<?= base_url(); ?>assets/images/img/logo-kegiatan/koordinasi_pembangunan-min.png"
                        alt="card image" />
                    </div>
                    <p class="card-text text-center text-activity">
                      KOORDINASI PEMBANGUNAN
                    </p>
                  </div>
                </div>
              </a>
            </div>
          </div>
        </section>
      </div>
      <!-- End Section Activity -->



      <!-- Section Application -->
      <div class="col-md-12 order-6">
        <section class="application">
          Aplikasi
          <hr />
          <div class="card card-application my-3">
            <div class="img-application">
              <img src="<?= base_url(); ?>assets/images/img/penilaian_ppd.png" class="card-img-top"
                alt="Aplikasi Penilaian PPD" />
              <div class="card-body">
                <p class="card-text text-center">LOGIN SISTEM PENILAIAN PPD</p>
              </div>
              <a href="https://peppd.bappenas.go.id/jumper_ppd/" target="_blank" rel="noopener"
                class="d-flex justify-content-center">
                <img class="align-self-center" src="<?= base_url(); ?>assets/images/img/External_link_font_awesome.png"
                  alt="Login Sistem Penilaian PPD" height="100" width="100" />
              </a>
            </div>
          </div>
          <div class="card card-application my-3">
            <div class="img-application">
              <img src="<?= base_url(); ?>assets/images/img/aplikasi_pemantauan.png" class="card-img-top"
                alt="Login Sistem Pemantauan" />
              <div class="card-body">
                <p class="card-text text-center">LOGIN SISTEM PEMANTAUAN</p>
              </div>
              <a href="https://peppd.bappenas.go.id/pemantauan/" target="_blank" rel="noopener"
                class="d-flex justify-content-center">
                <img class="align-self-center" src="<?= base_url(); ?>assets/images/img/External_link_font_awesome.png"
                  alt="Login Sistem Pemantauan" height="100" width="100" />
              </a>
            </div>
          </div>
        </section>
      </div>
      <!-- End Section Application -->

      <!-- Section Contact Us -->
      <div class="col-md-12 order-7">
        <section class="contact-us">
          Hubungi Kami
          <hr />
          <div class="card my-3">
            <a href="https://docs.google.com/forms/d/e/1FAIpQLSfcACkyqgiSTD7QrSYHBXxg47xwenTZfi7ofACM598Kjg8Jzw/viewform?usp=pp_url"
              target="_blank" rel="noopener">
              <img src="<?= base_url(); ?>assets/images/img/Contact-Centre-02.png" class="card-img-top"
                alt="Aplikasi Penilaian PPD" />
              <div class="card-body">
                <p class="card-text text-center">HUBUNGI KAMI</p>
              </div>
            </a>
          </div>
        </section>
      </div>
      <!-- End Section Contact Us -->

      <!-- Section career -->
      <!-- <div class="col-md-12 order-7">
          <section class="career">
            Karir
            <hr />
            <div class="card my-3">
              <a href="<?= base_url(); ?>karir" target="_blank" rel="noopener">
                <img
                  src="<?= base_url(); ?>assets/images/img/carousel/career1.png"
                  class="card-img-top"
                  alt="Rekrutmen Tenagan Pendukung Analis Ekonomi"
                />
              </a>
              <div class="card-body">
                <hr>
                <a type="button" href="<?= base_url(); ?>assets/images/img/carousel/career1.png" class="btn-download-publication" download="Lowongan_Kerja_Tenagan_Pendukung_Analis_Ekonomi_Bappenas.png"><i class="fa fa-arrow-circle-down"></i> Unduh Brosur</a>
              </div>
            </div>
          </section>
        </div> -->
      <!-- End Section Career -->

    </div>
  </div>
</div>

<script>
  function openDetailPage(indikator, wilayah) {
    var postData = {
      indikator: indikator,
      wilayah: wilayah
    };

    var form = document.createElement('form');
    form.method = 'POST';
    form.action = '<?= base_url('infograph'); ?>';

    for (var key in postData) {
      if (postData.hasOwnProperty(key)) {
        var input = document.createElement('input');
        input.type = 'hidden';
        input.name = key;
        input.value = postData[key];
        form.appendChild(input);
      }
    }
    document.body.appendChild(form);
    form.submit();
  }

  $(document).ready(function () {

    function load_article_data(page) {
      $.ajax({
        url: "<?php echo base_url(); ?>C_pagesController/article_pagination/" + page,
        method: "GET",
        dataType: "json",
        success: function (data) {
          // console.log(data.pagination_link);
          $('.list_article').html(data.list_article);
          $('.pagination_link').html(data.pagination_link);
        }
      });
    }

    load_article_data(1);

    $(document).on("click", ".pagination li span a", function (event) {
      $(this).append(' <i class="fa fa-spinner fa-spin icon-comment-loading"></i>');
      event.preventDefault();
      var page = $(this).data("ci-pagination-page");
      load_article_data(page);
    })

    $(document).on('click', '.button-detail-infograph', function () {
      var dataId = $(this).attr("data-id");
      var dataLog = "user mengklik info grafis dengan id = " + dataId + " pada halaman home";
      $.ajax({
        type: "POST",
        url: "<?= base_url(); ?>logPortalController/store",
        data: {
          // [csrfName]: csrfHash,
          action: dataLog,
        },
        success: function (result) {
          // console.log(result);
        },
        error: function (result) {
          console.log(result);
        }
      });
    });

    $(document).on('click', '.btn-read-more-article', function () {
      // var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>';
      // var csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
      var dataId = $(this).attr("data-id");
      var dataLog = "user mengklik article dengan id = " + dataId + " pada halaman home";
      $.ajax({
        type: "POST",
        url: "<?= base_url(); ?>logPortalController/store",
        data: {
          // [csrfName]: csrfHash,
          action: dataLog,
        },
        success: function (result) {
          // console.log(result);
        },
        error: function (result) {
          console.log(result);
        }
      });
    });

    $(document).on('click', '.card-article', function () {
      // var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>';
      // var csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
      var dataId = $(this).attr("data-id");
      var dataLog = "user mengklik article dengan id = " + dataId + " pada halaman home";
      $.ajax({
        type: "POST",
        url: "<?= base_url(); ?>logPortalController/store",
        data: {
          // [csrfName]: csrfHash,
          action: dataLog,
        },
        success: function (result) {
          // console.log(result);
        },
        error: function (result) {
          console.log(result);
        }
      });
    });
    $(document).on('click', '.btn-download-publication', function () {
      // var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>';
      // var csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
      var dataId = $(this).attr("data-id");
      var dataLog = "user mengunduh dokumen/file dengan id = " + dataId + " pada halaman home";
      $.ajax({
        type: "POST",
        url: "<?= base_url(); ?>logPortalController/store",
        data: {
          // [csrfName]: csrfHash,
          action: dataLog,
        },
        success: function (result) {
          console.log(result);
        },
        error: function (result) {
          console.log(result);
        }
      });
    });

    $(document).on('click', '.btn-read-publication', function () {
      // var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>';
      // var csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
      var dataId = $(this).attr("data-id");
      var dataLog = "user menklik dokumen/file dengan id = " + dataId + " pada halaman home";
      $.ajax({
        type: "POST",
        url: "<?= base_url(); ?>logPortalController/store",
        data: {
          // [csrfName]: csrfHash,
          action: dataLog,
        },
        success: function (result) {
          console.log(result);
        },
        error: function (result) {
          console.log(result);
        }
      });
    });


    // $(document).on('load', '.list_article', function() {
    //   var imageSrc = document
    //     .getElementByClassName('box-img-news')
    //     .style.backgroundImage.replace(/url\((['"])?(.*?)\1\)/gi, '$2')
    //     .split(',')[0];

    //   // I just broke it up on newlines for readability

    //   var image = new Image();
    //   image.src = imageSrc;

    //   image.onload = function() {
    //     var width = image.width,
    //       height = image.height;
    //     alert('width =' + width + ', height = ' + height);
    //   };
    // });

  });
</script>