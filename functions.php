<?php
include './dbconnect.php';

function student_registration($sid,$s_name,$s_email,$s_mob,$s_pin,$s_amount,$s_dept,$s_session,$s_semister,$s_section)
{
   $reg_date=date('d/m/Y');
   $c_key = $s_dept.$s_session;
   $query = mysql_query("INSERT INTO students_new(u_id,u_name,u_email,u_mob,u_pin,u_amount,u_dept,u_session,c_key,u_sem,u_section,u_reg) VALUES('".$sid."','".$s_name."','".$s_email."','".$s_mob."','".$s_pin."','".$s_amount."','".$s_dept."','".$s_session."','".$c_key."','".$s_semister."'  , '".$s_section."','".$reg_date."')"); 
   if($query){
       return true;
   }
   else{
       return false;
   }
}
// for all sessions direct show in form
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

// for all departments direct show in form
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
// for all sections direct show in form
function get_all_sections()
{
    $var = array();
    $query = mysql_query("SELECT * FROM section" );
    
    if($query){
        while($row = mysql_fetch_array($query)){
            $var[] = $row;
        }
    }
    
    return $var;
}
// for all semisters direct show in form
function get_all_semister()
{
    $var = array();
    $query = mysql_query("SELECT * FROM semester ");
    
    if($query){
        while($row = mysql_fetch_array($query)){
            $var[] = $row;
        }
    }
    
    return $var;
}

//sob students show hbe from database to browser
function get_all_students()
{
    $var = array();
    $query = mysql_query("SELECT * FROM students_new ");
    
    if($query){
        while($row = mysql_fetch_array($query)){
            $var[] = $row;
        }
    }
    
    return $var;
}
// table a specific dept show hbe instead of relation 

function get_dept_info_by_id($_id){
    $customer = array();
    $results = mysql_query("SELECT * FROM department WHERE id='".$_id."'");
    if($results){
        $customer = mysql_fetch_array($results);
    }
    return $customer;
}
// table a specific session show hbe instead of relation 

function get_ses_info_by_id($_id){
    $customer = array();
    $results = mysql_query("SELECT * FROM session WHERE id='".$_id."'");
    if($results){
        $customer = mysql_fetch_array($results);
    }
    return $customer;
}
// table a specific sem show hbe instead of relation 

function get_sem_info_by_id($_id){
    $customer = array();
    $results = mysql_query("SELECT * FROM semester WHERE id ='".$_id."'");
    if($results){
        $customer = mysql_fetch_array($results);
    }
    return $customer;
}
// table a specific sec show hbe instead of relation 

function get_sec_info_by_id($_id){
    $customer = array();
    $results = mysql_query("SELECT * FROM section WHERE id='".$_id."'");
    if($results){
        $customer = mysql_fetch_array($results);
     }
    return $customer;
}
//student id te click korle new page a specific stdt r info jbe

function get_student_info_by_id($_id){
    $std = array();
    $results = mysql_query("SELECT * FROM students_new WHERE id='".$_id."'");
    if($results){
        $std = mysql_fetch_array($results);
    }
    return $std;
}
//dept a click hole dept soho std info dekhabe

function get_all_students_by_dept($dept_std)
{
    $var = array();
    $query = mysql_query("SELECT * FROM students_new WHERE u_dept = '".$dept_std."' ");
    
    if($query){
        while($row = mysql_fetch_array($query)){
            $var[] = $row;
        }
    }
    
    return $var;
}

//student count on each dept
function get_all_students_by_dept_count($std_count)
{
    $var = array();
    $query = mysql_query("SELECT   * FROM  students_new WHERE u_dept = '".$std_count."' ");
    
    if($query){
        while($row = mysql_fetch_array($query)){
            $var[] = $row;
        }
    }
    
    return $var;
}

//teacher count on each dept
function get_all_teachers_by_dept_count($teacher_count)
{
    $var = array();
    $query = mysql_query("SELECT   * FROM  teacher WHERE dept = '".$teacher_count."' ");
    
    if($query){
        while($row = mysql_fetch_array($query)){
            $var[] = $row;
        }
    }
    
    return $var;
}

//sob teacher show hbe from database to browser
function get_all_teachers()
{
    $var = array();
    $query = mysql_query("SELECT * FROM teacher ORDER BY id DESC ");
    
    if($query){
        while($row = mysql_fetch_array($query)){
            $var[] = $row;
        }
    }
    
    return $var;
}

// total students count hbe
function get_all_students_count()
{
    $var = array();
    $query = mysql_query("SELECT   * FROM  students_new ");
    
    if($query){
        while($row = mysql_fetch_array($query)){
            $var[] = $row;
        }
    }
    
    return $var;
}
//student login korar jnno

function check_function($id,$pass){
    $std = array();
    $results = mysql_query("SELECT * FROM students_new WHERE u_id='".$id."' AND password='".$pass."'");
    if($results){
        $std = mysql_fetch_array($results);
    }
    return $std;
}

//using in upadating student data

function edit($std_name,$std_id,$std_email,$std_mob,$s_id)
{
  
    $query = mysql_query("UPDATE students_new SET u_name = '".$std_name."',u_id = '".$std_id."', u_email = '".$std_email."',u_mob = '".$std_mob."' WHERE id = '".$s_id."'");
    
    if($query){
        return TRUE;
    }
    else{
        return FALSE;
    }
}

//student delete korar jnno browser thk

function get_std_by_id_delete($std_delete)
{
  
    $query = mysql_query("DELETE from students_new WHERE id = '".$std_delete."'");
    
    if($query){
        return TRUE;
    }
    else{
        return FALSE;
    }
}

//book issue with student id

function check_std_id_book_code($code,$id){
    $std = array();
    $results = mysql_query("SELECT * FROM issue_books WHERE book_id='".$code."' AND student_id = '".$id."'");
    if($results){
        $std = mysql_fetch_array($results);
    }
    return $std;
 }
 



//book issue with book code from book table

function check_book($id){
    $std = array();
    $results = mysql_query("SELECT * FROM book WHERE code='".$id."'");
    if($results){
        $std = mysql_fetch_array($results);
    }
    return $std;
 }
 
 //book issue with student id from student table
 
 function check_std($id){
    $std = array();
    $results = mysql_query("SELECT * FROM students_new WHERE u_id ='".$id."'");
    if($results){
        $std = mysql_fetch_array($results);
    }
    return $std;
 }
 
 function book_issue($sid,$s_code)
{
   $reg_date=date('d/m/Y');
   $query = mysql_query("INSERT INTO issue_book(book_id,student_id,issue_date) VALUES('".$sid."','".$s_code."','".$reg_date."')"); 
   if($query){
       return true;
   }
   else{
       return false;
   }
}

function get_all_issue_books()
{
    $var = array();
    $query = mysql_query("SELECT * FROM issue_book ");
    
    if($query){
        while($row = mysql_fetch_array($query)){
            $var[] = $row;
        }
    }
    
    return $var;
}



function get_issue_info_by_student_id($_id){
    $customer = array();
    $results = mysql_query("SELECT * FROM students_new WHERE id='".$_id."'");
    if($results){
        $customer = mysql_fetch_array($results);
    }
    return $customer;
}


function get_issue_info_by_book_id($_id){
    $customer = array();
    $results = mysql_query("SELECT * FROM book WHERE id='".$_id."'");
    if($results){
        $customer = mysql_fetch_array($results);
    }
    return $customer;
}
?>
