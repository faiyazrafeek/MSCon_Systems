<?php 
session_start();
$branch=$_SESSION['branch'];
include('../dist/includes/dbcon.php');

	$name = $_POST['prod_name'];
	$price = $_POST['prod_price'];
	$qty = $_POST['prod_qty'];
	$desc = $_POST['prod_desc'];
	$category = $_POST['category'];
	$warehouse = $_POST['warehouse'];
	$serial = $_POST['serial'];
	
	$query2=mysqli_query($con,"select * from product where prod_name='$name' and branch_id='$branch'")or die(mysqli_error($con));
		$count=mysqli_num_rows($query2);

		if ($count>0)
		{
			echo "<script type='text/javascript'>alert('Item already exist!');</script>";
			echo "<script>document.location='item.php'</script>";  
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

			mysqli_query($con,"INSERT INTO product(prod_name,prod_price,prod_qty,prod_desc,prod_pic,cat_id,warehouse,branch_id,serial)
			VALUES('$name','$price','$qty','$desc','$pic','$category','$warehouse','$branch','$serial')")or die(mysqli_error($con));

			echo "<script type='text/javascript'>alert('Successfully added new item!');</script>";
					  echo "<script>document.location='item.php'</script>";  
		}
?>