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
     $sql_select = "SELECT * FROM userList where userName='".$_GET["userName"]."' AND password='".$_GET["password"]."'";
     $stmt = $conn->query($sql_select);
     $registrants = $stmt->fetchAll(); 
     
     if(count($registrants) > 0) {
	   setcookie("userName", $_GET["userName"], time()+3600);
       print 'Success';
     }
     else {
        print 'invalidUserNamePassword';
    }
?>