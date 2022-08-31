<?php
include_once 'products_crud.php';
include_once 'logged_in.php';
include_once 'database.php';

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Boy Apparel Co : Products</title>
  <!-- Bootstrap -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

  <link rel="styleheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap.min.css">
  <link rel="styleheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="/DataTables/datatables.css">

  <script type="text/javascript" src="https://code.jquery"></script>
  <script type="text/javascript" charset="utf8" src="/DataTables/datatables.js"></script>
  
  
  <!-- Modal Script -->
  <script type="text/javascript">
    function openModal(cpid) {
      $('.modal-body').load('products_details.php?pid=' + cpid, function() {
        $('#myModal').modal({
          show: true
        });
      });
    }
  </script>

  <style>
    body {
      background-image: url(pictures/mainbg.jpg);

      /* Center and scale the image nicely */
      background-position: center;
      background-repeat: no-repeat;

    }
  </style>

</head>

<body>

  <?php include_once 'nav_bar.php'; ?>

  <div class="container-fluid">
    <div class="row">
      <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
        <div class="page-header">
          <h2>Create New Product</h2>
        </div>
        <form action="products.php" method="post" class="form-horizontal">
          <div class="form-group">
            <label for="productid" class="col-sm-3 control-label">Product ID</label>
            <div class="col-sm-9">
             <?php 
             if ($_SESSION['role'] == "Admin") { ?>
              <input name="pid" type="text" class="form-control" id="productid" placeholder="Product ID" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_num']; ?>" required>
            <?php }
            if ($_SESSION['role'] == "Normal Staff") { ?>
              <input name="pid" type="text" class="form-control" readonly value="<?php if (isset($_GET['edit'])) echo $editrow['fld_product_num']; ?>">
            <?php } ?>
          </div>
        </div>

        <div class="form-group">
          <label for="productname" class="col-sm-3 control-label">Name</label>
          <div class="col-sm-9">
           <?php 
           if ($_SESSION['role'] == "Admin") { ?>
            <input name="name" type="text" class="form-control" id="productname" placeholder="Product Name" value="<?php if (isset($_GET['edit'])) echo $editrow['fld_product_name']; ?>" required>
          <?php }
          if ($_SESSION['role'] == "Normal Staff") { ?>
            <input name="name" type="text" class="form-control" readonly value="<?php if (isset($_GET['edit'])) echo $editrow['fld_product_name']; ?>">
          <?php } ?>
        </div>
      </div>

      <div class="form-group">
        <label for="productprice" class="col-sm-3 control-label">Price</label>
        <div class="col-sm-9">
          <?php
          if ($_SESSION['role'] == "Admin") { ?>
            <input name="price" type="number" class="form-control" id="productprice" placeholder="Product Price" value="<?php if (isset($_GET['edit'])) echo $editrow['fld_product_price']; ?>" min="1" step="any" required>
          <?php }
          if ($_SESSION['role'] == "Normal Staff") { ?>
            <input name="price" type="number" class="form-control" readonly value="<?php if (isset($_GET['edit'])) echo $editrow['fld_product_price']; ?>">
          <?php } ?>
        </div>
      </div>

      <div class="form-group">
        <label for="productbrand" class="col-sm-3 control-label">Brand</label>
        <div class="col-sm-9">
         <?php if ($_SESSION['role'] == "Admin") { ?>
          <select name="brand" class="form-control" id="productbrand" required>
            <option value="">Please select</option>
            <option value="Brands Outlet" <?php if(isset($_GET['edit'])) if($editrow['fld_product_brand']=="Brands Outlet") echo "selected"; ?>>Brands Outlet</option>
            <option value="Gamesters" <?php if(isset($_GET['edit'])) if($editrow['fld_product_brand']=="Gamesters") echo "selected"; ?>>Gamesters</option>
            <option value="Seed" <?php if(isset($_GET['edit'])) if($editrow['fld_product_brand']=="Seed") echo "selected"; ?>>Seed</option>
            <option value="PDI" <?php if(isset($_GET['edit'])) if($editrow['fld_product_brand']=="PDI") echo "selected"; ?>>PDI</option>
            <option value="Padini Authentics" <?php if(isset($_GET['edit'])) if($editrow['fld_product_brand']=="Padini Authentics") echo "selected"; ?>>Padini Authentics</option>
            <option value="Poney" <?php if(isset($_GET['edit'])) if($editrow['fld_product_brand']=="Poney") echo "selected"; ?>>Poney</option>
            <option value="Uniqlo" <?php if(isset($_GET['edit'])) if($editrow['fld_product_brand']=="Uniqlo") echo "selected"; ?>>Uniqlo</option>
            <option value="F.O.S" <?php if(isset($_GET['edit'])) if($editrow['fld_product_brand']=="F.O.S") echo "selected"; ?>>F.O.S</option>
            <option value="Cheetah" <?php if(isset($_GET['edit'])) if($editrow['fld_product_brand']=="Cheetah") echo "selected"; ?>>Cheetah</option>
            <option value="Cotton On Kids" <?php if(isset($_GET['edit'])) if($editrow['fld_product_brand']=="Cotton On Kids") echo "selected"; ?>>Cotton On Kids</option>
          </select>
        <?php }

        if ($_SESSION['role'] == "Normal Staff") { ?>
          <select name="brand" class="form-control" id="productbrand" readonly>
            <option value="">Please select</option>
            <option value="Brands Outlet" <?php if(isset($_GET['edit'])) if($editrow['fld_product_brand']=="Brands Outlet") echo "selected"; ?>disabled>Brands Outlet</option>
            <option value="Gamesters" <?php if(isset($_GET['edit'])) if($editrow['fld_product_brand']=="Gamesters") echo "selected"; ?>disabled>Gamesters</option>
            <option value="Seed" <?php if(isset($_GET['edit'])) if($editrow['fld_product_brand']=="Seed") echo "selected"; ?>disabled>Seed</option>
            <option value="PDI" <?php if(isset($_GET['edit'])) if($editrow['fld_product_brand']=="PDI") echo "selected"; ?>disabled>PDI</option>
            <option value="Padini Authentics" <?php if(isset($_GET['edit'])) if($editrow['fld_product_brand']=="Padini Authentics") echo "selected"; ?>disabled>Padini Authentics</option>
            <option value="Poney" <?php if(isset($_GET['edit'])) if($editrow['fld_product_brand']=="Poney") echo "selected"; ?>disabled>Poney</option>
            <option value="Uniqlo" <?php if(isset($_GET['edit'])) if($editrow['fld_product_brand']=="Uniqlo") echo "selected"; ?>disabled>Uniqlo</option>
            <option value="F.O.S" <?php if(isset($_GET['edit'])) if($editrow['fld_product_brand']=="F.O.S") echo "selected"; ?>disabled>F.O.S</option>
            <option value="Cheetah" <?php if(isset($_GET['edit'])) if($editrow['fld_product_brand']=="Cheetah") echo "selected"; ?>disabled>Cheetah</option>
            <option  value="Cotton On Kids" <?php if(isset($_GET['edit'])) if($editrow['fld_product_brand']=="Cotton On Kids") echo "checked";  ?>disabled>Cotton On Kids</option>

          </select>
        <?php } ?>

      </div>
    </div>    
    <div class="form-group">
      <label for="productsize" class="col-sm-3 control-label">Size</label>
      <div class="col-sm-9">
       <?php 
       if ($_SESSION['role'] == "Admin") { ?>
        <div class="radio">
          <label>
            <input name="size" type="radio" id="productsize" value="XS" <?php if(isset($_GET['edit'])) if($editrow['fld_product_size']=="XS") echo "checked"; ?> required> XS
          </label>
        </div>
        <div class="radio">
          <label>
            <input name="size" type="radio" id="productsize" value="S" <?php if(isset($_GET['edit'])) if($editrow['fld_product_size']=="S") echo "checked"; ?>> S
          </label>
        </div>
        <div class="radio">
          <label>
            <input name="size" type="radio" id="productsize" value="M" <?php if(isset($_GET['edit'])) if($editrow['fld_product_size']=="M") echo "checked"; ?>> M
          </label>
        </div>
        <div class="radio">
          <label>
            <input name="size" type="radio" id="productsize" value="L" <?php if(isset($_GET['edit'])) if($editrow['fld_product_size']=="L") echo "checked"; ?>> L
          </label>
        </div>
      <?php }
      if ($_SESSION['role'] == "Normal Staff") { ?>
        <div class="radio">
          <label>
            <input name="size" type="radio" id="productsize" value="XS" <?php if(isset($_GET['edit'])) if($editrow['fld_product_size']=="XS") echo "checked"; ?> disabled> XS
          </label>
        </div>
        <div class="radio">
          <label>
            <input name="size" type="radio" id="productsize" value="S" <?php if(isset($_GET['edit'])) if($editrow['fld_product_size']=="S") echo "checked"; ?>disabled> S
          </label>
        </div>
        <div class="radio">
          <label>
            <input name="size" type="radio" id="productsize" value="M" <?php if(isset($_GET['edit'])) if($editrow['fld_product_size']=="M") echo "checked"; ?>disabled> M
          </label>
        </div>
        <div class="radio">
          <label>
            <input name="size" type="radio" id="productsize" value="L" <?php if(isset($_GET['edit'])) if($editrow['fld_product_size']=="L") echo "checked"; ?>disabled> L
          </label>
        </div>
      <?php }?>
    </div>
  </div>
  <div class="form-group">
    <label for="productmanufacturer" class="col-sm-3 control-label">Manufacturer</label>
    <div class="col-sm-9">
      <?php 
      if ($_SESSION['role'] == "Admin") { ?>
        <select name="manufacturer" class="form-control" id="productmanufacturer" required>
          <option value="Padini Holdings Berhad" <?php if(isset($_GET['edit'])) if($editrow['fld_manufacturer']=="Padini Holdings Berhad") echo "selected"; ?>>Padini Holdings Berhad</option>
          <option value="Poney Garments Sdn Bhd" <?php if(isset($_GET['edit'])) if($editrow['fld_manufacturer']=="Poney Garments Sdn Bhd") echo "selected"; ?>>Poney Garments Sdn Bhd</option>
          <option value="Fast Retailing Co., Ltd" <?php if(isset($_GET['edit'])) if($editrow['fld_manufacturer']=="Fast Retailing Co., Ltd") echo "selected"; ?>>Fast Retailing Co., Ltd</option>
          <option value="F.O.S Apparel Group Sdn Bhd" <?php if(isset($_GET['edit'])) if($editrow['fld_manufacturer']=="F.O.S Apparel Group Sdn Bhd") echo "selected"; ?>>F.O.S Apparel Group Sdn Bhd</option>
          <option value="Cheetah Corporation (M) Sdn Bhd" <?php if(isset($_GET['edit'])) if($editrow['fld_manufacturer']=="Cheetah Corporation (M) Sdn Bhd") echo "selected"; ?>>Cheetah Corporation (M) Sdn Bhd</option>
          <option value="Litai Textiles" <?php if(isset($_GET['edit'])) if($editrow['fld_manufacturer']=="Litai Textiles") echo "selected"; ?>>Litai Textiles</option>
        </select>
      <?php }
      if ($_SESSION['role'] == "Normal Staff") { ?>
        <select name="manufacturer" class="form-control" id="productmanufacturer" >
          <option value="Padini Holdings Berhad" <?php if(isset($_GET['edit'])) if($editrow['fld_manufacturer']=="Padini Holdings Berhad") echo "selected"; ?>disabled>Padini Holdings Berhad</option>
          <option value="Poney Garments Sdn Bhd" <?php if(isset($_GET['edit'])) if($editrow['fld_manufacturer']=="Poney Garments Sdn Bhd") echo "selected"; ?>disabled>Poney Garments Sdn Bhd</option>
          <option value="Fast Retailing Co., Ltd" <?php if(isset($_GET['edit'])) if($editrow['fld_manufacturer']=="Fast Retailing Co., Ltd") echo "selected"; ?>disabled>Fast Retailing Co., Ltd</option>
          <option value="F.O.S Apparel Group Sdn Bhd" <?php if(isset($_GET['edit'])) if($editrow['fld_manufacturer']=="F.O.S Apparel Group Sdn Bhd") echo "selected"; ?>disabled>F.O.S Apparel Group Sdn Bhd</option>
          <option value="Cheetah Corporation (M) Sdn Bhd" <?php if(isset($_GET['edit'])) if($editrow['fld_manufacturer']=="Cheetah Corporation (M) Sdn Bhd") echo "selected"; ?>disabled>Cheetah Corporation (M) Sdn Bhd</option>
          <option value="Litai Textiles" <?php if(isset($_GET['edit'])) if($editrow['fld_manufacturer']=="Litai Textiles") echo "selected"; ?>disabled>Litai Textiles</option>
        </select>
      <?php }?>
    </div>
  </div> 


  <div class="form-group">
    <label for="productstock" class="col-sm-3 control-label">Stock</label>
    <div class="col-sm-9">
      <?php 
      if ($_SESSION['role'] == "Admin") { ?>
        <input name="stock" type="text" class="form-control" id="productstock" placeholder="Product Stock" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_stock']; ?>" min="0" required>
      <?php }
      if ($_SESSION['role'] == "Normal Staff") { ?>
        <input name="stock" type="text" class="form-control" id="productstock" placeholder="Product Stock" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_stock']; ?>" min="0" readonly>
      <?php }?>
    </div>
  </div>

  <div class="form-group">
    <label for="productimage" class="col-sm-3 control-label">Upload : </label>
    <div class="col-sm-9">
      <input type="file" name="fileToUpload" id="fileToUpload">
    </div>
  </div>


  <div class="form-group">
    <div class="col-sm-offset-3 col-sm-9">
     <?php 
     if ($_SESSION['role'] == "Admin") { ?>
      <?php if (isset($_GET['edit'])) { ?>
        <input type="hidden" name="oldpid" value="<?php echo $editrow['fld_product_num']; ?>">
        <button class="btn btn-default" type="submit" name="update"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Update</button>
      <?php } else { ?>
        <button class="btn btn-default" type="submit" name="create"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Create</button>
      <?php } ?>
      <button class="btn btn-default" type="reset"><span class="glyphicon glyphicon-erase" aria-hidden="true"></span> Clear</button>
    <?php }
    if ($_SESSION['role'] == "Normal Staff") { ?>
      <button class="btn btn-primary" onclick=" confirm('Sorry, you do not have right to add product')" type="reset"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Create</button>
      <button class="btn btn-primary" type="reset"><span class="glyphicon glyphicon-erase" aria-hidden="true"></span> Clear</button>
    <?php } ?>
  </div>
</div>
</form>
</div>
</div>

<div class="row">
  <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
    <div class="page-header">
      <h2>Products List</h2>
    </div>
    <table id="myTable" class="table table-striped table-bordered">
      <tr style="background-color: #C4A484">
        <th><center>Product ID</center></th>
        <th><center>Name</center></th>
        <th><center>Price</center></th>
        <th><center>Brand</center></th>
        <th></th>
      </tr>
      <?php
      // Read
      $per_page = 5;
      if (isset($_GET["page"]))
        $page = $_GET["page"];
      else
        $page = 1;
      $start_from = ($page-1) * $per_page;
      try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("select * from tbl_products_a181617_mypt2 LIMIT $start_from, $per_page");
        $stmt->execute();
        $result = $stmt->fetchAll();
      }
      catch(PDOException $e){
        echo "Error: " . $e->getMessage();
      }
      foreach($result as $readrow) {
        ?>   
        <tr>
          <td><?php echo $readrow['fld_product_num']; ?></td>
          <td><?php echo $readrow['fld_product_name']; ?></td>
          <td><?php echo $readrow['fld_product_price']; ?></td>
          <td><?php echo $readrow['fld_product_brand']; ?></td>
          <td>
            <?php 
            if ($_SESSION['role'] == "Admin") { ?>
              <!-- Trigger the modal with a button -->
              <a onclick="openModal('<?php echo $readrow['fld_product_num']; ?>'); return false;" class="btn btn-warning btn-xs" role="button">Details</a>

              <!-- Modal Page-->
              <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Product Details</h4>
                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- End of Modal -->

              <a href="products.php?edit=<?php echo $readrow['fld_product_num']; ?>" class="btn btn-success btn-xs" role="button"> Edit </a>
              <a href="products.php?delete=<?php echo $readrow['fld_product_num']; ?>" onclick="return confirm('Are you sure to delete?');" class="btn btn-danger btn-xs" role="button">Delete</a>
            <?php }
            if ($_SESSION['role'] == "Normal Staff") { ?>
              <!-- Trigger the modal with a button -->
              <a onclick="openModal('<?php echo $readrow['fld_product_num']; ?>'); return false;" class="btn btn-warning btn-xs" role="button">Details</a>

              <!-- Modal Page-->
              <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Product Details</h4>
                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- End of Modal -->

              <a onclick=" confirm('Sorry, you do not have right to edit product : <?php echo $readrow['fld_product_num']; ?>');" class="btn btn-danger btn-xs" role="button"> Edit </a>
              <a onclick=" confirm('Sorry, you do not have right to delete product : <?php echo $readrow['fld_product_num']; ?>');" class="btn btn-danger btn-xs" role="button">Delete</a>
            <?php } ?>

          </td>
        </tr>
      <?php }

      $conn = null; ?>

    </table>
  </div>
</div>

<div class="row">
  <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
    <nav>
      <ul class="pagination">
        <?php
        try {
          $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn->prepare("SELECT * FROM tbl_products_a181617_mypt2");
          $stmt->execute();
          $result = $stmt->fetchAll();
          $total_records = count($result);
        }
        catch(PDOException $e){
          echo "Error: " . $e->getMessage();
        }
        $total_pages = ceil($total_records / $per_page);
        ?>
        <?php if ($page==1) { ?>
          <li class="disabled"><span aria-hidden="true">«</span></li>
        <?php } else { ?>
          <li><a href="products.php?page=<?php echo $page-1 ?>" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
          <?php
        }
        for ($i=1; $i<=$total_pages; $i++)
          if ($i == $page)
            echo "<li class=\"active\"><a href=\"products.php?page=$i\">$i</a></li>";
          else
            echo "<li><a href=\"products.php?page=$i\">$i</a></li>";
          ?>
          <?php if ($page==$total_pages) { ?>
            <li class="disabled"><span aria-hidden="true">»</span></li>
          <?php } else { ?>
            <li><a href="products.php?page=<?php echo $page+1 ?>" aria-label="Previous"><span aria-hidden="true">»</span></a></li>
          <?php } ?>
        </ul>
      </nav>
    </div>
  </div>
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="https://code.jquery"></script>
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>

  <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

  <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap.min.js"></script>

  <script type="text/javascript">
    $(document).ready(function () {
      $('#myTable').DataTable();
    });
  </script>

  
  <script class="text-left" type="text/javascript" charset="utf8" src="/DataTables/datatables.js"></script>

</body>


</html>