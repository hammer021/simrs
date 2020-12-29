       <!-- HEADER KOP -->
    <!-- ------------------------------------------------------------------------------------------- -->
	
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">Jadwal Dokter</h4>
				
			</div>
			
			<div class="card-content collapse show">
				<div class="table-responsive">
					<table class="table" id="table">
						<thead class="thead-dark">
							<tr>
											<th>No</th>
											<th>No Praktek</th>
											<th>Nama Dokter</th>
											<th>Jam Praktek</th>
											<th>Hari Praktek</th>
											<th>Poli</th>
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
							</tr>
							
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	

	