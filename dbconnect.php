<?php

	 $DBhost = "localhost";
	 $DBuser = "root";
	 $DBpass = "";
	 $DBname = "project";
     $url = 'http://localhost:7080/Project/index.php';
	 
	 $DBcon = new MySQLi($DBhost,$DBuser,$DBpass,$DBname);
    
	if ($DBcon->connect_errno) {
		die("ERROR : -> ".$DBcon->connect_error);
	}
?>