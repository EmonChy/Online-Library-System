<?php
session_start();
if(!isset($_SESSION['employee'])){
header("Location: login.php");
}else{
include './includes/common.php';
include './includes/functions.php';
$pageName = 'Book Details';
$user_id = $_SESSION['employee']['a_id'];
$user_info = get_employee_info_by_id($user_id);

if(isset($_GET['stdId'])){
    $std_id = $_GET['stdId'];
    //$exp_info = get_user_expense_history_info_by_id($ex_id,$user_id);
    //$ex_type = get_expense_type_info_by_id($exp_info['ex_type']);
    //$ex_category = get_expense_category_info_by_id($exp_info['ex_category']);
    $std_information = get_student_info_by_id($std_id);
    

} else {
    echo "<meta http-equiv='refresh' content='.5;url=cpanel.php'>";
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo "Student Code"."[".$std_information['s_code']."]"; ?></title>
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
</head>
<body>
    <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="text-primary"><b><i class="fa fa-history"></i> Student Info Details</b></h2>
                    </div>
                </div>
            <!-- /. ROW  -->
            <br>
            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default well" style="font-family: monospace;">
                        <div class="panel-body">
                            <div class="text-center">
                                                 
                                
                                <?php
                                    if(base64_encode($std_information['s_pic'])){
                                      ?>
                                        <img class="img img-thumbnail img-responsive" src="data:image/jpg;base64,<?php echo base64_encode($std_information['s_pic']); ?>" alt="No Image" width="150" height="120" />
                                        <?php }else{ ?>
                                        <img class="img img-thumbnail img-responsive" src="" width="100" height="100" />
                                        <?php } ?>
                                        <h2><b><?php echo $std_information['s_name']; ?></b></h2>
                            </div>
                            <table class="table table-condensed  table-striped table-hover text-center">
                                <caption class="text-center">
                                    <b class="btn btn-lg btn-success">Details</b>
                                </caption>
                                <thead>
                                    <tr class="btn-primary">
                                        <td colspan="4"><b></b></td>
                                    </tr>
                                </thead>
                                <?php if($std_information){ 
                                    $dept_info = get_dept_info_by_id($std_information['s_dept']);
                                    $sem_info= get_sem_info_by_id($std_information['s_semester']);
                                    
                                    ?>
                                <tbody>
                                    
                                    <tr>
                                        <td class="text-right bg-danger"><b>Student Code:</b></td>
                                        <td class="text-left"><b><?php echo $std_information['s_code']; ?></b></td>
                                        <td class="text-right bg-danger"><b>Student Name:</b></td>
                                        <td class="text-left"><b><?php echo $std_information['s_name'] ?></b></td>
                                    </tr>
                                    <tr>
                                        <td class="text-right bg-danger"><b>Student Contact:</b></td>
                                        <td class="text-left"><b><?php echo $std_information['s_contact']; ?></b></td>
                                        <td class="text-right bg-danger"><b>Student Email:</b></td>
                                        <td class="text-left"><b><?php echo $std_information['s_email'] ?></b></td>
                                    </tr>
                                     <tr>
                                        <td class="text-right bg-danger"><b>Student Department:</b></td>
                                        <td class="text-left"><b><?php echo $dept_info['d_code'].'['.$dept_info['d_name'].']'; ?></b></td>
                                        <td class="text-right bg-danger"><b>Student Semester:</b></td>
                                        <td class="text-left"><b><?php echo $sem_info['sem_name'] ?></b></td>
                                    </tr>
                                    <tr>
                                        <td class="text-right bg-danger"><b>Student Reg Date:</b></td>
                                        <td class="text-left"><b><?php echo $std_information['s_reg']; ?></b></td>
                                        <td class="text-right bg-danger"><b>Status  :</b></td>
                                        <td class="text-left"><b><?php 
                                        if($std_information['s_status']==1){echo '<span>Active</span>';}
                                             
                                             
                                            else{ echo '<span>Deactive</span>'; }
                                            ?>
                                            
                                            </b></td>
                                    </tr>
                                  
                                </tbody>
                                <tfoot>
                                    
                                    <tr>
                                        <td colspan="4" class="btn-danger"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">
                                            <button type="button" class="btn btn-sm btn pull-left" onClick="window.close()">
                                                <i class="fa fa-close"> <b>Close</b></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn pull-right" onClick="window.print()">
                                                <i class="fa fa-print"> <b>Print</b></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php }else{ ?>
                                    <tr>
                                        <td colspan="4"><h2 style="color: red;"><b>No Book Records are found.</b></h2></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">
                                            <button type="button" class="btn btn-sm btn-default" onClick="window.close()">
                                                <i class="fa fa-close"> <b>Close</b></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php } ?>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
            </div>
                <!-- /. ROW  -->
                
        <?php include './footer.php'; ?>
        </div>
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



