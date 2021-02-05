<!-- Begin Page Content -->
<div class="container-fluid">

   <!-- Page Heading -->
   <div class="d-sm-flex align-items-center mb-4">
      <h1 class="h3 mb-0 text-gray-800 mr-4">Perbandingan Alternatif</h1>
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

   <?php if ($bobot_alternatif) : ?>
      <table class="table table-bordered">
         <thead class="thead-dark">
            <tr>
               <th scope="col">#</th>
               <th scope="col">Nama Siswa</th>
               <?php foreach ($kriteria as $k) : ?>
                  <th scope="col"><?php echo $k['nama_kriteria']; ?></th>
               <?php endforeach; ?>
            </tr>
         </thead>
         <tbody>
            <?php $c = 1; ?>
            <?php foreach ($bobot_alternatif as $bobot) : ?>
               <tr>
                  <th scope="row"><?php echo $c; ?></th>
                  <td><?php echo $bobot[0]; ?></td>
                  <?php for ($i = 0; $i < count($kriteria); $i++) : ?>
                     <th scope="col"><?php echo $bobot[$i + 1]; ?></th>
                  <?php endfor; ?>
               </tr>
               <?php $c++; ?>
            <?php endforeach; ?>

         </tbody>
      </table>
   <?php endif; ?>

   <a href="<?php echo site_url(); ?>perbandingan/submit_perbandingan_alternatif" class="btn btn-primary">Hitung</a>


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