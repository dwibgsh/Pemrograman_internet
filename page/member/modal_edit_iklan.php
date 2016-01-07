<?php
	include '../../koneksi.php';
 	
 	$rs_list=$db->query("SELECT * FROM jual WHERE id_jual='".$_POST['id']."'");
	$rs_list->setFetchMode(PDO::FETCH_OBJ);

	while ($index_list=$rs_list->fetch()) {

      $kategori_jual = $index_list->kategori_jual;
      $nama_barang = $index_list->nama_barang;
      $keterangan = $index_list->keterangan;

      $harga = $index_list->harga;
      $regional = $index_list->regional;
  ?>
  	<div class="col-md-12 row">
  		<div class="col-md-4">
  			<img src="<?php echo "gambar/unggah/".$index_list->foto; ?>" width="100%">
  		</div>
      <div class="col-md-8">
        
<form method="POST" action="page/member/action.php" enctype="multipart/form-data">
  <input type="text" value="<?php echo $index_list->id_member; ?>" name="id_member" class="hide">
  <input type="text" value="<?php echo $index_list->id_jual; ?>" name="id_jual" class="hide">
  <input type="text" value="<?php echo $index_list->foto; ?>" name="unlink_foto" class="hide">
  <table class="table" width="100%">
    <tr>
      <td><label>Kategori</label></td>
      <td><label>:</label></td>
      <td>
        <select class="form-control" name="kategori_jual" required>

        <?php $data = array('Mobil','Motor','Properti','Fashion','Hp','Industri','Hobi','Komputer' );
              $ct = count($data);
              for ($r=0; $r<$ct; $r++ ) {
                if ($kategori_jual==$data[$r]) {
                  echo "<option selected>".$data[$r]."</option>";
                } else {
                ?>
                  <option><?php echo $data[$r]; ?></option>
                <?php }
              }
         ?>
          

        </select>
      </td>
    </tr>
    <tr>
      <td><label>Nama Barang</label></td>
      <td><label>:</label></td>
      <td><input type="text" class="form-control" name="nama_barang" value="<?php echo $nama_barang; ?>" required></td>
    </tr>
    <tr>
      <td><label>Keterangan</label></td>
      <td><label>:</label></td>
      <td><textarea class="form-control" name="keterangan" required><?php echo $keterangan; ?></textarea></td>
    </tr>
    <tr>
      <td><label>Foto</label></td>
      <td><label>:</label></td>
      <td><input type="file" name="data_foto" class="form-control"></td>
    </tr>
    <tr>
      <td><label>Harga</label></td>
      <td><label>:</label></td>
      <td>
        <div class="input-group">
                   <span class="input-group-addon">Rp.</span>
                   <input type="text" class="form-control" name="harga" value="<?php echo $harga; ?>" placeholder="Cth : 100000" required>
                   <span class="input-group-addon">,00</span>
                </div>
      </td>
    </tr>
    <tr>
      <td><label>Area iklan</label></td>
      <td><label>:</label></td>
      <td>
        <select class="form-control" name="regional" required>
          <?php $data2 = array('Tegal','Slawi','Brebes','Pemalang'); 

              $ct2 = count($data2);
              for ($r2=0; $r2<$ct2; $r2++ ) {
                if ($regional==$data2[$r2]) {
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
    <tr>
      <td colspan="3" style="text-align:right;">
        <button class="btn btn-default"  data-dismiss="modal" aria-label="Close" type="reset">Batal</button>
        <button class="btn btn-primary" name="simpan_iklan">Simpan</button>
      </td>
    </tr>
  </table>
  </form>


      </div>
  	</div>

  	<?php } ?>