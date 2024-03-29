
    <div class="app-content content" id="main">
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
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">&nbsp;</h4>
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
			<div class="card-content collapse show">
				<div class="table-responsive">
					<table class="table" id="table">
						<thead class="thead-dark">
							<tr>
								<th scope="col">No</th>
								<th scope="col">Kode Resep</th>
								<th scope="col">Resep</th>
								<th scope="col">Biaya</th>
								<th scope="col">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$no=1;
							foreach($resep as $r):?>
							<tr>
								<th><?php echo $no++ ?></th>
								<td><?php echo $r->kd_resep ?></td>
								<td><?php echo $r->resep ?></td>
								<td>Rp. <?php echo $r->harga_resep ?></td>
								<td>-</td>
							</tr>
							<?php endforeach;?>
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
