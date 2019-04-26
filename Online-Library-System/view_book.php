<?php
session_start();
if(!isset($_SESSION['employee'])){
header("Location: login.php");
}else{
include './includes/common.php';
include './includes/functions.php';
$pageName = 'View Books';
$user_id = $_SESSION['employee']['a_id'];
$user_info = get_employee_info_by_id($user_id);

$message="";


if(isset($_POST['id'])){
	$bk_code = $_POST['book_code'];	
	$bk_name = $_POST['book_name'];	
	$bk_qty = $_POST['book_quantity'];	

        $bk_rck = $_POST['book_rack'];
        $bk_prc = $_POST['book_price'];
	
	$id = $_POST['id'];
        $result  = mysql_query("UPDATE libsys_books SET b_code='".$bk_code."',b_name='".$bk_name."',b_qty='".$bk_qty."' ,b_self='".$bk_rck."',b_price='".$bk_prc."'  WHERE b_id='".$id."'");
      if($result){
        $message= "Book Updated";
       }
      else {
       $message="Failed";    
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
     <!-- MORRIS CHART STYLES-->
     <link href="assets/css/animate.css" rel="stylesheet" />
   
        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
     <!-- TABLE STYLES-->
    <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
    <script src="assets/js_new/jquery.js"></script>
    <script src="assets/js_new/bootstrap.min.js"></script>
   
    
</head>
    <body >
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
                 
            <div class="row animated jackInTheBox">
                <div class="col-md-12" id="acr">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default btn-default" style="font-family: sans-serif;">
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-condensed table-hover text-center" id="dataTables-example">
                                   
                                    <thead>
                                        <tr class="btn-danger text-center">
                                            <td><b>SL#</b></td>
                                            <td><b>Book Code</b></td>
                                            <td><b>Book Name</b></td>
                                            <td><b>Book Quantity</b></td>
                                            
                                            <td><b>Book Price</b></td>
                                            <td><b>Book Rack No</b></td>
                                            <td><b>Status</b></td>
                                            <td colspan=""><b>Action</b>
                                            
                                                </td>
                                            <td colspan=""><b>Edit</b>
                                            
                                                </td>
                                            
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                         <?php 
                                        $i=1;
                                        $status='1'; //active
                                        $all_books=get_all_libsys_books();
                                        foreach ($all_books as $books){
                                            //$author_info= get_author_info_by_id($books['b_author']);
                                            //$publisher_info= get_publisher_info_by_id($books['b_publishar']);
                                            
                                         ?>
                                        <tr id="<?php echo $books['b_id']; ?>">
                                            <td><h5><b><?php echo $i; ?>.</b></h5></td>
                                            <td data-target="book_code"><h5><b><?php echo $books['b_code'] ?></b></h5></td>
                                            <td data-target="book_name"><h5><b><?php echo $books['b_name'] ?></b></h5></td>
                                            <td data-target="book_quantity"><h5><b><?php echo $books['b_qty']; ?></b></h5></td>
                                            
                                            <td data-target="book_price"><h5><b><?php echo $books['b_price']; ?></b></h5></td>                                           
                                            <td data-target="book_rack"><h5><b><?php echo $books['b_self']; ?></b></h5></td>
                                            <td><h5><b><?php 
                                            if($books['b_status']==1 && $books['b_qty']>1){echo '<span class=" btn btn-success">Available</span>';}
                                             
                                             
                                            else{ echo '<span class="btn btn-danger">Unavailable</span>'; } ?></b></h5></td>
                                            
                                            <td><h5>
                                                <a class="btn btn-primary" onClick="window.open('book_details.php?bookId=<?php echo $books['b_id']; ?>','SearchTip','width=700,height=630,resizable=yes,scrollbars=yes')">
                                                  <i class="fa fa-info-circle"></i> Details
                                                </a></h5>
                                            </td>
                                            <td><h5><b>
                                                        <form action="post_update_book.php" method="post">
                                                    <input type="hidden" value="<?php echo $books['b_id']; ?>" name="updt_id"/>
                                                    
                                                    <input type="submit" class="btn btn-md btn-warning" value="Update"/>
                                                    
                                                  <!-- <a href="#" class=" btn btn-md btn-warning"> <i class="fa fa-edit"></i> Update</a>
                                                     -->
                                                        </form>     
                                                        
                                       <!--                 
                                     <a href="#" data-role="update" data-id="<?php echo $books['b_id']; ?>" class=" btn btn-md btn-warning"> <i class="fa fa-edit"></i> Update</a>
                                               -->     </b></h5></td>
                                            
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
    
    
        
    
        <script>
  $(document).ready(function(){

    //  append values in input fields
      $(document).on('click','a[data-role=update]',function(){
            var id  = $(this).data('id');
            //var std_name  = $(this).data('u_name');
            var book_code  = $('#'+id).children('td[data-target=book_code]').text();
            var book_name  = $('#'+id).children('td[data-target=book_name]').text();
            var book_qty  = $('#'+id).children('td[data-target=book_quantity]').text();
            var book_prc  = $('#'+id).children('td[data-target=book_price]').text();
            var book_rak  = $('#'+id).children('td[data-target=book_rack]').text();
          
           
            
            $('#book_code').val(book_code);
            $('#book_name').val(book_name);
            $('#book_quantity').val(book_qty);
            $('#book_price').val(book_prc);
            $('#book_rack').val(book_rak);
            
           
            $('#book_id').val(id);
            $('#myModal').modal('toggle');
      });

      // now create event to get data from fields and update in database 
      
       $('#save').click(function(){
          var id  = $('#book_id').val(); 
        
         var book_code =  $('#book_code').val();
         
         var book_name =  $('#book_name').val();
         var book_qty =  $('#book_quantity').val();
         var book_prc =  $('#book_price').val();
         var book_rak =  $('#book_rack').val();
       
       $.ajax({
              url      : 'view_book.php',
              method   : 'post', 
              data     : {bk_code : book_code ,bk_name : book_name ,bk_qty : book_qty ,bk_prc : book_prc,bk_rak:book_rak,id: id},
              success  : function(response){
                            // now update user record in table 
                                                      
                             $('#'+id).children('td[data-target=book_code]').text(book_code);
                               $('#'+id).children('td[data-target=book_name]').text(book_name);
                                 $('#'+id).children('td[data-target=book_quantity]').text(book_qty);
                                   $('#'+id).children('td[data-target=book_price]').text(book_prc);
                                     $('#'+id).children('td[data-target=book_rack]').text(book_rak);
                                                     
                             $('#myModal').modal('toggle');
                           

                         }
          });
       });

  });
</script>
       
        
         <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header bg-primary">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title text-center ">Book Update</h4>
          </div>
          <div class="modal-body">           
              <div class="form-group">
                <label>Book Code</label>
                <b><input type="number" id="book_code" class="form-control"></b>
              </div>   
              <div class="form-group">
                <label>Book Name</label>
                <input type="text" id="book_name" class="form-control">
              </div>   
              <div class="form-group">
                <label>Book Quantity</label>
                <input type="text" id="book_quantity" class="form-control">
              </div>   
              <div class="form-group">
                <label>Book Price</label>
                <input type="text" id="book_price" class="form-control">
              </div> 
              <div class="form-group">
                <label>Book Rack</label>
                <input type="text" id="book_rack" class="form-control">
              </div>
              
                
                
              
              <input type="text" id="book_id" class="form-control">
          </div>
          <div class="modal-footer">
            <a href="#" id="save" class="btn btn-primary pull-right">Update</a>
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
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


