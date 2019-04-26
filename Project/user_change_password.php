<?php
session_start();
if(!isset($_SESSION['user'])){
header("Location: user_login.php");
}else{
include './includes/common.php';
include './includes/functions.php';
$pageName = 'User Change Password';
$updateStatus = "";

$user_id = $_SESSION['user']['s_id'];
$user_info = get_student_info_by_id($user_id);

if(isset($_POST['contact'])){
    $contact = $_POST['contact'];
    $opass = $_POST['opass'];
    $npass = $_POST['npass'];
    $cpass = $_POST['cpass'];
    
    $old_password = md5($opass);
    
    
    $user_password = $user_info['s_password'];
    
    $check_info =  check_user_contact($user_id,$contact);
   
     if($check_info){
         if($old_password==$user_password){
            if($npass==$cpass){
                $new_password=md5($npass);
                $PasswordUpdate = update_user_password($user_id,$new_password);
                $updateStatus .= "<b class='alert-info'>Successfully Changed Your Password .</b>";
            }
            else{
                $updateStatus .= "<b>Your New Password and Confirm not match.</b>";
            }
        } 
        else{
        $updateStatus .= "<b>Your old password not match.</b>";
        }
 }else{
     $updateStatus .= "<b>Contact Not Match.</b>";
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
</head>
<body onload="DisableAutoComp();">
    <div id="wrapper">
        <?php include './user_navtop.php'; ?>  
        <!-- /. NAV TOP  -->
        <?php include './user_navside.php'; ?>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h2><b><i class="fa fa-lock"></i> Change User Password</b></h2> 
                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />
               <div class="row">
                <div class="col-md-12">
                    <!-- Form Elements -->
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <form id="form" action="" method="post" >
                                        <table class="table table-condensed text-left">
                                            <thead>
                                                <tr class="btn-danger text-center">
                                                    <td colspan="2"><h3><b>Enter Your Information Below</b></h3></td>
                                                </tr>
                                                <?php
                                                if($updateStatus){
                                                ?>
                                                <tr class="btn-default text-center">
                                                    <td class="btn-default" colspan="2">
                                                        <b style="color: red;">Message : <?php echo $updateStatus; ?></b>
                                                    </td>
                                                </tr>
                                                <?php }else{ ?>
                                                <tr class="text-center">
                                                    <td colspan="2">
                                                        <b style="color: #0088cc;">Please input the current information.</b>
                                                    </td>
                                                </tr>
                                                <?php } ?>
                                                
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-right"><h5><b>Old Password :</b></h5></td>
                                                    <td><b><input class="form-control" type="password" name="opass" placeholder="Enter Your Old Password" required="" /></b></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right"><h5><b>New Password :</b></h5></td>
                                                    <td><b><input class="form-control" type="password" name="npass" placeholder="Enter Your New Password" required="" /></b></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right"><h5><b>Confirm Password :</b></h5></td>
                                                    <td><b><input class="form-control" type="password" name="cpass" placeholder="Enter Your New Password Again" required="" /></b></td>
                                                </tr>
                                                 <tr>
                                                    <td class="text-right"><h5><b>Contact :</b></h5></td>
                                                    <td><b><input class="form-control" type="number" name="contact" placeholder="Enter your contact"  minlength="11" maxlength="11" required="" /></b></td>
                                                </tr>
                                          
                                                <tr>
                                                    <td colspan="2" class="text-right">
                                                        <a href="user_panel.php" class="btn btn-danger pull-left"><b><i class="fa fa-reply-all"></i> Back</b></a>
                                                        <button type="submit" class="btn btn-primary"><b><i class="fa fa-check-circle"></i></b></button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr class="btn-danger text-center">
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
     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
</body>
</html>
<?php } ?>

