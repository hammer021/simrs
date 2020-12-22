<div class="app-content content">
	<div class="content-wrapper">
		<div class="content-wrapper-before"></div>
		<div class="content-header row">
			<div class="content-header-left col-md-4 col-12 mb-2">
				<h3 class="content-header-title" style="margin-bottom:50px;margin-top:80px">Data Pemeriksaan</h3>
			</div>
			<div class="content-header-right col-md-8 col-12">
				<div class="breadcrumbs-top float-md-right">
					<div class="breadcrumb-wrapper mr-1">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="index.html">Home</a>
							</li>
							<li class="breadcrumb-item active">
							</li>
						</ol>
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
								
								<form class="form-inline active-pink-4">
									<input class="form-control form-control-sm" type="text" placeholder="Search" aria-label="Search">
									<i class="la la-search" aria-hidden="false"></i>
								</form>
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
						<div class="card-content collapse show">
							<div class="table-responsive">
								<table class="table">
									<thead class="thead-dark" align="center">
										<tr>
											<th>No</th>
											<th>No Rekam Medis</th>
											<th>Tgl Kunjungan</th>
											<th>Jenis Kasus</th>
											<th>Keluhan</th>
											<th>Nama Pasien</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$no = 1;
										foreach ($dataperiksa as $u) {
										?>
											<tr>

												<td><?php echo $no++ ?></td>
												<td><?php echo $u['no_rm'] ?></td>
												<td><?php echo $u['tgl_kunjungan'] ?></td>
												<td><?php echo $u['jenis_kasus'] ?></td>
												<td><?php echo $u['keluhan'] ?></td>
												<td><?php echo $u['nama_pasien'] ?></td>
												<td><button type="button" class="la la-close"></button>
													</a>&nbsp;
													<button type="button" data-target="#<?php echo $u['no_rm'] ?>" data-toggle="modal" class="la la-check-square-o"></button></td>
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
