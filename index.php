<?php
$title = "MMHS Baseball";
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

// php reference database for upcoming games data (same thing as seen above)

*/
/*php Firebase alternate declaration

*/


include('views/header.php');
?>

<!--declaration of div Title-->
<div class="jumbotron jumbotron-fluid">
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
      </div>
    </div>
  </div>

    <!--delcaration of upcoming games section -->
    <div class="col-sm-5">
    <div class="jumbotron jumbotron-fluid">
      <h2>Upcoming Games</h2>
        <div class="container-sm">
          - @ Orem High -- 3/14/2021 4:00PM
        </div>
      </div>
    </div>
  </div>

  <!--declaration of livestream window -->
<div class="row">
  <div class="col-sm-12">
    <div class="jumbotron jumbotron-fluid">
      <h2>Livestream</h2>
      <!-- 
          Livestream Embed from Youtube
      /* You have to ask users to store the 11 character code from the youtube video. For e.g. http://www.youtube.com/watch?v=Ahg6qcgoay4 The eleven character code is : Ahg6qcgoay4
      You then take this code and place it in your database. Then wherever you want to place the youtube video in your page, load the character from the database and put the following 
      code:-g. for Ahg6qcgoay4 it will be : */
      <object width="425" height="350" data="http://www.youtube.com/v/Ahg6qcgoay4" type="application/x-shockwave-flash"><param name="src" value="http://www.youtube.com/v/Ahg6qcgoay4" /></object> -->
      -->
      <iframe width="90%" height="600" src="https://www.youtube.com/embed/I0xDkNMrJqw" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      </div>
  </div>
</div>

<?php include('views/footer.php');?>