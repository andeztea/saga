<?php
session_start();
$sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
if ($sesi_username != NULL || !empty($sesi_username) ||$_SESSION['leveluser']=='1'  )
//SourceCode by AndezNET.com
{

    include "../config/koneksi.php";


    $id_group = $_POST['id'];

    $data = mysqli_fetch_array(mysqli_query($mysqli,"SELECT * FROM pbk_groups WHERE GroupID=".$id_group),MYSQL_ASSOC);


    if($id_group > 0) {
        $id_group  = $data['GroupID'];
        $namegroup  = $data['NameGroup'];

    } else  {
        $id_group  = "";
        $namegroup  = "";
    }

    ?>

    <form class="form-horizontal style-form" id="form-grp">

        <div class="form-group" hidden="hidden">
            <label class="col-sm-2 col-sm-2 control-label">id</label>
            <div class="col-sm-2">
                <input type="text" name="id_group" id="id_group" value="<?php echo $id_group ?>">
            </div>
        </div>


        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Name Group</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="namegroup" id="namegroup" placeholder="Isikan Nama Group" value="<?php echo $namegroup ?>">
            </div>
        </div>



    </form>

<?php
}else{
    session_destroy();
    header('Location:../index.php?status=Silahkan Login');
}
?>