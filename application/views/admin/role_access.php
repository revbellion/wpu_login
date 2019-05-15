<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800"><?php echo $title; ?></h1>
	<div class="row">
		<div class="col-lg-5">
			<?php echo $this->session->flashdata('pesan'); ?>
			<?php echo form_error('role','<div class="alert alert-danger">','</div>') ?>

			<div class="table-responsive">
				<h5>Role : <?php echo $role['role'] ?></h5>
				<table class="table table-hover">
					<thead >
						<tr>
							<th>No.</th>
							<th>Menu</th>
							<th>Access</th>
						</tr>
					</thead>
					<tbody>
						<?php $no = 1; foreach ($menu as $m): ?>
						<tr>
							<td><?php echo $no++ ?></td>
							<td><?php echo $m['menu'] ?></td>
							<td>
								<div class="form-group form-check">
									<input type="checkbox" class="form-check-input" <?php echo check_access($role['id'],$m['id']) ?> data-role='<?php echo $role['id'] ?>' data-menu='<?php echo $m['id'] ?>'  >
								</div>
							</td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
