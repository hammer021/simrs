<div class="main-menu menu-fixed menu-dark menu-accordion    menu-shadow " data-scroll-to-active="true" id="menu" data-img="<?php echo base_url(); ?>theme-assets/images/backgrounds/04.jpg">
      <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">       
          <li class="nav-item mr-auto"><a class="navbar-brand" href="<?php echo base_url(); ?>admin/dashboard">"><img class="brand-logo" alt=" admin logo" src="<?php echo base_url(); ?>theme-assets/images/logo/logo-rsj.png"/>
              <h3 class="brand-text">RSJ Lawang</h3></a></li>
          <li class="nav-item d-md-none"><a class="nav-link close-navbar"><i class="ft-x"></i></a></li>
        </ul>
      </div>
      <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
          <li class="
          <?php if ($_SERVER['REQUEST_URI'] == '/simrs/Web/admin/dashboard'){ echo 'active';}else { echo 'nav-item'; } ?>
          "><a href="<?php echo base_url(); ?>admin/dashboard"><i class="ft-home"></i><span class="menu-title" data-i18n="">Dashboard</span></a>
          </li>
          <li class="
          <?php if ($_SERVER['REQUEST_URI'] == '/simrs/Web/admin/pemeriksaan'){ echo 'active';}else { echo 'nav-item';}?>
          "><a href="<?php echo base_url(); ?>admin/pemeriksaan"><i class="la la-medkit"></i><span class="menu-title" data-i18n="">Pemeriksaan</span></a>
          </li>
          <li class="
          <?php if ($_SERVER['REQUEST_URI'] == '/simrs/Web/admin/datadokter' || $_SERVER['REQUEST_URI'] == '/simrs/Web/admin/datapasien' || $_SERVER['REQUEST_URI'] == '/simrs/Web/admin/dataklinik'){ echo 'active has-sub';}else { echo 'nav-item has-sub'; } ?>
          "><a href="#"><i class="ft-layers"></i><span class="menu-title" data-i18n="">Data</span></a>
            <ul class="menu-content" style="">
              <li class="
              <?php if ($_SERVER['REQUEST_URI'] == '/simrs/Web/admin/datadokter'){ echo 'active';}else { }?>
          "><a class="menu-item" href="<?php echo base_url(); ?>admin/datadokter">Data Dokter</a>
              </li>
              <li class=""><a class="menu-item" href="chat-application.html">Data Pasien</a>
              </li>
              <li class=""><a class="menu-item" href="full-calender.html">Data Klinik</a>
              </li>
            </ul>
          </li>
        </ul>
      </div>
      <div class="navigation-background"></div>
    </div>