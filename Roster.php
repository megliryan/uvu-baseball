

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
  <style>
    img{
      display: block;
      margin-left: auto;
      margin-right: auto;
    }
  </style>
  <img src="<?php echo $filename?>" class="center"><br>
    
  <!-- pulls players info from database-->
  <style>
    .center{
      text-align: center;
    }
  </style>

  <div class="center">
    Name: <?=$player['PlayerName']?><br>
    Year: <?=$player['PlayerYear']?><br>
    Number: <?=$player['PlayerNumber']?><br>
    Position: <?=$player['PlayerPosition']?><br>
  </div>
  <br>

    
  <!-- pulls players stats into bootstrap layout-->
  
  <table>
    <div>
      <table class="table table-boardered w-auto center mx-auto">
        <thead class="table table-sm">
          <tr style="background-color:grey;">
            <th style="color:white" scope="col">AB</th>
            <th style="color:white" scope="col">PA</th>
            <th style="color:white" scope="col">AVG</th>
            <th style="color:white" scope="col">OBP</th>
            <th style="color:white" scope="col">SLG</th>
            <th style="color:white" scope="col">H</th>
            <th style="color:white" scope="col">1B</th>
            <th style="color:white" scope="col">2B</th>
            <th style="color:white" scope="col">3B</th>
            <th style="color:white" scope="col">HR</th>
            <th style="color:white" scope="col">RBI</th>
            <th style="color:white" scope="col">SB</th>
            <th style="color:white" scope="col">CS</th>
            <th style="color:white" scope="col">W</th>
            <th style="color:white" scope="col">L</th>
            <th style="color:white" scope="col">ERA</th>
            <th style="color:white" scope="col">WHIP</th>
            <th style="color:white" scope="col">SO</th>
            <th style="color:white" scope="col">BB</th>
            <th style="color:white" scope="col">BAA</th>
            <th style="color:white" scope="col">IP</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td style="color:white"> <?php echo $player['AB']?> </td>
            <td style="color:white"> <?php echo $player['PA']?> </td>
            <td style="color:white"> <?php echo $player['AVG']?> </td>
            <td style="color:white"> <?php echo $player['OBP']?> </td>
            <td style="color:white"> <?php echo $player['SLG']?> </td>
            <td style="color:white"> <?php echo $player['H']?> </td>
            <td style="color:white"> <?php echo $player['1B']?> </td>
            <td style="color:white"> <?php echo $player['2B']?> </td>
            <td style="color:white"> <?php echo $player['3B']?> </td>
            <td style="color:white"> <?php echo $player['HR']?> </td>
            <td style="color:white"> <?php echo $player['RBI']?> </td>
            <td style="color:white"> <?php echo $player['SB']?> </td>
            <td style="color:white"> <?php echo $player['CS']?> </td>
            <td style="color:white"> <?php echo $player['W']?> </td>
            <td style="color:white"> <?php echo $player['L']?> </td>
            <td style="color:white"> <?php echo $player['ERA']?> </td>
            <td style="color:white"> <?php echo $player['WHIP']?> </td>
            <td style="color:white"> <?php echo $player['SO']?> </td>
            <td style="color:white"> <?php echo $player['BB']?> </td>
            <td style="color:white"> <?php echo $player['BAA']?> </td>
            <td style="color:white"> <?php echo $player['IP']?> </td>
          </tr>
        </tbody>
      </table>
    </div>
  </table>
  <br><br><br>
    
    <?php endforeach ?>

<?php include('views/footer.php');?>





