<?php
 // DB connection info
 $host = "tcp:a75fmi0ygp.database.windows.net";
 $user = "silverneedle";
 $pwd = "Silver123";
 $db = "SilverNeedle";
 try{
     $conn = new PDO( "sqlsrv:Server= $host ; Database = $db ", $user, $pwd);
     $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

     $name = "aaron";
     $pw = "test";
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
 echo "<h3>Your're registered!</h3>";

 ?>