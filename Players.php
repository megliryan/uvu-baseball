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



<!--chads section -->
 


<!-- grey box header-->
<div class="jumbotron">
  <h1>Roster</h1>      
  <h4></h4>
</div>
<div class="container-fluid">

<!-- searches database for players-->
<?php foreach($players as $player):?>
<div>

<?php
$result = $player['ImagePath'];
$filename = "PlayersPics/".$result;
?>

<!-- pulls pictures form database-->
<img src="<?php echo $filename?>"><br>

<!-- pulls players info from database-->
Name: <?=$player['PlayerName']?><br>
Year: <?=$player['PlayerYear']?><br>
Number: <?=$player['PlayerNumber']?><br>
Position: <?=$player['PlayerPosition']?><br>
</div>

<!-- pulls players stats into bootstrap layout-->
<div class="table table-boardered">
  <thead>
    <tr>
      <th scope="col">AB</th>
      <th scope="col">PA</th>
      <th scope="col">AVG</th>
      <th scope="col">OBP</th>
      <th scope="col">SLG</th>
      <th scope="col">H</th>
      <th scope="col">1B</th>
      <th scope="col">2B</th>
      <th scope="col">3B</th>
      <th scope="col">HR</th>
      <th scope="col">RBI</th>
      <th scope="col">SB</th>
      <th scope="col">CS</th>
      <th scope="col">W</th>
      <th scope="col">L</th>
      <th scope="col">ERA</th>
      <th scope="col">WHIP</th>
      <th scope="col">SO</th>
      <th scope="col">BB</th>
      <th scope="col">BAA</th>
      <th scope="col">IP</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td> <?=$player['AB']?> </td>
      <td> <?=$player['PA']?> </td>
      <td> <?=$player['AVG']?> </td>
      <td> <?=$player['OBP']?> </td>
      <td> <?=$player['SLG']?> </td>
      <td> <?=$player['H']?> </td>
      <td> <?=$player['1B']?> </td>
      <td> <?=$player['2B']?> </td>
      <td> <?=$player['3B']?> </td>
      <td> <?=$player['HR']?> </td>
      <td> <?=$player['RBI']?> </td>
      <td> <?=$player['SB']?> </td>
      <td> <?=$player['CS']?> </td>
      <td> <?=$player['W']?> </td>
      <td> <?=$player['L']?> </td>
      <td> <?=$player['ERA']?> </td>
      <td> <?=$player['WHIP']?> </td>
      <td> <?=$player['SO']?> </td>
      <td> <?=$player['BB']?> </td>
      <td> <?=$player['BAA']?> </td>
      <td> <?=$player['IP']?> </td>
    </tr>
    <br><br><br>
  </tbody>
</div>

<?php endforeach ?>
    
</div>
<?php include('views/footer.php');?>