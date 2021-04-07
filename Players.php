<?php 
$title = "Players";
include('views/header.php');
?>

<!-- Select Player: <select name="players" id="players"> -->
 <?php 
require_once "config.php";

global $db;
    $query = 'SELECT * FROM players';
    $statement = $db->prepare($query);
    $statement->execute();
    $players = $statement->fetchAll();
    $statement->closeCursor();
?>

Select Player: <select name="players">
  <?php foreach ($players as $player): ?> 
  <option value="<?php echo $player;?>"> 
  <?php echo $player['PlayerName']; ?> 
  </option> <?php endforeach ?>
</select>

<img src="images/StatsBar.png" alt="">

<?php include('views/footer.php');?>
