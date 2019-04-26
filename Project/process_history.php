<?php
session_start();
if(!isset($_SESSION['employee'])){
header("Location: login.php");
}else{
include './includes/common.php';
include './includes/functions.php';
$pageName = 'Process History';
$user_id = $_SESSION['employee']['a_id'];
$user_info = get_employee_info_by_id($user_id);

if(isset($_GET['ex_cat'])){
    $ex_category=$_GET['ex_cat'];
    $expense_history = get_all_expense_history_by_employee_id_and_ex_category($user_id,$ex_category);
}else if(isset($_GET['today'])){
    $expense_history = get_todays_expense_history_by_employee_id($user_id);;
}else{
    $expense_history = get_all_expense_history_by_employee_id($user_id);
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
</head>
<body>
    <div id="wrapper">
        <?php include './navtop.php'; ?>  
        <!-- /. NAV TOP  -->
        <?php include './navside.php'; ?>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h2><b><i class="fa fa-history"></i> <?php echo $WebsiteSiteName; ?> Process History</b></h2>
                        <a class="btn" href="process_history.php"><b>All Expense</b></a>|
                        <?php 
                            $expense_category=get_all_expense_category();
                            foreach ($expense_category as $expense_cat){
                            ?>
                            <a class="btn" href="process_history.php?ex_cat=<?php echo $expense_cat['ec_id']; ?>"><b><?php echo $expense_cat['ec_name']; ?></b></a>|
                        <?php } ?>
                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr/>
            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default btn-default" style="font-family: monospace;">
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-condensed table-hover text-center" id="dataTables-example">
                                    <caption class="text-center text-primary"><b>
                                            Expense Category : 
                                            <?php 
                                            if(isset($_GET['ex_cat'])){
                                                $ex_cat_info = get_expense_category_info_by_id($_GET['ex_cat']);
                                                echo $ex_cat_info['ec_name'];
                                            }else {
                                                echo 'All';
                                            }
                                            ?>
                                        </b></caption>
                                    <thead>
                                        <tr class="btn-danger text-center">
                                            <td><b>SL#</b></td>
                                            <td><b>Txn Date</b></td>
                                            <td><b>Expense Category</b></td>
                                            <td><b>Expense Type</b></td>
                                            <td><b>Balance</b></td>
                                            <td><b>Status</b></td>
                                            <td><b>Action</b></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $i=1;
                                        $total_bdt=0;
                                        foreach ($expense_history as $expense){
                                            $ex_type = get_expense_type_info_by_id($expense['ex_type']);
                                            $ex_category = get_expense_category_info_by_id($expense['ex_category']);
                                        ?>
                                        <tr>
                                            <td><h5><b><?php echo $i; ?>.</b></h5></td>
                                            <td><h5><b><?php echo date('d/m/Y',strtotime($expense['ex_date'])); ?></b></h5></td>
                                            <td><h5><b><?php echo $ex_type['ext_name']; ?></b></h5></td>
                                            <td><h5><b><?php echo $ex_category['ec_name']; ?></b></h5></td>
                                            <td class="text-right"><h5><b><?php $u_balance=$expense['ex_amount']; echo number_format($u_balance,2); ?></b></h5></td>
                                            <td><h5><b><?php if($expense['ex_status']==3){ echo '<span class="label label-warning">Rejected</span>';} elseif($expense['ex_status']==2){ echo '<span class="label label-success">Success</span>';} elseif($expense['ex_status']==1){ echo '<span class="label label-primary">Pending</span>';} else{ echo '<span class="label label-danger">Canceled</span>'; } ?></b></h5></td>
                                            <td>
                                                <a class="btn btn-sm btn-success" onClick="window.open('exp_details.php?txnId=<?php echo $expense['ex_id']; ?>','SearchTip','width=700,height=630,resizable=yes,scrollbars=yes')">
                                                    <b>Details</b>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php 
                                        $total_bdt=$total_bdt+$expense['ex_amount']+$expense['ex_charge'];
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
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <h2 class="text-center"><b>Total Process : <?php echo number_format($total_bdt,2); ?> BDT</b></h2>
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
