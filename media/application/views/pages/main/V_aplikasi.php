<!-- author  : Muhamad Munawir Amin
Email        : muhamadmunawiramin@gmail.com
Last Update  : 03 July 2021 -->

    <div class="container-fluid" style="width: 90%; margin-top: 5rem">
      
      <!-- <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent">
          <li class="breadcrumb-item active" aria-current="page">Penghargaan</li>
        </ol>
      </nav> -->

      <div class="row">
        <div class="col-lg-12">
          <!-- Section Aplikasi -->
          <div class="col-md-12">
            <div class="d-flex justify-content-center">
              <!-- <h4>-- Aplikasi --</h4> -->
            </div> 
            <section class="aplikasi" style="height: 100%;">
              <!-- Search Box -->
              <!-- <div class="d-flex justify-content-center">
                <div class="col-12 col-lg-8">
                  <div class="p-1 bg-light rounded rounded-pill shadow-sm mb-4">
                    <div class="input-group">
                      <input
                        type="search"
                        placeholder='Cari "PPD" atau "Knowledge Sharing"'
                        aria-describedby="button-addon1"
                        class="form-control border-0"
                        style="border-radius: 27px"
                        id="publication_search"
                      />
                      <div class="input-group-append">
                        <button
                          id="button-addon1"
                          type="submit"
                          class="btn btn-link text-primary"
                        >
                          <i class="fa fa-search"></i>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div> -->
              <!-- End Search Box -->

              <div class="col-md-12">
                <section class="application">
                  <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent" style="padding: 0;">
                      <li class="breadcrumb-item"><h4>Aplikasi</h4></li>
                    </ol>
                  </nav>
                  <hr />
                  <div class="row">
                    <div class="col-12 col-md-6 col-lg-6 my-2">
                      <div class="card card-application my-3">
                        <div class="img-application">
                          <img
                            src="<?=base_url();?>assets/images/img/penilaian_ppd.png"
                            class="card-img-top"
                            alt="Aplikasi Penilaian PPD"
                          />
                          <div class="card-body">
                            <p class="card-text text-center" style="font-size: 0.9rem;"><b>LOGIN SISTEM PENILAIAN PPD</b></p>
                          </div>
                          <a href="https://peppd.bappenas.go.id/jumper_ppd/" target="_blank" rel="noopener" class="d-flex justify-content-center">
                            <img
                              class="align-self-center"
                              src="<?=base_url();?>assets/images/img/External_link_font_awesome.png"
                              alt="Login Sistem Penilaian PPD"
                              height="100"
                              width="100"
                            />
                          </a>
                        </div>
                      </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 my-2">
                      <div class="card card-application my-3" style="height: 91%">
                        <div class="img-application">
                          <img
                            src="<?=base_url();?>assets/images/img/aplikasi_pemantauan.png"
                            class="card-img-top"
                            alt="Aplikasi Pemantauan"
                          />
                          <div class="card-body">
                            <p class="card-text text-center" style="font-size: 0.9rem;"><b>LOGIN SISTEM PEMANTAUAN</b></p>
                          </div>
                          <a href="https://peppd.bappenas.go.id/pemantauan/" target="_blank" rel="noopener" class="d-flex justify-content-center" style="height: 104%">
                            <img
                              class="align-self-center"
                              src="<?=base_url();?>assets/images/img/External_link_font_awesome.png"
                              alt="Login Sistem Pemantauan"
                              height="100"
                              width="100"
                            />
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </section>
              </div>

            </section>
          </div>
          <!-- End Section aplikasi -->
        </div>
      </div>
    </div>

    <script>
        $(document).ready(function(){
            $("#publication_search").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                // $(".publication-list-row").filter(function() {
                $(".publication-list-content-card").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>