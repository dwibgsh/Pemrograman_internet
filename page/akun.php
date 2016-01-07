<?php 
	
	if (isset($_POST['login'])) {
		$pass = md5($_POST['password']);
		$rs_login = $db->query("SELECT * FROM member WHERE email LIKE '".$_POST['email']."' AND password = '".$pass."'");
		$rs_login->setFetchMode(PDO::FETCH_OBJ);

		if ($jml=$rs_login->rowCount()!=0) {
			$index_login=$rs_login->fetch();
			$_SESSION['email']=$index_login->email;
			$_SESSION['password']=$index_login->password;
			$_SESSION['id_member']=$index_login->id_member;
			echo "<script>
				window.location.href='member.php';
			  </script>";


		} else {
			echo "<script>
				alert('E-mail atau Password salah !!');
			  </script>";
			//header('location:index.php?page=akun');
		}
	}

 ?>

 <ol class="breadcrumb">
  <li><a href="index.php?page=akun">Akun saya</a></li>
</ol>

<div class="col-md-4"></div>
<div class="col-md-4">
	<h3>Login Sistem</h3>
	<form method="POST" action="">
	<table class="table">
		<tr>
			<td><label>E - mail</label></td>
			<td><label>:</label></td>
			<td><input type="email" class="form-control" placeholder="Masukan e-mail" name="email" required></td>
		</tr>
		<tr>
			<td><label>Password</label></td>
			<td><label>:</label></td>
			<td><input type="password" class="form-control" placeholder="Masukan password" name="password" required></td>
		</tr>
		<tr>
			<td colspan="3" style="text-align:right;">
				<button type="reset" class="btn btn-default">Batal</button>
				<button class="btn btn-primary" name="login">Masuk</button>
			</td>
		</tr>
	</table>
	</form>
	<hr>
	<center>
		<strong style="color:blue;">Belum punya akun ? --> </strong><button class="btn btn-danger btn-sm"  data-toggle="modal" data-target="#myModal">Registrasi</button>
	</center>
</div>



<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Form Registrasi</h4>
      </div>
      <div class="modal-body">
      <form method="POST" action="action/modal_akun.php">
        <table class="table">
        	<tr>
        		<td><label>Nama</label></td>
        		<td><label>:</label></td>
        		<td><input type="text" class="form-control" name="nama"></td>
        	</tr>
        	<tr>
        		<td><label>Telpone / Hp</label></td>
        		<td><label>:</label></td>
        		<td><input type="text" class="form-control" name="telp"></td>
        	</tr>
        	<tr>
        		<td><label>Alamat</label></td>
        		<td><label>:</label></td>
        		<td><textarea class="form-control" name="alamat"></textarea></td>
        	</tr>
        	<tr>
        		<td><label>E-mail</label></td>
        		<td><label>:</label></td>
        		<td><input type="email" class="form-control" name="email"></td>
        	</tr>
        	<tr>
        		<td><label>Regional</label></td>
        		<td><label>:</label></td>
        		<td>
        			<select class="form-control" name="regional">
        				<option>Tegal</option>
        				<option>Slawi</option>
        				<option>Brebes</option>
        				<option>Pemalang</option>
        			</select>
        		</td>
        	</tr>
        	<tr>
        		<td><label>Password</label></td>
        		<td><label>:</label></td>
        		<td><input type="password" class="form-control" name="password"></td>
        	</tr>
        </table>
        
      </div>
      <div class="modal-footer">
        <button type="reset" class="btn btn-default" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-danger" name="insert_reg">Registrasi</button>
      </div>
	</form>
    </div>
  </div>
</div>