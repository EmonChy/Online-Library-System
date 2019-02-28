<?php
session_start();
include './functions.php';
  if(isset($_SESSION['student'])){   
     $sid = $_SESSION['student']['id'];
      
      //$sid = $_GET['s_id'];
      $student = get_student_info_by_id($sid);
      $dept = get_dept_info_by_id($student['u_dept']);
      $sec =  get_sec_info_by_id($student['u_section']); 
  
     
?>





<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>home Page</title>
        <style></style>
       
           <link rel="stylesheet" href="css/bootstrap.css"/>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-danger text-center "> 
            <div class="panel panel-heading">
                <h1 style="font-family: cursive;font-weight: bold;">Welcome student info page</h1>     
            </div>
            <div class="panel panel-body ">
               
                <table class="table table-bordered text-center" >
                    <tr>
                        <td colspan="2">
                           <?php echo "<img src = 'image/".$student['image']."' height=100px width=200px />"; ?>
                    </tr>
                    <tr>
                        <td class="text-right ">name:</td>
                        <td class="text-left"><?php echo $student['u_name']; ?></td>
                      
                    </tr>
                    <tr>
                          <td class="text-right ">id:</td>
                          <td class="text-left"><?php echo $student['u_id']; ?></td>
                    </tr>
                    <tr>
                        <td class="text-right ">email:</td>
                          <td class="text-left"><?php echo $student['u_email']; ?></td>
                    </tr>
                    <tr>
                        <td class="text-right ">mob:</td>
                          <td class="text-left"><?php echo $student['u_mob']; ?></td>
                    </tr>
                    <tr>
                        <td class="text-right ">pin:</td>
                          <td class="text-left"><?php echo $student['u_pin']; ?></td>
                    </tr>
                    <tr>
                        <td class="text-right ">amount:</td>
                          <td class="text-left"><?php echo $student['u_amount']; ?></td>
                    </tr>
                     <tr>
                        <td class="text-right ">dept:</td>
                          <td class="text-left"><?php echo $dept['d_code']."(".$dept['d_name'].")"; ?></td>
                    </tr>
                    <tr>
                        <td class="text-right ">sec:</td>
                          <td class="text-left"><?php echo $sec['sec_name']; ?></td>
                    </tr>
                    
                </table>
                             
            </div>
            <div class=" panel-footer text-danger ">
                <p  style="text-align: center;font-size: 30px;"><a href="student_list.php">Back To Student List</a></p>
                <a href="logout.php">logout</a>
            </div>
        </div>
            </div>
          </div>
            
        </div>
   
    </body>
</html>
<?php }
  else{
     header ('Location:index.php');
  } ?>
