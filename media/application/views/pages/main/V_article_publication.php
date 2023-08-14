<!-- author  : Muhamad Munawir Amin
Email        : muhamadmunawiramin@gmail.com
Last Update  : 18 Juni 2021 -->

    <div class="container-md" style="margin-top: 8rem">
      <div class="row d-flex justify-content-center">
        <div class="col-lg-10">
          <!-- Section News -->
          <div class="col-md-12">
            <section class="news">
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
                        id="news_search"
                      />
                      <div class="input-group-append">
                        <button
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

              <?php foreach($articles as $article) { ?>
              <div class="news-list-content-card card mb-3">
                <div class="row no-gutters">
                  <div class="col-md-5">
                    <img
                      class="w-100 img-news"
                      src="<?php base_url();?>assets/images/summernote/<?php echo $article->title_picture ?>"
                      alt="Knowledge Sharing"
                    />
                  </div>
                  <div class="col-md-7">
                    <div class="card-body">
                      <p class="card-text">
                        <small class="text-muted"
                          ><?php echo date("j F Y", strtotime(substr($article->created_at, 0, 10))) ?></small
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
                        <?php echo (strlen($article->description) > 105) ? substr($article->description, 0, 101).'...' : $article->description ?>
                        <!-- <i><a class="btn-read-more-article" data-id="<?php echo $article->id ?>" target="_blank" rel="noopener" href="<?php base_url();?>news/<?php echo $article->slug ?>" title="<?php echo $article->title ?>">selengkapnya</a></i> -->
                        <br/><a type="button" class="button-read-more btn-read-more-article" data-id="<?php echo $article->id ?>" target="_blank" rel="noopener" href="<?php base_url();?>news/<?php echo $article->slug ?>" title="<?php echo $article->title ?>">Selengkapnya...</a>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              <?php } ?>
            </section>
          </div>
          <!-- End Section News -->
        </div>
      </div>
    </div>

    <script>
        $(document).ready(function(){   
            
            $("#news_search").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                // $(".news-list-row").filter(function() {
                $(".news-list-content-card").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });

            $('.btn-read-more-article').click(function() {
              console.log('sukses');
              var dataId = $(this).attr("data-id");
              var dataLog = "user mengklik article dengan id = "+dataId+" pada halaman article";
              $.ajax({
                  type: "POST",
                  url: "<?=base_url();?>logPortalController/store",
                  data: { 
                    action: dataLog,
                  },
                  success: function(result) {
                    // console.log(result);
                  },
                  error: function(result) {
                    console.log(result);
                  }
              });
            });

        });
    </script>