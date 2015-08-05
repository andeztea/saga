<?php
session_start();
$sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
if ($sesi_username != NULL || !empty($sesi_username) ||$_SESSION['leveluser']=='1'  )
//SourceCode by AndezNET.com
{

    include "../config/koneksi.php";


    $id_pbk = $_POST['id'];

    $data = mysqli_fetch_array(mysqli_query($mysqli,"SELECT * FROM pbk WHERE ID=".$id_pbk),MYSQL_ASSOC);

    if($id_pbk > 0) {
        $id_pbk = $data['ID'];
        $idgroup= $data['GroupID'];
        $nama = $data['Name'];
        $nohandphone = $data['Number'];
        $foto = $data['Foto'];
        $ket= "Edit";

    } else  {
        $id_pbk = "";
        $idgroup= "";
        $nama = "";
        $nohandphone  = "";
        $foto = "assets/img/noname.jpg";
        $ket= "Tambah";

    }

    ?>


    <form class="form-horizontal style-form" action="?id=pb" method="POST" id="uploadAjaxImage" enctype="multipart/form-data">

        <div class="form-group" hidden="hidden">
            <label class="col-sm-2 col-sm-2 control-label">ID</label>
            <div class="col-sm-2">
                <input type="text" name="idpbk" id="idpbk" value="<?php echo $id_pbk ?>">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Foto</label>
            <div class="col-sm-10">
                <div id="image_preview">
                    <img id="previewing" src="<?php echo $foto ?>" width="250" height="230"/></div>
                <span id='loading'></span>
                <div id="message"></div>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Nama</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="name" id="name" placeholder="Nama" value="<?php echo $nama ?>" required>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">No Handphone</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="datanohp" id="datanohp" placeholder="Isikan No Handphone" value="<?php echo $nohandphone ?>" required>
            </div>
        </div>



        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Group</label>
            <div class="col-sm-10">

                <select name="gp" value="" id="gp">
                    <option>-- Pilih Group --</option>
                    <?php
                    $q = mysqli_query($mysqli,"select * from pbk_groups");

                    while ($a = mysqli_fetch_array($q)){
                        if ($a[1] ==$idgroup) {
                            echo "<option value='$a[1]' selected>$a[0]</option>";
                        } else {
                            echo "<option value='$a[1]'>$a[0]</option>";
                        }
                    }
                    ?>
                </select>


            </div>
        </div>


        <div class="form-group" id="selectImage">
            <label class="col-sm-2 col-sm-2 control-label">Upload Photo</label>
            <div class="col-sm-10">
                <input type="file" name="file" id="file"/>


            </div>
        </div>
        <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Batal</button>
        <input type="submit" name="tb_act" class="btn btn-primary" VALUE="<?php echo $ket?>">
    </form>


    <script src="../assets/js/jquery-1.8.3.min.js"></script>
    <script>
        $(document).ready(function (e) {

            // Function to preview image after validation
            $(function() {
                $("#file").change(function() {
                    $("#message").empty(); // To remove the previous error message
                    var file = this.files[0];
                    var imagefile = file.type;
                    var match= ["image/jpeg","image/png","image/jpg"];
                    if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2])))
                    {
                        $('#previewing').attr('src','noimage.png');
                        $("#message").html("<p id='error'>Mohon Pilih File dengan benar</p>"+"<h4>Catatan</h4>"+"<span id='error_message'>Only jpeg, jpg and png Images type allowed</span>");
                        return false;
                    }else{
                        var reader = new FileReader();
                        reader.onload = imageIsLoaded;
                        reader.readAsDataURL(this.files[0]);
                    }
                });
            });
            function imageIsLoaded(e) {
                $("#file").css("color","#FFFFFF");
                $('#image_preview').css("display", "block");
                $('#previewing').attr('src', e.target.result);
                $('#previewing').attr('width', '250px');
                $('#previewing').attr('height', '230px');
            };
        });
    </script>
    </head>





<?php
}else{
    session_destroy();
    header('Location:../index.php?status=Silahkan Login');
}
?>