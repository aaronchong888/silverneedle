<?php
 // DB connection info
 $host = "tcp:a75fmi0ygp.database.windows.net";
 $user = "silverneedle";
 $pwd = "Silver123";
 $db = "SilverNeedle";
 try{
     $conn = new PDO( "sqlsrv:Server= $host ; Database = $db ", $user, $pwd);
     $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
     $sql = "CREATE TABLE userList(
     id INT NOT NULL IDENTITY(1,1) 
     PRIMARY KEY(id),
     userName VARCHAR(30),
     password VARCHAR(30),
     date DATE)";
     $conn->query($sql);
 }
 catch(Exception $e){
     die(print_r($e));
 }
 echo "<h3>Table created.</h3>";
 ?>