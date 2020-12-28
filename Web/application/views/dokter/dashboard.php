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
                            <h4 class="card-title">Riwayat Pasien</h4>
                            <a class="heading-elements-toggle">
                                <i class="fa fa-ellipsis-v font-medium-3"></i>
                            </a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li>
                                        <a data-action="reload">
                                            <i id="reload" class="ft-rotate-cw"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-content">
                            <div id="recent-pasien" class="media-list">
                                <?php foreach ($riwayatp as $rwyt){?>
                                    <a href="#" class="media border-0">
                                <div class="media-left pr-1">
                                    <span class="avatar avatar-md avatar-online">
                                        <img class="media-object rounded-circle" src="<?= base_url()?>assets/images/pasien/<?= $rwyt['foto'] ?>" alt="Generic placeholder image">
                                        <i></i>
                                        </span>
                                    </div>
                                    <div class="media-body w-100">
                                        <span class="list-group-item-heading"><?= $rwyt['nama_pasien'] ?> <span class="blue-grey font-small-2 lighten-2">( <?= $rwyt['no_rm'] ?> )</span></span>
                                        <ul class="list-unstyled users-list m-0 float-right">
                                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="" class="avatar avatar-sm pull-up">
                                            </li>
                                        </ul>
                                        <p class="list-group-item-text mb-0">
                                            <span class="blue-grey lighten-2 font-small-3"> <?= $rwyt['no_tlp'] ?> </span>
                                        </p>
                                    </div>
                                </a>
                            <?php 
                            }    
                            ?>
                        </div>
                    </div>
                    <script>
						$('#reload').click(function(event){ 
							$("#recent-pasien").load(location.href + " #recent-pasien");
						}); 
					</script>
                </div>
                </div>
                <div class="col-xl-4 col-lg-3 col-md-6">
                    <div class="card pull-up ecom-card-1 bg-white">
                        <div class="card-content ecom-card2 height-200">
                            <h5 class="text-muted danger position-absolute p-1">Progress Stats</h5>
                            <div class="card">
                                <center>
                                    <img src="<?= base_url("assets/images/pasien.jpg") ?>" style="width: 16%" class="card-img-top">
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
                        <div class="card-content ecom-card2 height-200">
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


<!-- ////////////////////////////////////////////////////////////////////////////-->

