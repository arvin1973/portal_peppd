<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <a href="<?=base_url();?>article/create" class="btn btn-outline-primary">Tambah</a>
            <h1 class="mr-2 float-left">Berita</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Berita</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid" style="width: 90%;">

        <div class="d-flex justify-content-center my-4">
            <div class="input-group mb-2" style="width: 60%;">
                <input type="text" style="border-radius: 1rem;" class="form-control" id="article_search" placeholder="Cari Publikasi...">
            </div>
        </div>

        <nav>
          <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a class="nav-link <?php echo($this->session->flashdata("status") == null) ? 'active' : '' ?>" id="nav-publish-tab" data-toggle="tab" href="#nav-publish" role="tab" aria-controls="nav-publish" aria-selected="true">Publish</a>
            <a class="nav-link <?php echo($this->session->flashdata("status") != null) ? 'active' : '' ?>" id="nav-draft-tab" data-toggle="tab" href="#nav-draft" role="tab" aria-controls="nav-draft" aria-selected="false">draft</a>
            <!-- <a class="nav-link" id="nav-trash-tab" data-toggle="tab" href="#nav-trash" role="tab" aria-controls="nav-trash" aria-selected="false">trash</a> -->
          </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
          <div class="tab-pane fade <?php echo($this->session->flashdata("status") == null) ? 'show active' : '' ?>" style="padding: 10px;" id="nav-publish" role="tabpanel" aria-labelledby="nav-publish-tab">
            
            <div class="row article-list-row-publish">
                <!-- <div class="col-sm-12">
                    <h5 style="padding: 10px;"><b>2020</b></h5>
                </div> -->
                <?php foreach($list_articles as $list) { ?>

                <?php if($list->status == 'publish') { ?>
                <div class="card sm-12 article-list-content-card" id="article-content-<?php echo $list->id ?>">
                    <div class="row no-gutters">
                        <div class="col-md-5">
                            <img src="<?=base_url();?>assets/images/summernote/<?php echo $list->title_picture ?>" width="273" height="245" class="card-img" alt="<?php echo $list->title ?>">
                        </div>
                        <div class="col-md-7">
                            <div class="card-body">
                                <p class="card-text">
                                    <i><?php echo $list->created_at ?></i>
                                    <span class="badge badge-secondary float-right"><?php echo $list->name ?></span>
                                </p>
                                <h5 class="card-title"><b><?php echo $list->title ?></b></h5>
                                <p class="card-text"><?php echo (strlen($list->description) > 130) ? substr($list->description, 0, 126).'...' : $list->description ?> <i><a target="_blank" rel="noopener" href="<?=base_url();?>news/<?php echo $list->slug ?>" title="<?php echo $list->title ?>">selengkapnya</a></i></p>
                                  <button type="button" class="btn btn-outline-info btn-copy-link" data-url="<?=base_url();?>news/<?php echo $list->slug ?>" data-toggle="tooltip" data-placement="top" title="Copy to clipboard">Copy Link</button>
                                  <button class="btn btn-outline-secondary changeStatusArticle" data-id="<?php echo $list->id ?>" data-status="draft">draft</button>
                                  <a href="<?=base_url();?>article/<?php echo $list->slug ?>/edit" class="btn btn-outline-warning">Ubah</a>
                                  <form action="<?=base_url();?>article/<?php echo $list->id ?>/delete" method="post" class="d-inline">
                                    <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Are you sure you want to delete this item?')">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>

                <?php } ?>
            </div>
          
          </div>
          <div class="tab-pane fade <?php echo($this->session->flashdata("status") != null) ? 'show active' : '' ?>" style="padding: 10px;" id="nav-draft" role="tabpanel" aria-labelledby="nav-draft-tab">
          
            <div class="row article-list-row-draft">
                <!-- <div class="col-sm-12">
                    <h5 style="padding: 10px;"><b>2020</b></h5>
                </div> -->
                <?php foreach($list_articles as $list) { ?>

                <?php if($list->status == 'draft') { ?>
                <div class="card sm-12 article-list-content-card" id="article-content-<?php echo $list->id ?>">
                    <div class="row no-gutters">
                        <div class="col-md-5">
                            <img src="<?=base_url();?>assets/images/summernote/<?php echo $list->title_picture ?>" width="273" height="245" class="card-img" alt="<?php echo $list->title ?>">
                        </div>
                        <div class="col-md-7">
                            <div class="card-body">
                                <p class="card-text">
                                    <i><?php echo $list->created_at ?></i>
                                    <span class="badge badge-secondary float-right"><?php echo $list->name ?></span>
                                </p>
                                <h5 class="card-title"><b><?php echo $list->title ?></b></h5>
                                <p class="card-text"><?php echo (strlen($list->description) > 130) ? substr($list->description, 0, 126).'...' : $list->description ?> <i><a target="_blank" rel="noopener" href="<?=base_url();?>news/<?php echo $list->slug ?>" title="<?php echo $list->title ?>">selengkapnya</a></i></p>
                                  <button type="button" class="btn btn-outline-info btn-copy-link" data-url="<?=base_url();?>news/<?php echo $list->slug ?>" data-toggle="tooltip" data-placement="top" title="Copy to clipboard">Copy Link</button>
                                  <button class="btn btn-outline-secondary changeStatusArticle" data-id="<?php echo $list->id ?>" data-status="publish">publish</button>
                                  <a href="<?=base_url();?>article/<?php echo $list->slug ?>/edit" class="btn btn-outline-warning">Edit</a>
                                  <form action="<?=base_url();?>article/<?php echo $list->id ?>/delete" method="post" class="d-inline">
                                    <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Are you sure you want to delete this item?')">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>

                <?php } ?>
            </div>

          </div>
          <div class="tab-pane fade" style="padding: 10px;" id="nav-trash" role="tabpanel" aria-labelledby="nav-trash-tab">
          
            <div class="row article-list-row-trash">
                <!-- <div class="col-sm-12">
                    <h5 style="padding: 10px;"><b>2020</b></h5>
                </div> -->
                <?php foreach($list_articles as $list) { ?>

                <?php if($list->status == 'trash') { ?>
                <div class="card sm-12 article-list-content-card" id="article-content-<?php echo $list->id ?>">
                    <div class="row no-gutters">
                        <div class="col-md-5">
                            <img src="<?=base_url();?>assets/images/summernote/<?php echo $list->title_picture ?>" width="273" height="245" class="card-img" alt="<?php echo $list->title ?>">
                        </div>
                        <div class="col-md-7">
                            <div class="card-body">
                                <p class="card-text">
                                    <i><?php echo $list->created_at ?></i>
                                    <span class="badge badge-secondary float-right"><?php echo $list->name ?></span>
                                </p>
                                <h5 class="card-title"><b><?php echo $list->title ?></b></h5>
                                <p class="card-text"><?php echo (strlen($list->description) > 130) ? substr($list->description, 0, 126).'...' : $list->description ?> <i><a target="_blank" rel="noopener" href="<?=base_url();?>news/<?php echo $list->slug ?>" title="<?php echo $list->title ?>">selengkapnya</a></i></p>
                                  <button class="btn btn-outline-secondary changeStatusArticle" data-id="<?php echo $list->id ?>" data-status="draft">draft</button>
                                  <a href="<?=base_url();?>article/<?php echo $list->slug ?>/edit" class="btn btn-outline-warning">Edit</a>
                                  <form action="<?=base_url();?>article/<?php echo $list->id ?>/delete" method="post" class="d-inline">
                                    <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Are you sure you want to delete this item?')">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>

                <?php } ?>
            </div>

          </div>
        </div>

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<script type="text/javascript">
  $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })

  $(document).on('click', '.btn-copy-link', function() {
    var dataUrl = $(this).attr("data-url");

    var textarea = document.createElement("textarea");
    textarea.textContent = dataUrl;
    textarea.style.position = "fixed"; // Prevent scrolling to bottom of page in MS Edge.
    document.body.appendChild(textarea);
    textarea.select();

    document.execCommand("copy"); 

    $(this).tooltip('hide')
          .attr('data-original-title', 'Copied!')
          .tooltip('show');

    document.body.removeChild(textarea);

    console.log($(this).attr("data-url"));
  });

  $(document).on('mouseout', '.btn-copy-link', function() {
    $(this).attr('data-original-title', 'Copy to clipboard');
  });
</script>


<script>
  $(document).ready(function(){
    <?php if($this->session->flashdata('status') == TRUE) { ?>

      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 5000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
      });

      Toast.fire({
        icon: 'success',
        title: '<?php echo $this->session->flashdata("status") ?>'
      });

    <?php } ?>
  });
</script>

<script>
    $(document).ready(function(){
        $("#article_search").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $(".article-list-content-card").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>

<script>
  $(document).ready(function(){

    $(document).on('click', '.changeStatusArticle', function() {
      var dataId = $(this).attr("data-id");
      var dataStatus = $(this).attr("data-status");
      
      $.ajax({
          type: "POST",
          url: "<?=base_url()?>admin/C_articlesController/updateStatus",
          data: { id: dataId, status: dataStatus },
          success: function(data) {
              console.log(JSON.parse(data));
              var result = JSON.parse(data);
              $('#article-content-'+dataId).remove();

              if(result[0].status == 'publish') {
                var status = 'draft';
              }else if(result[0].status == 'draft') {
                var status = 'publish';
              }

              if(result[0].text.length > 130) {
                var text_article = result[0].description.substr(0, 126)+'...';
              }else{
                var text_article = result[0].description;
              }
              
              var APP_URL = '<?=base_url();?>';
              var listArticle = '';
                  listArticle += '<div class="card sm-12 article-list-content-card" id="article-content-'+result[0].id+'">';
                  listArticle += '<div class="row no-gutters">';

                  listArticle += '<div class="col-md-5">';
                  listArticle += '<img src="'+APP_URL+'assets/images/summernote/'+result[0].title_picture+'" width="273" height="245" class="card-img" alt="'+result[0].title+'">';
                  listArticle += '</div>';

                  listArticle += '<div class="col-md-7">';
                  listArticle += '<div class="card-body">';
                  
                  listArticle += '<p class="card-text">';
                  listArticle += '<i>'+result[0].created_at+'</i>';
                  listArticle += '<span class="badge badge-secondary float-right">'+result[0].name+'</span>';
                  listArticle += '</p>';
                  listArticle += '<h5 class="card-title"><b>'+result[0].title+'</b></h5>';
                  listArticle += '<p class="card-text">'+text_article+'<i><a target="_blank" rel="noopener" href="'+APP_URL+'news/'+result[0].slug+'" title="'+result[0].title+'">selengkapnya</a></i></p>';
                  listArticle += '<button type="button" class="btn btn-outline-info btn-copy-link" data-url="'+APP_URL+'news/'+result[0].slug+'" data-toggle="tooltip" data-placement="top" title="Copy to clipboard">Copy Link</button>'
                  listArticle += '<button class="btn btn-outline-secondary changeStatusArticle" data-id="'+result[0].id+'" data-status="'+status+'">'+status+'</button> ';
                  listArticle += '<a href="'+APP_URL+'article/'+result[0].slug+'/edit" class="btn btn-outline-warning">Edit</a> ';
                  listArticle += '<form action="'+APP_URL+'article/'+result[0].id+'/delete" method="post" class="d-inline">';
                  listArticle += '<button type="submit" class="btn btn-outline-danger" onclick="return confirm(`Are you sure you want to delete this item?`)">Delete</button> ';
                  listArticle += '</form>';

                  listArticle += '</div>';
                  listArticle += '</div>';
                  
                  listArticle += '</div>';
                  listArticle += '</div>';

              if(result[0].status == 'publish'){
                $('.article-list-row-publish').append(listArticle);
              }else if(result[0].status == 'draft'){
                $('.article-list-row-draft').append(listArticle);
              }
          },
          error: function(data) {
              console.log(data);
          }
      });

    });

  });
</script>