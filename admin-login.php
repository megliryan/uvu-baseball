<?php
// Initialize the session
session_start();
    
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: admin.php");
    exit;
}
    
// Include config file
require_once "config.php";
    
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $login_err = "";
    
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM adminusers WHERE username = :username";
        
        if($stmt = $db->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(':username', $username);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Check if username exists, if yes then verify password
                if($stmt->rowCount() == 1){                    
                    // Bind result variables
                    if($user = $stmt->fetch()){
                        if(password_verify($password, $user['password'])){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $user['id'];
                            $_SESSION["username"] = $user['username'];  
                            $_SESSION["is_admin"] = true;                          
                            
                            // Redirect user to welcome page
                            header("location: admin.php");
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
            $stmt->closeCursor();
        }
    }
}

include('views/header.php');
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
<nav class="navbar navbar-expand-md bg-dark navbar-dark fixed-top">
    <!-- Brand -->
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
        <a class="nav-link" href="Roster.php">Roster</a>
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
    <div class="jumbotron shadow-lg w-25 mx-auto container-md">
    <div class="wrapper">
    
        <h2>Admin Login</h2>
        <br>

        <?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group w-100 mx-auto">
                <p class="text-dark">Username</p>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group w-100 mx-auto">
                <p class="text-dark">Password</p>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <br>
            <div class="form-group w-100 mx-auto">
                <input type="submit" class="btn btn-primary w-100 shadow-lg" value="Login">
            </div>
            
        </form>
        <div class=" w-100 mx-auto">
        <p class="text-dark text-center"> User?  <a href="Login.php">Click here!</a></p>
        </div>
    </div>
    </div>
</body>
</html>
