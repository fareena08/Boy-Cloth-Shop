<?php
include_once 'customers_crud.php';
include_once 'logged_in.php';
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Boy Apparel Co: Customers</title>
  <!-- Bootstrap -->
  <link href="css/bootstrap.min.css" rel="stylesheet">

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript">
      var check = function() {
        if (document.getElementById('pass').value ==
          document.getElementById('spass').value) {
          document.getElementById('message').style.color = 'green';
        document.getElementById('message').innerHTML = 'Password match';
      } else {
        alert('Password not match, try again');
      }
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
        <h2>Create New Customer</h2>
      </div>
      <form action="customers.php" method="post" class="form-horizontal">
        <div class="form-group">
         <label for="customerid" class="col-sm-3 control-label">Customer ID</label>
         <div class="col-sm-9">
          <?php 
          if ($_SESSION['role'] == "Admin") { ?>
            <input name="cid" type="text" class="form-control" id="customerid" placeholder="Customer ID" value="<?php if (isset($_GET['edit'])) echo $editrow['fld_customer_num']; ?>" required>
          <?php }
          if ($_SESSION['role'] == "Normal Staff") { ?>
            <input name="cid" type="text" class="form-control" id="customerid" placeholder="Customer ID" value="<?php if (isset($_GET['edit'])) echo $editrow['fld_customer_num']; ?>" required>
          <?php } ?>
        </div>
      </div>


      <div class="form-group">
        <label for="custname" class="col-sm-3 control-label">Customer Name</label>
        <div class="col-sm-9">
          <?php 
          if ($_SESSION['role'] == "Admin") { ?>
            <input name="name" type="text" class="form-control" id="custname" placeholder="CustomerName" value="<?php if (isset($_GET['edit'])) echo $editrow['fld_customer_name']; ?>" required>
          <?php }
          if ($_SESSION['role'] == "Normal Staff") { ?>
            <input name="name" type="text" class="form-control" id="custname" placeholder="CustomerName" value="<?php if (isset($_GET['edit'])) echo $editrow['fld_customer_name']; ?>" required>
          <?php } ?>
        </div>
      </div>


      <div class="form-group">
        <label for="custphone" class="col-sm-3 control-label">Phone Number</label>
        <div class="col-sm-9">
          <?php 
          if ($_SESSION['role'] == "Admin") { ?>
            <input name="phone" type="text" class="form-control" id="custphone" placeholder="Phone Number" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_customer_phone']; ?>" required> 
          <?php }
          if ($_SESSION['role'] == "Normal Staff") { ?>
           <input name="phone" type="text" class="form-control" id="custphone" placeholder="Phone Number" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_customer_phone']; ?>" required>
         <?php } ?>
       </div>
     </div>

     <div class="form-group">
      <div class="col-sm-offset-3 col-sm-9">
        <?php 
        if ($_SESSION['role'] == "Admin") { ?>
          <?php if (isset($_GET['edit'])) { ?>
            <input type="hidden" name="oldcid" value="<?php echo $editrow['fld_customer_num']; ?>">
            <button class="btn btn-primary" type="submit" name="update"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Update</button>
          <?php } else { ?>
            <button class="btn btn-primary" type="submit" name="create"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Create</button>
          <?php } ?>
          <button class="btn btn-primary" type="reset"><span class="glyphicon glyphicon-erase" aria-hidden="true"></span> Clear</button>
        <?php }
        if ($_SESSION['role'] == "Normal Staff") { ?>
          <?php if (isset($_GET['edit'])) { ?>
          <input type="hidden" name="oldcid" value="<?php echo $editrow['fld_customer_num']; ?>">
            <button class="btn btn-primary" type="submit" name="update"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Update</button>
          <?php } else { ?>
            <button class="btn btn-primary" type="submit" name="create"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Create</button>
          <?php } ?>
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
      <h2>Customers List</h2>
    </div>
    <table class="table table-striped table-bordered">
      <tr style="background-color: #C4A484;">
        <th><center>Customer ID</center></th>
        <th><center>Customer Name</center></th>
        <th><center>Phone Number</center></th>
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
        $stmt = $conn->prepare("select * FROM tbl_customers_a181617_mypt2 LIMIT $start_from, $per_page");
        $stmt->execute();
        $result = $stmt->fetchAll();
      }
      catch(PDOException $e){
        echo "Error: " . $e->getMessage();
      }
      foreach($result as $readrow) {
        ?>

        <tr>
          <td> <center><?php echo $readrow['fld_customer_num']; ?> </center></td>
          <td> <center><?php echo $readrow['fld_customer_name']; ?> </center></td>
          <td> <center><?php echo $readrow['fld_customer_phone']; ?> </center></td>

          <td> <center>
            <?php 
            if ($_SESSION['role'] == "Admin") { ?>
              <a href="customers.php?edit=<?php echo $readrow['fld_customer_num']; ?>" class="btn btn-success btn-xs" role="button">Edit</a>
              <a href="customers.php?delete=<?php echo $readrow['fld_customer_num']; ?>" onclick="return confirm('Are you sure to delete?');" class="btn btn-danger btn-xs" role="button">Delete</a>

            <?php }
            if ($_SESSION['role'] == "Normal Staff") { ?>
              <a href="customers.php?edit=<?php echo $readrow['fld_customer_num']; ?>" class="btn btn-success btn-xs" role="button">Edit</a>
              <a onclick=" confirm('Sorry, you do not have right to delete customer named <?php echo $readrow['fld_customer_name']; ?>');" class="btn btn-danger btn-xs" role="button">Delete</a>
            <?php } ?>

          </center> </td>
        </tr>

        <?php
      }
      $conn = null;
      ?>
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
          $stmt = $conn->prepare("SELECT * FROM tbl_customers_a181617_mypt2");
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
          <li><a href="customers.php?page=<?php echo $page-1 ?>" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
          <?php
        }
        for ($i=1; $i<=$total_pages; $i++)
          if ($i == $page)
            echo "<li class=\"active\"><a href=\"customers.php?page=$i\">$i</a></li>";
          else
            echo "<li><a href=\"customers.php?page=$i\">$i</a></li>";
          ?>
          <?php if ($page==$total_pages) { ?>
            <li class="disabled"><span aria-hidden="true">»</span></li>
          <?php } else { ?>
            <li><a href="customers.php?page=<?php echo $page+1 ?>" aria-label="Previous"><span aria-hidden="true">»</span></a></li>
          <?php } ?>
        </ul>
      </nav>
    </div>
  </div>
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="js/bootstrap.min.js"></script>

</body>
</html>