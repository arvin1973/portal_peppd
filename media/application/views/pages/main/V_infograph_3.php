<!-- author  : Muhamad Munawir Amin
Email        : muhamadmunawiramin@gmail.com
Last Update  : 15 March 2022 -->

<div class="container-md" style="margin-top: 7rem">
    <?php setlocale(LC_TIME, 'id_ID', 'Indonesian_indonesia', 'Indonesian'); ?>

    <!-- <?php print_r($description); ?>
    <br>
    <br>
    <?php print_r($infographprovinsi); ?>
    <br>
    <br>
    <?php print_r($indikator); ?>
    <br>
    <br>
    <?php print_r($subWilayah[0]['id']); ?>
    <?php print_r($subWilayahDaerah[0]['id']); ?>
    <br>
    <br>
    <?php print_r($graphperbandinganwilayah); ?> -->
    <div class="row">
        <div class="col-lg-4 order-lg-2 d-none d-lg-block">

            <!-- Section Search -->
            <!-- <div class="col-md-12" id="search-box"> -->
            <!-- <div class="col-md-12" id="search-box" style="position: fixed; width: auto; margin-right: 75px;"> -->
            <div class="col-md-12" id="search-box" style="position: sticky; top: 120px; width: auto;">
                <section class="search">

                    <div class="card">
                        <div class="card-header" style="padding-top: 0.5rem; padding-bottom: 0.5rem;">
                            <p style="font-family: 'Monda', sans-serif; font-size: 14px; margin: 0px;"><b>CARI...</b></p>
                        </div>
                        <?php if (isset($IndikatorTable)) { ?>
                            <form id="formSearchIndicator" method="POST" action="<?php echo base_url('test') ?>">
                                <div class="card-body" style="height: 300px; padding-top: 0.5rem; padding-bottom: 0.5rem;">
                                    <div class="form-group" style="margin-bottom: 0.5rem;">
                                        <label for="indikator">Indikatora</label>
                                        <select class="form-control" class="selectIndikator" id="indikator" name="indikator">
                                            <option value="Pertumbuhan_Ekonomi" <?php echo ($IndikatorTable[0]['nama_indikator'] == 'Pertumbuhan Ekonomi' ? "selected" : "") ?>>Pertumbuhan Ekonomi</option>
                                            <option value="PDRB_per_Kapita_ADHB" <?php echo ($IndikatorTable[0]['nama_indikator'] == 'PDRB per Kapita ADHB' ? "selected" : "") ?>>PDRB per Kapita ADHB</option>
                                            <option value="PDRB_per_Kapita_ADHK_Tahun_Dasar_2010" <?php echo ($IndikatorTable[0]['nama_indikator'] == 'PDRB per Kapita ADHK Tahun Dasar 2010' ? "selected" : "") ?>>PDRB per Kapita ADHK Tahun Dasar 2010</option>
                                            <option value="Jumlah_Penganggur" <?php echo ($IndikatorTable[0]['nama_indikator'] == 'Jumlah Penganggur' ? "selected" : "") ?>>Jumlah Penganggur</option>
                                            <option value="Tingkat_Pengangguran_Terbuka" <?php echo ($IndikatorTable[0]['nama_indikator'] == 'Tingkat Pengangguran Terbuka' ? "selected" : "") ?>>Tingkat Pengangguran Terbuka</option>
                                            <option value="Indeks_Pembangunan_Manusia" <?php echo ($IndikatorTable[0]['nama_indikator'] == 'Indeks Pembangunan Manusia' ? "selected" : "") ?>>Indeks Pembangunan Manusia</option>
                                            <option value="Gini_Rasio" <?php echo ($IndikatorTable[0]['nama_indikator'] == 'Gini Rasio' ? "selected" : "") ?>>Gini Rasio</option>
                                            <option value="Angka_Harapan_Hidup" <?php echo ($IndikatorTable[0]['nama_indikator'] == 'Angka Harapan Hidup' ? "selected" : "") ?>>Angka Harapan Hidup</option>
                                            <option value="Rata-rata_Lama_Sekolah" <?php echo ($IndikatorTable[0]['nama_indikator'] == 'Rata-rata Lama Sekolah' ? "selected" : "") ?>>Rata-rata Lama Sekolah</option>
                                            <option value="Harapan_Lama_Sekolah" <?php echo ($IndikatorTable[0]['nama_indikator'] == 'Harapan Lama Sekolah' ? "selected" : "") ?>>Harapan Lama Sekolah</option>
                                            <option value="Pengeluaran_per_Kapita" <?php echo ($IndikatorTable[0]['nama_indikator'] == 'Pengeluaran per Kapita' ? "selected" : "") ?>>Pengeluaran per Kapita</option>
                                            <option value="Indeks_Kedalaman_Kemiskinan" <?php echo ($IndikatorTable[0]['nama_indikator'] == 'Indeks Kedalaman Kemiskinan' ? "selected" : "") ?>>Indeks Kedalaman Kemiskinan</option>
                                            <option value="Tingkat_Kemiskinan" <?php echo ($IndikatorTable[0]['nama_indikator'] == 'Tingkat Kemiskinan' ? "selected" : "") ?>>Tingkat Kemiskinan</option>
                                            <option value="Jumlah_Penduduk_Miskin" <?php echo ($IndikatorTable[0]['nama_indikator'] == 'Jumlah Penduduk Miskin' ? "selected" : "") ?>>Jumlah Penduduk Miskin</option>
                                        </select>
                                    </div>
                                    <div class="form-group" style="margin-bottom: 0.5rem;">
                                        <label for="wilayah">Wilayah</label>
                                        <select class="form-control" id="selectWilayah" name="wilayah">
                                            <option value="nasional" <?php echo ($wilayah == 'nasional') ? 'selected' : '' ?>>Nasional</option>
                                            <option value="provinsi" <?php echo ($wilayah == 'provinsi') ? 'selected' : '' ?>>Provinsi</option>
                                            <option value="kabupatenkota" <?php echo ($wilayah == 'kabupatenkota') ? 'selected' : '' ?>>Kabupaten/ Kota</option>
                                        </select>
                                    </div>
                                    <div class="form-group form-group-sub-wilayah" style="margin-bottom: 0.5rem; display: <?php if (($wilayah == 'provinsi') || ($wilayah == 'kabupatenkota')) {
                                                                                                                                echo 'block';
                                                                                                                            } else {
                                                                                                                                echo 'none';
                                                                                                                            } ?>;">
                                        <?php $subWil = (isset($subWilayah[0]['nama_provinsi']) ? $subWilayah[0]['nama_provinsi'] : "") ?>
                                        <label for="sub-wilayah">Provinsi</label>
                                        <select class="form-control" id="selectSubWilayah" name="subWilayah" <?php if (($wilayah == 'provinsi') || ($wilayah == 'kabupatenkota')) {
                                                                                                                    echo 'required';
                                                                                                                } else {
                                                                                                                    echo '';
                                                                                                                } ?>>
                                            <option value=''>-Pilih-</option>
                                            <?php foreach ($list_provinsi as $list_p) { ?>
                                                <option value="<?php echo $list_p['id'] ?>" <?php echo ($subWil == $list_p['nama_provinsi'] ? 'selected' : '') ?>><?php echo $list_p['nama_provinsi'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group form-group-kabupaten-kota" style="margin-bottom: 0.5rem; display: <?php echo ($wilayah == 'kabupatenkota' ? 'block' : 'none') ?>;">
                                        <label for="sub-wilayah">Kabupaten/ Kota</label>
                                        <select class="form-control" id="selectKabupatenKota" name="kabupatenkota" <?php echo ($wilayah == 'kabupatenkota' ? 'required' : '') ?>>
                                        </select>
                                    </div>
                                </div>
                                <div class="card-footer" style="padding: 0.3rem 1.4rem 2.8rem 1rem; margin-top: 0.5rem;">
                                    <button type="submit" style="padding: 0.5% 5%; float: right; font-size: 14px;" class="button-read-more btn-read-more-article">
                                        Cari <i class="fa fa-xs fa-search"></i>
                                    </button>
                                </div>
                            </form>
                        <?php } else { ?>
                            <form id="formSearchIndicator" method="POST" >
                                <div class="card-body" style="height: 350px;">
                                    <div class="form-group">
                                        <label for="indikator">Indikator</label>
                                        <select class="form-control" class="selectIndikator" name="indikator">
                                            <option value="Pertumbuhan Ekonomi">Pertumbuhan Ekonomi</option>
                                            <option value="PDRB per Kapita ADHB">PDRB per Kapita ADHB</option>
                                            <option value="PDRB per Kapita ADHK Tahun Dasar 2010">PDRB per Kapita ADHK Tahun Dasar 2010</option>
                                            <option value="Jumlah Penganggur">Jumlah Penganggur</option>
                                            <option value="Tingkat Pengangguran Terbuka">Tingkat Pengangguran Terbuka</option>
                                            <option value="Indeks Pembangunan Manusia">Indeks Pembangunan Manusia</option>
                                            <option value="Gini Rasio">Gini Rasio</option>
                                            <option value="Angka Harapan Hidup">Angka Harapan Hidup</option>
                                            <option value="Rata-rata Lama Sekolah">Rata-rata Lama Sekolah</option>
                                            <option value="Harapan Lama Sekolah">Harapan Lama Sekolah</option>
                                            <option value="Pengeluaran per Kapita">Pengeluaran per Kapita</option>
                                            <option value="Indeks Kedalaman Kemiskinan">Indeks Kedalaman Kemiskinan</option>
                                            <option value="Tingkat Kemiskinan">Tingkat Kemiskinan</option>
                                            <option value="Jumlah Penduduk Miskin">Jumlah Penduduk Miskin</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="wilayah">Wilayah</label>
                                        <select class="form-control" id="selectWilayah" name="wilayah">
                                            <option value="nasional">Nasional</option>
                                            <option value="provinsi">Provinsi</option>
                                            <option value="kabupatenkota">Kabupaten/ Kota</option>
                                        </select>
                                    </div>
                                    <div class="form-group form-group-sub-wilayah" style="display: none;">
                                        <label for="sub-wilayah">Provinsi</label>
                                        <select class="form-control" id="selectSubWilayah" name="subWilayah">
                                            <?php foreach ($list_provinsi as $list_p) { ?>
                                                <option value="<?php echo $list_p['id'] ?>"><?php echo $list_p['nama_provinsi'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group form-group-kabupaten-kota" style="display: none;">
                                        <label for="sub-wilayah">Kabupaten/ Kota</label>
                                        <select class="form-control" id="selectKabupatenKota" name="kabupatenkota">
                                        </select>
                                    </div>
                                </div>
                                <div class="card-footer" style="padding: 0.3rem 1.4rem 2.8rem 1rem;">
                                    <button type="submit" style="padding: 0.5% 5%; float: right; font-size: 14px;" class="button-read-more btn-read-more-article">
                                        Cari <i class="fa fa-xs fa-search"></i>
                                    </button>
                                </div>
                            </form>
                        <?php } ?>
                    </div>
                </section>
            </div>
            <!-- End Section Search -->

            <!-- Section file -->
            <!-- <div class="col-md-12">
                <section class="file">

                    <div class="card">
                        <div class="card-header">
                            <p style="font-family: 'Monda', sans-serif; font-size: 14px; margin: 0px;"><b>FILE</b></p>
                        </div>
                        <div class="card-body">
                            <div class="row" style="display: flex; align-items: center; margin-top: 10px; margin-bottom: 10px;">
                                <div class="col-10">
                                    <p style="font-family: 'Monda', sans-serif; font-size: 12px; margin: 0px;">Pertumbuhan Ekonomi Nasional 2022.xls</p>
                                </div>
                                <div class="col-2">
                                    <a type="button" style="padding: 3px 8px 3px 8px; float: right; font-size: 11px; margin-top: 0px;" class="button-read-more btn-read-more-article">
                                        <i class="fa fa-xs fa-download"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="row" style="display: flex; align-items: center; margin-top: 10px; margin-bottom: 10px;">
                                <div class="col-10">
                                    <p style="font-family: 'Monda', sans-serif; font-size: 12px; margin: 0px;">Pertumbuhan Ekonomi Daerah.xls</p>
                                </div>
                                <div class="col-2">
                                    <a type="button" style="padding: 3px 8px 3px 8px; float: right; font-size: 11px; margin-top: 0px;" class="button-read-more btn-read-more-article">
                                        <i class="fa fa-xs fa-download"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="row" style="display: flex; align-items: center; margin-top: 10px; margin-bottom: 10px;">
                                <div class="col-10">
                                    <p style="font-family: 'Monda', sans-serif; font-size: 12px; margin: 0px;">Perbandingan Pertumbuhan Ekonomi Nasional dan Daerah 2020-2025.xls</p>
                                </div>
                                <div class="col-2">
                                    <a type="button" style="padding: 3px 8px 3px 8px; float: right; font-size: 11px; margin-top: 0px;" class="button-read-more btn-read-more-article">
                                        <i class="fa fa-xs fa-download"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </section>
            </div> -->
            <!-- End Section file -->

        </div>
        <div class="col-lg-12 mt-3 d-lg-none">
            <div class="col-12" data-toggle="modal" data-target="#exampleModal">
                        <div class="card p-1" id="menuSearch">
                            <div class="card-body">
                                <b>CARI...</b>
                            </div>
                        </div>
            </div>
        </div>
        <div class="col-lg-8 order-lg-1">
            <!-- Section Infograph -->
            <div class="col-md-12">
                <section class="infograph">

                    <div class="card">
                        <div class="card-body" style="padding-left: 0px; padding-right: 0px;">

                            <?php if (isset($IndikatorTable)) { ?>
                                <div class="col-12 order-md-1">
                                    <div class="card" style="border: 2px solid black; margin: 10px; background-image: url('<?= base_url(); ?>assets/images/img/pattern/pattern_8.png');">
                                        <div class="card-body" style="display: flex; padding: 0.5rem 0.5rem;">
                                            <div class="d-none d-md-block col-md-3 col-lg-3">
                                                <?php
                                                if (strtolower(str_replace(" ", "_", $indikator)) == 'pdrb_per_kapita_adhk_tahun_dasar_2010') {
                                                    $width_img = "w-100";
                                                } elseif (strtolower(str_replace(" ", "_", $indikator)) == 'tingkat_pengangguran_terbuka') {
                                                    $width_img = "w-50";
                                                } elseif (strtolower(str_replace(" ", "_", $indikator)) == 'gini_rasio') {
                                                    $width_img = "w-50";
                                                } elseif (strtolower(str_replace(" ", "_", $indikator)) == 'rata-rata_lama_sekolah') {
                                                    $width_img = "w-50";
                                                } elseif (strtolower(str_replace(" ", "_", $indikator)) == 'jumlah_penduduk_miskin') {
                                                    $width_img = "w-50";
                                                } else {
                                                    $width_img = "w-75";
                                                }
                                                ?>
                                                <img class="<?php echo $width_img; ?>" src="<?= base_url(); ?>assets/images/img/icon_pemantauan/<?php echo strtolower(str_replace(" ", "_", $indikator)); ?>.jpg" alt="<?php echo $indikator ?>" />
                                            </div>
                                            <div class="col-12 col-md-9 col-lg-9" style="align-self: center; text-align: end;">
                                                <p style="font-family: 'Monda', sans-serif; font-size: 28px; margin: 0px;"><b><?php echo $IndikatorTable[0]['nama_indikator']; ?></b></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 order-md-3">
                                    <!-- <div class="card" style="border: 2px solid black; margin: 20px; margin-top: 0px; background-color: #4CC9F0;"> -->
                                    <div class="card" style="border: 2px solid black; margin: 10px; margin-top: 0px;">
                                        <div class="card-body" style="display: flex; padding: 0.5rem 0.5rem;">
                                            <b>
                                                <p class="deskripsiIndikator" style="font-family: 'Monda', sans-serif; font-size: 12px; margin: 0px; color: #0d4a82;">
                                                    <?php echo $IndikatorTable[0]['deskripsi']; ?> </p>
                                            </b>
                                        </div>
                                    </div>
                                </div>

                                <?php if ((($wilayah == 'nasional') && (isset($infographnasional[5])) && ($infographnasional[5] != null)) || (($wilayah == 'provinsi') && (isset($infographprovinsi[5])) && ($infographprovinsi[5] != null)) || (($wilayah == 'kabupatenkota') && (isset($infographkabupatenkota[5])) && ($infographkabupatenkota[5] != null))) { ?>
                                    <div class="col-12 order-md-2">
                                        <div class="card" style="border: 2px solid black; border-bottom: 1.5px solid black; margin: 10px; margin-top: 10px; margin-bottom: 0px; height: 320px; border-radius: 0.25rem 0.25rem 0rem 0rem;">
                                            <div class="card-body" style="display: flex; padding: 0.5rem 0.5rem;">
                                                <!-- <div id="googleMap" style="width:100%;height:300px;"></div> -->
                                                <div id='map' style='width: 100%; height: 100%;'></div>
                                                <div class='map-overlay' id='features'>
                                                    <!-- <h4>US population density</h4> -->
                                                    <div>
                                                        <p id='pd'><i>sorot kursor pada daerah</i></p>
                                                    </div>
                                                </div>
                                                <!-- <div class="map-legend" id="legend"></div>
                                                <div class="map-description" id="description"></div> -->
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-6 order-md-2" style="padding-right: 0px;">
                                            <!-- <div class="card" style="border: 2px solid black; border-top: 1px solid black; border-right: 1px solid black; margin-left: 35px; margin-right: 0px; margin-top: 0px; margin-bottom: 10px; height: 115px; border-radius: 0rem 0rem 0rem 0.25rem; background-image: url('<?= base_url(); ?>assets/images/img/pattern/pattern_8.png');"> -->
                                            <div class="card" style="border: 2px solid black; border-top: 1px solid black; border-right: 1px solid black; margin-left: 25px; margin-right: 0px; margin-top: 0px; margin-bottom: 10px; height: 130px; border-radius: 0rem 0rem 0rem 0.25rem;">
                                                <div class="card-body" style="display: flex; padding: 0.5rem 0.5rem;">
                                                    <div id="legend">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 order-md-2" style="padding-left: 0px;">
                                            <div class="card" style="border: 2px solid black; border-top: 1px solid black; border-left: 1.5px solid black; margin-right: 25px; margin-left: 0px; margin-top: 0px; margin-bottom: 10px; height: 130px; border-radius: 0rem 0rem 0.25rem 0rem;">
                                                <div class="card-body" style="display: flex; padding: 0.5rem 0.5rem;">
                                                    <p id="description"><i>klik kursor pada daerah</i></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="row" style="margin: 10px;">

                                        <div class="<?php echo ($wilayah == 'nasional' ? 'col-md-12' : 'col-md-12') ?> order-md-4" style="margin-bottom: 10px;">
                                            <div class="card" style="height: 430px;">
                                                <div class="card-body" style="padding: 10px; padding-left: 3px;">
                                                    <script src="https://code.highcharts.com/highcharts.js"></script>
                                                    <script src="https://code.highcharts.com/modules/exporting.js"></script>
                                                    <script src="https://code.highcharts.com/modules/export-data.js"></script>
                                                    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

                                                    <figure class="highcharts-figure">
                                                        <div id="container"></div>
                                                    </figure>
                                                </div>
                                                <div class="card-footer text-muted" style="padding-bottom: 0rem;">
                                                    <div class="col-lg-12">
                                                        <p style="margin-bottom: 0.2rem;"><b>Keterangan : </b></p>
                                                        <ul class="" style="padding-left: 10px; list-style-type:none;">
                                                            <li><img src="<?= base_url(); ?>assets/images/img/menu-highchart.jpg" alt="Menu Highchart" style="width: 5%;" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;<em>Menu (klik untuk melihat menu grafik)</em></li>
                                                            <li><img src="<?= base_url(); ?>assets/images/img/legenda.jpg" alt="Legenda" style="width: 10%;" />&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;<em>Legenda (klik nama daerah untuk menyembuyikan/menampilkan grafik)</em></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <?php if ($wilayah == 'nasional') { ?>
                                            <?php
                                            if ($infographnasional[5]['satuan'] == '%') {
                                                $nilainasional1 = round($infographnasional[1]['nasional'], 2);
                                                $nilainasional2 = round($infographnasional[2]['nasional'], 2);
                                                $nilainasional3 = round($infographnasional[3]['nasional'], 2);
                                                $nilainasional4 = round($infographnasional[4]['nasional'], 2);
                                                $nilainasional5 = round($infographnasional[5]['nasional'], 2);
                                            } elseif ($infographnasional[5]['satuan'] == 'Rp') {
                                                $nilainasional1 = number_format($infographnasional[1]['nasional'], 0, ',', '.');
                                                $nilainasional2 = number_format($infographnasional[2]['nasional'], 0, ',', '.');
                                                $nilainasional3 = number_format($infographnasional[3]['nasional'], 0, ',', '.');
                                                $nilainasional4 = number_format($infographnasional[4]['nasional'], 0, ',', '.');
                                                $nilainasional5 = number_format($infographnasional[5]['nasional'], 0, ',', '.');
                                            } elseif ($infographnasional[5]['satuan'] == 'Orang') {
                                                $nilainasional1 = number_format($infographnasional[1]['nasional'], 0, ',', '.');
                                                $nilainasional2 = number_format($infographnasional[2]['nasional'], 0, ',', '.');
                                                $nilainasional3 = number_format($infographnasional[3]['nasional'], 0, ',', '.');
                                                $nilainasional4 = number_format($infographnasional[4]['nasional'], 0, ',', '.');
                                                $nilainasional5 = number_format($infographnasional[5]['nasional'], 0, ',', '.');
                                            } else {
                                                $nilainasional1 = $infographnasional[1]['nasional'];
                                                $nilainasional2 = $infographnasional[2]['nasional'];
                                                $nilainasional3 = $infographnasional[3]['nasional'];
                                                $nilainasional4 = $infographnasional[4]['nasional'];
                                                $nilainasional5 = $infographnasional[5]['nasional'];
                                            }
                                            ?>
                                            <div class="col-md-12 order-md-5" style="margin-bottom: 10px;">
                                                <table class="table table-bordered table-hover">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th><b>Wilayah</b></th>
                                                            <th>
                                                                <center><b><?php echo strftime("%b", mktime(0, 0, 0, $infographnasional[1]['periode'])); ?> - <?php echo $infographnasional[1]['tahun'] ?></b></center>
                                                            </th>
                                                            <th>
                                                                <center><b><?php echo strftime("%b", mktime(0, 0, 0, $infographnasional[2]['periode'])); ?> - <?php echo $infographnasional[2]['tahun'] ?></b></center>
                                                            </th>
                                                            <th>
                                                                <center><b><?php echo strftime("%b", mktime(0, 0, 0, $infographnasional[3]['periode'])); ?> - <?php echo $infographnasional[3]['tahun'] ?></b></center>
                                                            </th>
                                                            <th>
                                                                <center><b><?php echo strftime("%b", mktime(0, 0, 0, $infographnasional[4]['periode'])); ?> - <?php echo $infographnasional[4]['tahun'] ?></b></center>
                                                            </th>
                                                            <th>
                                                                <center><b><?php echo strftime("%b", mktime(0, 0, 0, $infographnasional[5]['periode'])); ?> - <?php echo $infographnasional[5]['tahun'] ?></b></center>
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td><b>Nasional</b></td>
                                                            <td>
                                                                <center><?php echo $nilainasional1; ?></center>
                                                            </td>
                                                            <td>
                                                                <center><?php echo $nilainasional2; ?></center>
                                                            </td>
                                                            <td>
                                                                <center><?php echo $nilainasional3; ?></center>
                                                            </td>
                                                            <td>
                                                                <center><?php echo $nilainasional4; ?></center>
                                                            </td>
                                                            <td>
                                                                <center><?php echo $nilainasional5; ?></center>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="col-md-12 order-md-6">
                                                <!-- <div class="card" style="border: 2px solid black; background-color: #3E86DA;"> -->
                                                <div class="card" style="border: 2px solid black; background-color: white;">
                                                    <!-- <div class="card-title" style="position: absolute; top: -10px; border: 2px solid black; align-self: center; text-align: center; padding-left: 5px; padding-right: 5px; margin-bottom: 0px; background-color: #85B9F5; color: white;"> -->
                                                    <div class="card-title" style="position: absolute; top: -10px; border: 2px solid black; align-self: center; text-align: center; padding-left: 5px; padding-right: 5px; margin-bottom: 0px; background-color: white; color: #0d4a82;">
                                                        <b>
                                                            <p class="JudulGrafikPerbandingan" style="margin-bottom: 0px;"><?php echo $IndikatorTable[0]['nama_indikator']; ?> Nasional</p>
                                                        </b>
                                                    </div>
                                                    <div class="card-body" style="display: flex; padding: 1rem 0.5rem 0.5rem 0.5rem;">
                                                        <p class="deskripsiGrafikPerbandingan" style="font-family: 'Monda', sans-serif; font-size: 12px; margin: 0px; color: #0d4a82;">
                                                            <!-- Capaian <?php echo $IndikatorTable[0]['nama_indikator']; ?> Nasional pada <?php echo strftime("%B", mktime(0, 0, 0, $infographnasional[5]['periode'])); ?> <?php echo $infographnasional[5]['tahun'] ?> berada <?php echo $status_capaian; ?> capaian pada <?php echo strftime("%B", mktime(0, 0, 0, $infographnasional[4]['periode'])); ?> <?php echo $infographnasional[4]['tahun'] ?>. Capaian <?php echo $IndikatorTable[0]['nama_indikator']; ?> Nasional pada <?php echo strftime("%B", mktime(0, 0, 0, $infographnasional[5]['periode'])); ?> <?php echo $infographnasional[5]['tahun'] ?> sebesar <?php echo $nilainasional5 ?> -->
                                                            <?php echo $deskripsi_indikator ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 order-md-7" style="margin-top: 10px;">

                                                <div id="accordion">
                                                    <div class="card" style="border: 2px solid black;">
                                                        <div class="card-header collapsed py-1" id="headingOne" style="background-color: greenyellow; border-bottom: 2px solid black;">
                                                            <h5 class="mb-0">
                                                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="padding: 0px; color: black;">
                                                                    Ubah Deskripsi Indikator
                                                                </button>
                                                                <i data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" class="icon-collapse-indikator-deskripsi fa fa-angle-down float-right"></i>
                                                            </h5>
                                                        </div>

                                                        <div id="collapseOne" class="collapse hide" aria-labelledby="headingOne" data-parent="#accordion">
                                                            <div class="card-body" style="padding: 10px;">
                                                                <div style="margin-bottom: 5px;">
                                                                    <button class="buttons-indikator" style="margin: 5px; margin-top: 0px;" value="[nama indikator]"><?php echo $IndikatorTable[0]['nama_indikator']; ?></button>
                                                                    <button class="buttons-indikator" style="margin: 5px; margin-top: 0px;" value="[bulan - tahun ini]"><?php echo strftime("%B", mktime(0, 0, 0, $infographnasional[5]['periode'])); ?> <?php echo $infographnasional[5]['tahun'] ?></button>
                                                                    <button class="buttons-indikator" style="margin: 5px; margin-top: 0px;" value="[bulan - 1 tahun lalu]"><?php echo strftime("%B", mktime(0, 0, 0, $infographnasional[4]['periode'])); ?> <?php echo $infographnasional[4]['tahun'] ?></button>
                                                                    <button class="buttons-indikator" style="margin: 5px; margin-top: 0px;" value="[nilai saat ini]">Nilai saat ini</button>
                                                                    <button class="buttons-indikator" style="margin: 5px; margin-top: 0px;" value="[sparator tahun ini dengan tahun sebelumnya]">Separator [diatas/dibawah/sama dengan] tahun ini dengan 1 tahun sebelumnya</button>
                                                                </div>
                                                                <form id="form-indicator-description">
                                                                    <input type="hidden" id="id-deskripsi-indikator" name="id_indikator" value="<?php echo $IndikatorTable[0]['id'] ?>">
                                                                    <input type="hidden" id="id-wilayah-indikator" name="wilayah" value="<?php echo $wilayah ?>">
                                                                    <input type="hidden" id="id-keterangan-indikator" name="keterangan" value="Deskripsi 1">
                                                                    <textarea rows="5" cols="100" class="txt-area-indikator" required><?php echo ($description != null ? $description[0]->deskripsi : '') ?></textarea>
                                                            </div>
                                                            <div class="card-footer" style="text-align: right;">
                                                                <button type="button" class="btn btn-outline-danger btn-sm" id="btn-cancel-deskripsi-indikator" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Cancel</button>
                                                                <button type="button" class="btn btn-outline-primary btn-sm" id="btn-save-deskripsi-indikator">Save</button>
                                                            </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        <?php } elseif ($wilayah == 'provinsi') { ?>
                                            <?php
                                            if ($infographprovinsi[5]['satuan'] == '%') {
                                                $nilainasional1 = round($infographprovinsi[1]['nasional'], 2);
                                                $nilainasional2 = round($infographprovinsi[2]['nasional'], 2);
                                                $nilainasional3 = round($infographprovinsi[3]['nasional'], 2);
                                                $nilainasional4 = round($infographprovinsi[4]['nasional'], 2);
                                                $nilainasional5 = round($infographprovinsi[5]['nasional'], 2);

                                                $nilaiprovinsi1 = round($infographprovinsi[1]['nilai'], 2);
                                                $nilaiprovinsi2 = round($infographprovinsi[2]['nilai'], 2);
                                                $nilaiprovinsi3 = round($infographprovinsi[3]['nilai'], 2);
                                                $nilaiprovinsi4 = round($infographprovinsi[4]['nilai'], 2);
                                                $nilaiprovinsi5 = round($infographprovinsi[5]['nilai'], 2);
                                            } elseif ($infographprovinsi[5]['satuan'] == 'Rp') {
                                                $nilainasional1 = number_format($infographprovinsi[1]['nasional'], 0, ',', '.');
                                                $nilainasional2 = number_format($infographprovinsi[2]['nasional'], 0, ',', '.');
                                                $nilainasional3 = number_format($infographprovinsi[3]['nasional'], 0, ',', '.');
                                                $nilainasional4 = number_format($infographprovinsi[4]['nasional'], 0, ',', '.');
                                                $nilainasional5 = number_format($infographprovinsi[5]['nasional'], 0, ',', '.');

                                                $nilaiprovinsi1 = number_format($infographprovinsi[1]['nilai'], 0, ',', '.');
                                                $nilaiprovinsi2 = number_format($infographprovinsi[2]['nilai'], 0, ',', '.');
                                                $nilaiprovinsi3 = number_format($infographprovinsi[3]['nilai'], 0, ',', '.');
                                                $nilaiprovinsi4 = number_format($infographprovinsi[4]['nilai'], 0, ',', '.');
                                                $nilaiprovinsi5 = number_format($infographprovinsi[5]['nilai'], 0, ',', '.');
                                            } elseif ($infographprovinsi[5]['satuan'] == 'Orang') {
                                                $nilainasional1 = number_format($infographprovinsi[1]['nasional'], 0, ',', '.');
                                                $nilainasional2 = number_format($infographprovinsi[2]['nasional'], 0, ',', '.');
                                                $nilainasional3 = number_format($infographprovinsi[3]['nasional'], 0, ',', '.');
                                                $nilainasional4 = number_format($infographprovinsi[4]['nasional'], 0, ',', '.');
                                                $nilainasional5 = number_format($infographprovinsi[5]['nasional'], 0, ',', '.');

                                                $nilaiprovinsi1 = number_format($infographprovinsi[1]['nilai'], 0, ',', '.');
                                                $nilaiprovinsi2 = number_format($infographprovinsi[2]['nilai'], 0, ',', '.');
                                                $nilaiprovinsi3 = number_format($infographprovinsi[3]['nilai'], 0, ',', '.');
                                                $nilaiprovinsi4 = number_format($infographprovinsi[4]['nilai'], 0, ',', '.');
                                                $nilaiprovinsi5 = number_format($infographprovinsi[5]['nilai'], 0, ',', '.');
                                            } else {
                                                $nilainasional1 = $infographprovinsi[1]['nasional'];
                                                $nilainasional2 = $infographprovinsi[2]['nasional'];
                                                $nilainasional3 = $infographprovinsi[3]['nasional'];
                                                $nilainasional4 = $infographprovinsi[4]['nasional'];
                                                $nilainasional5 = $infographprovinsi[5]['nasional'];

                                                $nilaiprovinsi1 = $infographprovinsi[1]['nilai'];
                                                $nilaiprovinsi2 = $infographprovinsi[2]['nilai'];
                                                $nilaiprovinsi3 = $infographprovinsi[3]['nilai'];
                                                $nilaiprovinsi4 = $infographprovinsi[4]['nilai'];
                                                $nilaiprovinsi5 = $infographprovinsi[5]['nilai'];
                                            }
                                            ?>
                                            <div class="col-md-12 order-md-5" style="margin-bottom: 10px;">
                                                <table class="table table-bordered table-hover">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th><b>Wilayah</b></th>
                                                            <th>
                                                                <center><b><?php echo strftime("%B", mktime(0, 0, 0, $infographprovinsi[1]['periode'])); ?> - <?php echo $infographprovinsi[1]['tahun'] ?></b></center>
                                                            </th>
                                                            <th>
                                                                <center><b><?php echo strftime("%B", mktime(0, 0, 0, $infographprovinsi[2]['periode'])); ?> - <?php echo $infographprovinsi[2]['tahun'] ?></b></center>
                                                            </th>
                                                            <th>
                                                                <center><b><?php echo strftime("%B", mktime(0, 0, 0, $infographprovinsi[3]['periode'])); ?> - <?php echo $infographprovinsi[3]['tahun'] ?></b></center>
                                                            </th>
                                                            <th>
                                                                <center><b><?php echo strftime("%B", mktime(0, 0, 0, $infographprovinsi[4]['periode'])); ?> - <?php echo $infographprovinsi[4]['tahun'] ?></b></center>
                                                            </th>
                                                            <th>
                                                                <center><b><?php echo strftime("%B", mktime(0, 0, 0, $infographprovinsi[5]['periode'])); ?> - <?php echo $infographprovinsi[5]['tahun'] ?></b></center>
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td><b>Nasional</b></td>
                                                            <td>
                                                                <center><?php echo $nilainasional1 ?></center>
                                                            </td>
                                                            <td>
                                                                <center><?php echo $nilainasional2 ?></center>
                                                            </td>
                                                            <td>
                                                                <center><?php echo $nilainasional3 ?></center>
                                                            </td>
                                                            <td>
                                                                <center><?php echo $nilainasional4 ?></center>
                                                            </td>
                                                            <td>
                                                                <center><?php echo $nilainasional5 ?></center>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><b><?php echo $subWilayah[0]['nama_provinsi'] ?></b></td>
                                                            <td>
                                                                <center><?php echo $nilaiprovinsi1 ?></center>
                                                            </td>
                                                            <td>
                                                                <center><?php echo $nilaiprovinsi2 ?></center>
                                                            </td>
                                                            <td>
                                                                <center><?php echo $nilaiprovinsi3 ?></center>
                                                            </td>
                                                            <td>
                                                                <center><?php echo $nilaiprovinsi4 ?></center>
                                                            </td>
                                                            <td>
                                                                <center><?php echo $nilaiprovinsi5 ?></center>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="col-md-12 order-md-5">
                                                <!-- <div class="card" style="border: 2px solid black; background-color: #3E86DA; margin-bottom: 20px;"> -->
                                                <div class="card" style="border: 2px solid black; background-color: white; margin-bottom: 10px;">
                                                    <!-- <div class="card-title" style="width: 80%; position: absolute; top: -12px; border: 2px solid black; align-self: center; text-align: center; padding-left: 5px; padding-right: 5px; margin-bottom: 0px; background-color: #85B9F5; color: white;"> -->
                                                    <div class="card-title" style="width: 80%; position: absolute; top: -12px; border: 2px solid black; align-self: center; text-align: center; padding-left: 5px; padding-right: 5px; margin-bottom: 0px; background-color: white; color: #0d4a82;">
                                                        <!-- <div class="card-title" style="width: 80%; position: absolute; top: -12px; border: 2px solid black; align-self: center; text-align: center; padding-left: 5px; padding-right: 5px; margin-bottom: 0px; color: #0d4a82;"> -->
                                                        <p class="JudulGrafikPerbandingan" style="margin-bottom: 0px;"><b>Perbandingan <?php echo $IndikatorTable[0]['nama_indikator']; ?> <?php echo ($wilayah == "provinsi" ? "Nasional dengan Provinsi" : "Nasional"); ?> </b></p>
                                                    </div>
                                                    <div class="card-body" style="display: flex; padding: 1rem 0.5rem 0.5rem 0.5rem;">
                                                        <p class="deskripsiGrafikPerbandingan" style="font-family: 'Monda', sans-serif; font-size: 12px; margin: 0px; color: #0d4a82;">
                                                            <!-- <?php echo $IndikatorTable[0]['nama_indikator']; ?> <?php echo $subWilayah[0]['nama_provinsi']; ?> pada <?php echo strftime("%B", mktime(0, 0, 0, $infographprovinsi[5]['periode'])); ?> <?php echo $infographprovinsi[5]['tahun'] ?> <?php echo $status_capaian; ?> dibandingkan dengan <?php echo strftime("%B", mktime(0, 0, 0, $infographprovinsi[4]['periode'])); ?> <?php echo $infographprovinsi[4]['tahun'] ?>. Pada <?php echo strftime("%B", mktime(0, 0, 0, $infographprovinsi[5]['periode'])); ?> <?php echo $infographprovinsi[5]['tahun'] ?> <?php echo $IndikatorTable[0]['nama_indikator']; ?> <?php echo $subWilayah[0]['nama_provinsi']; ?> adalah sebesar <?php echo $nilaiprovinsi5; ?>, sedangkan pada <?php echo strftime("%B", mktime(0, 0, 0, $infographprovinsi[4]['periode'])); ?> <?php echo $infographprovinsi[4]['tahun'] ?> pertumbuhannya tercatat sebesar <?php echo $nilaiprovinsi4; ?>. -->
                                                            <?php echo $deskripsi_indikator ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 order-md-6" style="margin-bottom: 20px;">

                                                <div id="accordion">
                                                    <div class="card" style="border: 2px solid black;">
                                                        <div class="card-header collapsed py-1" id="headingOne" style="background-color: greenyellow; border-bottom: 2px solid black;">
                                                            <h5 class="mb-0">
                                                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="padding: 0px; color: black;">
                                                                    Ubah Deskripsi Indikator
                                                                </button>
                                                                <i data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" class="icon-collapse-indikator-deskripsi fa fa-angle-down float-right"></i>
                                                            </h5>
                                                        </div>

                                                        <div id="collapseOne" class="collapse hide" aria-labelledby="headingOne" data-parent="#accordion">
                                                            <div class="card-body" style="padding: 10px;">
                                                                <div style="margin-bottom: 5px;">
                                                                    <button class="buttons-indikator" style="margin: 5px; margin-top: 0px;" value="[nama indikator]"><?php echo $IndikatorTable[0]['nama_indikator']; ?></button>
                                                                    <button class="buttons-indikator" style="margin: 5px; margin-top: 0px;" value="[nama daerah]">Nama Daerah</button>
                                                                    <button class="buttons-indikator" style="margin: 5px; margin-top: 0px;" value="[bulan - tahun ini]"><?php echo strftime("%B", mktime(0, 0, 0, $infographprovinsi[5]['periode'])); ?> <?php echo $infographprovinsi[5]['tahun'] ?></button>
                                                                    <button class="buttons-indikator" style="margin: 5px; margin-top: 0px;" value="[bulan - 1 tahun lalu]"><?php echo strftime("%B", mktime(0, 0, 0, $infographprovinsi[4]['periode'])); ?> <?php echo $infographprovinsi[4]['tahun'] ?></button>
                                                                    <button class="buttons-indikator" style="margin: 5px; margin-top: 0px;" value="[nilai saat ini]">Nilai saat ini</button>
                                                                    <button class="buttons-indikator" style="margin: 5px; margin-top: 0px;" value="[nilai 1 tahun sebelumnya]">Nilai 1 tahun sebelumnya</button>
                                                                    <button class="buttons-indikator" style="margin: 5px; margin-top: 0px;" value="[sparator tahun ini dengan tahun sebelumnya]">Separator [diatas/dibawah/sama dengan] tahun ini dengan 1 tahun sebelumnya</button>
                                                                </div>
                                                                <form id="form-indicator-description">
                                                                    <input type="hidden" id="id-deskripsi-indikator" name="id_indikator" value="<?php echo $IndikatorTable[0]['id'] ?>">
                                                                    <input type="hidden" id="id-wilayah-indikator" name="wilayah" value="<?php echo $wilayah ?>">
                                                                    <input type="hidden" id="id-kode-sub-wilayah-indikator" name="kodeSubWilayah" value="<?php echo $subWilayah[0]['id'] ?>">
                                                                    <input type="hidden" id="id-keterangan-indikator" name="keterangan" value="Deskripsi 1">
                                                                    <textarea rows="5" cols="100" class="txt-area-indikator" required><?php echo ($description != null ? $description[0]->deskripsi : '') ?></textarea>
                                                            </div>
                                                            <div class="card-footer" style="text-align: right;">
                                                                <button type="button" class="btn btn-outline-danger btn-sm" id="btn-cancel-deskripsi-indikator" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Cancel</button>
                                                                <button type="button" class="btn btn-outline-primary btn-sm" id="btn-save-deskripsi-indikator">Save</button>
                                                            </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        <?php } elseif ($wilayah == 'kabupatenkota') { ?>
                                            <?php
                                            if ($infographprovinsi[5]['satuan'] == '%') {
                                                $nilainasional1 = round($infographprovinsi[1]['nasional'], 2);
                                                $nilainasional2 = round($infographprovinsi[2]['nasional'], 2);
                                                $nilainasional3 = round($infographprovinsi[3]['nasional'], 2);
                                                $nilainasional4 = round($infographprovinsi[4]['nasional'], 2);
                                                $nilainasional5 = round($infographprovinsi[5]['nasional'], 2);

                                                $nilaiprovinsi1 = round($infographprovinsi[1]['nilai'], 2);
                                                $nilaiprovinsi2 = round($infographprovinsi[2]['nilai'], 2);
                                                $nilaiprovinsi3 = round($infographprovinsi[3]['nilai'], 2);
                                                $nilaiprovinsi4 = round($infographprovinsi[4]['nilai'], 2);
                                                $nilaiprovinsi5 = round($infographprovinsi[5]['nilai'], 2);

                                                $nilaikabupatenkota1 = round($infographkabupatenkota[1]['nilai'], 2);
                                                $nilaikabupatenkota2 = round($infographkabupatenkota[2]['nilai'], 2);
                                                $nilaikabupatenkota3 = round($infographkabupatenkota[3]['nilai'], 2);
                                                $nilaikabupatenkota4 = round($infographkabupatenkota[4]['nilai'], 2);
                                                $nilaikabupatenkota5 = round($infographkabupatenkota[5]['nilai'], 2);
                                            } elseif ($infographprovinsi[5]['satuan'] == 'Rp') {
                                                $nilainasional1 = number_format($infographprovinsi[1]['nasional'], 0, ',', '.');
                                                $nilainasional2 = number_format($infographprovinsi[2]['nasional'], 0, ',', '.');
                                                $nilainasional3 = number_format($infographprovinsi[3]['nasional'], 0, ',', '.');
                                                $nilainasional4 = number_format($infographprovinsi[4]['nasional'], 0, ',', '.');
                                                $nilainasional5 = number_format($infographprovinsi[5]['nasional'], 0, ',', '.');

                                                $nilaiprovinsi1 = number_format($infographprovinsi[1]['nilai'], 0, ',', '.');
                                                $nilaiprovinsi2 = number_format($infographprovinsi[2]['nilai'], 0, ',', '.');
                                                $nilaiprovinsi3 = number_format($infographprovinsi[3]['nilai'], 0, ',', '.');
                                                $nilaiprovinsi4 = number_format($infographprovinsi[4]['nilai'], 0, ',', '.');
                                                $nilaiprovinsi5 = number_format($infographprovinsi[5]['nilai'], 0, ',', '.');

                                                $nilaikabupatenkota1 = number_format($infographkabupatenkota[1]['nilai'], 0, ',', '.');
                                                $nilaikabupatenkota2 = number_format($infographkabupatenkota[2]['nilai'], 0, ',', '.');
                                                $nilaikabupatenkota3 = number_format($infographkabupatenkota[3]['nilai'], 0, ',', '.');
                                                $nilaikabupatenkota4 = number_format($infographkabupatenkota[4]['nilai'], 0, ',', '.');
                                                $nilaikabupatenkota5 = number_format($infographkabupatenkota[5]['nilai'], 0, ',', '.');
                                            } elseif ($infographprovinsi[5]['satuan'] == 'Orang') {
                                                $nilainasional1 = number_format($infographprovinsi[1]['nasional'], 0, ',', '.');
                                                $nilainasional2 = number_format($infographprovinsi[2]['nasional'], 0, ',', '.');
                                                $nilainasional3 = number_format($infographprovinsi[3]['nasional'], 0, ',', '.');
                                                $nilainasional4 = number_format($infographprovinsi[4]['nasional'], 0, ',', '.');
                                                $nilainasional5 = number_format($infographprovinsi[5]['nasional'], 0, ',', '.');

                                                $nilaiprovinsi1 = number_format($infographprovinsi[1]['nilai'], 0, ',', '.');
                                                $nilaiprovinsi2 = number_format($infographprovinsi[2]['nilai'], 0, ',', '.');
                                                $nilaiprovinsi3 = number_format($infographprovinsi[3]['nilai'], 0, ',', '.');
                                                $nilaiprovinsi4 = number_format($infographprovinsi[4]['nilai'], 0, ',', '.');
                                                $nilaiprovinsi5 = number_format($infographprovinsi[5]['nilai'], 0, ',', '.');

                                                $nilaikabupatenkota1 = number_format($infographkabupatenkota[1]['nilai'], 0, ',', '.');
                                                $nilaikabupatenkota2 = number_format($infographkabupatenkota[2]['nilai'], 0, ',', '.');
                                                $nilaikabupatenkota3 = number_format($infographkabupatenkota[3]['nilai'], 0, ',', '.');
                                                $nilaikabupatenkota4 = number_format($infographkabupatenkota[4]['nilai'], 0, ',', '.');
                                                $nilaikabupatenkota5 = number_format($infographkabupatenkota[5]['nilai'], 0, ',', '.');
                                            } else {
                                                $nilainasional1 = $infographprovinsi[1]['nasional'];
                                                $nilainasional2 = $infographprovinsi[2]['nasional'];
                                                $nilainasional3 = $infographprovinsi[3]['nasional'];
                                                $nilainasional4 = $infographprovinsi[4]['nasional'];
                                                $nilainasional5 = $infographprovinsi[5]['nasional'];

                                                $nilaiprovinsi1 = $infographprovinsi[1]['nilai'];
                                                $nilaiprovinsi2 = $infographprovinsi[2]['nilai'];
                                                $nilaiprovinsi3 = $infographprovinsi[3]['nilai'];
                                                $nilaiprovinsi4 = $infographprovinsi[4]['nilai'];
                                                $nilaiprovinsi5 = $infographprovinsi[5]['nilai'];

                                                $nilaikabupatenkota1 = $infographkabupatenkota[1]['nilai'];
                                                $nilaikabupatenkota2 = $infographkabupatenkota[2]['nilai'];
                                                $nilaikabupatenkota3 = $infographkabupatenkota[3]['nilai'];
                                                $nilaikabupatenkota4 = $infographkabupatenkota[4]['nilai'];
                                                $nilaikabupatenkota5 = $infographkabupatenkota[5]['nilai'];
                                            }
                                            ?>
                                            <div class="col-md-12 order-md-5" style="margin-bottom: 10px;">
                                                <table class="table table-bordered table-hover">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th><b>Wilayah</b></th>
                                                            <th>
                                                                <center><b><?php echo strftime("%B", mktime(0, 0, 0, $infographprovinsi[1]['periode'])); ?> - <?php echo $infographprovinsi[1]['tahun'] ?></b></center>
                                                            </th>
                                                            <th>
                                                                <center><b><?php echo strftime("%B", mktime(0, 0, 0, $infographprovinsi[2]['periode'])); ?> - <?php echo $infographprovinsi[2]['tahun'] ?></b></center>
                                                            </th>
                                                            <th>
                                                                <center><b><?php echo strftime("%B", mktime(0, 0, 0, $infographprovinsi[3]['periode'])); ?> - <?php echo $infographprovinsi[3]['tahun'] ?></b></center>
                                                            </th>
                                                            <th>
                                                                <center><b><?php echo strftime("%B", mktime(0, 0, 0, $infographprovinsi[4]['periode'])); ?> - <?php echo $infographprovinsi[4]['tahun'] ?></b></center>
                                                            </th>
                                                            <th>
                                                                <center><b><?php echo strftime("%B", mktime(0, 0, 0, $infographprovinsi[5]['periode'])); ?> - <?php echo $infographprovinsi[5]['tahun'] ?></b></center>
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td><b>Nasional</b></td>
                                                            <td>
                                                                <center><?php echo $nilainasional1 ?></center>
                                                            </td>
                                                            <td>
                                                                <center><?php echo $nilainasional2 ?></center>
                                                            </td>
                                                            <td>
                                                                <center><?php echo $nilainasional3 ?></center>
                                                            </td>
                                                            <td>
                                                                <center><?php echo $nilainasional4 ?></center>
                                                            </td>
                                                            <td>
                                                                <center><?php echo $nilainasional5 ?></center>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><b><?php echo $subWilayah[0]['nama_provinsi'] ?></b></td>
                                                            <td>
                                                                <center><?php echo $nilaiprovinsi1 ?></center>
                                                            </td>
                                                            <td>
                                                                <center><?php echo $nilaiprovinsi2 ?></center>
                                                            </td>
                                                            <td>
                                                                <center><?php echo $nilaiprovinsi3 ?></center>
                                                            </td>
                                                            <td>
                                                                <center><?php echo $nilaiprovinsi4 ?></center>
                                                            </td>
                                                            <td>
                                                                <center><?php echo $nilaiprovinsi5 ?></center>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><b><?php echo $subWilayahDaerah[0]['nama_kabupaten'] ?></b></td>
                                                            <td>
                                                                <center>
                                                                    <?php
                                                                    if ($infographprovinsi[1]['id_periode'] == $infographkabupatenkota[1]['id_periode']) {
                                                                        echo $nilaikabupatenkota1;
                                                                    } elseif ($infographprovinsi[1]['id_periode'] == $infographkabupatenkota[2]['id_periode']) {
                                                                        echo $nilaikabupatenkota1;
                                                                    } else {
                                                                        echo '';
                                                                    }
                                                                    ?>
                                                                </center>
                                                            </td>
                                                            <td>
                                                                <center>
                                                                    <?php
                                                                    if ($infographprovinsi[2]['id_periode'] == $infographkabupatenkota[2]['id_periode']) {
                                                                        echo $nilaikabupatenkota2;
                                                                    } elseif ($infographprovinsi[2]['id_periode'] == $infographkabupatenkota[3]['id_periode']) {
                                                                        echo $nilaikabupatenkota3;
                                                                    } else {
                                                                        echo '';
                                                                    }
                                                                    ?>
                                                                </center>
                                                            </td>
                                                            <td>
                                                                <center>
                                                                    <?php
                                                                    if ($infographprovinsi[3]['id_periode'] == $infographkabupatenkota[3]['id_periode']) {
                                                                        echo $nilaikabupatenkota3;
                                                                    } elseif ($infographprovinsi[3]['id_periode'] == $infographkabupatenkota[4]['id_periode']) {
                                                                        echo $nilaikabupatenkota4;
                                                                    } else {
                                                                        echo '';
                                                                    }
                                                                    ?>
                                                                </center>
                                                            </td>
                                                            <td>
                                                                <center>
                                                                    <?php
                                                                    if ($infographprovinsi[4]['id_periode'] == $infographkabupatenkota[4]['id_periode']) {
                                                                        echo $nilaikabupatenkota4;
                                                                    } elseif ($infographprovinsi[4]['id_periode'] == $infographkabupatenkota[5]['id_periode']) {
                                                                        echo $nilaikabupatenkota5;
                                                                    } else {
                                                                        echo '';
                                                                    }
                                                                    ?>
                                                                </center>
                                                            </td>
                                                            <td>
                                                                <center>
                                                                    <?php
                                                                    if ($infographprovinsi[5]['id_periode'] == $infographkabupatenkota[5]['id_periode']) {
                                                                        echo $nilaikabupatenkota5;
                                                                    } else {
                                                                        echo '';
                                                                    }
                                                                    ?>
                                                                </center>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="col-md-12 order-md-6">
                                                <!-- <div class="card" style="border: 2px solid black; background-color: #3E86DA; margin-bottom: 20px;"> -->
                                                <div class="card" style="border: 2px solid black; background-color: white; margin-bottom: 10px;">
                                                    <!-- <div class="card-title" style="width: 80%; position: absolute; top: -12px; border: 2px solid black; align-self: center; text-align: center; padding-left: 5px; padding-right: 5px; margin-bottom: 0px; background-color: #85B9F5; color: white;"> -->
                                                    <div class="card-title" style="width: 80%; position: absolute; top: -12px; border: 2px solid black; align-self: center; text-align: center; padding-left: 5px; padding-right: 5px; margin-bottom: 0px; background-color: white; color: #0d4a82;">
                                                        <b>
                                                            <p class="JudulGrafikPerbandingan" style="margin-bottom: 0px;">Perbandingan <?php echo $IndikatorTable[0]['nama_indikator']; ?> <?php if ($wilayah == 'nasional') {
                                                                                                                                                                                                echo 'Nasional';
                                                                                                                                                                                            } elseif ($wilayah == 'provinsi') {
                                                                                                                                                                                                echo 'Nasional dengan Provinsi';
                                                                                                                                                                                            } elseif ($wilayah == 'kabupatenkota') {
                                                                                                                                                                                                echo 'Nasional dengan Daerah';
                                                                                                                                                                                            } ?> </p>
                                                        </b>
                                                    </div>
                                                    <div class="card-body" style="display: flex; padding: 1rem 0.5rem 0.5rem 0.5rem;">
                                                        <p class="deskripsiGrafikPerbandingan" style="font-family: 'Monda', sans-serif; font-size: 12px; margin: 0px; color: #0d4a82;">
                                                            <!-- <?php echo $IndikatorTable[0]['nama_indikator']; ?> <?php echo $subWilayahDaerah[0]['nama_kabupaten']; ?> pada <?php echo strftime("%B", mktime(0, 0, 0, $infographkabupatenkota[5]['periode'])); ?> <?php echo $infographkabupatenkota[5]['tahun'] ?> <?php echo $status_capaian; ?> dibandingkan dengan <?php echo strftime("%B", mktime(0, 0, 0, $infographkabupatenkota[4]['periode'])); ?> <?php echo $infographkabupatenkota[4]['tahun'] ?>. Pada <?php echo strftime("%B", mktime(0, 0, 0, $infographkabupatenkota[5]['periode'])); ?> <?php echo $infographkabupatenkota[5]['tahun'] ?> <?php echo $IndikatorTable[0]['nama_indikator']; ?> <?php echo $subWilayahDaerah[0]['nama_kabupaten']; ?> adalah sebesar <?php echo $nilaikabupatenkota5; ?>, sedangkan pada <?php echo strftime("%B", mktime(0, 0, 0, $infographkabupatenkota[4]['periode'])); ?> <?php echo $infographkabupatenkota[4]['tahun'] ?> pertumbuhannya tercatat sebesar <?php echo $nilaikabupatenkota4 ?>. -->
                                                            <?php echo $deskripsi_indikator ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 order-md-7" style="margin-bottom: 20px;">

                                                <div id="accordion">
                                                    <div class="card" style="border: 2px solid black;">
                                                        <div class="card-header collapsed py-1" id="headingOne" style="background-color: greenyellow; border-bottom: 2px solid black;">
                                                            <h5 class="mb-0">
                                                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="padding: 0px; color: black;">
                                                                    Ubah Deskripsi Indikator
                                                                </button>
                                                                <i data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" class="icon-collapse-indikator-deskripsi fa fa-angle-down float-right"></i>
                                                            </h5>
                                                        </div>

                                                        <div id="collapseOne" class="collapse hide" aria-labelledby="headingOne" data-parent="#accordion">
                                                            <div class="card-body" style="padding: 10px;">
                                                                <div style="margin-bottom: 5px;">
                                                                    <button class="buttons-indikator" style="margin: 5px; margin-top: 0px;" value="[nama indikator]"><?php echo $IndikatorTable[0]['nama_indikator']; ?></button>
                                                                    <button class="buttons-indikator" style="margin: 5px; margin-top: 0px;" value="[nama daerah]">Nama Daerah</button>
                                                                    <button class="buttons-indikator" style="margin: 5px; margin-top: 0px;" value="[bulan - tahun ini]"><?php echo strftime("%B", mktime(0, 0, 0, $infographkabupatenkota[5]['periode'])); ?> <?php echo $infographkabupatenkota[5]['tahun'] ?></button>
                                                                    <button class="buttons-indikator" style="margin: 5px; margin-top: 0px;" value="[bulan - 1 tahun lalu]"><?php echo strftime("%B", mktime(0, 0, 0, $infographkabupatenkota[4]['periode'])); ?> <?php echo $infographkabupatenkota[4]['tahun'] ?></button>
                                                                    <button class="buttons-indikator" style="margin: 5px; margin-top: 0px;" value="[nilai saat ini]">Nilai saat ini</button>
                                                                    <button class="buttons-indikator" style="margin: 5px; margin-top: 0px;" value="[nilai 1 tahun sebelumnya]">Nilai 1 tahun sebelumnya</button>
                                                                    <button class="buttons-indikator" style="margin: 5px; margin-top: 0px;" value="[sparator tahun ini dengan tahun sebelumnya]">Separator [diatas/dibawah/sama dengan] tahun ini dengan 1 tahun sebelumnya</button>
                                                                </div>
                                                                <form id="form-indicator-description">
                                                                    <input type="hidden" id="id-deskripsi-indikator" name="id_indikator" value="<?php echo $IndikatorTable[0]['id'] ?>">
                                                                    <input type="hidden" id="id-wilayah-indikator" name="wilayah" value="<?php echo $wilayah ?>">
                                                                    <input type="hidden" id="id-kode-sub-wilayah-indikator" name="kodeSubWilayah" value="<?php echo $subWilayahDaerah[0]['id'] ?>">
                                                                    <input type="hidden" id="id-keterangan-indikator" name="keterangan" value="Deskripsi 1">
                                                                    <textarea rows="5" cols="100" class="txt-area-indikator" required><?php echo ($description != null ? $description[0]->deskripsi : '') ?></textarea>
                                                            </div>
                                                            <div class="card-footer" style="text-align: right;">
                                                                <button type="button" class="btn btn-outline-danger btn-sm" id="btn-cancel-deskripsi-indikator" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Cancel</button>
                                                                <button type="button" class="btn btn-outline-primary btn-sm" id="btn-save-deskripsi-indikator">Save</button>
                                                            </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        <?php } ?>

                                    </div>

                                    <?php if (isset($graphperbandinganwilayah) && ($graphperbandinganwilayah != null)) { ?>
                                        <?php if ($wilayah != 'nasional') { ?>
                                            <div class="row" style="margin: 10px; margin-top: 0px;">

                                                <div class="col-12 order-md-7">
                                                    <div class="card" style="height: 575px; margin-bottom: 10px;">
                                                        <div class="card-body" style="padding: 10px; padding-left: 3px;">
                                                            <script src="https://code.highcharts.com/highcharts.js"></script>
                                                            <script src="https://code.highcharts.com/highcharts-more.js"></script>
                                                            <script src="https://code.highcharts.com/modules/exporting.js"></script>
                                                            <script src="https://code.highcharts.com/modules/export-data.js"></script>
                                                            <script src="https://code.highcharts.com/modules/accessibility.js"></script>

                                                            <figure class="highcharts-figure">
                                                                <div id="container-3"></div>
                                                            </figure>
                                                        </div>
                                                        <div class="card-footer text-muted" style="padding-bottom: 0rem;">
                                                            <div class="col-lg-12">
                                                                <p style="margin-bottom: 0.2rem;"><b>Keterangan : </b></p>
                                                                <ul class="" style="padding-left: 10px; list-style-type:none;">
                                                                    <li><img src="<?= base_url(); ?>assets/images/img/menu-highchart.jpg" alt="Menu Highchart" style="width: 5%;" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;<em>Menu (klik untuk melihat menu grafik)</em></li>
                                                                    <li><img src="<?= base_url(); ?>assets/images/img/legenda.jpg" alt="Legenda" style="width: 10%;" />&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;<em>Legenda (klik nama daerah untuk menyembuyikan/menampilkan grafik)</em></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 order-md-8">
                                                    <table class="table table-bordered table-hover">
                                                        <thead class="thead-light">
                                                            <tr>
                                                                <th colspan="5">
                                                                    <center>TAHUN <?php echo $graphperbandinganwilayah[0]['tahun'] ?></center>
                                                                </th>
                                                            </tr>
                                                            <tr>
                                                                <th width="60%">
                                                                    <center>Wilayah</center>
                                                                </th>
                                                                <th width="10%">
                                                                    <center>Capaian</center>
                                                                </th>
                                                                <?php if ($wilayah == 'provinsi') { ?>
                                                                    <th width="10%">
                                                                        <center>Target RKPD</center>
                                                                    </th>
                                                                    <th width="10%">
                                                                        <center>Target RKP</center>
                                                                    </th>
                                                                    <th width="10%">
                                                                        <center>Target Kewilayahan RKP</center>
                                                                    </th>
                                                                <?php } ?>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            if (isset($graphperbandinganwilayah)) {
                                                                foreach ($graphperbandinganwilayah as $graphwil) { ?>
                                                                    <?php
                                                                    if ($wilayah == 'provinsi') {
                                                                        if ($graphwil['wilayah'] == $subWilayah[0]['id']) {
                                                                            $bg_table = 'background-color: antiquewhite';
                                                                        } else {
                                                                            $bg_table = '';
                                                                        }
                                                                    } elseif ($wilayah == 'kabupatenkota') {
                                                                        if ($graphwil['wilayah'] == $subWilayahDaerah[0]['id']) {
                                                                            $bg_table = 'background-color: antiquewhite';
                                                                        } else {
                                                                            $bg_table = '';
                                                                        }
                                                                    }
                                                                    ?>
                                                                    <tr style="<?php echo $bg_table; ?>">
                                                                        <td><?php echo $graphwil['nama_daerah'] ?></td>
                                                                        <td>
                                                                            <center>
                                                                                <?php
                                                                                if ($graphwil['satuan'] == '%') {
                                                                                    echo round($graphwil['nilai'], 2);
                                                                                } elseif ($graphwil['satuan'] == 'Rp') {
                                                                                    echo number_format($graphwil['nilai'], 0, ',', '.');
                                                                                } elseif ($graphwil['satuan'] == 'Orang') {
                                                                                    echo number_format($graphwil['nilai'], 0, ',', '.');
                                                                                } else {
                                                                                    echo $graphwil['nilai'];
                                                                                }
                                                                                ?>
                                                                            </center>
                                                                        </td>
                                                                        <?php if ($wilayah == 'provinsi') { ?>
                                                                            <td>
                                                                                <center>
                                                                                    <?php
                                                                                    if ($graphwil['satuan'] == '%') {
                                                                                        echo round($graphwil['t_rkpd'], 2);
                                                                                    } elseif ($graphwil['satuan'] == 'Rp') {
                                                                                        echo number_format($graphwil['t_rkpd'], 0, ',', '.');
                                                                                    } elseif ($graphwil['satuan'] == 'Orang') {
                                                                                        echo number_format($graphwil['t_rkpd'], 0, ',', '.');
                                                                                    } else {
                                                                                        echo $graphwil['t_rkpd'];
                                                                                    }
                                                                                    ?>
                                                                                </center>
                                                                            </td>
                                                                            <td>
                                                                                <center>
                                                                                    <?php
                                                                                    if ($graphwil['satuan'] == '%') {
                                                                                        echo round($graphwil['target'], 2);
                                                                                    } elseif ($graphwil['satuan'] == 'Rp') {
                                                                                        echo number_format($graphwil['target'], 0, ',', '.');
                                                                                    } elseif ($graphwil['satuan'] == 'Orang') {
                                                                                        echo number_format($graphwil['target'], 0, ',', '.');
                                                                                    } else {
                                                                                        echo $graphwil['target'];
                                                                                    }
                                                                                    ?>
                                                                                </center>
                                                                            </td>
                                                                            <td>
                                                                                <center>
                                                                                    <?php
                                                                                    if ($graphwil['satuan'] == '%') {
                                                                                        echo round($graphwil['t_k_rkp'], 2);
                                                                                    } elseif ($graphwil['satuan'] == 'Rp') {
                                                                                        echo number_format($graphwil['t_k_rkp'], 0, ',', '.');
                                                                                    } elseif ($graphwil['satuan'] == 'Orang') {
                                                                                        echo number_format($graphwil['t_k_rkp'], 0, ',', '.');
                                                                                    } else {
                                                                                        echo $graphwil['t_k_rkp'];
                                                                                    }
                                                                                    ?>
                                                                                </center>
                                                                            </td>
                                                                        <?php } ?>
                                                                    </tr>
                                                            <?php }
                                                            } ?>
                                                            <?php if ($wilayah == 'kabupatenkota') { ?>
                                                                <tr style="background-color: #E9ECEF;">
                                                                    <td><b><?php echo $subWilayah[0]['nama_provinsi'] ?></b></td>
                                                                    <td>
                                                                        <center>
                                                                            <?php
                                                                            if ($graphperbandinganwilayah[0]['satuan'] == '%') {
                                                                                echo round($infographprovinsi[5]['nilai'], 2);
                                                                            } elseif ($graphperbandinganwilayah[0]['satuan'] == 'Rp') {
                                                                                echo number_format($infographprovinsi[5]['nilai'], 0, ',', '.');
                                                                            } elseif ($graphperbandinganwilayah[0]['satuan'] == 'Orang') {
                                                                                echo number_format($infographprovinsi[5]['nilai'], 0, ',', '.');
                                                                            } else {
                                                                                echo $infographprovinsi[5]['nilai'];
                                                                            }
                                                                            ?>
                                                                        </center>
                                                                    </td>
                                                                </tr>
                                                            <?php } ?>
                                                            <tr style="background-color: #E9ECEF;">
                                                                <td><b>Indonesia</b></td>
                                                                <td>
                                                                    <center>
                                                                        <?php
                                                                        if ($graphperbandinganwilayah[0]['satuan'] == '%') {
                                                                            echo round($graphperbandinganwilayah[0]['nasional'], 2);
                                                                        } elseif ($graphperbandinganwilayah[0]['satuan'] == 'Rp') {
                                                                            echo number_format($graphperbandinganwilayah[0]['nasional'], 0, ',', '.');
                                                                        } elseif ($graphperbandinganwilayah[0]['satuan'] == 'Orang') {
                                                                            echo number_format($graphperbandinganwilayah[0]['nasional'], 0, ',', '.');
                                                                        } else {
                                                                            echo $graphperbandinganwilayah[0]['nasional'];
                                                                        }
                                                                        ?>
                                                                    </center>
                                                                </td>
                                                                <?php if ($wilayah != 'kabupatenkota') { ?>
                                                                    <td colspan="3">
                                                                    </td>
                                                                <?php } ?>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>

                                                <div class="col-12 order-md-9">
                                                    <div class="card" style="border: 2px solid black; border-radius: 5px 15px 5px 15px; margin-bottom: 20px;">
                                                        <div class="card-body" style="display: flex; padding: 0.5rem 0.5rem 0.5rem 0.5rem;">
                                                            <p class="deskripsiGrafikPerbandingan2" style="font-family: 'Monda', sans-serif; font-size: 12px; margin: 0px;">
                                                                <?php echo $deskripsi_indikator2 ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 order-md-10" style="margin-bottom: 20px;">

                                                    <div id="accordionTwo">
                                                        <div class="card" style="border: 2px solid black;">
                                                            <div class="card-header collapsed py-1" id="headingTwo" style="background-color: greenyellow; border-bottom: 2px solid black;">
                                                                <h5 class="mb-0">
                                                                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo" style="padding: 0px; color: black;">
                                                                        Ubah Deskripsi Indikator 2
                                                                    </button>
                                                                    <i data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo" class="icon-collapse-indikator-deskripsi-2 fa fa-angle-down float-right"></i>
                                                                </h5>
                                                            </div>

                                                            <div id="collapseTwo" class="collapse hide" aria-labelledby="headingTwo" data-parent="#accordionTwo">
                                                                <div class="card-body" style="padding: 10px;">
                                                                    <div style="margin-bottom: 5px;">
                                                                        <button class="buttons-indikator-2" style="margin: 5px; margin-top: 0px;" value="[nama indikator]"><?php echo $IndikatorTable[0]['nama_indikator']; ?></button>
                                                                        <button class="buttons-indikator-2" style="margin: 5px; margin-top: 0px;" value="[nama daerah]">Nama Daerah</button>
                                                                        <button class="buttons-indikator-2" style="margin: 5px; margin-top: 0px;" value="[bulan - tahun ini]">[bulan - tahun ini]</button>
                                                                        <button class="buttons-indikator-2" style="margin: 5px; margin-top: 0px;" value="[nilai daerah saat ini]">Nilai daerah saat ini</button>
                                                                        <button class="buttons-indikator-2" style="margin: 5px; margin-top: 0px;" value="[nilai provinsi saat ini]">Nilai provinsi saat ini</button>
                                                                        <button class="buttons-indikator-2" style="margin: 5px; margin-top: 0px;" value="[nilai nasional saat ini]">Nilai nasional saat ini</button>
                                                                        <button class="buttons-indikator-2" style="margin: 5px; margin-top: 0px;" value="[sparator nilai daerah dengan nilai nasional]">Separator [diatas/dibawah/sama dengan] daerah dengan nilai nasional</button>
                                                                        <button class="buttons-indikator-2" style="margin: 5px; margin-top: 0px;" value="[sparator nilai daerah dengan nilai provinsi]">Separator [diatas/dibawah/sama dengan] daerah dengan nilai provinsi</button>
                                                                    </div>
                                                                    <form id="form-indicator-description-2">
                                                                        <!-- <textarea rows="5" cols="100" class="txt-area-indikator-2" required><?php echo ($description != null ? $description[0]->deskripsi : '') ?></textarea> -->

                                                                        <input type="hidden" id="id-deskripsi-indikator-2" name="id_indikator" value="<?php echo $IndikatorTable[0]['id'] ?>">
                                                                        <input type="hidden" id="id-wilayah-indikator-2" name="wilayah" value="<?php echo $wilayah ?>">
                                                                        <?php if ($wilayah == 'provinsi') { ?>
                                                                            <input type="hidden" id="id-kode-sub-wilayah-indikator-2" name="kodeSubWilayah" value="<?php echo $subWilayah[0]['id'] ?>">
                                                                        <?php } else if ($wilayah == 'kabupatenkota') { ?>
                                                                            <input type="hidden" id="id-kode-sub-provinsi-indikator-2" name="kodeProvinsi" value="<?php echo $subWilayah[0]['id'] ?>">
                                                                            <input type="hidden" id="id-kode-sub-wilayah-indikator-2" name="kodeSubWilayah" value="<?php echo $subWilayahDaerah[0]['id'] ?>">
                                                                        <?php } ?>
                                                                        <input type="hidden" id="id-keterangan-indikator-2" name="keterangan" value="Deskripsi 2">
                                                                        <textarea rows="5" cols="100" class="txt-area-indikator-2" required><?php echo ($description2 != null ? $description2[0]->deskripsi : '') ?></textarea>

                                                                </div>
                                                                <div class="card-footer" style="text-align: right;">
                                                                    <button type="button" class="btn btn-outline-danger btn-sm" id="btn-cancel-deskripsi-indikator-2" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">Cancel</button>
                                                                    <button type="button" class="btn btn-outline-primary btn-sm" id="btn-save-deskripsi-indikator-2">Save</button>
                                                                </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>
                                        <?php } ?>
                                    <?php } ?>

                                    <!-- <div class="col-12 order-md-10">
                                        <div class="card" style="border: 2px solid black; border-radius: 5px 5px 15px 15px; margin: 20px; margin-top: 10px; background-color: #4CC9F0;">
                                            <div class="card-body" style="display: flex; padding: 0rem 0rem; align-self: center; text-align: end;">
                                                <p style="font-family: 'Monda', sans-serif; font-size: 12px; margin: 0px; color: white;">
                                                    Sumber data:
                                                    <?php if ($wilayah == 'nasional') {
                                                        echo $infographnasional[0]['sumber'];
                                                    } else if ($wilayah == 'provinsi') {
                                                        echo $infographprovinsi[0]['sumber'];
                                                    } else if ($wilayah == 'kabupatenkota') {
                                                        echo $infographkabupatenkota[0]['sumber'];
                                                    } ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div> -->
                                <?php } else { ?>
                                    <div class="col-12">
                                        <div class="card" style="border: 2px solid black; margin: 20px;">
                                            <div class="card-body" style="display: flex; text-align: center; align-items: center; width: 100%; height: 79vh;">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <img src="<?= base_url() ?>/assets/assets/icon/404-not-found.png" alt="Data Not Found" style="width: 40%;" />
                                                    </div>
                                                    <div class="col-12">
                                                        <h3 style="margin-top: 20px;">-Data Not Found-</h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php } else { ?>
                                <div class="col-12">
                                    <div class="card" style="border: 2px solid black; margin: 20px;">
                                        <div class="card-body" style="display: flex; text-align: center; align-items: center; width: 100%; height: 79vh;">
                                            <div class="row">
                                                <div class="col-12">
                                                    <img src="<?= base_url() ?>/assets/assets/icon/404-not-found.png" alt="Data Not Found" style="width: 40%;" />
                                                </div>
                                                <div class="col-12">
                                                    <h3 style="margin-top: 20px;">-Data Not Found-</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>

                        </div>
                    </div>

                </section>
            </div>
            <!-- End Section Infograph -->
        </div>

    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">CARI...</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="">
                    <div class="form-group">
                        <label for="indikator">Indikator</label>
                        <select class="form-control" class="selectIndikator">
                            <option>Pertumbuhan Ekonomi</option>
                            <option>Gini Rasio</option>
                            <option>Tingkat Pengangguran Terbuka</option>
                            <option>Tingkat Kemiskinan</option>
                            <option>Lama Harapan Hidup</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="wilayah">Wilayah</label>
                        <select class="form-control" id="selectWilayahMobile">
                            <option>Nasional</option>
                            <option>Provinsi</option>
                            <option>Kabupaten/ Kota</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="sub-wilayah">Provinsi</label>
                        <select class="form-control" id="selectSubWilayahMobile">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                <button type="button" type="button" style="padding: 0.5% 5%; float: right; font-size: 14px;" class="button-read-more btn-read-more-article">
                    Cari <i class="fa fa-xs fa-search"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">FILE</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- list file -->
                <div class="row" style="display: flex; align-items: center; margin-top: 10px; margin-bottom: 10px;">
                    <div class="col-10">
                        <p style="font-family: 'Monda', sans-serif; font-size: 12px; margin: 0px;">Pertumbuhan Ekonomi Nasional 2022.xls</p>
                    </div>
                    <div class="col-2">
                        <a type="button" style="padding: 3px 8px 3px 8px; float: right; font-size: 11px; margin-top: 0px;" class="button-read-more btn-read-more-article">
                            <i class="fa fa-xs fa-download"></i>
                        </a>
                    </div>
                </div>
                <div class="row" style="display: flex; align-items: center; margin-top: 10px; margin-bottom: 10px;">
                    <div class="col-10">
                        <p style="font-family: 'Monda', sans-serif; font-size: 12px; margin: 0px;">Pertumbuhan Ekonomi Daerah.xls</p>
                    </div>
                    <div class="col-2">
                        <a type="button" style="padding: 3px 8px 3px 8px; float: right; font-size: 11px; margin-top: 0px;" class="button-read-more btn-read-more-article">
                            <i class="fa fa-xs fa-download"></i>
                        </a>
                    </div>
                </div>
                <div class="row" style="display: flex; align-items: center; margin-top: 10px; margin-bottom: 10px;">
                    <div class="col-10">
                        <p style="font-family: 'Monda', sans-serif; font-size: 12px; margin: 0px;">Perbandingan Pertumbuhan Ekonomi Nasional dan Daerah 2020-2025.xls</p>
                    </div>
                    <div class="col-2">
                        <a type="button" style="padding: 3px 8px 3px 8px; float: right; font-size: 11px; margin-top: 0px;" class="button-read-more btn-read-more-article">
                            <i class="fa fa-xs fa-download"></i>
                        </a>
                    </div>
                </div>
                <!-- end list file -->
            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" type="button" style="padding: 0.5% 5%; float: right; font-size: 14px;" class="button-read-more btn-read-more-article">
                    Cari <i class="fa fa-xs fa-search"></i>
                </button>
            </div> -->
        </div>
    </div>
</div>

<!-- <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY&callback=myMap"></script>

<script>
    function myMap() {
        var mapProp = {
            center: new google.maps.LatLng(51.508742, -0.120850),
            zoom: 5,
        };
        var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
    }
</script> -->

<script>
    Highcharts.chart('container', {
        chart: {
            type: '<?php echo $IndikatorTable[0]['chart'] ?>',
            // height: 90 + '%'
            height: 300
        },
        title: {
            text: 'Perbandingan <?php echo $IndikatorTable[0]['nama_indikator'] ?> <?php if ($wilayah == 'nasional') {
                                                                                        echo 'Nasional';
                                                                                    } else if ($wilayah == 'provinsi') {
                                                                                        echo 'Nasional dengan Provinsi';
                                                                                    } else if ($wilayah == 'kabupatenkota') {
                                                                                        echo 'Nasional dengan Daerah';
                                                                                    } ?>',
            style: {
                fontFamily: 'monospace',
                fontSize: '1.2em',
            }
        },
        subtitle: {
            text: 'Sumber: <?php if ($wilayah == 'nasional') {
                                echo $infographnasional[0]['sumber'];
                            } else if ($wilayah == 'provinsi') {
                                echo $infographprovinsi[0]['sumber'];
                            } else if ($wilayah == 'kabupatenkota') {
                                echo $infographkabupatenkota[0]['sumber'];
                            } ?>',
            style: {
                fontFamily: 'monospace',
                fontSize: '0.8em'
            }
        },
        xAxis: {
            categories: [
                '<?php
                    if ($wilayah == 'nasional') {
                        // echo date("M", mktime(0, 0, 0, $infographnasional[1]['periode']));
                        echo strftime("%b", mktime(0, 0, 0, $infographnasional[1]['periode']));
                    } else if ($wilayah == 'provinsi') {
                        // echo date("M", mktime(0, 0, 0, $infographprovinsi[1]['periode']));
                        echo strftime("%b", mktime(0, 0, 0, $infographprovinsi[1]['periode']));
                    } else if ($wilayah == 'kabupatenkota') {
                        // echo date("M", mktime(0, 0, 0, $infographprovinsi[1]['periode']));
                        echo strftime("%b", mktime(0, 0, 0, $infographprovinsi[1]['periode']));
                    } ?> -`<?php if ($wilayah == 'nasional') {
                                echo substr($infographnasional[1]['tahun'], 2);
                            } else if ($wilayah == 'provinsi') {
                                echo substr($infographprovinsi[1]['tahun'], 2);
                            } else if ($wilayah == 'kabupatenkota') {
                                echo substr($infographprovinsi[1]['tahun'], 2);
                            } ?>',
                '<?php if ($wilayah == 'nasional') {
                        // echo date("M", mktime(0, 0, 0, $infographnasional[2]['periode']));
                        echo strftime("%b", mktime(0, 0, 0, $infographnasional[2]['periode']));
                    } else if ($wilayah == 'provinsi') {
                        // echo date("M", mktime(0, 0, 0, $infographprovinsi[2]['periode']));
                        echo strftime("%b", mktime(0, 0, 0, $infographprovinsi[2]['periode']));
                    } else if ($wilayah == 'kabupatenkota') {
                        // echo date("M", mktime(0, 0, 0, $infographprovinsi[2]['periode']));
                        echo strftime("%b", mktime(0, 0, 0, $infographprovinsi[2]['periode']));
                    } ?> -`<?php if ($wilayah == 'nasional') {
                                echo substr($infographnasional[2]['tahun'], 2);
                            } else if ($wilayah == 'provinsi') {
                                echo substr($infographprovinsi[2]['tahun'], 2);
                            } else if ($wilayah == 'kabupatenkota') {
                                echo substr($infographprovinsi[2]['tahun'], 2);
                            } ?>',
                '<?php if ($wilayah == 'nasional') {
                        // echo date("M", mktime(0, 0, 0, $infographnasional[3]['periode']));
                        echo strftime("%b", mktime(0, 0, 0, $infographnasional[3]['periode']));
                    } else if ($wilayah == 'provinsi') {
                        // echo date("M", mktime(0, 0, 0, $infographprovinsi[3]['periode']));
                        echo strftime("%b", mktime(0, 0, 0, $infographprovinsi[3]['periode']));
                    } else if ($wilayah == 'kabupatenkota') {
                        // echo date("M", mktime(0, 0, 0, $infographprovinsi[3]['periode']));
                        echo strftime("%b", mktime(0, 0, 0, $infographprovinsi[3]['periode']));
                    } ?> -`<?php if ($wilayah == 'nasional') {
                                echo substr($infographnasional[3]['tahun'], 2);
                            } else if ($wilayah == 'provinsi') {
                                echo substr($infographprovinsi[3]['tahun'], 2);
                            } else if ($wilayah == 'kabupatenkota') {
                                echo substr($infographprovinsi[3]['tahun'], 2);
                            } ?>',
                '<?php if ($wilayah == 'nasional') {
                        // echo date("M", mktime(0, 0, 0, $infographnasional[4]['periode']));
                        echo strftime("%b", mktime(0, 0, 0, $infographnasional[4]['periode']));
                    } else if ($wilayah == 'provinsi') {
                        // echo date("M", mktime(0, 0, 0, $infographprovinsi[4]['periode']));
                        echo strftime("%b", mktime(0, 0, 0, $infographprovinsi[4]['periode']));
                    } else if ($wilayah == 'kabupatenkota') {
                        // echo date("M", mktime(0, 0, 0, $infographprovinsi[4]['periode']));
                        echo strftime("%b", mktime(0, 0, 0, $infographprovinsi[4]['periode']));
                    } ?> -`<?php if ($wilayah == 'nasional') {
                                echo substr($infographnasional[4]['tahun'], 2);
                            } else if ($wilayah == 'provinsi') {
                                echo substr($infographprovinsi[4]['tahun'], 2);
                            } else if ($wilayah == 'kabupatenkota') {
                                echo substr($infographprovinsi[4]['tahun'], 2);
                            } ?>',
                '<?php if ($wilayah == 'nasional') {
                        // echo date("M", mktime(0, 0, 0, $infographnasional[5]['periode']));
                        echo strftime("%b", mktime(0, 0, 0, $infographnasional[5]['periode']));
                    } else if ($wilayah == 'provinsi') {
                        // echo date("M", mktime(0, 0, 0, $infographprovinsi[5]['periode']));
                        echo strftime("%b", mktime(0, 0, 0, $infographprovinsi[5]['periode']));
                    } else if ($wilayah == 'kabupatenkota') {
                        // echo date("M", mktime(0, 0, 0, $infographprovinsi[5]['periode']));
                        echo strftime("%b", mktime(0, 0, 0, $infographprovinsi[5]['periode']));
                    } ?> -`<?php if ($wilayah == 'nasional') {
                                echo substr($infographnasional[5]['tahun'], 2);
                            } else if ($wilayah == 'provinsi') {
                                echo substr($infographprovinsi[5]['tahun'], 2);
                            } else if ($wilayah == 'kabupatenkota') {
                                echo substr($infographprovinsi[5]['tahun'], 2);
                            } ?>'
            ]
        },
        yAxis: {
            title: {
                text: '<?php if ($wilayah == 'nasional') {
                            echo $infographnasional[5]['satuan'];
                        } else if ($wilayah == 'provinsi') {
                            echo $infographprovinsi[5]['satuan'];
                        } else if ($wilayah == 'kabupatenkota') {
                            echo $infographkabupatenkota[5]['satuan'];
                        } ?>',
                style: {
                    fontFamily: 'monospace',
                    fontSize: '0.8em'
                },
            },
            visible: false,
        },
        plotOptions: {
            <?php echo $IndikatorTable[0]['chart'] ?>: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: true
            }
        },
        exporting: {
            buttons: {
                contextButton: {
                    symbol: 'menuball'
                }
            }
        },
        legend: {
            title: {
                text: 'Legenda<br/><hr/><span style="font-size: 9px; color: #666; font-weight: normal;">(Klik nama daerah untuk menyembunyikan/menampilkan grafik)</span>',
                // style: {
                //     fontStyle: 'italic'
                // }
            },
            backgroundColor: '#FCFFC5',
            borderColor: '#C98657',
            borderWidth: 1
        },
        <?php
        if ($wilayah == 'nasional') {
            $nilainasional1 = $infographnasional[1]['nasional'];
            $nilainasional2 = $infographnasional[2]['nasional'];
            $nilainasional3 = $infographnasional[3]['nasional'];
            $nilainasional4 = $infographnasional[4]['nasional'];
            $nilainasional5 = $infographnasional[5]['nasional'];
            // if ($infographnasional[5]['satuan'] == '%') {
            //     $nilainasional1 = round($infographnasional[1]['nasional'], 2);
            //     $nilainasional2 = round($infographnasional[2]['nasional'], 2);
            //     $nilainasional3 = round($infographnasional[3]['nasional'], 2);
            //     $nilainasional4 = round($infographnasional[4]['nasional'], 2);
            //     $nilainasional5 = round($infographnasional[5]['nasional'], 2);
            // } elseif ($infographnasional[5]['satuan'] == 'Rp') {
            //     $nilainasional1 = number_format($infographnasional[1]['nasional'], 2, ',', '.');
            //     $nilainasional2 = number_format($infographnasional[2]['nasional'], 2, ',', '.');
            //     $nilainasional3 = number_format($infographnasional[3]['nasional'], 2, ',', '.');
            //     $nilainasional4 = number_format($infographnasional[4]['nasional'], 2, ',', '.');
            //     $nilainasional5 = number_format($infographnasional[5]['nasional'], 2, ',', '.');
            // } elseif ($infographnasional[5]['satuan'] == 'Orang') {
            //     $nilainasional1 = number_format($infographnasional[1]['nasional'], 0, ',', '.');
            //     $nilainasional2 = number_format($infographnasional[2]['nasional'], 0, ',', '.');
            //     $nilainasional3 = number_format($infographnasional[3]['nasional'], 0, ',', '.');
            //     $nilainasional4 = number_format($infographnasional[4]['nasional'], 0, ',', '.');
            //     $nilainasional5 = number_format($infographnasional[5]['nasional'], 0, ',', '.');
            // } else {
            //     $nilainasional1 = $infographnasional[1]['nasional'];
            //     $nilainasional2 = $infographnasional[2]['nasional'];
            //     $nilainasional3 = $infographnasional[3]['nasional'];
            //     $nilainasional4 = $infographnasional[4]['nasional'];
            //     $nilainasional5 = $infographnasional[5]['nasional'];
            // }
        }
        ?>

        <?php
        if ($wilayah == 'provinsi') {
            $nilainasional1 = $infographprovinsi[1]['nasional'];
            $nilainasional2 = $infographprovinsi[2]['nasional'];
            $nilainasional3 = $infographprovinsi[3]['nasional'];
            $nilainasional4 = $infographprovinsi[4]['nasional'];
            $nilainasional5 = $infographprovinsi[5]['nasional'];

            $nilaiprovinsi1 = $infographprovinsi[1]['nilai'];
            $nilaiprovinsi2 = $infographprovinsi[2]['nilai'];
            $nilaiprovinsi3 = $infographprovinsi[3]['nilai'];
            $nilaiprovinsi4 = $infographprovinsi[4]['nilai'];
            $nilaiprovinsi5 = $infographprovinsi[5]['nilai'];
            // if ($infographprovinsi[5]['satuan'] == '%') {
            //     $nilainasional1 = round($infographprovinsi[1]['nasional'], 2);
            //     $nilainasional2 = round($infographprovinsi[2]['nasional'], 2);
            //     $nilainasional3 = round($infographprovinsi[3]['nasional'], 2);
            //     $nilainasional4 = round($infographprovinsi[4]['nasional'], 2);
            //     $nilainasional5 = round($infographprovinsi[5]['nasional'], 2);

            //     $nilaiprovinsi1 = round($infographprovinsi[1]['nilai'], 2);
            //     $nilaiprovinsi2 = round($infographprovinsi[2]['nilai'], 2);
            //     $nilaiprovinsi3 = round($infographprovinsi[3]['nilai'], 2);
            //     $nilaiprovinsi4 = round($infographprovinsi[4]['nilai'], 2);
            //     $nilaiprovinsi5 = round($infographprovinsi[5]['nilai'], 2);
            // } elseif ($infographprovinsi[5]['satuan'] == 'Rp') {
            //     $nilainasional1 = number_format($infographprovinsi[1]['nasional'], 2, ',', '.');
            //     $nilainasional2 = number_format($infographprovinsi[2]['nasional'], 2, ',', '.');
            //     $nilainasional3 = number_format($infographprovinsi[3]['nasional'], 2, ',', '.');
            //     $nilainasional4 = number_format($infographprovinsi[4]['nasional'], 2, ',', '.');
            //     $nilainasional5 = number_format($infographprovinsi[5]['nasional'], 2, ',', '.');

            //     $nilaiprovinsi1 = number_format($infographprovinsi[1]['nilai'], 2, ',', '.');
            //     $nilaiprovinsi2 = number_format($infographprovinsi[2]['nilai'], 2, ',', '.');
            //     $nilaiprovinsi3 = number_format($infographprovinsi[3]['nilai'], 2, ',', '.');
            //     $nilaiprovinsi4 = number_format($infographprovinsi[4]['nilai'], 2, ',', '.');
            //     $nilaiprovinsi5 = number_format($infographprovinsi[5]['nilai'], 2, ',', '.');
            // } elseif ($infographprovinsi[5]['satuan'] == 'Orang') {
            //     $nilainasional1 = number_format($infographprovinsi[1]['nasional'], 0, ',', '.');
            //     $nilainasional2 = number_format($infographprovinsi[2]['nasional'], 0, ',', '.');
            //     $nilainasional3 = number_format($infographprovinsi[3]['nasional'], 0, ',', '.');
            //     $nilainasional4 = number_format($infographprovinsi[4]['nasional'], 0, ',', '.');
            //     $nilainasional5 = number_format($infographprovinsi[5]['nasional'], 0, ',', '.');

            //     $nilaiprovinsi1 = number_format($infographprovinsi[1]['nilai'], 0, ',', '.');
            //     $nilaiprovinsi2 = number_format($infographprovinsi[2]['nilai'], 0, ',', '.');
            //     $nilaiprovinsi3 = number_format($infographprovinsi[3]['nilai'], 0, ',', '.');
            //     $nilaiprovinsi4 = number_format($infographprovinsi[4]['nilai'], 0, ',', '.');
            //     $nilaiprovinsi5 = number_format($infographprovinsi[5]['nilai'], 0, ',', '.');
            // } else {
            //     $nilainasional1 = $infographprovinsi[1]['nasional'];
            //     $nilainasional2 = $infographprovinsi[2]['nasional'];
            //     $nilainasional3 = $infographprovinsi[3]['nasional'];
            //     $nilainasional4 = $infographprovinsi[4]['nasional'];
            //     $nilainasional5 = $infographprovinsi[5]['nasional'];

            //     $nilaiprovinsi1 = $infographprovinsi[1]['nilai'];
            //     $nilaiprovinsi2 = $infographprovinsi[2]['nilai'];
            //     $nilaiprovinsi3 = $infographprovinsi[3]['nilai'];
            //     $nilaiprovinsi4 = $infographprovinsi[4]['nilai'];
            //     $nilaiprovinsi5 = $infographprovinsi[5]['nilai'];
            // }
        }
        ?>

        <?php
        if ($wilayah == 'kabupatenkota') {
            $nilainasional1 = $infographprovinsi[1]['nasional'];
            $nilainasional2 = $infographprovinsi[2]['nasional'];
            $nilainasional3 = $infographprovinsi[3]['nasional'];
            $nilainasional4 = $infographprovinsi[4]['nasional'];
            $nilainasional5 = $infographprovinsi[5]['nasional'];

            $nilaiprovinsi1 = $infographprovinsi[1]['nilai'];
            $nilaiprovinsi2 = $infographprovinsi[2]['nilai'];
            $nilaiprovinsi3 = $infographprovinsi[3]['nilai'];
            $nilaiprovinsi4 = $infographprovinsi[4]['nilai'];
            $nilaiprovinsi5 = $infographprovinsi[5]['nilai'];

            $nilaikabupatenkota1 = $infographkabupatenkota[1]['nilai'];
            $nilaikabupatenkota2 = $infographkabupatenkota[2]['nilai'];
            $nilaikabupatenkota3 = $infographkabupatenkota[3]['nilai'];
            $nilaikabupatenkota4 = $infographkabupatenkota[4]['nilai'];
            $nilaikabupatenkota5 = $infographkabupatenkota[5]['nilai'];

            // if ($infographprovinsi[5]['satuan'] == '%') {
            //     $nilainasional1 = round($infographprovinsi[1]['nasional'], 2);
            //     $nilainasional2 = round($infographprovinsi[2]['nasional'], 2);
            //     $nilainasional3 = round($infographprovinsi[3]['nasional'], 2);
            //     $nilainasional4 = round($infographprovinsi[4]['nasional'], 2);
            //     $nilainasional5 = round($infographprovinsi[5]['nasional'], 2);

            //     $nilaiprovinsi1 = round($infographprovinsi[1]['nilai'], 2);
            //     $nilaiprovinsi2 = round($infographprovinsi[2]['nilai'], 2);
            //     $nilaiprovinsi3 = round($infographprovinsi[3]['nilai'], 2);
            //     $nilaiprovinsi4 = round($infographprovinsi[4]['nilai'], 2);
            //     $nilaiprovinsi5 = round($infographprovinsi[5]['nilai'], 2);

            //     $nilaikabupatenkota1 = round($infographkabupatenkota[1]['nilai'], 2);
            //     $nilaikabupatenkota2 = round($infographkabupatenkota[2]['nilai'], 2);
            //     $nilaikabupatenkota3 = round($infographkabupatenkota[3]['nilai'], 2);
            //     $nilaikabupatenkota4 = round($infographkabupatenkota[4]['nilai'], 2);
            //     $nilaikabupatenkota5 = round($infographkabupatenkota[5]['nilai'], 2);
            // } elseif ($infographprovinsi[5]['satuan'] == 'Rp') {
            //     $nilainasional1 = number_format($infographprovinsi[1]['nasional'], 2, ',', '.');
            //     $nilainasional2 = number_format($infographprovinsi[2]['nasional'], 2, ',', '.');
            //     $nilainasional3 = number_format($infographprovinsi[3]['nasional'], 2, ',', '.');
            //     $nilainasional4 = number_format($infographprovinsi[4]['nasional'], 2, ',', '.');
            //     $nilainasional5 = number_format($infographprovinsi[5]['nasional'], 2, ',', '.');

            //     $nilaiprovinsi1 = number_format($infographprovinsi[1]['nilai'], 2, ',', '.');
            //     $nilaiprovinsi2 = number_format($infographprovinsi[2]['nilai'], 2, ',', '.');
            //     $nilaiprovinsi3 = number_format($infographprovinsi[3]['nilai'], 2, ',', '.');
            //     $nilaiprovinsi4 = number_format($infographprovinsi[4]['nilai'], 2, ',', '.');
            //     $nilaiprovinsi5 = number_format($infographprovinsi[5]['nilai'], 2, ',', '.');

            //     $nilaikabupatenkota1 = number_format($infographkabupatenkota[1]['nilai'], 2, ',', '.');
            //     $nilaikabupatenkota2 = number_format($infographkabupatenkota[2]['nilai'], 2, ',', '.');
            //     $nilaikabupatenkota3 = number_format($infographkabupatenkota[3]['nilai'], 2, ',', '.');
            //     $nilaikabupatenkota4 = number_format($infographkabupatenkota[4]['nilai'], 2, ',', '.');
            //     $nilaikabupatenkota5 = number_format($infographkabupatenkota[5]['nilai'], 2, ',', '.');
            // } elseif ($infographprovinsi[5]['satuan'] == 'Orang') {
            //     $nilainasional1 = number_format($infographprovinsi[1]['nasional'], 0, ',', '.');
            //     $nilainasional2 = number_format($infographprovinsi[2]['nasional'], 0, ',', '.');
            //     $nilainasional3 = number_format($infographprovinsi[3]['nasional'], 0, ',', '.');
            //     $nilainasional4 = number_format($infographprovinsi[4]['nasional'], 0, ',', '.');
            //     $nilainasional5 = number_format($infographprovinsi[5]['nasional'], 0, ',', '.');

            //     $nilaiprovinsi1 = number_format($infographprovinsi[1]['nilai'], 0, ',', '.');
            //     $nilaiprovinsi2 = number_format($infographprovinsi[2]['nilai'], 0, ',', '.');
            //     $nilaiprovinsi3 = number_format($infographprovinsi[3]['nilai'], 0, ',', '.');
            //     $nilaiprovinsi4 = number_format($infographprovinsi[4]['nilai'], 0, ',', '.');
            //     $nilaiprovinsi5 = number_format($infographprovinsi[5]['nilai'], 0, ',', '.');

            //     $nilaikabupatenkota1 = number_format($infographkabupatenkota[1]['nilai'], 0, ',', '.');
            //     $nilaikabupatenkota2 = number_format($infographkabupatenkota[2]['nilai'], 0, ',', '.');
            //     $nilaikabupatenkota3 = number_format($infographkabupatenkota[3]['nilai'], 0, ',', '.');
            //     $nilaikabupatenkota4 = number_format($infographkabupatenkota[4]['nilai'], 0, ',', '.');
            //     $nilaikabupatenkota5 = number_format($infographkabupatenkota[5]['nilai'], 0, ',', '.');
            // } else {
            //     $nilainasional1 = $infographprovinsi[1]['nasional'];
            //     $nilainasional2 = $infographprovinsi[2]['nasional'];
            //     $nilainasional3 = $infographprovinsi[3]['nasional'];
            //     $nilainasional4 = $infographprovinsi[4]['nasional'];
            //     $nilainasional5 = $infographprovinsi[5]['nasional'];

            //     $nilaiprovinsi1 = $infographprovinsi[1]['nilai'];
            //     $nilaiprovinsi2 = $infographprovinsi[2]['nilai'];
            //     $nilaiprovinsi3 = $infographprovinsi[3]['nilai'];
            //     $nilaiprovinsi4 = $infographprovinsi[4]['nilai'];
            //     $nilaiprovinsi5 = $infographprovinsi[5]['nilai'];

            //     $nilaikabupatenkota1 = $infographkabupatenkota[1]['nilai'];
            //     $nilaikabupatenkota2 = $infographkabupatenkota[2]['nilai'];
            //     $nilaikabupatenkota3 = $infographkabupatenkota[3]['nilai'];
            //     $nilaikabupatenkota4 = $infographkabupatenkota[4]['nilai'];
            //     $nilaikabupatenkota5 = $infographkabupatenkota[5]['nilai'];
            // }
        }
        ?>
        series: [
            <?php if ($wilayah == 'nasional') { ?> {
                    name: 'Nasional',
                    data: [<?php echo $nilainasional1; ?>, <?php echo $nilainasional2; ?>, <?php echo $nilainasional3; ?>, <?php echo $nilainasional4; ?>, <?php echo $nilainasional5; ?>],
                    connectNulls: true
                },
            <?php } ?>
            <?php if ($wilayah == 'provinsi') { ?> {
                    name: 'Nasional',
                    data: [<?php echo $nilainasional1; ?>, <?php echo $nilainasional2; ?>, <?php echo $nilainasional3; ?>, <?php echo $nilainasional4; ?>, <?php echo $nilainasional5; ?>],
                    connectNulls: true
                },
                {
                    name: '<?php echo $subWilayah[0]['nama_provinsi'] ?>',
                    data: [<?php echo $nilaiprovinsi1; ?>, <?php echo $nilaiprovinsi2; ?>, <?php echo $nilaiprovinsi3; ?>, <?php echo $nilaiprovinsi4; ?>, <?php echo $nilaiprovinsi5; ?>],
                    connectNulls: true
                },
            <?php } ?>
            <?php if ($wilayah == 'kabupatenkota') { ?> {
                    name: 'Nasional',
                    data: [<?php echo $nilainasional1; ?>, <?php echo $nilainasional2; ?>, <?php echo $nilainasional3; ?>, <?php echo $nilainasional4; ?>, <?php echo $nilainasional5; ?>],
                    connectNulls: true
                },
                {
                    name: '<?php echo $subWilayah[0]['nama_provinsi'] ?>',
                    data: [<?php echo $nilaiprovinsi1; ?>, <?php echo $nilaiprovinsi2; ?>, <?php echo $nilaiprovinsi3; ?>, <?php echo $nilaiprovinsi4; ?>, <?php echo $nilaiprovinsi5; ?>],
                    connectNulls: true
                },
                {
                    name: '<?php echo $subWilayahDaerah[0]['nama_kabupaten'] ?>',
                    data: [
                        <?php
                        if ($infographprovinsi[1]['id_periode'] == $infographkabupatenkota[1]['id_periode']) {
                            echo $nilaikabupatenkota1;
                        } elseif ($infographprovinsi[1]['id_periode'] == $infographkabupatenkota[2]['id_periode']) {
                            echo $nilaikabupatenkota1;
                        } else {
                            echo 'null';
                        }
                        ?>,
                        <?php
                        if ($infographprovinsi[2]['id_periode'] == $infographkabupatenkota[2]['id_periode']) {
                            echo $nilaikabupatenkota2;
                        } elseif ($infographprovinsi[2]['id_periode'] == $infographkabupatenkota[3]['id_periode']) {
                            echo $nilaikabupatenkota3;
                        } else {
                            echo 'null';
                        }
                        ?>,
                        <?php
                        if ($infographprovinsi[3]['id_periode'] == $infographkabupatenkota[3]['id_periode']) {
                            echo $nilaikabupatenkota3;
                        } elseif ($infographprovinsi[3]['id_periode'] == $infographkabupatenkota[4]['id_periode']) {
                            echo $nilaikabupatenkota4;
                        } else {
                            echo 'null';
                        }
                        ?>,
                        <?php
                        if ($infographprovinsi[4]['id_periode'] == $infographkabupatenkota[4]['id_periode']) {
                            echo $nilaikabupatenkota4;
                        } elseif ($infographprovinsi[4]['id_periode'] == $infographkabupatenkota[5]['id_periode']) {
                            echo $nilaikabupatenkota5;
                        } else {
                            echo 'null';
                        }
                        ?>,
                        <?php
                        if ($infographprovinsi[5]['id_periode'] == $infographkabupatenkota[5]['id_periode']) {
                            echo $nilaikabupatenkota5;
                        } else {
                            echo 'null';
                        }
                        ?>
                    ],
                    connectNulls: true
                },
            <?php } ?>
        ]
    });
</script>

<script>
    Highcharts.chart('container-2', {
        chart: {
            type: 'column',
            height: 300
        },
        title: {
            text: 'Perbandingan <?php echo $IndikatorTable[0]['nama_indikator'] ?> antar <?php echo ($wilayah == 'provinsi' ? 'Provinsi' : 'Daerah'); ?>',
            style: {
                fontFamily: 'monospace',
                fontSize: '1.2em',
            }
        },
        subtitle: {
            text: 'Sumber: <?php if ($wilayah == 'nasional') {
                                echo $infographnasional[0]['sumber'];
                            } else if ($wilayah == 'provinsi') {
                                echo $infographprovinsi[0]['sumber'];
                            } else if ($wilayah == 'kabupatenkota') {
                                echo $infographkabupatenkota[0]['sumber'];
                            } ?>',
            style: {
                fontFamily: 'monospace',
                fontSize: '0.8em'
            }
        },
        xAxis: {
            categories: [
                <?php
                if (isset($graphperbandinganwilayah)) {
                    foreach ($graphperbandinganwilayah as $graphwil) {
                        echo "'" . $graphwil['label'] . "',";
                    }
                } ?>
            ]
        },
        yAxis: {
            title: {
                text: 'Value',
                style: {
                    fontFamily: 'monospace',
                    fontSize: '0.8em'
                }
            }
        },
        legend: {
            shadow: false
        },
        tooltip: {
            shared: true
        },
        plotOptions: {
            column: {
                grouping: false,
                shadow: false,
                borderWidth: 0
            }
        },
        series: [{
                name: '<?php echo $IndikatorTable[0]['nama_indikator'] ?>',
                <?php
                if (isset($graphperbandinganwilayah)) {
                    foreach ($graphperbandinganwilayah as $graphwil) {
                        if ($wilayah == 'provinsi') {
                            if ($graphwil['wilayah'] == $subWilayah[0]['id']) {
                                echo "color: 'rgba(248,161,63,1)',";
                            } else {
                                echo "color: 'rgba(248,161,63,1)',";
                            }
                        } elseif ($wilayah == 'kabupatenkota') {
                            if ($graphwil['wilayah'] == $subWilayahDaerah[0]['id']) {
                                echo "color: 'rgba(248,161,63,1)',";
                            } else {
                                echo "color: 'rgba(248,161,63,1)',";
                            }
                        } else {
                            echo "color: 'rgba(248,161,63,1)',";
                        }
                    }
                } ?>
                data: [
                    <?php
                    if (isset($graphperbandinganwilayah)) {
                        foreach ($graphperbandinganwilayah as $graphwil) {
                            echo $graphwil['nilai'] . ",";
                        }
                    } ?>
                ],
                pointPadding: 0.3,
                pointPlacement: -0.2
            },
            {
                name: 'Target RKP <?php echo $IndikatorTable[0]['nama_indikator'] ?>',
                color: 'rgba(186,60,61,.9)',
                data: [
                    <?php
                    if (isset($graphperbandinganwilayah)) {
                        foreach ($graphperbandinganwilayah as $graphwil) {
                            echo $graphwil['target'] . ",";
                        }
                    } ?>
                ],
                pointPadding: 0.4,
                pointPlacement: -0.2
            },
            {
                name: 'Nasional',
                type: 'spline',
                marker: {
                    enabled: false
                },
                data: [
                    <?php
                    if (isset($graphperbandinganwilayah)) {
                        foreach ($graphperbandinganwilayah as $graphwil) {
                            echo $graphwil['nasional'] . ",";
                        }
                    } ?>
                ],
                // tooltip: {
                //     valueSuffix: '°C'
                // }
            }
        ]
        // series: [{
        //         name: 'Employees',
        //         color: 'rgba(165,170,217,1)',
        //         data: [150, 73, 20],
        //         pointPadding: 0.3,
        //         pointPlacement: -0.2
        //     }, {
        //         name: 'Employees Optimized',
        //         color: 'rgba(126,86,134,.9)',
        //         data: [140, 90, 40],
        //         pointPadding: 0.4,
        //         pointPlacement: -0.2
        //     }, {
        //         name: 'Profit',
        //         color: 'rgba(248,161,63,1)',
        //         data: [183.6, 178.8, 198.5],
        //         tooltip: {
        //             valuePrefix: '$',
        //             valueSuffix: ' M'
        //         },
        //         pointPadding: 0.3,
        //         pointPlacement: 0.2,
        //         yAxis: 1
        //     }, {
        //         name: 'Profit Optimized',
        //         color: 'rgba(186,60,61,.9)',
        //         data: [203.6, 198.8, 208.5],
        //         tooltip: {
        //             valuePrefix: '$',
        //             valueSuffix: ' M'
        //         },
        //         pointPadding: 0.4,
        //         pointPlacement: 0.2,
        //         yAxis: 1
        //     },
        //     {
        //         name: 'Temperature',
        //         type: 'spline',
        //         marker: {
        //             enabled: false
        //         },
        //         data: [7.0, 6.9, 9.5],
        //         tooltip: {
        //             valueSuffix: '°C'
        //         }
        //     }
        // ]
    });
</script>

<script>
    Highcharts.setOptions({
        lang: {
            numericSymbols: [" Ribu", " Juta", " Miliar", " Triliun"]
        }
    });
    Highcharts.chart('container-3', {

        chart: {
            polar: true,
            type: 'line',
            height: 450,
            // margin: [70, 90, 120, 90]
        },

        // accessibility: {
        //     description: 'A spiderweb chart compares the allocated budget against actual spending within an organization. The spider chart has six spokes. Each spoke represents one of the 6 departments within the organization: sales, marketing, development, customer support, information technology and administration. The chart is interactive, and each data point is displayed upon hovering. The chart clearly shows that 4 of the 6 departments have overspent their budget with Marketing responsible for the greatest overspend of $20,000. The allocated budget and actual spending data points for each department are as follows: Sales. Budget equals $43,000; spending equals $50,000. Marketing. Budget equals $19,000; spending equals $39,000. Development. Budget equals $60,000; spending equals $42,000. Customer support. Budget equals $35,000; spending equals $31,000. Information technology. Budget equals $17,000; spending equals $26,000. Administration. Budget equals $10,000; spending equals $14,000.'
        // },

        title: {
            text: 'Perbandingan <?php echo $IndikatorTable[0]['nama_indikator'] ?> antar <?php echo ($wilayah == 'provinsi' ? 'Provinsi' : 'Daerah'); ?>',
            style: {
                fontFamily: 'monospace',
                fontSize: '1.2em',
            }
        },
        subtitle: {
            text: "Sumber: <?php if ($wilayah == 'nasional') {
                                echo $infographnasional[0]['sumber'];
                            } else if ($wilayah == 'provinsi') {
                                echo $infographprovinsi[0]['sumber'];
                            } else if ($wilayah == 'kabupatenkota') {
                                echo $infographkabupatenkota[0]['sumber'];
                            } ?> <?php echo $graphperbandinganwilayah[0]['tahun'] ?>",
            style: {
                fontFamily: 'monospace',
                fontSize: '0.8em'
            }
        },

        pane: {
            size: '80%'
        },

        xAxis: {
            labels: {
                allowOverlap: false
            },
            categories: [
                <?php
                if (isset($graphperbandinganwilayah)) {
                    foreach ($graphperbandinganwilayah as $graphwil) {
                        echo "'" . $graphwil['label'] . "',";
                    }
                } ?>
            ],
            tickmarkPlacement: 'on',
            lineWidth: 0
        },

        yAxis: {
            gridLineInterpolation: 'polygon',
            lineWidth: 0,
            min: 0
        },

        tooltip: {
            shared: true,
            pointFormat: '<span style="color:{series.color}">{series.name}: <b>{point.y:,.2f}</b><br/>'
        },
        legend: {
            title: {
                text: 'Legenda<br/><hr/><span style="font-size: 9px; color: #666; font-weight: normal;">(Klik nama daerah untuk menyembunyikan/menampilkan grafik)</span>',
                // style: {
                //     fontStyle: 'italic'
                // }
            },
            backgroundColor: '#FCFFC5',
            borderColor: '#C98657',
            borderWidth: 1,
            align: 'center',
            verticalAlign: 'bottom',
            layout: 'vertical'
        },

        exporting: {
            buttons: {
                contextButton: {
                    symbol: 'menuball'
                }
            }
        },

        series: [{
                name: 'Capaian',
                data: [
                    <?php
                    if (isset($graphperbandinganwilayah)) {
                        foreach ($graphperbandinganwilayah as $graphwil) {
                            echo $graphwil['nilai'] . ",";
                        }
                    } ?>
                ],
                pointPlacement: 'on'
            },
            <?php if ($wilayah == 'provinsi') { ?> {
                    name: 'Target RKPD',
                    data: [
                        <?php
                        if (isset($graphperbandinganwilayah)) {
                            foreach ($graphperbandinganwilayah as $graphwil) {
                                echo $graphwil['t_rkpd'] . ",";
                            }
                        } ?>
                    ],
                    pointPlacement: 'on'
                },
                {
                    name: 'Target RKP',
                    data: [
                        <?php
                        if (isset($graphperbandinganwilayah)) {
                            foreach ($graphperbandinganwilayah as $graphwil) {
                                echo $graphwil['target'] . ",";
                            }
                        } ?>
                    ],
                    pointPlacement: 'on'
                },
                {
                    name: 'Target Kewilayahan RKP',
                    data: [
                        <?php
                        if (isset($graphperbandinganwilayah)) {
                            foreach ($graphperbandinganwilayah as $graphwil) {
                                echo $graphwil['t_k_rkp'] . ",";
                            }
                        } ?>
                    ],
                    pointPlacement: 'on'
                },
            <?php } else if ($wilayah == 'kabupatenkota') { ?> {
                    name: 'Capaian Provinsi',
                    marker: {
                        enabled: false
                    },
                    data: [
                        <?php
                        if (isset($graphperbandinganwilayah)) {
                            for ($x = 0; $x < count($graphperbandinganwilayah); $x++) {
                                echo $infographprovinsi[5]['nilai'] . ",";
                            }
                        } ?>
                    ],
                    pointPlacement: 'on'
                },
            <?php } ?> {
                name: 'Capaian Nasional',
                marker: {
                    enabled: false
                },
                data: [
                    <?php
                    if (isset($graphperbandinganwilayah)) {
                        foreach ($graphperbandinganwilayah as $graphwil) {
                            echo $graphwil['nasional'] . ",";
                        }
                    } ?>
                ],
                pointPlacement: 'on'
            }
        ],

        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        align: 'center',
                        verticalAlign: 'bottom',
                        layout: 'horizontal'
                    },
                    pane: {
                        size: '100%'
                    }
                }
            }]
        }

    });
</script>

<script>
    $.get("https://webapi.bps.go.id/v1/api/list/model/subcat/lang/ind/domain/0000/key/24fb1b646304e23577aaad005eb40714/", function(data) {
        // console.log(data.data[1]);

        var txt = "<option value=''>-Pilih-</option>";
        for (let i = 0; i < data.data[1].length; i++) {
            txt += "<option value=" + data.data[1][i].subcat_id + ">" + data.data[1][i].title + "</option>";
        }
        $("#selectCategory").html(txt);
    });

    $('#selectCategory').on('change', function() {

        var valueSelectedCategory = this.value;
        if (valueSelectedCategory == '') {
            $(".form-group-subject").hide();
        } else {
            $(".form-group-subject").show();
        }

        $.get("https://webapi.bps.go.id/v1/api/list/model/subject/lang/ind/domain/0000/subcat/" + valueSelectedCategory + "/key/24fb1b646304e23577aaad005eb40714/", function(data) {
            // console.log(this);
            // console.log(data);
            // console.log(data.data[1][0].domain_id);
            // console.log(data.data[1][0].domain_id.substr(2, 1));

            var txt = "";
            if (data.data == '') {
                txt += "<option value=''>-Pilih-</option>";
            } else {
                for (let i = 0; i < data.data[1].length; i++) {
                    txt += "<option value=" + data.data[1][i].sub_id + ">" + data.data[1][i].title + "</option>";
                }
            }

            $("#selectSubject").html(txt);

        });

    });

    
    $('#selectSubWilayah').on('change', function() {
        var selectedValue = $(this).val();
        
        // Send the post request to get filtered data
        $.post('<?php echo base_url('C_pagesController/getFilteredData'); ?>', { selectedValue: selectedValue }, function(response) {
            // Handle the response here
            var txt = "<option value=''>-Pilih-</option>";
            var filteredData = JSON.parse(response);

            // Rebuild the dropdown options
            for (let i = 0; i < filteredData.length; i++) {
                txt += "<option value=" + filteredData[i].id + ">" + filteredData[i].nama_kabupaten + "</option>";
            }

            // Update the dropdown options
            $("#selectKabupatenKota").html(txt);

            // Re-select the original selected value, if it still exists in the filtered data
            if (filteredData.some(item => item.id === selectedValue)) {
                $('#selectKabupatenKota').val(selectedValue);
            }
        });
    });

</script>

<script>
    $.get("https://webapi.bps.go.id/v1/api/list/model/subcat/lang/ind/domain/0000/key/24fb1b646304e23577aaad005eb40714/", function(data) {
        // console.log(data.data[1]);

        var txt = "<option value=''>-Pilih-</option>";
        for (let i = 0; i < data.data[1].length; i++) {
            txt += "<option value=" + data.data[1][i].subcat_id + ">" + data.data[1][i].title + "</option>";
        }
        $("#selectCategory").html(txt);
    });

    $('#selectCategory').on('change', function() {

        var valueSelectedCategory = this.value;
        if (valueSelectedCategory == '') {
            $(".form-group-subject").hide();
        } else {
            $(".form-group-subject").show();
        }

        $.get("https://webapi.bps.go.id/v1/api/list/model/subject/lang/ind/domain/0000/subcat/" + valueSelectedCategory + "/key/24fb1b646304e23577aaad005eb40714/", function(data) {
            // console.log(this);
            // console.log(data);
            // console.log(data.data[1][0].domain_id);
            // console.log(data.data[1][0].domain_id.substr(2, 1));

            var txt = "";
            if (data.data == '') {
                txt += "<option value=''>-Pilih-</option>";
            } else {
                for (let i = 0; i < data.data[1].length; i++) {
                    txt += "<option value=" + data.data[1][i].sub_id + ">" + data.data[1][i].title + "</option>";
                }
            }

            $("#selectSubject").html(txt);

        });

    });

    $('#selectWilayah').on('change', function() {

        if (this.value == 'provinsi') {

            $(".form-group-sub-wilayah").show();
            $("#selectSubWilayah").prop('required', true);
            $(".form-group-kabupaten-kota").hide();
            $("#selectKabupatenKota").prop('required', false);

        } else if (this.value == 'kabupatenkota') {

            $(".form-group-sub-wilayah").show();
            $("#selectSubWilayah").prop('required', true);
            $(".form-group-kabupaten-kota").show();
            $("#selectKabupatenKota").prop('required', true);


        } else {

            $("#selectSubWilayah").prop('required', false);
            $(".form-group-sub-wilayah").hide();
            $("#selectKabupatenKota").prop('required', false);
            $(".form-group-kabupaten-kota").hide();

        }

    });

    $('#selectWilayah').on('change', function() {

        if (this.value == 'provinsi') {
            var json = <?php echo $json_list_provinsi; ?>;

                var txt = "<option value=''>-Pilih-</option>";
                for (let i = 0; i < json.length; i++) {
                    txt += "<option value=" + json[i].id + ">" + json[i].nama_provinsi + "</option>";
                }
                $("#selectSubWilayah").html(txt);
                $("#selectSubWilayahMobile").html(txt);

            $(".form-group-sub-wilayah").show();
            $(".form-group-kabupaten-kota").hide();

        } else if (this.value == 'kabupatenkota') {
            
            var json = <?php echo $json_list_provinsi; ?>;
            
                var txt = "<option value=''>-Pilih-</option>";
                for (let i = 0; i < json.length; i++) {
                    txt += "<option value=" + json[i].id + ">" + json[i].nama_provinsi + "</option>";
                }
                $("#selectSubWilayah").html(txt);
                $("#selectSubWilayahMobile").html(txt);
            

            $(".form-group-sub-wilayah").show();
            $(".form-group-kabupaten-kota").show();

        } else {

            $(".form-group-sub-wilayah").hide();
            $(".form-group-kabupaten-kota").hide();

        }

    });


    function peta() {
        mapboxgl.accessToken = 'pk.eyJ1IjoiZnJhbnNhbGFtb25kYSIsImEiOiJja2NlZ2xtMjkwMzgxMzJubm9paGJ5dmMyIn0.QJc2VJF6md9CaTilCmgYag';
        url = "<?= base_url(); ?>/C_infographController/peta";
        //$('form#form_edit input[name="iduser"]').val();
        //var provinsi = $("#inp_pro");
        // var provinsi = $('form#form_s select[name="inp_pro"]').val();
        // data1 = "provinsi=" + $("#inp_pro").val();

        <?php if ($wilayah == 'nasional') { ?>
            data1 = "provinsi=1000&indikator=<?php echo $IndikatorTable[0]['id'] ?>";
            // {provinsi: 1000, indikator: name}
        <?php } elseif ($wilayah == 'provinsi') { ?>
            data1 = "provinsi=<?php echo $subWilayah[0]['id'] ?>&indikator=<?php echo $IndikatorTable[0]['id'] ?>";
        <?php } elseif ($wilayah == 'kabupatenkota') { ?>
            // data1 = "provinsi=<?php echo $subWilayahDaerah[0]['id'] ?>";
            data1 = "provinsi=<?php echo $subWilayah[0]['id'] ?>&kabupatenkota=<?php echo $subWilayahDaerah[0]['id'] ?>&indikator=<?php echo $IndikatorTable[0]['id'] ?>";
        <?php } ?>
        // alert(data1 + "&" + data2);

        jQuery.ajax({
            type: "POST", // HTTP method POST or GET
            url: url, //Where to make Ajax calls
            dataType: "text", // Data type, HTML, json etc.
            data: data1, //Form variables

            success: function(response) {
                var obj = jQuery.parseJSON(response);
                // console.log(obj.peta);

                var zoomThreshold = 4;
                var map = new mapboxgl.Map({
                    container: 'map',
                    //style: 'mapbox://styles/mapbox/streets-v11',
                    style: 'mapbox://styles/mapbox/light-v10',
                    center: obj.js_tengah,
                    //center: [119.206479, -0.320152],
                    zoom: obj.js_zoom
                });
                let hoveredStateId = null;
                let clickedStateId = null;

                map.addControl(new mapboxgl.NavigationControl());

                //warna peta
                if (obj.peta.features[0].properties.jenis == 'positif') {
                    // var warna1 = 'rgba(186, 6, 24, 1)'; //merah
                    var warna1 = '#ff8989'; //merah
                    // var warna2 = 'rgba(250, 250, 7, 1)'; //kuning
                    var warna2 = '#a9ff68'; //hijau
                } else if (obj.peta.features[0].properties.jenis == 'negatif') {
                    // var warna2 = 'rgba(186, 6, 24, 1)'; //merah
                    var warna2 = '#ff8989'; //merah
                    // var warna1 = 'rgba(250, 250, 7, 1)'; //kuning
                    var warna1 = '#a9ff68'; //hijau
                }

                map.on('load', function(e) {
                    map.addSource('maine', {
                        'type': 'geojson',
                        //'data': obj.js_geo
                        'data': obj.peta
                    });
                    map.addLayer({
                        'id': 'states-layer',
                        'type': 'fill',
                        'source': 'maine',
                        'paint': {
                            'fill-color': [
                                'interpolate',
                                ['linear'],
                                ['get', 'population'],
                                // [logical expression, ['get', 'data who will get'], ['get', 'data who will compare]]
                                // ['<', ['get', 'population'], ['get', 'nasional']]
                                obj.peta.features[0].properties.nasional - 0.0001,
                                warna1,
                                obj.peta.features[0].properties.nasional,
                                warna2,
                            ],
                            'fill-opacity': [
                                'case',
                                ['boolean', ['feature-state', 'hover'], false],
                                1,
                                0.5
                            ],
                        }
                    });

                    var htmlLegend = '';

                    htmlLegend += '<b>Keterangan</b><br/><hr/ style="margin-top: 5px; margin-bottom: 5px;">';

                    if (obj.peta.features[0].properties.satuan == '%') {
                        // var nilainasional = Math.round((obj.peta.features[0].properties.nasional + Number.EPSILON) * 100) / 100 + '' + obj.peta.features[0].properties.satuan;
                        var nilainasional = Math.round((obj.peta.features[0].properties.nasional + Number.EPSILON) * 100) / 100;
                    } else if (obj.peta.features[0].properties.satuan == 'Rp') {
                        // var nilainasional = obj.peta.features[0].properties.satuan + ' ' + (obj.peta.features[0].properties.nasional).toLocaleString('id-ID', {
                        var nilainasional = (obj.peta.features[0].properties.nasional).toLocaleString('id-ID', {
                            minimumFractionDigits: 0,
                            maximumFractionDigits: 2
                        });
                    } else if (obj.peta.features[0].properties.satuan == 'Orang') {
                        // var nilainasional = (obj.peta.features[0].properties.nasional).toLocaleString('id-ID') + ' ' + obj.peta.features[0].properties.satuan;
                        var nilainasional = (obj.peta.features[0].properties.nasional).toLocaleString('id-ID');
                    } else if (obj.peta.features[0].properties.satuan == 'Tahun') {
                        // var nilainasional = (obj.peta.features[0].properties.nasional).toLocaleString('id-ID', {
                        //     minimumFractionDigits: 0,
                        //     maximumFractionDigits: 2
                        // }) + ' ' + obj.peta.features[0].properties.satuan;
                        var nilainasional = (obj.peta.features[0].properties.nasional).toLocaleString('id-ID', {
                            minimumFractionDigits: 0,
                            maximumFractionDigits: 2
                        });
                    } else {
                        var nilainasional = $infographnasional[5]['nasional'];
                    }

                    //warna peta
                    if (obj.peta.features[0].properties.jenis == 'positif') {

                        htmlLegend += '<div style="display: flex;">';
                        // htmlLegend += '<div style="height: 20px; width: 20px; background-color: rgba(186, 6, 24, 1); margin-right: 20px;"></div>';
                        htmlLegend += '<div style="height: 20px; width: 20px; background-color: #ff8989; margin-right: 20px;"></div>';
                        htmlLegend += '<p style="margin-bottom: 5px;"><b> < Capaian Nasional ' + nilainasional + '</b></p>';
                        htmlLegend += '</div>';

                        htmlLegend += '<div style="display: flex;">';
                        // htmlLegend += '<div style="height: 20px; width: 20px; background-color: rgba(250, 250, 7, 1); margin-right: 20px;"></div>';
                        htmlLegend += '<div style="height: 20px; width: 20px; background-color: #a9ff68; margin-right: 20px;"></div>';
                        htmlLegend += '<p style="margin-bottom: 5px;"><b> >= Capaian Nasional ' + nilainasional + '</b></p>';
                        htmlLegend += '</div>';

                    } else if (obj.peta.features[0].properties.jenis == 'negatif') {

                        htmlLegend += '<div style="display: flex;">';
                        // htmlLegend += '<div style="height: 20px; width: 20px; background-color: rgba(250, 250, 7, 1); margin-right: 20px;"></div>';
                        htmlLegend += '<div style="height: 20px; width: 20px; background-color: #a9ff68; margin-right: 20px;"></div>';
                        htmlLegend += '<p style="margin-bottom: 5px;"><b> <= Capaian Nasional ' + nilainasional + '</b></p>';
                        htmlLegend += '</div>';

                        htmlLegend += '<div style="display: flex;">';
                        // htmlLegend += '<div style="height: 20px; width: 20px; background-color: rgba(186, 6, 24, 1); margin-right: 20px;"></div>';
                        htmlLegend += '<div style="height: 20px; width: 20px; background-color: #ff8989; margin-right: 20px;"></div>';
                        htmlLegend += '<p style="margin-bottom: 5px;"><b> > Capaian Nasional ' + nilainasional + '</b></p>';
                        htmlLegend += '</div>';
                    }

                    htmlLegend += '<hr/ style="margin-top: 2px; margin-bottom: 2px;"><b>Satuan : </b>' + obj.peta.features[0].properties.satuan;
                    // htmlLegend += '<b style="margin-left: 40px;">Jenis : </b>' + obj.peta.features[0].properties.jenis;

                    document.getElementById('legend').innerHTML = htmlLegend;

                    // When the user moves their mouse over the state-fill layer, we'll update the
                    // feature state for the feature under the mouse.
                    map.on('mousemove', 'states-layer', (e) => {
                        // console.log(e.features[0].properties.target);
                        if (e.features.length > 0) {
                            if (hoveredStateId !== null) {
                                map.setFeatureState({
                                    source: 'maine',
                                    id: hoveredStateId
                                }, {
                                    hover: false
                                });
                            }
                            hoveredStateId = e.features[0].id;
                            map.setFeatureState({
                                source: 'maine',
                                id: hoveredStateId
                            }, {
                                hover: true
                            });
                        }
                    });

                    // Create a popup, but don't add it to the map yet.
                    const popup = new mapboxgl.Popup({
                        closeButton: false,
                        closeOnClick: false
                    });

                    map.on('mousemove', 'states-layer', (e) => {
                        document.getElementById('pd').innerHTML = '<b>' + e.features[0].properties.NAME_2 + '</b>';
                        // document.getElementById('description').innerHTML = '<p style="margin-bottom: 2px;">' + e.features[0].properties.description + '</p>';
                        map.getCanvas().style.cursor = 'pointer';
                    });

                    map.on('mouseenter', 'states-layer', (e) => {
                        popup.setLngLat(e.lngLat).setHTML(e.features[0].properties.short_description).addTo(map)
                    });

                    map.on('mouseleave', 'states-layer', (e) => {
                        document.getElementById('pd').innerHTML = '<i>sorot kursor pada daerah</i>';
                        // document.getElementById('description').innerHTML = '<p><b>Keterangan</b></p>';
                        map.getCanvas().style.cursor = '';
                        popup.remove();
                    });

                    map.on('click', 'states-layer', (e) => {
                        document.getElementById('description').innerHTML = '<p style="margin-bottom: 2px;">' + e.features[0].properties.description + '</p>';
                    });

                    // map.on('mousemove', (event) => {
                    //     const states = map.queryRenderedFeatures(event.point, {
                    //         layers: ['statedata']
                    //     });
                    //     document.getElementById('pd').innerHTML = states.length ?
                    //         `<h3>${states[0].properties.name}</h3>` :
                    //         `<p>Hover over a state!</p>`;
                    // });

                    // When the mouse leaves the state-fill layer, update the feature state of the
                    // previously hovered feature.
                    map.on('mouseleave', 'states-layer', () => {
                        if (hoveredStateId !== null) {
                            map.setFeatureState({
                                source: 'maine',
                                id: hoveredStateId
                            }, {
                                hover: false
                            });
                        }
                        hoveredStateId = null;
                    });


                    // Add a black outline around the polygon.
                    map.addLayer({
                        'id': 'outline',
                        'type': 'line',
                        'source': 'maine',
                        'layout': {},
                        'paint': {
                            'line-color': '#000',
                            'line-width': [
                                'case',
                                ['boolean', ['feature-state', 'click'], false],
                                2,
                                0.5
                            ]
                        }
                    });

                    // map.on('click', 'states-layer', function(e) {
                    //     new mapboxgl.Popup()
                    //         .setLngLat(e.lngLat)
                    //         .setHTML(e.features[0].properties.description)
                    //         .addTo(map);
                    // });


                    // console.log(typeof obj.peta.features[0].properties.regional_targeted);

                    if (parseInt(obj.peta.features[0].properties.regional_targeted) != null) {
                        clickedStateId = parseInt(obj.peta.features[0].properties.regional_targeted);
                        map.setFeatureState({
                            source: 'maine',
                            id: parseInt(obj.peta.features[0].properties.regional_targeted)
                        }, {
                            click: true
                        });
                        // document.getElementById('description').innerHTML = '<p style="margin-bottom: 2px;">' + e.features[0].properties.description + '</p>';
                    }

                    // console.log(obj.peta.features.length);

                    for (let index = 0; index < obj.peta.features.length; index++) {
                        if (parseInt(obj.peta.features[0].properties.regional_targeted) == parseInt(obj.peta.features[index].properties.kode)) {
                            document.getElementById('description').innerHTML = '<p style="margin-bottom: 2px;">' + obj.peta.features[index].properties.description + '</p>';
                        }

                    }

                    // When the user clicks we'll update the
                    // feature state for the feature under the mouse.
                    map.on('click', 'states-layer', function(e) {
                        // console.log(e);
                        if (e.features.length > 0) {
                            if (clickedStateId) {
                                map.setFeatureState({
                                    source: 'maine',
                                    id: clickedStateId
                                }, {
                                    click: false
                                });
                            }
                            clickedStateId = e.features[0].id;
                            map.setFeatureState({
                                source: 'maine',
                                id: clickedStateId
                            }, {
                                click: true
                            });
                        }
                    });

                });

            },
            error: function(xhr, ajaxOptions, thrownError) {
                loading.hide();
                alert(thrownError);
            }
        });
    }
    peta();

    $("#inp_pro").change(function(e) {
        e.preventDefault();
        peta();
    });
</script>

<script>
    $(document).ready(function() {
        $(".buttons-indikator").click(function() {
            var cntrl = $(this).val();
            $(".txt-area-indikator").val(function(_, val) {
                return val + cntrl
            });
        });
    });

    $('#collapseOne').on('hidden.bs.collapse', function() {
        $(".icon-collapse-indikator-deskripsi").removeClass('fa-angle-up float-right');
        $(".icon-collapse-indikator-deskripsi").addClass('fa-angle-down float-right');
    })

    $('#collapseOne').on('shown.bs.collapse', function() {
        $(".icon-collapse-indikator-deskripsi").removeClass('fa-angle-down float-right');
        $(".icon-collapse-indikator-deskripsi").addClass('fa-angle-up float-right');
    })

    $("#btn-save-deskripsi-indikator").click(function() {
        $('#btn-save-deskripsi-indikator').append(' <i class="fa fa-spinner fa-spin loading-icon"></i>');

        var id_indikator = $("#id-deskripsi-indikator").val();
        var wilayah = $("#id-wilayah-indikator").val();
        var keterangan = $('#id-keterangan-indikator').val();
        <?php if (($wilayah == 'provinsi') || ($wilayah == 'kabupatenkota')) { ?>
            var kodeSubWilayah = $("#id-kode-sub-wilayah-indikator").val();
        <?php } ?>
        var deskripsi = $(".txt-area-indikator").val();
        // alert("id indikator : " + id_indikator + " wilayah :" + wilayah + " deskripsi " + deskripsi);

        $.ajax({
                type: "POST",
                url: "<?= base_url() ?>/C_infographController/saveDecriptionIndicator",
                data: {
                    id_indikator: id_indikator,
                    wilayah: wilayah,
                    keterangan: keterangan,
                    deskripsi: deskripsi,
                    <?php if (($wilayah == 'provinsi') || ($wilayah == 'kabupatenkota')) { ?>
                        kodeSubWilayah: kodeSubWilayah,
                    <?php } ?>
                }
            })
            .success(function(data) {
                $(".deskripsiGrafikPerbandingan").html(data);
                $('.loading-icon').remove();
            })
            .fail(function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            });
    });
</script>

<script>
    $(document).ready(function() {
        $(".buttons-indikator-2").click(function() {
            var cntrl = $(this).val();
            $(".txt-area-indikator-2").val(function(_, val) {
                return val + cntrl
            });
        });
    });

    $('#collapseTwo').on('hidden.bs.collapse', function() {
        $(".icon-collapse-indikator-deskripsi-2").removeClass('fa-angle-up float-right');
        $(".icon-collapse-indikator-deskripsi-2").addClass('fa-angle-down float-right');
    })

    $('#collapseTwo').on('shown.bs.collapse', function() {
        $(".icon-collapse-indikator-deskripsi-2").removeClass('fa-angle-down float-right');
        $(".icon-collapse-indikator-deskripsi-2").addClass('fa-angle-up float-right');
    })

    $("#btn-save-deskripsi-indikator-2").click(function() {
        $('#btn-save-deskripsi-indikator-2').append(' <i class="fa fa-spinner fa-spin loading-icon-2"></i>');

        var id_indikator = $("#id-deskripsi-indikator-2").val();
        var wilayah = $("#id-wilayah-indikator-2").val();
        var keterangan = $('#id-keterangan-indikator-2').val();
        <?php if ($wilayah == 'provinsi') { ?>
            var kodeSubWilayah = $("#id-kode-sub-wilayah-indikator-2").val();
        <?php } elseif ($wilayah == 'kabupatenkota') { ?>
            var kodeProvinsi = $("#id-kode-sub-provinsi-indikator-2").val();
            var kodeSubWilayah = $("#id-kode-sub-wilayah-indikator-2").val();
        <?php } ?>
        var deskripsi = $(".txt-area-indikator-2").val();
        // alert("id indikator : " + id_indikator + " wilayah :" + wilayah + " deskripsi " + deskripsi);

        $.ajax({
                type: "POST",
                url: "<?= base_url() ?>/C_infographController/saveDecriptionIndicator",
                data: {
                    id_indikator: id_indikator,
                    wilayah: wilayah,
                    keterangan: keterangan,
                    deskripsi: deskripsi,
                    <?php if ($wilayah == 'provinsi') { ?>
                        kodeSubWilayah: kodeSubWilayah,
                    <?php } else if ($wilayah == 'kabupatenkota') { ?>
                        kodeProvinsi: kodeProvinsi,
                        kodeSubWilayah: kodeSubWilayah,
                    <?php } ?>
                }
            })
            .success(function(data) {
                $(".deskripsiGrafikPerbandingan2").html(data);
                $('.loading-icon-2').remove();
            })
            .fail(function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            });
    });
</script>