<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <a href="<?=base_url();?>user/create" class="btn btn-outline-primary">Tambah</a>
            <h1 class="mr-2 float-left">Pengguna</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Pengguna</li>
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
          <div class="col-12">

            <div class="mb-5">
              <table id="datatables-users" class="table table-bordered table-striped bg-white">
                  <thead style="background-color: #007bff; color: white;">
                      <tr>
                          <th scope="col">#</th>
                          <th scope="col">Nama</th>
                          <th scope="col">Email</th>
                          <th scope="col">Dibuat pada tanggal</th>
                          <th scope="col">Aksi</th>
                      </tr>
                  </thead>
                  <tbody>
                      <?php
                      $no = 1; 
                      foreach($list_users as $list) { ?>
                      <tr>
                          <th scope="row"><?php echo $no; ?></th>
                          <td><?php echo $list->name ?></td>
                          <td><?php echo $list->email ?></td>
                          <td><?php echo $list->created_at ?></td>
                          <td>
                            <?php if ($_SESSION['name'] == $list->name) { ?>
                              <a href="<?=base_url();?>user/<?php echo $list->id ?>" class="btn btn-outline-secondary btn-sm" >Detail</a>
                              <a href="<?=base_url();?>user/<?php echo $list->id ?>/edit" class="btn btn-outline-warning btn-sm">Ubah</a>
                              <form action="<?=base_url();?>user/<?php echo $list->id ?>/destroy" method="post" class="d-inline">
                                  <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item?')">Hapus</button>
                              </form>
                            <?php } ?>
                          </td>
                      </tr>
                      <?php $no++; } ?>
                  </tbody>
              </table>
            </div>

          </div>
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

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
    var table_users = $("#datatables-users").DataTable({
      "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
      // "dom": '<"top"l>rt<"bottom"p><"clear">',
      stateSave: true,
      stateSaveCallback: function(settings,data) {
        localStorage.setItem( 'DataTables_' + settings.sInstance, JSON.stringify(data) )
      },
      stateLoadCallback: function(settings) {
        return JSON.parse( localStorage.getItem( 'DataTables_' + settings.sInstance ) )
      }
    });
  });
</script>