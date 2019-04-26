<?php
//session_start();
//if(!isset($_SESSION['employee'])){
//header("Location: login.php");
//}else{

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include './includes/common.php';
include './includes/functions.php';
$pageName = 'Add Student';
$updateStatus = "";

//$user_id = $_SESSION['employee']['a_id'];
//$user_info = get_employee_info_by_id($user_id);



$message='';
if(isset($_REQUEST['s_email'])&&isset($_REQUEST['s_pass'])){
    $s_name= strtoupper($_REQUEST['s_name']);
    $s_code= strtoupper($_REQUEST['s_code']);
    $s_dept=$_REQUEST['s_dept'];
    $s_sem = $_REQUEST['s_sem'];
    $s_contact=$_REQUEST['s_contact'];
    $s_email=$_REQUEST['s_email'];
    
   
    $s_pass=$_REQUEST['s_pass'];
    $s_c_pass=$_REQUEST['s_c_pass'];
    /*
     if(!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $s_email)){
    // Return Error - Invalid Email
    $message = 'The email you have entered is invalid, please try again.';
     }
     */
     if (!filter_var($s_email, FILTER_VALIDATE_EMAIL)) {
            $message = "Invalid email format"; 
       }
    
     if(!empty($_FILES['std_img']['tmp_name']))
     {
      $std_picture = addslashes(file_get_contents($_FILES['std_img']['tmp_name']));
     }
     else{
         $msgfhg.="<b class='text-danger'>Error Uploading,Select a valid Picture(jpg,png etc format image & size must be less then or equal 60 kb).</b>";
     }
    
    if($s_pass==$s_c_pass){
        $s_password= md5($s_pass);
        
        $s_vkey = md5(time().$s_name);
         
    
        $add_students=add_students($s_name,$s_code,$s_dept,$s_sem,$s_contact,$s_email,$std_picture,$s_password,$s_vkey);
        if($add_students){
            
           require 'PHPMailer-master/src/Exception.php';
           require 'PHPMailer-master/src/PHPMailer.php';
           require 'PHPMailer-master/src/SMTP.php';
           
            $message_body = "Dear $s_name,
            <br />
            <p>Please Verify below this link,to activate your account.</p>
            <a href='http://localhost/users/verify.php?vkey=$s_vkey'>Just Click</a><br>
            Regards,<br />
            <b>Admin</b>";
            
           
             //$message_body = "<a href='http://localhost/Email_OTP/verify.php?vkey=$vkey'>Register Account</a>";
		
                $mail = new PHPMailer();
                
                ////////
                $mail->SMTPDebug = 0;                                 // Enable verbose debug output
                $mail->isSMTP();                                      // Set mailer to use SMTP
                $mail->Host = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                               // Enable SMTP authentication
                $mail->Username = 'emonchy35@gmail.com';                 // SMTP username
                $mail->Password = 'Emon@@@3Chy';                           // SMTP password
                $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 587;                                    // TCP port to connect to

                
                
                
            ////////////    
	   $mail->AddReplyTo('emonchy35@gmail.com','Admin');
           
                                $mail->SetFrom('emonchy35@gmail.com','Admin');
                                $mail->AddAddress($s_email);
                                $mail->Subject= "Account Verification";
                                $mail->MsgHTML($message_body);
                                $result=$mail->Send();
                                
                                //header('Location:new.php');
                                //alert("Pls check your email,to active account");
                                if(!$result) {
                                    echo "Mailer Error: " . $mail->ErrorInfo;
                                }else {
                                    
                                $message = "Registration Pending,Pls Check Your Email";
   
                                    	//return $result;  
                                }
            
            
            //$message='Registration Success.';
        
            
            
            
        }else{
            $message='Data Insert Failed.';
        }
    }
    else {
        $message='Password Not Match.Pls Try Again';
    }
}

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $WebsiteSiteName.'-'.$pageName; ?></title>
    <link rel="shortcut icon" href="favicon.ico">
	<!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
        <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>

     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
<script type="text/javascript">
    function DisableAutoComp() {
        var username = document.getElementById("form");
        if ('autocomplete' in username) {
            username.autocomplete = "off";
        }
        else {
            // Firefox
            username.setAttribute("autocomplete", "off");
        }
    }
</script>
   <script type="text/javascript">
//
//function checkname()
//{
// var name=document.getElementById( "UserName" ).value;
//	
// if(name)
// {
//  $.ajax({
//  type: 'post',
//  url: 'checkdata.php',
//  data: {
//   user_name:name,
//  },
//  success: function (response) {
//   $( '#name_status' ).html(response);
//   if(response=="OK")	
//   {
//    return true;	
//   }
//   else
//   {
//    return false;	
//   }
//  }
//  });
// }
// else
// {
//  $( '#name_status' ).html("");
//  return false;
// }
//}

function checkemail()
{
 var email=document.getElementById( "std_email" ).value;
	
 if(email)
 {
  $.ajax({
  type: 'post',
  url: 'check_data.php',
  data: {
   s_email:email,
  },
  success: function (response) {
   $( '#availability' ).html(response);
   if(response=="OK")	
   {
    return true;	
   }
   else
   {
    return false;	
   }
  }
  });
 }
 else
 {
  $( '#availability' ).html("");
  return false;
 }
}

function checkall()
{
 //var namehtml=document.getElementById("name_status").innerHTML;
 var emailhtml=document.getElementById("availability").innerHTML;

 if((emailhtml)=="OK")
 {
  return true;
 }
 else
 {
  return false;
 }
}

</script>
   
   
</head>
<body onload="DisableAutoComp();" onsubmit="return checkall();">
    <div id="wrapper">
        <?php //include './navtop.php'; ?>  
        <!-- /. NAV TOP  -->
        <?php //include './navside.php'; ?>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                       
                         <?php
                           
//                          $dt = new DateTime();
//                          $tz = new DateTimeZone('Asia/Dhaka'); // or whatever zone you're after
//
//                          $dt->setTimezone($tz);
//                          echo $dt->format('g:i a');
                         
                          date_default_timezone_set('Asia/Dhaka');
                          $dt = date('h:i:sa').'('.date('d-m-y').')';
                          echo $dt;

                    ?>
                    </div>
                </div>
                 <!-- /. ROW  -->
                 
               <div class="row">
                <div class="col-md-12">
                    <!-- Form Elements -->
                    <div class="panel panel-default well">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <form id="form" action="" method="post"  onsubmit="return checkall();" enctype="multipart/form-data">
                                        <table class="table table-condensed table-striped">
                                            <thead>
                                                <tr class="btn-success text-center">
                                                    <td colspan="2"><h3><b>Registration Panel</b></h3></td>
                                                </tr>
                                                <?php
                                                if($message){
                                                ?>
                                                <tr class="btn-default text-center">
                                                    <td class="btn-default" colspan="2">
                                                        <div class="alert alert-info alert-dismissible">
                                                          <button type="button" class="close" data-dismiss="alert">×</button>
                                                           <strong> Message : <?php echo $message; ?></strong>
                                                        </div> 
                                                        <!--<b style="color: red;">Message : <?php //echo $message; ?></b> -->
                                                    </td>
                                                </tr>
                                                <?php }else{ ?>
                                                <tr class="text-center">
                                                    <td colspan="2">
                                                        
                                                        <div class="alert alert-success alert-dismissible">
                                                          <button type="button" class="close" data-dismiss="alert">×</button>
                                                           <strong> Please input the current information. </strong>
                                                        </div>

                                                        <!--<b style="color: #0088cc;">Please input the current information.</b>-->
                                                    </td>
                                                </tr>
                                                <?php } ?>
                                                
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-right"><h5><b>Student Code :</b></h5></td>
                                                    <td><b><input class="form-control" type="text" name="s_code" placeholder="Enter Code" required="" /></b></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right"><h5><b>Student Name :</b></h5></td>
                                                    <td><b><input class="form-control" type="text" name="s_name" placeholder="Enter Name" required="" /></b></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right"><h5><b>Student Contact :</b></h5></td>
                                                    <td><b><input class="form-control" name="s_contact" type="text"  placeholder="Enter Contact" minlength="11" maxlength="11" required="" /></b></td>
                                                </tr>
                                                 <tr>
                                                    <td class="text-right"><h5><b>Student Email :</b></h5></td>
                                                    <td><b><input class="form-control" name="s_email" id="std_email" type="email"  placeholder="Enter Email" required=""  onkeyup="checkemail();"  /></b>
                                                       <span id="availability" style="font-weight: bold;"></span>
                                                        
                                                    </td>
                                                    
                                                        
                                                 </tr>
                                                
                                                  
                                                         <tr>
                                                    <td class="text-right"><b>Student Image :</b></td>
                                                    <td><b><input type="hidden" name="MAX_FILE_SIZE" value="63500" />
                                                            <input class="form-control" type="file" name="std_img"> </b></td>
                                                     </tr>
                                                    
                                                
                                                
                                                
                                                <tr>
                                                    <td class="text-right"><h5><b>Student Dept :</b></h5></td>
                                                    <td><b><select class="form-control" name="s_dept" required="">
                                                                    <option value="">Select Department</option>
                                                                    <?php 
                                                                    $all_dept= get_all_libsys_dept();
                                                                    foreach ($all_dept as $dept){
                                                                    ?>
                                                                    <option value="<?php echo $dept['d_id']; ?>"><?php echo $dept['d_code']."(".$dept['d_name'].")"; ?></option>
                                                                    <?php } ?>
                                                        </select></b></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right"><h5><b>Student Sem :</b></h5></td>
                                                    <td><b><select class="form-control" name="s_sem" required="">
                                                                    <option value="">Select Semester</option>
                                                                    <?php 
                                                                    $all_sem= get_all_libsys_sem();
                                                                    foreach ($all_sem as $sem){
                                                                    ?>
                                                                    <option value="<?php echo $sem['sem_id']; ?>"><?php echo $sem['sem_name']; ?></option>
                                                                    <?php } ?>
                                                        </select></b></td>
                                                </tr>
                                                 <tr>
                                                    <td class="text-right"><h5><b>Student Password :</b></h5></td>
                                                    <td><b><input class="form-control" type="password" name="s_pass" placeholder="Enter Password" required="" /></b></td>
                                                </tr>
                                                  <tr>
                                                    <td class="text-right"><h5><b>Confirm Password :</b></h5></td>
                                                    <td><b><input class="form-control" type="password" name="s_c_pass" placeholder="Enter Confirm Password" required="" /></b></td>
                                                </tr>
                                                
                                                <tr>
                                                    <td colspan="2" class="text-right">
                                                        <a href="user_login.php" class="btn btn-danger pull-left"><b><i class="fa fa-reply-all"></i> Back</b></a>
                                                        <button type="submit" class="btn btn-primary" name="register" id="register"><b><i class="fa fa-send-o"></i> Registration</b></button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr class="btn-success text-center">
                                                    <td colspan="2"><b></b></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                     <!-- End Form Elements -->
                </div>
            </div>
            <hr />
            <?php include './footer.php'; ?>
    </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
<!--    <script type="text/javascript">
        $(document).ready(function(){
            $('#s_email').blur(function(){
                    
            var user_email = $(this).val();
            
            $.ajax({
               url:'check.php',
               method:"POST",
               data:{s_email:user_email},
               success:function(data)
               {
                   if(data != '0')
                   {
                       
                      $('#availability').html('<span class = "text-danger">UserEmail Not Available</span>');
                      $('#register').attr("disabled",true);
                
                   }
                   else{
                      $('#availability').html('<span class = "text-success">UserEmail Available</span>');
                      $('#register').attr("disabled",false);
 
                 }
               }
              })
          });       
        });
      
        </script>-->
      
     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->

   
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
    
    
</body>
</html>
<?php //} ?>



