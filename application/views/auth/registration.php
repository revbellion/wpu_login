
  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5 col-lg-5 mx-auto">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg">
            <div class="p-3">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4"><strong><i class="fab fa-superpowers fa-fw text-success"></i>Create an Account!</strong></h1>
              </div>
              <form method="POST" action="<?php echo base_url('auth/registration') ?>" class="user">
                
                <div class="form-group">
                  <input type="text" class="form-control" id="name" name="name" placeholder="Full Name" autocomplete="off" value="<?php echo set_value('name') ?>">
                    <?php echo form_error('name','<small class=" font-weight-bolder text-danger font-italic pl-3">','</small>') ?>

                </div>
                <div class="form-group">
                  <input type="text" class="form-control" id="email" name="email" placeholder="Email Address" autocomplete="off" value="<?php echo set_value('email') ?>">
                    <?php echo form_error('email','<small class=" font-weight-bolder text-danger font-italic pl-3">','</small>') ?>
                     
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" class="form-control" id="password1" name="password1" placeholder="Password" autocomplete="off"  >
                    <?php echo form_error('password1','<small class=" font-weight-bolder text-danger font-italic pl-3">','</small>') ?>
                    
                  </div>
                  <div class="col-sm-6">
                    <input type="password" class="form-control" id="password2" name="password2" placeholder="Repeat Password" autocomplete="off" >
                    <?php echo form_error('password2','<small class=" font-weight-bolder text-danger font-italic pl-3">','</small>') ?>
                    
                  </div>
                </div>
                <button type="submit" class="btn btn-dark  btn-block">
                 <i class="fas fa-paper-plane fa-fw"></i> Register Account
                </button>
              </form>
              <hr>
              <div class="text-center">
                <a class="small" href="<?php echo base_url('auth/forgotPassword') ?>">Forgot Password?</a>
              </div>
              <div class="text-center">
                <a class="small" href="<?php echo base_url('auth') ?>">Already have an account? Login!</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
