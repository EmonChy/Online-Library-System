<?php
session_start();
if(!isset($_SESSION['employee'])){
header("Location: login.php");
}else{
include './includes/common.php';
include './includes/functions.php';
$pageName = 'Add Book';
$updateStatus = "";

$user_id = $_SESSION['employee']['a_id'];
$user_info = get_employee_info_by_id($user_id);



$message='';
if(isset($_POST['updt_id'])){
    $book_updt = $_POST['updt_id'];
}
if(isset($_REQUEST['b_code'])){
    $book_updt = $_POST['updt_id'];
    $b_code= $_REQUEST['b_code'];
    $b_name= strtoupper($_REQUEST['b_name']);
    
    $b_author=$_REQUEST['b_author'];
    $b_publisher=$_REQUEST['b_publisher'];
    $b_qty=$_REQUEST['b_qty'];
    $b_self=$_REQUEST['b_self'];
    $b_price = $_REQUEST['b_price'];
    
        $view_book=edit_books($b_code,$b_name,$b_author,$b_publisher,$b_qty,$b_self,$b_price,$book_updt);
        if($view_book){
            $message='Book Info Updated.';
        }else{
            $message='Update Failed.';
        }
    }
       $book_update = get_book_info_by_id($book_updt);


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
                        <h2><b><i class="fa fa-book"></i> Update <?php echo $WebsiteSiteName; ?> Books</b></h2> 
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
                                      <input type="hidden" value="<?php echo $book_update['b_id']; ?>" name="updt_id"/>  
                                        <table class="table table-condensed table-striped">
                                            <thead>
                                                <tr class="btn-danger text-center">
                                                    <td colspan="2"><h3><b>Enter Book Information Below</b></h3></td>
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
                                                       <!-- <b style="color: red;">Message : <?php //echo $message; ?></b> -->
                                                    </td>
                                                </tr>
                                                <?php }else{ ?>
                                                <tr class="text-center">
                                                    <td colspan="2">
                                                         
                                                        <div class="alert alert-success alert-dismissible">
                                                          <button type="button" class="close" data-dismiss="alert">×</button>
                                                           <strong> Please input the current information. </strong>
                                                        </div>
                                                        
                                                      <!--  <b style="color: #0088cc;">Please input the current information.</b>  -->
                                                    </td>
                                                </tr>
                                                <?php } ?>
                                                
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-right"><h5><b>Book Code :</b></h5></td>
                                                    <td><b><input class="form-control" type="number" name="b_code" value="<?php echo $book_update['b_code']; ?>" placeholder="Enter Code" required="" /></b></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right"><h5><b>Book Name :</b></h5></td>
                                                    <td><b><input class="form-control" type="text" name="b_name" value="<?php echo $book_update['b_name']; ?>" placeholder="Enter Name" required="" /></b></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right"><h5><b>Book Author :</b></h5></td>
                                                    <td><b><select class="form-control" name="b_author" required="">
                                                            <option value="">Select Author:</option>
                                                            <?php 
                                                            $all_author= get_all_libsys_author();
                                                            foreach ($all_author as $author){
                                                            ?>
                                                            <option value="<?php echo $author['au_id']; ?>" <?php if($author['au_id']==$book_update['b_author']){echo 'selected';}?> ><?php echo $author['au_name']; ?></option>
                                                            <?php } ?>
                                                            </select></b></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right"><h5><b>Book Publisher :</b></h5></td>
                                                    <td><b><select class="form-control" name="b_publisher" required="">
                                                                <option value="">Select Publisher:</option>
                                                                <?php 
                                                                $all_pub= get_all_libsys_publisher();
                                                                foreach ($all_pub as $pub){
                                                                ?>
                                                                <option value="<?php echo $pub['pub_id']; ?>" <?php if($pub['pub_id']==$book_update['b_publishar']){echo 'selected';}?>><?php echo $pub['pub_name']; ?></option>
                                                                <?php } ?>
                                                       </select></b></td>
                                                </tr>
                                                 <tr>
                                                    <td class="text-right"><h5><b>Book Quantity :</b></h5></td>
                                                    <td><b><input class="form-control" type="number" name="b_qty" value="<?php echo $book_update['b_qty']; ?>" placeholder="Enter Quantity" required="" /></b></td>
                                                </tr>
                                                  <tr>
                                                    <td class="text-right"><h5><b>Book Self :</b></h5></td>
                                                    <td><b><input class="form-control" type="number" name="b_self" value="<?php echo $book_update['b_self']; ?>" placeholder="Enter Self No" required="" /></b></td>
                                                </tr>
                                                  <tr>
                                                    <td class="text-right"><h5><b>Book Price :</b></h5></td>
                                                    <td><b><input class="form-control" type="number" name="b_price" value="<?php echo $book_update['b_price']; ?>" placeholder="Enter price" required="" /></b></td>
                                                </tr>
                                                                                                <tr>
                                                    <td colspan="2" class="text-right">
                                                        <a href="cpanel.php" class="btn btn-danger pull-left"><b><i class="fa fa-reply-all"></i> Back</b></a>
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


