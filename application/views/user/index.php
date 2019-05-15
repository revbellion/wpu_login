<!-- Begin Page Content -->
              <div class="container-fluid">

                <!-- Page Heading -->
                <h1 class="h3 mb-4 text-gray-800"><?php echo $title; ?></h1>

                <div class="card  mb-4 card border-left-success shadow h-100 py-2" style="max-width: 540px;">
                  <div class="row no-gutters">
                    <div class="col-md-4 mt-2">
                      <img src="<?php echo base_url('assets/img/profile/'). $user['image'] ?>" class=" ml-3 card-img " alt="...">
                    </div>
                    <div class="col-md-8 mt-4">
                      <div class="card-body">
                        <h5 class="card-title"><?php echo $user['name'] ?></h5>
                        <p class="card-text"><?php echo $user['email'] ?></p>
                        <p class="card-text"><small class="text-muted">Member Since <?php echo date('d F Y',$user['date_created']) ?></small></p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->