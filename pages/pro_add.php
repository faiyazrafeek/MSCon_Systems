<?php 
session_start();
$branch=$_SESSION['branch'];
include('../dist/includes/dbcon.php');

	$name =$_POST['name'];
	$desc =$_POST['desc'];
	$sector = $_POST['sector'];
	$sdate = $_POST['sdate'];
	$edate = $_POST['edate'];

	
	$query2=mysqli_query($con,"select * from project where pro_name='$name'")or die(mysqli_error($con));
		$count=mysqli_num_rows($query2);

		if ($count>0)
		{
			echo "<script type='text/javascript'>alert('Project already exist!');</script>";
			echo "<script>document.location='library.php'</script>";  
		}
		else
		{	


			mysqli_query($con,"INSERT INTO project(pro_name,pro_desc,pro_sector,pro_sdate,pro_edate)
			VALUES('$name','$desc','$sector','$sdate','$edate')")or die(mysqli_error($con));

			echo "<script type='text/javascript'>alert('Successfully added new Project!');</script>";
					  echo "<script>document.location='project.php'</script>";  
		}
?>