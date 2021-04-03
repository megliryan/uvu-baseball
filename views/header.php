<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>

<!-- bootstrap declaration -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="/styles.css">
<title><?=$title?></title>
</head>
<body>
  <!--declaration of navigation bar-->
  <nav class="navbar navbar-expand-md bg-dark navbar-dark">
  <!-- Brand -->
  <!--<a class="navbar-brand" href="#">Navbar</a>-->
  <div id=MMLogo>
    <a class="navbar-brand" href="#"><img src="/images/School_Logo.png" alt="Logo" style="width:60px;"></a>
  </div>
  <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Navbar links -->
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">

      <li class="nav-item">
        <a class="nav-link" href="/index.php">Home</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="/Schedule.php">Schedule</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="/Players.php">Roster</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="/forms">Forms</a>
      </li>
      <?php if (!isset($_SESSION['loggedin']) or !$_SESSION['loggedin']):
        # If the user is logged out, show the login button.?>
      <li class="nav-item">
        <a class="nav-link" href="/Login.php">Login</a>
      </li>
      <?php endif?>
      <?php if (isset($_SESSION['loggedin']) and $_SESSION['loggedin']):
        # If the user is logged in, show the logout button.?>
      <li class="nav-item">
        <a class="nav-link" href="/Logout.php">Logout</a>
      </li>
      <?php if ($_SESSION['is_admin']):
        # If previous & the user is an admin, show the manage button.?>
      <li class="nav-item">
       <a class="nav-link" href="/admin.php">Manage</a>
      </li>
      <?php endif; endif; # Close navbar options.?>

    </ul>
  </div>
</nav>
