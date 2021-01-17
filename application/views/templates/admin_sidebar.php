<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo site_url(); ?>admin_dashboard">
        <div class="sidebar-brand-icon">
            <i class="fas fa-user-cog"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Admin</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?php echo ($this->uri->segment(1) == 'admin_dashboard' ? 'active' : ''); ?>">
        <a class="nav-link" href="<?php echo site_url(); ?>admin_dashboard">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        User
    </div>

    <!-- Nav Item - Users -->
    <li class="nav-item <?php echo ($this->uri->segment(2) == 'user_list' ? 'active' : ''); ?>">
        <a class="nav-link" href="<?php echo site_url(); ?>Admin_manage_user/index">
            <i class="fas fa-fw fa-users"></i>
            <span>Pengguna Web</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Kriteria
    </div>

    <!-- Nav Item - Users -->
    <li class="nav-item <?php echo ($this->uri->segment(2) == 'user_list' ? 'active' : ''); ?>">
        <a class="nav-link" href="<?php echo site_url(); ?>Kriteria/index">
            <i class="fas fa-scroll"></i>
            <span>Kriteria</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Alternatif
    </div>

    <!-- Nav Item - Users -->
    <li class="nav-item <?php echo ($this->uri->segment(2) == 'user_list' ? 'active' : ''); ?>">
        <a class="nav-link" href="<?php echo site_url(); ?>Alternatif">
            <i class="fas fa-database"></i>
            <span>Alternatif</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Perhitungan
    </div>

    <!-- Nav Item - Edit Test -->
    <li class="nav-item <?php echo ($this->uri->segment(1) == 'edit_test' ? 'active' : ''); ?>">
        <a class="nav-link" href="<?php echo site_url(); ?>perhitungan/perbandingan">
            <i class="far fa-fw fa-file-word"></i>
            <span>Perbandingan</span></a>
    </li>

    <!-- Nav Item - Payment -->
    <li class="nav-item <?php echo ($this->uri->segment(1) == 'admin_payment' ? 'active' : ''); ?>">
        <a class="nav-link" href="<?php echo site_url(); ?>admin_payment">
            <i class="far fa-fw fa-credit-card"></i>
            <span>Pembayaran</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->