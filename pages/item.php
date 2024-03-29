<?php session_start();
if(empty($_SESSION['id'])):
header('Location:../index.php');
endif;
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Inventory | <?php include('../dist/includes/title.php');?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
    <style>
      
    </style>
 </head>
  <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
  <body class="hold-transition skin-<?php echo $_SESSION['skin'];?> layout-top-nav">
    <div class="wrapper">
      <?php include('../dist/includes/header.php');?>
      <!-- Full Width Column -->
      <div class="content-wrapper">
        <div class="container">
          <!-- Content Header (Page header) -->
          <section class="content-header">
            <h1>
              <a class="btn btn-lg btn-warning" href="home.php">Back</a>
              <a class="btn btn-lg btn-primary" href="#add" data-target="#add" data-toggle="modal" style="color:#fff;" class="small-box-footer"><i class="glyphicon glyphicon-plus text-blue"></i></a>
            </h1>
            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="active">Inventory</li>
            </ol>
          </section>

          <!-- Main content -->
          <section class="content">
            <div class="row">
	     
            
            <div class="col-xs-12">
              <div class="box box-primary">
    
                <div class="box-header">
                  <h3 class="box-title">Inventory List</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                      	<th>Picture</th>
                        <th>Item Code</th>
                        <th>Item Name</th>
                        <th>Description</th>
						            <th>Qty</th>
            						<th>Price</th>
            						<th>Unit</th>
            						<th>Warehouse</th>
            						<th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
<?php		
		$query=mysqli_query($con,"select * from product natural join category where branch_id='$branch' order by prod_name")or die(mysqli_error());
		while($row=mysqli_fetch_array($query)){
		
?>
                      <tr>
                      	<td><img style="width:80px;height:60px" src="../dist/uploads/<?php echo $row['prod_pic'];?>"></td>
                        <td><?php echo $row['serial'];?></td>
                        <td><?php echo $row['prod_name'];?></td>
                        <td><?php echo $row['prod_desc'];?></td>						       
                        <td><?php echo $row['prod_qty'];?></td>
            			<td><?php echo number_format($row['prod_price'],2);?></td>
            			<td><?php echo $row['cat_name'];?></td>
            			<td><?php echo $row['warehouse'];?></td>
     
                        <td>
				<a href="#updateordinance<?php echo $row['prod_id'];?>" data-target="#updateordinance<?php echo $row['prod_id'];?>" data-toggle="modal" style="color:#fff;" class="small-box-footer"><i class="glyphicon glyphicon-edit text-blue"></i></a>
			
						</td>
                      </tr>
<div id="updateordinance<?php echo $row['prod_id'];?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
	  <div class="modal-content" style="height:auto">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Update Item Details</h4>
              </div>
              <div class="modal-body">
			  <form class="form-horizontal" method="post" action="item_update.php" enctype='multipart/form-data'>
        <div class="form-group">
          <label class="control-label col-lg-3" for="price">Item Code</label>
          <div class="col-lg-9">
            <input type="text" class="form-control" id="price" name="serial" value="<?php echo $row['serial'];?>" required>  
          </div>
        </div>
                
				<div class="form-group">
					<label class="control-label col-lg-3" for="name">Item Name</label>
					<div class="col-lg-9"><input type="hidden" class="form-control" id="id" name="id" value="<?php echo $row['prod_id'];?>" required>  
					  <input type="text" class="form-control" id="name" name="prod_name" value="<?php echo $row['prod_name'];?>" required>  
					</div>
				</div> 
        <div class="form-group">
          <label class="control-label col-lg-3" for="name">Description</label>
          <div class="col-lg-9">
            <input type="text" class="form-control" id="name" name="desc" value="<?php echo $row['prod_desc'];?>" required>  
          </div>
        </div> 
				
				
				<div class="form-group">
					<label class="control-label col-lg-3" for="price">Price</label>
					<div class="col-lg-9">
					  <input type="text" class="form-control" id="price`" name="prod_price" value="<?php echo $row['prod_price'];?>" required>  
					</div>
				</div>
				
				<div class="form-group">
					<label class="control-label col-lg-3" for="price">Qty</label>
					<div class="col-lg-9">
					  <input type="text" class="form-control" id="qty" name="prod_qty" value="<?php echo $row['prod_qty'];?>" required>  
					</div>
				</div>
				
				<div class="form-group">
							<label class="control-label col-lg-3" >Unit</label>
							<div class="col-lg-9">
							  <select class="form-control select2" style="width: 100%;" name="category" required>
              <option value="<?php echo $row['cat_id'];?>"><?php echo $row['cat_name'];?></option>
                <?php
            
              $queryc=mysqli_query($con,"select * from category order by cat_name")or die(mysqli_error());
                while($rowc=mysqli_fetch_array($queryc)){
                ?>
                  <option value="<?php echo $rowc['cat_id'];?>"><?php echo $rowc['cat_name'];?></option>
                <?php }?>
              </select>
							</div><!-- /.input group -->
						  </div><!-- /.form group -->
						  
						 <div class="form-group">
					<label class="control-label col-lg-3" for="price">Warehouse</label>
					<div class="col-lg-9">
					  <input type="text" class="form-control" id="warehouse" name="warehouse" value="<?php echo $row['warehouse'];?>" required>  
					</div>
				</div>
						
				<div class="form-group">
					<label class="control-label col-lg-3" for="price">Picture</label>
					<div class="col-lg-9">
					  <input type="hidden" class="form-control" id="price" name="image1" value="<?php echo $row['prod_pic'];?>"> 
					  <input type="file" class="form-control" id="price" name="image">  
					</div>
				</div>
              </div><br><br><br><br><br><br><br>
              <div class="modal-footer">
		<button type="submit" class="btn btn-primary">Save changes</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
			  </form>
            </div>
			
        </div><!--end of modal-dialog-->
 </div>
 <!--end of modal-->                    
<?php }?>					  
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
 
            </div><!-- /.col -->
			
			
          </div><!-- /.row -->
	  
            
          </section><!-- /.content -->
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->
      <?php include('../dist/includes/footer.php');?>
    </div><!-- ./wrapper -->
<div id="add" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content" style="height:auto">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Add New Item</h4>
              </div>
              <div class="modal-body">
        <form class="form-horizontal" method="post" action="item_add.php" enctype='multipart/form-data'>
        <div class="form-group">
          <label class="control-label col-lg-3" for="price">Item Code</label>
          <div class="col-lg-9">
            <input type="text" class="form-control" id="price" name="serial" placeholder="Item Code" required>  
          </div>
        </div>
                
        <div class="form-group">
          <label class="control-label col-lg-3" for="name">Name</label>
          <div class="col-lg-9"><input type="hidden" class="form-control" id="id" name="id" required>  
            <input type="text" class="form-control" id="name" name="prod_name" placeholder="Item Name" required>  
          </div>
        </div> 
        <div class="form-group">
          <label class="control-label col-lg-3" for="price">Description</label>
          <div class="col-lg-9">
            <textarea class="form-control" id="price" name="prod_desc" placeholder="Item Description"></textarea>  
          </div>
        </div>
       
        
        <div class="form-group">
          <label class="control-label col-lg-3" for="price">Price</label>
          <div class="col-lg-9">
            <input type="text" class="form-control" id="price" name="prod_price" placeholder="Item Price" required>  
          </div>
        </div>
        
		 <div class="form-group">
          <label class="control-label col-lg-3" for="price">Qty</label>
          <div class="col-lg-9">
            <input type="text" class="form-control" id="qty" name="prod_qty" placeholder="Qty" required>  
          </div>
        </div>
		
        <div class="form-group">
              <label class="control-label col-lg-3" >Unit</label>
              <div class="col-lg-9">
                <select class="form-control select2" style="width: 100%;" name="category" required>
              
                <?php
            
              $queryc=mysqli_query($con,"select * from category order by cat_name")or die(mysqli_error());
                while($rowc=mysqli_fetch_array($queryc)){
                ?>
                  <option value="<?php echo $rowc['cat_id'];?>"><?php echo $rowc['cat_name'];?></option>
                <?php }?>
              </select>
              </div><!-- /.input group -->
              </div><!-- /.form group -->
        
		 <div class="form-group">
          <label class="control-label col-lg-3" for="price">Warehouse</label>
          <div class="col-lg-9">
            <input type="text" class="form-control" id="warehouse" name="warehouse" placeholder="Warehouse" required>  
          </div>
        </div>
		
        <div class="form-group">
          <label class="control-label col-lg-3" for="price">Picture</label>
          <div class="col-lg-9">
            <input type="file" class="form-control" id="price" name="image">  
          </div>
        </div>
              </div>
              <div class="modal-footer">
    <button type="submit" class="btn btn-primary">Save Item</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
        </form>
            </div>
      
        </div><!--end of modal-dialog-->
 </div>
 <!--end of modal--> 
    <!-- jQuery 2.1.4 -->
    <script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="../plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js"></script>
    <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>
    
    <script>
      $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
      });
    </script>
  </body>
</html>