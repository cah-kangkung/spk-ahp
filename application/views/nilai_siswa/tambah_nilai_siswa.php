<!-- Begin Page Content -->
<div class="container-fluid">
   <div class="row">
      <div class="col-lg-8">

         <!-- Basic Card Example -->
         <div class="card shadow mb-4">
            <div class="card-header py-3">
               <h6 class="m-0 font-weight-bold text-primary">Tambah Nilai Siswa</h6>
            </div>
            <div class="card-body">
               <form action="<?php echo site_url(); ?>nilai_siswa/tambah_nilai_siswa" method="post">
                  <div class="form-group row">
                     <label for="nama_siswa" class="col-lg-4 col-form-label">Nama Siswa</label>
                     <div class="col-lg-8">
                        <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" autofocus><?php echo set_value('nama_siswa'); ?></input>
                        <?php echo form_error('nama_siswa', '<small class="text-danger pl-2">', '</small>'); ?>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="akademik" class="col-lg-4 col-form-label">Nilai Akademik *</label>
                     <div class="col-lg-8">
                        <input type="number" class="form-control" id="akademik" name="akademik"><?php echo set_value('akademik'); ?></input>
                        <?php echo form_error('akademik', '<small class="text-danger pl-2">', '</small>'); ?>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="sikap" class="col-lg-4 col-form-label">Nilai Sikap *</label>
                     <div class="col-lg-8">
                        <input type="number" class="form-control" id="sikap" name="sikap"><?php echo set_value('sikap'); ?></input>
                        <?php echo form_error('sikap', '<small class="text-danger pl-2">', '</small>'); ?>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="keaktifan" class="col-lg-4 col-form-label">Nilai Keaktifan *</label>
                     <div class="col-lg-8">
                        <input type="number" class="form-control" id="keaktifan" name="keaktifan"><?php echo set_value('keaktifan'); ?></input>
                        <?php echo form_error('keaktifan', '<small class="text-danger pl-2">', '</small>'); ?>
                     </div>
                  </div>
                  <small style="color: red;">*harus diisi</small>
                  <div class="d-flex mt-4">
                     <a href="<?php echo site_url(); ?>nilai_siswa/index" class="btn btn-secondary ml-auto">Kembali</a>
                     <button type="submit" class="btn btn-primary ml-3">Tambah</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
   <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->