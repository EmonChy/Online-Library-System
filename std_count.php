<?php
include './functions.php';
  if(isset($_GET['std_c_id']))
  {
      $sid = $_GET['std_c_id'];
      $std_count = get_all_students_count($sid);
  
    
  }
  
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
        <div class="panel panel-primary text-center "> 
            <div class="panel panel-heading">
                <h1 style="font-family: cursive;font-weight: bold;">std info page</h1>     
            </div>
            <div class="panel panel-body ">
               
                <table class="table table-bordered table-striped" >
                    <tr>
                        <td colspan="2">
                            <img class="img img-thumbnail img-rounded" src="image/kh001.jpg" alt="flower" width="200"/>
                    </tr>
                    
                    <tr>
                        <td class="text-right text-info ">no of  total students:</td>
                        <td class="text-left"><?php echo count($std_count); ?></td>
                         
                      
                    </tr>
                    
                    
                    
                </table>
                             
            </div>
            
        </div>
            </div>
          </div>
        </div>
        
    </body>
</html>