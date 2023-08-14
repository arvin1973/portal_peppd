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
          <!-- Section Koordinasi -->
          <div class="col-md-12">
            <div class="d-flex justify-content-center">
              <!-- <h4>-- Koordinasi --</h4> -->
            </div> 
            <section class="koordinasi" style="height: 100%;">
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

              <div class="row mb-5">
                  <div class="col-sm-12 text-center">

                      <div class="home-wrapper">
                          <img src="<?=base_url();?>assets/zircosadmin/assets/images/animat-diamond-color.gif" alt="" height="180">
                          <h2 class="text-danger" style="font-family: 'Hind Madurai', sans-serif;">COMING SOON</h2>
                          <p class="text-muted" style="font-family: 'Varela Round', sans-serif;">We're making the system more awesome.</p>
                      </div>

                  </div>
              </div>

            </section>
          </div>
          <!-- End Section koordinasi -->
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