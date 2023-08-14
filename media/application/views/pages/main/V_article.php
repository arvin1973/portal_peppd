<!-- author  : Muhamad Munawir Amin
Email        : muhamadmunawiramin@gmail.com
Last Update  : 18 Juni 2021 -->

    <div class="container-md" style="margin-top: 4rem">
      <div class="row d-flex justify-content-center">
        <div class="col-lg-9">
          <!-- Section Article -->
          <div class="col-md-12">
            <section class="article">
              <hr />

              <div class="card">
                <div class="card-body">
                  <div class="text-justify" style="font-size: 16px">
                    <div class="row">
                      <div class="col-sm-12 col-md-6 col-lg-6 text-left">
                        <p class="card-text">
                          <small class="text-muted"
                            ><?php echo date("j F Y", strtotime(substr($article[0]->created_at, 0, 10))) ?></small
                          >
                          <span class="badge badge-secondary float-right"
                            ><?php echo $article[0]->name ?></span
                          >
                        </p>
                        <h3>
                          <?php echo $article[0]->title ?>
                        </h3>
                        <p>
                          <a href="">
                            <span class="badge badge-secondary my-1 mt-xl-3 mr-3" style="float: left; background-color: #1877F2">
                              <i class="fa fa-facebook-official" aria-hidden="true"></i>
                              Share on Facebook
                            </span>
                          </a>
                          <a href="">
                            <span class="badge badge-secondary my-1 mt-xl-3" style="float: left; background-color: #1B95E0;">
                              <i class="fa fa-twitter" aria-hidden="true"></i>
                              Share on Twitter
                            </span>
                          </a>
                      </p>
                      </div>
                      <div class="col-sm-12 col-md-6 col-lg-6">
                        <img
                          class="img-thumbnail"
                          src="<?=base_url();?>assets/images/summernote/<?php echo $article[0]->title_picture ?>"
                          alt="<?php echo $article[0]->title ?>"
                          height="300"
                          width="300"
                        />
                      </div>
                    </div>
                    <hr />
                    <div class="col-lg-12">
                      <p><?php echo $article[0]->text ?></p>
                    </div>
                    <button type="button" class="btn btn-info ml-3 mt-3 btn-sm">
                      Page Hint <span class="badge badge-light"><?php echo count($page_hint) ?></span>
                      <span class="sr-only">people see this article</span>
                    </button>
                    <?php if(($article_after != '') || ($article_before != '')) { ?>
                      <hr />
                      <h5 class="ml-3 mb-4">Artikel Terkait</h5>
                      <ul style="font-size: 14px;">
                      <?php foreach($article_after as $Aafter) { ?>
                        <li><a href="<?php base_url();?><?php echo $Aafter->slug ?>" data-toggle="tooltip" title="<img class='w-100' src='<?=base_url();?>assets/images/summernote/<?php echo $Aafter->title_picture ?>' />"><?php echo $Aafter->title ?></a></li>
                      <?php } ?>
                      <?php foreach($article_before as $Abefore) { ?>
                        <li><a href="<?php base_url();?><?php echo $Abefore->slug ?>" data-toggle="tooltip" title="<img class='w-100' src='<?=base_url();?>assets/images/summernote/<?php echo $Abefore->title_picture ?>' />"><?php echo $Abefore->title ?></a></li>
                      <?php } ?>
                    <?php } ?>
                      <!-- <li><a href="#">Manajemen Data SPBE Menentukan Kualitas Data Indonesia</a></li> -->
                    </ul>
                    <hr />
                    <h5 class="mx-3 mb-4">Komentar</h5>
                    <div class="card mx-3" style="background-color: #F0F0E1;">
                      <div class="card-body">
                        <h6 class="card-title">Tinggalkan Komentar</h6>
                        <hr />
                        <form class="form-comment">
                          <div class="row">
                            <!-- <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" /> -->
                            <input type="hidden" id="id_article" name="id_article" value="<?php echo $article[0]->id ?>">
                            <input type="hidden" id="id_comment" name="id_comment" value="-">
                            <div class="col-12 col-md-6 col-lg-6">
                              <div class="form-group">
                                <label for="name">Nama</label>
                                <?php if(@$_SESSION['hak_akses'] == 'admin') { ?>
                                  <input type="text" class="form-control" id="name" name="name" placeholder="Nama Anda" value="admin" readonly>
                                <?php }else{ ?>
                                  <input type="text" class="form-control" id="name" name="name" placeholder="Nama Anda" maxlength="25" required>
                                <?php } ?>
                              </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                              <div class="form-group">
                                <label for="email">Email</label>
                                <?php if(@$_SESSION['hak_akses'] == 'admin') { ?>
                                  <input type="email" class="form-control" id="email" name="email" placeholder="Alamat Email" value="<?php echo $_SESSION['email'] ?>" readonly>
                                <?php }else{ ?>
                                  <input type="email" class="form-control" id="email" name="email" placeholder="Alamat Email" required>
                                <?php } ?>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-12">
                              <div class="form-group">
                                <label for="comment">Komentar</label>
                                <textarea class="form-control" id="comment" name="comment" rows="3" maxlength="255" required></textarea>
                              </div>
                            </div>
                          </div>
                          <button type="submit" class="btn btn-outline-secondary btn-sm float-right btn-comment-submit">Kirim</button>
                        </form>
                      </div>
                    </div>
                    <hr />
                    <div class="box-comment">
                    </div>
                  </div>
                </div>
              </div>

            </section>
          </div>
          <!-- End Section Article -->
        </div>
      </div>
    </div>
    
  <script>

    function cardOver(id) {
      $(".icon-message-reply-"+id).css("color", "black");
      $(".icon-message-delete-"+id).css("color", "black");
    }

    function cardOut(id) {
      $(".icon-message-reply-"+id).css("color", "transparent");
      $(".icon-message-delete-"+id).css("color", "transparent");
    }

    $(document).ready(function() {

      $('a[data-toggle="tooltip"]').tooltip({
          animated: 'fade',
          placement: 'bottom',
          html: true
      });

      list_comment();

      function list_comment() {
        var id_article = <?php echo $article[0]->id ?>;
        $.ajax({
          type: "POST",
          url: "<?=base_url();?>commentController/index",
          data: {
            id_article: id_article,
          },
          success: function(result) {
            // console.log(JSON.parse(result));
            file = JSON.parse(result);
            $(".card-box-comment").remove();
            var boxComment = '';

            boxComment += '<div class="accordion" id="accordionReply">';
            boxComment += '<div class="card-box-comment">';

            boxComment += file;

            /* $.each(file, function(key, value) {
              boxComment += '<div class="card my-2" id="headingReply-'+value.id+'">';
              boxComment += '<div class="card-body">';
              boxComment += '<p class="card-text">';
              boxComment += '<small class="text-muted">'+value.name+'</small>';
              boxComment += '<small class="text-muted float-right">'+value.created_at.substr(0, 10)+'</small>';
              boxComment += '</p>';
              boxComment += '<p class="card-text">'+value.comment+'</p>';
              boxComment += '<div class="float-right">';
              boxComment += '<a data-toggle="collapse" data-target="#collapseReply-'+value.id+'" aria-expanded="false" aria-controls="collapseReply-'+value.id+'"><i class="fa fa-reply icon-message-reply ml-3" aria-hidden="true" title="Reply Message" data-id="'+value.id+'"></i></a>';
              boxComment += '<i class="fa fa-trash icon-message-delete ml-3" aria-hidden="true" title="Delete Message" data-id="'+value.id+'" data-email="'+value.email+'"></i>';
              boxComment += '</div>';
              boxComment += '</div>';
              boxComment += '</div>';

              boxComment += '<div id="collapseReply-'+value.id+'" class="collapse" aria-labelledby="headingReply-'+value.id+'" data-parent="#accordionReply">';
              boxComment += '<div class="card ml-3 mb-3 px-3 pb-3" style="background-color: #F0F0E1;">';
              boxComment += '<div class="card-body pt-3 pb-1 px-0">';
              boxComment += '<h6 class="card-title my-1">Balas Komentar</h6>';
              boxComment += '</div>';
              boxComment += '<hr class="my-1"/>';
              boxComment += '<form class="form-comment">';
              boxComment += '<div class="row mt-2">';
              boxComment += '<input type="hidden" id="id_article_reply" name="id_article" value="'+value.id_article+'">';
              boxComment += '<input type="hidden" id="id_comment_reply" name="id_comment" value="'+value.id+'">';
              boxComment += '<div class="col-12 col-md-6 col-lg-6">';
              boxComment += '<div class="form-group">';
              boxComment += '<label for="name">Nama</label>';
              boxComment += '<input type="text" class="form-control" id="name_reply" name="name" placeholder="Nama Anda">';
              boxComment += '</div>';
              boxComment += '</div>';
              boxComment += '<div class="col-12 col-md-6 col-lg-6">';
              boxComment += '<div class="form-group">';
              boxComment += '<label for="email">Email</label>';
              boxComment += '<input type="email" class="form-control" id="email_reply" name="email" placeholder="Alamat Email">';
              boxComment += '</div>';
              boxComment += '</div>';
              boxComment += '</div>';
              boxComment += '<div class="row">';
              boxComment += '<div class="col-12">';
              boxComment += '<div class="form-group">';
              boxComment += '<label for="comment">Komentar</label>';
              boxComment += '<textarea class="form-control" id="comment_reply" name="comment" rows="3"></textarea>';
              boxComment += '</div>';
              boxComment += '</div>';
              boxComment += '</div>';
              boxComment += '<button type="submit" class="btn btn-outline-secondary btn-sm float-right btn-comment-submit">Kirim</button>';
              boxComment += '<button class="btn btn-outline-warning btn-sm float-right mx-1 btn-comment-batal" data-id="'+value.id+'">Batal</button>';
              boxComment += '</form>';
              boxComment += '</div>';
              boxComment += '</div>';
            }); */
            boxComment += '</div>';
            boxComment += '</div>';

            $('.box-comment').append(boxComment);
          },
          error: function(result) {
            // console.log(result);
          }
        });
      }

      // function batalComment(id) {
      //   $('#collapseReply-'+id).collapse('hide');
      // }

      $(document).on('click', '.btn-comment-batal', function(e) {
        e.preventDefault();
        id = $(this).data("id");
        console.log(id);
        $('#collapseReply-'+id).collapse('hide');
      }); 


      $(document).on("submit", ".form-comment", function(e) {
        $('.btn-comment-submit').append( ' <i class="fa fa-spinner fa-spin icon-comment-loading"></i>' );
        e.preventDefault();
        var formData = $(this).serialize(); 
        $.ajax({
            type: "POST",
            url: "<?=base_url();?>commentController/store",
            data: formData,
            success: function(result) {
              console.log(result);
              $('.form-comment').trigger("reset");
              $(".icon-comment-loading").remove();

              list_comment();
            },
            error: function(result) {
              console.log(result);
            }
        });
      });

      // Start :: Action Delete Comment
      $(document).on('click', 'i[class*=icon-message-delete-]', function() {

        // var confirmDelete = confirm("Are you sure you want to delete this record?");
        // var confirmDelete = prompt("If you sure you want to delete this record, please enter your email:", "123@email.com");
        var confirmDelete = prompt("Jika anda yakin menghapus komentar ini, mohon masukan email:", "123@email.com");

        var id = $(this).data('id');
        var email = $(this).data('email');
        // alert($(this).data('id'));

        // if (confirmDelete == true) {
        if (confirmDelete == email) {
          $.ajax({
            type: "POST",
            url: "<?=base_url();?>commentController/destroy",
            data: {
              id: id,
            },
            success: function(result) {
              // console.log(result);

              list_comment();
            },
            error: function(result) {
              // console.log(result);
            }
          });
        }else{
          alert('Email anda tidak sama dengan email komentar');
        }
      });
      // End :: Action Delete Comment

    });
  </script>