
    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
        <div class="content-header row">
          <div class="content-header-left col-md-4 col-12 mb-2">
            <h3 class="content-header-title" style="margin-bottom:50px;margin-top:80px">Laporan Pemeriksaan</h3>
          </div>
          <div class="content-header-right col-md-8 col-12">
            <div class="breadcrumbs-top float-md-right">
              <div class="breadcrumb-wrapper mr-1">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.html">Home</a>
                  </li>
                  <li class="breadcrumb-item active">
                  </li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <div class="content-body">
<!-- Table head options start -->
<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h4 class="card-title">
							</h4>
							<a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
							<div class="heading-elements">
								<ul class="list-inline mb-0">
									<li><a data-action="collapse"><i class="ft-minus"></i></a></li>
									<li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
									<li><a data-action="expand"><i class="ft-maximize"></i></a></li>
								</ul>
							</div>
						</div>
						<div class="card-content collapse show">
							<div class="table-responsive">
								<table class="table">
									<thead class="thead-dark" align="center">
										<tr>
											<th>No</th>
											<th>No Rekam Medis</th>
											<th>Tgl Kunjungan</th>
											<th>Jenis Kasus</th>
											<th>Keluhan</th>
											<th>Nama Pasien</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$no = 1;
										foreach ($dataperiksa as $u) {
										?>
											<tr>

												<td class="text-center"><?php echo $no++ ?></td>
												<td class="text-center"><?php echo $u['no_rm'] ?></td>
												<td class="text-center"><?php echo $u['tgl_kunjungan'] ?></td>
												<td class="text-center"><?php echo $u['jenis_kasus'] ?></td>
												<td class="text-center"><?php echo $u['keluhan'] ?></td>
												<td class="text-center"><?php echo $u['nama_pasien'] ?></td>
												<td class="text-center"><button type="button" data-target="#view<?php echo $u['no_rm'] ?>" data-toggle="modal" class="la la-eye"></button></td>
											<?php } ?>
											</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>

			</div>
			<!-- Table End -->
	
</div>
<!-- Table Head options start -->
        </div>
      </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->
	<?php 

$no = 1;
foreach ($dataperiksa as $x) {
?>

	<!-- Modal View -->
	<div class="modal fade" id="view<?php echo $x['no_rm'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Data Konsultasi Pasien</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form method="post" action="#" enctype="multipart/form-data">
						<div class="form-group">
							<input type="hidden" id="no_rm" name ="no_rm" value="<?php echo $x['no_rm'] ?>"> 
							<label for="exampleInputEmail1">Nomor Rekam Medis :<br/> <h3><?php echo $x['no_rm'] ?></h3></label>
						</div>
						
						<div class="form-group">
							<label for="biaya">Biaya Konsultasi : <br>Rp. <?php echo $x['harga'] ?></label>
						</div>
						<div class="form-group">
							<label for="buktikeluhan">Bukti Pembayaran</label><br>
							<center><img src="<?php echo base_url("assets/images/bukti_keluhan/" .$x['buktikeluhan']) ?>" width="200px" height="200px">
								<center>
						</div>
						<div class="form-group">
							<label for="jenis_kasus">Pasien : <br><?php echo $x['nama_pasien'] ?></label>
						</div>

						<div class="form-group">
							<label for="exampleFormControlTextarea1">Tanggal Kunjungan : <br><?php echo $x['tgl_kunjungan'] ?></label>
						</div>
						
						<div class="form-group">
							<label for="exampleFormControlTextarea1">No Praktek Dokter : <br> <?php echo $x['no_praktek'] ?> </label>
						</div>
						
						<div class="form-group">
							<label for="exampleFormControlTextarea1">Nama Dokter : <br> <?php echo $x['name'] ?> </label>
						</div>
						
						<div class="form-group">
							<label for="jenis_kasus">Jenis Kasus :<br> <?php echo $x['jenis_kasus'] ?></label>
						</div>
						
						<div class="form-group">
							<label for="jenis_kasus">Keluhan : <br> <?php echo $x['keluhan'] ?></label>
						</div>

						<div class="form-group">
							<label for="jenis_kasus">Link : <br> <?php echo $x['keluhan'] ?></label>
						</div>

						<div class="form-group">
							<label for="jenis_kasus">Status : <?php $sts = $x['status'];
									if ($sts == 0){
											echo "Selesai";
									}
									else if($sts == 1){
										echo "Belum Bayar";
									}
									else if($sts == 2){
										echo "Sudah Bayar";
									}
									else if($sts == 3){
										echo "Sudah di Verifikasi";
									}
									else {
										echo "Not Found";
									}
									?></label><br>
						</div>

						

						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							
					</form>
				</div>
			</div>
		</div>
	</div>
	</div>
	<!-- Model View End -->
<?php } ?>