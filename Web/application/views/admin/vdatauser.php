<div class="app-content content" id="main">
	<div class="content-wrapper">
		<div class="content-wrapper-before"></div>
		<div class="content-header row">
			<div class="content-header-left col-md-4 col-12 mb-2">
				<h3 class="content-header-title" style="margin-bottom:50px;margin-top:80px">DATA USER</h3>
			</div>
			<div class="content-header-right col-md-8 col-12">
				<div class="breadcrumbs-top float-md-right">
					<div class="breadcrumb-wrapper mr-1">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="index.html">Home</a>
							</li>
							<li class="breadcrumb-item active">Data User
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
				<!--	<a href="#"><button style="float:left;margin-bottom:10px;" type="button" data-target="#tambah" data-toggle="modal" class="btn btn-primary">Tambah Data Dokter</button></a> -->
							<div class="heading-elements">
								<ul class="list-inline mb-0">
									<li><a data-action="collapse"><i class="ft-minus"></i></a></li>
									<li><a data-action="reload" id="reload"><i class="ft-rotate-cw"></i></a></li>
									<li><a data-action="expand"><i class="ft-maximize"></i></a></li>
								</ul>
							</div>
						</div>
						<script>
							$('#reload').click(function(event){ 
								$("#table").load(location.href + " #table");
							}); 
						</script>
						<div class="card-content collapse show">
							<!-- <p><span class="text-bold-600"><button class="btn btn-primary" data-toggle="modal" data-target="#tambah"><i class="fa fa-plus"></i> Tambah Data Dokter</button></span></p> -->
							<br>
							<div class="table-responsive">
								<table class="table" id="table">
									<thead class="thead-dark" align="center">
										<tr>
											<th>No</th>
											<th>Kode Registrasi</th>
											<th>Nama User</th>
											<th>Email</th>
											<th>Tempat Lahir</th>
                                            <th>Tanggal Lahir</th>
                                            <th>Alamat</th>
                                            <th>Nomor HP</th>
                                            <th>Foto</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$no = 1;
										foreach ($listuser as $e) {
										?>
											<tr>

												<td><?php echo $no++ ?></td>
												<td><?php echo $e->kd_regist ?></td>
												<td><?php echo $e->name ?></td>
												<td><?php echo $e->email ?></td>
                                                <td><?php echo $e->alamat ?></td>
                                                <td><?php echo $e->no_hp ?></td>
                                                <td><?php echo $e->tempat_lahir ?></td>
                                                <td><?php echo $e->tgl_lahir?></td>
												<td><img src="<?php echo base_url("assets/images/user/" . $e->image) ?>" width="100px" height="100px"></td>
												<td><a href="" data-toggle="modal" data-target="#hapusModal<?= $e->kd_regist ?>"><button type="button" class="la la-trash-o"></button></a>&nbsp;
													<div class="modal fade" id="hapusModal<?= $e->kd_regist ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
														<div class="modal-dialog" role="document">
															<div class="modal-content">
																<div class="modal-header">
																	<h5 class="modal-title" id="exampleModalLabel">Apakah Anda yakin untuk menghapus?<?= $e->name ?></h5>
																	<button class="close" type="button" data-dismiss="modal" aria-label="Close">
																		<span aria-hidden="true">×</span>
																	</button>
																</div>
																<div class="modal-footer">
																	<button class="btn btn-primary" type="button" data-dismiss="modal">Batal</button>
																	<a id="delete_link" class="btn btn-danger" href="<?php echo base_url('admin/hapususer/' . $e->kd_regist); ?>">Hapus</a>
																</div>
															</div>
														</div>
													</div>
							

							<!--<button type="button" data-target="#<//?php echo $e->kd_regist ?>" data-toggle="modal" class="la la-edit"></button></td> -->
							</div>
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
