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

    print '<div class="top_left">';
    print '<a class="profile" href="/index.php">Return</a>';
    print '<form class="logoutForm" action="handleLogout.php" method="get">';
    print '<input type="submit" class="log_out" value="Log Out">';
    print '</form>';
    print '</div>';
    print '<div id="result">';
    print '<h2 class="heading">'.$_COOKIE["userName"].'</h2><br><br>';
    print '<img src="images/graph.jpg" alt="Overall Performance" style="width:600px;height:350px;"><br>';
    print '</div>';
?>
</div>
</body>
</html>