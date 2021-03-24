        <?php
        // Initialize the session
        session_start();
         
        // Check if the user is already logged in, if yes then redirect him to welcome page
        if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
            header("location: admin-welcome.php");
            exit;
        }
         
        // Include config file
        // require_once "config.php";
         
        // Define variables and initialize with empty values
        $admin_username = $admin_password = "";
        $username_err = $password_err = $login_err = "";
         
        // Processing form data when form is submitted
        if($_SERVER["REQUEST_METHOD"] == "POST"){
         
            // Check if username is empty
            if(empty(trim($_POST["username"]))){
                $username_err = "Please enter username.";
            } else{
                $admin_username = trim($_POST["username"]);
            }
            
            // Check if password is empty
            if(empty(trim($_POST["password"]))){
                $password_err = "Please enter your password.";
            } else{
                $admin_password = trim($_POST["password"]);
            }
            
            // Validate credentials
            if(empty($username_err) && empty($password_err)){
                // Prepare a select statement
                $sql = "SELECT id, username, password FROM users WHERE username = ?";
                
                if($stmt = mysqli_prepare($link, $sql)){
                    // Bind variables to the prepared statement as parameters
                    mysqli_stmt_bind_param($stmt, "s", $param_username);
                    
                    // Set parameters
                    $param_username = $admin_username;
                    
                    // Attempt to execute the prepared statement
                    if(mysqli_stmt_execute($stmt)){
                        // Store result
                        mysqli_stmt_store_result($stmt);
                        
                        // Check if username exists, if yes then verify password
                        if(mysqli_stmt_num_rows($stmt) == 1){                    
                            // Bind result variables
                            mysqli_stmt_bind_result($stmt, $id, $admin_username, $hashed_password);
                            if(mysqli_stmt_fetch($stmt)){
                                if(password_verify($admin_password, $hashed_password)){
                                    // Password is correct, so start a new session
                                    session_start();
                                    
                                    // Store data in session variables
                                    $_SESSION["loggedin"] = true;
                                    $_SESSION["id"] = $id;
                                    $_SESSION["username"] = $admin_username;                            
                                    
                                    // Redirect user to welcome page
                                    header("location: welcome.php");
                                } else{
                                    // Password is not valid, display a generic error message
                                    $login_err = "Invalid username or password.";
                                }
                            }
                        } else{
                            // Username doesn't exist, display a generic error message
                            $login_err = "Invalid username or password.";
                        }
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }
        
                    // Close statement
                    mysqli_stmt_close($stmt);
                }
            }
            
            // Close connection
            mysqli_close($link);
        }
        ?>
        
        <!DOCTYPE html>
        <html lang="en">
        <head>
        
        <!-- bootstrap declaration -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
            
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="styles.css">
            <title>Login</title>
        </head>
        <body>
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
            <!-- <?php include('header.php'); ?> -->
            <!-- <?php if(!$logged_in) :?> -->
              <!-- Login Form -->
                <!-- <div id="data_entry", class="container form-control"> -->
                <!-- <form action="login.php" method="post"> -->
                    <!-- <br><input type="text" id="username" placeholder="Username"><br> -->
                    <!-- <input type="password" id="password" placeholder="Password"><br> -->
                    <!-- Instructions for players to reach out to the coach if they don't have a login -->
                    <!-- <p>Please reach out to your coach to get a profile set up</p> -->
                    <!-- <button type="submit" id="login">Login</button> <br><br> -->
                    <!-- <div class="errors"><?=$errors?></div> -->
                <!-- </form>   -->
                <!-- </div> -->
        
            <!-- <?php else : ?>
                <div id="data_entry", class="container">
                <a href="enter_nums.php">Click to begin</a>
                <a href="logout.php">Click to logout</a>
                </div>
            <?php endif; ?> -->
            <div class="wrapper">
                <h2>Login</h2>
                <p class="white-text">Please fill in your credentials to login.</p>
        
                <?php 
                if(!empty($login_err)){
                    echo '<div class="alert alert-danger">' . $login_err . '</div>';
                }        
                ?>
        
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group">
                        <label>Admin Username</label>
                        <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $admin_username; ?>">
                        <span class="invalid-feedback"><?php echo $username_err; ?></span>
                    </div>    
                    <div class="form-group">
                        <label>Admin Password</label>
                        <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                        <span class="invalid-feedback"><?php echo $password_err; ?></span>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Login">
                    </div>
                </form>
            </div>
        </body>
        </html>