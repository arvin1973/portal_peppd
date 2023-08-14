<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <a href="<?=base_url();?>publication_menu/create" class="btn btn-outline-primary">Tambah</a>
            <h1 class="mr-2 float-left">Publikasi</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Publikasi</li>
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
                <input type="text" style="border-radius: 1rem;" class="form-control" id="guide_search" placeholder="Cari Pedoman...">
            </div>
        </div>

        
        <div class="row guide-list-row">
            <!-- <div class="col-sm-12">
                <h5 style="padding: 10px;"><b>2020</b></h5>
            </div> -->
            <?php foreach($list_guides as $list) { ?>
            <div class="col-md-4">
                <div class="card sm-12 guide-list-content-card">
                    <!-- <img class="card-img-top" data-src="holder.js/100px180/" alt="100%x180" style="height: 180px; width: 100%; display: block;" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22286%22%20height%3D%22180%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20286%20180%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_1786379deb1%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A14pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_1786379deb1%22%3E%3Crect%20width%3D%22286%22%20height%3D%22180%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22107.1875%22%20y%3D%2296.3%22%3E286x180%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true"> -->
                    <img class="card-img-top" src="<?=base_url();?>assets/file_publication/<?php echo str_replace(' ', '-', $list->name) ?>/<?php echo $list->title_picture ?>" alt="<?php echo $list->title_picture ?>" width="286" height="180" data-holder-rendered="true">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $list->name ?></h5>
                        <p class="card-text"><?php echo $list->description ?></p>
                        <a href="<?=base_url();?>publication_menu/<?php echo $list->id ?>/edit" class="btn btn-outline-warning">Ubah</a>
                        <form action="<?=base_url();?>publication_menu/<?php echo $list->id ?>/delete" method="post" class="d-inline">
                            <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Are you sure you want to delete this item?')">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
            <?php } ?>

        </div>

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

@endsection

@push('script')

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
        title: '<?php echo $this->session->flashdata('status') ?>'
      });

    <?php } ?>
  });
</script>

<script>
    $(document).ready(function(){
        $("#guide_search").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $(".guide-list-content-card").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>