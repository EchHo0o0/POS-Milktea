<style>
 
  
  .btn-rounded{
        border-radius: 50px;
  }
  /* Milk Tea Navbar Styling */
  .navbar.navbar-expand.navbar-dark.bg-gradient-navy {
        background: linear-gradient(to right, #F3E5AB, #C7A17A); /* Milk Tea-inspired gradient */
        color: #fff;
  }
  .navbar-nav .nav-link {
        color: #6D4F29; /* Dark brown text for links */
  }
  .navbar-nav .nav-link:hover {
        color: #F3E5AB; /* Lighter Milk Tea color for hover effect */
  }
  .dropdown-menu {
        background-color: #F3E5AB; /* Lighter Milk Tea color for dropdown */
        border-color: #C7A17A; /* Complementary brown border */
  }
  .dropdown-item {
        color: #6D4F29; /* Dark brown color for dropdown items */
  }
  .dropdown-item:hover {
        background-color: #C7A17A; /* Slightly darker brown for hover */
        color: #fff;
  }
  .badge-light {
        background-color: #F3E5AB; /* Background color for badge in user menu */
  }
  .btn-rounded {
        background-color: #C7A17A; /* Background color for the button */
        color: #fff;
        border: none;
  }
  .btn-rounded:hover {
        background-color: #6D4F29; /* Darker brown for button hover */
  }
  /* Avatar Image in the Navbar */
  .user-img {
        border: 2px solid #C7A17A; /* Border color for avatar image */
  }
</style>

<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-dark shadow text-sm bg-gradient-navy">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php echo base_url ?>" class="nav-link"><?php echo (!isMobileDevice()) ? $_settings->info('name'):$_settings->info('short_name'); ?> - Admin</a>
      </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <!-- <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
        <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li> -->
      <!-- Messages Dropdown Menu -->
      <li class="nav-item">
        <div class="btn-group nav-link">
              <button type="button" class="btn btn-rounded badge badge-light dropdown-toggle dropdown-icon" data-toggle="dropdown">
              
                <span class="ml-3"><?php echo ucwords($_settings->userdata('firstname').' '.$_settings->userdata('lastname')) ?></span>
                <span class="sr-only">Toggle Dropdown</span>
              </button>
              <div class="dropdown-menu" role="menu">
                <a class="dropdown-item" href="<?php echo base_url.'admin/?page=user' ?>"><span class="fa fa-user"></span> My Account</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?php echo base_url.'/classes/Login.php?f=logout' ?>"><span class="fas fa-sign-out-alt"></span> Logout</a>
              </div>
          </div>
      </li>
      <li class="nav-item">
        
      </li>
     <!--  <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
        <i class="fas fa-th-large"></i>
        </a>
      </li> -->
    </ul>
</nav>
<!-- /.navbar -->
