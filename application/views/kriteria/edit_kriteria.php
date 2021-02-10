<!-- Begin Page Content -->
<div class="container-fluid">


   <div class="row">
      <div class="col-lg-6">

         <!-- Basic Card Example -->
         <div class="card shadow mb-4">
            <div class="card-header py-3">
               <h6 class="m-0 font-weight-bold text-primary">Edit Kriteria</h6>
            </div>
            <div class="card-body">
               <form action="<?php echo site_url(); ?>kriteria/edit_kriteria/<?php echo $kriteria['id_kriteria']; ?> " method="post">
                  <div class="form-group row">
                     <label for="nama_kriteria" class="col-lg-4 col-form-label">Nama Kriteria *</label>
                     <div class="col-lg-8">
                        <input type="text" class="form-control" id="nama_kriteria" name="nama_kriteria" value="<?php echo $kriteria['nama_kriteria']; ?>" autofocus></input>
                        <?php echo form_error('nama_kriteria', '<small class="text-danger pl-2">', '</small>'); ?>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="kode_kriteria" class="col-lg-4 col-form-label">Kode Kriteria *</label>
                     <div class="col-lg-8">
                        <input type="text" class="form-control" id="kode_kriteria" name="kode_kriteria" value="<?php echo $kriteria['kode_kriteria']; ?>"></input>
                        <?php echo form_error('kode_kriteria', '<small class="text-danger pl-2">', '</small>'); ?>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="jenis_nilai" class="col-lg-4 col-form-label">Jenis Nilai *</label>
                     <div class="col-lg-8">
                        <select class="form-control" id="jenis_nilai" name="jenis_nilai">
                           <?php if ($kriteria['jenis_nilai'] === "angka") : ?>
                              <option value="angka" selected>angka</option>
                              <option value="huruf">huruf</option>
                           <?php elseif ($kriteria['jenis_nilai'] === "huruf") : ?>
                              <option value="angka">angka</option>
                              <option value="huruf" selected>huruf</option>
                           <?php endif; ?>
                        </select>
                     </div>
                  </div>
                  <small style="color: red;">*harus diisi</small>
                  <div class="d-flex mt-4">
                     <a href="<?php echo site_url(); ?>kriteria" class="btn btn-secondary ml-auto">Kembali</a>
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