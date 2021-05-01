<?php 
# Special variables for the header:
  # $title = title of the page
  # $head = other code that needs to go in <head>
  # $root = (defined below) where all the files are stored on the server.
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
$root = '/uvu-baseball/';
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
<link rel="stylesheet" href="<?=$root?>styles.css">
<title><?php if (isset($title)) {echo $title;} else {echo 'MMHS Baseball';}?></title>
<!-- JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<?php if (isset($head)) {echo $head;}?>
</head>
<body>
  <!--declaration of navigation bar-->
  <nav class="navbar navbar-expand-md bg-dark navbar-dark fixed-top">
  <!-- Brand -->
  <!--<a class="navbar-brand" href="#">Navbar</a>-->
  <div id=MMLogo>
    <a class="navbar-brand" href="#"><img src="<?=$root?>images/School_Logo.png" alt="Logo" style="width:60px;"></a>
  </div>
  <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Navbar links -->
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">

      <li class="nav-item">
        <a class="nav-link" href="<?=$root?>index.php">Home</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?=$root?>Schedule.php">Schedule</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?=$root?>Roster.php">Roster</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?=$root?>forms">Forms</a>
      </li>
      <?php if (!isset($_SESSION['username'])):
        # If the user is logged out, show the login button.?>
      <li class="nav-item">
        <a class="nav-link" href="<?=$root?>Login.php">Login</a>
      </li>
      <?php endif?>
      <?php if (isset($_SESSION['is_admin'])):
        # If the user is logged in, show the logout and videos buttons.?>
      <li class="nav-item">
        <a class="nav-link" href="<?=$root?>videos.php">Videos</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?=$root?>Logout.php">Logout</a>
      </li>
      <?php if ($_SESSION['is_admin']):
        # If previous & the user is an admin, show the manage buttons.?>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        Manage
        </a>
       <div class="dropdown-menu">
          <a class="dropdown-item" href="<?=$root?>admin.php">Admin Dashboard</a>
          <a class="dropdown-item" href="<?=$root?>Register.php">Register User</a>
          <a class="dropdown-item" href="<?=$root?>adminregister.php">Register Admin</a>
        </div>
    </li>
      <?php endif; endif; # Close navbar options.?>

    </ul>
  </div>
</nav>
<br>
<br>
<br>
<br>
