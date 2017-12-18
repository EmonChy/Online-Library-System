<?php
include './dbconnect.php';

function student_registration($sid,$s_name,$s_email,$s_mob,$s_pin,$s_amount,$s_dept,$_session)
{
   $reg_date=date('d/m/Y');
   $query = mysql_query("INSERT INTO students_new(u_id,u_name,u_email,u_mob,u_pin,u_amount,u_dept,u_session,u_reg) VALUES('".$sid."','".$s_name."','".$s_email."','".$s_mob."','".$s_pin."','".$s_amount."','".$s_dept."','".$_session."','".$reg_date."')"); 
   if($query){
       return true;
   }else{
       return false;
   }
}
// for sessions
function get_all_sessions()
{
    $var = array();
    $query = mysql_query("SELECT * FROM session");
    
    if($query){
        while($row = mysql_fetch_array($query)){
            $var[] = $row;
        }
    }
    
    return $var;
}

// for departments
function get_all_departments()
{
    $var = array();
    $query = mysql_query("SELECT * FROM department where status=1");
    
    if($query){
        while($row = mysql_fetch_array($query)){
            $var[] = $row;
        }
    }
    
    return $var;
}

function get_all_students()
{
    $var = array();
    $query = mysql_query("SELECT * FROM students_new");
    
    if($query){
        while($row = mysql_fetch_array($query)){
            $var[] = $row;
        }
    }
    
    return $var;
}

function get_dept_info_by_id($_id){
    $customer = array();
    $results = mysql_query("SELECT * FROM department WHERE id='".$_id."'");
    if($results){
        $customer = mysql_fetch_array($results);
    }
    return $customer;
}
function get_ses_info_by_id($_id){
    $customer = array();
    $results = mysql_query("SELECT * FROM session WHERE id='".$_id."'");
    if($results){
        $customer = mysql_fetch_array($results);
    }
    return $customer;
}
function get_sem_info_by_id($_id){
    $customer = array();
    $results = mysql_query("SELECT * FROM semester WHERE id='".$_id."'");
    if($results){
        $customer = mysql_fetch_array($results);
    }
    return $customer;
}
function get_sec_info_by_id($_id){
    $customer = array();
    $results = mysql_query("SELECT * FROM section WHERE id='".$_id."'");
    if($results){
        $customer = mysql_fetch_array($results);
    }
    return $customer;
}
?>
