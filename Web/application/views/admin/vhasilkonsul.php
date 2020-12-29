
    <div class="app-content content" id="main">
      <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
        <div class="content-header row">
          <div class="content-header-left col-md-4 col-12 mb-2">
            <h3 class="content-header-title" style="margin-bottom:50px;margin-top:80px">Konsultasi</h3>
          </div>
          <div class="content-header-right col-md-8 col-12">
            <div class="breadcrumbs-top float-md-right">
              <div class="breadcrumb-wrapper mr-1">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.html">Home</a>
                  </li>
                  <li class="breadcrumb-item active">Hasil Konsultasi
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
				<h4 class="card-title">Hasil Konsultasi</h4>
				<div class="dropdown">
					<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Pilih Status
					</button>
					<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" name="status" id="status">
						
						<a class="dropdown-item" href="<?= base_url('Admin/filterhasilkonsul/4') ?>">Resep Masuk</a>
						<a class="dropdown-item" href="<?= base_url('Admin/filterhasilkonsul/1') ?>">Belum Bayar</a>
						<a class="dropdown-item" href="<?= base_url('Admin/filterhasilkonsul/2') ?>">Sudah Bayar</a>
						<a class="dropdown-item" href="<?= base_url('Admin/filterhasilkonsul/3') ?>">Sudah di Verifikasi</a>
					</div>
					
				</div>
				<div class="heading-elements">
					<ul class="list-inline mb-0">
						<li><a data-action="collapse"><i class="ft-minus"></i></a></li>
						<li><a data-action="reload" id="reload"><i class="ft-rotate-cw"></i></a></li>
						<li><a data-action="expand"><i class="ft-maximize"></i></a></li>
					</ul>
					<ul class="list-inline mb-0">
						<li><a class="btn btn-primary" target ="_blank" href="<?= base_url('Laporan/laphasilkonsul') ?>">CETAK</a></li>
						
					</ul>
				</div>
			</div>
			<script>
				$('#reload').click(function(event){ 
					$("#table").load(location.href + " #table");
				}); 
			</script>
			<div class="card-content collapse show">
				<div class="table-responsive">
					<table class="table" id="table">
						<thead class="thead-dark">
							<tr>
								<th scope="col">No</th>
								<th scope="col">No Rekam Medis</th>
								<th scope="col">Nama Pasien</th>
								<th scope="col">Tgl Konsultasi</th>
								<th scope="col">Nama Dokter</th>
								<th scope="col">Keluhan</th>
								<th scope="col">Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
						<?php
										$no = 1;
										foreach ($konsul as $kons) {
										?>
							<tr>
								<th scope="row"><?php echo $no++ ?></th>
								<td><?php echo $kons['no_rm'] ?></td>
								<td><?php echo $kons['nama_pasien'] ?></td>
								<td><?php echo $kons['jadwal_konsul'] ?></td>
								<td><?php $dok = $kons['name'];
									if ($dok== null){
											echo "~Belum Dipilih~";
									}
									else {
										echo $dok;
									}
									?></td>
								<td><?php echo $kons['keluhan'] ?></td>
								<td>
									<?php $sts = $kons['status_kons'];
									if ($sts == 0){
											echo "Resep Masuk";
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
									?></td>
							<td>
							<?php $sts = $kons['status_kons'];
									if ($sts == 0){?>
										<a href="" data-toggle="modal" data-target="#hapusModal"><button type="button" class="la la-trash-o"></button></a>&nbsp;
													<div class="modal fade" id="hapusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
														<div class="modal-dialog" role="document">
															<div class="modal-content">
																<div class="modal-header">
																	<h5 class="modal-title" id="exampleModalLabel">Apakah Anda yakin untuk menghapus?
																	<?php echo $kons['nama_pasien'] ?>
																	</h5>
																	<button class="close" type="button" data-dismiss="modal" aria-label="Close">
																		<span aria-hidden="true">×</span>
																	</button>
																</div>
																<div class="modal-footer">
																	<button class="btn btn-primary" type="button" data-dismiss="modal">Batal</button>
																	<a id="delete_link" class="btn btn-danger" href="<?php echo base_url('Admin/hapuskonsul/' . $kons['kd_konsul']); ?>">Hapus</a>
																</div>
															</div>
														</div>
													</div>
													
													<button type="button" data-target="#<?php echo $kons['kd_konsul'] ?>" data-toggle="modal" class="la la-edit"></button>
							<?php
											
									}
									else if($sts == 1){?>
										<a href="" data-toggle="modal" data-target="#hapusModal"><button type="button" class="la la-trash-o"></button></a>&nbsp;
													<div class="modal fade" id="hapusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
														<div class="modal-dialog" role="document">
															<div class="modal-content">
																<div class="modal-header">
																	<h5 class="modal-title" id="exampleModalLabel">Apakah Anda yakin untuk menghapus?
																	<?php echo $kons['nama_pasien'] ?>
																	</h5>
																	<button class="close" type="button" data-dismiss="modal" aria-label="Close">
																		<span aria-hidden="true">×</span>
																	</button>
																</div>
																<div class="modal-footer">
																	<button class="btn btn-primary" type="button" data-dismiss="modal">Batal</button>
																	<a id="delete_link" class="btn btn-danger" href="<?php echo base_url('Admin/hapuskonsul/' . $kons['no_rm']); ?>">Hapus</a>
																</div>
															</div>
														</div>
													</div>
													<button type="button" data-target="#view<?php echo $kons['kd_konsul'] ?>" data-toggle="modal" class="la la-eye"></button>
													
							<?php
									}
									else if($sts == 2){?>
										<a href="" data-toggle="modal" data-target="#hapusModal"><button type="button" class="la la-trash-o"></button></a>&nbsp;
													<div class="modal fade" id="hapusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
														<div class="modal-dialog" role="document">
															<div class="modal-content">
																<div class="modal-header">
																	<h5 class="modal-title" id="exampleModalLabel">Apakah Anda yakin untuk menghapus?
																	<?php echo $kons['nama_pasien'] ?>
																	</h5>
																	<button class="close" type="button" data-dismiss="modal" aria-label="Close">
																		<span aria-hidden="true">×</span>
																	</button>
																</div>
																<div class="modal-footer">
																	<button class="btn btn-primary" type="button" data-dismiss="modal">Batal</button>
																	<a id="delete_link" class="btn btn-danger" href="<?php echo base_url('Admin/hapuskonsul/' . $kons['no_rm']); ?>">Hapus</a>
																</div>
															</div>
														</div>
													</div>
													
													<button type="button" data-target="#acc<?php echo $kons['kd_konsul'] ?>" data-toggle="modal" class="la la-edit"></button>
							<?php
									}
									else if($sts == 3){?>
										<a href="" data-toggle="modal" data-target="#hapusModal"><button type="button" class="la la-trash-o"></button></a>&nbsp;
													<div class="modal fade" id="hapusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
														<div class="modal-dialog" role="document">
															<div class="modal-content">
																<div class="modal-header">
																	<h5 class="modal-title" id="exampleModalLabel">Apakah Anda yakin untuk menghapus?
																	<?php echo $kons['nama_pasien'] ?>
																	</h5>
																	<button class="close" type="button" data-dismiss="modal" aria-label="Close">
																		<span aria-hidden="true">×</span>
																	</button>
																</div>
																<div class="modal-footer">
																	<button class="btn btn-primary" type="button" data-dismiss="modal">Batal</button>
																	<a id="delete_link" class="btn btn-danger" href="<?php echo base_url('Admin/hapuskonsul/' . $kons['no_rm']); ?>">Hapus</a>
																</div>
															</div>
														</div>
													</div>
													<button type="button" data-target="#view<?php echo $kons['kd_konsul'] ?>" data-toggle="modal" class="la la-eye"></button>
							<?php
									}
									else {
										echo "Not Found";
									}
									?>
							
							</td>

							</tr>
							
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	
</div>
<!-- Table Head options start -->
        </div>
      </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->
	<?php
$no = 1;
foreach ($konsul as $konn) {
?>

	<!-- Modal Update ACC -->
	<div class="modal fade" id="acc<?php echo $konn['kd_konsul'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Verifikasi Konsultasi</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form method="post" action="<?= base_url('Admin/update_acc_konsul') ?>" enctype="multipart/form-data">
					<div class="form-group">
							<label for="biaya">Kode Konsultasi : <br> <h3><?php echo $konn['kd_konsul'] ?></h3></label>
							<input type="hidden" id="kd_konsul" name ="kd_konsul" value="<?php echo $konn['kd_konsul'] ?>"> 
							<input type="hidden" id="no_rm" name ="no_rm" value="<?php echo $konn['no_rm'] ?>">
							<input type="hidden" id="kd_resep" name ="kd_resep" value="<?php echo $konn['kd_resep'] ?>"> 
						</div>
						<div class="form-group">
							
							<label for="exampleInputEmail1">Nomor Rekam Medis :<br/> <h3><?php echo $konn['no_rm'] ?></h3></label>
						</div>
						
						<div class="form-group">
							<label for="jenis_kasus">Pasien : <br><?php echo $konn['nama_pasien'] ?></label>
						</div>

						<div class="form-group">
							<label for="exampleFormControlTextarea1">Tanggal Konsultasi : <br><?php echo $konn['jadwal_konsul'] ?></label>
						</div>
						<div class="form-group">
							<label for="biaya">Resep : <br> <?php echo $konn['resep'] ?></label>
						</div>
						<div class="form-group">
							<label for="tgl_konsul">Biaya Resep :<br>Rp.  <?php echo $konn['harga_resep'] ?> </label>
							
						</div>
						<div class="form-group">
							<label for="tgl_konsul">Biaya Kirim :<br> Rp. <?php echo $konn['harga_kirim'] ?> </label>
							
						</div>
						<div class="form-group">
							<label for="tgl_konsul">Total Biaya :  <br> <b>Rp. <?php echo $konn['grand_total'] ?></b> </label>
							
						</div>
						<div class="form-group">
							<label for="foto_dokter">Bukti Pembayaran Total</label><br>
							<center><img src="<?php echo base_url("assets/images/bukti_konsul/" . $konn['buktikonsul']) ?>" width="100px" height="100px">
								<center><br>
									
						</div>
						
						<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-danger">Konfirmasi</button>
						</div>
						
						
					</form>
				</div>
			</div>
		</div>
	</div>
	</div>
	<!-- Model Update End -->
<?php } 
	
	
$no = 1;
foreach ($konsul as $konn) {
?>

	<!-- Modal Update -->
	<div class="modal fade" id="<?php echo $konn['kd_konsul'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Tambah Biaya Resep </h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form method="post" action="<?= base_url('Admin/update_hasil_konsul') ?>" enctype="multipart/form-data">
					<div class="form-group">
							<label for="biaya">Kode Konsultasi : <br> <h3><?php echo $konn['kd_konsul'] ?></h3></label>
							<input type="hidden" id="kd_konsul" name ="kd_konsul" value="<?php echo $konn['kd_konsul'] ?>"> 
							<input type="hidden" id="no_rm" name ="no_rm" value="<?php echo $konn['no_rm'] ?>">
							<input type="hidden" id="kd_resep" name ="kd_resep" value="<?php echo $konn['kd_resep'] ?>"> 
						</div>
						<div class="form-group">
							
							<label for="exampleInputEmail1">Nomor Rekam Medis :<br/> <h3><?php echo $konn['no_rm'] ?></h3></label>
						</div>
						
						<div class="form-group">
							<label for="jenis_kasus">Pasien : <br><?php echo $konn['nama_pasien'] ?></label>
						</div>

						<div class="form-group">
							<label for="exampleFormControlTextarea1">Tanggal Konsultasi : <br><?php echo $konn['jadwal_konsul'] ?></label>
						</div>
						<div class="form-group">
							<label for="biaya">Resep : <br> <?php echo $konn['resep'] ?></label>
						</div>
						<div class="form-group">
							<label for="tgl_konsul">Biaya Resep : </label>
							<input placeholder="Masukkan Jumlah Harga Resep !!....." class="form-control" type="number" id="harga_resep" name="harga_resep">
						</div>
						<div class="form-group">
							<label for="tgl_konsul">Biaya Kirim : </label>
							<input placeholder="Masukkan Jumlah Harga Kirim !!....." class="form-control" type="number" id="harga_kirim" name="harga_kirim">
						</div>
						
						
						
						<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-danger">Save</button>
						</div>
						
						
					</form>
				</div>
			</div>
		</div>
	</div>
	</div>
	<!-- Model Update End -->
<?php } 

$no = 1;
foreach ($konsul as $konn) {
?>

	<!-- Modal View -->
	<div class="modal fade" id="view<?php echo $konn['kd_konsul'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
							<input type="hidden" id="no_rm" name ="no_rm" value="<?php echo $konn['no_rm'] ?>"> 
							<label for="exampleInputEmail1">Nomor Konsultasi :<br/> <h3><?php echo $konn['kd_konsul'] ?></h3></label></br>
							<label for="exampleInputEmail1">Nomor Rekam Medis :<br/> <h3><?php echo $konn['no_rm'] ?></h3></label>
						</div>
						<div class="form-group">
							<label for="jenis_kasus">Pasien : <br><?php echo $konn['nama_pasien'] ?></label>
						</div>
						<div class="form-group">
							<label for="biaya">Resep : <br> <?php echo $konn['resep'] ?></label>
						</div>
						<div class="form-group">
							<label for="biaya">Biaya Resep : <br>Rp. <?php echo $konn['harga_resep'] ?></label>
						</div>
						<div class="form-group">
							<label for="biaya">Biaya Kirim : <br>Rp. <?php echo $konn['harga_kirim'] ?></label>
						</div>
						<div class="form-group">
							<label for="biaya"><b>Total Biaya : <br>Rp. <?php echo $konn['grand_total'] ?></b></label>
						</div>
						<div class="form-group">
							<label for="foto_dokter">Bukti Pembayaran Total</label><br>
							<center><img src="<?php echo base_url("assets/images/bukti_konsul/" . $konn['buktikonsul']) ?>" width="100px" height="100px">
								<center><br>
									
						</div>
						<div class="form-group">
							<label for="exampleFormControlTextarea1">Tanggal Konsultasi : <br><?php echo $konn['jadwal_konsul'] ?></label>
						</div>
						
						<div class="form-group">
							<label for="exampleFormControlTextarea1">No Praktek Dokter : <br> <?php echo $konn['no_praktek'] ?> </label>
						</div>
						
						<div class="form-group">
							<label for="exampleFormControlTextarea1">Nama Dokter : <br> <?php echo $konn['name'] ?> </label>
						</div>
						<div class="form-group">
							<label for="exampleFormControlTextarea1">Poli : <br> <?php echo $konn['klinik'] ?> </label>
						</div>
						
						<div class="form-group">
							<label for="jenis_kasus">Jenis Kasus :<br> <?php echo $konn['jenis_kasus'] ?></label>
						</div>
						
						<div class="form-group">
							<label for="jenis_kasus">Keluhan : <br> <?php echo $konn['keluhan'] ?></label>
						</div>

						

						<div class="form-group">
							<label for="jenis_kasus">Status : <?php $sts = $konn['status_kons'];
									if ($sts == 0){
											echo "Resep Masuk";
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
<?php 
  if(isset($_GET['error'])=='001'){
  ?>
   <div id="er001" class="modal fade">
	<div class="modal-dialog h-100 d-flex flex-column justify-content-center my-0 modal-confirm">
		<div class="modal-content">
			<div class="modal-header flex-column">
				<div class="icon-box">
					<i class="material-icons" style="margin-top:6px">&#33;</i>
				</div>						
				<h4 class="modal-title w-100">Error!</h4>
			</div>
			<div class="modal-body">
				<p>Link kosong , Harap isi dengan benar!</p>
			</div>
			<div class="modal-footer justify-content-center">
			</div>
		</div>
	</div>
</div>     
    <?php } ?>
