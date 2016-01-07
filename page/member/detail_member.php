<div class="container">
	






<?php 
	$rs= $db->query("SELECT a.*,b.nama,b.telp FROM telabelang.jual a LEFT JOIN telabelang.member b ON (a.id_member = b.id_member) 
		WHERE a.id_member='".$_GET['mm']."' AND b.id_member='".$_GET['mm']."' AND a.id_jual='".$_GET['jl']."'");

	$rs->setFetchMode(PDO::FETCH_OBJ);
	$index_jual=$rs->fetch();

 ?>
<style type="text/css">
.harga {
	border-bottom-left-radius:25px;
	border-bottom-right-radius:25px;
	text-align:center;
	background-color:rgb(241, 246, 48);
	padding:7px;font-size:1.5em;
}

</style>

<ol class="breadcrumb">
  <li><a href="member.php">Home</a></li>
  <li><a href="<?php echo "member.php?page=regional_member&id=".$_GET['id']; ?>"><?php echo $index_jual->regional; ?></a></li>
  <li><a href="<?php echo "member.php?page=jualan_member&id=".$_GET['id']."&kategori=".$index_jual->kategori_jual."&reg=".$index_jual->regional; ?>"><?php echo $index_jual->kategori_jual; ?></a></li>
  <li><a href=""><?php echo $index_jual->nama_barang; ?></a></li>
</ol>

 <div class="col-md-8">
 	<div class="panel panel-default">
 		<div class="panel-body">
 			<legend><?php echo $index_jual->nama_barang; ?></legend>

 			<div class="col-md-12">
 				<div class="row">
 					<div class="col-md-8">
 						<p class="help-block"><?php echo "<span class='glyphicon glyphicon-ok-circle' style='padding-right:5px;'></span> Regional : ".$index_jual->regional." <span class='glyphicon glyphicon-earphone' style='padding-left:15px;padding-right:5px;'></span> Telp / Hp : ".$index_jual->telp; ?></p>
 					</div>
 					<div class="col-md-4 harga">
			 				Rp. <?php echo $index_jual->harga; ?> .00
 					</div>
 				</div>
 			</div>
 		
 			
 				
			<img src="<?php echo "gambar/unggah/".$index_jual->foto; ?>" width="100%">
 			
 			<p>
 				<?php echo $index_jual->keterangan; ?>
 			</p>
 		</div>
 		
 	</div>
 </div>

<?php 
	
	$rs2 = $db->query("SELECT * FROM jual 
		WHERE regional ='".$index_jual->regional."' AND kategori_jual='".$index_jual->kategori_jual."'
		ORDER BY RAND() LIMIT 0,4
		");
	$rs2->setFetchMode(PDO::FETCH_OBJ);


 ?>

 <div class="col-md-4">
 	<legend><center>Lihat Iklan <?php echo $index_jual->regional; ?></center></legend>

<?php 	while ($index_area = $rs2->fetch()) { ?>
 	<div class="panel panel-default">
 		<div class="panel-body">
 			<table class="table">
 				<tr>
 					<td width="40%"><img src="<?php echo "gambar/unggah/".$index_area->foto; ?>" width="100%"></td>
 					<td>
 						<a href="<?php echo "member.php?page=detail_member&id=".$_GET['id']."&jl=".$index_area->id_jual."&mm=".$index_area->id_member; ?>"><?php echo $index_area->nama_barang; ?></a>
 						<br>
 						<p class="label label-danger">Rp. <?php echo $index_area->harga; ?> ,00</p>

 					</td>
 				</tr>
 			</table>
 		</div>
 	</div>
<?php } ?>

 </div>




</div>