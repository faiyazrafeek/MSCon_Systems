<?php 
session_start();
$branch=$_SESSION['branch'];
include('../dist/includes/dbcon.php');

	$name = $_POST['lib_name'];
	$desc = $_POST['lib_desc'];
	$category = $_POST['category'];

	
	$query2=mysqli_query($con,"select * from library where lib_name='$name'")or die(mysqli_error($con));
		$count=mysqli_num_rows($query2);

		if ($count>0)
		{
			echo "<script type='text/javascript'>alert('Materil already exist!');</script>";
			echo "<script>document.location='library.php'</script>";  
		}
		else
		{	

			$pic = $_FILES["image"]["name"];
			if ($pic=="")
			{
				$pic="default.gif";
			}
			else
			{
				$pic = $_FILES["image"]["name"];
				$type = $_FILES["image"]["type"];
				$size = $_FILES["image"]["size"];
				$temp = $_FILES["image"]["tmp_name"];
				$error = $_FILES["image"]["error"];
			
				if ($error > 0){
					die("Error uploading file! Code $error.");
					}
				else{
					if($size > 100000000000) //conditions for the file
						{
						die("Format is not allowed or file size is too big!");
						}
				else
				      {
					move_uploaded_file($temp, "../dist/uploads/".$pic);
				      }
					}
			}	

			mysqli_query($con,"INSERT INTO library(lib_name,lib_desc,lib_pic,cat_id)
			VALUES('$name','$desc','$pic','$category')")or die(mysqli_error($con));

			echo "<script type='text/javascript'>alert('Successfully added new material!');</script>";
					  echo "<script>document.location='library.php'</script>";  
		}
?>