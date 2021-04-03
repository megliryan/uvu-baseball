<?php 
$title = "Schedule";
include('views/header.php');
require('config.php');
$query = "SELECT team.TeamName, schedule.Gametime, schedule.GameDate 
            FROM Team   
              INNER JOIN Schedule 
                ON Team.TeamID = Schedule.TeamID";
$statement = $db->prepare($query);
//do we need this below line of code? I do not think it hurts:)
$statement ->bindValue(':TeamID',$teamid);
$statement ->bindValue(':TeamName',$teamname);
$statement ->bindValue(':Gametime',$gametime);
$statement ->bindValue(':GameDate',$gamedate);
$statement->execute();
//we used fetchAll below because we wanted to return multiple results in an array so we could loop through them
$GameInfo = $statement-> fetchAll();
$statement -> closeCursor();

?>

<div class="container-fluid" style="height: 100vh">
  <div class="row h-100 no-gutters">
    <div class = "col-sm-6 d-flex flex-column">
    <div class="bg-info align-items-center flex-grow-1 justify-content-center d-flex">
      <?php //I need a for each loop for each item?>
      <div>Opponent:<?php foreach ($GameInfo as $teamname) :
        echo $teamname['TeamName'];
        endforeach;?> Date: Time:
      </div>
    </div>  
    <div class="bg-danger align-items-center flex-grow-1 justify-content-center d-flex">
      <div>Opponent: Date: Time:</div>
    </div>
    <div class="bg-success align-items-center flex-grow-1 justify-content-center d-flex">
      <div>Opponent: Date: Time:</div>
    </div>  
    </div>
    <div class = "col-sm-6 bg-warning">
       <img class="img-fluid" src="images/MMHS_Logo2.jpg" alt="School Logo" >
    </div>
  </div>
</div>
<?php include('views/footer.php');?>