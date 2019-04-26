<?php
session_start();
if(!isset($_SESSION['user'])){
header("Location: user_login.php");
}else{
include './includes/common.php';
include './includes/functions.php';
$pageName = 'User View Books';
$user_id = $_SESSION['user']['s_id'];

$user_info = get_student_info_by_id($user_id);

$issue = get_all_libsys_books_issue_by_id($user_id);





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
   
        <!-- CUSTOM STYLES-->
  <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
     <!-- TABLE STYLES-->
    <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
    <script src="assets/js_new/jquery.js"></script>
    <script src="assets/js_new/bootstrap.min.js"></script>
    
</head>
<body>
    <div id="wrapper">
        <?php include './user_navtop.php'; ?>  
        <!-- /. NAV TOP  -->
        <?php include './user_navside.php'; ?>
          
       <script type="text/javascript">
                     $(document).ready(function(){
                           $("#sp").click(function(){
                               $("#acr").slideToggle('slow');
                   
                   
                                      }) ;
                                });
        </script>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12 text-center" id="fun"> 
                        <h2><b><i class="fa fa-history"></i><?php echo " ".$WebsiteSiteName." ".$pageName?> </b></h2>
                         <a class="btn btn-lg btn-success" style="font-family: cursive;" id="sp">Your Records&nbsp;<i class="fa fa-arrow-down"></i></a>
                         <br>
                             <br>
                    </div>
                </div>
                 <!-- /. ROW  -->
                 
            <div class="row">
                <div class="col-md-12" id="acr">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default well" style="font-family: sans-serif;">
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-condensed table-hover text-center" id="dataTables-example">
                                   
                                    <thead>
                                        <tr class="btn-primary text-center">
                                            <td><b>SL#</b></td>
                                            <td><b>Book ID</b></td>
                                            <td><b>Book Name</b></td>
                                            <td><b>Student ID</b></td>
                                            <td><b>Issue Date</b></td>
                                            
                                            <td><b>Return Date</b></td>
                                             <td><b>Fine</b></td>
                                            
                                            <td><b>Status</b></td>
                                            
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                         <?php 
                                        $i=1;
                                        $total_fine = 0;
                                        foreach ($issue as $info){
                                            $book_info= get_book_info_by_id($info['i_book_id']);
                                            $std_info= get_student_info_by_id($info['i_student_id']);
                                            //$publisher_info= get_publisher_info_by_id($books['b_publishar']);
                                            
                                            
                                         ?>
                                        <tr >
                                            <td><h5><b><?php echo $i; ?>.</b></h5></td>
                                            <td><h5><b><?php echo $book_info['b_code'];?></b></h5></td>
                                             <td><h5><b><?php echo $book_info['b_name'];?></b></h5></td>
                                            <td><h5><b><?php echo $std_info['s_code'] ?></b></h5></td>
                                            <td><h5><b><?php echo $info['i_date']; ?></b></h5></td>
                                            
                                            <td><h5><b><?php echo $info['i_r_date']; ?></b></h5></td>  
                                            <td><h5><b><?php echo $info['i_fine']; ?></b></h5></td>
                                           
                                            <td><h5><b><?php 
                                            if($info['i_status']==1){echo '<span class="label label-success" style="font-family: sans-serif; font-size:15px;"><i class="fa fa-check-square"></i> Issued</span>';}
                                             
                                             
                                            else{ echo '<span class="label label-info" style="font-family: sans-serif; font-size:15px;"><i class="fa fa-crosshairs"></i> Return</span>'; } ?></b></h5></td>
                                            
                                            
                                         
                                            
                                        </tr>
                                        <?php 
                                         $total_fine =  $total_fine+$info['i_fine'];
                                        
                                        $i++; } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr class="btn-primary text-center">
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            
                                        </tr>
                                        
                                    </tfoot>
                                </table>
                            </div>
                            <?php
                            if($total_fine){
                            ?>
                            <h2 class="text-center"><b>Total Fine : <?php echo $total_fine; ?> BDT</b></h2>
                            <?php } else{ ?>
                            <h2 class="text-center"><b></b></h2>
                            <?php }?>
                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
            </div>
                <!-- /. ROW  -->
                <hr />
        <?php include './footer.php'; ?>
        </div>    
    </div>
             <!-- /. PAGE INNER  -->
            </div>
    
    
       
         <!-- /. PAGE WRAPPER  -->
     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
     <!-- DATA TABLE SCRIPTS -->
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
        <script>
            $(document).ready(function () {
                $('#dataTables-example').dataTable();
            });
    </script>
         <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>

    

</body>
</html>
<?php } ?>




