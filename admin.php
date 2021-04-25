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
</style>';

$action = filter_input(INPUT_POST, 'action');
if ($action == null) {
  $action = filter_input(INPUT_GET, 'action');
  if ($action == null) {
    $action = 'view';
  }
}

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
                <input type="submit" class="btn btn-info w-50 shadow-lg" style="margin: 2px;" name="calendarSubmit" value="Add to calendar">
            </form>
            <br>
            <br>
            <form method="POST">
                <h6><b>Delete a calendar event</b></h6>
                <input type="text" name="gameDate" id="gameDate" placeholder="Game Date">
                <input type="text" name="gameTime" id="gameTime" placeholder="Game Time">
                <input type="text" name="opponent" id="opponent" placeholder="Opponent">
                <input type="text" name="homeAway" id="homeAway" placeholder="Home or Away"><br>
                <input type="submit" class="btn btn-info w-50 btn-sm" style="margin: 2px;" name="DeleteCalendarEvent" value="Delete Calendar Event">
            </form>
          </div>

          <?php
              if(isset($_POST['announcementSubmit'])){
                $announcement = $_POST["announcement"];
                $announcementTitle = $_POST["announcementTitle"];

                $filenameAnnouncement = $_FILES["uploadFile"]["name"];
                $tempnameAnnouncement = $_FILES["uploadFile"]["tmp_name"];
                $folder = "Images/".$filenameAnnouncement;
                
                if (empty($announcement) || empty($announcementTitle) || empty($filenameAnnouncement)){
                  echo "Missing required data.";
                } else {
                  require_once('config.php');
                  $query2 = "INSERT INTO announcements (Announcement, AnnouncementTitle, ImagePath) VALUE (?, ?, ?)";
                  $stmt2 = $db->prepare($query2);
                  $stmt2->bindParam(':announcement', $announcement);
                  $stmt2->bindParam(':announcementTitle', $announcementTitle);
                  $stmt2->execute([$announcement, $announcementTitle, $filenameAnnouncement]);
                }
              }
            ?>
          <!--boostrap for boxes/layout-->
          <div class="col-sm-4">
            <form method="POST" enctype="multipart/form-data">
              <input type="file" name="uploadFile"><br>
              <h6><b>Announcement heading</b></h6>
              <textarea name="announcementTitle" id="announcementTitle" cols="30" rows="2"></textarea><br><br>
                <h6><b>Announcement body</b></h6>
              <textarea name="announcement" id="announcement" cols="30" rows="2"></textarea><br>
              <input type="submit" class="btn btn-info w-50 btn-sm" style="margin: 2px;" name="announcementSubmit" value="Add new announcement">
            </form>
          </div>

          <div class="col-sm-4">
          <form method="POST">
            <h6><b>Livestream Video URL</b></h6>
            <input type="hidden" name="action" value="livestream_edit">
            <input type="text" name="livestream" id="livestream" placeholder="https://www.youtube.com/watch?v=..."><br>
            <input type="submit" class="btn btn-info w-50 btn-sm" style="margin: 2px;" value="Add livestream URL">
            <?=$livestream_msg?>
            </form><br>

            <?php
              if(isset($_POST['videoSubmit'])){
                $filenameVideo = $_FILES["uploadfile"]["name"];
                $tempnameVideo = $_FILES["uploadfile"]["tmp_name"];
                $folder = "PlayerVideos/".$filenameVideo;
                
                if (empty($filenameVideo)){
                  echo "Missing required data.";
                } else {
                  require_once('config.php');
                  $videoQuery = "INSERT INTO videos (VideoPath) VALUE (?)";
                  $stmt2 = $db->prepare($videoQuery);
                  $stmt2->execute([$filenameVideo]);

                  if (move_uploaded_file($tempnameVideo, $folder))  {
                    $msg = "Video uploaded successfully";
                  } else{
                    $msg = "Failed to upload video";
              }
                }
              }
            ?>
          <!--boostrap for boxes/layout-->
            <form method="POST" enctype="multipart/form-data">
              <h6><b>Add a player video</b></h6>
              <input type="file" name="uploadfile"><br>
              <input type="submit" class="btn btn-info w-50 btn-sm" style="margin: 2px;" name="videoSubmit" value="Add new video">
            </form>

          </div><br>

      </div>
    </div>
    <!-- END FULL ROW -->

<!-- section bellow is for uploading and displaying players info

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

      $checkQuery = "SELECT * FROM players WHERE PlayerName='$playerName' and PlayerNumber='$playerNumber'";
      $statement = $db->prepare($checkQuery);
      $statement->execute();
      $checkrows = $statement->fetchAll();
      $statement->closeCursor();
      
        $filename = $_FILES["upload_file"]["name"];
        $tempname = $_FILES["upload_file"]["tmp_name"];
        $folder = "PlayersPics/".$filename;
              

      if (empty($atBats) || empty($plateAppearances) || empty($battingAverage) || empty($onBasePercentage) || empty($slugging) || empty($hits) || empty($singles) || empty($doubles) || empty($triples) || empty($homeruns) || empty($runsBattedIn) || empty($stolenBases) || empty($caughtStealing) || empty($inningsPitched) || empty($wins) || empty($losses) || empty($earnedRunAverage) || empty($whip) || empty($strikeOuts) || empty($walks) || empty($opponentBattingAverage || empty($playerName) || empty($playerNumber) || empty($playerPosition) || empty($playerYear))){
        echo "Missing required data.";
      // } elseif ($checkrows>1) {
        // echo "Player exists";
      } else {
        require_once('config.php');
        $query3 = "INSERT INTO players (PlayerName, PlayerNumber, PlayerPosition, PlayerYear,  ImagePath, AB, PA, AVG, OBP, SLG, H, 1B, 2B, 3B, HR, RBI, SB, CS, W, L, ERA, WHIP, SO, BB, BAA, IP) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt3 = $db->prepare($query3);
        
        // Doing this a different way: I'm not writing 21 lines.
        $stmt3->execute([$playerName, $playerNumber, $playerPosition, $playerYear, $filename, $atBats, $plateAppearances, $battingAverage, $onBasePercentage, $slugging, $hits, $singles, $doubles, $triples, $homeruns, $runsBattedIn, $stolenBases, $caughtStealing, $inningsPitched, $wins, $losses, $earnedRunAverage, $whip, $strikeOuts, $walks, $opponentBattingAverage]);
      
            if (move_uploaded_file($tempname, $folder))  {
              $msg = "Image uploaded successfully";
          }else{
              $msg = "Failed to upload image";
        }
      }
    }
?>

<!-- ROW START -->
<div class= "jumbotron jumbotron-fluid">
  <div class= "row">
    <form class=".container-fluid" method="POST" enctype="multipart/form-data">
      
      <div class="col-sm-4 right">
        <b>Add player: </b><br>
        <div id="playersForm">
          <link rel="stylesheet" href="popupStyles.css">
          <input type="file" name="upload_file" value=""><br>
          <b>Name: </b><input type="text" placeholder="Enter Name" name="playerName" required><br>
          <b>Number: </b><input type="text" placeholder="Enter Number" name="playerNumber" required><br>
          <b>Position: </b><input type="text" placeholder="Enter Position" name="playerPosition" required><br>
          <b>School Year: </b> <input type="text" placeholder="Enter Year" name="playerYear" id="playerYear"><br><br>
        </div>
      </div>
    
      <div class= "col-sm-4 right">
        <b>Update Hitting Stats</b><br>
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

      <div class="col-sm-4 right">
        <b>Update Pitching Stats</b><br>
        <b>IP:</b> <input type="text" name="inningsPitched" id="inningsPitched" required><br></h7>
        <b>W:</b> <input type="text" name="wins" id="wins" required><br>
        <b>L:</b> <input type="text" name="losses" id="losses" required><br>
        <b>ERA:</b> <input type="text" name="earnedRunAverage" id="earnedRunAverage" required><br>
        <b>WHIP:</b> <input type="text" name="whip" id="whip" required><br>
        <b>SO:</b> <input type="text" name="strikeOuts" id="strikeOuts" required><br>
        <b>BB:</b> <input type="text" name="walks" id="walks" required><br>
        <b>BAA:</b> <input type="text" name="opponentBattingAverage" id="opponentBattingAverage" required><br><br>
      </div>
      <input type="submit" name="playerSubmit" class="btn btn-info w-50 shadow-lg" style="margin: 2px;" value="Add Player">
    </form>
  </div>
</div>

<?php foreach ($players as $player): ?>

<?php

if(isset($_POST['updatePlayer'])){

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

      $filename = $_FILES["upload_file"]["name"];
      $tempname = $_FILES["upload_file"]["tmp_name"];
      $folder = "PlayersPics/".$filename;

  $playerID = $player['PlayersID'];

  $updateQuery = "UPDATE players
  SET (PlayerName = $playerName, PlayerNumber = $playerNumber, PlayerPosition = $playerPosition, PlayerYear = $playerYear, ImagePath = $filename, AB = $atBats, PA = $plateAppearances, AVG = $battingAverage, OBP = $onBasePercentage, SLG = $slugging, H = $hits, 1B = $singles, 2B = $doubles, 3B = $triples, HR = $homeruns, RBI = $runsBattedIn, SB = $stolenBases, CS = $caughtStealing, IP = $inningsPitched, W = $wins, L = $losses, ERA = $earnedRunAverage, WHIP = $whip, SO = $strikeOuts, BB = $walks, BAA = $opponentBattingAverage)
  -- SET (PlayerName, PlayerNumber, PlayerPosition, PlayerYear, ImagePath, AB, PA, AVG, OBP, SLG, H, 1B, 2B, 3B, HR, RBI, SB, CS, IP, W, L, ERA, WHIP, SO, BB, BAA) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
  WHERE PlayersID = $playerID;";

  $statement = $db->prepare($updateQuery);
  $statement->execute([$playerName, $playerNumber, $playerPosition, $playerYear, $filename, $atBats, $plateAppearances, $battingAverage, $onBasePercentage, $slugging, $hits, $singles, $doubles, $triples, $homeruns, $runsBattedIn, $stolenBases, $caughtStealing, $inningsPitched, $wins, $losses, $earnedRunAverage, $whip, $strikeOuts, $walks, $opponentBattingAverage]);
  // $statement->execute();
  $statement->closeCursor();
}
?>

<div class= "jumbotron jumbotron-fluid">
  <div class= "row">
    <form class=".container-fluid" method="POST" enctype="multipart/form-data">
      <b>Edit player: </b><br>
          <div class="col-sm-4 right">
        <div id="playersForm">
          <link rel="stylesheet" href="popupStyles.css">
          <input type="file" name="upload_file" value="<?=$player['ImagePath']?>"><br>
          <b>Name: </b><input type="text" value="<?=$player['PlayerName']?>" name="playerName" required><br>
          <b>Number: </b><input type="text" value="<?=$player['PlayerNumber']?>" name="playerNumber" required><br>
          <b>Position: </b><input type="text" value="<?=$player['PlayerPosition']?>" name="playerPosition" required><br>
          <b>School Year: </b> <input type="text" value="<?=$player['PlayerYear']?>" name="playerYear" id="playerYear"><br><br>
        </div>
        </div>
    
        <div class= "col-sm-4 right">
        <b>Update Hitting Stats</b><br>
        <b>AB:</b> <input type="text" name="atBats" value="<?=$player['AB']?>" id="atBats" required><br>
        <b>PA:</b> <input type="text" name="plateAppearances" value="<?=$player['PA']?>" id="plateAppearances" required><br>
        <b>AVG:</b> <input type="text" name="battingAverage" value="<?=$player['AVG']?>" id="battingAverage" required><br>
        <b>OBP:</b> <input type="text" name="onBasePercentage" value="<?=$player['OBP']?>" id="onBasePercentage" required><br>
        <b>SLG:</b> <input type="text" name="slugging" value="<?=$player['SLG']?>" id="slugging" required><br>
        <b>H:</b> <input type="text" name="hits" value="<?=$player['H']?>" id="hits" required><br>
        <b>1B:</b> <input type="text" name="singles" value="<?=$player['1B']?>" id="singles" required><br>
        <b>2B:</b> <input type="text" name="doubles" value="<?=$player['2B']?>" id="doubles" required><br>
        <b>3B:</b> <input type="text" name="triples" value="<?=$player['3B']?>" id="triples" required><br>
        <b>HR:</b> <input type="text" name="homeruns" value="<?=$player['HR']?>" id="homeruns" required><br>
        <b>RBI:</b> <input type="text" name="runsBattedIn" value="<?=$player['RBI']?>" id="runsBattedIn" required><br>
        <b>SB:</b> <input type="text" name="stolenBases" value="<?=$player['SB']?>" id="stolenBases" required><br>
        <b>CS:</b> <input type="text" name="caughtStealing" value="<?=$player['CS']?>" id="caughtStealing" required><br>
        </div>

        <div class="col-sm-4 right">
        <b>Update Pitching Stats</b><br>
        <b>IP:</b> <input type="text" name="inningsPitched" value="<?=$player['IP']?>" id="inningsPitched" required><br></h7>
        <b>W:</b> <input type="text" name="wins" value="<?=$player['W']?>" id="wins" required><br>
        <b>L:</b> <input type="text" name="losses" value="<?=$player['L']?>" id="losses" required><br>
        <b>ERA:</b> <input type="text" name="earnedRunAverage" value="<?=$player['ERA']?>" id="earnedRunAverage" required><br>
        <b>WHIP:</b> <input type="text" name="whip" value="<?=$player['WHIP']?>" id="whip" required><br>
        <b>SO:</b> <input type="text" name="strikeOuts" value="<?=$player['SO']?>" id="strikeOuts" required><br>
        <b>BB:</b> <input type="text" name="walks" value="<?=$player['BB']?>" id="walks" required><br>
        <b>BAA:</b> <input type="text" name="opponentBattingAverage" value="<?=$player['BAA']?>" id="opponentBattingAverage" required><br><br>
        </div>
        <input type="submit" name="updatePlayer" class="btn btn-info w-50 shadow-lg" style="margin: 2px;" value="Update Player">
    </form>
  </div>
</div>
<?php endforeach?>



</body>
</html>