<?php session_start();
if(empty($_SESSION['id'])):
header('Location:../index.php');
endif;

include('../dist/includes/dbcon.php');
	$id = $_POST['pro_id'];
	$name = $_POST['pro_name'];
	$desc = $_POST['pro_desc'];
	$type = $_POST['pro_type'];
	$sdate = $_POST['pro_sdate'];
	$edate = $_POST['pro_edate'];
	mysqli_query($con,"update project set pro_name='$name',pro_desc='$desc',pro_type='$type',pro_sdate='$sdate',pro_edate='$edate'")or die(mysqli_error($con));
	
	echo "<script type='text/javascript'>alert('Successfully updated Project details!');</script>";
	echo "<script>document.location='project.php'</script>";  

	
?>
