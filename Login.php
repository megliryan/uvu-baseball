<?php
    session_start();
        $logged_in = false;
        $errors = filter_input(INPUT_GET, 'errors');
        $username_cookie = filter_input(INPUT_COOKIE, 'username;');
        $password_cookie = filter_input(INPUT_COOKIE, 'password;');

        if( isset($_SESSION['username']) && isset($_SESSION['logged_in']) ){
            $logged_in = true;
        }elseif( $username_cookie == 'first' && $password_cookie == 'player'){
            $_SESSION['username'] = $username_cookie;
            $_SESSION['logged_in'] = TRUE;
            $logged_in = TRUE;
        }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Login.css">
    <title>Login</title>
</head>
<body>
    <!-- <?php include('header.php'); ?> -->
    <?php if(!$logged_in) :?>
        <div id="data_entry">
        <form action="login.php" method="post">
            <input type="text" id="username" placeholder="Username"><br>
            <input type="password" id="password" placeholder="Password"><br>
            <!-- <input type="checkbox" name="stay_logged_in">Stay logged in? -->
            <input type="submit" value="Login">
            <a href="ForgotPassword.php">Forgot Password</a><br><br>
            <a href="Register.php">Register Here</a>
            <div class="errors"><?=$errors?></div>
        </form>  
        </div>

    <?php else : ?>
        <div id="data_entry">
        <a href="enter_nums.php">Click to begin</a>
        <a href="logout.php">Click to logout</a>
        </div>
    <?php endif; ?>
</body>
</html>