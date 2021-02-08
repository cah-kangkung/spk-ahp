<!-- Begin Page Content -->
<div class="container-fluid">

   <!-- Page Heading -->
   <div class="d-sm-flex align-items-center mb-4">
      <h1 class="h3 mb-0 text-gray-800 mr-4">Perbandingan Kriteria</h1>
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

   <form action="<?php echo site_url(); ?>guru_perbandingan/submit_perbandingan_kriteria" method="post">

      <div class="card">
         <div class="card-header">Matriks</div>
         <div class="card-body">
            <table class="table table-bordered">
               <thead class="thead-dark">
                  <tr>
                     <th scope="col">Kriteria</th>
                     <?php foreach ($lables as $lable) : ?>
                        <th scope="col"><?php echo $lable; ?></th>
                     <?php endforeach; ?>
                  </tr>
               </thead>
               <tbody>
                  <?php for ($i = 0; $i < count($i_matrix); $i++) : ?>
                     <tr>
                        <td><?php echo $lables[$i]; ?></td>
                        <?php for ($j = 0; $j < count($i_matrix); $j++) : ?>
                           <td>
                              <?php if ($i > $j) : ?>
                                 <div class="form-group">
                                    <input type="text" class="form-control" name="nilai_kriteria[]" value="<?php echo $i_matrix[$i][$j]; ?>" id="k<?php echo $i . $j; ?>" readonly>
                                 </div>
                              <?php elseif ($i === $j) : ?>
                                 <div class="form-group">
                                    <input type="text" class="form-control" name="nilai_kriteria[]" value="<?php echo $i_matrix[$i][$j]; ?>" id="k<?php echo $i . $j; ?>" readonly>
                                 </div>
                              <?php else : ?>
                                 <div class="form-group">
                                    <input type="number" min="1" max="9" class="form-control" name="nilai_kriteria[]" value="<?php echo $i_matrix[$i][$j]; ?>" id="k<?php echo $i . $j; ?>" onchange="changeOppositeValue(this)" onKeyDown="return false">
                                 </div>
                              <?php endif; ?>
                           </td>
                        <?php endfor; ?>
                     </tr>
                  <?php endfor; ?>
                  <?php if ($total_kolom) : ?>
                     <tr>
                        <td>Total Kolum</td>
                        <?php foreach ($total_kolom as $tk) : ?>
                           <td>
                              <div class="form-group">
                                 <input type="text" class="form-control" value="<?php echo $tk; ?>" readonly>
                              </div>
                           </td>
                        <?php endforeach; ?>
                     </tr>
                  <?php endif; ?>
               </tbody>
            </table>
         </div>
      </div>

      <!-- Normalisasi Matriiikssss -->
      <?php if ($normalisasi_matriks) : ?>
         <div class="card mt-4">
            <div class="card-header">Matriks Normalisasi + Bobot</div>
            <div class="card-body">
               <table class="table table-bordered">
                  <thead class="thead-dark">
                     <tr>
                        <th scope="col">Kriteria</th>
                        <?php foreach ($lables as $lable) : ?>
                           <th scope="col"><?php echo $lable; ?></th>
                        <?php endforeach; ?>
                        <th scope="col">Bobot Prioritas</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php for ($i = 0; $i < count($normalisasi_matriks); $i++) : ?>
                        <tr>
                           <td><?php echo $lables[$i]; ?></td>
                           <?php for ($j = 0; $j < count($normalisasi_matriks); $j++) : ?>
                              <td>
                                 <div class="form-group">
                                    <input type="text" class="form-control" value="<?php echo $normalisasi_matriks[$i][$j]; ?>" readonly>
                                 </div>
                              </td>
                           <?php endfor; ?>
                           <td>
                              <div class="form-group">
                                 <input type="text" class="form-control" value="<?php echo $bobot_kriteria[$i]; ?>" readonly>
                              </div>
                           </td>
                        </tr>
                     <?php endfor; ?>
                  </tbody>
               </table>
            </div>
         </div>
      <?php endif; ?>


      <!-- Consistency Measure -->
      <?php if ($normalisasi_matriks) : ?>
         <div class="card mt-4">
            <div class="card-header">Consistency Measure</div>
            <div class="card-body">
               <table class="table table-bordered">
                  <thead class="thead-dark">
                     <tr>
                        <th scope="col">Kriteria</th>
                        <?php foreach ($lables as $lable) : ?>
                           <th scope="col"><?php echo $lable; ?></th>
                        <?php endforeach; ?>
                        <th scope="col">CM</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php for ($i = 0; $i < count($normalisasi_matriks); $i++) : ?>
                        <tr>
                           <td><?php echo $lables[$i]; ?></td>
                           <?php for ($j = 0; $j < count($normalisasi_matriks); $j++) : ?>
                              <td>
                                 <div class="form-group">
                                    <input type="text" class="form-control" value="<?php echo $normalisasi_matriks[$i][$j]; ?>" readonly>
                                 </div>
                              </td>
                           <?php endfor; ?>
                           <td>
                              <div class="form-group">
                                 <input type="text" class="form-control" value="<?php echo $cm[$i]; ?>" readonly>
                              </div>
                           </td>
                        </tr>
                     <?php endfor; ?>
                  </tbody>
               </table>

               <div class="row">
                  <div class="col-lg-4">
                     <table class="table table-bordered">
                        <thead class="thead-dark">
                           <tr>
                              <th scope="col">#</th>
                              <th scope="col">Nilai</th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr>
                              <td>CI</td>
                              <td><?php echo $ci; ?></td>
                           </tr>
                           <tr>
                              <td>RI</td>
                              <td><?php echo $ri; ?></td>
                           </tr>
                           <tr>
                              <td>CR</td>
                              <td><?php echo $cr; ?></td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
                  <div class="col-lg-4" style="display: flex; flex-direction: column; justify-content: center;">
                     <p>Untuk nilai CR 0 – 0.1 dianggap konsisten lebih dari itu tidak konsisten.</p>
                     <div class="alert <?php echo ($cr >= 0 && $cr <= 0.1) ? 'alert-success' : 'alert-danger'; ?>" role="alert">
                        <?php if ($cr >= 0 && $cr <= 0.1) : ?>
                           Perbandingan Kriteria Sudah Konsisten!
                        <?php else : ?>
                           Perbandingan Kriteria Belum Konsisten!
                        <?php endif; ?>
                     </div>
                  </div>
               </div>

            </div>
         </div>
      <?php endif; ?>

      <div class="my-3">
         <button type="submit" class="btn btn-primary">Hitung</button>
         <a href="<?php echo site_url(); ?>guru_perbandingan/reset" class="btn btn-danger">Reset</a>
      </div>
   </form>




</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<script>
   function changeOppositeValue(t) {
      let id = t.id;
      let value = t.value;
      let i = id.substr(1, 1);
      let j = id.substr(2, 1);

      let oppositeIndex = document.querySelector('#k' + j + i);
      oppositeIndex.value = 1 / value;
   }
</script>