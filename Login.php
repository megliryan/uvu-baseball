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
        $sql = "SELECT id, username, password FROM users WHERE username = :username";
        
        if($stmt = $db->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(':username', $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Store result
                // mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if($stmt->rowCount() == 1){                    
                    // Bind result variables
                    $user = $stmt->fetch();
                    // I think I'm doing this right, not certain.
                    if($user){
                        if(password_verify($password, $user['password'])){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $user['id'];
                            $_SESSION["username"] = $user['username'];
                            $_SESSION["is_admin"] = false;                           
                            
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
            $stmt->closeCursor();
        }
    }
    
    // Close connection
    //mysqli_close($link);
}

include('views/header.php');
?>

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
<div class="jumbotron shadow-lg w-25 mx-auto container-md">
    <div class="wrapper">
        <h2>Login</h2>
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
        <p class="text-dark" "text-center"> Admin? <a href="admin-login.php">Click here!</a></p>
        </div>
    </div>
</div>
<?php include('views/footer.php');?>
