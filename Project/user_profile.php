<?php
session_start();
if(!isset($_SESSION['user'])){
header("Location: user_login.php");
}else{
include './includes/common.php';
include './includes/functions.php';
$user_id = $_SESSION['user']['s_id'];
$user_info = get_student_info_by_id($user_id);
$pageName = 'User Profile';
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        
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
                                <h2><b><i class="fa fa-user"></i> My Profile</b></h2> 
                            </div>
                        </div>
                         <!-- /. ROW  -->
                         <hr />
                       <div class="row">
                        <div class="col-md-12">
                            <!-- Form Elements -->
                            <div class="panel panel-default">
                                <table class="table table-condensed">
                                    <thead>
                                        <tr class="btn-danger text-center">
                                            <td colspan="2"><h1><b>User Information</b></h1></td>
                                        </tr>
                                    </thead>
                                </table>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table table-condensed table-striped text-left">
                                                <thead>
                                                    <tr class="btn-danger">
                                                        <td colspan="2"><b></b></td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="text-center " colspan="2">
                                                            <?php
                                                            if(base64_encode($user_info['s_pic'])){
                                                            ?>
                                                            <img class="img img-thumbnail img-responsive" src="data:image/jpg;base64,<?php echo base64_encode($user_info['s_pic']); ?>" alt="No Image" width="150" height="120" />
                                                            <?php }else{ ?>
                                                            <img class="img img-thumbnail img-responsive" src="user.png" width="100" height="100" />
                                                            <?php } ?>
                                                            <h2><b><?php echo $user_info['s_name']; ?></b></h2>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-right"><b>User ID # :</b></td>
                                                        <td><b><?php echo $user_info['s_code']; ?></b></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-right"><b>Username :</b></td>
                                                        <td><b><?php echo $user_info['s_name']; ?></b></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-right"><b>Contact No :</b></td>
                                                        <td><b><?php echo $user_info['s_contact']; ?></b></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-right"><b>Email Address :</b></td>
                                                        <td><b><?php echo $user_info['s_email']; ?> <span class="label label-success"><i class="fa fa-check-circle"></i></span></b></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-right"><b>Resistration Date :</b></td>
                                                        <td><b><?php echo $user_info['s_reg']; ?></b></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-right"><b>Account Status :</b></td>
                                                        <td><b><?php if($user_info['s_status']==1){ echo '<span class="label label-success">Active</span>';} else{ echo '<span class="label label-danger">Deactive</span>'; } ?></b></td>
                                                    </tr>
                                                    
                                                </tbody>
                                                <tfoot>
                                                    <tr class="btn-danger">
                                                        <td colspan="2"><b></b></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
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
