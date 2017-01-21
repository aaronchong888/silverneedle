<?php
  if(isset($_COOKIE["userName"])){
    // TODO: 1. unset the cookie associated with the user. 
	setcookie("userName", "", time()-3600);
    // the header function below redirects the user back to index.php
    header("Location: index.php");
  }
?>
