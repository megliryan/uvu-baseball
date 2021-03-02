<?php
    session_start();
        $logged_in = false;
        $errors = filter_input(INPUT_GET, 'errors');
        $username_cookie = filter_input(INPUT_COOKIE, 'username;');
        $password_cookie = filter_input(INPUT_COOKIE, 'password;');

        if( isset($_SESSION['username']) && isset($_SESSION['logged_in']) ){
            $logged_in = true;
        }elseif( $username_cookie == 'first' && $password_cookie == 'player'){
            $_SESSION['username'] = $username_cookie;
            $_SESSION['logged_in'] = TRUE;
            $logged_in = TRUE;
        }
?>

<!DOCTYPE html>
<html lang="en">
<head>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Login</title>
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
    <!-- <?php include('header.php'); ?> -->
    <?php if(!$logged_in) :?>
        <div id="data_entry", class="container">
        <form action="login.php" method="post">
            <input type="text" id="username" placeholder="Username"><br>
            <input type="password" id="password" placeholder="Password"><br>
            <p>Please reach out to your coach to get a profile set up</p>
            <!-- <input type="checkbox" name="stay_logged_in">Stay logged in? -->
            <!-- <input type="submit" value="Login"><br><br> -->
            <button><a href="Main.html">Login</a></button>
            <div class="errors"><?=$errors?></div>
        </form>  
        </div>

    <?php else : ?>
        <div id="data_entry", class="container">
        <a href="enter_nums.php">Click to begin</a>
        <a href="logout.php">Click to logout</a>
        </div>
    <?php endif; ?>
</body>
</html>