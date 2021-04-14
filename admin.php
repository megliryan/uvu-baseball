<?php
$title = "Welcome";
// Initialize the session
session_start();
require('config.php');
 
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

$action = filter_input(INPUT_POST, 'action');
if ($action == null) {
  $action = filter_input(INPUT_GET, 'action');
  if ($action == null) {
    $action = 'view';
  }
}

$livestream_msg = '';
// Matches a youtube watch URL
if ($action == 'livestream_edit') {
  $link = filter_input(INPUT_POST, 'livestream');
  if (!$link) {
    $livestream_msg = 'Must enter a video URL!';
  } else {
    // Try to regex match the video link.
    $youtube_regex = '/^https:\/\/www.youtube.com\/watch\?v=(.{11})$/';
    if (preg_match($youtube_regex, $link, $matches)) {
      // The entry is indeed a youtube link
      $video_id = $matches[1];
      // Clear the livestream table (we only want 1)
      // No need to sanitize at this point.
      $db->query('DELETE FROM livestream;');
      $query = 'INSERT INTO livestream (url) values (:video_id);';
      $stmt = $db->prepare($query);
      $stmt->bindParam(':video_id', $video_id);
      $stmt->execute();
      if ($stmt->rowCount()) {
        $livestream_msg = "Video changed successfully!";
      } else {
        $livestream_msg = "Error changing video.";
      }
    } else {
      $livestream_msg = "Must be a YouTube 'watch' URL!";
    }
  }
}

include('views/header.php');
?>
    <h1 class="white">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Edit site details below.</h1>

    <!-- FULL ROW -->
    <div class="jumbotron jumbotron-fluid">
      <div class="row">
          <div class="col-sm-4">
            <!-- posts to schedule page-->
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
                  $query = "INSERT INTO schedule (GameDate, GameTime, Opponent, HomeAway) VALUES (:gameDate, :gameTime, :opponent, :homeAway)";
                  $stmt = $db->prepare($query);
                  $stmt->bindParam(':gameDate', $gameDate);
                  $stmt->bindParam(':gameTime', $gameTime);
                  $stmt->bindParam(':opponent', $opponent);
                  $stmt->bindParam(':homeAway', $homeAway);
                  $stmt->execute();
                }
              }
            ?>

            <form method="POST">
                <h6><b>Add a calendar event</b></h6>
                <input type="text" name="gameDate" id="gameDate" placeholder="Game Date">
                <input type="text" name="gameTime" id="gameTime" placeholder="Game Time">
                <input type="text" name="opponent" id="opponent" placeholder="Opponent">
                <input type="text" name="homeAway" id="homeAway" placeholder="Home or Away"><br>
                <input type="submit" class="btn" name="calendarSubmit" value="Add to calendar">
            </form>
          </div>

          <?php
              if(isset($_POST['announcementSubmit'])){
                $announcement = $_POST["announcement"];
                
                if (empty($announcement)){
                  echo "Missing required data.";
                } else {
                  require_once('config.php');
                  $query2 = "INSERT INTO announcements (Announcement) VALUE (:announcement)";
                  $stmt2 = $db->prepare($query2);
                  $stmt2->bindParam(':announcement', $announcement);
                  $stmt2->execute();
                }
              }
            ?>
          <!--boostrap for boxes/layout-->
          <div class="col-sm-4">
            <form method="POST">
              <h6><b>Announcement heading</b></h6>
              <textarea name="announcement" id="announcement" cols="30" rows="2"></textarea><br>
              <input type="submit" class="btn" name="announcementSubmit" value="Add new announcement">
            </form> <br
            <h6><b>Announcement body</b></h6>
              <textarea name="announcement" id="announcement" cols="30" rows="2"></textarea><br>
              <input type="submit" class="btn" name="announcementSubmit" value="Add new announcement">
            </form>
          </div>

          <div class="col-sm-4">
          <form method="POST">
            <h6><b>Livestream Video URL</b></h6>
            <input type="hidden" name="action" value="livestream_edit">
            <input type="text" name="livestream" id="livestream" placeholder="https://www.youtube.com/watch?v=..."><br>
            <input type="submit" class="btn" value="Add livestream URL">
            <?=$livestream_msg?>
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

    if(isset($_POST['playerSubmit'])){
      $playerName = $_POST["playerName"];
      $playerNumber = $_POST["playerNumber"];
      $playerPosition = $_POST["playerPosition"];
      $playerYear = $_POST["playerYear"];

      $atBats = $_POST["atBats"];
      $plateAppearances = $_POST["plateAppearances"];
      $battingAverage = $_POST["battingAverage"];
      $onBasePercentage = $_POST["onBasePercentage"];
      $slugging = $_POST["slugging"];
      $hits = $_POST["hits"];
      $singles = $_POST["singles"];
      $doubles = $_POST["doubles"];
      $triples = $_POST["triples"];
      $homeruns = $_POST["homeruns"];
      $runsBattedIn = $_POST["runsBattedIn"];
      $stolenBases = $_POST["stolenBases"];
      $caughtStealing = $_POST["caughtStealing"];
      $inningsPitched = $_POST["inningsPitched"];
      $wins = $_POST["wins"];
      $losses = $_POST["losses"];
      $earnedRunAverage = $_POST["earnedRunAverage"];
      $whip = $_POST["whip"];
      $strikeOuts = $_POST["strikeOuts"];
      $walks = $_POST["walks"];
      $opponentBattingAverage = $_POST["opponentBattingAverage"];
      
      if (empty($atBats) || empty($plateAppearances) || empty($battingAverage) || empty($onBasePercentage) || empty($slugging) || empty($hits) || empty($singles) || empty($doubles) || empty($triples) || empty($homeruns) || empty($runsBattedIn) || empty($stolenBases) || empty($caughtStealing) || empty($inningsPitched) || empty($wins) || empty($losses) || empty($earnedRunAverage) || empty($whip) || empty($strikeOuts) || empty($walks) || empty($opponentBattingAverage || empty($playerName) || empty($playerNumber) || empty($playerPosition) || empty($playerYear))){
        echo "Missing required data.";
      } else {
        require_once('config.php');
        $query3 = "INSERT INTO stats (AB, PA, AVG, OBP, SLG, H, 1B, 2B, 3B, HR, RBI, SB, CS, W, L, ERA, WHIP, SO, BB, BAA, IP) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        // Parameters to be added in the 'execute' step.
        $query4 = "INSERT INTO players (playerName, playerNumber, playerPosition, playerYear) VALUES (:playerName, :playerNumber, :playerPosition, :layerYear)";
        $stmt3 = $db->prepare($query3);
        
        // Doing this a different way: I'm not writing 21 lines.
        $stmt3->execute([$atBats, $plateAppearances, $battingAverage, $onBasePercentage, $slugging, $hits, $singles, $doubles, $triples, $homeruns, $runsBattedIn, $stolenBases, $caughtStealing, $inningsPitched, $wins, $losses, $earnedRunAverage, $whip, $strikeOuts, $walks, $opponentBattingAverage]);
        
        $stmt4 = $db->prepare($query4);
        // Chose the way I was taught for readability.
        $stmt4->bindParam(':playerName', $playerName);
        $stmt4->bindParam(':playerNumber', $playerNumber);
        $stmt4->bindParam(':playerPosition', $playerPosition);
        $stmt4->bindParam(':playerYear', $playerYear);
        $stmt4->execute();
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
          <!-- </form><br> -->
          <!-- user input and save/cancel buttons-->
          <b>Name: </b><input type="text" placeholder="Enter Name" name="playerName" required><br>
          <b>Number: </b><input type="text" placeholder="Enter Number" name="playerNumber" required><br>
          <b>Position: </b><input type="text" placeholder="Enter Position" name="playerPosition" required><br>
          <b>School Year: </b> <input type="text" placeholder="Enter Year" name="playerYear" id="playerYear"><br><br>
        </div>
      </div>
    
      <div class= "col-sm-4 right">
        <b>Update Hitting Stats</b><br>
        <b>AB:</b> <input type="text" name="atBats" id="atBats"><br>
        <b>PA:</b> <input type="text" name="plateAppearances" id="plateAppearances"><br>
        <b>AVG:</b> <input type="text" name="battingAverage" id="battingAverage"><br>
        <b>OBP:</b> <input type="text" name="onBasePercentage" id="onBasePercentage"><br>
        <b>SLG:</b> <input type="text" name="slugging" id="slugging"><br>
        <b>H:</b> <input type="text" name="hits" id="hits"><br>
        <b>1B:</b> <input type="text" name="singles" id="singles"><br>
        <b>2B:</b> <input type="text" name="doubles" id="doubles"><br>
        <b>3B:</b> <input type="text" name="triples" id="triples"><br>
        <b>HR:</b> <input type="text" name="homeruns" id="homeruns"><br>
        <b>RBI:</b> <input type="text" name="runsBattedIn" id="runsBattedIn"><br>
        <b>SB:</b> <input type="text" name="stolenBases" id="stolenBases"><br>
        <b>CS:</b> <input type="text" name="caughtStealing" id="caughtStealing"><br>
      </div>

      <div class="col-sm-4 right">
        <b>Update Pitching Stats</b><br>
        <b>IP:</b> <input type="text" name="inningsPitched" id="inningsPitched"><br></h7>
        <b>W:</b> <input type="text" name="wins" id="wins"><br>
        <b>L:</b> <input type="text" name="losses" id="losses"><br>
        <b>ERA:</b> <input type="text" name="earnedRunAverage" id="earnedRunAverage"><br>
        <b>WHIP:</b> <input type="text" name="whip" id="whip"><br>
        <b>SO:</b> <input type="text" name="strikeOuts" id="strikeOuts"><br>
        <b>BB:</b> <input type="text" name="walks" id="walks"><br>
        <b>BAA:</b> <input type="text" name="opponentBattingAverage" id="opponentBattingAverage"><br><br>
      </div>
      <input type="submit" name="playerSubmit" class="btn" value="Add Player">
    </form>
  </div>
</div>


</body>
</html>