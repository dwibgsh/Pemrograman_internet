<?php 

	include '../../koneksi.php';
	
	if (isset($_POST['edit_profil'])) {

		// $pass = md5($_POST['password']);
		$db->query("UPDATE telabelang.member 
			SET nama='".$_POST['nama']."',telp='".$_POST['telp']."',
				alamat='".$_POST['alamat']."',email='".$_POST['email']."',
				regional='".$_POST['regional']."'
			WHERE id_member = '".$_POST['id_member']."'
			");
		echo "<script>
				alert('Berhasil !!');
			   	window.location.href='../../member.php?page=profil';
			  </script>";
	}



	//-------------------- Edit Ikal ------------- 
	if (isset($_POST['simpan_iklan'])) {

	$error = false;
	$folder = '../../gambar/unggah/';

	//FILE TIPE
	$file_type = array('JPG','JPEG','PNG','GIF','jpg','jpeg','png','gif');

	//UKURAN FILE
	$max_size = 100000; //100 kb
	//Seleksi data
	$file_name  = $_FILES['data_foto']['name'];
    $file_size  = $_FILES['data_foto']['size'];

	//cari extensi file 
	$explode    = explode('.',$file_name);
    $extensi    = $explode[count($explode)-1];

    if (empty($file_name)) {
    	$db->query("UPDATE telabelang.jual SET kategori_jual='".$_POST['kategori_jual']."',
    					nama_barang='".$_POST['nama_barang']."',
    					keterangan='".$_POST['keterangan']."',
    					harga='".$_POST['harga']."',regional='".$_POST['regional']."'
    				WHERE id_member='".$_POST['id_member']."' AND id_jual='".$_POST['id_jual']."'
    		");

    	echo "<script>
				alert('Berhasil !!');
			   	window.location.href='../../member.php';
			  </script>";

    } elseif (!empty($file_name)) {
    	//cek kesesuaian file

		if (!in_array($extensi,$file_type)){
			$error = true;
			$pesan = 'Format File Tidak Sesuai';

		}
		if ($file_size > $max_size) {
			$error = true;
			$pesan = 'Size Lebih dari 100 kb';
		}

		if ($error==true) {
			echo "<script>alert('$pesan');</script>";
		} else {
			//PROSES UPLOAD
			if(move_uploaded_file($_FILES['data_foto']['tmp_name'], $folder.$file_name)){
				//Simpan kedatabase
				unlink('../../gambar/unggah/'.$_POST['unlink_foto']);

				$db->query("UPDATE telabelang.jual SET kategori_jual='".$_POST['kategori_jual']."',
    					nama_barang='".$_POST['nama_barang']."',
    					keterangan='".$_POST['keterangan']."',foto='".$file_name."',
    					harga='".$_POST['harga']."',regional='".$_POST['regional']."'
    				WHERE id_member='".$_POST['id_member']."' AND id_jual='".$_POST['id_jual']."'
    		");

			} else {
				echo "<script>alert('GAGAL UNGGAH');</script>";
			}
		}
		echo "<script>
			   	window.location.href='../../member.php';
			  </script>";

    } // Kondisi ada foto

	

}

 ?>