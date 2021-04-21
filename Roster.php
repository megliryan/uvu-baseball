<?php 
$title = "Roster";
include('views/header.php');
require_once('config.php');


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

<?php foreach($players as $player):?>
<div>

<?php
$result = $player['ImagePath'];
$filename = "PlayersPics/".$result;
?>
<img src="<?php echo $filename?>"><br>

Name: <?=$player['PlayerName']?><br>
Year: <?=$player['PlayerYear']?><br>
Number: <?=$player['PlayerNumber']?><br>
Position: <?=$player['PlayerPosition']?><br><br><br>
</div>
<?php endforeach ?>
    
</div>
<?php include('views/footer.php');?>