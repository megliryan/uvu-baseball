<?php
$title = "Welcome";
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || !$_SESSION['is_admin']){
    header("location: admin.php");
    exit;
}

$head = '<style>
body{ font: 14px sans-serif;
text-align: center;
background-color: #501124;
color: white;
}
</style>';

include('views/header.php');
?>
    <h1 class="white">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Edit site details below.</h1>

    <!-- FULL ROW -->
    <div class="jumbotron jumbotron-fluid">
      <div class="row">
          <div class="col-sm-4">

            <?php
              if(isset($_POST['calendarSubmit'])){
                $gameDate = $_POST["gameDate"];
                $gameTime = $_POST["gameTime"];
                $opponent = $_POST["opponent"];
                $homeAway = $_POST["homeAway"];
                
                if (empty($gameDate) || empty($gameTime) || empty($opponent) || empty($homeAway)){
                  echo "Missing required data.";
                } else {
                  require_once('config.php');
                  $query = "INSERT INTO schedule (GameDate, GameTime, Opponent, HomeAway) VALUES ('$gameDate', '$gameTime', '$opponent', '$homeAway')";
                  $db->exec($query);
                }
              }
            ?>

            <form method="POST">
                <h6><b>Add a calendar event</b></h6>
                <input type="text" name="gameDate" id="gameDate" placeholder="Game Date">
                <input type="text" name="gameTime" id="gameTime" placeholder="Game Time">
                <input type="text" name="opponent" id="opponent" placeholder="Opponent">
                <input type="text" name="homeAway" id="homeAway" placeholder="Home or Away"><br>
                <input type="submit" name="calendarSubmit" value="Add to calendar">
            </form>
          </div>

          <?php
              if(isset($_POST['announcementSubmit'])){
                $announcement = $_POST["announcement"];
                
                if (empty($announcement)){
                  echo "Missing required data.";
                } else {
                  require_once('config.php');
                  $query2 = "INSERT INTO announcements (Announcement) VALUE ('$announcement')";
                  $db->exec($query2);
                }
              }
            ?>
        
          <div class="col-sm-4">
            <form method="POST">
              <h6><b>Announcements</b></h6>
              <textarea name="announcement" id="announcement" cols="30" rows="2"></textarea><br>
              <input type="submit" name="announcementSubmit" value="Add new announcement">
            </form> <br>
          </div>

          <div class="col-sm-4">
          <form method="POST">
            <h6><b>Livestream URL</b></h6>
            <input type="text" name="livestream" id="livestream"><br>
            <input type="submit" value="Add livestream URL">
            </form>
          </div>

      </div>
    </div>
    <!-- END FULL ROW -->

<!-- section bellow is for uploading and displaying players info
https://www.w3schools.com/howto/howto_js_popup_form.asp-->


<?php 
require_once "config.php";

global $db;
    $query = 'SELECT * FROM players';
    $statement = $db->prepare($query);
    $statement->execute();
    $players = $statement->fetchAll();
    $statement->closeCursor();

    if(isset($_POST['calendarSubmit'])){
      $gameDate = $_POST["gameDate"];
      $gameTime = $_POST["gameTime"];
      $opponent = $_POST["opponent"];
      $homeAway = $_POST["homeAway"];
      
      if (empty($gameDate) || empty($gameTime) || empty($opponent) || empty($homeAway)){
        echo "Missing required data.";
      } else {
        $query = "INSERT INTO statistics (PostDate, AB, PA, AVG, OBP, SLG, H, 1B, 2B, 3B, HR, RBI, SB, CS, W, L, ERA, WHIP, SO, BB, BAA, IP) VALUES ('$gameDate', '$gameTime', '$opponent', '$homeAway')";
        $db->exec($query);
      }
    }
?>

<!-- ROW START -->
<div class= "jumbotron jumbotron-fluid">
  <div class= "row">
    <form class=".container-fluid" method="POST">
      
      <div class="col-sm-4 right">
        <b>Choose/add player: </b><select name="players"><br>
          <?php foreach ($players as $player): ?> 
          <option value="<?php echo $player;?>"> 
            <?php echo $player['PlayerName'];?>
          </option> <?php endforeach ?>
        </select><br>
        <div id="playersForm">
        <!-- <form action="/action_page.php" class="form-container"> -->
          <link rel="stylesheet" href="popupStyles.css">
          <!-- display a button only if user is logged in  (will need to redirect to forms page)-->
          <form action="PlayersPics.php" method="POST" enctype="multipart/form-data">
            <input type="file" name="file">
          </form><br>
          <!-- user input and save/cancel buttons-->
          <label for="playersName"><b>Name:</b></label>
          <input type="text" placeholder="Enter Name" name="playersName" required><br>
          <label for="playersYear"><b>Year:</b></label>
          <input type="text" placeholder="Enter Year" name="playersYear" required><br>
          <label for="playersPosition"><b>Position:</b></label>
          <input type="text" placeholder="Enter Position" name="playersPosition" required><br>
          <b>School Year:</b> <input type="text" name="school_year" id="school_year" value=$school_year><br><br>
        </div>
      </div>
    
      <div class= "col-sm-4 right">
        <b>Update Hitting Stats</b><br>
        <b>AB:</b> <input type="text" name="at-bats" id="at-bats"><br>
        <b>PA:</b> <input type="text" name="plate-appearances" id="plate-appearances"><br>
        <b>AVG:</b> <input type="text" name="batting_average" id="batting_average" value=$batting_average><br>
        <b>OBP:</b> <input type="text" name="on_base_percentage" id="on_base_percentage" value=$on_base_percentage><br>
        <b>SLG:</b> <input type="text" name="slugging" id="slugging"><br>
        <b>H:</b> <input type="text" name="hits" id="hits" value=$hits><br>
        <b>1B:</b> <input type="text" name="singles" id="singles" value=$singles><br>
        <b>2B:</b> <input type="text" name="doubles" id="doubles" value=$doubles><br>
        <b>3B:</b> <input type="text" name="triples" id="triples" value=$triples><br>
        <b>HR:</b> <input type="text" name="homeruns" id="homeruns" value=$homeruns><br>
        <b>RBI:</b> <input type="text" name="runs-batted-in" id="runs-batted-in"><br>
        <b>SB:</b> <input type="text" name="stolen_bases" id="stolen_bases" value=$stolen_bases><br>
        <b>CS:</b> <input type="text" name="caught-stealing" id="caught-stealing"><br>
      </div>

      <div class="col-sm-4 right">
        <b>Update Pitching Stats</b><br>
        <b>IP:</b> <input type="text" name="innings_pitched" id="innings_pitched" value=$innings_pitched><br></h7>
        <b>W:</b> <input type="text" name="wins" id="wins" value=$wins><br>
        <b>L:</b> <input type="text" name="losses" id="losses" value=$losses><br>
        <b>ERA:</b> <input type="text" name="earned_run_average" id="earned_run_average" value=$earned_run_average><br>
        <b>WHIP:</b> <input type="text" name="whip" id="whip" value=$whip><br>
        <b>SO:</b> <input type="text" name="strike_outs" id="strike_outs" value=$strike_outs><br>
        <b>BB:</b> <input type="text" name="walks" id="walks" value=$walks><br>
        <b>BAA:</b> <input type="text" name="opponent-batting-average" id="opponent-batting-average"><br><br>
        <button type="submit" name="playerSubmit" class="btn">Submit</button>
      </div>
    </form>
  </div>
</div>


</body>
</html>