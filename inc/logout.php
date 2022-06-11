<?php
   session_start();
   unset($_SESSION["login"]);
   unset($_SESSION["authorized"]);
   
   echo 'You have cleaned session';
   header('Refresh: 2; URL = ../validAuthorized.php');
   
?>