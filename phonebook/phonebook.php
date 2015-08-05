<?php
 session_start();
 $sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
if ($sesi_username != NULL || !empty($sesi_username) ||$_SESSION['leveluser']=='1'  )
//SourceCode by AndezNET.com
{


?>
<h3><i class="fa fa-angle-right"></i><?php echo $judul ?></h3>
    <?php
    $maxsize        = 2097152;
    $idpbk  	    = isset($_POST['idpbk']) ? $_POST['idpbk'] : NULL;
    $name  	        = isset($_POST['name']) ? $_POST['name'] : NULL;
    $datanohp	    = isset($_POST['datanohp']) ? $_POST['datanohp'] : NULL;
    $gp 	        = isset($_POST['gp']) ? $_POST['gp'] : NULL;
    $tb_act 		= isset($_POST['tb_act']) ? $_POST['tb_act'] : NULL;
    $foto	        = "";
    $mod 		    = isset($_GET['mod']) ? $_GET['mod'] : NULL;
    $id_pbk	        = isset($_GET['idpbk']) ? $_GET['idpbk'] : NULL;
    $nama_file      = $_FILES['file']['name'];
    $size_file      = $_FILES['file']['size'];
    $type_file      = $_FILES['file']['type'];




//============================

    if ($tb_act == "Tambah") {
        if ($name != "" && $datanohp != "") {

            if(($_FILES['file']['size'] >= $maxsize))
            {
                echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong> upload eroors<br/></div>";
            }	else {

                $uploaddir = 'assets/img/';
                $alamatfile = $uploaddir . $nama_file;
                move_uploaded_file($_FILES['file']['tmp_name'], $alamatfile);

                $q_tambah = mysqli_query($mysqli, "INSERT INTO pbk VALUES ('',$gp,'$name','$datanohp','$alamatfile')");
                if ($q_tambah > 0) {
                    echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Phonebook Berhasil disimpan<br/></div>";
                } else {
                    echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" . mysqli_error($mysqli) . "<br/></div>";
                }
            }
        } else {
            echo "<h4 class='alert_error'>Lengkapi Isian<span id='close'>[<a href='#'>X</a>]</span></h4>";
        }

    }


    if ($tb_act == "Edit") {
        if ($name != "" && $datanohp != "") {

            if(($_FILES['file']['size'] >= $maxsize))
            {
                echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong> upload eroors<br/></div>";
            }	else {
                if (($_FILES['file']['size'] == 0) ){

                    $q_edit1 = mysqli_query($mysqli, "UPDATE pbk SET GroupID='$gp', Name='$name', Number='$datanohp' where ID='$idpbk'");
                    if ($q_edit1 > 0) {
                        echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Phonebook Berhasil disimpan<br/></div>";
                    } else {
                        echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" . mysqli_error($mysqli) . "<br/></div>";
                    }
                }else {
                    $uploaddir = 'assets/img/';
                    $alamatfile = $uploaddir . $nama_file;
                    move_uploaded_file($_FILES['file']['tmp_name'], $alamatfile);

                    $q_edit2 = mysqli_query($mysqli, "UPDATE pbk SET GroupID='$gp',Name='$name',Number='$datanohp',Foto='$alamatfile' where ID='$idpbk'");
                    if ($q_edit2 > 0) {
                        echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Phonebook Berhasil disimpan<br/></div>";
                    } else {
                        echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" . mysqli_error($mysqli) . "<br/></div>";
                    }
                }

            }
        } else {
            echo "<h4 class='alert alert_danger'>Lengkapi Isian<span id='close'>[<a href='#'>X</a>]</span></h4>";
        }

    }

//SourceCode by AndezNET.com
      else if ($mod == "del") {
        $q_delete_pb = mysqli_query($mysqli,"DELETE FROM pbk WHERE ID = '$id_pbk'");
        if ($q_delete_pb > 0) {
            echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong>  Menghapus Phonebook<br/></div>";
        } else {
            echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" .mysqli_error($mysqli)."<br/></div>";
        }
         }

    ?>
    <div>
        <div class="col-sm-2">
        <input class="form-control round-form" type="text" name="pencarian" placeholder="Pencarian..">
        </div>

        <thead>
        <a  data-target="#dialog-pb" id="0" class="tambah btn btn-info" data-toggle="modal" >
            <i class="fa fa-pencil-square-o"></i>
            Tambah
            <span class="badge badge-warning badge-right"></span>
        </a>


        <a href="?id=pb" class="btn btn-success">
            <i class="fa fa-refresh"></i>
            Refresh
        </a>

    </div>

    <div id="data-pb"></div>
    </thead>

    <div id="dialog-pb" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i id="myModalLabel">Phonebook</i></h4>
                </div>

                <div class="modal-body">
                    <div class="pb"></div>
                </div>

                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>


<?php
}else{
    session_destroy();
    header('Location:../index.php?status=Silahkan Login');
    //SourceCode by AndezNET.com
}
?>

