<?php
session_start();
$sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
if ($sesi_username != NULL || !empty($sesi_username) ||$_SESSION['leveluser']=='1'  )
//SourceCode by AndezNET.com
{

    include "../config/koneksi.php";


    $id_inbox = $_POST['id'];

    $data = mysqli_fetch_array(mysqli_query($mysqli,"SELECT * FROM inbox WHERE ID=".$id_inbox),MYSQL_ASSOC);


    if($id_inbox > 0) {
        $id_inbox = $data['ID'];
        $to= $data['SenderNumber'];
    }

    ?>

    <form class="form-horizontal style-form" action="" method="POST" id="form-inbox">

        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Pesan</label>
            <div class="col-sm-10">
                <textarea class="form-control" name="pesan" id="pesan" required></textarea>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">To</label>
            <div class="col-sm-5">
                <input type="text" name="nohp" class="form-control" id="nohp" value="<?php echo $to ?>">
            </div>
        </div>

        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" name="input" value="KIRIM">
    </form>

<?php
}else{
    session_destroy();
    header('Location:../index.php?status=Silahkan Login');
}
?>