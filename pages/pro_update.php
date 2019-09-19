<?php session_start();
if(empty($_SESSION['id'])):
header('Location:../index.php');
endif;

include('../dist/includes/dbcon.php');
	$id = $_POST['id'];
	$name =$_POST['pro_name'];
	$desc =$_POST['pro_desc'];
	$sector = $_POST['pro_sector'];
	$sdate = $_POST['pro_sdate'];
	$edate = $_POST['pro_edate'];
	
				
	mysqli_query($con,"update project set pro_name='$name', pro_desc='$desc', pro_sector='$sector', pro_sdate='$sdate', pro_edate='$edate' where pro_id='$id'")or die(mysqli_error($con));
	
	echo "<script type='text/javascript'>alert('Successfully updated Project details!');</script>";
	echo "<script>document.location='project.php'</script>";  

	
?>
