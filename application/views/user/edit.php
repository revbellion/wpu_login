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
	<div class="card mb-4 card border-left-success shadow h-100 py-2">
		
		<div class="card-body">
			<form action="<?php echo base_url('user/update') ?>" method="POST" enctype="multipart/form-data">
				<div class="row">
					<div class="col-lg-5">
						<div class="form-group">
							<label for="exampleFormControlInput1"><strong>Email</strong></label>
							<input readonly type="email" value="<?php echo $user['email'] ?>" class="form-control" name="email" autocomplete="off" placeholder="Enter URL">

						</div>
					</div>
					
					

				</div>
				<div class="row">
					<div class="col-lg-5">
						<div class="form-group">
							<label for="exampleFormControlInput1"><strong>Full Name</strong></label>
							<input type="text" value="<?php echo $user['name'] ?>" class="form-control" name="name" autocomplete="off" placeholder="Enter Title">

						</div>
					</div>
					

				</div>
				<div class="row">
					<div class="col-lg-5">
						<div class="form-group">
							<label for="exampleFormControlInput1"><strong>Picture</strong></label>
							<img class=" mt-2 ml-2 mb-2" width="100" height="110" src="<?php echo base_url('assets/img/profile/'.$user['image']) ?>"  >

							<input type="file"   class="form-control" name="userfile">
							<input type="hidden" name="fileLama" value="<?php echo $user['image'] ?>">

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