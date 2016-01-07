
<?php 

  $rs=$db->query("SELECT * FROM regional WHERE id_reg='".$_GET['id']."'");
  $rs->setFetchMode(PDO::FETCH_OBJ);
  // $jml=$rs->rowCount();
  while ($index=$rs->fetch()) {
    $reg=$index->regional;

 ?>

 <ol class="breadcrumb">
  <li><a href="index.php">Home</a></li>
  <li><a href="<?php echo "index.php?page=regional&id=".$_GET['id']; ?>"><?php echo $index->regional; ?></a></li>
</ol>
<?php } ?>


<div class="panel panel-default" style="">
  <div class="panel-body">
  <legend><center>PILIH KATEGORI BARANG</center></legend>
  <!-- Baris 1  -->
    <div class="col-md-12">
      <div class="row">
        <div class="col-md-3 kategori">
          <center>
            <a href="<?php echo "index.php?page=jualan&id=".$_GET['id']."&kategori=mobil&reg=".$reg; ?>" >
              <img src="gambar/mobil.PNG">
              <br> <strong>Mobil</strong>
            </a>
          </center>
        </div>        
        
        <div class="col-md-3 kategori">
          <center>
            <a href="<?php echo "index.php?page=jualan&id=".$_GET['id']."&kategori=motor&reg=".$reg; ?>" >
                <img src="gambar/motor.PNG">
                <br> <strong>Motor</strong>
            </a>
          </center>
        </div>

        <div class="col-md-3 kategori">
          <center>
            <a href="<?php echo "index.php?page=jualan&id=".$_GET['id']."&kategori=properti&reg=".$reg; ?>" >
                <img src="gambar/properti.PNG">
                <br> <strong>Properti</strong>
            </a>
          </center>
        </div>

        <div class="col-md-3 kategori">
          <center>
            <a href="<?php echo "index.php?page=jualan&id=".$_GET['id']."&kategori=fashion&reg=".$reg; ?>" >
                <img src="gambar/fashion.PNG">
                <br> <strong>Fashion</strong>
            </a>
          </center>
        </div>
        
</div></div>
<!-- Penutup bari 1 -->

<!-- Baris keloro -->
<div class="col-md-12" style="">
<div class="row">
<hr>
        <div class="col-md-3 kategori" >
          <center>
            <a href="<?php echo "index.php?page=jualan&id=".$_GET['id']."&kategori=hp&reg=".$reg; ?>" >
              <img src="gambar/gadget.PNG">
              <br> <strong>HP</strong>
            </a>
          </center>
        </div>
       <div class="col-md-3 kategori" >
        <center>
          <a href="<?php echo "index.php?page=jualan&id=".$_GET['id']."&kategori=industri&reg=".$reg; ?>" >
          <img src="gambar/industri.PNG">
          <br><strong>Industri</strong>
          </a>
        </center>
      </div>
    <div class="col-md-3 kategori" >
    <center>
      <a href="<?php echo "index.php?page=jualan&id=".$_GET['id']."&kategori=hobi&reg=".$reg; ?>" >
        <img src="gambar/hobi.PNG">
      <br><strong>Hobi</strong> 
      </a>
  </center>
    </div>
<div class="col-md-3 kategori" >
<center>
    <a href="<?php echo "index.php?page=jualan&id=".$_GET['id']."&kategori=komputer&reg=".$reg; ?>">
        <img src="gambar/komputer.PNG" width="25%">
        <br><strong>Komputer</strong>
       </a>
       </center>
    </div>
 

      </div>
    </div>
<!-- Penutup Bari Ke 2 -->

  </div>
</div> 
