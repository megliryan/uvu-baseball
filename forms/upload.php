<?php

session_start();

// if (!isset($_SESSION['username']) or !isset($_SESSION['logged_in'])) {
//     header('location:/login.php'); // Tell the user they need to log in.
// }

$success = null;
$error = '';

$success = filter_input(INPUT_GET, 'success', FILTER_VALIDATE_BOOL);

if (isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles.css">
    <title>Forms</title>
</head>
<body>
    
<!-- NAVIGATION BAR. DO NOT TOUCH. -->
<nav class="navbar navbar-expand-md bg-dark navbar-dark">
  <!-- Brand -->
  <!--<a class="navbar-brand" href="#">Navbar</a>-->
  <div id=MMLogo>
    <a class="navbar-brand" href="#"><img src="images/School_Logo.png" alt="Logo" style="width:60px;"></a>
  </div>
  <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Navbar links -->
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">

      <li class="nav-item">
        <a class="nav-link" href="index.html">Home</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="Schedule.php">Schedule</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="Players.php">Roster</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="Players.php">Forms</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="Login.php">Login</a>
      </li>

    </ul>
  </div>
</nav>
<!-- END OF NAVIGATION BAR. DO NOT TOUCH. -->

<!-- Heading for forms page -->
<div class="jumbotron">
  <h1>Upload Form</h1>      

</div>
<!-- End of heading for forms page -->
<?php if ($success !== null):?>
  <?php if ($success === true) :?>
    <div class="m-4 alert alert-success">
        <strong>Success!</strong> Your file was successully uploaded.
    </div>
  <?php elseif ($success === false) :?>
    <div class="m-4 alert alert-danger">
        <strong>Error!</strong> <?=$error?>
    </div>
  <?php endif;?>
<?php endif?>
  <div class="m-4 p-3 container-fluid bg-light text-body"
    <form action="process-upload.php" method="post" enctype="multipart/form-data">
      <label for="name">Form name:</label><br/>
      <input type="text" name="name" id="name"><br/><br/>
      <label for="fileToUpload">Form to upload: (Must be a pdf)</label><br/>
      <input type="file" name="fileToUpload" id="fileToUpload"><br/><br/>
      <input type="submit" value="Submit">
    </form>

</body>
</html>