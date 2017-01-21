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
<div class="login">
     <h2>Register</h2>
     <form method="post" action="register.php" enctype="multipart/form-data" >
          <input name="username" id="loginUserName" placeholder="Username" type="text">';
          <input id="pw" name="password" id="loginPassword" placeholder="Password" type="password">';
          <input type="submit" name="submit" value="Submit" />
     </form>
<?php
 $host = "tcp:a75fmi0ygp.database.windows.net";
 $user = "silverneedle";
 $pwd = "Silver123";
 $db = "SilverNeedle";

 try{
     $conn = new PDO( "sqlsrv:Server= $host ; Database = $db ", $user, $pwd);
     $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    }
 catch(Exception $e){
     die(var_dump($e));
 }
if(!empty($_POST)) {
 try {
     $name = $_POST['username'];
     $pw = $_POST['pw'];
     $date = date("Y-m-d");
     // Insert data
     $sql_insert = "INSERT INTO userList (userName, password, date) 
                    VALUES (?,?,?)";
     $stmt = $conn->prepare($sql_insert);
     $stmt->bindValue(1, $name);
     $stmt->bindValue(2, $pw);
     $stmt->bindValue(3, $date);
     $stmt->execute();
 }
 catch(Exception $e) {
     die(var_dump($e));
 }
 setcookie("userName", $name, time()+3600);
 echo "<h2 class='register'> Redirecting to main page...</h2>";
 header( "refresh:5;url=index.php" );
}

?>
</div>
</body>
</html>