<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800"><?php echo $title; ?></h1>
	<div class="row">
		<div class="col-lg-5">
			<?php echo $this->session->flashdata('info'); ?>
			<?php echo form_error('role','<div class="alert alert-danger">','</div>') ?>
			<a href="#" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addRoleModal">Add New Role</a>

			<div class="table-responsive">
				<table class="table table-hover">
					<thead >
						<tr>
							<th>No.</th>
							<th>Role</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php $no = 1; foreach ($role as $r): ?>
						<tr>
							<td><?php echo $no++ ?></td>
							<td><?php echo $r['role'] ?></td>
							<td>
								<div class="btn-group">
									<a href="<?php echo base_url('admin/roleAccess/').$r['id'] ?>" class="btn btn-sm btn-warning">Access</a>
									<button class="btn btn-sm btn-success btn-editRole" data-id="<?php echo $r['id'] ?>" data-toggle="modal" data-target="#editRoleModal">Edit</button>
									<a onclick="return confirm('Are you Sure ?')" href="<?php echo base_url('admin/deleteRole/').$r['id'] ?>" class="btn btn-sm btn-danger">Delete</a>
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
<div class="modal fade" id="addRoleModal" tabindex="-1" role="dialog" aria-labelledby="addRoleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="addRoleModalLabel">Add New Role</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?php echo base_url('admin/addRole') ?>" method="post"> 
				<div class="modal-body">
					<div class="form-group">
						<input type="text" class="form-control" id="role" name="role" placeholder="Enter Role">
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
<div class="modal fade" id="editRoleModal" tabindex="-1" role="dialog" aria-labelledby="editRoleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="editRoleModalLabel">Edit Role</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?php echo base_url('admin/updateRole') ?>" method="post"> 
				<div class="modal-body">
					<div class="form-group">
						<input type="text" class="form-control" id="roleEdit" name="role" >
						<input type="hidden" class="form-control" id="roleIdEdit" name="id" >
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