<?php
session_start();
$sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
if ($sesi_username != NULL || !empty($sesi_username) ||$_SESSION['leveluser']=='1'  )
//SourceCode by AndezNET.com

{

    include "../config/koneksi.php";


    $id_auto = $_POST['id'];

    $data = mysqli_fetch_array(mysqli_query($mysqli,"SELECT * FROM tbl_autoreply WHERE ID=".$id_auto),MYSQL_ASSOC);


    if($id_auto > 0) {
        $id_auto = $data['id'];
        $keyword1= $data['keyword1'];
        $keyword2 = $data['keyword2'];
        $result = $data['result'];

    } else  {
        $id_auto = "";
        $keyword1= "";
        $keyword2 = "";
        $result = "";
    }

    ?>

    <form class="form-horizontal style-form" id="form-auto">

        <div class="form-group" hidden="hidden">
            <label class="col-sm-2 col-sm-2 control-label">id</label>
            <div class="col-sm-2">
                <input type="text" name="id_auto" id="id_auto" value="<?php echo $id_auto ?>">
            </div>
        </div>


        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Keyword 1</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="keyword1" id="keyword1" placeholder="" value="<?php echo $keyword1 ?>">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Keyword 2</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="keyword2" id="keyword2" placeholder="" value="<?php echo $keyword2 ?>">
            </div>
        </div>


        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Result</label>
            <div class="col-sm-10">
                <textarea class="form-control" name="result1" id="result1"><?php echo $result ?></textarea>
            </div>
        </div>


    </form>

<?php
}else{
    session_destroy();
    header('Location:../index.php?status=Silahkan Login');
}
?>