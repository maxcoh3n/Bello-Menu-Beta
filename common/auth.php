<?php 
  
if (!isset($_SESSION)) 
   session_start();

  if(! $_SESSION['authorized']) {
      header('Location: login.php');
  }

 ?>