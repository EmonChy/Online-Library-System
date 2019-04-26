<?php
session_start();
if(!isset($_SESSION['employee'])){
header("Location: login.php");
}else{
include './includes/common.php';
include './includes/functions.php';
$pageName = 'View Students';
$user_id = $_SESSION['employee']['a_id'];
$user_info = get_employee_info_by_id($user_id);
/*
if(isset($_GET['ex_cat'])){
    $ex_category=$_GET['ex_cat'];
    $expense_history = get_all_expense_history_by_employee_id_and_ex_category($user_id,$ex_category);
}else if(isset($_GET['today'])){
    $expense_history = get_todays_expense_history_by_employee_id($user_id);;
}else{
    $expense_history = get_all_expense_history_by_employee_id($user_id);
} 

 */

if(isset($_POST['student_aid_status'])){
    $student_aid_status=$_POST['student_aid_status'];
    $sql="UPDATE  `ecash`.`libsys_students` SET  `s_status` =  '1' WHERE  `libsys_students`.`s_id` = '".$student_aid_status."'  ;";
            $qu= mysql_query($sql); 
}

if(isset($_POST['student_did_status'])){
     
    $student_did_status=$_POST['student_did_status'];
    $sql="UPDATE  `ecash`.`libsys_students` SET  `s_status` =  '0' WHERE  `libsys_students`.`s_id` = '".$student_did_status."'  ;";
            $qu= mysql_query($sql); 
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
        <?php include './navtop.php'; ?>  
        <!-- /. NAV TOP  -->
        <?php include './navside.php'; ?>
          
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
                         <a class="btn btn-lg btn-success" style="font-family: cursive;" id="sp">Records&nbsp;<i class="fa fa-arrow-down"></i></a>
                         <br>
                             <br>
                    </div>
                </div>
                 <!-- /. ROW  -->
                 
            <div class="row">
                <div class="col-md-12" id="acr">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default btn-default" style="font-family: sans-serif;">
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-condensed table-hover text-center" id="dataTables-example">
                                   
                                    <thead>
                                        <tr class="btn-danger text-center">
                                            <td><b>SL#</b></td>
                                            <td><b>Code</b></td>
                                            <td><b>Name</b></td>
                                            <td><b>Contact</b></td>
                                            <td><b>Email</b></td>
                                            
                                            <td><b>Status</b></td>
                                            <td colspan=""><b>Details</b></td>
                                            
                                            <td colspan=""><b>Edit</b></td>
                                                                                          
                                            
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                         <?php 
                                        $i=1;
                                        $status='1'; //active
                                        $all_students=get_all_libsys_students();
                                        foreach ($all_students as $students){
                                            //$author_info= get_author_info_by_id($books['b_author']);
                                            //$publisher_info= get_publisher_info_by_id($books['b_publishar']);
                                            
                                         ?>
                                        <tr id="<?php echo $students['s_id']; ?>">
                                            <td><h5><b><?php echo $i; ?>.</b></h5></td>
                                            <td data-target="book_code"><h5><b><?php echo $students['s_code'] ?></b></h5></td>
                                            <td data-target="book_name"><h5><b><?php echo $students['s_name'] ?></b></h5></td>
                                            <td data-target="book_quantity"><h5><b><?php echo $students['s_contact']; ?></b></h5></td>
                                            
                                            <td data-target="book_price"><h5><b><?php echo $students['s_email']; ?></b></h5></td>                                           
                                            
                                            <?php if($students['s_status']==0){ ?>
                                            <td class="text-center"style=""><h5><b>
                                                        <form action="view_student.php" method="post">
                     <input type="hidden" value="<?php echo $students['s_id'] ; ?> " name="student_aid_status"/>
                     <input type="submit" class="btn btn-md btn-danger " value="DeActive"/>
                 </form>
                                            </b></h5></td>
                 <?php } else{ ?>    
                                            <td class="text-center"style=""><h5><b>
                                                        <form action="view_student.php" method="post">
                    <input type="hidden" value="<?php echo $students['s_id']; ?> " name="student_did_status"/>
                    <input type="submit" class="btn btn-md btn-success " value="Active"/>
                </form>
                                                    </b> </h5> </td>
            <?php } ?>
            
                                            
                                            <td><h5>
                                                <a class="btn btn-primary" onClick="window.open('student_details.php?stdId=<?php echo $students['s_id']; ?>','SearchTip','width=700,height=630,resizable=yes,scrollbars=yes')">
                                                    <i class="fa fa-info-circle"></i>&nbspView 
                                                </a></h5>
                                            </td>
                                            <td><h5><b>
                                                        <form action="post_update_student.php" method="post">
                                                    <input type="hidden" value="<?php echo $students['s_id']; ?>" name="updt_id"/>
                                                    
                                                    <input type="submit" class="btn btn-md btn-warning" value="Update"/>
                                                    
                                                  <!-- <a href="#" class=" btn btn-md btn-warning"> <i class="fa fa-edit"></i> Update</a>
                                                     -->
                                                   </form>      
                                                        
                                               </b></h5></td>
                                            
                                        </tr>
                                        <?php 
                                        
                                        $i++; } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr class="btn-danger text-center">
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

    <script src="assets/js_new/transitions.js"></script>

</body>
</html>
<?php } ?>




