<<<<<<< HEAD:index.php
<!-- <?php
=======
<?php
$title = "MMHS Baseball";
>>>>>>> 17a4ed5a8208c8fba58ba64a316aa4ed69e714f3:index.php
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

<<<<<<< HEAD:index.html
?> -->

<!DOCTYPE html>
<html lang="en">
<head>

<!-- bootstrap declaration -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- news carousel code-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>MMHS Baseball</title>
</head>
<body>
  <!--declaration of navigation bar-->
  <nav class="navbar navbar-expand-md bg-dark navbar-dark fixed-top">
  <!-- Brand -->
  <!--<a class="navbar-brand" href="#">Navbar</a>-->
  <div id=MMLogo>
    <a class="navbar-brand" href="#"><img src="images/School_Logo.png" alt="Logo" style="width:60px;"></a>
  </div>
  <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Navbar links -->
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">

      <li class="nav-item">
        <a class="nav-link" href="index.php">Home</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="Schedule.php">Schedule</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="Players.php">Roster</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="forms/index.php">Forms</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="Login.php">Login</a>
      </li>

    </ul>
  </div>
</nav>
<br>
=======

include('views/header.php');
?>

>>>>>>> 17a4ed5a8208c8fba58ba64a316aa4ed69e714f3:index.php
<!--declaration of div Title-->
<div class="jumbotron">
    <h1>Maple Mountain Baseball</h1>      
    <h3>Welcome to the mountain!</h3>
</div>

<style>
  /* Make the image fully responsive */
  .carousel-inner img {
    width: 100%;
    height: 100%;
  }

</style>

<!--declaration of announcements section-->
<div id="demo" class="carousel slide" data-ride="carousel">
  <ul class="carousel-indicators">
    <li data-target="#demo" data-slide-to="0" class="active"></li>
    <li data-target="#demo" data-slide-to="1"></li>
    <li data-target="#demo" data-slide-to="2"></li>
  </ul>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="C:\Users\Mark\Documents\GitHub\uvu-baseball\images\Team_Photo.jpg" alt="Team_Photo" width="900" height="300">
    
      <div class="carousel-caption">
        <div class="newsbackground">
        <h1>Maple Mountain Baseball</h1>
        <p>Welcome to the new Maple Mountain Basbeball website!</p>
      </div> 
    </div>  
  </div>
    <div class="carousel-item">
      <img src="C:\Users\Mark\Documents\GitHub\uvu-baseball\images\swing.jpg" alt="Swing" width="900" height="300">
      <div class="carousel-caption">
        <div class="newsbackground">
        <h1>MMHS beats Provo</h1>
        <p>Maple Mountain beat Provo on 4/5/21 with the final score of 6-5.</p>
      </div>
      </div>   
    </div>
    <div class="carousel-item">
      <img src="C:\Users\Mark\Documents\GitHub\uvu-baseball\images\thumbs_up.jpg" alt="New York" width="900" height="300">
      <div class="carousel-caption">
        <div class="newsbackground">
        <h1>Team approves of new website</h1>
        <p>Everyone loves the new site! Easy place to download forms, check video, and check stats!</p>
      </div>
      </div>   
    </div>
  </div>
  <a class="carousel-control-prev" href="#demo" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#demo" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>
</div>
<br>

<!--end of announcements-->

<!--declaration of livestream window -->
<div class="row">
  <div class="col-sm-12">
    <div class="jumbotron">
      <h2>Livestream</h2>
      <!-- 
          Livestream Embed from Youtube
      /* You have to ask users to store the 11 character code from the youtube video. For e.g. http://www.youtube.com/watch?v=Ahg6qcgoay4 The eleven character code is : Ahg6qcgoay4
      You then take this code and place it in your database. Then wherever you want to place the youtube video in your page, load the character from the database and put the following 
      code:-g. for Ahg6qcgoay4 it will be : */
      <object width="425" height="350" data="http://www.youtube.com/v/Ahg6qcgoay4" type="application/x-shockwave-flash"><param name="src" value="http://www.youtube.com/v/Ahg6qcgoay4" /></object> -->
      
      <iframe width="90%" height="600" src="https://www.youtube.com/embed/I0xDkNMrJqw" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      </div>
  </div>
</div>

<?php include('views/footer.php');?>