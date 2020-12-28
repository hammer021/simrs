<div class="app-content content" id="main">
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
			<!-- Table head options start -->
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
						<a href="#"><button style="float:left;margin-bottom:10px;" type="button" data-target="#tambah" data-toggle="modal" class="btn btn-primary">Tambah Data Klinik</button></a>
							<a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
							<div class="heading-elements">
								<ul class="list-inline mb-0">
									<li><a data-action="collapse"><i class="ft-minus"></i></a></li>
									<li><a data-action="reload" id="reload"><i class="ft-rotate-cw"></i></a></li>
									<li><a data-action="expand"><i class="ft-maximize"></i></a></li>
								</ul>
								<script>
									$('#reload').click(function(event){ 
										$("#table").load(location.href + " #table");
									}); 
								</script>
							</div>
						</div>
						<br>
						<div class="card-content collapse show">
							<div class="table-responsive">
								<table class="table" id="table">
									<thead class="thead-dark" align="center">
										<tr>
											<th>No</th>
											<th>Kode Klinik</th>
											<th>Nama Klinik</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<tbody>

										<?php
										$no = 1;
										foreach ($listklinik as $a) {
										?>

											<tr align="center">
												<td><?php echo $no++ ?></td>
												<td><?php echo $a->kd_poli ?></td>
												<td><?php echo $a->klinik ?></td>

												<td><a href="" data-toggle="modal" data-target="#hapusModal"><button type="button" class="la la-trash-o"></button></a>&nbsp;
													<div class="modal fade" id="hapusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
														<div class="modal-dialog" role="document">
															<div class="modal-content">
																<div class="modal-header">
																	<h5 class="modal-title" id="exampleModalLabel">Apakah Anda yakin untuk menghapus? <?php echo $a->klinik ?></h5>
																	<button class="close" type="button" data-dismiss="modal" aria-label="Close">
																		<span aria-hidden="true">×</span>
																	</button>
																</div>
																<div class="modal-footer">
																	<button class="btn btn-primary" type="button" data-dismiss="modal">Batal</button>
																	<a id="delete_link" class="btn btn-danger" href="<?php echo base_url('Klinik/hapusklinik/' . $a->kd_poli); ?>">Hapus</a>
																</div>
															</div>
														</div>
													</div>
													<button type="button" data-target="#<?php echo $a->kd_poli ?>" data-toggle="modal" class="la la-edit"></button>
												</td>
											<?php } ?>
											</tr>
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
					<form method="post" action="<?= base_url('Klinik/updatedata') ?>" enctype="multipart/form-data">
						<div class="form-group">
							<label for="exampleInputEmail1">Kode Klinik</label>
							<input type="hidden" class="form-control" id="exampleInputEmail1" value="<?php echo $a->kd_poli ?>" name="kd_poli" aria-describedby="emailHelp">
							<input type="" class="form-control" id="exampleInputEmail1" value="<?php echo $a->kd_poli ?>" name="kd_poli" aria-describedby="emailHelp">
							<label for="exampleInputEmail1">Klinik</label>
							<input type="text" class="form-control" id="exampleInputEmail1" value="<?php echo $a->klinik ?>" name="klinik" aria-describedby="emailHelp">
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

<div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" name="tambahmodal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Tambah Data Klinik</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="post" action="<?= base_url('Klinik/tambah_klinik') ?>" enctype="multipart/form-data">

					<div class="form-group">
						<label for="exampleInputEmail1">Klinik</label>
						<input type="text" class="form-control" id="exampleInputEmail1" name="klinik" aria-describedby="emailHelp">
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
</div>
</div>
</div>