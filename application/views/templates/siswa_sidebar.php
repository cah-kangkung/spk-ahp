<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

   <!-- Sidebar - Brand -->
   <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo site_url(); ?>siswa_dashboard">
      <div class="sidebar-brand-icon">
         <i class="fas fa-user-graduate"></i>
      </div>
      <div class="sidebar-brand-text mx-3">Siswa</div>
   </a>

   <!-- Divider -->
   <hr class="sidebar-divider my-0">

   <!-- Nav Item - Dashboard -->
   <li class="nav-item <?php echo ($this->uri->segment(1) == 'siswa_dashboard' ? 'active' : ''); ?>">
      <a class="nav-link" href="<?php echo site_url(); ?>siswa_dashboard">
         <i class="fas fa-fw fa-tachometer-alt"></i>
         <span>Dashboard</span></a>
   </li>

   <!-- Divider -->
   <hr class="sidebar-divider">

   <!-- Heading -->
   <div class="sidebar-heading">
      User
   </div>

   <!-- Nav Item - Payment -->
   <li class="nav-item <?php echo ($this->uri->segment(1) == 'admin_payment' ? 'active' : ''); ?>">
      <a class="nav-link" href="<?php echo site_url(); ?>Siswa_hasil/tampil">
         <i class="far fa-fw fa-credit-card"></i>
         <span>Hasil</span></a>
   </li>

   <!-- Divider -->
   <hr class="sidebar-divider d-none d-md-block">

   <!-- Sidebar Toggler (Sidebar) -->
   <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
   </div>

</ul>
<!-- End of Sidebar -->