 <html>
  <head>
    <meta charset="utf-8">
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
    print '</div><div id="loginError" class="err_msg"></div>';
  }
  else{
    print '<div class="top_left">';
    print '<a class="register" href="/profile.php">'.$_COOKIE["userName"].'</a>';
    print '<form class="logoutForm" action="handleLogout.php" method="get">';
    print '<input type="submit" class="log_out" value="Log Out">';
    print '</form>';
    print '</div>';
    print '<h2 id="heading"> What to eat next?</h2><br>';
  }
?>
</div>
</body>
</html>