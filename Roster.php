<!--chads section -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <?php 
  $title = "Roster";
  include('views/header.php');
  require_once('config.php');


  // Get all players.
  $query = 'SELECT * FROM players';
  $statement = $db->prepare($query);
  $statement->execute();
  $players = $statement->fetchAll();
  $statement->closeCursor();
  ?>

</head>
<body>
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

    
  <!-- pulls players stats into bootstrap layout-->
  <table class="table table-boardered">
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
        <td> <?php echo $player['AB']?> </td>
        <td> <?php echo $player['PA']?> </td>
        <td> <?php echo $player['AVG']?> </td>
        <td> <?php echo $player['OBP']?> </td>
        <td> <?php echo $player['SLG']?> </td>
        <td> <?php echo $player['H']?> </td>
        <td> <?php echo $player['1B']?> </td>
        <td> <?php echo $player['2B']?> </td>
        <td> <?php echo $player['3B']?> </td>
        <td> <?php echo $player['HR']?> </td>
        <td> <?php echo $player['RBI']?> </td>
        <td> <?php echo $player['SB']?> </td>
        <td> <?php echo $player['CS']?> </td>
        <td> <?php echo $player['W']?> </td>
        <td> <?php echo $player['L']?> </td>
        <td> <?php echo $player['ERA']?> </td>
        <td> <?php echo $player['WHIP']?> </td>
        <td> <?php echo $player['SO']?> </td>
        <td> <?php echo $player['BB']?> </td>
        <td> <?php echo $player['BAA']?> </td>
        <td> <?php echo $player['IP']?> </td>
      </tr>
      <br><br><br>
    </tbody>
  </table>
    
    <?php endforeach ?>
    <?php include('views/footer.php');?>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>





