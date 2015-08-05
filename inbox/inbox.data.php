<?php
 session_start();
 $sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
if ($sesi_username != NULL || !empty($sesi_username) ||$_SESSION['leveluser']=='1'  )
//SourceCode by AndezNET.com
{
// panggil berkas koneksi.php
include "../config/koneksi.php";


?>

 <div class="span8">
    <div class="table-responsive">

<table class="table table-striped" cellspacing="0" width="100%">
<thead>
    <tr>
        <th class="site-footer">No</th>
        <th class="site-footer">Tanggal</th>
        <th class="site-footer">Pengirim</th>
        <th class="site-footer">Isi Pesan</th>
        <th class="site-footer"></th>
    </tr>
</thead>
<tbody>
    <?php 
        $i = 1;
        $jml_per_halaman = 5; // jumlah data yg ditampilkan perhalaman
        $jml_data = mysqli_num_rows(mysqli_query($mysqli,"SELECT ID,ReceivingDateTime,SenderNumber,(select a.Name from pbk a where a.Number=b.SenderNumber)as nmpengirim,TextDecoded FROM inbox b order by ReceivingDateTime DESC"));
        $jml_halaman = ceil($jml_data / $jml_per_halaman);
        // query pada saat mode pencarian
        if(isset($_POST['cari'])) {
            $kunci = $_POST['cari'];
            echo "<strong>Hasil pencarian untuk kata kunci $kunci</strong>";
            $query = mysqli_query($mysqli,"
               SELECT ID,ReceivingDateTime,SenderNumber,(select a.Name from pbk a where a.Number=b.SenderNumber)as nmpengirim,TextDecoded FROM inbox b
                WHERE SenderNumber LIKE '%$kunci%'
                OR TextDecoded LIKE '%$kunci%'
				order by ReceivingDateTime DESC
            ");
        // query jika nomor halaman sudah ditentukan
        } elseif(isset($_POST['halaman'])) {
            $halaman = $_POST['halaman'];
            $i = ($halaman - 1) * $jml_per_halaman  + 1;
            $query = mysqli_query($mysqli,"SELECT ID,ReceivingDateTime,SenderNumber,(select a.Name from pbk a where a.Number=b.SenderNumber)as nmpengirim,TextDecoded FROM inbox b order by ReceivingDateTime DESC LIMIT ".(($halaman - 1) * $jml_per_halaman).", $jml_per_halaman");
        // query ketika tidak ada parameter halaman maupun pencarian
        } else {
            $query = mysqli_query($mysqli,"SELECT ID,ReceivingDateTime,SenderNumber,(select a.Name from pbk a where a.Number=b.SenderNumber)as nmpengirim,TextDecoded FROM inbox b order by ReceivingDateTime DESC  LIMIT 0, $jml_per_halaman");
            $halaman = 1; //tambahan
        }
         while($data = mysqli_fetch_array($query,MYSQL_ASSOC)){



    ?>
    <tr>
        <td><?php echo $i ?></td>
        <td><?php echo $data['ReceivingDateTime'] ?></td>
        <td><?php echo $data['SenderNumber'] ?> <div class="label label-success"><?php echo $data['nmpengirim'];?></div></td>
        <td><?php echo $data['TextDecoded']  ?></td>
        <td><div class="btn-group">
                <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
                    Action <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" role="menu">

                    <li><a href="#dialog-inbox" id="<?php echo $data['ID'] ?>" class="balas" data-toggle="modal">
                            <i class="fa fa-pencil"> Balas</i>
                        </a>
                    </li>

                    <li><a href="?id=inbox&mod=del&idinbox=<?php echo $data['ID'];?>" onclick="return confirm ('Menghapus pesan dari <?php echo $data['SenderNumber'];?>?')"><i class="fa fa-trash-o"> Hapus</i></a></li>


                </ul>
            </div>
        </td>

    </tr>

    <?php
        $i++;
        }
    ?>
</tbody>
</table>

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
        $val = $no_hal_tampil - 2; //3
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
</div>
<?php } ?>
 
<?php 

?>
<?php
}else{
	session_destroy();
	header('Location:../index.php?status=Silahkan Login');
}
?>