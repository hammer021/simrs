<div class="app-content content" id="main">
	<div class="content-wrapper">
		<div class="content-wrapper-before"></div>
		<div class="content-header row">
			<div class="content-header-left col-md-4 col-12 mb-2">
				<h3 class="content-header-title" style="margin-bottom:50px;margin-top:80px">DATA PASIEN</h3>
			</div>
			<div class="content-header-right col-md-8 col-12">
				<div class="breadcrumbs-top float-md-right">
					<div class="breadcrumb-wrapper mr-1">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="index.html">Home</a>
							</li>
							<li class="breadcrumb-item active">Data Pasien
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
							<div class="table-responsive">
								<table class="table">
									<thead class="thead-dark" align="center">
										<tr>
											<th>Kode Pasien</th>
											<th>Nama Pasien</th>
											<th>Tanggal lahir</th>
											<th>Jenis Kelamin</th>
											<th>Agama</th>
											<th>Pekerjaan</th>
											<th>Foto</th>
											<th>No Telp</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$no = 1;
										foreach ($listpasien as $a) {
										?>
											<tr>
												<td><?php echo $a->kd_pasien ?></td>
												<td><?php echo $a->nama_pasien ?></td>
												<td><?php echo $a->tgl_lahir ?></td>
												<td><?php echo $a->jenis_kelamin ?></td>
												<td><?php echo $a->agama ?></td>
												<td><?php echo $a->pekerjaan ?></td>
												<td><?php echo $a->foto ?></td>
												<td><?php echo $a->no_tlp ?></td>
												
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

