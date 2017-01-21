<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SilverNeedle</title>
    <link rel="stylesheet" type="text/css"  href="style.css">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Sofia' rel='stylesheet' type='text/css'>
    <script src="jquery-3.1.1.min.js"></script>
    <script src="script.js"></script>
  </head>

<body>
<div id="content">
<?php

  if(!isset($_COOKIE["userName"])){
    print '<div class="login">';
    print '<h2>Silver</h2>';
    print '<input name="username" id="loginUserName" placeholder="Username" type="text">';
    print '<input name="password" id="loginPassword" placeholder="Password" type="password">';
    print '<input type="submit" value="Login" onclick="login()">';
    print '<a class="register" href="/register.php">Register</a>';
    print '<div id="loginError" class="err_msg"></div></div>';
  }
  else{
    print '<div class="top_left">';
    print '<a class="profile" href="/profile.php">'.$_COOKIE["userName"].'</a>';
    print '<form class="logoutForm" action="handleLogout.php" method="get">';
    print '<input type="submit" class="log_out" value="Log Out">';
    print '</form>';
    print '</div>';
    print '<h2 class="heading"> What to eat next?</h2><br>';
    print '<div class="fileinput fileinput-new" data-provides="fileinput">';
    print '<img src="images/needle.png" alt="Take a Picture!" style="width:400px;height:400px;"><br>';
    print '<form class="logoutForm" action="result.php" method="post">';
    print '<input type="file" accept="image/*" capture="capture"><br>';
    print '<input type="submit" value="Check it out">';
    print '</form>';
  }
?>
</div>
</body>
</html>