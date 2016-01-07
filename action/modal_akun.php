<?php 
	include '../koneksi.php';

	if (isset($_POST['insert_reg'])) {

		$pass = md5($_POST['password']);
		$db->query("INSERT INTO member(nama,telp,alamat,email,regional,password) 
			VALUES('".$_POST['nama']."','".$_POST['telp']."','".$_POST['alamat']."','".$_POST['email']."','".$_POST['regional']."','".$pass."')");
		
		echo "<script>
				alert('Registrasi Berhasil !!');
			   	window.location.href='../index.php?page=akun';
			  </script>";

	}

 ?>