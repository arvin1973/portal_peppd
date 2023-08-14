<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <a href="<?=base_url();?>user/create" class="btn <?php echo ($this->uri->segment(2, 0) == 'create' ? 'btn-primary' : 'btn-outline-primary'); ?>">Tambah</a>
            <h1 class="mr-2 float-left">Pengguna</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url();?>user">Pengguna</a></li>
              <li class="breadcrumb-item active">Tambah Pengguna</li>
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
              <table id="datatables-users-create" class="table table-bordered table-striped bg-white">
                  <thead style="background-color: #007bff; color: white;">
                      <tr>
                          <th scope="col">#</th>
                          <th scope="col">Name</th>
                          <th scope="col">Email</th>
                          <th scope="col">Action</th>
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
                          <td>
                            <?php if ($_SESSION['name'] == $list->name) { ?>
                              <a href="<?=base_url();?>user/<?php echo $list->id ?>" class="btn btn-outline-secondary btn-sm" >Detail</a>
                              <a href="<?=base_url();?>user/<?php echo $list->id ?>/edit" class="btn btn-outline-warning btn-sm">Ubah</a>
                              <form action="<?=base_url();?>user/<?php echo $list->id ?>/delete" method="post" class="d-inline">
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
          <div class="col-md-4">
            
            <!-- Form Create User -->
            <div id="form-create-user">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title"><b>Tambah Pengguna</b></h3>
                  <a href="<?=base_url();?>user" class="close" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </a>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="<?=base_url();?>admin/C_usersController/store" method="post">
                  <div class="card-body">
                    <div class="form-group">
                      <label for="name">Nama</label>
                      <input type="text" class="form-control" id="name" name="name" placeholder="Masukan Nama" autofocus>
                    </div>
                    <div class="form-group">
                      <label for="email">Email</label>
                      <input type="email" class="form-control" id="email" name="email" placeholder="Masukan Email">
                    </div>
                    <div class="form-group">
                      <label for="password">Password</label>
                      <input type="password" class="form-control" id="password" name="password" placeholder="Masukan Password">
                    </div>
                    <div class="form-group">
                      <label for="password_confirmation">Password Confirm</label>
                      <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Masukan Password Confirmation">
                    </div>
                    <div class="form-group">
                      <label for="user_picture">Gambar</label>
                      <div class="input-group">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="user_picture">
                          <label class="custom-file-label" for="user_picture">Pilih gambar</label>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- /.card-body -->

                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary"><b>Tambah</b></button>
                  </div>
                </form>
              </div>
            </div>
            <!-- End Form Create User -->

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
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
      });

      Toast.fire({
        icon: 'success',
        title: '<?php echo $this->session->flashdata('status'); ?>'
      });
    <?php } ?>


    $(window).scroll(function() {
      var scrolled = $(window).scrollTop();
      var widthcontainer = $('.content').width();
      
      if (scrolled > 250) {
        $("#form-create-user").addClass("position-fixed");
        $("#form-create-user").css({'top' : '0', 'width' : (32 * widthcontainer) / 100, 'margin-top' : '1%'});
      }else{
        $("#form-create-user").removeClass("position-fixed");
        $("#form-create-user").css({'top' : '', 'width' : '', 'margin-top' : ''});
      }
    });

  });
</script>

<script>
  $(document).ready(function(){
    $("#datatables-users-create").DataTable({
      "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
      // "order": [[ 0, "desc" ]],
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