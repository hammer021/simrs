
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
                  <li class="breadcrumb-item active">Pemeriksaan Konsultasi
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
				<h4 class="card-title">Pemeriksaan Konsultasi</h4>
				<a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
				<div class="heading-elements">
					<ul class="list-inline mb-0">
						<li><a data-action="collapse"><i class="ft-minus"></i></a></li>
						<li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
						<li><a data-action="expand"><i class="ft-maximize"></i></a></li>
						<li><a data-action="close"><i class="ft-x"></i></a></li>
					</ul>
				</div>
			</div>
			<div class="card-content collapse show">
				<div class="table-responsive">
					<table class="table">
						<thead class="thead-dark">
							<tr>
								<th scope="col">No</th>
								<th scope="col">No Rekam Medis</th>
								<th scope="col">Nama Pasien</th>
								<th scope="col">Tgl Kunjungan</th>
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
								<td><?php echo $kons['tgl_kunjungan'] ?></td>
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
									<?php $sts = $kons['status'];
									if ($sts == 0){
											echo "Selesai";
									}
									else if($sts == 1){
										echo "Belum Bayar";
									}
									else if($sts == 2){
										echo "Sudah Bayar";
									}
									else {
										echo "Not Found";
									}
									?></td>
							<td>
							<?php $sts = $kons['status'];
									if ($sts == 0){
											
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
							
													<button type="button" data-target="#<?php echo $kons['no_rm'] ?>" data-toggle="modal" class="la la-edit"></button>
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
													<button type="button" data-target="#view<?php echo $kons['no_rm'] ?>" data-toggle="modal" class="la la-eye"></button>
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

	<!-- Modal Update -->
	<div class="modal fade" id="<?php echo $konn['no_rm'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Edit Data Konsultasi</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form method="post" action="<?= base_url('Admin/update_konsul') ?>" enctype="multipart/form-data">
						<div class="form-group">
							<input type="hidden" id="no_rm" name ="no_rm" value="<?php echo $konn['no_rm'] ?>"> 
							<label for="exampleInputEmail1">Nomor Rekam Medis :<br/> <h3><?php echo $konn['no_rm'] ?></h3></label>
						</div>
						
						<div class="form-group">
							<label for="biaya">Biaya Konsultasi : <br>Rp. <?php echo $konn['harga'] ?></label>
						</div>
						<div class="form-group">
							<label for="buktikeluhan">Bukti Pembayaran</label><br>
							<center><img src="<?php echo base_url("assets/images/bukti_keluhan/" .$konn['buktikeluhan']) ?>" width="200px" height="200px">
								<center>
						</div>
						<div class="form-group">
							<label for="jenis_kasus">Pasien : <br><?php echo $konn['nama_pasien'] ?></label>
						</div>

						<div class="form-group">
							<label for="exampleFormControlTextarea1">Tanggal Kunjungan : <br><?php echo $konn['tgl_kunjungan'] ?></label>
						</div>
						<?php 
						$praktek=$konn['no_praktek'];
						if ($praktek==""){
						?>
						<div class="form-group">
							<label for="exampleFormControlTextarea1">Dokter </label>
							<select class="form-control" name="dokter" id="dokter">
							<?php 
							foreach($listdokter as $dok):
							?>
							<option value="<?php echo $dok->no_praktek?>"> <?php echo $dok->nama_dokter?></option>
							<?php 
							endforeach;
							?>
							</select>	
						</div>
						<?php		
						}
						else{
						?>
						<div class="form-group">
							<label for="exampleFormControlTextarea1">No Praktek Dokter </label>
							<input class="form-control" name="no_praktek" id="praktek" value="<?php echo $konn['no_praktek'] ?>">
						</div>
						
						<div class="form-group">
							<label for="exampleFormControlTextarea1">Nama Dokter </label>
							<input class="form-control" name="nama_dokter" id="nama_dokter" value="<?php echo $konn['name'] ?>">
						</div>
						<?php	
						}
						?>
						<div class="form-group">
							<label for="jenis_kasus">Jenis Kasus :<br> <?php echo $konn['jenis_kasus'] ?></label>
						</div>
						
						<div class="form-group">
							<label for="jenis_kasus">Keluhan : <br> <?php echo $konn['keluhan'] ?></label>
						</div>

						<div class="form-group">
							<label for="jenis_kasus">Status : <?php $sts = $konn['status'];
									if ($sts == 0){
											echo "Selesai";
									}
									else if($sts == 1){
										echo "Belum Bayar";
									}
									else if($sts == 2){
										echo "Sudah Bayar";
									}
									else {
										echo "Not Found";
									}
									?></label><br>
						</div>

						

						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-danger">Save</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	</div>
	<!-- Model Update End -->
<?php } ?>


<?php
$no = 1;
foreach ($konsul as $konn) {
?>

	<!-- Modal View -->
	<div class="modal fade" id="view<?php echo $konn['no_rm'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
							<label for="exampleInputEmail1">Nomor Rekam Medis :<br/> <h3><?php echo $konn['no_rm'] ?></h3></label>
						</div>
						
						<div class="form-group">
							<label for="biaya">Biaya Konsultasi : <br>Rp. <?php echo $konn['harga'] ?></label>
						</div>
						<div class="form-group">
							<label for="buktikeluhan">Bukti Pembayaran</label><br>
							<center><img src="<?php echo base_url("assets/images/bukti_keluhan/" .$konn['buktikeluhan']) ?>" width="200px" height="200px">
								<center>
						</div>
						<div class="form-group">
							<label for="jenis_kasus">Pasien : <br><?php echo $konn['nama_pasien'] ?></label>
						</div>

						<div class="form-group">
							<label for="exampleFormControlTextarea1">Tanggal Kunjungan : <br><?php echo $konn['tgl_kunjungan'] ?></label>
						</div>
						
						<div class="form-group">
							<label for="exampleFormControlTextarea1">No Praktek Dokter : <br> <?php echo $konn['no_praktek'] ?> </label>
						</div>
						
						<div class="form-group">
							<label for="exampleFormControlTextarea1">Nama Dokter : <br> <?php echo $konn['name'] ?> </label>
						</div>
						
						<div class="form-group">
							<label for="jenis_kasus">Jenis Kasus :<br> <?php echo $konn['jenis_kasus'] ?></label>
						</div>
						
						<div class="form-group">
							<label for="jenis_kasus">Keluhan : <br> <?php echo $konn['keluhan'] ?></label>
						</div>

						<div class="form-group">
							<label for="jenis_kasus">Status : <?php $sts = $konn['status'];
									if ($sts == 0){
											echo "Selesai";
									}
									else if($sts == 1){
										echo "Belum Bayar";
									}
									else if($sts == 2){
										echo "Sudah Bayar";
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
