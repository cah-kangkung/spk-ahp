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
               <form action="<?php echo site_url(); ?>nilai_siswa/edit_nilai_siswa/<?php echo $siswa['id_siswa']; ?>" method="post">
                  <div class="form-group row">
                     <label for="nama_siswa" class="col-lg-4 col-form-label">Nama Siswa *</label>
                     <div class="col-lg-8">
                        <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" value="<?php echo $siswa['nama_siswa']; ?>" autofocus>
                        <input type="hidden" name="id_siswa" value="<?php echo $siswa['id_siswa']; ?>">
                        <?php echo form_error('id_siswa', '<small class="text-danger pl-2">', '</small>'); ?>
                     </div>
                  </div>
                  <?php $i = 0; ?>
                  <?php foreach ($nilai_siswa as $k) : ?>
                     <?php if ($k['jenis_nilai'] == 'angka') : ?>
                        <div class="form-group row">
                           <label for="" class="col-lg-4 col-form-label"><?php echo $k['nama_kriteria']; ?> *</label>
                           <div class="col-lg-8">
                              <input type="number" min="0" max="100" class="form-control" name="nilai[<?php echo $i; ?>][nilai]" value="<?php echo $k['nilai']; ?>">
                              <input type="hidden" name="nilai[<?php echo $i; ?>][id_kriteria]" value="<?php echo $k['id_kriteria']; ?>">
                              <?php echo form_error('akademik', '<small class="text-danger pl-2">', '</small>'); ?>
                           </div>
                        </div>
                     <?php else : ?>
                        <div class="form-group row">
                           <label for="" class="col-lg-4 col-form-label"><?php echo $k['nama_kriteria']; ?> *</label>
                           <div class="col-lg-8">
                              <select class="form-control" name="nilai[<?php echo $i; ?>][nilai]">
                                 <?php if ($k['nama_kriteria'] === "A") : ?>
                                    <option value="A" selected>A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                    <option value="D">D</option>
                                    <option value="E">E</option>
                                    <option value="F">F</option>
                                 <?php elseif ($k['nama_kriteria'] === "B") : ?>
                                    <option value="A">A</option>
                                    <option value="B" selected>B</option>
                                    <option value="C">C</option>
                                    <option value="D">D</option>
                                    <option value="E">E</option>
                                    <option value="F">F</option>
                                 <?php elseif ($k['nama_kriteria'] === "C") : ?>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C" selected>C</option>
                                    <option value="D">D</option>
                                    <option value="E">E</option>
                                    <option value="F">F</option>
                                 <?php elseif ($k['nama_kriteria'] === "D") : ?>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                    <option value="D" selected>D</option>
                                    <option value="E">E</option>
                                    <option value="F">F</option>
                                 <?php elseif ($k['nama_kriteria'] === "E") : ?>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                    <option value="D">D</option>
                                    <option value="E" selected>E</option>
                                    <option value="F">F</option>
                                 <?php else : ?>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                    <option value="D">D</option>
                                    <option value="E">E</option>
                                    <option value="F" selected>F</option>
                              </select>
                              <?php
                                    echo json_encode($k['nama_kriteria']);
                                    die;
                              ?>
                              <input type="hidden" name="nilai[<?php echo $i; ?>][id_kriteria]" value="<?php echo $k['id_kriteria']; ?>">
                              <?php echo form_error('akademik', '<small class="text-danger pl-2">', '</small>'); ?>
                           <?php endif; ?>
                           </div>
                        </div>
                     <?php endif; ?>
                     <?php $i++; ?>
                  <?php endforeach; ?>
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