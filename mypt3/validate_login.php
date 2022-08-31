<?php 

include_once 'database.php';

if(empty($_SESSION)) {
    session_start();
  }

  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  if(isset($_POST['sid'])) {

    try {
 
    $stmt = $conn->prepare("SELECT * from tbl_staffs_a181617_mypt2 WHERE fld_staff_num = :sid");

   
    $stmt->bindParam(':sid', $sid, PDO::PARAM_STR);
       
    $sid = $_POST['sid'];
    $pass = $_POST['pass'];
    $level = $_POST['level'];
         
    $stmt->execute();

    $count = $stmt->rowCount();

    $readrow = $stmt->fetch(PDO::FETCH_ASSOC);
   // $_SESSION['name'] = $readrow["fld_staff_name"];
 
    
    if ($count < 1) {
      echo "<script>alert('Sorry, user does not exist');</script>";
    }
    else if($pass != $readrow["fld_staff_password"]) {
      echo "<script>alert('Incorrect password. Please try again');</script>";
    }
    else if($level != $readrow["fld_staff_role"]) {
      echo "<script>alert('Incorrect role. Please try again');</script>";
    }
    else if($count == 1) {
      $_SESSION['role'] = $readrow["fld_staff_role"];
      $_SESSION['name'] = $readrow["fld_staff_name"];
      echo "<script>alert('Welcome {$_SESSION['name']}! You are logged in as {$_SESSION['role']}');document.location='index.php'</script>";
      if(!session_id()) 
        session_start();
    }
    
  }
  catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
  }

 ?>