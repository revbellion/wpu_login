<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800"><?php echo $title; ?></h1>
	<div class="row">
		<div class="col-lg-5">
			<?php echo $this->session->flashdata('info'); ?>
			<?php echo form_error('menu','<div class="alert alert-danger">','</div>') ?>
			<a href="#" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addMenuModal">Add New Menu</a>

			<div class="table-responsive">
				<table class="table table-hover">
					<thead >
						<tr>
							<th>No.</th>
							<th>Menu</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php $no = 1; foreach ($menu as $m): ?>
						<tr>
							<td><?php echo $no++ ?></td>
							<td><?php echo $m['menu'] ?></td>
							<td>
								<div class="btn-group">
									<button class="btn btn-sm btn-success btn-edit" data-id="<?php echo $m['id'] ?>" data-toggle="modal" data-target="#editMenuModal">Edit</button>
									<a onclick="return confirm('Are you Sure ?')" href="<?php echo base_url('menu/deleteMenu/').$m['id'] ?>" class="btn btn-sm btn-danger">Delete</a>
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



<!-- Modal Add-->
<div class="modal fade" id="addMenuModal" tabindex="-1" role="dialog" aria-labelledby="addMenuModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="addMenuModalLabel">Add New Menu</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?php echo base_url('menu/addMenu') ?>" method="post"> 
				<div class="modal-body">
					<div class="form-group">
						<input type="text" class="form-control" id="menu" name="menu" placeholder="Enter Title Menu">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Add</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Modal Edit-->
<div class="modal fade" id="editMenuModal" tabindex="-1" role="dialog" aria-labelledby="editMenuModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="editMenuModalLabel">Edit Menu</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?php echo base_url('menu/updateMenu') ?>" method="post"> 
				<div class="modal-body">
					<div class="form-group">
						<input type="text" class="form-control" id="menuEdit" name="menu" >
						<input type="hidden" class="form-control" id="idEdit" name="id" >
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Edit</button>
				</div>
			</form>
		</div>
	</div>
</div>