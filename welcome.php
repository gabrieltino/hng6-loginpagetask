<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>Welcome</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="./css/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="./css/register.css" />
</head>
<body>
    <div class="container text-center">
        <h3>Hi, <b><?php echo htmlspecialchars($_SESSION["firstname"]); ?></b> Welcome to our site.</h3>
    <p>
        <!-- <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a> -->
        <a href="logout.php" class="btn btn-purple text-white">Sign Out of Your Account</a>
    </p>
    </div>

</body>
</html>