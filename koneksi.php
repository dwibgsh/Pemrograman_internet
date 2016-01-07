<?php

	try {
		$db = new PDO('mysql:host=localhost;dbname=telabelang','root','');
		 // echo "Konek";
    

	} catch (PDOException $er){
		echo $er->getMessage();
	}

?>