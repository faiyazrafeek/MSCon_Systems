<?php session_start();
if(empty($_SESSION['id'])):
header('Location:../index.php');
endif;

include('../dist/includes/dbcon.php');
	$id = $_POST['id'];
	$amount = $_POST['amount'];
	$towhom = $_POST['towhom'];
	$purpose = $_POST['purpose'];
	
	mysqli_query($con,"update stockin set amount='$amount',towhom='$towhom',purpose='$purpose' where stockin_id='$id'")or die(mysqli_error());
	
	echo "<script>document.location='stockin.php'</script>";  

	
?>
