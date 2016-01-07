<?php 
  session_start();
  include'koneksi.php';

  if (isset($_SESSION['email']) && isset($_SESSION['password'])) {
  } else {
    header('location:index.php?page=akun');
  }


  if (isset($_GET['keluar'])) {
    // remove all session variables
    session_unset();
    // destroy the session
    session_destroy();
    echo "<script>
        alert('Keluar !!');
          window.location.href='index.php';
        </script>"; 
  }
 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>TelaBelang</title>

    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="bootstrap/js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </head>
  <style type="text/css">
    .navbar-default .navbar-nav > .open > a, .navbar-default .navbar-nav > .open > a:focus, .navbar-default .navbar-nav > .open > a:hover {
      color: #fff;
      background-color: #183B6B;
    }

    .navbar-nav li:hover {
      background-color: #183B6B;
    }


.paging-nav {
  text-align: right;
  padding-top: 2px;
}

.paging-nav a {
  margin: auto 1px;
  text-decoration: none;
  display: inline-block;
  padding: 1px 7px;
  background: #91b9e6;
  color: white;
  border-radius: 3px;
}

.paging-nav .selected-page {
  background: #187ed5;
  font-weight: bold;
}

  </style>
  <body>

    <nav class="navbar navbar-default" style="background-color:#194581">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="member.php?page=home_member" style="color:#fff;">TelaBelang</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <!-- <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
        <li><a href="#">Link</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>
      </ul>-->
      <ul class="nav navbar-nav">
        <!-- <li><a href="member.php" style="color:#fff;"><span class="glyphicon glyphicon-home"></span> Beranda</a></li> -->
        <li><a href="member.php?page=iklan" style="color:#fff;"><span class="glyphicon glyphicon-shopping-cart"></span> Pasang iklan</a></li>
        <li><a href="member.php?page=profil" style="color:#fff;"><span class="glyphicon glyphicon-user"></span> Profil</a></li>
        <li><a href="member.php?keluar=oke" style="color:#fff;"><span class="glyphicon glyphicon-log-out"></span> Keluar</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<div class="">
  <?php 
    if(empty($_GET['page'])){
        include("page/member/iklan.php");
      } 
      else {
        $page=$_GET['page'];

        $file= "page/member/$page.php";
        if(file_exists($file)){
          include("page/member/$page.php");
        }
        else {
          include("page/member/iklan.php");
        }
      }

  ?>
</div>

<script src="bootstrap/paging/jquery-ui.min.js"></script>
  <script type="text/javascript" src="bootstrap/paging/paging.js"></script> 
  <script type="text/javascript">
              $(document).ready(function() {
                  $('#tableData').paging({limit:3});
              });
          </script>

  </body>
</html>