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
          <!-- Section Penghargaan -->
          <div class="col-md-12">
            <div class="d-flex justify-content-center">
              <!-- <h4>-- Penghargaan --</h4> -->
            </div> 
            <!-- <hr/> -->
            <section class="penghargaan">
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
                <section class="activity">
                  <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent" style="padding: 0;">
                      <li class="breadcrumb-item"><h4>Penghargaan Pembangunan Daerah (PPD)</h4></li>
                    </ol>
                  </nav>
                  <hr />
                  <div class="row my-4 d-flex justify-content-center">
                    <div class="col-12 col-md-6 col-lg-3 my-2 rounded-3">
                      <a href="<?=base_url();?>kegiatan/penghargaan/profil" style="text-decoration: none;">
                        <div class="card card-activity card-activity-menu">
                          <div class="card-body">
                            <div class="box-img-activity col d-flex justify-content-center">
                              <img
                                class="img-fluid mb-4"
                                style="width: 70%;"
                                src="<?=base_url();?>assets/images/img/logo-kegiatan/profil-ppd.png"
                                alt="card image"
                              />
                            </div>
                            <p class="card-text text-center text-activity text-activity-menu">
                              PROFIL
                            </p>
                          </div>
                        </div>
                      </a>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3 my-2 rounded-3">
                      <a href="<?=base_url();?>kegiatan/penghargaan/pedoman" style="text-decoration: none;">
                        <div class="card card-activity card-activity-menu">
                          <div class="card-body">
                            <div class="box-img-activity col d-flex justify-content-center">
                              <img
                                class="img-fluid mb-4"
                                style="width: 70%;"
                                src="<?=base_url();?>assets/images/img/logo-kegiatan/pedoman-ppd.svg"
                                alt="card image"
                              />
                            </div>
                            <p class="card-text text-center text-activity text-activity-menu">
                              PEDOMAN
                            </p>
                          </div>
                        </div>
                      </a>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3 my-2 rounded-3">
                      <a href="https://peppd.bappenas.go.id/jumper_ppd/" target="_blank" rel="noopener" style="text-decoration: none;">
                        <div class="card card-activity card-activity-menu">
                          <div class="card-body">
                            <div class="box-img-activity col d-flex justify-content-center">
                              <img
                                class="img-fluid mb-4"
                                style="width: 70%;"
                                src="<?=base_url();?>assets/images/img/logo-kegiatan/login-sistem.png"
                                alt="card image"
                              />
                            </div>
                            <p class="card-text text-center text-activity text-activity-menu">
                              LOGIN SISTEM
                            </p>
                          </div>
                        </div>
                      </a>
                    </div>
                  </div>
                </section>
              </div>

            </section>
          </div>
          <!-- End Section penghargaan -->
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