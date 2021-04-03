<?php 
$title = "Schedule";
include('views/header.php');
require(config.php);
?>

<div class="container-fluid" style="height: 100vh">
  <div class="row h-100 no-gutters">
    <div class = "col-sm-6 d-flex flex-column">
          <div class="bg-info align-items-center flex-grow-1 justify-content-center d-flex"><div>left1</div></div>  
          <div class="bg-danger align-items-center flex-grow-1 justify-content-center d-flex"><div>left2</div></div>
          <div class="bg-success align-items-center flex-grow-1 justify-content-center d-flex"><div>left3</div></div>  
    </div>
    <div class = "col-sm-6 bg-warning">
       <img class="img-fluid" src="images/MMHS_Logo2.jpg" alt="School Logo" >
    </div>
  </div>
</div>
<?php include('views/footer.php');

$query = "SELECT team.TeamName, schedule.Gametime, schedule.GameDate FROM Team INNER JOIN Schedule ON Team.TeamID = Schedule.TeamID";
$statement = $db->prepare($query);
//do we need this below line of code? I do not think it hurts:)
$statement ->bindValue(':teamid',$teamid);
$statement ->bindValue(':teamname',$teamname);
$statement ->bindValue(':gametime',$gametime);
$statement ->bindValue(':gamedate',$gamedate);
$statement->execute();
//we used fetchAll below because we wanted to return multiple results in an array so we could loop through them
$currentGames = $statement-> fetchAll();
$statement -> closeCursor();


?>