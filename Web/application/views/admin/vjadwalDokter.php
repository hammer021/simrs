<div class="app-content content" id="main">
	<div class="content-wrapper">
		<div class="content-wrapper-before"></div>
		<div class="content-header row">
			<div class="content-header-left col-md-4 col-12 mb-2">
				<h3 class="content-header-title" style="margin-bottom:50px;margin-top:80px">JADWAL POLI DOKTER</h3>
			</div>
			<div class="content-header-right col-md-8 col-12">
				<div class="breadcrumbs-top float-md-right">
					<div class="breadcrumb-wrapper mr-1">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="index.html">Home</a>
							</li>
							<li class="breadcrumb-item active">Poli Dokter
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
						<a href="#"><button style="float:left;margin-bottom:10px;" type="button" data-target="#tambah" data-toggle="modal" class="btn btn-primary">Tambah Jadwal Dokter</button></a>
						
						<a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
							
							<div class="heading-elements">
								<ul class="list-inline mb-0">
									<li><a data-action="collapse"><i class="ft-minus"></i></a></li>
									<li><a data-action="reload" id="reload"><i class="ft-rotate-cw"></i></a></li>
									<li><a data-action="expand"><i class="ft-maximize"></i></a></li>
								</ul>
							</div>
							<div class="dropdown">
					<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Pilih Poli
					</button>
					<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" name="poli" id="poli">
						<?php foreach ($listklinik as $poli):?>
						<a class="dropdown-item" href="<?= base_url('Admin/filterjadwal/'.$poli->kd_poli) ?>"><?= $poli->klinik ?></a>
						<?php endforeach;?>
					</div>
					
				</div>
						</div>
						<script>
							$('#reload').click(function(event){ 
								$("#table").load(location.href + " #table");
							}); 
						</script>
						<div class="card-content collapse show">
							
						<br>
							<div class="table-responsive">
								<table class="table" id="table">
									<thead class="thead-dark" align="center">
										<tr>
											<th>No</th>
											<th>No Praktek</th>
											<th>Nama Dokter</th>
											<th>Jam Praktek</th>
											<th>Hari Praktek</th>
											<th>Poli</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$no = 1;
										foreach ($listdokter as $u) :
											if($u->senin =="1"){
												$senin = "Senin,";
											}
											elseif($u->senin =="0"){
												$senin="";
											}	

											if($u->selasa =="1"){
												$selasa = "Selasa,";
											}
											elseif($u->selasa =="0"){
												$selasa="";
											}

											if($u->rabu =="1"){
												$rabu = "Rabu,";
											}
											elseif($u->rabu =="0"){
												$rabu="";
											}
											if($u->kamis =="1"){
												$kamis = "Kamis,";
											}
											elseif($u->kamis =="0"){
												$kamis="";
											}
											if($u->jumat =="1"){
												$jumat = "Jum'at,";
											}
											elseif($u->jumat =="0"){
												$jumat="";
											}
											if($u->sabtu =="1"){
												$sabtu = "Sabtu,";
											}
											elseif($u->sabtu =="0"){
												$sabtu="";
											}
											if($u->minggu =="1"){
												$minggu = "Minggu";
											}
											elseif($u->minggu =="0"){
												$minggu="";
											}
										?>
											<tr>

												<td><?php echo $no++ ?></td>
												<td><?php echo $u->no_praktek ?></td>
												<td><?php echo $u->name ?></td>
												<td><?php echo $u->startwaktu.'-'. $u->endwaktu ?></td>
												<td><?php echo $senin.' '.$selasa.' '.$rabu.' '.$kamis.' '.$jumat.' '.$sabtu.' '.$minggu ?></td>
												<td><?php echo $u->klinik?></td>
												<td><a href="" data-toggle="modal" data-target="#hapusModal"><button type="button" class="la la-trash-o"></button></a>&nbsp;
													<div class="modal fade" id="hapusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
														<div class="modal-dialog" role="document">
															<div class="modal-content">
																<div class="modal-header">
																	<h5 class="modal-title" id="exampleModalLabel">Apakah Anda yakin untuk menghapus? <?php echo $u->name.'-'.$u->klinik ?> </h5>
																	<button class="close" type="button" data-dismiss="modal" aria-label="Close">
																		<span aria-hidden="true">×</span>
																	</button>
																</div>
																<div class="modal-footer">
																	<button class="btn btn-primary" type="button" data-dismiss="modal">Batal</button>
																	<a id="delete_link" class="btn btn-danger" href="<?php echo base_url('Admin/hapusjadwaldokter/'. $u->kd_dok_pol); ?>">Hapus</a>
																</div>
															</div>
														</div>
													</div>
							

														<button type="button" data-target="#<?php echo $u->kd_regist ?>" data-toggle="modal" class="la la-edit"></button></td>
											</tr>
											</tbody>
										<?php endforeach; ?>
						
									
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
					<h5 class="modal-title" id="exampleModalLabel">Edit Jadwal Dokter</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form method="post" action="<?= base_url('Admin/update_jadwal_dokter') ?>" enctype="multipart/form-data">
						<div class="form-group">
							<input type ="hidden" name="kd_dok_pol" value="<?php echo $u->kd_dok_pol ?>">
							<label for="exampleInputEmail1">Nomor Praktek : <?php echo $u->no_praktek ?></label>
							<input type="hidden" class="form-control" id="exampleInputEmail1" value="<?php echo $u->no_praktek ?>" name="no_praktek" aria-describedby="emailHelp">
								</br>
							<label for="exampleInputEmail1">Nama Dokter : <?php echo $u->name ?></label>
						</div>
						<div class="form-group">
							<label for="exampleFormControlTextarea1">Poli : <?php echo $u->klinik ?>  </label>
							
						</div>
						<div class="form-group">
							<label for="exampleFormControlTextarea1">Jam Buka : </label>
							<input type="time" class="form-control" name="startwaktu" id="startwaktu" value="<?php echo $u->startwaktu ?>">
						</div>
						<div class="form-group">
							<label for="exampleFormControlTextarea1">Jam Tutup : </label>
							<input type="time" class="form-control" name="endwaktu" id="endwaktu" value="<?php echo $u->endwaktu ?>">
						</div>
						<div class="form-group">
						<label for="exampleFormControlTextarea1">Silahkan Melilih Hari Lagi !!! </label>
						
						<table>
							<tr>
								<td> 
									<label for="exampleFormControlTextarea1">Senin </label>
									<select class="form-control"style="width:100px;" name="senin" id="senin">
									<option value="1"> Ya</option>
									<option value="0"> Tidak</option>
									</select>
								</td>
								<td>
									<label for="exampleFormControlTextarea1">Selasa </label>
									<select class="form-control" style="width:100px;" name="selasa" id="selasa">
									<option value="1"> Ya</option>
									<option value="0"> Tidak</option>
									</select> 
								</td>
								<td>
									<label for="exampleFormControlTextarea1">Rabu </label>
									<select class="form-control" style="width:100px;" name="rabu" id="rabu">
									<option value="1"> Ya</option>
									<option value="0"> Tidak</option>
									</select>
								</td>
								<td>
									<label for="exampleFormControlTextarea1">Kamis </label>
									<select class="form-control" style="width:100px;" name="kamis" id="kamis">
									<option value="1"> Ya</option>
									<option value="0"> Tidak</option>
									</select>
								</td>
							</tr>
							<tr>
								<td>
									<label for="exampleFormControlTextarea1">Jum'at </label>
									<select class="form-control" style="width:100px;" name="jumat" id="jumat">
									<option value="1"> Ya</option>
									<option value="0"> Tidak</option>
									</select>
								</td>
								<td>
									<label for="exampleFormControlTextarea1">Sabtu </label>
									<select class="form-control" style="width:100px;" name="sabtu" id="sabtu">
									<option value="1"> Ya</option>
									<option value="0"> Tidak</option>
									</select>
								</td>
								<td>
									<label for="exampleFormControlTextarea1">Minggu </label>
									<select class="form-control" style="width:100px;" name="minggu" id="minggu">
									<option value="1"> Ya</option>
									<option value="0"> Tidak</option>
									</select>
								</td>
							</tr>
						</table>
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
	<!-- Model Update End -->
<?php } ?>

<!-- Modal Insert-->

<div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Tambah Jadwal Dokter</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="post" action="<?= base_url('Admin/tambah_jadwal_dokter') ?>" enctype="multipart/form-data">
					
					<div class="form-group">
					<label for="poli">Pilih Dokter</label>
						<select class="form-control" name="no_praktek" id="no_praktek">
							<?php 
							foreach($listdokter1 as $dok):
							?>
							<option value="<?php echo $dok->no_praktek?>"> <?php echo $dok->no_praktek.'-'.$dok->name?></option>
							<?php 
							endforeach;
							?>
							</select>
					</div>
					
					<div class="form-group">
						<label for="exampleFormControlTextarea1">Jadwal praktek Buka</label>
						<input type ="time" class="form-control" name="jadwal_praktek_buka" id="exampleFormControlTextarea1" rows="3">
					</div>
					<div class="form-group">
						<label for="exampleFormControlTextarea1">Jadwal praktek Tutup</label>
						<input type ="time" class="form-control" name="jadwal_praktek_tutup" id="exampleFormControlTextarea1" rows="3">
					</div>
					
					<div class="form-group">
						<label for="poli">Pilih Poli</label>
						<select class="form-control" name="poli" id="poli">
							<?php 
							foreach($listklinik as $dok):
							?>
							<option value="<?php echo $dok->kd_poli?>"> <?php echo $dok->klinik?></option>
							<?php 
							endforeach;
							?>
							</select>	
					</div>
					<label for="exampleFormControlTextarea1">Jadwal Hari Praktek </label>
					<div class="form-group">
						
						
						<table>
							<tr>
								<td> 
									<label for="exampleFormControlTextarea1">Senin </label>
									<select class="form-control"style="width:100px;" name="senin" id="senin">
									<option value="1"> Ya</option>
									<option value="0"> Tidak</option>
									</select>
								</td>
								<td>
									<label for="exampleFormControlTextarea1">Selasa </label>
									<select class="form-control" style="width:100px;" name="selasa" id="selasa">
									<option value="1"> Ya</option>
									<option value="0"> Tidak</option>
									</select> 
								</td>
								<td>
									<label for="exampleFormControlTextarea1">Rabu </label>
									<select class="form-control" style="width:100px;" name="rabu" id="rabu">
									<option value="1"> Ya</option>
									<option value="0"> Tidak</option>
									</select>
								</td>
								<td>
									<label for="exampleFormControlTextarea1">Kamis </label>
									<select class="form-control" style="width:100px;" name="kamis" id="kamis">
									<option value="1"> Ya</option>
									<option value="0"> Tidak</option>
									</select>
								</td>
							</tr>
							<tr>
								<td>
									<label for="exampleFormControlTextarea1">Jum'at </label>
									<select class="form-control" style="width:100px;" name="jumat" id="jumat">
									<option value="1"> Ya</option>
									<option value="0"> Tidak</option>
									</select>
								</td>
								<td>
									<label for="exampleFormControlTextarea1">Sabtu </label>
									<select class="form-control" style="width:100px;" name="sabtu" id="sabtu">
									<option value="1"> Ya</option>
									<option value="0"> Tidak</option>
									</select>
								</td>
								<td>
									<label for="exampleFormControlTextarea1">Minggu </label>
									<select class="form-control" style="width:100px;" name="minggu" id="minggu">
									<option value="1"> Ya</option>
									<option value="0"> Tidak</option>
									</select>
								</td>
							</tr>
						</table>
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
