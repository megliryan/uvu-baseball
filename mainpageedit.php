<?php
/*php reference SQL database for current announcements data

$servername = "localhost";
$username = "username";
$password = "password";

// Create connection
$conn = mysqli_connect($servername, $username, $password);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
// echo out the data needed

*/

?>

<!DOCTYPE html>
<html lang="en">
<head>

<!-- bootstrap declaration -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>MMHS Baseball</title>
</head>
<body>
  <!--declaration of navigation bar-->
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
        <a class="nav-link" href="Main.html">Home</a>
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
        <a class="nav-link" href="Login.php">Login</a>
      </li>

    </ul>
  </div>
</nav>

<!--declaration of div Title-->
<div class="jumbotron">
    <h1>Maple Mountain Baseball</h1>      
    <h3>Welcome to the mountain!</h3>
</div>

<!--declaration of announcements section-->
<div class="row">
  <div class="col-sm-7">
  <div class="jumbotron jumbotron-fluid">
    <h2>Announcements</h2>
      <div class="container-sm">
        - Tryouts are set for 3/1/2021. Please do not forget!
        <!--  
        <?php 
        /*
        <?php foreach($announcements_entries as $announcement_entry): ?>
          <tr class=rowheader>
              <td><?=$announcement_entry['title']?></td>
              <td><?=$announcement_entry['date']?></td>
          </tr>
          <tr class=rowbody>
              <td><?=$announcement_entry['body']?></td>
          </tr>
          
        <?php endforeach; ?>
        */
        ?>
          
        -->
      </div>
    </div>
  </div>

    <!--delcaration of upcoming games section -->
    <div class="col-sm-5">
    <div class="jumbotron jumbotron-fluid">
      <h2>Upcoming Games</h2>
        <div class="container-sm">
          - @ Orem High -- 3/14/2021 4:00PM
          <!--  
        <?php 
        /*
        <?php foreach($game_entries as $game_entry): ?>
          <tr>
              <td><?=$game_entry['title']?></td>
              <td><?=$game_entry['date']?></td>
          </tr>
          
          
        <?php endforeach; ?>
        */
        ?>
          
        -->
        </div>
      </div>
    </div>
  </div>

  <!--declaration of livestream window-->
<div class="row">
  <div class="col-sm-12">
    <div class="jumbotron jumbotron-fluid">
    <!--code for the previous game-->
      <h2>Previous Game</h2>
      <div class="row">
      <div class="col-sm-12">
      <form >
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">YouTube Link</span>
                </div>
                <input type="link" class="form-control">
                <button type="button" class="btn btn-primary">Make Change</button>
            </div>
        </form>
        </div>
        </div>
      <div id=livestream>
        <object width="1500" height="1050" data="http://www.youtube.com/v/crNtuGff1-w" 
        type="application/x-shockwave-flash"><param name="src" value="http://www.youtube.com/v/crNtuGff1-w" /></div>
        </object>
        
        <!-- //reference code, please ignore
        <form action="login.php" method="post">
            Username <input type="text" name="username" placeholder="Username">
            Password <input type="password" name="password" placeholder="Password">
            <input type="checkbox" name="stay_logged_in">Stay logged in?
            <input type="submit" value="Submit">
            <div class="errors"><?=$errors?></div>
        </form>  
        -->
      
      </div>
  </div>
</div>
            
</body>
</html>