<div class="app-content content" id="main">
    <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
        <div class="content-header row">
            <div class="content-header-left col-md-4 col-12 mb-2">
                <h3 class="content-header-title" style="margin-bottom:50px;margin-top:80px">DATA ADMIN</h3>
            </div>
            <div class="content-header-right col-md-8 col-12">
                <div class="breadcrumbs-top float-md-right">
                    <div class="breadcrumb-wrapper mr-1">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Data Admin
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
                            <a href="#"><button style="float:left;margin-bottom:10px;" type="button" data-target="#tambah" data-toggle="modal" class="btn btn-primary">Tambah Data Admin</button></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                    <li><a data-action="reload" id="reload"><i class="ft-rotate-cw"></i></a></li>
                                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                </ul>
                                <script>
                                    $('#reload').click(function(event) {
                                        $("#table").load(location.href + " #table");
                                    });
                                </script>
                            </div>
                        </div>
                        <div class="card-content collapse show">
                            <!-- <p><span class="text-bold-600"><button class="btn btn-primary" data-toggle="modal" data-target="#tambah"><i class="fa fa-plus"></i> Tambah Data Dokter</button></span></p> -->
                            <br>
                            <div class="table-responsive">
                                <table class="table" id="table">
                                    <thead class="thead-dark" align="center">
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Admin</th>
                                            <th>Nama Admin</th>
                                            <th>Email</th>
                                            <th>Nomor HP Admin</th>
                                            <th>Foto</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($listadmin as $z) :
                                        ?>
                                            <tr>

                                                <td><?php echo $no++ ?></td>
                                                <td><?php echo $z->kd_regist ?></td>
                                                <td><?php echo $z->name ?></td>
                                                <td><?php echo $z->email ?></td>
                                                <td><?php echo $z->no_hp ?></td>
                                                <td><img src="<?php echo base_url("assets/images/admin/" . $z->image) ?>" width="100px" height="100px"></td>
                                                <td><a href="" data-toggle="modal" data-target="#hapusModal<?= $z->kd_regist ?>"><button type="button" class="la la-trash-o"></button></a>&nbsp;
                                                    <div class="modal fade" id="hapusModal<?= $z->kd_regist ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Apakah Anda yakin untuk menghapus? <?php echo $z->name ?> </h5>
                                                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">×</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-primary" type="button" data-dismiss="modal">Batal</button>
                                                                    <a id="delete_link" class="btn btn-danger" href="<?php echo base_url('Admin/hapusadmin/' . $z->kd_regist); ?>">Hapus</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <button type="button" data-target="#<?php echo $z->kd_regist ?>" data-toggle="modal" class="la la-edit"></button></td>
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
foreach ($listadmin as $z) {
?>

    <!-- Modal Update -->
    <div class="modal fade" id="<?php echo $z->kd_regist ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Admin</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="<?= base_url('Admin/update_admin') ?>" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Kode Admin : <h3><?php echo $z->kd_regist ?></h3></label>
                            <input type="hidden" class="form-control" id="exampleInputEmail1" value="<?php echo $z->kd_regist ?>" name="kd_regist" aria-describedby="emailHelp">
                                </br>
                            <label for="exampleInputEmail1">Nama Admin</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" value="<?php echo $z->name ?>" name="name" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Tempat Lahir </label>
                            <input type="text" class="form-control" name="tempat_lahir" id="exampleFormControlTextarea1" value="<?php echo $z->tempat_lahir ?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Tanggal Lahir </label>
                            <input type="date" class="form-control" name="tgl_lahir" id="exampleFormControlTextarea1" value="<?php echo $z->tgl_lahir ?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Alamat</label>
                            <input type="text" class="form-control" name="alamat" id="exampleFormControlTextarea1" value="<?php echo $z->alamat ?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Email </label>
                            <input type="email" class="form-control" name="email" id="exampleFormControlTextarea1" value="<?php echo $z->email ?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">No Hp Admin </label>
                            <input type="number" class="form-control" name="no_hp" id="exampleFormControlTextarea1" value="<?php echo $z->no_hp ?>">
                        </div>
                        <div class="form-group">
                            <label for="image">Foto</label><br>
                            <center><img src="<?php echo base_url("assets/images/admin/" . $z->image) ?>" width="100px" height="100px">
                                <center><br>
                                    <input type="file" class="form-control" name="image" id="image">
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
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Admin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="<?= base_url('Admin/tambah_admin') ?>" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama Admin</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="name" aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp">
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Nomor HP </label>
                        <input type="number" class="form-control" name="no_hp" id="exampleFormControlTextarea1" rows="3">
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Alamat</label>
                        <input type="text" class="form-control" name="alamat" id="exampleFormControlTextarea1" rows="3">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Tempat Lahir</label>
                        <input type="text" class="form-control" name="tempat_lahir" id="exampleFormControlTextarea1" rows="3">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Tanggal Lahir</label>
                        <input type="date" class="form-control" name="tgl_lahir" id="exampleFormControlTextarea1" rows="3">
                    </div>

                    <div class="form-group">
                        <label for="image_input">Foto</label>
                        <input type="file" class="form-control" name="images" id="images">
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