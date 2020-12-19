<!DOCTYPE html>


<!-- ////////////////////////////////////////////////////////////////////////////-->



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
                            <h4 class="card-title">Doctor</h4>
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
                            <?php 
                            $no = 1;
                            foreach ($dokter as $dok) {  ?>
                                <a href="#"  onclick="closeNav()"  data-bs-toggle="modal" id="cht<?=$no?>" data-bs-target="#chat<?= $no ?>" class="media border-0">
                                    <div class="media-left pr-1">
                                        <span class="avatar avatar-md avatar-online">
                                            <img class="media-object rounded-circle" 
                                            src="<?php echo base_url(); ?>./assets/images/dokter/<?php echo $dok['foto_dokter'] ?>" 
                                            alt="Generic placeholder image">
                                            <i></i>
                                        </span>
                                    </div>
                                    <div class="media-body w-100">
                                        <span class="list-group-item-heading">
                                        <?= $dok['nama_dokter'] ?>
                                        </span>
                                        
                                        <ul class="list-unstyled users-list m-0 float-right">
                                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="<?= $dok['nama_dokter'] ?>" class="avatar avatar-sm pull-up">
                                                <img href="javascript:;" data-friend="<?= $dok['no_praktek'] ?>"
                                                class="media-object rounded-circle no-border-top-radius no-border-bottom-radius" 
                                                src="<?php echo base_url(); ?>./assets/images/dokter/default.jpg" alt="Avatar">
                                            </li>
                                            
                                            
                                        </ul>
                                        <p class="list-group-item-text mb-0">
                                            <span class="blue-grey lighten-2 font-small-3"><?= $dok['no_hp_dokter'] ?> </span>
                                        </p>
                                    </div>
                                </a>
                            <?php
                            $no ++;
                            }?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-3 col-md-6">
                    <div class="card pull-up ecom-card-1 bg-white">
                        <div class="card-content ecom-card2 height-50">
                            <h5 class="text-muted danger position-absolute p-1">Progress Stats</h5>
                            <div class="card">
                                <center>
                                    <img src="<?= base_url("assets/images/pasien.jpg") ?>" style="width:16%" class="card-img-top">
                                    <div class="card-body">
                                        <?php foreach ($totpasien as $row) {  ?>
                                            <h5 class="card-title font-weight-bold"><?= $row['jmlpasien'] ?></h5>
                                        <?php } ?>
                                        <p class="card-text">Jumlah Pasien</p>
                                        <a href="<?= base_url('admin/datadokter') ?>" class="btn btn-primary">Lihat</a>
                                    </div>
                                </center>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-3 col-md-6">
                    <div class="card pull-up ecom-card-1 bg-white">
                        <div class="card-content ecom-card2 height-50">
                            <h5 class="text-muted danger position-absolute p-1">Progress Stats</h5>
                            <div class="card">
                                <center>
                                    <img src="<?= base_url("assets/images/dokter.jpg") ?>" style="width: 20%" class="card-img-top">
                                    <div class="card-body">
                                        <?php foreach ($totdokter as $row) {  ?>
                                            <h5 class="card-title font-weight-bold"><?= $row['jmldokter'] ?></h5>
                                        <?php } ?>
                                        <p class="card-text">Jumlah Dokter</p>
                                        <a href="<?= base_url('admin/datadokter') ?>" class="btn btn-primary">Lihat</a>
                                    </div>
                                </center>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                        $bulanini = Date('m');
                        $tahun = Date('Y');
                        $bulanlalu = Date('m', strtotime('-1 month'));
                        $analisis1 = $this->db->query("SELECT COUNT(no_rm) as jumlah FROM `tb_keluhan` WHERE month(tgl_kunjungan) = ".$bulanini." and year(tgl_kunjungan) = ".$tahun."")->row_array();
                        $analisis2 = $this->db->query("SELECT COUNT(no_rm) as jumlah FROM `tb_keluhan` WHERE month(tgl_kunjungan) = ".$bulanlalu." and year(tgl_kunjungan) = ".$tahun."")->row_array();
                    
                        
                    if($analisis1['jumlah'] == 0 || $analisis2['jumlah'] == 0){

                                    echo '<div class="col-xl-4 col-lg-6 col-md-12">
                                    <div class="card pull-up height-200" style="background-image: linear-gradient(to right, #0066cc 0%, #6699ff 100%);">
                                        <div class="card-body">
                                            <h4 class="card-title" style="color:white">Analisis</h4>
                                            <p class="card-text text-center" style="color:white;margin-top:50px;font-size:15px ">
                                                Tidak ada data
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>';
                    }else{

                        if($analisis2['jumlah'] < $analisis1['jumlah']){
                            $persen = ($analisis2['jumlah']-$analisis1['jumlah'])/$analisis2['jumlah']*100 ;
                   
                                echo '<div class="col-xl-4 col-lg-6 col-md-12">
                                    <div class="card pull-up height-200" style="background-image: linear-gradient(to right, #F35050, #D68B8B)">
                                        <div class="card-body">
                                            <h4 class="card-title" style="color:white">Analisis</h4>
                                            <p class="card-text text-center" style="color:white;margin-top:30px;font-size:40px ">
                                                '.$persen.'%
                                            </p>
                                            <p class="card-text pasien">Pasien Berkurang</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>';
                        }else{
                            $persen = ($analisis1['jumlah']-$analisis2['jumlah'])/$analisis1['jumlah']*100 ;

                                echo '<div class="col-xl-4 col-lg-6 col-md-12">
                                            <div class="card pull-up height-200" style="background-image: linear-gradient(to right, #2ebd28, #86e882)">
                                                <div class="card-body">
                                                    <h4 class="card-title" style="color:white">Analisis</h4>
                                                    <p class="card-text text-center" style="color:white;margin-top:30px;font-size:40px ">
                                                        '.$persen.'%?>
                                                    </p>
                                                    <p class="card-text pasien">Pasien Bertambah</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>';
                            }
                        } ?> 

                    <!-- Modal -->
                    <?php 
                    $no =1;
                    foreach ($dokter as $dok) {  ?>
                    <div class="modal fade " id="chat<?= $no ?>" tabindex="-1" aria-labelledby="chat1" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    </div>
                                <div class="modal-body">
                                    <div class="col-md-4">
                                    <ul class="friend-list">
                                        <li class="active bounceInDown">
                                            <a href="#" class="clearfix">
                                                <img src="https://bootdey.com/img/Content/user_1.jpg" alt="" class="img-circle">
                                                <div class="friend-name">	
                                                    <strong>John Doe</strong>
                                                </div>
                                                <div class="last-message text-muted">Hello, Are you there?</div>
                                                <small class="time text-muted">Just now</small>
                                                <small class="chat-alert label label-danger">1</small>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="clearfix">
                                                <img src="https://bootdey.com/img/Content/user_2.jpg" alt="" class="img-circle">
                                                <div class="friend-name">	
                                                    <strong>Jane Doe</strong>
                                                </div>
                                                <div class="last-message text-muted">Lorem ipsum dolor sit amet.</div>
                                                <small class="time text-muted">5 mins ago</small>
                                            <small class="chat-alert text-muted"><i class="fa fa-check"></i></small>
                                            </a>
                                        </li> 
                                    </div>
                                </div>
                                    <div class="modal-footer">
                                        <button type="button" id="close" class="btn btn-secondary" onclick="openNav()" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <?php 
                    $no ++;
                    } ?>
                    <!--/modal-->
        
</div>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<script type="text/javascript">
function closeNav() {
  document.getElementById("menu").style.width = "0";
  document.getElementById("main").style.marginLeft= "0";
  document.getElementById("nav").style.marginLeft= "0";
  $(".navbar-header").hide();
}

function openNav() {
  document.getElementById("main").removeAttribute('style');
  document.getElementById("menu").removeAttribute('style');
  document.getElementById("nav").removeAttribute('style');
  $(".navbar-header").show();
}
			function insertData(){
				if ($("#nama").val().trim()=='' || $("#pesan").val()==''){
					$("#isiw").html('Lengkapi..');
				}else{
					var datainput = {'nama':$("#nama").val(),'pesan':$("#pesan").val()};
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
							$("#btn").removeClass("disabled");

						},
						error:function(){
							$("#loader").hide();
							$("#btn").removeClass("disabled");
						}
					});
				}				
			}
		$(document).ready(function(){
			function tampilPesan(){			    	
				$.ajax({
					type:'POST',
					url:'<?php echo base_url();?>/index.php/chat/tampil_pesan',
					success:function(rs){
						$("#isi").html(rs);
					}
				});
			}		
			setInterval(function(){
				tampilPesan();
				$('#isiw').empty();	
			},1000);	
		});
		
        </script>
    
<!-- ////////////////////////////////////////////////////////////////////////////-->

