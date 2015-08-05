<?php
 session_start();
//SourceCode by AndezNET.com
 $sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
if ($sesi_username != NULL || !empty($sesi_username) ||$_SESSION['leveluser']=='1'  ) {

    include "../config/koneksi.php";

?>
<div class="row">
<?php 
        $i = 1;
        $jml_per_halaman = 5; // jumlah data yg ditampilkan perhalaman
        $jml_data = mysqli_num_rows(mysqli_query($mysqli,"SELECT a.ID,a.Name,a.Number,a.Foto,(select b.NameGroup from pbk_groups b where b.GroupID=a.GroupID)as NameGroup FROM pbk a order by Name ASC"));
        $jml_halaman = ceil($jml_data / $jml_per_halaman);
        // query pada saat mode pencarian
        if(isset($_POST['cari'])) {
            $kunci = $_POST['cari'];
            echo "<strong>Hasil pencarian untuk kata kunci $kunci</strong>";
            $query = mysqli_query($mysqli,"
                SELECT a.ID,a.Name,a.Number,a.Foto,(select b.NameGroup from pbk_groups b where b.GroupID=a.GroupID)as NameGroup FROM pbk a
                WHERE Name LIKE '%$kunci%'
                OR Number LIKE '%$kunci%'
				order by Name ASC
            ");
        // query jika nomor halaman sudah ditentukan
        } elseif(isset($_POST['halaman'])) {
            $halaman = $_POST['halaman'];
            $i = ($halaman - 1) * $jml_per_halaman  + 1;
            $query = mysqli_query($mysqli,"SELECT a.ID,a.Name,a.Number,a.Foto,(select b.NameGroup from pbk_groups b where b.GroupID=a.GroupID)as NameGroup FROM pbk a order by ID DESC LIMIT ".(($halaman - 1) * $jml_per_halaman).", $jml_per_halaman");
        // query ketika tidak ada parameter halaman maupun pencarian
        } else {
            $query = mysqli_query($mysqli,"SELECT a.ID,a.Name,a.Number,a.Foto,(select b.NameGroup from pbk_groups b where b.GroupID=a.GroupID)as NameGroup FROM pbk a order by ID DESC LIMIT 0, $jml_per_halaman");
            $halaman = 1; //tambahan
        }
         while($data = mysqli_fetch_array($query,MYSQLI_ASSOC)){

    ?>
    <div class="col-lg-4 col-md-4 col-sm-4 mb">
        <div class="white-panel pn">
            <div class="profile-01 centered">
                <a hidden="hidden"><?php echo $i ?></a><p><?php echo $data['Name'] ?> </p>
            </div>
            <p><img src="<?php echo $data['Foto'] ?>" class="img-circle" width="50"></p>
            <p><b><?php echo $data['Number'] ?></b></p>
            <div class="row">
                <div class="col-md-6">
                    <p class="big mt"><a data-toggle="modal" class="btn btn-info" data-target="#myModal<?php echo $data['ID'] ?>" href="#">Kirim Pesan</a></p>
                </div>
                <div class="col-md-6">
                    <p class="big mt"><a data-toggle="modal" id="<?php echo $data['ID'] ?>" class="ubah btn btn-success" data-target="#dialog-pb">Edit</a>
                        <a href="?id=pb&mod=del&idpbk=<?php echo $data['ID'] ?>" onclick="return confirm('Menghapus Phonebook <?php echo $data['Name'] ?>')" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></a></p>
                </div>
            </div>
            <div class="orange-header">
                <p>Group : <?php echo $data['NameGroup'] ?> </p>
            </div>

        </div>
    </div>

             <div class="modal fade" id="myModal<?php echo $data['ID'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                 <div class="modal-dialog">
                     <div class="modal-content">
                         <div class="modal-header">
                             <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                             <h4 class="modal-title" id="myModalLabel">Kirim Pesan</h4>
                         </div>
                         <div class="modal-body">
                             <form class="form-horizontal style-form" action="?id=pb" method="post">
                                 <div class="form-group">
                                     <label class="col-sm-2 col-sm-2 control-label">To</label>
                                     <div class="col-sm-10">
                                         <input type="text" class="form-control" name="nohp" placeholder="Isikan No Hp Tujuan" value="<?php echo $data['Number'] ?>" required>
                                     </div>
                                 </div>

                                 <div class="form-group">
                                     <label class="col-sm-2 col-sm-2 control-label">Pesan</label>
                                     <div class="col-sm-10">
                                         <textarea type="text" class="form-control" name="pesan" placeholder="Isikan Pesan" required></textarea>
                                     </div>

                                 </div>
                                 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                 <input type="submit" class="btn btn-primary" name="input" value="KIRIM"></form>
                         </div>
                         <div class="modal-footer">

                         </div>

                     </div>
                 </div>
             </div>
    <?php
        $i++;
        }
    ?>

        </div>
    <?php if(!isset($_POST['cari'])) { ?>
<!-- untuk menampilkan menu halaman -->
<div class="pagination">
  <ul>

    <?php

    // tambahan
    // panjang pagig yang akan ditampilkan
    $no_hal_tampil = 5; // lebih besar dari 3

    if ($jml_halaman <= $no_hal_tampil) {
        $no_hal_awal = 1;
        $no_hal_akhir = $jml_halaman;
    } else {
        $val = $no_hal_tampil - 3; //3
        $mod = $halaman % $val; //
        $kelipatan = ceil($halaman/$val);
        $kelipatan2 = floor($halaman/$val);

        if($halaman < $no_hal_tampil) {
            $no_hal_awal = 1;
            $no_hal_akhir = $no_hal_tampil;
        } elseif ($mod == 2) {
            $no_hal_awal = $halaman - 1;
            $no_hal_akhir = $kelipatan * $val + 2;
        } else {
            $no_hal_awal = ($kelipatan2 - 1) * $val + 1;
            $no_hal_akhir = $kelipatan2 * $val + 2;
        }

        if($jml_halaman <= $no_hal_akhir) {
            $no_hal_akhir = $jml_halaman;
        }
    }

    for($i = $no_hal_awal; $i <= $no_hal_akhir; $i++) {
        // tambahan
        // menambahkan class active pada tag li
        $aktif = $i == $halaman ? ' active' : '';
    ?>
	<ul class="pagination">

    <li class="halaman<?php echo $aktif ?>" id="<?php echo $i ?>"><a href="#"><?php echo $i ?></a></li>

    </ul>

    <?php } ?>


  </ul>
</div>
    <?php } ?>
<?php
}else{
    session_destroy();
    header('Location:../index.php?status=Silahkan Login');
}
?>