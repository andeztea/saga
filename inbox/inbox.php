<?php
error_reporting(0);
$sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
//SourceCode by AndezNET.com
if ($sesi_username != NULL || !empty($sesi_username) ||$_SESSION['leveluser']=='1'||$_SESSION['leveluser']=='2'  ) 

{


    $id_inbox	= isset($_GET['idinbox']) ? $_GET['idinbox'] : NULL;
    $mod 		= isset($_GET['mod']) ? $_GET['mod'] : NULL;

    if ($mod == "del") {
        $q_delete_inbox = mysqli_query($mysqli,"DELETE FROM inbox WHERE ID = '$id_inbox'");
        if ($q_delete_inbox >0) {
            echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class='fa fa-times'></i></button><strong><i class='fa fa-check'></i> BERHASIL </strong>Pesan Berhasil di Hapus<br/></div>";
        } else {
            echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='fa fa-times'></i></button><strong><i class='fa fa-times'></i> MAAF! </strong>" .mysql_error()."<br/></div>";
        }
    }

    if ($mod == "delall") {
        $q_deleteall_inbox = mysqli_query($mysqli,"DELETE FROM inbox");
        if ($q_deleteall_inbox >0) {
            echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class='fa fa-times'></i></button><strong><i class='fa fa-check'></i> BERHASIL </strong>Pesan Berhasil di Hapus<br/></div>";
        } else {
            echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='fa fa-times'></i></button><strong><i class='fa fa-times'></i> MAAF! </strong>" .mysql_error()."<br/></div>";
        }
    }

    if ($mod == "cek") {
        $q_cek_inbox = mysqli_query($mysqli,"update inbox set Processed='true' where ID='$id_inbox'");
    }
    ?>

    <h3><i class="fa fa-angle-right"></i><?php echo $judul ?></h3>
    <div class="row mt">
        <div class="col-lg-12">
            <div class="content-panel">
                <section id="unseen">

                    <!-- textbox untuk pencarian -->
                    <div class="weather-2">
                        <span class="add-on"><i class="icon-search"></i></span>

                        <thead>
                        <div class="col-sm-2">
                            <input class="form-control round-form" type="text" name="pencarian" placeholder="Pencarian..">
                        </div>

                        <a data-toggle="modal" class="btn btn-info" data-target="#myModal" href="" >
                            <i class="fa fa-pencil-square-o"></i>
                            Pesan Baru
                            <span class="badge badge-warning badge-right"></span>
                        </a>

                        <a class="btn btn-danger" href="?id=inbox&mod=delall" onclick="return confirm ('Menghapus semua pesan?')">Hapus all</a>

                        <a href="?id=inbox" class="btn btn-success ">
                            <i class="fa fa-refresh bigger-160"></i>
                            Refresh
                        </a>

                        <p> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp </p>
                    </div>
                    </thead>
                    <div id="data-inbox"></div>
                    <a href="cetak/cetakinbox.php" class="btn btn-danger ">
                        Print To PDF
                    </a>

                </section>

            </div><!-- /content-panel -->
        </div><!-- /col-lg-4 -->
    </div><!-- /row -->

<!-- awal untuk modal dialog -->
    <div id="dialog-inbox" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i id="myModalLabel">Balas Pesan</i></h4>
                </div>

                <div class="modal-body">
                    <div class="datainbox"></div>
                </div>

                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

<?php
}else{
	  echo "<script>alert('Mohon Maaf anda tidak bisa akses halaman ini'); window.location = '../index.php'</script>";
}
?>