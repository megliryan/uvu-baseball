<?php
$title = 'MMHS Baseball';
/*php reference SQL database for current announcements data

$servername = "localhost";
$username = "username";
$password = "password";

// Create connection
$conn = mysqli_connect($servername, $username, $password);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
// echo out the data needed

*/

include('views/header.php');
?>

<!--declaration of div Title-->
<div class="jumbotron">
    <h1>Maple Mountain Baseball</h1>      
    <h3>Welcome to the mountain!</h3>
</div>

<!--declaration of announcements section-->
<div class="row">
  <div class="col-sm-7">
  <div class="jumbotron jumbotron-fluid">
    <h2>Announcements</h2>
      <div class="container-sm">
        - Tryouts are set for 3/1/2021. Please do not forget!
        <!--  
        <?php 
        /*
        <?php foreach($announcements_entries as $announcement_entry): ?>
          <tr class=rowheader>
              <td><?=$announcement_entry['title']?></td>
              <td><?=$announcement_entry['date']?></td>
          </tr>
          <tr class=rowbody>
              <td><?=$announcement_entry['body']?></td>
          </tr>
          
        <?php endforeach; ?>
        */
        ?>
          
        -->
      </div>
    </div>
  </div>

    <!--delcaration of upcoming games section -->
    <div class="col-sm-5">
    <div class="jumbotron jumbotron-fluid">
      <h2>Upcoming Games</h2>
        <div class="container-sm">
          - @ Orem High -- 3/14/2021 4:00PM
          <!--  
        <?php 
        /*
        <?php foreach($game_entries as $game_entry): ?>
          <tr>
              <td><?=$game_entry['title']?></td>
              <td><?=$game_entry['date']?></td>
          </tr>
          
          
        <?php endforeach; ?>
        */
        ?>
          
        -->
        </div>
      </div>
    </div>
  </div>

  <!--declaration of livestream window-->
<div class="row">
  <div class="col-sm-12">
    <div class="jumbotron jumbotron-fluid">
    <!--code for the previous game-->
      <h2>Previous Game</h2>
      <div id=livestream>
        <object width="1500" height="1050" data="http://www.youtube.com/v/crNtuGff1-w" 
        type="application/x-shockwave-flash"><param name="src" value="http://www.youtube.com/v/crNtuGff1-w" /></div>
        </object>
      
      </div>
  </div>
</div>

<?php include('views/footer.php');?>
