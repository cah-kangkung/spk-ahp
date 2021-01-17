<!-- Begin Page Content -->
<div class="container-fluid">


   <div class="row">
      <div class="col-lg-8">

         <!-- Basic Card Example -->
         <div class="card shadow mb-4">
            <div class="card-header py-3">
               <h6 class="m-0 font-weight-bold text-primary">Tambah Alternatif</h6>
            </div>
            <div class="card-body">
               <form action="<?php echo site_url(); ?>alternatif/tambah_alternatif" method="post">
                  <div class="form-group row">
                     <label for="nama_alternatif" class="col-lg-4 col-form-label">Nama Siswa *</label>
                     <div class="col-lg-8">
                        <input type="text" class="form-control" id="nama_alternatif" name="nama_alternatif" autofocus><?php echo set_value('nama_alternatif'); ?></input>
                        <?php echo form_error('nama_alternatif', '<small class="text-danger pl-2">', '</small>'); ?>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="nisn" class="col-lg-4 col-form-label">NISN *</label>
                     <div class="col-lg-8">
                        <input type="number" class="form-control" id="nisn" name="nisn"><?php echo set_value('nisn'); ?></input>
                        <?php echo form_error('nisn', '<small class="text-danger pl-2">', '</small>'); ?>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="nis" class="col-lg-4 col-form-label">NIS *</label>
                     <div class="col-lg-8">
                        <input type="number" class="form-control" id="nis" name="nis"><?php echo set_value('nis'); ?></input>
                        <?php echo form_error('nis', '<small class="text-danger pl-2">', '</small>'); ?>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="jurusan" class="col-lg-4 col-form-label">Jurusan *</label>
                     <div class="col-lg-8">
                        <div class="form-group">
                           <select class="form-control" id="jurusan" name="jurusan">
                              <option value="AKL">AKL</option>
                              <option value="AP">AP</option>
                           </select>
                        </div>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="jenis_kelamin" class="col-lg-4 col-form-label">Jenis Kelamin *</label>
                     <div class="col-lg-8">
                        <div class="form-group">
                           <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                              <option value="Laki-Laki">Laki - Laki</option>
                              <option value="Perempuan">Perempuan</option>
                           </select>
                        </div>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="alamat" class="col-lg-4 col-form-label">Alamat *</label>
                     <div class="col-lg-8">
                        <textarea type="text" class="form-control" id="alamat" name="alamat" rows="3"><?php echo set_value('alamat'); ?></textarea>
                        <?php echo form_error('alamat', '<small class="text-danger pl-2">', '</small>'); ?>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="no_telepon" class="col-lg-4 col-form-label">Nomor Telp *</label>
                     <div class="col-lg-8">
                        <input type="number" class="form-control" id="no_telepon" name="no_telepon"><?php echo set_value('no_telepon'); ?></input>
                        <?php echo form_error('no_telepon', '<small class="text-danger pl-2">', '</small>'); ?>
                     </div>
                  </div>
                  <small style="color: red;">*harus diisi</small>
                  <div class="d-flex mt-4">
                     <a href="<?php echo site_url(); ?>kriteria" class="btn btn-secondary ml-auto">Kembali</a>
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