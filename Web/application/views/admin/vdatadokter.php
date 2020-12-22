<div class="app-content content" id="main">
	<div class="content-wrapper">
		<div class="content-wrapper-before"></div>
		<div class="content-header row">
			<div class="content-header-left col-md-4 col-12 mb-2">
				<h3 class="content-header-title" style="margin-bottom:50px;margin-top:80px">DATA DOKTER</h3>
			</div>
			<div class="content-header-right col-md-8 col-12">
				<div class="breadcrumbs-top float-md-right">
					<div class="breadcrumb-wrapper mr-1">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="index.html">Home</a>
							</li>
							<li class="breadcrumb-item active">Data Dokter
							</li>
						</ol>
					</div>
				</div>
			</div>
		</div>
		<div class="content-body">
			<!-- Table head options start -->
			<div class="row">
				<div class="col-xl-12 col-lg-12 col-sm-12">
					<div class="card">
						<div class="card-header">
						<a href="#"><button style="float:left;margin-bottom:10px;" type="button" data-target="#tambah" data-toggle="modal" class="btn btn-primary">Tambah Data Dokter</button></a>
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
							<!-- <p><span class="text-bold-600"><button class="btn btn-primary" data-toggle="modal" data-target="#tambah"><i class="fa fa-plus"></i> Tambah Data Dokter</button></span></p> -->
							<br>
							<div class="table-responsive">
								<table class="table">
									<thead class="thead-dark" align="center">
										<tr>
											<th>No</th>
											<th>No Praktek</th>
											<th>Nama Dokter</th>
											<th>Jadwal Praktek</th>
											<th>Nomor HP Dokter</th>
											<th>Foto</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$no = 1;
										foreach ($listdokter as $u) :
										?>
											<tr>

												<td><?php echo $no++ ?></td>
												<td><?php echo $u->no_praktek ?></td>
												<td><?php echo $u->name ?></td>
												<td><?php echo $u->jadwal_praktek ?></td>
												<td><?php echo $u->no_hp ?></td>
												<td><img src="<?php echo base_url("assets/images/dokter/" . $u->image) ?>" width="100px" height="100px"></td>
												<td><a href="" data-toggle="modal" data-target="#hapusModal"><button type="button" class="la la-trash-o"></button></a>&nbsp;
													<div class="modal fade" id="hapusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
														<div class="modal-dialog" role="document">
															<div class="modal-content">
																<div class="modal-header">
																	<h5 class="modal-title" id="exampleModalLabel">Apakah Anda yakin untuk menghapus? <?php echo $u->name ?> </h5>
																	<button class="close" type="button" data-dismiss="modal" aria-label="Close">
																		<span aria-hidden="true">×</span>
																	</button>
																</div>
																<div class="modal-footer">
																	<button class="btn btn-primary" type="button" data-dismiss="modal">Batal</button>
																	<a id="delete_link" class="btn btn-danger" href="<?php echo base_url('Admin/hapusdokter/'. $u->kd_regist); ?>">Hapus</a>
																</div>
															</div>
														</div>
													</div>
							

														<button type="button" data-target="#<?php echo $u->kd_regist ?>" data-toggle="modal" class="la la-edit"></button></td>
											</tr>
										<?php endforeach; ?>
						
									</tbody>
								</table>
							</div>
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
foreach ($listdokter as $u) {
?>

	<!-- Modal Update -->
	<div class="modal fade" id="<?php echo $u->kd_regist ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Edit Data Dokter</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form method="post" action="<?= base_url('Admin/update_dokter') ?>" enctype="multipart/form-data">
						<div class="form-group">
							<input type ="hidden" name="kd_regist" value="<?php echo $u->kd_regist ?>">
							<label for="exampleInputEmail1">Nomor Dokter</label>
							<input type="hidden" class="form-control" id="exampleInputEmail1" value="<?php echo $u->no_praktek ?>" name="no_praktek" aria-describedby="emailHelp">
							<input type="" class="form-control" id="exampleInputEmail1" value="<?php echo $u->no_praktek ?>" name="no_praktek" aria-describedby="emailHelp">
							<label for="exampleInputEmail1">Nama Dokter</label>
							<input type="text" class="form-control" id="exampleInputEmail1" value="<?php echo $u->name ?>" name="nama_dokter" aria-describedby="emailHelp">
						</div>
						<div class="form-group">
							<label for="exampleFormControlTextarea1">Email </label>
							<input type="email" class="form-control" name="email" id="exampleFormControlTextarea1" value="<?php echo $u->email ?>">
						</div>
						<div class="form-group">
							<label for="exampleFormControlTextarea1">Jadwal Praktek </label>
							<input type="text" class="form-control" name="jadwal_praktek" id="exampleFormControlTextarea1" value="<?php echo $u->jadwal_praktek ?>">
						</div>

						<div class="form-group">
							<label for="exampleFormControlTextarea1">No Hp Dokter </label>
							<input type="text" class="form-control" name="no_hp_dokter" id="exampleFormControlTextarea1" value="<?php echo $u->no_hp ?>">
						</div>
						<div class="form-group">
							<label for="foto_dokter">Foto</label><br>
							<center><img src="<?php echo base_url("assets/images/dokter/" . $u->image) ?>" width="100px" height="100px">
								<center><br>
									<input type="file" class="form-control" name="foto_dokter" id="foto_dokter">
						</div>

						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-danger">Save</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- Model Update End -->
<?php } ?>

<!-- Modal Insert-->

<div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Tambah Data Dokter</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="post" action="<?= base_url('Admin/tambah_dokter') ?>" enctype="multipart/form-data">
					<div class="form-group">
						<label for="exampleInputEmail1">Nomor Praktek</label>
						<input type="text" class="form-control" id="exampleInputEmail1" name="no_praktek" aria-describedby="emailHelp">
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Nama Dokter</label>
						<input type="text" class="form-control" id="exampleInputEmail1" name="nama_dokter" aria-describedby="emailHelp">
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Email</label>
						<input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp">
					</div>
					
					<div class="form-group">
						<label for="exampleFormControlTextarea1">Jadwal praktek </label>
						<textarea class="form-control" name="jadwal_praktek" id="exampleFormControlTextarea1" rows="3"></textarea>
					</div>
					<div class="form-group">
						<label for="exampleFormControlTextarea1">Nomo HP Dokter </label>
						<textarea class="form-control" name="no_hp_dokter" id="exampleFormControlTextarea1" rows="3"></textarea>
					</div>
					</br>
					<div class="form-group">
						<label for="image_input">Foto</label>
						<input type="file" class="form-control" name="foto_dokter" id="foto_dokter">
					</div>
					
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-danger">Add</button>
				</form>
			</div>
		</div>
	</div>
</div>
</div>
</div>
</div>
