<!-- Begin Page Content -->
<div class="container-fluid">


   <div class="row">
      <div class="col-lg-6">

         <!-- Basic Card Example -->
         <div class="card shadow mb-4">
            <div class="card-header py-3">
               <h6 class="m-0 font-weight-bold text-primary">Edit Alternatif</h6>
            </div>
            <div class="card-body">
               <form action="<?php echo site_url(); ?>alternatif/edit_alternatif/<?php echo $alt['id_alternatif']; ?>" <?php echo $alt['id_alternatif']; ?> method="post">
                  <div class="form-group row">
                     <label for="nama_alternatif" class="col-lg-3 col-form-label">Nama Siswa *</label>
                     <div class="col-lg-9">
                        <input type="text" class="form-control" id="nama_alternatif" name="nama_alternatif" value="<?php echo $alt['nama_alternatif']; ?>" autofocus>
                        <?php echo form_error('nama_alternatif', '<small class="text-danger pl-2">', '</small>'); ?>
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
                     <label for="alamat" class="col-lg-3 col-form-label">alamat *</label>
                     <div class="col-lg-9">
                        <textarea class="form-control" id="alamat" name="alamat" row="3" value="<?php echo $alt['alamat']; ?>"></textarea>
                        <?php echo form_error('alamat', '<small class="text-danger pl-2">', '</small>'); ?>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="no_telpon" class="col-lg-3 col-form-label">Nomor Telp *</label>
                     <div class="col-lg-9">
                        <input type="number" class="form-control" id="no_telpon" name="no_telpon" value="<?php echo $alt['no_telpon']; ?>"></input>
                        <?php echo form_error('no_telpon', '<small class="text-danger pl-2">', '</small>'); ?>
                     </div>
                  </div>
                  <small style="color: red;">*harus diisi</small>
                  <div class="d-flex mt-4">
                     <a href="<?php echo site_url(); ?>admin_manage_user" class="btn btn-secondary ml-auto">Kembali</a>
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