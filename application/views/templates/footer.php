 <!-- Footer -->
 <footer class="sticky-footer bg-white">
  <div class="container my-auto">
    <div class="copyright text-center my-auto">
      <span>Copyright &copy; <i class="fab fa-superpowers fa-fw"></i> Admin<sup>2</sup> <?php echo date('Y'); ?></span>
    </div>
  </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
  <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
      <div class="modal-footer">
        <button class="btn btn-info" type="button" data-dismiss="modal"><i class="fas fa-times fa-fw"></i>Cancel</button>
        <a class="btn btn-dark" href="<?php echo base_url('auth/logout') ?>"><i class="fas fa-sign-out-alt fa-fw"></i>Logout</a>
      </div>
    </div>
  </div>
</div>



<!-- Bootstrap core JavaScript-->
<script src="<?php echo base_url('assets/') ?>vendor/jquery/jquery.min.js"></script>
<script src="<?php echo base_url('assets/') ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?php echo base_url('assets/') ?>vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?php echo base_url('assets/') ?>js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="<?php echo base_url('assets/') ?>vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url('assets/') ?>vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="<?php echo base_url('assets/') ?>js/demo/datatables-demo.js"></script>




<!-- Ajax Menu -->
<script>
  $(document).ready(function(){
    // Modal Menu
    $('.btn-edit').on('click',function(){
      var id = $(this).data('id');
      $.ajax({
          url : '<?php echo base_url('menu/editMenu') ?>',
          method : 'POST',
          data : {id : id},
          dataType : 'json',
          success : function(result){
            $('#menuEdit').val(result.menu);
            $('#idEdit').val(result.id);
          } 
      });
    });
    // Modal Sub Menu
    $('.btn-editSub').on('click',function(){
      var id = $(this).data('id');
      $.ajax({
          url : '<?php echo base_url('menu/editSubMenu') ?>',
          method : 'POST',
          data : {id : id},
          dataType : 'json',
          success : function(result){
           $('#title').val(result.title);
           $('#id').val(result.id);
           $('#url').val(result.url);
           $('#icon').val(result.icon);
           $('#is_active').val(result.is_active);
           $('#menu_id').val(result.menu_id);
          } 
      });
    });
    // Modal Role
    $('.btn-editRole').on('click',function(){
      var id = $(this).data('id');
      $.ajax({
          url : '<?php echo base_url('admin/editRole') ?>',
          method : 'POST',
          data : {id : id},
          dataType : 'json',
          success : function(result){
           $('#roleEdit').val(result.role);
            $('#roleIdEdit').val(result.id);
          } 
      });
    });
    // Ajax Checked

    $('.form-check-input').on('click',function(){
       const menuId = $(this).data('menu');
       const roleId = $(this).data('role');

      $.ajax({
          url: "<?php echo base_url('admin/changeAccess') ?>",
          type: 'POST',
          data: {
            menuId : menuId,
            roleId : roleId
          },
          success : function(){
            document.location.href = "<?php echo base_url('admin/roleAccess/') ?>" + roleId;
          }

      });
    })
  });
</script>
</body>

</html>
