<?php



require("logFile/dbConnection.php");

		$sql = "CREATE TABLE sample(
			name varchar(50),
			address varchar(200)
		);";
		mysqli_query($object->connection,$sql);
	



?>