<?php  session_start();
//SourceCode by AndezNET.com
if(isset($_SESSION['username']))
{
	session_destroy();
	header('Location:index.php?status=Anda sudah Keluar');
}else{
	session_destroy();
	header('Location:index.php?status=Silahkan Login!');
}
?>