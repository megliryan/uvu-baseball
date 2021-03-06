<!DOCTYPE html>
<html lang="en">
<head>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
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

<div id="downloads" class="carousel slide" data-ride="carousel">

  <!-- Indicators -->
  <ul class="carousel-indicators">
    <li data-target="#downloads" data-slide-to="0" class="active"></li>
    <li data-target="#downloads" data-slide-to="1"></li>
    <li data-target="#downloads" data-slide-to="2"></li>
  </ul>

  <!-- The slideshow -->
  <div class="carousel-inner">
    <div class="carousel-item active">
      <div class="card-deck">
          <div class="card-body text-center">
              <p class="card-text">This is card 1</p>
          </div>
          <div class="card-body text-center">
              <p class="card-text">And card 2</p>
          </div>
          <div class="card-body text-center">
              <p class="card-text">Card 3!</p>
          </div>
      </div>
    </div>
    <div class="carousel-item">
      <div class="card-deck">
          <div class="card-body text-center">
              <p class="card-text">This is card 4</p>
          </div>
          <div class="card-body text-center">
              <p class="card-text">And card 5</p>
          </div>
          <div class="card-body text-center">
              <p class="card-text">Card 6!</p>
          </div>
      </div>
    </div>
    <div class="carousel-item">
      <div class="card-deck">
          <div class="card-body text-center">
              <p class="card-text">This is card 7</p>
          </div>
          <div class="card-body text-center">
              <p class="card-text">And card 8</p>
          </div>
          <div class="card-body text-center">
              <p class="card-text">Card 9!</p>
          </div>
      </div>
    </div>
  </div>

  <!-- Left and right controls -->
  <a class="carousel-control-prev" href="#demo" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#demo" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>

</div>


</body>
</html>