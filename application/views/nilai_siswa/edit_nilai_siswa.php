<!-- Begin Page Content -->
<div class="container-fluid">
   <div class="row">
      <div class="col-lg-8">

         <!-- Basic Card Example -->
         <div class="card shadow mb-4">
            <div class="card-header py-3">
               <h6 class="m-0 font-weight-bold text-primary">Edit Nilai Siswa</h6>
            </div>
            <div class="card-body">
               <form action="<?php echo site_url(); ?>nilai_siswa/edit_nilai_siswa/<?php echo $siswa['id_siswa']; ?>" method="post">
                  <div class="form-group row">
                     <label for="id_siswa" class="col-lg-4 col-form-label">Nama Siswa</label>
                     <div class="col-lg-8">
                        <input type="text" class="form-control" name="nama_siswa" id="nama_siswa" value="<?php echo $siswa['nama_siswa']; ?>">
                        <input type="hidden" name="id_siswa" id="id_siswa" value="<?php echo $siswa['id_siswa']; ?>">
                     </div>
                  </div>
                  <?php $i = 0; ?>
                  <?php foreach ($nilai_siswa as $ns) : ?>
                     <?php if ($ns['jenis_nilai'] == 'angka') : ?>
                        <div class="form-group row">
                           <label for="" class="col-lg-4 col-form-label"><?php echo $ns['nama_kriteria']; ?> *</label>
                           <div class="col-lg-8">
                              <input type="number" min="0" max="100" class="form-control" name="nilai[<?php echo $i; ?>][nilai]" value="<?php echo $ns['nilai']; ?>">
                              <input type="hidden" name="nilai[<?php echo $i; ?>][id_kriteria]" value="<?php echo $ns['id_kriteria']; ?>">
                           </div>
                        </div>
                     <?php else : ?>
                        <div class="form-group row">
                           <label for="" class="col-lg-4 col-form-label"><?php echo $ns['nama_kriteria']; ?> *</label>
                           <div class="col-lg-8">
                              <select class="form-control" name="nilai[<?php echo $i; ?>][nilai]">
                                 <option <?php echo ($ns['nilai'] == 'A') ? 'selected' : ''; ?>>A</option>
                                 <option <?php echo ($ns['nilai'] == 'B') ? 'selected' : ''; ?>>B</option>
                                 <option <?php echo ($ns['nilai'] == 'C') ? 'selected' : ''; ?>>C</option>
                                 <option <?php echo ($ns['nilai'] == 'D') ? 'selected' : ''; ?>>D</option>
                                 <option <?php echo ($ns['nilai'] == 'E') ? 'selected' : ''; ?>>E</option>
                                 <option <?php echo ($ns['nilai'] == 'F') ? 'selected' : ''; ?>>F</option>
                              </select>
                              <input type="hidden" name="nilai[<?php echo $i; ?>][id_kriteria]" value="<?php echo $ns['id_kriteria']; ?>">
                           </div>
                        </div>
                     <?php endif; ?>
                     <?php $i++; ?>
                  <?php endforeach; ?>
                  <small style="color: red;">*harus diisi</small><br>
                  <small style="color: red;">*untuk range nilai akademik 0 - 100</small><br>
                  <small style="color: red;">*untuk range nilai sikap dan keaktifan A - F</small>
                  <div class="d-flex mt-4">
                     <a href="<?php echo site_url(); ?>nilai_siswa/index" class="btn btn-secondary ml-auto">Kembali</a>
                     <button type="submit" class="btn btn-primary ml-3">Edit</button>
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