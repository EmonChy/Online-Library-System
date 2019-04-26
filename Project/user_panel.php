<?php
session_start();
if(!isset($_SESSION['user'])){
header("Location: user_login.php");
}else{
include './includes/common.php';
include './includes/functions.php';
$pageName = 'User_Deshboard';
$user_id = $_SESSION['user']['s_id'];
$user_info = get_student_info_by_id($user_id);

$all_books = get_all_libsys_books();
$all_students = get_all_libsys_students();
//$issue = get_all_libsys_books_issue_by_id($user_id);

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
    <!-- MORRIS CHART STYLES-->
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body>
<div id="wrapper">
        <?php include './user_navtop.php'; ?>   
        <!-- /. NAV TOP  -->
        <?php include './user_navside.php'; ?>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h2><b><i class="fa fa-dashboard fa-3x"></i> Dashboard</b></h2>   
                        <h5><b style="color: #EB0000;">Welcome <?php echo $user_info['s_name']; ?> , Love to see you back. Today <?php echo date("d F Y l"); ?></b> <span class="btn pull-right text-primary"><b>Hot Line : <?php echo $hoteLine; ?></b></span> </h5>
                        <marquee><span class=""><a class="btn-danger btn-sm" href="#"><b>Welcome <?php echo $user_info['s_name']; ?> , Love to see you back.</b></a></span></marquee>
                    </div>
                </div>              
                 <!-- /. ROW  -->
                  <hr />
                <div class="row">
                    <h2 class="text-center"><b>All Current Records</b></h2>
                    <div class="col-md-6 col-md-offset-3">
                        <h2 class="text-center"><b>Books</b></h2>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <div class="panel panel-primary text-center no-boder bg-color-green">
                                <div class="panel-body">
                                    <i class="fa fa-book fa-5x"></i>
                                    <h3><b><?php 
                                       $cnt=0;
                                       $status = 1;
                                       $show_issue = get_all_libsys_books_issue_by_id_count($user_id,$status);
                                         /*foreach ($show_issue as $issue){
                                             
                                                 $cnt++;
                                             
                                         }*/
                                         
                                       echo count($show_issue); ?>
                                    </b></h3>
                                </div>
                                <div class="panel-footer back-footer-green">
                                    <a class="btn btn-success btn-block disabled" href="" ><b>Issued</b></a>
                                </div>
                            </div> 
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <div class="panel panel-primary text-center no-boder bg-color-red">
                                <div class="panel-body">
                                    <i class="fa fa-book fa-5x"></i>
                                    <h3><b><?php 
                                       $cnt=0;
                                       $status = 0;
                                       $show_return = get_all_libsys_books_issue_by_id_count($user_id,$status);
                                         /*foreach ($show_return as $return){
                                             
                                                 $cnt++;
                                             
                                         }*/
                                         
                                       echo count($show_return) ?>
                                    </b></h3>
                                </div>
                                <div class="panel-footer back-footer-red">
                                    <a class="btn btn-danger btn-block disabled" href="" ><b>Return</b></a>
                                </div>
                           </div> 
                        </div>
                    </div>
                    
                </div>
                <!-- /. ROW  -->
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
     <!-- MORRIS CHART SCRIPTS -->
     <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/js/morris/morris.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
</body>
</html>
<?php
}
?>

