<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800"><?php echo $title; ?></h1>
	<div class="row">
		<div class="col-lg">
			<?php echo validation_errors('<div class="alert alert-danger">','</div>') ?>
			<?php echo $this->session->flashdata('info'); ?>
			<a href="#" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addSubMenuModal">Add New Sub Menu</a>
			<div class="table-responsive">
				<table class="table table-hover">
					<thead >
						<tr>
							<th>No.</th>
							<th>Menu</th>
							<th>Title</th>
							<th>Url</th>
							<th>Icon</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php $no = 1; foreach ($submenu as $sm): ?>
						<tr>
							<td><?php echo $no++ ?></td>
							<td><?php echo $sm['menu'] ?></td>
							<td><?php echo $sm['title'] ?></td>
							<td><?php echo $sm['url'] ?></td>
							<td><?php echo $sm['icon'] ?></td>
							<td>
								<?php echo ($sm['is_active'] == '1') ? "<span class='badge badge-success'>Active</span>" : "<span class='badge badge-danger'>Inactive</span>" ?>

							</td>
							<td>
								<div class="btn-group">
									<button class="btn btn-sm btn-success btn-editSub" data-id="<?php echo $sm['id'] ?>" data-toggle="modal" data-target="#editSubMenuModal">Edit</button>
									<a onclick="return confirm('Are you Sure ?')" href="<?php echo base_url('menu/deleteSubMenu/').$sm['id'] ?>" class="btn btn-sm btn-danger">Delete</a>
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
<div class="modal fade" id="addSubMenuModal" tabindex="-1" role="dialog" aria-labelledby="addSubMenuModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="addSubMenuModalLabel">Add New Sub Menu</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?php echo base_url('menu/addSubMenu') ?>" method="post"> 
				<div class="modal-body">
					<div class="form-group">
						<input type="text" class="form-control" name="title" placeholder="Enter Title">
					</div>
					<div class="form-group">
						<select name="menu" class="form-control">
							<option value="">Select Menu</option>
							<?php foreach ($menu as $m): ?>
								
								<option value="<?php echo $m['id'] ?>"><?php echo $m['menu'] ?></option>
							<?php endforeach ?>
						</select>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" name="url" placeholder="Enter url">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" name="icon" placeholder="Enter icon">
					</div>
					<div class="form-group">
						<select name="is_active" class="form-control">
							<option value="1">Active</option>
							<option value="0">Inactive</option>
						</select>
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
<div class="modal fade" id="editSubMenuModal" tabindex="-1" role="dialog" aria-labelledby="editSubMenuModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="editSubMenuModalLabel">Edit SubMenu</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?php echo base_url('menu/updateSubMenu') ?>" method="post"> 
				<div class="modal-body">
					<div class="form-group">
						<input type="text" class="form-control" name="title" id="title" placeholder="Enter Title">
						<input type="hidden" class="form-control" id="id" name="id" placeholder="Enter Title">
					</div>
					<div class="form-group">
						<select name="menu_id" id="menu_id" class="form-control">
							<?php foreach ($menu as $m): ?>
								
								<option value="<?php echo $m['id'] ?>"><?php echo $m['menu'] ?></option>
							<?php endforeach ?>
						</select>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" name="url" id="url" placeholder="Enter url">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" name="icon" id="icon" placeholder="Enter icon">
					</div>
					<div class="form-group">
						<select name="is_active" id="is_active" class="form-control">
							<option value="1">Active</option>
							<option value="0">Inactive</option>
						</select>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Update</button>
				</div>
			</form>
		</div>
	</div>
</div>