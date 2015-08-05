<?php
error_reporting(0);
include "config/koneksi.php";

	$username	= $_POST['username'];
	$password	= $_POST['password2'];
	$email	    = $_POST['email'];
	$enkrip_pass= md5($password);
	$nohp	    = $_POST['nohp'];


$cek_username=mysqli_num_rows(mysqli_query
             ($mysqli,"SELECT username FROM tbl_user
               WHERE username='$username'"));

$cek_email=mysqli_num_rows(mysqli_query
             ($mysqli,"SELECT email FROM tbl_user
               WHERE email='$email'"));


if ($cek_username > 0) {
    echo "<div id='gagal' class='alert alert-danger'>Maaf Username sudah terdaftar<button type='button' class='close' data-dismiss='alert'><i class='fa fa-times'></i></button></div>";
}
else if ($cek_email > 0){
    echo "<div id='gagal' class='alert alert-danger'>Mohon maaf Email anda sudah terdaftar<button type='button' class='close' data-dismiss='alert'><i class='fa fa-times'></i></button></div>";

}else {
    $input = mysqli_query($mysqli, "INSERT INTO tbl_user(id_user,username,
                                 pass,
                                 email,
                                 level_user,photo,nohp)
								VALUES('','$username',
								'$enkrip_pass',
								'$email',
								'1','assets/img/logosaga.png','$nohp')");




    if ($input > 0) {
        echo "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert'><i class='fa fa-times'></i></button><strong><i class='fa fa-check'></i> BERHASIL </strong>Silahkan <a href='index.php'>Login</a><br/></div>";
    } else {
        echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='fa fa-times'></i></button><strong><i class='fa fa-times'></i> MAAF! </strong>" . mysqli_error($mysqli) . "<br/></div>";
    }
}