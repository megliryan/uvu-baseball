<?php include('views/header.php'); ?>

<!-- section bellow is for uploading and displaying players info-->


<!-- display a button only if user is logged in -->

<?php
session_start();
if($_SESSION["loggedin"] = true) : ?>

<form action="PlayersPics.php" method="POST" enctype="multipart/form-data">
<input type="file" name="file">
<button type="submit" name="submit">Upload Player Pic</button>
</form>

<?php endif; ?>

<!-- statsbar-->
<div id=center>
  <img class="center" alt="center" src="images/StatsBar.png"  width="800px" >
</div>

<?php include('views/footer.php'); ?>



  

  


