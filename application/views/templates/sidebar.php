
<!-- Sidebar -->
<ul class="navbar-nav bg-gray-900 sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
    <div class="sidebar-brand-icon rotate-n-15">
      <i class="fab fa-superpowers fa-fw text-success"></i><sup class="text-warning">Admin</sup>
    </div>
    <div class="sidebar-brand-text mx-3"></div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider ">
  <!-- Query Menu -->

  <?php 
  $role_id = $this->session->userdata('role_id');

  $this->db->select('user_menu.id,menu');
  $this->db->from('user_menu');
  $this->db->join('user_access_menu', 'user_menu.id = user_access_menu.menu_id');
  $this->db->where('user_access_menu.role_id', $role_id);
  $this->db->order_by('user_access_menu.menu_id', 'asc');
  
  $menu = $this->db->get()->result_array();


  ?>

  <!-- LOOPING MENU -->
  <?php foreach ($menu as $m): ?>
    <div class="sidebar-heading text-light">
      <?php echo $m['menu']; ?>
    </div>
    

    <!-- SIAPKAN SUB-MENU -->
    <?php 
    $menuId = $m['id'];

    $this->db->where('menu_id', $menuId);
    $this->db->where('is_active', 1);
    $subMenu = $this->db->get('user_sub_menu')->result_array();

    ?>
    <?php foreach ($subMenu as $sm): ?>
      <?php if ($sm['title'] == $title): ?>
        
     
      <li class="nav-item  active">
      <?php else: ?>
      <li class="nav-item">

         <?php endif ?>
        <a class="nav-link pb-0" href="<?php echo base_url($sm['url']) ?>">
          <i class="<?php echo $sm['icon'] ?>"></i>
          <span><?php echo $sm['title'] ?></span></a>
        </li>
      <?php endforeach ?>
      <hr class="sidebar-divider mt-3">

    <?php endforeach ?>

    <!-- Nav Item - Dashboard -->


    <!-- Divider -->






    <li class="nav-item">
      <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
        <i class="fas fa-fw fa-sign-out-alt"></i>
        <span>Logout</span></a>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider">




      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
          <!-- End of Sidebar -->