<!DOCTYPE html>
<html lang="en">
<head>

<!-- bootstrap declaration -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Players</title>
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











<!-- section bellow is for uploading and displaying players info-->


<!-- display a button only if user is logged in -->

<?php
session_start();
if($_SESSION['isAdmin']) : ?><!--will need to link to admin page to check if logged in (need ryan to use "isadmin"
                                  variable on his page for login)-->
  <span>Edit</span>
<?php endif; ?>
<form method="POST">
  <div style="position: absolute; right:50px; bottom:100px">
    <button id="upload" type="submit">Upload</button>
  </div>  
  
  <!--if button is clicked it will then upload a new statsbar with picture that was uploaded.
  will need to figure out how to pull multiple fields for stats on each player (do i link the stats to player name?)-->
  <?php
  if(isset($_POST))
  {
    
  }
  ?>
</form>

<!-- statsbar-->
<div>
  <img class="center image" src="images/StatsBar.png" alt="centered image" width="800px" >
</div>

</body>
</html>



  

  


