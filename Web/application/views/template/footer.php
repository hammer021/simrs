 <!-- Modal -->
 <div class="modal fade " id="chat" tabindex="-1" aria-labelledby="chat1" aria-hidden="true">
                            <div class="modal-dialog  h-100 d-flex flex-column justify-content-center my-0 modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Chat</h5>
                                    </div>
                                <div class="modal-body" style="height:50vh;">
                                    <div class="row">
                                        <div class="col-md-4" style="overflow-y:auto;height:40vh;border-right: 1px solid #d9d9d9!important; ">
                                        <ul class="friend-list" id="list">
                                        </ul>
                                    </div>
                                    <div class="col-md-8 " style="overflow-y:auto;height:40vh;display: flex;flex-direction: column-reverse;">
                                        <div class="chat-message" style="padding-bottom:5px">
                                            <ul id="isi" class="chat">
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                    <form id="formpesan">  
                                        <div class="searchbar col-md-8 offset-md-4" style="padding: 10px 60px 10px 10px;">
                                        <input type="hidden" id="kd" value="<?= $this->session->userdata('kd_regist') ?>">
                                            <div class="row">
                                                <div class="col-md-11">
                                                <input class="search_input col-12" style="color:black;margin-top20px" type="text" name="" id="pesan" placeholder="Search...">
                                                </div>
                                                <div class="col-md-1 justify-content-center">
                                                <button class="btn btn-primary" type="button"  value="kirim" onclick="insertData()" ><i class="fas fa-paper-plane"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                    <div class="modal-footer" >
                                    </div>
                                </div>
                            </div>
                    </div>
                    </div>
                    <!--/modal-->
        
</div>

<script type="text/javascript">
function closeNav() {
  document.getElementById("menu").style.width = "0";
  document.getElementById("main").style.marginLeft= "0";
  document.getElementById("nav").style.marginLeft= "0";
  document.getElementById("footer").style.marginLeft= "0";
  $(".navbar-header").hide();
  $('#maximize').html('<i onclick="openNav()" class="ficon ft-maximize"></i>');
}

function openNav() {
  document.getElementById("main").removeAttribute('style');
  document.getElementById("menu").removeAttribute('style');
  document.getElementById("nav").removeAttribute('style');
  document.getElementById("footer").removeAttribute('style');
  $(".navbar-header").show();
  $('#maximize').html('<i onclick="closeNav()" class="ficon ft-maximize"></i>');
}

			function insertData(){
				if ($("#kd").val().trim()=='' || $("#pesan").val()==''){
					$("#isiw").html('Lengkapi..');
				}else{
					var datainput = {'kode':$("#kd").val(),'pesan':$("#pesan").val(),'send_to':global1};
					$.ajax({
						type:'POST',
						data:datainput,
						url:'<?php echo base_url();?>chat/insertpesan',
						beforeSend:function(){
							$("#loader").show();
							$("#btn").addClass("disabled");
						},
						success:function(rs){
							$("#isiw").html(rs);
							$("#loader").hide();
                            $( '#formpesan' ).each(function(){
                                this.reset();
                        });
							$("#btn").removeClass("disabled");

						},
						error:function(){
							$("#loader").hide();
							$("#btn").removeClass("disabled");
						}
					});
				}				
			}
            var global1 = "";

            function setGlobal(gg) {
                global1= gg;

                $.ajax({
					type:'POST',
                    data:{'dia':global1},
					url:'<?php echo base_url();?>chat/update_status',
					success:function(rs){
						$("#isi").html(rs);
					}
				});
            }
            function tampilPesan(id){
                
                if(global1== null){
                    var url1 = '<?php echo base_url();?>chat/tampil_pesan'; 
                }else{
                    var url1 = '<?php echo base_url();?>chat/tampil_pesan/'+global1; 
                }
				$.ajax({
					type:'POST',
					url:url1,
					success:function(rs){
						$("#isi").html(rs);
					}
				});
			}
            function tampilList(){	
                if(global1== null){
                    var url1 = '<?php echo base_url();?>chat/tampilList'; 
                }else{
                    var url1 = '<?php echo base_url();?>chat/tampilList/'+global1; 
                }	    	
				$.ajax({
					type:'POST',
					url:url1,
					success:function(rs){
						$("#list").html(rs);
					}
				});
            }
            function notifikasi(){		    	
				$.ajax({
					type:'POST',
                    url:'<?php echo base_url();?>chat/notifikasi',
					success:function(rs){
						$("#notip").html(rs);
					}
				});
            }
            
        	
		$(document).ready(function(){
            $('#chat').on('shown.bs.modal', function () {
                closeNav();
            });
            $('#chat').on('hidden.bs.modal', function () {
                openNav();
            });
            $('#er001').modal('show');
			setInterval(function(){
                notifikasi();
                tampilList(global1);
				tampilPesan(global1);
				$('#isiw').empty();	
			},1000);	
		});
        </script>

<footer id="footer" class="footer footer-static footer-light navbar-border navbar-shadow">
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