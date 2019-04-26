<?php
session_start();
if(!isset($_SESSION['employee'])){
header("Location: login.php");
}else{
include './includes/common.php';
include './includes/functions.php';
$pageName = 'Update Student';
$updateStatus = "";

$user_id = $_SESSION['employee']['a_id'];
$user_info = get_employee_info_by_id($user_id);

$message='';
if(isset($_POST['updt_id'])){
    $std_updt = $_POST['updt_id'];
}
if(isset($_REQUEST['s_name'])){
    $std_updt = $_POST['updt_id'];
    $s_name= strtoupper($_REQUEST['s_name']);
    $s_code= strtoupper($_REQUEST['s_code']);
    $s_dept=$_REQUEST['s_dept'];
    $s_sem = $_REQUEST['s_sem'];
    $s_contact=$_REQUEST['s_contact'];
    $s_email=$_REQUEST['s_email'];
    //$s_pass=$_REQUEST['s_pass'];
    //$s_c_pass=$_REQUEST['s_c_pass'];
    
        //if($s_pass==$s_c_pass){
        //edit_students($s_name,$s_code,$s_dept,$s_sem,$s_contact,$s_password,$s_id)
        //$s_password= md5($s_pass);
        $edit_students=edit_students($s_name,$s_code,$s_dept,$s_sem,$s_contact,$s_email,$std_updt);
        if($edit_students){
            $message='Update Success.';
        }else{
            $message='Data Insert Failed.';
        }
    }
    $std_update = get_student_info_by_id($std_updt);
   




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
        <?php include './navtop.php'; ?>  
        <!-- /. NAV TOP  -->
        <?php include './navside.php'; ?>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h2><b><i class="fa fa-user-md"></i> Update <?php echo $WebsiteSiteName; ?> Students</b></h2> 
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
                                    <form id="form" action="" method="post" enctype="multipart/form-data">
                                        <input type="hidden" value="<?php echo $std_update['s_id']; ?>" name="updt_id"/>
                                        <table class="table table-condensed table-striped">
                                            <thead>
                                                <tr class="btn-success text-center">
                                                    <td colspan="2"><h3><b>Enter Student Information Below</b></h3></td>
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
                                                    <td><b><input class="form-control" type="text" name="s_code" value="<?php echo $std_update['s_code']; ?>" placeholder="Enter Code" required="" /></b></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right"><h5><b>Student Name :</b></h5></td>
                                                    <td><b><input class="form-control" type="text" name="s_name" value="<?php echo $std_update['s_name']; ?>" placeholder="Enter Name" required="" /></b></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right"><h5><b>Student Contact :</b></h5></td>
                                                    <td><b><input class="form-control" name="s_contact" type="text" value="<?php echo $std_update['s_contact']; ?>"  placeholder="Enter Contact" minlength="11" maxlength="11" required="" /></b></td>
                                                </tr>
                                                 <tr>
                                                    <td class="text-right"><h5><b>Student Email :</b></h5></td>
                                                    <td><b><input class="form-control" name="s_email" type="email" value="<?php echo $std_update['s_email']; ?>"  placeholder="Enter Email" required="" /></b></td>
                                                </tr>
                                                
                                               
                                                
                                                <tr>
                                                    <td class="text-right"><h5><b>Student Dept :</b></h5></td>
                                                    <td><b><select class="form-control" name="s_dept" required="">
                                                                    <option value="">Select Department</option>
                                                                    <?php 
                                                                    $all_dept= get_all_libsys_dept();
                                                                    foreach ($all_dept as $dept){
                                                                    ?>
                                                                    <option value="<?php echo $dept['d_id']; ?>" <?php if($dept['d_id']==$std_update['s_dept']){echo 'selected';}?>><?php echo $dept['d_code']."(".$dept['d_name'].")"; ?></option>
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
                                                                    <option value="<?php echo $sem['sem_id'];?>"  <?php if($sem['sem_id']==$std_update['s_semester']){echo 'selected';}?> ><?php echo $sem['sem_name']; ?></option>
                                                                    <?php } ?>
                                                        </select></b></td>
                                                </tr>
                                              
                                                
                                                <tr>
                                                    <td colspan="2" class="text-right">
                                                        <a href="view_student.php" class="btn btn-danger pull-left"><b><i class="fa fa-reply-all"></i> Back</b></a>
                                                        <button type="submit" class="btn btn-primary"><b><i class="fa fa-send-o"></i> Update</b></button>
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




