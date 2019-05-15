

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
                    <h1 class="h4 mb-4"><strong class="text-dark"><i class="fab fa-superpowers fa-fw text-success"></i>Forgot password ?</strong></h1>
                    <?php echo $this->session->flashdata('message'); ?>
                  </div>
                  <form class="user" action="<?php echo base_url('auth/forgotPassword') ?>" method="post">  
                    <div class="form-group">
                      <input type="text" class="form-control " id="email" name="email" placeholder="Enter Email Address..." autocomplete="off" value="<?php echo set_value('email') ?>">
                       <?php echo form_error('email','<small class=" font-weight-bolder text-danger font-italic pl-3">','</small>') ?>
                    </div>
                     
                    <button type="submit" class="btn btn-dark btn-block">
                      <i class="fas fa-redo-alt fa-fw"></i> Reset password
                    </button>
                  </form>
                  <hr>
                 <div class="text-center">
                <a class="small" href="<?php echo base_url('auth') ?>">Already have an account? Login!</a>
              </div>
                  <div class="text-center">
                    <a class="small" href="<?php echo base_url('auth/registration') ?>">Create an Account!</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  