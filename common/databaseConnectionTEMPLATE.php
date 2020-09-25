<?php
ini_set('upload_max_filesize', '750M');
ini_set('post_max_size', '750M');
ini_set('max_input_vars', '3000');

  
$host="bellobysandronardone.com";
$database="[DATABASE NAME]"; 
$user="[USER]";
$password="[PASSWORD]";
$cxn= mysqli_connect($host,$user,$password,$database);
mysqli_set_charset($cxn,'utf8');


?>