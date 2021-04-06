<!DOCTYPE html>
<html lang="en">
<?php include('views/header.php');
require('database.php');?>
<head>

<!-- bootstrap declaration -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Calendar</title>
</head>
<body>
<div class="container-fluid" style="height: 100vh">
  <div class="row h-100 no-gutters">
    <div class = "col-sm-6 d-flex flex-column">
          <div class="bg-info align-items-center flex-grow-1 justify-content-center d-flex"><div>left1</div></div>  
          <div class="bg-danger align-items-center flex-grow-1 justify-content-center d-flex"><div>left2</div></div>
          <div class="bg-success align-items-center flex-grow-1 justify-content-center d-flex"><div>left3</div></div>  
    </div>
    <div class = "col-sm-6 bg-warning">
       <img class="img-fluid" src="images/MMHS_Logo2.jpg" alt="School Logo" >
    </div>
  </div>
</div>
</body>
</html>