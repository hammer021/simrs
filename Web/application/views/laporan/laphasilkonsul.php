       <!-- HEADER KOP -->
    <!-- ------------------------------------------------------------------------------------------- -->
	
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">Hasil Konsultasi</h4>
				
			</div>
			
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
							

							</tr>
							
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	

	