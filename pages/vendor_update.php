<?php session_start();
if(empty($_SESSION['id'])):
header('Location:../index.php');
endif;

include('../dist/includes/dbcon.php');
	$id = $_POST['id'];
	$last =$_POST['last'];
	$first =$_POST['first'];
	$address = $_POST['address'];
	$contact = $_POST['contact'];
	mysqli_query($con,"update customer set cust_name='$first',cust_desc='$last',cust_address='$address',cust_contact='$contact' where cust_id='$id'")or die(mysqli_error());
	
	echo "<script type='text/javascript'>alert('Successfully updated vendor details!');</script>";
	echo "<script>document.location='vendor.php'</script>";  

	
?>
