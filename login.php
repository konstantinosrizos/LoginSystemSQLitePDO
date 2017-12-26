<?php

//session starts here 
session_start();

include("database.php");

// Application library ( with DemoLib class )
require __DIR__ . '/lib/library.php';

//include("lib/library.php");
$app = new DemoLib();
 
$login_error_message = '';
$register_error_message = '';
 
// check Login request
if (!empty($_POST['join'])) {
 
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
 
    if ($username == "") {
        $login_error_message = 'Username field is required!';
    } else if ($password == "") {
        $login_error_message = 'Password field is required!';
    } else {
        $user_id = $app->Login($username, $password); // check user login
        if($user_id > 0)
        {
            $_SESSION['user_id'] = $user_id; // Set Session

            header("Location: welcome.php"); // Redirect user to the welcome.php
        }
        else
        {
            $login_error_message = 'Invalid login details!';
        }
    }
}

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Daily UI 001 Sign Up Form</title>
  
  
  <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.css'>
  <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css'>

      <link rel="stylesheet" href="css/style.css">

</head>

<body>
  <div class="signupSection">
  <div class="info">
    <h2>Login-Logout using PHP & SQLite-PDO</h2>
    <i class="icon ion-ios-ionic-outline" aria-hidden="true"></i>
    <p>The Future Is Here</p>
  </div>
        <?php
            if ($login_error_message != "") {
                echo '<script language="javascript">alert("Please enter valid username and password");</script>';
            }
        ?>
  <form action="login.php" method="POST" class="signupForm" name="signupform">
    <h2>Log In</h2>
    <ul class="noBullet">
      <li>
        <label for="username"></label>
        <input type="text" class="inputFields" id="username" name="username" placeholder="Username" value="" oninput="return userNameValidation(this.value)" required/>
      </li>
      <li>
        <label for="password"></label>
        <input type="password" class="inputFields" id="password" name="password" placeholder="Password" value="" oninput="return passwordValidation(this.value)" required/>
      </li>
      <li id="center-btn">
        <input type="submit" id="join-btn" name="join" alt="Join" value="Log In">
        <input type="button" id="join-btn" name="join" alt="Join" value="Create Account" onclick="window.location='registration.php';">
      </li>
    </ul>
  </form>
</div>
  
    <script src="js/index.js"></script>

</body>
</html>
