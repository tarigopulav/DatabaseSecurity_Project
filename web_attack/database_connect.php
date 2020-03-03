<?php 

	$server_name = "localhost";
	$server_user_name = "root";
	$server_password = "";
				
	try{
		$conn = new PDO("mysql:host=$server_name;dbname=web_attack",$server_user_name,$server_password);
		$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
					
		}catch(PDOException $e){
			echo "Could not connect to the database." . $e->getMessage();
		}

?>