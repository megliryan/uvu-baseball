<!DOCTYPE html>
<html lang="en">
<?php include('views/header.php');
require('config.php');
$query = 'SELECT * FROM Schedule';
$statement = $db->prepare($query);
$statement->execute();
//we used fetchAll below because we wanted to return multiple results in an array so we could loop through them
$GameInfo = $statement-> fetchAll();
$statement -> closeCursor();
?>
<head>
<?php
define("HvA","Home or Away");
define("OpTeam","Opponent");
define("Date","Date");
define("Time","Time");
?>
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
            ?>
          <div class="align-items-center flex-grow-1 justify-content-center d-flex">
            <div><?php echo HvA.": ".$Game['HomeAway']." "?> <br>
            <?php echo OpTeam.": ".$Game['Opponent']." ";?> <br>
            <?php echo Date.": ".$Game['GameDate']." ";?> <br>
            <?php echo Time.": ".$Game['GameTime']." ";?> <br>
            </div>
          </div>
          <span class="border-bottom"></span> 
        <?php endforeach ?>
    </div>
    <div class = "col-sm-6">
       <img class="img-fluid" src="images/MMHS_Logo2.jpg" alt="School Logo" >
       <br>
       <br>
       <br>
       <br>
       <br>
       <div class="text-center"><h1 style="color:white">Change The Schedule</h1></div>
       <br>
       <br>
       <br>
       <br>
       <div class="text-center btn-link">
       <?php if (isset($_SESSION['is_admin']) and $_SESSION['is_admin']):?>
       <form method="post" value="AddCalendarEvent">
         <button style="padding: 10px;">
            <a href="admin.php">Add a calendar event</a>
         </button>
       </form>
       </div>
       <div class="text-center btn-link">
       <form action="post" value="DeleteCalendarEvent">
        <button style="padding: 10px; margin:50px;">
            <a href="admin.php">Delete a calendar event</a> 
        </button>
       </form>
       <?php endif;?>
       </div>   
    </div>
  </div>
</div>
<?php include('views/footer.php')?>