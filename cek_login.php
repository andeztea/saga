
<?php
error_reporting(0);
include "config/koneksi.php";
//SourceCode by AndezNET.com
$user = $_POST['username'];
$pass = md5($_POST['passlogin']);

// pastikan username dan password adalah berupa huruf atau angka.

$cek_lagi=mysqli_query($mysqli,"SELECT * FROM tbl_user WHERE username='$user' AND pass='$pass'");
$ketemu=mysqli_num_rows($cek_lagi);
$r=mysqli_fetch_array($cek_lagi,MYSQL_ASSOC);

// Apabila username dan password ditemukan
if ($ketemu > 0){
  session_start();
  $_SESSION['kode']     = $r['id_user'];
  $_SESSION['namauser']     = $r['username'];
  $_SESSION['passuser']     = $r['pass'];
  $_SESSION['leveluser']    = $r['level_user'];
  $_SESSION['w_login']    = $r['w_login'];
    $_SESSION['photo']    = $r['photo'];


  if($_SESSION['leveluser']==1){
	echo "<div id='sukses' class='alert alert-warning alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>BERHASIL!</strong></div>  
	      <script>window.location ='media.php?id=home'</script>";
	mysqli_query($mysqli,"update tbl_user set w_login=NOW() where id_user='$id_user'");
  } 
}
else{
  echo "<div id='sukses' class='alert alert-warning alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>GAGAL LOGIN!</strong></div>";
}


?>