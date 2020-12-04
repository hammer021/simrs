
    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
        <div class="content-header row">
          <div class="content-header-left col-md-4 col-12 mb-2">
            <h3 class="content-header-title" style="margin-bottom:50px;margin-top:80px">Resep</h3>
          </div>
          <div class="content-header-right col-md-8 col-12">
            <div class="breadcrumbs-top float-md-right">
              <div class="breadcrumb-wrapper mr-1">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.html">Home</a>
                  </li>
                  <li class="breadcrumb-item active">Chat
                  </li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <div class="content-body">
<!-- Table head options start -->
<br>
						<div class="card-content collapse show">
							<!-- <p><span class="text-bold-600"><button class="btn btn-primary" data-toggle="modal" data-target="#tambah"><i class="fa fa-plus"></i> Tambah Data Dokter</button></span></p> -->
							<br><a href="#"><button style="float:right;margin-bottom:10px;margin-top:-20px;" type="button" data-target="#tambah" data-toggle="modal" class="btn btn-primary">Tambah Data Dokter</button></a>
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
												<td><img src="<?php echo base_url("assets/images/dokter/" . $u->foto_dokter) ?>" width="100px" height="100px"></td>
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
																	<a id="delete_link" class="btn btn-danger" href="<?php echo base_url('admin/hapusdokter/' . $u->no_praktek); ?>">Hapus</a>
																</div>
															</div>
														</div>
													</div>
							</div>

							<button type="button" data-target="#<?php echo $u->no_praktek ?>" data-toggle="modal" class="la la-edit"></button></td>
						<?php } ?>
						</tr>
						</tbody>
						</table>
						</div>
<!-- Table Head options start -->
        </div>
      </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->
	<div class="span10">
                        <label for=""><h5 class="margin0">Nama Lengkap</h5></label>
                        <div class="error_wrapper" id="wrapper_fullname" data-text="Kolom ini harus diisi">
                            
                            <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span><input type="text" id="fullname" class="special-characters" name="fullname" placeholder="Nama Lengkap" value=""></div>
                        </div>
                    </div>