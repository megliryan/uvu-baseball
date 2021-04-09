<?php 
$title = "Players";
include('views/header.php');

?>




    <!-- check to see if player already is on page -->
    <!-- update existing player from SQL if player does exist -->
    <!-- add player if does not exist -->
    <!-- Delete button -->

<!--chads section -->

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="styles.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <title>MAPLE MOUNTAIN BASEBALL</title>
  </head>
  <body>
    <h1>PLAYERS</h1>
    <div class="container-fluid">

      <!-- Select Player database: <select name="players" id="players"> -->
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
      </select><br><br>

      <?
      if($players == TRUE){
        $playersName = $_POST["playersName"];
        $playersYear = $_POST["playersYear"];
        $playersPosition = $_POST["playersPosition"];
      }
      if(empty($playersName) || empty($playersPosition) || empty($playersYear)){
        echo "Missing information";
      } else {
        require_once('config.php');
        $query = "INSERT INTO players (PlayersName, PlayersPosition, PlayersYear) VALUES ('$playersName', '$playersPosition', '$playersYear')";
        $db->exec($query);
      }
      ?>

      <form method="post">
      <input type="text" name="playersName" id="playersName" placeholder="Players name">
      
      </form>



    </div>
  </body>
</html>


<?php include('views/footer.php');?>