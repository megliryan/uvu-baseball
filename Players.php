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
    <link href="styles.css" rel="stylesheet" crossorigin="anonymous">

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
        <input type="submit">


        <?
          while($row = mysql_fetch_array($statement, MYSQL_ASSOC)){
            $name = $row['PlayerName'];
            $position = $row['PlayerPosition'];
            $year = $row['playerYear'];

            echo" <div style='margin:30px 0px;'>
            Name: $name<br />
            Position: $position<br />
            Year: $year 
            </div>
            ";
          }
          //https://www.inmotionhosting.com/support/website/grab-all-comments-from-database/
          //https://www.sitepoint.com/community/t/passing-two-values-using-one-submit-button/34209
        ?>






      



    </div>
  </body>
</html>


<?php include('views/footer.php');?>