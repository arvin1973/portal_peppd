<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="<?=base_url();?>assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"><b>ADMIN</b> PORTAL</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?=base_url();?>assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?php echo $_SESSION['name']; ?></a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->

                <li class="nav-header">MENU</li>

                <li class="nav-item">
                    <a href="<?=base_url();?>dashboard" <?php echo ($this->uri->segment(1, 0) == 'dashboard' ? 'class="nav-link active"' : 'class="nav-link"'); ?>>
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?=base_url();?>user" <?php echo ($this->uri->segment(1, 0) == 'user' ? 'class="nav-link active"' : 'class="nav-link"'); ?>>
                        <i class="nav-icon fas fa-user"></i>
                        <p>Pengguna</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?=base_url();?>article" <?php echo ($this->uri->segment(1, 0) == 'article' ? 'class="nav-link active"' : 'class="nav-link"'); ?>>
                        <i class="nav-icon fas fa-newspaper"></i>
                        <p>Berita</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?=base_url();?>publication_menu" <?php echo ($this->uri->segment(1, 0) == 'publication_menu' ? 'class="nav-link active"' : 'class="nav-link"'); ?>>
                        <i class="nav-icon fas fa-book"></i>
                        <p>Publikasi</p>
                    </a>
                </li>

            </ul>

        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
