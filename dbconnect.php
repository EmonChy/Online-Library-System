<?php 
$hostname = 'localhost';
$user = 'root';
$password = '';
$database = 'my_university';
//////////////////////////////////////
$connection = mysql_connect($hostname,$user,$password);

if($connection){
    $select_db = mysql_select_db($database,$connection);
    if(!$select_db){
        echo "Database not found.";
    }
}
else {
    echo 'Database Connection Failed.';
}
?>
