<?php 
session_start();
include('../dist/includes/dbcon.php');
	$branch=$_SESSION['branch'];
	$name = $_POST['name'];
	$desc = $_POST['desc'];
	$address = $_POST['address'];
	$contact = $_POST['contact'];
	
	$query2=mysqli_query($con,"select * from customer where cust_desc='$desc' and cust_name='$name' and branch_id='$branch'")or die(mysqli_error($con));
		$count=mysqli_num_rows($query2);

		if ($count>0)
		{
			echo "<script type='text/javascript'>alert('Vendor already exist!');</script>";
			echo "<script>document.location='vendor_new.php'</script>";  
		}
		else
		{	
			
			mysqli_query($con,"INSERT INTO customer(cust_name,cust_desc,cust_address,cust_contact,branch_id) 
				VALUES('$name','$desc','$address','$contact','$branch')")or die(mysqli_error($con));

			$id=mysqli_insert_id($con);
			//$_SESSION['cid']=$id;
			//echo "<script type='text/javascript'>alert('Successfully added new vendor!');</script>";
			echo "<script>document.location='vendor.php?cid=$id'</script>";  
		}
?>