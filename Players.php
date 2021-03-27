<!DOCTYPE html>
<html lang="en">
<head>

<!-- bootstrap declaration -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Players</title>
</head>
<body>

<!-- NAVIGATION BAR. DO NOT TOUCH. -->
<nav class="navbar navbar-expand-md bg-dark navbar-dark">
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
        <a class="nav-link" href="Forms.html">Forms</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="Login.php">Login</a>
      </li>

    </ul>
  </div>
</nav>
<!-- END OF NAVIGATION BAR. DO NOT TOUCH. -->







 
<!-- section bellow is for uploading and displaying players info
https://www.w3schools.com/howto/howto_js_popup_form.asp-->


<!-- connect to session and check to see if admin is logged in-->
<?php
session_start();
if($_SESSION["loggedin"] = true) : ?>


<!-- button that opens the popup screen-->
<button class="open-button" onclick="openForm()">Open Form</button>

<!-- popup code below-->
<div class="form-popup" id="playersForm">
  <form action="/action_page.php" class="form-container">
  <link rel="stylesheet" href="popupStyles.css">

    <!-- display a button only if user is logged in  (will need to redirect to forms page)-->
    <form action="PlayersPics.php" method="POST" enctype="multipart/form-data">
    <input type="file" name="file">
    <button type="submit" class="findPic" name="submit">Upload Pic</button>
    </form>

    <?php endif; ?>

    <!-- user input and save/cancel buttons-->
    <label for="playersName"><b>Name </b></label>
    <input type="text" placeholder="Enter Name" name="playersName" required><br>

    <label for="playersYear"><b>Year </b></label>
    <input type="text" placeholder="Enter Year" name="playersYear" required><br>

    <label for="playersPosition"><b>Position </b></label>
    <input type="text" placeholder="Enter Position" name="playersPosition" required><br>

    <button type="submit" class="btn">Submit</button>
    <button type="submit" class="btn cancel" onclick="closeForm()">Close</button>

     <!--statsbar-->
    <div id=center>
      <img class="center" alt="center" src="images/StatsBar.png"  width="800px" >
    </div> 


    <!-- script that runs and designates the layout-->
    <script>
    function openForm() {
      document.getElementById("playersForm").style.display = "block";
    }
    function closeForm() {
      document.getElementById("playersForm").style.display = "none";
    }
    </script>

  </form>
</div>


</body>
</html>



  

  


