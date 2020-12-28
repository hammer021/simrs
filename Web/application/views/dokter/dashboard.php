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
                                            <i class="ft-rotate-cw"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-content">
                            <div id="recent-buyers" class="media-list">
                            <?php 
                            foreach ($riwayatp as $rwyt){
                            ?>
                                <a href="#" class="media border-0">
                                        <span class="list-group-item-heading"><?= $rwyt['nama_pasien'] ?>

                                        </span>
                                        <p class="list-group-item-text mb-0">
                                            <span class="blue-grey lighten-2 font-small-3" style="margin-left:30px;"> <?= $rwyt['no_rm'] ?> </span>
                                        </p>
                                    </div>
                                </a>
                            <?php 
                            }    
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-3 col-md-6">
                    <div class="card pull-up ecom-card-1 bg-white">
                        <div class="card-content ecom-card2 height-200">
                            <h5 class="text-muted danger position-absolute p-1">Progress Stats</h5>
                            <div class="card">
                                <center>
                                    <img src="<?= base_url("assets/images/pasien.jpg") ?>" style="width: 30%" class="card-img-top">
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
                                    <img src="<?= base_url("assets/images/dokter.jpg") ?>" style="width: 38%" class="card-img-top">
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
                <div class="col-xl-4 col-lg-6 col-md-12">
                    <div class="card pull-up height-200" style="background-image: linear-gradient(to right, #F35050, #D68B8B)">
                        <div class="card-body">
                            <h4 class="card-title" style="color:white">Analisis</h4>
                            <p class="card-text text-center" style="color:white;margin-top:30px;font-size:40px ">-20.5%</p>
                            <p class="card-text pasien">Pasien Berkurang</p>
                        </div>
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

