<?php
   session_start();
   unset($_SESSION["login"]);
   unset($_SESSION["authorized"]);
   
   echo 'You have cleaned session';
   header('Location:'.dirname(__FILE__).'validAuthorized.php');
  // echo("<meta http-equiv='refresh' content='1'>");

 
   
?>