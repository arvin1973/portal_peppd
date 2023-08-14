<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <a href="<?= base_url(); ?>user/create" class="btn btn-outline-primary">Tambah</a>
          <h1 class="mr-2 float-left">Pengguna</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url(); ?>user">Pengguna</a></li>
            <li class="breadcrumb-item active">Detail Pengguna</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Main row -->
      <div class="row">
        <div class="col-md-8">
          <div class="mb-5">
            <table id="datatables-users-show" class="table table-bordered table-striped bg-white">
              <thead style="background-color: #007bff; color: white;">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Nama</th>
                  <th scope="col">Email</th>
                  <th scope="col">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                foreach ($list_users as $list) { ?>
                  <tr>
                    <th scope="row"><?php echo $no; ?></th>
                    <td><?php echo $list->name ?></td>
                    <td><?php echo $list->email ?></td>
                    <td>
                      <?php if ($_SESSION['name'] == $list->name) { ?>
                        <a href="<?= base_url(); ?>user/<?php echo $list->id ?>" class="btn <?php echo ($this->uri->segment(2, 0) == $list->id ? 'btn-secondary' : 'btn-outline-secondary'); ?> btn-sm">Detail</a>
                        <a href="<?= base_url(); ?>user/<?php echo $list->id ?>/edit" class="btn btn-outline-warning btn-sm">Ubah</a>
                        <form action="<?= base_url(); ?>user/<?php echo $list->id ?>/delete" method="post" class="d-inline">
                          <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item?')">Hapus</button>
                        </form>
                      <?php } ?>
                    </td>
                  </tr>
                <?php $no++;
                } ?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="col-md-4">

          <!-- Profile-image -->
          <div id="card-profile">
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <a href="<?= base_url(); ?>user" class="close" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </a>
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle" src="<?= base_url(); ?>assets/dist/img/user4-128x128.jpg" alt="User profile picture">
                </div>

                <h3 class="profile-username text-center"><?php echo $user[0]->name ?></h3>

                <p class="text-muted text-center"><?php echo $user[0]->email ?></p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Verifikasi Email</b> <a class="float-right"><?php echo $user[0]->email_verified_at ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Dibuat pada tanggal</b> <a class="float-right"><?php echo $user[0]->created_at ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Diubah pada tanggal</b> <a class="float-right"><?php echo $user[0]->updated_at ?></a>
                  </li>
                </ul>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
          <!-- End profile-image -->

        </div>
      </div>
      <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>


<script>
  $(document).ready(function() {

    $(window).scroll(function() {
      var scrolled = $(window).scrollTop();
      var widthcontainer = $('.content').width();

      if (scrolled > 150) {
        $("#card-profile").addClass("position-fixed");
        $("#card-profile").css({
          'top': '0',
          'width': (32 * widthcontainer) / 100,
          'margin-top': '1%'
        });
      } else {
        $("#card-profile").removeClass("position-fixed");
        $("#card-profile").css({
          'top': '',
          'width': '',
          'margin-top': ''
        });
      }
    });

  });
</script>

<script>
  $(document).ready(function() {
    $("#datatables-users-show").DataTable({
      "lengthMenu": [
        [10, 25, 50, -1],
        [10, 25, 50, "All"]
      ],
      // "dom": '<"top"l>rt<"bottom"p><"clear">',
      stateSave: true,
      stateSaveCallback: function(settings, data) {
        localStorage.setItem('DataTables_' + settings.sInstance, JSON.stringify(data))
      },
      stateLoadCallback: function(settings) {
        return JSON.parse(localStorage.getItem('DataTables_' + settings.sInstance))
      }
    });
  });
</script>