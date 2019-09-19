<?php

// session_start();
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'db4free.net:3306');
define('DB_USERNAME', 'teamsixpathdev');
define('DB_PASSWORD', 'sixpathdev');
define('DB_NAME', 'teamsixpathdev');
 
/* Attempt to connect to MySQL database */
$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($mysqli === false){
    die("ERROR: Could not connect. " . $mysqli->connect_error);
}
echo "Connected successfully";
?>