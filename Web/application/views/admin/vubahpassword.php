
    <div class="app-content content" id="main">
      <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
        <div class="content-header row">
          <div class="content-header-left col-md-4 col-12 mb-2">
            <h3 class="content-header-title" style="margin-bottom:50px;margin-top:80px">Edit Profile</h3>
          </div>
          <div class="content-header-right col-md-8 col-12">
            <div class="breadcrumbs-top float-md-right">
              <div class="breadcrumb-wrapper mr-1">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.html">Profile</a>
                  </li>
                  <li class="breadcrumb-item active">Edit Profile
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
				<h4 class="card-title">Ubah Password</h4>
				<a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
				<?php 
	                  if(isset($_GET['pesan'])){
		                  if($_GET['pesan'] == "gakcocoklama"){
		          	        echo "Password tidak cocok dengan password lama!";
						  }
						  else if($_GET['pesan'] == "gakcocok"){
                        echo "Pengulangan Password tidak cocok!";
                      	}
		               }
	                ?>
				<div class="heading-elements">
					<ul class="list-inline mb-0">
						<li><a data-action="collapse"><i class="ft-minus"></i></a></li>
						<li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
						<li><a data-action="expand"><i class="ft-maximize"></i></a></li>
						<li><a data-action="close"><i class="ft-x"></i></a></li>
					</ul>
				</div>
			</div>
			<div class="card-contentaa container collapse show">
				<div class="body">
					<?php 
					foreach ($pass as $prof):
					?>
				<form method="post" action="<?php 
				$sess = $this->session->userdata("kd_role");
				if ($sess=="1"){
					echo base_url('Profile/update_pass') ;
				} 
				 else if ($sess=="2"){
					echo base_url('Profile/update_passdok') ;
				}
				?>" enctype="multipart/form-data">
						<div class="form-group">
							<input type="hidden" id="kd_regist" name ="kd_regist" value="<?php echo $prof->kd_regist ?>"> 
							<h3><?php echo $prof->name ?></h3>
							
						</div>
						
						<div class="form-group">
						<label for="email">Password Lama :</label><br>
							<input placeholder ="Masukkan Password Lama" class="form-control" type="password" id="passlama" name = "passlama" value="">
						</div>
						
						<div class="form-group">
						<label for="alamat">Password Baru :</label><br>
							<input placeholder ="Masukkan Password Baru" class="form-control" type="password" id="passbaru" name = "passbaru" value="">
						</div>
						
						<div class="form-group">
						<label for="no_hp">Ulangi Passwod Baru :</label><br>
							<input placeholder ="Ulangi Masukkan Password Baru" class="form-control" type="password" id="rptpassbaru" name = "rptpassbaru" value="">
						</div>

						<div class="modal-footer">
							<a class="btn btn-secondary" href="<?php
							$sess = $this->session->userdata("kd_role");
							if ($sess=="1"){
								echo base_url('Admin/dashboard');
							} 
							 else if ($sess=="2"){
								echo base_url('Dokter/dashboard');
							}?>">Close</a>
							<button type="submit" class="btn btn-danger">Save</button>
					</form>
					<?php endforeach;?>
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
