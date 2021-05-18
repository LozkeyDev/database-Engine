<?php 
	if(isset($_POST["create_table"]))
	{
		$host = "localhost";
		$user = "root";
		$pass = "";
		$dbName = $_POST["dbname"];
		$new_table = $_POST['new_table'];

		$dbConn = @mysqli_connect($host,$user,$pass);

		try 
		{
			if (!$dbConn) throw new Exception("Error Connecting to Server!!!", 1);
			
		} 
		catch (Exception $e) 
		{
			die($e->getMessage());
		}

		$chk_db = mysqli_query($dbConn,"SHOW DATABASES LIKE '$dbName'");
		if(mysqli_num_rows($chk_db) > 0)
		{
			$sel_db = mysqli_select_db($dbConn,$dbName);

			mysqli_query($dbConn,"$new_table");

			echo "Table Successfully Created";
		}
		else
		{
			echo 'Database Doesnt Exist';
		}

	}

 ?>


<!DOCTYPE html>
<html>
<head>
	<title>New table</title>
</head>
<body>
	<form method="post" action="">
	<table>
		<tr>
			<td>DB NAME</td>
			<td><input type="text" name="dbname"></td>
		</tr>
		<tr>
			<td>NEW TABLE</td>
		<td><textarea name="new_table"></textarea></td>
		</tr>
		<tr>
			<td></td>
			<td><button name="create_table">Create Table</button></td>
		</tr>
	</table>
</form>
</body>
</html>