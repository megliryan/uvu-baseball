<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
// if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    // header("location: login.php");
    // exit;
// }
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
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
        <a class="nav-link" href="index.php">Home</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="Schedule.php">Schedule</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="Players.php">Roster</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="Forms.html">Forms</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="Logout.php">Logout</a>
      </li>

    </ul>
  </div>
</nav>
    <h1 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1>
    <p>
        <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
        <!-- <a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a> -->
    </p>
    <div>
          Add a calendar event<br>
          <input type="text" name="date" id="date" placeholder="date"><br>
          <input type="text" name="time" id="time" placeholder="time"><br>
          <input type="text" name="opponent" id="opponent" placeholder="opponent"><br>
        </div><br><br>
        <div class="stats">
            Update Stats<br>
            Batting AVG: <input type="text" name="batting_average" id="batting_average"><br>
            OBP: <input type="text" name="on_base_percentage" id="on_base_percentage"><br>
            Hits: <input type="text" name="hits" id="hits"><br>
            Singles: <input type="text" name="singles" id="singles"><br>
            Doubles: <input type="text" name="doubles" id="doubles"><br>
            Triples: <input type="text" name="triples" id="triples"><br>
            Homeruns: <input type="text" name="homeruns" id="homeruns"><br>
            Stolen Bases: <input type="text" name="stolen_bases" id="stolen_bases"><br>
            Stolen Base Attempts: <input type="text" name="stolen_bases_attempts" id="stolen_bases_attempts"><br>
            Wins: <input type="text" name="wins" id="wins"><br>
            Losses: <input type="text" name="losses" id="losses"><br>
            Earned Run AVG: <input type="text" name="earned_run_average" id="earned_run_average"><br>
            WHIP: <input type="text" name="whip" id="whip"><br>
            Strike Outs: <input type="text" name="strike_outs" id="strike_outs"><br>
            Walks: <input type="text" name="walks" id="walks"><br>
            Innings Pitched: <input type="text" name="innings_pitched" id="innings_pitched"><br>
        </div>
</body>
</html>