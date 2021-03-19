<?php
require('../database.php');
session_start();
$error_msg = '';
$success = null;
// If the user is not logged in and not an admin, redirect out.
// First off, if not logged in.
//if (!isset($_SESSION['is_admin'])) {
//    header('Location: /login.php');  # Redirect to login page. 
//}
//if (!$_SESSION['is_admin']) {
//    $has_permissions = false;  # Flag to give "access denied" page.
//} else {
// Page logic

    $action = filter_input(INPUT_POST, 'action');
    if ($action == null) {
        $action = 'form';
    }

    if ($action == 'adduser') {
        $success = true;
        // Get new user variables.
        $username = filter_input(INPUT_POST, 'username');
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'password');
        $is_admin = filter_input(INPUT_POST, 'is_admin', FILTER_VALIDATE_BOOLEAN);
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        // NEEDS VALIDATING - values cannot be false or null (except for is_admin, which can be false)

        if ($add_to_database == true) {
            $query = 'INSERT INTO users (username, email, password_hash, is_admin)
                      VALUES (:username, :email, :password_hash, :is_admin);';
            $statement = $db->prepare($query);
            $statement->bindParam(':username', $username);
            $statement->bindParam(':email', $email);
            $statement->bindParam(':password_hash', $password_hash);
            $statement->bindParam(':is_admin', $is_admin, PDO::PARAM_BOOL);
            try {
                $statement->execute();
            } catch (PDOException $err) {
                $error_msg = 'An error occurred while processing your request: '.$err->getMessage();
                $success = false;
                // Ideally, display the message.
            }
        }
    }

//}
// Now, the page itself.
include('../views/header.php');
?>
    <div id="data_entry", class="container">
        <form action="add-user.php" method="post" style="padding: 2em">
            Add User<br>
            <input type="hidden" name="action" value="adduser">
            <input type="text" id="username" placeholder="Username"><br>
            <input type="email" id="email", placeholder="Email"><br>
            <input type="password" id="password" placeholder="Password"><br>
            <!-- Instructions for players to reach out to the coach if they don't have a login -->
            <button type="submit" id="login">Add User</button> <br><br>
            <?=$error_msg?><?php # I would use an alert box, personally, but that can be done later.?>
            <?php if ($success === true):?>
            The user was added successfully.
            <?php endif?>
        </form>  
    </div>
<?php include('../views/footer.php');?>