<?php

$forms_paths = glob('all_forms/*');
$forms_friendly = array();
foreach ($forms_paths as $formpath) {
  $formpath_steps = explode(',', $formpath);
  $formname = end($formpath_steps);
  array_push($forms_friendly, $formname);
}
$forms_available = array_combine($forms_friendly, $forms_paths)


?>
<!DOCTYPE html>
<html lang="en">
<head>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Forms</title>
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
        <a class="nav-link" href="index.html">Home</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="Schedule.php">Schedule</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="Players.php">Roster</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="Players.php">Forms</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="Login.php">Login</a>
      </li>

    </ul>
  </div>
</nav>
<!-- END OF NAVIGATION BAR. DO NOT TOUCH. -->

<!-- Heading for forms page -->
<div class="jumbotron">
  <h1>Forms</h1>      
  <h4></h4>
</div>
<!-- End of heading for forms page -->

<ul class="list-group">
  <?php foreach ($forms_available as $formname => $formpath) {
    echo("<li class=\"list-group-item d-flex justify-content-between align-items-center\">
            $formname
            <a href='$formpath'>
              <span class=\"badge badge-primary\">
                <i class=\"material-icons\">
                  &#xe2c4;
                </i>
              </span>
            </a>
          </li>");
  }?>
</ul> 


</body>
</html>