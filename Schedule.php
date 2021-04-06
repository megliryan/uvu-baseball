<!DOCTYPE html>
<html lang="en">
<?php include('views/header.php');
require('config.php');
$query = 'SELECT * 
            FROM Team   
              INNER JOIN Schedule 
                ON team.TeamID = Schedule.TeamID';
$statement = $db->prepare($query);
$statement->execute();
//we used fetchAll below because we wanted to return multiple results in an array so we could loop through them
$GameInfo = $statement-> fetchAll();
$statement -> closeCursor();
?>
<head>

<!-- bootstrap declaration -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Calendar</title>
</head>
<body>
<div class="container-fluid" style="height: 100vh">
  <div class="row h-100 no-gutters">
    <div class = "col-sm-6 d-flex flex-column">
          <?php foreach ($GameInfo as $Game):
            echo $GameInfo['HomeAway'];
            echo $GameInfo['TeamName'];
            echo $GameInfo['GameDate'];
            echo $GameInfo['GameTime'];
            //echo $GameInfo['HomeAway'];
          endforeach
            ?>
          <div class="bg-info align-items-center flex-grow-1 justify-content-center d-flex">
            <div>Home or Away: <?php echo $GameInfo['HomeAway'];
                 Opponent:           echo $GameInfo['TeamName'];
                 Date:               echo $GameInfo['GameDate'];
                 Time:               echo $GameInfo['GameTime']; ?> 
            </div>
          </div>  
          <div class="bg-danger align-items-center flex-grow-1 justify-content-center d-flex">
            <div>Home or Away: <?php echo $GameInfo['HomeAway'];
                 Opponent:           echo $GameInfo['TeamName'];
                 Date:               echo $GameInfo['GameDate'];
                 Time:               echo $GameInfo['GameTime']; ?>
            </div>
          </div>
          <div class="bg-success align-items-center flex-grow-1 justify-content-center d-flex">
            <div>Home or Away: <?php echo $GameInfo['HomeAway'];
                 Opponent:           echo $GameInfo['TeamName'];
                 Date:               echo $GameInfo['GameDate'];
                 Time:               echo $GameInfo['GameTime']; ?>
            </div>
          </div>  
          <div class="bg-success align-items-center flex-grow-1 justify-content-center d-flex">
            <div>Home or Away: <?php echo $GameInfo['HomeAway'];
                 Opponent:           echo $GameInfo['TeamName'];
                 Date:               echo $GameInfo['GameDate'];
                 Time:               echo $GameInfo['GameTime']; ?>
            </div>
          </div>
          <div class="bg-success align-items-center flex-grow-1 justify-content-center d-flex">
            <div>Home or Away: <?php echo $GameInfo['HomeAway'];
                 Opponent:           echo $GameInfo['TeamName'];
                 Date:               echo $GameInfo['GameDate'];
                 Time:               echo $GameInfo['GameTime']; ?>
            </div>
          </div>
    </div>
    <div class = "col-sm-6 bg-warning">
       <img class="img-fluid" src="images/MMHS_Logo2.jpg" alt="School Logo" >
    </div>
  </div>
</div>
</body>
</html>