<!DOCTYPE html>


    <!-- ////////////////////////////////////////////////////////////////////////////-->

    <?php include_once 'header.php';?>
    <?php include_once 'sidemenu.php'; ?>

    <div class="app-content content" id="main">
      <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
        <div class="content-header row">
        <div class="content-header-left col-md-4 col-12 mb-2">
            <h3 class="content-header-title" style="margin-bottom:50px;margin-top:80px">Dashboard</h3>
          </div>
        </div>
        <div class="content-body">
<!-- Chart -->
<!-- eCommerce statistic -->
<div class="row">
    <div class="col-xl-9 col-lg-6 col-md-12">
        <div class="card pull-up ecom-card-1 bg-white">
            <div class="card-content ecom-card2 height-500">
                <h5 class="text-muted position-absolute p-1">Pasien Periksa</h5>
                <div>
                    <i class="ft-pie-chart danger font-large-1 float-right p-1"></i>
                </div>
                <div class="card-body">
                    <div class="position-relative">
                        <div id="areaGradient" class="height-400 areaGradientShadow"> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-lg-12">
        <div class="card pull-up ">
            <div class="card-header">
                <h4 class="card-title">Best Doctor</h4>
                <a class="heading-elements-toggle">
                    <i class="fa fa-ellipsis-v font-medium-3"></i>
                </a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li>
                            <a data-action="reload">
                                <i class="ft-rotate-cw"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card-content">
                <div id="recent-buyers" class="media-list">
                    <a href="#" class="media border-0">
                        <div class="media-left pr-1">
                            <span class="avatar avatar-md avatar-online">
                                <img class="media-object rounded-circle" src="theme-assets/images/portrait/small/avatar-s-7.png" alt="Generic placeholder image">
                                <i></i>
                            </span>
                        </div>
                        <div class="media-body w-100">
                            <span class="list-group-item-heading">Kristopher Candy

                            </span>
                            <ul class="list-unstyled users-list m-0 float-right">
                                <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Product 1" class="avatar avatar-sm pull-up">
                                    <img class="media-object rounded-circle no-border-top-radius no-border-bottom-radius" src="theme-assets/images/portfolio/portfolio-1.jpg"
                                        alt="Avatar">
                                </li>
                                <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Product 2" class="avatar avatar-sm pull-up">
                                    <img class="media-object rounded-circle no-border-top-radius no-border-bottom-radius" src="theme-assets/images/portfolio/portfolio-2.jpg"
                                        alt="Avatar">
                                </li>
                                <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Product 3" class="avatar avatar-sm pull-up">
                                    <img class="media-object rounded-circle no-border-top-radius no-border-bottom-radius" src="theme-assets/images/portfolio/portfolio-4.jpg"
                                        alt="Avatar">
                                </li>
                            </ul>
                            <p class="list-group-item-text mb-0">
                                <span class="blue-grey lighten-2 font-small-3"> #INV-12332 </span>
                            </p>
                        </div>
                    </a>
                    <a href="#" class="media border-0">
                        <div class="media-left pr-1">
                            <span class="avatar avatar-md avatar-away">
                                <img class="media-object rounded-circle" src="theme-assets/images/portrait/small/avatar-s-8.png" alt="Generic placeholder image">
                                <i></i>
                            </span>
                        </div>
                        <div class="media-body w-100">
                            <span class="list-group-item-heading">Lawrence Fowler

                            </span>
                            <ul class="list-unstyled users-list m-0 float-right">
                                <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Product 1" class="avatar avatar-sm pull-up">
                                    <img class="media-object rounded-circle no-border-top-radius no-border-bottom-radius" src="theme-assets/images/portfolio/portfolio-5.jpg"
                                        alt="Avatar">
                                </li>
                                <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Product 2" class="avatar avatar-sm pull-up">
                                    <img class="media-object rounded-circle no-border-top-radius no-border-bottom-radius" src="theme-assets/images/portfolio/portfolio-6.jpg"
                                        alt="Avatar">
                                </li>
                            </ul>
                            <p class="list-group-item-text mb-0">
                                <span class="blue-grey lighten-2 font-small-3"> #INV-12333 </span>
                            </p>
                        </div>
                    </a>
                    <a href="#" class="media border-0">
                        <div class="media-left pr-1">
                            <span class="avatar avatar-md avatar-busy">
                                <img class="media-object rounded-circle" src="theme-assets/images/portrait/small/avatar-s-9.png" alt="Generic placeholder image">
                                <i></i>
                            </span>
                        </div>
                        <div class="media-body w-100">
                            <span class="list-group-item-heading">Linda Olson

                            </span>
                            <ul class="list-unstyled users-list m-0 float-right">
                                <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Product 1" class="avatar avatar-sm pull-up">
                                    <img class="media-object rounded-circle no-border-top-radius no-border-bottom-radius" src="theme-assets/images/portfolio/portfolio-2.jpg"
                                        alt="Avatar">
                                </li>
                                <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Product 2" class="avatar avatar-sm pull-up">
                                    <img class="media-object rounded-circle no-border-top-radius no-border-bottom-radius" src="theme-assets/images/portfolio/portfolio-5.jpg"
                                        alt="Avatar">
                                </li>
                            </ul>
                            <p class="list-group-item-text mb-0">
                                <span class="blue-grey lighten-2 font-small-3"> #INV-12334 </span>
                            </p>
                        </div>
                    </a>
                    <a href="#" class="media border-0">
                        <div class="media-left pr-1">
                            <span class="avatar avatar-md avatar-online">
                                <img class="media-object rounded-circle" src="theme-assets/images/portrait/small/avatar-s-10.png" alt="Generic placeholder image">
                                <i></i>
                            </span>
                        </div>
                        <div class="media-body w-100">
                            <span class="list-group-item-heading">Roy Clark

                            </span>
                            <ul class="list-unstyled users-list m-0 float-right">
                                <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Product 1" class="avatar avatar-sm pull-up">
                                    <img class="media-object rounded-circle no-border-top-radius no-border-bottom-radius" src="theme-assets/images/portfolio/portfolio-6.jpg"
                                        alt="Avatar">
                                </li>
                                <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Product 2" class="avatar avatar-sm pull-up">
                                    <img class="media-object rounded-circle no-border-top-radius no-border-bottom-radius" src="theme-assets/images/portfolio/portfolio-1.jpg"
                                        alt="Avatar">
                                </li>
                            </ul>
                            <p class="list-group-item-text mb-0">
                                <span class="blue-grey lighten-2 font-small-3"> #INV-12335 </span>
                            </p>
                        </div>
                    </a>
                    <a href="#" class="media border-0">
                        <div class="media-left pr-1">
                            <span class="avatar avatar-md avatar-online">
                                <img class="media-object rounded-circle" src="theme-assets/images/portrait/small/avatar-s-11.png" alt="Generic placeholder image">
                                <i></i>
                            </span>
                        </div>
                        <div class="media-body w-100">
                            <span class="list-group-item-heading">Kristopher Candy

                            </span>
                            <ul class="list-unstyled users-list m-0 float-right">
                                <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Product 1" class="avatar avatar-sm pull-up">
                                    <img class="media-object rounded-circle no-border-top-radius no-border-bottom-radius" src="theme-assets/images/portfolio/portfolio-5.jpg"
                                        alt="Avatar">
                                </li>
                            </ul>
                            <p class="list-group-item-text mb-0">
                                <span class="blue-grey lighten-2 font-small-3"> #INV-12336 </span>
                            </p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
</div>
<div class="col-xl-9 col-lg-6 col-md-12">
        <div class="card pull-up ecom-card-1 bg-white">
            <div class="card-content ecom-card2 height-200">
                <h5 class="text-muted danger position-absolute p-1">Progress Stats</h5>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-12">
			<div class="card pull-up height-200"  style="background-image: linear-gradient(to right, #F35050, #D68B8B)">
				<div class="card-body">
                    <h4 class="card-title" style="color:white">Analisis</h4>
                    <p class="card-text text-center"  style="color:white;margin-top:30px;font-size:40px ">-20.5%</p>
                    <p class="card-text pasien">Pasien Berkurang</p>
				</div>
			</div>
        </div>
</div>


<!-- Statistics -->

<!--/ Statistics -->
        </div>
      </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->


    <footer class="footer footer-static footer-light navbar-border navbar-shadow">
      <div class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2"><span class="float-md-left d-block d-md-inline-block">2018  &copy; Copyright <a class="text-bold-800 grey darken-2" href="https://themeselection.com" target="_blank">ThemeSelection</a></span>
        <ul class="list-inline float-md-right d-block d-md-inline-blockd-none d-lg-block mb-0">
          <li class="list-inline-item"><a class="my-1" href="https://themeselection.com/" target="_blank"> More themes</a></li>
          <li class="list-inline-item"><a class="my-1" href="https://themeselection.com/support" target="_blank"> Support</a></li>
          <li class="list-inline-item"><a class="my-1" href="https://themeselection.com/products/chameleon-admin-modern-bootstrap-webapp-dashboard-html-template-ui-kit/" target="_blank"> Purchase</a></li>
        </ul>
      </div>
    </footer>

    <!-- BEGIN VENDOR JS-->
    <script src="<?php echo base_url(); ?>theme-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="<?php echo base_url(); ?>theme-assets/vendors/js/charts/chartist.min.js" type="text/javascript"></script>
    <script src="https://themeselection.com/demo/chameleon-admin-template/app-assets/vendors/js/charts/chartist-plugin-tooltip.min.js" type="text/javascript"></script>
    <script src="https://themeselection.com/demo/chameleon-admin-template/app-assets/js/scripts/charts/chartist/line/area.min.js" type="text/javascript"></script>
  
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN CHAMELEON  JS-->
    <script src="<?php echo base_url(); ?>theme-assets/js/core/app-menu-lite.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>theme-assets/js/core/app-lite.js" type="text/javascript"></script>
    <!-- END CHAMELEON  JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="theme-assets/js/scripts/pages/dashboard-lite.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS-->
  </body>
</html>