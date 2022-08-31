<?php
include_once 'staffs_crud.php';
include_once 'logged_in.php';

if (!($_SESSION['role'] == "Admin")) {
    header("location: index.php");
    echo '<script type ="text/JavaScript">';  
echo 'alert("Sorry you are not allowed to access Staff details")';  
echo '</script>';  
    exit;
  }
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Boy Apparel Co : Staffs</title>
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
          <h2>Create New Staff</h2>
        </div>
        <form action="staffs.php" method="post" class="form-horizontal">

          <div class="form-group">
           <label for="staffid" class="col-sm-3 control-label">Staff ID</label>
           <div class="col-sm-9">
            <?php 
              if ($_SESSION['role'] == "Admin") { ?>
            <input name="sid" type="text" class="form-control" id="staffid" placeholder="Staff ID" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_staff_num']; ?>" required>
             <?php }
              if ($_SESSION['role'] == "Normal Staff") { ?>
                <input name="sid" type="text" class="form-control" readonly>
              <?php } ?>
          </div>
        </div>

        <div class="form-group">
          <label for="staffname" class="col-sm-3 control-label">Staff Name</label>
          <div class="col-sm-9">
            <?php 
              if ($_SESSION['role'] == "Admin") { ?>
            <input name="fname" type="text" class="form-control" id="staffname" placeholder="Staff Name" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_staff_name']; ?>" required> 
             <?php }
              if ($_SESSION['role'] == "Normal Staff") { ?>
                <input name="fname" type="text" class="form-control" readonly>
              <?php } ?>
          </div>
        </div>

        <?php 
          if ($_SESSION['role'] == "Admin") { ?>
            <div class="form-group">
              <label for="spass" class="col-sm-3 control-label">Password :</label>
              <div class="col-sm-9">
                <input id="spass" name="spass" type="password" class="form-control" value="<?php if (isset($_GET['edit'])) echo $editrow['fld_staff_password']; ?>" placeholder="Staff Password" required>
              </div>
            </div>
            <div class="form-group">
              <label for="pass" class="col-sm-3 control-label">Confirm Password :</label>
              <div class="col-sm-9">
                <input id="pass" name="pass" type="password" class="form-control" value="<?php if (isset($_GET['edit'])) echo $editrow['fld_staff_password']; ?>" onchange='check();' placeholder="Confirm Password" required>
                <span id='message'></span>
              </div>
            </div>
            <div class="form-group">
              <label for="role" class="col-sm-3 control-label">Position :</label>
              <div class="col-sm-9">
                <select id="role" name="role" class="form-control" required>
                  <option>Please select</option>
                  <option value="Admin" <?php if (isset($_GET['edit'])) if ($editrow['fld_staff_role'] == "Admin") echo "selected"; ?>>Admin</option>
          
                  <option value="Normal Staff" <?php if (isset($_GET['edit'])) if ($editrow['fld_staff_role'] == "Normal Staff") echo "selected"; ?>>Normal Staff</option>
                </select>
              </div>
            </div>
          <?php }
          if ($_SESSION['role'] == "Normal Staff") { ?>

          <?php } ?>

          <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9">

              <?php 
              if ($_SESSION['role'] == "Admin") { ?>
                <?php if (isset($_GET['edit'])) { ?>
                  <input type="hidden" name="oldsid" value="<?php echo $editrow['fld_staff_num']; ?>">
                  <button class="btn btn-primary" type="submit" name="update"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Update</button>
                <?php } else { ?>
                  <button class="btn btn-primary" type="submit" name="create"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Create</button>
                <?php } ?>
                <button class="btn btn-primary" type="reset"><span class="glyphicon glyphicon-erase" aria-hidden="true"></span> Clear</button>
              <?php }
              if ($_SESSION['role'] == "Normal Staff") { ?>
                <button class="btn btn-primary" onclick=" confirm('Sorry, you do not have right to add staff')" type="reset"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Create</button>
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
        <h2>Staffs List</h2>
      </div>
      <table class="table table-striped table-bordered">
        <tr style="background-color: #C4A484 ;"> 
          <th>
              <center>Staff ID<center>
            </th>
            <th>
              <center>Staff Name<center>
            </th>
        
        <?php 
            if ($_SESSION['role'] == "Admin") { ?>
              <th>
                <center>Password</center>
              </th>
              <th>
                <center>Position</center>
              </th>
            <?php }
            if ($_SESSION['role'] == "Normal Staff") { ?>
              <th>
                <center>Position</center>
              </th>
            <?php } ?>
            <th>
              <center>Action</center>
            </th>

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
          $stmt = $conn->prepare("select * FROM tbl_staffs_a181617_mypt2 LIMIT $start_from, $per_page");
          $stmt->execute();
          $result = $stmt->fetchAll();
        }
        catch(PDOException $e){
          echo "Error: " . $e->getMessage();
        }
        foreach($result as $readrow) {
          ?>
          <tr>
            <td><?php echo $readrow['fld_staff_num']; ?></td>
            <td><?php echo $readrow['fld_staff_name']; ?></td>
                         
           <?php 
              if ($_SESSION['role'] == "Admin") { ?>
                <td>  <center><?php echo $readrow['fld_staff_password']; ?> </center></td>
                <td>  <center><?php echo $readrow['fld_staff_role']; ?> </center></td>

              <?php }
              if ($_SESSION['role'] == "Normal Staff") { ?>
                <td><center><?php echo $readrow['fld_staff_role']; ?> </center></td>
              <?php } ?>

              <td>  <center>
                <?php 
                if ($_SESSION['role'] == "Admin") { ?>
                  <a href="staffs.php?edit=<?php echo $readrow['fld_staff_num']; ?>" class="btn btn-success btn-xs" role="button">Edit</a>
                  <a href="staffs.php?delete=<?php echo $readrow['fld_staff_num']; ?>" onclick="return confirm('Are you sure to delete?');" class="btn btn-danger btn-xs" role="button">Delete</a>

                <?php }
                if ($_SESSION['role'] == "Normal Staff") { ?>
                  <a onclick=" confirm('Sorry, you do not have right to edit staff named <?php echo $readrow['fld_staff_name']; ?>');" class="btn btn-danger btn-xs" role="button">Edit</a>
                  <a onclick=" confirm('Sorry, you do not have right to delete staff named <?php echo $readrow['fld_staff_name']; ?>');" class="btn btn-danger btn-xs" role="button">Delete</a>
                <?php } ?>
              </center>
            </td>
          
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
            $stmt = $conn->prepare("SELECT * FROM tbl_staffs_a181617_mypt2");
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
            <li><a href="staffs.php?page=<?php echo $page-1 ?>" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
            <?php
          }
          for ($i=1; $i<=$total_pages; $i++)
            if ($i == $page)
              echo "<li class=\"active\"><a href=\"staffs.php?page=$i\">$i</a></li>";
            else
              echo "<li><a href=\"staffs.php?page=$i\">$i</a></li>";
            ?>
            <?php if ($page==$total_pages) { ?>
              <li class="disabled"><span aria-hidden="true">»</span></li>
            <?php } else { ?>
              <li><a href="staffs.php?page=<?php echo $page+1 ?>" aria-label="Previous"><span aria-hidden="true">»</span></a></li>
            <?php } ?>
          </ul>
        </nav>
      </div>
      </div>
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

  </body>
  </html>