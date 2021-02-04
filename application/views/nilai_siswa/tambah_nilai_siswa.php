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
                     <label for="id_siswa" class="col-lg-4 col-form-label">Nama Siswa</label>
                     <div class="col-lg-8">
                        <select class="form-control" id="id_siswa" name="id_siswa">
                           <?php foreach ($data_siswa as $siswa) : ?>
                              <option value="<?php echo $siswa['id_siswa']; ?>"><?php echo $siswa['nama_siswa']; ?></option>
                           <?php endforeach; ?>
                        </select>
                     </div>
                  </div>
                  <?php $i = 0; ?>
                  <?php foreach ($kriteria as $k) : ?>
                     <?php if ($k['jenis_nilai'] == 'angka') : ?>
                        <div class="form-group row">
                           <label for="" class="col-lg-4 col-form-label"><?php echo $k['nama_kriteria']; ?> *</label>
                           <div class="col-lg-8">
                              <input type="number" min="0" max="100" class="form-control" name="nilai[<?php echo $i; ?>][nilai]"><?php echo set_value('akademik'); ?></input>
                              <input type="hidden" name="nilai[<?php echo $i; ?>][id_kriteria]" value="<?php echo $k['id_kriteria']; ?>">
                              <?php echo form_error('akademik', '<small class="text-danger pl-2">', '</small>'); ?>
                           </div>
                        </div>
                     <?php else : ?>
                        <div class="form-group row">
                           <label for="" class="col-lg-4 col-form-label"><?php echo $k['nama_kriteria']; ?> *</label>
                           <div class="col-lg-8">
                              <input type="text" class="form-control" name="nilai[<?php echo $i; ?>][nilai]"><?php echo set_value('akademik'); ?></input>
                              <input type="hidden" name="nilai[<?php echo $i; ?>][id_kriteria]" value="<?php echo $k['id_kriteria']; ?>">
                              <?php echo form_error('akademik', '<small class="text-danger pl-2">', '</small>'); ?>
                           </div>
                        </div>
                     <?php endif; ?>
                     <?php $i++; ?>
                  <?php endforeach; ?>
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
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->