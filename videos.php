<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

$title = "Welcome";
$head = '<style>
body{ font: 14px sans-serif; text-align: center; }
</style>
';
include('views/header.php');
?>
    <link rel="styles.css">
    <h1 class="white my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1>
    <!-- <p>
        <a href="reset-password.php" class="btn btn-reset btn-warning btn-block">Reset Your Password</a>
    </p> -->

<?php
  require_once('config.php');

$query = 'SELECT * FROM videos';
  $statement = $db->prepare($query);
  $statement->execute();
  $videos = $statement->fetchAll();
  $statement->closeCursor();

  foreach($videos as $video):?>
  <div>
    
  <?php
  $result = $video['VideoPath'];
  $filename = "PlayerVideos/".$result;
  ?>

  <video src="<?php echo $filename?>" width="640" height="480" controls></video><br>
  <?php endforeach ?>

<?php include('views/footer.php');?>