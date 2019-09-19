<?php 
session_start();
include('../dist/includes/dbcon.php');
	$branch=$_SESSION['branch'];
	$name = $_POST['prod_name'];
	$amount = $_POST['amount'];
	$towhom = $_POST['towhom'];
	$purpose = $_POST['purpose'];
	
	date_default_timezone_set('Asia/Manila');

	$date = date("Y-m-d H:i:s");
	$id=$_SESSION['id'];
	
	$query=mysqli_query($con,"select prod_name from product where prod_id='$name'")or die(mysqli_error());
  
        $row=mysqli_fetch_array($query);
		$product=$row['prod_name'];
	$remarks="added $qty of $product";  
	
		mysqli_query($con,"INSERT INTO history_log(user_id,action,date) VALUES('$id','$remarks','$date')")or die(mysqli_error($con));
		
		
		
			mysqli_query($con,"INSERT INTO stockin(prod_id,amount,towhom,purpose,date,branch_id) VALUES('$name','$amount','$towhom','$purpose','$date','$branch')")or die(mysqli_error($con));

			echo "<script type='text/javascript'>alert('Successfully added new payment!');</script>";
					  echo "<script>document.location='paid.php'</script>";  
	
?>