<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: admin.php");
    exit;
}

// Check if the user is an admin, if not then redirect him to welcome page

  // // Prepare a select statement
  // $sql = "SELECT id FROM players WHERE first_name = ?";

  // if($stmt = mysqli_prepare($link, $sql)){
  //   $name = trim($_GET("name"));
    // $school_year = trim($_GET("school_year"));
  //   $batting_average = trim($_GET("batting_average"));
  //   $on_base_percentage = trim($_GET("on_base_percentage"));
  //   $hits = trim($_GET("hits"));
  //   $singles = trim($_GET("singles"));
  //   $doubles = trim($_GET("doubles"));
  //   $triples = trim($_GET("triples"));
  //   $homeruns = trim($_GET("homeruns"));
  //   $stolen_bases = trim($_GET("stolen_bases"));
  //   $stolen_bases_attempts = trim($_GET("stolen_bases_attempts"));
  //   $wins = trim($_GET("wins"));
  //   $losses = trim($_GET("losses"));
  //   $earned_run_average = trim($_GET("earned_run_average"));
  //   $whip = trim($_GET("whip"));
  //   $strike_outs = trim($_GET("strike_outs"));
  //   $walks = trim($_GET("walks"));
  //   $innings_pitched  = trim($_GET("innings_pitched"));

  //   $param_name = trim($_POST("name"));
  //   $param_school_year = trim($_POST("school_year"));
  //   $param_batting_average = trim($_POST("batting_average"));
  //   $param_on_base_percentage = trim($_POST("on_base_percentage"));
  //   $param_hits = trim($_POST("hits"));
  //   $param_singles = trim($_POST("singles"));
  //   $param_doubles = trim($_POST("doubles"));
  //   $param_triples = trim($_POST("triples"));
  //   $param_homeruns = trim($_POST("homeruns"));
  //   $param_stolen_bases = trim($_POST("stolen_bases"));
  //   $param_stolen_bases_attempts = trim($_POST("stolen_bases_attempts"));
  //   $param_wins = trim($_POST("wins"));
  //   $param_losses = trim($_POST("losses"));
  //   $param_earned_run_average = trim($_POST("earned_run_average"));
  //   $param_whip = trim($_POST("whip"));
  //   $param_strike_outs = trim($_POST("strike_outs"));
  //   $param_walks = trim($_POST("walks"));
  //   $param_innings_pitched  = trim($_POST("innings_pitched"));
  // }

        
  // if($stmt = mysqli_prepare($link, $sql)){
  //     // Bind variables to the prepared statement as parameters
  //     mysqli_stmt_bind_param($stmt, "s", $param_username);
      
  //     // Set parameters
  //     $param_username = trim($_POST["username"]);
      
  //     // Attempt to execute the prepared statement
  //     if(mysqli_stmt_execute($stmt)){
  //         /* store result */
  //         mysqli_stmt_store_result($stmt);
          
  //         if(mysqli_stmt_num_rows($stmt) == 1){
  //             $username_err = "This username is already taken.";
  //         } else{
  //             $username = trim($_POST["username"]);
  //         }
  //     } else{
  //         echo "Oops! Something went wrong. Please try again later.";
  //     }

  //     // Close statement
  //     mysqli_stmt_close($stmt);
  // }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif;
        text-align: center;
        background-color: #501124;
        color: white;
      }
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
        <a class="nav-link" href="forms/index.php">Forms</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="Register.php">Add New User</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="Logout.php">Logout</a>
      </li>

    </ul>
  </div>
</nav>
    <h1 class="white">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Edit site details below.</h1>
    
    <form action="POST">
      <div class="column">
            Add a calendar event<br><br>
            <input type="text" name="gameDate" id="gameDate" placeholder="Game Date"><br>
            <input type="text" name="gameTime" id="gameTime" placeholder="Game Time"><br>
            <input type="text" name="opponent" id="opponent" placeholder="Opponent"><br><br>
            <input type="button" value="Add to calendar">
      </div>
    </form>

    <form action="POST">
      <div class="column">
        Announcements<br><br>
        <input type="text" name="announcement" id="announcement"><br><br>
        <input type="button" value="Add new announcement">
    </div>
    </form>

    <div class="column">
      Player Videos<br><br>
      <input type="file" name="file"><br><br>
      <input type="button" value="Upload new video">
    </div><br>

    <form action="save">
    <?php $players = "SELECT id FROM players WHERE name = ?" ?>

      <!-- <select name="players" id="players"><?php $players?></select><br> -->
      <br>
    </form><br>



<!-- section bellow is for uploading and displaying players info
https://www.w3schools.com/howto/howto_js_popup_form.asp-->


<!-- popup code below-->
<form class="bottom-column" action="">
Choose or add player: <select name="players" id="players"><?php $players?></select><br>
<div id="playersForm">
  <!-- <form action="/action_page.php" class="form-container"> -->
  <link rel="stylesheet" href="popupStyles.css">

    <!-- display a button only if user is logged in  (will need to redirect to forms page)-->
    <form action="PlayersPics.php" method="POST" enctype="multipart/form-data">
    <input type="file" name="file">
    </form><br>

    <!-- user input and save/cancel buttons-->
    <label for="playersName"><b>Name </b></label>
    <input type="text" placeholder="Enter Name" name="playersName" required><br>

    <label for="playersYear"><b>Year </b></label>
    <input type="text" placeholder="Enter Year" name="playersYear" required><br>

    <label for="playersPosition"><b>Position </b></label>
    <input type="text" placeholder="Enter Position" name="playersPosition" required><br>

    Player Name: <input type="text" name="player" id="player" value=$name><br>
      School Year: <input type="text" name="school_year" id="school_year" value=$school_year><br><br>
      Update Stats<br>
      AVG: <input type="text" name="batting_average" id="batting_average" value=$batting_average><br>
      OBP: <input type="text" name="on_base_percentage" id="on_base_percentage" value=$on_base_percentage><br>
      Hits: <input type="text" name="hits" id="hits" value=$hits><br>
      Singles: <input type="text" name="singles" id="singles" value=$singles><br>
      Doubles: <input type="text" name="doubles" id="doubles" value=$doubles><br>
      Triples: <input type="text" name="triples" id="triples" value=$triples><br>
      HRs: <input type="text" name="homeruns" id="homeruns" value=$homeruns><br>
      Stolen Bases: <input type="text" name="stolen_bases" id="stolen_bases" value=$stolen_bases><br>
      Stolen Base Attempts: <input type="text" name="stolen_bases_attempts" id="stolen_bases_attempts" value=$stolen_bases_attempts><br>
      Wins: <input type="text" name="wins" id="wins" value=$wins><br>
      Losses: <input type="text" name="losses" id="losses" value=$losses><br>
      ERA: <input type="text" name="earned_run_average" id="earned_run_average" value=$earned_run_average><br>
      WHIP: <input type="text" name="whip" id="whip" value=$whip><br>
      Strike Outs: <input type="text" name="strike_outs" id="strike_outs" value=$strike_outs><br>
      Walks: <input type="text" name="walks" id="walks" value=$walks><br>
      Innings Pitched: <input type="text" name="innings_pitched" id="innings_pitched" value=$innings_pitched><br><br>

    <button type="submit" class="btn">Submit</button>

</div>
</form>


</body>
</html>