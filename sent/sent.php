<?php
session_start();
$sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
if ($sesi_username != NULL || !empty($sesi_username) ||$_SESSION['leveluser']=='1'  )
//SourceCode by AndezNET.com
{
    $id_sent	= isset($_GET['idsent']) ? $_GET['idsent'] : NULL;
    $mod 		= isset($_GET['mod']) ? $_GET['mod'] : NULL;

    if ($mod == "del") {
        $q_delete_sent = mysqli_query($mysqli,"DELETE FROM sentitems WHERE ID = '$id_sent'");
        if ($q_delete_sent) {
            echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class='fa fa-times'></i></button><strong><i class='fa fa-check'></i> BERHASIL </strong>Pesan Berhasil di Hapus<br/></div>";
        } else {
            echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='fa fa-times'></i></button><strong><i class='fa fa-times'></i> MAAF! </strong>" .mysql_error()."<br/></div>";
        }
    }

    if ($mod == "delall") {
        $q_deleteall_sent = mysqli_query($mysqli,"DELETE FROM sentitems");
        if ($q_deleteall_sent >0) {
            echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class='fa fa-times'></i></button><strong><i class='fa fa-check'></i> BERHASIL </strong>Pesan Terkirim Berhasil di Hapus<br/></div>";
        } else {
            echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='fa fa-times'></i></button><strong><i class='fa fa-times'></i> MAAF! </strong>" .mysqli_error($mysqli,$q_deleteall_sent)."<br/></div>";
        }
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

                        <a class="btn btn-danger" href="?id=sent&mod=delall" onclick="return confirm ('Menghapus semua pesan?')">Hapus all</a>

                        <a href="?id=sent" class="btn btn-success ">
                            <i class="fa fa-refresh bigger-160"></i>
                            Refresh
                        </a>

                        <p> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp </p>
                    </div>
                    </thead>
                    <div id="data-sent"></div>
                </section>

            </div><!-- /content-panel -->
        </div><!-- /col-lg-4 -->
    </div><!-- /row -->

<!-- awal untuk modal dialog -->
    <div id="sent" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i id="myModalLabel">Balas Pesan</i></h4>
                </div>

                <div class="modal-body">
                    <div class="datasent"></div>
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