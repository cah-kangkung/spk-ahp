<!-- Begin Page Content -->
<div class="container-fluid">

   <!-- Page Heading -->
   <div class="d-sm-flex align-items-center mb-4">
      <h1 class="h3 mb-0 text-gray-800 mr-4">List Nilai Siswa</h1>
      <a class="btn btn-primary" href="<?php echo site_url(); ?>Guru_nilai_siswa/tambah_nilai_siswa_guru">Tambah</a>
   </div>

   <?php if ($this->session->flashdata('danger_alert')) : ?>
      <div class="alert alert-dismissible alert-danger" role="alert">
         <button type="button" class="close" data-dismiss="alert">&times;</button>
         <?php echo $this->session->flashdata('danger_alert'); ?>
      </div>
   <?php endif; ?>

   <?php if ($this->session->flashdata('success_alert')) : ?>
      <div class="alert alert-dismissible alert-success" role="alert">
         <button type="button" class="close" data-dismiss="alert">&times;</button>
         <?php echo $this->session->flashdata('success_alert'); ?>
      </div>
   <?php endif; ?>

   <!-- DataTales Example -->
   <div class="card shadow mb-4">
      <div class="card-body">
         <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
               <thead>
                  <tr>
                     <th>Nama Siswa</th>
                     <th>NISN</th>
                     <th>Jurusan</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
                  <?php foreach ($data_siswa as $siswa) : ?>
                     <tr>
                        <td><?php echo $siswa['nama_siswa'] ?></td>
                        <td><?php echo $siswa['nisn'] ?></td>
                        <td><?php echo $siswa['jurusan'] ?></td>
                        <td>
                           <a href="<?php echo site_url(); ?>guru_nilai_siswa/hapus_nilai_siswa_guru/<?php echo $siswa['id_siswa']; ?>"><span class="badge badge-danger">Hapus</span></a>
                           <a href="<?php echo site_url(); ?>guru_nilai_siswa/edit_nilai_siswa_guru/<?php echo $siswa['id_siswa']; ?>"><span class="badge badge-secondary">Edit</span></a>
                        </td>
                     </tr>
                  <?php endforeach; ?>
               </tbody>
            </table>
         </div>
      </div>
   </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->