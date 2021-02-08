<!-- Begin Page Content -->
<div class="container-fluid">


   <div class="row">
      <div class="col-lg-6">

         <!-- Basic Card Example -->
         <div class="card shadow mb-4">
            <div class="card-header py-3">
               <h6 class="m-0 font-weight-bold text-primary">Edit User</h6>
            </div>
            <div class="card-body">
               <form action="<?php echo site_url(); ?>Guru_manage_user/edit_user_guru/<?php echo $user['id_user']; ?>" <?php echo $user['id_user']; ?> method="post">
                  <div class="form-group row">
                     <label for="username" class="col-lg-3 col-form-label">Username *</label>
                     <div class="col-lg-9">
                        <input type="text" class="form-control" id="username" name="username" value="<?php echo $user['username']; ?>" autofocus>
                        <?php echo form_error('username', '<small class="text-danger pl-2">', '</small>'); ?>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="password" class="col-lg-3 col-form-label">Password *</label>
                     <div class="col-lg-9">
                        <input type="password" class="form-control" id="password" name="password" value="<?php echo $user['password']; ?>"></input>
                        <?php echo form_error('password', '<small class="text-danger pl-2">', '</small>'); ?>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="role" class="col-lg-3 col-form-label">Role *</label>
                     <div class="col-lg-9">
                        <select class="form-control" id="role" name="role">
                           <?php if ($user['role'] == 2) : ?>
                              <option value="2" selected>Guru</option>
                              <option value="3">Siswa</option>
                           <?php else : ?>
                              <option value="2">Guru</option>
                              <option value="3" selected>Siswa</option>
                           <?php endif; ?>
                        </select>
                     </div>
                  </div>
                  <small style="color: red;">*harus diisi</small>
                  <div class="d-flex mt-4">
                     <a href="<?php echo site_url(); ?>guru_manage_user" class="btn btn-secondary ml-auto">Kembali</a>
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