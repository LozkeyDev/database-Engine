<?php 
	if (isset($_POST["create_db"])) 
	{
		$host = $_POST["dbhost"];
		$root = $_POST["dbuser"];
		$pass = $_POST["dbpass"];
		$dbname = $_POST["dbname"];

		$dbConn = @mysqli_connect($host,$root,$pass);
		try 
		{
			if(!$dbConn) throw new Exception("Error Connecting to Server...", 1);
			

		} 
		catch (Exception $e) 
		{
			die($e -> getMessage());
		}

		date_default_timezone_set("Africa/Lagos");
		$date = date("d/m/Y:h/i/s");

		$check_db = mysqli_query($dbConn,"SHOW DATABASES LIKE '$dbname'");
		if (mysqli_num_rows($check_db) > 0) 
		{
			$sel_db = mysqli_select_db($dbConn,$dbname);
			echo "Database already Exist";
		}
		else
		{
			// Create a file that will show when a database was created

			$filename = "dbCreation.txt";
			$create_file = fopen($filename, "a");
			$message = "Database " .$dbname." was Created On " .$date."\n\r";
			fwrite($create_file, $message);

			$create = mysqli_query($dbConn,"CREATE DATABASE IF NOT EXISTS $dbname");
			$sel_db = mysqli_select_db($dbConn,$dbname);

			// Enter all the tables that will be in the database here
			mysqli_query($dbConn,"CREATE TABLE `tbl_s` (`id` INT NOT NULL AUTO_INCREMENT , `fname` VARCHAR(20) NOT NULL , `sname` VARCHAR(20) NOT NULL , `gender` VARCHAR(20) NOT NULL , `age` VARCHAR(20) NOT NULL , PRIMARY KEY (`id`))");

			mysqli_query($dbConn,"CREATE TABLE `tbl_cart` (`id` INT NOT NULL AUTO_INCREMENT , `fname` VARCHAR(20) NOT NULL , `sname` VARCHAR(20) NOT NULL , `gender` VARCHAR(20) NOT NULL , `age` VARCHAR(20) NOT NULL , PRIMARY KEY (`id`))");

			mysqli_query($dbConn,"CREATE TABLE `tbl_ship` (`id` INT NOT NULL AUTO_INCREMENT , `fname` VARCHAR(20) NOT NULL , `sname` VARCHAR(20) NOT NULL , `gender` VARCHAR(20) NOT NULL , `age` VARCHAR(20) NOT NULL , PRIMARY KEY (`id`))");

			echo "Database Created Successfully!!!";
		}





	}

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>DB ENGINE</title>
</head>
<body style="">
<form method="post" action="">
	<table>
		<tr>
			<td>HOST</td>
			<td><input type="text" name="dbhost"></td>
		</tr>
		<tr>
			<td>DB USER</td>
			<td><input type="text" name="dbuser"></td>
		</tr>
		<tr>
			<td>DB PASSWORD</td>
			<td><input type="password" name="dbpass"></td>
		</tr>
		<tr>
			<td>DB NAME</td>
			<td><input type="text" name="dbname"></td>
		</tr>
		<tr>
			<td></td>
			<td><button name="create_db">Create Database</button></td>
		</tr>
	</table>

	<!-- Add a new table -->
		<a href="extra_tbl.php"> Add a New table</a>
</form>
</body>
</html>