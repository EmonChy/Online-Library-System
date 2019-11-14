<?php
include './includes/dbconnect.php';
///////////////////////////////////////////////////////////////////////////////

function generatePIN($digits = 4){
    $i = 0; //counter
    $tpin = ""; //our default pin is blank.
    while($i < $digits){
        //generate a random number between 0 and 9.
        $tpin .= mt_rand(0, 9);
        $i++;
    }
    return $tpin;
}
/////////////////////////////////////////////////////////////////////////////// for Employee
function check_employee_info($email){
    global $connecton;
    $results = mysqli_query($connecton,"SELECT * FROM atw_employee WHERE a_userid='".$email."' OR a_email='".$email."'");
    if($results){
        $num_of_user = mysqli_num_rows($results);
        if($num_of_user>0){
            return mysqli_fetch_array($results);
        }
}
    return false;
}

function check_user_info($email){
    global $connecton;
    $results = mysqli_query($connecton, "SELECT * FROM libsys_students WHERE s_code='".$email."' OR s_email='".$email."'");
    if($results){
        $num_of_user = mysqli_num_rows($results);
        if($num_of_user>0){
            return mysqli_fetch_array($results);
        }
}
    return false;
}

function is_employee($email,$password){
    global $connecton;
    $results = mysqli_query($connecton,"SELECT * FROM atw_employee WHERE a_userid='".$email."' AND a_password='".$password."' OR a_email='".$email."' AND a_password='".$password."'");
    if($results){
        $num_of_user = mysqli_num_rows($results);
        if($num_of_user>0){
            return mysqli_fetch_array($results);
        }
    }
    return false;
}


function is_user($email,$password){
    global $connecton;
    $results = mysqli_query($connecton,"SELECT * FROM libsys_students WHERE s_code='".$email."' AND s_password='".$password."' OR s_email='".$email."' AND s_password='".$password."'");
    if($results){
        $num_of_user = mysqli_num_rows($results);
        if($num_of_user>0){
            return mysqli_fetch_array($results);
        }
    }
    return false;
}

function get_employee_info_by_id($user_id){
    global $connecton;
    $var = array();
    $results = mysqli_query($connecton,"SELECT * FROM atw_employee WHERE a_id ='".$user_id."'");
    if($results){
        $var = mysqli_fetch_array($results);
    }
    return $var;
}

function check_employee_tpin($user_id,$tpin){
    global $connecton;
    $results = mysqli_query($connecton,"SELECT * FROM atw_employee WHERE a_id='".$user_id."' AND a_tpin='".$tpin."'");
    if($results){
        $num_of_row = mysqli_num_rows($results);
        if($num_of_row>0){
            return true;
        }
}
    return false;
}

function check_user_contact($user_id,$con){
    global $connecton;
    $results = mysqli_query($connecton,"SELECT * FROM libsys_students WHERE s_id='".$user_id."' AND s_contact='".$con."'");
    if($results){
        $num_of_row = mysqli_num_rows($results);
        if($num_of_row>0){
            return true;
        }
}
    return false;
}

function update_employee_password($user_id,$password){
    global $connecton;
    $result = mysqli_query($connecton,"UPDATE atw_employee SET a_password ='".$password."' WHERE a_id='".$user_id."' ");
    if($result){
        return true;
    }
    return false;
}

function update_user_password($user_id,$password){
    global $connecton;
    $result = mysqli_query($connecton,"UPDATE libsys_students SET s_password ='".$password."' WHERE s_id='".$user_id."' ");
    if($result){
        return true;
    }
    return false;
}
function update_employee_tpin($user_id,$n_tpin){
    global $connecton;
    $result = mysqli_query($connecton,"UPDATE atw_employee SET a_tpin ='".$n_tpin."' WHERE a_id='".$user_id."' ");
    if($result){
        return true;
    }
    return false;
}



function add_books($b_code,$b_name,$b_author,$b_publisher,$b_qty,$b_self,$b_price){
    global $connecton;
    $b_status = "1";
    $b_check = $b_author.$b_publisher;
    $result = mysqli_query($connecton,"INSERT INTO libsys_books(b_code,b_name,b_author,b_publishar,b_check,b_qty,b_self,b_price,b_status) VALUES('".$b_code."','".$b_name."','".$b_author."','".$b_publisher."','".$b_check."','".$b_qty."','".$b_self."','".$b_price."','".$b_status."')");
    if($result){
        return true;
    }
    return false;
}



function edit_books($b_code,$b_name,$b_author,$b_publisher,$b_qty,$b_self,$b_price,$b_id){
    //$b_status = "1";
    //$b_check = $b_author.$b_publisher;
    global $connecton;
    $result = mysqli_query($connecton,"UPDATE libsys_books SET b_code = '".$b_code."',b_name = '".$b_name."',b_author = '".$b_author."',b_publishar = '".$b_publisher."',b_qty = '".$b_qty."',b_self= '".$b_self."',b_price= '".$b_price."' WHERE b_id='".$b_id."'");
    if($result){
        return true;
    }
    return false; 
}


function add_students($s_name,$s_code,$s_dept,$s_sem,$s_contact,$s_email,$std_picture,$s_password,$s_vkey){
       global $connecton;
       $s_status = "0";    
       $dt = new DateTime();
       $tz = new DateTimeZone('Asia/Dhaka'); // or whatever zone you're after
       $dt->setTimezone($tz);
       $reg_date = $dt->format('Y-m-d g:i:s a');
    
    $result = mysqli_query($connecton,"INSERT INTO libsys_students(s_name,s_code,s_dept,s_semester,s_contact,s_email,s_pic,s_password,s_reg,s_vkey,s_status) VALUES('".$s_name."','".$s_code."','".$s_dept."','".$s_sem."','".$s_contact."','".$s_email."','".$std_picture."','".$s_password."','".$reg_date."','".$s_vkey."','".$s_status."')");
        
    if($result){
        return true;
        //return true;
    }
    return false;
}

//function check_student_email($search)
//{
//     
//    $std_email = array();
//    $qu = mysql_query("SELECT * FROM  libsys_students WHERE s_email ='".$search."'");
//    
//    if($qu){
//        while($row = mysql_fetch_array($qu)){
//            $std_email[] = $row;
//        }
//    }
//    
//    return $std_email;
//}



function edit_students($s_name,$s_code,$s_dept,$s_sem,$s_contact,$s_email,$s_id){
    global $connecton;
    //$s_status = "1";
    //$reg_date = date('Y-m-d');
    
    //$query = mysql_query("UPDATE libsys_students SET s_name = '".$s_name."',s_code = '".$s_code."',s_dept = '".$s_dept."',s_semester = '".$s_sem."'" WHERE id = '".$s_id."'");
    $result = mysqli_query($connecton,"UPDATE libsys_students SET s_name = '".$s_name."',s_code = '".$s_code."',s_dept = '".$s_dept."',s_semester = '".$s_sem."',s_contact = '".$s_contact."',s_email= '".$s_email."' WHERE s_id='".$s_id."'");
    if($result){
        return true;
    }
    return false;       
    
    
}


function get_all_libsys_author(){
    global $connecton;
    $var = array();
    $query = mysqli_query($connecton,"SELECT * FROM libsys_author");
    if($query){
        while($row = mysqli_fetch_array($query)){
            $var[] = $row;
        }
    }else{
        echo mysqli_error();
    }
    return $var;
}

function get_all_libsys_publisher(){
    global $connecton;
    $var = array();
    $query = mysqli_query($connecton,"SELECT * FROM libsys_publisher");
    if($query){
        while($row = mysqli_fetch_array($query)){
            $var[] = $row;
        }
    }else{
        echo mysqli_error();
    }
    return $var;
}

function get_all_libsys_dept(){
    global $connecton;
    $var = array();
    $query = mysqli_query($connecton,"SELECT * FROM libsys_departments");
    if($query){
        while($row = mysqli_fetch_array($query)){
            $var[] = $row;
        }
    }else{
        echo mysqli_error();
    }
    return $var;
}
function get_all_libsys_sem(){
    global $connecton;
    $var = array();
    $query = mysqli_query($connecton,"SELECT * FROM libsys_semester");
    if($query){
        while($row = mysqli_fetch_array($query)){
            $var[] = $row;
        }
    }else{
        echo mysqli_error();
    }
    return $var;
}

function get_all_libsys_books(){
    global $connecton;
    $var = array();
    $query = mysqli_query($connecton,"SELECT * FROM libsys_books");
    if($query){
        while($row = mysqli_fetch_array($query)){
            $var[] = $row;
        }
    }else{
        echo mysqli_error();
    }
    return $var;
}

function get_all_libsys_students(){
    global $connecton;
    $var = array();
    $query = mysqli_query($connecton,"SELECT * FROM libsys_students ORDER BY s_id DESC");
    if($query){
        while($row = mysqli_fetch_array($query)){
            $var[] = $row;
        }
    }else{
        echo mysqli_error();
    }
    return $var;
}

function get_all_libsys_books_category(){
    global $connecton;
    $var = array();
    $query = mysqli_query($connecton,"SELECT * FROM libsys_books_category");
    if($query){
        while($row = mysqli_fetch_array($query)){
            $var[] = $row;
        }
    }else{
        echo mysqli_error();
    }
    return $var;
}

function get_book_info_by_id($b_id){
    global $connecton;
    $var = array();
    $query = mysqli_query($connecton,"SELECT * FROM libsys_books WHERE b_id='".$b_id."'");
    if($query){
        $var = mysqli_fetch_array($query);
    }
    return $var;
}

function get_book_info_by_code($b_code){
    global $connecton;
    $var = array();
    $query = mysqli_query($connecton,"SELECT * FROM libsys_books WHERE b_code='".$b_code."'");
    if($query){
        $var = mysqli_fetch_array($query);
    }
    return $var;
}

function get_student_info_by_id($s_id){
    global $connecton;
    $var = array();
    $query = mysqli_query($connecton,"SELECT * FROM libsys_students WHERE s_id='".$s_id."'");
    if($query){
        $var = mysqli_fetch_array($query);
    }
    return $var;
}

function get_all_libsys_issue_book($s_id){
    global $connecton;
    $var = array();
    $query = mysqli_query($connecton,"SELECT * FROM libsys_issue WHERE i_student_id='".$s_id."'");
    if($query){
        $var = mysqli_fetch_array($query);
    }
    return $var;
}

function get_all_libsys_issue_return_book(){
    global $connecton;
    $var = array();
    $query = mysqli_query($connecton,"SELECT * FROM libsys_issue");
     if($query){
        while($row = mysqli_fetch_array($query)){
            $var[] = $row;
        }
    }else{
        echo mysqli_error();
    }
    return $var;
}



function get_all_libsys_books_issue_by_id($id){
    global $connecton;
    $var = array();
    $query = mysqli_query($connecton,"SELECT * FROM libsys_issue WHERE i_student_id='".$id."' ORDER BY i_id DESC");
    if($query){
        while($row = mysqli_fetch_array($query)){
            $var[] = $row;
        }
    }else{
        echo mysqli_error();
    }
    return $var;
}

function get_all_libsys_books_issue_by_id_count($id,$status){
    global $connecton;
    $var = array();
    $query = mysqli_query($connecton,"SELECT * FROM libsys_issue WHERE i_student_id='".$id."' AND i_status = '".$status."'");
    if($query){
        while($row = mysqli_fetch_array($query)){
            $var[] = $row;
        }
    }else{
        echo mysqli_error();
    }
    return $var;
}

function get_student_info_by_code($s_code){
    global $connecton;
    $var = array();
    $query = mysqli_query($connecton,"SELECT * FROM libsys_students WHERE s_code='".$s_code."'");
    if($query){
        $var = mysqli_fetch_array($query);
    }
    return $var;
}

function get_author_info_by_id($au_id){
    global $connecton;
    $var = array();
    $query = mysqli_query($connecton,"SELECT * FROM libsys_author WHERE au_id='".$au_id."'");
    if($query){
        $var = mysqli_fetch_array($query);
    }
    return $var;
}

function get_dept_info_by_id($dep_id){
    global $connecton;
    $var = array();
    $query = mysqli_query($connecton,"SELECT * FROM libsys_departments WHERE d_id='".$dep_id."'");
    if($query){
        $var = mysqli_fetch_array($query);
    }
    return $var;
}

function get_sem_info_by_id($sem_id){
    global $connecton;
    $var = array();
    $query = mysqli_query($connecton,"SELECT * FROM libsys_semester WHERE sem_id='".$sem_id."'");
    if($query){
        $var = mysqli_fetch_array($query);
    }
    return $var;
}


function get_publisher_info_by_id($pub_id){
    global $connecton;
    $var = array();
    $query = mysqli_query($connecton,"SELECT * FROM libsys_publisher WHERE pub_id='".$pub_id."'");
    if($query){
        $var = mysqli_fetch_array($query);
    }
    return $var;
}

function get_book_category_info_by_id($ex_category){
    global $connecton;
    $var = array();
    $results = mysqli_query($connecton,"SELECT * FROM libsys_books_category WHERE bc_id='".$ex_category."'");
    if($results){
        $var = mysqli_fetch_array($results);
    }
    return $var;
}


function issue_books_new($s_id,$b_id){
    global $connecton;
    $ck_key=$b_id.$s_id;
    $check_book = mysqli_query($connecton,"SELECT * FROM libsys_issue where i_check = '".$ck_key."' AND i_status='0'");
    if(mysql_num_rows($check_book)>0){
        $i_date=date('Y-m-d');
        $r_date=date('Y-m-d',strtotime($i_date. ' + 15 days'));
        $result = mysqli_query($connecton,"UPDATE libsys_issue SET i_status='1',i_date='".$i_date."',i_r_date='".$r_date."' WHERE i_check='".$ck_key."'");
    if($result){
        return true;
    }
    return false;  
        
    }
    else{
    $i_status = "1";
    $i_check=$b_id.$s_id;
    $i_date=date('Y-m-d');
    $r_date=date('Y-m-d',strtotime($i_date.'+ 15 days'));
    $result = mysqli_query($connecton,"INSERT INTO libsys_issue(i_student_id,i_book_id,i_check,i_date,i_r_date,i_status) VALUES('".$s_id."','".$b_id."','".$i_check."','".$i_date."','".$r_date."','".$i_status."')");
    if($result){
        return true;
    }
    return false;
 }
}


function return_issue_books($s_id,$b_id){
    global $connecton;
    $ck_key=$b_id.$s_id;
    $r_date=date('Y-m-d');
    $check_updt_book = mysqli_query($connecton,"SELECT * FROM libsys_issue where i_check = '".$ck_key."' AND i_status='1'");
    if(mysqli_num_rows($check_updt_book)>0){
        $issue_info = mysqli_fetch_array($check_updt_book);
        $pre_i_date=$issue_info['i_date'];
        $pre_r_date=$issue_info['i_r_date'];
        $i_diff=round(abs(strtotime($pre_r_date)-strtotime($pre_i_date))/86400);
        $i_fine='0';
        $fine_rate='1';
        if($i_diff>15){
            $fine_day=$i_diff-15;
            $i_fine=$fine_day*$fine_rate;
        }
        
    $result = mysqli_query($connecton,"UPDATE libsys_issue SET i_status='0',i_r_date='".$r_date."',i_fine='".$i_fine."' WHERE i_check='".$ck_key."'");
    if($result){
        return true;
    }
    return false;
}
}



function update_book_qty_minus($b_id){
    global $connecton;
    $book_info=get_book_info_by_id($b_id);
    $b_qty=$book_info['b_qty']-1;
    $result = mysqli_query($connecton,"UPDATE libsys_books SET b_qty='".$b_qty."' WHERE b_id='".$b_id."'");
    if($result){
        return true;
    }
    return false;
}



function update_book_qty_plus($b_id){
    global $connecton;
    $book_info=get_book_info_by_id($b_id);
    $b_qty=$book_info['b_qty']+1;
    $result = mysqli_query($connecton,"UPDATE libsys_books SET b_qty='".$b_qty."' WHERE b_id='".$b_id."'");
    if($result){
        return true;
    }
    return false;
}


?>