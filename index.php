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
    print '<input id="pw" name="password" id="loginPassword" placeholder="Password" type="password">';
    print '<input type="submit" value="Login" onclick="login()">';
    print '<a class="register" href="/register.php">Register</a>';
    print '</div><div id="loginError"></div>';
  }
  else{
    // DB connection info
     $host = "tcp:a75fmi0ygp.database.windows.net";
     $user = "silverneedle";
     $pwd = "Silver123";
     $db = "SilverNeedle";
     // Connect to database.
     try {
         $conn = new PDO( "sqlsrv:Server= $host ; Database = $db ", $user, $pwd);
         $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
     }
     catch(Exception $e){
         die(var_dump($e));
     }
     $sql_select = "SELECT * FROM users";
     $stmt = $conn->query($sql_select);
     $registrants = $stmt->fetchAll(); 
     if(count($registrants) > 0) {
         echo "<h2>People who are registered:</h2>";
         echo "<table>";
         echo "<tr><th>Name</th>";
         echo "<th>Pw</th>";
         echo "<th>Date</th></tr>";
         foreach($registrants as $registrant) {
             echo "<tr><td>".$registrant['name']."</td>";
             echo "<td>".$registrant['pw']."</td>";
             echo "<td>".$registrant['date']."</td></tr>";
         }
          echo "</table>";
     } 

    print '<h3 id="heading">You have successfully logged in.</h3><br>';
    }
  }
?>
</div>
</body>
</html>