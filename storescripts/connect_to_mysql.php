<?php
error_reporting(E_ALL ^ E_DEPRECATED);
?>
<?php   
$db_host = "localhost"; 
$db_username = "root";   
$db_pass = "";  
$db_name = "mystore"; 
 
$conn = mysqli_connect("$db_host","$db_username","$db_pass") or die ("could not connect to mysql");
mysqli_select_db($conn, $db_name) or die ("no database");              
?>