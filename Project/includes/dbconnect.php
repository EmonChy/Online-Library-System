<?php
$hostName='localhost';
$userName='root';
$password='';
$database='db_library';
//$link = mysql_connect("localhost","root","");
$connecton = mysqli_connect($hostName,$userName,$password,$database);

if (!$connecton){
    
    die("database not connect". mysqli_connect_error());
      
}
?>