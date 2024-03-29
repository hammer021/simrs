<html class="loading" lang="en" data-textdirection="ltr">
  <head>
    
    <title>Telekonsul</title>
    <link rel="apple-touch-icon" href="<?php echo base_url(); ?>theme-assets/images/logo/logo-rsj.png">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>theme-assets/images/logo/logo-rsj.png">
    <link href="https://fonts.googleapis.com/css?family=Muli:300,300i,400,400i,600,600i,700,700i%7CComfortaa:300,400,700" rel="stylesheet">
    <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css" rel="stylesheet">
    <link href="https://themeselection.com/demo/chameleon-admin-template/app-assets/fonts/line-awesome/css/line-awesome.min.css" rel="stylesheet">
    <link href="https://themeselection.com/demo/chameleon-admin-template/app-assets/css/plugins/charts/chartist.min.css" rel="stylesheet">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>theme-assets/css/vendors.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>theme-assets/vendors/css/charts/chartist.css">
    <!-- END VENDOR CSS-->
    <!-- BEGIN CHAMELEON  CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>theme-assets/css/app-lite.css">
    <!-- END CHAMELEON  CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>theme-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>theme-assets/css/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>theme-assets/css/pages/dashboard-ecommerce.css">
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>theme-assets/css/chat.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>theme-assets/css/custom1.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/d0d4d04864.js" crossorigin="anonymous"></script>
    <!-- END Custom CSS-->
  </head>
  <body class="vertical-layout vertical-menu 2-columns   menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu" data-color="bg-chartbg" data-col="2-columns">

    <!-- fixed-top-->
    <nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-light">
      <div  class="navbar-wrapper">
        <div id="nav" class="navbar-container content">
          <div class="collapse navbar-collapse show" id="navbar-mobile">
            <ul class="nav navbar-nav mr-auto float-left">
              <li class="nav-item d-block d-md-none"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu"></i></a></li>
              <li class="nav-item d-none d-md-block"><a class="nav-link nav-link-expand" href="#" id="maximize"><i onclick="closeNav()" class="ficon ft-maximize"></i></a></li>
              <?php 
              if(strpos($_SERVER['REQUEST_URI'], "dashboard") !== false || strpos($_SERVER['REQUEST_URI'], "Profile") !== false) {
              }else{
              ?>
              <li class="nav-item dropdown navbar-search"><a class="nav-link dropdown-toggle hide" data-toggle="dropdown" href="#"><i class="ficon ft-search"></i></a>
                <ul class="dropdown-menu">
                  <li class="arrow_box">
                  <?php if (strpos($_SERVER['REQUEST_URI'], "admin/datadokter") !== false){

                    echo '<form method="post" action="'.base_url('admin/datadokter/dokter').'">
                      <div class="input-group search-box">
                        <div class="position-relative has-icon-right full-width">
                          <input class="form-control" name="dokter" id="search" type="text" placeholder="Cari Nama Dokter">
                          <div class="form-control-position navbar-search-close"><i class="ft-x">   </i></div>
                        </div>
                      </div>
                    </form>';
                    }elseif (strpos($_SERVER['REQUEST_URI'], "admin/dataklinik") !== false){
                      echo '<form method="post" action="'.base_url('admin/dataklinik/klinik').'">
                      <div class="input-group search-box">
                        <div class="position-relative has-icon-right full-width">
                          <input class="form-control" name="klinik" id="search" type="text" placeholder="Cari Klinik">
                          <div class="form-control-position navbar-search-close"><i class="ft-x">   </i></div>
                        </div>
                      </div>
                    </form>';
                    }elseif (strpos($_SERVER['REQUEST_URI'], "admin/datapasien") !== false){
                      echo '<form method="post" action="'.base_url('admin/datapasien/pasien').'">
                      <div class="input-group search-box">
                        <div class="position-relative has-icon-right full-width">
                          <input class="form-control" name="pasien" id="search" type="text" placeholder="Cari Nama Pasien">
                          <div class="form-control-position navbar-search-close"><i class="ft-x">   </i></div>
                        </div>
                      </div>
                    </form>';
                    }elseif (strpos($_SERVER['REQUEST_URI'], "admin/datauser") !== false) {
                      echo '<form method="post" action="'.base_url('admin/datauser/user').'">
                      <div class="input-group search-box">
                        <div class="position-relative has-icon-right full-width">
                          <input class="form-control" name="user" id="search" type="text" placeholder="Cari Nama User">
                          <div class="form-control-position navbar-search-close"><i class="ft-x">   </i></div>
                        </div>
                      </div>
                    </form>';
                  }elseif (strpos($_SERVER['REQUEST_URI'], "admin/pemeriksaan") !== false) {
                    echo '<form method="post" action="'.base_url('admin/pemeriksaan/periksa').'">
                    <div class="input-group search-box">
                      <div class="position-relative has-icon-right full-width">
                        <input class="form-control" name="konsul" id="search" type="text" placeholder="Cari No Rm">
                        <div class="form-control-position navbar-search-close"><i class="ft-x">   </i></div>
                      </div>
                    </div>
                  </form>';
                  //dokter search
                  }elseif (strpos($_SERVER['REQUEST_URI'], "dokter/resep") !== false) {
                    echo '<form method="post" action="'.base_url('dokter/resep/resep').'">
                    <div class="input-group search-box">
                      <div class="position-relative has-icon-right full-width">
                        <input class="form-control" name="resep" id="search" type="text" placeholder="Cari Kode Resep">
                        <div class="form-control-position navbar-search-close"><i class="ft-x">   </i></div>
                      </div>
                    </div>
                  </form>';
                  }elseif (strpos($_SERVER['REQUEST_URI'], "dokter/datapemeriksaan") !== false) {
                    echo '<form method="post" action="'.base_url('dokter/datapemeriksaan/dperiksa').'">
                    <div class="input-group search-box">
                      <div class="position-relative has-icon-right full-width">
                        <input class="form-control" name="konsul" id="search" type="text" placeholder="Cari No Rm">
                        <div class="form-control-position navbar-search-close"><i class="ft-x">   </i></div>
                      </div>
                    </div>
                  </form>';
                  }elseif (strpos($_SERVER['REQUEST_URI'], "dokter/laporanpemeriksaan") !== false) {
                    echo '<form method="post" action="'.base_url('dokter/laporanpemeriksaan/lperiksa').'">
                    <div class="input-group search-box">
                      <div class="position-relative has-icon-right full-width">
                        <input class="form-control" name="konsul" id="search" type="text" placeholder="Cari No Rm">
                        <div class="form-control-position navbar-search-close"><i class="ft-x">   </i></div>
                      </div>
                    </div>
                  </form>';
                    }
                  }?>
                  </li>
                </ul>
              </li>
            </ul>
           
            <ul class="nav navbar-nav float-right">
            <li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label" href="#"  data-bs-toggle="modal" id="cht" data-bs-target="#chat"  data-toggle="dropdown"><i class="ficon ft-mail" id="notip"></i></a>
              </li>
              <li class="dropdown dropdown-user nav-item">
              <?php
                    $sess = $this->session->userdata("kd_role");
                    if ($sess=="1"){
                      ?> <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">             
                      <span class="avatar avatar-online">
                      <img src="../assets/images/<?php echo $this->session->userdata("image"); ?>" alt="avatar">
                      <i></i></span></a>
                   <?php } 
                   else if ($sess=="0"){
                    ?> <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">             
                    <span class="avatar avatar-online">
                    <img src="../assets/images/<?php echo $this->session->userdata("image"); ?>" alt="avatar">
                    <i></i></span></a>
                 <?php } 
                   else if ($sess=="2"){
                      ?><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">             
                      <span class="avatar avatar-online">
                      <img src="../assets/images/dokter/<?php echo $this->session->userdata("image"); ?>" alt="avatar">
                      <i></i></span></a>
                   <?php } ?>
                

                <div class="dropdown-menu dropdown-menu-right">
                  <div class="arrow_box_right">
                  <?php
                    $sess = $this->session->userdata("kd_role");
                    if ($sess=="1"){
                      ?> <a class="dropdown-item" href="#">
                      <span class="avatar avatar-online">
                        <img src="../assets/images/<?php echo $this->session->userdata("image"); ?>" 
                        alt="avatar"><span class="user-name text-bold-700 ml-1">
                          <?php echo $this->session->userdata("name"); ?></span></span></a>
                   <?php } 
                  else if ($sess=="0"){
                    ?> <a class="dropdown-item" href="#">
                    <span class="avatar avatar-online">
                      <img src="../assets/images/<?php echo $this->session->userdata("image"); ?>" 
                      alt="avatar"><span class="user-name text-bold-700 ml-1">
                        <?php echo $this->session->userdata("name"); ?></span></span></a>
                 <?php } 
                   else if ($sess=="2"){
                      ?><a class="dropdown-item" href="#">
                      <span class="avatar avatar-online">
                        <img src="../assets/images/dokter/<?php echo $this->session->userdata("image"); ?>" 
                        alt="avatar"><span class="user-name text-bold-700 ml-1">
                          <?php echo $this->session->userdata("name"); ?></span></span></a>
                   <?php } ?>
                
                    

                    <div class="dropdown-divider"></div>
                    <?php
                    $sess = $this->session->userdata("kd_role");
                    if ($sess=="1"){
                      ?> <a class="dropdown-item" href="<?php echo base_url('Admin/profileadm')?>">
                      
                   <?php } 
                   else if ($sess=="0"){
                    ?> <a class="dropdown-item" href="<?php echo base_url('Admin/profileadm')?>">
                    
                 <?php } 
                   else if ($sess=="2"){
                      ?> <a class="dropdown-item" href="<?php echo base_url('Dokter/profiledok')?>">
                   <?php } ?>
                   
                    <i class="ft-user"></i> Edit Profile</a>


                    <?php
                    $sess = $this->session->userdata("kd_role");
                    if ($sess=="1"){
                      ?> <a class="dropdown-item" href="<?php echo base_url('Profile/changepassadm')?>">
                      
                   <?php } 
                   else if ($sess=="0"){
                    ?> <a class="dropdown-item" href="<?php echo base_url('Profile/changepassadm')?>">
                    
                 <?php } 
                   else if ($sess=="2"){
                      ?> <a class="dropdown-item" href="<?php echo base_url('Profile/changepassdok')?>">
                   <?php } ?>
                   
                   <i class="ft-settings"></i> Setting</a>
                    
                    
                    

                    <div class="dropdown-divider"></div><a class="dropdown-item" href="<?php echo base_url('Auth/logout')?>"><i class="ft-power"></i> Logout</a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </nav>
    