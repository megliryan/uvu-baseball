<?php
require('database.php');
session_start();
$error_msg = '';

if (isset($_SESSION['username'])) {
    // The user is already logged in.
    header('Location: /index.php');
}

$username = filter_input(INPUT_POST, 'username');
$password = filter_input(INPUT_POST, 'password');
$action = filter_input(INPUT_POST, 'action');
if ($action == null) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == null) {
        $action = 'view';
    }
}

if ($action == 'login') {
    $query = 'SELECT * FROM users WHERE LOWER(username) = LOWER(:username)';
    $statement = $db->prepare($query);
    try {
        $statement->bindParam(':username', $username);
        $statement->execute();
    } catch (PDOException $err) {
        $error = true;
        $error_msg = 'Internal Error. Please try again. '.$err->getMessage();
        // Stop the script and send back here? No idea how to implement it
        // and I got to go to work in a few.
    }

    $user = $statement->fetch(PDO::FETCH_BOTH);
    $statement->closeCursor();
    if ($user == NULL) {
        // Error: Username not found.
        $error_msg = 'The username and password combination is not valid. Please try again.';
    } else {
        if (password_verify($password, $user['password_hash'])) {
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['is_admin'] = $user['is_admin'];
            $header('Location: /index.php');
        } else {
            // Error: Username and password combination invalid.
            $error_msg = 'The username and password combination is not valid. Please try again.';
        }
    }
}
// If they're at this point, display the form.
// They're either just got here, or made an error.
include('views/header.php');
?>
    <div id="data_entry", class="container">
        <form action="process_login.php" method="post" style="padding: 2em">
            <input type="hidden" name="action" value="login">
            <input type="text" id="username" placeholder="Username"><br>
            <input type="password" id="password" placeholder="Password"><br>
            <!-- Instructions for players to reach out to the coach if they don't have a login -->
            <p>Please reach out to your coach to get a profile set up.</p>
            <button type="submit" id="login">Login</button> <br><br>
            <?=$error_msg?>
        </form>  
    </div>
<?php include('views/footer.php');?>
