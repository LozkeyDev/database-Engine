<?php 
	
		$host= "localhost";
		$user = "root";
		$pass = "";
		// $db ="segun";

		$conn = @mysqli_connect($host,$user,$pass);
		try
		{
			if(!$conn) throw new Exception("Server Not Found", 1);
			
		}
		catch(Exception $e)
		{
			die($e-> getMessage());
		}
		


		date_default_timezone_set("Africa/Lagos");

	if(isset($_POST["upload_file"]))
	{
		$date = date("h:i:s");
		echo $date;
		$dbname = $_POST["dbname"];
		if(!mysqli_select_db($conn,$dbname))
		{
			echo "Database Not found!!!";
		}
		else
		{
		$file_to_upload = $_FILES["file_to_upload"]["tmp_name"];
		if($_FILES["file_to_upload"]["size"] > 0)
		{
			$file = fopen($file_to_upload, "r");

			while(($getData = fgetcsv($file)) !== FALSE ) 
			{
				$sql = mysqli_query($conn,"INSERT INTO student_db(name,matric,level) VALUES('".$getData[0]."','".$getData[1]."')");

				if(!isset($sql))
				{
					echo "Invalid File: Please Upload CSV file";
				}
				else
				{
					echo "File has been uploaded successfully";
				}
			}
			fclose($file);
		}
	}
	}
 ?>


 <!DOCTYPE html>
 <html>
 <head>
 	<title>CSV</title>
 </head>
 <body>
 	<form action="" method="post" enctype="multipart/form-data">
 		 	<h2>Form name </h2>
 			<label>Database Name</label>
 			<input type="text" name="dbname"> <br><br>
 			<label>Select File</label>
 			<input type="file" name="file_to_upload" accept=".csv"> <br><br>

 			<label>Import Data</label>
 			<input type="submit" value="Upload" name="upload_file"> 

 		</fieldset>
 	</form>
 </body>
 </html>