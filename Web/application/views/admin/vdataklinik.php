<div class="app-content content">
	<div class="content-wrapper">
		<div class="content-wrapper-before"></div>
		<div class="content-header row">
			<div class="content-header-left col-md-4 col-12 mb-2">
				<h3 class="content-header-title" style="margin-bottom:50px;margin-top:80px">DATA KLINIK</h3>
			</div>
			<div class="content-header-right col-md-8 col-12">
				<div class="breadcrumbs-top float-md-right">
					<div class="breadcrumb-wrapper mr-1">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="index.html">Home</a>
							</li>
							<li class="breadcrumb-item active">Data Klinik
							</li>
						</ol>
					</div>
				</div>
			</div>
		</div>
		<div class="content-body">
			<div class="col-xl-4 col-lg-3 col-lg-12">
				<div class="card">
					<div class="card-header">
						<div class="card-title">
							<form class="form-inline active-pink-4">
								<input class="form-control form-control-sm" type="text" placeholder="Search" aria-label="Search">
								<i class="la la-search" aria-hidden="false"></i>
							</form>
						</div>
					</div>
				</div>
			</div>
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
						<br>
						<div class="card-content collapse show">
							<!-- <p><span class="text-bold-600"><button class="btn btn-primary" data-toggle="modal" data-target="#tambah"><i class="fa fa-plus"></i> Tambah Data Dokter</button></span></p> -->
							<br><a href="#"><button style="float:right;margin-bottom:10px;margin-top:-20px;" type="button" data-target="#exampleModal" data-toggle="modal" class="btn btn-primary">Tambah Data Klinik</button></a>
							<div class="table-responsive">
								<table class="table">
									<thead class="thead-dark" align="center">
										<tr>
											<th>No</th>
											<th>Kode Klinik</th>
											<th>Nama Klinik</th>
											<th>Nama Dokter</th>
											<th>No Praktek</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$no = 1;
										foreach ($listklinik as $a) {
										?>
											<tr>

												<td><?php echo $no++ ?></td>
												<td><?php echo $a->kd_poli ?></td>
												<td><?php echo $a->klinik ?></td>
												<td><?php echo $a->nama_dokter ?></td>
												<td><?php echo $a->no_praktek ?></td>
											
												<td><a href="" data-toggle="modal" data-target="#hapusModal"><button type="button" class="la la-trash-o"></button></a>&nbsp;
													<div class="modal fade" id="hapusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
														<div class="modal-dialog" role="document">
															<div class="modal-content">
																<div class="modal-header">
																	<h5 class="modal-title" id="exampleModalLabel">Apakah Anda yakin untuk menghapus?</h5>
																	<button class="close" type="button" data-dismiss="modal" aria-label="Close">
																		<span aria-hidden="true">×</span>
																	</button>
																</div>
																<div class="modal-footer">
																	<button class="btn btn-primary" type="button" data-dismiss="modal">Batal</button>
																	<a id="delete_link" class="btn btn-danger" href="<?php echo base_url('admin/hapusklinik/' . $a->kd_klinik); ?>">Hapus</a>
																</div>
															</div>
														</div>
													</div>
							</div>

							<button type="button" data-target="#<?php echo $a->kd_klinik ?>" data-toggle="modal" class="la la-edit"></button></td>
						<?php } ?>
						</tr>
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
foreach ($listklinik as $a) {
?>

	<!-- Modal Update -->
	<div class="modal fade" id="<?php echo $a->kd_poli ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Edit Data Klinik</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form method="post" action="<?= base_url('Admin/update_klinik') ?>" enctype="multipart/form-data">
						<div class="form-group">
							<label for="exampleInputEmail1">Kode Klinik</label>
							<input type="hidden" class="form-control" id="exampleInputEmail1" value="<?php echo $a->kd_poli ?>" name="kd_poli" aria-describedby="emailHelp">
							<input type="" class="form-control" id="exampleInputEmail1" value="<?php echo $a->kd_poli ?>" name="kd_poli" aria-describedby="emailHelp">
							<label for="exampleInputEmail1">Klinik</label>
							<input type="text" class="form-control" id="exampleInputEmail1" value="<?php echo $a->klinik ?>" name="klinik" aria-describedby="emailHelp">
						</div>
						<div class="form-group">
							<label for="exampleFormControlTextarea1">Nama Dokter </label>
							<textarea class="form-control" name="nama_dokter" id="exampleFormControlTextarea1" rows="3"><?php echo $a->nama_dokter ?></textarea>
						</div>

						<div class="form-group">
							<label for="exampleFormControlTextarea1">Nomor Praktek </label>
							<textarea class="form-control" name="no_praktek" id="exampleFormControlTextarea1" rows="3"><?php echo $a->no_praktek?></textarea>
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

<!-- Modal Insert-->
<?php
$no = 1;
foreach ($lisklinik as $a) {
?>
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" name="tambahmodal">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Tambah Data Klinik</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form method="post" action="<?= base_url('Admin/tambah_klinik') ?>" enctype="multipart/form-data">
						<input type="hidden" class="form-control" id="exampleInputEmail1" value="<?php
																									$tanggal =  date("Y-m-d");
																									echo $tanggal ?>" name="tanggal" aria-describedby="emailHelp">
						<label for="exampleInputEmail1">Kode Klinik</label>
						<input type="hidden" class="form-control" id="exampleInputEmail1" value="<?php echo $a->kd_klinik ?>" name="kd_klinik" aria-describedby="emailHelp">
						<input type="" class="form-control" id="exampleInputEmail1" value="<?php echo $a->kd_klinik ?>" name="kd_klinik" aria-describedby="emailHelp">
						<div class="form-group">
							<label for="exampleInputEmail1">Klinik</label>
							<input type="text" class="form-control" id="exampleInputEmail1" name="klinik" aria-describedby="emailHelp">
						</div>
						<div class="form-group">
							<label for="exampleFormControlTextarea1">Nama Dokter </label>
							<textarea class="form-control" name="nama_dokter" id="exampleFormControlTextarea1" rows="3"></textarea>
						</div>
						<div class="form-group">
							<label for="exampleFormControlTextarea1">Nomor Praktek </label>
							<textarea class="form-control" name="no_praktek" id="exampleFormControlTextarea1" rows="3"></textarea>
						</div>
						</br>
							<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-danger">Add</button>
					</form>
				</div>
			</div>
		</div>
	</div>
<?php } ?>