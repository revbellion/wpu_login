

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-lg-5">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg">
                <div class="p-4">
                  <div class="text-center">
                    <h1 class="h4 mb-4"><strong class="text-dark"><i class="fab fa-superpowers fa-fw text-success"></i>Change password</strong></h1>
                    <?php echo $this->session->flashdata('message'); ?>
                  </div>
                  <form class="user" action="<?php echo base_url('auth/changePassword') ?>" method="post">  
                    <div class="form-group">
                      <input type="password" class="form-control " id="password" name="password" placeholder="Enter new password" autocomplete="off">
                       <?php echo form_error('password','<small class=" font-weight-bolder text-danger font-italic pl-3">','</small>') ?>
                    </div>
                      <div class="form-group">
                      <input type="password" class="form-control " id="passconf" name="passconf" placeholder="Enter repeat password" autocomplete="off">
                       <?php echo form_error('passconf','<small class=" font-weight-bolder text-danger font-italic pl-3">','</small>') ?>
                    </div>
                    <button type="submit" class="btn btn-dark btn-block">
                      <i class="fas fa-redo-alt fa-fw"></i> Change password
                    </button>
                  </form>
                  <hr>
                 
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  