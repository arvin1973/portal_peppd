<!-- author  : Muhamad Munawir Amin
Email        : muhamadmunawiramin@gmail.com
Last Update  : 18 Juni 2021 -->

    <div class="container-fluid" style="width: 90%; margin-top: 8rem">
      <div class="row">
        <div class="col-lg-12">
          <!-- Section Publication -->
          <div class="col-md-12">
            <section class="publication">
              <!-- Search Box -->
              <div class="d-flex justify-content-center">
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
              </div>
              <!-- End Search Box -->
              <hr />
              <div class="row">
              <?php foreach($list_publications as $list) { ?>
                <div class="my-2 mx-2">
                  <div class="img-publication-box">
                    <img
                      src="<?=base_url();?>assets/file_publication/<?php echo str_replace(" ","-",$list->name);?>/<?php echo $list->title_picture ?>"
                      class="img-thumbnail img-publication"
                      alt="<?php echo $list->name ?>"
                    />
                    <a href="<?=base_url();?>file_publication/<?php echo str_replace(" ","-",$list->name);?>/<?php echo $list->file?>" data-id="<?php echo $list->id ?>" target="_blank" rel="noopener" class="d-flex justify-content-center btn-read-publication">
                      <img
                        src="<?=base_url();?>assets/images/img/see_more.png"
                        alt="Download <?php echo $list->name ?>"
                        class="align-self-center"
                        height="70"
                        width="70"
                      />
                    </a>
                  </div>
                  <a type="button" href="<?=base_url();?>assets/file_publication/<?php echo str_replace(" ","-",$list->name); ?>/<?php echo $list->file; ?>" class="btn-download-publication" data-id="<?php echo $list->id ?>" download="<?php echo $list->file; ?>"><i class="fa fa-arrow-circle-down"></i> Unduh</a>
                </div>
                <?php } ?>
              </div>
            </section>
          </div>
          <!-- End Section Publication -->
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

            $('.btn-download-publication').click(function() {
              console.log('sukses');
              var dataId = $(this).attr("data-id");
              var dataLog = "user mengunduh dokumen/file dengan id = "+dataId+" pada halaman publikasi";
              $.ajax({
                  type: "POST",
                  url: "<?=base_url();?>logPortalController/store",
                  data: { 
                    action: dataLog,
                  },
                  success: function(result) {
                    console.log(result);
                  },
                  error: function(result) {
                    console.log(result);
                  }
              });
            });

            $('.btn-read-publication').click(function() {
              console.log('sukses');
              var dataId = $(this).attr("data-id");
              var dataLog = "user menklik dokumen/file dengan id = "+dataId+" pada halaman publikasi";
              $.ajax({
                  type: "POST",
                  url: "<?=base_url();?>logPortalController/store",
                  data: { 
                    action: dataLog,
                  },
                  success: function(result) {
                    console.log(result);
                  },
                  error: function(result) {
                    console.log(result);
                  }
              });
            });

        });
    </script>