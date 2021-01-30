<!-- Begin Page Content -->
<div class="container-fluid">


   <div class="row">
      <div class="col-lg-6">

         <!-- Basic Card Example -->
         <div class="card shadow mb-4">
            <div class="card-header py-3">
               <h6 class="m-0 font-weight-bold text-primary">Edit Siswa</h6>
            </div>
            <div class="card-body">
               <form action="<?php echo site_url(); ?>siswa/edit_siswa/<?php echo $alt['id_siswa']; ?>" <?php echo $alt['id_siswa']; ?> method="post">
                  <div class="form-group row">
                     <label for="nama_siswa" class="col-lg-3 col-form-label">Nama Siswa *</label>
                     <div class="col-lg-9">
                        <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" value="<?php echo $alt['nama_siswa']; ?>" autofocus>
                        <?php echo form_error('nama_siswa', '<small class="text-danger pl-2">', '</small>'); ?>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="nisn" class="col-lg-3 col-form-label">NISN *</label>
                     <div class="col-lg-9">
                        <input type="number" class="form-control" id="nisn" name="nisn" value="<?php echo $alt['nisn']; ?>"></input>
                        <?php echo form_error('nisn', '<small class="text-danger pl-2">', '</small>'); ?>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="nis" class="col-lg-3 col-form-label">NIS *</label>
                     <div class="col-lg-9">
                        <input type="number" class="form-control" id="nis" name="nis" value="<?php echo $alt['nis']; ?>"></input>
                        <?php echo form_error('nis', '<small class="text-danger pl-2">', '</small>'); ?>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="jurusan" class="col-lg-3 col-form-label">Jurusan *</label>
                     <div class="col-lg-9">
                        <select class="form-control" id="jurusan" name="jurusan">
                           <?php if ($alt['jurusan'] == 2) : ?>
                              <option value="AKL" selected>AKL</option>
                              <option value="AP">AP</option>
                              <option value="OTKP">OTKP</option>
                           <?php elseif ($alt['jurusan'] == 3) : ?>
                              <option value="AKL">AKL</option>
                              <option value="AP" selected>AP</option>
                              <option value="OTKP">OTKP</option>
                           <?php else : ?>
                              <option value="AKL">AKL</option>
                              <option value="AP">AP</option>
                              <option value="OTKP" selected>OTKP</option>
                           <?php endif; ?>
                        </select>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="jenis_kelamin" class="col-lg-3 col-form-label">Jenis Kelamin *</label>
                     <div class="col-lg-9">
                        <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                           <?php if ($alt['jenis_kelamin'] == 2) : ?>
                              <option value="Laki-Laki" selected>Laki - Laki</option>
                              <option value="Perempuan">Perempuan</option>
                           <?php else : ?>
                              <option value="Laki-Laki">Laki - Laki</option>
                              <option value="Perempuan" selected>Perempuan</option>
                           <?php endif; ?>
                        </select>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="alamat" class="col-lg-3 col-form-label">Alamat *</label>
                     <div class="col-lg-9">
                        <textarea class="form-control" id="alamat" name="alamat" row="3" value="<?php echo $alt['alamat']; ?>"></textarea>
                        <?php echo form_error('alamat', '<small class="text-danger pl-2">', '</small>'); ?>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="no_telpon" class="col-lg-3 col-form-label">Nomor Telp *</label>
                     <div class="col-lg-9">
                        <input type="number" class="form-control" id="no_telepon" name="no_telepon" value="<?php echo $alt['no_telepon']; ?>"></input>
                        <?php echo form_error('no_telpon', '<small class="text-danger pl-2">', '</small>'); ?>
                     </div>
                  </div>
                  <small style="color: red;">*harus diisi</small>
                  <div class="d-flex mt-4">
                     <a href="<?php echo site_url(); ?>siswa" class="btn btn-secondary ml-auto">Kembali</a>
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