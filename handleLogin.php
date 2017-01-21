<?php

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
     $sql_select = "SELECT * FROM userList where userName='".$_GET["userName"]."'";
     $stmt = $conn->query($sql_select);
     $registrants = $stmt->fetchAll(); 

  if(array_key_exists("password", $row)&&($row["password"]==$_GET["password"])){

	   setcookie("userName", $_GET["userName"], time()+3600);

  }
  else{
    // The user name and password entered by the user do not match those in the users table.
    // Login failure. Just respond "invalidUserNamePassword".
    // When login() funcion in script.js receives this reponse, it will replace the innerHTML of
    // <div id="loginError"> with "<h3>Invalid user name or password.</h3>".
    print 'invalidUserNamePassword';
  }
?>