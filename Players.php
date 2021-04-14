<?php 
$title = "Roster";
include('views/header.php');
require_once('config.php');

$action = filter_input(INPUT_POST, 'action');
if ($action == null) {
  $action = filter_input(INPUT_GET, 'action');
  if ($action == null) {
    $action = 'list';
  }
}

$message = '';
// If a player is selected to view
if ($action == 'view_player') {
  $player_id = filter_input(INPUT_POST, 'player');

  $query = 'SELECT * FROM Players WHERE PlayerID = :player_id';
  $stmt = $db->prepare($query);
  $stmt->bindParam(':player_id', $player_id);
  $stmt->execute();
  if ($stmt->rowCount()) {
    $viewplayer = $stmt->fetch();

    // Get player photo.
    $query2 = 'SELECT ImagePath FROM PlayerPhoto WHERE PlayerID = :player_id';
    $stmt2 = $db->prepare($query);
    $stmt2->bindParam(':player_id', $player_id);
    $stmt2->execute();
    $photo_link = $stmt2->fetch();
    $stmt2->closeCursor();
    // photo_link is an array that holds the image path. (Not sure how to use it though.)

  } else {
    $message = '<strong>Error!</strong> Player not found in the database!';
  }
  $stmt->closeCursor();
}

// Get all players for the dropdown box.
$query = 'SELECT * FROM players';
$statement = $db->prepare($query);
$statement->execute();
$players = $statement->fetchAll();
$statement->closeCursor();



?>




    <!-- check to see if player already is on page -->
    <!-- update existing player from SQL if player does exist -->
    <!-- add player if does not exist -->
    <!-- Delete button -->

<!--chads section -->


<div class="jumbotron">
  <h1>Roster</h1>      
  <h4></h4>
</div>

<div class="container-fluid">

    <?php if ($message): ?>
      <div class="alert alert-danger"><?=$message?></div>
    <?php endif?>

    <form action="Players.php" method="POST">
      <input type="hidden" name="action" value="view_player" class="form-inline">
    Select Player: <select name="player">
      <?php foreach ($players as $player): ?> 
      <option value="<?php echo $player['PlayerID'];?>"> 
        <?php echo $player['PlayerName']; ?> 
      </option> <?php endforeach ?>
      </select>
      <input type="submit" value="Go" class="btn btn-light">
    </form>

      <?php 
        // If a player was selected, view the player.
        if ($action == 'view_player' and isset($viewplayer)) { 
          // TODO: Make this look prettier, add photo ?>
      
      Name: <?=$viewplayer['PlayerName']?><br>
      Year: <?=$viewplayer['playerYear']?><br>
      Number: <?=$viewplayer['playerNumber']?><br>
      Position: <?=$viewplayer['PlayerPosition']?><br>
      <?php  }

      ?>
    </select><br><br>

</div>

<?php include('views/footer.php');?>