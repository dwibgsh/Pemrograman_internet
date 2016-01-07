<div class="container-fluid">
	

<?php 
if (isset($_POST['unggah_foto'])) {

	$error = false;
	$folder = 'gambar/unggah/profil/';

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

	//cek kesesuaian file
	$rs_upload=$db->query("SELECT foto FROM jual WHERE id_member='".$_SESSION['id_member']."'");
	$rs_upload->setFetchMode(PDO::FETCH_OBJ);
	$index=$rs_upload->fetch();
	$jml=$rs_upload->rowCount();

	if ($jml!=0&&$file_name==$index->foto) {
		
			$error = true;
			$pesan = 'File Sudah Ada';
		
	}
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
			if (!empty($_POST['foto_hapus'])) {
				unlink('gambar/unggah/profil/'.$_POST['foto_hapus']);
			}
			$db->query("UPDATE telabelang.member SET foto='".$file_name."' WHERE id_member='".$_POST['id_member']."'");

		} else {
			echo "<script>alert('GAGAL UNGGAH');</script>";
		}
	}

}

 ?>

		<?php 

			$rs_profil=$db->query("SELECT * FROM member WHERE id_member='".$_SESSION['id_member']."'");
			$rs_profil->setFetchMode(PDO::FETCH_OBJ);
			while ($index=$rs_profil->fetch()) { 
				if ($index->foto!='') {
					$gambar = 'unggah/profil/'.$index->foto;
				} else {
					$gambar='avatar.png';
				}
				?>

<div class="col-md-2"></div>
<div class="col-md-8">
	<div class="col-md-3">
		<legend>Foto</legend>

		<img src="<?php echo "gambar/".$gambar; ?>" width="100%">
		<form class="form-inline" method="POST" action="" enctype="multipart/form-data">
			<div class="form-group">
				<input type="text" name="id_member" value="<?php echo $_SESSION['id_member']; ?>" class="hide">
				<input type="text" name="foto_hapus" value="<?php echo $index->foto; ?>" class="hide">
				<input type="file" name="data_foto" required>
				<button class="btn btn-warning btn-sm" name="unggah_foto">Ubah Foto</button>
				<p class="help-block">Maks 100kb</p>
			</div>
		</form>
	</div>
	<div class="col-md-9">
		<legend>Data Profil</legend>
		<table class="table">
		
			<tr>
				<td width="25%"><label>Nama</label></td>
				<td width="1%"><label>:</label></td>
				<td><?php echo $index->nama; ?></td>
			</tr>
			<tr>
				<td><label>Telephone / Hp</label></td>
				<td><label>:</label></td>
				<td><?php echo $index->telp; ?></td>
			</tr>
			<tr>
				<td><label>Alamat</label></td>
				<td><label>:</label></td>
				<td><?php echo $index->alamat; ?></td>
			</tr>
			<tr>
				<td><label>E-mail</label></td>
				<td><label>:</label></td>
				<td><?php echo $index->email; ?></td>
			</tr>
			<tr>
				<td><label>Regional</label></td>
				<td><label>:</label></td>
				<td><?php echo $index->regional; ?></td>
			</tr>
			<tr>
				<td colspan="3" style="text-align:right;">
					<button class="btn btn-danger ed_pf">Edit Profil</button>
				</td>
			</tr>

			<?php } ?>
		</table>
	</div>
</div>


<!-- Modal Soal-->
<div class="modal fade btn_modal_edit_profil" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Profil</h4>
      </div>
      <div class="modal-body">
      	<form method="POST" action="page/member/action.php">
      	<?php 
      		$rs2=$db->query("SELECT * FROM member WHERE id_member='".$_SESSION['id_member']."'");
			$rs2->setFetchMode(PDO::FETCH_OBJ);
      		while ($index2=$rs2->fetch()) {
      		
      	 ?>
      	 <input value="<?php echo $index2->id_member; ?>" name="id_member" class="hide">
        <table class="table">
        	<tr>
        		<td><label>Nama</label></td>
        		<td><label>:</label></td>
        		<td><input type="text" class="form-control" name="nama" value="<?php echo $index2->nama; ?>"></td>
        	</tr>
        	<tr>
        		<td><label>Telpone / Hp</label></td>
        		<td><label>:</label></td>
        		<td><input type="text" class="form-control" name="telp" value="<?php echo $index2->telp; ?>"></td>
        	</tr>
        	<tr>
        		<td><label>Alamat</label></td>
        		<td><label>:</label></td>
        		<td><textarea class="form-control" name="alamat"><?php echo $index2->alamat; ?></textarea></td>
        	</tr>
        	<tr>
        		<td><label>E-mail</label></td>
        		<td><label>:</label></td>
        		<td><input type="email" class="form-control" name="email" value="<?php echo $index2->email; ?>"></td>
        	</tr>
        	<tr>
        		<td><label>Regional</label></td>
        		<td><label>:</label></td>
        		<td>
        			<select class="form-control" name="regional" required>
			          <?php $data2 = array('Tegal','Slawi','Brebes','Pemalang'); 

			              $ct2 = count($data2);
			              for ($r2=0; $r2<$ct2; $r2++ ) {
			                if ($index2->regional==$data2[$r2]) {
			                  echo "<option selected>".$data2[$r2]."</option>";
			                } else {
			                ?>
			                  <option><?php echo $data2[$r2]; ?></option>
			                <?php }
			              }
			         ?>
			          
			        </select>
        		</td>
        	</tr>
        	
        </table>
        <?php } ?>
      </div>
      <div class="modal-footer" style="">
      		<button class="btn btn-default" data-dismiss="modal" aria-label="Close">Batal</button>
      		<button class="btn btn-primary" name="edit_profil">Simpan</button>
      </div>
      </form>
    </div>
  </div>
</div>
    <script>
        $(function(){
            $(document).on('click','.ed_pf',function(e){
                e.preventDefault();
                $(".btn_modal_edit_profil").modal('show');
                
            });
        });
    </script>

</div>