<?php
$title = "MMHS Baseball";
require('config.php');

// Get livestream URL
$query = 'SELECT * FROM livestream;';
$stmt = $db->prepare($query);
$stmt->execute();
$video_url = $stmt->fetch()['url'];
$stmt->closeCursor();

include('views/header.php');
?>

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

<?php
  require('config.php');
  $query = 'SELECT * FROM announcements';
  $statement = $db->prepare($query);
  $statement->execute();
  $announcements = $statement-> fetchAll();
  $statement -> closeCursor();
?>

<!--declaration of announcements section-->
<div id="demo" class="carousel slide" data-ride="carousel">
  <ul class="carousel-indicators">
    <?php for ($i = 0; $i <= count($announcements); $i++):?>
    <li data-target="#demo" data-slide-to="<?=$i?>" <?php if ($i == 0) {echo 'class="active"';}?>></li>
    <?php endfor;?>
  </ul>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="images\Team_Photo.jpg" alt="Team_Photo" width="900" height="250">
    
      <div class="carousel-caption">
        <div class="newsbackground">
        <h1>Maple Mountain Baseball</h1>
        <p>Welcome to the new Maple Mountain Basbeball website!</p>
      </div> 
    </div>  
  </div>
    <?php foreach ($announcements as $announcement):
      $result = $announcement['ImagePath'];
      $filename = "Images/".$result;
            ?>
      <div class="carousel-item">
        <img src="<?=$filename?>" width="900" height="250">
        <div class="carousel-caption">
          <div class="newsbackground">
            <h1><?=$announcement['AnnouncementTitle']?></h1>
            <p><?=$announcement['Announcement']?></p>
          </div>
        </div>   
      </div>
    <?php endforeach ?>
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
      
      <iframe width="90%" height="600" src="https://www.youtube.com/embed/<?=$video_url?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      </div>
  </div>
</div>

<?php include('views/footer.php');?>