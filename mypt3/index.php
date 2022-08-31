<?php 
session_start()

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Boy Apparel Co : Home</title>
  <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
 
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
      html {
        width:100%;
        height:100%;
        /*background:url(pictures/logo.png) center no-repeat;*/
        background-color: #F3EDD9;
        min-height:100%;
      }
      h1,h4 {
        font-family: monospace;
      }
    </style>
</head>
<body>
 <?php include_once 'nav_bar.php'; ?>
 <div style="background-color: #F3EDD9">
 <center>
<h1 >WELCOME TO BOY APPAREL CO!</h1>
<h4>Style your kids in a classy yet comfy clothes</h4>
<br><br>
</center>

<div class="container-fluid bg-2 text-center" id="who">
  <div class="row">
    <div class="col-sm-4">
      <img src="pictures/index1.jpeg" class="img-responsive" alt="Image" style="display:inline">
    </div>
    <div class="col-sm-4">
      <img src="pictures/index2.jpeg" class="img-responsive" alt="Image" style="display:inline">
    </div>
    <div class="col-sm-4">
      <img src="pictures/index3.jpeg" class="img-responsive" alt="Image" style="display:inline" height="20px">
    </div>
    </div>
</div>
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

</body>
</html>