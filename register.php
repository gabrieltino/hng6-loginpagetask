<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$firstname = ""; 
$lastname =  "";
$email = "";
 $password = "";
 $phone = "";

$firstname_err = "";
 $lastname_err = "";
  $email_err ="";
   $password_err ="";
    $phone_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Validate name
  if (empty(trim($_POST["firstname"]))) {
    $firstname_err = "Please enter your name.";
  } else {
    // Prepare a select statement
    $sql = "SELECT id FROM users WHERE firstname = ?";

    if ($stmt = $mysqli->prepare($sql)) {
      // Bind variables to the prepared statement as parameters
      $stmt->bind_param("s", $param_firstname);

      // Set parameters
      $param_firstname = trim($_POST["firstname"]);

      // Attempt to execute the prepared statement
      if ($stmt->execute()) {
        // store result
        $stmt->store_result();

        if ($stmt->num_rows == 1) {
          $firstname_err = "This name is already used.";
        } else {
          $firstname = trim($_POST["firstname"]);
        }
      } else {
        echo "Oops! Something went wrong. Please try again later.";
      }
    }

    // Close statement
    $stmt->close();
  }
 // Validate email
  if (empty(trim($_POST["email"]))) {
    $email_err = "Please enter your email.";
  } else {
    // Prepare a select statement
    $sql = "SELECT id FROM users WHERE email = ?";

    if ($stmt = $mysqli->prepare($sql)) {
      // Bind variables to the prepared statement as parameters
      $stmt->bind_param("s", $param_email);

      // Set parameters
      $param_email = trim($_POST["email"]);

      // Attempt to execute the prepared statement
      if ($stmt->execute()) {
        // store result
        $stmt->store_result();

        if ($stmt->num_rows == 1) {
          $email_err = "This email is already taken.";
        } else {
          $email = trim($_POST["email"]);
        }
      } else {
        echo "Oops! Something went wrong. Please try again later.";
      }
    }

    // Close statement
    $stmt->close();
  }
  // validate name
 if (empty(trim($_POST["lastname"]))) {
    $lastname_err = "Please enter your name.";
  } else {
    $lastname = trim($_POST["lastname"]);
  }

  // Validate password
  if (empty(trim($_POST["password"]))) {
    $password_err = "Please enter a password.";
  } elseif (strlen(trim($_POST["password"])) < 6) {
    $password_err = "Password must have atleast 6 characters.";
  } else {
    $password = trim($_POST["password"]);
  }

  // Validate confirm password
  if (empty(trim($_POST["phone"]))) {
    $phone_err = "Please enter your phone number.";
  } elseif (strlen(trim($_POST["phone"])) < 11) {
    $phone_err = "Phone number must have atleast 11 characters.";
  } else {
    $phone = trim($_POST["phone"]);
  }

  // Check input errors before inserting in database
  if (empty($firstname_err) && empty($lastname_err) && empty($email_err) && empty($password_err) && empty($phone_err)) {

    // Prepare an insert statement
    $sql = "INSERT INTO users (firstname, lastname, email, password, phone) VALUES (?, ?, ?, ?, ?)";

    if (mysqli_query($mysqli, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($mysqli);
};


    if ($stmt = $mysqli->prepare($sql)) {
      // Bind variables to the prepared statement as parameters
      $stmt->bind_param("sssss", $param_firstname, $param_lastname, $param_email, $param_password, $param_phone);

      // Set parameters
      $param_firstname = $firstname;
      $param_lastname = $lastname;
      $param_email = $email;
      $param_phone = $phone;
      $param_password = password_hash($password, PASSWORD_DEFAULT); 
      // Creates a password hash

      // Attempt to execute the prepared statement
      if ($stmt->execute()) {

        // Redirect to login page
        header("location: login.php");
      } else {
        echo "Something went wrong. Please try again later.";
      }
    

    // Close statement
    $stmt->close();
  }
  // Close connection
  $mysqli->close();
}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>Registration</title>
  <link rel="stylesheet" href="./css/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="./css/register.css" />
</head>

<body>
  <div class="container">
    <div>
      <div class="form-head">
        <i class="fas fa-user-plus" style="margin-right: 1em;"></i>
        Register
      </div>
    </div>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <div class="form-group">
        <input class="input-control" type="text" name="firstname" placeholder="First name" value="<?php echo $firstname; ?>" required />

        <input class="input-control " type="text" name="lastname" placeholder="Last name" value="<?php echo $lastname; ?>" required />
      </div>
      <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
        <input class="input-control" type="email" name="email" placeholder="Email" value="<?php echo $email; ?>" required />
        <span class="help-block"><?php echo $email_err; ?></span>
      </div>
      <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
        <input class="input-control" type="password" name="password" placeholder="Password" value="<?php echo $password; ?>" required />
        <span class="help-block"><?php echo $password_err; ?></span>
      </div>
      <div class="form-group <?php echo (!empty($phone_err)) ? 'has-error' : ''; ?>">
        <input class="input-control" type="tel" name="phone" placeholder="Phone number" value="<?php echo $phone; ?>" required />
        <span class="help-block"><?php echo $phone_err; ?></span>
      </div>
      <div class="form-group">
        <button class="btn-purple input-control">Register</button>
      </div>
    </form>
    <div class="have-acct">
      <span>Already have an account?</span>
      <a href="login.php">Sign in</a>
    </div>
  </div>
</body>

</html>