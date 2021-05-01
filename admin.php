<?php
$title = "Welcome";
// Initialize the session
session_start();
require('config.php');

$success = false;
$error = false;
$successMessage = "";
$errorMessage = "";

 
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
    $error = true;
    $errorMessage = "Missing required data for calendar event.";
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
    $success = true;
    $successMessage = "Calendar event added successfully.";
  }
}

// DELETE CALENDAR EVENT
if(isset($_POST['deleteCalendarEvent'])){
  $scheduleID = $_POST['ScheduleID'];
  
  $delQuery = "DELETE FROM schedule WHERE ScheduleID = :ScheduleID";
  $delStatement = $db->prepare($delQuery);
  $delStatement->bindValue(':ScheduleID', $scheduleID);
  $delStatement->execute();
  if ($delStatement->rowCount() == 1) {
    $success = true;
    $successMessage = "Event deleted successfully.";
  } else {
    $error = true;
    $errorMessage = "Error deleting calendar event.";
  }
}

// CALENDAR LOOKUP TABLE CODE
// Always runs
$calendarEvents = $db->query("SELECT * FROM schedule");

if (isset($_POST['deleteUser'])) {
  $userIdentifier = explode(';', $_POST['UserIdentifier']);
  if ($userIdentifier[1] == 'adminuser') {
    $query = "DELETE FROM adminusers WHERE id = :userID";
  } else {
    $query = "DELETE FROM users WHERE id = :userID";
  } 
  $stmt = $db->prepare($query);
  $stmt->bindValue(':userID', $userIdentifier[0]);
  $stmt->execute();
  if ($stmt->rowCount() == 1) {
    $success = true;
    $successMessage = "User successfully deleted.";
  } else {
    $error = true;
    $errorMessage = "Error deleting user.";
  }
}

$users = $db->query("SELECT id, username FROM users");
$admins = $db->query("SELECT id, username from adminusers");


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
    $error = true;
    $errorMessage = "Missing data for announcement creation.";
  } else {
    //runs SQL statement to announcements table
    require_once('config.php');
    $query2 = "INSERT INTO announcements (Announcement, AnnouncementTitle, ImagePath) VALUE (?, ?, ?)";
    $stmt2 = $db->prepare($query2);
    $stmt2->execute([$announcement, $announcementTitle, $filenameAnnouncement]);
    if ($stmt2->rowCount() == 1) {
      $success = true;
      $successMessage = "Announcement created successfully!";
      move_uploaded_file($tempnameAnnouncement, $folder);
    } else {
      $error = true;
      $errorMessage = "Error while creating announcement.";
    }
  }
}

// ANNOUNCEMENT DELETE
if (isset($_POST['announcementDelete'])) {
  $announcementID = $_POST['announcementID'];
  $selquery = "SELECT ImagePath FROM announcements WHERE AnnouncementID = :AnnouncementID";
  $selstmt = $db->prepare($selquery);
  $selstmt->bindValue(':AnnouncementID', $announcementID);
  $selstmt->execute();
  $announcementPic = $selstmt->fetch()['ImagePath'];

  $query = "DELETE FROM announcements WHERE AnnouncementID = :AnnouncementID";
  $stmt = $db->prepare($query);
  $stmt->bindValue(':AnnouncementID', $announcementID);
  $stmt->execute();
  if ($stmt->rowCount() == 1) {
    $success = true;
    $successMessage = "Announcement deleted successfully!";
    unlink('images/'.$announcementPic);
  } else {
    $error = true;
    $errorMessage = "Error deleting announcement.";
  }
}

// Announcement list
$announcements = $db->query("SELECT * FROM announcements");

// LIVESTREAM UPDATING CODE
// Edits the livestream video.
if ($action == 'livestream_edit') {
  $link = filter_input(INPUT_POST, 'livestream');
  if (!$link) {
    $error = true;
    $errorMessage = 'Must enter a video URL!';
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
        $success = true;
        $successMessage = "Video changed successfully!";
      } else {
        $error = true;
        $errorMessage = "Error changing video.";
      }
    } else {
      $error = true;
      $errorMessage = "Must be a YouTube 'watch' URL!";
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
    $error = true;
    $errorMessage = "Missing required data for video upload.";
  } else {
    //runs SQL for videos table
    require_once('config.php');
    $videoQuery = "INSERT INTO videos (VideoPath) VALUE (?)";
    $stmt2 = $db->prepare($videoQuery);
    $stmt2->execute([$filenameVideo]);

    //checks to make sure file uploaded correctly
    if (move_uploaded_file($tempnameVideo, $folder))  {
      $success = true;
      $successMessage = "Video uploaded successfully";
    } else{
      $error = true;
      $errorMessage = "Failed to upload video";
    }
  }
}

// VIDEO DELETE
if(isset($_POST['videoDelete'])) {
  $videoID = $_POST['videoID'];
  // Get video ID and delete
  $getVideoStmt = $db->prepare("SELECT * FROM videos WHERE VideoID = :videoID");
  $getVideoStmt->bindValue(':videoID', $videoID);
  $getVideoStmt->execute();
  $videoPath = $getVideoStmt->fetch()['VideoPath'];
  $delVideoStmt = $db->prepare("DELETE FROM videos WHERE VideoID = :videoID");
  $delVideoStmt->bindValue(':videoID', $videoID);
  $delVideoStmt->execute();
  if ($delVideoStmt->rowCount() == 1) {
    unlink('PlayerVideos/'.$videoPath);
    $success = true;
    $successMessage = "Video deleted successfully!";
  }
}

// Get videos
$videos = $db->query("SELECT * FROM videos");

// PLAYER INFO ADD/UPDATE/DELETE

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
    $error = true;
    $errorMessage = "Missing required data for player submission.";

  } elseif ($playerID == 'new') {
    // Add a new player to the database.
    if ($checkrows >= 1) {
      $error = true;
      $errorMessage = "Player with that name and number already exists.";

    } else {
      // Player does not exist, add it to the database.
      $newPlayerQuery = "INSERT INTO players (PlayerName, PlayerNumber, PlayerPosition, PlayerYear,  ImagePath, AB, PA, AVG, OBP, SLG, H, 1B, 2B, 3B, HR, RBI, SB, CS, IP, W, L, ERA, WHIP, SO, BB, BAA) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
      $newPlayerStmt = $db->prepare($newPlayerQuery);
      // Executes, but also sanitizes.
      $newPlayerStmt->execute([$playerName, $playerNumber, $playerPosition, $playerYear, $filename, $atBats, $plateAppearances, $battingAverage, $onBasePercentage, $slugging, $hits, $singles, $doubles, $triples, $homeruns, $runsBattedIn, $stolenBases, $caughtStealing, $inningsPitched, $wins, $losses, $earnedRunAverage, $whip, $strikeOuts, $walks, $opponentBattingAverage]);
      // Move uploaded file into the PlayersPics folder.
      if (move_uploaded_file($tempname, $folder))  {
        //$msg = "Image uploaded successfully";
        // Do we need that?
      } else {
        $error = true;
        $errorMessage = "Failed to upload image";
      }
    }
  } else {
    // Update a player's information.
    if ($_FILES['upload_file']['error'] == UPLOAD_ERR_OK) {
      // It would be UPLOAD_ERROR_NO_FILE if no file is uploaded.
      $updateQuery = "UPDATE players
                      SET PlayerName = ?, PlayerNumber = ?, PlayerPosition = ?, PlayerYear = ?, ImagePath=?, AB=?, PA=?, AVG=?, OBP=?, SLG=?, H=?, 1B=?, 2B=?, 3B=?, HR=?, RBI=?, SB=?, CS=?, IP=?, W=?, L=?, ERA=?, WHIP=?, SO=?, BB=?, BAA=?
                      WHERE PlayersID = ?";
      $updateStmt = $db->prepare($updateQuery);
      $updateStmt->execute([$playerName, $playerNumber, $playerPosition, $playerYear, $filename, $atBats, $plateAppearances, $battingAverage, $onBasePercentage, $slugging, $hits, $singles, $doubles, $triples, $homeruns, $runsBattedIn, $stolenBases, $caughtStealing, $inningsPitched, $wins, $losses, $earnedRunAverage, $whip, $strikeOuts, $walks, $opponentBattingAverage, $playerID]);
    } else {
      $updateQuery = "UPDATE players
                      SET PlayerName = ?, PlayerNumber = ?, PlayerPosition = ?, PlayerYear = ?, AB=?, PA=?, AVG=?, OBP=?, SLG=?, H=?, 1B=?, 2B=?, 3B=?, HR=?, RBI=?, SB=?, CS=?, IP=?, W=?, L=?, ERA=?, WHIP=?, SO=?, BB=?, BAA=?
                      WHERE PlayersID = ?";
      $updateStmt = $db->prepare($updateQuery);
      $updateStmt->execute([$playerName, $playerNumber, $playerPosition, $playerYear, $atBats, $plateAppearances, $battingAverage, $onBasePercentage, $slugging, $hits, $singles, $doubles, $triples, $homeruns, $runsBattedIn, $stolenBases, $caughtStealing, $inningsPitched, $wins, $losses, $earnedRunAverage, $whip, $strikeOuts, $walks, $opponentBattingAverage, $playerID]);
    }
    if ($updateStmt->rowCount() > 0) {
      $success = true;
      $successMessage = "Updated successfully!";
    }
    else {
      $error = true;
      $errorMessage = "Error updating player.";
    }
    move_uploaded_file($tempname, $folder);
    // if (move_uploaded_file($tempname, $folder)) {} else {
    //   $error = true;
    //   $errorMessage = "Failed to upload image";
    // }
  }
} elseif (isset($_POST['playerDelete'])) {
  $playerID = $_POST['playerID'];
  // Just in case.
  if ($playerID == 'new') {
    $error = true;
    $errorMessage = "Must select a player to delete!";
  } else {
    // Get the player so we can delete the image.
    $selquery = "SELECT * FROM players WHERE PlayersID = :playerID";
    $selstmt = $db->prepare($selquery);
    $selstmt->bindValue(':playerID', $playerID);
    $selstmt->execute();
    $deletedPlayer = $selstmt->fetch();
    unlink('PlayersPics/'.$deletedPlayer['ImagePath']);
    // Then actually delete the player.
    $delQuery = "DELETE FROM players WHERE PlayersID = :playerID";
    $delStatement = $db->prepare($delQuery);
    $delStatement->bindValue(':playerID', $playerID);
    $delStatement->execute();
    if ($delStatement->rowCount() == 1) {
      $success = true;
      $successMessage = "Player deleted successfully.";
    } else {
      $error = true;
      $errorMessage = "Error while deleting player.";
    }
  }
}

// Get list of players for the dropdown.
$query = 'SELECT * FROM players';
$statement = $db->prepare($query);
$statement->execute();
$players = $statement->fetchAll();
$statement->closeCursor();

include('views/header.php');
?>

    <h1 class="white">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Edit site details below.</h1>

    <?php // Alert section: Success/Failure
    if ($success):?>
    <div class="alert alert-success p-2 m-3">
      <strong>Success!</strong> <?=$successMessage?>
    </div>
    <?php endif; if ($error):?>
    <div class="alert alert-danger p-2 m-3">
      <strong>Error!</strong> <?=$errorMessage?>
    </div>
    <?php endif;?>

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
              <select name="ScheduleID">
                <?php foreach ($calendarEvents as $event):?>
                <option value="<?=$event['ScheduleID']?>">
                  <?=$event['GameDate']?> <?=$event['GameTime']?> vs <?=$event['Opponent']?>
                </option>
                <?php endforeach;?>
              </select>
              <input type="submit" class="btn btn-info w-50 btn-sm" style="margin: 2px;" name="deleteCalendarEvent" value="Delete Calendar Event">
            </form>

            <form method="POST">
              <h6><b>Delete Users/Admins</b></h6>
              <select name="UserIdentifier">
                <?php foreach($users as $user):?>
                <option value="<?=$user['id']?>;user"><?=$user['username']?></option>
                <?php endforeach;?>
                <?php foreach ($admins as $admin):?>
                <option value="<?=$admin['id']?>;adminuser"><?=$admin['username']?> (Admin)</option>
                <?php endforeach?>
              </select><br>
              <input type="submit" class="btn btn-info w-50 btn-sm" style="margin: 2px;" name="deleteUser" value="Delete User/Admin">
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
            <br>
            <form method="POST">
              <h6><b>Delete Announcement</b></h6>
              <select name="announcementID">
              <?php foreach($announcements as $announcement):?>
                <option value="<?=$announcement['AnnouncementID']?>"><?=$announcement['AnnouncementTitle']?></option>
              <?php endforeach;?>
              </select>
              <input type="submit" class="btn btn-info w-50 btn-sm" style="margin: 2px;" name="announcementDelete" value="Delete Announcement">
            </form>
          </div>

          <!-- html for livestream form -->
          <div class="col-sm-4">
            <form method="POST">
              <h6><b>Livestream Video URL</b></h6>
              <input type="hidden" name="action" value="livestream_edit">
              <input type="text" name="livestream" id="livestream" placeholder="https://www.youtube.com/watch?v=..."><br>
              <input type="submit" class="btn btn-info w-50 btn-sm" style="margin: 2px;" value="Add livestream URL">
            </form><br>

          <!--boostrap for boxes/layout-->
          <!-- html for adding vids form -->
            <form method="POST" enctype="multipart/form-data">
              <h6><b>Add a player video</b></h6>
              <input type="file" name="uploadfile"><br>
              <input type="submit" class="btn btn-info w-50 btn-sm"  name="videoSubmit" value="Add new video">
            </form>
            <br>
            <form method="POST">
              <h6><b>Delete player video</b></h6>
              <select name="videoID">
                <?php foreach ($videos as $video):?><option value="<?=$video['VideoID']?>"><?=htmlspecialchars($video['VideoPath'])?></option><?php endforeach?>
              </select><br>
              <input type="submit" class="btn btn-info w-50 btn-sm" style="margin: 2px;" name="videoDelete" value="Delete video">
            </form>
            <br>
            <a href="forms/manage.php" class="btn btn-info w-50 btm-sm" style="margin: 2px;">Manage Forms</a>
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
            <b>School Year: </b> <input type="text" placeholder="Sophomore, Junior, etc..." name="playerYear" id="playerYear"><br><br>
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
          <input type="submit" name="playerSubmit" class="btn btn-info w-50 shadow-lg" style="margin: 2px;" value="Add Player" id="playerUpdateButton"><br>
          <input type="submit" name="playerDelete" class="btn btn-info w-50 shadow-lg" style="margin: 2px;" value="Delete Player" id="playerDeleteButton" disabled><br>





        </div>
      </div>
    </form>
  </div>

<?php include("views/footer.php");?>
