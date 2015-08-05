<?php
error_reporting(0);
$sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;

if ($sesi_username != NULL || !empty($sesi_username) ||$_SESSION['leveluser']=='1'||$_SESSION['leveluser']=='2'  )
//SourceCode by AndezNET.com
{


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
                        <a  data-target="#dialog-group" id="0" class="tambah btn btn-info" data-toggle="modal" >
                            <i class="fa fa-pencil-square-o"></i>
                            Tambah
                            <span class="badge badge-warning badge-right"></span>
                        </a>

                        <a href="?id=grp" class="btn btn-success ">
                            <i class="fa fa-refresh "></i>
                            Refresh
                        </a>
                        <p> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp</p>
                    </div>
                    </thead>
                    <div id="data-group"></div>
                </section>

            </div><!-- /content-panel -->
        </div><!-- /col-lg-4 -->
    </div><!-- /row -->

<!-- awal untuk modal dialog -->
    <div id="dialog-group" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i id="myModalLabel">Group</i></h4>
                </div>

                <div class="modal-body">
                    <div class="group"></div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Batal</button>
                    <button id="simpan-group" class="btn btn-success" data-dismiss="collapse" aria-hidden="true" >Simpan</button>
                </div>
            </div>
        </div>
    </div>




<?php
}else{
	  echo "<script>alert('Mohon Maaf anda tidak bisa akses halaman ini'); window.location = '../index.php'</script>";
}
?>