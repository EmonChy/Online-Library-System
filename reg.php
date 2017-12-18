<?php
include './dbconnect.php';

if(isset($_REQUEST['u_name'])){
     $s_name = $_REQUEST['u_name'];
     $s_id = $_REQUEST['u_id'];
     $s_email = $_REQUEST['u_email'];
     $s_mob = $_REQUEST['u_mob'];
     $s_pin = $_REQUEST['u_pin'];
     $s_amount = $_REQUEST['u_amount'];
     $s_dept = $_REQUEST['u_dept'];
    
    //echo $s_id.$s_name.$s_email.$s_password;
    
    $query = mysql_query("INSERT INTO students_new(u_name,u_id,u_email,u_mob,u_pin,u_amount,u_dept) VALUES('".$s_name."','".$s_id."','".$s_email."','".$s_mob."','".$s_pin."','".$s_amount."','".$s_dept."')");
    if($query){
        echo 'Insert Success' ;
    } else {
         echo 'Insert Failed' ;
    }
}
?>
