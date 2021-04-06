<?php
/* Database credentials. Running MySQL
server with default setting (user 'root' with no password) 
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'database');
define('DB_PASSWORD', 'baseball');
define('DB_NAME', 'baseball');

/* Attempt to connect to MySQL database 
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
*/
//The above code uses mysqli which is deprecated so we need to use PHP Data Objects I am keeping it for now but we
//will delete it later so it doesn't clutter up the page needlessly
$dsn = 'mysql:host=localhost;dbname=baseball';
$username = 'database';
$password = 'baseball';
$db = new PDO($dsn,$username,$password);

?>
