<?php
//SourceCode by AndezNET.com
session_start();
$sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
if ($sesi_username != NULL || !empty($sesi_username) ||$_SESSION['leveluser']=='1'  )
//SourceCode by AndezNET.com
{

// ================ DATA FORM ( POST ) =====================//
    $tb_act 		= isset($_POST['tb_act']) ? $_POST['tb_act'] : NULL;
//===================
    $p_user 		= isset($_POST['username']) ? $_POST['username'] : NULL;
    $maxsize        = 2097152;
    $p_pass 		= isset($_POST['pass']) ? $_POST['pass'] : NULL;
    $p_email 		= isset($_POST['email']) ? $_POST['email'] : NULL;
    $p_nohp	 		= isset($_POST['datanohp']) ? $_POST['datanohp'] : NULL;
    $p_pass	 		= isset($_POST['pass2']) ? $_POST['pass2'] : NULL;
//===================
    $nama_file      = $_FILES['file']['name'];
    $size_file      = $_FILES['file']['size'];
    $type_file      = $_FILES['file']['type'];

//============================
    if ($tb_act == "UPDATE") {
        if ($p_user != "" && $p_email != "") {

            if(($_FILES['file']['size'] >= $maxsize))
            {
                echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='fa fa-times'></i> MAAF! </strong> upload eroors<br/></div>";
            }	else {
                if (($_FILES['file']['size'] == 0) ){

                    $q_edit1 = mysqli_query($mysqli, "UPDATE tbl_user SET username='$p_user', email='$p_email', nohp='$p_nohp' where id_user='$id_user'");
                    if ($q_edit1 > 0) {
                        echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='fa fa-check'></i> BERHASIL</strong> Profile Berhasil disimpan<br/></div>";
                    } else {
                        echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='fa fa-times'></i> MAAF! </strong>" . mysqli_error($mysqli) . "<br/></div>";
                    }
                }else {
                    $uploaddir = 'assets/img/';
                    $alamatfile = $uploaddir . $nama_file;
                    move_uploaded_file($_FILES['file']['tmp_name'], $alamatfile);

                    $q_edit2 = mysqli_query($mysqli, "UPDATE tbl_user SET username='$p_user', email='$p_email', nohp='$p_nohp' ,photo='$alamatfile' where id_user='$id_user'");
                    if ($q_edit2 > 0) {
                        echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='fa fa-check'></i> BERHASIL</strong> Profile Berhasil disimpan<br/></div>";
                    } else {
                        echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='fa fa-times'></i> MAAF! </strong>" . mysqli_error($mysqli) . "<br/></div>";
                    }
                }

            }
        } else {
            echo "<h4 class='alert alert_danger'>Lengkapi Isian<span id='close'>[<a href='#'>X</a>]</span></h4>";
        }

    }

    $data = mysqli_fetch_array(mysqli_query($mysqli,"SELECT * FROM tbl_user WHERE id_user=".$id_user),MYSQL_ASSOC);

    $username = $data['username'];
    $email = $data['email'];
    $photo = $data['photo'];
    $nohp = $data['nohp'];

?>
    <div class="profile-01 centered">
        <p><i class="fa fa-angle-right"></i> <?php echo $judul ?></p>


    <div class="row mt">
        <div class="col-lg-12">
            <div class="form-panel">

                    <form class="form-horizontal style-form" action="" method="POST" id="uploadAjaxImage" enctype="multipart/form-data">

                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Foto</label>
                          <div class="col-sm-5">
                    <div id="image_preview">
                     <img id="previewing" src="<?php echo $photo ?>" width="250" height="230"/></div>
                              <span id='loading'></span>
                    <div id="message"></div>
                    </div>
                    </div>

                        <div class="form-group" id="selectImage">
                            <label class="col-sm-2 col-sm-2 control-label">Upload Photo</label>
                            <div class="col-sm-10">
                                <input type="file" name="file" id="file"/>

                            </div>
                        </div>


                        <div class="form-group">
                        <label class="col-sm-2 control-label">Username</label>
                            <div class="col-sm-5">
                            <input type="text" class="form-control" name="username" id="username" placeholder="Isikan Username" value="<?php echo $username ?>" required>
                            </div>
                            <a  data-target="#dialog-pass" id="0" class="btn btn-danger" data-toggle="modal" >
                                <i class="fa fa-pencil-square-o"></i>
                                Ubah Password
                                <span class="badge badge-warning badge-right"></span>
                            </a>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Email</label>
                            <div class="col-sm-5">
                                <input type="email" class="form-control" name="email" id="email" placeholder="Isikan Email" value="<?php echo $email ?>" required>
                            </div>
                        </div>


                        <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">No Handphone</label>
                        <div class="col-sm-5">
                    <input type="text" class="form-control" name="datanohp" id="datanohp" placeholder="Isikan No Handphone" value="<?php echo $nohp ?>" required>
                    </div>
                    </div>

                    <input type="submit" name="tb_act" class="btn btn-primary" VALUE="UPDATE">

                    </form>

                <div id="dialog-pass" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title"><i id="myModalLabel">Ubah Password</i></h4>
                            </div>

                            <div class="modal-body">
                                <?php
                                $tb_act 		= isset($_POST['tb_act']) ? $_POST['tb_act'] : NULL;
                                $p_pass 		= isset($_POST['pass2']) ? $_POST['pass2'] : NULL;
                                $passmd5        =md5($p_pass);

                                if ($tb_act == "UBAH") {
                                    $q_edit_pass	= mysqli_query($mysqli,"UPDATE tbl_user SET pass= '$passmd5'
								WHERE id_user = '$id_user'");
                                    if ($q_edit_pass) {
                                        echo "<script>alert('Password Berhasil di ubah');</script>";
                                    } else {
                                        echo "<script>alert('GAGAL');</script>";
                                    }
                                }

                                ?>
                                <form class="form-horizontal" name="form" id="valid-pass" method="post" action="">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="form-field-pass1">New Password</label>
                                        <div class="col-sm-5">
                                            <input type="password" class="form-control" name="pass1" id="pass1" />
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="form-field-pass2">Confirm Password</label>
                                        <div class="col-sm-5">
                                            <input type="password" name="pass2" class="form-control" id="pass2" />
                                        </div>
                                    </div>
                                    <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Batal</button>
                                    <input type="submit" name="tb_act" class="btn btn-primary" VALUE="UBAH">
                                </form>
                            </div>

                            <div class="modal-footer">

                        </div>
                        </div>
                    </div>
                </div>


                </div>
            </div>
            </div>
        </div>

<?php
}else{
session_destroy();
header('Location:../index.php?status=Silahkan Login');
}
?>