<div class="app-content content">
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
								<p><span class="text-bold-600"><button class="btn btn-primary" data-toggle="modal" data-target="#tambah"><i class="fa fa-plus"></i> Tambah Data Dokter</button></span></p>
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
										foreach ($listdokter as $u) {
										?>
											<tr>

												<td><?php echo $no++ ?></td>
												<td><?php echo $u->no_praktek ?></td>
												<td><?php echo $u->nama_dokter ?></td>
												<td><?php echo $u->jadwal_praktek ?></td>
												<td><?php echo $u->no_hp_dokter ?></td>
												<td><img src="<?php base_url('assets/images/dokter/') . $u->foto_dokter; ?>" alt="Foto Dokter" class="logo-komunitas mx-auto d-block mb-5" style="width:100"></td>
												<td><button type="button" class="la la-trash-o"></button>
													</a>&nbsp;
													<button type="button" data-target="#<?php echo $u->no_praktek ?>" data-toggle="modal" class="la la-edit"></button></td>
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
foreach ($listdokter as $u) {
?>

	<!-- Modal Update -->
	<div class="modal fade" id="<?php echo $u->no_praktek ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Edit Dokter</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form method="post" action="<?= base_url('Admin/update_dokter') ?>" enctype="multipart/form-data">
						<div class="form-group">
							<input type="hidden" class="form-control" id="exampleInputEmail1" value="<?php echo $u->no_praktek ?>" name="id" aria-describedby="emailHelp">
							<input type="" class="form-control" id="exampleInputEmail1" value="<?php echo $u->foto_dokter ?>" name="sekarang" aria-describedby="emailHelp">
							<label for="exampleInputEmail1">Nama_Dokter</label>
							<input type="text" class="form-control" id="exampleInputEmail1" value="<?php echo $u->title_threads ?>" name="nama_dokter" aria-describedby="emailHelp">
						</div>
						<div class="form-group">
							<label for="foto_dokter">Foto</label><br>
							<center><img src="<?php echo base_url("assets/images/dokter/" . $u->foto_dokter) ?>" width="100px" height="100px">
								<center><br>
									<input type="file" class="form-control" name="foto_dokter" id="foto_dokter">
						</div>
						<div class="form-group">
							<label for="exampleFormControlTextarea1">jadwal_praktek </label>
							<textarea class="form-control" name="jadwal_praktek" id="exampleFormControlTextarea1" rows="3"><?php echo $u->jadwal_praktek ?></textarea>
						</div>

						<div class="form-group">
							<label for="exampleFormControlTextarea1">No Hp Dokter </label>
							<textarea class="form-control" name="no_hp_dokter" id="exampleFormControlTextarea1" rows="3"><?php echo $u->no_hp_dokter ?></textarea>
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
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">New Thread</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="post" action="<?= base_url('Admin/tambah_threads') ?>" enctype="multipart/form-data">
					<input type="hidden" class="form-control" id="exampleInputEmail1" value="<?php
																								$tanggal =  date("Y-m-d");
																								echo $tanggal ?>" name="tanggal" aria-describedby="emailHelp">
					<div class="form-group">
						<label for="exampleInputEmail1">Judul</label>
						<input type="text" class="form-control" id="exampleInputEmail1" name="judul" aria-describedby="emailHelp">
					</div>
					</br>
					<div class="form-group">
						<label for="image_input">Gambar</label>
						<input type="file" class="form-control" name="image_input" id="image_input">
					</div>
					<div class="form-group">
						<label for="exampleFormControlTextarea1">Isi Thread </label>
						<textarea class="form-control" name="isi" id="exampleFormControlTextarea1" rows="3"></textarea>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-danger">Add</button>
				</form>
			</div>
		</div>
	</div>
</div>