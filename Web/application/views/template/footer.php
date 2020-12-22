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
    
  
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN CHAMELEON  JS-->
    <script src="<?php echo base_url(); ?>theme-assets/js/core/app-menu-lite.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>theme-assets/js/core/app-lite.js" type="text/javascript"></script>
    <!-- END CHAMELEON  JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="<?php echo base_url(); ?>theme-assets/js/scripts/pages/dashboard-lite.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
  
    <!-- END PAGE LEVEL JS-->
    <script>
    // assumes you're using jQuery
        $(document).ready(function() {
        $('.confirm-div').hide();
        <?php if($this->session->flashdata('success')){ ?>
        $('.confirm-div').html('<?php echo $this->session->flashdata('success'); ?>').show();
        <?php } ?>
        });
    </script>
    <script>
      $(window).on("load", function () {

        var areaGradientChart = new Chartist.Line('#areaGradient', {
          
            labels: [ 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sept', 'Okt', 'Nov', 'Des'],
            series: [
              [<?php foreach($bulan1 as $b)echo $b['aaa'] ?>,
              <?php foreach($bulan2 as $b)echo $b['aaa'] ?>,
              <?php foreach($bulan3 as $b)echo $b['aaa'] ?>,
              <?php foreach($bulan4 as $b)echo $b['aaa'] ?>,
              <?php foreach($bulan5 as $b)echo $b['aaa'] ?>,
              <?php foreach($bulan6 as $b)echo $b['aaa'] ?>,
              <?php foreach($bulan7 as $b)echo $b['aaa'] ?>,
              <?php foreach($bulan8 as $b)echo $b['aaa'] ?>,
              <?php foreach($bulan9 as $b)echo $b['aaa'] ?>,
              <?php foreach($bulan10 as $b)echo $b['aaa'] ?>,
              <?php foreach($bulan11 as $b)echo $b['aaa'] ?>,
              <?php foreach($bulan12 as $b)echo $b['aaa'] ?>
              
            ]
            ]
        }, {
                lineSmooth: Chartist.Interpolation.simple({
                    divisor: 2
                }),
                fullWidth: true,
                showArea: true,
                chartPadding: {
                    right: 25
                },
              
                axisX: {
                    showGrid: false
                },
                axisY: {               
                    scaleMinSpace: 40
                },
                plugins: [
                    Chartist.plugins.tooltip({                   
                        appendToBody: true,
                        pointClass: 'ct-point-circle'
                      })
                  ],
                low: 0,
                onlyInteger: true,
            });

          
            areaGradientChart.on('draw', function (data) {       
            var circleRadius = 9;
            if (data.type === 'point') {
                var circle = new Chartist.Svg('circle', {
                    cx: data.x,
                    cy: data.y,
                    'ct:value': data.value.y,
                    r: circleRadius,
                    class: data.value.y === 180 || data.value.y === 150 ? 'ct-point-circle' : 'ct-point-circle-transperent'
                });
                data.element.replace(circle);
            }
            if (data.type === 'line' || data.type == 'area') {
                data.element.animate({
                    d: {
                        begin: 1000,
                        dur: 1000,
                        from: data.path.clone().scale(1, 0).translate(0, data.chartRect.height()).stringify(),
                        to: data.path.clone().stringify(),
                        easing: Chartist.Svg.Easing.easeOutQuint
                    }
                });
            }
        });
      });
    </script>
</body>

</html>