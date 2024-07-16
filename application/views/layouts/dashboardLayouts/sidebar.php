  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo base_url();?>admin" class="brand-link">
      <img src="<?php echo base_url();?>assets/dashboard/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Moonscape Travels</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="<?php echo base_url();?>admin" class="nav-link <?php if($this->uri->segment(1) == 'admin' && $this->uri->segment(2) == null):?>active<?php endif;?>">
            <i class="far fa-circle nav-icon"></i>
            <p>Dashboard</p>
            </a>
          </li>

          <li class="nav-item <?php if($this->uri->segment('2') == 'packages'): ?>menu-is-opening menu-open<?php endif;?>">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Travel Plan
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url();?>admin/packages/add" class="nav-link <?php if($this->uri->segment('2') == 'packages' && $this->uri->segment('3') == 'add'): ?>active<?php endif;?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url();?>admin/packages/list" class="nav-link <?php if($this->uri->segment('2') == 'packages' && $this->uri->segment('3') == 'list'): ?>active<?php endif;?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item <?php if($this->uri->segment('2') == 'itineraries'): ?>menu-is-opening menu-open<?php endif;?>">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Itineraries
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url();?>admin/itineraries/add" class="nav-link <?php if($this->uri->segment('2') == 'itineraries' && $this->uri->segment('3') == 'add'): ?>active<?php endif;?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url();?>admin/itineraries/list" class="nav-link <?php if($this->uri->segment('2') == 'itineraries' && $this->uri->segment('3') == 'list'): ?>active<?php endif;?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item <?php if($this->uri->segment('2') == 'days'): ?>menu-is-opening menu-open<?php endif;?>">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Package Days
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url();?>admin/days/add" class="nav-link <?php if($this->uri->segment('2') == 'days' && $this->uri->segment('3') == 'add'): ?>active<?php endif;?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url();?>admin/days/list" class="nav-link <?php if($this->uri->segment('2') == 'days' && $this->uri->segment('3') == 'list'): ?>active<?php endif;?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item <?php if($this->uri->segment('2') == 'cars'): ?>menu-is-opening menu-open<?php endif;?>">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Cars Rental
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url();?>admin/cars/add" class="nav-link <?php if($this->uri->segment('2') == 'cars' && $this->uri->segment('3') == 'add'): ?>active<?php endif;?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url();?>admin/cars/list" class="nav-link <?php if($this->uri->segment('2') == 'cars' && $this->uri->segment('3') == 'list'): ?>active<?php endif;?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url();?>admin/cars/categories/list" class="nav-link <?php if($this->uri->segment('2') == 'cars' && $this->uri->segment('3') == 'categories'): ?>active<?php endif;?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Category List</p>
                </a>
              </li>
            </ul>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">