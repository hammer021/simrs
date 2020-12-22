
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
				<h4 class="card-title">MY Profile</h4>
				<a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
				<div class="heading-elements">
					<ul class="list-inline mb-0">
						<li><a data-action="collapse"><i class="ft-minus"></i></a></li>
						<li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
						<li><a data-action="expand"><i class="ft-maximize"></i></a></li>
						<li><a data-action="close"><i class="ft-x"></i></a></li>
					</ul>
				</div>
			</div>
			<div class="card-content container collapse show">
				<div class="body">
					<?php 
					foreach ($profile as $prof):
					?>
				<form method="post" action="<?= base_url('Profile/update_profile') ?>" enctype="multipart/form-data">
						<div class="form-group">
							<input type="hidden" id="kd_regist" name ="kd_regist" value="<?php echo $prof->kd_regist ?>"> 
							<input class="form-control" type="text" id="name" name = "name" value="<?php echo $prof->name ?>">
						</div>
						
						<div class="form-group">
						<label for="email">Email :</label><br>
							<input class="form-control" type="email" id="email" name = "email" value="<?php echo $prof->email ?>">
						</div>
						
						<div class="form-group">
						<label for="alamat">Alamat :</label><br>
							<input class="form-control" type="text" id="alamat" name = "alamat" value="<?php echo $prof->alamat ?>">
						</div>
						
						<div class="form-group">
						<label for="no_hp">No Hp :</label><br>
							<input class="form-control" type="text" id="no_hp" name = "no_hp" value="<?php echo $prof->no_hp ?>">
						</div>

						<div class="form-group">
							<label for="image">Foto</label><br>
							<center><img src="<?php echo base_url("assets/images/" . $prof->image) ?>" width="300px" height="300px">
								<center><br>
									<input type="file" class="form-control" name="image" id="image">
						</div>

						<div class="form-group">
						<label for="tempat_lahir">Tempat Lahir :</label><br>
							<input class="form-control" type="text" id="tempat_lahir" name = "tempat_lahir" value="<?php echo $prof->tempat_lahir ?>">
						</div>

						<div class="form-group">
						<label for="tgl_lahir">Tanggal Lahir :</label><br>
							<input class="form-control" type="date" id="tgl_lahir" name = "tgl_lahir" value="<?php echo $prof->tgl_lahir ?>">
						</div>
						

						<div class="modal-footer">
							<a class="btn btn-secondary" href="<?php echo base_url('Admin/dashboard') ?>">Close</a>
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
