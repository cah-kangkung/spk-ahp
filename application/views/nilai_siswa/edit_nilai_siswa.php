<!-- Begin Page Content -->
<div class="container-fluid">

   <div class="row">
      <div class="col-lg-6">

         <!-- Basic Card Example -->
         <div class="card shadow mb-4">
            <div class="card-header py-3">
               <h6 class="m-0 font-weight-bold text-primary">Edit Nilai Siswa</h6>
            </div>
            <div class="card-body">
               <form action="<?php echo site_url(); ?>nilai_siswa/edit_nilai_siswa/<?php echo $nilai_siswa['id_siswa']; ?>" <?php echo $nilai_siswa['id_siswa']; ?> method="post">
                  <div class="form-group row">
                     <label for="nama_siswa" class="col-lg-3 col-form-label">Nama Siswa *</label>
                     <div class="col-lg-9">
                        <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" value="<?php echo $nilai_siswa['nama_siswa']; ?>" autofocus>
                        <?php echo form_error('nama_siswa', '<small class="text-danger pl-2">', '</small>'); ?>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="akademik" class="col-lg-3 col-form-label">Nilai Akademik *</label>
                     <div class="col-lg-9">
                        <input type="number" class="form-control" id="akademik" name="akademik" value="<?php echo $nilai_siswa['akademik']; ?>"></input>
                        <?php echo form_error('akademik', '<small class="text-danger pl-2">', '</small>'); ?>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="sikap" class="col-lg-3 col-form-label">Nilai Sikap *</label>
                     <div class="col-lg-9">
                        <input type="text" class="form-control" id="sikap" name="sikap" value="<?php echo $nilai_siswa['sikap']; ?>"></input>
                        <?php echo form_error('sikap', '<small class="text-danger pl-2">', '</small>'); ?>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="keaktifan" class="col-lg-3 col-form-label">Nilai Keaktifan *</label>
                     <div class="col-lg-9">
                        <input type="text" class="form-control" id="keaktifan" name="keaktifan" value="<?php echo $nilai_siswa['keaktifan']; ?>"></input>
                        <?php echo form_error('keaktifan', '<small class="text-danger pl-2">', '</small>'); ?>
                     </div>
                  </div>
                  <small style="color: red;">*harus diisi</small>
                  <div class="d-flex mt-4">
                     <a href="<?php echo site_url(); ?>nilai_siswa" class="btn btn-secondary ml-auto">Kembali</a>
                     <button type="submit" class="btn btn-primary ml-3">Edit</button>
                  </div>
               </form>
            </div>
         </div>

      </div>


   </div>
   <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->