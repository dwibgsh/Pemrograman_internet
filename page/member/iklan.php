<div class="container-fluid">
	


<?php

if (isset($_POST['simpan_iklan'])) {

	$error = false;
	$folder = 'gambar/unggah/';

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
			$db->query("INSERT INTO jual(id_member,kategori_jual,nama_barang,keterangan,foto,harga,regional) 
				VALUES('".$_POST['id_member']."','".$_POST['kategori_jual']."','".$_POST['nama_barang']."','".$_POST['keterangan']."','".$file_name."','".$_POST['harga']."','".$_POST['regional']."')");
		} else {
			echo "<script>alert('GAGAL UNGGAH');</script>";
		}
	}

}

if (isset($_GET['hapus'])) {
	unlink('gambar/unggah/'.$_GET['unlink_foto']);
	$db->query("DELETE FROM jual WHERE id_jual='".$_GET['hapus']."'");
	echo "<script>
				alert('Terhapus!!');
			   	window.location.href='member.php?page=iklan';
			  </script>";
}
?>


<div class="col-md-4" style="border-right:1px dashed #333;">
<legend>Form Iklan</legend>
<div style="background-color:rgb(254, 255, 207); " class="table-responsive">
<form method="POST" action="" enctype="multipart/form-data">
	<input type="text" value="<?php echo $_SESSION['id_member']; ?>" name="id_member" class="hide">
	<table class="table" width="100%">
		<tr>
			<td><label>Kategori</label></td>
			<td><label>:</label></td>
			<td>
				<select class="form-control" name="kategori_jual" required>
					<option>Mobil</option>
					<option>Motor</option>
					<option>Properti</option>
					<option>Fashion</option>
					<option>Hp</option>
					<option>Industri</option>
					<option>Hobi</option>
					<option>Komputer</option>
				</select>
			</td>
		</tr>
		<tr>
			<td><label>Nama Barang</label></td>
			<td><label>:</label></td>
			<td><input type="text" class="form-control" name="nama_barang" required></td>
		</tr>
		<tr>
			<td><label>Keterangan</label></td>
			<td><label>:</label></td>
			<td><textarea class="form-control" name="keterangan" required></textarea></td>
		</tr>
		<tr>
			<td><label>Foto</label><p class="help-block">Maks 100kb</p></td>
			<td><label>:</label></td>
			<td><input type="file" name="data_foto" class="form-control" required></td>
		</tr>
		<tr>
			<td><label>Harga</label></td>
			<td><label>:</label></td>
			<td>
				<div class="input-group">
                   <span class="input-group-addon">Rp.</span>
                   <input type="text" class="form-control" name="harga" placeholder="Cth : 100000" required>
                   <span class="input-group-addon">,00</span>
                </div>
			</td>
		</tr>
		<tr>
			<td><label>Area iklan</label></td>
			<td><label>:</label></td>
			<td>
				<select class="form-control" name="regional" required>
					<option>Tegal</option>
					<option>Slawi</option>
					<option>Brebes</option>
					<option>Pemalang</option>
				</select>
			</td>
		</tr>
		<tr>
			<td colspan="3" style="text-align:right;">
				<button class="btn btn-default" type="reset">Batal</button>
				<button class="btn btn-danger" name="simpan_iklan">Simpan</button>
			</td>
		</tr>
	</table>
	</form>
</div>
</div>


<!-- Daftar Barang -->
<div class="col-md-8">
	<legend>Data Iklan</legend>

	<table id="tableData" class="table table-bordered table-hover">
		<thead>
			<tr>
				<th width="3%"><center>#</center></th>
				<th width="3%"><center>Kategori</center></th>
				<th width="15%"><center>Nama Barang</center></th>
				<th><center>Keterangan</center></th>
				<th width="15%"><center>Foto</center></th>
				<th width="20%"><center>Harga</center></th>
				<th width="8%"><center>Area</center></th>
				<th width="7%"><center>Aksi</center></th>
			</tr>
		</thead>
		<tbody>
		<?php 
			$rs_list=$db->query("SELECT * FROM jual WHERE id_member='".$_SESSION['id_member']."' ORDER BY id_jual DESC");
			$rs_list->setFetchMode(PDO::FETCH_OBJ);
			$no=1;
			while ($index_list=$rs_list->fetch()) {
				
		 ?>
			<tr>
				<td><?php echo $no; ?></td>
				<td><?php echo $index_list->kategori_jual; ?></td>
				<td><?php echo $index_list->nama_barang; ?></td>
				<td><?php echo $index_list->keterangan; ?></td>
				<td><img src="<?php echo "gambar/unggah/".$index_list->foto; ?>" width="100%"></td>
				<td><center>Rp. <?php echo $index_list->harga; ?> ,00</center></td>
				<td><center><?php echo $index_list->regional; ?></center></td>
				<td>
					<center>
						<a class="ed_kat" style="cursor:pointer;" id-jual="<?php echo $index_list->id_jual; ?>"><span class="glyphicon glyphicon-edit"></span></a> | 
						<a href="<?php echo "member.php?page=iklan&hapus=".$index_list->id_jual."&unlink_foto=".$index_list->foto; ?>"><span class="glyphicon glyphicon-trash"></span></a>
					</center>
				</td>
			</tr>
		<?php $no++; } ?>
		</tbody>
	</table>
</div>


<!-- Modal Soal-->
<div class="modal fade modal_edit_iklan" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Iklan</h4>
      </div>
      <div class="modal-body" style="background-color:#E5E5E5;">
      	<div class="sh">
      		
      	</div>
      </div>
      <div class="modal-footer" style="background-color:#E5E5E5;">
      </div>
    </div>
  </div>
</div>
    <script>
        $(function(){
            $(document).on('click','.ed_kat',function(e){
                e.preventDefault();
                $(".modal_edit_iklan").modal('show');
                $.post('page/member/modal_edit_iklan.php',
                    {id:$(this).attr('id-jual')},
                    function(html){
                        $(".sh").html(html);
                    }   
                );
            });
        });
    </script>



</div>