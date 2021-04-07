<<<<<<< HEAD
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
<nav class="navbar navbar-expand-md bg-dark navbar-dark fixed-top">
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
        <a class="nav-link" href="index.php">Home</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="Schedule.php">Schedule</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="Players.php">Roster</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="forms/index.php">Forms</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="Login.php">Login</a>
      </li>

    </ul>
  </div>
</nav>
<br>
<!-- END OF NAVIGATION BAR. DO NOT TOUCH. -->
=======
<?php 
$title = "Players";
include('views/header.php');
?>

<!-- Select Player: <select name="players" id="players"> -->
 <?php 
require_once "config.php";

global $db;
    $query = 'SELECT * FROM players';
    $statement = $db->prepare($query);
    $statement->execute();
    $players = $statement->fetchAll();
    $statement->closeCursor();
?>

Select Player: <select name="players">
  <?php foreach ($players as $player): ?> 
  <option value="<?php echo $player;?>"> 
  <?php echo $player['PlayerName']; ?> 
  </option> <?php endforeach ?>
</select>

<img src="images/StatsBar.png" alt="">

<?php include('views/footer.php');?>
