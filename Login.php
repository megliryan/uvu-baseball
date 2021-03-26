<!-- <?php
$title = 'Login'
    // session_start();
        // $logged_in = false;
        // $errors = filter_input(INPUT_GET, 'errors');
        // $username_cookie = filter_input(INPUT_COOKIE, 'username;');
        // $password_cookie = filter_input(INPUT_COOKIE, 'password;');

        // if( isset($_SESSION['username']) && isset($_SESSION['logged_in']) ){
            // $logged_in = true;
        // }elseif( $username_cookie == 'first' && $password_cookie == 'player'){
            // $_SESSION['username'] = $username_cookie;
            // $_SESSION['logged_in'] = TRUE;
            // $logged_in = TRUE;
        // }
?> -->

<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: welcome.php");
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
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
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

<?php include('views/header.php'); ?>
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
                <label>Username</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
        </form>
        <div class="white-text">Admin? <button><a href="admin-login.php">Click here!</a></button>
        </div>
    </div>

<?php include('views/footer.php') ?>
