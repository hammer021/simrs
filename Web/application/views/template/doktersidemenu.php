<div class="main-menu menu-fixed menu-dark menu-accordion    menu-shadow " data-scroll-to-active="true" id="menu" data-img="<?php echo base_url(); ?>theme-assets/images/backgrounds/04.jpg">
      <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">       
          <li class="nav-item mr-auto"><a class="navbar-brand" href="<?php echo base_url(); ?>dokter/dashboard"><img class="brand-logo" alt=" admin logo" src="<?php echo base_url(); ?>theme-assets/images/logo/logo-rsj.png"/>
              <h3 class="brand-text">RSJ Lawang</h3></a></li>
          <li class="nav-item d-md-none"><a class="nav-link close-navbar"><i class="ft-x"></i></a></li>
        </ul>
      </div>
      <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
          <li class="
          <?php if ($_SERVER['REQUEST_URI'] == '/simrs/Web/dokter/dashboard'){ echo 'active';}else { echo 'nav-item'; } ?>
          "><a href="<?php echo base_url(); ?>dokter/dashboard"><i class="ft-home"></i><span class="menu-title" data-i18n="">Dashboard</span></a>
          </li>
          <li class="
          <?php if ($_SERVER['REQUEST_URI'] == '/simrs/Web/dokter/resep'){ echo 'active';}else { echo 'nav-item'; } ?>
          "><a href="<?php echo base_url(); ?>dokter/resep"><i class="la la-medkit"></i><span class="menu-title" data-i18n="">Resep </span></a>
          </li>
          <li class="
          <?php if ($_SERVER['REQUEST_URI'] == '/simrs/Web/dokter/datapemeriksaan'){ echo 'active';}else { echo 'nav-item';}?>
          "><a href="<?php echo base_url(); ?>dokter/datapemeriksaan"><i class="la la-medkit"></i><span class="menu-title" data-i18n="">Data Pemeriksaan </span></a>
          </li>
          <li class="
          <?php if ($_SERVER['REQUEST_URI'] == '/simrs/Web/dokter/laporanpemeriksaan'){ echo 'active';}else { echo 'nav-item';}?>
          "><a href="<?php echo base_url(); ?>dokter/laporanpemeriksaan"><i class="la la-medkit"></i><span class="menu-title" data-i18n="">Laporan Pemeriksaan </span></a>
          </li>
          <li class="
          
            </ul>
          </li>
        </ul>
      </div>
      <div class="navigation-background"></div>
    </div>