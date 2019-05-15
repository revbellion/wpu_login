<div class="container-fluid">
	
	<h1 class="h3 mb-4 text-gray-800"><?php echo $title; ?></h1>
	<?php if ($this->session->flashdata('info')): ?>

		<div class="alert alert-success" role="alert">
			<?php echo "<strong>".$this->session->flashdata('info')."</strong>"; ?>
		</div>

	<?php endif ?>

	<?php if ($this->session->flashdata('danger')): ?>

		<div class="alert alert-danger" role="alert">
			<?php echo "<strong>".$this->session->flashdata('danger')."</strong>"; ?>
		</div>

	<?php endif ?>
	<div class="row">
		<div class="col-lg-5">
			<div class="card mb-4 card border-left-success shadow h-100 py-2">

				<div class="card-body">
					<form action="<?php echo base_url('user/changePassword') ?>" method="POST"  >
						<div class="row">
							<div class="col-lg">
								<div class="form-group">
									<label for="exampleFormControlInput1"><strong>Current Password</strong></label>
									<input   type="password"   class="form-control" name="curpass" autocomplete="off" >
									<?php echo form_error('curpass','<small class=" font-weight-bolder text-danger font-italic pl-0">','</small>') ?>

								</div>
							</div>



						</div>
						<div class="row">
							<div class="col-lg">
								<div class="form-group">
									<label for="exampleFormControlInput1"><strong>New Password</strong></label>
									<input   type="password"   class="form-control" name="password" autocomplete="off" >
									<?php echo form_error('password','<small class=" font-weight-bolder text-danger font-italic pl-0">','</small>') ?>


								</div>
							</div>


						</div>
						<div class="row">
							<div class="col-lg">
								<div class="form-group">
									<label for="exampleFormControlInput1"><strong>Confirm Password</strong></label>
									<input   type="password"   class="form-control" name="passconf" autocomplete="off" >
									<?php echo form_error('passconf','<small class=" font-weight-bolder text-danger font-italic pl-0">','</small>') ?>


								</div>

							</div>
						</div>
						<div class="row float-right">
							<div class="col-lg">
								<a href="<?php echo base_url('user') ?>" class="btn btn-secondary"><i class="fas fa-fw fa-arrow-left"></i>Back</a>
								<button class="btn btn-success"><i class="fas fa-save fa-fw"></i> Save</button>
							</div>

						</div>



					</form>
				</div>
			</div>
		</div>
	</div>
</div>