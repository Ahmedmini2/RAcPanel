<?php



try {
  	$WebDB = new PDO("mysql:host=localhost;Database=ruknam5_app",'ruknam5_root','Roek9933@');
  	$WebDB->exec("SET CHARACTER SET utf8");
  	$WebDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 	}
catch(PDOException $WebDB_Exception) 
	{
  		echo "Connection to Creatives Database failed:<br> " . $WebDB_Exception->getMessage();
	}
?>