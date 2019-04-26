<?php
session_start();
if(!isset($_SESSION['employee'])){
header("Location: index.php");
}else{
include './includes/common.php';
include './includes/functions.php';
$pageName = 'Deshboard';
$user_id = $_SESSION['employee']['a_id'];
$user_info = get_employee_info_by_id($user_id);

$all_books = get_all_libsys_books();
$all_students = get_all_libsys_students();


?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" >
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
   
   <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
    
   <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular-route.js"></script>

</head>
    
<body ng-app = "Mymod">
   
<div id="wrapper" >
    
        <?php include './navtop.php'; ?> 
    
        <!-- /. NAV TOP  -->
        
        <?php include './navside.php';?>
        
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                
                <div ng-view></div>
                  <div class="row" >
                    <div class="col-md-12">
                         
                        <h2><b><i class="fa fa-dashboard fa-3x"></i> Dashboard</b></h2>   
                        <h5><b style="color: #EB0000;">Welcome <?php echo $user_info['a_name']; ?> , Love to see you back. Today <?php echo date("d F Y l").' ' ;   
                          $dt = new DateTime();
                          $tz = new DateTimeZone('Asia/Dhaka'); // or whatever zone you're after

                          $dt->setTimezone($tz);
                          echo $a = $dt->format('g:i:s a');
                    

                         
                          
                          ?></b> <span class="btn pull-right text-primary"><b>Hot Line : <?php echo $hoteLine; ?></b></span> </h5>
                        <marquee><span class=""><a class="btn-danger btn-sm" href="#"><b>Welcome <?php echo $user_info['a_name']; ?> , Love to see you back.</b></a></span></marquee>
                    </div>
                </div>              
                 <!-- /. ROW  -->
                  <hr />
                <div class="row">
                    <h2 class="text-center"><b>All Current Records</b></h2>
                    <div class="col-md-6">
                        <h2 class="text-center"><b>Books</b></h2>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <div class="panel panel-primary text-center no-boder bg-color-green">
                                <div class="panel-body">
                                    <i class="fa fa-book fa-5x"></i>
                                    <h3><b><?php 
                                       $cnt=0;
                                         foreach ($all_books as $books){
                                             if($books['b_qty']>'0'){
                                                 $cnt++;
                                             }
                                         }
                                         
                                       echo $cnt; ?>
                                    </b></h3>
                                </div>
                                <div class="panel-footer back-footer-green">
                                    <a class="btn btn-success btn-block disabled" href="" ><b>Available</b></a>
                                </div>
                            </div> 
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <div class="panel panel-primary text-center no-boder bg-color-red">
                                <div class="panel-body">
                                    <i class="fa fa-book fa-5x"></i>
                                    <h3><b><?php 
                                       $cnt=0;
                                         foreach ($all_books as $books){
                                             if($books['b_qty']=='0'){
                                                 $cnt++;
                                             }
                                         }
                                         
                                       echo $cnt; ?>
                                    </b></h3>
                                </div>
                                <div class="panel-footer back-footer-red">
                                    <a class="btn btn-danger btn-block disabled" href="" ><b>Unavailable</b></a>
                                </div>
                           </div> 
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h2 class="text-center"><b>Students</b></h2>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <div class="panel panel-primary text-center no-boder bg-color-green">
                                <div class="panel-body">
                                    <i class="fa fa-user fa-5x"></i>
                                    <h3><b><?php 
                                       $cnt=0;
                                         foreach ($all_students as $std){
                                             if($std['s_status']=='1'){
                                                 $cnt++;
                                             }
                                         }
                                         
                                       echo $cnt; ?>
                                    </b></h3>
                                </div>
                                <div class="panel-footer back-footer-green">
                                    <a class="btn btn-success btn-block disabled" href="" ><b>Active</b></a>
                                </div>
                            </div> 
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <div class="panel panel-primary text-center no-boder bg-color-red">
                                <div class="panel-body">
                                    <i class="fa fa-user fa-5x"></i>
                                    <h3><b><?php 
                                       $cnt=0;
                                         foreach ($all_students as $std){
                                             if($std['s_status']=='0'){
                                                 $cnt++;
                                             }
                                         }
                                         
                                       echo $cnt; ?>
                                    </b></h3>
                                </div>
                                <div class="panel-footer back-footer-red">
                                    <a class="btn btn-danger btn-block disabled" href="" ><b>Deactive</b></a>
                                </div>
                           </div> 
                        </div>
                    </div>
                </div>
                <!-- /. ROW  -->
                <hr /> 

              
                     
                <?php include './footer.php'; ?>
            </div>
        </div>
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