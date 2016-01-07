<div class="container">
	


<?php 

  $rs=$db->query("SELECT * FROM regional WHERE id_reg='".$_GET['id']."'");
  $rs->setFetchMode(PDO::FETCH_OBJ);
  // $jml=$rs->rowCount();
  while ($index=$rs->fetch()) {
 ?>

<ol class="breadcrumb">
  <li><a href="member.php?page=home_member">Home</a></li>
  <li><a href="<?php echo "member.php?page=regional_member&id=".$_GET['id']; ?>"><?php echo $index->regional; ?></a></li>
  <li><a href=""><?php echo $_GET['kategori']; ?></a></li>
</ol>
<?php } ?>


<div class="col-md-12">
	<table class="table table-hover" id="tableData">
		<thead>
			<tr>
				<th width="3%"><center>No</center></th>
				<th width="10%">Tanggal</th>
				<th colspan="2">Barang</th>
				<th width="17%">Harga</th>
			</tr>
		</thead>
		<tbody>
			<?php 

				$rs_jualan=$db->query("SELECT * FROM telabelang.jual WHERE 
					 regional LIKE '".$_GET['reg']."' AND kategori_jual LIKE '".$_GET['kategori']."' ");

  				$rs_jualan->setFetchMode(PDO::FETCH_OBJ);
  				$no=1;
  				while ($index_jual=$rs_jualan->fetch()) {
  					
				?>
				<tr>
					<td><center><?php echo $no++; ?></center></td>
					<td>31 Des 2015</td>
					<td width="10%">
						<img src="<?php echo "gambar/unggah/".$index_jual->foto; ?>"  width="100%">
					</td>
					<td>
						<strong><a href="<?php echo "member.php?page=detail_member&id=".$_GET['id']."&jl=".$index_jual->id_jual."&mm=".$index_jual->id_member; ?>"><?php echo $index_jual->nama_barang; ?></a></strong>
						 <p class="help-block"><?php echo $index_jual->keterangan; ?></p>
					</td>
					<td>
						Rp. <?php echo $index_jual->harga; ?>,00
					</td>
				</tr>
				<?php
			} ?>
		</tbody>
	</table>	
</div>


</div>