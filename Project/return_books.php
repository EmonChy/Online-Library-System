<?php
session_start();
if(!isset($_SESSION['user'])){
header("Location: user_login.php");
}else{
include './includes/common.php';
include './includes/functions.php';
$pageName = 'Return Book';
$updateStatus = "";

$user_id = $_SESSION['user']['s_id'];
$user_info = get_student_info_by_id($user_id);


$message = '';
if(isset($_REQUEST['s_code'])&&isset($_REQUEST['b_code'])){
    $s_code = $_REQUEST['s_code'];
    $b_code = $_REQUEST['b_code'];
    $std_info = get_student_info_by_code($s_code);
    if($std_info){
        $book_info=get_book_info_by_code($b_code);
        if($book_info){
            if($book_info['b_qty']>0){
                 $s_id=$std_info['s_id'];
                 $b_id=$book_info['b_id'];
                
                $issue_books=return_issue_books($s_id,$b_id);
                
                if($issue_books){
                    update_book_qty_plus($b_id);
                    $message='Return Success.';
                }else{
                    $message='Return Failed.';
                }
            }else{
                $message='Books Qty 0.';
            }
        }else{
            $message ='No Books are found.';
           
        }
    }else {
        $message = 'No Students are found.';
        
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
                        <h2><b><i class="fa fa-book"></i> Return <?php echo $WebsiteSiteName; ?> Books</b></h2> 
                    </div>
                </div>
                 <!-- /. ROW  -->
                 
               <div class="row">
                <div class="col-md-12">
                    <!-- Form Elements -->
                    
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                     <?php
                                    if($message){
                                        ?>
                         
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" style="padding-top: 25px;">×</button>
                                <h3><b><?php echo $message; ?></b> <a href="return_books.php"><b>Return Another</b></a></h3>
                             </div>            
                    <!--<h1><?php //echo $message; ?> <a href="issue_books.php"><b>Issue Another</b></a></h1>-->
                                      <?php 
                                       }
                    else if(isset($_REQUEST['book'])&& isset($_REQUEST['student'])){
                        $b_code= $_REQUEST['book'];
                        $s_code= $_REQUEST['student'];
                        $student_info=get_student_info_by_code($s_code);
                        if($student_info){
                            $book_info=get_book_info_by_code($b_code);
                            if($book_info){
                                
                    ?>
                    <div class="row">
                        <form action="" method="post">
                            <input  type="hidden"  name="b_code" required="" value="<?php echo $b_code; ?>" />
                            <input  type="hidden"  name="s_code" required="" value="<?php echo $s_code; ?>" />
                        <div class="col-md-6">
                            <table class="table table-condensed table-striped">
                            <thead>
                                <tr class="btn-primary text-center">
                                    <td colspan="2"><span class="label label-success"><i class="fa fa-user"></i></span><b> Students Profile</b></td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-right"><h5><b>Student ID :</b></h5></td>
                                    <td><h5><b><?php echo $student_info['s_code']; ?></b></h5></td>
                                    </tr>
                                <tr>
                                    <td class="text-right"><h5><b>Student Name :</b></h5></td>
                                    <td><h5><b><?php echo $student_info['s_name']; ?></b></h5></td>
                                </tr>
                                <tr>
                                    <td class="text-right"><h5><b>Student Mobile :</b></h5></td>
                                    <td><h5><b><?php echo $student_info['s_contact']; ?></b></h5></td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr class="btn-primary">
                                    <td colspan="2"></td>
                                </tr>
                            </tfoot>
                        </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-condensed table-striped">
                            <thead>
                                <tr class="btn-primary text-center">
                                    <td colspan="2"><span class="label label-success"><i class="fa fa-info"></i></span><b> Book Information</b></td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-right"><h5><b>Book Code :</b></h5></td>
                                    <td><h5><b><?php echo $book_info['b_code']; ?></b></h5></td>
                                </tr>
                                <tr>
                                    <td class="text-right"><h5><b>Book Name :</b></h5></td>
                                    <td><h5><b><?php echo $book_info['b_name']; ?></b></h5></td>
                                </tr>
                                <tr>
                                    <td class="text-right"><h5><b>Book Self :</b></h5></td>
                                    <td><h5><b><?php echo $book_info['b_self']; ?></b></h5></td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr class="btn-primary">
                                    <td colspan="2"></td>
                                </tr>
                            </tfoot>
                        </table>
                        </div>
                            <div class="col-md-4 col-md-offset-4">
                                <button class="btn btn-primary btn-block"><span class="label label-success"><i class="fa fa-send-o"></i></span><b> Confirm Return</b></button>
                            </div>
                        </form>
                    </div>
                    
                    
                    <?php }
                        else{
                            
                            $message ='No Books are found.';?>
                                    
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" style="padding-top: 25px;">×</button>
                                <h3><b><?php echo $message; ?></b> <a href="issue_books.php"><b>Go Back</b></a></h3>
                             </div>
                                    
                        <?php
                           
                          }
                            }
                            
                    else
                        { $message = 'No Students are found.'; ?>
                    <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" style="padding-top: 25px;">×</button>
                                <h3><b><?php echo $message; ?></b> <a href="issue_books.php"><b>Go Back</b></a></h3>
                             </div>
                     <?php
                     
                    }
                    
                        }
                    
                    else{ ?>
                    
                       
                       
                    <form action="" method="post">
                       
                        <table class="table table-condensed table-striped">
                            <tr>
                                <td class="text-right"><h5><b>Student ID:</b></h5></td>
                                <td><b>
                                    <input class="form-control" name="student" type="text" required="" placeholder="Enter Student Code" />
                                    </b>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-right"><h5><b>Book ID:</b></h5></td>
                                <td><b>
                                    <input class="form-control" name="book" type="text" required="" placeholder="Enter Book Code" />
                                    </b>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input class="btn btn-danger pull-right" type="submit" name="Registration" />
                                </td>
                            </tr>
                        </table>
                    </form>
                    <?php }  ?>
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
