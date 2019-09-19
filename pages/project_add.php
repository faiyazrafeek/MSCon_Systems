<?php 
session_start();
include('../dist/includes/dbcon.php');
	$id = $_POST['id'];
	$name = $_POST['name'];
	$desc = $_POST['desc'];
	$type = $_POST['type'];
	$sdate = $_POST['sdate'];
	$edate = $_POST['edate'];
	
	$query2=mysqli_query($con,"select * from project where pro_id='$id'")or die(mysqli_error($con));
		$count=mysqli_num_rows($query2);

		if ($count>0)
		{
			echo "<script type='text/javascript'>alert('Project already exist!');</script>";
		}
		else
		{	
			
			mysqli_query($con,"INSERT INTO project(pro_name,pro_desc,pro_type,pro_sdate,pro_edate) 
				VALUES('$name','$desc','$type','$sdate','$edate')")or die(mysqli_error($con));

			$id=mysqli_insert_id($con);
			$_SESSION['cid']=$id;
			echo "<script type='text/javascript'>alert('Successfully added new !');</script>";
			echo "<script>document.location='project.php?cid=$id'</script>";  
		}
?>