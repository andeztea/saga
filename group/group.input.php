<?php
 session_start();
 $sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
if ($sesi_username != NULL || !empty($sesi_username) ||$_SESSION['leveluser']=='1'  )
//SourceCode by AndezNET.com
{
include "../config/koneksi.php";
error_reporting(0);

// proses menghapus data
if(isset($_POST['hapus'])) {
	mysqli_query($mysqli,"DELETE FROM pbk_groups WHERE GroupID=".$_POST['hapus']);
} else {
	// deklarasikan variabel
	$id_group	= $_POST['id_group'];
	$nmgroup	= $_POST['namegroup'];

	// validasi agar tidak ada data yang kosong
	if($nmgroup!="") {
		// proses tambah data
		if($id_group == 0) {
			mysqli_query($mysqli,"INSERT INTO pbk_groups VALUES('$nmgroup','')");
		// proses ubah data
		} else {
			$q_group=mysqli_query($mysqli,"UPDATE pbk_groups SET
			NameGroup = '$nmgroup'
			WHERE GroupID= $id_group
			");

			if ($q_group) {
					echo "<h4 class='alert_success'>Data berhasil ditambahkan <a href=''>Cetak</a><span id='close'>[<a href='#'>X</a>]</span></h4>";
				} else {
					echo "<h4 class='alert_error'>".mysql_error()."<span id='close'>[<a href='#'>X</a>]</span></h4>";
				}

		}
	}
}

?>
<?php
}else{
	session_destroy();
	header('Location:../index.php?status=Silahkan Login');
}
?>