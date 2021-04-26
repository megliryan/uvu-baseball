<?php
$title = "Welcome";
// Initialize the session
session_start();
require('config.php');
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || !$_SESSION['is_admin']){
    header("location: login.php");
    exit;
}

$head = '<style>
body{ font: 14px sans-serif;
text-align: center;
background-color: #501124;
color: white;
}
</style>
<script src="playeredit.js"></script>';

$action = filter_input(INPUT_POST, 'action');
if ($action == null) {
  $action = filter_input(INPUT_GET, 'action');
  if ($action == null) {
    $action = 'view';
  }
}

// ADD CALENDAR EVENT
if(isset($_POST['calendarSubmit'])){
  $gameDate = $_POST["gameDate"];
  $gameTime = $_POST["gameTime"];
  $opponent = $_POST["opponent"];
  $homeAway = $_POST["homeAway"];
  
  // Check for missing data
  if (empty($gameDate) || empty($gameTime) || empty($opponent) || empty($homeAway)){
    echo "Missing required data.";
  } else {
    //Run SQL query for schedule table
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

// DELETE CALENDAR EVENT
if(isset($_POST['deleteCalendarEvent'])){
  $gameDate = $_POST["gameDate"];
  $gameTime = $_POST["gameTime"];
  $opponent = $_POST["opponent"];
  $homeAway = $_POST["homeAway"];
  
  // Check for missing data
  if (empty($gameDate) || empty($gameTime) || empty($opponent) || empty($homeAway)){
    echo "Missing required data.";
  } else {
    //Run SQL query for schedule table
    require_once('config.php');
    $deleteQuery = "DELETE FROM schedule WHERE GameDate = $gameDate, GameTime = $gameTime, Opponent = $opponent, HomeAway = $homeAway";
    $stmt = $db->prepare($deleteQuery);
    $stmt->bindParam(':gameDate', $gameDate);
    $stmt->bindParam(':gameTime', $gameTime);
    $stmt->bindParam(':opponent', $opponent);
    $stmt->bindParam(':homeAway', $homeAway);
    $stmt->execute([$gameDate, $gameTime, $opponent, $homeAway]);
  }
}

// ANNOUNCEMENT CREATE
if(isset($_POST['announcementSubmit'])){
  $announcement = $_POST["announcement"];
  $announcementTitle = $_POST["announcementTitle"];
  // uploads picture to Images folder
  $filenameAnnouncement = $_FILES["uploadFile"]["name"];
  $tempnameAnnouncement = $_FILES["uploadFile"]["tmp_name"];
  $folder = "Images/".$filenameAnnouncement;
  
  // checks for missing data
  if (empty($announcement) || empty($announcementTitle) || empty($filenameAnnouncement)){
    echo "Missing required data.";
  } else {
    //runs SQL statement to announcements table
    require_once('config.php');
    $query2 = "INSERT INTO announcements (Announcement, AnnouncementTitle, ImagePath) VALUE (?, ?, ?)";
    $stmt2 = $db->prepare($query2);
    $stmt2->bindParam(':announcement', $announcement);
    $stmt2->bindParam(':announcementTitle', $announcementTitle);
    $stmt2->execute([$announcement, $announcementTitle, $filenameAnnouncement]);
  }
}


// LIVESTREAM UPDATING CODE
$livestream_msg = '';
// Edits the livestream video.
if ($action == 'livestream_edit') {
  $link = filter_input(INPUT_POST, 'livestream');
  if (!$link) {
    $livestream_msg = 'Must enter a video URL!';
  } else {
    // Try to regex match the video link.
    // Matches a youtube watch URL
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

// VIDEO ADD
if(isset($_POST['videoSubmit'])){
  //uploads video to PlayerVideos folder
  $filenameVideo = $_FILES["uploadfile"]["name"];
  $tempnameVideo = $_FILES["uploadfile"]["tmp_name"];
  $folder = "PlayerVideos/".$filenameVideo;
  
  //checks for missing data
  if (empty($filenameVideo)){
    echo "Missing required data.";
  } else {
    //runs SQL for videos table
    require_once('config.php');
    $videoQuery = "INSERT INTO videos (VideoPath) VALUE (?)";
    $stmt2 = $db->prepare($videoQuery);
    $stmt2->execute([$filenameVideo]);

    //checks to make sure file uploaded correctly
    if (move_uploaded_file($tempnameVideo, $folder))  {
      $msg = "Video uploaded successfully";
    } else{
      $msg = "Failed to upload video";
    }
  }
}

// PLAYER INFO ADD/UPDATE

global $db;
// Get list of players for the dropdown.
$query = 'SELECT * FROM players';
$statement = $db->prepare($query);
$statement->execute();
$players = $statement->fetchAll();
$statement->closeCursor();

// Checks if playerSubmit button is pressed
if(isset($_POST['playerSubmit'])){
  $playerID = filter_input(INPUT_POST, 'playerID');
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

  $checkQuery = "SELECT * FROM players WHERE PlayerName=:playerName and PlayerNumber=:playerNumber";
  $statement = $db->prepare($checkQuery);
  $statement->bindParam(':playerName', $playerName);
  $statement->bindParam(':playerNumber', $playerNumber);
  $statement->execute();
  $checkrows = $statement->rowCount();
  $statement->closeCursor();
  
  //uploads picture to PlayersPics
  $filename = $_FILES["upload_file"]["name"];
  $tempname = $_FILES["upload_file"]["tmp_name"];
  $folder = "PlayersPics/".$filename;
          

  if (empty($atBats) || empty($plateAppearances) || empty($battingAverage) || empty($onBasePercentage) || empty($slugging) || empty($hits) || empty($singles) || empty($doubles) || empty($triples) || empty($homeruns) || empty($runsBattedIn) || empty($stolenBases) || empty($caughtStealing) || empty($inningsPitched) || empty($wins) || empty($losses) || empty($earnedRunAverage) || empty($whip) || empty($strikeOuts) || empty($walks) || empty($opponentBattingAverage || empty($playerName) || empty($playerNumber) || empty($playerPosition) || empty($playerYear))){
    // If any fields are empty, reject the input.
    echo "Missing required data.";

  } elseif ($playerID == 'new') {
    // Add a new player to the database.
    if ($checkrows >= 1) {
      echo "Player with that name and number already exists.";

    } else {
      // Player does not exist, add it to the database.
      $newPlayerQuery = "INSERT INTO players (PlayerName, PlayerNumber, PlayerPosition, PlayerYear,  ImagePath, AB, PA, AVG, OBP, SLG, H, 1B, 2B, 3B, HR, RBI, SB, CS, IP, W, L, ERA, WHIP, SO, BB, BAA) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
      $newPlayerStmt = $db->prepare($newPlayerQuery);
      // Executes, but also sanitizes.
      $newPlayerStmt->execute([$playerName, $playerNumber, $playerPosition, $playerYear, $filename, $atBats, $plateAppearances, $battingAverage, $onBasePercentage, $slugging, $hits, $singles, $doubles, $triples, $homeruns, $runsBattedIn, $stolenBases, $caughtStealing, $inningsPitched, $wins, $losses, $earnedRunAverage, $whip, $strikeOuts, $walks, $opponentBattingAverage]);
      // Move uploaded file into the PlayersPics folder.
      if (move_uploaded_file($tempname, $folder))  {
          $msg = "Image uploaded successfully";
      } else {
          $msg = "Failed to upload image";
      }
    }
  } else {
    // Update a player's information.
    $updateQuery = "UPDATE players
                    SET PlayerName = ?, PlayerNumber = ?, PlayerPosition = ?, PlayerYear = ?, ImagePath=?, AB=?, PA=?, AVG=?, OBP=?, SLG=?, H=?, 1B=?, 2B=?, 3B=?, HR=?, RBI=?, SB=?, CS=?, IP=?, W=?, L=?, ERA=?, WHIP=?, SO=?, BB=?, BAA=?
                    WHERE PlayersID = ?";
    $updateStmt = $db->prepare($updateQuery);
    $updateStmt->execute([$playerName, $playerNumber, $playerPosition, $playerYear, $filename, $atBats, $plateAppearances, $battingAverage, $onBasePercentage, $slugging, $hits, $singles, $doubles, $triples, $homeruns, $runsBattedIn, $stolenBases, $caughtStealing, $inningsPitched, $wins, $losses, $earnedRunAverage, $whip, $strikeOuts, $walks, $opponentBattingAverage, $playerID]);
    if ($updateStmt->rowCount() > 0) {
      echo "Updated successfully!";
    }
    else {
      echo "Error updating player.";
    }
    if (move_uploaded_file($tempname, $folder)) {} else {
      $msg = "Failed to upload image";
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
            <!-- html for calendar submit form -->
            <form method="POST">
              <h6><b>Add a calendar event</b></h6>
              <input type="text" name="gameDate" id="gameDate" placeholder="Game Date">
              <input type="text" name="gameTime" id="gameTime" placeholder="Game Time">
              <input type="text" name="opponent" id="opponent" placeholder="Opponent">
              <input type="text" name="homeAway" id="homeAway" placeholder="Home or Away"><br>
              <input type="submit" class="btn btn-info w-50 shadow-lg" style="margin: 2px;" name="calendarSubmit" value="Add to calendar">
            </form>
            <br>
            <br>

            <!-- html for calendar delete form -->
            <form method="POST">
              <h6><b>Delete a calendar event</b></h6>
              <input type="text" name="gameDate" id="gameDate" placeholder="Game Date">
              <input type="text" name="gameTime" id="gameTime" placeholder="Game Time">
              <input type="text" name="opponent" id="opponent" placeholder="Opponent">
              <input type="text" name="homeAway" id="homeAway" placeholder="Home or Away"><br>
              <input type="submit" class="btn btn-info w-50 btn-sm" style="margin: 2px;" name="deleteCalendarEvent" value="Delete Calendar Event">
            </form>
          </div>

          <!--boostrap for boxes/layout-->
          <!-- html for announcement form -->
          <div class="col-sm-4">
            <form method="POST" enctype="multipart/form-data">
              <h6><b>Announcement picture</b></h6>
              <input type="file" name="uploadFile"><br><br>

              <h6><b>Announcement heading</b></h6>
              <textarea name="announcementTitle" id="announcementTitle" cols="30" rows="2"></textarea><br><br>

              <h6><b>Announcement body</b></h6>
              <textarea name="announcement" id="announcement" cols="30" rows="2"></textarea><br>
              <input type="submit" class="btn btn-info w-50 btn-sm" style="margin: 2px;" name="announcementSubmit" value="Add new announcement">
            </form>
          </div>

          <!-- html for livestream form -->
          <div class="col-sm-4">
            <form method="POST">
              <h6><b>Livestream Video URL</b></h6>
              <input type="hidden" name="action" value="livestream_edit">
              <input type="text" name="livestream" id="livestream" placeholder="https://www.youtube.com/watch?v=..."><br>
              <input type="submit" class="btn btn-info w-50 btn-sm" style="margin: 2px;" value="Add livestream URL">
              <?=$livestream_msg?>
            </form><br>

          <!--boostrap for boxes/layout-->
          <!-- html for adding or deleting players form -->
            <form method="POST" enctype="multipart/form-data">
              <h6><b>Add a player video</b></h6>
              <input type="file" name="uploadfile"><br>
              <input type="submit" class="btn btn-info w-50 btn-sm" style="margin: 2px;" name="videoSubmit" value="Add new video">
            </form>
          </div><br>
      </div>
    </div>
    <!-- END FULL ROW -->

<!-- section bellow is for uploading and displaying players info. -->

<!-- ROW START -->
<div class= "jumbotron jumbotron-fluid">
    <form class=".container-fluid" method="POST" enctype="multipart/form-data">
      <div class= "row">
      
        <!-- First column of player stats -->
        <div class="col-sm-4 right">
          <b>Select player: </b><br>
          <!-- Dropdown for players -->
          <select name="playerID" id="playerID" onchange="getPlayerStats()">
            <option value="new" selected>New Player</option>
            <?php foreach ($players as $player):?><option value="<?=$player['PlayersID']?>"><?=$player['PlayerName']?></option><?php endforeach?>
          </select>
          <div id="playersForm">
            <input type="file" name="upload_file" value=""><br>
            <b>Name: </b><input type="text" placeholder="Enter Name" name="playerName" id="playerName" required><br>
            <b>Number: </b><input type="text" placeholder="Enter Number" name="playerNumber" id="playerNumber" required><br>
            <b>Position: </b><input type="text" placeholder="Enter Position" name="playerPosition" id="playerPosition" required><br>
            <b>School Year: </b> <input type="text" placeholder="Enter Year" name="playerYear" id="playerYear"><br><br>
          </div>
        </div>
    
        <!-- Second column of player stats -->
        <div class="col-sm-4 right">
          <b>Hitting Stats</b><br>
          <b>AB:</b> <input type="text" name="atBats" id="atBats" required><br>
          <b>PA:</b> <input type="text" name="plateAppearances" id="plateAppearances" required><br>
          <b>AVG:</b> <input type="text" name="battingAverage" id="battingAverage" required><br>
          <b>OBP:</b> <input type="text" name="onBasePercentage" id="onBasePercentage" required><br>
          <b>SLG:</b> <input type="text" name="slugging" id="slugging" required><br>
          <b>H:</b> <input type="text" name="hits" id="hits" required><br>
          <b>1B:</b> <input type="text" name="singles" id="singles" required><br>
          <b>2B:</b> <input type="text" name="doubles" id="doubles" required><br>
          <b>3B:</b> <input type="text" name="triples" id="triples" required><br>
          <b>HR:</b> <input type="text" name="homeruns" id="homeruns" required><br>
          <b>RBI:</b> <input type="text" name="runsBattedIn" id="runsBattedIn" required><br>
          <b>SB:</b> <input type="text" name="stolenBases" id="stolenBases" required><br>
          <b>CS:</b> <input type="text" name="caughtStealing" id="caughtStealing" required><br>
        </div>
        
        <!-- Third column of player stats -->
        <div class="col-sm-4 right">
          <b>Pitching Stats</b><br>
          <b>IP:</b> <input type="text" name="inningsPitched" id="inningsPitched" required><br></h7>
          <b>W:</b> <input type="text" name="wins" id="wins" required><br>
          <b>L:</b> <input type="text" name="losses" id="losses" required><br>
          <b>ERA:</b> <input type="text" name="earnedRunAverage" id="earnedRunAverage" required><br>
          <b>WHIP:</b> <input type="text" name="whip" id="whip" required><br>
          <b>SO:</b> <input type="text" name="strikeOuts" id="strikeOuts" required><br>
          <b>BB:</b> <input type="text" name="walks" id="walks" required><br>
          <b>BAA:</b> <input type="text" name="opponentBattingAverage" id="opponentBattingAverage" required><br><br>
          <input type="submit" name="playerSubmit" class="btn btn-info w-50 shadow-lg" style="margin: 2px;" value="Add Player" id="playerUpdateButton">
        </div>
      </div>
    </form>
  </div>

<?php include("views/footer.php");?>
